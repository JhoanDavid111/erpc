<!-- Inicio Gráfico ///////////////////////////////////////////////// -->
<!-- <script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.PieChart);

// Add data

<?php 
	$datap = "[";

	$i = 0;
	foreach ($dpie as $pie) {
		$datap .= "{";
			$datap .= '"country": "'.$pie ['valnom'].'",';
			$datap .= '"litres": '.$pie ['Asig'];

		$datap .= "}";

		if ($i < count($dpie)-1) {
			$datap .= ",";
		}
		$i++;
	}
	$datap .= "]";
	?>

	chart.data=<?=$datap ?>;



// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";
pieSeries.innerRadius = am4core.percent(50);
pieSeries.ticks.template.disabled = true;
pieSeries.labels.template.disabled = true;

var rgm = new am4core.RadialGradientModifier();
rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
pieSeries.slices.template.fillModifier = rgm;
pieSeries.slices.template.strokeModifier = rgm;
pieSeries.slices.template.strokeOpacity = 0.4;
pieSeries.slices.template.strokeWidth = 0;

chart.legend = new am4charts.Legend();
chart.legend.position = "right";

}); // end am4core.ready()
</script>

<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv2", am4charts.XYChart);

// Add data
chart.data = [{
  "category": "",
  "from": 0,
  "to": 15,
  "name": "Stage #1",
  "fill": am4core.color("#0ca948")
}, {
  "category": "",
  "from": 15,
  "to": 75,
  "name": "Stage #2",
  "fill": am4core.color("#93da49")
}, {
  "category": "",
  "from": 75,
  "to": 90,
  "name": "Stage #3",
  "fill": am4core.color("#ffd100")
}, {
  "category": "",
  "from": 90,
  "to": 95,
  "name": "Stage #4",
  "fill": am4core.color("#cd213b")
}, {
  "category": "",
  "from": 95,
  "to": 100,
  "name": "Stage #5",
  "fill": am4core.color("#9e9e9e")
}];

// Create axes
var yAxis = chart.yAxes.push(new am4charts.CategoryAxis());
yAxis.dataFields.category = "category";
yAxis.renderer.grid.template.disabled = true;
yAxis.renderer.labels.template.disabled = true;

var xAxis = chart.xAxes.push(new am4charts.ValueAxis());
xAxis.renderer.grid.template.disabled = true;
xAxis.renderer.grid.template.disabled = true;
xAxis.renderer.labels.template.disabled = true;
xAxis.min = 0;
xAxis.max = 100;

// Create series
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueX = "to";
series.dataFields.openValueX = "from";
series.dataFields.categoryY = "category";
series.columns.template.propertyFields.fill = "fill";
series.columns.template.strokeOpacity = 0;
series.columns.template.height = am4core.percent(100);

// Ranges/labels
chart.events.on("beforedatavalidated", function(ev) {
  var data = chart.data;
  for(var i = 0; i < data.length; i++) {
    var range = xAxis.axisRanges.create();
    range.value = data[i].to;
    range.label.text = data[i].to + "%";
    range.label.horizontalCenter = "right";
    range.label.paddingLeft = 5;
    range.label.paddingTop = 5;
    range.label.fontSize = 10;
    range.grid.strokeOpacity = 0.2;
    range.tick.length = 18;
    range.tick.strokeOpacity = 0.2;
  }
});

// Legend
var legend = new am4charts.Legend();
legend.parent = chart.chartContainer;
legend.itemContainers.template.clickable = false;
legend.itemContainers.template.focusable = false;
legend.itemContainers.template.cursorOverStyle = am4core.MouseCursorStyle.default;
legend.align = "right";
legend.data = chart.data;

}); // end am4core.ready()
</script>

