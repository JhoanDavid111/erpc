<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="js/filestyle.min.js"> </script>

<h2 class="title-c">Subir Archivo</h2>
<br><br><br>


<form class="forms-sample" action="<?=base_url;?>crgmtz/subirArchpaa" name="importa" method="post" enctype="multipart/form-data">  
	<div class="row">
		<div class="form-group col-md-6">
      <label>Cargar Documento</label>
      <input type="file" class="filestyle" data-buttonText="Seleccione archivo" name="arcexc" accept=".xls,.xlsx">
    </div>
    <div class="form-group col-md-6">
			<button type="submit" name="enviar" class="btn-secondary-canalc">IMPORTAR</button>

			<input type="hidden" value="upload" name="action" />
			<input type="hidden" value="usuarios" name="mod">
			<input type="hidden" value="masiva" name="acc">
		</div>
	</div>
</form>

<div style="width: 100%;text-align: center;">
	<img src="../img/FormatoCI1.jpg" style="width: 100%">
	<a href="<?=base_url;?>plantillaCI.xlsx" target="_blank">
		<button type="button" name="enviar" class="btn-primary-ccapital">Descargar Plantilla</button>
	</a>
</div>

<script src="../js/jquery.min.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
