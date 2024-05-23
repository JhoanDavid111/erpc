<?php
 session_start();
    
require_once 'models/usuario.php';
require_once 'models/modulos.php';




class usuarioController{
	
	public function index(){
		login();
	}	
	
	public function login(){
		if(isset($_POST)){

/*			$ip = $_SERVER["REMOTE_ADDR"];
     		$captcha = $_POST['g-recaptcha-response'];
   		    $secretKey = '6Lc6LCEfAAAAAAwvPU20257qXSfzkhO0dk8_lI7l';

            $errors = array();

            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}&remoteip={$ip}");

           $atributos = json_decode($response, TRUE);

           if (!$atributos['success']) {
		   		//$errors[] = 'Verifica el captcha';
				echo '<script language="javascript">alert("Verifica el captcha")</script>';
				echo "<script>location.href='https://intranet.canalcapital.gov.co/erp'</script>";
				
				//header("Location:".base_url);
		   }else{*/

		   		$usuario = new Usuario();
				$usuario->setEmail($_POST['email']);
				$usuario->setPassword($_POST['password']);
				
				$identity = $usuario->login($_POST['email']);

				$_SESSION['identity'] = $identity;

				 // var_dump($_SESSION['identity']);
				 // die();

			
				if($identity && is_object($identity)){
					$_SESSION['identity'] = $identity;
					
					// if($identity->rol == 'admin'){
					// 	$_SESSION['admin'] = true;
					// }
					//require_once'views/modulos.php';
					$_SESSION['ctrlnav']=0;
					$_SESSION['salio']=FALSE;

					$_SESSION['perid'] = $identity->perid;
					$_SESSION['peremail'] = $identity->peremail;
					// $_SESSION['pefid']=;
					$mod = new Modulos();
					$mods = $mod->getAll();
					$moduser = $mod->getModUser($_SESSION['perid']);

					$vig = $mod->vigact();
					$_SESSION['vig']=$vig[0]['idpaa'];

					// var_dump($moduser);
					// die();
					$_SESSION['mods'] = $mods;
					$_SESSION['moduser'] = $moduser;
					$_SESSION['admin'] = true;

					header("Location:".base_url.'views/modulos.php');
					//header("Location:".base_url.'modulo/index');
					
				}else{				
					$_SESSION['error_login'] = 'Identificación fallida !!';
					header("Location:".base_url);
				}

		   //}		
		
		}
	}
	
	public function logout(){
		if(isset($_SESSION['identity'])){
			unset($_SESSION['identity']);
		}
		
		if(isset($_SESSION['admin'])){
			unset($_SESSION['admin']);
		}

		session_start();

		unset($_SESSION['identity']);

		session_destroy();
		$_SESSION['salio']= true;
		header("Location:".base_url);
	}
	
} // fin clase