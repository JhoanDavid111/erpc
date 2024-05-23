<?php if($act == "Contrato"){ ?>
	<!-- Insertar o Editar datos -->
	<?php echo Utils::tit("Actividad","fas fa-restroom  mr-3","contrato/index","300px"); ?>
	<div id="inser">

		<?php 
		// var_dump($edit);
		// var_dump($val);

		if(isset($edit) && isset($val)): ?>
			<h2 class="title-c m-tb-40">Ver Actividad de Gestión</h2>
			<?php //$url_action = base_url."contrato/save&idcon=".$val[0]['idcon']; ?>
			
		<?php else: ?>
			<h2 class="title-c m-tb-40">Nueva Actividad de Gestión</h2>
			<?php $url_action = base_url."contrato/save"; ?>
		<?php endif; ?>

		<br>

		<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
			<div class="row" style="margin-top: 20px;">
				<input type="hidden" name="idcon" value="<?=isset($val) ? $val[0]['idcon'] : ''; ?>"/>
				<div class="form-group col-md-6" id="go1" >
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
					<label for="objcon">Objeto del Contrato</label>
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

<!-- Ver datos -->

<h2 class="title-c">
	<?php if($act == "Contrato"){ ?>
		Actividades de Gestión
	<?php }elseif($act == "Finalizados"){ ?>
		Actividades Finalizadas y Retiradas
	<?php }else{ ?>
		Papelera de Gestión
	<?php } ?>
</h2>
<br><br>

<div class="mizqplg">
<?php
if($act!="Papelera"){
	echo $plug5;
	echo $plug1;
	//echo $plug2;
	echo $plug3;
	echo $plug4;
}
?>
</div>

<?php if($act == "Contrato"){ 
	$url_act2 = base_url."contrato/index";
}elseif($act == "Finalizados"){
	$url_act2 = base_url."finret/index";
}else{
	$url_act2 = base_url."papel/index";
} ?>




<?php if($act == "Contrato" or $act == "Finalizados"){ ?>
	<form id="formdes" name="frmdes" method="POST" action="<?=$url_act2;?>">
		<div style="display: inline-block;">
			<?php if($anos){ ?>
				<select name="ano" class="form-control"  onchange="this.form.submit();">
					<?php foreach ($anos as $dtano) { ?>
						<option <?php if($dtano["ano"]==$ano) echo " SELECTED "; ?>><?=$dtano["ano"];?></option>
					<?php } ?>
				</select>
			<?php } ?>
		</div>

		<div style="display: inline-block;">
			<?php if($datst){ ?>
				<select name="st" class="form-control"  onchange="this.form.submit();">
					<option value="0">Seleccionar Estado</option>
					<?php foreach ($datst as $dtst) { ?>
						$est
						<option value="<?php echo $dtst["valid"]; ?>" <?php if($est==$dtst["valid"]) echo " selected "; ?>><?=$dtst["valnom"];?></option>
					<?php } ?>
				</select>
			<?php } ?>
		</div>

		<div style="display: inline-block;">
			<?php if($datab){ ?>
				<select name="ab" class="form-control"  onchange="this.form.submit();">
					<option value="0">Seleccionar Abogado</option>
					<?php foreach ($datab as $dtst) { ?>
						$abo
						<option value="<?php echo $dtst["perid"]; ?>" <?php if($abo==$dtst["perid"]) echo " selected "; ?>><?=$dtst["pernom"]." ".$dtst["perape"];?></option>
					<?php } ?>
				</select>
			<?php } ?>
		</div>

	</form>
<?php } ?>

<?php $url_acttraz = base_url."contrato/savetra"; ?>
	<div class="table-responsive">
		<!-- <form name='frmcom' action='<?=base_url?>contrato/index' method='POST'> -->
		<form class="m-tb-40" action="<?=$url_acttraz?>" method="POST" enctype="multipart/form-data">
			<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
		        <thead>
		            <tr>
		                <th>Estado</th>
		                <th>Contrato</th>
						<th>
							<?php if(($_SESSION["pefid"]==11 or $_SESSION["pefid"]==12) AND $act!="Papelera"){ ?>
								<button type="submit" style="background-color: #523178;color: #fff;">
									<i class="fas fa-save"></i>
								</button>
							<?php } ?>
						</th>
		            </tr>
		        </thead>
		        <tbody>
		        	<?php 
		        	if(isset($contratos)){
		        		foreach ($contratos as $va){ ?>
		        			<?php $dlei = $contrato->seleido($_SESSION["perid"],$va['idtra']);
		        			$dlei = isset($dlei) ? $dlei:NULL; ?>
			            <tr>
			            	<td style="text-align: center">
		                        <small>
		                        	<?php if(!$dlei or ($dlei and $dlei[0]['visto']!=1)) echo "<strong>"; ?>
		                        		<?=$va['fectra'];?>
		                        		<br><?=$va['nomest'];?>
	                        		<?php if(!$dlei or ($dlei and $dlei[0]['visto']!=1)) echo "</strong>"; ?>
	                        		<br><br>
		                        	<?php if(!$dlei or ($dlei and $dlei[0]['visto']!=1)) echo "<strong>"; ?>
		                        		Días Hab. 
		                        		<?php 
		                        			date_default_timezone_set('America/Bogota');
											$fec1 = new DateTime(substr($va['feccon'],0,10));
											$fecha = isset($va['fectra']) ? $va['fectra']:date("Y-m-d 00:00:00");
											if($va['codest']!=20 and $va['codest']!=24 and date_format($fec1,"Y-m-d")==substr($fecha,0,10))
												$fecha = date("Y-m-d 00:00:00");
											$fec2 = new DateTime($fecha);
											$fec3 = substr($va['feccon'],0,10);
		                        			echo Utils::getDiasHabiles($fec3, substr($fecha,0,10), $fes); 
		                        		?>
		                        	<?php if(!$dlei or ($dlei and $dlei[0]['visto']!=1)) echo "</strong>"; ?>
		                        </small>
			                </td>
			                <td>
			                	<?php if(!$dlei or ($dlei and $dlei[0]['visto']!=1)) echo "<strong>"; ?>
				                	No.: <?=$va['nocon'];?><br>
									<?=$va['nomcon'];?>
								<?php if(!$dlei or ($dlei and $dlei[0]['visto']!=1)) echo "</strong>"; ?>
								<br>
								<?php if(!$dlei or ($dlei and $dlei[0]['visto']!=1)) ; else echo "<small>"; ?>
								<small>
									<strong>Área: </strong><?=$va['nomarea'];?><br>
									<strong>Abogado y/o Usuario: </strong><?=strtoupper($va['pernom']).' '.strtoupper($va['perape']);?><br>
									<strong>Fecha: </strong><?=$va['feccon'];?>
									<strong>Tipo de Actividad: </strong><?=$va['parnom'];?>
		                            <strong>Link: </strong>
			                        <a href="<?=$va['linexpcon'];?>" target="_blank" title="Ir a Link <?=$va['linexpcon'];?>">
			                            <i class="fas fa-external-link-alt"></i>
			                        </a>
		                        </small>
		                        <?php if(!$dlei or ($dlei and $dlei[0]['visto']!=1)) ; else echo "</small>"; ?>

		                        <?php if(($_SESSION["pefid"]==11 or $_SESSION["pefid"]==12) AND $act!="Papelera"){ ?>
		                        	<br><br>
				            		<div class="row">
				            			<div class="form-group col-md-6">
				            				<input type="hidden" name="idcon[]" value="<?=$va['idcon'];?>">
											<input type="hidden" name="codest[]" value="<?=$va['codest'];?>">
											<input type="hidden" name="idabo[]" value="<?=$va['perid'];?>">
										
											<select class="form-control" name="perid[]" style="height: 42px;">
												<option value="0">Sin abogado asignado</option>
											<?php if($databo){
												foreach ($databo as $dar) { ?>
													<option value="<?=$dar['perid'];?>" 
														<?php if($dar['perid']==$va['perid']) echo ' selected '; ?>>
														<?=$dar['pernom'].' '.$dar['perape'];?>
													</option>
												<?php }
											} ?>
											</select>
										</div>
										<div class="form-group col-md-6">
											<select class="form-control" name="valid[]" style="height: 42px;">
											<?php if($datest){
												foreach ($datest as $dar) { ?>
													<option value="<?=$dar['valid'];?>" 
														<?php if($dar['valid']==$va['codest']) echo ' selected '; ?>>
														<?=$dar['valnom'];?>
													</option>
												<?php }
											} ?>
											</select>
										</div>
										<div class="form-group col-md-12">
											<textarea class="form-control form-control-sm" name="obstra[]" placeholder="Observación"></textarea>
										</div>
									</div>
			            		<?php } ?>
			                </td>
			                
			                <td style="text-align: center">
			                	<?php if($act!="Papelera"){ ?>
				                	<a href="<?=base_url?>reso/index&idcon=<?=$va['idcon'];?>&idtra=<?=$va['idtra'];?>&act=<?=$act;?>">
										<i class="fa fa-user-secret fa-2x" style="color: #523178;" title="Resolver"></i>
									</a>

									<?php 
										$detpaadoc->setIdcon($va['idcon']);
										$datCanF = $detpaadoc->getFaltan();
										$datCanT = $detpaadoc->getTiene();
										if(($datCanF && $datCanF[0]['can']>0) || ($datCanT && $datCanT[0]['can']<1)){
									?>
										<a href="<?=base_url?>docon/index&idcon=<?=$va['idcon'];?>">
											<i class="fa fa-file-text fa-2x" style="color: #ff0000;" title="Faltan Documentos"></i>
										</a>
									<?php }else{ ?>
										<a href="<?=base_url?>docon/index&idcon=<?=$va['idcon'];?>">
											<i class="fa fa-file-text fa-2x" style="color: #523178;" title="Documentos Completos"></i>
										</a>
									<?php } ?>


									<br><br>
									<?php if($_SESSION["pefid"]==11 or $_SESSION["pefid"]==12 or $_SESSION["pefid"]==14){ ?>
										<a href="<?=base_url?>contrato/index&elcon=<?=$va['idcon'];?>" onclick='return eliminar();'>
											<i class="far fa-trash-alt" style="color: #ff0000;" title="Eliminar"></i>
										</a>
									<?php } ?>



									<?php if($dlei AND $dlei[0]['visto']==1){ ?>
										<a href="<?=base_url?>contrato/index&idtra=<?=$va['idtra'];?>&le=1">
			                				<i class="fa fa-envelope" style="color: #523178;" title="Marcar NO Leido"></i>
			                			</a>
									<?php } ?>
		<!-- 							
									$txt .= "<a href='home.php?idtra=".$f['idtra']."&mv=2&opera=uml&pg=".$pg."'>";
		 -->
		 						<?php }else{ ?>
		 							<!-- <?=base_url?>papel/index&elcon=<?=$va['idcon'];?> -->
		 							<a href="<?=base_url?>papel/index&elcon=<?=$va['idcon'];?>" onclick='return restaurar();'>
										<i class="fas fa-trash-restore fa-2x" style="color: #ff0000;" title="Restaurar"></i>
									</a>
		 						<?php } ?>
			                </td>
			            </tr>
			        <?php }} ?>
		        </tbody>
		        <tfoot>
		            <tr>
						<th>Estado</th>
		                <th>Contrato</th>
						<th>
							<?php if(($_SESSION["pefid"]==11 or $_SESSION["pefid"]==12) AND $act!="Papelera"){ ?>
								<button type="submit" style="background-color: #523178;color: #fff;">
									<i class="fas fa-save"></i>
								</button>
							<?php } ?>
						</th>
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