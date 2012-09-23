<?php

App::uses('AppController', 'Controller');

class TaobaoController extends AppController {
    
    public $layout = 'default';

    public $uses = false;

    public $components = array('Taobao');

    public function beforeFileter()
    {
        require dirname(__FILE__) . '/Component/TaobaoComponent.php';
        $this->Taobao = new Taobaocomponent();

        $reflect = new ReflectionClass($this->taobao);
        $re_methods = $reflect->getMethods();
        $methods = array();
        foreach($re_methods as $method){
            if($method->isPublic()){
                $methods[] = $method;
            }
        }

        $args = array();
        foreach($methods as $method){
            $m = $method->getName();
            $args[$m] = array();
            $reflect_params = $method->getParameters();
            foreach($reflect_params as $params){
                $args[$m][] = $params->getName();
            }
        }
        $this->args = $args;
    }

    public function __call($name, $params)
    {
        if ($this->request->is('post')) {
            $params = $this->request->data['param'];
            $result = call_user_func_ary(array($this->Taobao, $name), $params);
            echo "<pre>";
            var_export($result);
            echo "</pre>";
            die();
        }
        if(isset($this->args[$name])){
            $this->set('args', $this->args[$name]);
        }else{
            echo "undefined function\n";
            die();
        }
    }
