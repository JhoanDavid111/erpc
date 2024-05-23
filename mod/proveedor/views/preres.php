<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Pregunta","fas fa-restroom  mr-3","preres/index","300px"); ?>
<div id="inser">

	<?php 
	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Ver Pregunta</h2>
		<?php $url_action = base_url."preres/save&idepr=".$idepr; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo Pregunta</h2>
		<?php $url_action = base_url."preres/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<div class="row">
				<input type="hidden" name="idepr" value="<?=isset($val) ? $val[0]['idepr'] : ''; ?>" readonly />
						
			<div class="form-group col-md-6">
				<label for="txtepr">Pregunta</label>
				<input type="text" class="form-control form-control-sm" id="txtepr" name="txtepr" value="<?=isset($val) ? $val[0]['txtepr'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="tipepr">Tipo pregunta</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="tipepr" name="tipepr">
					<?php if($datipo){ foreach ($datipo as $dtt) { ?>
						<option value='<?=$dtt['valid'];?>' <?php if(isset($val) && $dtt['valid']==$val[0]['tipepr']) echo ' selected '; ?>>
							<?=$dtt['valnom'];?>
						</option>
					<?php }} ?>
				</select>
			</div>		
			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>		
		</div>
	</form>
</div>

<!-- Ver datos -->

<h2 class="title-c">Preguntas</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Pregunta</th>
	                <th>Tipo</th>
	                <th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($preress)){
	        		$i = 1;
	        		foreach ($preress as $va){ ?>
		            <tr>
		                <td>
		                	<span style="opacity: 0;"><?=$va['idepr'];?></span>
		                	<?=$i.' - '.$va['txtepr'];?>
	                        <small><ul>
	                        	<?php
			                		$resp = $preres->getResp($va["idepr"]);
			                		foreach ($resp as $rsp){
			                			echo '<li>';
			                				echo '<a href="eliRsp&idere='.$rsp["idere"].'" onclick="return eliminar();" title="Eliminar" style="margin-left: -15px;">';
			                					echo '<i class="fa fa-times-circle" style="color: #f00;"></i>&nbsp;&nbsp;';
			                				echo '</a>';
			                				echo "<strong>".$rsp['punere']."</strong>";
			                				echo "&nbsp;&nbsp;&nbsp;".$rsp['txtere'];
			                			echo "</li>";

			                		}
			                	?>	                       	
	                        </ul></small>
		                </td>
		                <td>
		                	<small>
		                		<?=$va['valnom'];?>
		                	</small>
		                </td>	                
		                <td>
		                	<a href="<?=base_url?>preres/edit&idepr=<?=$va['idepr'];?>" title="Editar">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                	<br><br>
		                	<!-- Modal Modulos perfil -->
		                	<i class="fa fa-plus-circle" data-toggle="modal" data-target="#myModPg<?=$va['idepr'];?>" title="Nueva respuesta" style="color: #523178;"></i>
		                	&nbsp;&nbsp;&nbsp;
		                	<?php 
		                	echo Utils::modalDosCampos("myModPg", "Agregar Respuesta", $va['idepr'], "Ingrese los siguientes datos:", "Respuesta", base_url."preres/saveResp","txtere","Calificación","punere");
		                	?>
		                </td>
		            </tr>
		        <?php $i++; }} ?>
	        </tbody>
	        <tfoot>
	            	<th>Pregunta</th>
	                <th>Tipo</th>
	                <th></th>
	        </tfoot>
	    </table>
		
	</div>

	<br>

<?php if(isset($edit) && isset($val)): ?>
	<script>ocultar(1,300);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>