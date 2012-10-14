<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
*/
class AppController extends Controller {

    public $ext = '.html';
    public $uses = true; //多model 为array('Post', 'Comment'...);
    public $modelClass = null;
    public $modelKey = null;
    public $layout = 'index';
    public $autoRender = true;
    public $autoLayout = true;
    
    public $components = array(
        'Session', 
        'Acl', 
        'Auth'=>array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers'),
            ),
        ),
    );
    public $helper = array('Session', 'Form', 'Html');
    
    function beforeFilter() {
        //Configure AuthComponent
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'home');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');

        $app_key = '21181372';/*填写appkey */
        $secret='c0eeef8223b85603ee92c400a7e41138';/*填入Appsecret'*/
        $timestamp=time()."000";
        $message = $secret.'app_key'.$app_key.'timestamp'.$timestamp.$secret;
        $mysign=strtoupper(hash_hmac("md5",$message,$secret));
        setcookie("timestamp",$timestamp, time() + 300, '/', 'zhuangbeidian.com');
        setcookie("sign",$mysign, time() + 300, '/', 'zhuangbeidian.com');
    }

}
