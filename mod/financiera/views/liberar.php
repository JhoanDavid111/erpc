<script src="../js/futic.js"></script>
<script src="../js/cdpaux.js"></script>

<?php if(isset($pfinandOne) && $_SESSION['apro']==null): ?>
	<?php foreach ($pfinandOne as $pf2){ ?>
		<h4 class="title-c m-tb-40">Liberar Saldo</h4>
		<form class="m-tb-40" action="<?=base_url;?>paa/editLibera" method="POST">
			<!-- <input type="hidden" name="are" id="are" value="<?=$pf2['area'];?>"> -->
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


				<!-- <div class="form-group col-md-12">
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
				</div> -->

				<?php 
					$valasignado = " $ ".number_format($pf2['asidpa'], 0, ',', '.');

				 ?>

				<div class="form-group col-md-6">
					<label for="valorAsignado">Valor Asignado</label>
					<input type="text" class="form-control" id="valorAsignado2" name="valorAsignado2" onkeyup="asigmes()" onchange="asigmes()" value="<?=$valasignado;?>" readonly>
					<input type="hidden" class="form-control" id="valorAsignado" name="valorAsignado" onkeyup="asigmes()" onchange="asigmes()" value="<?=$pf2['asidpa'];?>" readonly>
				</div>	
				<div class="form-group col-md-6">
					<label for="valiberar">Valor a liberar</label>
					<input type="number" class="form-control" id="valiberar" name="valiberar" onkeyup="asigmes()" onchange="asigmes()">					
				</div>				
				

				<!-- ALERTA -->
				<div class="col-md-12">
					<div id="alertdisponible" class="alert alert-danger" role="alert" style="display: none;">							
					  <div>
					    &nbsp;&nbsp; Recuerde que no puede exceder el valor disponible!!
					  </div>
					 
					</div>
				</div>

			</div>

			<!-- <br><br> -->		

			<br><br>	
												
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

<?php endif; ?>