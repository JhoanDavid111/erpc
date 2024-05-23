<?php if($txtn){ ?>
	<div style="color: #ff0000;font-weight:bold;text-shadow: 1px 1px 1px #787676;">
		¡Su usuario ha sido <?=$txtn;?>.!<br><br>
	</div>
<?php }?>


<h2 class="title-c">Informacion Usuario</h2>
<br><br>
	<div class="table-responsive">
		<table style="width:100%;" border="1" class="mitabla">
			<tr>
            	<th>Nombre y Apellidos:</th>
                <td colspan="3">
                	<?=$datPer[0]['pernom'];?>  <?=$datPer[0]['perape'];?>
                </td>
            </tr>            
            <tr>
                <th>N° Documento:</th>
                <td>
                	<?=$datPer[0]['nodocemp'];?>
                </td>
                <th>Celular:</th>
                <td>
                	<?=$datPer[0]['percel'];?>
                </td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>
                	<?=$datPer[0]['peremail'];?>
                </td>
            </tr>
        </table>
	    <br><br>
	</div>	

<!-- Insertar o Editar datos -->

<?php echo Utils::tit("Exp. Laboral","fa fa-cogs mr-3","expl/index&perid=".$perid, "350px"); ?>
<div id="inser">
	
	<?php if(isset($edit) && isset($datOne)): ?>
		<h2 class="title-c m-tb-40">Editar Experiencia Laboral</h2>
		<?php $url_action = base_url."expl/save&perid=".$datOne[0]['perid']; 
	else: ?>
		<h2 class="title-c m-tb-40">Insertar Experiencia Laboral</h2>
		<?php $url_action = base_url."expl/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action;?>" method="POST">
		<div class="row">
			<input type="hidden" id="idexplab" name="idexplab" value="<?=isset($datOne) ? $datOne[0]['idexplab'] : ''; ?>"/>
			<input type="hidden" id="perid" name="perid" value="<?=isset($perid) ? $perid : ''; ?>"/>
			<div class="form-group col-md-6">
				<label for="noment">Nombre de la entidad</label>
				<input type="text" class="form-control form-control-sm" id="noment" name="noment" value="<?=isset($datOne) ? $datOne[0]['noment'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
					<label for="empcar">Empresa o Cargo</label>
					<input type="text" class="form-control form-control-sm" id="empcar" name="empcar" value="<?=isset($datOne) ? $datOne[0]['empcar'] : ''; ?>" required />
				</div>
			<div class="form-group col-md-6" id="go1">
				<label for="natent">Naturaleza de la Entidad</label>
				<select id="natent" name="natent" class="form-control form-control-sm" style="padding: 0px;" required >	
					<?php foreach ($natent as $el){ ?>
						<option value="<?=$el['valid'];?>" <?php if($datOne AND $el['valid']==$datOne[0]['natent']) echo ' selected '; ?>><?=$el['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="traact">Es Trabajo Actual</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="traact" name="traact" required >
            		<option value="1" <?=isset($datOne) && $datOne[0]['traact']==1 ? ' selected ' : ''; ?> >Si</option>
            		<option value="2" <?=isset($datOne) && $datOne[0]['traact']!=1 ? ' selected ' : ''; ?> >No</option>
		        </select>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="dedex">Dedicacion</label>
				<select id="dedex" name="dedex" class="form-control form-control-sm" style="padding: 0px;" required >	
					<?php foreach ($dedex as $el){ ?>
						<option value="<?=$el['valid'];?>" <?php if($datOne AND $el['valid']==$datOne[0]['dedex']) echo ' selected '; ?>><?=$el['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="emaent">Correo electronico de la entidad</label>
				<input type="Email" class="form-control form-control-sm" id="emaent" name="emaent" value="<?=isset($datOne) ? $datOne[0]['emaent']:''; ?>"  />
			</div>
			<div class="form-group col-md-6">
				<label for="nument">Numero teléfono entidad</label>
				<input type="number" class="form-control form-control-sm" id="nument" name="nument" value="<?=isset($datOne) ? $datOne[0]['nument']:''; ?>"  />
			</div>
			<div class="form-group col-md-6">
				<label for="fecing">Fecha de ingreso</label>
				<input type="date" class="form-control form-control-sm" id="fecing" name="fecing" value="<?=isset($datOne) ? $datOne[0]['fecing']:$hoy; ?>" required />
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="fecret">Fecha de Retiro</label>
				<input type="date" class="form-control form-control-sm" id="fecret" name="fecret" value="<?=isset($datOne) ? $datOne[0]['fecret']:$hoy; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="cauret">Causa Retiro</label>
				<select id="cauret" name="cauret" class="form-control form-control-sm" style="padding: 0px;" required >	
					<?php foreach ($cauret as $el){ ?>
						<option value="<?=$el['valid'];?>" <?php if($datOne AND $el['valid']==$datOne[0]['cauret']) echo ' selected '; ?>><?=$el['valnom'];?></option>
					<?php } ?>
				</select>				
			</div>
			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>
		</div>
	</form>
</div> 
<!-- Ver datos -->

<h2 class="title-c">Lista de experiencias laborales</h2>
<?php $url_action2 = base_url."expl/index"; ?>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Nombre Empresa</th>
	                <th>Cargo o Contrato</th>
	                <th>Fecha Ingreso</th>
	                <th>Fecha Retiro</th>
	                <th>Opciones</th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($expla)){
	        		foreach ($expla as $xp){ ?>
		            <tr>
		            	<td>
		            		<?=$xp['noment'];?>  
		                </td>
		                <td>
		                	<?=$xp['empcar'];?>
		                </td>
		                <td>
	                       	<?=$xp['fecing'];?>
		                </td>
		                <td>
	                       	<?=$xp['fecret'];?>
		                </td>
		                <td>
						<a href="<?=base_url?>expl/edit&perid=<?=$perid;?>&idexplab=<?=$xp['idexplab'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
							<!-- <a href="<?=base_url?>expl/edit&perid=<?=$perid?>">
		                		<i class="fa fa-times-circle" style="color: #523178;"></i>
		                	</a> -->
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Nombre Empresa</th>
	                <th>Cargo o Contrato</th>
	                <th>Fecha Ingreso</th>
	                <th>Fecha Retiro</th>
	                <th>Opciones</th>
	            </tr>
	        </tfoot>
	    </table>
		
	</div>

	<br>

<?php if(isset($edit) && isset($val)): ?>
	<script>ocultar(1,300);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>