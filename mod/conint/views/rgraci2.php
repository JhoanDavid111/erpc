<h2 class="title-c">Gráfica por Áreas</h2>

<!-- Selección de área Inicio  -->
<?php $url_action = base_url."rgraci1/area"; ?>
<form class="m-tb-40" id="formdes" name="frmdes" method="POST" action="<?=$url_action;?>">
	<div class="row">
		<?php if($areas){ ?>
		<div class="form-group col-md-4">
			<label for="valid">Área:</label>
			<select name="valid" class="form-control form-control-sm"  onchange="this.form.submit();" <?php if($_SESSION['pefid']==59) echo " disabled "; ?> style="padding: 0px 0px !important;">
				<option value="0" <?php if($valid==0) echo " SELECTED "; ?>>Seleccione Área</option>
				<?php foreach ($areas as $dta) { ?>
					<option value="<?=$dta['valid'];?>" <?php if($dta["valid"]==$valid) echo " SELECTED "; ?>><?=strtoupper($dta["valnom"]);?></option>
				<?php } ?>
			</select>
		</div>
		<?php } ?>
		<div class="form-group col-md-3">
			<label for="fil1">F. Inicial Solicitud:</label>
			<input type="date" class="form-control form-control-sm" id="fil1" name="fil1" value="<?=$fil1;?>">
		</div>
		<div class="form-group col-md-3">
			<label for="fil2">F. Final Solicitud:</label>
			<input type="date" class="form-control form-control-sm" id="fil2" name="fil2"  onChange="this.form.submit();" value="<?=$fil2;?>">
		</div>
	</div>
</form>
<!-- Selección de área fin  -->

<!-- Alistamiento gráficas estilos CSS inicio  -->
<style type="text/css">
	.highcharts-figure, .highcharts-data-table table {
	    min-width: 360px; 
	    max-width: 1000px;
	    margin: 1em auto;
	}

	.highcharts-data-table table {
		font-family: Verdana, sans-serif;
		border-collapse: collapse;
		border: 1px solid #EBEBEB;
		margin: 10px auto;
		text-align: center;
		width: 100%;
		max-width: 500px;
	}
	.highcharts-data-table caption {
	    padding: 1em 0;
	    font-size: 1.2em;
	    color: #555;
	}
	.highcharts-data-table th {
		font-weight: 600;
	    padding: 0.5em;
	}
	.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
	    padding: 0.5em;
	}
	.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
	    background: #f8f8f8;
	}
	.highcharts-data-table tr:hover {
	    background: #f1f7ff;
	}
</style>
<!-- Alistamiento gráficas estilos CSS fin  -->


<!-- Llamado a librería gráficas JS inicio  -->
	<script src="../code/highcharts.js"></script>
	<script src="../code/modules/series-label.js"></script>
	<script src="../code/modules/exporting.js"></script>
	<script src="../code/modules/export-data.js"></script>
	<script src="../code/modules/accessibility.js"></script>
<!-- Llamado a librería gráficas JS fin  -->

<center>
	<figure class="highcharts-figure" style="display: inline-block;width: 90%;">
	    <div id="container1"></div>
	    <p class="highcharts-description"></p>
	</figure>
	<!-- <figure class="highcharts-figure" style="display: inline-block;width: 30%;">
	    <div id="container2"></div>
	    <p class="highcharts-description"></p>
	</figure> -->
</center>

<!-- Gráfica 1 Inicio  -->
<script type="text/javascript">
	Highcharts.chart('container1', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Planes de mejora por Estados'
	    },
	    subtitle: {
	        text: 'Gráfico en Barras'
	    },
	    xAxis: {
	        type: 'category',
	        labels: {
	            autoRotation: [-45, -90],
	            style: {
	                fontSize: '13px',
	                fontFamily: 'Verdana, sans-serif'
	            }
	        }
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Valores'
	        }
	    },
	    legend: {
	        enabled: false
	    },
	    tooltip: {
	        pointFormat: 'Cantidad: <b>{point.y:.1f}</b>'
	    },
	    series: [{
	        name: 'Cantidades',
	        colors: [
	        	// Sin Ini, ter Fue t, termina, En proceso, incumplida
	            //'#ff3300', '#4f6228', '#76933c', '#ffc000', '#c00000'
	            <?php
		        $con=0; 
		        foreach ($pmj as $f){
		        ?>
		            '<?=$f['pre'];?>'
		            <?php 
		            	if($con<(count($pmj))) echo ", ";
		           		$con++;
		           	?>
		        <?php } ?>
	        ],
	        colorByPoint: true,
	        groupPadding: 0,
	        data: [
		        <?php
		        $con=0; 
		        foreach ($pmj as $f){
		        ?>
		            ['<?=strtoupper($f['valnom']);?>', <?=strtoupper($f['tot']);?>]
		            <?php 
		            	if($con<(count($pmj))) echo ", ";
		           		$con++;
		           	?>
		        <?php } ?>
	        ],
	        dataLabels: {
	            enabled: true,
	            rotation: -90,
	            color: '#FFFFFF',
	            align: 'right',
	            format: '{point.y:.1f}', // one decimal
	            y: 10, // 10 pixels down from the top
	            style: {
	                fontSize: '13px',
	                fontFamily: 'Verdana, sans-serif'
	            }
	        }
	    }]
	});
	</script>
