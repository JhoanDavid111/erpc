<?php
include '../models/mgra.php';
?>

<head>
    <title>Capital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,400&display=swap" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <script type="text/javascript">
    	setTimeout("location.reload(true)",10000);
    	function recar(n){
    		window.location='gra.php';
    		//window.location='http://localhost/erp/mod/elecciones/views/graverde.php';
    	}
    </script> -->

        <style type="text/css">
            @font-face {
                font-family: 'Montserrat', sans-serif;
                font-style: normal;
                font-weight: 100;
            }

            body {
                background-color: #fff;
                background-image: url(../img/fondo2023plano.jpg);
                background-size: cover;
                color: #fff;
                font-family: DinBold;
                margin: 0px;
            }

            .can {
                display: inline-block;
                width: 165px;
                padding: 10px 10px 0px 10px;
                margin: 50px 8px 0px 8px;
                text-align: center;
                background-color: #cedff3;
            }

            .fonimg {
                width: 150px;
                height: 150px;
                padding: 5px;
                border-radius: 100px;
                margin-top: -60px;
                border: 2px solid #769cff;
            }

            .fonimg img {
                border-radius: 100px;
            }

            .porce {
                display: block;
                width: 185px;
                height: 5px;
                background-color: #fc5318;
                margin-left: -10px;
            }

            .txtvt {
                font-size: 30px;
                font-weight: bold;
                width: 100%;
                text-align: center;
            }

            .dat {
                width: 88%;
                margin: 0px auto;
                height: 400px;
                overflow-y: hidden;
                overflow-x: hidden;
                white-space: nowrap;
                text-align: center;
            }

            .titu {
                font-size: 30px;
                display: block;
                color: #fff;
                margin-top: 1px;
                margin-bottom: -35px;
                font-family: 'Montserrat', sans-serif;
                font-weight: bold;
            }

           .barra {
                /*            width: 73%;*/
                width: 90%; /* En lugar de 73% */            
                height: 15%;
                text-align: center;
                background-image: url(../img/fondotitulo_rojo2023.png);
                background-repeat: no-repeat;
                background-size: cover;
                color: #fff;
                font-size: 25px;
                font-weight: bold;
                margin: 0px auto;
                margin-bottom: 40px;
                margin-top: 50px;
                padding-top: 40px;
                position: relative;
            }

            .barint {
               
                padding: 20px; /* Ajusta el relleno para que el contenido no toque los bordes */
            }

            .barit {
                display: block;
                width: 100%;
                text-align: center;
            }

            

            .barinti {
                display: inline-block;
                margin: 4px 5px 0px 5px;
            }

            .txint {           
                font-family: 'Montserrat', sans-serif;
                font-style: normal;
                font-size: 18px;
                color: #ffddad;

            }

            .barder {
                width: 100%;
                text-align: right;
                padding: 20px 0% 0px 0%;
                font-size: 25px;
            }

            .texarr {
                display: inline-block;
                padding: 0px 10px;
            }

            .lin {
                border-left: 1px solid #fff;
                padding-right: 30px;
                text-align: left;
            }

            .subti {
                color: #fff;
                font-family: 'Montserrat', sans-serif;
                font-weight: bold;
                font-size: 17px;
            }

            /* --GRAFICO-   */

            .bar-chart-container {
                display: flex;
                justify-content: center;
                align-items: flex-end;
                max-width: 1000px;
                margin: 0 auto;
                margin-top: 100px;
            }

            .bar {
                flex: 0 0 50px;
                background-color: #73f5d1;
                text-align: center;
                color: white;
                padding: 5px;
                display: flex;
                flex-direction: column;
                align-items: center;
                position: relative;
                max-height: 200px;
                margin-right: 10px;
            }

            .bar-name {
                font-family: 'Montserrat', sans-serif;
                position: absolute;
                bottom: -100px;
                width: 100%;
                font-size: 12px;
            }

            .percentage {
                color: #f0e2af;
                font-family: 'Montserrat', sans-serif;
                padding: 5px;
                width: 90%;
                text-align: center;
                position: absolute;
                top: -42px;
            }

            .bar-content {
                display: flex;
                flex-direction: column;
                align-items: center;
                height: 100%;
                justify-content: flex-end;
            }

            .bar img {
                width: 50px;
                height: auto;
                position: absolute;
                bottom: -65px;
            }

            .x-axis {
                background-color: #fff;
                height: 2px;
                width: 200%;
                position: absolute;
                bottom: 0px;
            }

            .footer {
                text-align: center;
                margin-top: 180px;
                font-size: 14px;
                color: #fff;
                font-family: 'Montserrat', sans-serif;
            }
            .votos {
              text-align: right;
              font-size: 13px;
              color: #f0e2af;
            }

            @media (max-width: 1200px) {
              .barra {
                width: 100%;
              }
            }

            @media (max-width: 768px) {
              .barra {
                width: 100%;
                font-size: 18px;
                /* ...otros ajustes... */
              }
            }
        </style>
