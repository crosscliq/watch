<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('script', 'common.js', 'media/com_mediamanager/js/'); ?>
<?php $state = @$this->state; ?>
<?php $form = @$this->form; ?>
<?php $items = @$this->items; 

DSC::loadHighcharts();
?>

<form action="<?php echo JRoute::_( @$form['action'] )?>" method="post" name="adminForm" id="adminForm" id="adminForm" enctype="multipart/form-data">

	<table style="width: 100%;">
	<tr>
		<td style="width: 70%; max-width: 70%; vertical-align: top; padding: 0px 5px 0px 5px;">
			   <h1> LINE CHART </h1>
        	<?php
        $chartData = array(rand(1000, 3000), rand(1000, 4000), rand(1000, 5000), rand(1000, 6000), rand(1000, 8000), rand(1000, 11000));
  $series1 = new HighRollerSeriesData();
  $series1->addName('Station1')->addData($chartData);

    $chartData = array(rand(1000, 3000), rand(1000, 4000), rand(1000, 5000), rand(1000, 6000), rand(1000, 8000), rand(1000, 11000));
  $series2 = new HighRollerSeriesData();
  $series2->addName('Station2')->addData($chartData);
   $chartData = array(rand(1000, 3000), rand(1000, 4000), rand(1000, 5000), rand(1000, 6000), rand(1000, 8000), rand(1000, 11000));
  $series3 = new HighRollerSeriesData();
  $series3->addName('Station3')->addData($chartData);
  $linechart = new HighRollerLineChart();
  $linechart->chart->renderTo = 'linechart';
  $linechart->title->text = 'Connections Chart';
  $linechart->yAxis->title->text = 'Total';
  $linechart->addSeries($series1);
  $linechart->addSeries($series2);
  $linechart->addSeries($series3);
  $linechart -> credits-> enabled = false;
