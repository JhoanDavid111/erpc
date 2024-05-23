<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);

// Create axes
var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

for (var i = 0; i < 10; i++) {
  createSeries("value" + i, "Series #" + i);
}

// Create series
function createSeries(s, name) {
  var series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = "value" + s;
  series.dataFields.dateX = "date";
  series.name = name;

  var segment = series.segments.template;
  segment.interactionsEnabled = true;

  var hoverState = segment.states.create("hover");
  hoverState.properties.strokeWidth = 3;

  var dimmed = segment.states.create("dimmed");
  dimmed.properties.stroke = am4core.color("#dadada");

  segment.events.on("over", function(event) {
    processOver(event.target.parent.parent.parent);
  });

  segment.events.on("out", function(event) {
    processOut(event.target.parent.parent.parent);
  });

  var data = [];
  var value = Math.round(Math.random() * 100) + 100;
  for (var i = 1; i < 100; i++) {
    value += Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 30 + i / 5);
    var dataItem = { date: new Date(2018, 0, i) };
    dataItem["value" + s] = value;
    data.push(dataItem);
  }

  series.data = data;
  return series;
}

chart.legend = new am4charts.Legend();
chart.legend.position = "right";
chart.legend.scrollable = true;

// setTimeout(function() {
//   chart.legend.markers.getIndex(0).opacity = 0.3;
// }, 3000)
chart.legend.markers.template.states.create("dimmed").properties.opacity = 0.3;
chart.legend.labels.template.states.create("dimmed").properties.opacity = 0.3;

chart.legend.itemContainers.template.events.on("over", function(event) {
  processOver(event.target.dataItem.dataContext);
})

chart.legend.itemContainers.template.events.on("out", function(event) {
  processOut(event.target.dataItem.dataContext);
})

function processOver(hoveredSeries) {
  hoveredSeries.toFront();

  hoveredSeries.segments.each(function(segment) {
    segment.setState("hover");
  })
  
  hoveredSeries.legendDataItem.marker.setState("default");
  hoveredSeries.legendDataItem.label.setState("default");

  chart.series.each(function(series) {
    if (series != hoveredSeries) {
      series.segments.each(function(segment) {
        segment.setState("dimmed");
      })
      series.bulletsContainer.setState("dimmed");
      series.legendDataItem.marker.setState("dimmed");
      series.legendDataItem.label.setState("dimmed");
    }
  });
}

function processOut() {
  chart.series.each(function(series) {
    series.segments.each(function(segment) {
      segment.setState("default");
    })
    series.bulletsContainer.setState("default");
    series.legendDataItem.marker.setState("default");
    series.legendDataItem.label.setState("default");
  });
}

document.getElementById("button").addEventListener("click", function(){
  processOver(chart.series.getIndex(3));
})

}); // end am4core.ready()
</script>

<!-- HTML -->
<div id="chartdiv"></div>




<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Contrato","fas fa-restroom  mr-3","contrato/index","300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Ver Contrato</h2>
		<?php //$url_action = base_url."contrato/save&idcon=".$val[0]['idcon']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nueva Contrato</h2>
		<?php $url_action = base_url."contrato/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<div class="row">
			<input type="hidden" name="idcon" value="<?=isset($val) ? $val[0]['idcon'] : ''; ?>"/>
			<div class="form-group col-md-6" id="go1">
				<label for="nomcon">Contratista</label>
				<input type="text" class="form-control form-control-sm" id="nomcon" name="nomcon" value="<?=isset($val) ? $val[0]['nomcon'] : ''; ?>" <?=isset($val) ? ' disabled ' : ''; ?> />
			</div>
			<div class="form-group col-md-6" id="go2">
				<label for="perid">Abogado</label>
				<input type="text" class="form-control form-control-sm" id="perid" name="perid" value="<?=isset($val) ? $val[0]['perid'] : ''; ?>" <?=isset($val) ? ' disabled ' : ''; ?> />
			</div>
			<div class="form-group col-md-6" id="go3">
				<label for="valid">Área</label>
				<input type="number" class="form-control form-control-sm" id="valid" name="valid" value="<?=isset($val) ? $val[0]['valid'] : ''; ?>" <?=isset($val) ? ' disabled ' : ''; ?> />
			</div>
			<div class="form-group col-md-6" id="go3">
				<label for="parid">Tipo de Actividad</label>
				<input type="number" class="form-control form-control-sm" id="parid" name="parid" value="<?=isset($val) ? $val[0]['parid'] : ''; ?>" <?=isset($val) ? ' disabled ' : ''; ?> />
			</div>
			<div class="form-group col-md-6">
				<label for="linexpcon">Link Expediente Drive</label>
				<input type="text" class="form-control form-control-sm" id="linexpcon" name="linexpcon" value="<?=isset($val) ? $val[0]['linexpcon'] : ''; ?>" required  <?=isset($val) ? ' disabled ' : ''; ?> />
			</div>
		</div>
	</form>
</div>

<?php
	// if(isset($val) && $val[0]['perid']==1) echo "<script>anonima(1);</script>";
?>

<!-- Ver datos -->

<h2 class="title-c">Contratos</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Contrato</th>
	                <th>Estado</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($contratos)){
	        		foreach ($contratos as $va){ ?>
		            <tr>
		                <td>
		                	<strong>No.: <?=$va['nocon'];?></strong><br>
							<strong><?=$va['nomcon'];?></strong><br>
							<small>
								<strong>Área: </strong><?=$va['nomarea'];?><br>
								<strong>Abogado y/o Usuario: </strong><?=strtoupper($va['pernom']);?><br>
								<strong>Fecha: </strong><?=$va['feccon'];?>
								<strong>Tipo de Actividad: </strong><?=$va['parnom'];?>
	                            <strong>Link: </strong>
		                        <a href="<?=$va['linexpcon'];?>" target="_blank" title="Ir a Link <?=$va['linexpcon'];?>">
		                            <i class="fas fa-external-link-alt"></i>
		                        </a>
	                        </small>
		                </td>
		                <td style="text-align: center">
	                        <small>
                        		<?=$va['nomest'];?>
                        		<br><?=$va['fectra'];?>
                        		<br><br>
	                        	<strong>
	                        		Días Hab. 
	                        	</strong>
	                        </small>
		                </td>
		                <td style="text-align: center">
		                	<!-- <a href="<?=base_url?>contrato/edit&idcon=<?=$va['idcon'];?>">
		                		<i class="far fa-eye fa-2x" style="color: #523178;"></i>
		                	</a>
		                	<br> -->
		                	<i class="far fa-trash-alt fa-2x" style="color: #523178;"></i>
		                	<br><br>
		                	<i class="far fa-envelope fa-2x" style="color: #523178;"></i>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Contrato</th>
	                <th>Estado</th>
					<th></th>
	            </tr>
	        </tfoot>
	    </table>
		
	</div>

	<br>

<?php if(isset($edit) && isset($val)): ?>
	<script>ocultar(1,300);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>