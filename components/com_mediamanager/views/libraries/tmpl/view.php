<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php
$items = @$this->items;
$itemid_string = (!empty($this->item_id)) ? "&Itemid=" . $this->item_id : '';
?>

<div id="multimedia-content" class="wrap library-view">

    <h2 class="content-title events-date-range left">
        <?php if (!empty($this->helper_state['tag_id'])) { echo JText::_( "Tag" ) . ": " . $this->tag->tag_title; } ?>
    </h2>

    <?php if (!empty($this->pagination) && $this->pagination->get('pages.total') == '1') { ?> 
    <?php } elseif (!empty($this->pagination)) { ?>
        <?php echo $this->pagination->getPagesLinks( ); ?>
    <?php } ?>
    
    <?php if (!empty($items)) { ?>
    
    <ul id="multimedia-list" class="multimedia wrap clear list">
        <?php foreach ($items as $key=>$item) { ?>
        <?php 
            $item->link_view = "index.php?option=com_mediamanager&view=item&id=" . $item->media_id . $itemid_string;
            $item->types = explode('_', $item->media_type);
        ?>
            
        <li class="wrap media-instance instance table full">
            
            <div class="image-frame inner cell small <?php if (empty($item->media_image)) { ?>no-image<?php } ?>">
                <a href="<?php echo JRoute::_( $item->link_view ); ?>" class="bare wrap relative block">
            	<?php if (!empty($item->media_image)) { ?>            	
                <img class="small" src="<?php echo $item->media_image; ?>" alt="<?php echo htmlspecialchars( strip_tags( $item->media_title ) ); ?>" title="<?php echo htmlspecialchars( strip_tags( $item->media_title ) ); ?>" />
                <?php } ?>
                <span class="overlay overlay-<?php echo @$item->media_group; ?>"></span>
                </a>
            </div>
            
            <div class="instance-data inner wrap cell">
                <a href="<?php echo JRoute::_( $item->link_view ); ?>" class="bare wrap left">
                    <div class="overview left">
                        <h5><?php echo ucwords( $item->media_group ); ?></h5>
                        <h3><?php echo $item->media_title; ?></h3>
                    </div>
                </a>
                
                <div class="actions wrap right">
                    <div class="actionbutton button h5">
                        <a href="<?php echo JRoute::_( $item->link_view ); ?>" class="wrap">
                            <?php
                            switch ($item->media_group) {
                                case "video":
                                    echo JText::_( "Watch" );
                                    break;
                                case "audio":
                                    echo JText::_( "Listen" );
                                    break;
                                default:
                                    echo JText::_( "View" );
                                    break;
                            } 
                            ?>
                        </a>
                    </div>
                    <div class="user-actions right clear">
                        <?php
                            /*
                            $favsHelper = new MediamanagerHelperFavorites();
                            if ($favsHelper->isInstalled())
                            {
                                echo $favsHelper->getForm( $item->media_id, $item->media_title );
                            } 
                            */                               
                        ?>
                    </div>
                </div>
            </div>
            
            
            
        </li>
        <?php } ?>

    </ul>
    
    <?php } else if (empty($items)) { ?>
    <p>
        No items found that match your search
    </p>
    <?php } ?>

    <?php if (!empty($this->pagination)) { ?>
        <?php echo $this->pagination->getPagesLinks( ); ?>
    <?php } ?>    

</div>