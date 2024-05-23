<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Dominios","fa fa-address-card ico3","eledom/index","230px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($dom);

	if(isset($edit) && isset($dom)): ?>
		<h2 class="title-c m-tb-40">Editar Dominio <!-- <?=$dom[0]['nomdel']?> --></h2>
		<?php $url_action = base_url."eledom/save&iddel=".$dom[0]['iddel']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo Dominio</h2>
		<?php $url_action = base_url."eledom/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">
			<!-- <div class="form-group col-md-6"> -->
				<!-- <label for="iddel">Cod. Dominio</label> -->
				<input type="hidden" class="form-control form-control-sm" id="iddel" name="iddel" value="<?=isset($dom) ? $dom[0]['iddel'] : ''; ?>"/>
			<!-- </div> -->
			<div class="form-group col-md-6">
				<label for="nomdel">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="nomdel" name="nomdel" value="<?=isset($dom) ? $dom[0]['nomdel'] : ''; ?>" required />

			</div>
		
			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>

<br>
<!-- Ver datos -->

<h2 class="title-c">Dominios Electorales</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
					<th>Dominio</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($eledoms)){
	        		foreach ($eledoms as $do){ ?>
		            <tr>
		                <td>
		                	<?=$do['iddel'];?> - <?=$do['nomdel'];?>
		                </td>
		                <td>
		                	<a href="<?=base_url?>eledom/edit&iddel=<?=$do['iddel'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
					<th>Dominio</th>
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