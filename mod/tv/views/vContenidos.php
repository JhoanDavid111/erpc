<?php 

// require_once "models/mongoCrud.php";
// $crud = new Crud();
// $datos = $crud->mostrarDatosContenidos();

// foreach ($datos as $key => $value) {
//     if ($key != '_id') {
//         foreach ($value['contacto'] as $contacto) {
//             if (isset($contacto['telefono'])) {
//                 foreach ($contacto['telefono'] as $telefono) {
//                     echo "Telefono: " . $telefono['tel'] . "<br>";
//                 }
//             }
//         }
//     }
// }

// var_dump($opciones);
// die();
 ?>


<?php 
// foreach ($opciones as $documento) {
//     $formato = $documento["opciones"]["publicos"];
//     foreach ($formato as $valor) {
//         echo $valor . "<br>";
//     }
// }

// die();


 ?>

       

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>





 <?php if(isset($editar)){ ?>

    <?php foreach($getSerie as $document){ ?>
        <?php $id = (string) $document['_id'];  ?>
        <?php foreach($document as $key => $value){ ?>
            <?php if($key == $idserie) { ?>
                <h2 class="title-c m-tb-40">Actualizar Contenido</h2>

                <form class="m-tb-40" action="" method="POST">
                    <div class="row">
                      <div class="form-group col-sm-6">
                         <label for="idserie">Identificador Único:</label>
                         <input type="text" class="form-control form-control-sm" id="idserie" name="idserie" value="<?=$key;?>" required readonly />
                      </div>
                      <div class="form-group col-sm-6">
                         <label for="fechacrea">Fecha Creación:</label>
                         <?php 
                            $fechacreacion = $value["fechacreacion"];
                            $timestamp = strtotime($fechacreacion);
                            $fecha_formateada = date("Y-m-d", $timestamp);
                          ?>
                         <input type="date" class="form-control form-control-sm" id="fechacrea" name="fechacrea"  required value="<?=$fecha_formateada;?>" />
                      </div>
                      <div class="form-group col-sm-6">
                         <label for="ano">Año:</label>
                         <input type="number" class="form-control form-control-sm" id="ano" name="ano"  required value="<?=$value["year"][0];?>" />
                      </div>
                      <div class="form-group col-sm-6">
                         <label for="formato">Formato:</label>                            

                         <select name="formato" id="formato" class="form-control form-control-sm" style="padding: 0px;">
                              <option value="uno">Seleccionar</option>
                               <?php 

                                    foreach ($opciones as $documento) {
                                        $formato = $documento["opciones"]["formato"];
                                        foreach ($formato as $valorformato) {

                                            //echo $valor . "<br>";
                                ?>
                                    <option value="<?=$valorformato;?>"><?=$valorformato;?></option>
                                <?php 

                                        }
                                    }
                                 ?>   
                          </select>         
                      </div>
                     <!--  <div class="form-group col-sm-6">
                         <label for="Autor">Autor:</label>
                         <input type="text" class="form-control form-control-sm" id="Autor" name="Autor "  required value="<?=$value["autor"];?>" />
                      </div> -->
                      <div class="form-group col-sm-6">
                         <label for="pais">País:</label>
                         <input type="text" class="form-control form-control-sm" id="pais" name="pais"  required value="<?=$value["pais"];?>" />
                      </div>

                      <?php 
                        // var_dump($value['sinopsis']);
                        // die();

                       ?>
                      <!-- <div class="form-group col-sm-12">
                        <label for="sinopsis">Sinopsis:</label>
                        <textarea name="sinopsis" id="sinopsis" rows="10" style="width: 100%;" ><?=$value['sinopsis'];?></textarea>
                      </div>
                      <br>
                      <div class="form-group col-sm-6">
                         <label for="licconv">Licencia - Convenio:</label>
                         <input type="text" class="form-control form-control-sm" id="licconv" name="licconv"  required />
                      </div> -->
                      <!-- <div class="form-group col-sm-6">
                         <label for="liceje">Licencia - Eje:</label>
                         <input type="text" class="form-control form-control-sm" id="liceje" name="liceje"  required />
                      </div> -->

                      
                      <div class="form-group col-sm-6"> 
                          <label for="localidades">Ubicación Geográfica</label>
                          <input type="text" class="form-control form-control-sm" id="localidadess" name="localidades" />
                      </div>
                      <div class="form-group col-sm-6">
                          <label for="publico">Público</label>
                          <select name="publico" id="publico" class="form-control form-control-sm" style="padding: 0px;">
                              <option value="uno">Seleccionar</option>
                              
                               <?php 

                                    foreach ($publico as $documento) {
                                        $pub = $documento["opciones"]["publicos"];
                                        foreach ($pub as $v) {

                                            //echo $valor . "<br>";
                                ?>
                                    <option value="<?=$v;?>"><?=$v;?></option>
                                <?php 

                                        }
                                    }
                                 ?>   
                          </select>      
                      </div>
                      <div class="form-group col-sm-6">
                          <label for="publico">Género</label>
                          <select name="genero" id="genero" class="form-control form-control-sm" style="padding: 0px;">
                              <option value="">Seleccionar</option>
                              <option value="Ficción">Ficción</option>
                              <option value="Híbrido">Híbrido</option>
                              <option value="No Ficción">No Ficción</option>
                          </select>
                      </div>
                      <div class="form-group col-sm-6">
                          <label for="temaprincipal">Tema Pricipal</label>
                          <select name="temaprincipal" id="temaprincipal" class="form-control form-control-sm" style="padding: 0px;">
                              <option value="uno">Seleccionar</option>
                              
                               <?php 

                                    foreach ($tempap as $documento) {
                                        $pub = $documento["opciones"]["temaprincipal"];
                                        foreach ($pub as $tp) {

                                            //echo $valor . "<br>";
                                ?>
                                    <option value="<?=$tp;?>"><?=$tp;?></option>
                                <?php 

                                        }
                                    }
                                 ?>   
                          </select>    
                      </div>

                      <div class="form-group col-sm-12">
                          <label for="subtemas">Subtemas</label>
                         <!--  <input type="text" class="form-control form-control-sm" id="subtemas" name="subtemas" /> -->
                         <select name="subtemas" id="subtemas" class="form-control form-control-sm" style="padding: 0px;">
                              <option value="uno">Seleccionar</option>
                              
                               <?php 

                                    foreach ($subtema as $documento) {
                                        $pub = $documento["opciones"]["temaprincipal"];
                                        foreach ($pub as $subtema) {

                                            //echo $valor . "<br>";
                                ?>
                                    <option value="<?=$subtema;?>"><?=$subtema;?></option>
                                <?php 

                                        }
                                    }
                                 ?>   
                          </select>  
                           <script>
                                  var select = document.getElementById("subtemas");
                                  var options = Array.from(select.options);

                                  // Ordenar las opciones alfabéticamente
                                  options.sort(function(a, b) {
                                    return a.text.localeCompare(b.text);
                                  });

                                  // Eliminar todas las opciones existentes
                                  select.innerHTML = "";

                                  // Agregar las opciones ordenadas nuevamente
                                  options.forEach(function(option) {
                                    select.appendChild(option);
                                  });
                            </script>           
                            <textarea id="myTextareaSubtemas"  rows="5" style="width: 100%;"></textarea>

                            <script>
                               var select1 = document.getElementById("subtemas");
                               var textarea1 = document.getElementById("myTextareaSubtemas");

                                select1.addEventListener("change", function() {
                                    var selectedOption1 = select1.options[select1.selectedIndex];
                                    var optionValue1 = selectedOption1.value;
                                    var optionText1 = selectedOption1.text;

                                    // Agregar el valor de la opción al textarea
                                    textarea1.value += optionText1 + ", ";

                                    // Mostrar la opción seleccionada con una "x" para eliminarla
                                    var optionContainer1 = document.createElement("div");
                                    optionContainer1.textContent = optionText1;
                                    optionContainer1.style.display = "inline-block";
                                    optionContainer1.style.marginRight = "5px";

                                    var deleteButton = document.createElement("span");
                                    deleteButton.textContent = "x";
                                    deleteButton.style.cursor = "pointer";
                                    deleteButton.style.color = "red";
                                    deleteButton.style.marginLeft = "5px";
                                    deleteButton.addEventListener("click", function() {
                                      // Eliminar el valor del textarea
                                      textarea1.value = textarea1.value.replace(optionText1 + ", ", "");
                                      // Eliminar la opción seleccionada
                                      optionContainer1.remove();
                                    });

                                    optionContainer1.appendChild(deleteButton);
                                    document.body.appendChild(optionContainer1);
                                });
                            </script>
                      </div>

                      <?php 
                       // var_dump($value['tags'][0]['nombre'] );
                        //var_dump(    $value["materiales"][0]['ruta']);
                       
                        // die();
                       ?>
                       <div class="form-group col-sm-12">
                          <label for="tags">Tags</label>

                          <!-- <input type="text" class="form-control form-control-sm" id="etiquetas" name="etiquetas"> -->
                           <select name="tags" id="tags" class="form-control form-control-sm" style="padding: 0px;">
                              <option value="uno">Seleccionar</option>
                               <?php foreach($getTags as $document): ?> 
                                <?php 
                                     // Obtener el ID del documento
                                    $id = (string) $document['_id'];
                                 ?>

                                 <?php foreach($document as $key => $tag): ?> 
                                    <?php if($key !== '_id'): ?>
                                        <?php //echo $key; ?>
                                       <?php //$nombres[] = $value['nombre']; ?>
                                       <option value="<?=$tag['nombre']?>"><?=$tag['nombre']?></option>
                                    <?php endif ?>
                                <?php endforeach ?>

                            <?php endforeach; ?>
                                
                          </select>

                            <script>
                                  var select = document.getElementById("tags");
                                  var options = Array.from(select.options);

                                  // Ordenar las opciones alfabéticamente
                                  options.sort(function(a, b) {
                                    return a.text.localeCompare(b.text);
                                  });

                                  // Eliminar todas las opciones existentes
                                  select.innerHTML = "";

                                  // Agregar las opciones ordenadas nuevamente
                                  options.forEach(function(option) {
                                    select.appendChild(option);
                                  });
                            </script>                       

                        <textarea id="myTextareaTags"  rows="5" style="width: 100%;"></textarea>


                        <script>
                               var select = document.getElementById("tags");
                               var textarea = document.getElementById("myTextareaTags");

                                select.addEventListener("change", function() {
                                    var selectedOption = select.options[select.selectedIndex];
                                    var optionValue = selectedOption.value;
                                    var optionText = selectedOption.text;

                                    // Agregar el valor de la opción al textarea
                                    textarea.value += optionText + ", ";

                                    // Mostrar la opción seleccionada con una "x" para eliminarla
                                    var optionContainer = document.createElement("div");
                                    optionContainer.textContent = optionText;
                                    optionContainer.style.display = "inline-block";
                                    optionContainer.style.marginRight = "5px";

                                    var deleteButton = document.createElement("span");
                                    deleteButton.textContent = "x";
                                    deleteButton.style.cursor = "pointer";
                                    deleteButton.style.color = "red";
                                    deleteButton.style.marginLeft = "5px";
                                    deleteButton.addEventListener("click", function() {
                                      // Eliminar el valor del textarea
                                      textarea.value = textarea.value.replace(optionText + ", ", "");
                                      // Eliminar la opción seleccionada
                                      optionContainer.remove();
                                    });

                                    optionContainer.appendChild(deleteButton);
                                    document.body.appendChild(optionContainer);
                                });
                        </script>

                            

                            <!-- <script>
                                $(document).ready(function() {
                                    // Obtener los nombres desde PHP
                                    var nombres = <?php echo json_encode($nombres); ?>;
                                    
                                    // Configurar el autocompletado en el cuadro de texto
                                    $("#etiquetas").autocomplete({
                                        source: nombres
                                    });
                                });
                            </script> -->


                         


                          <!-- <input type="text" class="form-control form-control-sm" id="tags" name="tags" value="<?=isset($value['tags'][0]['nombre'])?$value['tags'][0]['nombre']:'';?>" /> -->
                      </div>
                      <br><br>
                     
                   </div>
                   <br>
                   <div class="row">
                        <div class="form-group col-md-12">
                            <h4 class="title-c m-tb-40">Materiales</h4> 
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="ttrailer">Tipo - Tráiler</label>
                            <input type="text" class="form-control form-control-sm" id="ttrailer" name="ttrailer" />
                        </div>
                         <div class="form-group col-sm-6">
                            <label for="tiemptrailer">Tiempo - Tráiler</label>
                            <input type="text" class="form-control form-control-sm" id="tiemptrailer" name="tiemptrailer" />
                        </div>
                         <div class="form-group col-sm-6">
                            <label for="ubicavirtual">Ubicación Virtual</label>
                            <input type="text" class="form-control form-control-sm" id="ubicavirtual" name="ubicavirtual"  value="<?=isset($value["materiales"][0]['ruta'])?$value["materiales"][0]['ruta']:"";?>" />
                        </div>
                         <div class="form-group col-sm-6">
                            <label for="tiempvideo">Tiempo - Vídeo</label>
                            <input type="text" class="form-control form-control-sm" id="tiempvideo" name="tiempvideo" />
                        </div>
                        
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn-primary-ccapital">
                                     Actualizar
                            </button>     
                            <a href="<?=base_raiz.'mod/tv/tv/contenidos'?>" class="btn-secondary-canalc">Cancelar</a>             
                                    
                        </div>          
                        
                    </div>  
                </form>
            <?php } ?>
        <?php } ?>
    <?php } ?>       
       
    
 <?php }else{ ?>
    <h2 class="title-c m-tb-40">Contenidos</h2>
 <?php } ?>




