<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Valor","fa fa-address-card ico3","eleval/index","300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Editar Valor<!-- <?=$val[0]['nomvel']?> --></h2>
		<?php $url_action = base_url."eleval/save&idvel=".$val[0]['idvel']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo Valor</h2>
		<?php $url_action = base_url."eleval/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">
			<div class="form-group col-md-6">
				<label for="nomvel">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="nomvel" name="nomvel" value="<?=isset($val) ? $val[0]['nomvel'] : ''; ?>" required />

			</div>
			<div class="form-group col-md-6">
				<label for="iddel">Dominio Electoral</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="iddel" name="iddel">
				<?php 
				if($elevals){

					foreach ($domfins as $do){ ?>
		            
		                <option value="<?=$do['iddel'];?>" <?=isset($val) && $do['iddel']==$val[0]['iddel'] ? ' selected ' : ''; ?> ><?=$do['iddel'];?> - <?=$do['nomdel'];?></option>
		            
		        <?php }} ?>
		        </select>

			</div>
			<div class="form-group col-md-6">
				<label for="prevel">Posición</label>
				<input type="text" class="form-control form-control-sm" id="prevel" name="prevel" value="<?=isset($val) ? $val[0]['prevel'] : ''; ?>"/>
			</div>
			<div class="form-group col-md-6">
				<label for="fijvel">Cantidad</label>
				<input type="text" class="form-control form-control-sm" id="fijvel" name="fijvel" value="<?=isset($val) ? $val[0]['fijvel'] : ''; ?>"/>
			</div>

			<div class="form-group col-md-6">
				<input type="hidden" name="idvel" value="<?=isset($val) ? $val[0]['idvel'] : ''; ?>" />
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>

<br>
<!-- Ver datos -->

<h2 class="title-c">Valores Electorales</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
					<th>Valor</th>								
					<th>Dominio</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($elevals)){
	        		foreach ($elevals as $va){ ?>
		            <tr>
		                <td>
		                	<?=$va['idvel'];?> - <?=$va['nomvel'];?>
		                	<?php if($va['prevel'] OR $va['fijvel']){ ?>
			                	<br><small>
			                		<strong>Posición: </strong><?=$va['prevel'];?> - <strong>Cantidad: </strong><?=$va['fijvel'];?>
			                	</small>
			                <?php } ?>	
		                </td>				                
		                <td><?=$va['nomdel'];?></td>
		                <td>
		                	<a href="<?=base_url?>eleval/edit&idvel=<?=$va['idvel'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Valor</th>								
					<th>Dominio</th>
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