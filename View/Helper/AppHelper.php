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
    
    public function ad($data, $options=array())
    {
        if(!$data) return '';
        $options += array(
            'baseurl' => '',
            'a_class' => '',
            'a_style' => '',
            'a_js' => '',
            'img_class' => '',
            'img_style' => '',
            'before' => '',
            'after' => '',
        );
        $data = array_merge($data, $options);

        $type = $data['type'];
        $ad = '';
        switch($type){
        case 'img':
            $ad = sprintf("<a href='%s' %s%s%s>%s<img src='%s'%s%s%s%s%s />%s</a>", $data['url'],
                ($data['a_class']?" class='{$data['a_class']}'":""), 
                ($data['a_style']?" style='{$data['a_style']}'":""), 
                $data['a_js'], $data['before'], $data['baseurl'].$data['img'],
                ($data['txt']?" alt='{$data['txt']}'":""),
                ($data['width']?" width='{$data['width']}'":""), 
                ($data['height']?" height='{$data['height']}'":""), 
                ($data['img_class']?" class='{$data['img_class']}'":""), 
                ($data['img_style']?" style='{$data['img_style']}'":""),
                $data['after']);
            break;
        case 'text':
            $ad = sprintf("<a href='%s' %s%s%s>%s%s%s</a>", $data['url'],
                ($data['a_class']?" class='{$data['a_class']}'":""), 
                ($data['a_style']?" style='{$data['a_style']}'":""), 
                $data['a_js'], $data['before'], $data['txt'], $data['after']);
            break;
        case 'javascript':
            $ad = "<script type='text/javascript'>{$data['other']}</script>";
            break;
        case 'flash':
            $ad = '';
            break;
        }
        return $ad;
    }
    
    public function item()
    {
        return '<span class="posterInfo">
            <b class="price">￥<em>95</em></b>
            <span class="opacity">
              <b class="name">潮流帆布包</b>
              <span class="sold"><em>已售</em>&nbsp;207</span>
            </span>
          </span>';
    }
}
