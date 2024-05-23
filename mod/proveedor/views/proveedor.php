<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Proveedor","fas fa-restroom  mr-3","proveedor/index","300px"); ?>
<div id="inser">

	<?php 
	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Ver proveedor</h2>
		<?php $url_action = base_url."proveedor/save&idprov=".$idprov; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo Proveedor</h2>
		<?php $url_action = base_url."proveedor/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<div class="row">
				<input type="hidden" name="idprov" value="<?=isset($val) ? $val[0]['idprov'] : ''; ?>" readonly />
						
			<div class="form-group col-md-6">
				<label for="nit">Nit</label>
				<input type="number" class="form-control form-control-sm" id="nit" name="nit" value="<?=isset($val) ? $val[0]['nit'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="razsoc">Razon Social</label>
				<input type="text" class="form-control form-control-sm" id="razsoc" name="razsoc" value="<?=isset($val) ? $val[0]['razsoc'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="ciu">Municipio</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="ciu" name="ciu">
					
				<?php 
				if($datmun){

					foreach ($datmun as $do){ ?>
		                <option value="<?=$do['codm'];?>" 
		                	<?php if(isset($val) && $do['codm']==$val[0]['ciu']) echo ' selected '; ?>
		                >
		                	<?=$do['nomm'];?> - <?=$do['nomd'];?>
		                </option>
		            
		        <?php }} ?>
		    	</select>
		    </div>
			
			<div class="form-group col-md-6" id="go4">
				<label for="dir">Dirección</label>
				<input type="text" class="form-control form-control-sm" id="dir" name="dir" value="<?=isset($val) ? $val[0]['dir'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6" id="go4">
				<label for="tel">Telefono</label>
				<input type="number" class="form-control form-control-sm" id="tel" name="tel" value="<?=isset($val) ? $val[0]['tel'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6" id="go2">
				<label for="email">E-mail</label>
				<input type="email" class="form-control form-control-sm" id="email" name="email" value="<?=isset($val) ? $val[0]['email'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="area">Area</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="area" name="area">
					
				<?php 
				if($datarea){

					foreach ($datarea as $do){ ?>
		                <option value="<?=$do['valid'];?>" 
		                	<?php if(isset($val) && $do['valid']==$val[0]['area']) echo ' selected '; ?>
		                >
		                	<?=strtoupper($do['valnom']);?>
		                </option>
		            
		        <?php }} ?>
		    	</select>
		    </div>
		    <div class="form-group col-md-6">
				<label for="valid">Tipo de Evaluación</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="valid" name="valid">
					
				<?php 
				if($dattipp){

					foreach ($dattipp as $do){ ?>
		                <option value="<?=$do['valid'];?>" 
		                	<?php if(isset($val) && $do['valid']==$val[0]['valid']) echo ' selected '; ?>
		                >
		                	<?=strtoupper($do['valnom']);?>
		                </option>
		            
		        <?php }} ?>
		    	</select>
		    </div>
		    <div class="form-group col-md-6" id="go2">
				<label for="paclave">Palabras Clave <small>(separadas por coma):</small></label>
				<input type="text" class="form-control form-control-sm" id="paclave" name="paclave" value="<?=isset($val) ? $val[0]['paclave'] : ''; ?>" required />
			</div>
			
			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>
			
		</div>
	</form>
</div>

<!-- Ver datos -->

