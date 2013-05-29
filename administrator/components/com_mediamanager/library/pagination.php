<?php
/**
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die();

jimport( 'joomla.html.pagination' );

class MediaManagerPagination extends JPagination 
{
    function __construct($total, $limitstart, $limit, $url='')
	{
	    $this->base_url = $url;
	    parent::__construct($total, $limitstart, $limit);
	}
	
	/**
	 * Create and return the pagination data object
	 *
	 * @access	public
	 * @return	object	Pagination data object
	 * @since	1.5
	 */
	function _buildDataObject()
	{
	    $this->limitstart_string = $this->base_url . "&limitstart=";
	    if (strpos($this->base_url, '?') === false) {
	        $this->limitstart_string = $this->base_url . "?limitstart=";
	    }	    
	    
		// Initialize variables
		$data = new stdClass();

		$data->all	= new JPaginationObject(JText::_('View All'));
		if (!$this->_viewall) {
			$data->all->base	= '0';
			$data->all->link	= JRoute::_( $this->limitstart_string );
		}

		// Set the start and previous data objects
		$data->start	= new JPaginationObject(JText::_('Start'));
		$data->previous	= new JPaginationObject(JText::_('Prev'));

		if ($this->get('pages.current') > 1)
		{
			$page = ($this->get('pages.current') -2) * $this->limit;

			$page = $page == 0 ? '' : $page; //set the empty for removal from route

			$data->start->base	= '0';
			$data->start->link	= JRoute::_( $this->limitstart_string );
			$data->previous->base	= $page;
			$data->previous->link	= JRoute::_( $this->limitstart_string . $page );
		}

		// Set the next and end data objects
		$data->next	= new JPaginationObject(JText::_('Next'));
		$data->end	= new JPaginationObject(JText::_('End'));

		if ($this->get('pages.current') < $this->get('pages.total'))
		{
			$next = $this->get('pages.current') * $this->limit;
			$end  = ($this->get('pages.total') -1) * $this->limit;

			$data->next->base	= $next;
			$data->next->link	= JRoute::_( $this->limitstart_string . $next);
			$data->end->base	= $end;
			$data->end->link	= JRoute::_( $this->limitstart_string . $end);
		}

		$data->pages = array();
		$stop = $this->get('pages.stop');
		for ($i = $this->get('pages.start'); $i <= $stop; $i ++)
		{
			$offset = ($i -1) * $this->limit;

			$offset = $offset == 0 ? '' : $offset;  //set the empty for removal from route

			$data->pages[$i] = new JPaginationObject($i);
			if ($i != $this->get('pages.current') || $this->_viewall)
			{
				$data->pages[$i]->base	= $offset;
				$data->pages[$i]->link	= JRoute::_( $this->limitstart_string . $offset);
			}
		}
		return $data;
	}
}
