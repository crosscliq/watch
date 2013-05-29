<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php jimport('joomla.html.pane'); ?>
<?php $tabs = JPane::getInstance( 'tabs' ); ?>
<?php $row = @$vars->row; ?>

<style type="text/css">
.current-files img {
    float: none;
}
</style>

<h3><?php echo JText::_( "PLG_MEDIAMANAGER_VIDEO_JWPLAYER" ); ?></h3>

<?php 
// start tab pane
echo $tabs->startPane( "pane_video_jwplayer" );

// Tab
echo $tabs->startPanel( JText::_( 'COM_MEDIAMANAGER_FILES' ), "panel_files");
?>

    <h2><?php echo JTEXT::_('COM_MEDIAMANAGER_ADD_NEW_FILE') ;?></h2>
    
    <div>
        <input name="add_type" type="hidden" value="" id="add_type" />
    </div>

    <div class="dsc-table">
        <div class="dsc-row">
            <div class="dsc-cell dsc-key">
                <?php echo JTEXT::_('COM_MEDIAMANAGER_ADD_NEW_REMOTE_FILE');?>
            </div>
            <div class="dsc-cell dsc-value">
                <input name="item_remote_new" type="text" size="150" id="item_remote_new" />
                <?php if (!empty($row->media_id)) { ?>
                    <input name="add_new_file" type="button" onclick="document.adminForm.add_type.value='add_new_file'; VideoJwplayer.addNewFile( 'form_files', '<?php echo JText::_( "COM_MEDIAMANAGER_ADDING_FILE" ); ?>' );" value="<?php echo JText::_( "COM_MEDIAMANAGER_ADD_NEW_REMOTE_FILE" ); ?>" />
                <?php } else { ?>
                    <p class="dsc-tip dsc-clear">
                        <?php echo JText::_( "COM_MEDIAMANAGER_PROVIDE_FULL_URL_TO_FILE_THEN_CLICK_APPLY" ); ?>
                    </p>
                <?php } ?>
            </div>
        </div>
        <div class="dsc-row">
            <div class="dsc-cell dsc-key">
                <?php echo JTEXT::_('COM_MEDIAMANAGER_ADD_AN_EXISTING_FILE_MANAGED_BY_MM');?>
            </div>
            <div class="dsc-cell dsc-value">
                <?php if (!empty($row->media_id)) { ?>
            
                    <?php   
                    JModel::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/models' );
                    $model = JModel::getInstance( 'ElementFile', 'MediaManagerModel' );
                    echo $model->fetchElement( 'item_existing_new', '' );
                    echo $model->clearElement( 'item_existing_new', '0' );
                    ?>
                    
                    <input name="add_existing_file" type="button" onclick="document.adminForm.add_type.value='add_existing_file'; VideoJwplayer.addNewFile( 'form_files', '<?php echo JText::_( "COM_MEDIAMANAGER_ADDING_FILE" ); ?>' );" value="<?php echo JText::_( "COM_MEDIAMANAGER_ADD_EXISTING_FILE" ); ?>" />
                
                <?php } else { ?>
                    <p class="dsc-tip dsc-clear">
                        <?php echo JText::_( "COM_MEDIAMANAGER_CLICK_APPLY_TO_ADD_EXISTING_FILES" ); ?>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <?php if (!empty($vars->list)) { ?>
    
    <h2><?php echo JTEXT::_('COM_MEDIAMANAGER_CURRENT_FILES') ;?></h2>

    <div id="form_files">
        <?php include 'form_files.php'; ?>
    </div>

    <?php } ?>

<?php 
echo $tabs->endPanel();

// Tab
echo $tabs->startPanel( JText::_( 'COM_MEDIAMANAGER_DISPLAY_SETTINGS' ), "panel_displaysettings");
?>

    <div class="dsc-table">
        <div class="dsc-row">
            <div class="dsc-cell dsc-key">
                <?php echo JText::_( 'COM_MEDIAMANAGER_WIDTH' ); ?>:
            </div>
            <div class="dsc-cell dsc-value">
                <input name="videojwplayer_width" value="<?php echo @$row->params->get('videojwplayer_width', $vars->params->get( 'videojwplayer_width' )); ?>" size="20" maxlength="4" type="text" />
                <p class="dsc-clear dsc-tip">
                    <?php echo JText::_( 'COM_MEDIAMANAGER_LEAVE_BLANK_TO_USE_DEFAULT_FROM_CONFIGURATION' ); ?>
                </p>
            </div>
        </div>
        <div class="dsc-row">
            <div class="dsc-cell dsc-key">
                <?php echo JText::_( 'COM_MEDIAMANAGER_HEIGHT' ); ?>:
            </div>
            <div class="dsc-cell dsc-value">
                <input name="videojwplayer_height" value="<?php echo @$row->params->get('videojwplayer_height', $vars->params->get( 'videojwplayer_height' )); ?>" size="20" maxlength="4" type="text" />
                <p class="dsc-clear dsc-tip">
                    <?php echo JText::_( 'COM_MEDIAMANAGER_LEAVE_BLANK_TO_USE_DEFAULT_FROM_CONFIGURATION' ); ?>
                </p>
            </div>
        </div>
        <div class="dsc-row">
            <div class="dsc-cell dsc-key">
                <?php echo JText::_( 'COM_MEDIAMANAGER_AUTOPLAY' ); ?>?
            </div>
            <div class="dsc-cell dsc-value">
                <?php echo MediaManagerSelect::booleanlist( @$row->params->get('videojwplayer_auto_play', $vars->params->get( 'videojwplayer_auto_play' )), 'videojwplayer_auto_play' ); ?>
            </div>
        </div>
        <div class="dsc-row">
            <div class="dsc-cell dsc-key">
                <?php echo JText::_( 'PLG_MEDIAMANAGER_VIDEO_JWPLAYER_BUFFER_LENGTH' ); ?>:
            </div>
            <div class="dsc-cell dsc-value">
                <input name="videojwplayer_buffer_length" value="<?php echo @$row->params->get('videojwplayer_buffer_length', $vars->params->get( 'videojwplayer_buffer_length' )); ?>" size="20" maxlength="4" type="text" />
            </div>
        </div>
        <div class="dsc-row">
            <div class="dsc-cell dsc-key">
                <?php echo JText::_( 'PLG_MEDIAMANAGER_VIDEO_JWPLAYER_CONTROLBAR_POSITION' ); ?>?
            </div>
            <div class="dsc-cell dsc-value">
                <?php echo MediaManagerSelectVideoJwplayer::controlbar_position( @$row->params->get('videojwplayer_controlbar_position', $vars->params->get( 'videojwplayer_controlbar_position' )), 'videojwplayer_controlbar_position' ); ?>
            </div>
        </div>
        
        <div class="dsc-row">
            <div class="dsc-cell dsc-key">
                <?php echo JText::_( 'PLG_MEDIAMANAGER_VIDEO_JWPLAYER_DISPLAY_PLAY_BUFFERING_ICONS' ); ?>?
            </div>
            <div class="dsc-cell dsc-value">
                <?php echo MediaManagerSelect::booleanlist( @$row->params->get('videojwplayer_show_icons', $vars->params->get( 'videojwplayer_show_icons' )), 'videojwplayer_show_icons' ); ?>
            </div>
        </div>
        
        <div class="dsc-row">
            <div class="dsc-cell dsc-key">
                <?php echo JText::_( 'PLG_MEDIAMANAGER_VIDEO_JWPLAYER_LOOP_VIDEO' ); ?>?
            </div>
            <div class="dsc-cell dsc-value">
                <?php echo MediaManagerSelect::video_loop( @$row->params->get('videojwplayer_loop', $vars->params->get( 'videojwplayer_loop' )), 'videojwplayer_loop' ); ?>
            </div>
        </div>

    </div>

<?php 
echo $tabs->endPanel();

echo $tabs->endPane();
?>
