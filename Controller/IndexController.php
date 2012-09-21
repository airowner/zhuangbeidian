<?php

App::uses('AppController', 'Controller');

class IndexController extends AppController 
{
    public $name = 'Index';

    //public $helper = array('Html');

    public $uses = array('Ad', 'Tag', 'Item');

    public function __construct($id, $module=null)
    {
        parent::__construct($id, $module);
        $game = $this->Tag->getCategory('#game');
        $this->game = array();
        foreach($game as $g){
            $this->game[$g['id']] = $g;
        }
        $this->set('game', $this->game);
        $this->cates = $this->Tag->getCate(true);
        $this->set('cates', $this->cates);
    }
    
    function beforeFilter() 
    {
        parent::beforeFilter(); 
        $this->Auth->allowedActions = array('*');
        $this->set('baseurl', '/');
        
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

        $tags = explode('_', $mt[2]);
        $tags = $this->changeTags($tags);

        return $this->_tag($tags);
    }

    public function search($name)
    {
        $name = preg_split('/[\s\n]/', $name);
        echo "unimplements<br>\n";
        var_dump($name);
        exit;
    }

	public function topcallback()
	{
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
        //总tag标记
        $top = $this->Tag->getTop();
        $this->set('root', $this->top);

        //path
        $path = $this->Tag->getPath($tags);
        //~ var_dump($path);exit;
        $active_path = array();
        $return_path = array();
        foreach($path as $k => $p){
            $tag = array_shift($p);
            $tag = $tag['tag'];
            $active = $p[count($p)-1]['id'];
            $_styles = $this->Tag->getCategory($tag);
            $_back = $_styles;
            foreach($p as $_p){
                if(!$_styles){
                    break;
                }
                foreach($_styles as $s){
                    if($s['id'] == $_p['id']){
                        $_back = $_styles;
                        $_styles = $this->Tag->getCategory($s['id']);
                        break;
                    }
                    
                }
            }
            $return_path[$tag] = $_back;
            $active_path[$tag] = $k;
        }
        foreach(array('#game', '#price', '#product') as $t){
            if(isset($return_path[$t])){
                continue;
            }
            $return_path[$t] = $this->Tag->getCategory($t);
            $active_path[$t] = null;
        }
        //~ var_dump($return_path, $active_path);exit;
        $this->set('path', $return_path);
        $this->set('active', $active_path);
    }

    private function changeTags($tags)
    {
        $tids = array();
        foreach((array)$tags as $tag){
            $tag = intval($tag);
            if($tag > 0 && !isset($tids[$tag])){
                $tids[$tag] = '';
            }
        }
        return array_keys($tids);
    }

}
