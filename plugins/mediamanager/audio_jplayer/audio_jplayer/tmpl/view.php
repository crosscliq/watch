<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php $row = @$vars->row; ?>
<?php $div_id = trim( "mediamanager_id_" . $row->media_id ); ?>
<?php
$extensions = array();
/*
$doc = JFactory::getDocument( );
$view_url = JURI::getInstance()->toString();
$doc->addCustomTag( '<meta property="og:title" content="' . strip_tags( htmlspecialchars_decode( $row->media_title_long ) ) . '" />' );
$doc->addCustomTag( "<meta property='og:type' content='$row->media_group' />" );
$doc->addCustomTag( "<meta property='og:url' content='$view_url' />" );
$doc->addCustomTag( "<meta property='og:image' content='$row->media_image' />" );
if (!empty($row->media_description)) { 
    $doc->setDescription( strip_tags( htmlspecialchars( $row->media_description ) ) );
}
*/
?>

<div id="<?php echo $div_id; ?>-wrap" class="audio audio_jplayer">

<?php if (!empty($vars->db_files)) { ?>
    
    <?php JHTML::_( 'script', 'jquery.jplayer.min.js', 'plugins/mediamanager/' . $vars->path_prefix . $vars->element . '/js/' ); ?>
    <?php JHTML::_( 'script', 'jplayer.playlist.min.js', 'plugins/mediamanager/' . $vars->path_prefix . $vars->element . '/js/' ); ?>
    
    <script type="text/javascript">
    jQuery(document).ready(function(){
        var myPlaylist = new jPlayerPlaylist({
            jPlayer: "#jquery_jplayer_<?php echo $div_id; ?>",
            cssSelectorAncestor: "#jp_container_<?php echo $div_id; ?>"
        }, 
        [
            <?php 
            foreach ($vars->db_files as $key=>$file) 
            {
                if (!in_array(trim($file->file_extension), $extensions)) {
                    $extensions[] = trim($file->file_extension);
                } 
                if ($key > 0) { echo ","; } 
                ?>
                {
                    <?php echo trim($file->file_extension); ?>: '<?php echo trim($file->file); ?>',
                    title: '<?php echo $file->caption ? htmlspecialchars( $file->caption, ENT_QUOTES ) : htmlspecialchars( $row->media_title, ENT_QUOTES ); ?>'
                }
                <?php 
            } 
            ?>
        ], 
        {
            playlistOptions: {
                enableRemoveControls: false
            },
            swfPath: "<?php echo JURI::root(); ?>plugins/mediamanager/<?php echo $vars->path_prefix . $vars->element; ?>/swf",
            supplied: "<?php echo implode(",", $extensions) ?>",
            solution: "flash",
            wmode: "window"
        });

    });
    </script>

    
            <div id="jquery_jplayer_<?php echo $div_id; ?>" class="jp-jplayer"></div>

            <div id="jp_container_<?php echo $div_id; ?>" class="jp-audio">
                <div class="jp-type-single wrap">
                    <div class="jp-gui jp-interface">
                        <ul class="jp-controls">
                            <li class="play"><a href="javascript:;" class="jp-play jp-audio-play" tabindex="1">play</a></li>
                            <li class="pause"><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                            <li class="stop"><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
                            <li class="mute"><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                            <li class="unmute"><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                            <li class="max-volume"><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
                        </ul>

                        <div class="jp-volume-bar">
                            <div class="jp-volume-bar-value"></div>
                        </div>
                        
                        <div class="jp-time-holder left">
                            <div class="table full">
                                <div class="jp-current-time time cell"></div>
                                <div class="jp-progress cell">
                                    <div class="jp-seek-bar">
                                        <div class="jp-play-bar"></div>
                                    </div>
                                </div>
                                <div class="jp-duration time cell"></div>
                            </div>
                            
                            <ul class="jp-toggles">
                                <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
                                <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="jp-playlist">

		                <div class="meta-header h4 purple light-purple-bg">
		                    Tracks
		                </div>
                    
                        <ul>
                            <li></li>
                        </ul>
                    </div>
                                        
                    <div class="jp-no-solution">
                        <span>Update Required</span> To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                    </div>
                </div>
            </div>

    <?php } ?>

</div>