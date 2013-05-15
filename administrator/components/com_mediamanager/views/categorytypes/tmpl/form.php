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
                    <input name="categorytype_title" value="<?php echo @$row->categorytype_title; ?>" size="72" maxlength="250" type="text" style="font-size: 20px;" />
                </td>
            </tr>
        </table>
    </fieldset>
    
    <div>
        <input type="hidden" name="id" value="<?php echo @$row->categorytype_id; ?>" />
        <input type="hidden" name="task" value="" />
    </div> 
</form>