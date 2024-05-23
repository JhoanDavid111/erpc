<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/style-dash.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<!---LINKS MODAL--->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<title>INSCRIPCIONES</title>
</html>


<?php if($txtn){ ?>
	<div style="color: #ff0000;font-weight:bold;text-shadow: 1px 1px 1px #787676;">
		¡Su Inscripción ha sido <?=$txtn;?>.!<br><br>
	</div>
<?php }else{ ?>
	<br><br>
<?php }?>
	
<?php $url_action = base_url."inscrip/saveExt"; ?>

<!-- <h2 class="title-c m-tb-40">Inscripciones</h2>
<br><br> -->
<div class="table-responsive">
	<table id="example" class="table table-striped table-bordered dterpce" style="width:99%;">
        <thead>
            <tr>
                <th>Evento ó Capacitación</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        	<?php if($ninsCap){ foreach($ninsCap AS $dni){ ?> 
        		<tr>
            		<td>
                    	<strong><?=$dni['nomce'];?></strong>
                    	<small><br>
						<strong>Tipo: </strong><?=$dni['Tipo'];?> &nbsp;&nbsp;
	                    	<strong>Modalidad: </strong><?=$dni['Modal'];?><br>
	                        <strong>Fecha Inicio: </strong><?=$dni['fecince'];?> &nbsp;&nbsp;
	                        <strong>Fecha Fin: </strong><?=$dni['fecfice'];?><br>
	                        <strong>Ubicación: </strong><?=$dni['ubice'];?>&nbsp;&nbsp;
	                        <strong>Por equipos: </strong>
	                        <?php if($dni['comce']==1) echo "No"; else echo "Si"; ?>
							<br>
	                        <strong>Descripción: </strong> <?=$dni['desce'];?>
                    	</small>
                    	<?=$dni['comce'];?>
	                </td>
	<td width="300px">
<form class="m-tb-40" action="<?=$url_action;?>" style="margin: 0px !important;" method="POST">
    <div class="row">
		<div class="form-group col-md-12">
            <input type="hidden" name="idce" value="<?=$dni['idce'];?>">
			<button type="button" class="btn-primary-ccapital" data-toggle="modal" data-target="#myModal<?=$dni['idce'];?>">Nueva Inscripción</button>
		</div>
	</div>
	
	<div class="modal fade" id="myModal<?=$dni['idce'];?>" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="title-c m-tb-40">Inscripciones <?=$dni['nomce'];?></h3>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-6" style="margin-bottom: 0px;">
							<label for="nodocemp">No. Documento</label>
							<input type="number" class="form-control form-control-sm" id="nodocemp" name="nodocemp" value="" required />
						</div>
						<div class="form-group col-md-6" style="margin-bottom: 0px;">
							<label for="tipdoc">Tipo de Documento</label>
							<select class="form-control form-select-sm" style="padding: 0px;" id="tipdoc" name="tipdoc" required>
								<?php if($dttd){ foreach ($dttd as $dt) { ?>
									<option value="<?=$dt['valid'];?>"><?=$dt['valnom'];?></option>
								<?php }} ?>
							</select>
						</div>
						<div class="form-group col-md-6" style="margin-bottom: 0px;">
							<label for="pernom">Nombre Completo</label>
							<input type="text" class="form-control form-control-sm" id="pernom" name="pernom" value="" required />
						</div>
						<div class="form-group col-md-6" style="margin-bottom: 0px;">
							<label for="peremail">E-mail</label>
							<input type="email" class="form-control form-control-sm" id="peremail" name="peremail" value="" required />
						</div>
						<div class="form-group col-md-6" style="margin-bottom: 0px;">
							<label for="pertel">No. Celular</label>
							<input type="number" max="9999999999" class="form-control form-control-sm" id="pertel" name="pertel" value="" required />
						</div>
						<div class="form-group col-md-6" style="margin-bottom: 0px;">
							<label for="sex">Sexo</label>
							<select class="form-control form-select-sm" style="padding: 0px;" id="sex" name="sex" required>
								<?php if($dtsx){ foreach ($dtsx as $dt) { ?>
									<option value="<?=$dt['valid'];?>"><?=$dt['valnom'];?></option>
								<?php }} ?>
							</select>
						</div>

						<?php if($dni['comce']==2){ ?>
							<div class="form-group col-md-6" style="margin-bottom: 0px;">
								<div class="row">
									<div class="form-group col-md-5">
										<label for="">¿Tienes Equipo?</label><br>
										<input type="radio" style="width: 30px;height: 30px;" name="equipo<?=$dni['idce'];?>" value="seleccionar" onclick="SeleccionarEquipo(<?=$dni['idce'];?>)"> Si
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" style="width: 30px;height: 30px;" name="equipo<?=$dni['idce'];?>" value="crear" onclick="mostrarCrearEquipo(<?=$dni['idce'];?>)"checked> No
		                			</div>
								<?php if($dni['comce']==2){ ?>
			                		<div id="crearEquipo<?=$dni['idce'];?>" class="form-group col-md-7" style="display: none;">
			                			<label for="nomequ">Crear equipo - Nombre</label>
		                				<input type="text" class="form-control form-control-sm" id="nomequ" name="nomequ" value="<?=isset($datOne) ? $datOne[0]['nomequ']:''; ?>" />
									</div>
									<div id="seleccionarEquipo<?=$dni['idce'];?>" class="form-group col-md-7" style="display: none;">
			                			<label for="idequ">Seleccionar equipo</label>
			                			<?php
			                				$ep->setIdce($dni['idce']);
			                				$dtEqce = $ep->getEqui();
			                			?>
		                				<select id="idequ" name="idequ" class="form-control form-select" style="height: 50px;">
		                					<?php if($dtEqce){ ?>
		                						<option value="0">Seleccione Equipo</option>
		                					<?php foreach($dtEqce AS $dtec){ ?>
												<option value="<?=$dtec['idequ'];?>"><?=$dtec['nomequ'];?></option>
											<?php }} else{ ?>
												<option value="0">Cree un equipo (Sin equipos creados)</option>
											<?php } ?>
				                		</select>
									</div>
								<?php } ?>
								</div>
							</div>
						<?php } ?>

						<div class="form-group col-md-6" style="margin-bottom: 0px;background-color: #f9f9f9;border: 1px solid #d3d3d3;border-radius: 3px;margin: 10px 0px 0px 0px;padding: 8px 0px 0px 15px;">
							<input type="checkbox" required checked> &nbsp;&nbsp;&nbsp;Acepto política de tratamiento de datos.
							<br>
							<span style="font-size: 8pt;">
								<a href="https://files.conexioncapital.co/assets/public/media/file/file/AGRI-SI-PO-005-POLITICA-DE-TRATAMIENTO-DE-DATOS-PERSONALES_0.pdf?VersionId=NbTHpjSjIRyLNJ7x5u2JQZSfyJ3n3w2M" target="_blank">Política de tratamiento de datos personales</a>
								&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
								<a href="https://files.conexioncapital.co/assets/public/media/file/file/TERMINOS-CONDICIONES.pdf?VersionId=8tYR.DNUN8V3f2yagRh7DEQSpKepIEAY" target="_blank">Términos y Condiciones</a>
								<br>
								<a href="https://files.conexioncapital.co/assets/public/media/file/file/TERMINOS-Y-CONDICIONES-DE-USO.pdf?VersionId=b96fSrwEuv5Ct7KgC27mW2klox9voeJB" target="_blank">Términos y condiciones de uso propiedad intelectual</a>
							</span>
						</div>
						<div class="form-group col-md-6" style="margin-top: 10px;margin-bottom: 0px;">
		                    <div class="g-recaptcha" data-sitekey="6Lc6LCEfAAAAAO9Cf9DaqJsDKkaH_eN4eALomycB"> </div>
						</div>
					</div>
				</div>					
				<div class="modal-footer">
					<input type="hidden" name="idce" value="<?=$dni['idce'];?>" />
					<input type="hidden" name="comce" value="<?=$dni['comce'];?>" />
					<button type="" class="btn-primary-ccapital" style="margin-top: 0px;" data-dismiss="modal">Cancelar</button>
					<input type="submit" class="btn-primary-ccapital" style="margin-top: 0px;" value="Inscribirme">
				</div>
			</div>
		</div>
	</div>
</form>


</td></tr>

	        <?php }}else{ ?>
	        	<tr><td colspan="2">
	        		No hay capacitaciones o eventos disponibles en este momento.
	        	</td></tr>
	    <?php } ?>
        </tbody>
        <tfoot>
            <tr>
				<th>Evento ó Capacitación</th>
                <th>Inscribirme</th>
            </tr>
        </tfoot>
    </table>
</div>

<script type="text/javascript" src="../js/inscrip.js"></script>

<?php if($ninsCap){ foreach($ninsCap AS $dni){
	if($dni['comce']==2){
		echo "<script>mostrarCrearEquipo(".$dni['idce'].");</script>";
}}} ?>
