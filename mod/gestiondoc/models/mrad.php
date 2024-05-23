<?php 
class mrad{
	/*
	INSERT INTO radicado(norad, asurad, carrad, noradext, orirad, firrad, folrad, tiprad, areprorad, noradcon, regrad, fecrad, emprad, nomrad, dirrad, posrad, ubiid, cuerad, revrad, consecutivo) VALUES (:norad, :asurad, :carrad, :noradext, :orirad, :firrad, :folrad, :tiprad, :areprorad, :noradcon, :regrad, :fecrad, :emprad, :nomrad, :dirrad, :posrad, :ubiid, :cuerad, :revrad, :coprad, :consecutivo)
                    */
	public function inspag($asurad, $carrad, $noradext, $orirad, $firrad, $folrad, $tiprad, $areprorad, $noradcon, $regrad, $fecrad, $emprad, $nomrad, $dirrad, $posrad, $ubiid, $cuerad, $revrad, $coprad, $chkrad, $adjrad, $consecutivo, $carradofi){
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();
		$sql="INSERT INTO radicado (asurad, carrad, noradext, orirad, firrad, folrad, tiprad, areprorad, noradcon, regrad, fecrad, emprad, nomrad, dirrad, posrad, ubiid, cuerad, revrad, coprad, chkrad, adjrad, consecutivo, carradofi) VALUES (:asurad, :carrad, :noradext, :orirad, :firrad, :folrad, :tiprad, :areprorad, :noradcon, :regrad, :fecrad, :emprad, :nomrad, :dirrad, :posrad, :ubiid, :cuerad, :revrad, :coprad, :chkrad, :adjrad, :consecutivo, :carradofi)";
		//echo "<br><br><br>".$sql."<br><br>";
		//echo "INSERT INTO radicado (asurad, carrad, noradext, orirad, firrad, folrad, tiprad, areprorad, noradcon, regrad, fecrad, emprad, nomrad, dirrad, posrad, ubiid, cuerad, revrad, coprad, chkrad, adjrad, consecutivo, carradofi) VALUES ('".$asurad."','".$carrad."','".$noradext."','".$orirad."','".strtolower($firrad)."','".$folrad."','".$tiprad."','".$areprorad."','".$noradcon."','".$regrad."','".$fecrad."','".$emprad."','".$nomrad."','".$dirrad."','".$posrad."','".$ubiid."','".$cuerad."','".$revrad."','".$coprad."','".$chkrad."','".$adjrad."','".$consecutivo."','".$carradofi."');<BR>";
		$result=$conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':asurad', $asurad);
		$result->bindParam(':carrad', $carrad);
		$result->bindParam(':noradext', $noradext);
		$result->bindParam(':orirad', $orirad);
		$result->bindParam(':firrad', $firrad);
		$result->bindParam(':folrad', $folrad);
		$result->bindParam(':tiprad', $tiprad);
		$result->bindParam(':areprorad', $areprorad);
		$result->bindParam(':noradcon', $noradcon);
		$result->bindParam(':regrad', $regrad);
		$result->bindParam(':fecrad', $fecrad);
		$result->bindParam(':emprad', $emprad);
		$result->bindParam(':nomrad', $nomrad);
		$result->bindParam(':dirrad', $dirrad);
		$result->bindParam(':posrad', $posrad);
		$result->bindParam(':ubiid', $ubiid);
		$result->bindParam(':cuerad', $cuerad);
		$result->bindParam(':revrad', $revrad);
		$result->bindParam(':coprad', $coprad);
		$result->bindParam(':chkrad', $chkrad);
		$result->bindParam(':adjrad', $adjrad);
		$result->bindParam(':consecutivo', $consecutivo);
		$result->bindParam(':carradofi', $carradofi);
		
		

