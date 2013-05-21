<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php $item = $this->item; ?>
<?php $i = $this->i; ?>

<fieldset>
    <legend>Filter <?php echo $i + 1; ?></legend>
        <table class="adminTable">
            <tr>
                <td valign="top" style="padding: 10px;">
                    <?php echo JText::_( "Title" ); ?>
                    <br/>
                    <input type="text" name="category_title[<?php echo $i; ?>]" value="<?php echo $item->category_title; ?>" size="30" />
                    <br/>
                    <input type="checkbox" value="1" name="display_admin[<?php echo $i; ?>]" <?php if (!empty($item->display_admin)) { echo "checked"; } ?> /> <?php echo JText::_( "Display in Admin"); ?>
                    <br/>
                    <input type="checkbox" value="1" name="display_site[<?php echo $i; ?>]" <?php if (!empty($item->display_site)) { echo "checked"; } ?> /> <?php echo JText::_( "Display in Site"); ?>                    
                </td>
                <td valign="top" style="padding: 10px;">
                    <?php echo JText::_( "Items" ); ?> (<?php echo JText::_( "Enter one item on a line" ); ?>)
                    <br/>
                    <textarea name="category_values[<?php echo $i; ?>]" cols="50" rows="10"><?php echo $item->category_values; ?></textarea>
                </td>
            </tr>
        </table>
        <input type="hidden" name="ids[<?php echo $i; ?>]" value="<?php echo $item->category_id; ?>" />
</fieldset>
