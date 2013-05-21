<?php 
defined('_JEXEC') or die('Restricted access');
JHTML::_('stylesheet', 'menu.css', 'media/com_locator/css/');
?>

<div id="<?php echo $this->name; ?>" class="submenu pull-left">

<ul class="nav nav-tabs">
<?php 
foreach ($this->items as $item) {
    
    if ($this->hide) {
        
        if ($item[2] == 1) {
        ?> <li class="active disabled" disabled="disabled"> <span class="nolink active disabled"><?php echo $item[0]; ?></span></li> <?php
        } else {
        ?> <li class="disabled" disabled="disabled"> <span class="nolink disabled"><?php echo $item[0]; ?></span></li> <?php    
        }
        
    } else {
        
        if ($item[2] == 1) {
        ?> <li class="active"><a class="active" href="<?php echo $item[1]; ?>"><?php echo $item[0]; ?></a></li><?php
        } else {
        ?> <li class=""><a href="<?php echo $item[1]; ?>"><?php echo $item[0]; ?></a></li> <?php   
        }        
    }
    
}
?>
</ul>
</div>