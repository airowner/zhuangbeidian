<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
    <div class="body home">
      <div class="clearfix">
        <div class="catalog" id="catalog">
          <ul class="tit">
            <li class="cur"><a href="javascript:void(0)" onFocus="this.blur()">按类别</a></li>
            <li style="margin-left:-1px;"><a href="javascript:void(0)" onFocus="this.blur()">按部位</a></li>
          </ul>
          <div class="con">
            <ul style="display:block;">
              <?php foreach($this->cates as $cate){ ?>
              <li>
              <div><?php echo CHtml::encode($cate['tag'])?></div>
                <?php foreach($cate['sub'] as $sub){ ?>
                 <a href="/tag/<?php echo $sub['id']?>"><?php echo CHtml::encode($sub['tag'])?></a>
                <?php } ?>
              </li>
              <?php } ?>
            </ul>
            <ul>
              <?php foreach($this->cates as $cate){ ?>
              <li>
              <div><?php echo CHtml::encode($cate['tag'])?></div>
                <?php foreach($cate['sub'] as $sub){ ?>
                 <a href="/tag/<?php echo $sub['id']?>"><?php echo CHtml::encode($sub['tag'])?></a>
                <?php } ?>
              </li>
              <?php } ?>
            </ul>
          </div>
        </div>
        <div class="rec">
            <ul class="clearfix">
              <li>
                <a href=""><img src="temp/img1_rec.jpg" width="548" height="199"/></a>
              </li>
              <li class="fr">
                <a href=""><img src="temp/img2_rec.jpg" width="180" height="394"/></a>
              </li>
              <li>
                <a href=""><img src="temp/img3_rec.jpg" width="182" height="194"/></a>
              </li>
              <li>
                <a href=""><img src="temp/img4_rec.jpg" width="182" height="194"/></a>
              </li>
              <li>
                <a href=""><img src="temp/img5_rec.jpg" width="182" height="194"/></a>
              </li>
            </ul>
        </div>
      </div>
      <a href="">
        <img class="poster" src="temp/ad1.jpg"/>
      </a>
      <div class="list clearfix">
        <div class="imgList">
          <div class="section">
            <div class="tit c_red clearfix">
              <div class="fr">
                <a href="">衣服</a><span>|</span><a href="">裤子</a><span>|</span><a href="">鞋</a><span>|</span><a href="">包</a><span>|</span><a href="">手机套</a>
              </div>
              <div class="inner_tit">
                <b class="icons fl"></b>
                <span>热门商品</span>
                <b class="icons fr"></b>
              </div>
            </div>
            <ul class="productCell clearfix">
              <li>
                <div>
                  <a href="">
                    <img src="temp/img_product.jpg"/>
                  </a>
                </div>
                <ul>
                  <li class="name"><a href="">三星S5380D接受挑战，将</a></li>
                  <li class="price"><em>市场价：￥5869</em></li>
                  <li class="price">装备店价：<b>￥2279.00</b></li>
                </ul>
              </li>
              <li>
                <div>
                  <a href="">
                    <img src="temp/img_product.jpg"/>
                  </a>
                </div>
                <ul>
                  <li class="name"><a href="">三星S5380D接受挑战，将</a></li>
                  <li class="price"><em>市场价：￥5869</em></li>
                  <li class="price">装备店价：<b>￥2279.00</b></li>
                </ul>
              </li>
              <li>
                <div>
                  <a href="">
                    <img src="temp/img_product.jpg"/>
                  </a>
                </div>
                <ul>
                  <li class="name"><a href="">三星S5380D接受挑战，将</a></li>
                  <li class="price"><em>市场价：￥5869</em></li>
                  <li class="price">装备店价：<b>￥2279.00</b></li>
                </ul>
              </li>
              <li>
                <div>
                  <a href="">
                    <img src="temp/img_product.jpg"/>
                  </a>
                </div>
                <ul>
                  <li class="name"><a href="">三星S5380D接受挑战，将</a></li>
                  <li class="price"><em>市场价：￥5869</em></li>
                  <li class="price">装备店价：<b>￥2279.00</b></li>
                </ul>
              </li>
              <li>
                <div>
                  <a href="">
                    <img src="temp/img_product.jpg"/>
                  </a>
                </div>
                <ul>
                  <li class="name"><a href="">三星S5380D接受挑战，将</a></li>
                  <li class="price"><em>市场价：￥5869</em></li>
                  <li class="price">装备店价：<b>￥2279.00</b></li>
                </ul>
              </li>
              <li>
                <div>
                  <a href="">
                    <img src="temp/img_product.jpg"/>
                  </a>
                </div>
                <ul>
                  <li class="name"><a href="">三星S5380D接受挑战，将</a></li>
                  <li class="price"><em>市场价：￥5869</em></li>
                  <li class="price">装备店价：<b>￥2279.00</b></li>
                </ul>
              </li>
              <li>
                <div>
                  <a href="">
                    <img src="temp/img_product.jpg"/>
                  </a>
                </div>
                <ul>
                  <li class="name"><a href="">三星S5380D接受挑战，将</a></li>
                  <li class="price"><em>市场价：￥5869</em></li>
                  <li class="price">装备店价：<b>￥2279.00</b></li>
                </ul>
              </li>
              <li>
                <div>
                  <a href="">
                    <img src="temp/img_product.jpg"/>
                  </a>
                </div>
                <ul>
                  <li class="name"><a href="">三星S5380D接受挑战，将</a></li>
                  <li class="price"><em>市场价：￥5869</em></li>
                  <li class="price">装备店价：<b>￥2279.00</b></li>
                </ul>
              </li>
            </ul>
          </div>
          <div class="section">
            <div class="tit c_green clearfix">
              <div class="fr">
                <a href="">衣服</a><span>|</span><a href="">裤子</a><span>|</span><a href="">鞋</a><span>|</span><a href="">包</a><span>|</span><a href="">手机套</a>
              </div>
              <div class="inner_tit">
                <b class="icons fl"></b>
                <span>热门商品</span>
                <b class="icons fr"></b>
              </div>
            </div>
            <ul class="productCell clearfix">
              <li>
                <div>
                  <a href="">
                    <img src="temp/img_product.jpg"/>
                  </a>
                </div>
                <ul>
                  <li class="name"><a href="">三星S5380D接受挑战，将</a></li>
                  <li class="price"><em>市场价：￥5869</em></li>
                  <li class="price">装备店价：<b>￥2279.00</b></li>
                </ul>
              </li>
              <li>
                <div>
                  <a href="">
                    <img src="temp/img_product.jpg"/>
                  </a>
                </div>
                <ul>
                  <li class="name"><a href="">三星S5380D接受挑战，将</a></li>
                  <li class="price"><em>市场价：￥5869</em></li>
                  <li class="price">装备店价：<b>￥2279.00</b></li>
                </ul>
              </li>
              <li>
                <div>
                  <a href="">
                    <img src="temp/img_product.jpg"/>
                  </a>
                </div>
                <ul>
                  <li class="name"><a href="">三星S5380D接受挑战，将</a></li>
                  <li class="price"><em>市场价：￥5869</em></li>
                  <li class="price">装备店价：<b>￥2279.00</b></li>
                </ul>
              </li>
              <li>
                <div>
                  <a href="">
                    <img src="temp/img_product.jpg"/>
                  </a>
                </div>
                <ul>
                  <li class="name"><a href="">三星S5380D接受挑战，将</a></li>
                  <li class="price"><em>市场价：￥5869</em></li>
                  <li class="price">装备店价：<b>￥2279.00</b></li>
                </ul>
              </li>
              <li>
                <div>
                  <a href="">
                    <img src="temp/img_product.jpg"/>
                  </a>
                </div>
                <ul>
                  <li class="name"><a href="">三星S5380D接受挑战，将</a></li>
                  <li class="price"><em>市场价：￥5869</em></li>
                  <li class="price">装备店价：<b>￥2279.00</b></li>
                </ul>
              </li>
              <li>
                <div>
                  <a href="">
                    <img src="temp/img_product.jpg"/>
                  </a>
                </div>
                <ul>
                  <li class="name"><a href="">三星S5380D接受挑战，将</a></li>
                  <li class="price"><em>市场价：￥5869</em></li>
                  <li class="price">装备店价：<b>￥2279.00</b></li>
                </ul>
              </li>
              <li>
                <div>
                  <a href="">
                    <img src="temp/img_product.jpg"/>
                  </a>
                </div>
                <ul>
                  <li class="name"><a href="">三星S5380D接受挑战，将</a></li>
                  <li class="price"><em>市场价：￥5869</em></li>
                  <li class="price">装备店价：<b>￥2279.00</b></li>
                </ul>
              </li>
              <li>
                <div>
                  <a href="">
                    <img src="temp/img_product.jpg"/>
                  </a>
                </div>
                <ul>
                  <li class="name"><a href="">三星S5380D接受挑战，将</a></li>
                  <li class="price"><em>市场价：￥5869</em></li>
                  <li class="price">装备店价：<b>￥2279.00</b></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <div class="txtList">
          <div class="section">
            <div class="tit">服装热门店铺</div>
            <ul class="con">
              <li>
                <b class="icons"></b><a href="">搜酷女包 女包排行第一</a><em class="icons yHat"></em><em class="icons yHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">猫猫包袋 欧美日韩女包</a><em class="icons yHat"></em><em class="icons yHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">小丫晶晶 日韩箱包</a><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">麦包包 箱包专营店</a><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">优优良品 日韩美包</a><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">猫猫包袋 旗舰商城</a><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">搜酷女包 旗舰商城</a><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">简单奢华 外贸原单</a><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">品质生活 流行女包</a><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">日韩外贸 时尚前卫</a><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em>
              </li>
            </ul>
          </div>
          <a href=""><img src="temp/ad2.jpg"/></a>
          <div class="section">
            <div class="tit">服装热门店铺</div>
            <ul class="con">
              <li>
                <b class="icons"></b><a href="">搜酷女包 女包排行第一</a><em class="icons yHat"></em><em class="icons yHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">猫猫包袋 欧美日韩女包</a><em class="icons yHat"></em><em class="icons yHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">小丫晶晶 日韩箱包</a><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">麦包包 箱包专营店</a><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">优优良品 日韩美包</a><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">猫猫包袋 旗舰商城</a><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">搜酷女包 旗舰商城</a><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">简单奢华 外贸原单</a><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">品质生活 流行女包</a><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em>
              </li>
              <li>
                <b class="icons"></b><a href="">日韩外贸 时尚前卫</a><em class="icons bHat"></em><em class="icons bHat"></em><em class="icons bHat"></em>
              </li>
            </ul>
          </div>
          <a href=""><img src="temp/ad2.jpg"/></a>
        </div>
      </div>
    </div>
