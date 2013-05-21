<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php
MediaManager::load( 'MediaManagerSelect', 'library.select' ); 
echo $this->sliders->startPanel( JText::_( "Media and Library Settings" ), 'media' );
?>

<table class="adminlist">
<tbody>
<tr>
    <th style="width: 25%;">
        <?php echo JText::_( 'Media Groups' ); ?>
    </th>
    <td>
        <textarea name="groups" cols="50" rows="10"><?php echo $this->row->get('groups'); ?></textarea>
    </td>
    <td>
        <?php echo JText::_( "ENTER ONE ITEM ON A LINE" ); ?>
        <br/>
        <br/>
        <?php echo JText::_( "GROUP DEFAULTS ARE" ); ?>:<br/>
        slideshow<br/>
        video<br/>
        audio<br/>
    </td>
</tr>
<tr>
    <th style="width: 25%;">
        <?php echo JText::_( 'Default pagination limit for channels' ); ?>
    </th>
    <td>
        <input name="library_pagination_limit" value="<?php echo $this->row->get('library_pagination_limit', '8'); ?>" type="text" size="10"/>
    </td>
    <td>
        
    </td>
</tr>
<tr>
	<th style="width: 25%;">
		<?php echo JText::_( 'Default Item ID' ); ?>
	</th>
	<td>
         <input type="text" name="item_id" value="<?php echo $this->row->get( 'item_id', '' ); ?>" />
	</td>
    <td>
        
    </td>
</tr>
<tr>
	<th style="width: 25%;">
		<?php echo JText::_( 'Default Library' ); ?>
	</th>
	<td>
         <?php echo MediaManagerSelect::library( $this->row->get( 'library_id'), 'library_id' ); ?>
	</td>
    <td>
        
    </td>
</tr>
</tbody>
</table>
<?php
echo $this->sliders->endPanel();

?>