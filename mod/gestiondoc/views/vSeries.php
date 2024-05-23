<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="../js/gestorarchivo.js"></script>
<script src="../js/sweetalert.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#btnguardarserie').click(function(){			
			agregarArchivosGestor();
		});
	});
</script>





<h2 class="title-c">
	ARCHIVO DE GESTIÓN
</h2>
<br><br><br><br>
<?php 
	$host= $_SERVER["HTTP_HOST"]; //Optiene el host ej http://miweb.com
	$url= $_SERVER["REQUEST_URI"]; // Optiene la url de la pagina actual ej */home
	//echo "http://" . $host . $url; //y aqui regresa http://miweb.com/home
	$dir = "http://" . $host . $url; //y aqui regresa http://miweb.com/home
	//echo $dir;
	//$_SESSION['dir']=$dir;
 ?>




<div class="row">
	<?php if($j>0 && $btn==1): ?>
		<div class="col-sm-4">
			<span class="btn btn-primary btn-block" style="background-color: #523178 !important;" data-toggle="modal" data-target="#modalserie">
				<span class="fas fa-plus-circle"> </span>
				<?=$btnAgregar;?>
			</span>
		</div>	

	<?php endif ?>	

	
	<?php if(isset($cont)){ ?>
		<div class="col-sm-4">
			<a href="<?=base_url?>radica/series">
				<span class="btn btn-info btn-block" style="background-color: #f66f16 !important;">
					<span class="fa fa-arrow-left"></span>
					Dependencias
				</span>
			</a>		
		</div>
		<?php 
			// var_dump($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		 ?>
		<?php //if($cont>3){ ?>
			<div class="col-sm-4">			
				<button class="btn btn-info btn-block" style="background-color: #f66f16 !important;" onClick='history.go(-1);'><span class="fa fa-arrow-up"></span>
					Regresar
				</button>	


			</div>	
		<?php // } ?>		
	<?php } ?>
	
</div>
<br><br>



<?php if (isset($descrip)) { ?>
	<div class="row">
		<div class="col-sm-12">
			<label for="" style="background-color:#523178; color: white; width: 100%; padding: 5px; "><?=$descrip;?>&nbsp;<?=$serie;?></label>
		</div>
	</div>
<?php } ?>