<h2 class="title-c">Proveedor</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Proveedor</th>
	                <th>Área</th>
	                <th>Servicios</th>	
	                <th>Palabras Clave</th>               
	                <th></th>
	                <th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($proveedors)){
	        		foreach ($proveedors as $va){ ?>
		            <tr>
		                <td>
	                        <small>
	                        	<?php //if($va['denano']!=1){ ?>
	                            	<big><strong><?=$va['nit'];?> - <?=$va['razsoc'];?></strong></big>
		                            <br>
		                            <small>
			                            <strong>Ciudad: </strong><?=$va['mun']." - ".$va['det'];?>
			                        	<br>
			                            <strong>Dirección: </strong><?=$va['dir'];?>
			                            </br>
			                            <strong>Telefono: </strong><?=$va['tel'];?>
			                            </br>
			                            <strong>E-mail: </strong><?=$va['email'];?>
			                            <br>
			                            <strong>Tipo de evaluación: </strong><?=$va['tipp'];?>
			                            <br><br>
			                            
			                            <?php 
			                            	$prom=intval($va['prome']);
			                            	$grey="#777575";
			                            	$gold="#f3ca4c";
			                            	$estg=5-$prom;
			                            	// var_dump($prom.$estg);
			                             ?>

			                             <?php if(isset($prom)): ?>
			                             	<?php for ($i=0; $i < $prom; $i++): ?>
				                             	<i class="fa fa-star" style="color: #f3ca4c;"></i>
				                             <?php endfor ?>
				                             <?php for ($i=0; $i < $estg; $i++): ?>
				                             	<i class="fa fa-star" style="color: #777575;"></i>
				                             <?php endfor ?>


			                             <?php endif ?>
			                             &nbsp;&nbsp;&nbsp;
			                             <strong><?=round($va['prome'],2);?></strong>      
			                            <!-- <i class="fa fa-star" style="color: #523178;"></i> -->
									</small>
	                            <?php //} ?>
	                            <!-- <strong>Descripción: </strong><?=$va['are'];?> -->
                            	
	                        </small>


		                </td>
		                <td>
		                	<?=$va['are'];?>
		                </td>
		                <td>
		                	<small>
			                	<?php
			                		$ciius2 = $proveedor->getCiiu($va["idprov"]);
			                		foreach ($ciius2 as $ci) {	                	
			                			echo '<a href="eliciiu&idprov='.$va["idprov"].'&idciiu='.$ci["idciiu"].'" onclick="return eliminar();" title="Eliminar">';
			                				echo '<i class="fa fa-times-circle" style="color: #f00;"></i>&nbsp;&nbsp;';
			                				echo '</a>';
			                			echo $ci['codciiu']." - ".$ci['nomciiu'];
			                			echo "<br>";	                			
			                		}
			                	?>	

		                	</small>
		                </td>
		                	
		                <td>
		                	<small>
		                		<strong>Palabras clave: </strong> <?=$va['paclave'];?>
		                	</small>
			                <br>
		                </td>
		               
		                <td style="text-align: center">
								<?php
									$Ndoc = $proveedor->tdocnit($va['idprov']);
									if($Ndoc && $Ndoc[0]['tdoc']>0){
								?>
										<div class="infomem">
											<?=$Ndoc[0]['tdoc'];?> / <?=$tdo[0]["total"];?>
										</div>

										<i class="fa fa-paperclip fa-2x" style="color:rgba(82,49,120,0.3);" title="<?=$Ndoc[0]['tdoc'];?> Documentos Adjuntos"></i>
										
								<?php
									}
								?>
			                </td>
		                
		                <td>
		                	<a href="<?=base_url?>proveedor/edit&idprov=<?=$va['idprov'];?>" title="Editar">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                	<br><br>
		                	<a href="<?=base_url?>docpro/index&idprov=<?=$va['idprov'];?>" title="Agregar o Ver documentos">
		                		<i class="fa fa-files-o" style="color: #523178;"></i>
		                	</a>
		                	<br><br>
		                	<!-- Modal Modulos perfil -->
		                	<i class="fa fa-plus-circle" data-toggle="modal" data-target="#myModPpr<?=$va['idprov'];?>" title="Asignar Ciiu" style="color: #523178;"></i>
		                	&nbsp;&nbsp;&nbsp;
		                	<?php 
		                	$datos = $proveedor->getCiius();

		                	//$mod = array["id" => "1","nom" => "foo",];
		                	echo Utils::modalSimple("myModPpr", "Agregar Servicio", $va['idprov'], "Seleccione el servicio", "Ciiu - Código", base_url."proveedor/saveCiuu", $datos);
		                	?>

		                	<br>
		                	<a href="<?=base_url?>preres/evalua&idprov=<?=$va['idprov'];?>&tipp=<?=$va['pre'];?>" title="<?=$va['tipp'];?>">
		                		<i class="fa fa-calendar-check-o" style="color: #FF0000;"></i>
		                	</a>
		                	<!-- &nbsp;&nbsp;&nbsp;
		                	<a href="<?=base_url?>preres/evalua&idprov=<?=$va['idprov'];?>&tipp=<?=$dattipp[0]['pre'];?>" title="Evaluar Especial">
		                		<i class="fa fa-calendar-check-o" style="color: #FF0000;"></i>
		                	</a> -->

		                	<br><br>
		                	<a href="<?=base_url?>preres/histo&idprov=<?=$va['idprov'];?>" title="Historial">
		                		<i class="fa fa-history" style="color: #523178;"></i>
		                	</a>




		                <!--	<a href="<?//=base_url?>proveedor/eli&idprov=<?//=$va['idprov'];?>">
		                		<i class="far fa-trash-alt" style="color: #523178;"></i>
		                	</a> -->
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <th>Proveedor</th>
	            <th>Área</th>
                <th>Servicios</th>
                <th>Palabras Clave</th>
                <th></th>  
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