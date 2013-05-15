<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php 
echo $this->sliders->startPanel( JText::_( "General Settings" ), 'general' );
?>

<table class="adminlist">
<tbody>
<tr>
    <th style="width: 25%;">
        <?php echo JText::_( 'SET DATE FORMAT' ); ?>
    </th>
    <td>
        <input name="date_format" value="<?php echo $this->row->get('date_format', '%a, %d %b %Y, %I:%M%p'); ?>" type="text" size="40"/>
    </td>
    <td>
        <?php echo JText::_( "CONFIG SET DATE FORMAT" ); ?>
    </td>
</tr>
<tr>
    <th style="width: 25%;">
        <?php echo JText::_( 'Show Linkback' ); ?>
    </th>
    <td>
        <?php echo JHTML::_('select.booleanlist', 'show_linkback', 'class="inputbox"', $this->row->get('show_linkback', '1') ); ?>
    </td>
    <td>
        
    </td>
</tr>
<tr>
    <th style="width: 25%;">
        <?php echo JText::_( 'Include Site CSS' ); ?>
    </th>
    <td>
        <?php echo JHTML::_('select.booleanlist', 'include_site_css', 'class="inputbox"', $this->row->get('include_site_css', '1') ); ?>
    </td>
    <td>
        
    </td>
</tr>
</tbody>
</table>
<?php
echo $this->sliders->endPanel();

?>