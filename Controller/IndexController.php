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

    public function search($name)
    {
        $name = preg_split('/[\s\n]/', $name);
        $result = $this->Sphinx->query($name);
        var_dump($result);exit;
        echo "unimplements<br>\n";
        var_dump($name);
        exit;
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
