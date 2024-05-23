<?php
	require_once '../../../config/db.php';
	include'../models/dathvper.php';

	if (isset($_POST['id'])) {
			$id=$_POST['id'];
			$modelo= new dathvper();
			$loca=$modelo->getUbi($id);

			$html="<option value=''>Seleccione</option>";
			foreach($loca AS $value){
				$html.="<option value='".$value['ubiid']."''>".$value['ubinom']."</option>";
			}
			
			$row = array(
	    		'loca' => $html
	    	);
	    	if (is_array($row)) {
	    		echo json_encode($row);
			}
		}	
?>