<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="js/sweetalert.min.js"></script>
<!-- <script src="../js/gestor.js"></script> -->
<script src="../js/sweetalert.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#btnguardarchi').click(function(){			
			agregarArchivosDrive();
		});

		$('#btnguardarcat').click(function(){				
			agregarCat();
		});

		$('#elimcat').click(function(){					
			eliminarCategoria();
		});

		$('#btneditarcat').click(function(){					
			editarCategoria();
		});

		$('#btncompartir').click(function(){					
			compartirdoc();
		});

		enviarTRD


	});
</script>


<div class="row">
	<div class="col-sm-12">
		<button type="button" class="btn-primary-ccapital col-sm-4" id="btnguardarserie" data-toggle="modal" data-target="#modalserie" >Agregar Carpeta</button> 
		<button type="button" class="btn-primary-ccapital col-sm-4" id="btnguardarserie" data-toggle="modal" data-target="#modalArchivos" >Agregar Archivos</button>
		<br><br>
		<table id="example" class="table table-striped table-bordered driverrhh " style="width:100%;">
		<!-- <table id="example" class="table table-striped table-bordered dterpce table-dark" style="width:100%;"> -->

		    <thead>
				<tr style="text-align: center !important;">	
					<th></th>
					<th>Nombre</th>						
					<th>Fecha Creación</th>	
					<th>Acción</th>										
				</tr>			
			</thead>				

				<?php if(isset($allcat)){ ?>
					<?php foreach($allcat AS $cat){ ?>
						<tr>							
							<td>
							    <?php switch ($cat['tipod']) { 
							        case 1: // Carpeta 
							    ?>			

							    				<?php if(isset($compartidos)){ ?>
							    					<?php if($compartidos==1){ ?>
							    						<a href="<?=base_url?>drive/compartido&idcat=<?=$cat['id'];?>&nomcat=<?=urlencode($cat['nomar']);?>">
							    					<?php }?>	
							    				<?php }else{ ?>
							    						<a href="<?=base_url?>drive/contenido&idcat=<?=$cat['id'];?>&nomcat=<?=urlencode($cat['nomar']);?>">
							    				<?php } ?>
							            <i class="fa fa-folder" style="color: orange;"></i></a>
							    <?php
							            break;
							        case 2: // Word
							    ?>
							            <a href="<?=$cat['ruta'];?>" target="_blank"><i class="fa fa-file-word-o"></i></a>
							    <?php
							            break;
							        case 3: // Excel
							    ?>
							            <a href="<?=$cat['ruta'];?>" target="_blank"><i class="fa fa-file-excel-o" style="color: green;"></i></a>
							    <?php
							            break;
							        case 4: // Pdf
							    ?>
							            <a href="<?=$cat['ruta'];?>" target="_blank"><i class="fa fa-file-pdf-o" style="color: red;"></i></a>
							    <?php
							            break;
							        case 5: // img
							    ?>
							            <a href="<?=$cat['ruta'];?>" target="_blank"><i class="fa fa-file-photo-o" style="color: #0CA397;"></i></a>
							    <?php
							            break;
							        case 6: // Zip
							    ?>
							            <a href="<?=$cat['ruta'];?>" target="_blank"><i class="fa fa-file-zip-o" style="color: #B1158E;"></i></a>
							    <?php
							            break;
							        case 7: // URL video
							    ?>
							            <a href="<?=$cat['ruta'];?>" target="_blank"><i class="fa fa-file-video-o" style="color: #F7471E;"></i></a>
							    <?php
							            break;
							        case 8: // ppt
							    ?>
							            <a href="<?=$cat['ruta'];?>" target="_blank"><i class="fa fa-file-powerpoint-o" style="color: #F6A119;"></i></a>
							    <?php
							            break;
							        case 9: // .avi .mp4
							    ?>
							            <a href="<?=$cat['ruta'];?>" target="_blank"><i class="fa fa-file-movie-o" style="color: #FE4006;"></i></a>
							    
							    <?php
							            break;
							        default:
							            // Código para el caso por defecto
							            // Puedes agregar más contenido HTML o PHP aquí si es necesario
							    ?>
							    				<a href="<?=$cat['ruta'];?>"><i class="fa fa-file" style="color: #0D4094;"></i></a>
							    <?php } ?>           
							</td>


							<td>
									<?php if($cat['tipod']==1){ ?>

										<?php if(isset($compartidos)){ ?>
				    					<?php if($compartidos==1){ ?>
				    						<a href="<?=base_url?>drive/compartido&idcat=<?=$cat['id'];?>&nomcat=<?=urlencode($cat['nomar']);?>">
													<span style="color: #000;"> <b><?=$cat['nomar'];?></b></span>
												</a>	
				    					<?php } ?>
				    				<?php }else{ ?>
				    						<a href="<?=base_url?>drive/contenido&idcat=<?=$cat['id'];?>&nomcat=<?=urlencode($cat['nomar']);?>">
													<span style="color: #000;"> <b><?=$cat['nomar'];?></b></span>
												</a>	
				    				<?php } ?>


																		

									<?php }else{ ?>
										<a href="<?=$cat['ruta'];?>" target="_blank">
											<span style="color: #000;"><?=$cat['nomar'];?></span>
										</a>
										
									<?php } ?>						
								
							</td>
							<td><?=$cat['fsis'];?></td>					
							<td style="text-align: center;">
								<?php if(!isset($compartidos)){ ?>
										<a href="#" title="Compartir" onclick="$('#idcatcomp').val('<?=$cat['id'];?>');"  data-toggle="modal" data-target="#modalserie3">								
										<i class="fas fa-link"></i> 
									</a>
								<?php } ?>
								
								<a href="#" title="Editar" onclick="obtenerCategoria('<?=$cat['id'];?>')"  data-toggle="modal" data-target="#modalserie2">
              		<i class="fas fa-edit"></i> 
              	</a>
								<a href="#" class="elimcat" title="Eliminar" onclick="eliminarCategoria('<?=$cat['id'];?>')">
              		<i class="fas fa-trash-alt"></i> 
              	</a> 
              	<a href="#" title="Enviar TRD" onclick="enviarTRD('<?=$cat['id'];?>')">
              		<i class="fas fa-cloud" style="color:#21DB21;" data-toggle="modal" data-target="#modaltrd"></i> 
              	</a> 
							</td>
						</tr>
					<?php  } ?>
				<?php } ?>
					
				

			<tbody>
			</tbody>
		</table>
	</div>
