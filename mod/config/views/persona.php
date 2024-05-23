<!-- Insertar o Editar datos -->

<?php echo Utils::tit("persona F.","fa fa-address-card ico3","persona/index","300px"); ?>
<div id="inser">

	<?php if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Editar persona F. <!-- <?=$val[0]['nodocemp']?> --></h2>
		<?php $url_action = base_url."persona/save&perid=".$val[0]['perid']; 
	?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo persona F.</h2>
		<?php $url_action = base_url."persona/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">

			<?php if(isset($val) && $perid){ ?>
				<div class="form-group col-md-6">
					<label for="perid">Id.</label>
					<input type="number" class="form-control form-control-sm" id="perid" name="perid" value="<?=isset($val) ? $val[0]['perid'] : ''; ?>"/>

				</div>
			<?php } ?>
			<div class="form-group col-md-6">
				<label for="pernom">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="pernom" name="pernom" value="<?=isset($val) ? $val[0]['pernom'] : ''; ?>" required />

			</div>
			<div class="form-group col-md-6">
				<label for="perape">Apellido</label>
				<input type="text" class="form-control form-control-sm" id="perape" name="perape" value="<?=isset($val) ? $val[0]['perape'] : ''; ?>" required />

			</div>
			<div class="form-group col-md-6">
				<label for="peremail">Email</label>
				<input type="email" class="form-control form-control-sm" id="peremail" name="peremail" value="<?=isset($val) ? $val[0]['peremail'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="perpass">Contraseña</label>
				<input type="password" class="form-control form-control-sm" id="perpass" name="perpass" <?=isset($val) ? '': 'required'; ?> />
			</div>
			<!-- <div class="form-group col-md-6">
				<label for="ubiid">Ciudad</label> -->
				<input type="hidden" class="form-control form-control-sm" id="ubiid" name="ubiid" value="11001" />
			<!-- </div> -->
			<div class="form-group col-md-6">
				<label for="perdir">Dirección</label>
				<input type="text" class="form-control form-control-sm" id="perdir" name="perdir" value="<?=isset($val) ? $val[0]['perdir'] : ''; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="pertel">No. Teléfono</label>
				<input type="number" class="form-control form-control-sm" id="pertel" name="pertel" value="<?=isset($val) ? $val[0]['pertel'] : ''; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="percel">No. Celular</label>
				<input type="number" class="form-control form-control-sm" id="percel" name="percel" value="<?=isset($val) ? $val[0]['percel'] : ''; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="pefid">Perfil Predeterminado</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="pefid" name="pefid">
				<?php 
				if($perfils2){
					foreach ($perfils2 as $do){ ?>
		            
		                <option value="<?=$do['pefid'];?>" <?=isset($val) && $do['pefid']==$val[0]['pefid'] ? ' selected ' : ''; ?> ><?=$do['pefnom']." - Mod. ".$do['nommod'];?></option>
		            
		        <?php }} ?>
		        </select>
			</div>
			<div class="form-group col-md-6">
				<label for="depid">Área</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="depid" name="depid">
				<?php 
				if($areas){
					foreach ($areas as $do){ ?>
		            
		                <option value="<?=$do['valid'];?>" <?=isset($val) && $do['valid']==$val[0]['depid'] ? ' selected ' : ''; ?> ><?=$do['valnom'];?></option>
		            
		        <?php }} ?>
		        </select>
			</div>
			<!-- <div class="form-group col-md-6">
				<label for="envema">Enviar Email</label> -->
				<input type="hidden" class="form-control form-control-sm" id="envema" name="envema" value="1" />
			<!-- </div> -->
			<div class="form-group col-md-6">
				<label for="actemp">Activo</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="actemp" name="actemp">
            		<option value="1" <?=isset($val) && $val[0]['actemp']==1 ? ' selected ' : ''; ?> >Si</option>
            		<option value="2" <?=isset($val) && $val[0]['actemp']!=1 ? ' selected ' : ''; ?> >No</option>
		        </select>
			</div>

			<div class="form-group col-md-6">
				<label for="ordgas">Tipo de Usuario</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="ordgas" name="ordgas">
				<?php 
				if($tpusu){
					foreach ($tpusu as $do){ ?>
		            
		                <option value="<?=$do['ncon'];?>" <?=isset($val) && $do['ncon']==$val[0]['ordgas'] ? ' selected ' : ''; ?> ><?=$do['valnom'];?></option>
		        <?php }} ?>
		        </select>
			</div>

			<div class="form-group col-md-6">
				<label for="planta">Planta</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="planta" name="planta">
            		<option value="1" <?=isset($val) && $val[0]['planta']==1 ? ' selected ' : ''; ?> >Si</option>
            		<option value="0" <?=isset($val) && $val[0]['planta']!=1 ? ' selected ' : ''; ?> >No</option>
		        </select>
			</div>

			<div class="form-group col-md-6">
				<label for="cargo">Cargo</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="cargo" name="cargo">
				<?php 
				if($carg){
					foreach ($carg as $do){ ?>
		            
		                <option value="<?=$do['valid'];?>" <?=isset($val) && $do['valid']==$val[0]['cargo'] ? ' selected ' : ''; ?> ><?=$do['valnom'];?></option>
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

<h2 class="title-c">Personas</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Usuario</th>
					<th>Act</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($personas)){
	        		foreach ($personas as $va){ ?>
		            <tr>
		                <td>
		                	<strong>
	                            <?php if($va['nodocemp']) echo $va['nodocemp']." - ";?>
	                            <?=$va['pernom'];?> <?=$va['perape'];?>
	                        </strong><br>
	                        <small>
	                            <strong>E-mail: </strong><?=$va['peremail'];?>
	                            </br>
	                            <?php if($va['perdir']){
	                            	echo "<strong>Dirección: </strong>";
	                            	echo $va['perdir']."&nbsp;&nbsp;&nbsp;";
	                            } ?>
	                            <?php if($va['ubinom']) echo $va['ubinom']."</br>"; ?>
	                            <?php if($va['pertel']){
	                            	echo "<strong>Teléfono: </strong>";
	                            	echo $va['pertel']."&nbsp;&nbsp;&nbsp;";
	                            } ?>
	                            <?php if($va['percel']){
	                            	echo "<strong>Celular: </strong>";
	                            	echo $va['percel']."</br>";
	                            } ?>

 	                            <?php if($va['pefnom']){
	                            	echo "<strong>Perfil: </strong>";
	                            	echo $va['pefnom']."&nbsp;&nbsp;&nbsp;";
	                            } ?>

	                            <?php if($va['envema']==1){ ?>
	                            	<i class="fas fa-envelope" title="Enviar E-mail"></i>&nbsp;&nbsp;&nbsp;
	                            <?php } ?>
	                            

	                            <?php if($va['valnom']){
	                            	echo "<strong>Área: </strong>";
	                            	echo $va['valnom']."</br>";
	                            } ?>

	                            <?php if($va['tpusu']){
	                            	echo "<strong>Tipo de Usuario: </strong>";
	                            	echo $va['tpusu']."&nbsp;&nbsp;&nbsp;";
	                            } ?>

	                            <strong>Planta: </strong>
	                            <?php if($va['planta']==1){
	                            	echo "Si";
	                            }else{
	                            	echo "No";
	                            } ?>
	                            &nbsp;&nbsp;&nbsp;
	                            
	                            <?php if($va['carg']){
	                            	echo "<strong>Cargo: </strong>";
	                            	echo $va['carg']."</br>";
	                            } ?>

	                        </small>
		                </td>
		                <td>
							<span style="opacity: 0"><?=$va['actemp'];?></span>
		                	<?php if($va['actemp']==1){ ?>
		                		<a href="<?=base_url?>persona/act&perid=<?=$va['perid'];?>&actemp=2">
				                	<i class="fas fa-check-circle" style="color: #523178;">
				                		<span style="color: rgba(255,255,255,0);">+</span>
				                	</i>
				                </a>
			                <?php }else{ ?>
			                	<a href="<?=base_url?>persona/act&perid=<?=$va['perid'];?>&actemp=1">
									<i class="fas fa-times-circle" style="color: #f00;">
										<span style="color: rgba(255,255,255,0);">-</span>
									</i>
								</a>
							<?php } ?>
		                </td>
		                <td>
		                	<a href="<?=base_url?>persona/edit&perid=<?=$va['perid'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>

		                	&nbsp;&nbsp;&nbsp;

		                	<!-- Modal Modulos perfil -->
		                	<i class="far fa-address-book" data-toggle="modal" data-target="#myModsel<?=$va['perid'];?>" title="Mostrar Perfiles por Módulos" style="color: #523178;"></i>
		                	<?php 
		                		$pxpa = $persona->getAllpxp($va['perid']);
		                	echo Utils::modals("myModsel", "Perfiles por Módulo", $va['perid'], $va['pernom'].' '.$va['perape'], $modulos, base_url."persona/savepp", $perfils, $pxpa); 
		                	?>

		                	&nbsp;&nbsp;&nbsp;
		                <?php if($va['depid']==1024){ ?>
		                	<!-- Modal Modulos Categoria -->
		                	<i class="fas fa-tasks" data-toggle="modal" data-target="#myModCat<?=$va['perid'];?>" title="Mostrar Categorías" style="color: #523178;"></i>
		                	<?php 

		                		$pxpct = $persona->getAllcat($va['perid']);
		                		echo Utils::modal("myModCat", "Categorias por persona", $va['perid'], $va['pernom']."<br>Sistemas", $valores, base_url."persona/savect", $pxpct); 
		                	?>
		                <?php } ?>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Usuario</th>
					<th>Act</th>
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