<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Utils{

	//FINANCIERA*******************************************

	public static function areasu($year){
		$pfinan = new Pfinan();
		$pfinan->setIdpaa($year);
		$areasutil = $pfinan->getAreas();
		return $areasutil;
	}

	//*****END FINANCIERA**********************************

	public static function deleteSession($name){
		if(isset($_SESSION[$name])){
			$_SESSION[$name] = null;
			unset($_SESSION[$name]);
		}
		
		return $name;
	}
	
	public static function isAdmin(){
		if(!isset($_SESSION['admin'])){
			header("Location:".base_raiz);
			// header("Location:https://websolution.com.co/gestion/");
			// header("Location:".base_url);
		}else{
			return true;
		}
	}

	public function modulos(){
		$mod = new Modulos();
		$mods = $mod->getAll();
	}

	public static function menu($rmenu,$pefid){
		require_once '../../models/menu.php';
		if(isset($rmenu)){
			$men = new Menu();
			$men->setIdmod($rmenu);
			//echo $men->getIdmod();
			$menu = $men->getMenu($pefid);
			$_SESSION['menu'] = $menu;
		}else{
			session_start();
			session_destroy();
			header("Location:".base_raiz);
		}
	}

	public static function mcdpmul($area){
		require_once '../../models/menu.php';
		$men = new Menu();
		$menu = $men->getCdpMul($area);
		if($menu && $menu[0]["Nu"]==1) 
			return true;
		else
			return false;
	}

	//

	public static function useraccess($nompag,$perfil,$p=""){
		if(!$p){
			require_once '../../models/menu.php';
		}else{
			require_once '../../../models/menu.php';
			$bas_rai = '/erp';
		}

		$men = new Menu();

		if(isset($perfil)){
			$menu = $men->getPagper($nompag, $perfil);		


			// var_dump($menu);
			// die();			

			if(!$menu){

				session_start();
				session_destroy();
				if(!$p) header("Location:".base_raiz); else header("Location:".$bas_rai);
			}
		}else{
			session_start();
			session_destroy();
			if(!$p) header("Location:".base_raiz); else header("Location:".$bas_rai);
		}
	}
	
	public static function menEstpaa(){
		require_once '../../models/menu.php';
		$men = new Menu();
		$menu = $men->getEstpaa();
		$_SESSION['estPaa'] = $menu;
	}

	public static function isIdentity(){
		if(!isset($_SESSION['identity'])){
			header("Location:".base_url);
		}else{
			return true;
		}
	}
	
	public static function tit($ti,$ic,$pg,$alto){
	    $txt = '';
	    $txt .= '<div class="interno">';
	        $txt .= '<button id="mos" class="btn-primary-ccapital" style="display: block;width: 170px;margin-bottom: 20px;" onclick="ocultar(1,\''.$alto.'\');" title="Nuevo '.$ti.'">';
	            $txt .= '<i class="'.$ic.'"></i>';
	            $txt .= ' Nuevo '.$ti;
	        $txt .= '</button>';

	        $txt .= '<a href="'.base_url.$pg.'" id="ocu">';
	            $txt .= '<button id="ocu" class="btn-primary-ccapital" style="display: block;width: 170px;margin-bottom: 20px;" title="Cerrar">';
	                $txt .= '<i class="fas fa-times ico3"></i> Cancelar';
	            $txt .= '</button>';
	        $txt .= '</a>';
	    $txt .= '</div>';
	    return $txt;
	}

	public static function opti($pict, $nomimg, $rut, $pre){
		ini_set('memory_limit', '512M');
		$pafi=path_file;
		$nombre = '';
		if($pict){
			$max_ancho = 1024;
			$max_alto = 800;
			$docext = pathinfo($pict["name"], PATHINFO_EXTENSION);
			if($docext=="png" or $docext=="PNG" or $docext=="jpg" or $docext=="JPG" or $docext=="jpeg" or $docext=="JPEG" or $docext=="jfif"){
				$medidasimagen = getimagesize($pict['tmp_name']);
				//echo $medidasimagen[0]."-".$pict['size'];
				if($medidasimagen[0]<=$max_ancho && $pict['size']<10485760){
					$nombre = $rut.'/'.$nomimg.$pre.".".$docext;
					move_uploaded_file($pict['tmp_name'], $pafi.$nombre);
				}else{
					$nombre = $rut.'/'.$nomimg.$pre.".".$docext;
					$rtOriginal=$pict['tmp_name'];
					if($pict['type']=='image/jpeg'){
						$original = @imagecreatefromjpeg($rtOriginal);
					}else if($pict['type']=='image/png'){
						$original = @imagecreatefrompng($rtOriginal);
					}else if($pict['type']=='image/gif'){
						$original = @imagecreatefromgif($rtOriginal);
					}
					list($ancho,$alto)=getimagesize($rtOriginal);
					$x_ratio = $max_ancho / $ancho;
					$y_ratio = $max_alto / $alto;
					if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
		    			$ancho_final = $ancho;
		    			$alto_final = $alto;
					}elseif (($x_ratio * $alto) < $max_alto){
		    			$alto_final = ceil($x_ratio * $alto);
		    			$ancho_final = $max_ancho;
					}else{
		    			$ancho_final = ceil($y_ratio * $ancho);
		    			$alto_final = $max_alto;
					}
					$lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
					imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
		 			$cal=8;
		 			if($pict['type']=='image/jpeg'){
						imagejpeg($lienzo,$pafi.$nombre);
					}else if($pict['type']=='image/png'){
						imagepng($lienzo,$pafi.$nombre);
					}else if($pict['type']=='image/gif'){
						imagegif($lienzo,$pafi.$nombre);
					}
				}
			}elseif ($docext=="mp4" or $docext=="mov" or $docext=="avi" or $docext=="MP4" or $docext=="MOV" or $docext=="AVI") {
				//echo $pict['name']."-".$pict['tmp_name']."-".$pict['size'];
				if($pict['size']<100741824){
					$nombre = $rut.'/'."Vid_".$nomimg.$pre.".".$docext;
					move_uploaded_file($pict['tmp_name'], $pafi.$nombre);
				}else{
					echo "<script>alert('Los archivos de video debe tener un peso maximo de 97Mb');</script>";
				}	
			}elseif ($docext=="doc" or $docext=="docx" or $docext=="xls" or $docext=="xlsx" or $docext=="csv" or $docext=="pdf" or $docext=="txt" or $docext=="ppt" or $docext=="pptx" or $docext=="zip" or $docext=="gz" or $docext=="ZIP" or $docext=="GZ" or $docext=="TXT" or $docext=="DOC" or $docext=="DOCX" or $docext=="XLS" or $docext=="XLSX" or $docext=="CSV" or $docext=="PDF" or $docext=="PPT" or $docext=="PPTX") {
				if($pict['size']<100741824){
					$nombre = $rut.'/'."Arc_".$nomimg.$pre.".".$docext;
					move_uploaded_file($pict['tmp_name'], $pafi.$nombre);
				}else{
					echo "<script>alert('Los archivos deben tener un peso maximo de 10Mb');</script>";
				}
				// echo "<script>alert('Solo se permiten archivos de extensiones: png, jpg, jpeg, mp4, mov, avi.');</script>";
			}
		}
		return $nombre;
	}

	public static function modal($nonven, $titulo, $id, $nombre, $dtmos, $ruta, $dtsel, $msg=""){
		$txt = '';

		$txt .= '<div class="modal" id="'.$nonven.$id.'" tabindex="-1"  aria-labelledby="'.$nonven.$id.'" aria-hidden="true">';
			$txt .= '<div class="modal-dialog">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h3 class="modal-title">'.$titulo.'</h3>';
						$txt .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>';
					$txt .= '</div>';
					$txt .= '<form name="frmpxp" action="'.$ruta.'" method="POST">';
						$txt .= '<div class="modal-body">';
							$txt .= '<h6>Perfil: '.$nombre.'</h6>';
							if($dtmos){
								//var_dump($dtmos);
								// die();
								//var_dump($dtsel);
								foreach ($dtmos as $dpg) {
									$busq = false;
									$em = false;
									foreach($dtsel AS $dt){
										if ($dt['idb']==$dpg['id']){
											if(isset($dt['em'])) if ($dt['em']==1) $em = true;
											$busq = true;
											break; 
										}
									}
									//$busq = in_array($dpg['id'], $dtsel);
									$txt .= '<div class="dpag">';
										$txt .= '<input type="checkbox" name="chk[]" value="'.$dpg['id'].'" ';
										if($busq==true) $txt .= ' checked ';
										$txt .= '>';
										if(isset($dt['em'])){
											$txt .= "&nbsp;&nbsp;&nbsp;";
											$txt .= '<input type="checkbox" name="ema[]" value="'.$dpg['id'].'" ';
											if ($em==true) $txt .= ' checked ';
											$txt .= '>*';
										}
										$txt .= "&nbsp;&nbsp;&nbsp;";
										$txt .= $dpg['nom'];
									$txt .= '</div>';
								}
							}
							//$txt .= '<input type="hidden" name="opera" value="'.$nonven.'">';
							$txt .= '<input type="hidden" name="id" value="'.$id.'">';
						$txt .= '</div>';

						$txt .= '<div class="modal-footer">';
							if($msg)
								$txt .= '<span class="txtfoot">'.$msg.'</span>';
							$txt .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
		        			$txt .= '<input type="submit" class="btn btn-primary" value="Guardar">';
						$txt .= '</div>';
					$txt .= '</form>';
				$txt .= '</div>';
			$txt .= '</div>';
		$txt .= '</div>';

		return $txt;
	}

