<!-- Insertar o Editar datos -->

<?php //echo Utils::tit("persona F.","fa fa-address-card ico3","persona/index","300px"); ?>
<div id="inser">

	<?php if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Editar persona F. <!-- <?=$val[0]['nodocemp']?> --></h2>
		<?php $url_action = base_url."persona/editPUser&perid=".$val[0]['perid']; 
	?>
		
	<?php else: ?>
		<!-- <h2 class="title-c m-tb-40">Crear Nuevo persona F.</h2> -->
		<?php //$url_action = base_url."persona/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>"	 method="POST">
		<div class="row">

			<?php if(isset($val) && $perid){ ?>
				<!-- <div class="form-group col-md-6"> -->
					<!-- <label for="perid">Id.</label> -->
					<input type="hidden" class="form-control form-control-sm" id="perid" name="perid" value="<?=isset($val) ? $val[0]['perid'] : ''; ?>"/>
				<!-- </div> -->
			<?php } ?>
			<div class="form-group col-md-6">
				<label for="pernom">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="pernom" name="pernom" value="<?=isset($val) ? $val[0]['pernom'] : ''; ?>" required />

			</div>
			<div class="form-group col-md-6">
				<label for="perape">Apellido</label>
				<input type="text" class="form-control form-control-sm" id="perape" name="perape" value="<?=isset($val) ? $val[0]['perape'] : ''; ?>" required />

			</div>
			<div class="form-group col-md-6">
				<label for="peremail">Email</label>
				<input type="email" class="form-control form-control-sm" id="peremail" name="peremail" value="<?=isset($val) ? $val[0]['peremail'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="perpass">Contraseña</label>
				<input type="password" class="form-control form-control-sm" id="perpass" name="perpass" />
			</div>
			<!-- <div class="form-group col-md-6">
				<label for="ubiid">Ciudad</label> -->
				<input type="hidden" class="form-control form-control-sm" id="ubiid" name="ubiid" value="11001" />
			<!-- </div> -->
			<div class="form-group col-md-6">
				<label for="perdir">Dirección</label>
				<input type="text" class="form-control form-control-sm" id="perdir" name="perdir" value="<?=isset($val) ? $val[0]['perdir'] : ''; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="pertel">No. Teléfono</label>
				<input type="number" class="form-control form-control-sm" id="pertel" name="pertel" value="<?=isset($val) ? $val[0]['pertel'] : ''; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="percel">No. Celular</label>
				<input type="number" class="form-control form-control-sm" id="percel" name="percel" value="<?=isset($val) ? $val[0]['percel'] : ''; ?>" />
			</div>
			
			
			<!-- <div class="form-group col-md-6">
				<label for="envema">Enviar Email</label> -->
				<input type="hidden" class="form-control form-control-sm" id="envema" name="envema" value="1" />
			<!-- </div> -->
			

			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Actualizar">
			</div>

		</div>
	</form>
</div>