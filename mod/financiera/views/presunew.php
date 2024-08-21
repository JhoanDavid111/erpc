<!-- <script src="js/my.js"></script> -->
<script src="../js/futic.js"></script>
<script src="../js/cdpaux.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<?php if (isset($_SESSION['consultado']) && !isset($ediAnte)): ?>
	<h2 class="title-c m-tb-40">Nuevo Registro Pesupuestal</h2>

	<br><br>
	
	<!-- ALERTA -->
	<div class="col-md-12">
		<div id="alertdisponible" class="alert alert-danger" role="alert" style="display: none;">
		  <div>
		    &nbsp;&nbsp; Seleccione el rubro con el cual se va a ingresar el registro presupuestal.!!
		  </div>
		</div>
	</div>
	<!-- FIN ALERTA -->

	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Código</th>												
					<th>Nombre Rubro</th>
					<th>Act</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($rubrosPf)){
	        		$contar=0;
	        		foreach ($rubrosPf as $ep){ $contar++; ?>
		            <tr>
		                <td id="codrubr" value="<?=$ninipaa.$ep['codrub'];?>"><?=$ninipaa.$ep['codrub'];?> <input type="text" id="<?=$contar?>" value="<?=$ninipaa.$ep['codrub'];?>" hidden></td>               			                
		                <td><?=$ep['nomrub'];?></td>
		                <td>
		                <?php if($ep['actrub']==1){ ?>
		                	<i class="fas fa-check-circle" style="color: #0071bc;">
		                		<span style="color: rgba(255,255,255,0);">+</span>
		                	</i>
		                <?php }else{ ?>
							<i class="fas fa-times-circle" style="color: #f00;">
								<span style="color: rgba(255,255,255,0);">-</span>
							</i>
						<?php } ?>
		                </td>
		                <td>
		                	<input type="radio" id="<?=$ninipaa.$ep['codrub'];?>" name="rubro" onclick="rubri(<?=$contar;?>,'<?=$ep['nomrub'];?>')" value="<?=$ep['codrub'];?>" <?= $ep['codrub'] == $editp ? ' checked ' : ''; ?>>

		                <!-- 	<input type="radio" id="<?=$ninipaa.$ep['codrub'];?>" name="rubro" onclick="rubri(<?=strval($ninipaa.$ep['codrub']);?>,'<?=$ep['nomrub'];?>')" value="<?=$ep['codrub'];?>" <?= $ep['codrub'] == $editp ? ' checked ' : ''; ?>> -->

		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Código</th>													
					<th>Nombre Rubro</th>
					<th>Act</th>
					<th></th>
	            </tr>
	        </tfoot>
	    </table>
	</div>
<?php endif; ?>
				
<div class="row">
	<div class="form-group col-md-12">
		<?php if(isset($edit) && isset($rub)){ ?>
			<label for="dependencias">Dependencias</label>
			<br>
			<span id="dependencias" style="font-size: 11px;">
                <?=isset($dependencias) ? $dependencias:''; ?>
	        </span>
        <?php } ?>
	</div>
	<div class="form-group col-md-12"></div>
</div>
<!--//*********************** //NUEVO //*********************** -->

<?php if(isset($_SESSION['newpaa'])): ?>
	<?php unset($_SESSION['newpaa']); ?>
		<h4 class="title-c m-tb-40">Agregar Registro</h4>
		<br><br>
		<form class="m-tb-40" action="<?=base_url;?>presu/insPresu"  method="POST" >
			<div class="row">
				<div class="form-group col-md-4">
					<label for="areas">Areas</label>
					<?php if($_SESSION["pefid"]==21 OR $_SESSION["pefid"]==34){ ?>
						<?php $areas=Utils::areasu($_SESSION['consultado']); ?>
						<select id="areas" name="areas" class="form-control" style="padding: 0px;" >
							<?php $areas=Utils::areasu($_SESSION['consultado']); ?>	
							<?php foreach ($areas as $pf){ ?>
								<option value="<?=$pf['valid'];?>" <?=$pf['valid']==$_SESSION['depid'] ? ' selected ' : ''; ?>>
									<?=strtoupper($pf['valnom']);?>
								</option>
							<?php } ?>
						</select>
					<?php }else{ ?>
						<input type="hidden" name="areas" value="<?=$_SESSION['depid'];?>">
						<input type="text" class="form-control" value="<?=$_SESSION['nomarea'];?>" readonly>
					<?php } ?>
				</div>
				<div class="form-group col-md-4">
					<label for="codUNSPSC">Cod. UNSPSC</label>
					<input type="text" class="form-control" id="codUNSPSC" name="codUNSPSC" required="" value="<?=isset($pf2) && $pf2['unspsc'] ? $pf2['unspsc'] : '' ;?>">
				</div>
				<div class="form-group col-md-4">
					<label for="rubroPre"> Rubro Presupuestal</label>
					<input type="number" class="form-control" id="rubroPre" name="rubroPre" value="<?=$ninipaa.$pf2['codrub'];?>" readonly>
				</div>
				<div class="form-group col-md-12">
					<label for="nombreRubro">Nombre Rubro Presupuestal</label>
					<input type="text" class="form-control" id="nombreRubro" name="nombreRubro" readonly="">

				</div>
				<div class="form-group col-md-12">
					<label for="nomcont">Nombre Contratista</label>
					<input type="text" class="form-control" id="nomcont" name="nomcont">
				</div>
				<div class="form-group col-md-12">
					<label for="objeto">Objeto/Descripción</label>
					<textarea class="form-control" id="objeto" name="objeto" rows="4" required=""></textarea>
				</div>

				<?php if($_SESSION["pefid"]==21 OR $_SESSION["pefid"]==34){ ?>
					<div class="form-group col-md-12">
						<label for="objdpa">Objetivo</label>							

						<select id="objdpa" name="objdpa" class="form-control form-control-sm" style="padding: 0px;" >	
							<?php foreach ($objetivos as $dat){ ?>
								<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) && $pf2['objdpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
							<?php } ?>
						</select>
					</div>
				<?php }else{ ?>
					<input type="hidden" name="objdpa" value="36">
				<?php } ?>

				<?php if($_SESSION["pefid"]==21 OR $_SESSION["pefid"]==34){ ?>
					<div class="form-group col-md-12">
						<label for="inidpa">Iniciativa</label>
						<select id="inidpa" name="inidpa" class="form-control form-control-sm" style="padding: 0px;" >	
							<?php foreach ($iniciativas as $dat){ ?>
								<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['inidpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
							<?php } ?>
						</select>
					</div>
				<?php }else{ ?>
					<input type="hidden" name="inidpa" value="83">
				<?php } ?>

				<?php if($_SESSION["pefid"]==21 OR $_SESSION["pefid"]==34){ ?>
					<div class="form-group col-md-12">
						<label for="prodpa">Proyecto</label>
						<select id="prodpa" name="prodpa" class="form-control form-control-sm" style="padding: 0px;" >	
							<?php foreach ($proyectos as $dat){ ?>
								<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['prodpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
							<?php } ?>
						</select>
					</div>
				<?php }else{ ?>
					<input type="hidden" name="prodpa" value="418">
				<?php } ?>

				<div class="form-group col-md-6">
					<label for="fechaInicio">Fecha Estimada de Inicio</label>
					<input type="date" class="form-control" id="fechaInicio" name="fechaInicio" onchange="asigmes()" value="<?=$pf2['fecinidpa'];?>">
				</div>

				<div class="form-group col-md-6">
					<label for="fechaEstimada">Fecha Estimada Final</label>
					<input type="date" class="form-control" id="fechaEstimada" name="fechaEstimada" onchange="asigmes()" value="<?=$pf2['fecfindpa'];?>">
				</div>

				<div class="form-group col-md-4">
					<label for="valorAsignado">Valor Asignado</label>
					<input type="text" class="form-control" id="valorAsignado" name="valorAsignado" onkeyup="asigmes()" onchange="asigmes()" value="">
				</div>
				<div class="form-group col-md-4">
					<label for="valorVigencia">Valor Vigencia Actual</label>
					<input type="number" class="form-control" id="valorVigencia" name="valorVigencia" value="">
				</div>
				<div class="col-md-4">
					<label for="#">Requiere vigencia Futura</label>
					<!-- <div class="form-check">
						<input class="form-check-input" type="radio" name="vigenciaF" id="SI" value="SI">
						<label class="form-check-label" for="SI">
							SI
						</label>
					</div> -->
					<div class="form-check">
						<input class="form-check-input" type="radio" name="vigenciaF" id="NO" value="NO" checked>
						<label class="form-check-label" for="NO">
							NO
						</label>
					<!-- <div class="form-check">
						<input class="form-check-input" type="radio" name="vigenciaF" id="SI" value="SI"
							<?=isset($pf2) && $pf2['reqvigf'] == "SI" ? ' checked' : ''; ?>>
						<label class="form-check-label" for="SI">
							SI
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="vigenciaF" id="NO" value="NO" <?=isset($pf2) &&  $pf2['reqvigf'] == "NO" ? ' checked' : ''; ?>>
						<label class="form-check-label" for="NO">
							NO
						</label> -->
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

				<div class="form-group col-md-3">
					<label for="duracion">Número de Pagos</label>
					<input type="number" class="form-control" id="duracion" name="duracion" onkeyup="asigmes()" onchange="asigmes()" value="" readonly="">
				</div>
				<div class="form-group col-md-3">
					<label for="primerm">Valor Primer mes</label>
					<input type="number" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="primerm" name="primerm" value="" >
				</div>

				<div class="form-group col-md-3">
					<label for="ultimom">Valor último mes</label>
					<input type="number" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="ultimom" name="ultimom" value="">
				</div>	

				<div class="form-group col-md-3">
					<label for="valormensual">Valor mensual prom.</label>
					<input type="number" class="form-control" id="valormensual" name="valormensual" value=""  readonly="">
				</div>								

				<div class="form-group col-md-4">
					<label for="tipcondpa">Modalidad</label>
					<select id="tipcondpa" name="tipcondpa" class="form-control form-control-sm" style="padding: 0px;" >	
						<?php foreach ($tipocontra as $dat){ ?>
							<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['tipcondpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
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
							<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ftefindpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
						<?php } ?>
					</select>
				</div>
			</div>

<!-- 			<h4 class="title-c m-tb-40">Proyección de Inversión</h4>
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
			</div> -->

			<br><br>
			<h4 class="title-c m-tb-40">Unidad Ejecutora</h4>
			<br><br>
			<div class="row">
				<?php if (isset($ucontrata)): ?>								
					<div class="form-group col-md-6">
						<label for="unicontra">Unidad de Contratación</label>
						<input type="text" class="form-control" id="unicontra" name="unicontra" value="<?=$ucontrata[0]['vafnom'];?>">
					</div>
					<div class="form-group col-md-6">
						<label for="ubicacion">Ubicación</label>
						<input type="text" class="form-control" id="ubicacion" name="ubicacion" value="<?=$ucontrata[1]['vafnom'];?>">
					</div>
				<?php endif ?>								

				<div class="form-group col-md-6">
					<label for="nombreR">Nombre del solicitante</label>
					<select id="nombreR" name="nombreR" class="form-control form-control-sm" style="padding: 0px;" >
						<?php foreach ($ordgas as $ord){ ?>
							<option value="<?=$ord['perid'];?>">
								<?=$ord['pernom'].' '.$ord['perape'];?>
							</option>								
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
					<label for="idpro">Proceso CDP:</label>
					<select id="idpro" name="idpro" class="form-control form-control-sm" onchange="" style="padding: 0px;">
						<?php foreach ($pcdp as $pcd){ ?>
							<option value="<?=$pcd['idpro'];?>">
								<?=$pcd['nompro'];?>
							</option>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3 text-center">
					<button class="btn-secondary-canalc">Registrar</button>
				</div>
<!-- 				<div class="row" style="opacity: 0; width: 0px; height: 0px;">
					<div class="col-md-3 text-center">
						<button id="btnsolicitar" class="btn-secondary-canalc">Solicitar</button>
					</div>			
				</div> -->
			</div>
		</form>

<?php endif; ?>	
						
<!--//*********************** //FIN NUEVO //*********************** -->
<script>
	$(document).ready(function(){
		//alert('pp');
		//asigmes();
		
	})
</script>