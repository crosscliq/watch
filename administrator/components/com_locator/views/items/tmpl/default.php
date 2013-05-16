<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php $state = @$this->state; ?>
<?php $form = @$this->form; ?>
<?php $items = @$this->items; ?>

<form action="<?php echo JRoute::_( @$form['action'] )?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">

	<?php echo DSCGrid::pagetooltip( JRequest::getVar('view') ); ?>
	
   <?php echo DSCGrid::searchform(@$state->filter ) ?>


    <table class="adminlist table table-striped table-bordered" style="clear: both;">
		<thead>
            <tr>
                <th style="width: 5px;">
                	<?php echo JText::_("Num"); ?>
                </th>
                <th style="width: 20px;">
                	<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(<?php echo count( @$items ); ?>);" />
                </th>
                <th style="width: 50px;">
                	<?php echo DSCGrid::sort( 'ID', "tbl.item_id", @$state->direction, @$state->order ); ?>
                </th>                
                <th style="text-align: left;width: 50%">
                	<?php echo DSCGrid::sort( 'Name', "tbl.name", @$state->direction, @$state->order ); ?>
                </th>
                <th style="width: 100px;">
                	<?php echo DSCGrid::sort( 'Street', "tbl.street", @$state->direction, @$state->order ); ?>
                </th>
                <th style="width: 100px;">
                	<?php echo DSCGrid::sort( 'City', "tbl.city", @$state->direction, @$state->order ); ?>
                </th>
                <th style="width: 100px;">
                    <?php echo DSCGrid::sort( 'State', "tbl.state", @$state->direction, @$state->order ); ?>
                </th>
                <th style="width: 100px;">
    	            <?php echo DSCGrid::sort( 'Zip', "tbl.zip", @$state->direction, @$state->order ); ?>
    	        
                </th>
                <th style="width: 100px;">
    	            <?php echo DSCGrid::sort( 'Type', "tbl.type", @$state->direction, @$state->order ); ?>
    	        
                </th>
                 <th style="width: 100px;">
    	            <?php echo DSCGrid::sort( 'Lat', "tbl.latitude", @$state->direction, @$state->order ); ?>
    	        
                </th>
                 <th style="width: 100px;">
    	            <?php echo DSCGrid::sort( 'Long', "tbl.longitude", @$state->direction, @$state->order ); ?>
    	        
                </th>
                <th style="width: 100px;">
    	            <?php echo DSCGrid::sort( 'Enabled', "tbl.enabled", @$state->direction, @$state->order ); ?>
                </th>
            </tr>
            <tr class="filterline">
                <th colspan="3">
                    <?php $attribs = array('class' => 'inputbox', 'size' => '1', 'onchange' => 'document.adminForm.submit();'); ?>
                    <div class="range">
                        <div class="rangeline">
                            <input type="text" placeholder="<?php echo JText::_("From"); ?>" id="filter_id_from" name="filter_id_from" value="<?php echo @$state->filter_id_from; ?>" size="5" class="input input-small" width="50px" />
                        </div>
                        <div class="rangeline">
                            <input type="text" placeholder="<?php echo JText::_("To"); ?>" id="filter_id_to" name="filter_id_to" value="<?php echo @$state->filter_id_to; ?>" size="5" class="input input-small" />
                        </div>
                    </div>
                </th>
                <th style="text-align: left;">
                	<input id="filter_name" name="filter_name" type="text" value="<?php echo @$state->filter_name; ?>" size="75"/>
                    
                </th>
                <th>
                	
                    <?php //echo LocatorSelect::state( @$state->filter_state, 'filter_state', $attribs, 'state', true, 'State' ); ?>
                </th>
                <th>
                	
                    <?php // echo LocatorSelect::city( @$state->filter_city, 'filter_city', $attribs, 'city', true, 'City' ); ?>
                </th>
                <th>
                   
                </th>
                <th>
                
                </th>
                <th>
                
                </th>
                <th>
                
                </th>
                <th>
                
                </th>
                <th>
                    <?php echo DSCSelect::booleans( @$state->filter_enabled, 'filter_enabled', $attribs, 'enabled', true, 'Enabled State' ); ?>
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
                    <div class="pagination pagination-toolbar">
                    <?php echo @$this->pagination->getPagesLinks(); ?>
                    </div>
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
					<?php echo DSCGrid::checkedout( $item, $i, 'id' ); ?>
				</td>
				<td style="text-align: center;">
					<a href="<?php echo $item->link; ?>">
						<?php echo $item->item_id; ?>
					</a>
				</td>	
				<td style="text-align: left;">
					<a href="<?php echo $item->link; ?>">
						<?php echo $item->name; ?>
					</a>
				</td>
				<td style="text-align: center;">
					<?php echo $item->street; ?>
				</td>
				<td style="text-align: center;">
					<?php echo $item->city; ?>
				</td>
                <td style="text-align: center;">
                    <?php echo $item->state; ?>
                </td>
				<td style="text-align: center;">
					<?php echo $item->zip; ?>
				</td>
				<td style="text-align: center;">
					<?php echo $item->type; ?>
				</td>
				<td style="text-align: center;">
					<?php echo $item->latitude; ?>
				</td>
				<td style="text-align: center;">
					<?php echo $item->longitude; ?>
				</td>
				<td style="text-align: center;">
					<?php echo DSCGrid::enable($item->enabled, $i, 'enabled.'); ?>
				</td>
			</tr>
			<?php $i=$i+1; $k = (1 - $k); ?>
			<?php endforeach; ?>
			
			<?php if (!count(@$items)) : ?>
			<tr>
				<td colspan="10" align="center">
					<?php echo JText::_('No items found'); ?>
				</td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>

	<input type="hidden" name="order_change" value="0" />
	<input type="hidden" name="id" value="" />
	<input type="hidden" name="task" id="task" value="" />
	<input type="hidden" name="boxchecked" value="" />
	<input type="hidden" name="filter_order" value="<?php echo @$state->order; ?>" />
	<input type="hidden" name="filter_direction" value="<?php echo @$state->direction; ?>" />
	
	<?php echo $this->form['validate']; ?>
</form>