<?php
/**
 * @package MediaManager
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2009 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 */
/*ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted Access' );

JHTML::_('stylesheet', 'component.css', 'media/com_mediamanager/css/');
?>

<?php
if ( $vars ) :
	echo $vars->handler_html;
endif;
?>