<br><br>
<br>
<h6>Encuentra aquí la lista de:</h6>
<br>
<span class="badge badge-danger" style="font-size: 20px;">Series</span>
<span>&nbsp;&nbsp;&nbsp;y&nbsp;&nbsp;&nbsp;</span>
<span class="badge badge-success" style="font-size: 20px;">Unitarios</span>
<br><br><br>

<a href="" class="btn-primary-ccapital">Registrar Nuevo</a>
<br><br><br>



<div class="table-responsive">
	<table id="example" class="table table-striped table-bordered dterpceTV" style="width:100%;">
        <thead>
            <tr>
                <th>Año(s)</th>
                <th>Ver</th>
                <th>Nombre</th>
                <th>Género</th>
                <th>Tema</th>
                <th>Formato</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

       

        <?php foreach($datos as $document): ?> 
            <?php 
                 // Obtener el ID del documento
                $id = (string) $document['_id'];
             ?>

             <?php foreach($document as $key => $value): ?> 
                <?php if($key !== '_id'): ?>
                    <tr>
                        <?php 
                            $fechacreacion = $value["fechacreacion"];
                              // $year = date("Y", strtotime($fechacreacion));
                              // echo $year . "\n";
                              // echo $value["year"][0];
                              // die();
                         ?>

                        <td><?=$value["year"][0];?></td>                       
                        <?php if($value['serie']==true){ ?>
                            <td>
                                <a href="#" class="badge badge-danger" style="font-size: 20px;"><?=$key;?></a>
                            </td>
                        <?php }else{ ?>
                            <td>
                                <a href="#" class="badge badge-success" style="font-size: 20px;"><?=$key;?></a>
                            </td>
                        <?php } ?>
                        <td><?=$value['nombre'];?></td>
                        <td><?=$value['genero'];?></td>                       
                        <td></td>

                        <td>
                            <?php
                                $formato = $value['formato'];
                                // Imprimir el contenido del campo "formato"
                                foreach ($formato as $item) {
                                  echo $item . "\n";
                                }
                            ?>
                        </td>                       
                        
                        <td>
                            <!-- <a href="#" title="Eliminar">
                                <i class="fas fa-trash-alt"></i> 
                            </a> -->
                            <a href="<?=base_raiz.'mod/tv/tv/contenidos'.'&idserie='.$key;?>" title="Editar">
                                <i class="fas fa-edit"></i> 
                            </a>
                        </td>
                    </tr>
                    <?php //echo $key; ?>
                    
                <?php endif ?>
            <?php endforeach ?>

        <?php endforeach; ?>
        	

        </tbody>
        <tfoot>
            <tr>
                <th>Año(s)</th>
                <th>Ver</th>
                <th>Nombre</th>
                <th>Género</th>
                <th>Tema</th>
                <th>Formato</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
	
</div>