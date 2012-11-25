<script>
var fcate = <?php echo json_encode($cate);?>;
var ccate = <?php echo json_encode($ccate);?>;
var changeCate = function(cate){
    var d = cate?ccate[cate]:[];
    var htm = '<option value="">请选择</option>';
    $.each(d, function(k, v){
        htm += '<option value="'+k+'">'+v+'</option>';
    });
    $('#ccate').html(htm);
}
</script>
<div class="spider form">
<?php echo $this->Form->create('Spider')?>
    <fieldset>
        <legend><?php echo __('添加商品'); ?></legend>
    <?php
        echo $this->Form->input('url', array('label'=>'淘宝商品链接'));
        echo $this->Form->input('name', array(
            'label'=>'商品名称',
            'type' => 'input',
            'value' => '1',
        ));
        echo $this->Form->input('game', array(
            'type' => 'select',
            'label' => '游戏',
            'required' => true,
            'empty' => true,
            'options' => $game,
        ));
        echo $this->Form->input('price', array(
            'type' => 'select',
            'label'=>'价格',
            'required' => true,
            'empty' => true,
            'options' => $price,
        ));
        echo $this->Form->input('cate', array(
            'type' => 'select',
            'label'=>'分类',
            'required' => true,
            'empty' => true,
            'options' => $cate,
            'onchange' => 'changeCate(this.value)',
        ));
        echo $this->Form->input('ccate', array(
            'id' => 'ccate',
            'type' => 'select',
            'label'=>'子分类',
            'required' => true,
            'empty' => true,
            'options' => array(), 
        ));
        echo $this->Form->input('other', array(
            'type' => 'input',
            'label'=>'其他',
            'required' => false,
            'empty' => true,
            'options' => $other, 
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
