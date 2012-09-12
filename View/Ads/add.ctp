<script>
var hideType = function(){
    $('#url, #txt, #img, #width, #height, #other').hide();
}
var changeType = function(type){
    hideType();
    switch(type){
    case 'text':
        $('#url, #txt').show();
        break;
    case 'img':
        $('#url, #txt, #width, #height, #img').show();
        break;
    case 'javascript':
        $('#other').show();
        break;
    case 'flash':
        $('#other, #width, #height').show();
        break;
    }
}
</script>
<div class="ads form">
<?php echo $this->Form->create('Ad', array(
    'type'=>'file',

)); ?>
    <fieldset>
        <legend><?php echo __('添加广告'); ?></legend>
    <?php
        echo $this->Form->input('name', array('label'=>'广告名称'));
        echo $this->Form->input('type', array(
            'type' => 'select',
            'label' => '广告类型',
            'required' => true,
            'empty' => true,
            'options' => array(
                'text' => 'text',
                'img' => 'img',
                'javascript' => 'javascript',
                'flash' => 'flash',
            ),
            'onclick' => "changeType(this.value);",
        ));
        echo $this->Form->input('url', array('label'=>'跳转网址',
            'div' => array(
                'style' => 'display:none',
                'id'=>'url',
            ),        
        ));
        echo $this->Form->input('txt', array('label'=>'文本信息',
            'div' => array(
                'style' => 'display:none',
                'id'=>'txt',
            ),
        ));
        echo $this->Form->input('img', array('label'=>'上传文件', 'type'=>'file', 
            'div' => array(
                'style' => 'display:none',
                'id'=>'img',
            ),
        ));
        echo $this->Form->input('width', array('label'=>'宽度（px）',
            'div' => array(
                'style' => 'display:none',
                'id'=>'width',
            ),
        ));
        echo $this->Form->input('height', array('label'=>'高度（px）',
            'div' => array(
                'style' => 'display:none',
                'id'=>'height',
            ),
        ));
        echo $this->Form->input('other', array(
            'label'=>'代码',
            'type' => 'textarea',
            'div' => array(
                'style' => 'display:none',
                'id'=>'other',
            ),
        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Ads'), array('action' => 'index')); ?></li>
    </ul>
</div>
