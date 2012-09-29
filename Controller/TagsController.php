<?php
App::uses('AppController', 'Controller');
/**
 * Tags Controller
 *
 * @property Tag $Tag
 */
class TagsController extends AppController {

    public $layout = 'default';

    public function beforeFilter() 
    {
        parent::beforeFilter(); 
		//$this->Auth->allow('*');
        $result = Hash::extract($this->Tag->children(null), '{n}.Tag');
        $tree = array();
        foreach($result as $r){
            if($r['parent_id'] === null){
                $tree[$r['id']] = array('tag'=>$r['tag']);
            }else{
            }
        }
        var_dump($this->Tag->generateTreeList(null, '{n}.Tag.id', '{n}.Tag.tag', '', 2));exit;
    }
/**
 * index method
 *
 * @return void
 */
	public function index( $parent_id=1 ) {
		$this->Tag->recursive = 0;
        $this->set('tags', $this->paginate(
           array(
                'parent_id' => $parent_id,
            )
        ));
        $top = $this->Tag->find('all', array(
            'conditions'=>array(
                'parent_id' => 0,
            ),
            'order' => 'id asc',
        ));
        $top = Hash::extract($top, '{n}.Tag');
        $this->set('top', $top);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Tag->id = $id;
		if (!$this->Tag->exists()) {
			throw new NotFoundException(__('Invalid tag'));
		}
		$this->set('tag', $this->Tag->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Tag->create();
			if ($this->Tag->save($this->request->data)) {
				$this->Session->setFlash(__('The tag has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tag could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Tag->id = $id;
		if (!$this->Tag->exists()) {
			throw new NotFoundException(__('Invalid tag'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Tag->save($this->request->data)) {
				$this->Session->setFlash(__('The tag has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tag could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Tag->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Tag->id = $id;
		if (!$this->Tag->exists()) {
			throw new NotFoundException(__('Invalid tag'));
		}
		if ($this->Tag->delete()) {
			$this->Session->setFlash(__('Tag deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tag was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
