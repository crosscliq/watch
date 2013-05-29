<?php
/**
 * @version	1.5
 * @package	MediaManager
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.filter.filteroutput' );
jimport( 'joomla.application.component.view' );

class MediaManagerViewBase extends DSCViewAdmin
{
	/**
	 * Displays a layout file 
	 * 
	 * @param unknown_type $tpl
	 * @return unknown_type
	 */
	function display($tpl=null)
	{
	    JHTML::_('stylesheet', 'common.css', 'media/dioscouri/css/');
		JHTML::_('stylesheet', 'admin.css', 'media/com_mediamanager/css/');
		JHTML::_('script','common.js','media/com_mediamanager/js/');
		
		$parentPath = JPATH_ADMINISTRATOR . '/components/com_mediamanager/helpers';
		DSCLoader::discover('MediamanagerHelper', $parentPath, true);
		
		$parentPath = JPATH_ADMINISTRATOR . '/components/com_mediamanager/library';
		DSCLoader::discover('Mediamanager', $parentPath, true);
                
        parent::display($tpl);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see featureditems/admin/views/FeatureditemsViewBase#_formToolbar($isNew)
	 */
	function _formToolbar( $isNew = null )
	{
	    if ( !$isNew )
	    {
	        JToolBarHelper::custom( 'save_as', 'refresh', 'refresh', JText::_( 'Save As' ), false );
	    }
	    parent::_formToolbar( $isNew );
	}

}