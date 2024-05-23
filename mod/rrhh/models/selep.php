<?php
class selep{
    private $idequ;
    private $nomequ;
    private $idcp;
    private $db;
    public function __construct(){
        $this->db = conexion::get_conexion();
    }


//METODOS GET

    function getIdequ(){
        return $this->idequ;
    }
    function getNomequ(){
        return $this->nomequ;
    }
    function getIdcp(){
        return $this->idcp;
    }


//metodos SET

    function setIdequ($idequ){
        $this->idequ = $idequ;
    }
    function setNomequ($nomequ){
        $this->nomequ = $nomequ;
    }
    function setIdcp($idcp){
        $this->idcp = $idcp;
    }




    public function save(){
        $sql= "INSERT INTO equipo (idcp, idequ, nomequ) VALUES (?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getIdcp(), $this->getIdequ(), $this->getNomequ());
		//echo $sql;
	    //var_dump($sql);
		//die();
		$save = $insert->execute($arrdata);
    }

}
?>