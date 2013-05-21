<?php defined('_JEXEC') or die('Restricted access'); ?>

	<?php
	    $defines = Mediamanager::getInstance();
	
	?>

	<table style="margin-bottom: 5px; width: 100%; border-top: thin solid #e5e5e5;">
	<tbody>
	<tr>
		<td style="text-align: left; width: 33%;">
					<a href="http://crosscliq.com/" target="_blank"><img src="http://crosscliq.com/images/logo.png"></img></a>

		</td>
		<td style="text-align: center; width: 33%;">
			<?php echo JText::_( "Advertising Media Manager" ); ?>: <?php echo JText::_( "Mediamanager_Desc" ); ?>
			<br/>
			<?php echo JText::_( "Version" ); ?>: <?php echo $defines->getVersion(); ?>
		</td>
		<td style="text-align: right; width: 33%;">
		</td>
	</tr>
	</tbody>
	</table>
