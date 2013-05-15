<?php
/**
 * @package		MediaManager
 * @copyright	Copyright (C) 2011 DT Design Inc. All rights reserved.
 * @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link 		http://www.dioscouri.com
 */

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );

class MediaManagerSelect extends DSCSelect
{
	
	public static function render_library_categories($prefix='filter_', $state, $list_attributes = array(
		"class2" => "inputbox", "style" => "width:100px;", "onchange" => "document.adminForm.submit();"
	), $include )
	{
		// initiate model
		$cmodel = JModel::getInstance( 'Categories', 'MediamanagerModel' );
		//first up get all categories
		$categories = $cmodel->getList( );
		
		//loop through each category
		foreach ( $categories as $cat )
		{
			//create the first option based on the category title 
			$list = array( );
			$list_attributes = $list_attributes;
			$list[] = self::option( '', $cat->category_title );
			//now loop through each of the category values creating additional options 
			foreach ( $cat->options as $option )
			{
				//check whether option has been selected for library
				if ( in_array( strtolower( trim( $option ) ), $include ) )
				{
					$list[] = self::option( $option, $option );
				}
			}
			$category_selects[$cat->category_title] = self::genericlist( $list, $prefix . $cat->category_title, $list_attributes, 'value', 'text', $state->get( $prefix . $cat->category_title ) );
		}
		
		return $category_selects;
	}
	
	/**
	 * Generates a created/modified select list
	 *
	 * @param string The value of the HTML name attribute
	 * @param string Additional HTML attributes for the <select> tag
	 * @param mixed The key that is selected
	 * @returns string HTML for the radio list
	 */
	public static function mediatype( $selected, $name = 'filter_mediatype', $attribs = array(
		'class' => 'inputbox', 'size' => '1'
	), $idtag = null, $allowAny = false, $title = 'Select Media Type' )
	{
		$list = array( );
		if ( $allowAny )
		{
			$list[] = self::option( '', "- " . JText::_( $title ) . " -" );
		}
		
		JModel::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/models' );
		$model = JModel::getInstance( 'Handlers', 'MediaManagerModel' );
		$items = $model->getList( );
		
		foreach ( $items as $item )
		{
			$list[] = JHTML::_( 'select.option', $item->element, $item->element );
		}
		
		return self::genericlist( $list, $name, $attribs, 'value', 'text', $selected, $idtag );
	}
	
	/**
	 * Displays a checkbox
	 *
	 * @static
	 * @return html
	 *
	 */
	function checkbox( $name, $label, $value, $attributes, $checked = '', $linebreak = true )
	{
		$html = '<input type="checkbox" ' . $attributes . ' ' . $checked . ' name="' . $name . '" value="' . $value . '" id="' . $name . '" />';
		$html .= '&nbsp;<label for="' . $name . '">' . $label . '</label>';// . "<br/>";
		if ( $linebreak ) :
			$html .= "<br/>";
		endif;
		return $html;
		
	}
	
	function checkboxArray( $array, $chkName, $chkLabel, $chkAttributes, $chkValue, $filters, $linebreak = true )
	{
		
		$chkHTML = '';
		//check whether an array
		if ( is_array( $array ) )
		{
			foreach ( $array as $key => $value )
			{
				//format input name without any spaces and no trailing whitespace
				$formatted = str_replace( ' ', '_', trim( strtolower( $value ) ) );
				$checked = '';
				//make into array of different options
				$name = $chkName . "[" . $formatted . "]";
				$label = $value;
				//admin JParams passed in 	
				if ( is_object( $filters ) )
				{
					if ( $filters->get( 'display_filter_' . $formatted ) ) :
						$checked = 'checked="checked"';
					endif;
				}
				//front end state filter int passed in 
				if ( is_int( $filters ) )
				{
					if ( $filters )
					{
						$checked = 'checked="checked"';
					}
				}
				//push over for chk creation
				$chkHTML .= self::checkbox( $name, $label, $chkValue, $chkAttributes, $checked, $linebreak );
			}
		}
		return $chkHTML;
	}
	
