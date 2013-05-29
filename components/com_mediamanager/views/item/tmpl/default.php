<?php defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('stylesheet', 'component.css', 'media/com_mediamanager/css/');
$item = @$this->row;
$helper = new MediaManagerHelperMedia();
$this->state = $helper->getState();
$surrounding = @$this->surrounding;

$item_id = (!empty($this->item_id)) ? $this->item_id : JRequest::getInt( 'Itemid' );
$itemid_string = '';
if ($item_id) {
    $itemid_string = '&Itemid=' . $item_id;
}

?>
<div id="mediamanager-content" class="media-detail detail-page detail-page-<?php echo $item->media_group; ?>">

            <div class="user-actions right clear wrap">
                <div id="share-button-wrapper" class="wrap left">
                    <div id="event-share-button" class="share-button wrap medium-grey-bg">
                        <div class="h4">
                            Share
                            <img class="arrow-down" src="<?php echo JURI::root(); ?>templates/default/images/arrow-down.png" alt="&#9660;">
                        
                            <div class="share-options wrap" style="display: none;">
                                <!-- AddThis Button BEGIN -->
                                <?php /* ?><div class="addthis_toolbox" addthis:url="<?php echo JRoute::_( "index.php?option=com_mediamanager&view=item&id=" . $item->media_id . $itemid_string ); ?>"> */ ?>
                                <div class="addthis_toolbox">
                                    <ul class="networks">
                                        <li class="wrap fb">
                                            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                                        </li>
                                        <li class="wrap twitter">
                                            <a class="addthis_button_tweet"></a>
                                        </li>
                                    </ul>
    
                                    <ul class="manual">
                                        <li class="wrap email">
                                            <a class="addthis_button_email">
                                                <img class="left" src="templates/default/images/Email.png" alt="Share via Email" />
                                                <span class="h5 left">E-Mail</span>
                                            </a>
                                        </li>
                                        <?php /* ?>
                                        <li class="wrap clip">
                                        <div class="copy-clipboard">
                                        <img class="left " src="templates/default/images/CopyLink.png" alt="Copy Link" />
                                            <span class="h5 left">
                                                Copy Link
                                            </span>
                                        </div>
                                        </li>
                                        */ ?>
                                    </ul>
    
                                </div>
                                <script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
                                <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-503d11b4393f1d4b"></script>
                                <!-- AddThis Button END -->                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<h1 class="content-title event-title page-title">
    <?php echo htmlspecialchars_decode( $item->media_title_long ? $item->media_title_long : $item->media_title ); ?>
</h1>

<div id="media-template-wrapper" class="item-wrapper wrap">
    <?php echo $this->loadTemplate( $item->media_group ); ?>
</div>

<div id="media-view-navigation" class="wrap full item-navigation">
    <div class="controls left">
        <div class="control back">
            <?php if (!empty($this->state['library_id'])) { ?>
                <?php $back_url = "index.php?option=com_mediamanager&view=libraries&task=view" . $itemid_string; ?>
                <?php if (!empty($this->state['tag_id'])) { ?>
                    <?php $back_url .= "&tag_id=" . $this->state['tag_id']; ?> 
                <?php } ?>
                
                <a class="bare" href="<?php echo JRoute::_( $back_url ); ?>">
                    Back to Results
                </a>
                
            <?php } ?>
        </div>
    </div>

    <ul class="right table controls">
        <li class="cell control medium prev<?php if (empty($surrounding['prev'])) { echo '-null'; } ?>">
            <?php if (!empty($surrounding['prev'])) { ?>
		    <a class="bare" href="<?php echo JRoute::_( "index.php?option=com_mediamanager&view=item&id=" . $surrounding['prev'] . $itemid_string ); ?>">
		        <?php echo JText::_( "Prev" ); ?>
		    </a>
		    <?php } ?>
        </li>

        <li class="cell control medium next<?php if (empty($surrounding['next'])) { echo '-null'; } ?>">
            <?php if (!empty($surrounding['next'])) { ?>
		    <a class="bare" href="<?php echo JRoute::_( "index.php?option=com_mediamanager&view=item&id=" . $surrounding['next'] . $itemid_string ); ?>">
		        <?php echo JText::_( "Next" ); ?>
		    </a>
		    <?php } ?>
        </li>
    </ul>
</div>


<?php /* if (!empty($this->related_items)) { ?>
<h3 class="list-title">Related multimedia</h3>
<ul class="horiz features small">
    <?php foreach ($this->related_items as $ri) { ?>
    <?php $ri->types = explode('_', $ri->media_type); ?>
    <li>
        <a href="<?php echo JRoute::_( "index.php?option=com_mediamanager&view=media&id=" . $ri->media_id . "&library_id=" . @$this->state['library_id'] ); ?>">
            <div class="feature-info">
                <h4><?php echo JText::_( ucwords( @$ri->types[0] ) ); ?></h4>
                <p class="date"><?php echo JText::_( 'Date added' ) . ": " . date('M j', strtotime( $ri->date_added ) ); ?></p>
                <p><?php echo $ri->media_title; ?></p>
            </div>
            <img src="<?php echo $ri->media_image_remote; ?>" alt="<?php echo $ri->media_title; ?>" width="239" height="134">
            <span class="opacity"></span>
            <span class="media <?php echo @$ri->types[0]; ?>"></span>
        </a>
    </li>
    <?php } ?>
</ul>
<?php } */ ?>

</div>