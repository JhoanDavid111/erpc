<?php

class Usuario{
		
	private $peremail;
	private $perpass;
	private $db;
	
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
	function getId() {
		return $this->id;
	}	

	function getEmail() {
		return $this->peremail;
	}	

	function getPassword() {
		//return password_hash($this->password, PASSWORD_DEFAULT, array("cost"=>4));
		return $password = sha1(md5($this->perpass));
	}	
	
	function setEmail($email) {
		$this->peremail = $email;
	}

	function setPassword($password) {
		$pass=$password;
		$this->perpass = $password;
	}

		
	public function login($email){
		$result = false;		
		$password = $this->getPassword();		
		$malito=$email;		

		$sql = "SELECT * FROM persona WHERE (pernom=:email or peremail= :email) AND actemp=1 limit 1";
		$sth = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':email' => $malito));
		$usuario = $sth->fetchObject();

		// $cuenta=$sth->rowCount();
		// var_dump($cuenta);
		// var_dump($usuario->perpass);
		// var_dump($password);
		// die();



		$result=NULL;
		if($usuario && $sth->rowCount() == 1){			
			//$verify = password_verify($password, $usuario->perpass);
			$vpass= $usuario->perpass;

			// var_dump($vpass);
			// die();

			if ($password == $vpass){
				$verify=TRUE;
				//$_SESSION['user']=$malito;
				$_SESSION['user']=$malito;
				$_SESSION['pass']=$this->perpass;
				// $_SESSION['salio']=FALSE;

				if($verify){
				$result = $usuario;
				}
			}


			}
			// var_dump($verify);
			// die();
			
		
		return $result;
	}
	
	
	
}