<!-- Gráfica 1 Fin  -->

<!-- Gráfica 2 Inicio  -->
<script type="text/javascript">
	Highcharts.chart('container2', {
	    chart: {
	        type: 'pie',
	        options3d: {
	            enabled: true,
	            alpha: 45
	        }
	    },
	    title: {
	        text: 'Planes de mejora',
	        align: 'center'
	    },
	    subtitle: {
	        text: 'Gráfico en dona',
	        align: 'center'
	    },
	    plotOptions: {
	        pie: {
	            innerSize: 100,
	            depth: 45
	        }
	    },
	    series: [{
	        name: 'Cantidad',
	        data: [
		        <?php
		        $con=0; 
		        foreach ($pmj as $f){
		        ?>
		            ['<?=strtoupper($f['valnom'])." (".strtoupper($f['tot']).")";?>', <?=strtoupper($f['tot']);?>]
		            <?php 
		            	if($con<(count($pmj))) echo ", ";
		           		$con++;
		           	?>
		        <?php } ?>
	        ]
	    }]
	});
</script>
<!-- Gráfica 2 Fin  -->


<strong>Gráficas Origen por Estados</strong><br>
<center>
	<figure class="highcharts-figure" style="display: inline-block;width: 40%;">
	    <div id="container3"></div>
	    <p class="highcharts-description"></p>
	</figure>
	<figure class="highcharts-figure" style="display: inline-block;width: 40%;">
	    <div id="container4"></div>
	    <p class="highcharts-description"></p>
	</figure>
</center>

<!-- Gráfica 3 Inicio  -->
<script type="text/javascript">
	Highcharts.chart('container3', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Origen Externo por estados'
	    },
	    subtitle: {
	        text: 'Gráfico en Barras'
	    },
	    xAxis: {
	        type: 'category',
	        labels: {
	            autoRotation: [-45, -90],
	            style: {
	                fontSize: '13px',
	                fontFamily: 'Verdana, sans-serif'
	            }
	        }
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Valores'
	        }
	    },
	    legend: {
	        enabled: false
	    },
	    tooltip: {
	        pointFormat: 'Cantidad: <b>{point.y:.1f}</b>'
	    },
	    series: [{
	        name: 'Cantidades',
	        colors: [
	        	// Sin Ini, ter Fue t, termina, En proceso, incumplida
	            //'#ff3300', '#4f6228', '#76933c', '#ffc000', '#c00000'
	            <?php
		        $con=0; 
		        foreach ($pmj as $f){
		        ?>
		            '<?=$f['pre'];?>'
		            <?php 
		            	if($con<(count($pmj))) echo ", ";
		           		$con++;
		           	?>
		        <?php } ?>
	        ],
	        colorByPoint: true,
	        groupPadding: 0,
	        data: [
		        <?php
		        $con=0; 
		        foreach ($pmj1 as $f){
		        ?>
		            ['<?=strtoupper($f['valnom']);?>', <?=strtoupper($f['tot']);?>]
		            <?php 
		            	if($con<(count($pmj1))) echo ", ";
		           		$con++;
		           	?>
		        <?php } ?>
	        ],
	        dataLabels: {
	            enabled: true,
	            rotation: -90,
	            color: '#FFFFFF',
	            align: 'right',
	            format: '{point.y:.1f}', // one decimal
	            y: 10, // 10 pixels down from the top
	            style: {
	                fontSize: '13px',
	                fontFamily: 'Verdana, sans-serif'
	            }
	        }
	    }]
	});
	</script>
<!-- Gráfica 3 Fin  -->