</head>
<body>

<?php
	//session_start();
	$mbas = new mbas();
    $cfg = $mbas->getCfg(1);
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
		//$dcc = $mbas->getResCc("eleral",$dpt,$mnc,$crp);
		$dat =$mbas->getResmudp("eleral"); //ALCALDÍA
		$ncor = "ALCALDÍA";
	}elseif($btn=="GO"){
		//$dcc = $mbas->getResCc("elergo",$dpt,$mnc,$crp);
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
<div class='barra'>	

<?php
    if($dpt==16 AND $mnc==1)
        $nmmnoo = "BOGOTÁ D.C.";
    else
        $nmmnoo = $dat[0]['muni'];
?>
	<div class="barint" >
		<div  style="text-align: center;"> 
			<span class="titu"><?=$ncor;?> DE <?php if($dat) echo $nmmnoo; ?></span>
			<br>
			
		</div>

		<div style="text-align: center;">
			<div class="barinti" style="padding-left: 40px;">
				<span class="subti">Boletín:</span>
				<span class="txint">No. 0<?php if($dat) echo $dat[0]['bolnum']; ?></span>
			</div>
			<div class="barinti" style="border-left: 2px solid #714EA6;padding-left: 15px;">
				<span class="subti">Mesas Informadas</span>
				<span class="txint"><?php if($dat) echo number_format($dat[0]['mesinf'], 0, ',', '.'); ?></span>
			</div>
			<div class="barinti" style="border-left: 2px solid #714EA6;padding-left: 15px;">
				<span class="subti">Porcentaje</span>
				<span class="txint"><?php if($dat) echo number_format($dat[0]['porinfo'], 2, ',', '.'); ?>%</span>
			</div>			
		</div>
	</div>
</div>
<div class="bar-chart-container">
	  <?php if($dat){ foreach ($dat as $candidate){ 
        if($candidate["idcan"]=='90900900')
            $name = "VOTO EN BLANCO";
        elseif($candidate["idcan"]=='90900950')
            $name = "VOTOS NULOS";
        else
        $name = substr($candidate["ncan"],0,strpos($candidate["ncan"], " "))." ".substr($candidate["acan"],0,strpos($candidate["acan"], " "));
      $percentage = $candidate["porce"];
      $votes = $candidate["voto"];
      $image = "../img/".$candidate['ccan'].".png";
      if(!file_exists($image)) $image = "../img/sinfoto.png";
	  ?>
	      <div class="bar" style="height: <?=($percentage * 8);?>px;"> 
	      	<div class="percentage"><?=$percentage;?>%<br><span class="votos"><?= number_format($votes, 0, ',', '.') ?></span></div>
      		<div class="bar-content">
      			<div class="x-axis"></div>
      			<img src="<?=$image;?>" alt="<?=$name;?>">
      		</div>
	      	<div class="bar-name">
                <?=$name;?></div>
	      </div>
	  <?php }} ?>
</div>

<div class="footer">
  Fuente: Registraduría Nacional
</div>

</body>