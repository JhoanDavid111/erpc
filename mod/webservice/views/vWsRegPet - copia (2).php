

<?php 
	$location = "https://www.alcaldiabogota.gov.co/sdqs/servicios/RadicacionPorCanalService?wsdl";


 ?>


 <?php 

	  // $request1="<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:sdqs=\"http://sdqs.ws.alcasdqs.bogota.gov.co/\">
	  //       <soapenv:Header/>
	  //       <soapenv:Body>
	  //           <sdqs:consultarTipoPeticion/>
	  //       </soapenv:Body>
	  //    </soapenv:Envelope>";

	  //    $action1 = "consultarTipoPeticion";
	  //    $headers1 = [
	  //        'Method: POST',
	  //        'Connection: Keep-Alive',
	  //        'User-Agent: Apache-HttpClient/4.5.5 (Java/16.0.1)',
	  //        'Content-Type: text/xml; charset=utf-8',
	  //        'SOAPAction: ""',
	  //    ];

	  //    $ch1 = curl_init($location);                     
	  //    curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers1);
	  //    curl_setopt($ch1, CURLOPT_POST, true);
	  //    curl_setopt($ch1, CURLOPT_POSTFIELDS, $request1);
	  //    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);

	  //    curl_setopt($ch1, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);//
	  //    curl_setopt($ch1, CURLOPT_USERPWD, 'sweb7:CanalCapital2023*'); //usuario:contraseña

	  //    $response1 = curl_exec($ch1);
	  //    $err_status1 = curl_error($ch1);

	  //    $sxe1 = new SimpleXMLElement($response1);
	  //    $ns1 = $sxe1->getNamespaces(true);
	  //    $sxe1->registerXPathNamespace('ns2', $ns1['ns2']);
	  //    $data1 = $sxe1->xpath('//ns2:consultarTipoPeticionResponse');

	  ?>

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

		        
				 'Content-Type: text/xml;charset=UTF-8',
				 'Host: www.alcaldiabogota.gov.co',
				 'Accept-Encoding: gzip,deflate',


		        

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

			curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false); // deshabilitar verificación de certificado SSL

			$response2 = curl_exec($ch2);
			$err_status2 = curl_error($ch2);
			// var_dump($err_status2);
			// die();

			$sxe2 = new SimpleXMLElement($response2);
			// $sxe2 = new SimpleXMLElement($response2,null,true);

			$ns2 = $sxe2->getNamespaces(true);
			$sxe2->registerXPathNamespace('ns2', $ns2['ns2']);
			$data2 = $sxe2->xpath('//ns2:consultarTemasResponse');

			var_dump($data2);
			die();


		     ///////////
		     ////////////


		     // $ch2 = curl_init($location);

		     // curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers2);
		     // curl_setopt($ch2, CURLOPT_POST, true);
		     // curl_setopt($ch2, CURLOPT_POSTFIELDS, $request2);
		     // curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

		     // curl_setopt($ch2, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);//
		     // curl_setopt($ch2, CURLOPT_USERPWD, 'sweb7:CanalCapital2023*'); //usuario:contraseña

		     // $response2 = curl_exec($ch2);
		     // $err_status2 = curl_error($ch2);
		     // // var_dump($err_status2);
		     // // die();

		     // $sxe2 = new SimpleXMLElement($response2);
		     // // $sxe2 = new SimpleXMLElement($response2,null,true);

		     // $ns2 = $sxe2->getNamespaces(true);
		     // $sxe2->registerXPathNamespace('ns2', $ns2['ns2']);
		     // $data2 = $sxe2->xpath('//ns2:consultarTemasResponse');




		  ?>

