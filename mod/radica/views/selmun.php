<?php
	include '../models/muni.php';

	$valor = $_REQUEST["valor"];
	$radica = new Muni();
	$dat = $radica->getMun($valor);

	$html = '<div id="reloadMun">';
	
		$html .= '<select name="ubiid" class="form-control form-control-sm" style="padding: 0px;">';
			$html .= '<option value=0>Seleccione Departamento</option>';
			if($dat){
				foreach ($dat as $do){
	                $html .= '<option value="'.$do['ubiid'].'">';
	                	$html .= $do['ubinom'];
	                $html .= '</option>';
	            }
	        }
	            
		$html .= '</select>';
	$html .= '</div>';

	echo $html;
?>


