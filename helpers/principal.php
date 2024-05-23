<?php
ob_start();
//session_start();
require_once 'autoload.php';
require_once '../../config/db.php';
require_once '../../config/raiz.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once '../../helpers/utils.php';
require_once 'views/layout/header.php';


// if (isset($_SESSION['admin'])) {
// 	require_once 'views/layout/sidebar.php';
// }

require_once 'views/layout/sidebar.php';

function show_error(){
	$error = new errorController();
	$error->index();
}

if(isset($_GET['controller'])){
	$nombre_controlador = ucfirst($_GET['controller'].'Controller');
	//var_dump($nombre_controlador);
	//die();

}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
	$nombre_controlador = ucfirst(controller_default);

	
}else{
	show_error();
	exit();
}

if(class_exists($nombre_controlador)){	
	$controlador = new $nombre_controlador();
	
	if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
		$action = $_GET['action'];

		

		$controlador->$action();
	}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
		$action_default = action_default;

		


		$controlador->$action_default();
	}else{
		show_error();
	}
}else{
	show_error();
}

require_once 'views/layout/footer.php';


