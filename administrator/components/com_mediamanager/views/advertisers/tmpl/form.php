<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php $form = @$this->form; ?>
<?php $row = @$this->row; ?>

<form action="<?php echo JRoute::_( @$form['action'] ) ?>" method="post" class="adminform" name="adminForm" id="adminForm" enctype="multipart/form-data" >

    <fieldset>
        <legend><?php echo JText::_( "Basics" ); ?></legend>
        
        <table class="admintable">
            <tr>
                <td class="key">
                    <?php echo JText::_( 'Advertiser Name' ); ?>:
                </td>
                <td>
                    <input name="advertiser_name" value="<?php echo @$row->advertiser_name; ?>" size="72" maxlength="250" type="text" style="font-size: 20px;" />
                </td>
            </tr>
            <tr>
                <td class="key">
                    <?php echo JText::_( 'Contact Name' ); ?>:
                </td>
                <td>
                    <input name="advertiser_contact" value="<?php echo @$row->advertiser_contact; ?>" size="72" maxlength="250" type="text" style="font-size: 20px;" />
                </td>
            </tr>

            <tr>
                <td class="key">
                    <?php echo JText::_( 'Advertiser Phone' ); ?>:
                </td>
                <td>
                    <input name="advertiser_phone" value="<?php echo @$row->advertiser_phone; ?>" size="72" maxlength="250" type="text" style="font-size: 20px;" />
                </td>
            </tr>
            
        </table>
    </fieldset>
    
    <div>
        <input type="hidden" name="id" value="<?php echo @$row->category_id; ?>" />
        <input type="hidden" name="task" value="" />
    </div> 
</form>