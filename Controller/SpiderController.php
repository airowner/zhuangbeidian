<?php

App::uses('AppController', 'Controller');

class SpiderController extends AppController 
{
    public $layout = 'default';

    public $name = 'Spider';
    //public $helper = array('Html');
	public $components = array('Taobao');

    public $uses = array('Item', 'Tag', 'Shop', 'ItemExt');
    
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('*');
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
			// var_dump($item);exit;
			$num_iid = $item['num_iid'];
			$nick = $item['nick'];

            $item = array('Item'=>$item);
            $this->Item->create();
			try{
            	if($this->Item->save($item)){
                    $this->redirect(array('action'=>'js_getother', $this->Item->id, $num_iid, $nick));
					//保存成功后直接添加tag标记
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

    //获取商店信息
    public function shop()
    {
        if (!$this->request->is('post')){
            CakeLog::info('request is not post method');
            exit('0');
        } 
    /*
     * {"taobaoke_shops":{"taobaoke_shop":[{"auction_count":"301","click_url":"http://s.click.taobao.com/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTdjPgsro5sLEzTdlUjmtJ3pgL%2B551VN4LnW4B7LFeB2egIham6k%2FHBiJHdmWpw%2B87SCRbN0wVXDXsdIpbAaVkL2zT0aAbtrGAV3XPyDdPkMrjawy4%3D&pid=mm_17531361_0_0","commission_rate":"5.38","seller_credit":"11","seller_nick":"清若彤","shop_id":11436017,"shop_title":"miss2蜜s兔-淘宝服饰频道官方合作店铺","shop_type":"C","total_auction":"3895","user_id":20737888}]}}
     */
        if(!isset($this->request->data['taobaoke_shops'],$this->request->data['taobaoke_shops']['taobaoke_shop'])){
            CakeLog::info(__CLASS__ . " " . __METHOD__ . " name post params error");
            exit('0');
        }
        $shop = $this->request->data['taobaoke_shops']['taobaoke_shop'][0];
        switch($shop['shop_type']){
        case 'B':
            $shop['shop_type'] = 2;
            break;
        default:
            $shop['shop_type'] = 1;
        }
        $old_shop = $this->Shop->findByUserId($shop['user_id']);
        if(!$old_shop){
            $this->Shop->create();
        }else{
            $this->Shop->id = $old_shop['Shop']['id'];
        }
        if($this->Shop->save(array('Shop'=>$shop))){
            exit('1');
        }else{
            debug($this->Shop->validationErrors);
            CakeLog::info(__METHOD__ . " name save error");
		}
        exit('0');
    }

    /*
     * {"taobaoke_items":{"taobaoke_item":[{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ay1HpKDx10PCh3jfBdwLVikkFeHfmR9lrpMf4amF9YTOnoL0aUGoV88iHAoApxkRIj7J9d0yxGI%2BHlrgk4Fc7qLfdsWIyOTK6TDutq2757RFn35iFDwI9JQ6bSmOC6amLRblB3J7WPftn7JHzDzRdfDldvgHd5lSFA%3D%3D&spm=2014.21181372.1.0","commission":"3.27","commission_num":"204","commission_rate":"300.00","commission_volume":"1651.77","item_location":"福建 泉州","nick":"哈喽_您好","num_iid":19292304601,"pic_url":"http:\/\/img02.taobaocdn.com\/bao\/uploaded\/i2\/T1aeLJXcFmXXbNihzX_115410.jpg","price":"109.00","seller_credit_score":8,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhX%2FR%2BrHS6GMo3tRsQtiUuHDpDzaYE7AGhHVdmKUuZOz%2FN8CMuTkTU0MYyZa1dsancyUEk4JJSsVddwCWk9ihpZaQmNF%2B%2BXMT%2FMe%2BgpJ6nh5zfhfP8zUGoLocTAlMQeQgYMPbXiyqOFdwro%3D&spm=2014.21181372.1.0","title":"秋冬新款时尚潮流男士板鞋李宁正品男鞋舒适男鞋韩版李宁运动板鞋","volume":1667}]},"total_results":1}
     */
    //获取商品附加信息
    public function item()
    {
        if (!$this->request->is('post')){
            exit('0');
        }
        if(!isset($this->request->data['taobaoke_items'],$this->request->data['taobaoke_items']['taobaoke_item'])){
            CakeLog::info(__CLASS__ . " " . __METHOD__ . " name post params error");
            exit('0');
        }
        $item_ext = $this->request->data['taobaoke_items']['taobaoke_item'][0];
        $old_item_ext = $this->ItemExt->findByNumIid($item_ext['num_iid']);
        if(!$old_item_ext){
            $this->ItemExt->create();
        }else{
            $this->ItemExt->id = $old_item_ext['ItemExt']['id'];
        }
        if($this->ItemExt->save(array('ItemExt'=>$item_ext))){
            exit('1');
        }else{
            debug($this->ItemExt->validationErrors);
            CakeLog::info(__METHOD__ . " name save error");
		}
        exit('0');
    }

    public function search()
    {
    	$cids = $this->Taobao->AllCids();
    	var_dump($cids);exit;
    	$cids = $this->Taobao->TaobaoCids();
    	var_dump($cids);exit;
    	if($this->request->is('post')){
			$keyword = trim($this->request->data['keyword']);
			$sort = $this->request->data['sort'];
			$page_no = intval($this->request->data['page_no']);
			$page_no = $page_no ? $page_no : 1;
			$page_size = intval($this->request->data['page_size']);
			$page_size = $page_size ? $page_size : 100;

			$items = $this->Taobao->Search($keyword, $sort, $page_no, $page_size);
			var_dump($items);exit;
			$total = $items->total_result;
			$total_page = ceil($total/$page_size);

			$this->set(compact('keyword', 'sort', 'page_no', 'page_size', 'total_page'));
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
