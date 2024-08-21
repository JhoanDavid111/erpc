<!-- Insertar o Editar datos -->
<?php 
echo Utils::tit("Resoluciones FUTIC","fa fa-address-card ico3","futic/index","300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Editar Resoluciones F. <!-- <?=$val[0]['vafnom']?> --></h2>
		<?php $url_action = base_url."futic/save&vafid=".$val[0]['vafid']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nueva Resoluciones F.</h2>
		<?php $url_action = base_url."futic/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">
			<div class="form-group col-md-6">
				<label for="vafid">Cod.</label>
				<input type="number" class="form-control form-control-sm" id="vafid" name="vafid" value="<?=isset($val) ? $val[0]['vafid']:$Newid; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="vafnom">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="vafnom" name="vafnom" value="<?=isset($val) ? $val[0]['vafnom'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>

<br>
<!-- Ver datos -->

<h2 class="title-c">Resoluciones FUTIC</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Cód.</th>
					<th>Nombre</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($futics)){
	        		foreach ($futics as $va){ ?>
		            <tr>
		                <td><?=$va['vafid'];?></td>
		                <td><?=$va['vafnom'];?></td>				                
		                <td style="text-align: center;">
		                	<?php if($va['vaffijo']==1){ ?>
		                		<a href="<?=base_url?>futic/updAct&vafid=<?=$va['vafid'];?>&vaffijo=2" title="Click para Desactivar">
				                	<i class="fa fa-check-circle" style="color: #4d3274;"></i>
				                </a>
				            <?php }else{ ?>
				            	<a href="<?=base_url?>futic/updAct&vafid=<?=$va['vafid'];?>&vaffijo=1" title="Click para Activar">
				                	<i class="fa fa-times-circle" style="color: #ff0000;"></i>
				                </a>
				            <?php } ?>
				            &nbsp;&nbsp;&nbsp;
		                	<a href="<?=base_url?>futic/edit&vafid=<?=$va['vafid'];?>">
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