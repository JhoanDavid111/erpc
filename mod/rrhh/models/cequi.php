<?php
class cequi{
    private $idce;
    private $idequ;
    private $nomequ;
    private $db;
    public function __construct(){
        $this->db = conexion::get_conexion();
    }


//METODOS GET

    function getIdce(){
        return $this->idce;
    }
    function getIdequ(){
        return $this->idequ;
    }
    function getNomequ(){
        return $this->nomequ;
    }


//metodos SET

    function setIdce($idce){
        $this->idce = $idce;
    }
    function setIdequ($idequ){
        $this->idequ = $idequ;
    }
    function setNomequ($nomequ){
        $this->nomequ = $nomequ;
    }




    public function save(){
        $sql= "INSERT INTO cequi (idce, idequ, nomequ) VALUES (?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getIdce(), $this->getIdequ(), $this->getNomequ());
		//echo $sql;
	    //var_dump($sql);
		//die();
		$save = $insert->execute($arrdata);
    }

}
?>