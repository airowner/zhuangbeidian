<div class="spider form">
<?php echo $this->Form->create('Spider')?>
    <fieldset>
        <legend><?php echo __('添加商品'); ?></legend>
        <?php
        echo $this->Form->input('url', array('label'=>'淘宝商品链接'));
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>


<?php
/*
 * {"taobaoke_shops":{"taobaoke_shop":[{"auction_count":"301","click_url":"http://s.click.taobao.com/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTdjPgsro5sLEzTdlUjmtJ3pgL%2B551VN4LnW4B7LFeB2egIham6k%2FHBiJHdmWpw%2B87SCRbN0wVXDXsdIpbAaVkL2zT0aAbtrGAV3XPyDdPkMrjawy4%3D&pid=mm_17531361_0_0","commission_rate":"5.38","seller_credit":"11","seller_nick":"清若彤","shop_id":11436017,"shop_title":"miss2蜜s兔-淘宝服饰频道官方合作店铺","shop_type":"C","total_auction":"3895","user_id":20737888}]}}
 */
?>
<div class="spider form">
    <fieldset>
        <legend><?php echo __('查找商家'); ?></legend>
        <?php
        echo $this->Form->input('nicks', array('label'=>'淘宝商家nick', 'onchange'=>'TB.getShop(this.value, TB.debug);'));
        ?>
    </fieldset>
</div>
<div class="spider form">
    <fieldset>
        <legend><?php echo __('查找商品'); ?></legend>
        <?php
        echo $this->Form->input('num_iids', array('label'=>'商品iids', 'onchange'=>'TB.getItems(this.value, TB.debug);'));
        ?>
    </fieldset>
</div>
