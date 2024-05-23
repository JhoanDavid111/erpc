<script src="../js/futicmcdp.js"></script>
<script src="../js/cdpaux.js"></script>
<script src="../js/cdpmultr.js"></script>

<?php 
//********************
//********************
//SOLICITUD MULTIPLE CDP
//********************
//********************
 ?>


<?php if(!isset($_SESSION['newpfin'])&&($solicitud==true)):  ?>
	<!-- <h2 class="title-c"> Solicitud MULTIPLE CDP </h2> -->

<!-- 	<form class="m-tb-40" action="" method="POST"> -->	
	<br><br>


	<?php if(isset($pfinandOne0)): ?>
		<h4 class="title-c m-tb-40">Solicitud CDP con Multiples Rubros</h4>
		<br>
		<form class="m-tb-40" action="<?=base_url;?>cdpmul/solimcdp" method="POST">
			<div class="row">
				<div class="form-group col-md-12">
					<label for="codUNSPSC">Cod. UNSPSC</label>
					<input type="text" class="form-control" id="codUNSPSC" name="codUNSPSC" value="N/A">
				</div>
			</div>
			
			<?php $objetos=""; ?>
			<?php $ov=0; ?>
			<?php for ($i=0;$i<count($codrub1);$i++){  ?>
				<fieldset class="form-group row">
					<?php foreach (${'pfinandOne'.$i} as $pf2): ?>
						<input type="hidden" class="form-control" id="" name="idpro" value="<?=$pf2['idpro'];?>">
						<input type="hidden" class="form-control" id="" name="idpaa" value="<?=$pf2['idpaa'];?>">	

							
						<div class="form-group col-md-12">
							<label for="rubroPre"> Rubro Presupuestal</label>
							<input type="number" class="form-control" id="" name="rubroPre[]" value="<?=$ninipaa.$pf2['codrub'];?>" readonly>
						</div>
						<input type="hidden" name="iddpa[]"  value="<?=$pf2['iddpa'];?>">
						<div class="form-group col-md-12">
							<label for="nombreRubro">Nombre Rubro Presupuestal</label>
							<input type="text" class="form-control" id="" name="nombreRubro[]" value="<?=$pf2['nomrub'];?>" readonly="">
						</div>

						<?php $objetos .= $pf2['nobjeto'].'. '; ?>
						<?php 
							// var_dump(count($tipocontra));
							// die();

							$nc=count($tipocontra);


						 ?>

						<div class="form-group col-md-4">
							<label for="tipcondpa">Modalidad</label>
							<select id="tipcondpa" name="tipcondpa[]" class="form-control form-control-sm" style="padding: 0px;" >	

								<?php foreach ($tipocontra as $dat){ ?>
									<option value="<?=$dat['vafid'];?>"  <?= $pf2['tipcondpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group col-md-4">
							<label for="ftefindpa">Fuente de Recursos</label>
							<select id="" name="ftefindpa[]" class="form-control form-control-sm" onchange="javascript:ovif(this.value, '<?php echo $nc;?>','<?php echo $ov;?>')" style="padding: 0px;" >	
								<?php foreach ($fuentes as $dat){ ?>
									<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ftefindpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group col-md-4" id="vif<?=$ov;?>">
							<label for="futic">Resolución FUTIC</label>
							<select id="" name="futic[]" class="form-control form-control-sm" style="padding: 0px;" >	
								<?php foreach ($futic as $dat){ ?>
									<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ft'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group col-md-4">
							<label for="valorAsignado">Valor Asignado</label>
							<input type="number" class="form-control" id="valorAsignado" name="valorAsignado[]" onkeyup="asigmes()" onchange="asigmes()" value="<?=$pf2['asidpa'];?>">
						</div>
						<div class="form-group col-md-4">
							<label for="valorVigencia" style="color:green; font-weight: bolder;">Valor Disponible</label>
							<input type="text" class="form-control" id="valorVigencia" name="valorVigencia[]" style="color:green; font-weight: bolder;" value="<?=$pf2['asidpa'];?>" readonly="">
						</div>

						<!-- ALERTA -->
						<div class="col-md-12">
							<div id="alertdisponible" class="alert alert-danger" role="alert" style="display: none;">							
							  <div>
							    &nbsp;&nbsp; Recuerde que no puede exceder el valor disponible!!
							  </div>
							  <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
							</div>
						</div>
						<!--fiN ALERTA -->
						<?php $ov++; ?>
					<?php endforeach ?>
				</fieldset>
			<?php } //cierra for?>
			<div class="row">
				<div class="form-group col-md-4">
					<label for="cpc">CPC</label>
					<input type="number" class="form-control" id="cpc" name="cpc" value="<?=$pf2['cpc'];?>">
				</div>
				<div class="form-group col-md-12">
					<label for="nomcont">Nombre Contratista</label>
					<input type="text" class="form-control" id="nomcont" name="nomcont" value="<?=$pf2['nomcont'];?>">
				</div>

				<div class="form-group col-md-12">
					<label for="objeto">Objeto/Descripción</label>
					<textarea class="form-control" id="objeto" name="objeto" rows="4"><?=$objetos;?></textarea>
				</div>

				<div class="form-group col-md-6">
					<label for="fechaInicio">Fecha Inicio</label>
					<input type="date" class="form-control" id="fechaInicio" name="fechaInicio" onchange="asigmes()" value="<?=$pf2['fecinidpa'];?>">
				</div>

				<div class="form-group col-md-6">
					<label for="fechaEstimada">Fecha Estimada Final</label>
					<input type="date" class="form-control" id="fechaEstimada" name="fechaEstimada" onchange="asigmes()" value="<?=$pf2['fecfindpa'];?>">
				</div>

					<div class="form-group col-md-4" style="display: none;">
						<label class="switchBtn">
						    <input type="checkbox" class="form-control" value="pagoman" id="pagoman" name="pagoman" onclick="metodoClick();">
						    <div class="slide round">Modificar Número de Pagos</div>
						</label>
					</div>	

					<div class="w-100"> </div>

					<div class="form-group col-md-3">
						<label for="duracion" id="lduracion">Número Pagos</label>
						<input type="number" class="form-control" id="duracion" name="duracion" onkeyup="asigmes()" onchange="asigmes()"  value="<?=$pf2['nmesdpa'];?>" readonly="">
					</div>					
								

					<div class="form-group col-md-3">
						<label for="primerm" id="lprimerm">Valor Primer mes</label>
						<input type="number" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="primerm" name="primerm" value="<?=$pf2['pmes']?>" >
					</div>

					<div class="form-group col-md-3">
						<label for="ultimom" id="lultimom">Valor último mes</label>
						<input type="number" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="ultimom" name="ultimom" value="<?=$pf2['umes']?>" >
					</div>	

					<div class="form-group col-md-3">
						<label for="valormensual" id="lvalormensual">Valor mensual prom.</label>
						<input type="number" class="form-control" id="valormensual" name="valormensual" value=""  readonly="">
					</div>	
					
					<div class="w-100"> </div>

					<div class="form-group col-md-4" >
						<label for="duracion2" id="lduracion2" style="display: none;">Número Pagos.</label>
						<input type="number" style="display: none;" class="form-control" id="duracion2" name="duracion2" onkeyup="quitar()" onchange="quitar()"  value="1" >
					</div>						
					

					<div class="row form-group col-md-12" id="newpay">
						
					</div>	

									

					
					<?php 

						if ($pf2['ftefindpa']==653) {
							echo "<script type='text/javascript'>ovif(653);</script>";		
						}else{
							echo "<script type='text/javascript'>ovif(1);</script>";			
						}
						
					 ?>

					

					<div class="form-group col-md-12" style="display: none;">
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
								
								<option value="<?=$ord['perid'];?>"  <?=isset($pf2) &&  ($ord['perid'])== $pf2['resp'] ? ' selected ' : ''; ?>><?=$ord['pernom']." ".$ord['perape']." (".$ord['valnom'].")";?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group col-md-6">
						<label for="norgas">Ordenador del gasto</label>
						<select id="norgas" name="norgas" class="form-control form-control-sm" onchange="" style="padding: 0px;" >	


							<?php foreach ($ordgas2 as $ord){ ?>
								
								<option value="<?=$ord['perid'];?>"  <?=isset($pf2) &&  ($ord['perid'])== $pf2['ordgas'] ? ' selected ' : ''; ?>><?=$ord['pernom']." ".$ord['perape']." (".$ord['valnom'].")";?></option>
							<?php } ?>
						</select>
					</div>

					<!-- <div class="form-group col-md-4">
						<label for="telefono">Teléfono</label>
						<input type="number" class="form-control" id="telefono" name="telefono" value="<?=$pf2['celres'];?>">
					</div>

					<div class="form-group col-md-4">
						<label for="email">E-Mail</label>
						<input type="email" class="form-control" id="email" name="email" value="<?=$pf2['mailres'];?>">
					</div> -->
				</div>

				<input type="hidden" name="valid" value="<?=$valid;?>">
												
				<div class="row">
					<div class="col-md-3 text-center">
						<button id="btnsolicitar" class="btn-secondary-canalc">Solicitar</button>
					</div>
					<!-- <div class="col-md-3 text-center">
						<button class="btn-primary-ccapital">Nuevo</button>
					</div>
					<div class="col-md-3 text-center">
						<button class="btn-primary-ccapital">Generar Certificado</button>
					</div>
					 -->
				</div>




			</div>
			
			
			
		</form>
		

	<?php endif; ?>	
	

<?php endif; ?>