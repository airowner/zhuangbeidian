<?php
App::uses('AppController', 'Controller');
/**
 * Ads Controller
 *
 * @property Ad $Ad
 */
class AdsController extends AppController {
    
    public $layout = 'default';

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->Ad->recursive = 0;
        $this->set('ads', $this->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        $this->Ad->id = $id;
        if (!$this->Ad->exists()) {
            throw new NotFoundException(__('Invalid ad'));
        }
        $this->set('ad', $this->Ad->read(null, $id));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->Ad->create();
            if ($this->Ad->save($this->request->data)) {
                $this->Session->setFlash(__('The ad has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The ad could not be saved. Please, try again.'));
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
        $this->Ad->id = $id;
        if (!$this->Ad->exists()) {
            throw new NotFoundException(__('Invalid ad'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Ad->save($this->request->data)) {
                $this->Session->setFlash(__('The ad has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The ad could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Ad->read(null, $id);
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
        $this->Ad->id = $id;
        if (!$this->Ad->exists()) {
            throw new NotFoundException(__('Invalid ad'));
        }
        if ($this->Ad->delete()) {
            $this->Session->setFlash(__('Ad deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Ad was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
