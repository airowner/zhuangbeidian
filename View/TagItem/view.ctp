<div class="tags view">
<h2><?php  echo __('商品标签分类'); ?></h2>
	<dl>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link(h($item['Item']['title']), $item['Item']['click_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('price'); ?></dt>
		<dd>
			￥<?php echo h($item['Item']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('pic'); ?></dt>
		<dd>
			<?php echo $this->Html->link($this->Html->image($item['Item']['pic_url'], array('width'=>300)), $item['Item']['click_url'], array('escape'=>false)); ?>
			&nbsp;
		</dd>
		<?php
		$_tag = array(); 
		$_map = array();
		foreach($tree as $t){
			$_tag[$t['id']] = array();
			$_map[$t['id']] = $t['tag'];
		}
		foreach($tags as $tag){
			$pid = $tag['parent_id'];
			if(!isset($_tag[$pid])){
				if(isset($tags[$pid])){
					$pid = $tags[$pid]['parent_id'];
				}else{
					continue;
				}
			}
			$_tag[$pid][] = $tag['tag'];
		}
		foreach($_tag as $pid => $__t){
			switch($_map[$pid]){
				case '#game':
				echo '<dt>游戏</dt>';
				break;
				case '#price':
				echo '<dt>价格范围</dt>';
				break;
				case '#product':
				echo '<dt>商品分类</dt>';
				break;
				case '#user':
				echo '<dt>用户自定义分类</dt>';
				break;
			}
		?>
		<dd>
			<?php echo implode(',', $__t); ?>
			&nbsp;
		</dd>
		<?php 
		}
		?>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit TagItem'), array('action' => 'edit', $item['Item']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete TagItem'), array('action' => 'delete', $item['Item']['id']), null, __('Are you sure you want to delete # %s?', $item['Item']['title'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
	</ul>
</div>