	/**
	 * Generates a created/modified select list
	 *
	 * @param string The value of the HTML name attribute
	 * @param string Additional HTML attributes for the <select> tag
	 * @param mixed The key that is selected
	 * @returns string HTML for the radio list
	 */
	public static function categorytype( $selected, $name = 'filter_categorytype', $attribs = array('class' => 'inputbox', 'size' => '1'), $idtag = null, $allowAny = false, $title = 'Select Category Type' )
	{
		$list = array( );
		if ( $allowAny )
		{
			$list[] = self::option( '', "- " . JText::_( $title ) . " -" );
		}
		
		JModel::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/models' );
		$model = JModel::getInstance( 'CategoryTypes', 'MediaManagerModel' );
		$items = $model->getList( );
		
		foreach ( $items as $item )
		{
			$list[] = JHTML::_( 'select.option', $item->categorytype_id, $item->categorytype_title );
		}
		
		return self::genericlist( $list, $name, $attribs, 'value', 'text', $selected, $idtag );
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $selected
	 * @param unknown_type $name
	 * @param unknown_type $attribs
	 * @param unknown_type $idtag
	 * @param unknown_type $allowAny
	 * @param unknown_type $title
	 * @return return_type
	 */
	public static function category( $selected, $categorytype_id='', $library_id='', $name = 'filter_category', $attribs = array('class' => 'inputbox', 'size' => '1'), $idtag = null, $allowAny = false, $title = 'Select Category' )
	{
		$list = array( );
		if ( $allowAny )
		{
			$list[] = self::option( '', "- " . JText::_( $title ) . " -" );
		}
		
		JModel::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/models' );
		if (empty($library_id)) 
		{
    		$model = JModel::getInstance( 'Categories', 'MediaManagerModel' );
    		$model->setState('filter_categorytype', $categorytype_id);
    		$items = $model->getList( );
		}
		    else 
		{
    		$model = JModel::getInstance( 'LibraryCategories', 'MediaManagerModel' );
    		$model->setState('filter_library', $library_id);
    		$model->setState('filter_categorytype', $categorytype_id);
    		$items = $model->getList( );		    
		}
		
		foreach ( $items as $item )
		{
			$list[] = JHTML::_( 'select.option', $item->category_id, $item->category_title );
		}
		
		return self::genericlist( $list, $name, $attribs, 'value', 'text', $selected, $idtag );
	}
	
	public static function group( $selected, $name = 'filter_group', $attribs = array('class' => 'inputbox', 'size' => '1'), $idtag = null, $allowAny = false, $title = 'Select Group' )
	{
		$list = array( );
		if ( $allowAny )
		{
			$list[] = self::option( '', "- " . JText::_( $title ) . " -" );
		}
		
		JModel::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/models' );
		$model = JModel::getInstance( 'Handlers', 'MediaManagerModel' );
		$items = $model->getGroups( );
		
		foreach ( $items as $item )
		{
			$list[] = JHTML::_( 'select.option', strtolower($item), strtolower($item) );
		}
		
		return self::genericlist( $list, $name, $attribs, 'value', 'text', $selected, $idtag );
	}
	
	/**
	 * Generates a created/modified select list
	 *
	 * @param string The value of the HTML name attribute
	 * @param string Additional HTML attributes for the <select> tag
	 * @param mixed The key that is selected
	 * @returns string HTML for the radio list
	 */
	public static function tag( $selected, $name = 'filter_tag', $attribs = array('class' => 'inputbox', 'size' => '1'), $idtag = null, $allowAny = false, $title = 'Select Tag' )
	{
		$list = array( );
		if ( $allowAny )
		{
			$list[] = self::option( '', "- " . JText::_( $title ) . " -" );
		}
		
		JModel::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/models' );
		$model = JModel::getInstance( 'Tags', 'MediaManagerModel' );
		$model->setState( 'order', 'tbl.tag_title' );
		$items = $model->getList( );
		
		foreach ( $items as $item )
		{
			$list[] = JHTML::_( 'select.option', $item->tag_id, $item->tag_title );
		}
		
		return self::genericlist( $list, $name, $attribs, 'value', 'text', $selected, $idtag );
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $selected
	 * @param unknown_type $name
	 * @param unknown_type $attribs
	 * @param unknown_type $idtag
	 * @param unknown_type $allowAny
	 * @param unknown_type $title
	 * @return return_type
	 */
	public static function sort( $selected, $name = 'filter_order', $attribs = array('class' => 'inputbox', 'size' => '1'), $idtag = null, $allowAny = false, $title = 'Select Field' )
	{
		$list = array( );
		if ( $allowAny )
		{
			$list[] = self::option( '', "- " . JText::_( $title ) . " -" );
		}
		
    	$list[] = JHTML::_( 'select.option', 'tbl.date_added', JText::_( "Date Added" ) );
    	$list[] = JHTML::_( 'select.option', 'tbl.hits', JText::_( "Popularity" ) );
    	$list[] = JHTML::_( 'select.option', 'tbl.media_title', JText::_( "Title" ) );
    	
		return self::genericlist( $list, $name, $attribs, 'value', 'text', $selected, $idtag );
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $selected
	 * @param unknown_type $name
	 * @param unknown_type $attribs
	 * @param unknown_type $idtag
	 * @param unknown_type $allowAny
	 * @param unknown_type $title
	 * @return return_type
	 */
	public static function library( $selected, $name = 'filter_library', $attribs = array('class' => 'inputbox', 'size' => '1'), $idtag = null, $allowAny = false, $title = 'Select Library' )
	{
		$list = array( );
		if ( $allowAny )
		{
			$list[] = self::option( '', "- " . JText::_( $title ) . " -" );
		}
		
		JModel::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_mediamanager/models' );
		$model = JModel::getInstance( 'Libraries', 'MediaManagerModel' );
		$items = $model->getList( );
		
		foreach ( $items as $item )
		{
			$list[] = JHTML::_( 'select.option', $item->library_id, $item->library_title );
		}
		
		return self::genericlist( $list, $name, $attribs, 'value', 'text', $selected, $idtag );
	}
	
	public static function video_loop( $selected, $name = 'video_loop', $attribs = array('class' => 'inputbox', 'size' => '1'), $idtag = null, $allowAny = false, $title = 'Loop' )
	{
	    $lists = array();
	
	    if ($allowAny)
	    {
	        $lists[] = JHTML::_('select.option', '', $title);
	    }
	
	    $lists[] = JHTML::_('select.option', 'none', 'none - do nothing (stop playback) whever a file is completed');
	    $lists[] = JHTML::_('select.option', 'list', 'list - play each file in the playlist once, stop at the end');
	    $lists[] = JHTML::_('select.option', 'always', 'always - continously play the file (or all files in the playlist)');
	    $lists[] = JHTML::_('select.option', 'single', 'single - continously repeat the current file in the playlist');
	
	    return self::genericlist($lists, $name, $attribs, 'value', 'text', $selected );
	}
}
