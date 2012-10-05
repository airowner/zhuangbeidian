<div class="itemRecommends index">
	<h2><?php echo __('Item Recommends'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('item_id'); ?></th>
			<th><?php echo $this->Paginator->sort('modify_time'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($itemRecommends as $itemRecommend): ?>
	<tr>
		<td><?php echo h($itemRecommend['ItemRecommend']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($itemRecommend['Item']['title'], array('controller' => 'items', 'action' => 'view', $itemRecommend['Item']['id'])); ?>
		</td>
		<td><?php echo h($itemRecommend['ItemRecommend']['modify_time']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $itemRecommend['ItemRecommend']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $itemRecommend['ItemRecommend']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $itemRecommend['ItemRecommend']['id']), null, __('Are you sure you want to delete # %s?', $itemRecommend['ItemRecommend']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Item Recommend'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
