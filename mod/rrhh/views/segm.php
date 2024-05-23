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
                	<?=$datSegm[0]['pernom'];?>  <?=$datSegm[0]['perape'];?>
                </td>
            </tr>            
            <tr>
                <th>N° Documento:</th>
                <td>
                	<?=$datSegm[0]['nodocemp'];?>
                </td>
                <th>Celular:</th>
                <td>
                	<?=$datSegm[0]['percel'];?>
                </td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>
                	<?=$datSegm[0]['peremail'];?>
                </td>
            </tr>
        </table>
	    <br><br>
	</div>	

<!-- Insertar o Editar datos -->

<?php echo Utils::tit("Condicion Medica","fa fa-cogs mr-3","segm/index&perid=".$perid, "350px"); ?>
<div id="inser"> 

	<?php if(isset($edit) && isset($datOne)): ?>
		<h2 class="title-c m-tb-40">Editar Condicioner Medicas</h2>
		<?php $url_action = base_url."segm/save&perid=".$datOne[0]['perid'];  
	else: ?>
		<h2 class="title-c m-tb-40">Insertar Condicioner Medicas</h2>
		<?php $url_action = base_url."segm/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action;?>" method="POST">
		<div class="row">
			<input type="hidden" id="idcondiusu" name="idcondiusu" value="<?=isset($datOne) ? $datOne[0]['idcondiusu'] : ''; ?>"/>
			<input type="hidden" id="perid" name="perid" value="<?=isset($perid) ? $perid:''; ?>"/>			
			<div class="form-group col-md-12" id="go1">
			<h2 class="title-c m-tb-40">Discapacidad</h2>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="tiedis">Tiene Discapacidad</label>
				<select id="tiedis" name="tiedis" class="form-control form-control-sm" onchange="javascript:ovid(this.value);" style="padding: 0px;"  required >
            		<option value="1" <?=isset($datOne) && $datOne[0]['tiedis']==1 ? ' selected ' : ''; ?> >NO</option>
            		<option value="2" <?=isset($datOne) && $datOne[0]['tiedis']!=1 ? ' selected ' : ''; ?> >SI</option>
		        </select>
			</div>
			<div id="discap" class="form-group col-md-6" id="go1">
				<label for="disca">Discapacidad</label>
				<select id="disca" name="disca" class="form-control form-control-sm" style="padding: 0px;" >	
					<?php foreach ($disca as $cm){ ?>
						<option value="<?=$cm['valid'];?>" <?php if($datOne AND $cm['valid']==$datOne[0]['tipo']) echo ' selected '; ?>><?=$cm['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
			<div id="discon" class="form-group col-md-6" id="go1">
				<label for="arcdis">Adjuntar certificado de discapacidad</label>
				<input type="file" class="form-control form-control-sm" id="arcdis" name="arcdis" />
			</div>			
		
			<div class="form-group col-md-12" id="go1">
				<h2 class="title-c m-tb-40">Condiciones Medicas</h2>
				<br><br>
				<label for="cappla">En caso de tener una condición médica que requiera especial atención por cuenta de la entidad o que pueda modificar las condiciones para su desempeño o el de su entorno y que tenga un soporte médico por favor regístrela. La Condición de discapacidad debe estar dentro de señalado en la Resolución 583 de 2018 expedida por el Ministerio de Salud.</label>				
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="fecdia">Fecha diagnostico</label>
				<input type="date" class="form-control form-control-sm" id="fecdia" name="fecdia" value="<?=isset($datOnedatOne) ? $datOnedatOne[0]['fecdia']:$hoy; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="tipo">Tipologia</label>
				<select id="tipo" name="tipo" class="form-control form-control-sm" style="padding: 0px;" >	
					<?php foreach ($tipo as $cm){ ?>
						<option value="<?=$cm['valid'];?>" <?php if($datOne AND $cm['valid']==$datOne[0]['tipo']) echo ' selected '; ?>><?=$cm['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="diag">Diagnostico</label>
				<input type="text" class="form-control form-control-sm" id="diag" name="diag" value="<?=isset($datOne) ? $datOne[0]['diag'] : ''; ?>" >
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="condi">Condición</label>
				<select id="condi" name="condi" class="form-control form-control-sm" style="padding: 0px;" >	<?php foreach ($condi as $cm){ ?>
						<option value="<?=$cm['valid'];?>" <?php if($datOne AND $cm['valid']==$datOne[0]['condi']) echo ' selected '; ?>><?=$cm['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="fecfincod">Fecha fin de la condición</label>
				<input type="date" class="form-control form-control-sm" id="fecfincod" name="fecfincod" value="<?=isset($datOne) ? $datOne[0]['fecfincod']:$hoy; ?>" >
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="arccon">Adjuntar certificado de condicion medica</label>
				<input type="file" class="form-control form-control-sm" id="arccon" name="arccon" />
			</div>

			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
<!-- </div> -->
</div>

<!-- Ver datos -->

<h2 class="title-c">Lista de condiciones medicas</h2>
<?php $url_action2 = base_url."segm/index"; ?>

	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Diagnostico</th>
	                <th>Tipologia</th>
	                <th>Tipo de enfermedad</th>
	                <th>Opciones</th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php
	        	if(isset($segm)){
	        		foreach ($segm as $sg){ ?>  
	        			<tr>
		            		<td>
		            			<?=$sg['diag'];?>
		            			<br>
		            			<strong>Fecha Diagnostico: </strong>
		            			<?=$sg['fecdia'];?>
		                	</td>
		                	<td>
		                		<?=$sg['nomtipo'];?>
		                	</td>
		                	<td>
	                       		<?=$sg['nomdisca'];?>
		                	</td>
		                <td>
		                	<a href="<?=base_url?>segm/edit&perid=<?=$perid;?>&idcondiusu=<?=$sg['idcondiusu'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                </td>
		            </tr>
		       <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Diagnostico</th>
	                <th>Tipologia</th>
	                <th>Tipo de enfermedad</th>
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

<script type="text/javascript" src="../js/discap.js"></script>