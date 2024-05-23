<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php if($txtn){ ?>
	<div style="color: #ff0000;font-weight:bold;text-shadow: 1px 1px 1px #787676;">
		¡<?=$txtn;?>!<br><br>
	</div>
<?php }?>

<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Denuncia","fas fa-restroom  mr-3","denuncia/index","300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Ver denuncia</h2>
		<?php //$url_action = base_url."denuncia/save&denid=".$val[0]['denid']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nueva denuncia</h2>
		<?php $url_action = base_url."denuncia/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<div class="row">
				<input type="hidden" name="denid" value="<?=isset($val) ? $val[0]['denid'] : ''; ?>"/>
			<div class="form-group col-md-6">
				<label for="denano">¿Denuncia Anónima?</label>
				<input type="radio" id="denano" name="denano" onclick="anonima(1);" value="1" <?=isset($val) && isset($val[0]['denano'])==1 ? ' checked ' : ''; ?> <?=isset($val) ? ' disabled ' : ''; ?>
				/> Si
				<input type="radio" name="denano" onclick="anonima(2);" value="2" 
				<?php
					if(isset($val)){
						if($val[0]['denano']!=1)
							echo ' checked ';
						else
							echo '';
					}else{
						echo ' checked ';
					}
				?> <?=isset($val) ? ' disabled ' : ''; ?> /> No
			</div>
			<div class="form-group col-md-6">
				<label for="denpro">Proteger datos del denunciante</label>
				<input type="checkbox" id="denpro" name="denpro" value="1" <?=isset($val) && isset($val[0]['denpro'])==1 ? ' checked ' : ' checked '; ?> required <?=isset($val) ? ' disabled ' : ''; ?> />
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="dennom">Nombres</label>
				<input type="text" class="form-control form-control-sm" id="dennom" name="dennom" value="<?=isset($val) ? $val[0]['dennom'] : ''; ?>" <?=isset($val) ? ' disabled ' : ''; ?> />
			</div>
			<div class="form-group col-md-6" id="go2">
				<label for="denape">Apellidos</label>
				<input type="text" class="form-control form-control-sm" id="denape" name="denape" value="<?=isset($val) ? $val[0]['denape'] : ''; ?>" <?=isset($val) ? ' disabled ' : ''; ?> />
			</div>
			<div class="form-group col-md-6" id="go3">
				<label for="denide">No. Identificación</label>
				<input type="number" class="form-control form-control-sm" id="denide" name="denide" value="<?=isset($val) ? $val[0]['denide'] : ''; ?>" <?=isset($val) ? ' disabled ' : ''; ?> />
			</div>
			<div class="form-group col-md-6" id="go4">
				<label for="dentel">No. Teléfono</label>
				<input type="number" class="form-control form-control-sm" id="dentel" name="dentel" value="<?=isset($val) ? $val[0]['dentel'] : ''; ?>" <?=isset($val) ? ' disabled ' : ''; ?> />
			</div>
			<div class="form-group col-md-6">
				<label for="denema">Email</label>
				<input type="email" class="form-control form-control-sm" id="denema" name="denema" value="<?=isset($val) ? $val[0]['denema'] : ''; ?>" required  <?=isset($val) ? ' disabled ' : ''; ?> />
			</div>
			<div class="form-group col-md-6">
				<label for="dentip">Tipo de Denuncia</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="dentip" name="dentip" <?=isset($val) ? ' disabled ' : ''; ?> >
					<option value="0">Seleccione tipo de denuncia
		                </option>
				<?php 
				if($tipo){
					foreach ($tipo as $do){ ?>
		                <option value="<?=$do['valid'];?>" 
		                	<?=isset($val) && $do['valid']==$val[0]['dentip'] ? ' selected ' : ''; ?> <?=$do['valid']==111 ? ' id="bals" ' : ''; ?> ><?=$do['valnom'];?>
		                </option>
		            
		        <?php }} ?>
		        </select>
		        <small><small><span style="color: #ff0000;font-weight: bold;">* Tenga en cuenta que si desa hacer una denuncia de acoso laboral, esta no puede ser anónima.</span></small></small>
			</div>
			<div class="form-group col-md-6">
				<label for="dendes">Descripción de la denuncia</label>
				<textarea class="form-control form-control-sm" id="dendes" name="dendes" required <?=isset($val) ? ' disabled ' : ''; ?> ><?=isset($val) ? $val[0]['dendes'] : ''; ?></textarea>
			</div>
			<?php if(!isset($val)){ ?>
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
			<?php }elseif($val[0]['denarc']){ ?>
            	<div class="form-group col-md-6">
					<label for="denarc">Archivo evidencias</label><br>
					<a href="<?=path_filem?><?=$val[0]['denarc'];?>" target="_blank">
	            		<img src="<?=base_url_img?>adjun.png" id="denarc" width="50px" title="Descargue el archivo de evidencias">
	            	</a>
				</div>
	        <?php } ?>
		</div>
	</form>