<?php if ($btnAgregar != "Agregar documento(s)"){ ?>
	<div class="row">
		<div class="col-sm-12">
			<table id="example" class="table table-striped table-bordered dterpce " style="width:100%;">
			<!-- <table id="example" class="table table-striped table-bordered dterpce table-dark" style="width:100%;"> -->

			    <thead>
					<tr style="text-align: center !important;">	
						<th></th>									
						<th>CÓDIGO <?=$coltabla;?></th>						
						<th>NOMBRE</th>			
						<!-- <th>AÑOS G.A</th>
						<th>AÑOS A.C</th>
						<th>DFINTRD</th>
						<th></th>
						<th></th>
						<th></th> -->
						<th></th>
					</tr>			
				</thead>

				<tbody>
					
					<?php if(isset($dttipd)){ ?>

						<?php if (isset($_SESSION['expediente'])){
								//unset($_SESSION['expediente']);
							} 
						?>

						<?php if($coltabla=="EXPEDIENTE" AND isset($dttipdEXP)){ ?>
								
							<?php foreach($dttipdEXP as $f): ?>
						
								<tr>						
							
									<td><a href="<?= base_url ?>radica/series&carga=2&id=<?= urlencode($f['id']) ?>&depidexp=<?= urlencode($f['depid']) ?>&seri=<?= urlencode($f['ultserie']) ?>&descrip=<?= urlencode($f['nomar']) ?><?php if (isset($descrip)): echo '&descrip1=' . urlencode($descrip); endif; ?>" title="Abrir">
	                		<i class="fa fa-folder-open" aria-hidden="true"></i>
	                	</a> 
	                </td>						
									<td><?=$f['id'];?></td>

									<td>
										<a href="<?= base_url ?>radica/series&carga=2&id=<?= urlencode($f['id']) ?>&depidexp=<?= urlencode($f['depid']) ?>&seri=<?= urlencode($f['ultserie']) ?>&descrip=<?= urlencode($f['nomar']) ?><?php if (isset($descrip)): echo '&descrip1=' . urlencode($descrip); endif; ?>" style="color: #523178; text-decoration: underline #523178; !important;"><?=$f['nomar'];?></a>
									</td>	
									<td>
										<?php if($_SESSION['pefid']==9){ ?>
	                		<input type="hidden" id="iddoc" value="<?=$f['id'];?>">
		                	<a href="#" title="EliminarX" onclick="elimDoc()" id="btn-elidoc">
		                		<i class="fas fa-trash-alt"></i> 
		                	</a>  
	                	<?php } ?>
									</td>
								</tr>
							<?php endforeach; ?>	
						<?php }else{ ?>
								<?php 
										if ($coltabla=="CARPETA") {
											$carpeta=1;
										}else{
											$carpeta=0;
										}
								?>
							<?php foreach($dttipd as $f): ?>
						
								<tr>
									<td><a href="<?=base_url?>radica/series&carpeta=<?=$carpeta;?>&id=<?=isset($f['id'])?$f['id']:0;?>&seri=<?=$f['doctrd'];?>&descrip=<?=urlencode($f['destrd']);?><?php if (isset($descrip)){ echo '&descrip1='.urlencode($descrip);} ?>" title="Abrir">
					                		<i class="fa fa-folder-open" aria-hidden="true"></i>
					                	</a> 
					                </td>						
									<td><?=$f['doctrd'];?></td>

									<td><a href="<?=base_url?>radica/series&carpeta=<?=$carpeta;?>&id=<?=isset($f['id'])?$f['id']:0;?>&seri=<?=$f['doctrd'];?>&descrip=<?=urlencode($f['destrd']);?><?php if (isset($descrip)){ echo '&descrip1='.urlencode($descrip);} ?>" style="color: #523178; text-decoration: underline #523178; !important;"><?=$f['destrd'];?></a>
									</td>						

					        <!-- <td>
										<a href="" title="Editar">
	                		<i class="fa fa-pencil-square-o"></i> 
	                	</a> 
	                </td>	

					        <td>
										<a href="" title="Descargar">
	                		<i class="fa fa-download"></i> 
	                	</a> 
	                </td>			
									
									<td>
										<a href="" title="Eliminar">
	                		<i class="fas fa-trash-alt"></i> 
	                	</a> 
	                </td> -->
	                <td>

	                
	                	<?php if($_SESSION['pefid']==9 && isset($f['id']) ){ ?>
	                		<input type="hidden" id="iddoc" value="<?=$f['id'];?>">
		                	<a href="#" title="Eliminarc" onclick="elimDoc()">
		                		<i class="fas fa-trash-alt"></i> 
		                	</a>  
	                	<?php } ?>
	                </td>
								</tr>
							<?php endforeach; ?>	
						<?php } ?>
						
					<?php } ?>					
					
				</tbody>
			    <tfoot>
			        
			    </tfoot>
			</table>
		</div>
	</div>

<?php } ?>
<br>

