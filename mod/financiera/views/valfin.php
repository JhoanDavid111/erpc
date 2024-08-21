<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Valor F.","fa fa-address-card ico3","valfin/index","300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Editar Valor F. <!-- <?=$val[0]['vafnom']?> --></h2>
		<?php $url_action = base_url."valfin/save&vafid=".$val[0]['vafid']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo Valor F.</h2>
		<?php $url_action = base_url."valfin/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">
			<div class="form-group col-md-6">
				<label for="vafid">Cod.</label>
				<input type="number" class="form-control form-control-sm" id="vafid" name="vafid" value="<?=isset($val) ? $val[0]['vafid'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="vafnom">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="vafnom" name="vafnom" value="<?=isset($val) ? $val[0]['vafnom'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="dofid">Dominio Financiero</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="dofid" name="dofid">
				<?php 
				if($valfins){

					foreach ($domfins as $do){ ?>
		            
		                <option value="<?=$do['dofid'];?>" <?=isset($val) && $do['dofid']==$val[0]['dofid'] ? ' selected ' : ''; ?> ><?=$do['dofid'];?> - <?=$do['dofnom'];?></option>
		            
		        <?php }} ?>
		        </select>

			</div>
			<div class="form-group col-md-6">
				<label for="vaffijo">Valor Fijo</label>
				<input type="number" class="form-control form-control-sm" id="vaffijo" name="vaffijo" value="<?=isset($val) ? $val[0]['vaffijo']:'1'; ?>" min="0" max="10" />
			</div>
			<div class="form-group col-md-6">
				<label for="vafpre">Descripción</label>
				<input type="text" class="form-control form-control-sm" id="vafpre" name="vafpre" value="<?=isset($val) ? $val[0]['vafpre'] : ''; ?>"/>

			</div>
			
			<div class="form-group col-md-6">
				<label for="vafpf">Prefijo</label>
				<input type="text" class="form-control form-control-sm" id="vafpf" name="vafpf" value="<?=isset($val) ? $val[0]['vafpf'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>

<br>
<!-- Ver datos -->

<h2 class="title-c">Valores Financiero</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Cód.</th>
					<th>Nombre</th>								
					<th>Dominio</th>
					<!-- <th>Valor Fijo</th> -->
					<th>Descripción</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($valfins)){
	        		foreach ($valfins as $va){ ?>
		            <tr>
		                <td><?=$va['vafid'];?></td>
		                <td><?=$va['vafnom'];?><br><small><strong>Valor Fijo:</strong> <?=$va['vaffijo'];?></small></td>				                
		                <td><?=$va['dofnom'];?></td>
		                <!-- <td><?=$va['vaffijo'];?></td> -->
		                <td>
		                	<?=$va['vafpre'];?>
		                	<?php if($va['vafpf']){ ?>
			                	<br>
			                	<small>
				                	<strong>Prefijo: </strong>
				                	<?=$va['vafpf'];?>
				                </small>
				            <?php } ?>
		                </td>
		                <td>
		                	<a href="<?=base_url?>valfin/edit&vafid=<?=$va['vafid'];?>">
		                		<i class="fas fa-edit" style="color: #0071bc;"></i>
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
					<!-- <th>Valor Fijo</th> -->
					<th>Descripción</th>
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