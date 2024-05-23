<!-- Insertar o Editar datos -->
<?php echo Utils::tit2("pregunta","fas fa-restroom  mr-3","pregunta/index","300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Ver pregunta</h2>
		<?php //$url_action = base_url."pregunta/save&iddap=".$val[0]['iddap']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nueva pregunta</h2>
		<?php $url_action = base_url."pregunta/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<div class="row">
				<input type="hidden" name="iddap" value="<?=isset($val) ? $val[0]['iddap'] : ''; ?>"/>
			<div class="form-group col-md-6">
				<label for="temdap">Tema</label>
				<input type="text" class="form-control form-control-sm" id="temdap" name="temdap" value="<?=isset($val) ? $val[0]['temdap'] : ''; ?>" <?=isset($val) ? ' disabled ' : ''; ?> required />
			</div>
			<div class="form-group col-md-6">
				<label for="tipo">Categoría</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="valid" name="valid">
				<?php 
				if($tipoe){
					foreach ($tipoe as $tipo){ ?>
		                <option value="<?=$tipo['valid'];?>" 
		                	<?=isset($val) && $tipo['valid']==$val[0]['tipo'] ? ' selected ' : ''; ?> ><?=$tipo['valnom'];?>
		                </option>
		            
		        <?php }} ?>
		        </select>
			</div>
			<div class="form-group col-md-6">
				<label for="predap">Descripción de la pregunta</label>
				<textarea class="form-control form-control-sm" id="predap" name="predap" required><?=isset($val) ? $val[0]['predap'] : ''; ?></textarea>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="okjurdap">OK Jurídica</label>
				<input type="checkbox" class="form-control form-control-sm" id="okjurdap" name="okjurdap" <?=isset($val) and $val==1 ? "checked" : ''; ?> />
			</div>

<!--  		<?php if(!isset($rutdap)){ ?> -->
				<div class="form-group col-md-6">
					<label for="archi">Archivo adjunto (Opcional)</label>
					<input type="file" class="form-control form-control-sm" id="archi" name="arch" accept="image/*, video/*, .doc,.docx,applitipoion/msword,applitipoion/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf,.xls,.xlsx,.ppt,.pptx,.zip,.rar" style="height: 50px;"/>
					<small><small><span style="color: #ff0000;font-weight: bold;">* Si son varios archivos, suba un solo archivo comprimido.</span></small></small>
				</div>
<!-- 			<?php }elseif($val[0]['archi']){ ?>
            	<div class="form-group col-md-6">
					<label for="archi">Archivo evidencias</label><br>
					<a href="<?=path_filem;?><?=$val[0]['archi'];?>" target="_blank">
	            		<img src="<?=base_url_img?>adjun.png" id="archi" width="50px" title="Descargue el archivo de evidencias">
	            	</a>
				</div>
	        <?php } ?> -->
	       	<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>
		</div>
	</form>
</div>

<!-- Ver datos -->

<h2 class="title-c">preguntas</h2>
<?php $url_action2 = base_url."pregunta/index"; ?>

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
	                <th>Pregunta</th>
	                <!-- <th>Categoría</th> -->
	                <th>Respuesta</th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($preguntas)){
	        		foreach ($preguntas as $va){ ?>
		            <tr>
		            	<td>
	                        <small>
	                            <?=$va['fecdap'];?>
	                        </small>
		                </td>
		                <td>
		                	<strong>
	                            <?=$va['temdap'];?>
	                        </strong><br>
	                        <small>
                            	<strong>Descripción: </strong><?=$va['predap'];?>
                            	</br>
                            	</br>
                            	<?php if($va['rutdap']){ ?>
	                            	<strong>Adjunto: </strong>
	                            	<a href="<?=path_filem;?><?=$va['rutdap'];?>" target="_blank">
	                            		<img src="<?=base_url_img?>adjun.png" width="30px">
	                            	</a>
                            	<?php } ?>
	                        </small>
		                </td>
		                <!-- <td>
	                        <small>
	                            <?=$va['tipoe'];?>
	                        </small>
		                </td> -->
		                <td style="text-align: center;">
		                	<!-- <a href="<?=base_url?>respuesta/edit&iddap=<?=$va['Ndap'];?>">
		                		<i class="far fa-eye" style="color: #523178;"></i>
		                	</a> -->
		                	<a href="<?=base_url?>respuesta/index&iddap=<?=$va['Ndap'];?>">
			                	<?php if($va['leido']==1){ ?>
				                	<i class="fas fa-comments" title="Respuestas" style="color: #523178;"></i>
				                <?php }else{ ?>
				                	<i class="fas fa-comment" title="Respuestas" style="color: #ff0000;"></i>
				                <?php } ?>
			                </a>

		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Fecha</th>
	                <th>Pregunta</th>
	                <!-- <th>Categoría</th> -->
	                <th>Respuesta</th>
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