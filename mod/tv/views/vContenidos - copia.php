<?php 

require_once "models/mongoCrud.php";
$crud = new Crud();
$datos = $crud->mostrarDatosContenidos();

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

// var_dump($datos);
// die();

 ?>

<h2 class="title-c m-tb-40">Contenidos</h2>
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
	<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
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

        <tr>
                <td>2022</td>
                <td>
                    <a href="#" class="badge badge-danger" style="font-size: 20px;">ABDKO</a>
                </td>
                <td>Al borde del knockout</td>
                <td>Ficción</td>
                <td>Género</td>         
                <td>Drama Comedia</td> 
                <td>
                    <a href="" title="Eliminar">
                        <i class="fas fa-trash-alt"></i> 
                    </a>
                    <a href="" title="Editar">
                        <i class="fas fa-edit"></i> 
                    </a>
                </td>
            </tr>  

        <?php foreach($datos as $document): ?> 
            <?php 
                 // Obtener el ID del documento
                $id = (string) $document['_id'];
             ?>

             <?php foreach($document as $key => $value): ?> 
                <?php if($key !== '_id'): ?>
                    <?php //echo $key; ?>
                <?php endif ?>
            <?php endforeach ?>

        <?php endforeach; ?>
        	<tr>
                <td>2022</td>
        		<td>
                    <a href="#" class="badge badge-danger" style="font-size: 20px;">ABDKO</a>
                </td>
        		<td>Al borde del knockout</td>
        		<td>Ficción</td>
        		<td>Género</td>        	
                <td>Drama Comedia</td> 
                <td>
                    <a href="" title="Eliminar">
                        <i class="fas fa-trash-alt"></i> 
                    </a>
                    <a href="" title="Editar">
                        <i class="fas fa-edit"></i> 
                    </a>
                </td>
            </tr>  
            <tr>
                 <td>2021</td>
                <td>
                    <a href="#" class="badge badge-success" style="font-size: 20px;">ACRAC</a>
                </td>
                <td>El dulce encanto de la Isla Acracia</td>
                <td>Ficción</td>
                <td></td>           
                <td>Espectáculo</td> 
                <td></td>
            </tr>  
            <tr>
                <td>2017</td>
                <td>
                    <a href="#" class="badge badge-danger" style="font-size: 20px;">ADANE</a>
                </td>
                <td>Anne con E</td>
                <td>Ficción</td>
                <td></td>           
                <td>Live action</td>  
                <td></td>
            </tr>  
            <tr>
                <td>2022</td>
                <td>
                    <a href="#" class="badge badge-danger" style="font-size: 20px;">ABDKO</a>
                </td>
                <td>Al borde del knockout</td>
                <td>Ficción</td>
                <td>Género</td>         
                <td>Drama Comedia</td> 
                <td></td>
            </tr>  
            <tr>
                 <td>2021</td>
                <td>
                    <a href="#" class="badge badge-success" style="font-size: 20px;">ACRAC</a>
                </td>
                <td>El dulce encanto de la Isla Acracia</td>
                <td>Ficción</td>
                <td></td>           
                <td>Espectáculo</td> 
                <td></td>
            </tr>  
            <tr>
                <td>2017</td>
                <td>
                    <a href="#" class="badge badge-danger" style="font-size: 20px;">ADANE</a>
                </td>
                <td>Anne con E</td>
                <td>Ficción</td>
                <td></td>           
                <td>Live action</td> 
                <td></td> 
            </tr>  
            <tr>
                <td>2022</td>
                <td>
                    <a href="#" class="badge badge-danger" style="font-size: 20px;">ABDKO</a>
                </td>
                <td>Al borde del knockout</td>
                <td>Ficción</td>
                <td>Género</td>         
                <td>Drama Comedia</td> 
                <td></td>
            </tr>  
            <tr>
                 <td>2021</td>
                <td>
                    <a href="#" class="badge badge-success" style="font-size: 20px;">ACRAC</a>
                </td>
                <td>El dulce encanto de la Isla Acracia</td>
                <td>Ficción</td>
                <td></td>           
                <td>Espectáculo</td> 
                <td></td>
            </tr>  
            <tr>
                <td>2017</td>
                <td>
                    <a href="#" class="badge badge-danger" style="font-size: 20px;">ADANE</a>
                </td>
                <td>Anne con E</td>
                <td>Ficción</td>
                <td></td>           
                <td>Live action</td>  
                <td></td>
            </tr>  
            <tr>
                <td>2022</td>
                <td>
                    <a href="#" class="badge badge-danger" style="font-size: 20px;">ABDKO</a>
                </td>
                <td>Al borde del knockout</td>
                <td>Ficción</td>
                <td>Género</td>         
                <td>Drama Comedia</td> 
                <td></td>
            </tr>  
            <tr>
                 <td>2021</td>
                <td>
                    <a href="#" class="badge badge-success" style="font-size: 20px;">ACRAC</a>
                </td>
                <td>El dulce encanto de la Isla Acracia</td>
                <td>Ficción</td>
                <td></td>           
                <td>Espectáculo</td> 
                <td></td>
            </tr>  
            <tr>
                <td>2017</td>
                <td>
                    <a href="#" class="badge badge-danger" style="font-size: 20px;">ADANE</a>
                </td>
                <td>Anne con E</td>
                <td>Ficción</td>
                <td></td>           
                <td>Live action</td>  
                <td></td>
            </tr>              

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