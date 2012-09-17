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
