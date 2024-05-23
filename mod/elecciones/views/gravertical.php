<?php
include '../models/mgra.php';
//session_start();
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
			window.location='graverde.php?n='+n;
			//window.location='http://localhost/erp/mod/elecciones/views/graverde.php';
		}
	</script> -->

	<style type="text/css">
		@font-face{
		    font-family: 'Montserrat', sans-serif;
		    font-style: normal;
		    font-weight: 100;	   
		}

		

		body{
			background-color: #fff;
			background-image: url(../img/fondo2023plano2.jpg);
			background-size: cover;
			/*background-size: cover;*/
			color: #fff;
			font-family: DinBold;
			margin: 0px 0px;
			overflow: overlay;
			background-repeat: no-repeat;

		}
		.can{
			display: inline-block;
			width: 165px;
			/*border: 2px solid #fff;*/
			padding: 10px 10px 0px 10px;
	    	margin: 50px 8px 0px 8px;
			/*border-radius: 20px 20px 0px 20px;*/
			text-align: center;
			background-color: #cedff3;
		}
		.fonimg{
			width: 150px;
			height: 150px;
			/*background-color: #fff;*/
			padding: 5px;
			border-radius: 100px;
			margin-top: -60px;
			border: 2px solid #769cff;
		}
		.fonimg img{
			border-radius: 100px;
		}
		.porce{
			display: block;
			width: 185px;
			height: 5px;
			background-color: #fc5318;
			margin-left: -10px;
		}
		.txtvt{
			font-size: 30px;
			font-weight: bold;
			width: 100%;
			text-align: center;
		}
		.dat{
			width: 88%;
			margin: 0px auto;
			height: 400px;
			overflow-y: hidden; 
			overflow-x: hidden;
			/*padding: 10px;*/
			white-space: nowrap;
			/*scrollbar-color: #2a3883 #2a3883;*/
			text-align: center;
		}
		
		.titu{
			font-size: 30px;		
			display:block;
			color: #fff;	
			margin-top: 1px;
			margin-bottom: -10px;
			font-family: 'Montserrat', sans-serif;
			font-weight: bold;
		}

		.barra{
			width: 73%;
			height: 15%;
			text-align: center;
			/*background-color: #ff9801;*/
			background-image: url(../img/fondotitulo_rojo2023.png);
			background-repeat: no-repeat;
			background-size: cover;
			color: #fff;
			font-size: 25px;
			font-weight: bold;
			margin: 0px auto;
			margin-bottom: 50px;
			margin-top: 20px;
			/*border-radius: 0px 20px 0px 20px;*/
			padding-top: 40px;
		}


		.barit{
			display: block;
			width: 100%;
			text-align: center;

		}
		.barint{
			width: 70%;
			display: inline-block;
			/*background-color: #ffffff;*/
			padding-bottom: 10px;
			font-size: 17px;
			text-align: left;
			/*border-radius: 0px 10px 0px 10px;*/
		}
		.barinti{
			display: inline-block;
			margin: 4px 5px 0px 5px;
		}
		.txint{
			font-weight: bold;
			font-size: 18px;
			color: #ffddad;
			font-family: 'Montserrat', sans-serif !important;
		}
		.barder{
			width: 100%;
			text-align: right;
			padding: 20px 0% 0px 0%;
			font-size: 25px;
		}
		.texarr{
			display: inline-block;
			padding: 0px 10px;
		}
		.lin{
			border-left: 1px solid #fff;
			padding-right: 30px;
			text-align: left;
		}

		.subti{
			color: #fff;
			font-family: 'Montserrat', sans-serif;
			font-weight: bold;
			font-size: 17px
		}

		/* --GRAFICO-	*/

		.bar-container {  
			display: flex;
			align-items: center; /* Alinea los elementos en el centro verticalmente */
			width: 90%;
			max-height: 100px;
			margin-bottom: 0px;
			margin-left: auto;
			margin-right: auto;
			}

			.bar-name-container {
			width: 150px;
			display: flex;
			align-items: center; /* Alinea los elementos en el centro verticalmente */
			justify-content: flex-end; /* Alinea el texto del nombre a la derecha */
			}

		.bar-name-container {
		  width: 150px;
		  display: flex;
		  align-items: center; /* Alinea los elementos en el centro verticalmente */
		  justify-content: flex-end; /* Alinea el texto del nombre a la derecha */
		}

		.bar {
		  background-color: #73f5d1;
		  color: white;
		  padding: 5px;
		  display: flex;
		  flex-direction: column;
		  justify-content: flex-end;
		  height: 40px; /*ancho barra*/
		}

		.bar-name {
		  font-family: 'Montserrat', sans-serif;
		  font-size: 16px;
		  text-align: right;
		  padding-right: 10px;
		}

		.bar-content {
		  display: flex;
		  flex-direction: column;
		  align-items: flex-end;
		  margin-top: 10px;
		}

		.ancho-img {
		  max-width: 70px !important; /* Ancho máximo de las imágenes (80 píxeles) */
		  height: auto;
		  margin-right: 3px;
		}


		.y-axis-line {
		  width: 2px; /* Ancho de la línea */
		  height: 120px; /* Altura de la línea (250px en este caso) */
		  background-color: #fff; /* Color de la línea, ajusta según tus preferencias */
		  margin-left: 10px; /* Espacio entre la línea y las barras */
		  margin-right: 10px; /* Espacio entre la línea y las fotos */
		}

		.footer {
		  text-align: center;
		  margin-top: 20px;
		  font-size: 14px;
		  color: #fff;
		  font-family: 'Montserrat', sans-serif;
		}

		.percentage {
		  text-align: right;
		  color: yellow;
		  margin-bottom: 0px; /* Añade espacio entre la cifra de porcentaje y los votos */
		  font-size: 25px;
		  margin-left: 30px;
		  font-family: 'Montserrat', sans-serif;
		}

		.percentage1{
		  text-align: right;
		  color: transparent;
		  margin-bottom: 2px; /* Añade espacio entre la cifra de porcentaje y los votos */
		  font-size: 25px;
		}

		.votos {
		  text-align: right;
		  font-size: 23px;
		  color: #fff;
		  font-family: 'Montserrat', sans-serif;
		}
	</style>
