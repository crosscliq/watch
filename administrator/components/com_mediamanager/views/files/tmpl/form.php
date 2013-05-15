<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php $form = @$this->form; ?>
<?php $row = @$this->row; ?>

<form action="<?php echo JRoute::_( @$form['action'] ) ?>" method="post" class="adminform" name="adminForm" id="adminForm" enctype="multipart/form-data" >
    <fieldset>
        <legend><?php echo JText::_( "New File" ); ?></legend>

        <div class="dsc-table">
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'Upload New Local File' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <input name="new_file" type="file" size="100" />
                </div>
            </div>
        </div>
        
    </fieldset>
    
    <fieldset>
        <legend><?php echo JText::_( "File Details" ); ?></legend>

        <p><?php echo JText::_( "COM_MEDIAMANAGER_LEAVE_FILE_DETAILS_BLANK_WHEN_UPLOADING_NEW_FILE" ); ?>

        <div class="dsc-table">
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'File Name' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <input name="file_name" value="<?php echo @$row->file_name; ?>" size="72" maxlength="250" type="text" style="font-size: 20px;" />
                    <p class="dsc-clear dsc-tip">
                        <?php echo JText::_( "COM_MEDIAMANAGER_TIP_FILE_NAME" ); ?>
                    </p>
                </div>
            </div>
            
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'File URL' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <input name="file_url" value="<?php echo @$row->file_url; ?>" size="150" maxlength="250" type="text" />
                    <p class="dsc-clear dsc-tip">
                        <?php echo JText::_( "COM_MEDIAMANAGER_TIP_FILE_URL" ); ?>
                    </p>
                </div>
            </div>
            
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'File Path' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <input name="file_path" value="<?php echo @$row->file_path; ?>" size="150" maxlength="250" type="text" />
                    <p class="dsc-clear dsc-tip">
                        <?php echo JText::_( "COM_MEDIAMANAGER_TIP_FILE_PATH" ); ?>
                    </p>
                </div>
            </div>
            
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'File Extension' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <input name="file_extension" value="<?php echo @$row->file_extension; ?>" size="10" maxlength="10" type="text" />
                </div>
            </div>
            
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'Enabled' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <?php echo JHTML::_('select.booleanlist', 'file_enabled', '', empty($row->file_id) ? '1' : @$row->file_enabled ); ?>
                </div>
            </div>
            
        </div>
        
    </fieldset>
    
    <div>
        <input type="hidden" name="id" value="<?php echo @$row->file_id; ?>" />
        <input type="hidden" name="task" value="" />
    </div> 
</form>