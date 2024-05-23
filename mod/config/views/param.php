<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Parametros","fa fa-address-card ico3","param/index","230px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($dom);

	if(isset($edit) && isset($dom)): ?>
		<h2 class="title-c m-tb-40">Editar Parametro <!-- <?=$dom[0]['parnom']?> --></h2>
		<?php $url_action = base_url."param/save&parid=".$dom[0]['parid']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo Parametro F.</h2>
		<?php $url_action = base_url."param/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">
			<!-- <div class="form-group col-md-6"> -->
				<!-- <label for="parid">Cod. Parametro</label> -->
				<input type="hidden" class="form-control form-control-sm" id="parid" name="parid" value="<?=isset($dom) ? $dom[0]['parid'] : ''; ?>"/>
			<!-- </div> -->
			<div class="form-group col-md-6">
				<label for="parnom">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="parnom" name="parnom" value="<?=isset($dom) ? $dom[0]['parnom'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="parfijo">Valor Fijo</label>
				<input type="text" class="form-control form-control-sm" id="parfijo" name="parfijo" value="<?=isset($dom) ? $dom[0]['parfijo'] : ''; ?>"/>
			</div>
		
			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>

<br>
<!-- Ver datos -->

<h2 class="title-c">Parametros</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Código</th>
					<th>Parametro</th>								
					<th>Valor Fijo</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($params)){
	        		foreach ($params as $do){ ?>
		            <tr>
		                <td><?=$do['parid'];?></td>
		                <td><?=$do['parnom'];?></td>				                
		                <td><?=$do['parfijo'];?></td>
		                <td>
		                	<a href="<?=base_url?>param/edit&parid=<?=$do['parid'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Código</th>
					<th>Parametro</th>								
					<th>Valor Fijo</th>
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