/*
$nonven		->	Nombre de la ventana modal
$titulo		->	Titulo que se va a ver dentro de la ventana modal
$id			->	Numero unido al nonven que hacen el nombre de la ventana unico para que sea llamado
$nombre		->	Nombre del Subtitulo si es necesario de lo contrario enviar "", para que no muestre nada
$dtmos		->	Arreglo (Array) con los nombres que van a tener las etiquetas (label) de cada cuadro combinado (select)
$ruta		->	Ruta a la cual el formulario va a enviar los datos
$dtsel		->	Arreglo (Array) que llena el/los cuadros combinados (select), pero son identificados por el id del dtmos
$pxpa		->	Arreglo (Array)que llena todos los resultados seleccionados por en cada cuadro combinado, pero el sistema busca por por el valor del select y muestra el seleccionado en ese control.
$arrman		->	Arreglo (Array) manual, si el arreglo es hecho a código colocar Si, por defecto no si el arreglo es el resultado de una consulta de BD
$msg		->	Mensaje que aparece en la parte inferior, predeterminadamente se encuentra vacio.
*/
	public static function modals($nonven, $titulo, $id, $nombre, $dtmos, $ruta, $dtsel, $pxpa, $arrman="No", $msg=""){
		$txt = '';

		$txt .= '<div class="modal" id="'.$nonven.$id.'" tabindex="-1"  aria-labelledby="'.$nonven.$id.'" aria-hidden="true">';
			$txt .= '<div class="modal-dialog">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h3 class="modal-title">'.$titulo.'</h3>';
						$txt .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>';
					$txt .= '</div>';

					$txt .= '<form name="frmpxp" action="'.$ruta.'" method="POST">';
						$txt .= '<div class="modal-body">';
							$txt .= '<h6>'.$nombre.'</h6>';
							if($dtmos){
								// var_dump($dtmos);
								//die();
								//var_dump($dtsel);
								//var_dump($pxpa);
								foreach ($dtmos as $dpg) {
									$busq = false;
									
									//$busq = in_array($dpg['id'], $dtsel);
									$txt .= '<div class="dpag">';
										$txt .= $dpg['nom'];
									$txt .= '</div>';
									$txt .= '<div class="dpag">';
									if($dtsel){
										$txt .= '<select name="chk[]" value="'.$dpg['id'].'" class="form-control form-control-sm" >';
											$txt .= '<option value="0">Sin perfil</option>';
											foreach($dtsel AS $dt){
											 	if ($dt['idb']==$dpg['id']){
											 		$busq = false;
											 		//p.pefid AS idp, m.idmod AS idb, p.pefnom AS nom2
													foreach($pxpa AS $dta){
														if($arrman=="No"){
															if ($dta['pid']==$dt['idp']){
																$busq = true;
																break; 
															}
														}else{
															if ($dta['pim']==$dt['idp']){
																$busq = true;
																break; 
															}
														}
													}

											 		$txt .= '<option value="'.$dt['idp'].'" ';
											 			if($busq==true) $txt .= ' selected ';
											 		$txt .= '>';
											 			$txt .= $dt['nom2'];
													$txt .= '</option>';
												}
											}
										$txt .= '</select>';
									}
									$txt .= '</div>';
								}
							}
							//$txt .= '<input type="hidden" name="opera" value="'.$nonven.'">';
							$txt .= '<input type="hidden" name="id" value="'.$id.'">';
						$txt .= '</div>';

						$txt .= '<div class="modal-footer">';
							if($msg)
								$txt .= '<span class="txtfoot">'.$msg.'</span>';
							$txt .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
		        			$txt .= '<input type="submit" class="btn btn-primary" value="Guardar">';
						$txt .= '</div>';
					$txt .= '</form>';
				$txt .= '</div>';
			$txt .= '</div>';
		$txt .= '</div>';

		return $txt;
	}

	public static function modalSimple($nonven, $titulo, $id, $nombre, $dtmos, $ruta, $dtsel, $msg=""){
		$txt = '';

		$txt .= '<div class="modal" id="'.$nonven.$id.'" tabindex="-1"  aria-labelledby="'.$nonven.$id.'" aria-hidden="true">';
			$txt .= '<div class="modal-dialog">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h3 class="modal-title">'.$titulo.'</h3>';
						$txt .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>';
					$txt .= '</div>';

					$txt .= '<form name="frmpxp" action="'.$ruta.'" method="POST">';
						$txt .= '<div class="modal-body">';
							$txt .= '<h6>'.$nombre.'</h6>';
							$txt .= '<div class="dpag" style="width: 29%">';
								$txt .= $dtmos;
							$txt .= '</div>';
							$txt .= '<div class="dpag" style="width: 69%">';
							if($dtsel){
								// echo $dtsel[0]['idp'];
								// echo "<br><br><pre>";
								// var_dump($dtsel);
								// echo "<pre>";
								// die();
								$txt .= '<select name="chk[]" value="datse" class="form-control form-control-sm" >';
									foreach($dtsel AS $dt){
								 		$txt .= '<option value="'.$dt['idp'].'" >';
								 			$txt .= substr($dt['nom2'],0,80);
										$txt .= '</option>';
									}
								$txt .= '</select>';
							}
							$txt .= '</div>';
							//$txt .= '<input type="hidden" name="opera" value="'.$nonven.'">';
							$txt .= '<input type="hidden" name="id" value="'.$id.'">';
						$txt .= '</div>';

						$txt .= '<div class="modal-footer">';
							if($msg)
								$txt .= '<span class="txtfoot">'.$msg.'</span>';
							$txt .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
		        			$txt .= '<input type="submit" class="btn btn-primary" value="Guardar">';
						$txt .= '</div>';
					$txt .= '</form>';
				$txt .= '</div>';
			$txt .= '</div>';
		$txt .= '</div>';

		return $txt;
	}

	public static function modalDosCampos($nonven, $titulo, $id, $nombre, $dtmos, $ruta, $dttxt, $nomnb, $dtnb, $msg=""){
		$txt = '';

		$txt .= '<div class="modal" id="'.$nonven.$id.'" tabindex="-1"  aria-labelledby="'.$nonven.$id.'" aria-hidden="true">';
			$txt .= '<div class="modal-dialog">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h3 class="modal-title">'.$titulo.'</h3>';
						$txt .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>';
					$txt .= '</div>';

					$txt .= '<form name="frmpxp" action="'.$ruta.'" method="POST">';
						$txt .= '<div class="modal-body">';
							$txt .= '<h6>'.$nombre.'</h6>';

							$txt .= '<div class="row">';
								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<label for="txtepr">';
										$txt .= $dtmos;
									$txt .= '</label>';
									$txt .= '<input type="text" name="'.$dttxt.'"  class="form-control form-control-sm" required />';
								$txt .= '</div>';

								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<label for="txtepr">';
										$txt .= $nomnb;
									$txt .= '</label>';
									$txt .= '<input type="number" name="'.$dtnb.'"  class="form-control form-control-sm" min="0" max="5" value="0" />';
								$txt .= '</div>';
							$txt .= '</div>';
							$txt .= '<input type="hidden" name="id" value="'.$id.'">';
						$txt .= '</div>';

						$txt .= '<div class="modal-footer">';
							if($msg)
								$txt .= '<span class="txtfoot">'.$msg.'</span>';
							$txt .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
		        			$txt .= '<input type="submit" class="btn btn-primary" value="Guardar">';
						$txt .= '</div>';
					$txt .= '</form>';
				$txt .= '</div>';
			$txt .= '</div>';
		$txt .= '</div>';

		return $txt;
	}

