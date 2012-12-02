<?php

App::uses('AppModel', 'Model');

class Tag extends AppModel
{
    public $name = 'tag';
    public $useTable = 'tag';

    public $actsAs = array('Tree');

    private $cateTag2Id = array();
    private $cateId2Tag = array();
    private $id2pid = array();

    public function getTree()
    {
    	static $tree = null;
    	if($tree !== null ) return $tree;
		
        $result = Hash::extract($this->children(null), '{n}.Tag');
        $tree = array();
        foreach($result as $r){
            if($r['parent_id'] === null) {
            	$r['parent_id'] = 0;
            }
        	if(!isset($tree[$r['parent_id']])){
            	$tree[$r['parent_id']] = array();
            }
            $tree[$r['parent_id']][$r['id']] = $r;
            $this->id2pid[$r['id']] = $r['parent_id'];
			$this->cateId2Tag[$r['id']] = $r['tag'];
			$this->cateTag2Id[$r['tag']] = $r['id'];
		}
		foreach($tree as $pid => $t){
			$tree[$pid] = $t;
		}
        // var_dump($tree);exit;
		return $tree;
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
				}else{
					continue;
				}
			}
			$parent_tagid[$pt] = array();
		}
		foreach($parent_tagid as $pid => $value){
			if(isset($tree[$pid])){
				$parent_tagid[$pid] = $tree[$pid];
			}
		}
		return $parent_tagid;
    }

	public function getCategory($parent_Tag, $onlyValid=true, $onlyDisplay=true)
	{
		$parent_tagid = $this->getCategories($parent_Tag, $onlyValid, $onlyDisplay);
		if(count($parent_tagid)){
			$r = array_values($parent_tagid);
			return $r[0];	
		}else{
			return array();
		}
	}

	private static function _sortTree($a, $b)
	{
		return $a['order'] > $b['order'];
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

    //获取传入tag的路径 返回为 array
    public function get_Path($ids)
    {
        $tree = $this->getTree();
		$ids = (array)$ids;
        foreach($ids as $k => $id){
            if(!is_numeric($id)){
                if(isset($this->cateTag2Id[$id])){
                    $ids[$k] = $this->cateTag2Id[$id];
                }else{
                    unset($ids[$k]);
                }
            }
        }
        $path = array();
		foreach($ids as $id){
			$path[$id] = $this->_getPath($id, $tree);
		}
        return $path;
    }

    private function _getPath($id, $tree)
    {
        $path_pid = array($id);
        while($pid = $this->id2pid[$id]){
            $path_pid[] = $pid;
            $id = $pid;
        }
        $path_pid = array_reverse($path_pid);
        $path = array();
        $_tree = $tree[0];
        foreach($path_pid as $pid){
            $path[$pid] = $_tree[$pid];
            if(isset($tree[$pid])){
                $_tree = $tree[$pid];
            }else{
                break;
            }
        }
        return $path;
    }
}
