<div class="items form">
<?php echo $this->Form->create('Item'); ?>
	<fieldset>
		<legend><?php echo __('Add Item'); ?></legend>
	<?php
		echo $this->Form->input('num_iid');
		echo $this->Form->input('item_imgs');
		echo $this->Form->input('num');
		echo $this->Form->input('track_iid');
		echo $this->Form->input('cid');
		echo $this->Form->input('list_time');
		echo $this->Form->input('delist_time');
		echo $this->Form->input('title');
		echo $this->Form->input('pic_url');
		echo $this->Form->input('price');
		echo $this->Form->input('props');
		echo $this->Form->input('nick');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('desc');
		echo $this->Form->input('auction_point');
		echo $this->Form->input('approve_status');
		echo $this->Form->input('detail_url');
		echo $this->Form->input('ems_fee');
		echo $this->Form->input('express_fee');
		echo $this->Form->input('freight_payer');
		echo $this->Form->input('has_discount');
		echo $this->Form->input('has_invoice');
		echo $this->Form->input('has_showcase');
		echo $this->Form->input('has_warranty');
		echo $this->Form->input('is_virtual');
		echo $this->Form->input('stuff_status');
		echo $this->Form->input('seller_cids');
		echo $this->Form->input('input_pids');
		echo $this->Form->input('input_str');
		echo $this->Form->input('type');
		echo $this->Form->input('valid_thru');
		echo $this->Form->input('post_fee');
		echo $this->Form->input('postage_id');
		echo $this->Form->input('property_alias');
		echo $this->Form->input('outer_id');
		echo $this->Form->input('skus');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Items'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Tag Items'), array('controller' => 'tag_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag Item'), array('controller' => 'tag_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
