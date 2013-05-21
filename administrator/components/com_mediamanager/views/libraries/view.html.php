<?php
/**
 * @version 1.5
 * @package MediaManager
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 */

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted Access' );

MediaManager::load( 'MediaManagerViewBase', 'views._base' );

class MediaManagerViewLibraries extends MediaManagerViewBase
{
	function _defaultToolbar( )
	{
		JToolBarHelper::publishList( 'library_enabled.enable' );
		JToolBarHelper::unpublishList( 'library_enabled.disable' );
		parent::_defaultToolbar( );
	}
}
