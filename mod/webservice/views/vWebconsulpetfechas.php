<h4 class="title-c">
  Consulta registro de peticiones
</h4>
<br>
<br>

<?php 

// var_dump($_POST);
//die();

$fecin = $_POST['fecin'];
$fecfi = $_POST['fecfi'];


 ?>

<?php 

$location = "https://www.alcaldiabogota.gov.co/sdqs/servicios/RadicacionPorCanalService?wsdl";

// $request="<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:sdqs=\"http://sdqs.ws.alcasdqs.bogota.gov.co/\">
//    <soapenv:Header/>
//    <soapenv:Body>
//       <sdqs:consultarEntidades>
//          <consultaEntidades>
//             <!--Optional:-->
//             <codigoEntidad>904</codigoEntidad>
//             <!--Optional:-->
//             <codigoSector>9</codigoSector>
//          </consultaEntidades>
//       </sdqs:consultarEntidades>
//    </soapenv:Body>
// </soapenv:Envelope>";

$request="<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:sdqs=\"http://sdqs.ws.alcasdqs.bogota.gov.co/\">
   <soapenv:Header/>
   <soapenv:Body>
      <sdqs:consultarRequerimientosRangoFechas>
         <consultarRequerimientosRangoFechas>
            <codigoEntidad>904</codigoEntidad>
            <fechaInicio>".$fecin."</fechaInicio>
            <fechaFin>".$fecfi."</fechaFin>
            <pagina>1</pagina>
            <numeroRegistros>100</numeroRegistros>
         </consultarRequerimientosRangoFechas>
      </sdqs:consultarRequerimientosRangoFechas>
   </soapenv:Body>
</soapenv:Envelope>";

$action = "consultarRequerimientosRangoFechas";
$headers = [
    'Method: POST',
    'Connection: Keep-Alive',
    'User-Agent: Apache-HttpClient/4.5.5 (Java/16.0.1)',
    'Content-Type: text/xml; charset=utf-8',
    'SOAPAction: ""',
];

$ch = curl_init($location);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
//curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//tipo de autorización
//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);//NTLM para webservices con dominios de windows
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);//AUTH BASIC para este caso
//curl_setopt($ch, CURLOPT_USERPWD, 'lucio:lucio'); //usuario:contraseña
curl_setopt($ch, CURLOPT_USERPWD, 'sweb7:CanalCapital2023*'); //usuario:contraseña
//curl_setopt($ch, CURLOPT_USERPWD, 'srodriguez0508:Bogota.2020'); //usuario:contraseña

$response = curl_exec($ch);
$err_status = curl_error($ch);

//print("Response: <br>");
//print("<pre>".$response."</pre>");

// $datosxml = simplexml_load_string($response);
// $p=htmlentities($response);

// $xml = simplexml_load_string($response);
// //EMPIEZO A LEER LA INFORMACION DEL CFDI E IMPRIMIRLA
// foreach ($xml->xpath('//ns2:consultarEntidadesResponse') as $cfdiComprobante){
//       echo $cfdiComprobante['codigoMensaje'];
//       echo "<br />";
    
// }

$sxe = new SimpleXMLElement($response);
$ns = $sxe->getNamespaces(true);
$sxe->registerXPathNamespace('ns2', $ns['ns2']);
$data = $sxe->xpath('//ns2:consultarRequerimientosRangoFechasResponse');

//var_dump($data);

// echo "<br><br>";
// echo "FOREACH:";
// echo "<br><br>";


// foreach ($sxe->xpath('//ns2:consultarRequerimientosRangoFechasResponse') as $cfdiComprobante){
//       echo $cfdiComprobante->return->peticiones->asunto;

//       foreach ($cfdiComprobante->return->peticiones AS $asun){
//          echo $asun->asunto;
//       } 
//       echo "<br />";
    
// }

?>

<br><br>

