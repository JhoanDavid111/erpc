<h2 class="title-c">Carga Masiva de Documentos&nbsp;&nbsp;&nbsp;&nbsp;</h2>

<div id="inser">
	<form class="m-tb-40" action="<?=base_url;?>masi/inser" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="form-group col-md-6">
				<label for="arcexc">Cargar Archivo Excel</label>
				<input type="file" class="form-control form-control-sm" id="arcexc" name="arcexc" accept=".xls,.xlsx" style="height: 50px;" required />
				<small><small><span style="color: #ff0000;font-weight: bold;">* Solo cargue un archivo con extensión *.xls ó *.xlsx, con el listado de CDP's o RP's a cargar.</span></small></small>
			</div>
			<div class="form-group col-md-6">
				<label for="arczip">Cargar Archivo Comprimido en Zip</label>
				<input type="file" class="form-control form-control-sm" id="arczip" name="arczip" accept=".zip,.rar" style="height: 50px;" required />
				<small><small><span style="color: #ff0000;font-weight: bold;">* Solo cargue un archivo con extensión *.zip, este debe contener todos los CDP's o RP's relacionados en el excel para ser cargados.</span></small></small>
			</div>
		
			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>


<?php
	if($html){
?>
		<h2 class="title-c">Resultados de la carga&nbsp;&nbsp;&nbsp;&nbsp;</h2>
		<br><br>
		<?=$html;?>
<?php
	}
?>
<!-- <i class="fa fa-download"></i> -->