<?php if($btnAgregar == "Agregar Expediente"){ ?>
	<h2 class="title-c">EXPEDIENTES COMPARTIDOS AREA JURÍDICA</h2>
	<br><br><br>
	<div class="row">
		<div class="col-sm-12">
			<table id="example" class="table table-striped table-bordered dterpce " style="width:100%;">
			<!-- <table id="example" class="table table-striped table-bordered dterpce table-dark" style="width:100%;"> -->

			    <thead>
					<tr style="text-align: center !important;">	
						<th></th>									
						<th>CÓDIGO </th>						
						<th>NOMBRE EXPEDIENTE</th>		

						<!-- <th>AÑOS G.A</th>
						<th>AÑOS A.C</th>
						<th>DFINTRD</th>
						<th></th>
						<th></th>
						<th></th> -->
					</tr>			
				</thead>

				<tbody>
					
					<?php if(isset($ExpJurid)){ ?>
						

						<?php if (isset($_SESSION['expediente'])){
								//unset($_SESSION['expediente']);
							} 
						?>

						<?php if($coltabla=="EXPEDIENTE" AND isset($ExpJurid)){ ?>


								
							<?php foreach($ExpJurid as $f): ?>
						
								<tr>
									<td><a href="<?=base_url?>radica/series&carga=2&id=<?=$f['id'];?>&depidexp=<?=$f['depid'];?>&seri=<?=$f['ultserie'];?>&descrip=<?=$f['nomar'];?> <?php if (isset($descrip)){ echo '&descrip1='.$descrip;} ?>" title="Abrir">
					                		<i class="fa fa-folder-open" aria-hidden="true"></i>
					                	</a> 
					                </td>						
									<td><?=$f['id'];?></td>

									<!-- nombre de expediente compartido -->
									<td><a href="<?=base_url?>radica/series&carga=2&id=<?=$f['id'];?>&depidexp=<?=$f['depid'];?>&seri=<?=$f['ultserie'];?>&descrip=<?=$f['nomar'];?> <?php if (isset($descrip)){ echo '&descrip1='.$descrip;} ?>" style="color: #523178; text-decoration: underline #523178; !important;"><?=$f['nomar'];?></a>
									</td>	
								</tr>
							<?php endforeach; ?>	
						<?php }else{ ?>
							<?php foreach($dttipd as $f): ?>

														
								<tr>
									<td><a href="<?=base_url?>radica/series&seri=<?=$f['doctrd'];?>&descrip=<?=$f['destrd'];?> <?php if (isset($descrip)){ echo '&descrip1='.$descrip;}  ?>" title="Abrir">
					                		<i class="fa fa-folder-open" aria-hidden="true"></i>
					                	</a> 
					                </td>						
									<td><?=$f['doctrd'];?></td>

									<td><a href="<?=base_url?>radica/series&seri=<?=$f['doctrd'];?>&descrip=<?=$f['destrd'];?> <?php if (isset($descrip)){ echo '&descrip1='.$descrip;} ?>" style="color: #523178; text-decoration: underline #523178; !important;"><?=$f['destrd'];?></a>
									</td>						

					        <!-- <td>
										<a href="" title="Editar">
	                		<i class="fa fa-pencil-square-o"></i> 
	                	</a> 
	                </td>	

					        <td>
										<a href="" title="Descargar">
	                		<i class="fa fa-download"></i> 
	                	</a> 
	                </td>			
									
									<td>
										<a href="" title="Eliminar">
	                		<i class="fas fa-trash-alt"></i> 
	                	</a> 
	                </td> -->
								</tr>
							<?php endforeach; ?>	
						<?php } ?>
						
					<?php } ?>					
					
				</tbody>
			    <tfoot>
			        
			    </tfoot>
			</table>
		</div>
	</div>
<?php } ?>
	





<?php 

	// var_dump($_SESSION['depid']);
	// die();

 ?>

 <?php if($btnAgregar == "Agregar Expediente"){ ?>

 <?php } ?>

