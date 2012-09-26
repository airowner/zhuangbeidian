<?php

App::uses('AppController', 'Controller');

class SpiderController extends AppController 
{
    public $layout = 'default';

    public $name = 'Spider';
    //public $helper = array('Html');
	public $components = array('Taobao');

    public $uses = array('Item', 'Tag');
    
    private $tags = array();
    private $game = array();
    private $cate = array();
    private $ccate = array();
    private $price = array();
    
    public function beforeFilter()
    {
        $this->Auth->allow('*');
        $this->game = $this->Tag->getCategory('#game', true);
        $this->price = $this->Tag->getCategory('#price', true);
        $this->cate = $this->Tag->getCate(true);

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
			
			$nick = $item->nick;
            //$shop = $this->Taobao->TKShopByNicks($nick);
            $shop = $this->Taobao->TKShop('古老鲨鱼');
            if(!$shop){
				$this->Session->setFlash('获取店铺信息错误!');
				$this->redirect(array('action'=>'request'));
			}
			
			$item = json_decode(json_encode($item), true);
			$shop = json_decode(json_encode($shop), true);
			
			$handle = fopen(dirname(__FILE__) . '/../tmp/data', 'w');
			$content = "<?php\n";
			$content .= "\$item = ";
			$content .= var_export($item, true);
			$content .= "\n\$shop = ";
			$content .= var_export($shop, true);
			fwrite($handle, $content);
			fclose($handle);
			
			die("done");
        }
    }
    
    public function testsave()
    {
        require dirname(dirname(__FILE__)) . '/data.php';
        $item['city'] = $item['location']['city'];
        $item['state'] = $item['location']['state'];
        $item['item_imgs'] = json_encode($item['item_imgs']);
        $item['prop_imgs'] = json_encode($item['prop_imgs']);
        $item['skus'] = json_encode($item['skus']);
        $item['cick_url'] = '';
        $item['shop_click_url'] = '';
        $item['seller_credit_score'] = 11;


        $item = array('Item'=>$item);
        var_export($item);
        $this->Item->create();
        var_dump($this->Item->save($item));
        exit;

        $shop = json_decode(json_encode($shop));
        $shops = $shop->taobaoke_shops->taobaoke_shop;
        var_export($item);
        var_export($shop);
        exit;
    }
    private function _setSelect($data)
    {
        $_data = array();
        foreach($data as $d){
            $_data[$d['id']] = $d['tag'];
        }
        $this->tags += $_data;
        return $_data;
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
        $this->ItemGetBefore->recursive = 0;
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
