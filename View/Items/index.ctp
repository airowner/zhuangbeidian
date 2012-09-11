<div class="items index">
	<h2><?php echo __('Items'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('num_iid'); ?></th>
			<th><?php echo $this->Paginator->sort('item_imgs'); ?></th>
			<th><?php echo $this->Paginator->sort('num'); ?></th>
			<th><?php echo $this->Paginator->sort('track_iid'); ?></th>
			<th><?php echo $this->Paginator->sort('cid'); ?></th>
			<th><?php echo $this->Paginator->sort('list_time'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('delist_time'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('pic_url'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('props'); ?></th>
			<th><?php echo $this->Paginator->sort('nick'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('desc'); ?></th>
			<th><?php echo $this->Paginator->sort('auction_point'); ?></th>
			<th><?php echo $this->Paginator->sort('approve_status'); ?></th>
			<th><?php echo $this->Paginator->sort('detail_url'); ?></th>
			<th><?php echo $this->Paginator->sort('ems_fee'); ?></th>
			<th><?php echo $this->Paginator->sort('express_fee'); ?></th>
			<th><?php echo $this->Paginator->sort('freight_payer'); ?></th>
			<th><?php echo $this->Paginator->sort('has_discount'); ?></th>
			<th><?php echo $this->Paginator->sort('has_invoice'); ?></th>
			<th><?php echo $this->Paginator->sort('has_showcase'); ?></th>
			<th><?php echo $this->Paginator->sort('has_warranty'); ?></th>
			<th><?php echo $this->Paginator->sort('is_virtual'); ?></th>
			<th><?php echo $this->Paginator->sort('stuff_status'); ?></th>
			<th><?php echo $this->Paginator->sort('seller_cids'); ?></th>
			<th><?php echo $this->Paginator->sort('input_pids'); ?></th>
			<th><?php echo $this->Paginator->sort('input_str'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('valid_thru'); ?></th>
			<th><?php echo $this->Paginator->sort('post_fee'); ?></th>
			<th><?php echo $this->Paginator->sort('postage_id'); ?></th>
			<th><?php echo $this->Paginator->sort('property_alias'); ?></th>
			<th><?php echo $this->Paginator->sort('outer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('skus'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($items as $item): ?>
	<tr>
		<td><?php echo h($item['Item']['id']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['num_iid']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['item_imgs']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['num']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['track_iid']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['cid']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['list_time']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['modified']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['delist_time']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['title']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['pic_url']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['price']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['props']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['nick']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['city']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['state']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['desc']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['auction_point']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['approve_status']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['detail_url']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['ems_fee']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['express_fee']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['freight_payer']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['has_discount']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['has_invoice']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['has_showcase']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['has_warranty']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['is_virtual']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['stuff_status']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['seller_cids']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['input_pids']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['input_str']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['type']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['valid_thru']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['post_fee']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['postage_id']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['property_alias']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['outer_id']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['skus']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $item['Item']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $item['Item']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $item['Item']['id']), null, __('Are you sure you want to delete # %s?', $item['Item']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Item'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Tag Items'), array('controller' => 'tag_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag Item'), array('controller' => 'tag_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
