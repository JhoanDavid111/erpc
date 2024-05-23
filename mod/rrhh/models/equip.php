<?php
class equip{
    private $idce;
    private $idequ;
    private $nomequ;
    private $asis;
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
    function getAsis(){
        return $this->asis;
    }
    function getperid(){
        return $this->perid;
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
    function setPerid($perid){
        $this->perid = $perid;
    }
    function setAsis($asis){
        $this->asis = $asis;
    }

	public function getOneCapI(){
		$sql ="SELECT ca.idce, ca.nomce, ca.tipce, t.valnom AS Tipo, ca.modce, m.valnom AS Modal, ca.ubice, ca.desce, ca.fecince, ca.fecfice, ce.idequ, ca.comce, ca.linkce, ce.asis FROM capeve AS ca INNER JOIN ceins AS ce ON ca.idce=ce.idce INNER JOIN valor AS t ON ca.tipce=t.valid INNER JOIN valor AS m ON ca.modce=m.valid";
        // if($_SESSION['pefid']!=60)
            $sql .= " WHERE ce.perid='".$_SESSION['perid']."'";
        // echo $sql."<br>";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
        //var_dump($execute);
        //die();
		return $pfinan;
	}
    public function getOneCapNI(){
        $sql ="SELECT ca.idce, ca.nomce, ca.tipce, t.valnom AS Tipo, ca.modce, m.valnom AS Modal, ca.ubice, ca.desce, ca.fecince, ca.fecfice, ca.comce, ca.linkce FROM capeve AS ca INNER JOIN valor AS t ON ca.tipce=t.valid INNER JOIN valor AS m ON ca.modce=m.valid WHERE ca.fecfice>=NOW() AND ca.idce NOT IN (SELECT idce FROM ceins WHERE perid='".$_SESSION['perid']."')";
        $execute = $this->db->query($sql);
        $pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
        //var_dump($execute);
        //die();
        return $pfinan;
    }
    public function getOneCapIEX(){
		$sql ="SELECT ca.idce, ca.nomce, ca.tipce, t.valnom AS Tipo, ca.modce, m.valnom AS Modal, ca.ubice, ca.desce, ca.fecince, ca.fecfice, ce.idequ, ca.comce, ca.linkce FROM capeve AS ca INNER JOIN ceins AS ce ON ca.idce=ce.idce INNER JOIN valor AS t ON ca.tipce=t.valid INNER JOIN valor AS m ON ca.modce=m.valid";
        // if($_SESSION['pefid']!=60)
            //$sql .= " WHERE ce.perid='".$_SESSION['perid']."'";
        // echo $sql."<br>";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
        //var_dump($execute);
        //die();
		return $pfinan;
	}
    public function getOneCapNIEX(){
        $sql ="SELECT ca.idce, ca.nomce, ca.tipce, t.valnom AS Tipo, ca.modce, m.valnom AS Modal, ca.ubice, ca.desce, ca.fecince, ca.fecfice, ca.comce, ca.linkce FROM capeve AS ca INNER JOIN valor AS t ON ca.tipce=t.valid INNER JOIN valor AS m ON ca.modce=m.valid WHERE ca.idce NOT IN (SELECT idce FROM ceins WHERE perid)";
        $execute = $this->db->query($sql);
        $pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
        //var_dump($execute);
        //die();
        return $pfinan;
    }

    public function getOneCapEX(){
        $sql ="SELECT ca.idce, ca.nomce, ca.tipce, t.valnom AS Tipo, ca.modce, m.valnom AS Modal, ca.ubice, ca.desce, ca.fecince, ca.fecfice, ca.comce, ca.linkce FROM capeve AS ca INNER JOIN valor AS t ON ca.tipce=t.valid INNER JOIN valor AS m ON ca.modce=m.valid WHERE ca.fecfice>=NOW();";
        $execute = $this->db->query($sql);
        $pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
        //var_dump($execute);
        //die();
        return $pfinan;
    }


    public function save(){
        $sql= "INSERT INTO ceins (idce, idequ, perid) VALUES (?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getIdce(), $this->getIdequ(), $_SESSION['perid']);
		//echo $sql;
	    //var_dump($sql);
		//die();
		$save = $insert->execute($arrdata);
    }

    public function saveExt(){        

            $sql= "INSERT INTO ceins (idce, idequ, perid) VALUES (?,?,?)";
            $insert = $this->db->prepare($sql);
            $arrdata = array($this->getIdce(), $this->getIdequ(), $this->getPerid());
            //echo $sql;
            //var_dump($arrdata);
            //die();
            $save = $insert->execute($arrdata);
    }

    public function updAsiIns($asis){        
            $sql= "UPDATE ceins SET asis=? WHERE idce=? AND perid=?";
            $insert = $this->db->prepare($sql);
            $arrdata = array($asis, $this->getIdce(), $_SESSION['perid']);
            // echo $sql;
            // var_dump($arrdata);
            // die();
            $save = $insert->execute($arrdata);
    }

    public function getExt($nodocemp){
        $sql = "SELECT perid FROM persona WHERE nodocemp = '$nodocemp'";
        $execute = $this->db->query($sql);
        $pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
        return $pfinan;
    }

    public function getInsExi($idce, $perid){
        $sql = "SELECT COUNT(idce) AS can FROM ceins WHERE idce='$idce' AND perid='$perid'";
        $execute = $this->db->query($sql);
        $pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
        return $pfinan;
    }

    

    public function del(){
        $sql= "DELETE FROM ceins WHERE idce=? AND perid=?";
        $insert = $this->db->prepare($sql);
        $arrdata = array($this->getIdce(), $_SESSION['perid']);
        //echo $sql;
        //var_dump($sql);
        //die();
        $save = $insert->execute($arrdata);
    }

    public function getEqui(){
        $sql= "SELECT idequ, idce, nomequ FROM cequi WHERE idce='".$this->getIdce()."'";
        $execute = $this->db->query($sql);
        $pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
        //echo $sql."<br>'".$this->getIdce()."','".$this->getNomequ()."'<br>";
        return $pfinan;
    }

    public function saveEqu(){
        $sql= "INSERT INTO cequi(idce, nomequ) VALUES (?,?)";
        $insert = $this->db->prepare($sql);
        $arrdata = array($this->getIdce(), $this->getNomequ());
        //echo $sql;
        //var_dump($sql);
        //die();
        $save = $insert->execute($arrdata);
    }

    public function getEqu(){
        $sql ="SELECT idequ FROM cequi WHERE idce='".$this->getIdce()."' AND nomequ='".$this->getNomequ()."'";
        $execute = $this->db->query($sql);
        $pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
        //echo $sql."<br>'".$this->getIdce()."','".$this->getNomequ()."'<br>"; 
        return $pfinan;
    }

    public function actAs(){		
		$sql = "UPDATE ceins SET asis=? WHERE idce=?";
		$update= $this->db->prepare($sql);
		$arrdata = array($this->getAsis(), $this->getIdce());
		$update->execute($arrdata);
		
		$result = false;
		if ($update) {
			$result = true;
		}
		return $result;
	}
	public function getOneA(){
		$sql = "SELECT e.perid, e.asis, e.idce, p.pernom, p.perape FROM ceins AS e INNER JOIN persona AS p ON p.perid=e.idce";
        // if($_SESSION['pefid']!=60)
		$sql .= " WHERE p.perid='".$_SESSION['perid']."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

}
?>