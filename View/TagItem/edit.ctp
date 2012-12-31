<style type="text/css">
div.checkbox{clear:none;display:inline-block;}
</style>
<script>
<?php
	$top = array();
	$product = array();
	$tagids = array();
	foreach($tree[0] as $k => $t){
		if(!isset($tree[$k])) continue;
		$cates = $tree[$k];
		$tmp = array();
		foreach($cates as $cateid => $cate){
			$tmp[$cate['id']] = $cate['tag'];
			if(isset($tree[$cateid])){
				foreach($tree[$cateid] as $k => $v){
					if(!isset($product[$cateid])) $product[$cateid] = array();
					$product[$cateid][$k] = $v;
				}
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
var checked = <?php echo json_encode($tagids); ?>;
var changeProduct = function(v){
	if(!(v in products)) return false;
	var tmp = products[v];
	var html = '';
	for(var i in tmp){
		var h_checked = '';
		if(i in checked){
			h_checked = ' selected="selected"';
		}
		html += '<option value="'+i+'"'+h_checked+'>'+tmp[i]['tag']+'</option>';
	}
	$('#product').html(html);
}

var init = function(){
	$('input[name="data[TagItem][game][]"], select[name="data[TagItem][product_parent]"] option, select[name="data[TagItem][price]"] option, input[name="data[TagItem][user][]"]').each(function(){
		if(this.value in checked){
			if(this.getAttribute('type') == 'checkbox'){
				this.checked = true;
			}else{
				this.selected = true;
				$(this).parent().change();
			}
		}
	});
	checked = {};
	var o = $('input[name="data[TagItem][game][]"]');
	var all = true;
	o.each(function(i){
		if(i == o.length-1) return;
		if(!$(this).attr('checked')) all = false;
	});
	if(all){
		$('input[name="data[TagItem][game][]"]').last().attr('checked', true);
	}
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
	init();
	$('input[name="data[TagItem][game][]"]').last().bind('click', allchoose);
})
</script>
<div class="users form">
<?php echo $this->Form->create('TagItem'); ?>
	<fieldset>
		<legend><?php echo __('编辑产品相关TAG'); ?></legend>
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
            'value' => $item['name'],
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

		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
	</ul>
</div>
