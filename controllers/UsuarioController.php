<?php
session_start();

require_once 'vendor/autoload.php'; // Carga el autoloader de Composer
require_once 'models/usuario.php';
require_once 'models/modulos.php';

use Google\Client as GoogleClient;
use Google\Service\Oauth2 as Google_Service_Oauth2;

class usuarioController {
    private $clientId = '553284407053-r1a8p54gig13o3n7plkhufga3cts3r1q.apps.googleusercontent.com';
    private $clientSecret = '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';
    private $redirectUri = 'http://localhost/erpc/usuario/loginWithGoogle';

    private $googleClient;

    public function __construct() {
        $this->googleClient = new GoogleClient();
        $this->googleClient->setClientId($this->clientId);
        $this->googleClient->setClientSecret($this->clientSecret);
        $this->googleClient->setRedirectUri($this->redirectUri);
        $this->googleClient->addScope("email");
        $this->googleClient->addScope("profile");
        echo "<script>console.log('Google Client initialized');</script>";
    }

    public function login() {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $usuario = new Usuario();
            $usuario->setEmail($email);
            $usuario->setPassword($password);

            $identity = $usuario->login($email);

            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;
                $_SESSION['perid'] = $identity->perid;
                $_SESSION['peremail'] = $identity->peremail;

                $mod = new Modulos();
                $mods = $mod->getAll();
                $moduser = $mod->getModUser($_SESSION['perid']);
                $vig = $mod->vigact();
                $_SESSION['vig'] = $vig[0]['idpaa'];
                $_SESSION['mods'] = $mods;
                $_SESSION['moduser'] = $moduser;
                $_SESSION['admin'] = true;

                header("Location: " . base_url . 'views/modulos.php');
                exit();
            } else {
                $_SESSION['error_login'] = 'Identificación fallida !!';
                header("Location: " . base_url);
                exit();
            }
        }
    }

	public function loginWithGoogle() {
		echo "<script>console.log('URL completa: " . $_SERVER['REQUEST_URI'] . "');</script>";
		echo "<script>console.log('Método de solicitud: " . $_SERVER['REQUEST_METHOD'] . "');</script>";
		echo "<script>console.log('Parámetros de la URL: " . json_encode($_GET) . "');</script>";
	
		if (isset($_GET['code'])) {
			$code = $_GET['code'];
			echo "<script>console.log('Código recibido: " . $code . "');</script>";
	
			try {
				echo "<script>console.log('Autenticando con Google');</script>";
	
				// Intenta obtener el token de acceso usando el código de autorización
				$accessToken = $this->googleClient->fetchAccessTokenWithAuthCode($code);
				echo "<script>console.log('Respuesta del token de acceso: " . json_encode($accessToken) . "');</script>";
	
				if (isset($accessToken['access_token'])) {
					$this->googleClient->setAccessToken($accessToken['access_token']);
	
					// Verificar el estado del token de acceso
					if ($this->googleClient->isAccessTokenExpired()) {
						echo "<script>console.log('El token de acceso ha expirado');</script>";
						// Solicitar un nuevo token de acceso si es necesario
						$refreshToken = $accessToken['refresh_token'] ?? null;
						if ($refreshToken) {
							$newToken = $this->googleClient->fetchAccessTokenWithRefreshToken($refreshToken);
							$this->googleClient->setAccessToken($newToken);
							// Guarda el nuevo token si es necesario
						}
					}
	
					// Obtener la información del usuario
					$oauth = new Google_Service_Oauth2($this->googleClient);
					$userInfo = $oauth->userinfo->get();
					echo "<script>console.log('User Info obtenido: " . json_encode($userInfo) . "');</script>";
	
					if ($userInfo && isset($userInfo->email)) {
						$email = $userInfo->email;
	
						// Verificar el correo electrónico y manejar la sesión
						$usuarioModel = new Usuario();
						$usuarioModel->setEmail($email);
						$user = $usuarioModel->verificarEmail($email);
	
						if ($user) {
							$_SESSION['identity'] = $user;
							$_SESSION['perid'] = $user->perid;
							$_SESSION['peremail'] = $user->peremail;
	
							$mod = new Modulos();
							$mods = $mod->getAll();
							$moduser = $mod->getModUser($_SESSION['perid']);
							$vig = $mod->vigact();
							$_SESSION['vig'] = $vig[0]['idpaa'];
							$_SESSION['mods'] = $mods;
							$_SESSION['moduser'] = $moduser;
							$_SESSION['admin'] = true;
	
							echo "<script>console.log('Login exitoso'); window.location.href = '" . base_url . "views/modulos.php';</script>";
							exit();
						} else {
							echo "<script>console.log('Correo electrónico no válido o usuario inactivo !!'); window.location.href = '" . base_url . "';</script>";
							echo "<script>
							alert('Correo electrónico no válido o usuario inactivo. Recuerde que debe ser su correo institucional.');
							setTimeout(function() {
								window.location.href = '" . base_url . "';
							}, 3000); // Espera 3 segundos antes de redirigir
						  </script>";
							exit();
						}
					} else {
						echo "<script>console.log('Error al obtener la información del usuario.'); window.location.href = '" . base_url . "';</script>";
						exit();
					}
				} else {
					echo "<script>console.log('Error al obtener el token de acceso: " . json_encode($accessToken) . "');</script>";
					echo "<script>console.log('Error details: " . json_encode($this->googleClient->getLastError()) . "');</script>";
					echo "<script>window.location.href = '" . base_url . "';</script>";
					exit();
				}
			} catch (Exception $e) {
				echo "<script>console.log('Error durante el proceso de autenticación: " . addslashes($e->getMessage()) . "');</script>";
				echo "<script>window.location.href = '" . base_url . "';</script>";
				exit();
			}
		} else {
			// Redirigir a Google para autenticación
			$authUrl = $this->googleClient->createAuthUrl();
			header('Location: ' . $authUrl);
			exit();
		}
	}
	

    public function logout() {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }

        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }

        session_start();
        unset($_SESSION['identity']);
        session_destroy();
        $_SESSION['salio'] = true;
        header('Location: ' . base_url);
        exit();
    }
}
?>