</div>


<?php if($permisocom==true): ?>
	<br><br>
	<h6 class="title-c m-tb-40">Compartidos conmigo</h6>
	<br><br>


	<table id="example" class="table table-striped table-bordered driverrhh " style="width:100%;">
			
		  <thead>
				<tr style="text-align: center !important;">	
					<th></th>
					<th>Nombre</th>						
					<th>Fecha Creación</th>	
					<th>Acción</th>										
				</tr>			
			</thead>				

				<?php if(isset($carpetas_raiz)){ ?>
					<?php foreach($carpetas_raiz AS $cat){ ?>
						<tr>
														<td>
							    <?php switch ($cat['tipod']) { 
							        case 1: // Carpeta 
							    ?>								    	
							            <a href="<?=base_url?>drive/compartido&idcat=<?=$cat['id'];?>&nomcat=<?=urlencode($cat['nomar']);?>"><i class="fa fa-folder" style="color: orange;"></i></a>
							    <?php
							            break;
							        case 2: // Word
							    ?>
							            <a href="<?=$cat['ruta'];?>" target="_blank"><i class="fa fa-file-word-o"></i></a>
							    <?php
							            break;
							        case 3: // Excel
							    ?>
							            <a href="<?=$cat['ruta'];?>" target="_blank"><i class="fa fa-file-excel-o" style="color: green;"></i></a>
							    <?php
							            break;
							        case 4: // Pdf
							    ?>
							            <a href="<?=$cat['ruta'];?>" target="_blank"><i class="fa fa-file-pdf-o" style="color: red;"></i></a>
							    <?php
							            break;
							        case 5: // img
							    ?>
							            <a href="<?=$cat['ruta'];?>" target="_blank"><i class="fa fa-file-photo-o" style="color: #0CA397;"></i></a>
							    <?php
							            break;
							        case 6: // Zip
							    ?>
							            <a href="<?=$cat['ruta'];?>" target="_blank"><i class="fa fa-file-zip-o" style="color: #B1158E;"></i></a>
							    <?php
							            break;
							        case 7: // URL video
							    ?>
							            <a href="<?=$cat['ruta'];?>" target="_blank"><i class="fa fa-file-video-o" style="color: #F7471E;"></i></a>
							    <?php
							            break;
							        case 8: // ppt
							    ?>
							            <a href="<?=$cat['ruta'];?>" target="_blank"><i class="fa fa-file-powerpoint-o" style="color: #F6A119;"></i></a>
							    <?php
							            break;
							        case 9: // .avi .mp4
							    ?>
							            <a href="<?=$cat['ruta'];?>" target="_blank"><i class="fa fa-file-movie-o" style="color: #FE4006;"></i></a>
							    
							    <?php
							            break;
							        default:
							            // Código para el caso por defecto
							            // Puedes agregar más contenido HTML o PHP aquí si es necesario
							    ?>
							    				<a href="<?=$cat['ruta'];?>"><i class="fa fa-file" style="color: #0D4094;"></i></a>
							    <?php } ?>           
							</td>


							<td>
									<?php if($cat['tipod']==1){ ?>
										<a href="<?=base_url?>drive/compartido&idcat=<?=$cat['id'];?>&nomcat=<?=urlencode($cat['nomar']);?>">
											<span style="color: #000;"> <b><?=$cat['nomar'];?></b></span>
										</a>									

									<?php }else{ ?>
										<a href="<?=$cat['ruta'];?>" target="_blank">
											<span style="color: #000;"><?=$cat['nomar'];?></span>
										</a>
										
									<?php } ?>						
								
							</td>
							<td><?=$cat['fsis'];?></td>					
							<td style="text-align: center;">
								<!-- <a href="#" title="Compartir" onclick="$('#idcatcomp').val('<?=$cat['id'];?>');"  data-toggle="modal" data-target="#modalserie3">								
									<i class="fas fa-link"></i> 
								</a> -->
								<a href="#" title="Editar" onclick="obtenerCategoria('<?=$cat['id'];?>')"  data-toggle="modal" data-target="#modalserie2">
              		<i class="fas fa-edit"></i> 
              	</a>
								<a href="#" class="elimcat" title="Eliminar" onclick="eliminarCategoria('<?=$cat['id'];?>')">
              		<i class="fas fa-trash-alt"></i> 
              	</a> 
							</td>
						</tr>
					<?php  } ?>
				<?php } ?>								

			<tbody>
		</tbody>
	</table>