// Ventana modal dos textos
	public static function modalDosText($nonven, $titulo, $id, $dtmos, $ruta, $dttxt, $nopla, $nomnb="", $dtnb="", $msg=""){
		$txt = '';

		$txt .= '<div class="modal" id="'.$nonven.$id.'" tabindex="-1"  aria-labelledby="'.$nonven.$id.'" aria-hidden="true">';
			$txt .= '<div class="modal-dialog">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h3 class="modal-title">'.$titulo.'</h3>';
						$txt .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>';
					$txt .= '</div>';

					$txt .= '<form name="frmpxp" action="'.$ruta.'" method="POST" enctype="multipart/form-data">';
						$txt .= '<div class="modal-body">';
							// $txt .= '<h6>'.$nombre.'</h6>';

							$txt .= '<div class="row">';
								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<label for="'.$dttxt.'">';
										$txt .= $dtmos;
									$txt .= '</label>';
									$txt .= '<textarea name="'.$dttxt.'"  class="form-control form-control-sm" required ></textarea>';
								$txt .= '</div>';

								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<label for="'.$dtnb.'">';
										$txt .= $nomnb;
									$txt .= '</label>';
									$txt .= '<input type="file" name="'.$dtnb.'" class="form-control" required />';
								$txt .= '</div>';
							$txt .= '</div>';
							$txt .= '<input type="hidden" name="noplm" value="'.$id.'">';
							$txt .= '<input type="hidden" name="nopla" value="'.$nopla.'">';
						$txt .= '</div>';

						$txt .= '<div class="modal-footer">';
							if($msg)
								$txt .= '<span class="txtfoot">'.$msg.'</span>';
							$txt .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
		        			$txt .= '<input type="submit" class="btn btn-primary" value="Guardar">';
						$txt .= '</div>';
					$txt .= '</form>';
				$txt .= '</div>';
			$txt .= '</div>';
		$txt .= '</div>';

		return $txt;
	}

// Ventana modal texto y file
	public static function modalTextFile($nonven, $titulo, $id, $dtmos, $ruta, $dttxt, $nopla, $nomact, $nomnb="", $dtnb="", $msg=""){
		$txt = '';

		$txt .= '<div class="modal" id="'.$nonven.$id.'" tabindex="-1"  aria-labelledby="'.$nonven.$id.'" aria-hidden="true">';
			$txt .= '<div class="modal-dialog">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h3 class="modal-title">'.$titulo.'</h3>';
						$txt .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>';
					$txt .= '</div>';

					$txt .= '<form name="frmpxp" action="'.$ruta.'" method="POST" enctype="multipart/form-data">';
						$txt .= '<div class="modal-body">';
							// $txt .= '<h6>'.$nombre.'</h6>';

							$txt .= '<div class="row">';
								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<h6>';
										$txt .= "(Actividad) ".$nomact;
									$txt .= '</h6>';
								$txt .= '</div>';
								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<label for="'.$dttxt.'">';
										$txt .= $dtmos;
									$txt .= '</label>';
									$txt .= '<textarea name="'.$dttxt.'"  class="form-control form-control-sm" required ></textarea>';
								$txt .= '</div>';

								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<label for="'.$dtnb.'">';
										$txt .= $nomnb;
									$txt .= '</label>';
									if($nomnb=="Evidencias y/o soportes de la ejecución de la acción") $req=""; else $req="required";
									$txt .= '<input type="file" name="'.$dtnb.'" class="form-control" '.$req.' />';
								$txt .= '</div>';
							$txt .= '</div>';
							$txt .= '<input type="hidden" name="noact" value="'.$id.'">';
							$txt .= '<input type="hidden" name="nopla" value="'.$nopla.'">';
						$txt .= '</div>';

						$txt .= '<div class="modal-footer">';
							if($msg)
								$txt .= '<span class="txtfoot">'.$msg.'</span>';
							$txt .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
		        			$txt .= '<input type="submit" class="btn btn-primary" value="Guardar">';
						$txt .= '</div>';
					$txt .= '</form>';
				$txt .= '</div>';
			$txt .= '</div>';
		$txt .= '</div>';

		return $txt;
	}

