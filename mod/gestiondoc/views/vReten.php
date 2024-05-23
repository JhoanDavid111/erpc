<!-- Insertar o Editar datos -->
<!-- <?php if($act == "radica"){ ?>

	<?php echo Utils::tit("Actividad","fas fa-restroom  mr-3","radica/index","300px"); ?>

	<div id="inser">

		<?php 
		// var_dump($edit);
		// var_dump($val);

		if(isset($edit) && isset($val)): ?>
			<h2 class="title-c m-tb-40">Ver Actividad de Gestión</h2>
			<?php //$url_action = base_url."radica/save&norad=".$val[0]['norad']; ?>
			
		<?php else: ?>
			<h2 class="title-c m-tb-40">Nueva Actividad de Gestión</h2>
			<?php $url_action = base_url."radica/save"; ?>
		<?php endif; ?>

		<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
			<div class="row">
				<input type="hidden" name="norad" value="<?=isset($val) ? $val[0]['norad'] : ''; ?>"/>
				<div class="form-group col-md-6" id="go1">
					<label for="nomcon">Contratista</label>
					<input type="text" class="form-control form-control-sm" id="nomcon" name="nomcon" value="<?=isset($val) ? $val[0]['nomcon'] : ''; ?>" <?=isset($val) ? ' disabled ' : ''; ?> />
				</div>
				<?php if($_SESSION["pefid"]>=11 and $_SESSION["pefid"]<16){ ?>
					<div class="form-group col-md-6" id="go2">
						<label for="perid">Abogado</label>
						<select class="form-control" name="perid" style="height: 42px;">
							<option value="0">Seleccione Abogado...</option>
							<?php if($databo){
								foreach ($databo as $dar) { ?>
									<option value="<?=$dar['perid'];?>">
										<?=$dar['pernom'].' '.$dar['perape'];?>
									</option>
								<?php }
							} ?>
						</select>
					</div>
				<?php }else{ ?>
					<input type="hidden" name="perid" value="<?=$_SESSION["perid"];?>">
				<?php } ?>

				<?php if($_SESSION["pefid"]>=11 and $_SESSION["pefid"]<16){ ?>
					<div class="form-group col-md-6" id="go3">
						<label for="valid">Área</label>
						<select class="form-control" name="valid" style="height: 42px;">
							<?php if($datare){
								foreach ($datare as $dar) { ?>
									<option value="<?=$dar['valid'];?>">
										<?=$dar['valnom'];?>
									</option>
								<?php }
							} ?>
						</select>
					</div>
				<?php }else{ ?>
					<input type="hidden" name="valid" value="<?=$_SESSION['depid'];?>">
				<?php } ?>
				<div class="form-group col-md-6" id="go3">
					<label for="parid">Tipo de Actividad</label>
					<select class="form-control" name="parid" style="height: 42px;">
						<?php if($datTA){
							foreach ($datTA as $dar) { ?>
								<option value="<?=$dar['parid'];?>">
									<?=$dar['parnom'];?>
								</option>
							<?php }
						} ?>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label for="objcon">Objeto del radica</label>
					<textarea class="form-control form-control-sm" id="objcon" name="objcon"><?=isset($val) ? $val[0]['objcon'] : ''; ?></textarea>
				</div>
				<div class="form-group col-md-6">
					<label for="linexpcon">Link Expediente  Drive</label>
					<input type="text" class="form-control form-control-sm" id="linexpcon" name="linexpcon" value="<?=isset($val) ? $val[0]['linexpcon'] : ''; ?>" required />
				</div>

				<div class="form-group col-md-6">
					<input type="submit" class="btn-primary-ccapital" value="Registrar">
				</div>
			</div>
		</form>
	</div>
<?php } ?>
 -->

<!-- Ver datos -->