</head>
<body>
<?php
	//session_start();
  $mbas = new mbas();
  $cfg = $mbas->getCfg(2);
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
				<span class="txint">0<?php if($dat) echo $dat[0]['bolnum']; ?></span>
			</div>
			<div class="barinti" style="border-left: 2px solid #fff;padding-left: 15px;">
				<span class="subti" style="font-family: 'Montserrat', sans-serif !important;" >Mesas Informadas:</span>
				<span class="txint" ><?php if($dat) echo number_format($dat[0]['mesinf'], 0, ',', '.'); ?></span>
			</div>
			<div class="barinti" style="border-left: 2px solid #fff;padding-left: 15px;">
				<span class="subti">Porcentaje:</span>
				<span class="txint" ><?php if($dat) echo number_format($dat[0]['porinfo'], 2, ',', '.'); ?>%</span>
			</div>			
		</div>
		
		
	</div>
</div>

<div>
	<div class="bar-chart">
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
	    <div class="bar-container">
			  <div class="bar-name-container">
			    <div class="bar-name"><?= $name ?></div>
			    <img class="ancho-img" src="<?= $image ?>" alt="<?= $name ?>">
			  </div>
			  <div class="y-axis-line">.</div> <!-- Línea del eje Y -->
			  <div class="bar" style="width: <?= $percentage ?>%;">
			    <!-- Contenido de la barra... -->
			  </div>
			  <div class="bar-content">
			    <div class="percentage"><?= $percentage ?>%</div>
			    <div class="votos"><?= number_format($votes, 0, ',', '.') ?></div> <!-- Muestra el número de votos -->
			  </div>
			</div>
    <?php }} ?>
	</div>
</div>


<div class="footer">
  Fuente: Registraduría Nacional
</div>

</body>


<script>
  // Función para calcular el margin-left automáticamente
  function calcularMarginLeft() {
    // Encuentra todas las barras dentro del .bar-chart
    const barras = document.querySelectorAll('.bar');
    let barraMasAncha = 0;

    // Encuentra la barra más ancha
    barras.forEach(barra => {
      const ancho = parseFloat(barra.style.width);
      if (ancho > barraMasAncha) {
        barraMasAncha = ancho;
      }
    });

    let marginIzquierdo=0;

    if (barraMasAncha <=15) {
      console.log('AQUI');
      marginIzquierdo = (100 - barraMasAncha) / 2 - 7;

    }else if(barraMasAncha > 15 && barraMasAncha <= 30){
      marginIzquierdo = (100 - barraMasAncha) / 2 - 5;

    }else if(barraMasAncha > 30 && barraMasAncha <= 50){
      marginIzquierdo = (100 - barraMasAncha) / 2 - 1;

    }else if(barraMasAncha > 50){
      marginIzquierdo = (100 - barraMasAncha) / 2;
    }

   

    // Aplica el margin-left al .bar-chart
    const barChart = document.querySelector('.bar-chart');
    barChart.style.marginLeft = marginIzquierdo + '%';
  }

  // Llama a la función al cargar la página y cuando se redimensione la ventana
  window.addEventListener('load', calcularMarginLeft);
  window.addEventListener('resize', calcularMarginLeft);
</script>