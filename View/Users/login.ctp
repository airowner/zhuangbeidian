<?php

$this->Session->flash('auth');
echo $this->Form->create('User');
echo $this->Form->inputs(array(
        'legend' => __('Login', true),
        'username',
        'password'
));
echo $this->Form->end('Login');
