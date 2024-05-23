<?php
	require_once '../../../config/db.php';
	include'../models/dathvper.php';

	if (isset($_POST['id'])) {
			$id=$_POST['id'];
			$modelo= new dathvper();
			$mun=$modelo->getUbi($id);

			$html="<option value=''>Seleccione</option>";
			foreach($mun AS $value){
				$html.="<option value='".$value['ubiid']."'>".$value['ubinom']."</option>";
			}
			$row = array(
	    		'muni' => $html
	    	);
	    	if (is_array($row)) {
	    		echo json_encode($row);
			}
		}	
?>