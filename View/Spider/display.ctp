<script type="text/javascript" src="/js/jquery/jquery.min.js"></script>
<script>
var addUrl = function(){
    var url = $('#url').attr('src');
    if(url){
    	$('input[name="data[Spider][dst]"]').val(url);
	$('form').submit();
    }else{
    	alert('url is empty');
    }
};
var checkSubmit = function(){
    if($('input[name="data[Spider][dst]"]').val() != ''){
    	return true;
    }
    return false;
};
</script>
<div class="spider form">
<?php echo $this->Form->create('Spider', array(
	'url' => array('controller'=>'Spider', 'action' => 'request'),
	'onsubmit' => 'return checkSubmit();',
)); ?>
    <?php
        echo $this->Form->input('dst', array(
            'type' => 'hidden',
            'required' => true,
            'empty' => false,
	));
    ?>
<?php echo $this->Form->end(array(
	'label' => '收录到后台',
	'type' => 'button',
	'onclick' => 'addUrl();',
)); ?>
</div>
<iframe id="url" src="<?php echo $dst; ?>" style="width:100%;height:90%;overflow:hidden;"></iframe>

