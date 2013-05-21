<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php $row = $vars->row; ?>
<?php $div_id = "mediamanager_id_" . $row->media_id; ?>
<?php $count = $vars->db_files_count;
$params = $vars->row->params;

JHtml::_('script', 'jquery.jcarousel.min.js', 'plugins/mediamanager/' . $vars->path_prefix . $vars->element . '/js/');
JHtml::_('script', 'jquery.pikachoose.full.js', 'plugins/mediamanager/' . $vars->path_prefix . $vars->element . '/js/');

?>

<div class="slideshow-pikachoose mediamanager-media">

<div id="<?php echo $div_id; ?>" class="slideshow-container">

    <div id="<?php echo $div_id; ?>-container" class="container">
    
        <ul id="<?php echo $div_id; ?>-slides" class="slides images-list">
        <?php foreach ($vars->db_files as $key=>$item) { ?>

            <li data-slide="<?php echo $key; ?>" class="slide image text-center wrap <?php if ($key == 0) { echo " first"; } if ($key == ($count-1)) { echo " last"; } ?>">
                <div class="slide-frame frame">
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

</div>

<?php if ($count > 1) { ?>
<script type="text/javascript">
jQuery(document).ready(function () {
    jQuery("#<?php echo $div_id; ?>-slides").PikaChoose({
        text: { play: "", stop: "", previous: "&lt; Previous", next: "Next &gt;", loading: "Loading" },
        showCaption:false
    });
});
</script>
<?php } ?>