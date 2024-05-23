<h2 class="title-c">Buscar Proveedor</h2>
<br>

<a href="<?=base_raiz.'modulo/mod&id=8';?>" class="btn-primary-ccapital btn-block" style="text-align: center;">Volver al PAA. Presupuesto</a>

<div>
	<?php $url_action = base_url."proveedor/buspro"; ?>
	<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<div class="row">	
		<?php if(!isset($pfinand)){ ?>	
			<div class="form-group col-md-4">
				<label for="razsoc">Proveedor</label>
				<input type="text" class="form-control form-control-sm" id="razsoc" name="razsoc" value="<?=$razsoc;?>" />				
			</div>	
		<?php  } ?>	
		<?php if(isset($pfinand)){ ?>	
			<?php 
			// var_dump($pfinand);
			// die();
			 ?>
			<input type="hidden" name="infodetpaa" id="infodetpaa" value="<?=$pfinand[0]['iddpa'];?>">
		<?php  } ?>	

			
			<div class="form-group col-md-4">
				<label for="nomciiu">Servicio <small>(Palabra clave):</small></label>
				<input type="text" class="form-control form-control-sm" id="nomciiu" name="nomciiu" value="<?=$nomciiu;?>" />
		    </div>

		    <div class="form-group col-md-4">
				<label for="nresul">Número máx. de resultados:</label>			
				<select id="nresul" name="nresul" class="form-control form-control-sm" style="padding: 0px;">
					<option  value="1">1</option>
					<option  value="2">2</option>
					<option  value="3">3</option>
					<option  value="4">4</option>
				    <option   selected="selected" value="5">5</option>
				    <option  value="10">10</option>
				    <option  value="15">15</option>
				    <option  value="20">20</option>
				    
				</select>
		    </div>
			
			<div class="form-group col-md-3">
				<button type="submit" class="btn-primary-ccapital btn-block">
					<i class='fa fa-search'></i> Buscar
				</button>
			</div>
			
		</div>
	</form>
	<?php if(isset($cont)){ ?>
		<span>Número de coincidencias en la Base de datos: <strong><?=$cont;?></strong></span>
		<br>
	<?php } ?>
	<?php if(isset($contresul)){ ?>
		<span>Número de registros seleccionados: <strong><?=$contresul;?></strong></span>
		<br>
	<?php } ?>
</div>
<?php if (isset($pfinand)): ?>
	<div style="background-color: #523178; color: white; padding: 10px;">

		<?php foreach($pfinand as $pf){?>
			<small>
				<strong>Objeto: </strong><?=$pf['nobjeto'];?>
				<br>
				<strong>Iddpa: </strong><?=$pf['iddpa'];?>
				<br>
			</small>	

		<?php } ?>		
	</div>
<?php endif ?>

<br>

