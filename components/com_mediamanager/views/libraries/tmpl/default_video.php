<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php $item = @$this->row; ?>

<div id="media-wrapper" class="wrap">
    <div class="handler-wrapper">
        <?php echo $this->handler_html; ?>
    </div>
</div>

<div class="meta-info wrap">
    <div id="media-description-wrapper" class="wrap left span6">
        <?php if (!empty($item->media_description)) { ?>
            <div class="meta-header h4 purple light-purple-bg">
                Description
            </div>
            <div id="media-description" class="description inner">
                <?php echo htmlspecialchars_decode( $item->media_description ); ?>
            </div>
        <?php } ?>
    </div>
    
    <div id="media-date-wrapper" class="wrap left span3 indent-20">
        <?php if (!empty($item->date_added)) { ?>
            <div class="meta-header h4 purple light-purple-bg">
                Date
            </div>
            <div id="media-date" class="date inner">
                <p><?php echo date( 'F j, Y', strtotime($item->date_added) ); ?></p>
            </div>
        <?php } ?>
    </div>
    
    <div id="media-tags-wrapper" class="wrap left span3 indent-20">
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