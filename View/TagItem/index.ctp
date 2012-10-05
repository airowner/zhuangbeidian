<div class="tagitems index">
	<h2><?php echo __('TagItems'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('tags'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($tagitems as $tagitem):?>
	<tr>
		<td><?php echo h($tagitem['id']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link(h($tagitem['title']), $tagitem['click_url'], array('target'=>'_blank')); ?>&nbsp;</td>
		<td><?php echo h($tagitem['price']); ?>&nbsp;</td>
		<td><?php
		$_t = array(); 
		foreach($tagitem['tags'] as $tag_id){
			$_t[] = $tags[$tag_id];
		}
		echo implode(',', $_t);
		?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $tagitem['item_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $tagitem['item_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $tagitem['item_id']), null, __('Are you sure you want to delete # %s?', $tagitem['title'])); ?>
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
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tag'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
	</ul>
</div>
