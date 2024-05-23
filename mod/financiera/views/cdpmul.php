<h3 class="title-c">CDP - Múltiples Rubros&nbsp;&nbsp;&nbsp;&nbsp;</h3>


<link rel="stylesheet" href="../css/acordeon.css">
<link rel="stylesheet" href="/resources/demos/style.css">

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  
<script>
$( function() {
    $( "#accordion" ).accordion({
    	active: false,
      collapsible: true,
      heightStyle: "content"
    });
  } );
</script>

<br>
<br>

<h4 class="title-c">Precargados:&nbsp;&nbsp;&nbsp;&nbsp;</h4>
<br><br><br>

<div id="accordion">

	<h3>Nuevo..</h3>
	<div>

		<form action="<?=base_url;?>cdpmul/saveMC" method="POST">

			<div>
				<label for="nomnuevo">Nombre nueva plantilla:</label>
				<input type="text" class="form-control" id="nomnuevo" name="nomnuevo" value="" required>
			</div>
			<br>

			<?php $n=1; ?>
			<?php foreach ($dxyc as $pf) { ?>			
	 			<div class="custom-control custom-switch">
				  <input type="checkbox" class="custom-control-input" id="<?='customSwitch'.$n?>" name="<?='rub[]'?>" value="<?=$pf['codrub'].';'.$pf['iddpa'];?>">
				  <input type="hidden" class="" id="" name="<?='iddpa[]'?>" value="<?=$pf['iddpa'];?>">  
				  <label class="custom-control-label" for="<?='customSwitch'.$n;?>"><?=$ninipaa.$pf['codrub'];?>&nbsp;&nbsp;&nbsp;<?=$pf['nomrub'];?></label>
				</div>
			<?php $n++;} ?>
			<div class="col-md-3 text-center">
				<button id="crear" name="btcrear" class="btn-secondary-canalc">Crear</button>
			</div>	
		</form>
	</div>

	<?php if((isset($mcdt)) && $mcd) {	?>

		<?php for ($i=0;$i<count($mcd);$i++){ ?>
			
				<h3><?=$mcdt[$i][0]['valnom'];?></h3>
				<div>
					<form action="<?=base_url;?>cdpmul/getRubmc" method="POST">
						<div style="text-align: right;">
							<button id="btnsolicitar" class="btn-secondary-canalc">Solicitar</button>
							<a href="<?=base_url?>cdpmul/index&valid=<?=$mcdt[$i][0]['valid'];?>&iddpa=<?=$mcdt[$i][0]['iddpa'];?>" class="btn btn-danger" style="text-align: right;">
								<i class="far fa-trash-alt"></i>
							</a>							
						</div>
						<input type="hidden" name="valid" value="<?=$mcdt[$i][0]['valid'];?>">
						<!-- <input type="text" name="valid" value="<?=$mcdt[$i][0]['iddpa'];?>"> -->
						<!-- <input type="text" name="valid" value="<?=$mcdt[$i][0]['valid'];?>"> -->
							
						<?php foreach ($mcdt[$i] as $mc){ ?>		  		
				  		<fieldset>
							  <legend></legend>
							  <div>
									<label for="rubroPre" class=""> Rubro Presupuestal:</label>
									<input type="number" class="form-control" id="rubroPre" name="<?='r[]'?>" value="<?=$ninipaa.$mc['codrub'];?>" readonly>
									<input type="hidden" name="iddpa[]"  value="<?=$mc['iddpa'];?>">
									<input type="text" name=""  value="<?=$mc['idpaa'];?>">

								</div>
								<br>
								<div>
									<label for="nombreRubro">Nombre:</label>
									<input type="text" class="form-control" id="nombreRubro" name="nombreRubro" value="<?=$mc['nomrub'];?>" readonly="">
								</div>
							</fieldset>

						<?php } ?>		  		

			  		<div class="col-md-3 text-center">
							<button id="btnsolicitar" class="btn-secondary-canalc">Solicitar</button>
						</div>	

					</form>
				</div>

		<?php } //cierra for?>
	<?php } //cierra if?>


<?php die(); ?>



  <h3>CDP Nómina</h3>
  <div>  	
  	<form action="<?=base_url;?>cdpmul/getRubmc" method="POST">	
	  	<?php $n=1; ?>
  		<?php foreach ($mcdt as $mc){ ?>
  			<fieldset>
			    <legend></legend>
			    <div>
					<label for="rubroPre" class=""> Rubro Presupuestal:</label>
					<input type="number" class="form-control" id="rubroPre" name="<?='r[]'?>" value="<?=$ninipaa.$mc['codrub'];?>" readonly>
					<input type="hidden" name="iddpa" id="iddpa" value="<?=$mc['iddpa'];?>">
				</div>
				<br>
				<div>
					<label for="nombreRubro">Objeto:</label>
					<input type="text" class="form-control" id="nombreRubro" name="nombreRubro" value="<?=$mc['nobjeto'];?>" readonly="">
				</div>
			 </fieldset>
			 <?php $n++; ?>

  		<?php } ?>

  		<div class="col-md-3 text-center">
				<button id="btnsolicitar" class="btn-secondary-canalc">Solicitar</button>
			</div>	

		</form>

  </div>
  
  
</div>


