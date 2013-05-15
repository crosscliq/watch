<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php $form = @$this->form; ?>
<?php $row = @$this->row; ?>
<?php jimport('joomla.html.pane'); ?>
<?php $tabs = JPane::getInstance( 'tabs' ); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php JHTML::_('behavior.modal'); ?>
<?php $helper = new MediaManagerHelperBase(); ?>

<form action="<?php echo JRoute::_( @$form['action'] ) ?>" method="post" class="adminform" name="adminForm" id="adminForm" enctype="multipart/form-data" >

    <fieldset>
        <legend><?php echo JText::_( "Basics" ); ?></legend>
        
        <table class="table table-striped table-bordered">
            <tr>
                <td class="dsc-key">
                    <?php echo JText::_( 'Title' ); ?>:
                </td>
                <td>
                    <input name="library_title" value="<?php echo @$row->library_title; ?>" size="72" maxlength="250" type="text" style="font-size: 20px;" />
                </td>
            </tr>
            <tr>
                <td class="dsc-key">
                    <?php echo JText::_( 'Enabled' ); ?>:
                </td>
                <td>
                    <?php echo JHTML::_('select.booleanlist', 'library_enabled', '', @$row->library_enabled ); ?>
                </td>
            </tr>
            <tr>
            	<td class="dsc-key"><?php echo JText::_( 'Featured Media Item'); ?></td>
            	<td>
				<?php 	
				JModel::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/models' );
				$model = JModel::getInstance( 'ElementMedia', 'MediaManagerModel' );
				echo $model->fetchElement( 'default_media_id', @$row->default_media_id );
				echo $model->clearElement( 'default_media_id', 0 );
				?>
            	</td>
            </tr>
            <?php /* ?>
            <!--<tr> Removed before moving to new section on form
                <td class="dsc-key">
                    <?php echo JText::_( 'Filters' ); ?>:
                </td>
                <td>
                    TODO Filters
                    <?php // echo MediaManagerSelect::createFilters(@$row->categories,@$row->filters); ?>
                </td>
            </tr>-->
            <tr>
                <td class="dsc-key">
                    <?php echo JText::_( 'Tags' ); ?>:
                </td>
                <td>
                    
                </td>
            </tr>
            <tr>
            	<td class="dsc-key"><?php echo JText::_( 'CHANNEL DISPLAY TYPE' ) ;?></td>
            	<td><?php echo MediaManagerSelect::booleanlist( @$row->params->get( 'channel_type','0' ), 'params[channel_type]', '', 'Full View', 'Mini View', $id=false ); ?></td>
            </tr>
            */ ?>
        </table>
    </fieldset>
    
    <fieldset>
    	<legend><?php echo JText::_( 'Default Filtering' );?></legend>
    	
    	<table class="table table-striped table-bordered">
            <tr>
                <td class="dsc-key">
                    <?php echo JText::_( 'Start Date' ); ?>:
                </td>
                <td>
                    <p class="dsc-tip">To only display media added after a certain date, specify a start date here</p>
                    <?php echo JHTML::calendar( @$row->library_date_from, "library_date_from", "library_date_from", '%Y-%m-%d %H:%M:%S', array('size'=>25) ); ?>
                </td>
            </tr>
            <tr>
                <td class="dsc-key">
                    <?php echo JText::_( 'End Date' ); ?>:
                </td>
                <td>
                    <p class="dsc-tip">To only display media added before a certain date, specify an end date here</p>
                    <?php echo JHTML::calendar( @$row->library_date_to, "library_date_to", "library_date_to", '%Y-%m-%d %H:%M:%S', array('size'=>25) ); ?>
                </td>
            </tr>
            <tr>
                <td class="dsc-key">
                    <?php echo JText::_( 'Groups' ); ?>:
                </td>
                <td>
                    <p class="dsc-tip">Which media group(s) should display?</p>
                    <?php echo MediaManagerSelect::group( @$row->groups, 'groups[]' , array('class' => 'inputbox', 'size' => '10', 'multiple'=>'multiple') ); ?>
                </td>
            </tr>
            <tr>
                <td class="dsc-key">
                    <?php echo JText::_( 'Categories' ); ?>:
                </td>
                <td>
                    <p class="dsc-tip">Please select the default filtering applied to this library for each of the category types below.  If you do not select any categories within a category type, then the library will not apply those filters.</p>
                    <p class="dsc-tip">Hide/Display determines whether or not the filtering module should allow the user to filter by the respective category type.</p>
                    <?php foreach($this->categorytypes as $ct):?>
                    <div style="float: left; min-width: 150px; margin-right: 10px;">
                        <h3><?php echo $ct->categorytype_title; ?></h3>
                        <?php
                            echo MediaManagerSelect::booleanlist( $this->getModel()->typeEnabled( $ct->categorytype_id, @$row->library_id ), 'lct_' . $ct->categorytype_id, null, 'Display', 'Hide' );
                        ?>
                        <br/>
                        <?php echo MediaManagerSelect::category( @$row->categories, $ct->categorytype_id, null, 'categories[]' , array('class' => 'inputbox', 'size' => '10', 'multiple'=>'multiple') ); ?>
                    </div>
                    <?php endforeach;?>
                    
                    <div style="clear: both;"></div>
                </td>
            </tr>
    	</table>
        
    </fieldset>
    
    
    <fieldset>
        <legend><?php echo JText::_( "Interface" ); ?></legend>
        
        <table class="table table-striped table-bordered">
            <tr>
                <td class="dsc-key">
                    <?php echo JText::_( 'Pagination Limit' ); ?>:
                </td>
                <td>
                    <input name="library_pagination_limit" value="<?php echo (int) @$row->library_pagination_limit; ?>" size="10" maxlength="10" type="text" />
                    <br/>
                    <?php echo JText::_( "Set to 0 to use pagination limit set in Mediamanager >> Configuration"); ?>
                </td>
            </tr>
            <tr>
                <td class="dsc-key">
                    <?php echo JText::_( 'Layout' ); ?>:
                </td>
                <td>
                    <input name="library_layout" value="<?php echo @$row->library_layout; ?>" size="20" maxlength="250" type="text" />
                </td>
            </tr>
            <tr>
                <td class="dsc-key">
                    <?php echo JText::_( 'Display Filter Dropdowns' ); ?>:
                </td>
                <td>
                    <?php echo JHTML::_('select.booleanlist', 'params[display_filter_dropdowns]', '', @$row->params->get('display_filter_dropdowns') ); ?>
                </td>
            </tr>
            <tr>
                <td class="dsc-key">
                    <?php echo JText::_( 'Display Media Type Checkboxes' ); ?>:
                </td>
                <td>
                    <?php echo JHTML::_('select.booleanlist', 'params[display_checkboxes]', '', @$row->params->get('display_checkboxes') ); ?>
                </td>
            </tr>
            <tr>
                <td class="dsc-key">
                    <?php echo JText::_( 'Display List of Media Items' ); ?>:
                </td>
                <td>
                    <?php $default = empty($row->library_id) ? '1' : '0'; ?>
                    <?php echo JHTML::_('select.booleanlist', 'params[display_items]', '', @$row->params->get('display_items', $default) ); ?>
                </td>
            </tr>
        </table>
    </fieldset>

    <div>
        <input type="hidden" name="id" value="<?php echo @$row->library_id; ?>" />
        <input type="hidden" name="task" value="" />
    </div> 
</form>