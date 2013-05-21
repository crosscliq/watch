<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('script', 'common.js', 'media/com_mediamanager/js/'); ?>
<?php JHTML::_('script', 'Stickman.MultiUpload.js', 'media/com_mediamanager/js/'); ?>
<?php JHTML::_('stylesheet', 'Stickman.MultiUpload.css', 'media/com_mediamanager/css/'); ?>
<?php $form = @$this->form; ?>
<?php $row = $this->row ? $this->row : new JObject(); ?>
<?php jimport('joomla.html.pane'); ?>
<?php $tabs = JPane::getInstance( 'tabs' ); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php $helper = new MediaManagerHelperBase(); ?>
<?php $table = $this->getModel()->getTable(); $table->bind($row); ?>
<?php DSC::loadJQuery(); ?>

<form action="<?php echo JRoute::_( @$form['action'] ) ?>" method="post" class="adminform" name="adminForm" id="adminForm" id="adminForm" enctype="multipart/form-data" >

  <fieldset>
        <legend><?php echo JText::_( "COM_MEDIAMANAGER_BASIC_INFORMATION" ); ?></legend>
        
        <div class="dsc-right dsc-text-center" style="width: 150px;">
            <?php
            if (!empty($row->media_image_remote))
            {
                ?>
                <img src="<?php echo $row->media_image_remote; ?>" style="max-height: 125px; max-width: 125px;" />
                <p class="dsc-clear dsc-tip">
                    <?php echo JText::_( "COM_MEDIAMANAGER_REMOTE_IMAGE" ); ?>
                </p>
                <?php
            } 
                else 
            {
                jimport('joomla.filesystem.file');
                if (!empty($row->media_image) && JFile::exists( $table->getThumbPath() . DS . $row->media_image ))
                {
                    ?>
                    <img src="<?php echo $table->getThumbUrl() . $table->media_image; ?>" style="max-height: 125px; max-width: 125px;" />
                    <p class="dsc-clear dsc-tip">
                        <?php echo JText::_( "COM_MEDIAMANAGER_LOCAL_IMAGE" ) . ": " . $row->media_image; ?>
                    </p>
                    <?php
                }

            }
            ?>
        </div>

        <div class="dsc-table">
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'Short Title' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <input name="media_title" value="<?php echo @$row->media_title; ?>" size="50" maxlength="60" type="text" style="font-size: 20px;" />
                    <p class="dsc-clear dsc-tip">
                        60 characters max.  Used in related items and small featured items boxes.
                    </p>
                </div>
            </div>
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'Long Title' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <input name="media_title_long" value="<?php echo @$row->media_title_long; ?>" size="100" maxlength="100" type="text" />
                    <p class="dsc-clear dsc-tip">
                        100 characters max.  Used in listing page, medium/large featured items boxes, and media detail page.  If left blank, short title is used.
                    </p>
                </div>
            </div>
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'Enabled' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <?php echo JHTML::_('select.booleanlist', 'media_enabled', '', @$row->media_enabled ); ?>
                </div>
            </div>
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'Remote Thumbnail URL' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <input name="media_image_remote" value="<?php echo @$row->media_image_remote; ?>" size="125" type="text" />
                    <p class="dsc-clear dsc-tip">
                        <?php echo JText::_( "Please enter the full URL" ); ?>
                    </p>
                </div>
            </div>
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'Local Thumbnail' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <?php $media = new DSCElementMedia(); ?> 
                    <?php echo $media->fetchElement( 'media_image', @$row->media_image ); ?>
                </div>
            </div>
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'Type' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <?php echo MediaManagerSelect::mediatype( $this->media_type, 'media_type' ); ?>
                </div>
            </div>
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'Group' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <?php echo MediaManagerSelect::group( $this->media_group, 'media_group' ); ?>
                </div>
            </div>
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'Hits' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <input name="hits" value="<?php echo (int) @$row->hits; ?>" size="10" maxlength="10" type="text" />
                </div>
            </div>
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'Date Added' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <input name="date_added" value="<?php echo @$row->date_added; ?>" size="30" type="text" />
                </div>
            </div>
            <?php if (!empty($row->media_id)) { ?>
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'ID' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <?php echo $row->media_id; ?>
                </div>
            </div>
            <?php } ?>
        </div>
        
    </fieldset>
    
    <fieldset>
    
        <legend><?php echo JText::_( "Details" ); ?></legend>
        
        <div class="dsc-table">
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'Categories' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <?php foreach($this->categorytypes as $ct):?>
                    <div class="dsc-left" style="min-width: 150px;">
                        <h3><?php echo $ct->categorytype_title; ?></h3>
                        <?php echo MediaManagerSelect::category( @$row->categories, $ct->categorytype_id, null, 'categories[]' , array('class' => 'inputbox', 'size' => '10', 'multiple'=>'multiple') ); ?>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php // echo JText::_( 'Tags' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <?php // TODO Just load from com_tags ?>
                    <?php // echo $this->loadTemplate( 'tags' ); ?>
                </div>
            </div>
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'Short Description' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <?php $editor = JFactory::getEditor( ); ?>
                    <?php echo $editor->display( 'media_description', @$row->media_description, '100%', '450', '100', '20' ); ?>                
                </div>
            </div>
            <div class="dsc-row">
                <div class="dsc-cell dsc-key">
                    <?php echo JText::_( 'Full Description' ); ?>:
                </div>
                <div class="dsc-cell dsc-value">
                    <?php $editor = JFactory::getEditor( ); ?>
                    <?php echo $editor->display( 'media_description_full', @$row->media_description_full, '100%', '450', '100', '20' ); ?>                
                </div>
            </div>
        </div>

    </fieldset>
    
    <?php if (!empty($this->handler_html)) { ?>
    <fieldset>
        <legend><?php echo JText::_( "Handler" ); ?></legend>
        
        <?php echo $this->handler_html; ?>
    </fieldset>
    <?php } ?>
    
    <div>
        <input type="hidden" name="id" id="id" value="<?php echo @$row->media_id; ?>" />
        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>