// Ventana modal texto y combobox
	public static function modalTextCombo($nonven, $titulo, $id, $dtmos, $ruta, $dttxt, $nopla, $nomact, $est, $nomnb="", $dtnb="", $nomnb2="", $dtnb2="", $msg="",$vlmin="0"){
		$txt = '';

		$txt .= '<div class="modal" id="'.$nonven.$id.'" tabindex="-1"  aria-labelledby="'.$nonven.$id.'" aria-hidden="true">';
			$txt .= '<div class="modal-dialog">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h3 class="modal-title">'.$titulo.'</h3>';
						$txt .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>';
					$txt .= '</div>';

					$txt .= '<form name="frmpxp" action="'.$ruta.'" method="POST" enctype="multipart/form-data">';
						$txt .= '<div class="modal-body">';
							// $txt .= '<h6>'.$nombre.'</h6>';

							$txt .= '<div class="row">';
								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<h6>';
										$txt .= "(Actividad) ".$nomact;
										$txt .= " <strong>".$nomnb.":</strong> ".$est;
									$txt .= '</h6>';
								$txt .= '</div>';
								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<label for="'.$dttxt.'">';
										$txt .= $dtmos;
									$txt .= '</label>';
									$txt .= '<textarea name="'.$dttxt.'" class="form-control form-control-sm" required ></textarea>';
								$txt .= '</div>';

								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<label for="'.$dtnb2.'">';
										$txt .= $nomnb2;
									$txt .= '</label>';

									$txt .= '<input type="number" name="'.$dtnb2.'" id="'.$dtnb2.'" class="form-control" min="'.$vlmin.'" max="100" value="'.($vlmin+1).'">';
								$txt .= '</div>';

								/*$txt .= '<div class="form-group col-md-12">';
									$txt .= '<label for="'.$dtnb.'">';
										$txt .= $nomnb;
									$txt .= '</label>';

									$txt .= '<select name="'.$dtnb.'" id="'.$dtnb.'" class="form-select form-select-sm" style="width: 100%;">';
											$txt .= '<option value="0">Automático</option>';
										if($est){ foreach ($est as $do){ if($do['valid']>1803)
							                $txt .= '<option value="'.$do['valid'].'">'.$do['valnom'].'</option>';
								        }}
									$txt .= '</select>';
								$txt .= '</div>';*/

							$txt .= '</div>';
							$txt .= '<input type="hidden" name="noava" value="'.$id.'">';
							$txt .= '<input type="hidden" name="nopla" value="'.$nopla.'">';
							$txt .= '<input type="hidden" name="fecter" value="'.$est.'">';
						$txt .= '</div>';

						$txt .= '<div class="modal-footer">';
							if($msg)
								$txt .= '<span class="txtfoot">'.$msg.'</span>';
							$txt .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
		        			$txt .= '<input type="submit" class="btn btn-primary" value="Guardar">';
						$txt .= '</div>';
					$txt .= '</form>';
				$txt .= '</div>';
			$txt .= '</div>';
		$txt .= '</div>';

		return $txt;
	}
// Ventana modal texto y combobox Edición
	public static function modalTextComboEdi($nonven, $titulo, $id, $dtmos, $ruta, $dttxt, $nopla, $nomact, $est, $nomnb="", $dtnb="", $nomnb2="", $dtnb2="", $msg="", $noplsg="",$anaseg="",$ejesep="", $vlmin="0"){
		$txt = '';

		$txt .= '<div class="modal" id="'.$nonven.$id.'" tabindex="-1"  aria-labelledby="'.$nonven.$id.'" aria-hidden="true">';
			$txt .= '<div class="modal-dialog">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h3 class="modal-title">'.$titulo.'</h3>';
						$txt .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>';
					$txt .= '</div>';

					$txt .= '<form name="frmpxp" action="'.$ruta.'" method="POST" enctype="multipart/form-data">';
						$txt .= '<div class="modal-body">';
							// $txt .= '<h6>'.$nombre.'</h6>';

							$txt .= '<div class="row">';
								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<h6>';
										$txt .= "(Actividad) ".$nomact;
										$txt .= " <strong>".$nomnb.":</strong> ".$est;
									$txt .= '</h6>';
								$txt .= '</div>';
								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<label for="'.$dttxt.'">';
										$txt .= $dtmos;
									$txt .= '</label>';
									$txt .= '<textarea name="'.$dttxt.'" class="form-control form-control-sm" required >'.$anaseg.'</textarea>';
								$txt .= '</div>';

								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<label for="'.$dtnb2.'">';
										$txt .= $nomnb2;
									$txt .= '</label>';

									$txt .= '<input type="number" name="'.$dtnb2.'" id="'.$dtnb2.'" class="form-control" min="'.$vlmin.'" max="100" value="'.$ejesep.'">';
								$txt .= '</div>';

							$txt .= '</div>';
							$txt .= '<input type="hidden" name="noplsg" value="'.$noplsg.'">';
							$txt .= '<input type="hidden" name="noava" value="'.$id.'">';
							$txt .= '<input type="hidden" name="nopla" value="'.$nopla.'">';
							$txt .= '<input type="hidden" name="fecter" value="'.$est.'">';
						$txt .= '</div>';

						$txt .= '<div class="modal-footer">';
							if($msg)
								$txt .= '<span class="txtfoot">'.$msg.'</span>';
							$txt .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
		        			$txt .= '<input type="submit" class="btn btn-primary" value="Guardar">';
						$txt .= '</div>';
					$txt .= '</form>';
				$txt .= '</div>';
			$txt .= '</div>';
		$txt .= '</div>';

		return $txt;
	}

// Ventana modal texto y combobox Edición
	public static function modalTextCmbNew($nonven, $titulo, $id, $dtmos, $ruta, $dttxt, $nomcmb, $dtcmb, $dtall, $msg=""){
		$txt = '';

		$txt .= '<div class="modal" id="'.$nonven.$id.'" tabindex="-1"  aria-labelledby="'.$nonven.$id.'" aria-hidden="true">';
			$txt .= '<div class="modal-dialog">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h3 class="modal-title">'.$titulo.'</h3>';
						$txt .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>';
					$txt .= '</div>';

					$txt .= '<form name="frmpxp" action="'.$ruta.'" method="POST" enctype="multipart/form-data">';
						$txt .= '<div class="modal-body">';
							$txt .= '<div class="row">';
								$txt .= '<div class="form-group col-md-12">';
								$txt .= '</div>';
								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<label for="'.$dttxt.'">';
										$txt .= $dtmos;
									$txt .= '</label>';
									$txt .= '<textarea name="'.$dttxt.'" class="form-control form-control-sm" required ></textarea>';
								$txt .= '</div>';

								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<label for="'.$dtcmb.'">';
										$txt .= $nomcmb;
									$txt .= '</label>';

									$txt .= '<select name="'.$dtcmb.'" id="'.$dtcmb.'" class="form-control form-select" style="height: 41px;">';
									if($dtall){ foreach($dtall as $dt){
										$txt .= '<option value="'.$dt['valid'].'">'.$dt['valnom'].'</option>';
									}}
									$txt .= '</select>';
								$txt .= '</div>';
							$txt .= '</div>';
							$txt .= '<input type="hidden" name="denid" value="'.$id.'">';
						$txt .= '</div>';

						$txt .= '<div class="modal-footer">';
							if($msg)
								$txt .= '<span class="txtfoot">'.$msg.'</span>';
							$txt .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
		        			$txt .= '<input type="submit" class="btn btn-primary" value="Guardar">';
						$txt .= '</div>';
					$txt .= '</form>';
				$txt .= '</div>';
			$txt .= '</div>';
		$txt .= '</div>';

		return $txt;
	}

