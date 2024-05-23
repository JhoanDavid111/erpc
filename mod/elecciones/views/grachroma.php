<?php
include '../models/mgra.php';
//session_start();
?>

<head>
    <title>Capital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,400&display=swap" rel="stylesheet"><link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script type="text/javascript">
        setTimeout("location.reload(true)",10000);
        function recar(n){
            window.location='graverde.php?n='+n;
            //window.location='http://localhost/erp/mod/elecciones/views/graverde.php';
        }
    </script>

    <style type="text/css">

        body{
            background-color: #0f0;
            /*background-image: url(../img/fondo.jpg);*/
            background-size: 100% 100%;
            color: #fff;
            
            margin: 0px 0px;
            overflow: overlay;

        }
        
        

        .barra{
            background-image: url(../img/barrachroma.png);
            width: 850px;
            height: 150px;
            text-align: center;     
            color: #242951;
            font-size: 20px;
            font-weight: bold;      
            background-size: cover; /* La imagen se ajustará al contenedor y cubrirá todo el espacio */
            background-position: center; /* La imagen se centrará en el contenedor */
            background-repeat: no-repeat; /* Evita la repetición de la imagen */
            margin-bottom: 30px;
            margin-left: -50px;
        }

        
        .mibar{
            width: 100%;
            position: fixed;
            bottom: 0px;
            right: 0px;
            margin-bottom: 30px;
        }

        .baimd{
            width: 750px;
            margin: 0px auto;
            margin-bottom: 5px;
        }   

        .barinti{
            display: inline-block;
            text-align: center;
            margin: 4px 5px 0px 5px;
        }



        .infocan {
          display: flex; /* Establece el contenedor como flexbox */
          margin-left: 110px;
        /*background-color: blue;*/
          height: 70px;
          width: 80%;
          padding-top: 25px;
        }

        .can {
          flex: 1; /* Hace que las imágenes ocupen el mismo espacio */
          margin: 0 5px; /* Agrega margen entre las imágenes */
          text-align: right !important;
          margin-top: -15px;
          background-repeat: no-repeat; /* Evita la repetición de la imagen */
          background-size: contain; /* La imagen se ajustará al contenedor y cubrirá todo el espacio */

        }


        .infogen{
            margin-top: 10px;
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
          /*font-family: 'Montserrat', sans-serif; */
          font-size: 17;     

        }
        

        .subti{
            color: #c80079;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 12px
        }

        .txint{
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 12px;
            color: #4c3e83;
        }

        .muni{

            color: #4c3e83;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 17px
        }
    </style>
</head>
<body>
<?php
    //session_start();
    $mbas = new mbas();
    $cfg = $mbas->getCfg(3);
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
                <div class="can" style="margin-left: 30px; background-image: url('<?=$image;?>');" >
                    <span style="color: transparent;">separa</span>
                    <span class="nomcan"><?=$name;?></span><br>                      
                    <span class="nomcan votos" ><?=number_format($votes, 0, ',', '.');?></span><br>
                    <span style="font-size: 10px; color: transparent;">separa</span><br>
                    <span class="nomcan percentage"><?=$percentage;?>%</span>
                </div>
                <?php }} ?>
<!--                 <div class="can" style="margin-left: 30px; background-image: url('../img/votoblancochroma.png');" >
                    <span style="color: transparent;">separa</span>
                    <span class="nomcan">Voto en Blanco</span><br>                      
                    <span class="nomcan votos" >7777</span><br>
                    <span style="font-size: 10px; color: transparent;">separa</span><br>
                    <span class="nomcan percentage">14.5%</span>
                </div>    -->           
            </div>          

<?php
    if($dpt==16 AND $mnc==1)
        $nmmnoo = "BOGOTÁ D.C.";
    else
        $nmmnoo = $dat[0]['muni'];
?>

            <div class="infogen">
                <div class="barinti" style="padding-left: 70px;">
                    <span class="muni"><?php if($dat) echo $nmmnoo; ?></span>                    
                </div>
                <div class="barinti" style="padding-left: 30px;">
                    <span class="subti">Boletín:</span><br>
                    <span class="txint">0<?php if($dat) echo $dat[0]['bolnum']; ?></span>
                </div>
                <div class="barinti" style="border-left: 2px solid #c80079;padding-left: 15px;">
                    <span class="subti" >Mesas Informadas:</span><br>
                    <span class="txint" ><?php if($dat) echo number_format($dat[0]['mesinf'], 0, ',', '.'); ?></span>
                </div>
                <div class="barinti" style="border-left: 2px solid #c80079;padding-left: 15px;">
                    <span class="subti">Porcentaje:</span><br>
                    <span class="txint" ><?php if($dat) echo number_format($dat[0]['porinfo'], 2, ',', '.'); ?>%</span>
                </div>
            </div>        
        </div>
    </div>
</div>
</body>