<script>
am4core.ready(function() {
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv3", am4charts.XYChart);

<?php 

	$datap = "[";

	$i = 0;

	foreach ($dxyc as $xyc) {
		$dtcdp = $pfinan->sumcdpR($xyc['codrub']);
		$dtrp = $pfinan->sumrpR($xyc['codrub']);
		$cdp= isset($dtcdp[0]['cdp']) ? $dtcdp[0]['cdp']:0;
		$rp= isset($dtrp[0]['rp']) ? $dtrp[0]['rp']:0;
		$dispo = ($xyc['Asig']-$cdp-$rp);
		$datap .= "{";
			$datap .= '"region": "'.$ninipaa.$xyc['codrub'].'",';
			$datap .= '"state": "RPs'.$i.'",';
			$datap .= '"sales": '.$rp;

		$datap .= "},";
		$datap .= "{";
			$datap .= '"region": "'.$ninipaa.$xyc['codrub'].'",';
			$datap .= '"state": "CDP'.$i.'",';
			$datap .= '"sales": '.$cdp;

		$datap .= "},";
		$datap .= "{";
			
			$datap .= '"region": "'.$ninipaa.$xyc['codrub'].'",';
			$datap .= '"state": "Disponible'.$i.'",';
			$datap .= '"sales": '.$dispo;

		$datap .= "},";
		$datap .= "{";
			$datap .= '"region": "'.$ninipaa.$xyc['codrub'].'",';
			$datap .= '"state": "Asignación'.$i.'",';
			$datap .= '"sales": '.$xyc['Asig'];
		$datap .= "},";
		$datap .= "{";
			$datap .= '"region": "'.$ninipaa.$xyc['codrub'].'",';
			$datap .= '"state": "_'.$i.'",';
			$datap .= '"sales": 0';
		$datap .= "}";

		if ($i < count($dxyc)-1) {
			$datap .= ",";
		}
		$i++;
	}
	$datap .= "]";
	
	?>

	chart.data=<?=$datap ?>;

var yAxis = chart.yAxes.push(new am4charts.CategoryAxis());
yAxis.dataFields.category = "state";
yAxis.renderer.grid.template.location = 0;
yAxis.renderer.labels.template.fontSize = 10;
yAxis.renderer.minGridDistance = 10;

var xAxis = chart.xAxes.push(new am4charts.ValueAxis());

var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueX = "sales";
series.dataFields.categoryY = "state";
series.columns.template.tooltipText = "{categoryY}: [bold]{valueX}[/]";
series.columns.template.strokeWidth = 0;
series.columns.template.adapter.add("fill", function(fill, target) {
  if (target.dataItem) {
    switch(target.dataItem.dataContext.region) {
    	<?php 
    		$i=0;
    		foreach ($dxyc as $xyc) {
    	 ?>
		      case "<?=$ninipaa.$xyc['codrub']?>":
		        return chart.colors.getIndex(<?=$i?>);
		        break;
		     
    	<?php $i++;} ?>
    }
  }
  return fill;
});

var axisBreaks = {};
var legendData = [];

function addRange(label, start, end, color) {
  var range = yAxis.axisRanges.create();
  range.category = start;
  range.endCategory = end;
  range.label.text = label;
  range.label.disabled = false;
  range.label.fill = color;
  range.label.location = 0;
  range.label.dx = -5;
  range.label.dy = 12;
  range.label.fontWeight = "bold";
  range.label.fontSize = 11;
  range.label.horizontalCenter = "left"
  range.label.inside = true;
  
  range.grid.stroke = am4core.color("#396478");
  range.grid.strokeOpacity = 1;
  range.tick.length = 200;
  range.tick.disabled = false;
  range.tick.strokeOpacity = 0.6;
  range.tick.stroke = am4core.color("#396478");
  range.tick.location = 0;
  
  range.locations.category = 1;
  var axisBreak = yAxis.axisBreaks.create();
  axisBreak.startCategory = start;
  axisBreak.endCategory = end;
  axisBreak.breakSize = 1;
  axisBreak.fillShape.disabled = true;
  axisBreak.startLine.disabled = true;
  axisBreak.endLine.disabled = true;
  axisBreaks[label] = axisBreak;  

  legendData.push({name:label, fill:color});
}

<?php 
	$i=0;
	$txt = "";
	foreach ($dxyc as $xyc) {
		echo  'addRange("'.$ninipaa.$xyc['codrub'].' '.$xyc['nomrub'].'", "_'.$i.'", "RPs'.$i.'", chart.colors.getIndex('.$i.'));';
		$i++;
	}
 ?>

chart.cursor = new am4charts.XYCursor();
var legend = new am4charts.Legend();
legend.position = "right";
legend.scrollable = true;
legend.valign = "top";
legend.reverseOrder = true;

chart.legend = legend;
legend.data = legendData;

legend.itemContainers.template.events.on("toggled", function(event){
  var name = event.target.dataItem.dataContext.name;
  var axisBreak = axisBreaks[name];
  if(event.target.isActive){
    axisBreak.animate({property:"breakSize", to:0}, 1000, am4core.ease.cubicOut);
    yAxis.dataItems.each(function(dataItem){
      if(dataItem.dataContext.region == name){
        dataItem.hide(1000, 500);
      }
    })
    series.dataItems.each(function(dataItem){
      if(dataItem.dataContext.region == name){
        dataItem.hide(1000, 0, 0, ["valueX"]);
      }
    })    
  }
  else{
    axisBreak.animate({property:"breakSize", to:1}, 1000, am4core.ease.cubicOut);
    yAxis.dataItems.each(function(dataItem){
      if(dataItem.dataContext.region == name){
        dataItem.show(1000);
      }
    })  

    series.dataItems.each(function(dataItem){
      if(dataItem.dataContext.region == name){
        dataItem.show(1000, 0, ["valueX"]);
      }
    })        
  }
})

}); 
</script> -->
<!-- Fin Gráfico ///////////////////////////////////////////////// -->


