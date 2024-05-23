<?php if($txtn){ ?>
	<div style="color: #ff0000;font-weight:bold;text-shadow: 1px 1px 1px #787676;">
		¡Su evento o capacitación ha sido <?=$txtn;?>.!<br><br>
	</div>
<?php }?>

<!-- Insertar o Editar datos -->

<?php echo Utils::tit("Eventos - Capacitaciones","fa fa-cogs mr-3","capeve/index&idce=".$idce, "300px"); ?>
<div id="inser"> 

	<?php if(isset($edit) && isset($datOne)): ?>
		<h2 class="title-c m-tb-40">Ver Evento - Capacitación</h2>
		<?php $url_action = base_url."capeve/save&idce=".$datOne[0]['idce'];  
	else: ?>
		<h2 class="title-c m-tb-40">Insertar Evento - Capacitación</h2>
		<?php $url_action = base_url."capeve/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action;?>" method="POST">
		<div class="row">
			<input type="hidden" id="idce" name="idce" value="<?php if($datOne) echo $datOne[0]['idce']; ?>"/>
			<div class="form-group col-md-6">
				<label for="tipce">Tipo</label>
				<select id="tipce" name="tipce" class="form-control form-control-sm" style="padding: 0px;" >	
					<?php foreach ($tipce as $ce){ ?>
						<option value="<?=$ce['valid'];?>" <?php if($datOne AND $ce['valid']==$datOne[0]['tipce']) echo ' selected '; ?>><?=$ce['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="modce">Modalidad</label>
				<select id="modce" name="modce" class="form-control form-control-sm" style="padding: 0px;" >	
					<?php foreach ($modce as $ce){ ?>
						<option value="<?=$ce['valid'];?>" <?php if($datOne AND $ce['valid']==$datOne[0]['modce']) echo ' selected '; ?>><?=$ce['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="nomce">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="nomce" name="nomce" value="<?php if($datOne) echo $datOne[0]['nomce']; ?>" >
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="entce">Entidad Prestante</label>
				<input type="text" class="form-control form-control-sm" id="entce" name="entce" value="<?php if($datOne) echo $datOne[0]['entce']; ?>" >
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="fecince">Fecha Inicio</label>
				<input type="datetime-local" class="form-control form-control-sm" id="fecince" name="fecince" value="<?php if($datOne) echo $datOne[0]['fecince']; else echo $hoy; ?>" >
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="fecfice">Fecha Fin</label>
				<input type="datetime-local" class="form-control form-control-sm" id="fecfice" name="fecfice" value="<?php if($datOne) echo $datOne[0]['fecince']; else echo $hoy; ?>" >
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="desce">Descripción</label>
				<input type="text" class="form-control form-control-sm" id="desce" name="desce" value="<?php if($datOne) echo $datOne[0]['desce']; ?>" >
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="ubice">Ubicación</label>
				<input type="text" class="form-control form-control-sm" id="ubice" name="ubice" value="<?php if($datOne) echo $datOne[0]['ubice']; ?>" >
			</div>
			<div class="form-group col-md-6">
				<label for="formce">Formalidad</label>
				<select id="formce" name="formce" class="form-control form-control-sm" style="padding: 0px;" >	
					<?php foreach ($formce as $ce){ ?>
						<option value="<?=$ce['valid'];?>" <?php if($datOne AND $ce['valid']==$datOne[0]['formce']) echo ' selected '; ?>><?=$ce['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="linkce">Link</label>
				<input type="text" class="form-control form-control-sm" id="linkce" name="linkce" value="<?php if($datOne) echo $datOne[0]['linkce']; ?>" >
			</div>
			<div class="form-group col-md-6">
				<label for="comce">Competencia por equipo?</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="comce" name="comce" required >
            		<option value="1" <?php if($datOne && $datOne[0]['comce']==1) echo ' selected '; ?> >No</option>
            		<option value="2" <?php if($datOne && $datOne[0]['comce']!=1) echo ' selected '; ?> >SI</option>
		        </select>
			</div>
			<div class="form-group col-md-6">
				<label for="asisce">Requiere asistencia?</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="asisce" name="asisce" required >
            		<option value="1" <?php if($datOne && $datOne[0]['asisce']==1) echo ' selected '; ?> >No</option>
            		<option value="2" <?php if($datOne && $datOne[0]['asisce']!=1)  echo ' selected '; ?> >Si</option>
		        </select>
			</div>

			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>

<!-- Ver datos -->

<h2 class="title-c">Lista Eventos - Capacitaciones</h2><br><br>
<?php $url_action2 = base_url."capeve/index"; ?>

	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Descripción</th>
	                <th>Fecha y Hora</th>
	                <th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php
	        	if(isset($capeve)){
	        		foreach ($capeve as $cs){ ?>  
	        			<tr>
		            		<td>
		            		<strong>Nombre: </strong><?=$cs['nomce'];?>
	                        <small>
	                        	<br><strong>Tipo: </strong><?=$cs['tipo'];?></br>
	                        	<strong>Modalidad: </strong><?=$cs['modal'];?></br>
	                            <strong>Entidad Prestante: </strong> <?=$cs['entce'];?></br>
	                            <strong>Ubicación: </strong> <?=$cs['ubice'];?></br>
	                            <strong>Descripción: </strong> <?=$cs['desce'];?>
	                        </small>
		                </td>
		                	<td>
		                		<strong>Inicio:</strong> <?=$cs['fecince'];?>
		                		<br><br>
		                		<strong>Fin:</strong> <?=$cs['fecfice'];?>
		                	</td>
		                <td>
		                	<a href="<?=base_url?>capeve/edit&idce=<?=$cs['idce'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                	&nbsp;&nbsp;&nbsp;
		                	<a href="<?=base_url?>capeve/list&idce=<?=$cs['idce'];?>">
		                		<i class="fa fa-list" style="color: #523178;"></i>
		                	</a>
		                	<div class="anat">
		                	<?php
								$dtce = new capeve();
		                		$datTCE = $dtce->getTotCE($cs['idce']);
		                	?>
	                			<div class="txttiz">
	                				Asistentes:
	                			</div>
	                			<div class="txttde">
	                				<?=$datTCE[1]['can'];?>
	                			</div>
	                			<div class="txttiz">
	                				No asistentes:
	                			</div>
	                			<div class="txttde">
	                				<?=$datTCE[0]['can'];?>
	                			</div>
	                			<div class="txttiz borsu">
	                				Total Inscritos:
	                			</div>
	                			<div class="txttde borsu">
	                				<?=$datTCE[2]['can'];?>
	                			</div>
		                	</div>
		                </td>
		            </tr>
		       <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Descripción</th>
	                <th>Fecha y Hora</th>
	                <th></th>
	            </tr>
	        </tfoot>
	    </table>
		
	</div>

<?php if(isset($dtOnem)): ?>
	<script>ocultar(1,300);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>