<?php if ($btnAgregar == "Agregar documento(s)"){ ?>

	<?php 
		$getarch = new Radica();	
		$depid = $_SESSION['depid'];	
		$perid = $_SESSION['perid'];
		$perfilAr = $getarch->getPerfil($perid );
		$depidnomAr = $getarch->getDepidNom($depid);
		$k=0;			

		foreach ($perfilAr as $p) {
			if ($p['pefid']=="9") {
				$k=1;
			}
		}

		$k=2;//quitar directorios
		if ($k==1) {

								$year = date("Y");
								$carpet= 'C:/xampp/htdocs/erpc/mod/gestiondoc/archi/';
								//$ruta = '../archi/'.$year;
								$ruta = $carpet;


									function obtener_estructura_directorios($ruta){
								    // Se comprueba que realmente sea la ruta de un directorio
								    if (is_dir($ruta)){
								        // Abre un gestor de directorios para la ruta indicada

								        $gestor = opendir($ruta);
								        // var_dump($gestor);
								        // die();
								        echo "<ul>";

								        // Recorre todos los elementos del directorio
								        while (($archivo = readdir($gestor)) !== false)  {
								                
								            $ruta_completa = $ruta . "/" . $archivo;

								            // Se muestran todos los archivos y carpetas excepto "." y ".."
								            if ($archivo != "." && $archivo != "..") {
								                // Si es un directorio se recorre recursivamente
								                if (is_dir($ruta_completa)) {
								                    echo "<li>" . $archivo . "</li>";
								                    obtener_estructura_directorios($ruta_completa);
								                } else {
								                    //echo "<li>" . $archivo ."-". $ruta_completa	. "</li>";
								                    echo "<li>" . $archivo . "</li>";
								                }
								            }
								        }
								        
								        // Cierra el gestor de directorios
								        closedir($gestor);
								        echo "</ul>";
								    } else {
								        echo "No es una ruta de directorio valida<br/>";
								    }
								  }

								  obtener_estructura_directorios($ruta);

								    ///*******

								    function mostrar_imagenes($ruta){
										    // Se comprueba que realmente sea la ruta de un directorio
										    if (is_dir($ruta)){
										        // Abre un gestor de directorios para la ruta indicada
										        $gestor = opendir($ruta);

										        // Recorre todos los archivos del directorio
										        while (($archivo = readdir($gestor)) !== false)  {
										            // Solo buscamos archivos sin entrar en subdirectorios
										            if (is_file($ruta."/".$archivo)) {
										                echo "<img src='".$ruta."/".$archivo."' width='200px' alt='".$archivo."' title='".$archivo."'>";
										            }            
										        }

										        // Cierra el gestor de directorios
										        closedir($gestor);
										    } else {
										        echo "No es una ruta de directorio valida<br/>";
										    }
										}

										///**********

										// // Ruta de la carpeta en la que se encuentra el archivo desde el que 
										// // se hace esta llamada
										// obtener_estructura_directorios("./");
										// // Ruta de una carpeta que se encuentra dentro de la carpeta en la que
										// // esta el archivo desde el que se hace esta llamada
										// obtener_estructura_directorios("nombre_carpeta");
										// // Ruta de una carpeta que se encuentra en la carpeta padre de la
										// // carpeta en la que esta el archivo desde el que se hace esta llamada
										// obtener_estructura_directorios("../nombre_carpeta");
								
											
		}else{
			
			$getarchi= $getarch->getar($_SESSION['perid'],$_SESSION['depid'],$serie,$carpid);
		}
		//var_dump($carpid);
	 ?> 

	

	<div class="row">
		<div class="col-sm-12">
			<table id="example" class="table table-striped table-bordered dterpce " style="width:100%;">
			<!-- <table id="example" class="table table-striped table-bordered dterpce table-dark" style="width:100%;"> -->

			    <thead>
					<tr style="text-align: center !important;">	
						<th></th>									
						<th>No. SERIE</th>						
						<th>NOMBRE</th>	
						<th>TIPO</th>		
						<th>PESO</th>
						<th>AÑOS G.A</th>
						<th>AÑOS A.C</th>
						<th>D.FIN</th>
						<!-- <th></th>
						<th></th> -->
						<th></th>
					</tr>			
				</thead>

				<tbody>
					
					<?php if(isset($getarchi)){ ?>
						<?php foreach($getarchi as $f): ?>
						
							<tr id="<?='d'.$f['id'];?>">
								<td><a href="">
                		<i class="fa fa-folder-open" aria-hidden="true"></i>
                	</a> 
                </td>						
								<td><?=$f['num'];?></td>

								<td><a href="<?=$f['ruta'];?>" target="_blank"><?=$f['nomserie'];?></a></td>
								<td><?=$f['tipo'];?></td>
								<td><?=$f['peso'].' '.'Kb';?></td>
								<td><?=$f['agentrd'];?></td>
								<td><?=$f['acentrd'];?></td>
								<td><?=$f['dfintrd'];?></td>
								<!-- <td>
									<a href="" title="Activo">
				                		<i class="fas fa-check-circle"></i> 
				                	</a> 
				                </td> -->

				               <!--  <td>
									<a href="" title="Editar">
				                		<i class="fa fa-pencil-square-o"></i> 
				                	</a> 
				                </td>	

				                <td>
									<a href="" title="Descargar">
				                		<i class="fa fa-download"></i> 
				                	</a> 
				                </td>	 -->		
								
								<td>									
									<!-- <a href="<?=base_url?>radica/eliminarDoc&iddoc=<?=$f['id'];?>" title="Eliminar">
                		<i class="fas fa-trash-alt"></i> 
                	</a>   --> 
                	<?php if($_SESSION['pefid']==9){ ?>
                		<input type="hidden" id="iddoc" value="<?=$f['id'];?>">
	                	<a href="#" title="Eliminard" onclick="elimDoc()">
	                		<i class="fas fa-trash-alt"></i> 
	                	</a>  
                	<?php } ?>
                	               	
                </td>
							</tr>
						<?php endforeach; ?>	
					<?php } ?>					
					
				</tbody>
			    <tfoot>
			        
			    </tfoot>
			</table>
		</div>
	</div>


<?php } ?>