<h2 class="title-c">Plan Anual de Adquisiciones Detalle&nbsp;&nbsp;&nbsp;&nbsp;</h2>

<?php if (!isset($_SESSION['inspaa'])) { ?>

	<?php if($_SESSION['pefid']==21 OR $_SESSION['pefid']==34){ ?>				
			<a href="<?=base_url?>paa/index&new=1" class="fas fa-plus-square fa-2x" style="color: #f66f16;" title="Nuevo Registro"></a>
	<?php } ?>

<!-- Inicio Selección área ///////////////////////////////////////////////// -->
 	<?php	if($_SESSION['pefid']!=31){	?>
 		<?php if(!isset($pfinandOne)): ?>
				<form class="m-tb-40" action="<?=base_url;?>paa/index" method="POST">
					<!-- <div class="row">
		

 						<div class="form-group col-md-3">
							<label for="areas">Areas</label>
							<select id="areas" name="areas" class="form-control form-control-sm" style="padding: 0px;" onchange="this.form.submit();">
								<option value="0">Seleccione área</option>
								<?php foreach ($areas2 as $pf){ ?>
									

									<option value="<?=$pf['valid'];?>"<?= $pf['valid'] == $area ? ' selected ' : ''; ?>><?=$pf['valnom'];?>
										
									</option>

									
								<?php } ?>
							</select>

						</div>
					</div> -->
					<?php if(isset($_SESSION['actpaa'])): ?>
						<?php if ($_SESSION['actpaa']=="si"): ?>
							<strong style="color:green;">Actualización Exitosa!!</strong>
						<?php endif; ?>
						<?php if ($_SESSION['actpaa']=="no"): ?>
							<strong style="color:red;">Error al Actualizar</strong>
						<?php endif; ?>
						<?php Utils::deleteSession('actpaa'); ?>
					<?php endif; ?>
					
				</form>
	<?php endif; ?>
<?php } ?>
<!-- Fin Selección área ///////////////////////////////////////////////// -->


<!-- Inicio tabla Rubro Disponible y Asignado ///////////////////////////////////////////////// -->

			<h4 class="title-c">Presupuesto disponible&nbsp;&nbsp;&nbsp;&nbsp;</h4>
			<?php //if(isset($pfinand) && !isset($codrub)): ?>
			<?php if(isset($pfinand)): ?>
				<br><br>
				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
						<thead>
							<tr>
								<th>Código</th>
								<th>Objeto</th>						
								<th>Asignación&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th>Disponible&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							
								<?php foreach ($pfinand as $pf){ ?>
									<tr>
										<td><small><?=$ninipaa.$pf['codrub'];?></small></td>
											<!-- <td><?//=$pf['unspsc'];?></td> -->
										<td>
											<?=$pf['nobjeto'];?>
											<br><br>
												<strong>Área: </strong><?=$pf['are'];?>
											<br>
											<small>
												<strong>Fecha Inicio: </strong><?=$pf['fecinidpa'];?>
												<br>
												<strong>Fecha Fin: </strong>
												<?=$pf['fecfindpa'];?>
												<br>
												<strong>Modalidad:</strong>
												<?=$pf['moda'];?>
												<br>
												<strong>Fuente: </strong>
												<?=$pf['fuen'];?>
											</small>
										</td>
										<?php
											$TAsig = $pfinan->TotAsig($pf['iddpa']);
											$TAsig1 = isset($TAsig[0]['asidpa']) ? $TAsig[0]['asidpa']:0;
											$TAsig2 = isset($TAsig[0]['TotAsig']) ? $TAsig[0]['TotAsig']:0;
											$TAsig3 = $TAsig1 + $TAsig2;
										?>
										<td align="right">
											$ <?=number_format($TAsig3, 0, ',', '.');?></td>
										<?php 
											$dtcdp = $pfinan->sumcdp($pf['iddpa']);
											$dtrp = $pfinan->sumrp($pf['iddpa']);
											$cdp= isset($dtcdp[0]['cdp']) ? $dtcdp[0]['cdp']:0;
											$rp= isset($dtrp[0]['rp']) ? $dtrp[0]['rp']:0;
											$dispo = ($pf['asidpa']-$cdp-$rp);
											$sumasi += $pf['asidpa'];
											$sumdis += $dispo;
											$sumcdp += $cdp;
											$sumrp += $rp;
										?>
										<td align="right">$ <?=number_format($dispo, 0, ',', '.');?></td>
										<td>
											<?php if($_SESSION['pefid']==21 OR $_SESSION['pefid']==34){ ?>	
												<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="Editar">
			                		<i class="fas fa-edit" style="color: #523178;"></i>
			                	</a>
			                <?php } ?>
												<br><br>
			                	<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>&soli=true" title="CDP">
			                		<i class="fas fa-file-invoice-dollar" style="color: #523178;"></i>
			                	</a>
			                	<br><br>
			                	<!-- <a href="<?=base_url?>cdp/solicdp&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="SOLICITAR">
			                		<i class="fas fa-sign-in-alt" style="color: #523178;"></i>
			                	</a> -->
										</td>
									</tr>
								<?php } ?>
					
							
						</tbody>
						<tfoot>
							<tr>
								<td></td>
								<td></td>						
								<td align="right"><strong>$ <?=number_format($sumasi, 0, ',', '.');?></strong></td>
								<td align="right"><strong>$ <?=number_format($sumdis, 0, ',', '.');?></strong></td>
								<td></td>
							</tr>
							<tr>
								<th>Código</th>
								<th>Objeto</th>						
								<th>Asignación</th>
								<th>Disponible</th>
								<th></th>
							</tr>
				    </tfoot>
					</table>					
				</div>
			<?php endif; ?>	
<!-- Fin tabla Rubro Disponible y Asignado ///////////////////////////////////////////////// -->


<!-- Inicio tabla CDP ///////////////////////////////////////////////////////////////////////// -->
			<br>
			<h4 class="title-c">CDP's&nbsp;&nbsp;&nbsp;&nbsp;</h4>
			<?php if(isset($pfcdp)): ?>
				<br><br>
				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
						<thead>
							<tr>
								<th>Código</th>
								<th>Objeto</th>						
								<th>Valor CDP's &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th>Estado&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							
								<?php foreach ($pfcdp as $pf){ ?>
									<tr>
										<td><small><?=$ninipaa.$pf['codrub'];?></small></td>
											<!-- <td><?//=$pf['unspsc'];?></td> -->
										<td>
											<?=$pf['nobjeto'];?>
											<br><br>
												<strong>Área: </strong><?=$pf['are'];?>
											<br>
											<small>
												<strong>Fecha Inicio: </strong><?=$pf['fecinidpa'];?>
												<br>
												<strong>Fecha Fin: </strong>
												<?=$pf['fecfindpa'];?>
												<br>
												<strong>Modalidad:</strong>
												<?=$pf['moda'];?>
												<br>
												<strong>Fuente: </strong>
												<?=$pf['fuen'];?>
											</small>
										</td>
										<td align="right">$ <?=number_format($pf['asidpa'], 0, ',', '.');?></td>
										<?php 
											$dtcdp = $pfinan->sumcdp($pf['iddpa']);
											$dtrp = $pfinan->sumrp($pf['iddpa']);
											$cdp= isset($dtcdp[0]['cdp']) ? $dtcdp[0]['cdp']:0;
											$rp= isset($dtrp[0]['rp']) ? $dtrp[0]['rp']:0;
											$dispo = ($pf['asidpa']-$cdp-$rp);
											$sumasi += $pf['asidpa'];
											$sumdis += $dispo;
											$sumcdp += $cdp;
											$sumrp += $rp;
										?>
										<td><?=$pf['actflu'];?></td>

										<td>
											<?php if($_SESSION['pefid']==21 OR $_SESSION['pefid']==34){ ?>	
												<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="Editar">
			                		<i class="fas fa-eye" style="color: #523178;"></i>
			                	</a>
			                <?php } ?>
												<br><br>
			                	<!-- <a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>&soli=true" title="CDP">
			                		// <i class="fas fa-file-invoice-dollar" style="color: #523178;"></i>
			                		<i class="fas fa-eye" style="color: #523178;"></i>
			                	</a> -->
			                	<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>&apro=1" title="Aprobar o Rechazar">
			                		<i class="fas fa-arrow-alt-circle-right" style="color: #523178;"></i>
			                	</a>
			                	<br><br>
			                	
			                	<a href="<?=base_url?>paa/delcdp&iddpa=<?=$pf['iddpa'];?>" title="Eliminar CDP">
			                		<i class="fas fa-trash-alt" style="color: #523178;"></i>
			                	</a>
			                	<!-- <a href="<?=base_url?>cdp/solicdp&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="SOLICITAR">
			                		<i class="fas fa-sign-in-alt" style="color: #523178;"></i>
			                	</a> -->
										</td>
									</tr>
								<?php } ?>
					
							
						</tbody>
						<tfoot>
							<tr>
								<td></td>
								<td></td>						
								<td align="right"><strong>$ <?=number_format($sumasi, 0, ',', '.');?></strong></td>
								<td></td>	
								<td></td>
							</tr>
							<tr>
								<th>Código</th>
								<th>Objeto</th>						
								<th>Valor CDP's&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th>Estado&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th></th>
							</tr>
				    </tfoot>
					</table>					
				</div>
			<?php endif; ?>	

<!-- Fin tabla CDP ///////////////////////////////////////////////////////////////////////// -->


<!-- Inicio tabla RP ///////////////////////////////////////////////////////////////////////// -->
			<br>
			<h4 class="title-c">RP's&nbsp;&nbsp;&nbsp;&nbsp;</h4>
			<?php if(isset($pfrp)): ?>
				<br><br>
				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
						<thead>
							<tr>
								<th>Código</th>
								<th>Objeto</th>						
								<th>Valor RP's&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							
								<?php foreach ($pfrp as $pf){ ?>
									<tr>
										<td><small><?=$ninipaa.$pf['codrub'];?></small></td>
											<!-- <td><?//=$pf['unspsc'];?></td> -->
										<td>
											<?=$pf['nobjeto'];?>
											<br><br>
												<strong>Área: </strong><?=$pf['are'];?>
											<br>
											<small>
												<strong>Fecha Inicio: </strong><?=$pf['fecinidpa'];?>
												<br>
												<strong>Fecha Fin: </strong>
												<?=$pf['fecfindpa'];?>
												<br>
												<strong>Modalidad:</strong>
												<?=$pf['moda'];?>
												<br>
												<strong>Fuente: </strong>
												<?=$pf['fuen'];?>
											</small>
										</td>
										<td align="right">$ <?=number_format($pf['asidpa'], 0, ',', '.');?></td>
										<?php 
											$dtcdp = $pfinan->sumcdp($pf['iddpa']);
											$dtrp = $pfinan->sumrp($pf['iddpa']);
											$cdp= isset($dtcdp[0]['cdp']) ? $dtcdp[0]['cdp']:0;
											$rp= isset($dtrp[0]['rp']) ? $dtrp[0]['rp']:0;
											$dispo = ($pf['asidpa']-$cdp-$rp);
											$sumasi += $pf['asidpa'];
											$sumdis += $dispo;
											$sumcdp += $cdp;
											$sumrp += $rp;
										?>
										<td>
											<?php if($_SESSION['pefid']==21 OR $_SESSION['pefid']==34){ ?>	
												<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="Editar">
			                		<i class="fas fa-edit" style="color: #523178;"></i>
			                	</a>
			                <?php } ?>
												<br><br>
			                	<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>&soli=true" title="CDP">
			                		<!-- <i class="fas fa-file-invoice-dollar" style="color: #523178;"></i> -->
			                		<i class="fas fa-eye" style="color: #523178;"></i>
			                	</a>
			                	<br><br>
			                	<?php if($_SESSION['area']==1026){ ?>
				                	<a href="<?=base_url?>paa/delcdp&iddpa=<?=$pf['iddpa'];?>" title="Eliminar RP">
				                		<i class="fas fa-trash-alt" style="color: #523178;"></i>
				                	</a>
				                <?php } ?>
			                	<!-- <a href="<?=base_url?>cdp/solicdp&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="SOLICITAR">
			                		<i class="fas fa-sign-in-alt" style="color: #523178;"></i>
			                	</a> -->
										</td>
									</tr>
								<?php } ?>
					
							
						</tbody>
						<tfoot>
							<tr>
								<td></td>
								<td></td>						
								<td align="right"><strong>$ <?=number_format($sumasi, 0, ',', '.');?></strong></td>
								<td></td>
							</tr>
							<tr>
								<th>Código</th>
								<th>Objeto</th>						
								<th>Valor RP's&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th></th>
							</tr>
				    </tfoot>
					</table>					
				</div>
			<?php endif; ?>	

<!-- Fin tabla RP ///////////////////////////////////////////////////////////////////////// -->

<!-- Iniciar Mostrar Gráfico ////////////////////////////////////////////////////////////// -->
	<?php //if(isset($dpie)): ?>
	<!--
		<div id="rubroarea">
			<h5 class="title-c m-tb-40">Asignación Rubro <?=$ninipaa.$dpie[0]['codrub']." - ".$dpie[0]['nomrub']?> por Areas</h5>
			<div class="chartdiv" style="height: 400px !important;"></div>
		</div>
	-->
	<?php //endif; ?>
	<br><br><br>
	<?php //if(isset($dxyc)): ?>
		<?php //if(isset($pfinand)&& !isset($codrub)): ?>
<!-- 	<?php //if(isset($pfinand)): ?>
				<div id="rubroarea">
					<h5 class="title-c m-tb-40">Ejecución Rubros por Area - <?=$dxyc[0]['valnom'];?></h5>
					<br><br>
					<?php //if(isset($otroo)): ?>
						<div class="chartdiv2" style="height: 130px !important;"></div>
					<?php //endif; ?>
					<div class="chartdiv3" style="height: 1000px !important;"></div>
				</div>
	<?php //endif; ?> -->
<!-- Fin Mostrar Gráfico ////////////////////////////////////////////////////////////// -->

<?php } ?>