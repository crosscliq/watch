<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php $item = @$this->row; ?>

<div class="default_audio wrap">

    <div id="media-image-wrapper" class="wrap left span6">
        <?php if (!empty($item->media_image)) { ?>
            <div id="media-image" class="image-frame">
                <img class="span6" src="<?php echo JURI::root() . $item->media_image; ?>" alt="<?php echo $item->media_title_long; ?>" title="<?php echo $item->media_title_long; ?>" />
            </div>
        <?php } ?>
    </div>
    
    <div class="meta-info wrap left span6 indent-20">
    
        <div id="media-wrapper" class="wrap span6">
            <div class="handler-wrapper">
                <?php echo $this->handler_html; ?>
            </div>
        </div>
        
    
        <div id="media-description-wrapper" class="wrap span6">
            <?php if (!empty($item->media_description)) { ?>
                <div class="meta-header h4 purple light-purple-bg">
                    Description
                </div>
                <div id="media-description" class="description inner">
                    <?php echo htmlspecialchars_decode( $item->media_description ); ?>
                </div>
            <?php } ?>
        </div>
        
        <?php /* ?>
        <div id="media-date-wrapper" class="wrap span3">
            <?php if (!empty($item->date_added)) { ?>
                <div class="meta-header h4 purple light-purple-bg">
                    Date
                </div>
                <div id="media-date" class="date inner">
                    <p><?php echo date( 'F j, Y', strtotime($item->date_added) ); ?></p>
                </div>
            <?php } ?>
        </div>
        */ ?>
        
        <div id="media-tags-wrapper" class="wrap span3 indent-20">
            <?php if (!empty($item->mediatags)) { ?>
                <div class="meta-header h4 purple light-purple-bg">
                    Tags
                </div>
                <div id="media-tags" class="tags inner">
                    <?php $key = 0; foreach ($item->mediatags as $mt) { if ($key > 0) { echo ", "; } echo "<a href='" . JRoute::_( $this->tag_url_base . $mt->tag_id ) . "'>" . $mt->tag_title . "</a>"; $key++; } ?>
                </div>
            <?php } ?>
        </div>
    
    </div>

</div>
