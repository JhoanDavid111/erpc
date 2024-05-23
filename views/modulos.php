<?php 
require_once '../autoload.php';
require_once '../config/db.php';
require_once '../config/parameters.php';
require_once '../helpers/utils.php';
require_once '../models/modulos.php';
require_once '../models/modalertas.php';
//require_once '../controllers/ModuloController.php';
session_start();

if(!isset($_SESSION['identity'])){
    session_start();
    session_destroy();
    header("Location:".base_url);
}

if ($_SESSION['salio']==true) {
    session_destroy();
    // var_dump($_SESSION['salio']);
    // die();
    header('Location:../index.php');
    
}



// if(!isset($_SESSION['ctrlnav'])){
//     //session_destroy();
//     header('Location:../index.php');

// }

$_SESSION['ctrlnav']++;

// if(empty($_SESSION['identity'])){
//     echo "<script> document.location.href = "login.php" </script>";
//     }

//require_once 'helpers/utils.php';
ob_start();
//session_start();



// var_dump($_SESSION['identity']);
// die();



//Utils::isIdentity();


// require_once 'autoload.php';
// //require_once 'config/db.php';
// require_once 'config/parameters.php';

 ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canal Capital</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css?ver=3.0">
    <link rel="icon" href="https://intranet.canalcapital.gov.co/intranet/new_security_cc/wp-content/uploads/2020/04/cropped-icocanal-32x32.png" sizes="32x32" />
    <link rel="icon" href="https://intranet.canalcapital.gov.co/intranet/new_security_cc/wp-content/uploads/2020/04/cropped-icocanal-192x192.png" sizes="192x192" />
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

</head>

