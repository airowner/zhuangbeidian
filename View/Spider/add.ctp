<div class="ads form">
<?php echo $this->Form->create('Spider')?>
    <fieldset>
        <legend><?php echo __('添加商品'); ?></legend>
    <?php
        echo $this->Form->input('url', array('label'=>'淘宝商品链接'));
        echo $this->Form->input('game', array(
            'type' => 'select',
            'label' => '游戏',
            'required' => true,
            'empty' => true,
            'options' => 
        ));
        echo $this->Form->input('price', array(
            'type' => 'select',
            'label'=>'价格',
            'required' => true,
            'empty' => true,
            'options' => 
        ));
        echo $this->Form->input('cate', array(
            'type' => 'select',
            'label'=>'分类',
            'required' => true,
            'empty' => true,
            'options' => 
        ));
        echo $this->Form->input('other', array(
            'type' => 'input',
            'label'=>'其他',
            'required' => true,
            'empty' => true,
            'options' => 
        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('List Spider'), array('action' => 'index')); ?></li>
    </ul>
</div>
