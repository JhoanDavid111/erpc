<?php
include'models/plamej.php';

class rgraci1Controller{
	
	public function index(){
		Utils::useraccess('rgraci1/index',$_SESSION['pefid']);
		$plamej = new Plamej();
		date_default_timezone_set('America/Bogota');
		$ano = isset($_POST['ano']) ? $_POST['ano']:date("Y");
		$mes = date('n');
		$fil1 = isset($_POST['fil1']) ? $_POST['fil1']:NULL;
		$fil2 = isset($_POST['fil2']) ? $_POST['fil2']:NULL;
		
		// echo "Gra 1 =".$fil1." ".$fil2;
		//$pmj = $plamej->getDatM();
		$toms = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		$anos = $plamej->getAno();
		$pmj = $plamej->getGraEstado(0,$fil1,$fil2);
		$pmj1 = $plamej->getGraEstadoI(1901,$fil1,$fil2);
		$pmj2 = $plamej->getGraEstadoI(1902,$fil1,$fil2);
		$CanPlan = $plamej->getCanPlan($fil1, $fil2);
		$AC = $plamej->getAC($fil1, $fil2);
		$EI = $plamej->getEI($fil1, $fil2);

		require_once 'views/rgraci1.php';
	}

	public function area(){
		Utils::useraccess('rgraci1/area',$_SESSION['pefid']);
		$plamej = new Plamej();
		date_default_timezone_set('America/Bogota');
		$ano = isset($_POST['ano']) ? $_POST['ano']:date("Y");
		$mes = date('n');
		$valid = isset($_POST['valid']) ? $_POST['valid']:NULL;
		$fil1 = isset($_POST['fil1']) ? $_POST['fil1']:NULL;
		$fil2 = isset($_POST['fil2']) ? $_POST['fil2']:NULL;

		//echo "Gra 2 =".$fil1." ".$fil2;
		if($_SESSION['pefid']==59)
			$valid = $_SESSION['depid'];
		else
			$valid = isset($_POST['valid']) ? $_POST['valid']:0;
		$toms = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		$anos = $plamej->getAno();
		$areas = $plamej->getAllVal(1);;
		$pmj = $plamej->getGraEstado($valid,$fil1,$fil2);
		$pmj1 = $plamej->getGraEstadoIarea(1901,$valid,$fil1,$fil2);//Interno
		$pmj2 = $plamej->getGraEstadoIarea(1902,$valid,$fil1,$fil2);//Externo
		$CanPlan = $plamej->getCanPlan($fil1, $fil2);
		$AC = $plamej->getACarea($valid,$fil1, $fil2);
		$EI = $plamej->getEIarea($valid,$fil1, $fil2);

		require_once 'views/rgraci2.php';
	}
}