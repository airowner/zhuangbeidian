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
        $this->game = $this->Tag->getGames();
        $this->cates = $this->Tag->getTreeCategory();
        $this->set('game', $this->game);
        $this->set('cates', $this->cates);
    }
    
    function beforeFilter() 
    {
        parent::beforeFilter(); 
        $this->Auth->allowedActions = array('*');
        $this->set('baseurl', '/');
    }

    public function index()
    {
        $_ads = $this->Ad->find('all', array(
            'condition' => array('id' => ' < 5'),
        ));
        $ads = array();
        foreach($_ads as $ad){
            $tmp = $ad['Ad'];
            $ads[$tmp['id']] = $tmp;
        }
        $this->set('ads', $ads);
    }

    public function tag()
    {
        $this->set('baseurl', '/');
        $_ads = $this->Ad->find('all', array(
            'condition' => array('id' => ' < 5'),
        ));
        $ads = array();
        foreach($_ads as $ad){
            $tmp = $ad['Ad'];
            $ads[$tmp['id']] = $tmp;
        }
        $this->set('ads', $ads);
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
        $rootTag = $this->Tag->getRoot();
        $root = array();
        foreach($rootTag as $r){
            $root[$r['tag']] = $r['id'];
            $cate_ids[$r['id']] = array();
        }
        $this->set('root', $root);

        //path
        $path = $this->Tag->getPath($tags);
        $this->set('path', $path);
        $this->set('cur_tags', array_keys($path));


        //商品分类
        $pids = array_keys($this->cates);
        $product = array();
        $product_active = '';
        if(!$product_active){
            foreach($path as $p){
                $p_id = $p[0]['id'];
                if(isset($this->cates[$p_id])){
                    break;
                }
            }
            $product_active = $p[count($p)-1]['id'];
            if(count($p)>1){
                //进入子类
                $product = $this->cates[$p_id]['child'];
            }else{
                //显示父类
                foreach($this->cates as $cate){
                    $product[] = $cate['data'];
                }
            }
        }
        $this->set('product', $product);
        $this->set('product_active', $product_active);

        //游戏分类
        $game_active = '';
        foreach($this->game as $p){
            if(isset($path[$p['id']])){
                $game_active = $p['id'];
                break;
            }
        }
        $this->set('game_active', $game_active);

        //价格分类
        $price = $this->Tag->getPrice();
        $price_active = '';
        foreach($price as $p){
            if(isset($path[$p['id']])){
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

    private function getGenericClass($tagids)
    {
        $result = array();
        $pids = array();
        $tmp = array();

        $rootid = array();
        $root = $this->Tag->getRoot();
        foreach($root as $rt){
            $rootid[$rt['id']] = $rt['id'];
        }

        $parents = $this->Tag->getParents($tagids);
        foreach($parents as $id => $parent){
            $result[$id] = array($parent);
            if($parent['pid'] && !isset($rootid[$parent['pid']])){
                $pids[] = $parent['pid'];
                $tmp[$parent['pid']] = $id;
            }
        }
        if($pids){
            $parents = $this->Tag->getParents($pids);
            foreach($parents as $id => $parent){
                $oid = $tmp[$id];
                array_unshift($result[$oid], $parent);
            }
        }
        return $result;
    }

}
