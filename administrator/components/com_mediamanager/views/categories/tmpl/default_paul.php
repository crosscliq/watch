<?php defined('_JEXEC') or die('Restricted access'); ?> 
<?php $items = @$this->get('items'); ?>
<?php $form = @$this->get('form'); ?>
<?php $state = @$this->get('state'); ?>

<form action="<?php echo JRoute::_(@$form['action']);?>" <?php echo @$form['enctype']; ?> name="adminForm" id="adminForm" id="adminForm" method="post">
    <?php $max_filters = MediaManager::getInstance()->get( 'max_filters', '5' ); ?>
    
    <?php for ($i=0; $i < $max_filters; $i++) :?>
        <?php $item = $this->getModel()->getTable(); ?>
        <?php if (!empty($items[$i])) { $item = $items[$i]; } ?>
        <?php $this->item = $item; ?>
        <?php $this->i = $i; ?>
        <?php echo $this->loadTemplate( 'item' ); ?>
    <?php endfor; ?>

    <div>
        <input type="hidden" name="task" value="" />
    </div>
</form>