<!-- Gráfica 4 Inicio  -->
<script type="text/javascript">
	Highcharts.chart('container4', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Origen Interno por estados'
	    },
	    subtitle: {
	        text: 'Gráfico en Barras'
	    },
	    xAxis: {
	        type: 'category',
	        labels: {
	            autoRotation: [-45, -90],
	            style: {
	                fontSize: '13px',
	                fontFamily: 'Verdana, sans-serif'
	            }
	        }
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Valores'
	        }
	    },
	    legend: {
	        enabled: false
	    },
	    tooltip: {
	        pointFormat: 'Cantidad: <b>{point.y:.1f}</b>'
	    },
	    series: [{
	        name: 'Cantidades',
	        colors: [
	        	// Sin Ini, ter Fue t, termina, En proceso, incumplida
	            //'#ff3300', '#4f6228', '#76933c', '#ffc000', '#c00000'
	            <?php
		        $con=0; 
		        foreach ($pmj as $f){
		        ?>
		            '<?=$f['pre'];?>'
		            <?php 
		            	if($con<(count($pmj))) echo ", ";
		           		$con++;
		           	?>
		        <?php } ?>
	        ],
	        colorByPoint: true,
	        groupPadding: 0,
	        data: [
		        <?php
		        $con=0; 
		        foreach ($pmj2 as $f){
		        ?>
		            ['<?=strtoupper($f['valnom']);?>', <?=strtoupper($f['tot']);?>]
		            <?php 
		            	if($con<(count($pmj2))) echo ", ";
		           		$con++;
		           	?>
		        <?php } ?>
	        ],
	        dataLabels: {
	            enabled: true,
	            rotation: -90,
	            color: '#FFFFFF',
	            align: 'right',
	            format: '{point.y:.1f}', // one decimal
	            y: 10, // 10 pixels down from the top
	            style: {
	                fontSize: '13px',
	                fontFamily: 'Verdana, sans-serif'
	            }
	        }
	    }]
	});
	</script>
<!-- Gráfica 4 Fin  -->


<strong>Gráficas Internos y Externos</strong><br>
<center>
	<figure class="highcharts-figure" style="display: inline-block;width: 40%;">
	    <div id="container5"></div>
	    <p class="highcharts-description"></p>
	</figure>
	<figure class="highcharts-figure" style="display: inline-block;width: 48%;">
	    <div id="container6"></div>
	    <p class="highcharts-description"></p>
	</figure>
</center>

<!-- Gráfica 5 Inicio  -->
<script type="text/javascript">
	Highcharts.chart('container5', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Interno/Externo'
	    },
	    subtitle: {
	        text: 'Gráfica de barras'
	    },
	    xAxis: {
	        type: 'category',
	        labels: {
	            rotation: -45,
	            style: {
	                fontSize: '13px',
	                fontFamily: 'Verdana, sans-serif'
	            }
	        }
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Cantidades'
	        }
	    },
	    legend: {
	        enabled: false
	    },
	    tooltip: {
	        pointFormat: 'Cantidad: <b>{point.y:.1f} </b>'
	    },
	    series: [{
	        name: 'Population',
	        colors: [
	            '#7cb5ec', '#434348', '#861ec9', '#7a17e6', '#7010f9'
	        ],
	        colorByPoint: true,
	        groupPadding: 0,
	        data: [
	            <?php  
				$con=0;
				if($EI){ foreach($EI as $td){
					echo "['".$td['tipo']."', ".$td['tot']."]";
					if($con<count($EI)-1){
						echo ",";
					}
					$con++;
				}}
				?>
	        ],
	        dataLabels: {
	            enabled: true,
	            rotation: -90,
	            color: '#FFFFFF',
	            align: 'right',
	            format: '{point.y:.1f}', // one decimal
	            y: 10, // 10 pixels down from the top
	            style: {
	                fontSize: '13px',
	                fontFamily: 'Verdana, sans-serif'
	            }
	        }
	    }]
	});
	</script>
<!-- Gráfica 5 Fin  -->

<!-- Gráfica 6 Inicio  -->
<script type="text/javascript">
	Highcharts.chart('container6', {
	    chart: {
	        type: 'pie',
	        options3d: {
	            enabled: true,
	            alpha: 45
	        }
	    },
	    title: {
	        text: 'Interno/Externo',
	        align: 'center'
	    },
	    subtitle: {
	        text: 'Gráfico en dona',
	        align: 'center'
	    },
	    plotOptions: {
	        pie: {
	            innerSize: 100,
	            depth: 45
	        }
	    },
	    series: [{
	        name: 'Cantidad',
	        data: [
		        <?php
		        $con=0; 
		        foreach ($EI as $f){
		        ?>
		            ['<?=strtoupper($f['tipo'])." (".strtoupper($f['tot']).")";?>', <?=strtoupper($f['tot']);?>]
		            <?php 
		            	if($con<(count($EI)-1)) echo ", ";
		           		$con++;
		           	?>
		        <?php } ?>
	        ]
	    }]
	});
	</script>
