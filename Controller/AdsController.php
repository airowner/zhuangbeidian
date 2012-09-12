<?php
App::uses('AppController', 'Controller');
/**
 * Ads Controller
 *
 * @property Ad $Ad
 */
class AdsController extends AppController {
    
    public $layout = 'default';
    
    private $uploadsDir = 'files';

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
    
    private function upload($data) {
        
        $filename = md5_file($data['tmp_name']);
        $dir1 = substr($filename, -2, -1);
        $dir2 = substr($filename, -1);
        
        $path = $this->uploadsDir . DS . $dir1 . DS . $dir2;
        if(!file_exists(WWW_ROOT . $path)){
            mkdir(WWW_ROOT . $path, 0777, true);
        }
        
        $tmp = explode('.', $data['name']);
        if (count($tmp) > 0) {
            $ext = array_pop($tmp);
        }else{
            switch($uploadfile['type']){
                case 'image/jpeg':
                case 'image/jpg':
                    $ext = 'jpg';
                    break;
                case 'image/gif';
                    $ext = 'gif';
                    break;
                default:
                    $ext = 'unknown';
            }
        }
        $newfilename = $path . DS . $filename . '.' . $ext;
        $move = move_uploaded_file($data['tmp_name'], $newfilename);
        if($move){
            return $newfilename;
        }else{
            return false;
        }

    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $filename = $this->upload($this->request->data['Ad']['img']);
            if(!$filename){
                $this->Session->setFlash(__('The ad could not be saved. Please, try again.'));
                die();
            }
            $this->request->data['Ad']['img'] = $filename;
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
            if (is_uploaded_file($this->request->data['Ad']['img']['tmp_name'])){
                $filename = $this->upload($this->request->data['Ad']['img']);
                if(!$filename){
                    $this->Session->setFlash(__('The ad could not be saved. Please, try again.'));
                    die();
                }
                $this->request->data['Ad']['img'] = $filename;
            }else{
                $olddata = $this->Ad->read(null, $id);
                $this->request->data['Ad']['img'] = $olddata['Ad']['img'];
            }
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
