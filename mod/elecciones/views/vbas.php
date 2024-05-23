<h2 class="title-c">Archivos Básicos&nbsp;&nbsp;&nbsp;&nbsp;</h2>

<div id="inser">
	<form class="m-tb-40" action="<?=base_url;?>bas/inser" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="form-group col-md-6">
				<label for="tipo">Tipo de Archivo</label>
				<select id="tipo" name="tipo" class="form-control form-control-sm" style="padding: 0px;">
					<option value="0">Seleccione tipo a cargar</option>
					<?php foreach ($dom as $pf){ ?>
						<option value="<?=$pf['iddel'];?>">
							<?=$pf['nomdel'];?>
						</option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="arcexc">Cargar Archivo de Texto (*.txt)</label>
				<input type="file" class="form-control form-control-sm" id="arcexc" name="arcexc" accept=".txt" style="height: 50px;" required />
				<small><small><span style="color: #ff0000;font-weight: bold;">* Solo cargue un archivo con extensión *.txt, con el listado de cualquiera de los tipos básicos cargados.</span></small></small>
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