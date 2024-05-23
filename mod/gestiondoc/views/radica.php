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

<?php 
	//$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$link = substr("$_SERVER[REQUEST_URI]",strlen("$_SERVER[REQUEST_URI]")-12,12);
	if ($link=="radica/index") $rt="../";
	else $rt="";
?>
<script src="<?=$rt;?>code/highcharts.js"></script>
<script src="<?=$rt;?>code/modules/series-label.js"></script>
<script src="<?=$rt;?>code/modules/exporting.js"></script>
<script src="<?=$rt;?>code/modules/export-data.js"></script>
<script src="<?=$rt;?>code/modules/accessibility.js"></script>

<!-- Ver datos -->
<h2 class="title-c">
	BANDEJA DE ENTRADA
<!-- 	<?php if($act == "radica"){ ?>
		RADICA
	<?php }elseif($act == "Finalizados"){ ?>
		Actividades Finalizadas y Retiradas
	<?php }else{ ?>
		Papelera de Gestión
	<?php } ?>
 --></h2>
<br><br>

<?php $url_act2 = base_url."radica/index"; ?>


<?php $url_acttraz = base_url."radica/savetra"; ?>

<?php if($_SESSION['pefid']==6 OR $_SESSION['pefid']==54){ ?>
	<div class="row">
		<?php if($_SESSION['pefid']==6){ ?>
			<div class="form-group col-md-2" id="go1">
				<a href="<?=base_url?>radica/ext" class="btnrect" style="display: block;margin-bottom: 20px;">
					<button class="btn-primary-ccapital" >
						<i class="fa fa-plus" aria-hidden="true"></i> Externo
					</button>
				</a>
			</div>
		<?php } ?>
		<div class="form-group col-md-2" id="go1">
			<a href="<?=base_url?>radica/mem" class="btnrect" style="display: block;margin-bottom: 20px;">
				<button class="btn-primary-ccapital" >
					<i class="fa fa-plus" aria-hidden="true"></i> Memorando
				</button>
			</a>
		</div>
		<div class="form-group col-md-2" id="go1">
			<a href="<?=base_url?>radica/ofi" class="btnrect" style="display: block;margin-bottom: 20px;">
				<button class="btn-primary-ccapital" >
					<i class="fa fa-plus" aria-hidden="true"></i> Oficio
				</button>
			</a>
		</div>
	</div>
<?php } ?>



	<form class="m-tb-40" action="<?=base_url?>radica/index" method="POST">
		<div class="row">
			<div class="form-group col-md-2" id="go1">
				<label for="fecin">Fecha Inicial</label>
				<input type="date" class="form-control form-control-sm" id="fecin" name="fecin" value="<?=$fecin;?>" />
			</div>
			<div class="form-group col-md-2" id="go1">
				<label for="fecfi">Fecha Final</label>
				<input type="date" class="form-control form-control-sm" id="fecfi" name="fecfi" value="<?=$fecfi;?>" />
			</div>
			<div class="form-group col-md-2" id="go1">
				<button type="submit" class="btn-primary-ccapital" style="background-color: #ff0000;">
					<i class="fa fa-search"></i> Buscar
				</button>
			</div>
		</div>
	</form>

<div style="margin-top: -60px;float: right;">
	<?php if($tota){
		foreach ($tota as $tt) {
	?>
		<div style="padding: 5px 10px;margin: 5px;border: 1px solid #523178;color: #523178; border-radius: 20px;display:inline-block;font-size: 14px;">
			<small>
				<strong><?=$tt['tip']; ?>: </strong>
				<?=$tt['tot']; ?>
			</small>
		</div>
	<?php 
		}
	} ?>
