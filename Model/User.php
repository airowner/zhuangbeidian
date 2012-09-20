<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property Group $Group
 */
class User extends AppModel {


    public $name = 'User';
    public $actsAs = array('Acl' => array('type' => 'requester'));

    public function beforeSave($options=array())
    {
        $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        return true;
    }
    
    /**
     * In case we want simplified per-group only permissions, we need to implement bindNode() in User model.
     * This method will tell ACL to skip checking User Aro’s and to check only Group Aro’s.
     */
     /*
    public function bindNode($user) {
        return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
    }
    */
    
    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if(!$groupId){
            return null;
        }else{
            return array('Group'=>array('id'=>$groupId));
        }
    }
/**    
* After save callback
*
* Update the aro for the user.
*
* @access public
* @return void
*/
    function afterSave($created) {
            if (!$created) {
                $parent = $this->parentNode();
                $parent = $this->node($parent);
                $node = $this->node();
                $aro = $node[0];
                $aro['Aro']['parent_id'] = $parent[0]['Aro']['id'];
                $this->Aro->save($aro);
            }
    }
/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'username' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
                'allowEmpty' => false,
                'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'password' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
                'allowEmpty' => false,
                'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'group_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                'allowEmpty' => false,
                'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
    public $belongsTo = array(
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'group_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
