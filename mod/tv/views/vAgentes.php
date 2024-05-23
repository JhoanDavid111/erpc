<?php      
    require_once "models/mongoCrud.php";
    $crud = new Crud();
    $datos = $crud->mostrarDatosEmpresas();
    //$datos2 = $crud->mostrarDatos();
    //var_dump(iterator_to_array($datos)); 
    // var_dump($datos);
    // die();


     
    //$dt=iterator_to_array($datos);

    //$iterator = iterator_to_array($datos);

    //var_dump($dt);

    
  
    //var_dump($j[0]['_id']);

  

    // foreach ($datos AS $documento) {    
          
    //      //echo $em['7Kz3ejCTTmQZS91DTnka']['contacto']. "\n" ;
    //     $contactos = $documento['7Kz3ejCTTmQZS91DTnka']['contacto'];
        
    //     foreach ($contactos as $contacto) {
    //     // Imprimir el apellido del contacto
    //     echo $contacto['apellidos'] . "<br>";
    //   }
    // }

    // // Recorrer los documentos
    // foreach ($datos as $documento) {
    //     // Acceder a los datos del documento
    //     $id = $documento->_id;
    //     $relacion = $documento->relacion;
    //     $contacto = $documento->contacto;
    //     $web = $documento->web;

    //     echo $id . "<br>";
    //     // ... y así sucesivamente para cada campo que se quiera acceder
    //     // En este punto, se pueden realizar las operaciones deseadas con los datos
    //     // de cada documento dentro del bucle
    // }

    // foreach ($datos as $documento) {
    //   // Obtener las claves del documento
    //   $keys = array_keys((array)$documento);

    //   // Imprimir las claves
    //   echo "Claves del documento: " . implode(", ", $keys) . "\n";
    // }


    // foreach ($datos as $document) {
    //     // Obtener el ID del documento
    //     $id = (string) $document['_id'];
        
    //     // Recorrer los contactos del documento y listar los apellidos
    //     foreach ($document as $key => $value) {
    //         if ($key !== '_id') {
    //             $apellidos = $value['contacto'][0]['apellidos'];
    //             echo "El documento con ID $id tiene el apellido $apellidos en la clave $key\n";
    //         }
    //     }
    // }

 ?>

<?php if(isset($_GET['idagente'])){ ?>
    <h2 class="title-c m-tb-40">Actualizar Contenido</h2>

    <form class="m-tb-40" action="" method="POST">
       
    </form>
<?php }else{ ?>
    <br>
    <h2 class="title-c m-tb-40">Agentes</h2>
    <br><br>
<?php } ?>



<br>
<h6>Encuentra aquí la lista de agentes:</h6>
<br>


 <div class="table-responsive">
    <table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Empresa</th>     
                <th></th>           
            </tr>
        </thead>
        <tbody>           

            <?php foreach($datos as $document): ?> 
                <?php 
                     // Obtener el ID del documento
                    $id = (string) $document['_id'];
                 ?>

                 <!-- // Recorrer los contactos del documento y listar los apellidos -->
                <?php foreach($document as $key => $value): ?> 
                    <?php if($key !== '_id'): ?>
                        <tr>
                            <td>
                                 <?=$key;?>
                            </td>
                            <td>
                                <?=$value['contacto'][0]['nombres'];?>
                            </td>
                            <td>
                                <?=$value['contacto'][0]['apellidos'];?>
                            </td>
                            <td>
                                <?=$value['relacion'];?>
                                <br><br>
                                <small><strong>Email: </strong><?=$value['contacto'][0]['correo'];?></small>
                                <br>
                                <?php foreach($value['contacto'] as $contacto): ?>
                                    <?php if(isset($contacto['telefono'])): ?>
                                        <?php foreach($contacto['telefono'] as $telefono): ?>
                                            <small><strong>Teléfono: </strong><?=$telefono['tel'];?></small>
                                            <br>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>                                
                                
                                <small><strong>Cargo: </strong><?=$value['contacto'][0]['cargo'];?></small>
                            </td>
                             <td>
                                <!-- <a href="#" title="Eliminar">
                                    <i class="fas fa-trash-alt"></i> 
                                </a> -->
                                <a href="<?=base_raiz.'mod/tv/tv/agentes'.'&idagente='.$key;?>" title="Editar">
                                    <i class="fas fa-edit"></i> 
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

            <?php endforeach; ?>
            

        </tbody>
        <tfoot>
             <tr>
                <th>Id</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Empresa</th>   
                <th></th>             
            </tr>
        </tfoot>
    </table>
    
</div>

