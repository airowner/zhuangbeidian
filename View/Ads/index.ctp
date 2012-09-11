<div class="ads index">
	<h2><?php echo __('Ads'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('url'); ?></th>
			<th><?php echo $this->Paginator->sort('img'); ?></th>
			<th><?php echo $this->Paginator->sort('txt'); ?></th>
			<th><?php echo $this->Paginator->sort('width'); ?></th>
			<th><?php echo $this->Paginator->sort('height'); ?></th>
			<th><?php echo $this->Paginator->sort('other'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($ads as $ad): ?>
	<tr>
		<td><?php echo h($ad['Ad']['id']); ?>&nbsp;</td>
		<td><?php echo h($ad['Ad']['name']); ?>&nbsp;</td>
		<td><?php echo h($ad['Ad']['type']); ?>&nbsp;</td>
		<td><?php echo h($ad['Ad']['url']); ?>&nbsp;</td>
		<td><?php echo h($ad['Ad']['img']); ?>&nbsp;</td>
		<td><?php echo h($ad['Ad']['txt']); ?>&nbsp;</td>
		<td><?php echo h($ad['Ad']['width']); ?>&nbsp;</td>
		<td><?php echo h($ad['Ad']['height']); ?>&nbsp;</td>
		<td><?php echo h($ad['Ad']['other']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $ad['Ad']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $ad['Ad']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ad['Ad']['id']), null, __('Are you sure you want to delete # %s?', $ad['Ad']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Ad'), array('action' => 'add')); ?></li>
	</ul>
</div>
