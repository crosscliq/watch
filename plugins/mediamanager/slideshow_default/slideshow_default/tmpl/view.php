<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php $row = $vars->row; 

?>
<?php $div_id = "mediamanager_id_" . $row->media_id; ?>
<?php $count = $vars->db_files_count;
$params = $vars->row->params;
JHtml::_('script', 'carousel.js', 'modules/mod_featureditems_items/media/js/');
/*
$doc = JFactory::getDocument();
$view_url = JURI::getInstance()->toString();
$doc->addCustomTag( "<meta property='og:title' content='$row->media_title' />" );
$doc->addCustomTag( "<meta property='og:type' content='$row->media_group' />" );
$doc->addCustomTag( "<meta property='og:url' content='$view_url' />" );
$doc->addCustomTag( "<meta property='og:image' content='$row->media_image' />" );
if (!empty($row->media_description)) { 
    $doc->setDescription( $row->media_description );
}
*/
?>

<div class="slideshow-default mediamanager-media">

<div id="<?php echo $div_id; ?>" class="slideshow">

    <div id="<?php echo $div_id; ?>-container" class="container">
        <ul id="<?php echo $div_id; ?>-slides" class="slides">
        <?php  foreach ($vars->db_files as $key=>$item) { ?>

            <li data-slide="<?php echo $key; ?>" class="slide text-center wrap <?php if ($key == 0) { echo " first"; } if ($key == ($count-1)) { echo " last"; } ?>">
                <div class="slide-frame">
				<?php if ( !empty( $item->url ) ) { ?>
				<a class="bare" href="<?php echo $item->url; ?>" <?php if ($item->url_target == '1') { echo "target='_blank'"; } elseif ($item->url_target == '2') { echo "class='modal' rel=\"$handler\""; } ?>>
				<?php } ?>
                				
				<img class="" src="<?php echo $item->file; ?>" alt="<?php echo $row->media_title; ?>" title="<?php echo $row->media_title; ?>" />
					
				<?php if ( !empty( $item->url ) ) { ?>
				</a>
				<?php } ?>
				</div>
            </li>
        <?php } ?>
        </ul>
    </div>

    <div id="<?php echo $div_id; ?>-container-captions" class="captions-container clear">
        <ul id="<?php echo $div_id; ?>-captions" class="captions">
            <?php $n = 1;
            foreach ( $vars->db_files as $key=>$item ) { ?>
                <li class="caption detail <?php if ($key == 0) { echo " first"; } if ($key == ($count-1)) { echo " last"; } ?>">
                    <div class="caption-body"><?php echo $item->caption; ?></div>                        
                </li>
            <?php $n++; ?>
            <?php } ?>
        </ul>
    </div>


    <ul class="controls pagination small">
        <li class="control prev small" style="cursor: pointer;">Prev</li>
        <?php
        foreach ( $vars->db_files as $key=>$item ) { ?>
            <li data-slide="<?php echo $key; ?>" class="number <?php if ($key == $params->get( 'slideshow_start' )) { echo 'active'; } ?>">
                <?php $n = $key + 1; echo $n; ?>
            </li>
        <?php $n++; ?>
        <?php } ?>
        <li class="control next small" style="cursor: pointer;">Next</li>
    </ul>

    </div>

</div>

<?php if ($count > '1') { ?>
<script type="text/javascript">
Jalc.setActiveSlideshowNav = function(el) {
    jQuery('#<?php echo $div_id; ?> .number').each(function(){
        e = jQuery(this);
        e.removeClass('active')
        if (e.attr('data-slide') == el.currentPosition) {
            e.addClass('active');
        }
    });    
}

jQuery(document).ready(function() {

    
    jQuery('#<?php echo $div_id; ?>').carousel({
        transition: '<?php echo $params->get( 'slideshow_transition', 'fade' ); ?>',
        start: <?php echo $params->get( 'slideshow_start', '0' ); ?>,
        autoPlayInterval: <?php echo $params->get( 'slideshow_autoplayinterval', '6000' ); ?>,
        autoPlay: <?php echo $params->get( 'slideshow_autoplay', '0' ); ?>,
        autoPlayStopOnClick: <?php echo $params->get( 'slideshow_autoplaystoponclick', '1' ); ?>,
        hideControls: <?php echo $params->get( 'slideshow_hidecontrols', '0' ); ?>,
        insertControls: <?php echo $params->get( 'slideshow_insertcontrols', '0' ); ?>,
        loop: <?php echo $params->get( 'slideshow_loop', '1' ); ?>,
        duration: <?php echo $params->get( 'slideshow_duration', '1000' ); ?>,
        containerWidth: <?php echo $params->get( 'slideshow_container_width', '940' ); ?>,
        containerHeight: <?php echo $params->get( 'slideshow_container_height', '650' ); ?>,
        slideWidth: <?php echo $params->get( 'slideshow_slide_width', '940' ); ?>,
        slideHeight: <?php echo $params->get( 'slideshow_slide_height', '650' ); ?>,
        setSlidesCSS: 0,
        resizeImages: 0,
        onCompleteTransitionFunction: Jalc.setActiveSlideshowNav
    });

    jQuery('#<?php echo $div_id; ?> .detail').each(function(){
        e = jQuery(this);
        if (e.hasClass('active')) {
            e.fadeIn();
        }
    });

    jQuery('#<?php echo $div_id; ?> .number').bind('click', function(){
        e = jQuery(this);
        n = e.attr('data-slide')
        jQuery('#<?php echo $div_id; ?>').data('carousel').slideClick(n);
    });
 
});
</script>
<?php } ?>
