<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Valor","fa fa-address-card ico3","valor/index","300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Editar Valor<!-- <?=$val[0]['valnom']?> --></h2>
		<?php $url_action = base_url."valor/save&valid=".$val[0]['valid']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo Valor</h2>
		<?php $url_action = base_url."valor/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">
			<div class="form-group col-md-6">
				<label for="valid">Cod.</label>
				<input type="number" class="form-control form-control-sm" id="valid" name="valid" value="<?=isset($val) ? $val[0]['valid'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="valnom">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="valnom" name="valnom" value="<?=isset($val) ? $val[0]['valnom'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="parid">Dominio</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="parid" name="parid">
				<?php 
				if($valors){

					foreach ($params as $do){ ?>
		            
		                <option value="<?=$do['parid'];?>" <?=isset($val) && $do['parid']==$val[0]['parid'] ? ' selected ' : ''; ?> ><?=$do['parid'];?> - <?=$do['parnom'];?></option>
		            
		        <?php }} ?>
		        </select>
			</div>
			<!-- <div class="form-group col-md-6">
				<label for="valfijo">Valor Fijo</label>
				<input type="text" class="form-control form-control-sm" id="valfijo" name="valfijo" value="<?=isset($val) ? $val[0]['valfijo'] : ''; ?>"/>
			</div> -->
			<div class="form-group col-md-6">
				<label for="pre">Proceso</label>
				<input type="text" class="form-control form-control-sm" id="pre" name="pre" value="<?=isset($val) ? $val[0]['pre'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="abr">Abreviatura</label>
				<input type="text" maxlength="100" class="form-control form-control-sm" id="abr" name="abr" value="<?=isset($val) ? $val[0]['abr'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="ncon">No. Consecutivo</label>
				<input type="number" class="form-control form-control-sm" id="ncon" name="ncon" value="<?=isset($val) ? $val[0]['ncon'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="cdpmul">Cdp Multiple</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="cdpmul" name="cdpmul">
		            <option value="1" <?=isset($val) && $val[0]['cdpmul']==1 ? ' selected ' : ''; ?> >Activado</option>
		            <option value="2" <?=isset($val) && $val[0]['cdpmul']==2 ? ' selected ' : ''; ?> >Desactivado</option>
		        </select>
			</div>

			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>

<br>
<!-- Ver datos -->

<h2 class="title-c">Valores</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Cód.</th>
					<th>Nombre</th>								
					<th>Dominio</th>
					<th>Abre.</th>
					<th>CDP Mult.</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($valors)){
	        		foreach ($valors as $va){ ?>
		            <tr>
		                <td><?=$va['valid'];?></td>
		                <td>
		                	<?=$va['valnom'];?>
		                	<br>
		                	<small>
		                		<?php if($va['valfijo']){ ?>
			                		<strong>Depende: </strong>
			                		<?=$va['valfijo'];?>
			                	<?php } ?>
			                	<?php if($va['ncon']){ ?>
			                		<strong> Consecutivo: </strong>
			                		<?=$va['ncon'];?>
			                	<?php } ?>
		                		<?php if($va['pre']){ ?>
		                			<br>
			                		<strong>Proceso: </strong>
			                		<?=$va['pre'];?>
			                	<?php } ?>
		                	</small>
		                </td>				                
		                <td><?=$va['parnom'];?></td>
		                <td><?=$va['abr'];?></td>
		                <td>
		                	<span style="opacity: 0"><?=$va['cdpmul'];?></span>
		                	<?php if($va['cdpmul']==1){ ?>
		                		<a href="<?=base_url?>valor/act&valid=<?=$va['valid'];?>&cdpmul=2">
				                	<i class="fas fa-check-circle" style="color: #523178;">
				                		<span style="color: rgba(255,255,255,0);">+</span>
				                	</i>
				                </a>
			                <?php }else{ ?>
			                	<a href="<?=base_url?>valor/act&valid=<?=$va['valid'];?>&cdpmul=1">
									<i class="fas fa-times-circle" style="color: #f00;">
										<span style="color: rgba(255,255,255,0);">-</span>
									</i>
								</a>
							<?php } ?>
		                </td>
		                <td>
		                	<a href="<?=base_url?>valor/edit&valid=<?=$va['valid'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Cód.</th>
					<th>Nombre</th>								
					<th>Dominio</th>
					<th>Abre.</th>
					<th>CDP Mult.</th>
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