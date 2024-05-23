<?php if($txtn){ ?>
	<div style="color: #ff0000;font-weight:bold;text-shadow: 1px 1px 1px #787676;">
		¡Su Inscripción ha sido <?=$txtn;?>.!<br><br>
	</div>
<?php }else{ ?>
	<br><br>
<?php }?>
	
<?php $url_action = base_url."equip/save"; ?>
<?php $url_action2 = base_url."cequi/save";?>

<h2 class="title-c m-tb-40">Inscripciones</h2>
<br><br>
<div class="table-responsive">
	<table id="example" class="table table-striped table-bordered dterpce" style="width:99%;">
        <thead>
            <tr>
                <th>Evento ó Capacitación</th>
                <th>Inscribirme</th>
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
	                        <?php if($dni['linkce']){ ?>
	                        	<strong>Link:</strong> <a href="<?=$dni['linkce'];?>" target="_blank"><?=$dni['linkce'];?></a></br>
	                        <?php } ?>
	                        <strong>Ubicación: </strong><?=$dni['ubice'];?>&nbsp;&nbsp;
	                        <strong>Por equipos: </strong>
	                        <?php if($dni['comce']==1) echo "No"; else echo "Si"; ?>
	                        <br>
	                        <strong>Descripción: </strong> <?=$dni['desce'];?>
                    	</small>
	                	<?php if($dni['comce']==2){ ?>
							<br><br>
							<input type="radio" name="equipo<?=$dni['idce'];?>" value="crear" onclick="mostrarCrearEquipo(<?=$dni['idce'];?>)" checked> Crear Equipo
							<input type="radio" name="equipo<?=$dni['idce'];?>" value="seleccionar" onclick="SeleccionarEquipo(<?=$dni['idce'];?>)"> Seleccionar Equipo
						<?php } ?>
					</td>
	                <td width="300px">

	                	<form class="m-tb-40" action="<?=$url_action;?>" style="margin: 0px !important;" method="POST">

	                		<div class="row">
	                			<?php if($dni['comce']==2){ ?>
			                		<div id="crearEquipo<?=$dni['idce'];?>" class="form-group col-md-12" style="display: none;">
			                			<label for="nomequ">Crear equipo - Nombre</label>
		                				<input type="text" class="form-control form-control-sm" id="nomequ" name="nomequ" value="<?=isset($datOne) ? $datOne[0]['nomequ']:''; ?>" />
									</div>
									<div id="seleccionarEquipo<?=$dni['idce'];?>" class="form-group col-md-12" style="display: none;">
			                			<label for="idequ">Seleccionar equipo</label>
			                			<?php
			                				$ep->setIdce($dni['idce']);
			                				$dtEqce = $ep->getEqui();
			                			?>
		                				<select id="idequ" name="idequ" class="form-control form-select" style="height: 50px;">
		                					<?php if($dtEqce){ foreach($dtEqce AS $dtec){ ?>
												<option value="<?=$dtec['idequ'];?>"><?=$dtec['nomequ'];?></option>
											<?php }} else{ ?>
												<option value="0">Cree un equipo (Sin equipos creados)</option>
											<?php } ?>
				                		</select>
									</div>
								<?php } ?>
								<div class="form-group col-md-12">
		                			<input type="hidden" name="idce" value="<?=$dni['idce'];?>">
		                			<input type="hidden" name="comce" value="<?=$dni['comce'];?>">
									<input type="submit" class="btn-primary-ccapital" style="margin-top: 0px;" value="Inscribirme">
								</div>
		                		
							</div>
						</form>
	                </td>
	            </tr>
	        <?php }} ?>
        </tbody>
        <tfoot>
            <tr>
				<th>Evento ó Capacitación</th>
                <th>Inscribirme</th>
            </tr>
        </tfoot>
    </table>
</div>

<h2 class="title-c m-tb-40">Mis inscripciones</h2>
<br><br>
<div class="table-responsive">
	<table id="example" class="table table-striped table-bordered dterpce" style="width:99%;">
        <thead>
            <tr>
                <th>Evento ó Capacitación</th>
				<th>Tipo o Modalidad</th>
				<th></th>
            </tr>
        </thead>
        <tbody>
        	<?php if($insCap){ foreach($insCap AS $dni){ ?> 
        		<tr>
            		<td>
                    	<strong><?=$dni['nomce'];?></strong>
                    	<small></br>
	                        <strong>Fecha Inicio:</strong> <?=$dni['fecince'];?> &nbsp;&nbsp;
	                        <strong>Fecha Fin:</strong> <?=$dni['fecfice'];?> </br>
	                        <strong>Ubicación:</strong> <?=$dni['ubice'];?></br>
	                        <?php if($dni['linkce']){ ?>
	                        	<strong>Link:</strong> <a href="<?=$dni['linkce'];?>" target="_blank"><?=$dni['linkce'];?></a></br>
	                        <?php } ?>
	                        <strong>Descripción:</strong> <?=$dni['desce'];?>
                    	</small>
	                </td>
					<td>
							<strong>Tipo: </strong><?=$dni['Tipo'];?></br>
	                    	<strong>Modalidad: </strong><?=$dni['Modal'];?>
					</td>
					<td style="text-align: center;">
						<a href="<?=base_url."equip/del&idce=".$dni['idce']; ?>">
							<i class="fa fa-trash fa-2x" style="color: #4d3274;" onclick="return eliminar();" aria-hidden="true"></i>
						</a>
						<?php 
						if($hoy>=substr($dni['fecince'],0,10) AND $hoy<=substr($dni['fecfice'],0,10) AND $dni['asis']==2){ ?>
							<a href="<?=base_url."equip/asins&idce=".$dni['idce']."&save=actin";?>">
							<button class="btn-primary-ccapital">
								¿Asistió? 
								<i class="fa fa-thumbs-up" aria-hidden="true"></i> Sí 
								<!-- <i class="fa fa-thumbs-down" aria-hidden="true"></i> No -->
							</button>
							</a>
						<?php }elseif($dni['asis']==1){ ?>
							<br><br>Si Asistió 
						<?php } ?>
					</td>
	            </tr>
	        <?php }} ?>
        </tbody>
        <tfoot>
            <tr>
				<th>Evento ó Capacitación</th>
				<th>Tipo o Modalidad</th>
				<th></th>
            </tr>
        </tfoot>
    </table>
</div>
<script type="text/javascript" src="../js/equip.js"></script>
<?php if($ninsCap){ foreach($ninsCap AS $dni){
	if($dni['comce']==2){
		echo "<script>mostrarCrearEquipo(".$dni['idce'].");</script>";
}}} ?>