<!-- INICIO CARGA DE DATOS PARA GRÁFICOS --------------------------------------------------------------------- -->

<!-- <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script> -->

<script src="../js/futic.js"></script>
<script src="../js/cdpaux.js"></script>


<script>
	am4core.ready(function() {

	// Themes begin
	am4core.useTheme(am4themes_animated);
	// Themes end

	// Create chart instance
	var chart = am4core.create("chartdiv3", am4charts.XYChart);

	// Add data
	<?php 
		$datap = "[";
		$i = 0;
		foreach ($dxyc as $xyc) {
			$dtcdp = $pfinan->sumcdpR($xyc['codrub'],$areas);
			$dtrp = $pfinan->sumrpR($xyc['codrub'],$areas);
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

	// Create axes
	var yAxis = chart.yAxes.push(new am4charts.CategoryAxis());
	yAxis.dataFields.category = "state";
	yAxis.renderer.grid.template.location = 0;
	yAxis.renderer.labels.template.fontSize = 10;
	yAxis.renderer.minGridDistance = 10;

	var xAxis = chart.xAxes.push(new am4charts.ValueAxis());

	// Create series
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

	// Add ranges
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
		//echo $txt;
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
</script>

<!-- FIN CARGA DE DATOS PARA GRÁFICOS --------------------------------------------------------------------- -->

<h2 class="title-c">Plan Anual de Adquisiciones&nbsp;&nbsp;&nbsp;&nbsp;</h2>


<!-- INICIO SELECCIONAR ÁREA --------------------------------------------------------------------- -->
<?php if (!isset($_SESSION['inspaa'])) { ?>

	<?php //if($_SESSION['pefid']==21 OR $_SESSION['pefid']==34){ ?>				
<!--			<a href="<?=base_url?>paa/index&new=1" class="fas fa-plus-square fa-2x" style="color: #f66f16;" title="Nuevo Registro"></a> -->
	<?php //} ?>


 	<?php	//if($_SESSION['pefid']!=31){	?>
<!--  		<?php if(!isset($pfinandOne)): ?>
				<form class="m-tb-40" action="<?=base_url;?>paa/index" method="POST">
					<div class="row">
		

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
					</div>
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
	<?php endif; ?> -->
<?php //}else{ ?>
	<br><br><br>
<?php //} ?>

<!-- FIN SELECCIONAR ÁREA --------------------------------------------------------------------- -->

<!-- INICIO PINTAR TABLA DE GRÁFICO --------------------------------------------------------------------- -->
<div class="row" style="float: right;">
	<div class="mestCDP" style="display: block;margin-top: -100px;text-align: end;">
		<br><br><br>
		<a href="<?=base_url?>views/csv.php?depid=<?=$_SESSION['depid'];?>&areSel=<?=$areSel;?>" target="_blank" title="CSV PAA">
			<i class="fas fa-file-excel fa-2x"></i>
		</a>
	</div>
</div>
		<?php if(!isset($pfinandOne)): ?>
				<?php if(isset($dxyc)): ?>
				 		<!-- <br><br><br> -->
						<div class="table-responsive">
 							<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
						        <thead>
						            <tr>
						            	<th>Código</th>
										<th>Nombre</th>							
										<th>Asignación&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										<th>Disponible&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										<th>CDP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										<th>RP's&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										<th></th>
						            </tr>
						        </thead>
						        <tbody>
				        			<?php foreach ($dxyc as $pf){ ?>
						            <tr>
						            	<?php
							            	$dtcdp = $pfinan->sumcdpR($pf['codrub'],$areas);
											$dtrp = $pfinan->sumrpR($pf['codrub'],$areas);
											$calCDP = $pfinan->contcdpR($pf['codrub'], $areas);
											$calRP = $pfinan->contrpR($pf['codrub'], $areas);
											$cdp= isset($dtcdp[0]['cdp']) ? $dtcdp[0]['cdp']:0;
											$rp= isset($dtrp[0]['rp']) ? $dtrp[0]['rp']:0;
											$dispo = ($pf['Asig']-$cdp-$rp);
										?>
						                <td><?=$ninipaa.$pf['codrub'];?></td>
						                <td><?=$pf['nomrub'];?></td>				                
						                <td>$ <?=number_format($pf['Asig'], 0, ',', '.');?></td>
						                <td>
						                	$ <?=number_format($dispo, 0, ',', '.');?>
						                	<br><br>
						                	<a href="<?=base_url?>paa/detpaa&codrub=<?=$pf['codrub'];?>&tip=1&tot=<?=$tot;?>" class="btn-primary-ccapital btable" title="Ver Disponible">
			                					<i class="fas fa-eye"></i> Disponible 
			                				</a> 
			                				<!-- <div class="contspan"><span class="spCanalPT1">9</span></div> -->
						                </td>
						                <td>
						                	$ <?=number_format($cdp, 0, ',', '.');?>
						                	<br><br>
						                	<a href="<?=base_url?>paa/detpaa&codrub=<?=$pf['codrub'];?>&tip=2&tot=<?=$tot;?>" class="btn-primary-ccapital btable" title="Ver CP's">
			                					<i class="fas fa-eye" ></i> CP's
			                				</a> 
			                				
			                				<?php if($calCDP[0]['alerta']>0){ ?>
			                					<div class="contspan"><span class="spCanalPT1"><?=$calCDP[0]['alerta'];?></span></div>
			                				<?php } ?>
						                </td>
						                <td>
						                	$ <?=number_format($rp, 0, ',', '.');?>
						                	<br><br>
						                	<a href="<?=base_url?>paa/detpaa&codrub=<?=$pf['codrub'];?>&tip=3&tot=<?=$tot;?>" class="btn-primary-ccapital btable" title="Ver RP's">
			                					<i class="fas fa-eye"></i> RP's
			                				</a> 

			                				<?php if($calRP[0]['alerta']>0){ ?>
			                					<div class="contspan"><span class="spCanalPT1"><?=$calRP[0]['alerta'];?></span></div>
			                				<?php } ?>
						                </td>
						                <td>
						                	<a href="<?=base_url?>paa/detpaa&codrub=<?=$pf['codrub'];?>&tot=<?=$tot;?>" title="Ver Todo">
			                					<i class="fas fa-eye" style="color: #523178;"></i>
			                				</a>
						                </td>
						            </tr>
						              	   
				           		<?php } ?>
						        </tbody>
						        <tfoot>
						             <tr>
						                <th>Código</th>
										<th>Nombre</th>
										<th>Asignación</th>
										<th>Disponible</th>
										<th>CDP</th>
										<th>RPs</th>
										<th></th>
						            </tr>
						        </tfoot>
						    </table>
							
						</div>
					

				<?php endif; ?> 
		<?php endif; ?> 

<!-- FIN PINTAR TABLA DE GRÁFICO ---------------------------------------------------------------------		 -->


<!-- INICIO PINTAR GRÁFICO --------------------------------------------------------------------- -->
				<?php if(isset($dpie)): ?>
					<!-- 
					<div id="rubroarea">
						<h5 class="title-c m-tb-40">Asignación Rubro <?=$ninipaa.$dpie[0]['codrub']." - ".$dpie[0]['nomrub']?> por Areas</h5>
						<div class="chartdiv" style="height: 400px !important;">
						</div>
					</div> -->
				<?php endif; ?>
				<br><br><br>

				<?php if($dxyc): ?>
					<?php if(isset($pfinand) && !isset($codrub)): ?>

						<div id="rubroarea">
							<h5 class="title-c m-tb-40">Ejecución Rubros por Area - <?=$dxyc[0]['valnom'];?></h5>
							<br><br>

							<?php if(isset($otroo)): ?>
								<div class="chartdiv2" style="height: 130px !important;">
					
								</div>
							<?php endif; ?>


							<div class="chartdiv3" style="height: 1000px !important;">
		    
		  					</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>
<!-- FIN PINTAR GRÁFICO --------------------------------------------------------------------- -->

<?php } ?>



<!-- 				<br><br><br> -->



<?php if(isset($pfinandOne) && $_SESSION['apro']==null): ?>
	<?php foreach ($pfinandOne as $pf2){ ?>
		<h4 class="title-c m-tb-40">Editar Registro</h4>
		<form class="m-tb-40" action="<?=base_url;?>paa/editpaa" method="POST">
			<!-- <input type="hidden" name="are" id="are" value="<?=$pf2['area'];?>">  -->
			<input type="hidden" name="iddpa" id="iddpa" value="<?=$pf2['iddpa'];?>">
			<input type="hidden" name="idpaa" id="idpaa" value="<?=$pf2['idpaa'];?>">			
			<input type="hidden" name="idflu" id="idflu" value="<?=$pf2['idflu'];?>">
			<input type="hidden" name="depidd" id="depidd" value="<?=$pf2['depidd'];?>">

			<div class="row">
				<div class="form-group col-md-6">
					<label for="codUNSPSC">Cod. UNSPSC</label>
					<input type="text" class="form-control" id="codUNSPSC" name="codUNSPSC" value="<?=$pf2['unspsc'];?>" readonly="">

				</div>
				<div class="form-group col-md-6">
					<label for="rubroPre"> Rubro Presupuestal</label>
					<input type="number" class="form-control" id="rubroPre" name="rubroPre" value="<?=$ninipaa.$pf2['codrub'];?>" readonly="">

				</div>
				<div class="form-group col-md-12">
					<label for="nombreRubro">Nombre Rubro Presupuestal</label>
					<input type="text" class="form-control" id="nombreRubro" name="nombreRubro" value="<?=$pf2['nomrub'];?>" readonly="">
				</div>
				<div class="form-group col-md-12">
					<label for="nomcont">Nombre Contratista</label>
					<input type="text" class="form-control" id="nomcont" name="nomcont" value="<?=$pf2['nomcont'];?>">
				</div>
				<div class="form-group col-md-12">
					<label for="objeto">Objeto/Descripción</label>
					<textarea class="form-control" id="objeto" name="objeto" rows="4"><?=$pf2['nobjeto'];?></textarea>

				</div>

				<input type="hidden" name="objdpa" value="<?=$pf2['objdpa']?>">
				<input type="hidden" name="inidpa" value="<?=$pf2['inidpa']?>">
				<input type="hidden" name="prodpa" value="<?=$pf2['prodpa']?>">


				<div class="form-group col-md-12">
					<label for="objdpa">Objetivo</label>	
					<select id="objdpa" name="objdpa" class="form-control form-control-sm" style="padding: 0px;" >	
						<?php foreach ($objetivos as $dat){ ?>
							<option value="<?=$dat['vafid'];?>"  <?= $pf2['objdpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group col-md-12">
					<label for="inidpa">Iniciativa</label>
					<select id="inidpa" name="inidpa" class="form-control form-control-sm" style="padding: 0px;" >	
						<?php foreach ($iniciativas as $dat){ ?>
							<option value="<?=$dat['vafid'];?>"  <?= $pf2['inidpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group col-md-12">
					<label for="prodpa">Proyecto</label>
					<select id="prodpa" name="prodpa" class="form-control form-control-sm" style="padding: 0px;" >	
						<?php foreach ($proyectos as $dat){ ?>
							<option value="<?=$dat['vafid'];?>"  <?= $pf2['prodpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
						<?php } ?>
					</select>
				</div>

				<div class="form-group col-md-6">
					<label for="fechaInicio">Fecha Inicio</label>
					<input type="date" class="form-control" id="fechaInicio" name="fechaInicio" onchange="asigmes()" value="<?=$pf2['fecinidpa'];?>">
				</div>

				<div class="form-group col-md-6">
					<label for="fechaEstimada">Fecha Estimada Final</label>
					<input type="date" class="form-control" id="fechaEstimada" name="fechaEstimada" onchange="asigmes()" value="<?=$pf2['fecfindpa'];?>">
				</div>

				<div class="form-group col-md-4">
					<label for="valorAsignado">Valor Asignado</label>
					<input type="number" class="form-control" id="valorAsignado" name="valorAsignado" onkeyup="asigmes()" onchange="asigmes()" value="<?=$pf2['asidpa'];?>">
				</div>				
				<div class="col-md-4">
					<label for="#">Requiere vigencia Futura</label>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="vigenciaF" id="SI" value="SI"
							<?= $pf2['reqvigf'] == "SI" ? ' checked' : ''; ?>>
						<label class="form-check-label" for="SI">
							SI
						</label>
						<input type="hidden" class="form-control" id="valorVigencia" name="valorVigencia" style="color:green; font-weight: bolder;" value="999999999999" readonly="">
					</div>					
					<div class="form-check">
						<input class="form-check-input" type="radio" name="vigenciaF" id="NO" value="NO" <?= $pf2['reqvigf'] == "NO" ? ' checked' : ''; ?>>
						<label class="form-check-label" for="NO">
							NO
						</label>
					</div>
					<div class="form-group col-md-4">
						<!-- <label for="valorVigencia" style="color:green; font-weight: bolder;">Valor Disponible</label> -->
						<input type="hidden" class="form-control" id="valorVigencia" name="valorVigencia" style="color:green; font-weight: bolder;" value="<?=$pf2['asidpa'];?>" readonly="">
					</div>
				</div>

				<!-- ALERTA -->
				<div class="col-md-12">
					<div id="alertdisponible" class="alert alert-danger" role="alert" style="display: none;">							
					  <div>
					    &nbsp;&nbsp; Recuerde que no puede exceder el valor disponible!!
					  </div>
					 
					</div>
				</div>

				<!-- FIN ALERTA -->

				<?php if($pf2['cuodpa']>0) { ?>
					<div class="form-group col-md-4">
						<label class="switchBtn">
						    <input type="checkbox" checked class="form-control" value="pagoman" id="pagoman" name="pagoman" onclick="metodoClick();">
						    <div class="slide round">Modificar Número de Pagos</div>
						</label>
					</div>	

					<div class="w-100"> </div>

					<div class="form-group col-md-3">
						<label for="duracion" id="lduracion" style="display: none;">Número Pagos</label>
						<input type="number"  style="display: none;" class="form-control" id="duracion" name="duracion" onkeyup="asigmes()" onchange="asigmes()"  value="<?=$pf2['nmesdpa'];?>" readonly="">
					</div>					
								

					<div class="form-group col-md-3">
						<label for="primerm" style="display: none;" id="lprimerm">Valor Primer mes</label>
						<input type="number" style="display: none;" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="primerm" name="primerm" value="<?=$pf2['pmes']?>" >
					</div>

					<div class="form-group col-md-3">
						<label for="ultimom" style="display: none;" id="lultimom">Valor último mes</label>
						<input type="number" style="display: none;" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="ultimom" name="ultimom" value="<?=$pf2['umes']?>" >
					</div>	

					<div class="form-group col-md-3">
						<label for="valormensual" style="display: none;" id="lvalormensual">Valor mensual prom.</label>
						<input type="number" style="display: none;" class="form-control" id="valormensual" name="valormensual" value="<?=$valmes=intval(($pf2['asidpa'])/($pf2['nmesdpa']))?>"  readonly="">
					</div>	

					<div class="w-100"> </div>
				
					<div class="form-group col-md-4" >
						<label for="duracion2" id="lduracion2" style="display: block;">Número Pagos.</label>
						<input type="number" style="display: block;" class="form-control" id="duracion2" name="duracion2" onkeyup="quitar()" onchange="quitar()"  value="<?=$pf2['cuodpa'];?>">
					</div>	

					<div class="row form-group col-md-12" id="newpay">
						<?php for ($i=1; $i <= $pf2['cuodpa'] ; $i++) { ?>
							<div class="form-group col-md-4" id="<?='div'.$i?>">
								<label for="<?='p'.$i?>"><?='Pago'.' '.$i?></label>
								<input type="number" class="form-control" id="<?='p'.$i?>" required name="p[]" value="<?=$cuota[$i-1]['valor'];?>">
								
							</div>
						<?php } ?>
						
					</div>		

					

				<?php }else{ ?>
					<div class="form-group col-md-4">
						<label class="switchBtn">
						    <input type="checkbox" class="form-control" value="pagoman" id="pagoman" name="pagoman" onclick="metodoClick();">
						    <div class="slide round">Modificar Número de Pagos</div>
						</label>
					</div>	

					<div class="w-100"> </div>

					<div class="form-group col-md-3">
						<label for="duracion" id="lduracion" style="display: block;">Número Pagos</label>
						<input type="number"  style="display: block;" class="form-control" id="duracion" name="duracion" onkeyup="asigmes()" onchange="asigmes()"  value="<?=$pf2['nmesdpa'];?>" readonly="">
					</div>					
								

					<div class="form-group col-md-3">
						<label for="primerm" style="display: block;" id="lprimerm">Valor Primer mes</label>
						<input type="number" style="display: block;" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="primerm" name="primerm" value="<?=$pf2['pmes']?>" >
					</div>

					<div class="form-group col-md-3">
						<label for="ultimom" style="display: block;" id="lultimom">Valor último mes</label>
						<input type="number" style="display: block;" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="ultimom" name="ultimom" value="<?=$pf2['umes']?>" >
					</div>	

					<div class="form-group col-md-3">
						<label for="valormensual" style="display: block;" id="lvalormensual">Valor mensual prom.</label>
						<input type="number" style="display: block;" class="form-control" id="valormensual" name="valormensual" value="<?=$valmes=intval(($pf2['asidpa'])/($pf2['nmesdpa']))?>"  readonly="">
					</div>	

					<div class="w-100"> </div>
				
					<div class="form-group col-md-4" >
						<label for="duracion2" id="lduracion2" style="display: none;">Número Pagos.</label>
						<input type="number" style="display: none;" class="form-control" id="duracion2" name="duracion2" onkeyup="quitar()" onchange="quitar()"  value="<?=$pf2['cuodpa'];?>">
					</div>	
			
				<?php } ?>							

				<div class="form-group col-md-4">
					<label for="tipcondpa">Modalidad</label>
					<select id="tipcondpa" name="tipcondpa" class="form-control form-control-sm" style="padding: 0px;" >	
						<?php foreach ($tipocontra as $dat){ ?>
							<option value="<?=$dat['vafid'];?>"  <?= $pf2['tipcondpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
						<?php } ?>
					</select>
				</div>

				<div class="form-group col-md-4">
					<label for="ftefindpa">Fuente de Recursos</label>
					<select id="ftefindpa" name="ftefindpa" class="form-control form-control-sm" onchange="javascript:ovif(this.value);" style="padding: 0px;" >	
						<?php foreach ($fuentes as $dat){ ?>
							<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ftefindpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
						<?php } ?>
					</select>
				</div>

				<div class="form-group col-md-4" id="vif">
					<label for="futic">Resolución FUTIC</label>
					<select id="futic" name="futic" class="form-control form-control-sm" style="padding: 0px;" >	
						<?php foreach ($futic as $dat){ ?>
							<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ft'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
						<?php } ?>
					</select>
				</div>

				<?php 

					if ($pf2['ftefindpa']==653) {
						echo "<script type='text/javascript'>ovif(653);</script>";		
					}else{
						echo "<script type='text/javascript'>ovif(1);</script>";			
					}
					
				 ?>

				<div class="form-group col-md-12">
					<label for="observa">Observaciones</label>
					<textarea class="form-control" id="observa" name="observa" rows="4" readonly=""><?=$pf2['observaciones'];?></textarea>
				</div>

				<div class="form-group col-md-12">
					<div class="table-responsive">
						<table id="example2" class="table table-striped table-bordered " style="width:100%; font-size: 15px;">
							<thead>
								<tr id="tmeses">
									
								</tr>						
							</thead>
							<tbody>
								<tr id="tvmeses">
									
								</tr>
							</tbody>
							<tfoot>
								<tr id="tfoot">
									
								</tr>
							</tfoot>				
						</table>
					</div>
				</div>
			</div>

		<!-- <br><br> -->

		<div class="row">
			<div class="form-group col-md-6">
				<label for="metadp">Meta</label>
				<select class="form-control form-control-sm" id="metadp" name="metadp" style="padding: 0px;" >
				<?php foreach ($metas as $dtm) { ?>
					<option value="<?=$dtm['vafid'];?>" 
						<?php if($pf2['metadp']==$dtm['vafid']) echo " selected "; ?>
					>
						<?=$dtm['vafnom'];?>
					</option>
				<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="resoludp">Resolución</label>
				<select class="form-control form-control-sm" id="resoludp" name="resoludp" style="padding: 0px;" > 
				<?php foreach ($resols as $dtm) { ?>
					<option value="<?=$dtm['vafid'];?>" 
						<?php if($pf2['resoludp']==$dtm['vafid']) echo " selected "; ?>
					>
						<?=$dtm['vafnom'];?>
					</option>
				<?php } ?>
				</select>
			</div>
		</div>

		<br><br>
		
		<h4 class="title-c m-tb-40">Unidad Ejecutora</h4>
		<br><br>

		<div class="row">

			<div class="form-group col-md-6">
				<label for="unicontra">Unidad de Contratación</label>
				<input type="text" class="form-control" id="unicontra" name="unicontra" value="<?=$pf2['unidad'];?>">
			</div>

			<div class="form-group col-md-6">
				<label for="ubicacion">Ubicación</label>
				<input type="text" class="form-control" id="ubicacion" name="ubicacion" value="<?=$pf2['ubicacion'];?>">
			</div>

			

			<div class="form-group col-md-6">
				<label for="nombreR">Nombre del solicitante</label>
				<select id="nombreR" name="nombreR" class="form-control form-control-sm" onchange="" style="padding: 0px;" >	


					<?php foreach ($ordgas as $ord){ ?>
						
						<option value="<?=$ord['perid'];?>"  <?=isset($pf2) &&  ($ord['perid'])== $pf2['resp'] ? ' selected ' : ''; ?>><?=$ord['pernom']." ".$ord['perape'];?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group col-md-6">
				<label for="norgas">Ordenador del gasto</label>
				<select id="norgas" name="norgas" class="form-control form-control-sm" onchange="" style="padding: 0px;" >	


					<?php foreach ($ordgas2 as $ord){ ?>
						
						<option value="<?=$ord['perid'];?>"  <?=isset($pf2) &&  ($ord['perid'])== $pf2['ordgas'] ? ' selected ' : ''; ?>><?=$ord['pernom']." ".$ord['perape'];?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group col-md-6">
				<input type="hidden" name="hidpro" id="hidpro" value="<?=$pf2['idpro'];?>">
				<label for="idpro">Proceso CDP:</label>
				<select id="idpro" name="idpro" class="form-control form-control-sm" onchange="" style="padding: 0px;" >	
					<?php foreach ($pcdp as $pcd){ ?>
						
						<option value="<?=$pcd['idpro'];?>"  <?=isset($pf2) &&  ($pcd['idpro'])== $pf2['idpro'] ? ' selected ' : ''; ?>><?=$pcd['nompro'];?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group col-md-6">
				<label for="marea">Area Asignada:</label>
				<select id="marea" name="marea" class="form-control form-control-sm" onchange="" style="padding: 0px;" >	
					<?php foreach ($areas2 as $ar){ ?>
						
						<option value="<?=$ar['valid'];?>"  <?=isset($pf2) &&  ($ar['valid'])== $pf2['area'] ? ' selected ' : ''; ?>><?=$ar['valnom'];?></option>
					<?php } ?>
				</select>
			</div>

				
		</div>
											
		<div class="row" style="opacity: 0; width: 0px; height: 0px;">
			<div class="col-md-3 text-center">
				<button id="btnsolicitar" class="btn-secondary-canalc">Solicitar</button>
			</div>			
		</div>

		<div class="row">
			<div class="col-md-3 text-center">
				<button class="btn-secondary-canalc">Modificar</button>
			</div>			
		</div>
	</form>		

<?php } ?>



<!-- 	//APROBACION -->

<?php elseif (isset($_SESSION['apro']) && $_SESSION['apro']==1 && $pfinandOne[0]['area']!=$_SESSION['depid'] ) : ?>
	<?php $_SESSION['apro']==null;
		if(isset($pfinandOne)){
			foreach ($pfinandOne as $pf2){ ?>
			<h4 class="title-c m-tb-40">Aprobar Solicitud</h4>									
			<form class="m-tb-40" action="<?=base_url;?>paa/aprobacion" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="idflu" id="idflu" value="<?=$pf2['idflu'];?>">
				<input type="hidden" name="iddpa" id="iddpa" value="<?=$pf2['iddpa'];?>">
				<input type="hidden" name="are" value="<?=$pf2['area'];?>">
				<input type="hidden" name="fluareas" value="<?=$pf2['fluareas'];?>">

				<?php if ($pf2['rutcdp']!=NULL || $pf2['rutcdp']!="" ) { ?>
					<input type="hidden" name="rutcdp" value="<?=$pf2['rutcdp'];?>">
				<?php } ?>
				<?php if ($pf2['rutrp']!=NULL || $pf2['rutrp']!="" ) { ?>
					<input type="hidden" name="rutrp" value="<?=$pf2['rutrp'];?>">
				<?php } ?>
				
				
				<div class="row">
					<div class="form-group col-md-6">
						<label for="codUNSPSC">Cod. UNSPSC</label>
						<input type="text" class="form-control" id="codUNSPSC" name="codUNSPSC" value="<?=$pf2['unspsc'];?>" readonly="">

					</div>
					<div class="form-group col-md-6">
						<label for="rubroPre"> Rubro Presupuestal</label>
						<input type="number" class="form-control" id="rubroPre" name="rubroPre" value="<?=$ninipaa.$pf2['codrub'];?>" readonly="">

					</div>
					<div class="form-group col-md-12">
						<label for="nombreRubro">Nombre Rubro Presupuestal</label>
						<input type="text" class="form-control" id="nombreRubro" name="nombreRubro" value="<?=$pf2['nomrub'];?>" readonly="">
					</div>

					<div class="form-group col-md-12">
						<label for="nomcont">Nombre Contratista</label>
						<input type="text" class="form-control" id="nomcont" name="nomcont" value="<?=$pf2['nomcont'];?>" readonly="">
					</div>

					<div class="form-group col-md-12">
						<label for="objeto">Objeto/Descripción</label>
						<textarea class="form-control" id="objeto" name="objeto" rows="4" readonly=""><?=$pf2['nobjeto'];?></textarea>
					</div>											

					<div class="form-group col-md-12">
						<label for="objdpa">Objetivo</label>
						<select id="objdpa" name="objdpa" class="form-control form-control-sm" style="padding: 0px;" readonly="">	
							<?php foreach ($objetivos as $dat){ ?>
								<!-- <input type="hidden" name="objdpa" value="<?=$_SESSION['depid'];?>">
								<input type="text" class="form-control" value="<?=$pf2['objdpa'];?>" readonly>	 -->
								<option value="<?=$dat['vafid'];?>"  <?= $pf2['objdpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group col-md-12">
						<label for="inidpa">Iniciativa</label>
						<select id="inidpa" name="inidpa" class="form-control form-control-sm" style="padding: 0px;" readonly="">	
							<?php foreach ($iniciativas as $dat){ ?>
								<option value="<?=$dat['vafid'];?>"  <?= $pf2['inidpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group col-md-12">
						<label for="prodpa">Proyecto</label>
						<select id="prodpa" name="prodpa" class="form-control form-control-sm" style="padding: 0px;" readonly="" >	
							<?php foreach ($proyectos as $dat){ ?>
								<option value="<?=$dat['vafid'];?>"  <?= $pf2['prodpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group col-md-6">
						<label for="fechaInicio">Fecha Inicio</label>
						<input type="date" class="form-control" id="fechaInicio" name="fechaInicio" onchange="asigmes()" value="<?=$pf2['fecinidpa'];?>" readonly="">
					</div>

					<div class="form-group col-md-6">
						<label for="fechaEstimada">Fecha estimada presentación Ofertas</label>
						<input type="date" class="form-control" id="fechaEstimada" name="fechaEstimada" onchange="asigmes()" value="<?=$pf2['fecfindpa'];?>" readonly="">
					</div>

					<div class="form-group col-md-4">
						<label for="valorAsignado">Valor Asignado</label>
						<input type="number" class="form-control" id="valorAsignado" name="valorAsignado" onkeyup="asigmes()" onchange="asigmes()" value="<?=$pf2['asidpa'];?>" readonly="">
					</div>
					<div class="form-group col-md-4">
						<label for="valorVigencia">Valor Vigencia Actual</label>
						<input type="text" class="form-control" id="valorVigencia" name="valorVigencia" value="<?=$pf2['valvigact'];?>" readonly="">
					</div>
					<div class="col-md-4">
						<label for="#">Requiere vigencia Futura</label>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="vigenciaF" id="SI" value="SI"
								<?= $pf2['reqvigf'] == "SI" ? ' checked' : ''; ?> readonly="">
							<label class="form-check-label" for="SI">
								SI
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="vigenciaF" id="NO" value="NO" <?= $pf2['reqvigf'] == "NO" ? ' checked' : ''; ?>>
							<label class="form-check-label" for="NO">
								NO
							</label>
						</div>
					</div>

					<?php if($pf2['cuodpa']>0) { ?>
						
						
						<div class="form-group col-md-3">
							<label for="duracion" id="lduracion" style="display: none;">Número Pagos</label>
							<input type="number"  style="display: none;" class="form-control" id="duracion" name="duracion" onkeyup="asigmes()" onchange="asigmes()"  value="<?=$pf2['nmesdpa'];?>" readonly="">
						</div>					
									

						<div class="form-group col-md-3">
							<label for="primerm" style="display: none;" id="lprimerm">Valor Primer mes</label>
							<input type="number" style="display: none;" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="primerm" name="primerm" value="<?=$pf2['pmes']?>" >
						</div>

						<div class="form-group col-md-3">
							<label for="ultimom" style="display: none;" id="lultimom">Valor último mes</label>
							<input type="number" style="display: none;" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="ultimom" name="ultimom" value="<?=$pf2['umes']?>" >
						</div>	

						<div class="form-group col-md-3">
							<label for="valormensual" style="display: none;" id="lvalormensual">Valor mensual prom.</label>
							<input type="number" style="display: none;" class="form-control" id="valormensual" name="valormensual" value="<?=$valmes=intval(($pf2['asidpa'])/($pf2['nmesdpa']))?>"  readonly="">
						</div>	

						<div class="w-100"> </div>
					
						<div class="form-group col-md-4" >
							<label for="duracion2" id="lduracion2" style="display: block;">Número Pagos.</label>
							<input type="number" style="display: block;" class="form-control" id="duracion2" name="duracion2" onkeyup="quitar()" onchange="quitar()"  value="<?=$pf2['cuodpa'];?>" readonly>
						</div>	

						<div class="row form-group col-md-12" id="newpay">
							<?php for ($i=1; $i <= $pf2['cuodpa'] ; $i++) { ?>
								<div class="form-group col-md-4" id="<?='div'.$i?>">
									<label for="<?='p'.$i?>"><?='Pago'.' '.$i?></label>
									<input type="number" class="form-control" id="<?='p'.$i?>" required name="p[]" value="<?=$cuota[$i-1]['valor'];?>" readonly>
									
								</div>
							<?php } ?>
							
						</div>		

			

					<?php }else{ ?>
						<div class="form-group col-md-4">
							<label class="switchBtn">
							    <input type="checkbox" class="form-control" value="pagoman" id="pagoman" name="pagoman" onclick="metodoClick();">
							    <div class="slide round">Modificar Número de Pagos</div>
							</label>
						</div>	

						<div class="w-100"> </div>

						<div class="form-group col-md-3">
							<label for="duracion" id="lduracion" style="display: block;">Número Pagos</label>
							<input type="number"  style="display: block;" class="form-control" id="duracion" name="duracion" onkeyup="asigmes()" onchange="asigmes()"  value="<?=$pf2['nmesdpa'];?>" readonly="">
						</div>					
						

						<div class="form-group col-md-3">
							<label for="primerm" style="display: block;" id="lprimerm">Valor Primer mes</label>
							<input type="number" style="display: block;" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="primerm" name="primerm" value="<?=$pf2['pmes']?>" >
						</div>

						<div class="form-group col-md-3">
							<label for="ultimom" style="display: block;" id="lultimom">Valor último mes</label>
							<input type="number" style="display: block;" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="ultimom" name="ultimom" value="<?=$pf2['umes']?>" >
						</div>	

						<div class="form-group col-md-3">
							<label for="valormensual" style="display: block;" id="lvalormensual">Valor mensual prom.</label>
							<input type="number" style="display: block;" class="form-control" id="valormensual" name="valormensual" value="<?=$valmes=intval(($pf2['asidpa'])/($pf2['nmesdpa']))?>"  readonly="">
						</div>	

						<div class="w-100"> </div>
					
						<div class="form-group col-md-4" >
							<label for="duracion2" id="lduracion2" style="display: none;">Número Pagos.</label>
							<input type="number" style="display: none;" class="form-control" id="duracion2" name="duracion2" onkeyup="quitar()" onchange="quitar()"  value="<?=$pf2['cuodpa'];?>">
						</div>	
				
					<?php } ?>							

					<div class="form-group col-md-4">
						<label for="tipcondpa">Modalidad</label>
						<select id="tipcondpa" name="tipcondpa" class="form-control form-control-sm" style="padding: 0px;" >	
							<?php foreach ($tipocontra as $dat){ ?>
								<option value="<?=$dat['vafid'];?>"  <?= $pf2['tipcondpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group col-md-4">
						<label for="ftefindpa">Fuente de Recursos</label>
						<select id="ftefindpa" name="ftefindpa" class="form-control form-control-sm" onchange="javascript:ovif(this.value);" style="padding: 0px;" >	
							<?php foreach ($fuentes as $dat){ ?>
								<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ftefindpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
							<?php } ?>
						</select>
					</div>
					

					<div class="form-group col-md-4">
						<label for="tipcondpa">Modalidad</label>
						<select id="tipcondpa" name="tipcondpa" class="form-control form-control-sm" style="padding: 0px;" readonly="">	
							<?php foreach ($tipocontra as $dat){ ?>
								<option value="<?=$dat['vafid'];?>"  <?= $pf2['tipcondpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group col-md-4">
						<label for="ftefindpa">Fuente de Recursos</label>
						<select id="ftefindpa" name="ftefindpa" class="form-control form-control-sm" onchange="javascript:ovif(this.value);" style="padding: 0px;" readonly="">	
							<?php foreach ($fuentes as $dat){ ?>
								<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ftefindpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
							<?php } ?>
						</select>
					</div>



					<div class="form-group col-md-4" id="vif">
						<label for="futic">Resolución FUTIC</label>
						<select id="futic" name="futic" class="form-control form-control-sm" style="padding: 0px;" readonly="">	
							<?php foreach ($futic as $dat){ ?>
								<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ft'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
							<?php } ?>
						</select>
					</div>

					<?php 

						if ($pf2['ftefindpa']==653) {
							echo "<script type='text/javascript'>ovif(653);</script>";		
						}else{
							echo "<script type='text/javascript'>ovif(1);</script>";			
						}
						
					 ?>

					<div class="form-group col-md-12">
						<label for="observa">Observaciones</label>
						<textarea class="form-control" id="observa" name="observa" rows="4"><?=$pf2['observaciones'];?></textarea>
					</div>

					<?php 

					$numflu=$pfinan->getVFlujoPro($pf2['idpro'],3);
					$numfluF=$pfinan->getVFlujoPro($pf2['idpro'],4);

					// echo $numflu[0]['mini']+1;
					// die();

					if ($pf2['idflu']==$numflu[0]['maxi']) { ?>
						<div class="form-group col-md-6">
							<label for="denarc">CDP</label>
							<input type="file" class="form-control form-control-sm" id="rutcdp" name="arch" accept="image/*, video/*, .doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf,.xls,.xlsx,.ppt,.pptx,.zip,.rar" style="height: 50px;" required />
							<small><small><span style="color: #ff0000;font-weight: bold;">* Si son varios archivos, suba un solo archivo comprimido.</span></small></small>
						</div>

						<div class="form-group col-md-6">
							<label for="nbogdata">No. BogData</label>
							<input type="number" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="nbogdata" name="nbogdata" value="<?=$pf2['nbogdata']?>" required>
						</div>	
						<br><br><br>
					<?php	}	?>	

					<?php if ($pf2['idflu']==$numfluF[0]['mini']) { ?>
						<div class="form-group col-md-4">
							<label for="denarc">RP</label>
							<input type="file" class="form-control form-control-sm" id="rutrp" name="archRP" accept="image/*, video/*, .doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf,.xls,.xlsx,.ppt,.pptx,.zip,.rar" style="height: 50px;" required />
							<small><small><span style="color: #ff0000;font-weight: bold;">* Si son varios archivos, suba un solo archivo comprimido.</span></small></small>
						</div>

						<div class="form-group col-md-4">
							<label for="nexpcdp">Consecutivo Solicitud</label>
							<input type="text" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="nexpcdp" name="nexpcdp" value="<?=$pf2['nexpcdp']?>" required readonly="">
						</div>	

						<div class="form-group col-md-4">
							<label for="nrp">No. RP</label>
							<input type="text" class="form-control" id="nrp" name="nrp" value="<?=isset($pf2['nrp']) ? $pf2["nrp"] : '0'; ?>" required >
						</div>	
						<br><br><br>
					<?php	}	?>											


					<br>
					<br>
					<div class="form-group col-md-12">
						<h4 class="title-c m-tb-40">Proyección de Inversión</h4>
					</div>
					
					<br>
					<br>

					<div class="table-responsive">
						<table id="example2" class="table table-striped table-bordered " style="width:100%; font-size: 15px;">
							<thead>
								<tr id="tmeses">
									
								</tr>						
							</thead>
							<tbody>
								<tr id="tvmeses">
									
								</tr>
							</tbody>
							<tfoot>
								<tr id="tfoot">
									
								</tr>
							</tfoot>				
						</table>
					</div>								

				</div>

			<br><br>
			
			<h4 class="title-c m-tb-40">Unidad Ejecutora</h4>
			<br><br>

			<div class="row">

				<div class="form-group col-md-6">
					<label for="unicontra">Unidad de Contratación</label>
					<input type="text" class="form-control" id="unicontra" name="unicontra" value="<?=$pf2['unidad'];?>" readonly="">
				</div>

				<div class="form-group col-md-6">
					<label for="ubicacion">Ubicación</label>
					<input type="text" class="form-control" id="ubicacion" name="ubicacion" value="<?=$pf2['ubicacion'];?>" readonly="">
				</div>										

				<div class="form-group col-md-6">
					<label for="nombreR">Nombre del solicitante</label>
					<select id="nombreR" name="nombreR" class="form-control form-control-sm" onchange="" style="padding: 0px;" >	


						<?php foreach ($ordgas as $ord){ ?>
							
							<option value="<?=$ord['perid'];?>"  <?=isset($pf2) &&  ($ord['perid'])== $pf2['resp'] ? ' selected ' : ''; ?>><?=$ord['pernom']." ".$ord['perape'];?></option>
						<?php } ?>
					</select>
				</div>

				<div class="form-group col-md-6">
					<label for="norgas">Ordenador del gasto</label>
					<select id="norgas" name="norgas" class="form-control form-control-sm" onchange="" style="padding: 0px;" >	


						<?php foreach ($ordgas2 as $ord){ ?>
							
							<option value="<?=$ord['perid'];?>"  <?=isset($pf2) &&  ($ord['perid'])== $pf2['ordgas'] ? ' selected ' : ''; ?>><?=$ord['pernom']." ".$ord['perape'];?></option>
						<?php } ?>
					</select>
				</div>

				<!-- <div class="form-group col-md-4">
					<label for="telefono">Teléfono</label>
					<input type="number" class="form-control" id="telefono" name="telefono" value="<?=$pf2['celres'];?>" readonly="">
				</div>

				<div class="form-group col-md-4">
					<label for="email">E-Mail</label>
					<input type="email" class="form-control" id="email" name="email" value="<?=$pf2['mailres'];?>" readonly="">
				</div> -->
			</div>

			<?php 

			if ($pf2['fluareas']) {
				
				$autori = explode(";", $pf2['fluareas']);

				$permiso = false;

				foreach ($autori as $aut){
					if ($aut==$_SESSION['depid']) {
						$permiso = true;
					}
				}

			}else{
				$permiso=true;
			}

			if ($permiso == true) { ?>
				<div class="row">
					<div class="col-md-3 text-center">
						<button class="btn-secondary-canalc" name="boton" value="aprobar">Aprobar</button>
					</div>

					<div class="col-md-3 text-center">
						<button class="btn-secondary-canalc" name="boton" value="rechazar">Rechazar</button>
					</div>								
															
				</div>

			<?php } else { ?>

			<div class="col-md-3 text-center">
				<button class="btn-secondary-canalc" name="boton" value="regresar">Regresar</button>
			</div>
			
			<?php } ?>
		<?php } ?>	



		</form>	

	<?php } ?>


<?php endif; ?>	







