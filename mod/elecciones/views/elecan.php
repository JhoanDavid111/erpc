<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Candidato","fa fa-address-card ico3","elecan/index","300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Editar Valor<!-- <?=$val[0]['corp']?> --></h2>
		<?php $url_action = base_url."elecan/save&idcan=".$val[0]['idcan']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo Candidato</h2>
		<?php $url_action = base_url."elecan/save"; ?>
	<?php endif; ?>
	<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="form-group col-md-6">
				<label for="corp">Corporación</label>
				<select id="corp" name="corp" class="form-control form-control-sm" style="padding: 0px;" >	
					<?php foreach ($corporacion as $va){ ?>						
						<option value="<?=$va['iddat'];?>" <?=isset($val) && $va['iddat'] == $val[0]['corp'] ? ' selected ' : ''; ?> >
							<?=$va['nomdat'];?>								
						</option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="circ">Circunscripción</label>
				<select id="circ" name="circ" class="form-control form-control-sm" style="padding: 0px;" >	
					<?php foreach ($circuns as $va){ ?>						
						<option value="<?=$va['iddat'];?>" <?=isset($val) && $va['iddat'] == $val[0]['circ'] ? ' selected ' : ''; ?>>
							<?=$va['nomdat'];?>								
						</option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="elecdep">Código del Departamento</label>
				<input type="number" max="99" class="form-control form-control-sm" id="elecdep" name="elecdep" value="<?=isset($val) ? $val[0]['elecdep'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="elecmun">Código Municipio</label>
				<input type="number" max="999" class="form-control form-control-sm" id="elecmun" name="elecmun" value="<?=isset($val) ? $val[0]['elecmun'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="eleccom">Código Comuna</label>
				<input type="number" max="99" class="form-control form-control-sm" id="eleccom" name="eleccom" value="<?=isset($val) ? $val[0]['eleccom'] : ''; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="elecp">Código del Partido</label>
				<select id="elecp" name="elecp" class="form-control form-control-sm" style="padding: 0px;" >	
					<?php foreach ($elepars as $va){ ?>						
						<option value="<?=$va['elecp'];?>" <?=isset($val) && $va['elecp'] == $val[0]['elecp'] ? ' selected ' : ''; ?>>
							<?=$va['elenp'];?>								
						</option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="eleccan">Código del Candidato</label>
				<input type="number" max="999" class="form-control form-control-sm" id="eleccan" name="eleccan" value="<?=isset($val) ? $val[0]['eleccan'] : ''; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="ptip">Preferente Tipo</label>
				<input type="number" max="9" class="form-control form-control-sm" id="ptip" name="ptip" value="<?=isset($val) ? $val[0]['ptip'] : ''; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="ncan">Nombre</label>
				<input type="text" maxlength="100" class="form-control form-control-sm" id="ncan" name="ncan" value="<?=isset($val) ? $val[0]['ncan'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="acan">Apellido</label>
				<input type="text" maxlength="100" class="form-control form-control-sm" id="acan" name="acan" value="<?=isset($val) ? $val[0]['acan'] : ''; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="ccan">Cédula</label>
				<input type="text" maxlength="15" class="form-control form-control-sm" id="ccan" name="ccan" value="<?=isset($val) ? $val[0]['ccan'] : ''; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="gcan">Género</label>
				<input type="text" maxlength="1" class="form-control form-control-sm" id="gcan" name="gcan" value="<?=isset($val) ? $val[0]['gcan'] : ''; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="scan">Sorteo</label>
				<input type="number" max="99" class="form-control form-control-sm" id="scan" name="scan" value="<?=isset($val) ? $val[0]['scan'] : ''; ?>" />
			</div>

			<div class="form-group col-md-6">
						
			</div>

			<div class="form-group col-md-6">
				<label for="foto">Foto</label>
				<input type="file"  value="" accept="image/png" name="imagen" id="imagen" multiple=""/>				
			</div>

			<?php if(isset($edit)): ?>

				<div class="form-group col-md-6">
					<img src="../img/<?=$val[0]['ccan'];?>.png" alt="No disponible" style="width: 120px; height: 120px;">			
				</div>

			<?php endif; ?>

			<div class="form-group col-md-6">
				<input type="hidden" name="idcan" value="<?=isset($val) ? $val[0]['idcan'] : ''; ?>" />
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

			

		</div>
	</form>
</div>

<br>


<?php $url_action = base_url."elecan/index"; ?>
<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class="form-group col-md-4">
			<label for="selmun">Municipio y/o Departamento</label>
			<select id="selmun" name="selmun" class="form-control form-control-sm" style="padding: 0px;" >	
				<?php foreach ($getmuns as $va){ ?>						
					<option value="<?=$va['elecdep'];?>:<?=$va['elecmun'];?>" >
						<?=$va['elenmun'];?>								
					</option>
				<?php } ?>
			</select>
		</div>

		<div class="form-group col-md-4">
			<label for="corp2">Corporación</label>
			<select id="corp2" name="corp2" class="form-control form-control-sm" style="padding: 0px;" >	
				<?php foreach ($corporacion as $va){ ?>						
					<option value="<?=$va['iddat'];?>" <?=isset($val) && $va['iddat'] == $val[0]['corp'] ? ' selected ' : ''; ?> >
						<?=$va['nomdat'];?>								
					</option>
				<?php } ?>
			</select>
		</div>

		<div class="form-group col-md-4">		
			<input type="submit" class="btn-primary-ccapital" value="Listar">
		</div>
		
	</div>
	
	
</form>


<?php if (isset($showcan)): ?>

	<!-- Ver datos -->

<h2 class="title-c">Candidato</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
					<th>Código</th>								
					<th>Candidato</th>
					<th>Partido</th>
					<th>Corporación</th>
					<th>Act</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($elecans)){
	        		foreach ($elecans as $va){ ?>
		            <tr>
		                <td>

		                	<?php 

			                	//$imagenDeseada = base_url.'img/'.$va['ccan'].'.png';
			                	$imagenDeseada = './img/'.$va['ccan'].'.png';

								// Ruta de la imagen por defecto
								$imagenPorDefecto = '../img/user-profile.png';

								// // Verificar si la imagen deseada existe
								if (file_exists($imagenDeseada)) {
								    $imagenAMostrar = '../img/'.$va['ccan'].'.png';
								} else {
								    $imagenAMostrar = $imagenPorDefecto;
								}


								// $filename = $imagenDeseada;
								// $filename = filter_var($filename, FILTER_VALIDATE_URL);
								 
								// $handle = curl_init($filename);
								 
								// curl_setopt_array($handle, array(
								// 	CURLOPT_FOLLOWLOCATION => TRUE,
								// 	CURLOPT_NOBODY         => TRUE,
								// 	CURLOPT_HEADER         => FALSE,
								// 	CURLOPT_RETURNTRANSFER => FALSE,
								// 	CURLOPT_SSL_VERIFYHOST => FALSE,
								// 	CURLOPT_SSL_VERIFYPEER => FALSE
								// ));
								 
								// $response = curl_exec($handle);
								// $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
								// curl_close($handle);
								 
								// if($httpCode == 200){
								// 	$imagenAMostrar = $imagenDeseada;
								// }else{
								// 	$imagenAMostrar = $imagenPorDefecto;
								// }

		                	?>

		                	
		                	<img src="<?=$imagenAMostrar; ?>" alt="" style="width: 50px;height: 50px;">
		                	<big><strong><?=$va['eleccan'];?></strong></big>
		                </td>				                
		                <td>
		                	<?=$va['ncan'];?> <?=$va['acan'];?><br>
		                	<small>
		                	<?php if(trim($va['ccan'])){ ?>
		                		<strong>Cédula:</strong> <?=$va['ccan'];?>
		                	<?php } ?>
		                	<?php if(trim($va['gcan'])){ ?>
		                		<strong>Género:</strong> <?=$va['gcan'];?>
		                	<?php } ?>
		                	<?php if(trim($va['scan'])){ ?>
		                		<strong>Sorteo:</strong> <?=$va['scan'];?>
		                	<?php } ?>
		                	</small>
		                </td>
		                <td>
		                	<?=$va['elecp'];?> <?=$va['elenp'];?><br>
		                </td>
		                <td>
		                	<?=$va['corp'];?> - <?=$va['nco'];?><br>
		                	<small>
		                	<?php if($va['circ']){ ?>
		                		<strong>Circunscripción:</strong> <?=$va['circ'];?> - <?=$va['nci'];?><br>
		                	<?php } ?>
		                	<?php if($va['elecdep']){
		                		$dtdp = $elecan->getDepto($va['elecdep']); ?>
			                	<strong>Departamento:</strong> <?=$va['elecdep']." ".$dtdp[0]['nom'];?><br>
			                <?php } ?>
			                <?php if($va['elecmun']){ 
			                	$dtdp = $elecan->getMunic2($va['elecmun'],$va['elecdep']); ?>
			                	<strong>Municipio:</strong> <?=$va['elecmun']." ".$dtdp[0]['nom'];?><br>
			                <?php } ?>
			                <?php if($va['eleccom']){ 
			                	$dtdp = $elecan->getComun($va['eleccom']); ?>
			                	<strong>Comuna:</strong> <?=$va['eleccom']." ".$dtdp[0]['nom'];?>
			                <?php } ?>
		                	</small>
		                </td>
		                <td>
		                	<!-- <?//=$va['ptip'];?><br> -->
		                	<span style="opacity: 0"><?=$va['act'];?></span>
		                	<?php if($va['act']==1){ ?>
		                		<a href="<?=base_url?>elecan/act&idcan=<?=$va['idcan'];?>&act=2">
				                	<i class="fas fa-check-circle" style="color: #523178;">
				                		<span style="color: rgba(255,255,255,0);">+</span>
				                	</i>
				                </a>
			                <?php }else{ ?>
			                	<a href="<?=base_url?>elecan/act&idcan=<?=$va['idcan'];?>&act=1">
									<i class="fas fa-times-circle" style="color: #f00;">
										<span style="color: rgba(255,255,255,0);">-</span>
									</i>
								</a>
							<?php } ?>
		                </td>
		                <td>
		                	<a href="<?=base_url?>elecan/edit&idcan=<?=$va['idcan'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Código</th>								
					<th>Candidato</th>
					<th>Partido</th>
					<th>Corporación</th>
					<th>Prf.</th>
					<th></th>
	            </tr>
	        </tfoot>
	    </table>
		
	</div>

	<br>
<?php endif ?>


<?php if(isset($edit) && isset($val)): ?>
	<script>ocultar(1,300);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>