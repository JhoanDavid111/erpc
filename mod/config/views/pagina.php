<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Página","fa fa-address-card ico3","pagina/index","300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Editar Página <!-- <?=$val[0]['pagnom']?> --></h2>
		<?php $url_action = base_url."pagina/save&pagid=".$val[0]['pagid']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo Página</h2>
		<?php $url_action = base_url."pagina/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">
			<div class="form-group col-md-6">
				<label for="pagid">Id.</label>
				<input type="number" class="form-control form-control-sm" id="pagid" name="pagid" value="<?=isset($val) ? $val[0]['pagid'] : ''; ?>"/>
			</div>
			<div class="form-group col-md-6">
				<label for="pagnom">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="pagnom" name="pagnom" value="<?=isset($val) ? $val[0]['pagnom'] : ''; ?>"/>
			</div>
			<div class="form-group col-md-6">
				<label for="pagarc">Ruta Archivo</label>
				<input type="text" class="form-control form-control-sm" id="pagarc" name="pagarc" value="<?=isset($val) ? $val[0]['pagarc'] : ''; ?>"/>
			</div>

			<div class="form-group col-md-6">
				<label for="pagmos">Mostrar en menú</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="pagmos" name="pagmos">
		            <option value="1" <?=isset($val) && $val[0]['pagmos']==1 ? ' selected ' : ''; ?> >Si</option>
		            <option value="2" <?=isset($val) && $val[0]['pagmos']==2 ? ' selected ' : ''; ?> >No</option>
		        </select>
			</div>

			<div class="form-group col-md-6">
				<label for="pagord">Orden</label>
				<input type="number" class="form-control form-control-sm" id="pagord" name="pagord" value="<?=isset($val) ? $val[0]['pagord'] : ''; ?>"/>
			</div>

			<div class="form-group col-md-6">
				<label for="icono">Icono</label>
				<input type="text" class="form-control form-control-sm" id="icono" name="icono" value="<?=isset($val) ? $val[0]['icono'] : ''; ?>"/>
			</div>

			<div class="form-group col-md-6">
				<label for="idmod">Módulo</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="idmod" name="idmod">
				<?php 
				if($modulos){

					foreach ($modulos  as $do){ ?>
		            
		                <option value="<?=$do['idmod'];?>" <?=isset($val) && $do['idmod']==$val[0]['idmod'] ? ' selected ' : ''; ?> ><?=$do['idmod'];?> - <?=$do['nommod'];?></option>
		            
		        <?php }} ?>
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

<h2 class="title-c">Páginas</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Ico.</th>
					<th>Nombre</th>
					<th></th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($paginas)){
	        		foreach ($paginas as $va){ ?>
		            <tr>
		                <td>
		                	<i class="<?=$va['icono'];?>"></i>
		                </td>
		                <td>
		                	<strong>
								<?=$va['pagid'];?> - <?=$va['pagnom'];?>
							</strong>
							<br>
								<?=$va['pagarc'];?><br>
								<small><small>
<!-- 									<strong>Menú:</strong> <?=$va['pagmen'];?> -->
									<br><strong>Icono:</strong> <?=$va['icono'];?>
									<br><strong>Módulo:</strong> <?=$va['nommod'];?>
								</small></small>
		                </td>				                
		                <td><span style="opacity: 0"><?=$va['pagmos'];?></span>
		                	<?php if($va['pagmos']==1){ ?>
		                		<a href="<?=base_url?>pagina/act&pagid=<?=$va['pagid'];?>&pagmos=2">
				                	<i class="fas fa-check-circle" style="color: #523178;">
				                		<span style="color: rgba(255,255,255,0);">+</span>
				                	</i>
				                </a>
			                <?php }else{ ?>
			                	<a href="<?=base_url?>pagina/act&pagid=<?=$va['pagid'];?>&pagmos=1">
									<i class="fas fa-times-circle" style="color: #f00;">
										<span style="color: rgba(255,255,255,0);">-</span>
									</i>
								</a>
							<?php } ?>
		                </td>
		                <td>
		                	<a href="<?=base_url?>pagina/edit&pagid=<?=$va['pagid'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Ico.</th>
					<th>Nombre</th>
					<th></th>
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