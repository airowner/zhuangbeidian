<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
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
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper {
    /*
     * path = array(
     *  array(0=>array('id'=>'xx', tag=>'xx', 'pid'=>'xx'), 1=>array('id'=>'xx', tag=>'xx', 'pid'=>'xx')),
     *  array(0=>array('id'=>'xx', tag=>'xx', 'pid'=>'xx')),
     *  ...
     * );
     *
     */
    public function createLink($path, $key='', $tag_value=null)
    {
        if($key===''&&$tag_value===null) return '';
        $key = intval($key);
        $tag_value = intval($tag_value);

        $tags = array();
        $append = false;
        if(!$key) $append = true;

        foreach($path as $k => $p){
            if($k === $key){
                if(!$tag_value){ //全部
                    if(count($p)>1){
                        //移动到父tag
                        $tags[] = $p[count($p)-2]['id'];
                    }else{
                        //取消此tag
                    }
                }else{
                    $tags[] = intval($tag_value);
                }
            }else{
                $tags[] = $p[count($p)-1]['id'];
            }
        }

        if($append){
            $tags[] = $tag_value;
        }
        sort($tags);

        return "/tag/" . implode('_', $tags);
    }
}
