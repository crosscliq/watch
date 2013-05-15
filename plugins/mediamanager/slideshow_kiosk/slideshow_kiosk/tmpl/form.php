<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php jimport('joomla.html.pane'); ?>
<?php $tabs = JPane::getInstance( 'tabs' ); ?>
<?php $row = @$vars->row; ?>

<style type="text/css">
.current-files img {
    float: none;
}
</style>

<h3><?php echo JText::_( "PLG_MEDIAMANAGER_SLIDESHOW_DEFAULT" ); ?></h3>

<?php 
// start tab pane
echo $tabs->startPane( "pane_slideshow_default" );

// Tab
echo $tabs->startPanel( JText::_( 'COM_MEDIAMANAGER_FILES' ), "panel_images");
?>
    <h2><?php echo JTEXT::_('COM_MEDIAMANAGER_ADD_NEW_FILE') ;?></h2>
    
    <div>
        <input name="add_type" type="hidden" value="" id="add_type" />
    </div>

    <div class="dsc-table">
        <div class="dsc-row">
            <div class="dsc-cell dsc-key">
                <?php echo JTEXT::_('COM_MEDIAMANAGER_ADD_NEW_LOCAL_FILE');?>
            </div>
            <div class="dsc-cell dsc-value">
    		    <?php $media = new DSCElementMedia(); ?>
    		    <?php echo $media->fetchElement( 'item_local_new', '' ); ?>
                <?php if (!empty($row->media_id)) { ?>
                    <input name="add_new_file_local" type="button" onclick="document.adminForm.add_type.value='add_new_file_local'; SlideshowKiosk.addNewFile( 'form_files', '<?php echo JText::_( "COM_MEDIAMANAGER_ADDING_FILE" ); ?>' );" value="<?php echo JText::_( "COM_MEDIAMANAGER_ADD_NEW_LOCAL_FILE" ); ?>" />
                <?php } else { ?>
                    <p class="dsc-tip dsc-clear">
                        <?php echo JText::_( "COM_MEDIAMANAGER_SELECT_FILE_THEN_CLICK_APPLY" ); ?>
                    </p>
                <?php } ?>
            </div>
        </div>
        <div class="dsc-row">
            <div class="dsc-cell dsc-key">
                <?php echo JTEXT::_('COM_MEDIAMANAGER_ADD_NEW_REMOTE_FILE');?>
            </div>
            <div class="dsc-cell dsc-value">
      		    <input name="item_remote_new" type="text" size="150" id="item_remote_new" />
      		    <?php if (!empty($row->media_id)) { ?>
                    <input name="add_new_file" type="button" onclick="document.adminForm.add_type.value='add_new_file'; SlideshowKiosk.addNewFile( 'form_files', '<?php echo JText::_( "COM_MEDIAMANAGER_ADDING_FILE" ); ?>' );" value="<?php echo JText::_( "COM_MEDIAMANAGER_ADD_NEW_REMOTE_FILE" ); ?>" />
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
    				
          		    <input name="add_existing_file" type="button" onclick="document.adminForm.add_type.value='add_existing_file'; SlideshowKiosk.addNewFile( 'form_files', '<?php echo JText::_( "COM_MEDIAMANAGER_ADDING_FILE" ); ?>' );" value="<?php echo JText::_( "COM_MEDIAMANAGER_ADD_EXISTING_FILE" ); ?>" />
                
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
echo $tabs->startPanel( JText::_( 'General Settings' ), "panel_generalsettings");
?>
    <table class="admintable">
        <tr>
            <td class="key">
                <?php echo JText::_( 'COM_MEDIAMANAGER_INCLUDE_JQUERY' ); ?>:
            </td>
            <td>
                <?php echo MediaManagerSelect::booleanlist( @$row->params->get('slideshowdefault_include_jquery', $vars->params->get( 'slideshowdefault_include_jquery', '1' ) ), 'slideshowdefault_include_jquery' ); ?>
                <p class="dsc-tip dsc-clear">
                    <?php echo JText::_( 'COM_MEDIAMANAGER_INCLUDE_JQUERY_TIP' ); ?>
                </p>
            </td>
        </tr>
        <tr>
            <td class="key">
                <?php echo JText::_( 'COM_MEDIAMANAGER_SHOW_CAPTIONS' ); ?>:
            </td>
            <td>
                <?php echo MediaManagerSelect::booleanlist( @$row->params->get('slideshowdefault_show_caption', $vars->params->get( 'slideshowdefault_show_caption' ) ), 'slideshowdefault_show_caption' ); ?>
            </td>
        </tr>
        <tr>
            <td class="key">
                <?php echo JText::_( 'COM_MEDIAMANAGER_AUTOPLAY' ); ?>:
            </td>
            <td>
                <?php echo MediaManagerSelect::booleanlist( @$row->params->get('slideshowdefault_autoplay', $vars->params->get( 'slideshowdefault_autoplay', '1' )), 'slideshowdefault_autoplay' ); ?>
            </td>
        </tr>
        <tr>
            <td class="key">
                <?php echo JText::_( 'COM_MEDIAMANAGER_AUTOPLAY_DELAY' ); ?>:
            </td>
            <td>
                <input name="slideshowdefault_auto_play_delay" value="<?php echo @$row->params->get('slideshowdefault_auto_play_delay', $vars->params->get( 'slideshowdefault_auto_play_delay', '5000' )); ?>" size="20" maxlength="4" type="text" />
            </td>
        </tr>
        <tr>
            <td class="key">
                <?php echo JText::_( 'COM_MEDIAMANAGER_SHOW_CONTROLS' ); ?>:
            </td>
            <td>
                <?php echo MediaManagerSelect::booleanlist( @$row->params->get('slideshowdefault_show_controls', $vars->params->get( 'slideshowdefault_show_controls' ) ), 'slideshowdefault_show_controls' ); ?>
            </td>
        </tr>
        <tr>
            <td class="key">
                <?php echo JText::_( 'COM_MEDIAMANAGER_SLIDE_WIDTH' ); ?>:
            </td>
            <td>
                <input name="slideshowdefault_slide_width" value="<?php echo @$row->params->get('slideshowdefault_slide_width', $vars->params->get( 'slideshowdefault_slide_width', '640' )); ?>" size="20" maxlength="4" type="text" />
                <p class="dsc-tip dsc-clear">
                    <?php echo JText::_( 'COM_MEDIAMANAGER_SLIDE_WIDTH_TIP' ); ?>
                </p>
            </td>
        </tr>
        <tr>
            <td class="key">
                <?php echo JText::_( 'COM_MEDIAMANAGER_SLIDE_HEIGHT' ); ?>:
            </td>
            <td>
                <input name="slideshowdefault_slide_height" value="<?php echo @$row->params->get('slideshowdefault_slide_height', $vars->params->get( 'slideshowdefault_slide_height', '640' )); ?>" size="20" maxlength="4" type="text" />
                <p class="dsc-tip dsc-clear">
                    <?php echo JText::_( 'COM_MEDIAMANAGER_SLIDE_HEIGHT_TIP' ); ?>
                </p>
            </td>
        </tr>
        <tr>
            <td class="key">
                <?php echo JText::_( 'COM_MEDIAMANAGER_CONTAINER_WIDTH' ); ?>:
            </td>
            <td>
                <input name="slideshowdefault_container_width" value="<?php echo @$row->params->get('slideshowdefault_container_width', $vars->params->get( 'slideshowdefault_container_width', '640' )); ?>" size="20" maxlength="4" type="text" />
                <p class="dsc-tip dsc-clear">
                    <?php echo JText::_( 'COM_MEDIAMANAGER_CONTAINER_WIDTH_TIP' ); ?>
                </p>
            </td>
        </tr>
        <tr>
            <td class="key">
                <?php echo JText::_( 'COM_MEDIAMANAGER_CONTAINER_HEIGHT' ); ?>:
            </td>
            <td>
                <input name="slideshowdefault_container_height" value="<?php echo @$row->params->get('slideshowdefault_container_height', $vars->params->get( 'slideshowdefault_container_height', '640' )); ?>" size="20" maxlength="4" type="text" />
                <p class="dsc-tip dsc-clear">
                    <?php echo JText::_( 'COM_MEDIAMANAGER_CONTAINER_HEIGHT_TIP' ); ?>
                </p>
            </td>
        </tr>
        <tr>
            <td class="key">
                <?php echo JText::_( 'COM_MEDIAMANAGER_LOOP' ); ?>:
            </td>
            <td>
                <?php echo MediaManagerSelect::booleanlist( @$row->params->get('slideshowdefault_loop', $vars->params->get( 'slideshowdefault_loop', '1' ) ), 'slideshowdefault_loop' ); ?>
            </td>
        </tr>        
        <tr>
            <td class="key">
                <?php echo JText::_( 'COM_MEDIAMANAGER_TRANSITION_SPEED' ); ?>:
            </td>
            <td>
                <input name="slideshowdefault_speed" value="<?php echo @$row->params->get('slideshowdefault_speed', $vars->params->get( 'slideshowdefault_speed', '1000' )); ?>" size="20" maxlength="4" type="text" />
            </td>
        </tr>
        
        
    </table>
<?php 
echo $tabs->endPanel();

echo $tabs->endPane();
?>

<script type="text/javascript">
  window.addEvent('domready', function(){
      new MultiUpload( jQuery( 'adminForm' ).item_local_new, 0, '[{id}]', false, true );
  });
</script>
