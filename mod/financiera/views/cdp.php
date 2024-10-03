<script src="../js/futic.js"></script>
<script src="../js/cdpaux.js"></script>
<script src="../js/cdpmultr.js"></script>
<script src="../js/buscarEmpleado.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../js/sweetalert.min.js"></script>



<script type="text/javascript">
	$(document).ready(function(){
		$('#btnsavegrup').click(function(){			
			savePerfil();
		});

	});
</script>

<?php 
//********************
//********************
//SOLICITUD CDP
//********************
//********************
 ?>

 
<?php if(!isset($_SESSION['newpfin'])&&($solicitud==true)):  ?>
	<h2 class="title-c"> Solicitud CDP </h2><br><br>
	<!-- 	<form class="m-tb-40" action="" method="POST"> -->	

	<?php if(isset($pfinandOne)): ?>
		<?php foreach ($pfinandOne as $pf2){ ?>
			<h4 class="title-c m-tb-40">Editar Registro</h4>
			<br><br><br>			
			<form class="m-tb-40" action="<?=base_url;?>paa/solicdp" method="POST">
				<input type="hidden" name="are" id="are" value="<?=$pf2['area'];?>">
				<input type="hidden" name="iddpa" id="iddpa" value="<?=$pf2['iddpa'];?>">
				<input type="hidden" name="idpaa" id="idpaa" value="<?=$pf2['idpaa'];?>">
				<!-- <input type="text" name="idflu" id="idflu" value="<?=$pf2['idflu'];?>"> -->
				<input type="hidden" class="form-control" name="idpro" value="<?=$pf2['idpro'];?>">
				<input type="hidden" name="tipper" id="tipper" value="0">
				<div class="row">
					<div class="form-group col-md-6">
						<label for="codUNSPSC">Cod. UNSPSC</label>
						<input type="text" class="form-control" id="codUNSPSC" name="codUNSPSC" value="<?=$pf2['unspsc'];?>">

					</div>
					<div class="form-group col-md-6">
						<label for="rubroPre"> Rubro Presupuestal</label>
						<input type="number" class="form-control" id="rubroPre" name="rubroPre" value="<?=$ninipaa.$pf2['codrub'];?>" readonly>

					</div>
					<div class="form-group col-md-12">
						<label for="nombreRubro">Nombre Rubro Presupuestal</label>
						<input type="text" class="form-control" id="nombreRubro" name="nombreRubro" value="<?=$pf2['nomrub'];?>" readonly="">
					</div>
					
					<!-- <div class="form-group col-md-4">						
						<span class="btn btn-primary " style="background-color: #523178 !important;" data-toggle="modal" data-target="#modalserie">
							<span class="fa fa-database"> </span>
								Agregar búsqueda de proveedor
						</span>
					</div> -->


					<!-- <div class="form-group col-md-12">						
						<span class="btn btn-primary btn-block " onclick="myFunction()" style="background-color: #523178 !important;">
							<span class="fa fa-database"> </span>
								Agregar búsqueda de proveedor
						</span>
					</div> -->

					<div class="form-group col-md-6">						
						<span class="btn btn-primary btn-block" onclick="myFunction2()" style="background-color: #0071bc !important;">
							<span class="fa fa-user-plus"> </span>
								Agregar contratista persona natural
						</span>
					</div>

					<div class="form-group col-md-6">						
						<span class="btn btn-primary btn-block" onclick="myFunction3()" style="background-color: #0071bc !important;">
							<span class="fa fa-user-plus"> </span>
								Agregar contratista persona jurídica
						</span>
					</div>
					<br>
					<div class="form-group col-md-12 " style="display:none; background-color:#f8f6f6 !important;" id="myDIV2">
						<br>
						<h4 class="title-c m-tb-40">Persona Natural</h4>
						<br><br>

						<div class="form-row">
			                <!-- <div class="col-md-4 form-group">
			                    <label for="area">Área</label>
			                    <input type="text" class="form-control" id="area" name="area" readonly>
			                </div> -->
			                <div class="col-md-4 form-group">
			                    <label for="num_documento">Número de documento</label>
			                    <input type="number" class="form-control" id="num_documento" name="num_documento">
			                </div>

			                <div class="col-md-4 form-group">
			                    <button type="button" class="btn-secondary-canalc " onclick="buscarEmpleado(1)">Buscar</button>
			                </div>
			                <div class="col-md-4 form-group">
			                    
			                </div>
			            </div>

			            <div  id="dataFuturoCont" style="background-color:#f0ebeb; display:none; width:100%">
			            	<br>
			            	<div class="row">
			            		<div class="col-md-6 ">
					                <label for="nomcontNew">Nombres futuro contratista</label>
					                <input type="text" class="form-control" id="nomcontNew" name="nomcontNew">
					            </div>

					            <div class="col-md-6 ">
					                <label for="apecontNew">Apellidos futuro contratista</label>
					                <input type="text" class="form-control" id="apecontNew" name="apecontNew">
					                <input type="hidden" id="peridNew" name="peridNew">
					                <input type="hidden" id="nodocemp" name="nodocemp">
					            </div>
			            	</div>

			            	<div class="row" id="datosmail">
			            		<div class="col-md-6 form-group">
					                <label for="mailcontNew">Correo Electrónico</label>
					                <input type="text" class="form-control" id="mailcontNew" name="mailcontNew">
					            </div>

					            <div class="col-md-6 form-group">
					                <label for="contracontNew">Contraseña temporal</label>
					                <input type="text" class="form-control" id="contracontNew" name="contracontNew">
					            </div>
			            	</div>		            	
				            
				            <br>
			            </div>
			            
			            <div class="form-group">
			                <br>			                
			                <h6 class="title-c"> Obligaciones:</h6>
			                <br><br>
			                <div class="form-group row">       
						        <div class="col-md-8">
						        	 <label for="obligagen" class="col-form-label">Palabras Clave:</label>
						            <select id="obligagen" name="obligagen" class="form-control" onchange="mostrarObligaciones(this.value);" style="padding: 0px;">
						            	<option value="">Seleccione...</option>
						                <?php foreach ($obligagen as $og) { ?>
						                    <option value="<?= $og['idobliga']; ?>"><?= $og['nom']; ?></option>
						                <?php } ?>
						            </select>
						        </div>

						        <div class="col-md-1" style="margin-top: 10px !important;">
				                    <button type="button" class="btn-secondary-canalc" id="btnguardarserie" data-toggle="modal" data-target="#modalserie2" >+</button> 
				                </div>				               
						    </div>						    

						    <?php 						  
						    	//var_dump($_SESSION['depid']);						    	
						     ?>



						    <!-- <table id="example" class="table table-striped table-bordered driverrhh " style="width:100%;">		
							    <thead>
									<tr style="text-align: center !important;">	
										<th></th>
										<th>Nombre</th>						
										<th>Fecha Creación</th>	
										<th>Acción</th>										
									</tr>			
								</thead>				

									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>									
									</tr>
										
									

								<tbody>
								</tbody>
							</table> -->





						    <div id="obligaciones-container1"></div>
						    <br>
						    <button type="button" class="btn btn-primary" id="agregar-obligacion-general" style="display: none;">Agregar obligación General</button>
						    <br><br>
						    <h6 class="title-c"> Obligaciones Anteriores:</h6>
			                <br><br>

							<button type="button" id="botonAgregar" class="btn btn-primary" onclick="obligacionesAnt()">Agregar Obligaciones Anteriores</button>
							<br><br>
							<input type="hidden" id="oblicargo" name="oblicargo" value="0">			                
						    <div id="obligaciones-container2"></div>

						    <br>
						    <h6 class="title-c"> Obligaciones Nuevas:</h6>
						    <br><br>
			                <div id="obligaciones-container">
			                    <div class="input-group mb-2">
			                        <input type="text" class="form-control" name="obligacionNew[]">
			                        <div class="input-group-append">
			                            <button type="button" class="btn btn-danger eliminar-obligacion">Eliminar</button>
			                        </div>
			                    </div>
			                </div>
			                <button type="button" class="btn btn-primary" id="agregar-obligacion">Agregar obligación</button>
			            </div>

			            <div class="form-group">
			                <label>Estudios</label>
			                <div id="estudios-container">
			                    <div class="input-group mb-2">
			                        <input type="text" class="form-control" name="estudioc[]">
			                        <div class="input-group-append">                           
			                            <button type="button" class="btn btn-danger eliminar-estudio">Eliminar</button>
			                        </div>
			                    </div>
			                </div>
			                <button type="button" class="btn btn-primary" id="agregar-estudio">Agregar estudio</button>
			            </div>

			            <div class="form-group">
			                <label for="experiencia">Experiencia</label>
			                <textarea class="form-control" id="experienciaPN" name="experiencia" rows="3"></textarea>
			            </div>

			            

			            <div class="form-group" style="display: none;">
			            	<h4>Listado de Documentos para Contratar</h4>
						    <div class="row">
						    	<?php if($pernat){ foreach ($pernat as $pnt) { ?>
						    		<div class="form-group col-md-6" style="margin-bottom: 5px;">
							        	<input type="checkbox" name="docpernat[]" value="<?=$pnt['valid'];?>" checked> <small><?=$pnt['valnom'];?></small>
							      	</div>
						    	<?php }} ?>
						    </div>
			            </div>

			            <script>
					        $(document).ready(function() {
					        	// Agregar obligacion general al cargo del area
					        	$("#agregar-obligacion-general").click(function() {
					                $("#obligaciones-container1").append('<div class="input-group mb-2"><input type="text" class="form-control" name="obligacionCargo[]"><div class="input-group-append"><button type="button" class="btn btn-danger eliminar-obligacion-general">Eliminar</button></div></div>');
					            });
					             // Eliminar obligación General
					            $(document).on("click", ".eliminar-obligacion-general", function() {
					                $(this).closest(".input-group").remove();
					            });
					            // Agregar nueva obligación
					            $("#agregar-obligacion").click(function() {
					                $("#obligaciones-container").append('<div class="input-group mb-2"><input type="text" class="form-control" name="obligacionNew[]"><div class="input-group-append"><button type="button" class="btn btn-danger eliminar-obligacion">Eliminar</button></div></div>');
					            });

					            // Eliminar obligación
					            $(document).on("click", ".eliminar-obligacion", function() {
					                $(this).closest(".input-group").remove();
					            });

					            // Agregar nuevo estudio con soporte
					            $("#agregar-estudio").click(function() {
					                $("#estudios-container").append('<div class="input-group mb-2"><input type="text" class="form-control" name="estudioc[]"><div class="input-group-append"><button type="button" class="btn btn-danger eliminar-estudio">Eliminar</button></div></div>');
					            });

					            // Eliminar estudio
					            $(document).on("click", ".eliminar-estudio", function() {
					                $(this).closest(".input-group").remove();
					            });
					        });
					    </script>
					</div>

					<br>

					<div class="form-group col-md-12 " style="display:none;background-color:#f8f6f6 !important;" id="myDIV3" >
						<br>
						<h4 class="title-c m-tb-40">Persona Jurídica</h4>
						<br><br>



						<div class="form-row">		               
			                <div class="col-md-4 form-group">
			                    <label for="num_documento">NIT:</label>
			                    <input type="number" class="form-control" id="nit" name="nit">
			                </div>

			                <div class="col-md-4 form-group">
			                    <button type="button" class="btn-secondary-canalc " onclick="buscarEmpleado(2)">Buscar</button>
			                </div>
			                <div class="col-md-4 form-group">
			                    
			                </div>
			            </div>

			             <div class="form-group" id="divrazon" style="display: none;">
			                <label for="nombre_contratista">Razon Social - Contratista</label>
			                <input type="text" class="form-control" id="razsocial" name="razsocial">
			            </div>




			            <div class="row" id="datosmailpj" style="display: none;">
		            		<div class="col-md-6 form-group">
				                <label for="mailcontNewpj">Correo Electrónico</label>
				                <input type="text" class="form-control" id="mailcontNewpj" name="mailcontNewpj">
				            </div>

				            <div class="col-md-6 form-group">
				                <label for="contracontNewpj">Contraseña temporal</label>
				                <input type="text" class="form-control" id="contracontNewpj" name="contracontNewpj">
				            </div>
		            	</div>	

			            <div class="form-group">
			                <label>Obligaciones</label>			               
			                <div id="obligaciones-container">
			                    <div class="input-group mb-2">
			                        <input type="text" class="form-control" name="obligacion">
			                        <div class="input-group-append">
			                            <button type="button" class="btn btn-danger eliminar-obligacion">Eliminar</button>
			                        </div>
			                    </div>
			                </div>
			                <button type="button" class="btn btn-primary" id="agregar-obligacionPJ">Agregar obligación</button>
			            </div>

			            <div class="form-group">
			                <label>Estudios</label>
			                <div id="estudios-container">
			                    <div class="input-group mb-2">
			                        <input type="text" class="form-control" name="estudio">
			                        <div class="input-group-append">
			                            <input type="file" class="form-control-file" name="soporte">
			                            <button type="button" class="btn btn-danger eliminar-estudio">Eliminar</button>
			                        </div>
			                    </div>
			                </div>
			                <button type="button" class="btn btn-primary" id="agregar-estudioPJ">Agregar estudio</button>
			            </div>

			            <div class="form-group">
			                <label for="experiencia">Experiencia</label>
			                <textarea class="form-control" id="experiencia" name="experiencia" rows="3"></textarea>
			            </div>

			            <div class="form-group">
			                <label for="honorarios">Honorarios</label>
			                <input type="text" class="form-control" id="honorarios" name="honorarios">
			            </div>

						<div class="form-group">
			            	<h4>Listado de Documentos para Contratar</h4>
						    <div class="row">
						    	<?php if($perjur){ foreach ($perjur as $pnt) { ?>
						    		<div class="form-group col-md-6" style="margin-bottom: 5px;">
							        	<input type="checkbox" name="docperjur[]" value="<?=$pnt['valid'];?>" checked> <small><?=$pnt['valnom'];?></small>
							      	</div>
						    	<?php }} ?>
						    </div>
			            </div>
					</div>
					
					<br>
					<div id="myDIV" class="table-responsive" style="display: none;">
					  <table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
						<thead>
				            <tr>
				                <!-- <th>Usuario</th> -->
				                <th>Busqueda</th>
				                <th>Proveedores</th>
				                <th></th>	                       
				            </tr>
				        </thead>
				        <tbody>
				        	<?php if (isset($histo)): ?>
				        		<?php foreach ($histo AS $his): ?>
				        			<tr>
				        				
				        				<td>
					        				<small>
					        					<strong>Fecha:</strong>
					        					<?=$his['fecpb'];?>
					        					<br>
					        					<strong>Usuario:</strong>
					        					<?=$his['fecpb'];?>
					        				</small>
					        				<br>
					        				<small>
					        					<strong>Usuario:</strong>
					        					<?=$his['pernom']." ".$his['perape']?>
					        				</small>
					        				<br>	
					        				<!-- <small>
					        					<strong>prveedores:</strong>
					        					
					        				</small>
					        				<br> -->			        				
					        			</td>
					        			<td>
					        				<?php 
					        					// echo $contprov= count($prov[0]);
					        					// var_dump(count($prov[2]));
					        					// var_dump($prov[2][2]['idprov']);
					        					//die();
					        					$prove2="";

					        					$provv= new Newpaa();
					        					//var_dump($his['idprov']);
					        					$prove2=$provv->busprove($his['idprov']);
					        				 	//var_dump($prove);


					        				 ?>
					        				 <?php $np=1 ?>

					        				 <?php foreach($prove2 AS $pro): ?>	 	
					        				 	<strong>Proveedor: <?=$np?></strong>
					        					<br>
					        					<small>
					        						<strong>Razon Social:</strong><?=$pro['razsoc'].$pro['idprov'];?>
					        						<br>
					        						<strong>Nit:</strong><?=$pro['nit'];?>
					        						<br>
					        						<strong>Dirección:</strong><?=$pro['dir'];?>
					        						<br>
					        						<strong>Teléfono:</strong><?=$pro['tel'];?>
					        						<br>
					        						<strong>Email:</strong><?=$pro['email'];?>	
					        						<br>	
					        					</small>
					        					<small><small>
					        					 		<?php 
							                            	$prom=intval($pro['prome']);
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
							                        </small></small>
							                          <br>   
					        					
					        					<?php $np++; ?>
					        				 <?php endforeach ?>
					        			</td>
					        			<td>
					        				<!-- <i class="fas fa-check-circle" style="color: #523178;" title="Seleccionar"></i> -->
					        				<div class="form-check">
											  <input class="form-check-input" type="radio" name="rad1" id="rad1" value="<?=$his['idpb'];?>">
											  <label class="form-check-label" for="rad1">
											   
											  </label>
											</div>

					        			</td>
				        			</tr>	        			
				        		<?php endforeach ?>
				        		<tr>
			        				<td>Ninguno</td>
			        				<td>Ninguno</td>
			        				<td>
			        					<div class="form-check">
										  <input class="form-check-input" type="radio" name="rad1" id="rad1" value="0">
										  <label class="form-check-label" for="rad1">
										   
										  </label>
										</div>
			        				</td>
			        				

			        			</tr>
				        		
				        	<?php endif ?>
				        	
					        </tbody>				        
						</table>
					</div>	

					<script>
						function myFunction() {
						    var x = document.getElementById("myDIV");
						    var y = document.getElementById("myDIV2");
						    var z = document.getElementById("myDIV3");
						    y.style.display = "none";
						    z.style.display = "none";
						    if (x.style.display === "none") {
						        x.style.display = "block";
						    } else {
						        x.style.display = "none";
						    }
						}

						function myFunction2() {
							var x = document.getElementById("myDIV");
						    var y = document.getElementById("myDIV2");
						    var z = document.getElementById("myDIV3");

						    var divnomcont = document.getElementById("divnomcont");

						    x.style.display = "none";
						    z.style.display = "none";
						    document.getElementById("tipper").value = "2";
						    if (y.style.display === "none") {
						        y.style.display = "block";
						        divnomcont.style.display="none";
						        var nomcontNewVal = $("#nomcontNew").val();
							    var apecontNewVal = $("#apecontNew").val();

							    if (nomcontNewVal && apecontNewVal) {
							        $("#nomcont").val(nomcontNewVal + " " + apecontNewVal);
							    }
						    } else {
						        y.style.display = "none";
						        divnomcont.style.display="block";
						        var nomcontNewVal = $("#nomcontNew").val();
							    var apecontNewVal = $("#apecontNew").val();

							    if (nomcontNewVal && apecontNewVal) {
							        $("#nomcont").val(nomcontNewVal + " " + apecontNewVal);
							    }
						    }
						}

						function myFunction3() {
							var x = document.getElementById("myDIV");
							var y = document.getElementById("myDIV2");
						    var z = document.getElementById("myDIV3");

						    var divnomcont = document.getElementById("divnomcont");

						    x.style.display = "none";
						    y.style.display = "none";
						    document.getElementById("tipper").value = "3";
						    if (z.style.display === "none") {
						        z.style.display = "block";
						        divnomcont.style.display="none";
						        var nomcontNewVal = $("#nomcontNew").val();
							    var apecontNewVal = $("#apecontNew").val();

							    if (nomcontNewVal && apecontNewVal) {
							        $("#nomcont").val(nomcontNewVal + " " + apecontNewVal);
							    }
						    } else {
						        z.style.display = "none";
						        divnomcont.style.display="block";
						        var nomcontNewVal = $("#nomcontNew").val();
							    var apecontNewVal = $("#apecontNew").val();

							    if (nomcontNewVal && apecontNewVal) {
							        $("#nomcont").val(nomcontNewVal + " " + apecontNewVal);
							    }

						    }
						}
					</script>				

					<div class="form-group col-md-12" id="divnomcont">
						<label for="nomcont">Nombre Contratista</label>
						<input type="text" class="form-control" id="nomcont" name="nomcont" value="<?=$pf2['nomcont'];?>">
					</div>
					<div class="form-group col-md-12">
						<label for="objeto">Objeto/Descripción</label>
						<textarea class="form-control" id="objeto" name="objeto" rows="4"><?=$pf2['nobjeto'];?></textarea>

					</div>

					<div class="form-group col-md-12">
						<label for="obobjeto">Observación Objeto</label>
						<textarea class="form-control" id="obobjeto" name="obobjeto" rows="4" style="background-color: #fbf2f5;"></textarea>

					</div>

					<input type="hidden" name="objdpa" value="<?=$pf2['objdpa']?>">
					<input type="hidden" name="inidpa" value="<?=$pf2['inidpa']?>">
					<input type="hidden" name="prodpa" value="<?=$pf2['prodpa']?>">				

					<div class="form-group col-md-6">
						<label for="fechaInicio">Fecha Inicio</label>
						<input type="date" class="form-control" id="fechaInicio" name="fechaInicio" onchange="asigmes()" value="<?=$pf2['fecinidpa'];?>">
					</div>

					<div class="form-group col-md-6">
						<label for="fechaEstimada">Fecha Estimada Final</label>
						<input type="date" class="form-control" id="fechaEstimada" name="fechaEstimada" onchange="asigmes()" value="<?=$pf2['fecfindpa'];?>">
					</div>

					<div class="form-group col-md-4">
						<label for="valorAsignado2">Valor Asignado</label>
						<input type="text" class="form-control" id="valorAsignado2" name="valorAsignado2" onkeyup="asigmes()" onchange="asigmes()" value="<?=$numeroFormateado;?>">
					</div>
					<div class="form-group col-md-4">
						<label for="valorVigencia2" style="color:green; font-weight: bolder;">Valor Disponible</label>
						<input type="text" class="form-control" id="valorVigencia2" name="valorVigencia2" style="color:green; font-weight: bolder;" value="<?=$numeroFormateado;?>" readonly="">
					</div>

					<input type="hidden" name="valorAsignado" id="valorAsignado" value="<?=$pf2['asidpa'];?>">	
					<input type="hidden" name="valorVigencia" id="valorVigencia" value="<?=$pf2['asidpa'];?>">	


					<div class="col-md-4">
						<label for="#">Requiere vigencia Futura</label>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="vigenciaF" id="SI" value="SI"
								<?= $pf2['reqvigf'] == "SI" ? ' checked' : ''; ?>>
							<label class="form-check-label" for="SI">
								SI
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="vigenciaF" id="NO" value="NO" <?= $pf2['reqvigf'] == "NO" ? ' checked' : ''; ?>>
							<label class="form-check-label" for="NO">
								NO
							</label>
						</div>
					</div>

					<!-- ALERTA -->
					<div class="col-md-12">
						<div id="alertdisponible" class="alert alert-danger" role="alert" style="display: none;">							
						  <div>
						    &nbsp;&nbsp; Recuerde que no puede exceder el valor disponible!!
						  </div>
						  <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
						</div>
					</div>

					<!-- FIN ALERTA -->

					<div class="form-group col-md-4">
						<label class="switchBtn">
						    <input type="checkbox" class="form-control" value="pagoman" id="pagoman" name="pagoman" onclick="metodoClick();">
						    <div class="slide round">Modificar Número de Pagos</div>
						</label>
					</div>	

					<div class="w-100"> </div>

					<div class="form-group col-md-3">
						<label for="duracion" id="lduracion">Número Pagos</label>
						<input type="number" class="form-control" id="duracion" name="duracion" onkeyup="asigmes()" onchange="asigmes()"  value="<?=$pf2['nmesdpa'];?>" readonly="">
					</div>					
								

					<div class="form-group col-md-3">
						<label for="primerm" id="lprimerm">Valor Primer mes</label>
						<input type="number" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="primerm" name="primerm" value="<?=$pf2['pmes']?>" >
					</div>

					<div class="form-group col-md-3">
						<label for="ultimom" id="lultimom">Valor último mes</label>
						<input type="number" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="ultimom" name="ultimom" value="<?=$pf2['umes']?>" >
					</div>	

					<div class="form-group col-md-3">
						<label for="valormensual" id="lvalormensual">Valor mensual prom.</label>
						<input type="number" class="form-control" id="valormensual" name="valormensual" value=""  readonly="">
					</div>	
					
					<div class="w-100"> </div>

					<div class="form-group col-md-4" >
						<label for="duracion2" id="lduracion2" style="display: none;">Número Pagos.</label>
						<input type="number" style="display: none;" class="form-control" id="duracion2" name="duracion2" onkeyup="quitar()" onchange="quitar()"  value="1" >
					</div>						
					

					<div class="row form-group col-md-12" id="newpay">
						
					</div>									

					<div class="form-group col-md-4">
						<label for="tipcondpa">Modalidad</label>
						<select id="tipcondpa" name="tipcondpa" class="form-control form-control-sm" style="padding: 0px;" >	
							<?php foreach ($tipocontra as $dat){ ?>
								<option value="<?=$dat['vafid'];?>"  <?= $pf2['tipcondpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group col-md-4">
						<label for="ftefindpa">Fuente de Recursos</label>
						<select id="ftefindpa" name="ftefindpa" class="form-control form-control-sm" onchange="javascript:ovif(this.value);" style="padding: 0px;" >	
							<?php foreach ($fuentes as $dat){ ?>
								<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ftefindpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group col-md-4" id="vif">
						<label for="futic">Resolución FUTIC</label>
						<select id="futic" name="futic" class="form-control form-control-sm" style="padding: 0px;" >	
							<?php foreach ($futic as $dat){ ?>
								<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ft'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
							<?php } ?>
						</select>
					</div>

					<?php 

						if ($pf2['ftefindpa']==653) {
							echo "<script type='text/javascript'>ovif(653);</script>";		
						}else{
							echo "<script type='text/javascript'>ovif(1);</script>";			
						}
						
					 ?>

					<div class="form-group col-md-4">
						<label for="cpc">CPC</label>
						<input type="number" class="form-control" id="cpc" name="cpc" value="<?=$pf2['cpc'];?>">
					</div>

					<div class="form-group col-md-12">
						<label for="observa">Observaciones</label>
						<textarea class="form-control" id="observa" name="observa" rows="4" readonly=""><?=$pf2['observaciones'];?></textarea>
					</div>

					<div class="form-group col-md-12">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered " style="width:100%; font-size: 15px;">
								<thead>
									<tr id="tmeses">
										
									</tr>						
								</thead>
								<tbody>
									<tr id="tvmeses">
										
									</tr>
								</tbody>
								<tfoot>
									<tr id="tfoot">
										
									</tr>
								</tfoot>				
							</table>
						</div>
					</div>
				</div>

			<br><br>

						<div class="row">
				<div class="form-group col-md-6">
					<label for="metadp">Meta</label>
					<select class="form-control form-control-sm" id="metadp" name="metadp" style="padding: 0px;" >
					<?php foreach ($metas as $dtm) { ?>
						<option value="<?=$dtm['vafid'];?>" 
							<?php if($pf2['metadp']==$dtm['vafid']) echo " selected "; ?>
						>
							<?=$dtm['vafnom'];?>
						</option>
					<?php } ?>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label for="resoludp">Resolución</label>
					<select class="form-control form-control-sm" id="resoludp" name="resoludp" style="padding: 0px;" > 
					<?php foreach ($resols as $dtm) { ?>
						<option value="<?=$dtm['vafid'];?>" 
							<?php if($pf2['resoludp']==$dtm['vafid']) echo " selected "; ?>
						>
							<?=$dtm['vafnom'];?>
						</option>
					<?php } ?>
					</select>
				</div>
			</div>
			
			<h4 class="title-c m-tb-40">Unidad Ejecutora</h4>
			<br><br>

			<div class="row">

				<div class="form-group col-md-6">
					<label for="unicontra">Unidad de Contratación</label>
					<input type="text" class="form-control" id="unicontra" name="unicontra" value="<?=$pf2['unidad'];?>">
				</div>

				<div class="form-group col-md-6">
					<label for="ubicacion">Ubicación</label>
					<input type="text" class="form-control" id="ubicacion" name="ubicacion" value="<?=$pf2['ubicacion'];?>">
				</div>

				

				<div class="form-group col-md-6">
					<label for="nombreR">Nombre del solicitante</label>
					<select id="nombreR" name="nombreR" class="form-control form-control-sm" onchange="" style="padding: 0px;" >
						<?php foreach ($ordgas as $ord){ ?>
							
							<option value="<?=$ord['perid'];?>"  <?=isset($pf2) &&  ($ord['perid'])== $pf2['resp'] ? ' selected ' : ''; ?>><?=$ord['pernom']." ".$ord['perape']." (".$ord['valnom'].")";?></option>
						<?php } ?>
					</select>
				</div>

				<div class="form-group col-md-6">
					<label for="norgas">Ordenador del gasto</label>
					<select id="norgas" name="norgas" class="form-control form-control-sm" onchange="" style="padding: 0px;" >
						<?php foreach ($ordgas2 as $ord){ ?>							
							<option value="<?=$ord['perid'];?>"  <?=isset($pf2) &&  ($ord['perid'])== $pf2['ordgas'] ? ' selected ' : ''; ?>><?=$ord['pernom']." ".$ord['perape']." (".$ord['valnom'].")";?></option>
						<?php } ?>
					</select>
				</div>

				<div class="form-group col-md-6">
					<input type="hidden" name="hidpro" id="hidpro" value="<?=$pf2['idpro'];?>">
					<label for="idpro">Proceso CDP:</label>
					<select id="idpro" name="idpro" class="form-control form-control-sm" onchange="" style="padding: 0px;" disabled>	
						<?php foreach ($pcdp as $pcd){ ?>
							
							<option value="<?=$pcd['idpro'];?>"  <?=isset($pf2) &&  ($pcd['idpro'])== $pf2['idpro'] ? ' selected ' : ''; ?>><?=$pcd['nompro'];?></option>
						<?php } ?>
					</select>
				</div>

				<div class="form-group col-md-6">
					<label for="marea">Area Asignada:</label>		
					<select id="marea" name="marea" class="form-control form-control-sm" onchange="" style="padding: 0px;" disabled>	
						<?php foreach ($areas2 as $ar){ ?>
							
							<option value="<?=$ar['valid'];?>"  <?=isset($pf2) &&  ($ar['valid'])== $pf2['area'] ? ' selected ' : ''; ?>><?=$ar['valnom'];?></option>
						<?php } ?>
					</select>
				</div>

				<!-- <div class="form-group col-md-4">
					<label for="telefono">Teléfono</label>
					<input type="number" class="form-control" id="telefono" name="telefono" value="<?=$pf2['celres'];?>">
				</div>

				<div class="form-group col-md-4">
					<label for="email">E-Mail</label>
					<input type="email" class="form-control" id="email" name="email" value="<?=$pf2['mailres'];?>">
				</div> -->
			</div>
											
			<div class="row">
				<div class="col-md-3 text-center">
					<button id="btnsolicitar" class="btn-secondary-canalc">Solicitar</button>
				</div>
				<!-- <div class="col-md-3 text-center">
					<button class="btn-primary-ccapital">Nuevo</button>
				</div>
				<div class="col-md-3 text-center">
					<button class="btn-primary-ccapital">Generar Certificado</button>
				</div>
				 -->
			</div>
		</form>		

		<?php } ?>
	<?php endif; ?>	
	

<?php endif; ?>



































<?php
//********************
//********************
//ESTADO CDP
//********************
//********************
?>





<?php if(!isset($_SESSION['newpfin'])&& $estado==true):  ?>
	
	<h2 class="title-c"> Estado CDP </h2>
	<br><br>
	<h4 class="title-c"> Solicitudes por Dependencia </h4>


	<form class="m-tb-40" action="" method="POST">
	<!-- <form class="m-tb-40" action="<?=base_url;?>/antproy/planes" method="POST"> -->
		<div class="row">				

			<div class="form-group col-md-3">
				<label for="vigencia">Vigencia  <!-- <a href="<?=base_url?>antproy/newpfin" class="fas fa-plus-square" style="color: #523178;"></a> --></label>
				<!-- <?php //$cont = date('Y'); ?> -->
				<select id="sel1" name="vigencia" class="form-control form-control-sm" style="padding: 0px;" >	
					<?php foreach ($pfvig as $pf){ ?>
						<option value="<?=$pf['idpaa'];?>"><?=$pf['idpaa'];?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group col-md-3">
				<label for="nsolicitud">Número de Solicitud  <!-- <a href="<?=base_url?>antproy/newpfin" class="fas fa-plus-square" style="color: #523178;"></a> --></label>
				<!-- <?php //$cont = date('Y'); ?> -->
				<input type="number" id="nsolicitud" name="nsolicitud" class="form-control form-control-sm">
			</div>
			
			<div class="col-md-3">				
				<button class="btn-primary-ccapital">Consultar</button>
			</div>

		</div>
	</form>	
	
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>No. Solicitud</th>
					<th>Objeto</th>					
					<th>Duración</th>
					<th>Valor</th>
					<th>Estado</th>									
					<th>Descargar</th>				
					<th></th>
	            </tr>
	        </thead>
	        <tbody>		        	      	   
	           
	        </tbody>
	        <tfoot>
	             <tr>
	                <th>No. Solicitud</th>
					<th>Objeto</th>					
					<th>Duración</th>
					<th>Valor</th>
					<th>Estado</th>									
					<th>Descargar</th>				
					<th></th>
	            </tr>
	        </tfoot>
	    </table>
		
	</div>

	<div class="row">
		<div class="col-md-3 text-center">
			<button class="btn-secondary-canalc">Regresar</button>
		</div>
		
	</div>

<?php endif; ?>








<?php
//********************
//********************
//APROBACION CDP
//********************
//********************
?>






<?php if(!isset($_SESSION['newpfin'])&& $aprobacion==true):  ?>
	<h2 class="title-c"> Aprobación CDP </h2>

	<form class="m-tb-40" action="" method="POST">
	<!-- <form class="m-tb-40" action="<?=base_url;?>/antproy/planes" method="POST"> -->
		<div class="row">				

			<div class="form-group col-md-3">
				<label for="vigencia">Vigencia  <!-- <a href="<?=base_url?>antproy/newpfin" class="fas fa-plus-square" style="color: #523178;"></a> --></label>
				<!-- <?php //$cont = date('Y'); ?> -->
				<select id="sel1" name="vigencia" class="form-control form-control-sm" style="padding: 0px;" >	
					<?php foreach ($pfvig as $pf){ ?>
						<option value="<?=$pf['idpaa'];?>"><?=$pf['idpaa'];?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group col-md-3">
				<label for="nsolicitud">Número de Solicitud  <!-- <a href="<?=base_url?>antproy/newpfin" class="fas fa-plus-square" style="color: #523178;"></a> --></label>
				<!-- <?php //$cont = date('Y'); ?> -->
				<input type="number" id="nsolicitud" name="nsolicitud" class="form-control form-control-sm">
			</div>
			
			<div class="col-md-3">				
				<button class="btn-primary-ccapital">Consultar</button>
			</div>

		</div>
	</form>	

	
	<h3 class="title-c"> Listado Solicitudes Pendientes </h3>

	<br><br>

	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>No. Solicitud</th>
					<th>Objeto</th>					
					<th>Duración</th>
					<th>Valor</th>
					<th>Estado</th>									
					<th>Cargar</th>				
					<th></th>						
	            </tr>
	        </thead>
	        <tbody>

	        </tbody>
	        <tfoot>
	             <tr>
	                <th>No. Solicitud</th>
					<th>Objeto</th>					
					<th>Duración</th>
					<th>Valor</th>
					<th>Estado</th>									
					<th>Cargar</th>				
					<th></th>						
	            </tr>
	        </tfoot>
	    </table>
		
	</div>

	<!-- <h4 class="title-c m-tb-40">Agregar Registro</h4> -->
	
	<!-- <form class="m-tb-40" action="<?=base_url;?>paa/editpaa" method="POST">	 -->
	<form class="m-tb-40" action="<?=base_url;?>/antproy/insAntep"  method="POST">

		<div class="row">

			<div class="form-group col-md-12">
				<label for="areas">Areas</label>
				<?php if($_SESSION["pefid"]==21 OR $_SESSION["pefid"]==34){ ?>
					<?php //$areas=Utils::areasu($_SESSION['consultado']); ?>
					<select id="areas" name="areas" readonly="" class="form-control" style="padding: 0px;" >

						<?php $areas=Utils::areasu($_SESSION['consultado']); ?>	
						<?php foreach ($areas as $pf){ ?>
							

							<option value="<?=$pf['valid'];?>" <?=$pf['valid']==$_SESSION['depid'] ? ' selected ' : ''; ?>>
								<?=$pf['valnom'];?>
								
							</option>								
							
						<?php } ?>
					</select>
				<?php }else{ ?>
					<input type="hidden" name="areas" value="<?=$_SESSION['depid'];?>">
					<input type="text" class="form-control" value="<?=$_SESSION['nomarea'];?>" readonly>
				<?php } ?>

				
				
			</div>

		
			<div class="form-group col-md-6">
				<label for="codUNSPSC">Cod. UNSPSC</label>
				<input type="text" class="form-control" id="codUNSPSC" name="codUNSPSC" required="" value="<?=isset($pf2) && $pf2['unspsc'] ? $pf2['unspsc'] : '' ;?>" readonly="">

			</div>
			<div class="form-group col-md-6">
				<label for="rubroPre"> Rubro Presupuestal</label>
				<input type="number" class="form-control" id="rubroPre" name="rubroPre" value="<?=$ninipaa.$pf2['codrub'];?>" readonly>

			</div>
			<div class="form-group col-md-12">
				<label for="nombreRubro">Nombre Rubro Presupuestal</label>
				<input type="text" class="form-control" id="nombreRubro" name="nombreRubro" readonly="">

			</div>
			<div class="form-group col-md-12">
				<label for="nomcont">Nombre Contratista</label>
				<input type="text" class="form-control" id="nomcont" name="nomcont" readonly="">
			</div>
			<div class="form-group col-md-12">
				<label for="objeto">Objeto/Descripción</label>
				<textarea class="form-control" id="objeto" name="objeto" rows="4" required="" readonly=""></textarea>
			</div>
			

			<?php if($_SESSION["pefid"]==21 OR $_SESSION["pefid"]==34){ ?>
				<div class="form-group col-md-12">
					<label for="objdpa">Objetivo</label>							

					<select id="objdpa" name="objdpa" class="form-control form-control-sm" style="padding: 0px;" readonly="">	
						<?php foreach ($objetivos as $dat){ ?>
							<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) && $pf2['objdpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
						<?php } ?>
					</select>
				</div>
			<?php }else{ ?>
				<input type="hidden" name="objdpa" value="36">
			<?php } ?>

			<?php if($_SESSION["pefid"]==21 OR $_SESSION["pefid"]==34){ ?>
				<div class="form-group col-md-12">
					<label for="inidpa">Iniciativa</label>
					<select id="inidpa" name="inidpa" class="form-control form-control-sm" style="padding: 0px;" readonly="">	
						<?php foreach ($iniciativas as $dat){ ?>
							<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['inidpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
						<?php } ?>
					</select>
				</div>
			<?php }else{ ?>
				<input type="hidden" name="inidpa" value="83">
			<?php } ?>

			<?php if($_SESSION["pefid"]==21 OR $_SESSION["pefid"]==34){ ?>
				<div class="form-group col-md-12">
					<label for="prodpa">Proyecto</label>
					<select id="prodpa" name="prodpa" class="form-control form-control-sm" style="padding: 0px;" readonly="">	
						<?php foreach ($proyectos as $dat){ ?>
							<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['prodpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
						<?php } ?>
					</select>
				</div>
			<?php }else{ ?>
				<input type="hidden" name="prodpa" value="418">
			<?php } ?>

			<div class="form-group col-md-6">
				<label for="fechaInicio">Fecha Estimada de Inicio</label>
				<input type="date" class="form-control" id="fechaInicio" name="fechaInicio" onchange="asigmes()" value="<?=$pf2['fecinidpa'];?>" readonly="">
			</div>

			<div class="form-group col-md-6">
				<label for="fechaEstimada">Fecha Estimada Final</label>
				<input type="date" class="form-control" id="fechaEstimada" name="fechaEstimada" onchange="asigmes()" value="<?=$pf2['fecfindpa'];?>" readonly="">
			</div>

			<div class="form-group col-md-4">
				<label for="valorAsignado">Valor Asignado</label>
				<input type="text" class="form-control" id="valorAsignado" name="valorAsignado" onkeyup="asigmes()" onchange="asigmes()" value="" readonly="">
			</div>
			<div class="form-group col-md-4">
				<label for="valorVigencia">Valor Vigencia Actual</label>
				<input type="text" class="form-control" id="valorVigencia" name="valorVigencia" value="" readonly="">
			</div>
			<div class="col-md-4">
				<label for="#">Requiere vigencia Futura</label>
				<!-- <div class="form-check">
					<input class="form-check-input" type="radio" name="vigenciaF" id="SI" value="SI">
					<label class="form-check-label" for="SI">
						SI
					</label>
				</div> -->
				<div class="form-check">
					<input class="form-check-input" type="radio" name="vigenciaF" id="NO" value="NO" checked>
					<label class="form-check-label" for="NO">
						NO
					</label>
				<!-- <div class="form-check">
					<input class="form-check-input" type="radio" name="vigenciaF" id="SI" value="SI"
						<?=isset($pf2) && $pf2['reqvigf'] == "SI" ? ' checked' : ''; ?>>
					<label class="form-check-label" for="SI">
						SI
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="vigenciaF" id="NO" value="NO" <?=isset($pf2) &&  $pf2['reqvigf'] == "NO" ? ' checked' : ''; ?>>
					<label class="form-check-label" for="NO">
						NO
					</label> -->
				</div>
			</div>

			<div class="form-group col-md-3">
				<label for="duracion">Número de Pagos</label>
				<input type="number" class="form-control" id="duracion" name="duracion" onkeyup="asigmes()" onchange="asigmes()" value="" readonly="">
			</div>

			<div class="form-group col-md-3">
				<label for="primerm" id="lprimerm">Valor Primer mes</label>
				<input type="number" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="primerm" name="primerm" value="" readonly="">
			</div>

			<div class="form-group col-md-3">
				<label for="ultimom" id="lultimom">Valor último mes</label>
				<input type="number" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="ultimom" name="ultimom" value="" readonly="">
			</div>	

			<div class="form-group col-md-3">
				<label for="valormensual" id="lvalormensual">Valor mensual prom.</label>
				<input type="number" class="form-control" id="valormensual" name="valormensual" value=""  readonly="">
			</div>								

			<div class="form-group col-md-6">
				<label for="tipcondpa">Modalidad</label>
				<select id="tipcondpa" name="tipcondpa" class="form-control form-control-sm" style="padding: 0px;" readonly="">	
					<?php foreach ($tipocontra as $dat){ ?>
						<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['tipcondpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group col-md-6">
				<label for="ftefindpa">Fuente de Recursos</label>
				<select id="ftefindpa" name="ftefindpa" class="form-control form-control-sm" style="padding: 0px;" readonly="" >	
					<?php foreach ($fuentes as $dat){ ?>
						<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ftefindpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group col-md-6">
				<label for="numbog">Número CDP BOG</label>
				<input type="number" id="numbog" name="numbog" class="form-control form-control-sm">
			</div>

			<div class="form-group col-md-6">
				<label for="docbog">Anexar Documento</label>
				<input type="file" id="docbog" name="docbog" class="form-control form-control-sm">
			</div>

			<br>
			
		<!-- </div>

			<h4 class="title-c m-tb-40">Proyección de Inversión</h4>
			<br>
			<br>

			<div class="table-responsive">
				<table id="example2" class="table table-striped table-bordered " style="width:100%; font-size: 15px;">
					<thead>
						<tr id="tmeses">
							
						</tr>						
					</thead>
					<tbody>
						<tr id="tvmeses">
							
						</tr>
					</tbody>
					<tfoot>
						<tr id="tfoot">
							
						</tr>
					</tfoot>				
				</table>
			</div>							
		

		</div> -->

			<br><br>
			
			<h4 class="title-c m-tb-40">Observaciones:</h4>
			<br><br>

			<textarea class="form-control" id="observaciones" name="observaciones" rows="4" required="" readonly=""></textarea>
			
		</div>	

		<div class="row">
			<div class="col-md-3 text-center">
				<button class="btn-primary-ccapital">Aprobar Solicitud</button>
			</div>
			<div class="col-md-3 text-center">
				<button class="btn-secondary-canalc">Descargar CDP</button>
			</div>			
			<div class="col-md-3 text-center">
				<button class="btn-secondary-canalc">Cancelar</button>
			</div>
			<!-- <div class="col-md-3 text-center">
				<button class="btn-primary-ccapital">Nuevo</button>
			</div>
			<div class="col-md-3 text-center">
				<button class="btn-primary-ccapital">Generar Certificado</button>
			</div>
			 -->
		</div>
	</form>
<?php endif; ?>





<?php
//********************
//********************
//HISTORIAL CDP
//********************
//********************
?>







<?php if(!isset($_SESSION['newpfin'])&& $historial==true):  ?>
	<h2 class="title-c"> Historial CDP </h2>


	<!-- <form class="m-tb-40" action="<?=base_url;?>/antproy/planes" method="POST"> -->
	<form class="m-tb-40" action="" method="POST">
		<div class="row">				

			<div class="form-group col-md-3">
				<label for="vigencia">Vigencia  <!-- <a href="<?=base_url?>antproy/newpfin" class="fas fa-plus-square" style="color: #523178;"></a> --></label>
				<!-- <?php //$cont = date('Y'); ?> -->
				<select id="sel1" name="vigencia" class="form-control form-control-sm" style="padding: 0px;" >	
					<?php foreach ($pfvig as $pf){ ?>
						<option value="<?=$pf['idpaa'];?>"><?=$pf['idpaa'];?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group col-md-3">
				<label for="nsolicitud">Número de Solicitud  <!-- <a href="<?=base_url?>antproy/newpfin" class="fas fa-plus-square" style="color: #523178;"></a> --></label>
				<!-- <?php //$cont = date('Y'); ?> -->
				<input type="number" id="nsolicitud" name="nsolicitud" class="form-control form-control-sm">
			</div>
			
			<div class="col-md-3">				
				<button class="btn-primary-ccapital">Consultar</button>
			</div>

		</div>
	</form>	

	<br>

	
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>No. Solicitud</th>
					<th>Objeto</th>					
					<th>Duración</th>
					<th>Valor</th>
					<th>Dependencia</th>
					<th>Seleccionar</th>							
					<th></th>
	            </tr>
	        </thead>
	        <tbody>		        	  	   
	           
	        </tbody>
	        <tfoot>
	             <tr>
	               <th>No. Solicitud</th>
					<th>Objeto</th>					
					<th>Duración</th>
					<th>Valor</th>
					<th>Dependencia</th>
					<th>Seleccionar</th>							
					<th></th>					
	            </tr>
	        </tfoot>
	    </table>
		
	</div>

	
	<div class="row">
		<div class="col-md-3 text-center">
			<button class="btn-primary-ccapital">Imprimir CDP</button>
		</div>
		<div class="col-md-3 text-center">
			<button class="btn-primary-ccapital">Descargar CDP</button>			</div>
		
		<div class="col-md-3 text-center">
			<button class="btn-secondary-canalc">Cancelar</button>
		</div>
		<!-- <div class="col-md-3 text-center">
			<button class="btn-primary-ccapital">Nuevo</button>
		</div>
		<div class="col-md-3 text-center">
			<button class="btn-primary-ccapital">Generar Certificado</button>
		</div>
		 -->
	</div>
	

<?php endif; ?>



<!-- Modal 1-->


<div  class="modal fade"  id="modalserie" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content" style="width: 150%;">
      <div class="modal-header">
        <h5 class="title-c" id="exampleModalLabel">Seleccionar Búsqueda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
			<thead>
	            <tr>
	                <!-- <th>Usuario</th> -->
	                <th>Busqueda</th>
	                <th>Proveedores</th>
	                <th></th>	                       
	            </tr>
	        </thead>
	        <tbody>
	        	<?php if (isset($histo)): ?>
	        		<?php foreach ($histo AS $his): ?>
	        			<tr>
	        				
	        				<td>
		        				<small>
		        					<strong>Fecha:</strong>
		        					<?=$his['fecpb'];?>
		        					<br>
		        					<strong>Usuario:</strong>
		        					<?=$his['fecpb'];?>
		        				</small>
		        				<br>
		        				<small>
		        					<strong>Usuario:</strong>
		        					<?=$his['pernom']." ".$his['perape']?>
		        				</small>
		        				<br>	
		        				<small>
		        					<strong>prveedores:</strong>
		        					<?=$his['idprov'];?>
		        				</small>
		        				<br>			        				
		        			</td>
		        			<td>
		        				<?php 
		        					// echo $contprov= count($prov[0]);
		        					// var_dump(count($prov[2]));
		        					// var_dump($prov[2][2]['idprov']);
		        					//die();
		        					$prove2="";

		        					$provv= new Newpaa();
		        					//var_dump($his['idprov']);
		        					$prove2=$provv->busprove($his['idprov']);
		        				 	//var_dump($prove);


		        				 ?>
		        				 <?php $np=1 ?>

		        				 <?php foreach($prove2 AS $pro): ?>	 	
		        				 	<strong>Proveedor: <?=$np?></strong>
		        					<br>
		        					<small>
		        						<strong>Razon Social:</strong><?=$pro['razsoc'].$pro['idprov'];?>
		        						<br>
		        						<strong>Nit:</strong><?=$pro['nit'];?>
		        						<br>
		        						<strong>Dirección:</strong><?=$pro['dir'];?>
		        						<br>
		        						<strong>Teléfono:</strong><?=$pro['tel'];?>
		        						<br>
		        						<strong>Email:</strong><?=$pro['email'];?>		
		        					</small>
		        					<hr>
		        					<?php $np++; ?>
		        				 <?php endforeach ?>
		        			</td>
		        			<td>
		        				<!-- <i class="fas fa-check-circle" style="color: #523178;" title="Seleccionar"></i> -->
		        				<div class="form-check">
								  <input class="form-check-input" type="radio" name="rad1" id="rad1" value="<?=$his['idpb'];?>">
								  <label class="form-check-label" for="rad1">
								   
								  </label>
								</div>

		        			</td>
	        			</tr>	        			
	        		<?php endforeach ?>
	        		<tr>
        				<td>Ninguno</td>
        				<td>Ninguno</td>
        				<td>
        					<div class="form-check">
							  <input class="form-check-input" type="radio" name="rad1" id="rad1" value="0">
							  <label class="form-check-label" for="rad1">
							   
							  </label>
							</div>
        				</td>
        				

        			</tr>
	        		
	        	<?php endif ?>
	        	
	        </tbody>

	        
		</table>
      		
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn-secondary-canalc col-sm-4" data-dismiss="modal" >Cancelar</button>
        <button type="button" class="btn-primary-ccapital col-sm-4" id="btnguardarserie" >Guardar</button>
      </div> -->
    </div>
  </div>
</div>


<!-- Modal 2-->
<div  class="modal fade" id="modalserie2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="title-c" id="exampleModalLabel">Nombre Grupo Contractual</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		<form id="frmSavePerfil" class="" enctype="multipart/form-data">
      			
				<?php 
					date_default_timezone_set('America/Bogota');
						//$fecSis = date("Y-m-d H:i:s");
						$fecSis = date("d-m-Y");
							//echo $btnAgregar;
				 ?>      

				<div class="form-group row">
						<input type="hidden" class="form-control" id="oldcat" name="oldcat">						   	
				    <label for="perfilcon" class="col-sm-2 col-form-label">Nombre</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="perfilcon" name="perfilcon">
				    </div>
				</div> 

      		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-secondary-canalc col-sm-4" data-dismiss="modal" >Cancelar</button>
        <button type="button" class="btn-primary-ccapital col-sm-4" id="btnsavegrup" >Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL2 FIN -->

<script>
	function savePerfil() {
	    var perfilcon = $('#perfilcon').val();                  
	    var formData = new FormData(document.getElementById('frmSavePerfil'));   
	    if (perfilcon == "") {
	        swal("", "Campo nombre vacío", "warning");
	        return false;
	    } else {                    
	        $.ajax({
	            type: "POST",
	            url: "<?php echo base_raiz; ?>mod/financiera/views/vsaveperfil.php",
	            dataType: "html",
	            data: formData,
	            cache: false,
	            contentType: false,
	            processData: false,
	            success: function(respuesta) {
	                respuesta = respuesta.trim();
	                console.log(respuesta);
	                if (respuesta > 0) {
	                    swal("", "Registro agregado correctamente", "success");
	                    // Llamar a la función para actualizar el select
	                    actualizarSelect();
	                    $('#modalserie2').modal('hide'); 
	                } else {
	                    swal(":(", "Fallo al agregar", "error");
	                }
	            }
	        });
	    }
	}

	function actualizarSelect() {
	    $.ajax({	        
	        url: '<?php echo base_raiz; ?>mod/financiera/views/vActualizaperfiles.php', // Ruta al archivo PHP que obtiene las nuevas opciones
	        type: 'GET',
	        dataType: 'json',
	        success: function(response) {
	            // Limpiar las opciones actuales del select
	            $('#obligagen').empty();
	            // Agregar las nuevas opciones al select
	            $.each(response, function(key, value) {
	            	console.log(response);
	                $('#obligagen').append('<option value="' + value.idobliga + '">' + value.nom + '</option>');
	            });
	        },
	        error: function(xhr, status, error) {
	            console.error('Error al obtener nuevas opciones:', status, error);
	        }
	    });
	}

	$('#modalserie2').on('hidden.bs.modal', function () {
	    // Llamar a la función para actualizar el select cuando se cierra la ventana modal
	    actualizarSelect();
	});

</script>
































	