// Ventana modal un texto
	public static function modalUnText($nonven, $titulo, $id, $dtmos, $ruta, $dttxt, $nopla, $nomnb="", $dtnb="", $msg="",$nom="",$oc=""){
		$txt = '';

		$txt .= '<div class="modal" id="'.$nonven.$id.'" tabindex="-1"  aria-labelledby="'.$nonven.$id.'" aria-hidden="true">';
			$txt .= '<div class="modal-dialog">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h3 class="modal-title">'.$titulo.'</h3>';
						$txt .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>';
					$txt .= '</div>';

					$txt .= '<form name="frmpxp" action="'.$ruta.'" method="POST">';
						$txt .= '<div class="modal-body">';
							// $txt .= '<h6>'.$nombre.'</h6>';

							$txt .= '<div class="row">';
								if($nom){
									$txt .= '<div class="form-group col-md-12">';
										$txt .= '<h6>';
											$txt .= "(Acción) ".$nom;
										$txt .= '</h6>';
									$txt .= '</div>';
								}
								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<label for="'.$dttxt.'">';
										$txt .= $dtmos;
									$txt .= '</label>';
									$txt .= '<textarea name="'.$dttxt.'"  class="form-control form-control-sm" required >'.$oc.'</textarea>';
								$txt .= '</div>';
							$txt .= '</div>';
							$txt .= '<input type="hidden" name="noacc" value="'.$id.'">';
							$txt .= '<input type="hidden" name="nopla" value="'.$nopla.'">';
						$txt .= '</div>';

						$txt .= '<div class="modal-footer">';
							if($msg)
								$txt .= '<span class="txtfoot">'.$msg.'</span>';
							$txt .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
		        			$txt .= '<input type="submit" class="btn btn-primary" value="Guardar">';
						$txt .= '</div>';
					$txt .= '</form>';
				$txt .= '</div>';
			$txt .= '</div>';
		$txt .= '</div>';

		return $txt;
	}


// Ventana modal un texto con botonera Abierto Cerrado
	public static function modalUnTextAbCe($nonven, $titulo, $id, $dtmos, $ruta, $dttxt, $nopla, $nomnb="", $dtnb="", $msg="",$nom="",$oc="",$dtmt=""){
		$txt = '';

		$txt .= '<div class="modal" id="'.$nonven.$id.'" tabindex="-1"  aria-labelledby="'.$nonven.$id.'" aria-hidden="true">';
			$txt .= '<div class="modal-dialog">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h3 class="modal-title">'.$titulo.'</h3>';
						$txt .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>';
					$txt .= '</div>';

					$txt .= '<form name="frmpxp" action="'.$ruta.'" method="POST">';
						$txt .= '<div class="modal-body">';
							// $txt .= '<h6>'.$nombre.'</h6>';

							$txt .= '<div class="row">';
								if($nom){
									$txt .= '<div class="form-group col-md-12">';
										$txt .= '<h6>';
											$txt .= "(Acción) ".$nom;
										$txt .= '</h6>';
									$txt .= '</div>';
								}
								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<label for="'.$dttxt.'">';
										$txt .= $dtmos;
									$txt .= '</label>';
									//$txt .= '<textarea name="'.$dttxt.'"  class="form-control form-control-sm" required >'.$oc.'</textarea>';
									$txt .= '<textarea name="'.$dttxt.'"  class="form-control form-control-sm" required ></textarea>';
								$txt .= '</div>';
							if($dtmt){ foreach ($dtmt as $dm) {
								$txt .= '<div class="form-group col-md-3" style="text-align: left;font-size: 10px;margin-bottom: 0px;">';
									$txt .= $dm['feciepla'];
								$txt .= '</div>';
								$txt .= '<div class="form-group col-md-5" style="text-align: left;font-size: 10px;margin-bottom: 0px;">';
									$txt .= $dm['ocpla'];
								$txt .= '</div>';
								$txt .= '<div class="form-group col-md-4" style="text-align: right;font-size: 8px;margin-bottom: 0px;">';
									$txt .= $dm['pernom']." ".$dm['perape'];
								$txt .= '</div>';
							}}
							$txt .= '</div>';
							$txt .= '<input type="hidden" name="noacc" value="'.$id.'">';
							$txt .= '<input type="hidden" name="nopla" value="'.$nopla.'">';
						$txt .= '</div>';

						$txt .= '<div class="modal-footer">';
							if($msg)
								$txt .= '<span class="txtfoot">'.$msg.'</span>';
							$txt .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
		        			$txt .= '<input type="submit" name="btnCas" class="btn btn-primary" value="Abierto">';
		        			$txt .= '<input type="submit" name="btnCas" class="btn btn-primary" style="background-color: #ff0000;" value="Cerrado">';
						$txt .= '</div>';
					$txt .= '</form>';
				$txt .= '</div>';
			$txt .= '</div>';
		$txt .= '</div>';

		return $txt;
	}

