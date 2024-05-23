<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Pasante","fas fa-restroom  mr-3","pasante/index","300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Editar Pasante<!-- <?=$val[0]['docpas']?> --></h2>
		<?php $url_action = base_url."pasante/save&idpas=".$val[0]['idpas']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo pasante</h2>
		<?php $url_action = base_url."pasante/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">
				<input type="hidden" name="idpas" value="<?=isset($val) ? $val[0]['idpas'] : ''; ?>"/>
			<div class="form-group col-md-6">
				<label for="docpas">No. Documento</label>
				<input type="number" class="form-control form-control-sm" id="docpas" name="docpas" value="<?=isset($val) ? $val[0]['docpas'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="nompas">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="nompas" name="nompas" value="<?=isset($val) ? $val[0]['nompas'] : ''; ?>"/>
			</div>
			<div class="form-group col-md-6">
				<label for="propas">Programa</label>
				<input type="text" class="form-control form-control-sm" id="propas" name="propas" value="<?=isset($val) ? $val[0]['propas'] : ''; ?>"/>
			</div>
			<div class="form-group col-md-6">
				<label for="unipas">Universidad</label>
				<input type="text" class="form-control form-control-sm" id="unipas" name="unipas" value="<?=isset($val) ? $val[0]['unipas'] : ''; ?>"/>
			</div>
			<div class="form-group col-md-6">
				<label for="fingpas">Fecha Ingreso</label>
				<input type="date" class="form-control form-control-sm" id="fingpas" name="fingpas" value="<?=isset($val) ? $val[0]['fingpas'] : $fecin; ?>" min="<?=$fecin;?>" <?php if(isset($val) AND $_SESSION['pefid']!=57) echo "readonly"; ?>/>
			</div>
			<div class="form-group col-md-6">
				<label for="ffinpas">Fecha Fin</label>
				<input type="date" class="form-control form-control-sm" id="ffinpas" name="ffinpas" value="<?=isset($val) ? $val[0]['ffinpas'] : $fecin; ?>" min="<?=$fecin;?>" <?php if(isset($val) AND $_SESSION['pefid']!=57) echo "readonly"; ?>/>
			</div>
			<div class="form-group col-md-6">
				<label for="durpas">Duración</label>
				<input type="text" class="form-control form-control-sm" id="durpas" name="durpas" value="<?=isset($val) ? $val[0]['durpas'] : ''; ?>"/>
			</div>
			<div class="form-group col-md-6">
				<label for="actpas">Activo</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="actpas" name="actpas">
	                <option value="1" <?=isset($val) && 1==$val[0]['actpas'] ? ' selected ' : ''; ?> >Si</option>
		            <option value="2" <?=isset($val) && 1!=$val[0]['actpas'] ? ' selected ' : ''; ?> >No</option>
		        </select>

			</div>
			<div class="form-group col-md-6">
				<label for="acvpas">Actividades</label>
				<textarea class="form-control form-control-sm" id="acvpas" name="acvpas"><?=isset($val) ? $val[0]['acvpas'] : ''; ?></textarea>
			</div>
			<div class="form-group col-md-6">
				<label for="conpas">Convenio o Estado Joven</label>
				<textarea class="form-control form-control-sm" id="conpas" name="conpas"><?=isset($val) ? $val[0]['conpas'] : ''; ?></textarea>
			</div>
			

			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>

<br>
<!-- Ver datos -->

<h2 class="title-c">Pasantes</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Pasante</th>
					<th>F. Ing</th>
	                <th>F. Fin</th>
					<th></th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($pasantes)){
	        		foreach ($pasantes as $va){ ?>
		            <tr>
		                <td>
		                	<strong>
<!-- , , durpas, acvpas, conpas, actpas -->
	                            <?php if($va['docpas']) echo $va['docpas']." - ";?>
	                            <?=$va['nompas'];?>
	                        </strong><br>
	                        <small>
	                        	<strong>Programa: </strong><?=$va['propas'];?>
	                            </br>
	                            <strong>Universidad: </strong><?=$va['unipas'];?>
	                            </br>
	                            <strong>Duración: </strong><?=$va['durpas'];?>

	                            <!-- <?php if($va['acvpas']){
	                            	echo "<strong>Activo: </strong>";
	                            	echo $va['acvpas']."&nbsp;&nbsp;&nbsp";
	                            } ?>
	                            <?php if($va['conpas']){
	                            	echo "<strong>Con: </strong>";
	                            	echo $va['conpas']."</br>";
	                            } ?> -->
	                        </small>
		                </td>
		                <td>
		                	<small>
                            	<?=$va['fingpas'];?>
                            </small>
		                </td>
		                <td>
		                	<small>
                            	<?=$va['ffinpas'];?>
                            </small>
		                </td>
		                <td>
							<span style="opacity: 0"><?=$va['actpas'];?></span>
		                	<?php if($va['actpas']==1){ ?>
		                		<a href="<?=base_url?>pasante/act&idpas=<?=$va['idpas'];?>&actpas=2">
				                	<i class="fas fa-check-circle" style="color: #523178;">
				                		<span style="color: rgba(255,255,255,0);">+</span>
				                	</i>
				                </a>
			                <?php }else{ ?>
			                	<a href="<?=base_url?>pasante/act&idpas=<?=$va['idpas'];?>&actpas=1">
									<i class="fas fa-times-circle" style="color: #f00;">
										<span style="color: rgba(255,255,255,0);">-</span>
									</i>
								</a>
							<?php } ?>
		                </td>
		                <td>
		                	<a href="<?=base_url?>pasante/edit&idpas=<?=$va['idpas'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Pasante</th>
	                <th>F. Ing</th>
	                <th>F. Fin</th>
					<th></th>
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