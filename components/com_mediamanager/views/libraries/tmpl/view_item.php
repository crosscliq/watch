<?php defined( '_JEXEC' ) or die( 'Restricted Access' ); ?>
<?php $item = $this->item; ?>
<?php $i = $this->i; ?>
<?php
$thumb_path = '';
if ( empty( $item->media_image ) )
{
	$thumb_path = 'media/com_mediamanager/images/noimage.png';
}
else
{
	$thumb_path = mediamanager::getURL( 'media_thumbs' ) . $item->media_id . '/' . $item->media_image;
}
$item->link = 'index.php?option=com_mediamanager&view=libraries&layout=view&task=view&id=' . $item->library_id . '&media_id=' . $item->media_id;
?>
<div id="recent_media">
	<div id="recent_thumb">
	<!-- initially set thumb width and height dimensions because of error processing thumbs -->
	<img src="<?php echo $thumb_path; ?>" width="85" height="64"/>
	</div>
	<div id="recent_description">
	<a href="<?php echo $item->link; ?>">Title: <?php echo $item->media_title; ?><br/>
	<?php
	//limited space and a paragraph of text would break layout
	echo substr( $item->media_description, 0, 50 );
	?></a><br>
	<?php $list=explode("_", strtoupper($item->media_type));
		echo $list[0];
	?>
	</div>
	<div class="clear"></div>
</div>
<?php //echo mediamanager::dump($item); ?>