// Ventana modal mostrar texto
	public static function modalMosCom($nonven, $titulo, $id, $dtmos, $ruta, $dttxt, $nopla, $come, $nomnb="", $msg=""){
		$txt = '';

		$txt .= '<div class="modal" id="'.$nonven.$id.'" tabindex="-1"  aria-labelledby="'.$nonven.$id.'" aria-hidden="true">';
			$txt .= '<div class="modal-dialog">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h3 class="modal-title">'.$titulo.'</h3>';
						$txt .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>';
					$txt .= '</div>';

					$txt .= '<form name="frmpxp" action="'.$ruta.'" method="POST">';
						$txt .= '<div class="modal-body">';
							// $txt .= '<h6>'.$nombre.'</h6>';

							$txt .= '<div class="row">';
								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">';
								        $txt .= '<thead>';
								            $txt .= '<tr>';
								            	$txt .= '<th>'.$dtmos.'</th>';
								            $txt .= '</tr>';
								        $txt .= '</thead>';
								        $txt .= '<tbody>';
								        	if(isset($come)){
								        		foreach ($come as $va){
									            $txt .= '<tr>';
									            	$txt .= '<td>';
									            		$txt .= "<small>";
										            		$txt .= $va['relcom'];
										            		$txt .= "<br>";
															$txt .= "<small><small>";
																$txt .= $va['nodocemp']." - ".$va['pernom']." ".$va['perape'];
																$txt .= "<br>";
										            			$txt .= $va['fechcom'];
										            		$txt .= "</small></small>";
										            	$txt .= "</small>";
									                $txt .= '</td>';
									            $txt .= '</tr>';
									        }}
								        $txt .= '</tbody>';
								        $txt .= '<tfoot>';
								            $txt .= '<tr>';
								            	$txt .= '<th>'.$dtmos.'</th>';
								            $txt .= '</tr>';
								        $txt .= '</tfoot>';
								    $txt .= '</table>';
								$txt .= '</div>';
							$txt .= '</div>';
							$txt .= '<input type="hidden" name="noplm" value="'.$id.'">';
							$txt .= '<input type="hidden" name="nopla" value="'.$nopla.'">';
						$txt .= '</div>';

						$txt .= '<div class="modal-footer">';
							if($msg)
								$txt .= '<span class="txtfoot">'.$msg.'</span>';
							$txt .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
		        			$txt .= '<input type="submit" class="btn btn-primary" value="Guardar">';
						$txt .= '</div>';
					$txt .= '</form>';
				$txt .= '</div>';
			$txt .= '</div>';
		$txt .= '</div>';

		return $txt;
	}

	//Ventana Modal para carga de archivo
	public static function modalfile($nonven, $titulo, $id, $nombre, $ruta, $codrub, $arrman="No", $msg=""){
		$txt = '';

		$txt .= '<div class="modal" id="'.$nonven.$id.'" tabindex="-1"  aria-labelledby="'.$nonven.$id.'" aria-hidden="true">';
			$txt .= '<div class="modal-dialog">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h3 class="modal-title">'.$titulo.'</h3>';
						$txt .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>';
					$txt .= '</div>';
					$txt .= '<form name="frmpxp" action="'.$ruta.'" method="POST" enctype="multipart/form-data">';
						$txt .= '<div class="modal-body">';
							$txt .= '<label for="denarc">'.$nombre.'</label>';
							$txt .= '<input type="file" class="form-control form-control-sm" id="rutcdp" name="arch" accept="image/*, video/*, .doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf,.xls,.xlsx,.ppt,.pptx,.zip,.rar" style="height: 50px;" required />';
							
							$txt .= '<small><small><span style="color: #ff0000;font-weight: bold;">';
								if($msg)
									$txt .= $msg;
								else
									$txt .= '* Cargue el memorando, para solicitar la liberación, del CDP total o parcialmente.';
							$txt .= '</span></small></small>';

							$txt .= '<input type="hidden" name="id" value="'.$id.'">';
							$txt .= '<input type="hidden" name="cod" value="'.$codrub.'">';
						$txt .= '</div>';

						$txt .= '<div class="modal-footer">';
							/* if($msg)
								$txt .= '<span class="txtfoot">'.$msg.'</span>'; */
							$txt .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
		        			$txt .= '<input type="submit" class="btn btn-primary" value="Guardar">';
						$txt .= '</div>';
					$txt .= '</form>';
				$txt .= '</div>';
			$txt .= '</div>';
		$txt .= '</div>';

		return $txt;
	}

	//Ventana Modal para Enviar Email
	public static function modalTextEmail($nonven, $titulo, $id, $nombre, $ruta, $arrman="No", $msg=""){
		$txt = '';

		$txt .= '<div class="modal" id="'.$nonven.$id.'" tabindex="-1"  aria-labelledby="'.$nonven.$id.'" aria-hidden="true">';
			$txt .= '<div class="modal-dialog">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h3 class="modal-title">'.$titulo.'</h3>';
						$txt .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>';
					$txt .= '</div>';
					$txt .= '<form name="frmpxp" action="'.$ruta.'" method="POST" enctype="multipart/form-data">';
						$txt .= '<div class="modal-body">';
							$txt .= '<label for="emaenv">'.$nombre.'</label>';
							$txt .= '<input type="text" class="form-control form-control-sm" id="emaenv" name="emaenv" placeholder="Correos a enviar documento" required />';
							
							$txt .= '<small><small><span style="color: #ff0000;font-weight: bold;">';
								if($msg)
									$txt .= $msg;
								else
									$txt .= '* Puede enviar varios correos al tiempo, separando cada uno con coma (,).';
							$txt .= '</span></small></small>';

							$txt .= '<input type="hidden" name="id" value="'.$id.'">';
						$txt .= '</div>';

						$txt .= '<div class="modal-footer">';
							$txt .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
		        			$txt .= '<input type="submit" class="btn btn-primary" value="Enviar">';
						$txt .= '</div>';
					$txt .= '</form>';
				$txt .= '</div>';
			$txt .= '</div>';
		$txt .= '</div>';

		return $txt;
	}

	public static function salir(){
		$txt = '';
		$txt .= '<div id="content" class="p-4 p-md-5 pt-5">';
		if (isset($_SESSION['identity'])) {
			include'../../mod/config/models/peredit.php';		

		$perid2= $_SESSION['identity']->perid;

		$edit2 = true;
		
		$persona2 = new Peredit();
		$persona2->setPerid($perid2);
		$personas2 = $persona2->getAll();
		$areas2 = $persona2->getAllArea(1);
		$val2 = $persona2->getOne();

		// var_dump($val2);
		// die();

		
		

			$txt .= '<div class="container">';
				$txt .= '<div class="user-section">';
					$txt .= '<img src="'.base_url.'img/user-profile.png" alt="">';
					$txt .= '<div class="dropdown">';
						$txt .= '<button class="btn-transparent-canalc dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><strong>';
						$nomb = $_SESSION['identity']->pernom.' '.$_SESSION['identity']->perape;
						$txt .= $nomb;
						$txt .= '</strong></button><br>';
						$txt .= '<small>'.$_SESSION['pefnom'].'</small>';
						$txt .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
							$txt .= '<a class="dropdown-item" href="'.base_raiz.'usuario/logout" >
								<i class="fa fa-power-off" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Cerrar Sesión
								</a>';
							
							$txt .= '<a class="dropdown-item" style="cursor:pointer;" data-toggle="modal" data-target="#myModEpf"><i class="fas fa-user-edit" data-toggle="modal" data-target="#myModEpf" title="Editar Perfil" aria-hidden="true" style="color: #523178;"></i>&nbsp;&nbsp;&nbsp;Editar Perfil</a>';

							$txt .= '<a class="dropdown-item" style="cursor:pointer;" data-toggle="modal" data-target="#myModFir"><i class="fas fa-file-signature" data-toggle="modal" data-target="#myModFir" title="Registrar Firmar" aria-hidden="true" style="color: #523178;"></i>&nbsp;&nbsp;&nbsp;Registrar Firma</a>';
					

							// $txt .= '<a class="dropdown-item" href="'.base_raiz2.'persona/editPerf" >
							// 	<i class="fas fa-user-edit" aria-hidden="true"></i>
							// 	Editar Perfil
							// 	</a>';	

						$txt .= '</div>';
					$txt .= '</div>';
				$txt .= '</div>';
				$txt .= '<div class="cont-wrapper">';


				$txt .= '<div class="modal" id="myModEpf" tabindex="-1"  aria-labelledby="myModEpf" aria-hidden="true">';
					$txt .= '<div class="modal-dialog">';
						$txt .= '<div class="modal-content" style="width:810px">';
							$txt .= '<div class="modal-header">';
								$txt .= '';
								$txt .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>';
							$txt .= '</div>';							

							$txt .= '<div id="inser2" style="padding: 30px;">';
								if(isset($edit2) && isset($val2)):
									$txt .= '<h2 class="title-c m-tb-40">Editar persona F. </h2>';
									//$url_action = base_raiz2."persona/editPUser&perid=".$val2[0]["perid"];
									$url_action = base_raiz2."persona/editPUser&perid=".$val2[0]['perid']; 
									// var_dump($url_action);
									// die();
								else:
									//$url_action = base_url."persona/save";
								endif;

								$txt .= '<form class="m-tb-40" action="'.$url_action.'" method="POST">';
									$txt .= '<div class="row">';

										if(isset($val2) && $perid2){
											$txt .= '<input type="hidden" class="form-control form-control-sm" id="perid2" name="perid2" value="';
												$txt .= isset($val2) ? $val2[0]["perid"] : "";
											$txt .= '"/>';
										}
										$txt .= '<div class="form-group col-md-6">';
											$txt .= '<label for="pernom2">Nombre</label>';
											$txt .= '<input type="text" class="form-control form-control-sm" id="pernom2" name="pernom2" value="';
												$txt .= isset($val2) ? $val2[0]["pernom"] : "";
											$txt .= '" required />';
										$txt .= '</div>';
										$txt .= '<div class="form-group col-md-6">';
											$txt .= '<label for="perape2">Apellido</label>';
											$txt .= '<input type="text" class="form-control form-control-sm" id="perape2" name="perape2" value="';
												$txt .= isset($val2) ? $val2[0]["perape"] : "";
											$txt .= '" required />';
										$txt .= '</div>';
										$txt .= '<div class="form-group col-md-6">';
											$txt .= '<label for="peremail2">Email</label>';
											$txt .= '<input type="email" class="form-control form-control-sm" id="peremail2" name="peremail2" value="';
												$txt .= isset($val2) ? $val2[0]["peremail"] : "";
											$txt .= '" required readonly=""/>';
										$txt .= '</div>';
										$txt .= '<div class="form-group col-md-6">';
											$txt .= '<label for="perpass2">Contraseña</label>';
											$txt .= '<input type="password" class="form-control form-control-sm" id="perpass2" name="perpass2" />';
										$txt .= '</div>';
										$txt .= '<input type="hidden" class="form-control form-control-sm" id="ubiid2" name="ubiid2" value="11001" />';
										$txt .= '<div class="form-group col-md-6">';
											$txt .= '<label for="perdir2">Dirección</label>';
											$txt .= '<input type="text" class="form-control form-control-sm" id="perdir2" name="perdir2" value="';
												$txt .= isset($val2) ? $val2[0]["perdir"] : "";
											$txt .= '" />';
										$txt .= '</div>';
										$txt .= '<div class="form-group col-md-6">';
											$txt .= '<label for="pertel2">No. Teléfono</label>';
											$txt .= '<input type="number" class="form-control form-control-sm" id="pertel2" name="pertel2" value="';
												$txt .= isset($val2) ? $val2[0]["pertel"] : "";
											$txt .= '" />';
										$txt .= '</div>';
										$txt .= '<div class="form-group col-md-6">';
											$txt .= '<label for="percel2">No. Celular</label>';
											$txt .= '<input type="number" class="form-control form-control-sm" id="percel2" name="percel2" value="';
												$txt .= isset($val2) ? $val2[0]["percel"] : "";
											$txt .= '" />';
										$txt .= '</div>';
										$txt .= '<input type="hidden" class="form-control form-control-sm" id="envema2" name="envema2" value="1" />';


										$txt .= '<div class="form-group col-md-6">';			
											$txt .= '<input type="submit" class="btn-primary-ccapital" value="Actualizar">';

										$txt .= '</div>';

									$txt .= '</div>';
								$txt .= '</form>';
							$txt .= '</div>';
						$txt .= '</div>';
					$txt .= '</div>';
				$txt .= '</div>';

// --------------------------- Firma -----------------------------------------------

				$txt .= '<div class="modal" id="myModFir" tabindex="-1"  aria-labelledby="myModFir" aria-hidden="true">';
					$txt .= '<div class="modal-dialog">';
						$txt .= '<div class="modal-content" style="width:810px">';
							$txt .= '<div class="modal-header">';
								$txt .= '';
								$txt .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>';
							$txt .= '</div>';							

							$txt .= '<div id="inser2" style="padding: 30px;">';
								if(isset($edit2) && isset($val2)):
									$txt .= '<h2 class="title-c m-tb-40">Registrar Firma</h2>';
									$url_action = base_raiz."views/firma.php?idusu=".$val2[0]['perid']; 
								endif;
								$txt .= '<br><br>';
								$txt .= '<div style="display: inline-block;">';
									$txt .= '<iframe id="firmaInt" title="Firma" width="400px" height="230px" src="'.$url_action.'" style="border: 0px solid #fff;"></iframe>';
								$txt .= '</div>';

								$txt .= '<div style="display: inline-block;width: 300px;">';
									$txt .= '<h5>Recomendaciones</h5>';
									$txt .= '<ul>';
										$txt .= '<li>Por favor realice su firme en el recuadro y presione el botón Guardar.</li>';
										$txt .= '<li>En la parte inferior puede visualizar su firma guardada.</li>';
										$txt .= '<li>Si lo desea puede limpiar el recuadro presionando el botón Limpiar y vuelva a repetir el proceso</li>';
									$txt .= '</ul>';
									$txt .= '<br>';
								$txt .= '</div>';

								$url_action2 = base_raiz."modulo/firm";
								$txt .= '<div style="display: inline-block;width: 300px;height: 80px;">';
									$txt .= '<form name="frm4" action="'.$url_action2.'" method="POST" enctype="multipart/form-data">';
										$txt .= '<h5>Cargar Firma desde archivo</h5>';
										//$txt .= '<br>';
										$txt .= '<div style="display: inline-block;width: 220px;">';
											$txt .= '<input type="file" class="form-control form-control-sm" id="rutcdp" name="arch" accept="image/*, .pdf" style="height: 40px;" required >';
											//$txt .= '<input type="hidden" name="arch" value="prueba" />';
										$txt .= '</div>';
										$txt .= '<div style="display: inline-block;width: 70px;    margin-left: 10px;">';
											$txt .= '<input type="submit" class="btn-secondary-canalc" style="margin-top: 0px;" value="Enviar" />';
										$txt .= '</div>';
										$txt .= '<br>';
										$txt .= '<small><small><span style="color: #ff0000;font-weight: bold;">* Suba un solo archivo de imagen (png o jpg).</span></small></small>';
										
									$txt .= '</form>';
									$txt .= '<br>';
								$txt .= '</div>';
							$txt .= '</div>';
							$txt .= '<div class="modal-footer" style="justify-content: start;">';
								$txt .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">';
									$txt .= 'Cerrar';
								$txt .= '</button>';
							$txt .= '</div>';
						$txt .= '</div>';
					$txt .= '</div>';
				$txt .= '</div>';

// --------------------------- Fin Firma -------------------------------------------

			
		}
		return $txt;
		
	}

	public static function salirmod(){
		$txt = '';
		$txt .= '<div id="content" class="p-4 p-md-5 pt-5">';

			$txt .= '<div class="container">';
				$txt .= '<div class="user-section" style="text-align:right;">';
					$txt .= '<img src="'.base_url.'img/user-profile.png" alt="">';
					
						$txt .= '<a class="dropdown-item" href="../usuario/logout" >
							<i class="fa fa-power-off" aria-hidden="true"></i>
							Cerrar Sesión
							</a>';
						
				$txt .= '</div>';
				$txt .= '<div class="cont-wrapper">';
		return $txt;
	}

