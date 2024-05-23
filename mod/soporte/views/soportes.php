<div id="inser">

		<h2 class="title-c m-tb-40">Crear Nuevo soporte</h2>
		<?php $url_action = base_url."soporte/save"; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<div class="row">
				<input type="hidden" name="idst" value=""/>
			<div class="form-group col-md-6">
				<label for="nomsst">Nombre del Solicitante</label>
				<input type="text" class="form-control form-control-sm" id="nomsst" name="nomsst" value="" required />
			</div>
			<div class="form-group col-md-6">
				<label for="cat">Categoría</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="cat" name="cat">
				<?php 
				if($cate){
					foreach ($cate as $cat){ ?>
		                <option value="<?=$cat['valid'];?>">
		                	<?=$cat['valnom'];?>
		                </option>
		            
		        <?php }} ?>
		        </select>
			</div>
			<div class="form-group col-md-6">
				<label for="area">Área</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="area" name="area" >
				<?php 
				if($tipo){
					foreach ($tipo as $do){ ?>
		                <option value="<?=$do['valid'];?>">
		                	<?=$do['valnom'];?>
		                </option>
		        <?php }} ?>
		        </select>
			</div>
			<div class="form-group col-md-6">
				<label for="desst">Descripción de la soporte</label>
				<textarea class="form-control form-control-sm" id="desst" name="desst" required ></textarea>
			</div>
			
			<div class="form-group col-md-6" id="go1">
				<label for="telst">Número de Contacto</label>
				<input type="number" class="form-control form-control-sm" id="telst" name="telst" value="" required />
			</div>

			<div class="form-group col-md-6">
				<label for="rutst">Archivo adjunto (Opcional)</label>
				<input type="file" class="form-control form-control-sm" id="rutst" name="arch" accept="image/*, video/*, .doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf,.xls,.xlsx,.ppt,.pptx,.zip,.rar" style="height: 50px;"/>
				<small><small><span style="color: #ff0000;font-weight: bold;">* Si son varios archivos, suba un solo archivo comprimido.</span></small></small>
			</div>
			

			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>