		if(!$result)
			echo "<script>alert('ERROR AL REGISTRAR')</script>";
		else
			$result->execute();
	}

	public function selpag($filtro,$filtro2,$filtro3,$filtro4,$filtro5,$filtro6,$filtro7,$rvalini,$rvalfin){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();

		$sql="SELECT r.norad, r.asurad, r.carrad, r.carradofi, c.valnom as cargo, r.noradext, r.orirad, r.firrad, r.folrad, r.tiprad, v.valnom as tip, r.areprorad, a.valnom as are, r.noradcon, r.regrad, p.pernom, p.perape, r.fecrad, r.emprad, r.nomrad, r.dirrad, r.posrad, r.ubiid, u.ubinom, u.ubidepto, r.cuerad, r.revrad, r.coprad, r.chkrad, r.adjrad, r.consecutivo FROM radicado AS r INNER JOIN persona AS p ON r.regrad=p.perid INNER JOIN valor AS v ON r.tiprad=v.valid LEFT JOIN valor AS c ON r.carrad=c.valid LEFT JOIN valor AS a ON r.areprorad=a.valid LEFT JOIN ubica AS u ON r.ubiid=u.ubiid";
			$filtr = $filtro;
			$filtro = "%".$filtro."%";
			$sql .= " WHERE (r.asurad LIKE :filtro";
			$sql .= " OR r.orirad LIKE :filtro";
			$sql .= " OR r.carrad LIKE :filtro";
			$sql .= " OR r.consecutivo LIKE :filtro";
			$sql .= " OR r.norad=:filtr)";
		if($filtro OR $filtro2 OR $filtro3 OR $filtro4 OR $filtro5 OR $filtro6 OR $filtro7){
			if($filtro2){
				$sql .= " AND r.tiprad=:filtro2";
			}
			if($filtro3){
				$sql .= " AND YEAR(r.fecrad)=:filtro3";
			}
			if($filtro4){
				$sql .= " AND r.firrad=:filtro4";
			}
			if($filtro5 AND $filtro6){
				$sql .= " AND r.fecrad BETWEEN :filtro5 AND :filtro6";
			}
			if($filtro7){
				$sql .= " AND r.regrad=:filtro7";
			}
		}
		$sql .= " ORDER BY r.fecrad DESC LIMIT $rvalini, $rvalfin;";
		//echo "<br><br><br><br><br>".$sql."<br>".$filtro."-".$filtro2."-".$filtro3."-".$filtro4."-".$filtro5."-".$filtro6."-".$filtro7;
		$result=$conexion->prepare($sql);

		$result->bindParam(':filtr', $filtr);
		$result->bindParam(':filtro', $filtro);
		
		if($filtro2)
			$result->bindParam(':filtro2', $filtro2);
		if($filtro3)
			$result->bindParam(':filtro3', $filtro3);
		if($filtro4)
			$result->bindParam(':filtro4', $filtro4);
		if($filtro5 AND $filtro6){
			$filtro5 = $filtro5." 00:00:00";
			$result->bindParam(':filtro5', $filtro5);
			$filtro6 = $filtro6." 23:59:59";
			$result->bindParam(':filtro6', $filtro6);
		}
		if($filtro7)
			$result->bindParam(':filtro7', $filtro7);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function sqlcount($filtro,$filtro2,$filtro3,$filtro4,$filtro5,$filtro6,$filtro7){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();
		$sql="SELECT count(r.norad) AS Npe FROM radicado AS r INNER JOIN persona AS p ON r.regrad=p.perid INNER JOIN valor AS v ON r.tiprad=v.valid LEFT JOIN valor AS c ON r.carrad=c.valid LEFT JOIN valor AS a ON r.areprorad=a.valid LEFT JOIN ubica AS u ON r.ubiid=u.ubiid";
			$filtr = $filtro;
			$filtro = "%".$filtro."%";
			$sql .= " WHERE (r.asurad LIKE '$filtro'";
			$sql .= " OR r.orirad LIKE '$filtro'";
			$sql .= " OR r.carrad LIKE '$filtro'";
			$sql .= " OR r.consecutivo LIKE '$filtro'";
			$sql .= " OR r.norad='$filtr')";
		if($filtro OR $filtro2 OR $filtro3 OR $filtro4 OR $filtro5 OR $filtro6 OR $filtro7){
			if($filtro2){
				$sql .= " AND r.tiprad='$filtro2'";
			}
			if($filtro3){
				$sql .= " AND YEAR(r.fecrad)='$filtro3'";
			}
			if($filtro4){
				$sql .= " AND d.firrad='$filtro4'";
			}
			if($filtro5 AND $filtro6){
				$sql .= " AND r.fecrad BETWEEN '$filtro5 00:00:00' AND '$filtro6 23:59:59'";
			}
			if($filtro7){
				$sql .= " AND r.regrad='$filtro7'";
			}
		}
		//echo $sql;
		return $sql;
	}

	public function regexi($noradcon){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();

		$sql="SELECT d.norad FROM radicado AS d ";
			$sql .= " WHERE (d.noradcon = :noradcon);";
		$result=$conexion->prepare($sql);
		//echo $sql."<br>"; 
		$result->bindParam(':noradcon', $noradcon);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function selpag1($norad){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();

		$sql="SELECT r.norad, r.asurad, r.carrad, r.carradofi, c.valnom as cargo, r.noradext, r.orirad, r.firrad, r.folrad, r.tiprad, v.valnom as tip, r.areprorad, a.valnom as are, r.noradcon, r.regrad, p.pernom, p.perape, r.fecrad, r.emprad, r.nomrad, r.dirrad, r.posrad, r.ubiid, u.ubinom, u.ubidepto, r.cuerad, r.revrad, r.coprad, r.chkrad, r.adjrad, r.consecutivo FROM radicado AS r INNER JOIN persona AS p ON r.regrad=p.perid INNER JOIN valor AS v ON r.tiprad=v.valid LEFT JOIN valor AS c ON r.carrad=c.valid LEFT JOIN valor AS a ON r.areprorad=a.valid LEFT JOIN ubica AS u ON r.ubiid=u.ubiid WHERE norad=:norad";
		//echo "<br>".$sql."  --  ".$norad;
		$result=$conexion->prepare($sql);

		$result->bindParam(':norad', $norad);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function updpag($campo, $valor, $norad){
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();
		$sql="UPDATE radicado SET $campo= :valor WHERE norad= :norad";
		//echo "<br>".$sql;
		$result=$conexion->prepare($sql);
		$result->bindParam(':valor', $valor);
		$result->bindParam(':norad', $norad);

		if(!$result)
			echo "<script>alert('ERROR AL MODIFICAR')</script>";
		else
			$result->execute();
	}

	public function elipag($norad){
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();
		$sql="DELETE FROM radicado WHERE norad= :norad";
		$result=$conexion->prepare($sql);
		$result->bindParam(':norad', $norad);

		if (!$result)
			echo "<script>alert('ERROR AL ELIMINAR')</script>";
		else
			$result->execute();
	}

	public function selparam($parid){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();

		$sql="SELECT valid, valnom, parid, valfijo FROM valor WHERE parid=:parid";
		$sql .= " ORDER BY valnom;";
		//echo "1".$sql."<br>";
		$result=$conexion->prepare($sql);
		$result->bindParam(':parid', $parid);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function selval($valid){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();

		$sql="SELECT valid, valnom, parid, valfijo, pre FROM valor WHERE valid=:valid ORDER BY valnom";
		//echo "4".$sql."<br>";
		$result=$conexion->prepare($sql);
		$result->bindParam(':valid', $valid);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function selnum($valid){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();

		$sql="SELECT count(norad)+1 as nro FROM radicado WHERE noradext=:valid";
		//echo "10".$sql."<br>";
		$result=$conexion->prepare($sql);
		$result->bindParam(':valid', $valid);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	
	
	public function selano(){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();

		$sql="SELECT DISTINCT YEAR(fecrad) AS ano FROM radicado ORDER BY YEAR(fecrad) DESC";
		//echo "<br><br><br><br><br><br>5".$sql."<br><br><br><br><br>";
		$result=$conexion->prepare($sql);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function selpef($pefid){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();

		$sql="SELECT pefid, pefnom, pefbus, pefdes, pefedi, pefeli FROM perfil WHERE pefid=:pefid";
		//echo "4".$sql."<br>";
		$result=$conexion->prepare($sql);
		$result->bindParam(':pefid', $pefid);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function selarc($norad){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();
		//notid, n.idtac, n.perid, p.pernom
		$sql = "SELECT * FROM documen";
		$sql .= " WHERE norad=:norad";
		//echo "<br>".$notid."<br>".$sql."<br><br>";
		$result=$conexion->prepare($sql);

		$result->bindParam(':norad', $norad);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function selpdfrad($norad){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();

		$sql="SELECT r.norad, r.asurad, r.carrad, r.noradext, r.orirad, r.firrad, r.folrad, r.tiprad, v.valnom, r.areprorad, r.noradcon, r.regrad, p.pernom, p.perape, r.fecrad, r.emprad, r.nomrad, r.dirrad, r.posrad, r.ubiid, r.cuerad, r.revrad, r.coprad, r.chkrad, r.adjrad, r.consecutivo FROM radicado AS r INNER JOIN persona AS p ON r.regrad=p.perid INNER JOIN valor AS v ON r.tiprad=v.valid WHERE r.norad=:norad;";
		//echo "<br><br><br><br><br>".$sql."<br>'".$norad."'<br><br><br><br>";
		$result=$conexion->prepare($sql);
		$result->bindParam(':norad', $norad);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function selpla($tiprad, $fecrad, $fechaf, $filtro, $filtro3, $filtro5, $filtro6){
		//&filtro=concej&filtro3=2019&filtro5=2019-10-30&filtro6=2019-10-31
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();

		$sql="SELECT r.norad, r.asurad, r.carrad, c.valnom as cargo, r.noradext, r.orirad, r.firrad, r.folrad, r.tiprad, v.valnom as tip, r.areprorad, a.valnom as are, r.noradcon, r.regrad, p.pernom, p.perape, r.fecrad, r.emprad, r.nomrad, r.dirrad, r.posrad, r.ubiid, u.ubinom, u.ubidepto, r.cuerad, r.revrad, r.coprad, r.chkrad, r.adjrad, r.consecutivo FROM radicado AS r INNER JOIN persona AS p ON r.regrad=p.perid INNER JOIN valor AS v ON r.tiprad=v.valid LEFT JOIN valor AS c ON r.carrad=c.valid LEFT JOIN valor AS a ON r.areprorad=a.valid LEFT JOIN ubica AS u ON r.ubiid=u.ubiid";
		$sql .= " WHERE tiprad=:tiprad";
		if($fecrad){
			$sql .= " AND r.fecrad>='".$fecrad." 00:00:00' AND r.fecrad<='".$fechaf." 23:59:59'";
		}
		if($filtro){
			$sql .= " AND (r.asurad LIKE '%".$filtro."%' OR r.cuerad LIKE '%".$filtro."%' OR r.orirad LIKE '%".$filtro."%')";
		}
		if($filtro3){
			$sql .= " AND YEAR(r.fecrad)='".$filtro3."'";
		}
		if($filtro5 AND $filtro6){
			$sql .= " AND r.fecrad BETWEEN '".$filtro5." 00:00:00' AND '".$filtro6." 23:59:59'";
		}
		$sql .= " ORDER BY r.fecrad;";
		//echo $fecrad."-".$filtro."-".$filtro3."-".$filtro5."-".$filtro6."&";
		//echo "<br><br><br><br><br>".$sql."<br>";
		$result=$conexion->prepare($sql);
		$result->bindParam(':tiprad', $tiprad);

		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function selfch($tiprad){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();

		$sql="SELECT DISTINCT DATE(fecrad) AS fecha FROM radicado ";
		$sql .= " WHERE tiprad=:tiprad ORDER BY fecrad DESC";
		//echo "<br><br><br><br><br>".$sql."<br>";
		$result=$conexion->prepare($sql);
		$result->bindParam(':tiprad', $tiprad);

		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function eliarchuni($docid){
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();
		$sql="DELETE FROM documen WHERE docid= :docid";
		//echo "<br><br><br><br><br>".$sql."<br>'".$docid."'<br><br><br><br>";
		$result=$conexion->prepare($sql);
		$result->bindParam(':docid', $docid);

		if (!$result)
			echo "<script>alert('ERROR AL ELIMINAR')</script>";
		else
			$result->execute();
	}

	public function selarc1($docid){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();
		$sql="SELECT docid, notid, docruta FROM documen WHERE docid= :docid";
		$result=$conexion->prepare($sql);

		$result->bindParam(':docid', $docid);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function seldepto(){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();
		$sql="SELECT ubiid, ubinom, ubidepto FROM ubica WHERE ubidepto='0' ORDER BY ubinom;";
		$result=$conexion->prepare($sql);

		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function selusu(){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();
		$sql="SELECT idusu, nomusu, carusu, emausu, firmusu, visbueusu, actusu FROM usuario WHERE actusu='1' ORDER BY nomusu;";
		$result=$conexion->prepare($sql);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}

	public function selusuu($idusu){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();
		$sql="SELECT idusu, nomusu, carusu, emausu, firmusu, visbueusu, actusu FROM usuario WHERE idusu =:idusu;";
		$result=$conexion->prepare($sql);
		$result->bindParam(':idusu', $idusu);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	public function selconfig(){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();

		$sql="SELECT idconf, nit, nomemp, dircon, mosdir, telcon, mostel, celcon, moscel, emacon, mosema, logocon, nomemo, noofi, noext FROM configuracion";
		//echo $sql;
		$result=$conexion->prepare($sql);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	
	public function updconf($campo, $valor){
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();
		$sql="UPDATE configuracion SET $campo= :valor WHERE idconf=1";
		//echo "<br>".$sql;
		$result=$conexion->prepare($sql);
		$result->bindParam(':valor', $valor);

		if(!$result)
			echo "<script>alert('ERROR AL MODIFICAR')</script>";
		else
			$result->execute();
	}
}
?>