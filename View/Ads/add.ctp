<div class="ads form">
<?php echo $this->Form->create('Ad'); ?>
	<fieldset>
		<legend><?php echo __('Add Ad'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('type');
		echo $this->Form->input('url');
		echo $this->Form->input('img');
		echo $this->Form->input('txt');
		echo $this->Form->input('width');
		echo $this->Form->input('height');
		echo $this->Form->input('other');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Ads'), array('action' => 'index')); ?></li>
	</ul>
</div>
