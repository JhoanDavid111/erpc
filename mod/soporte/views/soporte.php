<!-- Insertar o Editar datos -->
<?php echo Utils::tit("soporte","fas fa-restroom  mr-3","soporte/index","300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Ver Soporte</h2>
		<?php //$url_action = base_url."soporte/save&idst=".$val[0]['idst']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo Soporte</h2>
		<?php $url_action = base_url."soporte/save"; ?>
	<?php endif; ?>


	<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<div class="row">
				<input type="hidden" name="idst" value="<?=isset($val) ? $val[0]['idst'] : ''; ?>"/>
			<div class="form-group col-md-6">
				<label for="nomsst">Nombre del Solicitante</label>
				<input type="text" class="form-control form-control-sm" id="nomsst" name="nomsst" value="<?=isset($val) ? $val[0]['nomsst'] : ''; ?>" <?=isset($val) ? ' disabled ' : ''; ?> required />
			</div>
			<div class="form-group col-md-6">
				<label for="cat">Categoría</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="cat" name="cat">
				<?php 
				if($cate){
					foreach ($cate as $cat){ ?>
		                <option value="<?=$cat['valid'];?>" 
		                	<?=isset($val) && $cat['valid']==$val[0]['cat'] ? ' selected ' : ''; ?> ><?=$cat['valnom'];?>
		                </option>
		            
		        <?php }} ?>
		        </select>
			</div>
			<div class="form-group col-md-6">
				<label for="area">Área</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="area" name="area" <?=isset($val) ? ' disabled ' : ''; ?> >
				<?php 
				if($tipo){
					foreach ($tipo as $do){ ?>
		                <option value="<?=$do['valid'];?>" 
		                	<?=isset($val) && $do['valid']==$val[0]['area'] ? ' selected ' : ''; ?> ><?=$do['valnom'];?>
		                </option>
		            
		        <?php }} ?>
		        </select>
			</div>
			<div class="form-group col-md-6">
				<label for="desst">Descripción de la soporte</label>
				<textarea class="form-control form-control-sm" id="desst" name="desst" required><?=isset($val) ? $val[0]['desst'] : ''; ?></textarea>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="telst">Número de Contacto</label>
				<input type="number" class="form-control form-control-sm" id="telst" name="telst" value="<?=isset($val) ? $val[0]['telst'] : ''; ?>" <?=isset($val) ? ' disabled ' : ''; ?> required />
			</div>
			<?php if(!isset($val)){ ?>
				<div class="form-group col-md-6">
					<label for="rutst">Archivo adjunto (Opcional)</label>
					<input type="file" class="form-control form-control-sm" id="rutst" name="arch" accept="image/*, video/*, .doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf,.xls,.xlsx,.ppt,.pptx,.zip,.rar" style="height: 50px;"/>
					<small><small><span style="color: #ff0000;font-weight: bold;">* Si son varios archivos, suba un solo archivo comprimido.</span></small></small>
				</div>

				<div class="form-group col-md-6">
					<input type="submit" class="btn-primary-ccapital" value="Registrar">
				</div>
			<?php }elseif($val[0]['rutst']){ ?>
            	<div class="form-group col-md-6">
					<label for="rutst">Archivo evidencias</label><br>
					<a href="<?=path_filem;?><?=$val[0]['rutst'];?>" target="_blank">
	            		<img src="<?=base_url_img?>adjun.png" id="rutst" width="50px" title="Descargue el archivo de evidencias">
	            	</a>
				</div>
	        <?php } ?>
		</div>
	</form>
</div>

<!-- Ver datos -->

<h2 class="title-c">Soportes</h2>
<?php $url_action2 = base_url."soporte/index"; ?>

	<div>
		<form class="m-tb-40" action="<?=$url_action2?>" method="POST">
			<div class="row">
				<div class="form-group col-md-6">
					<label for="fil1">Fecha Inicial:</label>
					<input type="date" class="form-control form-control-sm" id="fil1" name="fil1" value="<?=$munm?>">
				</div>
				<div class="form-group col-md-6">
					<label for="fil2">Fecha Final:</label>
					<input type="date" class="form-control form-control-sm" id="fil2" name="fil2"  onChange="this.form.submit();">
				</div>
			</div>
		</form>
	</div>

	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Fecha</th>
	                <th>Soporte</th>
	                <th>Categoría</th>
	                <th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($soportes)){
	        		foreach ($soportes as $va){ ?>
		            <tr>
		            	<td>
	                        <small>
	                            <?=$va['fecsst'];?>
	                        </small>
		                </td>
		                <td>
		                	<strong>
	                            <?=$va['nomsst'];?>
	                        </strong><br>
	                        <small>
                            	<strong>Área: </strong><?=$va['area'];?> - <?=$va['valnom'];?>
                            	</br>
                            	<strong>Descripción: </strong><?=$va['desst'];?>
                            	</br> 
	                            <strong>No. Teléfono: </strong><?=$va['telst'];?>
	                            </br>
                            	</br>
                            	<?php if($va['rutst']){ ?>
	                            	<strong>Adjunto: </strong>
	                            	<a href="<?=path_filem;?><?=$va['rutst'];?>" target="_blank">
	                            		<img src="<?=base_url_img?>adjun.png" width="30px">
	                            	</a>
                            	<?php } ?>
	                        </small>
		                </td>
		                <td>
	                        <small>
	                            <?=$va['cate'];?>
	                        </small>
		                </td>
		                <td style="text-align: center;">
		                	<!-- <a href="<?=base_url?>soporte/edit&idst=<?=$va['idst'];?>">
		                		<i class="far fa-eye" style="color: #523178;"></i>
		                	</a> -->
		                	<a href="<?=base_url?>ressop/index&idst=<?=$va['idst'];?>">
			                	<?php if($va['cerst']==1){ ?>
				                	<i class="fas fa-lock" title="Caso Cerrado" style="color: #523178;"></i>
				                <?php }else{ ?>
				                	<i class="fas fa-unlock-alt" title="Caso Abierto" style="color: #ff0000;"></i>
				                <?php } ?>
			                </a>

		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Fecha</th>
	                <th>Soporte</th>
	                <th>Categoría</th>
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