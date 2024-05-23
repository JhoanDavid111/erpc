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
                	<?=$datOusu[0]['pernom'];?> <?=$datOusu[0]['perape'];?>
                </td>
            </tr>
            <tr>
                <th>N° Documento:</th>
                <td>
                	<?=$datOusu[0]['nodocemp'];?>
                </td>
                <th>Celular:</th>
                <td>
                	<?=$datOusu[0]['percel'];?>
                </td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>
                	<?=$datOusu[0]['peremail'];?>
                </td>
            </tr>
	    </table>
	    <br><br>
	</div>

<!-- Insertar o Editar datos -->

<?php echo Utils::tit("Persona a Cargo","fa fa-cogs mr-3","percargo/index&perid=".$perid, "350px"); ?>
<div id="inser"> 

	<?php if(isset($edit) && isset($datOne)): ?>
		<h2 class="title-c m-tb-40">Ver Personas a Cargo</h2>
		<?php $url_action = base_url."percargo/save&perid=".$datOne[0]['perid']; 
	else: ?>
		<h2 class="title-c m-tb-40">Insertar Persona a Cargo</h2>
		<?php $url_action = base_url."percargo/save"; ?>
	<?php endif; ?>
		
	<form class="m-tb-40" action="<?=$url_action;?>" method="POST">
		<div class="row">
			<input type="hidden" id="idpcg2" name="idpcg2" value="<?=isset($datOne) ? $datOne[0]['idpcg2'] : ''; ?>"/>
			<input type="hidden" id="perid" name="perid" value="<?=isset($perid) ? $perid : ''; ?>"/>
			<div class="form-group col-md-6">
				<label for="tdocpcg">Tipo Documento</label>
				<select id="tdocpcg" name="tdocpcg" class="form-control form-control-sm" style="padding: 0px;" required >	
					<?php foreach ($tdocpcg as $pc){ ?>
						<option value="<?=$pc['valid'];?>" <?php if($datOne AND $pc['valid']==$datOne[0]['tdocpcg']) echo ' selected '; ?>><?=$pc['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="idpcg">Número de Documento</label>
				<input type="number" class="form-control form-control-sm" id="idpcg" name="idpcg" value="<?=isset($datOne) ? $datOne[0]['idpcg']:''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="nompcg">Nombre y Apellidos Pariente</label>
				<input type="text" class="form-control form-control-sm" id="nompcg" name="nompcg" value="<?=isset($datOne) ? $datOne[0]['nompcg'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="sexpcg">Sexo</label>
				<select id="sexpcg" name="sexpcg" class="form-control form-control-sm" style="padding: 0px;" required >
					<?php foreach ($sexpcg as $pc){ ?>
						<option value="<?=$pc['valid'];?>" <?php if($datOne AND $pc['valid']==$datOne[0]['sexpcg']) echo ' selected '; ?>><?=$pc['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="fnacpcg">Fecha nacimiento persona a cargo</label>
				<input type="date" class="form-control form-control-sm" id="fnacpcg" name="fnacpcg" value="<?=isset($datOne) ? $datOne[0]['fnacpcg']:$hoy; ?>" >
			</div>
			<div class="form-group col-md-6">
				<label for="prtpcg">Parentesco</label>
				<select id="prtpcg" name="prtpcg" class="form-control form-control-sm" style="padding: 0px;" required >
					<?php foreach ($prtpcg as $pc){ ?>
						<option value="<?=$pc['valid'];?>" <?php if($datOne AND $pc['valid']==$datOne[0]['prtpcg']) echo ' selected '; ?>><?=$pc['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="tippcg">Tipologia</label>
				<select id="tippcg" name="tippcg" class="form-control form-control-sm" style="padding: 0px;" required >
					<?php foreach ($tippcg as $pc){ ?>
						<option value="<?=$pc['valid'];?>" <?php if($datOne AND $pc['valid']==$datOne[0]['tippcg']) echo ' selected '; ?>><?=$pc['valnom'];?></option>
					<?php } ?>
				</select>
			</div>

<!-- Boton Registrar -->			
			</div>
			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>
		</div>
	</form>
</div>

<!-- Ver datos -->

<h2 class="title-c">Lista de Personas a Cargo</h2>
<?php $url_action2 = base_url."percargo/index"; ?>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Detalle</th>
	                <th>Tipologia</th>
	                <th>Parentesco</th>
	                <th>Opciones</th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($percargo)){
	        		foreach ($percargo as $cp){ ?>	        	
		            <tr>
		            	<td>
		            		<?=$cp['nompcg'];?><br>
		            		
	                        <small>
	                        	<br><strong>Tipo Documento </strong><?=$cp['tdocpcg'];?></br>
	                        	<strong>N° Documento </strong><?=$cp['idpcg'];?>
	                            </br>
	                            <strong>Fecha de Nacimiento:</strong> <?=$cp['fnacpcg'];?>
		                </td>
		                <td>
		                	<?=$cp['tippcg'];?>
		                	<br>
		                	<strong>Edad: <?=$cp['Edad'];?>	Años</strong>
		                </td>
		                <td>
		                	<?=$cp['prtpcg'];?> 
		                </td>
		                <td>
		                	<a href="<?=base_url?>percargo/edit&perid=<?=$perid;?>&idpcg2=<?=$cp['idpcg2'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                	<!--<a href="<?=base_url?>percargo/edit&perid=<?=$val['perid'];?>">
		                		<i class="fa fa-times-circle" style="color: #523178;"></i>
		                	</a> -->
		                </td>
		            </tr>
		       <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Detalle</th>
	                <th>Tipologia</th>
	                <th>Parentesco</th>
	                <th></th>
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