<body>
    <header id="encabezado">
       <div class="wrapper-header">
        <section class="encabezado-a">
            <div class="encabezado-a-2">
                <div class="redesp">
                    <a href="https://www.facebook.com/CanalCapitalOficial" title="Facebook CanalCapitalOficial" target="_blank">
                        <span class="icono">
                            <i class="redes-m fab fa-facebook-f"></i>
                        </span>
                    </a>
                    <a href="https://twitter.com/canalcapital" title="Twitter canalcapital" target="_blank">
                        <span class="icono">
                            <i class="fab fa-twitter"></i>
                        </span>
                    </a>
                    <a href="https://www.instagram.com/canalcapitaloficial/" title="Instagram canalcapitaloficial" target="_blank">
                        <span class="icono">
                            <i class="fab fa-instagram"></i>
                        </span>
                    </a>
                    <a href="https://www.youtube.com/user/CanalCapitalBogota" title="Youtube CanalCapitalBogota" target="_blank">
                        <span class="icono">
                            <i class="fab fa-youtube"></i>
                        </span>
                    </a>
                </div>
            </div>
        </section>
        <section class="encabezado-b">
                <div class="logo_entidad1">
                    <a href="http://www.canalcapital.gov.co/">
                        <img id="imaglog" src="https://intranet.canalcapital.gov.co/intranet/img/logocanal.png" alt="Logo Canal Capital">
                    </a>
                </div>
                <div class="logo_entidad2">
                    <a href="http://www.canalcapital.gov.co/">
                        <img typeof="foaf:Image" src="https://intranet.canalcapital.gov.co/intranet/img/logomejor.png" width="154" height="55" alt="Logo Bogotá mejor para todos" title="Logo Bogotá mejor para todos">
                    </a>
                </div>
        </section>
    </div><?=Utils::salirmod()?>
    </header>

    
  

    <main>  
        <div class="container">
            <h2>Bienvenido(a) <b><?=$_SESSION['identity']->pernom?></b></h2>
            <p>Por favor seleccione el módulo al que desea ingresar.</p>

            <div class="row cont-buttons">
                <?php 
                $mods = $_SESSION['mods'];
                $moduser = $_SESSION['moduser'];
                foreach ($mods as $md) { 
                    $act = false;
                    foreach ($moduser as $mu) {
                        if($md['idmod']==$mu['idmod']){
                            $act = true;
                            break;
                        }
                    }
                    $alert = NULL;
                    $titu = NULL;
                    if($act==true){
                        $mod = new Modulos();
                        $perfil = $mod->getPerfil($md['idmod'], $_SESSION['perid']);
                        $alerta = new Alertas();
                        switch($md['idmod']){
                            case 3: // Contratos               OK OK
                                $alert = $alerta->getAll3($perfil[0]['pefid'],$perfil[0]['depid']);
                                if($alert[0]['alerta']>0) $alert = $alert[0]['alerta']; else $alert = NULL;
                                if($alert>0) $titu = "En rojo: Número contratos en proceso en todos los años registrados"; else $titu = NULL;
                                break;
                            case 4: // Soporte                 OK OK
                                if($perfil[0]['pefid']==10){
                                    $alert = $alerta->getAll4();
                                    if($alert[0]['alerta']>0) $alert = $alert[0]['alerta']; else $alert = NULL;
                                    if($alert>0) $titu = "En rojo: Número de soportes pendientes"; else $titu = NULL;
                                }
                                if($perfil[0]['pefid']==27){
                                    $alert = $alerta->getAll4($_SESSION['perid']);
                                    if($alert[0]['alerta']>0) $alert = $alert[0]['alerta']; else $alert = NULL;
                                    if($alert>0) $titu = "En rojo: Número de soportes pendientes"; else $titu = NULL;
                                }
                                break;
                            case 8: // Financiera
                                if($perfil[0]['pefid']==31){
                                    $alert = $alerta->sumcdpR_area($perfil[0]['depid'],$_SESSION['vig']);
                                    if($alert[0]['alerta']>0) $alert = $alert[0]['alerta']; else $alert = NULL;
                                    if($alert>0) $titu = "En rojo: Número de CDPs pendientes por área"; else $titu = NULL;
                                }
                                if($perfil[0]['pefid']==21 OR $perfil[0]['pefid']==32 OR $perfil[0]['pefid']==34){
                                    // Para ver solo las de su área
                                    $alert = $alerta->getAll8_apr($perfil[0]['depid']);
                                    //$alert[0]['alerta'] = 0;
                                    // Para verlos todos
                                    //$alert = $alerta->sumcdpR();
                                    if($alert[0]['alerta']>0) $alert = $alert[0]['alerta']; else $alert = NULL;
                                    if($alert>0) $titu = "En rojo: Número de CDPs pendientes por Aprobar"; else $titu = NULL;
                                }
                                break;
                            case 9: // Denuncia                 OK (Falta Si esta leido o no)
                                if($perfil[0]['pefid']==24){
                                    $alert = $alerta->getAll9();
                                    if($alert[0]['alerta']>0) $alert = $alert[0]['alerta']; else $alert = NULL;
                                    if($alert>0) $titu = "En rojo: Número de denuncias registradas"; else $titu = NULL;
                                }
                                break;
                            case 10: // Solicitudes       OK
                                $alert = $alerta->getAll11("te");
                                if($alert[0]['alerta']>0) $alert = $alert[0]['alerta']; else $alert = NULL;
                                if($alert>0) $titu = "En rojo: Número de solicitudes sin respuesta"; else $titu = NULL;
                                break;
                            case 11: // Derechos de Autor       OK
                                $alert = $alerta->getAll11("da");
                                if($alert[0]['alerta']>0) $alert = $alert[0]['alerta']; else $alert = NULL;
                                if($alert>0) $titu = "En rojo: Número de preguntas sin respuesta"; else $titu = NULL;
                                break;
                        }
                    ?>
                        <div class="col-lg-4 text-center">
                            <button class="button" href="#" onclick="window.location.href='<?=base_url?>modulo/mod&id=<?=$md['idmod']?>';" data-aos="fade-down" data-aos-duration="500" title="<?=$titu;?>"> <img src="../<?=$md['icomod']?>" alt=""><br><?=$md['nommod']?>
                                <?php if(($md['idmod']==3 OR $md['idmod']==4 OR $md['idmod']==8 OR $md['idmod']==9 OR $md['idmod']==10 OR $md['idmod']==11) AND $alert){ ?>
                                    <div class="contspan">
                                        <span class="spCanalP1"><?=$alert;?></span>                       
                                    </div>
                                <?php }else{ echo "<br><br>"; } ?>
                            </button>
                            
                        </div>
                    <?php }else{ ?>
                        <div class="col-lg-4 text-center">
                            <button class="button desactivado" href="#" data-aos="fade-down" data-aos-duration="500"> <img src="../<?=$md['icomod']?>" alt=""><br><?=$md['nommod']?><br><br></button>
                        </div>
                <?php }} ?>

            </div>
        </div>


    </main>

    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="site-info container">
            <nav role="navigation" class="col-md-6">
                Av. El Dorado No. 66 - 63, piso 5<br>
                Teléfono:  +57 1 4578300<br>
                Horario de atención:  Lunes a viernes: 8:00am - 5.30pm<br>
                Correo:  ccapital@canalcapital.gov.co<br>
                correo:  notificacionesjudiciales@canalcapital.gov.co<br>
                Bogotá - Colombia<br>                      
            </nav>

            <div class="copyright col-md-6">
            </div>

        </div><!-- .site-info -->
        
    </footer><!-- #colophon -->



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init();
    </script>
<?php ob_flush(); ?>
</body>
</html>