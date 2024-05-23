<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/firma.css">
    <script type="text/javascript" src="../js/dibmanalz.js"></script>
    <script type="text/javascript" src="../js/dibdedmov.js"></script>
</head>


<?php
	$idusu = isset($_GET["idusu"]) ? $_GET["idusu"]:NULL;
?>

<body onload="window.startup();comenzar();">
	
	<div class='container'>
		<canvas id="canvas" width="300px" height="150px"></canvas>
	    <br>   
		<div style="width: 300px;">
			<center>
				<a href="firma.php?idusu=<?php echo $idusu; ?>">
					<input type="button" class="btn-primary-ccapital" style="margin-right: 0px;" value="Limpiar">
				</a>
				<?php 
				$rutarc = "../firma/fir_";
				$no = $idusu;
				if (file_exists($rutarc.$no.".png")) { ?>
				    	<img style="width:60px; height:40px" id="imagen" src="<?php echo $rutarc.$no; ?>.png" />
				<?php }else{ ?>
				    <img style="width:60px; height:40px" id="imagen" src="../firma/imagen.png" />
				<?php } ?>
			    <input name="guardar" type="button" class="btn-primary-ccapital" style="margin-right: 0px;" value="Guardar" onclick="upload('<?php echo $rutarc.$no; ?>');">
			</center>
	    </div>
	</div>
</body>
</html>