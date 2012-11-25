<?php
App::uses('AppController', 'Controller');
/**
 * Items Controller
 *
 * @property Item $Item
 */
class TagItemController extends AppController {

    public $layout = 'default';

    public $uses = array('TagItem', 'Item', 'Tag', 'ItemRecommend');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('*');
    }

    public function index()
    {
		$tags = array();
		$this->paginate = array(
			'fields' => array(
				'Item.*',
				'item_id',
				'group_concat(distinct `TagItem`.`tag_id` order by `TagItem`.`tag_id` asc) as tag_ids',
			),
			'limit' => 20,
			'order' => array('item_id' => 'asc'),
			'group' => array('item_id'),
			'contain' => array('Item'),
		);
		$tagitems = $this->paginate();
		//var_dump($tagitems);exit;

		foreach($tagitems as &$ti){
			$ti['Item']['tags'] = explode(',', $ti[0]['tag_ids']);
			$tags = array_merge($tags, $ti['Item']['tags']);
			unset($ti[0]);
			$ti['Item']['item_id'] = $ti['TagItem']['item_id'];
			unset($ti['TagItem']);
		}
		
		$tags = $this->Tag->findAllById($tags, array('id', 'tag'));
		$t = array();
		foreach($tags as $tag){
			$t[$tag['Tag']['id']] = $tag['Tag']['tag'];
		}
		$this->set('tags', $t);

        $this->set('tagitems', Hash::extract($tagitems, '{n}.Item'));
    }

    private function categories()
    {
		$tree = $this->Tag->getTree();
        $this->set(compact('tree'));
    }

    public function add( $item_id = null ) 
	{
        if(!$item_id){
			throw new NotFoundException(__('Invalid item'));
        }
		if($this->request->is('post') || $this->request->is('put')){
			$obj = $this->request->data['TagItem'];
			foreach($obj['game'] as $k => $value){
				if($value == 'all'){
					unset($obj['game'][$k]);
				}
			}
			$tags = array_values($obj['game']);
			$tags[] = $obj['price'];

			//分类
			if(!$obj['product']){
				throw new Exception('商品选项未进行选择');
			}
			$path = Hash::extract($this->Tag->getPath($obj['product']), '{n}.Tag');
			foreach($path as $p){
				if($p['tag'] == '#product') continue;
				$tags[] = $p['id'];
			}

			//用户选择
			if(isset($obj['user'])){
				$user = $obj['user'];
				if($user){
					$tags = array_merge($tags, $user);
				}
			}
			
			//用户自定义
			$user_defined = trim($this->request->data['TagItem']['user_defined']);
			if($user_defined != ''){
				$user_defined = explode(',', $user_defined);
				foreach($user_defined as $key => $value){
					$value = trim($value);
					if(!$value){
						unset($user_defined[$key]);
					}else{
						$user_defined[$key] = $value;
					}
				}
				$user_parent = Hash::extract($this->Tag->findByTag('#user'), 'Tag');
				$result = $this->Tag->findAllByTag($user_defined);
				$result_tag = Hash::extract($result, '{n}.Tag.tag');
				$result_id = Hash::extract($result, '{n}.Tag.id');
				$tags = array_merge($tags, $result_id);
				
				$user_defined = array_diff($user_defined, $result_tag);
				//var_dump($user_defined);
				$tag = array();
				foreach($user_defined as $t){
					$tag[] = array('tag'=>$t, 'parent_id'=>$user_parent['id']);
				}
				//var_dump($tag);exit;
				if($tag){
					if($this->Tag->saveMany($tag)){
						$newids = Hash::extract($this->Tag->findAllByTag($user_defined), '{n}.Tag.id');
						$tags = array_merge($tags, $newids);
					}else{
						throw new NotFoundException(__('The user tag has not been saved'));
					}
				}
			}
			//用户自定义结束
			$tags = array_unique($tags);
			
			$data = array();
			foreach($tags as $tag){
				$data[] = array('tag_id'=>$tag, 'item_id'=>$item_id);
			}
			$this->TagItem->deleteAll(array('item_id'=>$item_id), false);
			$this->Item->read(null, $item_id);
			$this->Item->set('name', $this->request->data['name']);
			$this->Item->save();
			if($this->TagItem->saveMany($data)){		
				/*
				首页推荐暂时添加到这里,　在设置tag时直接添加,　默认按添加时间排列
				*/
				$this->ItemRecommend->create();
				$this->ItemRecommend->save(array('ItemRecommend' => array('modify_time'=>date('Y-m-d H:i:s'), 'item_id'=>$item_id)));
			}
				
			$this->Session->setFlash(__('The tag has been saved'));
			$this->redirect(array('action' => 'index'));
		}
		
		$this->Item->id = $item_id;
        $item = Hash::extract($this->Item->read(), 'Item');

        $cates = $this->categories();

        $this->set(compact('item', 'cates'));
    }

	public function view($item_id = null) 
	{
		$this->categories();
		$this->Item->id = $item_id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		$item = $this->Item->read(null, $item_id);
		$tag_ids = Hash::extract($this->TagItem->find('all', array(
			'conditions' => array(
				'item_id' => $item_id,
			),
			'contain'=>false,
		)), '{n}.TagItem.tag_id');
		$tags = $this->Tag->findAllById($tag_ids);
		$newtags = array();
		foreach($tags as $t){
			$t = $t['Tag'];
			$newtags[$t['id']] = $t;
		}
		$tags = $newtags;
		//var_dump($tags);exit;
		$this->set(compact('item', 'tags'));
	}

	public function edit($item_id = null) 
	{
		$this->add($item_id);
		$tagids = $this->TagItem->findAllByItemId($item_id, array('contain'=>false));
		$tagids = Hash::extract($tagids, '{n}.TagItem.tag_id');
		if($tagids){
			$tagids = array_combine($tagids, $tagids);
		}
		$this->set('tagids', $tagids);
	}

	public function delete($item_id = null) 
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		if ($this->TagItem->deleteAll(array('item_id'=>$item_id), false)) {
			$this->Session->setFlash(__('商品标签关联已删除!'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('商品标签关联删除失败!'));
		$this->redirect(array('action' => 'index'));
	}
}
