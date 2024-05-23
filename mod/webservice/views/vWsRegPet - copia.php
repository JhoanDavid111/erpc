<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script language="javascript">
$(document).ready(function(){
    $("#departamento").on('change', function () {
        $("#departamento option:selected").each(function () {
            elegido=$(this).val();
            $.post("http://localhost/erpc/mod/gestiondoc/views/vwsciudad.php", { elegido: elegido }, function(data){
                $("#ciudad").html(data);
            });			
        });
   });
});
</script>

<h2 class="title-c">
	Registro de petición
</h2>
<br>
<br>
<!-- <a href="<?=base_url;?>/radica/webregpeticion">Registro de petición</a>
<br> -->
<br>

<?php 
	$location = "https://www.alcaldiabogota.gov.co/sdqs/servicios/RadicacionPorCanalService?wsdl";
 ?>

<form class="m-tb-40" action="<?=base_url?>radica/savePeticion" method="POST" enctype="multipart/form-data">

	<div class="row">
		<div class="form-group col-md-6">
			<label for="tpeticionario">Tipo peticionario</label>
			<select id="tpeticionario" name="tpeticionario" class="form-control form-control-sm" style="padding: 0px;" >	
				<option value="1">Petición como Identificado</option>
				<option value="2">Petición como Anónimo</option>
			</select>

		</div class="form-group col-md-12">
			<p><small>De conformidad con el Anexo 2 de la Resolución 2893 de 2020 del Ministerio de Tecnologías de la Información y las Comunicaciones, para el registro de la petición anónima, se recomienda aplicar garantías de anonimato en cabeza del usuario tales como registrar la petición en una ventana en modo de incógnito, bloquear el acceso a su ubicación en el navegador, contemplar técnicas de enmascaramiento de IP, metadata, entre otros. Adicionalmente, se aclara que el sistema sigue los lineamientos de anonimización de datos emitidos por el Archivo General de la Nación, proporcionando en forma efectiva cumplimiento a los mismos.</small></p>
		<div>
			
		</div>

		<div class="form-group col-md-12">
			<label for="asunto">Asunto</label>
			<textarea class="form-control" id="asunto" name="asunto" rows="4" required="" maxlength="4000"></textarea>
		</div>

		<div class="form-group col-md-6">
			<label for="archivo">Adjuntar Archivo</label>
			<input type="file" class="form-control" id="archivo" name="archivo" value="">
		</div>
	</div>

	<?php 

	  $request1="<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:sdqs=\"http://sdqs.ws.alcasdqs.bogota.gov.co/\">
	        <soapenv:Header/>
	        <soapenv:Body>
	            <sdqs:consultarTipoPeticion/>
	        </soapenv:Body>
	     </soapenv:Envelope>";

	     $action1 = "consultarTipoPeticion";
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
	     $data1 = $sxe1->xpath('//ns2:consultarTipoPeticionResponse');

	  ?>

	<div class="row">
		<div class="form-group col-md-6">
			<label for="tpeticion">Tipo de petición *</label>
			<select id="tpeticion" name="tpeticion" class="form-control form-control-sm" style="padding: 0px;"  required>
				<option value="">Seleccione...</option>
			 	<?php foreach ($sxe1->xpath('//ns2:consultarTipoPeticionResponse') as $datos1): ?>
                    <?php foreach ($datos1->return->list AS $asun1): ?>
                    	<option value="<?=$asun1->id;?>"><?=$asun1->nombre;?></option>
                    <?php endforeach ?>
                <?php endforeach ?>			
			</select>
		</div>

		<div class="form-group col-md-6">
			<label for="entidaddes">Entidad Destino*</label>
			<select id="entidaddes" name="entidaddes" class="form-control form-control-sm" style="padding: 0px;" >	
				<option value="904">CANAL CAPITAL</option>				
			</select>
		</div>

		<?php 

		  $request2="<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:sdqs=\"http://sdqs.ws.alcasdqs.bogota.gov.co/\">
		        <soapenv:Header/>
		        <soapenv:Body>
		            <sdqs:consultarTemas>				        
				         <codigoEntidad>
				            <codigoEntidad>904</codigoEntidad>
				         </codigoEntidad>
				    </sdqs:consultarTemas>
		        </soapenv:Body>
		     </soapenv:Envelope>";

		     $action2 = "consultarTemas";
		     $headers2 = [
		         'Method: POST',
		         'Connection: Keep-Alive',
		         'User-Agent: Apache-HttpClient/4.5.5 (Java/16.0.1)',
		         'Content-Type: text/xml; charset=utf-8',
		         'SOAPAction: ""',
		     ];

		     $ch2 = curl_init($location);                     
		     curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers2);
		     curl_setopt($ch2, CURLOPT_POST, true);
		     curl_setopt($ch2, CURLOPT_POSTFIELDS, $request2);
		     curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

		     curl_setopt($ch2, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);//
		     curl_setopt($ch2, CURLOPT_USERPWD, 'sweb7:CanalCapital2023*'); //usuario:contraseña

		     $response2 = curl_exec($ch2);
		     $err_status2 = curl_error($ch2);

		     $sxe2 = new SimpleXMLElement($response2);
		     $ns2 = $sxe2->getNamespaces(true);
		     $sxe2->registerXPathNamespace('ns2', $ns2['ns2']);
		     $data2 = $sxe2->xpath('//ns2:consultarTemasResponse');

		  ?>
		<div class="form-group col-md-6">
			<label for="tema">Tema*</label>
			<select id="tema" name="tema" class="form-control form-control-sm" style="padding: 0px;" >	
				<option value="">Seleccione...</option>
			 	<?php foreach ($sxe2->xpath('//ns2:consultarTemasResponse') as $datos2): ?>
                    <?php foreach ($datos2->return->list AS $asun2): ?>
                    	<option value="<?=$asun2->id;?>"><?=$asun2->nombre;?></option>
                    <?php endforeach ?>
                <?php endforeach ?>	
			</select>
		</div>

		

		<div class="form-group col-md-6">
			<label for="palabra">Palabra clave</label>
			<input type="text" class="form-control" id="palabra" name="palabra" value="">
		</div>

		<div class="form-group col-md-12">
		  	<label for="correo">Correo electrónico:</label>
		  	<input type="text" class="form-control" name="correo">
		</div>
	</div>

	<br>
	<h4 class="title-c">Información Adicional</h4>
	<br><br><br>

	<?php 

	  $request3="<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:sdqs=\"http://sdqs.ws.alcasdqs.bogota.gov.co/\">
	        <soapenv:Header/>
	        <soapenv:Body>
	            <sdqs:consultarTipoTramite>
			         <codigoEntidad>
			            <codigoEntidad>904</codigoEntidad>
			         </codigoEntidad>
			    </sdqs:consultarTipoTramite>
	        </soapenv:Body>
	     </soapenv:Envelope>";

	     $action3 = "consultarTipoTramite";
	     $headers3 = [
	         'Method: POST',
	         'Connection: Keep-Alive',
	         'User-Agent: Apache-HttpClient/4.5.5 (Java/16.0.1)',
	         'Content-Type: text/xml; charset=utf-8',
	         'SOAPAction: ""',
	     ];

	     $ch3 = curl_init($location);                     
	     curl_setopt($ch3, CURLOPT_HTTPHEADER, $headers3);
	     curl_setopt($ch3, CURLOPT_POST, true);
	     curl_setopt($ch3, CURLOPT_POSTFIELDS, $request3);
	     curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);

	     curl_setopt($ch3, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);//
	     curl_setopt($ch3, CURLOPT_USERPWD, 'sweb7:CanalCapital2023*'); //usuario:contraseña

	     $response3 = curl_exec($ch3);
	     $err_status3 = curl_error($ch3);

	     $sxe3 = new SimpleXMLElement($response3);
	     $ns3 = $sxe3->getNamespaces(true);
	     $sxe3->registerXPathNamespace('ns2', $ns3['ns2']);
	     $data3 = $sxe3->xpath('//ns2:consultarTipoTramiteResponse');

	  ?>

	<div class="row">
		<div class="form-group col-md-6">
			<label for="tramite">Trámite y/o servicio*</label>
			<select id="tramite" name="tramite" class="form-control form-control-sm" style="padding: 0px;" >	
				<option value="">Seleccione...</option>
			 	<?php foreach ($sxe3->xpath('//ns2:consultarTipoTramiteResponse') as $datos3): ?>
                    <?php foreach ($datos3->return->list AS $asun3): ?>
                    	<option value="<?=$asun3->id;?>"><?=$asun3->nombre;?></option>
                    <?php endforeach ?>
                <?php endforeach ?>	
			</select>
		</div>

		<?php 

	  $request4="<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:sdqs=\"http://sdqs.ws.alcasdqs.bogota.gov.co/\">
	        <soapenv:Header/>
	        <soapenv:Body>
	            <sdqs:consultarDependencia>
			         <codigoEntidad>
			            <codigoEntidad>904</codigoEntidad>
			         </codigoEntidad>
			     </sdqs:consultarDependencia>
	        </soapenv:Body>
	     </soapenv:Envelope>";

	     $action4 = "consultarDependencia";
	     $headers4 = [
	         'Method: POST',
	         'Connection: Keep-Alive',
	         'User-Agent: Apache-HttpClient/4.5.5 (Java/16.0.1)',
	         'Content-Type: text/xml; charset=utf-8',
	         'SOAPAction: ""',
	     ];

	     $ch4 = curl_init($location);                     
	     curl_setopt($ch4, CURLOPT_HTTPHEADER, $headers4);
	     curl_setopt($ch4, CURLOPT_POST, true);
	     curl_setopt($ch4, CURLOPT_POSTFIELDS, $request4);
	     curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);

	     curl_setopt($ch4, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);//
	     curl_setopt($ch4, CURLOPT_USERPWD, 'sweb7:CanalCapital2023*'); //usuario:contraseña

	     $response4 = curl_exec($ch4);
	     $err_status4 = curl_error($ch4);

	     $sxe4 = new SimpleXMLElement($response4);
	     $ns4 = $sxe4->getNamespaces(true);
	     $sxe4->registerXPathNamespace('ns2', $ns4['ns2']);
	     $data4 = $sxe4->xpath('//ns2:consultarDependenciaResponse');

	  ?>

		<div class="form-group col-md-6">
			<label for="dependencia">Dependencia</label>
			<select id="dependencia" name="dependencia" class="form-control form-control-sm" style="padding: 0px;" >	
				<option value="">Seleccione...</option>
			 	<?php foreach ($sxe4->xpath('//ns2:consultarDependenciaResponse') as $datos4): ?>
                    <?php foreach ($datos4->return->list AS $asun4): ?>
                    	<option value="<?=$asun4->id;?>"><?=$asun4->nombre;?></option>
                    <?php endforeach ?>
                <?php endforeach ?>	
			</select>
		</div>

		<?php 

	  $request5="<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:sdqs=\"http://sdqs.ws.alcasdqs.bogota.gov.co/\">
	        <soapenv:Header/>
	        <soapenv:Body>
	            <sdqs:consultarProcesosCalidad>
			         <codigoEntidad>
			            <codigoEntidad>904</codigoEntidad>
			         </codigoEntidad>
			    </sdqs:consultarProcesosCalidad>

	        </soapenv:Body>
	     </soapenv:Envelope>";

	     $action5 = "consultarProcesosCalidad";
	     $headers5 = [
	         'Method: POST',
	         'Connection: Keep-Alive',
	         'User-Agent: Apache-HttpClient/4.5.5 (Java/16.0.1)',
	         'Content-Type: text/xml; charset=utf-8',
	         'SOAPAction: ""',
	     ];

	     $ch5 = curl_init($location);                     
	     curl_setopt($ch5, CURLOPT_HTTPHEADER, $headers5);
	     curl_setopt($ch5, CURLOPT_POST, true);
	     curl_setopt($ch5, CURLOPT_POSTFIELDS, $request5);
	     curl_setopt($ch5, CURLOPT_RETURNTRANSFER, true);

	     curl_setopt($ch5, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);//
	     curl_setopt($ch5, CURLOPT_USERPWD, 'sweb7:CanalCapital2023*'); //usuario:contraseña

	     $response5 = curl_exec($ch5);
	     $err_status5 = curl_error($ch5);

	     $sxe5 = new SimpleXMLElement($response5);
	     $ns5 = $sxe5->getNamespaces(true);
	     $sxe5->registerXPathNamespace('ns2', $ns5['ns2']);
	     $data5 = $sxe5->xpath('//ns2:consultarProcesosCalidadResponse');

	  ?>

		<div class="form-group col-md-6">
			<label for="proceso">Proceso de calidad</label>
			<select id="proceso" name="proceso" class="form-control form-control-sm" style="padding: 0px;" >	
				<option value="">Seleccione...</option>
			 	<?php foreach ($sxe5->xpath('//ns2:consultarProcesosCalidadResponse') as $datos5): ?>
                    <?php foreach ($datos5->return->list AS $asun5): ?>
                    	<option value="<?=$asun5->id;?>"><?=$asun5->nombre;?></option>
                    <?php endforeach ?>
                <?php endforeach ?>	
			</select>
		</div>

		<div class="form-group col-md-6">
			<label for="puntoatencion">Punto de atención*</label>
			<select id="puntoatencion" name="puntoatencion" class="form-control form-control-s" style="padding: 0px;" >	
				<option value="534">CANAL CAPITAL</option>				
			</select>
		</div>

		<?php 

	  $request6="<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:sdqs=\"http://sdqs.ws.alcasdqs.bogota.gov.co/\">
	        <soapenv:Header/>
	        <soapenv:Body>
	            <sdqs:consultarCanales/>
	        </soapenv:Body>
	     </soapenv:Envelope>";

	     $action6 = "consultarCanales";
	     $headers6 = [
	         'Method: POST',
	         'Connection: Keep-Alive',
	         'User-Agent: Apache-HttpClient/4.5.5 (Java/16.0.1)',
	         'Content-Type: text/xml; charset=utf-8',
	         'SOAPAction: ""',
	     ];

	     $ch6 = curl_init($location);                     
	     curl_setopt($ch6, CURLOPT_HTTPHEADER, $headers6);
	     curl_setopt($ch6, CURLOPT_POST, true);
	     curl_setopt($ch6, CURLOPT_POSTFIELDS, $request6);
	     curl_setopt($ch6, CURLOPT_RETURNTRANSFER, true);

	     curl_setopt($ch6, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);//
	     curl_setopt($ch6, CURLOPT_USERPWD, 'sweb7:CanalCapital2023*'); //usuario:contraseña

	     $response6 = curl_exec($ch6);
	     $err_status6 = curl_error($ch6);

	     $sxe6 = new SimpleXMLElement($response6);
	     $ns6 = $sxe6->getNamespaces(true);
	     $sxe6->registerXPathNamespace('ns2', $ns6['ns2']);
	     $data6 = $sxe6->xpath('//ns2:consultarCanalesResponse');

	  ?>

		<div class="form-group col-md-6">
			<label for="canal">Canal*</label>
			<select id="canal" name="canal" class="form-control form-control-sm" style="padding: 0px;" >	
				<?php foreach ($sxe6->xpath('//ns2:consultarCanalesResponse') as $datos6): ?>
                    <?php foreach ($datos6->return->canalArray AS $asun6): ?>
                    	<option value="<?=$asun6->codigoCanal;?>"><?=$asun6->nombre;?></option>
                    <?php endforeach ?>
                <?php endforeach ?>	
			</select>
		</div>

		<div class="form-group col-md-6">
		  	<label for="fradicado">Fecha radicado*:</label>
		  	<input type="date" class="form-control" name="fradicado" required>
		</div>

		<div class="form-group col-md-6">
		  	<label for="nradicado">Número radicado:</label>
		  	<input type="text" class="form-control" name="nradicado">
		</div>

		<!-- <div class="form-group col-md-6">
			<label for="codUNSPSC">Copiar respuesta a defensor de la ciudadanía</label>
			<select id="tipcondpa" name="tipcondpa" class="form-control form-control-sm" style="padding: 0px;" >	
				<option value=""></option>
				<option value=""></option>
			</select>
		</div> -->

		<div class="form-group col-md-12">
			<label for="observaciones">Observaciones</label>
			<textarea class="form-control" id="observaciones" name="observaciones" rows="4" maxlength="4000" required="" ></textarea>
		</div>
		
	</div>

	<br>
	<h4 class="title-c">Lugar de los hechos</h4>
	<br><br><br>

	<div class="row">
		<?php 

	  $request7="<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:sdqs=\"http://sdqs.ws.alcasdqs.bogota.gov.co/\">
	        <soapenv:Header/>
	        <soapenv:Body>
	            <sdqs:consultarDepartamentosPais>
			         <codigoPais>
			            <codigoPais>169</codigoPais>
			         </codigoPais>
			    </sdqs:consultarDepartamentosPais>
	        </soapenv:Body>
	     </soapenv:Envelope>";

	     $action7 = "consultarDepartamentosPais";
	     $headers7 = [
	         'Method: POST',
	         'Connection: Keep-Alive',
	         'User-Agent: Apache-HttpClient/4.5.5 (Java/16.0.1)',
	         'Content-Type: text/xml; charset=utf-8',
	         'SOAPAction: ""',
	     ];

	     $ch7 = curl_init($location);                     
	     curl_setopt($ch7, CURLOPT_HTTPHEADER, $headers7);
	     curl_setopt($ch7, CURLOPT_POST, true);
	     curl_setopt($ch7, CURLOPT_POSTFIELDS, $request7);
	     curl_setopt($ch7, CURLOPT_RETURNTRANSFER, true);

	     curl_setopt($ch7, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);//
	     curl_setopt($ch7, CURLOPT_USERPWD, 'sweb7:CanalCapital2023*'); //usuario:contraseña

	     $response7 = curl_exec($ch7);
	     $err_status7 = curl_error($ch7);

	     $sxe7 = new SimpleXMLElement($response7);
	     $ns7 = $sxe7->getNamespaces(true);
	     $sxe7->registerXPathNamespace('ns2', $ns7['ns2']);
	     $data7 = $sxe7->xpath('//ns2:consultarDepartamentosPaisResponse');

	  ?>

		<div class="form-group col-md-6">
			<label for="departamento">Departamento</label>
			<select id="departamento" name="departamento" id="departamento" class="form-control form-control-sm" style="padding: 0px;" >	
				<?php foreach ($sxe7->xpath('//ns2:consultarDepartamentosPaisResponse') as $datos7): ?>
					<option value="">Seleccione..</option>
                    <?php foreach ($datos7->return->list AS $asun7): ?>
                    	<option value="<?=$asun7->codigoDepartamento;?>"><?=$asun7->nombreDepartamento;?></option>
                    <?php endforeach ?>
                <?php endforeach ?>	
			</select>
		</div>

		<div class="form-group col-md-6">
			<label for="ciudad">Ciudad</label>
			<select id="ciudad" name="ciudad" id="ciudad" class="form-control form-control-sm" style="padding: 0px;" >	
				
			</select>
		</div>

		<div class="form-group col-md-12">
		  	<label for="direccion">Dirección:</label>
		  	<input type="text" class="form-control" name="direccion">
		</div>

		</div class="form-group col-md-12">
			<p><small>Certifico que el correo electrónico ingresado en mis datos personales se encuentra vigente, de igual manera autorizo a Bogotá Te Escucha - Sistema Distrital para la Gestión de Peticiones Ciudadanas, para que realice la notificación electrónica, a través de este mismo medio, de los actos administrativos o comunicaciones que se emitan dentro del trámite de la petición, incluida la respuesta a la misma, en los términos indicados por el artículo 56 de la Ley 1437 de 2011 a las normas que la modifiquen, aclaren o sustituyan.</small></p>
			
			<p><small>Al hacer clic en el botón Registrar Petición, usted acepta la remisión de la PQRS a la entidad. Sus datos serán recolectados y tratados conforme con la Política de Tratamiento de Datos. En la opción Consulta tu petición podrá verificar el estado de la respuesta. En caso que la solicitud de información sea de naturaleza de identidad reservada, deberá efectuar el respectivo trámite ante la Procuraduría General de la Nación, haciendo clic aquí.</small></p>

		<div>

	</div>

	<div class="form-group col-md-6" id="go1">
        <button type="submit" class="btn-primary-ccapital">
             Registrar Petición
        </button>
    </div>


	
</form>

