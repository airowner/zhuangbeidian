<?php

App::uses('AppModel', 'Model');

class TagItem extends AppModel
{
    public $name = 'item_tag';
    public $useTable = 'item_tag';

    public $belongsTo = array(
        'Tag', 'Item'
    );
}
