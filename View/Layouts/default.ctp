<?php
/**
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
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', '管理后台');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $title_for_layout; ?>
    </title>
    <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('cake.generic');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
    <script type="text/javascript" src="/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/js/jquery/jquery.cookie.js"></script>
    <script type="text/javascript" src="http://a.tbcdn.cn/apps/top/x/sdk.js"></script>
    <script type="text/javascript" src="/js/taobao.js"></script>
</head>
<body>
    <div id="container">
        <div id="header">
            <h1><?php echo $cakeDescription; ?></h1>
        </div>
        <div id="content">

            <?php echo $this->Session->flash(); ?>
			<?php if(!($this->request->params['controller']=='users' && $this->request->params['action']=='login')): ?>
			<div class="actions">
				<ul>
					<li><a href="/spider/request">抓取商品</a> </li>
					<li><a href="/tags">标签管理</a> </li>
					<li><a href="/tagitem">商品标签关联</a> </li>
					<li><a href="/ads">广告管理</a> </li>
					<li><a href="/itemrecommend">商品推荐管理</a> </li>
					<li><a href="#">店铺推荐管理</a> </li>
					<li><a href="/users">用户管理</a> </li>
				</ul>
			</div>
			<?php endif; ?>
            <?php echo $this->fetch('content'); ?>
        </div>
        <div id="footer">
            <?php echo $this->Html->link(
                    $this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
                    'http://www.cakephp.org/',
                    array('target' => '_blank', 'escape' => false)
                );
            ?>
        </div>
    </div>
    <?php echo $this->element('sql_dump'); ?>
<script>
TOP.init({
    appkey: 21181372,
    channelUrl: '/channel.html'
});
</script>
</body>
</html>