<?php if(isset($pfinand)){ ?>
	<?php $url_action = base_url."proveedor/salbus"; ?>
	<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
<?php } ?>
	
	<?php if(isset($proveedors)){ ?>
		<div class="table-responsive">
			<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
		        <thead>
		            <tr>
		                <th>Proveedor</th>
		                <th>Servicios</th>
		                <th>Área</th>
		                <th>Palabras Clave:</th>
		                       
		            </tr>
		        </thead>
		        <tbody>
		        	<?php 
		        	if(isset($proveedors) && $cont>0){

		        		for ($i=0;$i<$ct;$i++){ ?>
			            <tr>
			                <td>
		                        <small>
		                            	<big><strong><?=$proveedors[$posmos[$i]]['nit'];?> - <?=$proveedors[$posmos[$i]]['razsoc'];?></strong></big>
			                            <br>
			                            <small>
				                            <strong>Ciudad: </strong><?=$proveedors[$posmos[$i]]['mun']." - ".$proveedors[$posmos[$i]]['det'];?>
				                        	<br>
				                            <strong>Dirección: </strong><?=$proveedors[$posmos[$i]]['dir'];?>
				                            </br>
				                            <strong>Telefono: </strong><?=$proveedors[$posmos[$i]]['tel'];?>
				                            </br>
				                            <strong>E-mail: </strong><?=$proveedors[$posmos[$i]]['email'];?>
				                            <br>
				                            <strong>Idprov: </strong><?=$proveedors[$posmos[$i]]['idprov'];?><br><br>
				                            <?php if(isset($pfinand)){ ?>
				                            	<input type="hidden" name="b[]" value="<?=$proveedors[$posmos[$i]]['idprov'];?>">
				                            <?php } ?>

				                             <?php 
				                            	$prom=intval($proveedors[$posmos[$i]]['prome']);
				                            	$grey="#777575";
				                            	$gold="#f3ca4c";
				                            	$estg=5-$prom;
				                            	// var_dump($prom.$estg);
				                             ?>

				                             <?php if(isset($prom)): ?>
				                             	<?php for ($j=0; $j < $prom; $j++): ?>
					                             	<i class="fa fa-star" style="color: #f3ca4c;"></i>
					                             <?php endfor ?>
					                             <?php for ($k=0; $k < $estg; $k++): ?>
					                             	<i class="fa fa-star" style="color: #777575;"></i>
					                             <?php endfor ?>

				                             <?php endif ?>    
				                            &nbsp;&nbsp;&nbsp;
			                             	<strong><?=round($proveedors[$posmos[$i]]['prome'],2);?></strong> 
				                            
										</small>
		                            <?php //} ?>
		                        </small>
			                </td>
			                <td>
			                	<small>
			                	<?php
			                		$ciius2 = $proveedor->getCiiu($proveedors[$posmos[$i]]["idprov"]);
			                		foreach ($ciius2 as $ci) {
			                			echo $ci['codciiu']." - ".$ci['nomciiu'];
			                			echo "<br>";
			                		}
			                	?>
			                	</small>
			                </td>
			                <td>
			                	<?=$proveedors[$posmos[$i]]['valnom'];?>
			                </td>
			                <td>
			                	<small>
			                		<strong>Palabras clave: </strong> <?=$proveedors[$posmos[$i]]['paclave'];?>
			                	</small>
				                <br>
			                </td>
			               
			            </tr>
			        <?php }} ?>
		        </tbody>
		        <tfoot>
	            	<th>Proveedor</th>
	                <th>Servicios</th>
	                <th>Área</th>
	                <th>Palabras Clave</th>
		        </tfoot>
		    </table>
		</div>
	<?php } ?>

<?php if(isset($pfinand)){ ?>
		<input type="hidden" name="ultima" value="<?=$ultima;?>">
		<?php if (isset($historial)): ?>
			<?php if (isset($proveedors) && $cont>0): ?>					
				<input type="submit" name="btnsalvar" value="Salvar" class="btn btn-success">
			<?php endif ?>			
		<?php endif ?>
		
	</form>

	
	<hr>
	<h2 class="title-c">Historial actual de búsqueda</h2>
	<br><br>

	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>	        	
	        	
	            <tr>
	                <th>Usuario</th>
	                <th>Fecha</th>
	                <th>Busqueda</th>	                       
	            </tr>


	        </thead>
	        <tbody>	        	
	        	
	        	<?php if (isset($historial)): ?>
	        		<?php foreach ($historial AS $hi): ?>
		        		<tr>
			                <td>   
	                            <?=$hi['pernom']." ".$hi['perape'];?>
			                </td>
			                <td>
			                	<?=$hi['fecpb'];?>
			                </td>
			                <td>
			                	<?=$hi['filserv'];?>
			                </td>
			               
			            </tr>
		        	<?php endforeach ?>  	        		
	        	<?php endif ?>
	        	<tr>
	        		<td>
	        			<?php foreach($pfinand as $pf){?>
							<small>
								<strong> Busqueda para el objeto: </strong><?=$pf['nobjeto'];?>
								<br>
								<strong>Iddpa: </strong><?=$pf['iddpa'];?>
								<br>
							</small>	

						<?php } ?>	
	        		</td>
	        		<td></td>
	        		<td></td>
	        		
	        	</tr>
	        	  	
		            
		        
	        </tbody>
	        <tfoot>
            	<th>Usuario</th>
                <th>Fecha</th>
                <th>Busqueda</th>	
                
	        </tfoot>
	    </table>
	</div>
<?php } ?>

	
