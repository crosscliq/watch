<?php defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_( 'script', 'common.js', 'media/com_mediamanager/js/' );
?>

<?php if ( $v != 2) { ?>
<div id="event-filter">
<?php } ?>
    <form name="multimedia_filters" class="multimedia-form" id="multimedia_filters" action="" method="post">
        <ul class="primary_categories">       
        	<?php foreach (@$primary_categories as $ct):?>
        		<li class="">
                    <?php echo MediaManagerSelect::category( @$state['categories'], $ct->categorytype_id, $library_id, 'categories[]' , array('class' => 'inputbox', 'size' => '1', 'onchange'=>$onclick_primary ), 'filter_categories_'.$ct->categorytype_id, true, 'Select ' . $ct->categorytype_title ); ?>
                </li>
        	<?php endforeach;?>
    	</ul>
    
        <ul class="secondary_categories">
        	<?php foreach (@$secondary_categories as $category):?>					
        		<li>
                    <input type="radio" <?php echo $category->checked ? "checked" : ''; ?> name="secondary_category" value="<?php echo $category->id; ?>" onclick="<?php echo $onclick_secondary; ?>" /><?php echo $category->title . ' (' . $category->count . ')'; ?>
                </li>		
        	<?php endforeach;?>
        </ul>
        <input type="hidden" name="Itemid" value="<?php echo $item_id; ?>" />
    </form>
<?php if ( $v != 2) { ?>
</div>
<?php } ?>

<?php // echo MediaManager::dump($state); ?>