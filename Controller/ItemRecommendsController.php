<?php
App::uses('AppController', 'Controller');
/**
 * ItemRecommends Controller
 *
 * @property ItemRecommend $ItemRecommend
 */
class ItemRecommendsController extends AppController {

	public $layout = 'default';
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('*');
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ItemRecommend->recursive = 0;
		$this->set('itemRecommends', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ItemRecommend->id = $id;
		if (!$this->ItemRecommend->exists()) {
			throw new NotFoundException(__('Invalid item recommend'));
		}
		$this->set('itemRecommend', $this->ItemRecommend->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ItemRecommend->create();
			if ($this->ItemRecommend->save($this->request->data)) {
				$this->Session->setFlash(__('The item recommend has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item recommend could not be saved. Please, try again.'));
			}
		}
		$items = $this->ItemRecommend->Item->find('list');
		$this->set(compact('items'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ItemRecommend->id = $id;
		if (!$this->ItemRecommend->exists()) {
			throw new NotFoundException(__('Invalid item recommend'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ItemRecommend->save($this->request->data)) {
				$this->Session->setFlash(__('The item recommend has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item recommend could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ItemRecommend->read(null, $id);
		}
		$items = $this->ItemRecommend->Item->find('list');
		$this->set(compact('items'));
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
		$this->ItemRecommend->id = $id;
		if (!$this->ItemRecommend->exists()) {
			throw new NotFoundException(__('Invalid item recommend'));
		}
		if ($this->ItemRecommend->delete()) {
			$this->Session->setFlash(__('Item recommend deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Item recommend was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
