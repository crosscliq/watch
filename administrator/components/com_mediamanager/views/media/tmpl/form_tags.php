<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('script', 'common.js', 'media/com_mediamanager/js/'); ?>
<?php $mediatags = (!empty($this->mediatags)) ? $this->mediatags : array(); ?>
<?php $removeUrl = 'index.php?format=raw&option=com_mediamanager&view=media&task=removeTag&mediatag_id='; ?>
<?php $removeUrlString = 'index.php?format=raw&option=com_mediamanager&view=media&task=removeTag&tag_title='; ?>

<style type="text/css">
.left { float: left; }
div.tag {
    float: left;
    line-height: 16px;
    border: 1px solid #E9E9E9;
    margin-right: 9px;
    margin-bottom: 5px;
    margin-top: 5px;
    padding: 3px;
}

div.tag_title {
    float: left;
    vertical-align: middle;
    margin-right: 3px;
}

img.x_img {
    vertical-align:middle;
    border: 0;
    margin: 0;
    padding: 0;
}
</style>

<div id="tag_validation"></div>

<div id="tag_wrapper">
    <div id="tag_form">
        Enter a new one
        <input type="text" name="new_tag_name" id="new_tag_name" size="25" onkeypress="handleKeyPress(event,this.form)" class="dsc-no-float" />
        or select an existing one
        <?php echo MediaManagerSelect::tag( null, 'existing_tag_id', array('class'=>'dsc-no-float'), null, true ); ?>
        <span class="button href" onclick="mediamanagerAddTag( '<?php echo JText::_( "Adding Tag" ); ?>' );"><?php echo JText::_( "Add Tag" ); ?></span>
    </div>
    
    <div id="tag_list">
	<?php $i=0; ?>
	<?php foreach ($mediatags as $tag) : ?>
    	<div id="tag<?php echo $i; ?>" class="tag">    		
        	<div class="tag_title">
                <?php if (!empty($tag->tag_title)) { ?>
        		    <?php echo $tag->tag_title; ?>
                <?php } elseif (is_string($tag)) { ?>
                    <?php echo $tag; ?>
                    <input type="hidden" name="mediatags[]" value="<?php echo $tag; ?>" />
                <?php } ?>
        	</div>
            <?php if (!empty($tag->mediatag_id)) { ?>
            <span class="href">
            	<img src="<?php echo DSC::getURL('images'); ?>publish_x.png" class="left x_img" onclick="mediamanagerDoTask('<?php echo $removeUrl.$tag->mediatag_id; ?>', 'tag_wrapper', document.adminForm, 'Deleting');" />
            </span>
            <?php } elseif (is_string($tag)) { ?>
            <span class="href">
                <img src="<?php echo DSC::getURL('images'); ?>publish_x.png" class="left x_img" onclick="mediamanagerDoTask('<?php echo $removeUrlString.urlencode($tag); ?>', 'tag_wrapper', document.adminForm, 'Deleting');" />
            </span>            
            <?php } ?>
    	</div>
	<?php $i++; ?>
	<?php endforeach; ?>
    </div>
</div>

<script type="text/javascript">
function handleKeyPress(e,form)
{
    var key=e.keyCode || e.which;
    if (key==13) {
        mediamanagerAddTag( '<?php echo JText::_( "Adding Tag" ); ?>' );
    }
}
</script>