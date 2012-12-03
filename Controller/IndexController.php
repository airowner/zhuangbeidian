<?php

App::uses('AppController', 'Controller');

class IndexController extends AppController 
{
    public $name = 'Index';

    //public $helper = array('Html');
    public $components = array('Sphinx');

    public $uses = array('Ad', 'Tag', 'Item', 'TagItem');
    
    function beforeFilter() 
    {
        parent::beforeFilter(); 
        $this->Auth->allowedActions = array('*');
        $this->set('baseurl', '/');
        
        $this->ads();

        $this->tree = $this->Tag->getTree();
        $this->set('tree', $this->tree);
        $this->game = $this->Tag->getCategory('#game');
        $this->set('game', $this->game);
        $this->cates = $this->Tag->getCategory('#product');
        $this->set('cates', $this->cates);
        $this->set('price', $this->Tag->getCategory('#price'));
    }

    private function ads()
    {
        $_ads = $this->Ad->find('all', array(
            //'conditions' => array('id' => '<5'),
        ));
        $ads = array();
        foreach(Hash::extract($_ads, '{n}.Ad') as $ad){
            $ads[$ad['id']] = $ad;
        }
        $this->set('ads', $ads);
    }

    public function index()
    {
        
    }

    public function tag()
    {
        /*
         * 含有推广itemid
         */
        $item = array();
        if(isset($this->request->query['item'])){
            $itemid = intval($this->request->query['item']);
            if($itemid > 0){
                $item = $this->Item->findById($itemid);
            }
        }
        $this->set('item', $item);

        //实现路由
        if(!preg_match('~^([a-zA-Z]+)/([\d_]+)/?$~', $this->request->url, $mt)){
            return $this->setAction('index');
        }

        $tags = array_unique(explode('_', $mt[2]));
        $this->_tag($tags);
		
        $items = $this->_search();
        var_dump($items);
		//items
		$items = $this->TagItem->find('all', array(
			'fields' => array(
				'Item.id, Item.title, Item.pic_url, Item.price, Item.click_url, Item.shop_click_url, Item.nick, Item.num',
			),
			'conditions' => array(
				'TagItem.tag_id' => $tags,
			),
			'contain' => array('Item'),
			'order' => array('price asc'),
			'page' => 1,
			'limit' => 12,
		));

		$this->set('items_count', $this->TagItem->find('count', array('conditions'=>array('TagItem.tag_id'=>$tags))));
		$items = Hash::extract($items, '{n}.Item');
		$this->set('items', $items);
    }

    public function search()
    {
        $ret = array(
            'errmsg' => '',
            'data' => array(),
        );
        try{
            $ths->_search();
        }catch(Exception $e){
            $ret['errmsg'] = $e->getMessage();
        }
        var_dump($result);exit;
        if(!$ret['errmsg']){
            $ret['data'] = $result;
        }
        echo json_encode($ret);
        exit();
    }

    private function _search()
    {
        $kw = trim($this->get('kw'));
        $page = intval($this->get('page', 1));
        $limit = intval($this->get('limit', 12));
        $new_order = $this->getOrder();
        $new_filter = $this->getFilter();
        $options = array(
            'limit' => array(($page-1)*$limit, $limit),
            'order' => $new_order,
            'filter ' => $new_filter,
        );
        $result = $this->Sphinx->query($kw, $options);
        return $result;
    }

    private function get($p, $default='')
    {
        if(isset($this->request->query[$p])){
            return $this->request->query[$p];
        }
        return $default;
    }

    private function getOrder()
    {
        $order = trim($this->get('order'));
        $_order_mode = array('delist_time'=>1, 'price'=>1, 'seller_credit_score'=>1, 'volume'=>1);
        $_order_type = array('asc'=>1, 'desc'=>1);
        $new_order = array();
        if($order){
            $order = explode(',', $order);
            foreach($order as $o){
                $o = explode(' ', $o, 2);
                $o = array_map('trim', $o);
                if(!isset($_order_mode[$o[0]]) || !isset($_order_type[$o[1]])) continue;
                $new_order[$o[0]] = $o[1];
            }
        }else{
            $new_order['price'] = 'asc';
        }
        return $new_order;
    }

    // filter=a:0,100;b:100,200,1 // dimension:start|value[, end[, exinclude]]
    private function getFilter()
    {
        $filter = trim($this->get('filter'));
        $new_filter = array();
        if($filter){
            $filter = explode(';', $filter);
            foreach($filter as $f){
                $f = trim($f);
                if(!$f) continue;
                $f = explode(':', $f, 2);
                if(count($f) < 2) continue;
                $fk = trim($f[0]);
                $fv = explode(',', $f[1]);
                if(count($fv)>3) continue;
                $tmp = array();
                foreach($fv as $v){
                    if(!is_numeric($v)) continue 2;
                    $v = intval($v);
                    $tmp[] = $v;
                }
                $new_filter[$fk] = $tmp;
            }
        }
        return $new_filter;
    }

	public function topcallback()
	{
		echo "callback";exit;
		$top_appkey = $_GET['top_appkey']; 
		$top_parameters = $_GET['top_parameters']; 
		$top_session = $_GET['top_session']; 
		$top_sign = $_GET['top_sign']; 

		$secret = 'xxxxxxx'; // 别忘了改成你自己的 

		$md5 = md5( $top_appkey . $top_parameters . $top_session . $secret, true ); 
		$sign = base64_encode( $md5 ); 

		if ( $sign != $top_sign ) { 
			echo "signature invalid."; 
			exit(); 
		} 

		$parameters = array(); 
		parse_str( base64_decode( $top_parameters ), $parameters ); 

		$now = time(); 
		$ts = $parameters['ts'] / 1000; 
		if ( $ts > ( $now + 60 * 10 ) || $now > ( $ts + 60 * 30 ) ) { 
			echo "request out of date."; 
			exit(); 
		} 

		echo "welcome {$parameters['visitor_nick']}."; 
	}

    private function _tag($tags)
    {
        //path
        $tags = $this->Tag->get_Path($tags);
        $active = array();
        foreach($tags as $tag){
            foreach($tag as $_t){
                $active[$_t['id']] = $tag;
                break;
            }
        }
        $this->set('active', $active);
    }

}
