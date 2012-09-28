<div class="tags view">
<h2><?php  echo __('Tag'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tag['Tag']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tag'); ?></dt>
		<dd>
			<?php echo h($tag['Tag']['tag']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Id'); ?></dt>
		<dd>
			<?php echo h($tag['Tag']['parent_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Display Html'); ?></dt>
		<dd>
			<?php echo h($tag['Tag']['display_html']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order'); ?></dt>
		<dd>
			<?php echo h($tag['Tag']['order']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Validate'); ?></dt>
		<dd>
			<?php echo h($tag['Tag']['validate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time'); ?></dt>
		<dd>
			<?php echo h($tag['Tag']['time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tag'), array('action' => 'edit', $tag['Tag']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tag'), array('action' => 'delete', $tag['Tag']['id']), null, __('Are you sure you want to delete # %s?', $tag['Tag']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Items'); ?></h3>
	<?php if (!empty($tag['Item'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Num Iid'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Click Url'); ?></th>
		<th><?php echo __('Shop Click Url'); ?></th>
		<th><?php echo __('Seller Credit Score'); ?></th>
		<th><?php echo __('Pic Url'); ?></th>
		<th><?php echo __('Item Imgs'); ?></th>
		<th><?php echo __('Num'); ?></th>
		<th><?php echo __('Track Iid'); ?></th>
		<th><?php echo __('Cid'); ?></th>
		<th><?php echo __('List Time'); ?></th>
		<th><?php echo __('Delist Time'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Nick'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Desc'); ?></th>
		<th><?php echo __('Prop Img'); ?></th>
		<th><?php echo __('Props'); ?></th>
		<th><?php echo __('Property Alias'); ?></th>
		<th><?php echo __('Auction Point'); ?></th>
		<th><?php echo __('Approve Status'); ?></th>
		<th><?php echo __('Detail Url'); ?></th>
		<th><?php echo __('Ems Fee'); ?></th>
		<th><?php echo __('Express Fee'); ?></th>
		<th><?php echo __('Freight Payer'); ?></th>
		<th><?php echo __('Has Discount'); ?></th>
		<th><?php echo __('Has Invoice'); ?></th>
		<th><?php echo __('Has Showcase'); ?></th>
		<th><?php echo __('Has Warranty'); ?></th>
		<th><?php echo __('Is Virtual'); ?></th>
		<th><?php echo __('Stuff Status'); ?></th>
		<th><?php echo __('Seller Cids'); ?></th>
		<th><?php echo __('Input Pids'); ?></th>
		<th><?php echo __('Input Str'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Valid Thru'); ?></th>
		<th><?php echo __('Post Fee'); ?></th>
		<th><?php echo __('Postage Id'); ?></th>
		<th><?php echo __('Outer Id'); ?></th>
		<th><?php echo __('Skus'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tag['Item'] as $item): ?>
		<tr>
			<td><?php echo $item['id']; ?></td>
			<td><?php echo $item['num_iid']; ?></td>
			<td><?php echo $item['title']; ?></td>
			<td><?php echo $item['click_url']; ?></td>
			<td><?php echo $item['shop_click_url']; ?></td>
			<td><?php echo $item['seller_credit_score']; ?></td>
			<td><?php echo $item['pic_url']; ?></td>
			<td><?php echo $item['item_imgs']; ?></td>
			<td><?php echo $item['num']; ?></td>
			<td><?php echo $item['track_iid']; ?></td>
			<td><?php echo $item['cid']; ?></td>
			<td><?php echo $item['list_time']; ?></td>
			<td><?php echo $item['delist_time']; ?></td>
			<td><?php echo $item['modified']; ?></td>
			<td><?php echo $item['price']; ?></td>
			<td><?php echo $item['nick']; ?></td>
			<td><?php echo $item['city']; ?></td>
			<td><?php echo $item['state']; ?></td>
			<td><?php echo $item['desc']; ?></td>
			<td><?php echo $item['prop_img']; ?></td>
			<td><?php echo $item['props']; ?></td>
			<td><?php echo $item['property_alias']; ?></td>
			<td><?php echo $item['auction_point']; ?></td>
			<td><?php echo $item['approve_status']; ?></td>
			<td><?php echo $item['detail_url']; ?></td>
			<td><?php echo $item['ems_fee']; ?></td>
			<td><?php echo $item['express_fee']; ?></td>
			<td><?php echo $item['freight_payer']; ?></td>
			<td><?php echo $item['has_discount']; ?></td>
			<td><?php echo $item['has_invoice']; ?></td>
			<td><?php echo $item['has_showcase']; ?></td>
			<td><?php echo $item['has_warranty']; ?></td>
			<td><?php echo $item['is_virtual']; ?></td>
			<td><?php echo $item['stuff_status']; ?></td>
			<td><?php echo $item['seller_cids']; ?></td>
			<td><?php echo $item['input_pids']; ?></td>
			<td><?php echo $item['input_str']; ?></td>
			<td><?php echo $item['type']; ?></td>
			<td><?php echo $item['valid_thru']; ?></td>
			<td><?php echo $item['post_fee']; ?></td>
			<td><?php echo $item['postage_id']; ?></td>
			<td><?php echo $item['outer_id']; ?></td>
			<td><?php echo $item['skus']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'items', 'action' => 'view', $item['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'items', 'action' => 'edit', $item['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'items', 'action' => 'delete', $item['id']), null, __('Are you sure you want to delete # %s?', $item['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
