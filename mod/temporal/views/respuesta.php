<?php if(!$ate){ ?>

	<!-- Insertar o Editar datos -->
	<?php echo Utils::tit2("Respuesta","fas fa-restroom  mr-3","respuesta/index&iddap=".$iddap,"300px"); ?>



	<div id="inser">

		<?php 
		// var_dump($edit);
		// var_dump($val);

		if(isset($edit) && isset($val)): ?>
			<h2 class="title-c m-tb-40">Ver Respuesta</h2>
			<?php //$url_action = base_url."pregunta/saverp&iddap=".$val[0]['iddap']; ?>
			
		<?php else: ?>
			<h2 class="title-c m-tb-40">Crear Nueva Respuesta</h2>
			<?php $url_action = base_url."respuesta/saverp"; ?>
		<?php endif; ?>

		<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
			<div class="row">
				<input type="hidden" name="iddap" value="<?=isset($iddap) ? $iddap : ''; ?>"/>
				<div class="form-group col-md-6">
					<label for="resdar">Descripción de la Respuesta</label>
					<textarea class="form-control form-control-sm" id="resdar" name="resdar" required <?=isset($val) ? ' disabled ' : ''; ?> ><?=isset($val) ? $val[0]['resdar'] : ''; ?></textarea>
				</div>
				<div class="form-group col-md-6">
					<input type="submit" class="btn-primary-ccapital" value="Registrar">
				</div>
			</div>
		</form>
	</div>
<?php }?>

<!-- Ver datos -->

<h2 class="title-c">Pregunta No. <?=$iddap;?></h2>
<br><br>

	<div class="table-responsive">
	<?php 
        if(isset($preguntas)){
        	foreach ($preguntas as $va){ ?>
				<table class="table table-hover">
					<tr>
						<th class="tablefor">Tema:</th>
						<td class="active">
							<big><big><strong>
								<?=$va['temdap'];?>
							</strong></big></big>
						</td>
						<th class="tablefor">Categoría:</th>
						<td class="active" colspan="2">
							<?=$va['valid'];?> - <?=$va['valnom'];?>
						</td>
					</tr>
					<tr>
						<th class="tablefor">Descripción:</th>
						<td class="active" colspan="4">
							<?=$va['predap'];?>
						</td>
					</tr>
					<tr>
						<th class="tablefor">Fecha Solicitud:</th>
						<td class="active">
							<?=$va['fecdap'];?>
						</td>
						<th class="tablefor">Solicitante:</th>
						<td class="active"><?=$va['pernom'];?> <?=$va['perape'];?></td>
						<td class="active">
							<?php if($va['okjurdap']){ ?>
		                    	<a href="<?=path_filem;?><?=$va['okjurdap'];?>" target="_blank">
		                    		<img src="<?=base_url_img?>adjun.png" width="30px">
		                    	</a>
		                	<?php } ?>
						</td>
					</tr>
				</table>
		<?php }} ?>
	</div>

	<br>

<!-- Detalles -->

<!-- Ver datos -->

<h2 class="title-c">Seguimiento</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	            	<th>Fecha</th>
	                <th>Respuesta</th>
	                <!-- <th></th> -->
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($asis)){
	        		foreach ($asis as $va){ ?>
		            <tr>
		            	<td>
	                        <small>
	                            <?=$va['fecdar'];?>
	                        </small>
		                </td>
		                <td>
	                        <small>
                            	<?=$va['resdar'];?>
	                        </small>
		                </td>
		                <!-- <td style="text-align: center;">
		                	<?php if($va['ceras']==1){ ?>
			                	<i class="fas fa-lock" title="Caso Cerrado" style="color: #523178;"></i>
			                <?php }else{ ?>
			                	<i class="fas fa-unlock-alt" title="Caso Abierto" style="color: #ff0000;"></i>
			                <?php } ?>
		                </td> -->
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Fecha</th>
	                <th>Respuesta</th>
	                <!-- <th></th> -->
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