</div>

	<div class="table-responsive">
		<!-- <form name='frmcom' action='<?=base_url?>radica/index' method='POST'> -->
		<!-- <form class="m-tb-40" action="<?=$url_acttraz?>" method="POST" enctype="multipart/form-data"> -->
			<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
		        <thead>
		            <tr>
		            	<th>Fecha</th>
		                <th>Usuario</th>
		                <th>Radicado</th>
		                <th>Área</th>
		                <th>Tipo</th>
						<th></th>
						<?php //if($_SESSION["pefid"]==6){ ?>
							<th></th>
						<?php //} ?>
		            </tr>
		        </thead>
		        <tbody>
		        	<?php 
		        	if(isset($radicas)){
		        		foreach ($radicas as $f){ ?>
		        			
			            <tr>
			            	<?php 
				            	if (file_exists("image/".$f['firrad'].".png"))
									$imagen = "image/".$f['firrad'].".png";
								else
									$imagen = "image/file.png";

								$fecleido = isset($f['fecleido']) ? $f['fecleido']:NULL;
								$idban = isset($f['idban']) ? $f['idban']:NULL;
								$vinculo = base_url."radica/resp&norad=".$f['norad'];
								if($idban) $vinculo .= "&idban=".$idban;

								// if($selpef[0]["pefdes"]==1){
								// 	echo "<td align='center' width='30px'><a href='".$vinculo."' target='_new'><img src='".$imagen."' title='Descargar' width='20px' ></a></td>";
								// }
			            	?>
			            	<td style="text-align: center;">
			            		<small><small>
			            			<?=substr($f["fecrad"],0,10);?>
			            			<BR>
			            			<?=substr($f["fecrad"],11,8);?>
			            			<BR><BR>
			            			<?php
			            				$radica->setNorad($f['norad']);
			            				$totresp = $radica->getTotResp();
			            				if($totresp && $totresp[0]['tot']>0){
			            			?>
			            					<div class="infomem" style="color: #523178;background-color: rgba(0,0,0,0);margin: 0px 0px 0px 1px;" title="Respuestas">
												<?=$totresp[0]['tot'];?>
											</div>
											<i class="fa fa-comment fa-2x" style="color:rgba(82,49,120,0.3);" title="Respuestas"></i>
									<?php
										}
									?>

			            		</small></small>
			                </td>
			            	<td>
			            		<small>
		 		            		<?php if($tipo=="Recibidos"){ ?>
										<a href='<?=$vinculo;?>'>
											<?php if(!$fecleido) echo "<strong>";
												$nprs = $f["pernom"]." ".$f["perape"];
												if(strlen($nprs)<36)
													echo $nprs;
												else
													echo substr($nprs,0,34)."...";
											if(!$fecleido) echo "</strong>"; ?>
										</a>
									<?php }elseif($tipo=="Enviados"){
											$sep = explode(", ",$f['nomrad']);
											$nomper = ""; ?>
											<?php foreach ($sep as $sp) {
												$spr = $mrad->selpara($sp);
												$nprs = $spr[0]["pernom"]." ".$spr[0]["perape"];
												$nomper .= substr($nprs,0,strpos($nprs," ")).", ";
											} ?>
											<a href='<?=$vinculo;?>'>
												<?php if(strlen($nomper)<36)
													echo "Para: ".substr($nomper,0,strlen($nomper)-2);
												else
													echo "Para: ".substr($nomper,0,30)."...";
											?>
											</a>
									<?php } ?>
								</small>
			                </td>
			                <td>
			                	<a href='<?=$vinculo;?>'>
									<small>
										<?php if(!$fecleido) echo "<strong>"; ?>
										<?php
											echo $f['consecutivo']." - ";
											if(strlen($f['asurad'])<50)
												echo $f['asurad'];
											else
												echo substr($f['asurad'],0,50)."...";
										?>
										<br><small>Firmado: <?php if($f['mfirrad']==1) echo "Si"; else echo "No"; ?></small>
										<?php if(!$fecleido) echo "</strong>"; ?>
			                        </small>
			                    </a>
			                </td>
			                <td>
			                	<small><small>
			                		<?php 
			                			if($f['tiprad']==601) echo "<strong>Asignada:</strong><br>";
			                			if($f['tiprad']==602) echo "<strong>Que proyecta:</strong><br>";
			                		?>
			                		<?=$f['are']; ?>
			                	</small></small>
			                </td>
			                <td>
			                	<?=$f['tip']; ?>
			                </td>
			                
			                <td style="text-align: center">
								<?php
									$Ndoc = $radica->getNodoc($f['norad']);
									if($Ndoc && $Ndoc[0]['Ndoc']>0){
								?>
										<div class="infomem">
											<?=$Ndoc[0]['Ndoc'];?>
										</div>
										<i class="fa fa-paperclip fa-2x" style="color:rgba(82,49,120,0.3);" title="<?=$Ndoc[0]['Ndoc'];?> Documentos Adjuntos"></i>
										
								<?php
									}
								?>
			                </td>
			                
		                	<td style="text-align: center;<?php if($_SESSION["pefid"]==6){ ?>width: 100px;<?php } ?>">
								<?php if($f['tiprad']==603){ ?>
									<a href="<?=base_url?>views/vpdfofi.php?norad=<?=$f['norad'];?>&trd=<?=$f['tiprad'];?>" target="_blank">
										<i class="far fa-file-text" style="color: #523178;margin: 5px;" title="Documento"></i>
									</a>
								<?php }else if($f['tiprad']==602){ ?>
									<a href="<?=base_url?>views/vpdfmem.php?norad=<?=$f['norad'];?>&trd=<?=$f['tiprad'];?>" target="_blank">
										<i class="far fa-file-text" style="color: #523178;margin: 5px;" title="Documento"></i>
									</a>
								<?php } ?>
								<?php if($_SESSION["pefid"]==6){ ?>
									<a href="<?=base_url?>views/vpdfrad.php?norad=<?=$f['norad'];?>&trd=<?=$f['tiprad'];?>" target="_blank">
										<i class="far fa-credit-card" style="color: #523178;margin: 5px;" title="Sticker"></i>
									</a>

									<i class="fa fa-plus-square" data-toggle="modal" data-target="#myModarch<?=$f['norad'];?>" style="color: #523178;margin: 5px;" title="Agregar Archivo"></i>

				                	<?php 
				                		echo Utils::modalfile("myModarch", $f['tip']." No. ".$f['consecutivo'], $f['norad'], "Cargar archivo a radicado No. ".$f['norad'], base_url."radica/savearc", $f['norad'], "No", "* Cargue un solo archivo.");
				                	?>

									<a href="<?=base_url?>radica/del&elcon=<?=$f['norad'];?>" onclick='return eliminar();'>
										<i class="far fa-trash-alt" style="color: #ff0000;margin: 5px;" title="Eliminar"></i>
									</a>
								<?php } ?>
							</td>
			            </tr>
			        <?php }} ?>
		        </tbody>
		        <tfoot>
		            <tr>
		            	<th>Fecha</th>
		                <th>Usuario</th>
		                <th>Radicado</th>
		                <th>Área</th>
		                <th>Tipo</th>
						<th></th>
						<?php //if($_SESSION["pefid"]==6){ ?>
							<th></th>
						<?php //} ?>
		            </tr>
		        </tfoot>
		    </table>
		<!-- </form>		 -->
	</div>

	<br>
	<figure class="highcharts-figure">
	    <div id="container"></div>
	    <p class="highcharts-description"></p>
	</figure>

	<script type="text/javascript">
		Highcharts.chart('container', {
		    title: {
		        text: 'TIPOS '
		    },
		    yAxis: {
		        title: {
		            text: 'Valores'
		        }
		    },
		    xAxis: {
		        categories: [
		        	<?php foreach ($tota as $f){ ?>
		        		'<?=strtoupper($f['tip']);?>',
		        	<?php } ?>
		        ]
		    },
		    legend: {
		        layout: 'vertical',
		        align: 'right',
		        verticalAlign: 'middle'
		    },
		    plotOptions: {
		        line: {
		            dataLabels: {
		                enabled: true
		            },
		            enableMouseTracking: false
		        }
		    },
		    series: [{
		    	name: '',
		        data: [
		        	<?php foreach ($tota as $f){ ?>
		        		<?=strtoupper($f['tot']);?>,
		        	<?php } ?>
		        ]   
		    }],
		    responsive: {
		        rules: [{
		            condition: {
		                maxWidth: 500
		            },
		            chartOptions: {
		                legend: {
		                    layout: 'horizontal',
		                    align: 'center',
		                    verticalAlign: 'bottom'
		                }
		            }
		        }]
		    }
		});
	</script>

	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	            	<th>Tipo</th>
	                <th style="text-align: center;">Cantidad</th>
	            </tr>
	        </thead>
	        <tbody>
				<?php if($tota){
					$co = 0;
					foreach ($tota as $tt) {
				?>
						<tr>
							<td><strong><?=$tt['tip']; ?>: </strong></td>
							<td style="text-align: center;"><?=$tt['tot']; ?></td>
						</tr>
				<?php 
						$co += $tt['tot'];
					}
				} ?>
			</tbody>
	        <tfoot>
	            <tr>
	            	<th>TOTAL</th>
	                <th style="text-align: center;"><?=$co;?></th>
	            </tr>
	        </tfoot>
	    </table>
	</div>


<?php if(isset($edit) && isset($val)): ?>
	<script>ocultar(1,300);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>