</div>

<?php
	if(isset($val) && $val[0]['denano']==1) echo "<script>anonima(1);</script>";
?>

<!-- Ver datos -->

<h2 class="title-c">Denuncias</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Denunciante</th>
	                <th>Tipo</th>
	                <th>Fecha</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($denuncias)){
	        		foreach ($denuncias as $va){
	        			$denuncia->setDenid($va['denid']); 
	        			$datObs = $denuncias = $denuncia->getObs();
	        	?>
		            <tr>
		                <td>
		                	<strong>
	                            <?php if($va['denano']==1){ ?>
	                            	Anónimo
	                            <?php }else{
	                            	echo $va['dennom']." ".$va['denape'];
	                            }?>
	                            <?=' '.$va['denema'];?>
	                        </strong><br>
	                        <small>
	                        	<?php if($va['denano']!=1){ ?>
	                            	<strong>No. identificación: </strong><?=$va['denide'];?> 
		                            <strong>No. Teléfono: </strong><?=$va['dentel'];?>
		                            </br>
	                            <?php } ?>
	                            <!-- <strong>Tipo: </strong><?=$va['valnom'];?> -->

                            	<strong>Descripción: </strong>
                            	<?=$va['dendes'];?>
                            	</br>
                            	<?php if($va['denarc']){ ?>
	                            	<strong>Adjunto: </strong>
	                            	<a href="<?=path_filem?><?=$va['denarc'];?>" target="_blank">
	                            		<img src="<?=base_url_img?>adjun.png" width="30px">
	                            	</a>
                            	<?php } ?>
							</small>

							<br>
							<strong>Observaciones: </strong>
                        	<table width="100%">
                        		<?php if($datObs){ foreach ($datObs as $dOb){ ?>
                        			<tr>
                            			<td>
                            				<small><?=$dOb['denobs'];?></small>
                            			</td>
                            			<th style="text-align: center;">
                            				<?=$dOb['valnom'];?><br>
                            				<small><small>
                            					<?=$dOb['denfec'];?>
                            				</small></small>
                            			</th>
                            			<td style="text-align: center;">
                            				<a href="<?=base_url."denuncia/dlobs&idobs=".$dOb['idobs'];?>" onclick="return eliminar();">
                            					<i class="fa fa-times-circle" style="color: #ff0000" aria-hidden="true"></i>
                            				</a>
                            			</td>
                            		</tr>
                            	<?php }} ?>
                        	</table>
		                </td>
		                <td>
	                        <small>
	                            <?=$va['valnom'];?>
	                        </small>
		                </td>
		                <td>
	                        <small>
	                            <?=$va['denfec'];?>
	                        </small>
		                </td>
		                <td>
		                	<a href="<?=base_url?>denuncia/edit&denid=<?=$va['denid'];?>">
		                		<i class="far fa-eye fa-2x" style="color: #523178;"></i>
		                	</a>
							<?php if($_SESSION['pefid']!=58){ ?>
			                	<button class="btn btn-primary btn-sm btn2" style="background-color: #523178;margin: 2px;" data-toggle="modal" data-target="#myModObs<?=$va['denid'];?>" type="button" title="Agregar Avance"><i class="fa fa-plus"></i></button>

			                	<?php echo Utils::modalTextCmbNew("myModObs", "Añadir Observación", $va['denid'], "Comentario", base_url."denuncia/svobs", "denobs", "Estado", "denest", $est);
			                	?>
	            			<?php } ?>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Denuncia</th>
	                <th>Tipo</th>
	                <th>Fecha</th>
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