<?php endif; ?>









<!-- MODAL INICIO -->


<!-- Modal ARCHIVOS-->
<div  class="modal fade" id="modalArchivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="title-c" id="exampleModalLabel">Agregar Documento(s)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form id="frmDocs" class="" enctype="multipart/form-data">
      			
      			<input type="hidden" name="depcat" value="<?=$depcat?>">
						<input type="hidden" name="idcat" value="<?=$idcat;?>">     			
      			<div class="form-group row">
		  					<?php 
		  						date_default_timezone_set('America/Bogota');
										//$fecSis = date("Y-m-d H:i:s");
										$fecSis = date("d-m-Y");
											//echo $btnAgregar;
		  					 ?>      										    
						</div>

							<!-- <div class="form-group row">
								<label for="selectcat" class="col-sm-2 col-form-label">Categorías</label>
								<div class="col-sm-10">
									<select id="selectcat" name="selectcat" class="form-control form-control-sm" style="padding: 0px;" >	
										<?php foreach ($allcat as $c){ ?>
											<option value="<?=$c['id'];?>"><?=$c['nomar'];?></option>
										<?php } ?>
									</select>
								</div>
							</div> -->
								
						<div class="form-group row">
						    <label for="num" class="col-sm-2 col-form-label">Archivo</label>
						    <div class="col-sm-10">
						      <!-- <input type="file" class="form-control" id="archivos[]" name="archivos[]" multiple=""> -->
						      <input type="file" class="form-control" id="archivos" name="archivos[]" multiple="" accept=".doc, .docx, .xls, .xlsx, .pdf, .jpg, .jpeg, .png, .zip, .rar, .ppt, .pptx, .mp4, .avi, .mov" required>
						    </div>
						    <div class="col-sm-10">
						    	<span>.doc, .txt, .docx, .xls, .xlsx, .pdf, .jpg, .jpeg, .png, .zip, .rar, .ppt, .pptx, .mp4, .avi, .mov</span>
						    </div>
						</div> 
      	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-secondary-canalc col-sm-4" data-dismiss="modal" >Cancelar</button>
        <button type="button" class="btn-primary-ccapital col-sm-4" id="btnguardarchi" >Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL ARCHIVOS FIN -->

