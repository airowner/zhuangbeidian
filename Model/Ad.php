<?php
App::uses('AppModel', 'Model');
/**
 * ad Model
 *
 */
class Ad extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
    public $useTable = 'ad';

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'type' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
    );
}
