<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php $form = @$this->form; ?>
<?php $row = @$this->row; ?>

<form action="<?php echo JRoute::_( @$form['action'] ) ?>" method="post" class="adminform" name="adminForm" id="adminForm" enctype="multipart/form-data" >

    <fieldset>
        <legend><?php echo JText::_( "Basics" ); ?></legend>
        
        <table class="admintable">
            <tr>
                <td class="key">
                    <?php echo JText::_( 'UUID' ); ?>:
                </td>
                <td>
                    <input name="uuid" value="<?php echo @$row->uuid; ?>" size="72" maxlength="250" type="text" style="font-size: 20px;" />
                </td>
            </tr>
            <tr>
                <td class="key">
                    <?php echo JText::_( 'Station Name' ); ?>:
                </td>
                <td>
                    <input name="station_name" value="<?php echo @$row->station_name; ?>" size="72" maxlength="250" type="text" style="font-size: 20px;" />
                </td>
            </tr>
            
            <tr>
                <td class="key">
                    <?php echo JText::_( 'Street Address' ); ?>:
                </td>
                <td>
                    <input name="station_address1" value="<?php echo @$row->station_address1; ?>" size="72" maxlength="250" type="text" style="font-size: 20px;" />
                </td>
            </tr>
            <tr>
                <td class="key">
                    <?php echo JText::_( 'Street Address' ); ?>:
                </td>
                <td>
                    <input name="station_address2" value="<?php echo @$row->station_address2; ?>" size="72" maxlength="250" type="text" style="font-size: 20px;" />
                </td>
            </tr>
            <tr>
                <td class="key">
                    <?php echo JText::_( 'Provence' ); ?>:
                </td>
                <td>
                    <input name="station_provence" value="<?php echo @$row->station_provence; ?>" size="72" maxlength="250" type="text" style="font-size: 20px;" />
                </td>
            </tr>
            <tr>
                <td class="key">
                    <?php echo JText::_( 'City' ); ?>:
                </td>
                <td>
                    <input name="station_city" value="<?php echo @$row->station_city; ?>" size="72" maxlength="250" type="text" style="font-size: 20px;" />
                </td>
            </tr>
            <tr>
                <td class="key">
                    <?php echo JText::_( 'Country' ); ?>:
                </td>
                <td>
                    <input name="station_country" value="<?php echo @$row->station_country; ?>" size="72" maxlength="250" type="text" style="font-size: 20px;" />
                </td>
            </tr>
             <tr>
                <td class="key">
                    <?php echo JText::_( 'Postal Code' ); ?>:
                </td>
                <td>
                    <input name="station_postalcode" value="<?php echo @$row->station_postalcode; ?>" size="72" maxlength="250" type="text" style="font-size: 20px;" />
                </td>
            </tr>


            <tr>
                <td class="key">
                    <?php echo JText::_( 'Station Description' ); ?>:
                </td>
                <td>
                    <input name="station_desc" value="<?php echo @$row->station_desc; ?>" size="72" maxlength="250" type="text" style="font-size: 20px;" />
                </td>
            </tr>
            <tr>
                <td class="key">
                    <?php echo JText::_( 'UUID' ); ?>:
                </td>
                <td>
                    <input name="station_notes" value="<?php echo @$row->station_notes; ?>" size="72" maxlength="250" type="text" style="font-size: 20px;" />
                </td>
            </tr>
            <tr>
                <td class="key">
                    <?php // echo JText::_( 'Type' ); ?>:
                </td>
                <td>
                    <?php // echo MediaManagerSelect::categorytype( @$row->categorytype_id, 'categorytype_id' ); ?>
                </td>
            </tr>
        </table>
    </fieldset>
    
    <div>
        <input type="hidden" name="id" value="<?php echo @$row->category_id; ?>" />
        <input type="hidden" name="task" value="" />
    </div> 
</form>