<?php

class Trasla{

	private $codrub;

	private $db;
	//SELECT codrub, nomrub, deprub, actrub FROM rubro
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getCodrub() {
		return $this->codrub;
	}

}
?>