// Metodo getDiasHabiles

	public static function getDiasHabiles($fechainicio, $fechafin, $diasferiados = array()) {
	        $fechainicio = strtotime($fechainicio);
	        $fechafin = strtotime($fechafin);
	        $diainc = 24*60*60;
	        $diashabiles = array();
	        for ($midia = $fechainicio; $midia <= $fechafin; $midia += $diainc) {
	            if (!in_array(date('N', $midia), array(6,7))) {
	                if (!in_array(date('Y-m-d', $midia), $diasferiados)) {
	                        array_push($diashabiles, date('Y-m-d', $midia));
	                }
	            }
	        }
	       	
	       	$ndhab = count($diashabiles);
	        return $ndhab;
	}

	/*

	var_dump(getDiasHabiles('2021-06-01', '2021-06-30', ['2021-06-07','2021-06-14']));

	echo "<br><br><strong>Días habiles: ".getDiasHabiles('2021-06-01', '2021-06-30', ['2021-06-07', '2021-06-14'])."</strong>";

	*/



//////////    Class de extracción ////////////////////////////////////////////////////////////


	/**
     * Checks file extension and calls suitable extractor functions.
     *
     * @param $archive
     * @param $destination
     */
    public static function extract($archive, $destination, $name){


        $ext = pathinfo($archive, PATHINFO_EXTENSION);
        //echo $ext;
        //echo "<br><br>".$archive." - ".$destination." - ".$name."<br><br>";
        //die();
        switch ($ext){
            case 'zip':
                $res = self::extractZipArchive($archive, $destination, $name);
                break;
            case 'gz':
                $res = self::extractGzipFile($archive, $destination, $name);
                break;
            case 'rar':

                $res = self::extractRarArchive($archive, $destination, $name);
                break;
        }

        return $res;
    }
    
    /**
     * Decompress/extract a zip archive using ZipArchive.
     *
     * @param $archive
     * @param $destination
     */
    public static function extractZipArchive($archive, $destination, $name){
        // Check if webserver supports unzipping.
        if(!class_exists('ZipArchive')){
            $GLOBALS['status'] = array('error' => 'Your PHP version does not support unzip functionality.');
            return false;
        }
        $zip = new ZipArchive;
    
        // Check if archive is readable.
        if($zip->open($archive) === TRUE){
            // Check if destination is writable
            if(is_writeable($destination . '/')){
                $zip->extractTo($destination);
                $zip->close();
                $GLOBALS['status'] = array('success' => 'Files unzipped successfully');
                return true;
            }else{
                $GLOBALS['status'] = array('error' => 'Directory not writeable by webserver.');
                return false;
            }
        }else{
            $GLOBALS['status'] = array('error' => 'Cannot read .zip archive.');
            return false;
        }
    }
    
    /**
     * Decompress a .gz File.
     *
     * @param $archive
     * @param $destination
     */
    public static function extractGzipFile($archive, $destination, $name){
        // Check if zlib is enabled

        if(!function_exists('gzopen')){
            $GLOBALS['status'] = array('error' => 'Error: Your PHP has no zlib support enabled.');
            return false;
        }

        $filename = pathinfo($archive, PATHINFO_FILENAME);
// echo "Vamos bien.. ".path_file.$archive."<br><br><br>";
// echo "Vamos bien.. ".path_filem.$archive."<br><br><br>";
		$gzipped = gzopen(path_file.$archive, "rb");
        //$gzipped = gzopen(path_filem.$archive, "rb");

        $file = fopen($filename, "w");
    
        while ($string = gzread($gzipped, 4096)) {
            fwrite($file, $string, strlen($string));
        }
        gzclose($gzipped);

        fclose($file);
        $name = substr($name, 0, strpos($name, ".gz"));
        // echo $filename." ----- ".$destination.'/'.$name;
        // die();

        rename($filename, $destination.'/'.$name);
    
        // Check if file was extracted.
        if(file_exists($destination.'/'.$name)){
            $GLOBALS['status'] = array('success' => 'File unzipped successfully.');
            if(file_exists(path_file.$archive)) unlink(path_file.$archive);
            return true;
        }else{
            $GLOBALS['status'] = array('error' => 'Error unzipping file.');
            return false;
        }
    }
    
    /**
     * Decompress/extract a Rar archive using RarArchive.
     *
     * @param $archive
     * @param $destination

     */
    public static function extractRarArchive($archive, $destination, $name){
        // Check if webserver supports unzipping.
        if(!class_exists('RarArchive')){
            $GLOBALS['status'] = array('error' => 'Your PHP version does not support .rar archive functionality.');
            return false;
        }
        // Check if archive is readable.
        if($rar = RarArchive::open($archive)){

            // Check if destination is writable
            if (is_writeable($destination . '/')) {
                $entries = $rar->getEntries();
                foreach ($entries as $entry) {
                    $entry->extract($destination);
                }
                $rar->close();
                $GLOBALS['status'] = array('success' => 'File extracted successfully.');
                return true;
            }else{
                $GLOBALS['status'] = array('error' => 'Directory not writeable by webserver.');
                return false;
            }
        }else{
            $GLOBALS['status'] = array('error' => 'Cannot read .rar archive.');
            return false;
        }
    }

    //Cargar datos para enviar mail
    public static function carsenmail(){
		require '../../PHPMailer/src/Exception.php';
		require '../../PHPMailer/src/PHPMailer.php';
		require '../../PHPMailer/src/SMTP.php';
	}

    //Enviar E-mail
    public static function sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$stick,$diri,$txt_message,$mail_subject,$firm,$dadj, $template){

		// require '../../PHPMailer/src/Exception.php';
		// require '../../PHPMailer/src/PHPMailer.php';
		// require '../../PHPMailer/src/SMTP.php';

	//require 'PHPMailer/get_oauth_token.php';
		$mail = new PHPMailer(true);
		$mail->isSMTP();                            // Establecer el correo electrónico para utilizar SMTP
		$mail->Host = 'smtp.gmail.com';             // Especificar el servidor de correo a utilizar 
		$mail->SMTPAuth = true;                     // Habilitar la autenticacion con SMTP
		$mail->Username = $mail_username;          // Correo electronico saliente ejemplo: tucorreo@gmail.com
		$mail->Password = $mail_userpassword; 		// Tu contraseña de gmail
		$mail->SMTPSecure = 'tls';                  // Habilitar encriptacion, `ssl` es aceptada
		$mail->Port = 587;                          // Puerto TCP  para conectarse 
		$mail->setFrom($mail_setFromEmail, $mail_setFromName);//Introduzca la dirección de la que debe aparecer el correo electrónico. Puede utilizar cualquier dirección que el servidor SMTP acepte como válida. El segundo parámetro opcional para esta función es el nombre que se mostrará como el remitente en lugar de la dirección de correo electrónico en sí.
		$mail->addReplyTo($mail_setFromEmail, $mail_setFromName);//Introduzca la dirección de la que debe responder. El segundo parámetro opcional para esta función es el nombre que se mostrará para responder
		$mail->addAddress($mail_addAddress);   // Agregar quien recibe el e-mail enviado
		$message = file_get_contents($template);
		$message = str_replace('{{first_name}}', $mail_setFromName, $message);
		$message = str_replace('{{stick}}', $stick, $message);
		$message = str_replace('{{diri}}', $diri, $message);
		$message = str_replace('{{subject}}', $mail_subject, $message);
		$message = str_replace('{{message}}', $txt_message, $message);
		$message = str_replace('{{firm}}', $firm, $message);
		$message = str_replace('{{dadj}}', $dadj, $message);
		
		$message = str_replace('{{customer_email}}', $mail_setFromEmail, $message);
		$mail->isHTML(true);  // Establecer el formato de correo electrónico en HTML
		
		$mail->Subject = "Respuesta: ".$mail_subject;
		$mail->msgHTML($message);
		if(!$mail->send()) {
			//echo '<p style="color:red">No se pudo enviar el mensaje..';
			echo '<script>alert("No se pudo enviar el mensaje.. '.$mail->ErrorInfo.'");</script>';
			//echo 'Error de correo: ' . ;
			//echo "</p>";
		} else {
			//echo '<p style="color:green">Tu mensaje ha sido enviado!</p>';
			echo '<script>alert("Tu mensaje ha sido enviado!");</script>';
		}
	}
	
}