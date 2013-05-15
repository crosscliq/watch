<?php defined('_JEXEC') or die('Restricted access'); ?>

    <table class="adminlist current-files">
    <thead>
        <tr>
            <th class="key" style="text-align: left;">
              <?php echo JTEXT::_('COM_MEDIAMANAGER_URL') ; ?> + 
              <?php echo JTEXT::_('COM_MEDIAMANAGER_CAPTION');?>
            </th>
            <th class="key" style="text-align: center;">
                <?php echo JTEXT::_('COM_MEDIAMANAGER_ORDERING'); ?>
            </th>
            <th class="key" style="text-align: center;">
                <?php echo JTEXT::_('COM_MEDIAMANAGER_ENABLED'); ?>?
            </th>
            <th class="key" style="text-align: center;">
                <?php echo JTEXT::_('COM_MEDIAMANAGER_DELETE'); ?>?
            </th>
            <th class="key" style="text-align: center;">
                <?php echo JTEXT::_('COM_MEDIAMANAGER_FILE_ID') ;?>
            </th>
            <th class="key" style="text-align: center;">
                <?php echo JTEXT::_('COM_MEDIAMANAGER_MEDIAFILE_ID') ;?>
            </th>
        </tr>
    </thead>
    <tbody> 
        <?php 
        $i=0;
        foreach ($vars->list as $item) : 
        ?>
        <tr>
            <td>
                <div class="dsc-table">
                    <div class="dsc-row">
                        <div class="dsc-cell">
                            <?php echo JTEXT::_('COM_MEDIAMANAGER_URL'); ?>:
                        </div>
                        <div class="dsc-cell">
                            <?php if (!empty($item->file_url)) {
                                echo $item->file_url;
                            } elseif (!empty($item->file_path)) {
                                echo $item->file_path . $item->file_name;
                            } ?>
                        </div>
                    </div>
                    <div class="dsc-row">
                        <div class="dsc-cell">
                            <?php echo JTEXT::_('COM_MEDIAMANAGER_CAPTION'); ?>:
                        </div>
                        <div class="dsc-cell">
                            <input type="text" name="caption[<?php echo $item->mediafile_id; ?>]" value="<?php echo $item->caption; ?>" size="70" />
                        </div>
                    </div>
                </div>
            </td>
            <td style="text-align: center;">
                <input type="text" name="ordering[<?php echo $item->mediafile_id; ?>]" value="<?php echo $item->ordering; ?>" size="5" />
            </td>
            <td style="text-align: center;">
                <?php echo MediaManagerSelect::booleanlist( $item->enabled, 'enabled['.$item->mediafile_id.']' );?>
            </td>
            <td style="text-align: center;">
                <input type="button" onclick="VideoJplayer.deleteFile( '<?php echo $item->mediafile_id; ?>', 'form_files', '<?php echo JText::_( "COM_MEDIAMANAGER_DELETING" ); ?>' );" value="<?php echo JText::_( "COM_MEDIAMANAGER_DELETE" ); ?>" >
            </td>
            <td style="text-align: center;">
                <?php echo $item->file_id; ?>
            </td>
            <td style="text-align: center;">
                <?php echo $item->mediafile_id; ?>
                <input type="hidden" name="mediafile_ids[]" value="<?php echo $item->mediafile_id; ?>" />
            </td>
        </tr>
        <?php 
        $i ++;
        endforeach;?>
    </tbody>
    </table>