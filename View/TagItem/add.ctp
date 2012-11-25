<style type="text/css">
div.checkbox{clear:none;display:inline-block;}
</style>
<script>
<?php

	$top = array();
	$product = array();
	foreach($tree as $t){
		if(!isset($t['children'])) continue;
		$cates = $t['children'];
		$tmp = array();
		foreach($cates as $cate){
			$tmp[$cate['id']] = $cate['tag'];
			if(isset($cate['children'])){
				$product[$cate['id']] = $cate['children'];
			}
		}
		$_form_options = array(
			'options' => $tmp,
			'empty' => '请选择',
		);
		if($t['tag'] == '#product'){
			$_form_options += array(
				'name' => 'data[TagItem][product_parent]',
				'onchange' => 'changeProduct(this.value)',
				'after' => $this->Form->select('TagItem.product', null, array('id'=>'product')),
			);
		}elseif($t['tag'] == '#user'){
			unset($_form_options['empty']);
			$_form_options += array('multiple' => 'checkbox');
		}elseif($t['tag'] == '#game'){
			unset($_form_options['empty']);
			$_form_options['options']['all'] = '全选';
			$_form_options += array('multiple' => 'checkbox');
		}
		$top[substr($t['tag'], 1)] = $_form_options;
	}
?>
var products = <?php echo json_encode($product); ?>;
var changeProduct = function(v){
	if(!(v in products)) return false;
	var tmp = products[v];
	var html = '';
	for(var i in tmp){
		html += '<option value="'+i+'">'+tmp[i]['tag']+'</option>';
	}
	$('#product').html(html);
}
var allchoose = function(){
	var o = $('input[name="data[TagItem][game][]"]');
	var l = o.length;
	var _click = function(){
		var all = true;
		o.each(function(i){
			if(i == l-1) return;
			if(!$(this).attr('checked')) all = false;
		});
		if(all){
			o.each(function(){$(this).attr('checked', false);})
		}else{
			o.each(function(){$(this).attr('checked', true);})
		}
	}
	_click();
	return _click;
}
$(function(){
	$('input[name="data[TagItem][game][]"]').last().bind('click', allchoose);
})
</script>
<div class="users form">
<?php echo $this->Form->create('TagItem'); ?>
	<fieldset>
		<legend><?php echo __('Add Tag For Item'); ?></legend>
		<div style="position:relative">
			<div style="float:right">
				<?php echo $this->Html->image($item['pic_url'], array('width'=>300)); ?>
			</div>
			<div style="float:left;word-wrap:break-word;clear:none"><?php echo $item['title'];?></div>
			<div style="float:left;word-wrap:break-word;clear:none">￥<?php echo $item['price'];?></div>
			<div></div>
		</div>
		<?php 
		echo $this->Form->hidden('item_id', array('value'=>$item['id']));
		echo $this->Form->input('name', array(
            'type' => 'text',
            'label' => '商品名称',
            'value' => $item['title'],
        ));
		foreach($top as $k => $v){
			echo $this->Form->input($k, $v);
		}
		echo $this->Form->input('user_defined', array('label'=>'用户自定义标签(多个标签请用半角逗号分割)'));
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
	</ul>
</div>
