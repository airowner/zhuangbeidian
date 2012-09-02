<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/layout.css" />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>


<body>
  <div class="wrap">
    <div class="header clearfix">
      <div class="logo" title="<?php echo CHtml::encode(Yii::app()->name); ?>"><?php echo CHtml::encode(Yii::app()->name); ?></div>
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
            <li class="cur"><a href=""><span><em>首页</em></span></a></li>
            
            <?php $i=0;
            foreach($this->game as $g){ 
                if($i==5)break;
            ?>
            <li><a href="/game/<?php echo $g->id?>"><span><em><?php echo CHtml::encode($g->tag); ?></em></span></a></li>
            <?php $i++; } ?>
          </ul>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    
    <?php echo $content; ?>
    
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
        Copyright&copy;<?php echo Yii::powered(); ?>&nbsp;All Rights Reserved.
      </div>
    </div>
  </div>
</body>
</html>
