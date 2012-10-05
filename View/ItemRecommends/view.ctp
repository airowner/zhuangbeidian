<div class="itemRecommends view">
<h2><?php  echo __('Item Recommend'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($itemRecommend['ItemRecommend']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemRecommend['Item']['title'], array('controller' => 'items', 'action' => 'view', $itemRecommend['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modify Time'); ?></dt>
		<dd>
			<?php echo h($itemRecommend['ItemRecommend']['modify_time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Item Recommend'), array('action' => 'edit', $itemRecommend['ItemRecommend']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Item Recommend'), array('action' => 'delete', $itemRecommend['ItemRecommend']['id']), null, __('Are you sure you want to delete # %s?', $itemRecommend['ItemRecommend']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Item Recommends'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item Recommend'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
