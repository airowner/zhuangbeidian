<?php

App::uses('AppModel', 'Model');

class Tag extends AppModel
{
    public $name = 'tag';
    public $useTable = 'tag';

    public $hasMany = array(
        'TagItem' => array(
        ),
    );

    public function getRoot()
    {
        static $root = null;
        if($root === null){
            $root = $this->getTags(0, true);
        }
        return $root;
    }

    public function getGames()
    {
        return $this->getDetailCate('#game');
    }

    public function getCategory()
    {
        return $this->getDetailCate('#product');
    }

    public function getPrice()
    {
        return $this->getDetailCate('#price');
    }
    
    public function getOther()
    {
        return $this->getDetailCate('#user');
    }

    public function getDetailCate($rootTag)
    {
        $p = $this->getTagByTagName($rootTag, true);
        if(isset($p['id'])){
            return $this->getTags($p['id']);
        }
        return array();
    }

    public function getTags($pid, $root=false)
    {
        $result = array();
        $this->unbindModel(array('hasMany' => array('TagItem')));
        $ret = $this->findAllByPidAndValidateAndDisplay_html($pid, 1, ($root?0:1), "id, tag", array('order desc'));
        foreach($ret as $key => $value){
            $result[$key] = $value['Tag'];
        }
        return $result;
    }

    public function getTagByTagName($tag, $root=false)
    {
        $this->unbindModel(array('hasMany' => array('TagItem')));
        $g_tag = $this->findByTagAndValidateAndDisplay_html($tag, 1, ($root?0:1), 'id, tag, pid');
        return $g_tag['Tag'];
    }


    /*
     * 获取多个父tag
     */
    public function getParents($tags)
    {
        $tags = (array)$tags;

        $sql = "select id, tag, pid from {$this->useTable} where validate=1 and display_html=1";

        if(count($tags)>1){
            $sql .= " and id in (" . implode(",", $tags) . ")";
        }else{
            $sql .= " and id={$tags[0]}";
        }

        $cates = $this->query($sql); 

        $result = array();
        foreach($cates as $cate){
            $result[$cate[$this->useTable]['id']] = $cate[$this->useTable];
        }
        return $result;
    }

    public function getSubCategory($pids)
    {
        $pids = (array)$pids;

        $sql = "select * from {$this->useTable} where validate=1 and display_html=1";

        if(count($pids)>1){
            $sql .= " and pid in (" . implode(",", $pids) . ")";
        }else{
            $sql .= " and pid={$pids[0]}";
        }

        $sql .= " order by `order` desc";
        $subcates = $this->query($sql); 
        $result = array();
        foreach($subcates as $subcate){
            $pid = $subcate[$this->useTable]['pid'];
            if(!isset($result[$pid])){
                $result[$pid] = array();
            }
            $result[$pid][$subcate[$this->useTable]['id']] = $subcate[$this->useTable];
        }

        return $result;
    }

    //目前只支持两级
    public function getTreeCategory()
    {
        $result = array();
        $cates = $this->getCategory();
        $ids = array();
        foreach($cates as $cate){
            $ids[] = $cate['id'];
            $result[$cate['id']] = array(
                'data' => $cate,
                'child' => array(),
            );
        }
        $subcates = $this->getSubCategory($ids);
        foreach($subcates as $key => $subcate){
            $result[$key]['child'] = $subcate;
        }

        return $result;
    }

    //获取传入tag的路径
    public function getPath($ids)
    {
        $path = array();
        $tmp = array();
        $this->_getPath($ids, $path, $tmp);
        return $path;
    }

    private function _getPath($ids, &$path, &$tmp)
    {
        if(!$ids) return $path;

        $pids = array();
        $parent = $this->getParents($ids);
        foreach($parent as $id => $p){
            if(!isset($tmp[$id])){
                $oid = $id;
            }else{
                $oid = $tmp[$id];
            }
            if(!isset($path[$oid])){
                $path[$oid] = array();
            }
            array_unshift($path[$oid], $p);
            if($p['pid']){
                $pids[] = $p['pid'];
                $tmp[$p['pid']] = $oid;
            }
        }

        return $this->_getPath($pids, $path, $tmp);
    }
}
