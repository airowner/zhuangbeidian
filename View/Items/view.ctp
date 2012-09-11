<div class="items view">
<h2><?php  echo __('Item'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($item['Item']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Num Iid'); ?></dt>
		<dd>
			<?php echo h($item['Item']['num_iid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item Imgs'); ?></dt>
		<dd>
			<?php echo h($item['Item']['item_imgs']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Num'); ?></dt>
		<dd>
			<?php echo h($item['Item']['num']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Track Iid'); ?></dt>
		<dd>
			<?php echo h($item['Item']['track_iid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cid'); ?></dt>
		<dd>
			<?php echo h($item['Item']['cid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('List Time'); ?></dt>
		<dd>
			<?php echo h($item['Item']['list_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($item['Item']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Delist Time'); ?></dt>
		<dd>
			<?php echo h($item['Item']['delist_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($item['Item']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pic Url'); ?></dt>
		<dd>
			<?php echo h($item['Item']['pic_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($item['Item']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Props'); ?></dt>
		<dd>
			<?php echo h($item['Item']['props']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nick'); ?></dt>
		<dd>
			<?php echo h($item['Item']['nick']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($item['Item']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($item['Item']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Desc'); ?></dt>
		<dd>
			<?php echo h($item['Item']['desc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Auction Point'); ?></dt>
		<dd>
			<?php echo h($item['Item']['auction_point']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Approve Status'); ?></dt>
		<dd>
			<?php echo h($item['Item']['approve_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Detail Url'); ?></dt>
		<dd>
			<?php echo h($item['Item']['detail_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ems Fee'); ?></dt>
		<dd>
			<?php echo h($item['Item']['ems_fee']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Express Fee'); ?></dt>
		<dd>
			<?php echo h($item['Item']['express_fee']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Freight Payer'); ?></dt>
		<dd>
			<?php echo h($item['Item']['freight_payer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Has Discount'); ?></dt>
		<dd>
			<?php echo h($item['Item']['has_discount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Has Invoice'); ?></dt>
		<dd>
			<?php echo h($item['Item']['has_invoice']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Has Showcase'); ?></dt>
		<dd>
			<?php echo h($item['Item']['has_showcase']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Has Warranty'); ?></dt>
		<dd>
			<?php echo h($item['Item']['has_warranty']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Virtual'); ?></dt>
		<dd>
			<?php echo h($item['Item']['is_virtual']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stuff Status'); ?></dt>
		<dd>
			<?php echo h($item['Item']['stuff_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Seller Cids'); ?></dt>
		<dd>
			<?php echo h($item['Item']['seller_cids']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Input Pids'); ?></dt>
		<dd>
			<?php echo h($item['Item']['input_pids']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Input Str'); ?></dt>
		<dd>
			<?php echo h($item['Item']['input_str']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($item['Item']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Valid Thru'); ?></dt>
		<dd>
			<?php echo h($item['Item']['valid_thru']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Post Fee'); ?></dt>
		<dd>
			<?php echo h($item['Item']['post_fee']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Postage Id'); ?></dt>
		<dd>
			<?php echo h($item['Item']['postage_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Property Alias'); ?></dt>
		<dd>
			<?php echo h($item['Item']['property_alias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Outer Id'); ?></dt>
		<dd>
			<?php echo h($item['Item']['outer_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Skus'); ?></dt>
		<dd>
			<?php echo h($item['Item']['skus']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Item'), array('action' => 'edit', $item['Item']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Item'), array('action' => 'delete', $item['Item']['id']), null, __('Are you sure you want to delete # %s?', $item['Item']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tag Items'), array('controller' => 'tag_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag Item'), array('controller' => 'tag_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Tag Items'); ?></h3>
	<?php if (!empty($item['TagItem'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Item Id'); ?></th>
		<th><?php echo __('Tag Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['TagItem'] as $tagItem): ?>
		<tr>
			<td><?php echo $tagItem['id']; ?></td>
			<td><?php echo $tagItem['item_id']; ?></td>
			<td><?php echo $tagItem['tag_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tag_items', 'action' => 'view', $tagItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'tag_items', 'action' => 'edit', $tagItem['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'tag_items', 'action' => 'delete', $tagItem['id']), null, __('Are you sure you want to delete # %s?', $tagItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Tag Item'), array('controller' => 'tag_items', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
