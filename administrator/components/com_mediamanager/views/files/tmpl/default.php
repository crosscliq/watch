<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php $state = @$this->state; ?>
<?php $form = @$this->form; ?>
<?php $items = @$this->items; ?>

<form action="<?php echo JRoute::_( @$form['action'] )?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">

    <?php echo DSCGrid::pagetooltip(JRequest::getVar('view'));?>

    <table>
        <tr>
            <td align="left" width="100%">
            </td>
            <td nowrap="nowrap">
                <input name="filter" value="<?php echo @$state->filter; ?>" />
                <button onclick="this.form.submit();"><?php echo JText::_('Search'); ?></button>
                <button onclick="mediamanagerFormReset(this.form);"><?php echo JText::_('Reset'); ?></button>
            </td>
        </tr>
    </table>

    <table class="adminlist" style="clear: both;">
        <thead>
            <tr>
                <th style="width: 5px;">
                    <?php echo JText::_("Num"); ?>
                </th>
                <th style="width: 20px;">
                    <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( @$items ); ?>);" />
                </th>
                <th style="width: 50px;">
                    <?php echo DSCGrid::sort( 'ID', "tbl.file_id", @$state->direction, @$state->order ); ?>
                </th>
                <th style="text-align: left;">
                    <?php echo DSCGrid::sort( 'Filename', "tbl.file_name", @$state->direction, @$state->order ); ?> + 
                    <?php echo DSCGrid::sort( 'URL', "tbl.file_url", @$state->direction, @$state->order ); ?> + 
                    <?php echo DSCGrid::sort( 'Path', "tbl.file_path", @$state->direction, @$state->order ); ?>
                </th>
                <th style="width: 50px;">
                    <?php echo DSCGrid::sort( 'Extension', "tbl.file_extension", @$state->direction, @$state->order ); ?>
                </th>
                <th style="width: 100px;">
                    <?php echo DSCGrid::sort( 'Enabled', "tbl.file_enabled", @$state->direction, @$state->order ); ?>
                </th>
            </tr>
            <tr class="filterline">
                <th colspan="3">
                    <?php $attribs = array('class' => 'inputbox', 'size' => '1', 'onchange' => 'document.adminForm.submit();'); ?>
                    <div class="range">
                        <div class="rangeline">
                            <span class="label"><?php echo JText::_("From"); ?>:</span> <input id="filter_id_from" name="filter_id_from" value="<?php echo @$state->filter_id_from; ?>" size="5" class="input" />
                        </div>
                        <div class="rangeline">
                            <span class="label"><?php echo JText::_("To"); ?>:</span> <input id="filter_id_to" name="filter_id_to" value="<?php echo @$state->filter_id_to; ?>" size="5" class="input" />
                        </div>
                    </div>
                </th>
                <th style="text-align: left;">
                    <div class="range">
                        <div class="rangeline" style="text-align: left;">
                            <span class="label"><?php echo JText::_("Filename"); ?>:</span> <input id="filter_name" name="filter_name" value="<?php echo @$state->filter_name; ?>" size="25"/>
                        </div>
                        <div class="rangeline" style="text-align: left;">
                            <span class="label"><?php echo JText::_("URL/Path"); ?>:</span> <input id="filter_urlpath" name="filter_urlpath" value="<?php echo @$state->filter_urlpath; ?>" size="25"/>
                        </div>
                    </div>                
                </th>
                <th>
                </th>
                <th>
                    <?php echo MediaManagerSelect::booleans( @$state->filter_enabled, 'filter_enabled', $attribs, 'enabled', true, 'Enabled State' ); ?>
                </th>
            </tr>
            <tr>
                <th colspan="20" style="font-weight: normal;">
                    <div style="float: right; padding: 5px;"><?php echo @$this->pagination->getResultsCounter(); ?></div>
                    <div style="float: left;"><?php echo @$this->pagination->getListFooter(); ?></div>
                </th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="20">
                    <div style="float: right; padding: 5px;"><?php echo @$this->pagination->getResultsCounter(); ?></div>
                    <?php echo @$this->pagination->getPagesLinks(); ?>
                </td>
            </tr>
        </tfoot>
        <tbody>
        <?php $i=0; $k=0; ?>
        <?php foreach (@$items as $item) : ?>
            <tr class='row<?php echo $k; ?>'>
                <td align="center">
                    <?php echo $i + 1; ?>
                </td>
                <td style="text-align: center;">
                    <?php echo DSCGrid::checkedout( $item, $i, 'file_id' ); ?>
                </td>
                <td style="text-align: center;">
                    <a href="<?php echo $item->link; ?>">
                        <?php echo $item->file_id; ?>
                    </a>
                </td>
                <td style="text-align: left;">
                    <a href="<?php echo $item->link; ?>">
                        <?php echo $item->file_name; ?>
                    </a>
                    <?php 
                    if (!empty($item->file_url)) {
                        echo "<br/>&nbsp;&nbsp;<b>" . JText::_( "URL" ) . ":</b> " . $item->file_url;
                    }
                    if (!empty($item->file_path)) {
                        echo "<br/>&nbsp;&nbsp;<b>" . JText::_( "Path" ) . ":</b> " . $item->file_path;
                    }
                    ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $item->file_extension; ?>
                </td>
                <td style="text-align: center;">
                    <?php echo DSCGrid::enable($item->file_enabled, $i, 'file_enabled.' ); ?>
                </td>
            </tr>
            <?php $i=$i+1; $k = (1 - $k); ?>
            <?php endforeach; ?>
            
            <?php if (!count(@$items)) : ?>
            <tr>
                <td colspan="10" align="center">
                    <?php echo JText::_('NO ITEMS FOUND'); ?>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <input type="hidden" name="order_change" value="0" />
    <input type="hidden" name="id" value="" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="" />
    <input type="hidden" name="filter_order" value="<?php echo @$state->order; ?>" />
    <input type="hidden" name="filter_direction" value="<?php echo @$state->direction; ?>" />
    
    <?php echo $this->form['validate']; ?>
</form>