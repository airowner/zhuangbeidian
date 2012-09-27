<?php

ddd

require dirname(__FILE__) . '/Controller/Component/TaobaoComponent.php';
$taobao = new TaobaoComponent();

$reflect = new ReflectionClass($taobao);
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

