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
        $this->set('ads', Hash::extract($_ads, '{n}.Ad'));
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

    private function _tag($tags)
    {
        //总tag标记
        $top = $this->Tag->getTop();
        //$this->set('root', $this->top);

        //path
        $path = $this->Tag->getPath($tags);
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
                        if(isset($_styles['children'])){
                            $_styles = $_styles['children'];
                        }else{
                            $_styles = array();
                        }
                        break;
                    }
                    
                }
            }
            $return_path[$tag] = array(
                'active' => $k,
                'content' => $_back,
            );
        }
        foreach(array('#game', '#price', '#product') as $t){
            if(isset($return_path[$t])){
                continue;
            }
            $return_path[$t] = array(
                'active' => null,
                'content' => $this->Tag->getCategory($t),
            );
        }
        $this->set('path', $return_path);
        $this->set('cur_tags', array_keys($path));

        //商品分类
        $cate = $this->cates;
        $product_active = '';
        $product = $cate;
        
        foreach($path as $k => $p){
            if($this->Tag->getCateTag($k)){
                $product_active = $p[count($p)-1]['id'];
                $path = $p;
                break;
            }
        }
        array_shift($path);//去掉 root 分类 #product
        foreach($path as $p){
            $p_id = $p['id'];
            foreach($cate as $c){
                if($c['id'] == $p_id){
                    $product = $cate;
                    $cate = isset($c['children']) ? $c['children'] : array();
                    break;
                }
            }
        }
        $this->set('product', $product);
        $this->set('product_active', $product_active);

        //游戏分类
        $game_active = '';
        foreach($path as $p){
            if(isset($this->game[$p['id']])){
                $game_active = $p['id'];
                break;
            }
        }
        $this->set('game_active', $game_active);

        //价格分类
        $_price = $this->Tag->getCategory('#price');
        $price = array();
        foreach($_price as $p){
            $price[$p['id']] = $p;
        }
        $price_active = '';
        foreach($path as $p){
            if(isset($price[$p['id']])){
                $price_active = $p['id'];
            }
        }
        $this->set('price', $price);
        $this->set('price_active', $price_active);
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
