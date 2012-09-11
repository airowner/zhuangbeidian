<?php

App::uses('AppModel', 'Model');

class Item extends AppModel
{
    public $name = 'item';
    public $useTable = 'item';

    public $hasMany = array(
        'TagItem' => array(
        ),
    );
}