<table id="example" class="table table-striped table-bordered dterpceDSC" style="width:100%;">     

   <thead style="font-size: 12px; text-align: center;">
      <tr>       
         <th>ASUNTO</th>                                     
         <th>DATOS DE CONTACTO</th>
         <th>DEPENDENCIA</th>
         <th>FECHAS</th>        
         <th>INFORMACION</th>
         <th>ESTADO</th>
         <th></th>
      </tr>      
   </thead>
   
   <tbody style="font-size: 12px;">
      <?php foreach ($sxe->xpath('//ns2:consultarRequerimientosRangoFechasResponse') as $datos): ?>

         <?php foreach ($datos->return->peticiones AS $asun): ?>
            <tr> 
               <td>                  
                  <small><strong>Asunto: </strong><?=$asun->asunto;?></small>
                  <br><br>
                  <small><strong>Tipo: </strong><?=$asun->tipo->nombre;?></small>
                  <br><br>
                  <small><strong>Número Radicado: </strong><?=$asun->numero;?></small>
                  <br><br>
                  <small><strong>Número Petición Entidad: </strong><?=$asun->numeroPeticionEntidad;?></small>
                  <br><br>                  
               </td>               
               <td>
                  <small><strong>Nombre Contácto: </strong><?=$asun->nombreCompletoContacto;?></small>
                  <br><br>
                  <small><strong>Correo: </strong><?=$asun->correoElectronico;?></small>
                  <br>
                  <small><strong>Ciudad: </strong><?=$asun->ciudad->nombre;?></small>
                  <br>
                  <small><strong>Barrio: </strong><?=$asun->barrio->nombre;?></small>
                  <br>
                  <small><strong>Celular: </strong><?=$asun->celularContacto;?></small>
                  <br>
                  <br>
                  <small><strong>Teléfono Fijo: </strong><?=$asun->telefonoFijoContacto;?></small>
                  <br>
                  <small><strong>Dirección: </strong><?=$asun->direccionResidenciaContacto;?></small>
                  <br><br>

                  <?php 
                     if (($asun->notificacionCelular)=="true") {
                        $notificacionCelular="Si";
                     }else{
                        $notificacionCelular="No";
                     }
                   ?>
                  <small><strong>Notificación Celular: </strong><?=$notificacionCelular;?></small>
                  <br>

                  <?php 
                     if (($asun->notificacionElectronica)=="true") {
                        $notificacionElectronica="Si";
                     }else{
                        $notificacionElectronica="No";
                     }
                   ?>
                  <small><strong>Notificación Electrónica: </strong><?=$notificacionElectronica;?></small>
                  <br>
                  <?php 
                     if (($asun->notificacionFisica)=="true") {
                        $notificacionFisica="Si";
                     }else{
                        $notificacionFisica="No";
                     }
                   ?>
                  <small><strong>Notificación Física: </strong><?=$notificacionFisica;?></small>

               </td>
               <td>
                  <small><strong><?=$asun->dependencia->nombre;?> </strong></small>
                  <br><br>
                  <small><strong>Funcionario: </strong><?=$asun->funcionario->nombre;?></small>
                  <br><br>
                  <small><strong>Entidad: </strong><?=$asun->entidad->nombre;?></small>
                  <br>
                  <small><strong>Entidad Fuente: </strong><?=$asun->entidadFuente;?></small>
                  <br>
                  <small><strong>Entidad Ingresa: </strong><?=$asun->entidadIngresa->nombre;?></small>
                  <br>
                  <small><strong>Entidad Procedencia: </strong><?=$asun->entidadProcedencia;?></small>
                  <br>
                  <small><strong>Entidad Responsable: </strong><?=$asun->entidadResponsable->nombre;?></small>
               </td>
               <td>
                  <small><strong>Fecha Ingreso: </strong><?=$asun->fechaIngreso;?></small>
                  <br>
                  <small><strong>Fecha Radicado: </strong><?=$asun->fechaRadicado;?></small>
                  <br>
                  <small><strong>Fecha Registro: </strong><?=$asun->fechaRegistro;?></small>
               </td>
               
               <td>
                  <small><strong>Motivo: </strong><?=$asun->motivo->nombre;?></small>
                  <br>
                  <small><strong>Canal: </strong><?=$asun->canal->nombre;?></small>
                  <br>
                  <small><strong>Opción: </strong><?=$asun->opcion->nombre;?></small>
                  <br>
                  <small><strong>punto Atención: </strong><?=$asun->puntoAtencion->nombre;?></small>
                  <br><br>
                  <small><strong>Atención Preferencial: </strong><?=$asun->atencionPreferencial->nombre;?></small>
                  <br>
                  <small><strong>Dirección Hechos: </strong><?=$asun->direccionHechos;?></small>
                  <br><br>
                  <small><strong>Observaciones: </strong><?=$asun->observaciones;?></small>
                  <br><br>
                  <?php 
                     if (($asun->representanteLegal)=="true") {
                        $representanteLegal="Si";
                     }else{
                        $representanteLegal="No";
                     }
                   ?>
                  <small><strong>Representante Legal: </strong><?=$representanteLegal;?></small>
                  <br>
                  <small><strong>Tema: </strong><?=$asun->tema->nombre;?></small>
                  <br>
                  <small><strong>Tipo Trámite: </strong><?=$asun->tipoTramite->nombre;?></small>
                  <br>
                   <small><strong>Proceso Calidad: </strong><?=$asun->procesoCalidad;?></small>

               </td>
               <td>
                  <?php 

                  $request1="<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:sdqs=\"http://sdqs.ws.alcasdqs.bogota.gov.co/\">
                        <soapenv:Header/>
                        <soapenv:Body>
                           <sdqs:consultarEstadoRequerimiento>
                              <codigoRequerimiento>
                                 <codigoEntidad>904</codigoEntidad>
                                 <codigoRequerimiento>".$asun->numero."</codigoRequerimiento>
                              </codigoRequerimiento>
                           </sdqs:consultarEstadoRequerimiento>
                        </soapenv:Body>
                     </soapenv:Envelope>";

                     $action1 = "consultarEstadoRequerimiento";
                     $headers1 = [
                         'Method: POST',
                         'Connection: Keep-Alive',
                         'User-Agent: Apache-HttpClient/4.5.5 (Java/16.0.1)',
                         'Content-Type: text/xml; charset=utf-8',
                         'SOAPAction: ""',
                     ];

                     $ch1 = curl_init($location);                     
                     curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers1);
                     curl_setopt($ch1, CURLOPT_POST, true);
                     curl_setopt($ch1, CURLOPT_POSTFIELDS, $request1);
                     curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);

                     curl_setopt($ch1, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);//
                     curl_setopt($ch1, CURLOPT_USERPWD, 'sweb7:CanalCapital2023*'); //usuario:contraseña

                     $response1 = curl_exec($ch1);
                     $err_status1 = curl_error($ch1);

                     $sxe1 = new SimpleXMLElement($response1);
                     $ns1 = $sxe1->getNamespaces(true);
                     $sxe1->registerXPathNamespace('ns2', $ns1['ns2']);
                     $data1 = $sxe1->xpath('//ns2:consultarEstadoRequerimientoResponse');

                  ?>
                   <?php foreach ($sxe1->xpath('//ns2:consultarEstadoRequerimientoResponse') as $datos1): ?>
                     <?php foreach ($datos1->return AS $asun1): ?>
                        <small><strong>Descripción Estado: </strong><?=$asun1->descripcionEstado;?></small>
                        <br><br>
                        <small><strong>Nombre: </strong><?=$asun1->nombre;?></small>

                     <?php endforeach ?>
                   <?php endforeach ?>
                  
               </td>  
               <td></td>              
            </tr> 
         <?php endforeach ?>
      <?php endforeach ?>         
   </tbody>
     
 </table>