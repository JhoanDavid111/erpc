<?php 

$html = "";
$departamento = $_POST['elegido'];



$location = "https://www.alcaldiabogota.gov.co/sdqs/servicios/RadicacionPorCanalService?wsdl";

$request="<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:sdqs=\"http://sdqs.ws.alcasdqs.bogota.gov.co/\">
	        <soapenv:Header/>
	        <soapenv:Body>
	            <sdqs:consultarCiudadesDepartamento>
				     <codigoDepartamento>
				        <codigoDepartamento>".$departamento."</codigoDepartamento>
				     </codigoDepartamento>
				</sdqs:consultarCiudadesDepartamento>
	        </soapenv:Body>
	     </soapenv:Envelope>";

	     $action = "consultarCiudadesDepartamento";
	     $headers = [
	         'Method: POST',
	         'Connection: Keep-Alive',
	         'User-Agent: Apache-HttpClient/4.5.5 (Java/16.0.1)',
	         'Content-Type: text/xml; charset=utf-8',
	         'SOAPAction: ""',
	     ];

	     $ch = curl_init($location);                     
	     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	     curl_setopt($ch, CURLOPT_POST, true);
	     curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
	     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	     curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);//
	     curl_setopt($ch, CURLOPT_USERPWD, 'sweb7:CanalCapital2023*'); //usuario:contraseña

	     $response = curl_exec($ch);
	     $err_status = curl_error($ch);

	     $sxe = new SimpleXMLElement($response);
	     $ns = $sxe->getNamespaces(true);
	     $sxe->registerXPathNamespace('ns2', $ns['ns2']);
	     $data = $sxe->xpath('//ns2:consultarCiudadesDepartamentoResponse');

 ?>

 <?php foreach ($sxe->xpath('//ns2:consultarCiudadesDepartamentoResponse') as $datos): ?>
	
    <?php foreach ($datos->return->list AS $asun): ?>
    	<?php 
    		$html .= '<option value="';
    		$html .= $asun->codigoCiudad;
    		$html .= '">';
    		$html .= $asun->nombre;
    		$html .= '</option>';
    	 ?>    	
    <?php endforeach ?>
<?php endforeach ?>	

<?php echo $html ?>