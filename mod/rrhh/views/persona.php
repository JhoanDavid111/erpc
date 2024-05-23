<!-- Insertar o Editar datos -->

<?php 
if($_SESSION['pefid']!=62){
	echo Utils::tit("persona F.","fa fa-address-card ico3","persona/index","300px"); 
?>

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
<?php } ?>

<!-- Ver datos -->

<h2 class="title-c">Usuarios</h2>
<?php 
	$url_action2 = base_url."dathvper/index";
	$url_action = base_url."persona/index";
 ?>

	<div>
		<form class="m-tb-40" action="<?=$url_action?>" method="POST">
			<div class="row">
				<div class="form-group col-md-6">
					<label for="fil1">Fecha Inicial:</label>
					<input type="date" class="form-control form-control-sm" id="fil1" name="fil1" value="<?=$fecinico;?>">
				</div>
				<div class="form-group col-md-6">
					<label for="fil2">Fecha Final:</label>
					<input type="date" class="form-control form-control-sm" id="fil2" name="fil2" value="<?=$fecfinco;?>" onChange="this.form.submit();">
				</div>
			</div>
		</form>
	</div>


<h2 class="title-c">Personas</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Usuario</th>
	                <th>Tipo Contrato</th>
	                <th>Fecha Inicio</th>
	                <th>Fecha Fin</th>
					<th>Act</th>
					<!-- <th></th> -->
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($personas)){
	        		foreach ($personas as $va){ ?>
	        		<tr>
		                <td>
		                	<strong>
	                            <?=$va['pernom'];?> <?=$va['perape'];?>
	                        </strong><br>
	                        <small>
	                        	<strong>N° Documento </strong><?=$va['nodocemp'];?>
	                            </br>
	                            <?php if($va['peremail']){
	                            	echo "<strong>E-mail: </strong>";
	                            	echo $va['peremail']."&nbsp;&nbsp;&nbsp;";
	                            } ?>
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
<!-- 	                            <?php if($va['perid']){
	                            	echo "<strong>ID Per: </strong>";
	                            	echo $va['perid']."</br>";
	                            } ?> -->
<!--  	                            <?php if($va['pefnom']){
	                            	echo "<strong>Perfil: </strong>";
	                            	echo $va['pefnom']."&nbsp;&nbsp;&nbsp;";
	                            } ?> -->
<!-- 
	                            <?php if($va['envema']==1){ ?>
	                            	<i class="fas fa-envelope" title="Enviar E-mail"></i>&nbsp;&nbsp;&nbsp;
	                            <?php } ?> -->
	                            

	                            <?php if($va['area']){
	                            	echo "<strong>Área: </strong>";
	                            	echo $va['area']."</br>";
	                            } ?>
<!-- 
	                            <?php if($va['tpusu']){
	                            	echo "<strong>Tipo de Usuario: </strong>";
	                            	echo $va['tpusu']."&nbsp;&nbsp;&nbsp;";
	                            } ?> -->
	                            	                            
	                            <?php if($va['carg']){
	                            	echo "<strong>Cargo: </strong>";
	                            	echo $va['carg']."</br>";
	                            } ?>

	                        </small>
	                        <br>
	                        <div class="row">
								<div class="col-md-12" style="text-align: center;">
									<a href="<?=base_url?>dathvper/index&perid=<?=$va['perid'];?>" title="Datos Personales">
				                		<i class="fas fa-address-book fa-2x" style="color: #523178;"></i>
				                	</a>
				                	&nbsp;&nbsp;&nbsp;
				                	<a href="<?=base_url?>dats/index&perid=<?=$va['perid'];?>" title="Educación Superior">
				                		<i class="fas fa-graduation-cap fa-2x" style="color: #523178;"></i>
				                	</a>
				                	&nbsp;&nbsp;&nbsp;
				                	<a href="<?=base_url?>expl/index&perid=<?=$va['perid'];?>" title="Experiencia Laboral">
				                		<i class="fas fa-briefcase fa-2x" style="color: #523178;"></i>
				                	</a>
				                	&nbsp;&nbsp;&nbsp;
				                	<a href="<?=base_url?>segm/index&perid=<?=$va['perid'];?>" title="Condiciones de Salud">
				                		<i class="fas fa-plus-circle fa-2x" style="color: #523178;"></i>
				                	</a>
				                	&nbsp;&nbsp;&nbsp;
				                	<a href="<?=base_url?>percargo/index&perid=<?=$va['perid'];?>" title="Personas a Cargo">
				                		<i class="fas fa-user-circle fa-2x" style="color: #523178;"></i>
				                	</a>
								</div>
							</div>
		                </td>
		                <td>
	                		<?php if($va['tpcto']) echo $va['tpcto']; ?>
		                </td>
		                <td>
		                	<?php if($va['fecinico']) echo $va['fecinico']; ?>
		                </td>
		                <td>
		                	<?php if($va['fecfinco']) echo $va['fecfinco']; ?>
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
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Usuario</th>
	                <th>Tipo Contrato</th>
	                <th>Fecha Inicio</th>
	                <th>Fecha Fin</th>
					<th>Act</th>
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