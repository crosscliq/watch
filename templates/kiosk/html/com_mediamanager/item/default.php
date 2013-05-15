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

            <?php echo $this->loadTemplate( $item->media_group ); ?>
</div>




</div>