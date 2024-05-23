<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Partidos","fa fa-address-card ico3","elepar/index","230px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($dom);

	if(isset($edit) && isset($dom)): ?>
		<h2 class="title-c m-tb-40">Editar Partido <!-- <?=$dom[0]['elenp']?> --></h2>
		<?php $url_action = base_url."elepar/save&elecp=".$dom[0]['elecp']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo Partido</h2>
		<?php $url_action = base_url."elepar/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">
			<div class="form-group col-md-6">
				<label for="elecp">Cod. Partido</label>
				<input type="number" class="form-control form-control-sm" id="elecp" name="elecp" value="<?=isset($dom) ? $dom[0]['elecp'] : ''; ?>" required <?=isset($dom) ? ' readonly ' : ''; ?>/>
			</div>
			<div class="form-group col-md-6">
				<label for="elenp">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="elenp" name="elenp" value="<?=isset($dom) ? $dom[0]['elenp'] : ''; ?>" required />

			</div>
		
			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>

<br>
<!-- Ver datos -->

<h2 class="title-c">Partidos Electorales</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
					<th>Partido</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($elepars)){
	        		foreach ($elepars as $do){ ?>
		            <tr>
		                <td>
		                	<?=$do['elecp'];?> - <?=$do['elenp'];?>
		                </td>
		                <td>
		                	<a href="<?=base_url?>elepar/edit&elecp=<?=$do['elecp'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
					<th>Partido</th>
					<th></th>
	            </tr>
	        </tfoot>
	    </table>
		
	</div>

	<br>

<?php if(isset($edit) && isset($dom)): ?>
	<script>ocultar(1,230);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>