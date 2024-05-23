<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Ubicación","fa fa-address-card ico3","ubica/index","300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Editar Ubicación <!-- <?=$val[0]['ubinom']?> --></h2>
		<?php $url_action = base_url."ubica/save&ubiid=".$val[0]['ubiid']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo Ubicación</h2>
		<?php $url_action = base_url."ubica/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">
			<div class="form-group col-md-6">
				<label for="ubiid">Cod.</label>
				<input type="number" class="form-control form-control-sm" id="ubiid" name="ubiid" value="<?=isset($val) ? $val[0]['ubiid'] : ''; ?>"/>
			</div>
			<div class="form-group col-md-6">
				<label for="ubinom">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="ubinom" name="ubinom" value="<?=isset($val) ? $val[0]['ubinom'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="ubidepto">Depende</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="ubidepto" name="ubidepto">
					<option value="0" <?=isset($val) && 0==$val[0]['ubidepto'] ? ' selected ' : ''; ?> >Departamento - Sin  Dependencia</option>
				<?php 
				if($deptos){
					foreach ($deptos as $do){ ?>
		            
		                <option value="<?=$do['ubiid'];?>" <?=isset($val) && $do['ubiid']==$val[0]['ubidepto'] ? ' selected ' : ''; ?> ><?=$do['ubiid'];?> - <?=$do['ubinom'];?></option>
		            
		        <?php }} ?>
		        </select>

			</div>
			<!-- <div class="form-group col-md-6">
				<label for="ubiestado">Activo</label>
				<input type="text" class="form-control form-control-sm" id="ubiestado" name="ubiestado" value="<?=isset($val) ? $val[0]['ubiestado'] : ''; ?>"/>
			</div> -->

			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>

<br>
<!-- Ver datos -->

<h2 class="title-c">Ubicaciones</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Cód.</th>
					<th>Municipio</th>								
					<!-- <th>Descripción</th> -->
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($ubicas)){
	        		foreach ($ubicas as $va){ ?>
		            <tr>
		                <td><?=$va['ubiid'];?></td>
		                <td>
		                	<?=$va['mun'];?>
		                	<br>
		                	<small><small>
			                	<strong>Departamento: </strong>
			                	<?=$va['dept'];?>
			                </small></small>
		                </td>				                
		                <td>
		                	<a href="<?=base_url?>ubica/edit&ubiid=<?=$va['ubiid'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Cód.</th>
					<th>Municipio</th>								
					<!-- <th>Descripción</th> -->
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