<?php 

// ob_start();
//session_start();

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canal Capital</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="https://intranet.canalcapital.gov.co/intranet/new_security_cc/wp-content/uploads/2020/04/cropped-icocanal-32x32.png" sizes="32x32" />
    <link rel="icon" href="https://intranet.canalcapital.gov.co/intranet/new_security_cc/wp-content/uploads/2020/04/cropped-icocanal-32x32.png" sizes="32x32" />
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/login.css">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body>
    <header id="encabezado">
       <div class="wrapper-header">
        <section class="encabezado-a">
            <div class="encabezado-a-2">
                <div class="redesp">
                    <a href="https://www.facebook.com/CanalCapitalOficial" title="Facebook CanalCapitalOficial" target="_blank">
                        <span class="icono">
                            <i class="fab fa-facebook-f"></i>
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
    </div>
    </header>
    <main>
        
          
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form action="<?=base_url?>usuario/login" method="POST">
                    <h1>Login</h1>                    
                    
                    <input type="text" placeholder="Usuario" name="email" required="" />                  
                    <input type="password" placeholder="Password" name="password" required=""/>
                    <div class="mb-3">
                        <div class="g-recaptcha" data-sitekey="6Lc6LCEfAAAAAO9Cf9DaqJsDKkaH_eN4eALomycB"> </div>
                    </div><br>
                    <button class="btnlo">Ingresar</button>                    
                </form>
            </div>
            <div class="form-container sign-in-container">    
                    
                    <button class="btnlo1" onclick="window.location.href='modulos.html'">
                        <span>conectar con:</span> <br>
                        <span>Canal Capital</span>
                    </button>                
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Ingreso Directo?</h1>
                        
                        <button class="ghost btnlo" id="signIn">Regresar</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Logueo</h1>
                        <p>Ingresa con tu correo institucional</p>
                        <button class="ghost btnlo" id="signUp">Ingresar</button>
                    </div>
                </div>
            </div>
        </div>
       
    </main>
    <br>

    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="site-info containerfooter">
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
    <script src="js/jslogin.js"></script>

    <script>
        AOS.init();
    </script>
<!-- <?php ob_flush(); ?>
</body> -->

</html>



