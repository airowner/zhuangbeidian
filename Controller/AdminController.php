<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class AdminController extends AppController {

    public $uses = false;
    public $layout = 'default';

    function beforeFilter() 
    {
        parent::beforeFilter(); 
        $this->Auth->allowedAction = array('*');
    }
    
    public function index(){
        
    }

    public function top() {
        $user = $this->Auth->user();
        $this->set('user', $user);
        $controllers = array('/ads', '/groups', '/users', '/items');
        $this->set('controllers', $controllers);
    }
    
    public function bottom(){
        
    }
}
