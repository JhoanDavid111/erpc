<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div id="inser">

		<h2 class="title-c m-tb-40">Crear Nueva denuncia</h2>
		<?php $url_action = base_url."denuncia/save"; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<div class="row">
				<input type="hidden" name="denid" value=""/>
			<div class="form-group col-md-6">
				<label for="denano">¿Denuncia Anónima?</label>
				<input type="radio" id="denano" name="denano" onclick="anonima(1);" value="1" /> Si
				<input type="radio" name="denano" onclick="anonima(2);" value="2" checked /> No
			</div>
			<div class="form-group col-md-6">
				<label for="denpro">Proteger datos del denunciante</label>
				<input type="checkbox" id="denpro" name="denpro" value="1" checked required />
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="dennom">Nombres</label>
				<input type="text" class="form-control form-control-sm" id="dennom" name="dennom" value=""/>
			</div>
			<div class="form-group col-md-6" id="go2">
				<label for="denape">Apellidos</label>
				<input type="text" class="form-control form-control-sm" id="denape" name="denape" value=""/>
			</div>
			<div class="form-group col-md-6" id="go3">
				<label for="denide">No. Identificación</label>
				<input type="number" class="form-control form-control-sm" id="denide" name="denide" value=""/>
			</div>
			<div class="form-group col-md-6" id="go4">
				<label for="dentel">No. Teléfono</label>
				<input type="number" class="form-control form-control-sm" id="dentel" name="dentel" value=""/>
			</div>
			<div class="form-group col-md-6" id="go4">
				<label for="denema">Email</label>
				<input type="email" class="form-control form-control-sm" id="denema" name="denema" value="" required />
			</div>
			<div class="form-group col-md-6">
				<label for="dentip">Tipo de Denuncia</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="dentip" name="dentip">
					<option value="0">Seleccione tipo de denuncia
		                </option>
				<?php 
				if($tipo){

					foreach ($tipo as $do){ ?>
		                <option value="<?=$do['valid'];?>" <?=$do['valid']==111 ? ' id="bals" ' : ''; ?> >
		                	<?=$do['valnom'];?>
		                </option>
		            
		        <?php }} ?>
		        </select>
		        <small><small><span style="color: #ff0000;font-weight: bold;">* Tenga en cuenta que si desa hacer una denuncia de acoso laboral, esta no puede ser anónima.</span></small></small>
			</div>
			<div class="form-group col-md-6">
				<label for="dendes">Descripción de la denuncia</label>
				<textarea class="form-control form-control-sm" id="dendes" name="dendes" required ></textarea>
			</div>
			<div class="form-group col-md-6">
				<label for="denarc">Archivo evidencias en *.zip</label>
				<input type="file" class="form-control form-control-sm" id="denarc" name="arch" accept="image/*, video/*, .doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf,.xls,.xlsx,.ppt,.pptx,.zip,.rar" style="height: 50px;"/>
				<small><small><span style="color: #ff0000;font-weight: bold;">* Si son varios archivos, suba un solo archivo comprimido.</span></small></small>
			</div>
<!-- Espacio Recaptcha Inicio -->
			<div class="form-group col-md-6">
                <div class="g-recaptcha" data-sitekey="6Lc6LCEfAAAAAO9Cf9DaqJsDKkaH_eN4eALomycB"> </div>	
			</div>
<!-- Espacio Recaptcha Fin -->

			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>