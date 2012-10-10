<?php

App::uses('AppController', 'Controller');

class SpiderController extends AppController 
{
    public $layout = 'default';

    public $name = 'Spider';
    //public $helper = array('Html');
	public $components = array('Taobao');

    public $uses = array('Item', 'Tag', 'Shop');
    
    private $tags = array();
    private $game = array();
    private $cate = array();
    private $ccate = array();
    private $price = array();
    
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('*');
        $this->game = $this->Tag->getCategory('#game', false, false);
        $this->price = $this->Tag->getCategory('#price', false, false);
        $this->cate = $this->Tag->getCategory('#product', false, false);

        $this->set('all_game', $this->game);
        $this->set('all_cate', $this->cate);
        $this->set('all_price', $this->price);
    }
    
    //添加淘宝url
    public function request()
    {
         if ($this->request->is('post') || $this->request->is('put')) {
            $url = $this->request->data['Spider']['url'];
			//~ http://detail.tmall.com/item.htm?spm=a2106.m874.1000384.d11&id=12399021577&source=dou&scm=1029.0.1.1
			$item = $this->Taobao->TKItemByUrl($url);
			if(!$item){
				$this->Session->setFlash('抓取不成功!');
				$this->redirect(array('action'=>'request'));
			}
            $item = $this->prepareItem($item);
			$nick = $item['nick'];

            $item = array('Item'=>$item);
            $this->Item->create();
			try{
            	if($this->Item->save($item)){
                    $this->redirect(array('action'=>'js_getother', $this->Item->id, $num_iid, $nick));
					//保存成功后直接添加tag标记
					//$this->redirect(array('controller'=>'tagitem', 'action' => 'add', $this->Item->id));
	            }else{
	                debug($this->Item->validationErrors);
	                exit;
					//$this->Session->setFlash('保存数据不成功!');
					//$this->redirect(array('action'=>'request'));
	            }
			}catch(Exception $e){
				if($e->getCode() == '23000'){
					$this->Session->setFlash('此商品已经被抓取过!');
					$this->redirect(array('action'=>'request'));
				}
				var_dump($e);exit;
			}
			
            //$shop = $this->Taobao->TKShopByNicks($nick);
            ////$shop = $this->Taobao->TKShop($nick);
            //if(!$shop){
			//	$this->Session->setFlash('获取店铺信息错误!');
			//	$this->redirect(array('action'=>'request'));
			//}

            //var_export($item, $shop);exit;
        }
    }

    private function prepareItem($item)
    {
        $return_item = array();
        $return_item['click_url'] = $item->click_url;
        $return_item['shop_click_url'] = $item->shop_click_url;
        $return_item['seller_credit_score'] = $item->seller_credit_score;
        $product = $item->item;
        foreach($product as $key => $value){
            if(is_bool($value)){
                $value = $value ? 1 : 0;
            }
            switch($key){
            case 'location':
                $return_item['city'] = $value->city;
                $return_item['state'] = $value->state;
                break;
            case 'skus':
            case 'prop_imgs':
            case 'item_imgs':
                $return_item[$key] = json_encode($value);
                break;
            default:
                $return_item[$key] = $value;
            }
        }
        return $return_item;
    }
    

    public function js_getother( $numiid, $nick ) {}

    public function shop()
    {
        if (!$this->request->is('post')){
            exit('0');
        } 
    /*
     * {"taobaoke_shops":{"taobaoke_shop":[{"auction_count":"301","click_url":"http://s.click.taobao.com/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTdjPgsro5sLEzTdlUjmtJ3pgL%2B551VN4LnW4B7LFeB2egIham6k%2FHBiJHdmWpw%2B87SCRbN0wVXDXsdIpbAaVkL2zT0aAbtrGAV3XPyDdPkMrjawy4%3D&pid=mm_17531361_0_0","commission_rate":"5.38","seller_credit":"11","seller_nick":"清若彤","shop_id":11436017,"shop_title":"miss2蜜s兔-淘宝服饰频道官方合作店铺","shop_type":"C","total_auction":"3895","user_id":20737888}]}}
     */
        if(!isset($this->request->taobaoke_shops,$this->request->taobaoke_shops['taobaoke_shop'])){
            exit('0');
        }
        $shop = $this->request->taobaoke_shops['taobaoke_shop'][0];
        $this->Shop->create();
        if($this->Shop->save(array('Shop'=>$shop))){
            exit('1');
        }
        exit('0');
    }

    public function item()
    {
        if (!$this->request->is('post')){
            exit('0');
        } 
    }
    
    private function translate($tagid)
    {
        if(isset($this->tags[$tagid])){
            return $this->tags[$tagid];
        }
        $t = $this->Tag->find('first', array('condition'=>array('id'=>$tagid)));
        $this->tags[$t['Tag']['id']] = $t['Tag']['tag'];
        
        return $this->tags[$tagid];
    }
    
    private function translateItem(&$item)
    {
        $tagsid = explode(',', $item['ItemGetBefore']['tags']);
        $tagsname = array();
        foreach($tagsid as $tagid){
            $tagsname[] = $this->translate($tagid);
        }
        $item['ItemGetBefore']['tags'] = implode(',', $tagsname);
    }
    
    private function setCateById($tags)
    {
        $tagsid = explode(',', $tags);
        $other = array();
        foreach($tagsid as $tagid){
            if(isset($this->game[$tagid])){
                $this->set('game', array($tagid => $this->translate($tagid)));
            }elseif(isset($this->cate[$tagid])){
                $this->set('cate', array($tagid => $this->translate($tagid)));
            }elseif(isset($this->ccate[$tagid])){
                $this->set('ccate', array($tagid => $this->translate($tagid)));
            }elseif(isset($this->price[$tagid])){
                $this->set('price', array($tagid => $this->translate($tagid)));
            }else{
                $other[$tagid] = $this->translate($tagid); 
            }
            $this->set('other', $other);
        }
    }
    
