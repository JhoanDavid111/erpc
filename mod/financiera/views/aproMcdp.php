<script src="../js/futic.js"></script>
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
		<h4 class="title-c m-tb-40">Solicitud CDP con Múltiples Rubros</h4>
		<br>
		<form class="m-tb-40" action="<?=base_url;?>paa/aproMCdp" method="POST" enctype="multipart/form-data">
		<!-- <form class="m-tb-40" action="" method="POST"> -->
			<div class="row">
				<div class="form-group col-md-12">
					<label for="codUNSPSC">Cod. UNSPSC</label>
					<input type="text" class="form-control" id="codUNSPSC" name="codUNSPSC" value="<?=$pfinandOne0[0]['unspsc']?>" readonly>
				</div>
			</div>		
			
			<?php $objetos=""; ?>
			<?php for ($i=0;$i<count($codrub1);$i++){  ?>
				<fieldset class="form-group row">
					<?php foreach (${'pfinandOne'.$i} as $pf2): ?>
						<input type="hidden" class="form-control" id="" name="idpro" value="<?=$pf2['idpro'];?>">
						<input type="hidden" class="form-control" id="" name="idpaa" value="<?=$pf2['idpaa'];?>">	

						<input type="hidden" name="idflu" id="idflu" value="<?=$pf2['idflu'];?>">		
						<input type="hidden" name="are" value="<?=$pf2['area'];?>">
						<input type="hidden" name="fluareas" value="<?=$pf2['fluareas'];?>">

						<?php if ($pf2['rutcdp']!=NULL || $pf2['rutcdp']!="" ) { ?>
							<input type="hidden" name="rutcdp" value="<?=$pf2['rutcdp'];?>">
						<?php } ?>
						<?php if ($pf2['rutrp']!=NULL || $pf2['rutrp']!="" ) { ?>
							<input type="hidden" name="rutrp" value="<?=$pf2['rutrp'];?>">
						<?php } ?>

							
						<div class="form-group col-md-12">
							<label for="rubroPre"> Rubro Presupuestal</label>
							<input type="number" class="form-control" id="" name="rubroPre[]" value="<?=$ninipaa.$pf2['codrub'];?>" readonly>
							<input type="hidden" name="iddpa[]" id="" value="<?=$pf2['iddpa'];?>">
						</div>
						
						<div class="form-group col-md-12">
							<label for="nombreRubro">Nombre Rubro Presupuestal</label>
							<input type="text" class="form-control" id="" name="nombreRubro[]" value="<?=$pf2['nomrub'];?>" readonly="">
						</div>

						<?php $objetos .= $pf2['nobjeto'].'. '; ?>

						<div class="form-group col-md-4">
							<label for="tipcondpa">Modalidad</label>

							<select id="" name="tipcondpa[]" class="form-control form-control-sm" style="padding: 0px;" readonly>	
								<?php foreach ($tipocontra as $dat){ ?>
									<option value="<?=$dat['vafid'];?>"  <?= $pf2['tipcondpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group col-md-4">
							<label for="ftefindpa">Fuente de Recursos</label>
							<select id="" name="ftefindpa[]" class="form-control form-control-sm" onchange="javascript:ovif(this.value);" style="padding: 0px;" readonly>	
								<?php foreach ($fuentes as $dat){ ?>
									<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ftefindpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group col-md-4" id="vif">
							<label for="futic">Resolución FUTIC</label>
							<select id="" name="futic[]" class="form-control form-control-sm" style="padding: 0px;" readonly>	
								<?php foreach ($futic as $dat){ ?>
									<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ft'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group col-md-4">
							<label for="valorAsignado">Valor Asignado</label>
							<input type="number" class="form-control" id="valorAsignado" name="valorAsignado[]" onkeyup="asigmes()" onchange="asigmes()" value="<?=$pf2['asidpa'];?>" readonly>
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
						
					<?php endforeach ?>
				</fieldset>
			<?php } //cierra for?>

			<div class="form-group col-md-4">
				<label for="valor" style="color:green; font-weight: bolder;">Total CDP Múltiple: $ <?=number_format($suma, 0, ',', '.');?></label>
				<!-- <input type="text" class="form-control" id="valor" name="valor" style="color:green; font-weight: bolder;" value="$ <?=number_format($suma, 0, ',', '.');?>" readonly=""> -->
			</div>	
			<div class="row">
				<div class="form-group col-md-4">
					<label for="cpc">CPC</label>
					<input type="number" class="form-control" id="cpc" name="cpc" value="<?=$pf2['cpc'];?>" readonly>
				</div>
				<div class="form-group col-md-12">
					<label for="nomcont">Nombre Contratista</label>
					<input type="text" class="form-control" id="nomcont" name="nomcont" value="<?=$pf2['nomcont'];?>" readonly>
				</div>

				<div class="form-group col-md-12">
					<label for="objeto">Objeto/Descripción</label>
					<textarea class="form-control" id="objeto" name="objeto" rows="4" readonly><?=$objetos;?></textarea>
				</div>

				<div class="form-group col-md-6">
					<label for="fechaInicio">Fecha Inicio</label>
					<input type="date" class="form-control" id="fechaInicio" name="fechaInicio" onchange="asigmes()" value="<?=$pf2['fecinidpa'];?>" readonly>
				</div>

				<div class="form-group col-md-6">
					<label for="fechaEstimada">Fecha Estimada Final</label>
					<input type="date" class="form-control" id="fechaEstimada" name="fechaEstimada" onchange="asigmes()" value="<?=$pf2['fecfindpa'];?>" readonly>
				</div>

					<div class="form-group col-md-4" style="display: none;">
						<label class="switchBtn">
						    <input type="checkbox" class="form-control" value="pagoman" id="pagoman" name="pagoman" onclick="metodoClick();">
						    <div class="slide round">Modificar Número de Pagos</div>
						</label>
					</div>	

					<div class="w-100"> </div>

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
							<input type="number" style="display: none;" class="form-control" id="valormensual" name="valormensual" value=""  readonly="">
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
						<div class="form-group col-md-4" style="display: none;">
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
							<input type="number" style="display: block;" class="form-control" id="valormensual" name="valormensual" value=""  readonly="">
						</div>	

						<div class="w-100"> </div>
					
						<div class="form-group col-md-4" >
							<label for="duracion2" id="lduracion2" style="display: none;">Número Pagos.</label>
							<input type="number" style="display: none;" class="form-control" id="duracion2" name="duracion2" onkeyup="quitar()" onchange="quitar()"  value="<?=$pf2['cuodpa'];?>">
						</div>	
				
					<?php } ?>	
					
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

<!-- 				<input type="hidden" name="valid" value="">			 -->
				<!-- <input type="hidden" name="valid" value="<?=$valid;?>">	 -->							
				
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
			
		</form>
		

	<?php endif; ?>	
	

<?php endif; ?>