<!-- Button trigger modal -->


<!-- Modal 1-->
<div  class="modal fade" id="modalserie" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="title-c" id="exampleModalLabel">Agregar Carpeta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		<form id="frmArchivos" class="" enctype="multipart/form-data">
      			
      			<!-- <input type="hidden" value="<?=$btnAgregar;?>" id="btnagregar" name="btnagregar">      			 -->
      			<div class="form-group row">
  					<?php 
  						date_default_timezone_set('America/Bogota');
								//$fecSis = date("Y-m-d H:i:s");
								$fecSis = date("d-m-Y");
									//echo $btnAgregar;
  					 ?>      										    
				</div>
				<input type="hidden" name="depcat" value="<?=$allcat[0]['depcat']?>">
				<input type="hidden" name="idcat" value="<?=$idcat;?>">
				<div class="form-group row">
				    <label for="nomcat" class="col-sm-2 col-form-label">Nombre</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="nomcat" name="nomcat">
				    </div>
				</div> 

      		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-secondary-canalc col-sm-4" data-dismiss="modal" >Cancelar</button>
        <button type="button" class="btn-primary-ccapital col-sm-4" id="btnguardarcat" >Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL FIN -->



<!-- Modal 2-->
<div  class="modal fade" id="modalserie2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="title-c" id="exampleModalLabel">Editar nombre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		<form id="frmArchivosEdit" class="" enctype="multipart/form-data">
      			
      			<input type="hidden" value="<?=$btnAgregar;?>" id="btnagregar" name="btnagregar">   
      			
	  					<?php 
	  						date_default_timezone_set('America/Bogota');
									//$fecSis = date("Y-m-d H:i:s");
									$fecSis = date("d-m-Y");
										//echo $btnAgregar;
	  					 ?>      										    
					

						<div class="form-group row">
								<input type="hidden" class="form-control" id="oldcat" name="oldcat">						   	
						    <label for="edicat" class="col-sm-2 col-form-label">Nombre</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="edicat" name="edicat">
						    </div>
						</div> 

      		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-secondary-canalc col-sm-4" data-dismiss="modal" >Cancelar</button>
        <button type="button" class="btn-primary-ccapital col-sm-4" id="btneditarcat" >Actualizar</button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL2 FIN -->

<!-- Modal 3-->
<div  class="modal fade" id="modalserie3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="title-c" id="exampleModalLabel">Compartir</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		<form id="frmCompartir" class="" enctype="multipart/form-data">
	  					<?php 
	  						date_default_timezone_set('America/Bogota');
									//$fecSis = date("Y-m-d H:i:s");
									$fecSis = date("d-m-Y");
										//echo $btnAgregar;
	  					 ?> 

						<div class="form-group row">
							<label for="selectcat" class="col-sm-2 col-form-label">Seleccione usuarios</label>
							<div class="col-sm-10">
								<input type="hidden" id="idcatcomp" name="idcatcomp">
								<select id="selectOptions" name="selectOptions[]" multiple class="form-control form-control-sm" style="padding: 0px;" >	
									<?php foreach ($allUserArea as $a){ ?>
										<?php if ($userperid != $a['perid']): ?>
											<option value="<?=$a['perid'];?>"><?=$a['pernom']." ".$a['perape'];?></option>
										<?php endif ?>
										
									<?php } ?>
								</select>
							</div>
						</div>

						<style>
						    #selectedOptions {
						        margin-top: 20px;
						        border: 1px solid #ccc;
						        padding: 10px;
						        min-height: 50px;
						    }
						</style>
						<div id="selectedOptions"></div>
						<script>
				        const selectOptions = document.getElementById('selectOptions');
				        const selectedOptionsDiv = document.getElementById('selectedOptions');

				        selectOptions.addEventListener('change', function() {
				            const selectedOptions = Array.from(this.selectedOptions).filter(option => option.selected).map(option => option.textContent);
				            selectedOptionsDiv.textContent = selectedOptions.join('; ');
				        });
				    </script>

      		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-secondary-canalc col-sm-4" data-dismiss="modal" >Cancelar</button>
        <button type="button" class="btn-primary-ccapital col-sm-4" id="btncompartir" >Compartir</button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL3 FIN -->

