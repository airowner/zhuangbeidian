<div class="spiders view">
<h2><?php  echo __('Spider'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($spider['Spider']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('URL'); ?></dt>
        <dd>
            <?php echo h($spider['Spider']['url']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Game'); ?></dt>
        <dd>
            <?php echo h($game); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Price'); ?></dt>
        <dd>
            <?php echo h($price); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Cate'); ?></dt>
        <dd>
            <?php echo h($cate); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Other'); ?></dt>
        <dd>
            <?php echo h($other); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Spider'), array('action' => 'edit', $spider['Spider']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Spider'), array('action' => 'delete', $spider['Spider']['id']), null, __('Are you sure you want to delete # %s?', $spider['Spider']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Spiders'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Spider'), array('action' => 'add')); ?> </li>
    </ul>
</div>
