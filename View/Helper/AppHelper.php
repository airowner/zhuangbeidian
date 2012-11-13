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
     * cur_path = array(
     *  '#product' => array(0=>array('id'=>'xx', tag=>'xx', 'pid'=>'xx'), 1=>array('id'=>'xx', tag=>'xx', 'pid'=>'xx')),
     *  '#price' => array(0=>array('id'=>'xx', tag=>'xx', 'pid'=>'xx')),
     *  ...
     * );
     *
     */
    public $root_path;
    public function createLink($tag, array $path, array $active_path)
    {
        $param = array();
        $active = $active_path[$tag];
        //获取其他不变量
        foreach(array_keys($path) as $key){
            if($key == $tag) continue;
            if($active_path[$key]){
                $param[] = $active_path[$key];
            }
        }
        
        $html = array();   
        if($active){
            $html[] = "<a href=\"" . $this->getLink($param) . "\">全部</a>";
        }else{
            // 激活全部
            $html[] = "<a class=\"on\" href=\"" . $this->getLink($param) ."\">全部</a>";
        }
        foreach($path[$tag] as $p){
            if($p['id'] == $active){
                $html[] = "<a class=\"on\" href=\"" . $this->getLink($param, $p) ."\">{$p['tag']}</a>";
            }else{
                $html[] = "<a href=\"" . $this->getLink($param, $p) . "\">{$p['tag']}</a>";
            }
        }
        return implode('', $html);
    }
    
    private function getLink($params, $path=null)
    {
        if($path){
            $params[] = $path['id'];
        }
        sort($params);
        return "/tag/" . implode('_', $params);
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

    public function seller_heart($heart)
    {
    	switch($heart){
    		case '1':
    			return "s_red_1.gif";
    		case '2':
    			return "s_red_1.gif";
    		case '3':
    			return "s_red_1.gif";
    		case '4':
    			return "s_red_1.gif";
    		case '5':
    			return "s_red_1.gif";
    		case '6':
    			return "s_blue_1.gif";
    		case '7':
    			return "s_blue_2.gif";
    		case '8':
    			return "s_blue_3.gif";
    		case '9':
    			return "s_blue_4.gif";
    		case '10':
    			return "s_blue_5.gif";
    		case '11':
    			return "s_cap_1.gif";
    		case '12':
    			return "s_cap_2.gif";
    		case '13':
    			return "s_cap_3.gif";
    		case '14':
    			return "s_cap_4.gif";
    		case '15':
    			return "s_cap_5.gif";
    		case '16':
    			return "s_crown_1.gif";
    		case '17':
    			return "s_crown_2.gif";
    		case '18':
    			return "s_crown_3.gif";
    		case '19':
    			return "s_crown_4.gif";
    		case '20':
    			return "s_crown_5.gif";
    	}
    }
}
