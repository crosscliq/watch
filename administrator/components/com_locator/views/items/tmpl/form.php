<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php $form = @$this -> form; ?>
<?php $row = @$this -> row; ?>
<?php JHTML::_('behavior.calendar');
	JHtml::_('behavior.formvalidation');
?>

<form action="<?php echo JRoute::_( @$form['action'] ) ?>" method="post" class="adminForm" name="adminForm" id="adminForm" enctype="multipart/form-data" >

	<fieldset>
		<legend>
			<?php echo JText::_("BASIC INFORMATION"); ?>
		</legend>

		<table class="admintable">
			<tr>
				<td class="key"> <?php echo JText::_('id'); ?>: </td>
				<td> <?php echo @$row -> id; ?> </td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('Category'); ?>: </td>
				<td>
				<?php echo LocatorSelect::getSCategoriesSelectList(@$row -> cat_id); ?>
				</td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('Name'); ?>: </td>
				<td>
				<input name="name" value="<?php echo @$row -> name; ?>" size="50" maxlength="250" type="text" style="font-size: 20px;" />
				</td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('Street'); ?>: </td>
				<td>
				<input name="street" value="<?php echo @$row -> street; ?>" size="50" maxlength="250" type="text" style="font-size: 20px;" />
				</td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('Street 2'); ?>: </td>
				<td> <input name="street2" value="<?php echo @$row -> street2; ?>" size="50" maxlength="250" type="text" style="font-size: 20px;" /> </td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('City'); ?>: </td>
				<td> <input name="city" value="<?php echo @$row -> city; ?>" size="50" maxlength="250" type="text" style="font-size: 20px;" /></td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('State'); ?>: </td>
				<td> <input name="state" value="<?php echo @$row -> state; ?>" size="50" maxlength="250" type="text" style="font-size: 20px;" /> </td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('Zip'); ?>: </td>
				<td> <input name="zip" value="<?php echo @$row -> zip; ?>" size="50" maxlength="250" type="text" style="font-size: 20px;" /></td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('Country'); ?>: </td>
				<td> <input name="country" value="<?php echo @$row -> country; ?>" size="50" maxlength="250" type="text" style="font-size: 20px;" /></td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('Phone'); ?>: </td>
				<td> <input name="phone" value="<?php echo @$row -> phone; ?>" size="50" maxlength="250" type="text" style="font-size: 20px;" /></td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('Type'); ?>: </td>
				<td> <input name="type" value="<?php echo @$row -> type; ?>" size="50" maxlength="250" type="text" style="font-size: 20px;" /></td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('Notes'); ?>: </td>
				<td> <input name="zip" value="<?php echo @$row -> notes; ?>" size="50" maxlength="250" type="text" style="font-size: 20px;" /></td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('Latitude'); ?>: </td>
				<td> <input name="latitude" value="<?php echo @$row -> latitude; ?>" size="50" maxlength="250" type="text" style="font-size: 20px;" /></td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('longitude'); ?>: </td>
				<td> <input name="longitude" value="<?php echo @$row -> longitude; ?>" size="50" maxlength="250" type="text" style="font-size: 20px;" /></td>
			</tr>
		</table>
	</fieldset>
	<div>
		<input type="hidden" name="id" id="id" value="<?php echo @$row -> id; ?>" />
		<input type="hidden" name="params" id="params" value="" />
		<input type="hidden" name="task" value="" />
	</div>
</form>