<h2 class="title-c">
	TABLAS DE RETENCIÓN DOCUMENTAL
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
	 <br>
	<div class="table-responsive">
		<!-- <form name='frmcom' action='<?=base_url?>radica/index' method='POST'> -->
		<form class="m-tb-40" action="<?=$url_acttraz?>" method="POST" enctype="multipart/form-data">

			<table id="example" class="table table-striped table-bordered dterpceDSC" style="width:100%;">		

		        <thead style="font-size: 10px; text-align: center;">
					<tr>
						<!-- <th rowspan="2">Tabla Avanzada</th> -->
						<th colspan="3" class="col-1">CÓDIGOS</th>
						<th rowspan="2">SERIES, SUBSERIES Y TIPOS DOCUMENTALES</th>
						<th colspan="2" class="col-1">SOPORTE</th>
						<th colspan="2">AÑOS DE RETENCIÓN</th>
						<th colspan="4">DISPOSICIÓN FINAL</th>
						<th colspan="3">FECHA</th>
						<th rowspan="2"></th>


					</tr>
					<tr style="font-size: 10px; text-align: center;" >
						<th>Expediente</th>
						<th>Dependencia</th>
						<th>Serie - Subserie</th>
						<th>Físico</th>
						<th>Digital</th>
						<th>Archivo Gestión</th>
						<th>Archivo Central</th>
						<th>CT</th>
						<th>E</th>
						<th>M</th>
						<th>S</th>
						<th>Final Proceso</th>
						<th>Archivo Gestión</th>
						<th>Archivo Central</th>
					</tr>
				</thead>
			
				<tbody style="font-size: 10px; text-align: center;">
					<?php foreach ($dat as $f): ?>
						<?php 
							$sst = $radica->selsst($f['doctrd']);

						 ?>
						<tr>
							<th><?=substr($f['fecrad'],0,4).$sst[0]['doctrdt'];?></th>
						
							<td><?=$sst[0]['doctrdd'];?></td>
							<td><?=$sst[0]['doctrds']." - ".$sst[0]['doctrdb']." - ".$sst[0]['doctrdt'];?></td>
							<td><?=$sst[0]['destrds']." - ".$sst[0]['destrdb']." - ".$sst[0]['destrdt'];?></td>
							<td></td>
							<td>X</td>
							<td><?=$f['agentrd'];?></td>
							<td><?=$f['acentrd'];?></td>
							<td><?php if($f['dfintrd']=="CT"){ ?>
								   X
								<?php } ?>
							</td>
							<td>
								<?php if($f['dfintrd']=="E"){ ?>
								   X
								<?php } ?>
							</td>
							<td>
								<?php if($f['dfintrd']=="M"){ ?>
								   X
								<?php } ?>
							</td>
							<td>
								<?php if($f['dfintrd']=="S"){ ?>
								   X
								<?php } ?>
								
							</td>
							<?php 
								$fecfinal=substr($f['fecrad'],0,4)."-12-31";
							 ?>
							<td><?=$fecfinal;?>							
							</td>
							<?php 
								$newdate = strtotime ('+'.$f['agentrd'].' year', strtotime ($fecfinal));
								$newdate = date('Y-m-j', $newdate);
							 ?>
							<td><?=$newdate;?></td>
							<?php 
								$newdate = strtotime ('+'.($f['agentrd']+$f['acentrd']).' year', strtotime ($fecfinal));
								$newdate = date('Y-m-j', $newdate);
							 ?>
							<td><?=$newdate;?></td>
							<td>
								<a href="" title="Ver Expediente">
			                		<i class="fas fa-eye"></i> 
			                	</a> 
			                </td>							
						</tr>	

					<?php endforeach ?>
						
					
					<!-- <tr>
						<th>Fila 1</th>
						<td>2</td>
						<td>3</td>
						<td>4</td>
						<td>5</td>
						<td>6</td>
						<td>7</td>
						<td>8</td>
						<td>9</td>
						<td>10</td>
						<td>11</td>
						<td>12</td>
						<td>13</td>
						<td>14</td>
						<td>15</td>
						<td>
							<a href="" title="Ver Expediente">
		                		<i class="fas fa-eye"></i> 
		                	</a> 
		                </td>

					</tr> -->
					
				</tbody>
		        <tfoot>
		            <tr>
						<th>Estado</th>
		                <th>radica</th>
						<th></th>
		            </tr>
		        </tfoot>
		    </table>
		</form>		
	</div>

	<br>

<?php if(isset($edit) && isset($val)): ?>
	<script>ocultar(1,300);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>