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
        $this->setTopQuery();

        $this->tree = $this->Tag->getTree();
        // var_dump($this->tree);exit;
        $this->set('tree', $this->tree);
        $this->game = $this->Tag->getCategory('#game');
        $this->set('game', $this->game);
        $this->cates = $this->Tag->getCategory('#product');
        $this->set('cates', $this->cates);
        $this->set('price', $this->Tag->getCategory('#price'));
    }

    private function setTopQuery()
    {      
        $query_keywords = array();
        if(file_exists('/tmp/query_log')){
            $query_keywords = file_get_contents('/tmp/query_log');
            $query_keywords = explode("\n", trim($query_keywords));
            foreach($query_keywords as $k => $qk){
                if(!$qk){
                    unset($query_keywords[$k]);
                }
            }
        }
        $default_query_keywords = array('lol', '雷蛇', '马克杯', '手机壳', '钥匙坠', '韩版');
        $query_keywords = array_slice(array_unique(array_merge($query_keywords, $default_query_keywords)), 0, 6);
        $this->set('query_keywords', $query_keywords);
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
        $this->setItem();
        $this->search();
        $tags = trim($this->get('tags'));
        $tags = array_unique(explode('_', $tags));
        $active = $this->getActive($tags);
        $this->set('active', $active);
    }

    public function search()
    {
        $kw = trim($this->get('kw'));
        $tags = trim($this->get('tags'));
        $sort = trim($this->get('sort'));
        $page = intval($this->get('page', 1));
        $limit = intval($this->get('limit', 16));

        if(!$sort){
            $sort = 'price asc';
        }

        $url = array(
            'kw' => $kw,
            'tags' => $tags,
            'sort' => $sort,
            'page' => $page,
            'limit' => $limit,
        );

        $ret = array(
            'errmsg' => '',
            'data' => array(),
        );
        $search_result = array();
        $search_count = 0;
        try{
            $options = array(
                'limit' => array(($page-1)*$limit, $limit),
                'sort' => $this->getSort($sort),
                'filter' => $this->getFilter($tags),
            );
            $search_result = $this->Sphinx->query($kw, $options);
            $search_count = $search_result['total'];
            $search_result = $search_result['items'];
            foreach($search_result as &$item){
                unset($item['desc'], $item['tags_id']);
            }
        }catch(Exception $e){
            $ret['errmsg'] = $e->getMessage();
        }

        if($this->request->is('ajax')){
            if(!$ret['errmsg']){
                $ret['data'] = $search_result;
            }
            echo json_encode($ret);
            die();
        }

        $this->set(compact('kw','tags', 'order', 'page', 'limit', 'url', 'search_result', 'search_count'));
    }

    private function setItem()
    {
        $item = array();
        if(isset($this->request->query['item'])){
            $itemid = intval($this->request->query['item']);
            if($itemid > 0){
                $item = $this->Item->findById($itemid);
            }
        }
        $this->set('item', $item);
    }

    private function get($p, $default='')
    {
        if(isset($this->request->query[$p])){
            return $this->request->query[$p];
        }
        return $default;
    }

    private function getSort($sort)
    {
        $_sort_mode = array('delist_time'=>1, 'price'=>1, 'seller_credit_score'=>1, 'volume'=>1);
        $_sort_type = array('asc'=>1, 'desc'=>1);
        $new_sort = array();
        $sort = explode(',', $sort);
        foreach($sort as $o){
            $o = explode(' ', $o, 2);
            $o = array_map('trim', $o);
            if(!isset($_sort_mode[$o[0]]) || !isset($_sort_type[$o[1]])) continue;
            $new_sort[$o[0]] = $o[1];
        }
        return $new_sort;
    }

    private function getFilter($tags)
    {
        $new_filter = array();
        if(!$tags) return $new_filter;
        $tags = array_unique(explode('_', $tags));
        foreach($tags as $tag){
            $new_filter[] = array('key'=>'tag_ids', 'value'=>array($tag));
        }
        return $new_filter;
    }

    // filter=a:0,100;b:100,200,1 // dimension:start|value[, end[, exinclude]]
    private function getFilterScope()
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

    private function getActive($tags)
    {
        $tags = $this->Tag->get_Path($tags);
        $active = array();
        foreach($tags as $tag){
            foreach($tag as $_t){
                $active[$_t['id']] = $tag;
                break;
            }
        }
        return $active;
    }


    private function mysql_tag()
    {
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
}