?>
<div id="linechart"></div>
  <script type="text/javascript">
    <?php echo $linechart->renderChart();?>
  </script>

		<h1>Reports</h1>

		<?php

		$chartdata = array();
		$chartdata[] = array('DEMO ADS', (int) rand(1, 500));
		$chartdata[] = array('DEMO ADS 2', (int) rand(1, 500) );
		$chartdata[] = array('DEMO ADS 3', (int) rand(1, 1000) );
		$chartdata[] = array('DEMO ADS 4', (int) rand(1, 1000) );
		$chartdata[] = array('DEMO ADS 5', (int) rand(1, 1000) );
		$chartdata[] = array('DEMO ADS 6', (int) rand(1, 1000) );
		// HIGHROLLER PIE CHART
		$chart = new HighRollerPieChart();

		$chart -> chart -> renderTo = 'chart';
		$chart -> chart -> plotBackgroundColor = NULL;
		$chart -> chart -> plotBorderWidth = NULL;
		$chart -> chart -> plotShadow = false;
		$chart -> title -> text = 'Advertisements';

		$chart -> plotOptions = new stdClass();
		$chart -> plotOptions -> pie = new stdClass();
		$chart -> plotOptions -> pie -> allowPointSelect = true;
		$chart -> plotOptions -> pie -> cursor = 'pointer';
		$chart -> plotOptions -> pie -> dataLabels = new stdClass();
		$chart -> plotOptions -> pie -> dataLabels -> enabled = true;
		$chart -> plotOptions -> pie -> dataLabels -> color = '#000000';
		$chart -> plotOptions -> pie -> dataLabels -> connectorColor = '#000000';
		$chart -> credits-> enabled = false;
		$series = new HighRollerSeriesData();
		$series -> addName('Rating') -> addData($chartdata);
		//$series -> type = 'pie';
		$chart -> addSeries($series);
		?>
		
        <div id="chart" style="width: 100%;"></div>
        
        <script type="text/javascript"><?php echo $chart -> renderChart(); ?></script>




			<?php
			$modules = JModuleHelper::getModules("mediamanager_dashboard_main");
			$document	= JFactory::getDocument();
			$renderer	= $document->loadRenderer('module');
			$attribs 	= array();
			$attribs['style'] = 'xhtml';
			foreach ( @$modules as $mod )
			{
				echo $renderer->render($mod, $attribs);
			}
			?>
		</td>
		<td style="vertical-align: top; width: 30%; min-width: 30%; padding: 0px 5px 0px 5px;">
		<h1>DEMO REPORTs</h1>	
			<?php

		$chartdata = array();
		$chartdata[] = array('DEMO ADS', (int) rand(1, 500));
		$chartdata[] = array('DEMO ADS 2', (int) rand(1, 500) );
		$chartdata[] = array('DEMO ADS 3', (int) rand(1, 1000) );
		$chartdata[] = array('DEMO ADS 4', (int) rand(1, 1000) );
		$chartdata[] = array('DEMO ADS 5', (int) rand(1, 1000) );
		$chartdata[] = array('DEMO ADS 6', (int) rand(1, 1000) );
		// HIGHROLLER PIE CHART
		$chart = new HighRollerPieChart();

		$chart -> chart -> renderTo = 'chart2';
		$chart -> chart -> plotBackgroundColor = NULL;
		$chart -> chart -> plotBorderWidth = NULL;
		$chart -> chart -> plotShadow = false;
		$chart -> title -> text = 'Advertisements';

		$chart -> plotOptions = new stdClass();
		$chart -> plotOptions -> pie = new stdClass();
		$chart -> plotOptions -> pie -> allowPointSelect = true;
		$chart -> plotOptions -> pie -> cursor = 'pointer';
		$chart -> plotOptions -> pie -> dataLabels = new stdClass();
		$chart -> plotOptions -> pie -> dataLabels -> enabled = true;
		$chart -> plotOptions -> pie -> dataLabels -> color = '#000000';
		$chart -> plotOptions -> pie -> dataLabels -> connectorColor = '#000000';
		$chart -> credits-> enabled = false;
		$series = new HighRollerSeriesData();
		$series -> addName('Rating') -> addData($chartdata);
		//$series -> type = 'pie';
		$chart -> addSeries($series);
		?>
		
        <div id="chart2" style="width: 100%;"></div>
        
        <script type="text/javascript"><?php echo $chart -> renderChart(); ?></script>

        <h1>OTHER DEMO REPORTs</h1>	
			<?php

		$chartdata = array();
		$chartdata[] = array('DEMO ADS', (int) rand(1, 500));
		$chartdata[] = array('DEMO ADS 2', (int) rand(1, 500) );
		$chartdata[] = array('DEMO ADS 3', (int) rand(1, 1000) );
		$chartdata[] = array('DEMO ADS 4', (int) rand(1, 1000) );
		$chartdata[] = array('DEMO ADS 5', (int) rand(1, 1000) );
		$chartdata[] = array('DEMO ADS 6', (int) rand(1, 1000) );
		// HIGHROLLER PIE CHART
		$chart = new HighRollerPieChart();

		$chart -> chart -> renderTo = 'chart3';
		$chart -> chart -> plotBackgroundColor = NULL;
		$chart -> chart -> plotBorderWidth = NULL;
		$chart -> chart -> plotShadow = false;
		$chart -> title -> text = 'Advertisements';

		$chart -> plotOptions = new stdClass();
		$chart -> plotOptions -> pie = new stdClass();
		$chart -> plotOptions -> pie -> allowPointSelect = true;
		$chart -> plotOptions -> pie -> cursor = 'pointer';
		$chart -> plotOptions -> pie -> dataLabels = new stdClass();
		$chart -> plotOptions -> pie -> dataLabels -> enabled = true;
		$chart -> plotOptions -> pie -> dataLabels -> color = '#000000';
		$chart -> plotOptions -> pie -> dataLabels -> connectorColor = '#000000';
		$chart -> credits-> enabled = false;
		$series = new HighRollerSeriesData();
		$series -> addName('Rating') -> addData($chartdata);
		//$series -> type = 'pie';
		$chart -> addSeries($series);
		?>
		
        <div id="chart3" style="width: 100%;"></div>
        
        <script type="text/javascript"><?php echo $chart -> renderChart(); ?></script>
			<?php
			$modules = JModuleHelper::getModules("mediamanager_dashboard_right");
			$document	= JFactory::getDocument();
			$renderer	= $document->loadRenderer('module');
			$attribs 	= array();
			$attribs['style'] = 'xhtml';
			foreach ( @$modules as $mod )
			{
				$mod_params = new DSCParameter( $mod->params );
				if ($mod_params->get('hide_title', '1')) { $mod->showtitle = '0'; }
				echo $renderer->render($mod, $attribs);
			}
			?>
		</td>
	</tr>
	</table>

	<?php echo $this->form['validate']; ?>
</form>
