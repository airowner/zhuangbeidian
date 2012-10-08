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

<div class="spider form">
    <fieldset>
        <legend><?php echo __('添加商品'); ?></legend>
        <?php
        echo $this->Form->input('nicks', array('label'=>'淘宝商家nick', 'onchange'=>'getShop(this.value);'));
        ?>
    </fieldset>

</div>

<pre id="result">
</pre>

<script>
var getShop = function(seller_nick){
    TB.get({
        method: 'taobao.taobaoke.widget.shops.convert',
        fields: 'user_id,shop_title,click_url,commission_rate',
        seller_nicks: seller_nick
    }, function(resp){
        $('#result').html(TB.debug(resp));
    }
}
</script>
