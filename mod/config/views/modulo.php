<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Módulos","fa fa-address-card ico3","modulo/index","300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Editar Modulo <!-- <?=$val[0]['nommod']?> --></h2>
		<?php $url_action = base_url."modulo/save&idmod=".$val[0]['idmod']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo Módulo</h2>
		<?php $url_action = base_url."modulo/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">
			<div class="form-group col-md-6">
				<label for="nommod">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="nommod" name="nommod" value="<?=isset($val) ? $val[0]['nommod'] : ''; ?>"/>
			</div>
			<div class="form-group col-md-6">
				<label for="icomod">Ruta imagen</label>
				<input type="text" class="form-control form-control-sm" id="icomod" name="icomod" value="<?=isset($val) ? $val[0]['icomod'] : ''; ?>"/>
			</div>

			<div class="form-group col-md-6">
				<label for="actmod">Activo</label>
				<select class="form-control" id="actmod" name="actmod" style="height: 45px;">
				 	<option value="1" <?=(isset($val) && $val[0]['actmod']==1) ? ' selected ':''; ?>>Si</option>
				 	<option value="2" <?=(isset($val) && $val[0]['actmod']!=1) ? ' selected ':''; ?>>No</option>
				</select>
			</div>

			<div class="form-group col-md-6">
				<label for="ordmod">Orden</label>
				<input type="number" class="form-control" id="ordmod" name="ordmod" value="<?=isset($val) ? $val[0]['ordmod'] : '100'; ?>" style="height: 45px;" />
			</div>
			
			<div class="form-group col-md-6">
				<label for="pefpre">Perfil Predeterminado</label>
				<select class="form-control" id="pefpre" name="pefpre" style="height: 45px;">
					<?php if($ppn){ foreach ($ppn as $pn) { ?>
				 		<option value="<?=$pn['pefid'];?>" <?=(isset($val) && $val[0]['pefpre']==$pn['pefid']) ? ' selected ':''; ?>><?=$pn['pefnom'];?></option>
				 	<?php }} ?>
				</select>
			</div>

			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>

<br>
<!-- Ver datos -->

<h2 class="title-c">Módulos</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th></th>
					<th>Módulo</th>								
					<th>Act.</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($modulos)){
	        		foreach ($modulos as $va){ ?>
		            <tr>
		                <td><img src="<?=base_url_img.$va['icomod'];?>" width="100px"></td>
		                <td>
		                	<?=$va['idmod']." - ".$va['nommod'];?>
 		                	<br>
		                	<small><small>
		                		<strong>Perfil Predeterminado:</strong>
		                		<?php
		                			if($va['pefpre']){
		                				echo $va['pefnom'];
		                			}else{
		                				echo "Sin perfil asignado";
		                			}
		                		?>
		                	</small></small>
		                </td> 
		                <td style="text-align: center;">
		                	<?=$va['ordmod'];?>
		                	<br><br>
		                	<?php if($va['actmod']==1){ ?>
		                		<a href="<?=base_url?>modulo/act&idmod=<?=$va['idmod'];?>&actmod=2">
				                	<i class="fas fa-check-circle" style="color: #523178;">
				                		<span style="color: rgba(255,255,255,0);">+</span>
				                	</i>
				                </a>
			                <?php }else{ ?>
			                	<a href="<?=base_url?>modulo/act&idmod=<?=$va['idmod'];?>&actmod=1">
									<i class="fas fa-times-circle" style="color: #f00;">
										<span style="color: rgba(255,255,255,0);">-</span>
									</i>
								</a>
							<?php } ?>
		                </td>
		                <td style="text-align: center;">
		                	<a href="<?=base_url?>modulo/edit&idmod=<?=$va['idmod'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>


		                	<!-- Modal Modulos perfil -->
		                	<i class="far fa-address-book" data-toggle="modal" data-target="#myModPpr<?=$va['idmod'];?>" title="Asignar perfil Predeterminado" style="color: #523178;"></i>
		                	&nbsp;&nbsp;&nbsp;
		                	<?php 
		                	//$pxpa = $perfil->getAllpxp($va['perid']);
		                	$ure = array("id" => $va['idmod'],"nom" => $va['nommod']);
		                	$mod = array($ure);
		                	
		                	$usel = array("pim" => $va['pefpre'],"pid" => "-5");
		                	$ase = array($usel);
		                	//$mod = array["id" => "1","nom" => "foo",];
		                	echo Utils::modals("myModPpr", "Perfil Predeterminado", $va['idmod'], "", $mod, base_url."modulo/savemxp", $perfils, $ase, "Si");
		                	?>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th></th>
					<th>Módulo</th>								
					<th>Act.</th>
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