<?php if(!$ate){ ?>

	<!-- Insertar o Editar datos -->
	<?php echo Utils::tit("Solución","fas fa-restroom  mr-3","ressop/index&idst=".$idst,"300px"); ?>



	<div id="inser">

		<?php 
		// var_dump($edit);
		// var_dump($val);

		if(isset($edit) && isset($val)): ?>
			<h2 class="title-c m-tb-40">Ver Solución</h2>
			<?php //$url_action = base_url."soporte/save&idst=".$val[0]['idst']; ?>
			
		<?php else: ?>
			<h2 class="title-c m-tb-40">Crear Nueva Solución</h2>
			<?php $url_action = base_url."ressop/saverp"; ?>
		<?php endif; ?>

		<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
			<div class="row">
					<input type="hidden" name="idst" value="<?=isset($idst) ? $idst : ''; ?>"/>
				<!-- <div class="form-group col-md-6">
					<label for="perid">Técnico Encargado</label>
					<select class="form-control form-control-sm" style="padding: 0px;" id="perid" name="perid" <?=isset($val) ? ' disabled ' : ''; ?> >
					<?php 
					// if($psis){
					// 	foreach ($psis as $do){ ?>
			                <option value="<?=$do['perid'];?>" 
			                	<?=isset($val) && $do['perid']==$val[0]['perid'] ? ' selected ' : ''; ?> ><?=$do['nom'];?>
			                </option>
			            
			        <?php //}} ?>
			        </select>
				</div> -->
				<div class="form-group col-md-6">
					<label for="desas">Descripción de la solución</label>
					<textarea class="form-control form-control-sm" id="desas" name="desas" required <?=isset($val) ? ' disabled ' : ''; ?> ><?=isset($val) ? $val[0]['desas'] : ''; ?></textarea>
				</div>
				<div class="form-group col-md-6">
					<label for="ceras">Cerrar Caso?</label>
					<input type ="checkbox" class="form-control form-control-sm" id="ceras" name="ceras" value="1" checked >
				</div>
				<div class="form-group col-md-6">
					<input type="submit" class="btn-primary-ccapital" value="Registrar">
				</div>
			</div>
		</form>
	</div>
<?php }?>

<!-- Ver datos -->

<h2 class="title-c">Resolver Caso No. <?=$idst;?></h2>
<br><br>

	<div class="table-responsive">
	<?php 
        if(isset($soportes)){
        	foreach ($soportes as $va){ ?>
				<table class="table table-hover">
					<tr>
						<th class="tablefor">Solicitante:</th>
						<td class="active">
							<big><big><strong>
								<?=$va['nomsst'];?>
							</strong></big></big>
						</td>
						<th class="tablefor">Área:</th>
						<td class="active" colspan="2">
							<?=$va['area'];?> - <?=$va['valnom'];?>
						</td>
					</tr>
					<tr>
						<th class="tablefor">Descripción:</th>
						<td class="active" colspan="4">
							<?=$va['desst'];?>
						</td>
					</tr>
					<tr>
						<th class="tablefor">Fecha Solicitud:</th>
						<td class="active">
							<?=$va['fecsst'];?>
						</td>
						<th class="tablefor">No. Contacto:</th>
						<td class="active"><?=$va['telst'];?></td>
						<td class="active">
							<?php if($va['rutst']){ ?>
		                    	<a href="<?=path_filem;?><?=$va['rutst'];?>" target="_blank">
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
	                <th>Soporte</th>
	                <th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($asis)){
	        		foreach ($asis as $va){ ?>
		            <tr>
		            	<td>
	                        <small>
	                            <?=$va['fecas'];?>
	                        </small>
		                </td>
		                <td>
		                	<strong>
	                            Atendió: <?=$va['pernom'];?>
	                        </strong><br>
	                        <small>
                            	<strong>Reporte: </strong><?=$va['desas'];?>
	                        </small>
		                </td>
		                <td style="text-align: center;">
		                	<!-- <a href="<?=base_url?>soporte/edit&ceras=<?=$va['ceras'];?>">
		                		<i class="far fa-eye" style="color: #523178;"></i>
		                	</a> -->
		                	<?php if($va['ceras']==1){ ?>
			                	<i class="fas fa-lock" title="Caso Cerrado" style="color: #523178;"></i>
			                <?php }else{ ?>
			                	<i class="fas fa-unlock-alt" title="Caso Abierto" style="color: #ff0000;"></i>
			                <?php } ?>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Fecha</th>
	                <th>Soporte</th>
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