/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->Item->recursive = 0;
        $result = $this->paginate();
        foreach($result as &$r){
            $this->translateItem($r);
        }
        $this->set('spiders', $result);
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        $this->ItemGetBefore->id = $id;
        if (!$this->ItemGetBefore->exists()) {
            throw new NotFoundException(__('Invalid spider'));
        }
        $item = $this->ItemGetBefore->read(null, $id);
        $this->set('item', $item);
        $this->setCateById($item['tags']);
    }
    
    private function tagExists($tagname){
        $result = $this->Tag->findByTag($tagname, 'id');
        return $result?$result['Tag']['id']:false;
    }
/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $other = $this->request->data['Spider']['other'];
            if($other){
                $other_tagpid = $this->Tag->findByTag('#user', 'id'); 
                $others = preg_split('/[\s,]+/', $other);
                $_otherid = array();
                foreach($other as $o){
                    $id = $this->tagExists($o);
                    if(!$id){
                        $this->Tag->create(array('tag'=>$o, 'pid'=>$other_tagpid['Tag']['id']));
                        $_otherid[] = $this->Tag->getInsertId();
                    }else{
                        $_otherid[] = $id;
                    }
                }
                $this->request->data['Spider']['other'] = implode(',', $_otherid); 
            }
            $this->ItemGetBefore->create();
            if ($this->ItemGetBefore->save($this->request->data)) {
                $this->Session->setFlash(__('The spider has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The spider could not be saved. Please, try again.'));
            }
        }
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        $this->ItemGetBefore->id = $id;
        if (!$this->ItemGetBefore->exists()) {
            throw new NotFoundException(__('Invalid ad'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $other = $this->request->data['Spider']['other'];
            if($other){
                $other_tagpid = $this->Tag->findByTag('#user', 'id'); 
                $others = preg_split('/[\s,]+/', $other);
                $_otherid = array();
                foreach($other as $o){
                    $id = $this->tagExists($o);
                    if(!$id){
                        $this->Tag->create(array('tag'=>$o, 'pid'=>$other_tagpid['Tag']['id']));
                        $_otherid[] = $this->Tag->getInsertId();
                    }else{
                        $_otherid[] = $id;
                    }
                }
                $this->request->data['Spider']['other'] = implode(',', $_otherid); 
            }
            if ($this->ItemGetBefore->save($this->request->data)) {
                $this->Session->setFlash(__('The spider has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The spider could not be saved. Please, try again.'));
            }
        } else {
            $item = $this->ItemGetBefore->read(null, $id);
            $this->setCateById($item['tags']);
            $this->request->data = $item;
        }
    }

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->ItemGetBefore->id = $id;
        if (!$this->ItemGetBefore->exists()) {
            throw new NotFoundException(__('Invalid spider'));
        }
        if ($this->ItemGetBefore->delete()) {
            $this->Session->setFlash(__('Item deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Item was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
