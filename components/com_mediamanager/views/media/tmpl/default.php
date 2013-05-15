<?php defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('stylesheet', 'component.css', 'media/com_mediamanager/css/');
$item = @$this->row;
$helper = new MediaManagerHelperMedia();
$this->state = $helper->getState();
?>
<div id="mediamanager-content">

<div id="page-title">
    <?php if (!empty($this->state['library_id'])) { ?>
        <?php $back_url = "index.php?option=com_mediamanager&view=libraries&task=view&id=" . $this->state['library_id'] . "&reset=0"; ?>
        <?php if (!empty($this->state['tag_id'])) { ?>
            <?php $back_url .= "&tag_id=" . $this->state['tag_id']; ?> 
        <?php } ?>
        <a class="back left" href="<?php echo JRoute::_( $back_url ); ?>">Back to Multimedia</a>
    <?php } ?>
    
    <div class="title-wrap clear">
        <h1><?php echo $item->media_title_long; ?></h1>
    </div>
</div>

<div id="media-wrapper wrap">
    <?php echo $this->handler_html; ?>
</div>

<div class="wrap content-wrap">
    <div id="main">
        <?php if (!empty($item->media_description)) { ?>
            <div id="media-description"><?php echo htmlspecialchars_decode( $item->media_description ); ?></div>
        <?php } ?>
        <p>Date added: <?php echo date( 'M j', strtotime($item->date_added) ); ?></p>
    </div>
    <?php if (!empty($item->mediacategories)) { ?>
    <div id="related">
        <ul>
            <?php foreach ($this->category_types as $ct) { ?>
                <?php if (!empty($item->categories[$ct->categorytype_id]) && (empty($this->state['library_id']) || (in_array($ct->categorytype_id, $this->library_category_types)))) { ?>
                    <li> <?php echo $ct->categorytype_title; ?>: 
                    <?php foreach ($item->categories[$ct->categorytype_id] as $key=>$cat) { ?><?php if ($key > 0) { echo ", "; } ?><a href="<?php echo JRoute::_( "index.php?option=com_mediamanager&view=libraries&task=view&id=" . @$this->state['library_id'] . "&reset=1&filter_categories[]=" . $cat->category_id ); ?>"><?php echo $cat->category_title; ?></a><?php } ?>
                    </li>
                <?php } ?>
            <?php } ?>
            
            <?php if (!empty($item->mediatags)) { ?>
            <li>
                Tags: <?php $key = 0; foreach ($item->mediatags as $mt) { if ($key > 0) { echo ", "; } echo "<a href='" . JRoute::_( $this->tag_url_base . $mt->tag_id ) . "'>" . $mt->tag_title . "</a>"; $key++; } ?>
            </li>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>
</div>

<?php if (!empty($this->related_items)) { ?>
<h3 class="list-title">Related multimedia</h3>
<ul class="horiz features small">
    <?php foreach ($this->related_items as $ri) { ?>
    <?php $ri->types = explode('_', $ri->media_type); ?>
    <li>
        <a href="<?php echo JRoute::_( "index.php?option=com_mediamanager&view=media&id=" . $ri->media_id . "&library_id=" . @$this->state['library_id'] ); ?>">
            <div class="feature-info">
                <h4><?php echo JText::_( ucwords( @$ri->types[0] ) ); ?></h4>
                <p class="date"><?php echo JText::_( 'Date added' ) . ": " . date('M j', strtotime( $ri->date_added ) ); ?></p>
                <p><?php echo $ri->media_title; ?></p>
            </div>
            <img src="<?php echo $ri->media_image_remote; ?>" alt="<?php echo $ri->media_title; ?>" width="239" height="134">
            <span class="opacity"></span>
            <span class="media <?php echo @$ri->types[0]; ?>"></span>
        </a>
    </li>
    <?php } ?>
</ul>
<?php } ?>

</div>