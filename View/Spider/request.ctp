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
