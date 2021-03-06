<?php defined('_JEXEC') or die('Restricted access');
$state = @$this->state;
$items = @$this->items;
$item = @$this->featured_item;
$this->row = @$this->featured_item;
$library = @$this->library;

$item_id = (!empty($this->item_id)) ? $this->item_id : JRequest::getInt( 'Itemid' );
$itemid_string = '&library_id=' . $library->library_id;
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
                                <?php /* ?><div class="addthis_toolbox" addthis:url="<?php echo JRoute::_( "index.php?option=com_mediamanager&view=libraries&task=view&reset=1" . $itemid_string ); ?>"> */ ?>
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
                                <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
                                <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-503d11b4393f1d4b"></script>
                                <!-- AddThis Button END -->                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<h1 class="content-title event-title page-title">
    <?php echo $library->library_title; ?>
    <div class="small italic">
        <?php echo $item->media_title_long ? $item->media_title_long : $item->media_title; ?>
    </div>
</h1>

<div id="media-template-wrapper" class="item-wrapper wrap">
    <?php if (!empty($item->media_group)) { echo $this->loadTemplate( $item->media_group ); } ?>
</div>

</div>