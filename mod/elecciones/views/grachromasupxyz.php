<?php
include '../models/mgra.php';
?>
<head>
    <title>Capital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,400&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <style type="text/css">
    body {
            background-color: #fff;
            background-size: 100% 100%;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .mibar {
    /*        background-color: blue;*/
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .arriba{
            display: none;

            }

        .logo_arriba {
           display none
        }

        .baimd {
    /*        background-color: red;*/
            width: 100%;
            max-width: 750px;
            margin: 0 auto;
            padding: 5px;
            position: relative;
            display: flex;
            align-items: center; /* Centrar verticalmente */
        }

        .barra {
            background-image: url('../img/barra_violeta_bs.png');
            background-size: auto 203px; /* Ajustar la altura a 203px */
            background-position: center;
            background-repeat: no-repeat;
            flex-grow: 1;
            text-align: center;
            color: #242951;
            font-size: 20px;
            font-weight: bold;
            height: 203px;
        }

         .amarillo {
            background-image: url('../img/barra_amarilla_bs.png');
            width: 164px;
            height: 203px;
            position: relative; /* Posicionamiento absoluto */
            top: 0; /* Mantener la misma posición vertical */
            left: 20px; /* Superponer horizontalmente 10px hacia la izquierda */
        }


      .logo {
            background-image: url('../img/logo_bs.png');
            background-size: contain;
            background-position: center;
            width: 100%;
            height: 100%;
            position: absolute; /* Posicionamiento absoluto */
            top: 0;
            left: 50%; /* Centrar horizontalmente */
            transform: translateX(-50%); /* Ajustar el margen izquierdo automáticamente */
            max-width: 60%;
            background-repeat: no-repeat;
        }

        

       .barragris {
    /*        background-color: black;*/
            background-image: url('../img/barra_blanca_bs.png');
            background-size: 97% 100%; /* Ajustar al tamaño del div */
            background-position: right 4px;
            background-repeat: no-repeat;
            width: 100%;
            max-width: 750px;
            margin: 0 auto;
            padding: 5px;
            position: relative;
            display: flex;
            align-items: center; /* Centrar verticalmente */
            justify-content: center; /* Centrar horizontalmente */
            height: 70px;
            padding-bottom: 10px;
            margin-top: -12px;

        }


        .barinti {

            display: inline-block;
            text-align: center;
            margin: 4px 5px 0px 5px;

        }

        .infocan {
            display: flex;
            height: 70px;
            width: 80%;
            padding-top: 25px;
            margin: 0 auto;
            max-width: 750px;
        }

        .can {
            background-color: transparent;
            flex: 1;
            margin: 0 15px;
            text-align: right !important;
            margin-bottom: 20px;
            background-repeat: no-repeat;
            background-size: auto 100%;
            background-position: center top 5px; /* Agregar el margen superior a la posición vertical */
        }



       .nomcan {
            color: #fff;
            font-family: 'Montserrat', sans-serif;
            padding-right: 0px; /* Ajusta el margen derecho para juntar más las clases */   
            width: 100%;
            text-align: right;
            font-size: 10px;
        }


        .votos {
            color: #FBD343;
            font-size: 12;
            margin-top: 40px !important;
        }

         .percentage {
            color: #f0e2af;
            font-family: 'Montserrat', sans-serif;
            font-size: 15px;
        }

        .subti {
            color: #c80079;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 15px;
        }

        .txint {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 15px;
            color: #4c3e83;
        }

        .muni {
            color: #4c3e83;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 23px;
        }


        /* Media query para cambiar la altura de la barra en pantallas pequeñas (1 columna) */
    @media (min-width: 300px) and (max-width: 670px) {
        .arriba{
            display: block;
            background-color: #fed511;
            background-image: url('../img/barra_amarilla_bs.png');       
            height: 89px;
            position: relative; /* Posicionamiento absoluto */
            margin: 0 auto;
            margin-bottom: -10px;
            width: 99%;       

            }

        .logo_arriba {
            background-image: url('../img/logo_bs.png');
            background-size: contain;
            background-position: center;
            width: 70%;
            height: 70%;
            position: absolute; /* Posicionamiento absoluto */
            top: 0;
            left: 50%; /* Centrar horizontalmente */
            transform: translateX(-50%); /* Ajustar el margen izquierdo automáticamente */
            max-width: 70%;
            background-repeat: no-repeat;
            margin-top: 10px;
        }
       .barra {
            background-image: url('../img/barra_violeta_bs.png');
            background-size: auto 600px;
            background-position: center;
            background-repeat: no-repeat;
            flex-grow: 1;
            text-align: center;
            color: #242951;
            font-size: 20px;
            font-weight: bold;
            width: 100%; /* Agregar esto para que ocupe el 100% de ancho */
            height: 600px;
            position: relative;
        }

        .amarillo {
            display: none;
        }

        .can {
            background-color: transparent;
            flex: 1;      
            text-align: right !important;
            margin-top: 0px !important; /* Ajustar la posición superior para dar espacio a .amarillo */
            margin-bottom: 30px;
            background-repeat: no-repeat;      
            background-size: auto 110px!important; /* Modifica el tamaño de la imagen */
            background-position: center top 2px; /* Agregar el margen superior a la posición vertical */
            width: 99%;
            height: 115px;
            margin-left: auto;
            margin-right: auto;
            margin-top: -10px;

        }

        .nomcan {
            color: #fff;
            font-family: 'Montserrat', sans-serif;
            padding: 0px;
            width: 100%;
            text-align: right;
            font-size: 14px;
            padding-bottom: 10px;

        }

        .votos {
            color: #FBD343;
            font-size: 22px;

        }

        .percentage {
            color: #f0e2af;
            font-family: 'Montserrat', sans-serif;
            font-size: 22px;
            line-height: 3.5;

        }

        .barragris {
    /*        background-color: black;*/
            background-image: url('../img/barra_blanca_bs.png');
            background-size: 97% 100%; /* Ajustar al tamaño del div */
            background-position: right 4px;
            background-repeat: no-repeat;
            width:100%;
            max-width: 750px;
            margin: 0 auto;
            padding: 5px;
            position: relative;
            display: flex;
            align-items: center; /* Centrar verticalmente */
            justify-content: center; /* Centrar horizontalmente */
            height: 140px;
            padding-bottom: 10px;
            margin-top: -12px;
            margin-left: -20px;

        }

         .muni {
            color: #4c3e83;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 17px;        
            position: absolute!important;
            width: 100%;
            margin-top: -68px;

        }

        .barinti {

            display: inline-block;
            text-align: center;
            margin: 34px 2px 0px 5px;


        }
    }

    </style>
</head>
<body>
<?php
    //session_start();
    $mbas = new mbas();
    $cfg = $mbas->getCfg(4);
    $btn = isset($cfg[0]['btn']) ? $cfg[0]['btn']:NULL;
    $dpt = isset($cfg[0]['dpt']) ? $cfg[0]['dpt']:NULL;
    $mnc = isset($cfg[0]['mnc']) ? $cfg[0]['mnc']:NULL;
    $crp = isset($cfg[0]['crp']) ? $cfg[0]['crp']:NULL;
    $ctd = isset($cfg[0]["ctd"]) ? $cfg[0]["ctd"]:NULL;
    $nb = isset($cfg[0]["bolnum"]) ? $cfg[0]["bolnum"]:NULL;
    // echo "<big><big><big>".$btn." ".$dpt." ".$mnc." ".$crp." ".$ctd."</big></big></big><br>";
    
    $mbas->setBtn($btn);
    $mbas->setDpt($dpt);
    $mbas->setMnc($mnc);
    $mbas->setCrp($crp);
    $mbas->setCtd($ctd);
    $mbas->setBolnum($nb);

    $mmc = $mbas->getMc();
    //$btn="AL";
    if($btn=="AL"){
        $dat =$mbas->getResmudp("eleral"); //ALCALDÍA
        $ncor = "ALCALDÍA";
    }elseif($btn=="GO"){
        $dat =$mbas->getResmudp("elergo"); //GOBERNACIÓN
        $ncor = "GOBERNACIÓN";
    }elseif($btn=="CO"){
        $dat =$mbas->getResmudp("elerco"); //CONCEJO MUNICIPAL
        $ncor = "CONCEJO MUNICIPAL";
    }elseif($btn=="AS"){
        $dat =$mbas->getResmudp("eleras"); //ASAMBLEA DEPARTAMENTAL
        $ncor = "ASAMBLEA DEPARTAMENTAL";
    }elseif($btn=="CA"){
        $dat =$mbas->getResmudp("elerca"); // CAMARA DE REPRESENTANTES
        $ncor = "CAMARA DE REPRESENTANTES";
    }elseif($btn=="PR"){
        $dat =$mbas->getResmudp("elerpr"); //Presidencia
        $ncor = "PRESIDENCIA";
    }
    // var_dump($dat);
    // die();
?>

<div class='mibar'>   
    <div class="arriba">
        <div class="logo_arriba">
                
        </div>
    </div>
    <div class="baimd">
        <div class="amarillo">
            <div class="logo">
                
            </div>
        </div>
        <div class='barra'>   


    <div class="infocan row">


       <?php if($dat){ foreach ($dat as $candidate){ 
          if($candidate["idcan"]=='90900900')
                $name = "VOTO EN BLANCO";
            elseif($candidate["idcan"]=='90900950')
                $name = "VOTOS NULOS";
            else
                $name = substr($candidate["ncan"],0,strpos($candidate["ncan"], " "))." ".substr($candidate["acan"],0,strpos($candidate["acan"], " "));
          $percentage = $candidate["porce"];
          $votes = $candidate["voto"];
          $image = "../img/c".$candidate['ccan'].".png";
          if(!file_exists($image)) $image = "../img/sinfoto.png";
        ?>
            <div class="col-md-6">
                <div class="can text-center" style="background-image: url('<?=$image;?>'); background-size: 150px auto;">
                    <span style="color: transparent;">separa</span>
                    <span class="nomcan"><?=$name;?></span><br>
                    <span class="nomcan votos"><?=number_format($votes, 0, ',', '.');?></span><br>               
                    <span class="nomcan percentage"><?=$percentage;?>%</span>
                </div>
            </div>
        <?php }} ?>
    </div>
  
</div>

        
    </div>

    <div class="barragris">
        <div class="barinti" style="padding-left: 0px;">
            <span class="muni"><?php if($dat) echo $dat[0]['muni']; ?></span>
        </div>
        <div class="barinti" style="padding-left: 40px;">
            <span class="subti">Boletín:</span><br>
            <span class="txint">0<?php if($dat) echo $dat[0]['bolnum']; ?></span>
        </div>
        <div class="barinti" style="border-left: 2px solid #c80079; padding-left: 15px;">
            <span class="subti">Mesas Informadas:</span><br>
            <span class="txint"><?php if($dat) echo number_format($dat[0]['mesinf'], 0, ',', '.'); ?></span>
        </div>
        <div class="barinti" style="border-left: 2px solid #c80079; padding-left: 15px;">
            <span class="subti">Porcentaje:</span><br>
            <span class="txint"><?php if($dat) echo number_format($dat[0]['porinfo'], 2, ',', '.'); ?>%</span>
        </div>
    </div>  
</div>
</body>





<!-- <?php
include '../models/mgra.php';
//session_start();
?>
<head>
    <title>Capital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,400&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script type="text/javascript">
        setTimeout("location.reload(true)",10000);
        function recar(n){
            window.location='graverde.php?n='+n;
            //window.location='http://localhost/erp/mod/elecciones/views/graverde.php';
        }
    </script>

    <style type="text/css">
        body {
            background-color: #fff;
            background-size: 100% 100%;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .barra {
            background-image: url('../img/barrachroma.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100%;
            height: 140px;
            text-align: center;
            color: #242951;
            font-size: 20px;
            font-weight: bold;
            position: relative;
        }

        .mibar {
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .baimd {
            width: 100%;
            max-width: 750px;
            margin: 0 auto;
            padding: 5px;
            position: relative;
        }

        .barinti {
            display: inline-block;
            text-align: center;
            margin: 4px 5px 0px 5px;
        }

        .infocan {
            display: flex;
            height: 70px;
            width: 80%;
            padding-top: 25px;
            margin: 0 auto;
            max-width: 750px;
        }

        .can {
            flex: 1;
            margin: 0 5px;
            text-align: right !important;
            margin-top: -15px;
            background-repeat: no-repeat;
            background-size: contain;
        }

        .infogen {
            margin-top: 0px;
            padding-top: 0px;
            text-align: center;
            width: 80%;
        }

        .nomcan {
            color: #fff;
            font-family: 'Montserrat', sans-serif;
            padding: 0px;
            width: 100%;
            text-align: right;
            font-size: 10px;
        }

        .percentage {
            color: #f0e2af;
            font-family: 'Montserrat', sans-serif;
            font-size: 15px;
        }

        .votos {
            color: #FBD343;
            font-size: 17;
        }

        .subti {
            color: #c80079;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 12px;
        }

        .txint {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 12px;
            color: #4c3e83;
        }

        .muni {
            color: #4c3e83;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 17px;
        }
    </style>
</head>
<body>
<?php
    //session_start();
    $mbas = new mbas();
    $cfg = $mbas->getCfg(4);
    $btn = isset($cfg[0]['btn']) ? $cfg[0]['btn']:NULL;
    $dpt = isset($cfg[0]['dpt']) ? $cfg[0]['dpt']:NULL;
    $mnc = isset($cfg[0]['mnc']) ? $cfg[0]['mnc']:NULL;
    $crp = isset($cfg[0]['crp']) ? $cfg[0]['crp']:NULL;
    $ctd = isset($cfg[0]["ctd"]) ? $cfg[0]["ctd"]:NULL;
    // echo "<big><big><big>".$btn." ".$dpt." ".$mnc." ".$crp." ".$ctd."</big></big></big><br>";
    
    $mbas->setBtn($btn);
    $mbas->setDpt($dpt);
    $mbas->setMnc($mnc);
    $mbas->setCrp($crp);
    $mbas->setCtd($ctd);

    $mmc = $mbas->getMc();
    //$btn="AL";
    if($btn=="AL"){
        $dat =$mbas->getResmudp("eleral"); //ALCALDÍA
        $ncor = "ALCALDÍA";
    }elseif($btn=="GO"){
        $dat =$mbas->getResmudp("elergo"); //GOBERNACIÓN
        $ncor = "GOBERNACIÓN";
    }elseif($btn=="CO"){
        $dat =$mbas->getResmudp("elerco"); //CONCEJO MUNICIPAL
        $ncor = "CONCEJO MUNICIPAL";
    }elseif($btn=="AS"){
        $dat =$mbas->getResmudp("eleras"); //ASAMBLEA DEPARTAMENTAL
        $ncor = "ASAMBLEA DEPARTAMENTAL";
    }elseif($btn=="CA"){
        $dat =$mbas->getResmudp("elerca"); // CAMARA DE REPRESENTANTES
        $ncor = "CAMARA DE REPRESENTANTES";
    }elseif($btn=="PR"){
        $dat =$mbas->getResmudp("elerpr"); //Presidencia
        $ncor = "PRESIDENCIA";
    }
    // var_dump($dat);
    // die();
?>

<div class='mibar'>
    <div class="baimd">
        <div class='barra'>
            <div class="infocan">
            <?php if($dat){ foreach ($dat as $candidate){ 
              if($candidate["idcan"]=='90900900')
                    $name = "VOTO EN BLANCO";
                elseif($candidate["idcan"]=='90900950')
                    $name = "VOTOS NULOS";
                else
                    $name = substr($candidate["ncan"],0,strpos($candidate["ncan"], " "))." ".substr($candidate["acan"],0,strpos($candidate["acan"], " "));
              $percentage = $candidate["porce"];
              $votes = $candidate["voto"];
              $image = "../img/c".$candidate['ccan'].".png";
              if(!file_exists($image)) $image = "../img/sinfoto.png";
            ?>
                <div class="can" style=" margin-left: 80px; background-image: url('<?=$image;?>');">
                    <span style="color: transparent;">separa</span>
                    <span class="nomcan"><?=$name;?></span><br>
                    <span class="nomcan votos"><?=number_format($votes, 0, ',', '.');?></span><br>
                    <span style="font-size: 10px; color: transparent;">separa</span><br>
                    <span class="nomcan percentage"><?=$percentage;?>%</span>
                </div>
            <?php }} ?>
            </div>
            <div class="infogen">
                <div class="barinti" style="padding-left: 70px;">
                    <span class="muni"><?php if($dat) echo $dat[0]['muni']; ?></span>
                </div>
                <div class="barinti" style="padding-left: 30px;">
                    <span class="subti">Boletín:</span><br>
                    <span class="txint">0<?php if($dat) echo $dat[0]['bolnum']; ?></span>
                </div>
                <div class="barinti" style="border-left: 2px solid #c80079; padding-left: 15px;">
                    <span class="subti">Mesas Informadas:</span><br>
                    <span class="txint"><?php if($dat) echo number_format($dat[0]['mesinf'], 0, ',', '.'); ?></span>
                </div>
                <div class="barinti" style="border-left: 2px solid #c80079; padding-left: 15px;">
                    <span class="subti">Porcentaje:</span><br>
                    <span class="txint"><?php if($dat) echo number_format($dat[0]['porinfo'], 2, ',', '.'); ?>%</span>
                </div>
            </div>
        </div>
    </div>
</div>
</body> -->