<?php
/**
* @package      MediaManager
* @copyright    Copyright (C) 2009 DT Design Inc. All rights reserved.
* @license      GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
* @link         http://www.dioscouri.com
*/

MediaManager::load( 'MediaManagerSelect', 'library.select' );

class MediaManagerSelectAudioJplayer extends MediaManagerSelect
{
    public static function url_target( $selected, $name = 'audiojplayer_url_target', $attribs = array('class' => 'inputbox', 'size' => '1'), $idtag = null, $allowAny = false, $title = 'Select URL Target' )
    {
        $lists = array();

        if ($allowAny)
        {
            $lists[] = JHTML::_('select.option', '', $title);
        }
        
        $lists[] = JHTML::_('select.option', '0', 'Same Window'); 
        $lists[] = JHTML::_('select.option', '1', 'New Window');
        $lists[] = JHTML::_('select.option', '2', 'Lightbox');
        
        return self::genericlist($lists, $name, $attribs, 'value', 'text', $selected );
    }
    
    public static function controlbar_position( $selected, $name = 'audiojplayer_controlbar_position', $attribs = array('class' => 'inputbox', 'size' => '1'), $idtag = null, $allowAny = false, $title = 'Select Position' )
    {
        $lists = array();
    
        if ($allowAny)
        {
            $lists[] = JHTML::_('select.option', '', $title);
        }
    
        $lists[] = JHTML::_('select.option', 'over', 'Over');
        $lists[] = JHTML::_('select.option', 'bottom', 'Bottom');
        $lists[] = JHTML::_('select.option', 'top', 'Top');
        $lists[] = JHTML::_('select.option', 'none', 'None');
        
    
        return self::genericlist($lists, $name, $attribs, 'value', 'text', $selected );
    }
}