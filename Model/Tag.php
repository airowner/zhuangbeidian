<?php

App::uses('AppModel', 'Model');

class Tag extends AppModel
{
    public $name = 'tag';
    public $useTable = 'tag';
    
    public $display = true;
    public $validate = true;
    
    public $top = array();
    public $cateId2Tag = array();
    public $cateTag2Id = array();

    public $hasAndBelongsToMany = array(
        'Item' => array(
        ),
    );
    
    private function addOption(&$options)
    {
        if($this->display){
            $options['condition']['display'] = $this->display;
        }
        if($this->validate){
            $options['condition']['validate'] = $this->validate;
        }
    }
/*
 * ROOT分类
 */
    public function getTop()
    {
        if($this->top) return $this->top;
    
        $this->unbindModel(array('hasAndBelongsToMany' => array('Item')));
        $data = $this->find('all', array(
            'conditions' => array('parent_id'=>'0'),
            'fields' => 'id, tag',
        ));
        $data = Hash::extract($data, '{n}.Tag');
        $top = array();
        foreach($data as $d){
            $top[$d['tag']] = $d['id'];
        }
        $this->top = $top;
        return $this->top;
    }
    
    public function getCategory($parent_Tags, $getItem=false)
    {
        $this->getTop();
        $parent_Tags = (array)$parent_Tags;
        foreach($parent_Tags as $key => $tag){
            $parent_Tags[$key] = isset($this->top[$tag]) ? $this->top[$tag] : $tag;
        }
        if(count($parent_Tags)==1){
            $parent_Tags = $parent_Tags[0];
        }
        $options = array(
            'conditions' => array(
                'parent_id' => $parent_Tags,
            ),
            'order' => "order desc",
        );
        $this->addOption($options);
        if(!$getItem){
            $this->unbindModel(array('hasAndBelongsToMany' => array('Item')));
        }else{
            $options += array(
                //
            );
        }
        $data = $this->find('all', $options);
        $data = Set::extract($data, '{n}.Tag');
        return $data;
    }
    
    public function getCateTag($key)
    {
        $this->getCate();
        
        if(is_numeric($key)){
            return isset($this->cateId2Tag[$key]) ? $this->cateId2Tag[$key] : false;
        }else{
            return isset($this->cateTag2Id[$key]) ? $this->cateTag2Id[$key] : false;
        }
    }
    
    public function getCate()
    {
        static $cate = array();
        if($cate){
            return $cate;
        }
        $product = $this->getCategory('#product');
        foreach($product as $k => $c){
            $product[$k]['children'] = array();
            $cate[$c['id']] = $product[$k];
            $this->cateId2Tag[$c['id']] = $c['tag'];
            $this->cateTag2Id[$c['tag']] = $c['id'];
        }
        $parent_ids = array_keys($this->cateId2Tag);
        $subcate = $this->getCategory($parent_ids);
        foreach($subcate as $s){
            $cate[$s['parent_id']]['children'][] = $s;
            $this->cateId2Tag[$s['id']] = $s['tag'];
            $this->cateTag2Id[$s['tag']] = $s['id'];
        }
        return $cate;
    }

    public function getTagByTagName($tag)
    {
        $this->unbindModel(array('hasAndBelongsToMany' => array('Item')));
        $options = array('conditions'=>array('tag'=>$tag), 'fields'=>'id, tag, parent_id');
        $this->addOption($options);
        $g_tag = $this->find('first', $options);
        return Set::extract($g_tag, '{n}.Tag');
    }

    /*
     * 获取多个父tag
     */
    public function getParents($tag_ids)
    {
        $tag_ids = (array)$tag_ids;
        $this->unbindModel(array('hasAndBelongsToMany' => array('Item')));
        $options = array('conditions'=>array('id'=>$tag_ids), 'fields'=>'id, tag, parent_id');
        $this->addOption($options);
        $g_tag = $this->find('all', $options);
        $g_tag = Set::extract($g_tag, '{n}.Tag');
        $return = array();
        foreach($g_tag as $g){
            $return[$g['id']] = $g;
        }
        return $return;
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

        $parent_ids = array();
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
            if($p['parent_id']){
                $parent_ids[] = $p['parent_id'];
                $tmp[$p['parent_id']] = $oid;
            }
        }

        return $this->_getPath($parent_ids, $path, $tmp);
    }
}
