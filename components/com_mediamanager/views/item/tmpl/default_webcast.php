<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php $item = @$this->row; ?>
<?php $title = $item->media_title_long ? $item->media_title_long : $item->media_title; ?>
<?php $image = '<img src="' . $item->media_image . '" class="x-large" alt="' . htmlspecialchars( strip_tags( $title ) ). '" title="' . htmlspecialchars( strip_tags( $title ) ). '" />'; ?>

<div id="media-wrapper" class="wrap">
    <div class="handler-wrapper">
        <?php echo !empty($this->handler_html) ? $this->handler_html : $image; ?>
    </div>
</div>

<div class="meta-info wrap">
    <div id="webcast-options" class="wrap left span3">
        <?php if (!empty($item->media_description)) { ?>
            <div class="meta-header h4 purple light-purple-bg">
                Description
            </div>
            <div id="media-description" class="description inner">
                <?php echo htmlspecialchars_decode( $item->media_description ); ?>
            </div>
        <?php } ?>
    
        <?php 
        $app    = JFactory::getApplication();
        $menu   = $app->getMenu();
        $active = $menu->getActive();
        $module_position = 'webcast-room'; 
        ?>
        
        <?php if (!empty($active->id)) { ?>
            <?php 
            $module_position_html = DSCModule::renderModules( $module_position, $active->id );
            if (!empty($module_position_html))
            {
                echo $module_position_html;
            }
            ?>
        <?php } ?>
        
    </div>
    
    <div id="webcast-chatroom" class="wrap left span6 indent-20">
		&nbsp;
    </div>
    
    <div id="webcast-twitter-feed" class="wrap left span3 indent-20">
    	<?php $module_position = 'webcast-room-right'; ?>
        <?php if (!empty($active->id)) { ?>
            <?php 
            $module_position_html = DSCModule::renderModules( $module_position, $active->id );
            if (!empty($module_position_html))
            {
                echo $module_position_html;
            }
            ?>
        <?php } ?>
    </div>

</div>