<!-- Modal TRD-->
<div  class="modal fade" id="modaltrd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="title-c" id="exampleModalLabel">Seleccione TRD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		<form id="frmArchivosEdit" class="" enctype="multipart/form-data">
      			
	  					<?php 
	  						date_default_timezone_set('America/Bogota');
									//$fecSis = date("Y-m-d H:i:s");
									$fecSis = date("d-m-Y");
										//echo $btnAgregar;
	  					 ?>      										    
					
						<div class="form-group row">
														   	
						    <label for="edicat" class="col-sm-12 col-form-label">TRD</label>
						    <div class="col-sm-12">
						      <select name="trd_select" id="trd_select" class="form-control form-control-lg">
					            <?php foreach ($trd AS $t){ ?>
					            	<option value="<?=$t['doctrd']?>"><?=$t['destrd']?></option>
					            <?php } ?>
					        </select>
						    </div>
						</div> 

      		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-secondary-canalc col-sm-4" data-dismiss="modal" >Cancelar</button>
        <button type="button" class="btn-primary-ccapital col-sm-4" id="btneditarcat" >Actualizar</button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL2 TRD -->


<!-- FINAL HTML -->

<script type="text/javascript">

	function agregarArchivosDrive(){
	  //var nomarchi = $('#nomarchi').val();		
		var archivos = $('#archivos')[0].files;
		//console.log (archivos);							
		var formData = new FormData(document.getElementById('frmDocs'));	
		if ((archivos.length < 1)) {
			swal("","Debe seleccionar al menos un archivo","warning");
			return false;
		}else{					
			$.ajax({
				type:"POST",
				//data:"serie="+serie,
				//data:parametros,					
				url:"<?php echo base_raiz; ?>mod/rrhh/views/vsavedoc.php",
				datatype: "html",
				data: formData,
				cache: false,
				contentType:false,
				processData:false,
				success:function(respuesta){
					respuesta=respuesta.trim();
					console.log(respuesta);
					if(respuesta>0){
						swal("","Registro agregado correctamente","success")
							.then(function () {
			                    // Cerrar la ventana modal
			                    $('#modalArchivos').modal('hide');                    
			                    // Obtener la URL actual
			                    var currentUrl = window.location.href;
			                    window.location.href = currentUrl;
			                });	
					}else{
						//console.log(ur);
						// console.log(respuesta);
						swal(":(","Fallo al agregar","error");
					}
				}
			});
		}	
	}

	function agregarCat(){
		var cat = $('#nomcat').val();				
		var formData = new FormData(document.getElementById('frmArchivos'));	
		//if (serie=="" || num=="" || dfin=="") {
		if (cat=="") {
			swal("","Debe completar los campos","warning");
			return false;
		}else{					
			$.ajax({
				type:"POST",
				//data:"serie="+serie,
				//data:parametros,					
				url:"<?php echo base_raiz; ?>mod/rrhh/views/vsavecat.php",
				datatype: "html",
				data: formData,
				cache: false,
				contentType:false,
				processData:false,
				success:function(respuesta){
					respuesta=respuesta.trim();
					console.log(respuesta);
					if(respuesta>0){			
						swal("","Registro agregado correctamente","success")
								.then(function () {
                    // Cerrar la ventana modal
                    $('#modalserie').modal('hide');
                    // Redireccionar a 
                    //window.location.href = "<?php echo base_raiz; ?>mod/rrhh/drive/categorias";
                    var currentUrl = window.location.href;
                    window.location.href = currentUrl;
                });	
					}else{
						//console.log(ur);
						// console.log(respuesta);
						swal(":(","Fallo al agregar","error");
					}
				}
			});
		}
	}

	function eliminarCategoria(idcategoria){
		let idcat = parseInt(idcategoria);		
		swal({
			titlle: "Esta seguro de eliminar esta categoría?",
			text: "Una vez eliminada no podra recuperarse",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
		    $.ajax({
					type:"POST",											
					url:"<?php echo base_raiz; ?>mod/rrhh/views/vdeleteCat.php",
					//datatype: "html",
					data: "idcat=" + idcat,
					// buttons=true,
					// dangerMode=true,
					
					success:function(respuesta){
						respuesta=respuesta.trim();
						console.log(respuesta);
						if(respuesta>0){	
							swal("","Eliminado con exito!","success")
								.then(function () {		                   
		                    		//window.location.href = "<?php echo base_raiz; ?>mod/rrhh/drive/categorias";
		                    		var currentUrl = window.location.href;
                    				window.location.href = currentUrl;
		                });	
						}else{
							//console.log(ur);
							// console.log(respuesta);
							swal(":(","Fallo al eliminar","error");
						}
					}
				});
		  } 
		});
	}


	function obtenerCategoria(idcategoria){
		let idcat = parseInt(idcategoria);	
		
	    $.ajax({
				type:"POST",											
				url:"<?php echo base_raiz; ?>mod/rrhh/views/vobtcat.php",
				//datatype: "html",
				data: "idcat=" + idcat,
				// buttons=true,
				// dangerMode=true,
				
				success:function(respuesta){
					respuesta=jQuery.parseJSON(respuesta);
					console.log(respuesta);
					$('#oldcat').val(respuesta[0]['id']);
					$('#edicat').val(respuesta[0]['nomar']);												
				}
			});			
	}




	function editarCategoria(){
		var idcatold = $('#oldcat').val();		
		var edicat = $('#edicat').val();			
		var formData = new FormData(document.getElementById('frmArchivosEdit'));	
		//if (serie=="" || num=="" || dfin=="") {
		if (edicat=="") {
			swal("","Debe completar los campos","warning");
			return false;
		}else{					
			$.ajax({
				type:"POST",
				//data:"serie="+serie,
				//data:parametros,					
				//url:"<?php echo base_raiz; ?>mod/rrhh/views/veditcateg.php",				
				url: "<?php echo base_raiz; ?>mod/rrhh/views/veditcateg.php",
				datatype: "html",
				data: formData,
				cache: false,
				contentType:false,
				processData:false,
				success:function(respuesta){
					respuesta=respuesta.trim();
					console.log(respuesta);
					if(respuesta>0){					

						swal("","Registro editado correctamente","success")	
								.then(function () {
		                    // Cerrar la ventana modal
		                    $('#modalserie2').modal('hide');
		                    // Redireccionar a 
		                    //window.location.href = "<?php echo base_raiz; ?>mod/rrhh/drive/categorias";
		                    var currentUrl = window.location.href;
                    		window.location.href = currentUrl;
		                });				
					}else{
						//console.log(ur);
						// console.log(respuesta);
						swal(":(","Fallo al actualizar","error");
					}
				}
			});			
		}
	}


	function compartirdoc(){		
		var opciones = $('#selectOptions').val();				
		var formData = new FormData(document.getElementById('frmCompartir'));	
		//if (serie=="" || num=="" || dfin=="") {
		if (opciones=="") {
			swal("","Debe completar los campos","warning");
			return false;
		}else{					
			$.ajax({
				type:"POST",
				//data:"serie="+serie,
				//data:parametros,					
				url:"<?php echo base_raiz; ?>mod/rrhh/views/vcompartirdoc.php",
				datatype: "html",
				data: formData,
				cache: false,
				contentType:false,
				processData:false,
				success:function(respuesta){
					respuesta=respuesta.trim();
					console.log(respuesta);
					if(respuesta>0){			
						swal("","Elemento compartido correctamente","success")
								.then(function () {
                    // Cerrar la ventana modal
                    $('#modalserie').modal('hide');
                    // Redireccionar a 
                    //window.location.href = "<?php echo base_raiz; ?>mod/rrhh/drive/categorias";
                    var currentUrl = window.location.href;
                    window.location.href = currentUrl;
                });	
					}else{
						//console.log(ur);
						// console.log(respuesta);
						swal(":(","Fallo al compartir","error");
					}
				}
			});
		}
	}







</script>