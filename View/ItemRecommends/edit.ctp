<div class="itemRecommends form">
<?php echo $this->Form->create('ItemRecommend'); ?>
	<fieldset>
		<legend><?php echo __('Edit Item Recommend'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('item_id');
		echo $this->Form->input('modify_time');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ItemRecommend.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ItemRecommend.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Item Recommends'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
