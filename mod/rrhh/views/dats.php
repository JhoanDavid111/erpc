<script type="text/javascript" src="../js/jquery.min.js"></script>
 
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

<?php echo Utils::tit("Edu . Educacion Superior","fa fa-cogs mr-3","dats/index&perid=".$perid, "350px"); ?>
<div id="inser">
	
	<?php if(isset($edit) && isset($datOne)): ?>
		<h2 class="title-c m-tb-40">Editar Educacion Superior</h2>
		<?php $url_action = base_url."dats/save&perid=".$datOne[0]['perid']; 
	else: ?>
		<h2 class="title-c m-tb-40">Insertar Educacion Superior</h2>
		<?php $url_action = base_url."dats/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action;?>" method="POST">
		<div class="row">
			<input type="hidden" id="idedusup" name="idedusup" value="<?=isset($datOne) ? $datOne[0]['idedusup'] : ''; ?>"/>
			<input type="hidden" id="perid" name="perid" value="<?=isset($perid) ? $perid : ''; ?>"/>
			<div class="form-group col-md-6">
				<label for="nomedusup">Nombre Instituto de Formación</label>
				<input type="text" class="form-control form-control-sm" id="nomedusup" name="nomedusup" value="<?=isset($datOne) ? $datOne[0]['nomedusup'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="dep">Nombre Titulo o Programa</label>
				<input type="text" class="form-control form-control-sm" id="dep" name="dep" value="<?=isset($datOne) ? $datOne[0]['dep'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="tiptitul">Titulo</label>
				<select id="tiptitul" name="tiptitul" class="form-control form-control-sm" style="padding: 0px;" required >	
					<?php foreach ($tiptitul as $ds){ ?>
						<option value="<?=$ds['valid'];?>" <?php if($datOne AND $ds['valid']==$datOne[0]['tiptitul']) echo ' selected '; ?>><?=$ds['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="ulsecu">Ultimo Semestre Cursado</label>
				<select id="ulsecu" name="ulsecu" class="form-control form-control-sm" style="padding: 0px;" required >	
					<?php foreach ($ulsecu as $ds){ ?>
						<option value="<?=$ds['valid'];?>" <?php if($datOne AND $ds['valid']==$datOne[0]['ulsecu']) echo ' selected '; ?>><?=$ds['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="feculsem">Fecha de ultimo Semestre Cursado</label>
				<input type="date" class="form-control form-control-sm" id="feculsem" name="feculsem" value="<?=isset($datOne) ? $datOne[0]['feculsem']:$hoy; ?>" required />
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="grad">Graduado</label>
				<select id="grad" name="grad" class="form-control form-control-sm" onchange="javascript:grad(this.value);" style="padding: 0px;"  required >
            		<option value="1" <?=isset($datOne) && $datOne[0]['grad']==1 ? ' selected ' : ''; ?> >SI</option>
            		<option value="2" <?=isset($datOne) && $datOne[0]['grad']!=1 ? ' selected ' : ''; ?> >NO</option>
		        </select>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="fecgrad">Fecha de Grado</label>
				<input type="date" class="form-control form-control-sm" id="fecgrad" name="fecgrad" value="<?=isset($datOne) ? $datOne[0]['fecgrad']:$hoy; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="tarjp">Tarjeta Profesional</label>
				<select id="tarjp" name="tarjp" class="form-control form-control-sm" style="padding: 0px;" required >	
					<?php foreach ($tarjp as $ds){ ?>
						<option value="<?=$ds['valid'];?>" <?php if($datOne AND $ds['valid']==$datOne[0]['tarjp']) echo ' selected '; ?>><?=$ds['valnom'];?></option>
					<?php } ?>
				</select>				
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="modest">Modalidad de Estudio</label>
				<select id="modest" name="modest" class="form-control form-control-sm" style="padding: 0px;" required >	
					<?php foreach ($modest as $ds){ ?>
						<option value="<?=$ds['valid'];?>" <?php if($datOne AND $ds['valid']==$datOne[0]['modest']) echo ' selected '; ?>><?=$ds['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="medcap">Medio de Capacitaciòn</label>
				<select id="medcap" name="medcap" class="form-control form-control-sm" style="padding: 0px;" required >	
					<?php foreach ($medcap as $ds){ ?>
						<option value="<?=$ds['valid'];?>" <?php if($datOne AND $ds['valid']==$datOne[0]['medcap']) echo ' selected '; ?>><?=$ds['valnom'];?></option>
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

<h2 class="title-c">Datos de Educacion Superior</h2>
<?php $url_action2 = base_url."dats/index"; ?>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Nombre Instituto de Formación</th>
	                <th>Nombre Titulo o Programa</th>
	                <th>Titulo</th>
	                <th>Opciones</th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($edusup)){
	        		foreach ($edusup as $ed){ ?>
		            <tr>
		            	<td>
		            		<?=$ed['nomedusup'];?><br>
		            		<small><?=$ed['nomme'];?></small>
		                </td>
		                <td>
		                	<?=$ed['dep'];?>
		                </td>
		                <td>
	                       	<?=$ed['nomtt'];?>
		                </td>
		                <td>
		                	<a href="<?=base_url?>dats/edit&perid=<?=$perid;?>&idedusup=<?=$ed['idedusup'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                	<!-- <a href="<?=base_url?>dats/edit&perid=<?=$perid?>">
		                		<i class="fa fa-times-circle" style="color: #523178;"></i>
		                	</a> -->
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
					<th>Nombre Instituto de Formación</th>
	                <th>Nombre Titulo o Programa</th>
	                <th>Titulo</th>
	                <th>Opciones</th>
	            </tr>
	        </tfoot>
	    </table>
		
	</div>

	<br>

<?php if(isset($edit) && isset($datOne)): ?>
	<script>ocultar(1,300);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>