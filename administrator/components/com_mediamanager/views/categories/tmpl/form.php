<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php $form = @$this->form; ?>
<?php $row = @$this->row; ?>

<form action="<?php echo JRoute::_( @$form['action'] ) ?>" method="post" class="adminform" name="adminForm" id="adminForm" enctype="multipart/form-data" >

    <fieldset>
        <legend><?php echo JText::_( "Basics" ); ?></legend>
        
        <table class="admintable">
            <tr>
                <td class="key">
                    <?php echo JText::_( 'Title' ); ?>:
                </td>
                <td>
                    <input name="category_title" value="<?php echo @$row->category_title; ?>" size="72" maxlength="250" type="text" style="font-size: 20px;" />
                </td>
            </tr>
            <tr>
                <td class="key">
                    <?php echo JText::_( 'Type' ); ?>:
                </td>
                <td>
                    <?php echo MediaManagerSelect::categorytype( @$row->categorytype_id, 'categorytype_id' ); ?>
                </td>
            </tr>
        </table>
    </fieldset>
    
    <div>
        <input type="hidden" name="id" value="<?php echo @$row->category_id; ?>" />
        <input type="hidden" name="task" value="" />
    </div> 
</form>