<?php

App::uses('AppModel', 'Model');

class Tag extends AppModel
{
    public $name = 'tag';
    public $useTable = 'tag';

    public $actsAs = array('Tree');
    //public $hasAndBelongsToMany = array(
    //    'Item' => array(
    //    ),
    //);
    //
    public function getTree()
    {
		//$this->unbindModel(array('hasAndBelongsToMany' => array('Item')));
		static $tree = null;
		if($tree !== null) return $tree;
		
		$this->cateId2Tag = array();
		$this->cateTag2Id = array();
		
        $result = Hash::extract($this->children(null), '{n}.Tag');
        $tree = array();
        $path = array();
        foreach($result as $r){
            $path[$r['id']] = $r['parent_id'];
			$this->cateId2Tag[$r['id']] = $r['tag'];
			$this->cateTag2Id[$r['tag']] = $r['id'];
            $tmp_parent_id = $r['parent_id'];
            $tmp_path = array();
            while($tmp_parent_id !== null){
                $tmp_path[] = $tmp_parent_id;
                $tmp_parent_id = $path[$tmp_parent_id];
            }
            $tmp_path = array_reverse($tmp_path);
            $obj = &$tree;
            foreach($tmp_path as $t){
                if(isset($obj['children'][$t])){
                    $obj = &$obj['children'][$t];
                }
            }
            if(!isset($obj['children'])){
                $obj['children'] = array();
            }
            $obj['children'][$r['id']] = $r;
        }
		$tree = $tree['children'];
		return $tree;
    }

/*
 * ROOT分类
 */
    public function getTop()
    {
		static $top = null;
		if($top !== null) return $top;
		$tree = $this->getTree();
		$top = array();
		foreach($tree as $t){
			$top[$t['tag']] = $t['id'];
		}
        return $top;
    }
    
/*
根据给定父tag,获取子tag内容
*/
    public function getCategories($parent_Tags, $onlyValid=true, $onlyDisplay=true)
    {
		$parent_Tags = (array)$parent_Tags;
        $tree = $this->getTree();

		$parent_tagid = array();
		foreach($parent_Tags as $key => $pt){
			if(!is_numeric($pt)){
				if(isset($this->cateTag2Id[$pt])){
					$pt = $this->cateTag2Id[$pt];
				}
			}
			$parent_tagid[$pt] = array();
		}
		
		self::findTree($parent_tagid, $tree, $onlyValid, $onlyDisplay);
		
		//order by order desc
		foreach($parent_tagid as $key => $value){
			usort($value, array('Tag', '_sortTree'));
			$parent_tagid[$key] = $value;
		}
		return $parent_tagid;
    }

	public function getCategory($parent_Tag, $onlyValid=true, $onlyDisplay=true)
	{
		$parent_tagid = $this->getCategories($parent_Tag, $onlyValid, $onlyDisplay);
		if(!is_numeric($parent_Tag)){
			$parent_Tag = $this->cateTag2Id[$parent_Tag];
		}
		if($parent_Tag){
			return $parent_tagid[$parent_Tag];
		}
	}

	private static function _sortTree($a, $b)
	{
		return $a['order'] > $b['order'];
	}

	private static function findTree(&$parent_tagid, $tree, $onlyValid, $onlyDisplay){
		foreach($tree as $t){
			if(isset($parent_tagid[$t['parent_id']])){
				if($onlyValid && !$t['validate']) continue;
				if($onlyDisplay && !$t['display_html']) continue;
				$parent_tagid[$t['parent_id']][] = $t;
			}elseif(isset($t['children'])){
				self::findTree($parent_tagid, $t['children'], $onlyValid, $onlyDisplay);
			}
		}
	}
    
    public function getCateTag($key)
    {
        $this->getTree();      
        if(is_numeric($key)){
            return isset($this->cateId2Tag[$key]) ? $this->cateId2Tag[$key] : false;
        }else{
            return isset($this->cateTag2Id[$key]) ? $this->cateTag2Id[$key] : false;
        }
    }

    //获取传入tag的路径
    public function get_Path($ids)
    {
		$ids = (array)$ids;
        $path = array();
        $tmp = array();
		foreach($ids as $id){
			$path[$id] = Hash::extract($this->getPath($id), '{n}.Tag');
		}
        return $path;
    }
}