<!-- Button trigger modal -->


<!-- Modal 1-->
<div  class="modal fade" id="modalserie" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="title-c" id="exampleModalLabel"><?=$btnAgregar;?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		<form id="frmArchivos" class="m-tb-40" enctype="multipart/form-data">
      			<input type="hidden" value="<?=$serie;?>" id="ultserie" name="ultserie">
      			<input type="hidden" value="<?=$_SESSION['perid'];?>" id="perid" name="perid">
      			<input type="hidden" value="<?=$_SESSION['depid'];?>" id="depid" name="depid"> 
      			<input type="hidden" value="<?=$btnAgregar;?>" id="btnagregar" name="btnagregar">      			
      			<div class="form-group row">
      					<?php 

      						date_default_timezone_set('America/Bogota');
   								//$fecSis = date("Y-m-d H:i:s");
   								$fecSis = date("d-m-Y");

   									//echo $btnAgregar;
      					 ?>

      					 <?php if($btnAgregar=='Agregar documento(s)'){ ?>
      					 		<label for="num" class="col-sm-2 col-form-label">Fecha</label>
								    <div class="col-sm-10">
								    	<input type="date" class="form-control" id="num" name="num" > 
								      
								    </div>

								    <br><br>
								    <label for="num" class="col-sm-2 col-form-label">Cierre</label>
								    <div class="col-sm-10">
								    	<input type="date" class="form-control" id="cierre" name="cierre" > 
								      
								    </div>
      					 <?php }else{ ?>
      					 		<label for="num" class="col-sm-2 col-form-label">Fecha</label>
								    <div class="col-sm-10">
								      <input type="date" class="form-control" id="num" name="num" value="" >
								    </div>
      					 <?php } ?>						    
						</div>

						<input type="hidden" name="carpeta" value="<?=isset($carpeta)?$carpeta:NULL;?>">
						<input type="hidden" name="idexp" value="<?=isset($idexp)?$idexp:NULL;?>">
						<input type="hidden" name="depidexp" value="<?=isset($depidexp)?$depidexp:NULL;?>">
						<input type="hidden" name="carpid" value="<?=isset($carpid)?$carpid:NULL;?>">



						<div class="form-group row">
						    <label for="nomserie" class="col-sm-2 col-form-label">Nombre</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="nomserie" name="nomserie">
						    </div>
						</div> 

						<?php if(!isset($areas3)): ?>					   

						    	<?php if(isset($tipodoc)): ?>
						    		<?php if (count($tipodoc) > 0): ?>
						    			<div class="form-group row">
							    			<label for="tipodoc" class="col-sm-2 col-form-label">TIPO</label>
							    			<div class="col-sm-10">
							    				<select name="tipodoc" id="" class="form-control form-control-sm" style="height: 50px;">
							    					<?php foreach ($tipodoc AS $td): ?>
										      		<option value="<?=$td['codpro']?>"><?=$td['nompro']." - ".$td['codpro']?></option>										      
							    					<?php endforeach ?>
						    			  	</select>
						    			  </div>
											</div> 
						    		<?php endif ?>						    		
						    	<?php endif ?>
						       
						    

							<div class="form-group row">
						    <label for="nomserie" class="col-sm-2 col-form-label">Depende</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="depende" name="depende" value="<?=$serie;?>" readonly>
						    </div>
							</div>

							<?php if ($_SESSION['depid']==1014): ?>

									<div class="form-group row">
								    <label for="asigarea" class="col-sm-2 col-form-label">Asignar Área:</label>
								    <div class="col-sm-10">
								      <select name="asigarea" id="" class="form-control form-control-sm" style="height: 50px;">
							    					<?php foreach ($asigarea AS $are): ?>
										      		<option value="<?=$are['valid']?>"><?=$are['valnom'];?></option>										      
							    					<?php endforeach ?>
						    			</select>
								    </div>
									</div>
								
							<?php endif ?>

							<!-- <div class="form-group row">
						    <label for="nomserie" class="col-sm-4 col-form-label">Permanencia</label>
						    <div class="col-sm-8">
						       <select name="permanencia" id="permanencia" class="form-control form-control-md" style="height: 50px;">
						       		<option value="1"><small>Conservar</small></option>
							      	<option value="2"><small>Eliminar</small></option>
							      </select>
						    </div>
							</div>  -->
						<?php endif ?>
						



						<?php if(isset($areas3)): ?>
							
							<div class="form-group row">
								<label for="nomserie" class="col-sm-2 col-form-label">Áreas</label>
						    <div class="col-sm-10">
						    	<?php foreach ($areas3 AS $a3): ?>
						    		<input type="checkbox" name="areaaso[]" value="<?=$a3['valid'];?>" class="form-check-input" ><?=strtoupper($a3['valnom']);?></input>
						    		<br>
						    	<?php endforeach; ?>
							      <!-- <select name="" id="" class="form-control form-control-sm">
							      	<option value="2">prueba</option>
							      </select> -->

							  </div>
							</div>
						<?php endif; ?>


						<!-- <div class="form-group row">
						    <label for="num" class="col-sm-2 col-form-label">Dfin</label>
						    <div class="col-sm-4">
						      <input type="text" class="form-control" id="dfin" name="dfin">
						    </div>
						</div>  -->
						<?php if($btnAgregar=="Agregar documento(s)"){ ?>  
							<div class="form-group row">
							    <label for="num" class="col-sm-2 col-form-label">Archivo</label>
							    <div class="col-sm-10">
							      <input type="file" class="form-control" id="archivos[]" name="archivos[]" multiple="">
							    </div>
							</div> 
						<?php } ?>   			
      		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-secondary-canalc col-sm-4" data-dismiss="modal" >Cancelar</button>
        <button type="button" class="btn-primary-ccapital col-sm-4" id="btnguardarserie" >Guardar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	function agregarArchivosGestor(){
		var serie = $('#nomserie').val();
		var num = $('#num').val();
		//var dfin = $('#dfin').val();
		var ultserie = $('#ultserie').val();			
		var formData = new FormData(document.getElementById('frmArchivos'));	
		//if (serie=="" || num=="" || dfin=="") {
		if (serie=="" || num=="") {
			swal("","Debe completar los campos","warning");
			return false;
		}else{					
			$.ajax({
				type:"POST",
				//data:"serie="+serie,
				//data:parametros,					
				url:"https://intranet.canalcapital.gov.co/erpc/mod/gestiondoc/views/vSaveSerie.php",
				datatype: "html",
				data: formData,
				cache: false,
				contentType:false,
				processData:false,
				success:function(respuesta){
					respuesta=respuesta.trim();
					console.log(respuesta);
					if(respuesta>0){					

						swal("","Registro agregado correctamente","success");
					}else{
						//console.log(ur);
						// console.log(respuesta);
						swal(":(","Fallo al agregar","error");
					}
				}
			});
		}

	}



	function elimDoc(){
		console.log('as');
		var documento = $("#iddoc").val();
		
    $.ajax({
        type: "POST",
        url: "https://intranet.canalcapital.gov.co/erpc/mod/gestiondoc/views/eliminardoc.php",        
        data: { documento: documento },
       
    }).done(function(res){
       
        var result = JSON.parse(res);

         console.log(result.r);
         if (result.r == 1) {
            swal("","Documento Eliminado","success");
            $("#"+"d"+documento).remove();
                        
         }         
                
    });
	}

</script>



