<!-- Gráfica 6 Fin  -->

<strong>Gráficas Planes Abierto y Cerrados</strong><br>
<center>
	<figure class="highcharts-figure" style="display: inline-block;width: 48%;">
	    <div id="container8"></div>
	    <p class="highcharts-description"></p>
	</figure>
	<figure class="highcharts-figure" style="display: inline-block;width: 40%;">
	    <div id="container7"></div>
	    <p class="highcharts-description"></p>
	</figure>
</center>

<!-- Gráfica 7 Inicio  -->
<script type="text/javascript">
	Highcharts.chart('container7', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Abierto / Cerrado'
	    },
	    subtitle: {
	        text: 'Gráfica de barras'
	    },
	    xAxis: {
	        type: 'category',
	        labels: {
	            rotation: -45,
	            style: {
	                fontSize: '13px',
	                fontFamily: 'Verdana, sans-serif'
	            }
	        }
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Cantidades'
	        }
	    },
	    legend: {
	        enabled: false
	    },
	    tooltip: {
	        pointFormat: 'Cantidad: <b>{point.y:.1f} </b>'
	    },
	    series: [{
	        name: 'Population',
	        colors: [
	            '#7cb5ec', '#434348', '#861ec9', '#7a17e6', '#7010f9'
	        ],
	        colorByPoint: true,
	        groupPadding: 0,
	        data: [
	            <?php  
				$con=0;
				if($AC){ foreach($AC as $td){
					echo "['".$td['tipo']."', ".$td['tot']."]";
					if($con<count($AC)-1){
						echo ",";
					}
					$con++;
				}}
				?>
	        ],
	        dataLabels: {
	            enabled: true,
	            rotation: -90,
	            color: '#FFFFFF',
	            align: 'right',
	            format: '{point.y:.1f}', // one decimal
	            y: 10, // 10 pixels down from the top
	            style: {
	                fontSize: '13px',
	                fontFamily: 'Verdana, sans-serif'
	            }
	        }
	    }]
	});
	</script>
<!-- Gráfica 7 Fin  -->

<!-- Gráfica 8 Inicio  -->
<script type="text/javascript">
	Highcharts.chart('container8', {
	    chart: {
	        type: 'pie',
	        options3d: {
	            enabled: true,
	            alpha: 45
	        }
	    },
	    title: {
	        text: 'Interno/Externo',
	        align: 'center'
	    },
	    subtitle: {
	        text: 'Gráfico en dona',
	        align: 'center'
	    },
	    plotOptions: {
	        pie: {
	            innerSize: 100,
	            depth: 45
	        }
	    },
	    series: [{
	        name: 'Cantidad',
	        data: [
		        <?php
		        $con=0; 
		        foreach ($AC as $f){
		        ?>
		            ['<?=strtoupper($f['tipo'])." (".strtoupper($f['tot']).")";?>', <?=strtoupper($f['tot']);?>]
		            <?php 
		            	if($con<(count($AC))) echo ", ";
		           		$con++;
		           	?>
		        <?php } ?>
	        ]
	    }]
	});
	</script>
<!-- Gráfica 8 Fin  -->


<div class="table-responsive">
	<?php if($pmj){ 
		$ctnCnt = 0;
		$ctnPor = 0;
	?>
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
			<thead>
				<tr>
					<th>Estado</th>
					<th style="text-align: center;">Cantidad</th>
					<th style="text-align: center;">Porcentaje</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($pmj as $f){ ?>
					<tr>
						<td>
							<span style="font-size: 0px;"><?=$f['tot'];?></span>
							<small><?=strtoupper($f['valnom']);?></small>
						</td>
						<td style="text-align: center;">
							<?=$f['tot'];?>&nbsp;&nbsp;&nbsp;&nbsp;
							<?php $ctnCnt += $f['tot']; ?>
						</td>
						<td style="text-align: center;">
							<?php
								if($CanPlan AND $CanPlan[0]['tot']>0){
									echo round($f['tot']*100/$CanPlan[0]['tot'],0)." %";
									$ctnPor += round($f['tot']*100/$CanPlan[0]['tot'],0);
								}
							?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
			<thead>
				<tr>
					<th>
						Total
					</th>
					<th style="text-align: center;">
						<?=$ctnCnt;?>
					</th>
					<th style="text-align: center;">
						<?=$ctnPor;?> %
					</th>
				</tr>
			</thead>
		</table>
	<?php }else{ ?>
		<center><h5>No existen resultados</h5></center><br><br>
	<?php } ?>
</div>
