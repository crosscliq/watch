<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php $row = @$vars->row; ?>
<?php $div_id = "mediamanager_id_" . $row->media_id; ?>
<?php
JHTML::_('stylesheet', 'component.css', 'media/com_mediamanager/css/');
/*
$doc = JFactory::getDocument( );
$view_url = JURI::getInstance()->toString();
$doc->addCustomTag( "<meta property='og:title' content='$row->media_title_long' />" );
$doc->addCustomTag( "<meta property='og:type' content='$row->media_group' />" );
$doc->addCustomTag( "<meta property='og:url' content='$view_url' />" );
$doc->addCustomTag( "<meta property='og:image' content='$vars->image' />" );
if (!empty($row->media_description)) { 
    $doc->setDescription( $row->media_description );
}
*/
?>

<?php if (!empty($vars->db_files)) { ?>
    <div id="<?php echo $div_id; ?>-wrap" class="video video_jwplayer">
    <div id="<?php echo $div_id; ?>"></div>
    
    <?php JHTML::_( 'script', 'jwplayer.js', 'plugins/mediamanager/' . $vars->path_prefix . $vars->element . '/js/' ); ?>

    <script type="text/javascript">
      jwplayer('<?php echo $div_id; ?>').setup({
        'id': '<?php echo $div_id; ?>-video',
        'width': '<?php echo $vars->width; ?>',
        'height': '<?php echo $vars->height; ?>',
        <?php 
        if ($vars->db_files_count > 1) { 
            ?>
            playlist: [
                <?php 
                foreach ($vars->db_files as $key=>$file) 
                {
                    if ($key > 0) { echo ","; }
                    ?>
                    {
                        'file': '<?php echo $vars->db_files[$key]->file; ?>',
                        'title': '<?php echo $vars->db_files[$key]->caption; ?>',
                        'image': '<?php echo $vars->image; ?>',
                    }
                    <?php            
                } 
                ?>
            ],
            'playlist.position': 'right',
            'playlist.size': '300',
            <?php 
        } else {
            ?>
            'file': '<?php echo $vars->db_files[0]->file; ?>',
            <?php 
        } 
        ?>
        <?php
        if (!empty($vars->image)) {
            ?>
            'image': '<?php echo $vars->image; ?>',
            <?php        
        }
        ?>
        'skin': '<?php echo JURI::root() . $vars->relative_path; ?>/skins/slim/slim.zip',
        'controlbar': '<?php echo $vars->row->params->get( 'videojwplayer_controlbar_position', 'over' ); ?>',
        'autostart': '<?php echo $vars->row->params->get( 'videojwplayer_auto_play', '0' ) ? 'true' : 'false'; ?>',
        'icons': '<?php echo $vars->row->params->get( 'videojwplayer_show_icons', '1' ) ? 'true' : 'false'; ?>',
        'bufferlength': '<?php echo $vars->row->params->get( 'videojwplayer_buffer_length', '1' ); ?>',
        'repeat': 'list',
        'modes': [
            {type: 'html5'},
            {type: 'flash', src: '<?php echo JURI::root() . $vars->relative_path; ?>/swf/player.swf'}
        ],
        events: {
            onBeforePlay: function() {
                jQuery('.video_jwplayer object').each(function(){
                    element = jQuery(this);
                    if (element.attr('id') != '<?php echo $div_id; ?>') {
                        jwplayer(element.attr('id')).stop();                        
                    }
                });
            }
           }
      });
    </script>
    
    </div>
<?php } ?>

