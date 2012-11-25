<?php

App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');

class SpiderController extends AppController 
{
    public $layout = 'default';

    public $name = 'Spider';
    //public $helper = array('Html');
	public $components = array('Taobao', 'Sphinx');

    public $uses = array('Item', 'Tag', 'Shop', 'ItemExt');
    
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('*');
    }

    public function request_error(){}
    
    //添加淘宝url
    public function request($num_iid)
    {
	    $url = 'http://item.taobao.com/item.htm?id=' . $num_iid;

	    //~ http://detail.tmall.com/item.htm?spm=a2106.m874.1000384.d11&id=12399021577&source=dou&scm=1029.0.1.1
	    $item = $this->Taobao->TKItemByUrl($url);
	    if(!$item){
		    $this->Session->setFlash('抓取不成功!');
		    $this->redirect(array('action'=>'request_error'));
	    }
	    $item = $this->prepareItem($item);
	    // var_dump($item);exit;
	    $num_iid = $item['num_iid'];
	    $nick = $item['nick'];

	    $old_item = $this->Item->findByNumIid($num_iid);
	    $this->Item->create();
	    if($old_item){
	    	$this->Item->id = $old_item['Item']['id'];
	    }
	    //var_dump($item);exit;
	    try{
		$this->Item->save(array('Item'=>$item));
		$this->redirect(array('action'=>'js_getother', $this->Item->id, $num_iid, $nick));
	    }catch(Exception $e){
	        CakeLog::error($e->getMessage());
		    $this->Session->setFlash('保存不成功!');
		    $this->redirect(array('action'=>'request_error'));
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
	$return_item['update_time'] = date('Y-m-d H:i:s');
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
        $this->Shop->create();
        if($old_shop){
            $this->Shop->id = $old_shop['Shop']['id'];
        }
	$shop['update_time'] = date('Y-m-d H:i:s');
        try{
	    $this->Shop->save(array('Shop'=>$shop));
            exit('1');
        }catch(Exception $e){
            CakeLog::error($e->getMessage());
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
        if(!isset($this->request->data['taobaoke_items'], $this->request->data['taobaoke_items']['taobaoke_item'])){
            CakeLog::info(__CLASS__ . " " . __METHOD__ . " name post params error");
            exit('0');
        }
        $item_ext = $this->request->data['taobaoke_items']['taobaoke_item'][0];
        $old_item_ext = $this->ItemExt->findByNumIid($item_ext['num_iid']);
        $this->ItemExt->create();
        if($old_item_ext){
            $this->ItemExt->id = $old_item_ext['ItemExt']['id'];
        }
    	$item_ext['update_time'] = date('Y-m-d H:i:s');
    	// var_dump(array('ItemExt'=>$item_ext));exit;
    	try{
                $this->ItemExt->save(array('ItemExt'=>$item_ext));
                exit('1');
            }catch(Exception $e){
                CakeLog::error($e->getMessage());
    	}
        exit('0');
    }

    public function search()
    {
		$query = $_POST;
		$kw = isset($query['kw']) ? trim($query['kw']) : '';
		if(!$kw){
			$this->redirect('/spider', 200, true);
		}

		$page_no = isset($query['page_no']) && intval($query['page_no'])  ? intval($query['page_no']) : 1;
		$page_size = isset($query['page_size']) ? intval($query['page_size']) : 40;
		if($page_size > 40 || $page_size <= 0){
			$page_size = 40;
		}
		
		$start_credit = isset($query['start_credit']) ? intval($query['start_credit']) : 0;
		$end_credit = isset($query['end_credit']) ? intval($query['end_credit']) : 0;
		$start_price = isset($query['start_price']) ? intval($query['start_price']) : 0;
		$end_price = isset($query['end_price']) ? intval($query['end_price']) : 0;
		$start_commissionRate = isset($query['start_commissionRate']) ? intval($query['start_commissionRate']) : 0;
		$end_commissionRate = isset($query['end_commissionRate']) ? intval($query['end_commissionRate']) : 0;

		$sort_enum = array(
		    'price_desc' => 1,
		    'price_asc' => 1,
		    'credit_desc' => 1,
		    'credit_asc' => 1,
		    'commissionRate_desc' => 1,
		    'commissionRate_asc' => 1,
		    'commissionNum_desc' => 1,
		    'commissionNum_asc' => 1,
		    'commissionVolume_desc' => 1,
		    'commissionVolume_asc' => 1,
		    'delistTime_desc' => 1,
		    'delistTime_asc' => 1,
	        );
		$credits = array(
			'', 
			'1heart', '2heart', '3heart', '4heart', '5heart',
			'1diamond', '2diamond', '3diamond', '4diamond', '5diamond',
			'1crown', '2crown', '3crown', '4crown', '5crown',
			'1goldencrown', '2goldencrown', '3goldencrown', '4goldencrown', '5goldencrown',
		);
		$sort = isset($query['sort']) && isset($sort_enum[$query['sort']]) ? $query['sort'] : 'default';

		$options['sort'] = $sort;
		if($start_credit){ $options['startCredit'] = $credits[$start_credit]; }
		if($end_credit)  { $options['endCredit'] = $credits[$end_credit]; }
		if($start_price){ $options['startPrice'] = $start_price; }
		if($end_price){ $options['endPrice'] = $end_price; }
		if($start_commissionRate){ $options['startCommissionRate'] = $start_commissionRate; }
		if($end_commissionRate){ $options['endCommissionRate'] = $end_commissionRate; }

		$items = $this->Taobao->Search($kw, $page_no, $page_size, $options);
		if($items){
			$total = $items->total_results;
			$total_page = ceil($total/$page_size);
		}else{
			$total = 0;
			$total_page = 0;
		}

		$this->set(compact('kw', 'items', 'page_no', 'page_size', 'total', 'total_page', 'start_credit', 'end_credit', 'start_price', 'end_price', 'start_commissionRate', 'end_commissionRate', 'sort'));
    }



/**
 * index method
 *
 * @return void
 */
    public function index() {}

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
