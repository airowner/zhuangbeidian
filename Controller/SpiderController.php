<?php

App::uses('AppController', 'Controller');

class SpiderController extends AppController 
{
    public $layout = 'default';

    public $name = 'Spider';
    //public $helper = array('Html');

    public $uses = array('ItemGetBefore', 'Tag');
    
    private $tags = array();
    private $game = array();
    private $cate = array();
    private $ccate = array();
    private $price = array();
    
    public function __construct($id, $module=null)
    {
        parent::__construct($id, $module);
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
      
            $taobaoid = $this->getTaobaoId($url);
            try{
                $item = self::getItem($taobaoid);
            }catch(Exception $e){
                var_dump($e->getMessage());
                $this->Session->setFlash($e->getMessage());
                exit();
            }
            
            var_dump($item);exit;
            try{
                $shop = self::getShop($item['nick']);
            }catch(Exception $e){
                $this->Session->setFlash($e->getMessage());
                exit();
            }

            //~ http://detail.tmall.com/item.htm?spm=a2106.m874.1000384.d11&id=12399021577&source=dou&scm=1029.0.1.1
            //~ $data = TaoBaoApi::get($url);
            //~ if($data){
                //~ $this->requestAction(array('action'=>'add'), $data);
            //~ }else{
                //~ $this->Session->setFlash(__('获取数据失败.'));
            //~ }
        }
    }
    
    private function getTaobaoId($url)
    {
        if(!preg_match('/[^\/\s]+(taobao|tmall)\.com\//', $url)){
            $this->Session->setFlash(__('传入url必须是淘宝商品url'));
            exit();
        }
        $id = false;
        $query = parse_url($url, PHP_URL_QUERY);
        parse_str($query, $q_ary);
        foreach($q_ary as $key => $value){
            switch($key){
                case 'id':
                    $id = $value;
                    break;
            }
        }
        if(!$id){
            $this->Session->setFlash(__('参数解析不正确'));
            exit();
        }
        return $id;
    }
    
    private static function TopClient()
    {
        static $client = null;
        if(!$client){
            include(WWW_ROOT . '../Lib/top/TopClient.php');
            include(WWW_ROOT . '../Lib/top/RequestCheckUtil.php');
            //~ TopConf::$online = false;
            $client = new TopClient();
        }
        return $client;
    }
    
    /*
     array (
      'approve_status' => 'onsale',
      'auction_point' => 0,
      'cid' => 1101,
      'delist_time' => '2012-08-13 20:16:43',
      'desc' => '',#描述页
      'detail_url' => 'http://item.taobao.com/item.htm?id=18446972931&spm=2014.12129701.0.0',
      'ems_fee' => '0.00',
      'express_fee' => '0.00',
      'freight_payer' => 'seller',
      'has_discount' => false,
      'has_invoice' => false,
      'has_showcase' => false,
      'has_warranty' => true,
      'input_pids' => '14837354',
      'input_str' => '5公斤',
      'is_virtual' => false,
      'item_imgs' => 
      array (
        'item_img' => 
        array (
          0 => 
          array (
            'id' => 0,
            'position' => 0,
            'url' => 'http://img06.taobaocdn.com/bao/uploaded/i6/T1sZaDXXRzXXXMolgW_024416.jpg',
          ),
        ),
      ),
      'list_time' => '2012-08-06 20:16:43',
      'location' => 
      array (
        'city' => '上海',
        'state' => '上海',
      ),
      'modified' => '2012-08-11 17:02:16',
      'nick' => '方承实业',
      'num' => 983,
      'num_iid' => 18446972931,
      'outer_id' => '',
      'pic_url' => 'http://img06.taobaocdn.com/bao/uploaded/i6/T1sZaDXXRzXXXMolgW_024416.jpg',
      'post_fee' => '0.00',
      'postage_id' => 0,
      'price' => '7999.00',
      'property_alias' => '1627207:28341:大陆行货',
      'props' => '14837354:8346491;20000:30111;3127340:38597;31182:152318040;20100:21372;31356:99825;20143:124862591;14513524:148396841;20183:21968;31357:72163639;20121:14873065;20122:65242;14636630:3222910;20137:21955;20145:11669893;1626817:3422062;1626817:107193199;1626975:3229217;4012728:12805419;21530:122742847;20930:32998;31696:137283541;20420:27389;14495765:33214235;14528434:6548912;14528551:24312922;14528616:80137;14528616:3218357;20879:21456',
      'seller_cids' => ',225095017,225092888,',
      'stuff_status' => 'new',
      'title' => '实体2012款13寸Apple/苹果 MacBook Pro MD101CH/A正品行货笔记本',
      'type' => 'fixed',
      'valid_thru' => 7,
      );
     */
    private static function getItem($num_id)
    {
        static $request = null;
        if(!$request){
            include(WWW_ROOT . '../Lib/top/request/ItemGetRequest.php');
            $request = new ItemGetRequest();
            $request->setFields("detail_url,num_iid,title,nick,type,cid,seller_cids,props,input_pids,input_str,desc,pic_url,num,valid_thru,list_time,delist_time,stuff_status,location,price,post_fee,express_fee,ems_fee,has_discount,freight_payer,has_invoice,has_warranty,has_showcase,modified,increment,approve_status,postage_id,product_id,auction_point,property_alias,item_img,prop_img,sku,video,outer_id,is_virtual");
        }
        $request->setNumIid($num_id);
        $result = self::TopClient()->execute($request);
var_dump($result);exit;
        $result = self::parse_taobao($result);
        if($result && isset($result['item_get_response'], $result['item_get_response']['item'])){
            $result = $result['item_get_response']['item'];
        }
        return $result;
    }
    
    /*
     array (
        'bulletin' => '',
        'cid' => 10,
        'created' => '2012-06-16 19:44:43',
        'desc' => '这是店铺描述。....................',
        'modified' => '2012-08-20 12:46:28',
        'nick' => 'sandbox_b_20',
        'pic_path' => '',
        'sid' => 50795559,
        'title' => 'sandbox_b_20的测试商城店铺',
      ),
    */
    private static function getShop($taobao_nick)
    {
        static $request = null;
        if(!$request){
            include(WWW_ROOT . '../Lib/top/request/ShopGetRequest.php');
            $request = new ShopGetRequest();
            $request->setFields("sid,cid,title,nick,desc,bulletin,pic_path,created,modified");
        }
        $request->setNick($taobao_nick);
        $result = self::TopClient()->execute($request);
        $result = self::parse_taobao($result);
        if($result){
            $result = $result['shop'];
        }
        return $result;
    }
    
    private static function parse_taobao($result)
    {
        if($result->code){
            $error = '';
            if(isset($result->msg)){
                $error .= $result->msg;
            }
            if(isset($result->submsg)){
                $error .= ' '. $result->submsg;
            }
            throw new Exception($error);
        }
        //parse
        return @json_decode($result, true);
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
