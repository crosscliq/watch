<?php
/**
 * @package	MediaManager
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

MediaManager::load( 'MediaManagerViewBase', "views._base", array( 'site'=>'site', 'type'=>'components', 'ext'=>'com_mediamanager' ) );

class MediaManagerViewMedia extends MediaManagerViewBase  
{
	function _default($tpl='')
	{
		MediaManager::load( 'MediaManagerSelect', 'library.select' );
		$model = $this->getModel();

		// get the data
	    $row = $model->getItem();
	    JFilterOutput::objectHTMLSafe( $row );
		$this->assign('row', $row );

	}
}