<?php defined('_JEXEC') or die('Restricted access'); ?>

	<?php
	    $defines = Mediamanager::getInstance();
		$img_file = "dioscouri_logo_transparent.png";
		$img_path = "../media/com_mediamanager/images";

		$url = "http://www.dioscouri.com/";
		if ($amigosid = $defines->getInstance()->get( 'amigosid', '' ))
		{
			$url .= "?amigosid=".$amigosid;
		}
	?>

	<table style="margin-bottom: 5px; width: 100%; border-top: thin solid #e5e5e5;">
	<tbody>
	<tr>
		<td style="text-align: left; width: 33%;">
			<a href="<?php echo $url; ?>" target="_blank"><?php echo JText::_( 'Dioscouri.com Support Center' ); ?></a>
			<br/>
			<a href="http://twitter.com/dioscouri" target="_blank"><?php echo JText::_( "Follow Us on Twitter" ); ?></a>
			<br/>
			<a href="http://extensions.joomla.org/extensions/owner/dioscouri" target="_blank"><?php echo JText::_( "Leave JED Feedback" ); ?></a>
		</td>
		<td style="text-align: center; width: 33%;">
			<?php echo JText::_( "Mediamanager" ); ?>: <?php echo JText::_( "Mediamanager_Desc" ); ?>
			<br/>
			<?php echo JText::_( "Copyright" ); ?>: <?php echo $defines->getCopyrightYear(); ?> &copy; <a href="<?php echo $url; ?>" target="_blank">Dioscouri Design</a>
			<br/>
			<?php echo JText::_( "Version" ); ?>: <?php echo $defines->getVersion(); ?>
		</td>
		<td style="text-align: right; width: 33%;">
			<a href="<?php echo $url; ?>" target="_blank"><img src="<?php echo $img_path."/".$img_file;?>"></img></a>
		</td>
	</tr>
	</tbody>
	</table>
