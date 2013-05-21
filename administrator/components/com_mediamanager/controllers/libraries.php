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
defined( '_JEXEC' ) or die( 'Restricted access' );

class MediaManagerControllerLibraries extends MediaManagerController
{
	function __construct( )
	{
		parent::__construct( );
		
		$this->set( 'suffix', 'libraries' );
		
		$this->registerTask( 'accessspecial', 'accessMenu' );
		$this->registerTask( 'accessregistered', 'accessMenu' );
		$this->registerTask( 'accesspublic', 'accessMenu' );
		
		$this->registerTask( 'library_enabled.enable', 'boolean' );
		$this->registerTask( 'library_enabled.disable', 'boolean' );
	}
	
	/**
	 * Sets the model's default state based on values in the request
	 *
	 * @return array()
	 */
	function _setModelState( &$model=null )
	{
		$state = parent::_setModelState( );
		$app = JFactory::getApplication( );
		$model = $this->getModel( $this->get( 'suffix' ) );
		$ns = $this->getNamespace( );
		
		$state = array( );
		
		$state['filter_title'] = $app->getUserStateFromRequest( $ns . 'filter_title', 'filter_title', '', '' );
		
		foreach ( @$state as $key => $value )
		{
			$model->setState( $key, $value );
		}
		return $state;
	}
	
	public function edit($cachable=false, $urlparams = false)
	{
		$model = $this->getModel( $this->get( 'suffix' ) );
		$id = $model->getId();
		$model->setId( $id );
		$model->setState('get_categories', true);
		$item = $model->getItem($id, true);
		
		$ctmodel = $this->getModel( 'categorytypes' );
		$ctmodel->setState('get_categories', true);
		$cts = $ctmodel->getList( false );
		
		$view = $this->getView( 'libraries', 'html' );
		$view->set( '_doTask', true );
		$view->set( 'hidemenu', false );
		$view->setModel( $model, true );
		$view->setModel( $ctmodel );
	    $view->assign( 'categorytypes', $cts );
	    
	    parent::edit( $cachable, $urlparams );
	}
	
	/**
	 * (non-PHPdoc)
	 * @see mediamanager/mediamanager/admin/MediaManagerController::save()
	 */
	function save( )
	{
		parent::save( );
		
		$model = $this->getModel( $this->get( 'suffix' ) );
		$id = $model->getId();
		
		$row = $model->getTable( );
		$row->load( $id );
		
		$model->setId( $id );
		$model->setState('get_categories', true);
		$item = $model->getItem($id);
		
		$librarycategories_ids = DSCHelper::getColumn( $item->librarycategories, 'category_id' );
		
		JTable::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/tables' );
		$libcat = JTable::getInstance('LibraryCategories', 'MediaManagerTable');
		$categories = JRequest::getVar( 'categories', array( ), 'post', 'array' );
		$groups = JRequest::getVar( 'groups', array( ), 'post', 'array' );

		foreach ($item->librarycategories as $lc) {
		    if (!in_array($lc->category_id, $categories)) {
		        $libcat->delete($lc->librarycategory_id);
		    }
		}
		
		foreach ($categories as $ct)
		{
		    if (!in_array($ct, $librarycategories_ids))
		    {
		        $libcat = JTable::getInstance('LibraryCategories', 'MediaManagerTable');
		        $libcat->library_id = $id;
		        $libcat->category_id = $ct;
		        $libcat->store();
		    }
		}
		
		$ctmodel = $this->getModel( 'categorytypes' );
		$cts = $ctmodel->getList( false );
		foreach ($cts as $ct) 
		{
		    $lct = JRequest::getVar( 'lct_' . $ct->categorytype_id, 0 );
		    $table = $ctmodel->getTable( 'librarycategorytypes' );
		    $table->load( array( 'library_id'=>$id, 'categorytype_id'=>$ct->categorytype_id ) );
		    if ($lct) 
		    {
		        $table->library_id = $id;
		        $table->categorytype_id = $ct->categorytype_id;
		        $table->save();
		    } else {
		        $table->delete();
		    }
		}
		$ctmodel->clearCache();
		
		//echo MediaManager::dump($categories);
		//echo MediaManager::dump($librarycategories_ids);
		
		$post_params = JRequest::getVar( 'params', array( ), 'post', 'array' );
		$post_filters = JRequest::getVar( 'filter', array( ), 'post', 'array' );

		$params = new DSCParameter( trim( $row->library_params ));
		$params->set( 'display_filter_dropdowns', @$post_params['display_filter_dropdowns'] );
		$params->set( 'display_checkboxes', @$post_params['display_checkboxes'] );
		$params->set( 'channel_type', @$post_params['channel_type'] );
		$params->set( 'display_items', @$post_params['display_items'] );
		$row->library_params = trim( $params->toString( ) );
		
		$row->library_groups = json_encode($groups);
		$row->library_categories = json_encode( $categories );
		
		//unset existing filter params 
		$row->library_filters = '';
		$filters = new DSCParameter( trim( $row->library_filters ));
		foreach ( $post_filters as $key => $value )
		{
			$filters->set( 'display_filter_' . $key, @$post_filters[$key] );
		}
		//		echo mediamanager::dump( $filters );
		
		$row->library_filters = trim( $filters->toString( ) );
		$row->store( );
		
		$lcmodel = $this->getModel( 'librarycategories' );
		$lcmodel->clearCache();
		$lctmodel = $this->getModel( 'librarycategorytypes' );
		$lctmodel->clearCache();

	}
}
