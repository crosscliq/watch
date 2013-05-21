<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php //echo MediaManager::dump( $this->handlers ); ?>

<h2><?php echo JText::_( "Select a Media Handler" ); ?></h2>

<?php foreach ( $this->groups as $group) { ?>
    <h3><?php echo JText::_( $group->name ); ?></h3>
    
    <ul>
    <?php if (empty($group->handlers)) { ?>
        <li>
            <?php echo JText::_( "No Handlers Installed" ); ?>
        </li>
    <?php } ?>
    
    
    <?php foreach ( $group->handlers as $handler) { ?>
        <li>
            <a href="<?php echo $handler->link_add; ?>"><?php echo $handler->name; ?></a>
        </li>
    <?php } ?>
    </ul>    
<?php } ?>