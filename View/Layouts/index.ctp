<?php
    $home = '装备店';
    $home_url = '/';
    $power = '装备店';
?>
<!DOCTYPE>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $title_for_layout; ?>-<?php echo $home ?>
    </title>
    <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('layout');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
</head>
<body>
  <div class="wrap">
    <div class="header clearfix">
      <div class="logo" title="<?php echo $this->Html->link($home, $home_url); ?></div>
      <div class="search">
        <form action="">
        <div class="sInput">
          <b class="icons rc lt"></b>
          <b class="icons rc rt"></b>
          <b class="icons rc lb"></b>
          <b class="icons rc rb"></b>
          <input class="txt" type="text"/>
          <input class="btn" type="submit" value="搜 索"/>
        </div>
        </form>
        <div class="sLabel">
          热门搜索：<a title="" href="">香水</a><a title="" href="">数码相机</a><a title="" href="">led电视</a><a title="" href="">香水</a><a title="" href="">数码相机</a><a title="" href="">led电视</a>
        </div>
      </div>
    </div>
    <div class="nav">
      <div class="inner1_nav">
        <div class="inner2_nav">
          <div class="more">
            <a class="moreBtn" href="">
              <b class="icons"></b>
              更多
            </a>
          </div>
          <ul class="main">
            
          <li<?php if(!isset($active['#game'])):?> class="cur"<?php endif; ?>><a href="/"><span><em>首页</em></span></a></li>
            <?php $i=0;
            foreach($game as $g){ 
                if($i==5)break;
            ?>
            <li<?php if(isset($active['#game']) && $active['#game'] == $g['id']):?> class="cur"<?php endif; ?>><a href="/game/<?php echo $g['id']?>"><span><em><?php echo ($g['tag']); ?></em></span></a></li>
            <?php $i++; } ?>
          </ul>
          <div class="clear"></div>
        </div>
      </div>
    </div>

    <?php echo $this->fetch('content'); ?>

    <div class="footer">
      <div class="helpInfo clearfix">
        <dl class="sign">
          <dt>品牌正品 商城保障</dt>
          <dd>
            本站是淘宝网特约合作导购站点<br/>本站所有商品均与淘宝同时发布<br/>交易均在淘宝进行，请放心使用
          </dd>
        </dl>
        <div class="list">
          <div class="section rookie">
            <b class="icons"></b>
            <div class="inner_section">
                <div class="tit">
                  新手上路
                </div>
                <ul class="con">
                  <li><a href="">免费注册</a></li>
                  <li><a href="">开通支付宝</a></li>
                  <li><a href="">支付宝充值</a></li>
                  <li><a href="">如何购买</a></li>
                </ul>
            </div>
          </div>
          <div class="section pay">
            <b class="icons"></b>
            <div class="inner_section">
                <div class="tit">
                  支付方式
                </div>
                <ul class="con">
                  <li><a href="">快捷支付</a></li>
                  <li><a href="">余额支付</a></li>
                  <li><a href="">货到付款</a></li>
                  <li><a href="">网上银行支付</a></li>
                </ul>
            </div>
          </div>
          <div class="section service">
            <b class="icons"></b>
            <div class="inner_section">
                <div class="tit">
                  售后服务
                </div>
                <ul class="con">
                  <li><a href="">交易维权</a></li>
                  <li><a href="">投诉卖家流程</a></li>
                  <li><a href="">举报卖家流程</a></li>
                  <li><a href="">淘宝网客服电话</a></li>
                </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="copyInfo">
      Copyright&nbsp;&copy;&nbsp; <?php echo $power; ?> &nbsp;All Rights Reserved.
      </div>
    </div>
  </div>
    <?php echo $this->element('sql_dump'); ?>
</body>
</html>
