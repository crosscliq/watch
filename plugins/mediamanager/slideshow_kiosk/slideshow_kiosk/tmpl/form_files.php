<?php defined('_JEXEC') or die('Restricted access'); ?>

    <table class="adminlist current-files">
    <thead>
        <tr>
    		<th class="key" style="text-align: center; max-width: 100px; width: 100px;">
    		    <?php echo JTEXT::_('COM_MEDIAMANAGER_IMAGE') ;?>
    		</th>
            <th class="key" style="text-align: left;">
              <?php echo JTEXT::_('COM_MEDIAMANAGER_URL') ; ?> + 
              <?php echo JTEXT::_('COM_MEDIAMANAGER_CAPTION');?>
            </th>
            <th class="key" style="text-align: center;">
                <?php echo JTEXT::_('COM_MEDIAMANAGER_PUBLICATION_DATES'); ?>
            </th>
            <th class="key" style="text-align: center;">
                <?php echo JTEXT::_('COM_MEDIAMANAGER_OPEN_URL_IN'); ?>:
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
    		<td style="text-align: center;">
                <?php if (!empty($item->file_url)) { ?>
                    <img src="<?php echo $item->file_url; ?>" style="max-width: 85px; max-height: 60px;" />
                    <br/>
                    <?php echo $item->file_url; ?>
                <?php } else { ?>
        			<img src="<?php echo MediaManager::getURL('siteImages') . $vars->row->media_id.'/thumbs/'.$item->file_name; ?>" style="max-width: 85px; max-height: 60px;" />
        			<br/>
                    <?php echo $item->file_name; ?>
                <?php } ?>
    		</td>
            <td>
                <div class="dsc-table">
                    <div class="dsc-row">
                        <div class="dsc-cell" style="vertical-align: top;">
                            <?php echo JTEXT::_('COM_MEDIAMANAGER_URL'); ?>:
                        </div>
                        <div class="dsc-cell">
                            <input type="text" name="url[<?php echo $item->mediafile_id; ?>]" value="<?php echo $item->url;?>" size="70" />
                        </div>
                    </div>
                    <div class="dsc-row">
                        <div class="dsc-cell" style="vertical-align: top;">
                            <?php echo JTEXT::_('COM_MEDIAMANAGER_CAPTION'); ?>:
                        </div>
                        <div class="dsc-cell">
                            <input type="text" name="caption[<?php echo $item->mediafile_id; ?>]" value="<?php echo $item->caption; ?>" size="70" maxlength="300" />
                            <p class="dsc-tip">Max length: 300 characters</p>
                        </div>
                    </div>
                </div>
            </td>
            <td style="text-align: right;">
                <div class="dsc-table">
                    <div class="dsc-row">
                        <div class="dsc-cell">
                            <?php echo JTEXT::_('COM_MEDIAMANAGER_PUBLISH_UP'); ?>:
                        </div>
                        <div class="dsc-cell">
                            <?php echo JHTML::calendar( $item->publish_up, "publish_up[" . $item->mediafile_id . "]", "publish_up_" . $item->mediafile_id, '%Y-%m-%d %H:%M:%S', array('size'=>25) ); ?>
                        </div>
                    </div>
                    <div class="dsc-row">
                        <div class="dsc-cell">
                            <?php echo JTEXT::_('COM_MEDIAMANAGER_PUBLISH_DOWN'); ?>:
                        </div>
                        <div class="dsc-cell">
                            <?php echo JHTML::calendar( $item->publish_down, "publish_down[" . $item->mediafile_id . "]", "publish_down" . $item->mediafile_id, '%Y-%m-%d %H:%M:%S', array('size'=>25) ); ?>
                        </div>
                    </div>
                </div>
            </td>
            <td style="text-align: center;">
                <?php echo MediaManagerSelectSlideshowKiosk::url_target( $item->url_target, 'url_target['.$item->mediafile_id.']' );?>
            </td>
            <td style="text-align: center;">
                <input type="text" name="ordering[<?php echo $item->mediafile_id; ?>]" value="<?php echo $item->ordering; ?>" size="5" />
            </td>
            <td style="text-align: center;">
                <?php echo MediaManagerSelect::booleanlist( $item->enabled, 'enabled['.$item->mediafile_id.']' );?>
            </td>
            <td style="text-align: center;">
                <input type="button" onclick="SlideshowKiosk.deleteFile( '<?php echo $item->mediafile_id; ?>', 'form_files', '<?php echo JText::_( "COM_MEDIAMANAGER_DELETING" ); ?>' );" value="<?php echo JText::_( "COM_MEDIAMANAGER_DELETE" ); ?>" >
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