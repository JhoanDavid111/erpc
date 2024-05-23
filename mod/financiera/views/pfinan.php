<h2 class="title-c">Plan Financiero </h2>
	<form class="m-tb-40" action="<?=base_url;?>/pfinan/planes" method="POST">
		<div class="row">
			<!-- <div class="col-md-3">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="tBusqueda" id="exampleRadios1"
						value="individual" checked>
					<label class="form-check-label" for="exampleRadios1">
						Busqueda Individual
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="tBusqueda" id="exampleRadios2"
						value="todo">
					<label class="form-check-label" for="exampleRadios2">
						Ver todo
					</label>
				</div>
			</div> -->



			<div class="form-group col-md-3">
				<label for="vigencia">Vigencia</label>
				<!-- <?php //$cont = date('Y'); ?> -->
				<select id="sel1" name="vigencia" class="form-control form-control-sm" style="padding: 0px;" >	
					<?php foreach ($pfvig as $pf){ ?>
						<option value="<?=$pf['idpaa'];?>"><?=$pf['idpaa'];?></option>
					<?php } ?>
				</select>	

			</div>
			<!-- <div class="form-group col-md-3">
				<label for="rubro">Rubro</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="rubro" name="rubro">
					<option>Selecciona una Opción...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>

			</div> -->
			<div class="col-md-3">
				<button class="btn-primary-ccapital">Consultar</button>
			</div>

		</div>
	</form>


	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Código</th>
					<th>Nombre Rubro</th>								
					<th>UNSPSC</th>
					<th>Fecha Inicio</th>
					<th>Número meses</th>
					<!-- <th>Tipo Contratación</th>
					<th>Fuente</th> -->
					<th>Asignación</th>
					<th>Valor</th>
					<th>Fecha Fin</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>

	        	<?php if(isset($pfinand)): ?>
	        		<?php foreach ($pfinand as $pf){ ?>
			            <tr>
			                <td><?=$ninipaa.$pf['codrub'];?></td>
			                <td><?=$pf['nomrub'];?></td>				                
			                <td><?=$pf['unspsc'];?></td>
			                <td><?=$pf['fecinidpa'];?></td>
			                <td><?=$pf['nmesdpa'];?></td>
			                <!-- <td><?=$pf['tipcondpa'];?></td>				                
			                <td><?=$pf['ftefindpa'];?></td> -->
			                <td><?=$pf['asidpa'];?></td>
			                <td><?=$pf['valdpa'];?></td>
			                <td><?=$pf['fecfindpa'];?></td>
			                <td>
								<a href="<?=base_url?>pfinan/getPf&codrub=<?=$pf['codrub'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
							</td>
			            </tr>
			        <?php } ?>

	        	<?php endif; ?>

	        	

	        	   
	           
	        </tbody>
	        <tfoot>
	             <tr>
	                <th>Código</th>
					<th>Nombre Rubro</th>								
					<th>UNSPSC</th>
					<th>Fecha Inicio</th>
					<th>Número meses</th>
					<!-- <th>Tipo Contratación</th>
					<th>Fuente</th> -->
					<th>Asignación</th>
					<th>Valor</th>
					<th>Fecha Fin</th>
					<th></th>
	            </tr>
	        </tfoot>
	    </table>
		
	</div>

	<br>

	
	<?php if(isset($pfinand) && isset($epf)): ?>
		
		<!-- <form class="m-tb-40" action="<?=base_url;?>pfinan/editPf" method="POST"> -->
		<form class="m-tb-40" action="" method="POST">
			<h2 class="title-c m-tb-40">Editar Registro</h2>
			<br>
			<br><br>

			<div class="table-responsive">
				<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
			        <thead>
			            <tr>
			                <th>Código</th>												
							<th>Nombre Rubro</th>
							<th>Act</th>
							<th></th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php 
			        	if(isset($rubrosPf)){
			        		foreach ($rubrosPf as $ep){ ?>
				            <tr>
				                <td><?=$ninipaa.$ep['codrub'];?></td>               			                
				                <td><?=$ep['nomrub'];?></td>
				                <td>
				                <?php if($ep['actrub']==1){ ?>
				                	<i class="fas fa-check-circle" style="color: #523178;">
				                		<span style="color: rgba(255,255,255,0);">+</span>
				                	</i>
				                <?php }else{ ?>
									<i class="fas fa-times-circle" style="color: #f00;">
										<span style="color: rgba(255,255,255,0);">-</span>
									</i>
								<?php } ?>
				                </td>
				                <td>
				                	<input type="radio" name="rubro" value="<?=$ep['codrub'];?>" <?= $ep['codrub'] == $editp ? ' checked ' : ''; ?>>
				                </td>
				            </tr>
				        <?php }} ?>
			        </tbody>
			        <tfoot>
			            <tr>
			                <th>Código</th>													
							<th>Nombre Rubro</th>
							<th>Act</th>
							<th></th>
			            </tr>
			        </tfoot>
			    </table>
				
			</div>
			<br><br>

			

			<div class="row">
				<div class="form-group col-md-12">
					<?php if(isset($edit) && isset($rub)){ ?>
						<label for="dependencias">Dependencias</label>
						<br>
						<span id="dependencias" style="font-size: 11px;">
			                <?=isset($dependencias) ? $dependencias:''; ?>
				        </span>
			        <?php } ?>
				</div>



				<div class="form-group col-md-6">
					<label for="objeto">Objetivo Estratégico</label>

					<textarea class="form-control" name="objeto" id="" cols="" rows="4"><?=$pfinand[0]['objdpa']?></textarea>
					<!-- <input type="text" class="form-control"  id="objeto" name="objeto" value="<?=$pfinand[0]['objdpa']?>"> -->
				</div>
				<div class="form-group col-md-6">
					<label for="iniciativa">Iniciativa</label>
					<textarea class="form-control" name="objeto" id="" cols="" rows="4"><?=$pfinand[0]['inidpa']?></textarea>
					<!-- <input type="text" class="form-control"  id="iniciativa" name="iniciativa"  value="<?=$pfinand[0]['inidpa']?>">
 -->
				</div>
				<div class="form-group col-md-6">
					<label for="proyecto">Proyecto</label>
					<input type="text" class="form-control" id="proyecto" name="proyecto" value="<?=$pfinand[0]['prodpa']?>">
				</div>
				<!-- <div class="form-group col-md-6">
					<label for="nombre">Nombre</label>
					<input type="text" class="form-control" id="nombre" name="nombre">
				</div> -->

				<div class="form-group col-md-3">
					<label for="asig">Asignación</label>
					<input type="number" onkeyup="asigmes()" class="form-control" id="asig" name="asig" value="<?=$pfinand[0]['asidpa']?>" >
				</div>

				<div class="form-group col-md-3">
					<label for="uns">UNSPSC</label>
					<input type="number" class="form-control" id="uns" name="uns" value="<?=$pfinand[0]['unspsc']?>" >
				</div>

				<div class="form-group col-md-3">
					<label for="neses">Número de Meses</label>
					<input type="number" onkeyup="asigmes()" class="form-control" id="nmeses" name="nmeses" value="<?=$pfinand[0]['nmesdpa']?>" >
				</div>

				<div class="form-group col-md-3">
					<label for="fechaInicio">Fecha Inicio</label>
					<input type="date" class="form-control" id="fechaInicio" name="fechaInicio" value="<?=$pfinand[0]['fecinidpa']?>">
				</div>

				

				<div class="form-group col-md-3">
					<label for="fehcaFin">Fecha Fin</label>
					<input type="date" class="form-control" id="fehcaFin" name="fehcaFin" value="<?=$pfinand[0]['fecfindpa']?>">
				</div>

				<div class="form-group col-md-3">
					<label for="valormensual">Valor Mensual</label>
					<input type="number"  class="form-control" id="valormensual" name="valormensual" value="<?=$valmes=intval(($pfinand[0]['asidpa'])/($pfinand[0]['nmesdpa']))?>" readonly="">
				</div>


			</div>	

			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>
			<br>		

		</form>
	

		<h2 class="title-c m-tb-40">Información Presupuestal</h2>
		<form class="m-tb-40">
			<div class="row">
				<div class="form-group col-md-4">
					<label for="asignacion">Asignación</label>
					<input type="number" class="form-control" id="asignacion" name="asignacion">

				</div>
				<div class="form-group col-md-4">
					<label for="disponible">Disponible</label>
					<input type="number" class="form-control" id="disponible" name="disponible">

				</div>
				<div class="form-group col-md-4">
					<label for="enCdp">En CDP</label>
					<input type="number" class="form-control" id="enCdp" name="enCdp">

				</div>
				<div class="form-group col-md-4">
					<label for="cdpCom">CDP X Com</label>
					<input type="number" class="form-control" id="cdpCom" name="cdpCom">
				</div>
				<div class="form-group col-md-4">
					<label for="comprometido">Comprometido</label>
					<input type="number" class="form-control" id="comprometido" name="comprometido">
				</div>
				<div class="form-group col-md-4">
					<label for="obligado">Obligado</label>
					<input type="number" class="form-control" id="obligado" name="obligado">
				</div>
			</div>
		</form>

		<h2 class="title-c m-tb-40">Proyección de Inversión</h2>
		<br>
		<br>
		<br>
		<div class="table-responsive">
			<table id="example2" class="table table-striped table-bordered " style="width:100%; font-size: 15px;">
		        <thead>
		            <tr>
		                <th>Ene</th>
		                <th>Feb</th>
		                <th>Mar</th>
		                <th>Abr</th>
		                <th>May</th>
		                <th>Jun</th>
		                <th>Jul</th>
		                <th>Ago</th>
		                <th>Sep</th>
		                <th>Oct</th>
		                <th>Nov</th>
		                <th>Dic</th>								
		            </tr>
		        </thead>
		        <tbody>
		            <tr>
		                <td><?=$valmes;?></td>
		                <td><?=$valmes;?></td>				                
		                <td><?=$valmes;?></td>
		                <td><?=$valmes;?></td>
		                <td><?=$valmes;?></td>			                
		                <td><?=$valmes;?></td>
		                <td><?=$valmes;?></td>
		                <td><?=$valmes;?></td>
		                <td><?=$valmes;?></td>
		                <td><?=$valmes;?></td>
		                <td><?=$valmes;?></td>
		                <td><?=$valmes;?></td> 
		            </tr> 
		        </tbody>
		        <tfoot>
		            <tr>
		                <th>Ene</th>
		                <th>Feb</th>
		                <th>Mar</th>
		                <th>Abr</th>
		                <th>May</th>
		                <th>Jun</th>
		                <th>Jul</th>
		                <th>Ago</th>
		                <th>Sep</th>
		                <th>Oct</th>
		                <th>Nov</th>
		                <th>Dic</th>
		            </tr>
		        </tfoot>
		    </table>
			
		</div>
		<br>
		<br>

		<h2 class="title-c m-tb-40">Contratos Asociados al Rubro</h2>

		<br>
		<br>
		<br>

		<div class="table-responsive">
			<table id="example3" class="table table-striped table-bordered dterpc" style="width:100%;">
			        <thead>
			            <tr>
			                <th>Objeto</th>
			                <th>Val. Contrato</th>
			                <th>Mod. Selección</th>
			                <th>Cod. UNSPSC</th>				                							
			            </tr>
			        </thead>
			        <tbody>
			            <tr>
			                <td>$320,800</td>
			                <td>$320,800</td>				                
			                <td>$320,800</td>
			                <td>$320,800</td> 

			            </tr>
			            <tr>
			                <td>$320,800</td>
			                <td>$320,800</td>				                
			                <td>$320,800</td>
			                <td>$320,800</td>
			               
			            </tr>		           


			           
			        </tbody>
			        <tfoot>
			            <tr>
			                <th>Objeto</th>
			                <th>Val. Contrato</th>
			                <th>Mod. Selección</th>
			                <th>Cod. UNSPSC</th>	
			            </tr>
			        </tfoot>
			</table>
		</div>


		<div class="row">
			<div class="col-md-4 text-center">
				<button class="btn-secondary-canalc">Modificar</button>

			</div>
			<div class="col-md-4 text-center">
				<button class="btn-primary-ccapital" style="">Nuevo</button>
			</div>
			<div class="col-md-4 text-center">
				<button class="btn-cancel-canalc">Salir</button>
			</div>
		</div>

	<?php endif; ?>

	<div class="row" style="margin-top: 60px;">
		<div class="col-md-12">
			<h2 class="title-c m-tb-40">Archivos Plano</h2>
			<div class="row">
				<div class="col-md-8">
					<form action="">
						<div class="row" style="margin-top: 40px;">
							<div class="form-group col-md-6">
								<label for="archivoPlano">Cargar Archivo Plano – Plan Financiero</label>
								<input type="file" class="form-control" id="archivoPlano" name="archivoPlano" required="">

							</div>
							<div class="col-md-6">
								<button class="btn-primary-ccapital">Cargar</button>
							</div>
						</div>						

					</form>
				</div>
				<div class="col-md-4" style="padding-top: 40px;">
						<button class="btn-primary-ccapital">Descargar</button>
				</div>

			</div>
			
		

		</div>
	</div>