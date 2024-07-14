<?php if($_SESSION['pefid']!=58 or $_SESSION['pefid']!=73 or $OCI){ ?>

	<?php
function modalEditActivity($modalId, $modalTitle, $activityId, $activityData) {
    ob_start();
    $url_edit_action = base_url . "Mejseg/actualizarActividad&nopla=" . $_GET['nopla'];
    $url_approve_action = base_url . "Mejseg/aprobarActividad";
    $url_disapprove_action = base_url . "Mejseg/desaprobarActividad";
    ?>
    <div class="modal fade" id="<?= $modalId . $activityId ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $modalId . 'Label' ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="<?= $modalId . 'Label' ?>"><?= $modalTitle ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= $url_edit_action ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="prevActivityId" value="<?= $activityData['noava'] ?>">
                        <input type="hidden" name="noava" value="<?= $activityData['noava'] ?>">
                        <div class="form-group">
                            <label for="noact">Número de Actividad</label>
                            <input type="text" class="form-control" name="noact" value="<?= $activityData['noact'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="comava">Comentario</label>
                            <input type="text" class="form-control" name="comava" value="<?= $activityData['comava'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="eviava">Evidencia</label>
                            <input type="text" class="form-control" name="eviava" value="<?= $activityData['eviava'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="perid">ID persona</label>
                            <input type="text" class="form-control" name="perid" value="<?= $activityData['perid'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="fechava">Fecha</label>
                            <input type="date" name="fechava" value="<?= date('Y-m-d', strtotime($activityData['fechava'])) ?>" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>

                    <!-- Formulario para aprobar avance -->
                    <form action="<?= $url_approve_action ?>" method="POST" class="d-inline">
                        <input type="hidden" name="noava" value="<?= $activityData['noava'] ?>">
                        <button type="submit" class="btn btn-success btn-sm btn2" title="Aprobar Avance">
                            <i class="fa fa-check"></i>
                        </button>
                    </form>

                    <!-- Formulario para desaprobar avance -->
                    <form action="<?= $url_disapprove_action ?>" method="POST" class="d-inline">
                        <input type="hidden" name="noava" value="<?= $activityData['noava'] ?>">
                        <button type="submit" class="btn btn-danger btn-sm btn2" title="No aprobar Avances">
                            <i class="fa fa-times"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
?>
	<!-- Insertar o Editar datos -->
	<?php if($h!='t47kt'){ ?>
		<?php echo Utils::tit("Acción","fas fa-restroom  mr-3","mejseg/index&nopla=".$nopla,"300px"); ?>
	<?php }else{ ?>
		<br>
	<?php } ?>

	<div id="inser">

		<?php 
		// var_dump($edit);
		// var_dump($val);

		if(isset($dtOnem)): ?>
			<h2 class="title-c m-tb-40">Ver Acción</h2>
		<?php else: ?>
			<h2 class="title-c m-tb-40">Crear Nueva Acción</h2>
		<?php endif; ?>
		<?php $url_action = base_url."mejseg/saveMejo&nopla=".$nopla; ?>
		<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
			<div class="row">
				<input type="hidden" name="nopla" value="<?=isset($nopla) ? $nopla:''; ?>"/>
				<input type="hidden" name="noacc" value="<?=isset($noacc) ? $noacc:''; ?>"/>
				<div class="form-group col-md-12">
					<label for="caumej">Causa(s) de la observación y/o hallazgo <small>(Utilice cualquier técnica: 5 ¿por qué?, espina pescado, lluvia de ideas etc.)</small></label>
					<textarea class="form-control form-control-sm" id="caumej" name="caumej" required ><?=isset($dtOnem) ? $dtOnem[0]['caumej']:''; ?></textarea>
				</div>
				<div class="form-group col-md-9">
					<label for="accmej"><strong>Detalle de Actividades para ejecutar la acción </strong><br><small>(Detalle todas las actividades que ejecutarán para eliminar la(s) causa(s) de la(s) observación(es) y/o hallazgo(s))</small></label>
					<!-- <textarea class="form-control form-control-sm" id="accmej" name="accmej" required ><?=isset($dtOnem) ? $dtOnem[0]['accmej'] : ''; ?></textarea> -->
				</div>
				<div class="form-group col-md-3" style="text-align: right;">
					<button class="btn btn-primary btn-sm btn2" style="background-color: #523178;" type="button" value="agregar" id="agr"><i class="fa fa-plus"></i> Agregar Actividad</button>
				</div>
				<div class="form-group col-md-3">
					<label>Actividad <small>(Por cada actividad agregue una nueva)</small></label>
				</div>
				<div class="form-group col-md-2">
					<label>Fórmula del indicador <small>(Detalle el resultado que se espera obtener)</small></label>
				</div>
				<div class="form-group col-md-2">
					<label>Porcentaje Actividad</label>
				</div>
				<div class="form-group col-md-2">
					<label>Fec. Inicial</label>
				</div>
				<div class="form-group col-md-2">
					<label>Fec. Terminación</label>
				</div>
				<div class="form-group col-md-1">
				</div>
				<?php 
					if($dtOnem){
						$plamej->setNoacc($dtOnem[0]['noacc']);
						$datacc = $plamej->getOneAct();
				?>
					<div class="form-group col-md-12">
						<div class="row">
							<?php if($datacc){ $gr=0; foreach($datacc AS $dtac){ ?>

								<div id="dp1" class="form-group col-md-3" style="background: rgb(223, 208, 241);">
									<input type="hidden" name="noact[]" value="<?=$dtac['noact'];?>">
									<input type="text" name="accmej[]" id="accmej" required="" class="form-control form-control-sm" value="<?=$dtac['accmej'];?>">
								</div>
								<div id="dc1" class="form-group col-md-4" style="background: rgb(223, 208, 241);">
									<input type="text" name="foract[]" id="foract" required="" class="form-control form-control-sm" value="<?=$dtac['foract'];?>">
								</div>
								<div id="dc1" class="form-group col-md-2" style="background: rgb(223, 208, 241);">
                                   <input type="number" name="porcentaje[]" id="porcentaje" required="" class="form-control form-control-sm" min="0" max="100" value="<?=$dtac['porcent'];?>">
                                </div>
								<div id="dc1" class="form-group col-md-2" style="background: rgb(223, 208, 241);">
									<input type="date" name="finimej[]" id="finimej<?="_".$gr;?>" required="" class="form-control form-control-sm" value="<?=isset($dtac) ? substr($dtac['finimej'],0,10):$fec; ?>" min="<?=substr($plamejs[0]['fsolpla'],0,10);?>" max="<?=$ftedt;?>" onchange="UpdFechaFin(this.value,<?="'_".$gr."'";?>);">
								</div>
								<div id="dc1" class="form-group col-md-2" style="background: rgb(223, 208, 241);">
									<input type="date" name="ffinmej[]" id="ffinmej<?="_".$gr;?>" required="" class="form-control form-control-sm" value="<?=isset($dtac) ? substr($dtac['ffinmej'],0,10):$ftedtp; ?>" min="<?=$fec;?>">
								</div>
								<div id="dc1" class="form-group col-md-1" style="text-align: center;">
									<?php
										$plamej->setNoact($dtac['noact']);
										$cva2 = $plamej->getCouAva2();
										//var_dump($cva2); 
										if($cva2 AND $cva2[0]['can']==0){
									?>
											<div class="btn-group btn-group-toggle" data-toggle="buttons">
											    <label class="btn btn-primary btntoo">
											        <input type="checkbox" name="chkeli[]" value="<?=$dtac['noact'];?>" autocomplete="off"><i class="fa fa-trash" title="Selecciona para eliminar"></i>
											    </label>
											</div>
									<?php } ?>

								</div>								
							<?php $gr++; }} ?>
						</div>	
					</div>
				<?php 
					}
				?>
				<div class="form-group col-md-12">
					<div id="act" class="row"></div>	
				</div>
				<div class="form-group col-md-6">
					<label for="tapmej">Tipo de acción Propuesta <small>(Seleccione de la lista desplegable)</small></label>
					<select class="form-control form-control-sm" style="padding: 0px;" id="tapmej" name="tapmej">
					<?php 
					if($accpro){ foreach ($accpro as $do){ ?>
			                <option value="<?=$do['valid'];?>" 
			                	<?=isset($dtOnem) && $do['valid']==$dtOnem[0]['tapmej'] ? ' selected ' : ''; ?> ><?=$do['valnom'];?>
			                </option>
			        <?php }} ?>
			        </select>
				</div>
<!-- 				<div class="form-group col-md-6">
					<label for="formej">Fórmula del indicador <small>(Detalle el resultado que se espera obtener)</small></label>
					<input type="text" class="form-control form-control-sm" id="formej" name="formej" required value="<?=isset($dtOnem) ? $dtOnem[0]['formej'] : ''; ?>">
				</div> -->
				<!-- <div class="form-group col-md-6">
					<label for="metmej">Meta de la acción <small>(Detalle el resultado que se espera obtener)</small></label>
					<input type="number" min="0" max="100" class="form-control form-control-sm" id="metmej" name="metmej" required value="<?=isset($dtOnem) ? $dtOnem[0]['metmej'] : ''; ?>">
				</div> -->
				<input type="hidden" id="metmej" name="metmej" value="0">
				<div class="form-group col-md-6">
					<label for="alcmej">% que se espera alcanzar de la meta <small>(Ingrese números de 0 a 100)</small></label>
					<input type="number" min="0" max="100" class="form-control form-control-sm" id="alcmej" name="alcmej" required value="<?=isset($dtOnem) ? $dtOnem[0]['alcmej']:'100'; ?>">
				</div>
<!-- 				<div class="form-group col-md-6">
					<label for="finimej">Fecha de inicio</label>

					<input type="date" class="form-control form-control-sm" id="finimej" name="finimej" required value="<?=isset($dtOnem) ? substr($dtOnem[0]['finimej'],0,10):$fec; ?>" min="<?=substr($plamejs[0]['fsolpla'],0,10);?>" max="<?=$ftedt;?>">
				</div>
				<div class="form-group col-md-6">
					<label for="ffinmej">Fecha terminación</label>
					<input type="date" class="form-control form-control-sm" id="ffinmej" name="ffinmej" required value="<?=isset($dtOnem) ? substr($dtOnem[0]['ffinmej'],0,10):$ftedtp; ?>" min="<?=$fec;?>" max="<?=$ftedt;?>">
				</div> -->

<!-- // Inicio////////////////////////////////////////////////////// -->
				<div class="form-group col-md-6" id="go1">
					<label for="aremej">Área responsable de ejecución <small>(Para varios mantenga seleccionado Ctrl)</small></label>
					<?php
						if(isset($dtOnem) AND $dtOnem[0]['aremej']){
							$rvare = explode(";", $dtOnem[0]['aremej']);
							array_unshift($rvare,"--");
						}
					?>
					<select class="form-control form-control-sm" style="padding: 0px;max-height: none;height: 115px;" id="aremej" name="aremej[]"  multiple="multiple">
					<?php if($area){ foreach ($area as $do){ ?>
						<?php 
							if(isset($dtOnem) AND $dtOnem[0]['aremej'])
								$pos = array_search($do['valid'], $rvare);
							else
								$pos = NULL;

						?>
		                <option value="<?=$do['valid'];?>" 
		                	<?=isset($dtOnem) && $dtOnem[0]['aremej'] && $pos ? ' selected ':''; ?>><?=$do['valnom'];?>
		                </option>
				    <?php }} ?>
				    </select>
				</div>
<!-- // Fin////////////////////////////////////////////////////////////// -->


<!-- // Inicio ////////////////////////////////////////////////////////// -->
				<div class="form-group col-md-6" id="go1">
					<label for="carlmej">Cargo del Líder proceso <small>(Seleccione de la lista desplegable)</small></label>
					<?php
						if(isset($dtOnem) AND $dtOnem[0]['carlmej']){
							$rvare = explode(";", $dtOnem[0]['carlmej']);
							array_unshift($rvare,"--");
						}
					?>
					<select class="form-control form-control-sm" style="padding: 0px;max-height: none;height: 115px;" id="carlmej" name="carlmej[]"  multiple="multiple">
					<?php if($cargoLid){ foreach ($cargoLid as $do){ ?>
						<?php 
							if(isset($dtOnem) AND $dtOnem[0]['carlmej'])
								$pos = array_search($do['valid'], $rvare);
							else
								$pos = NULL;

						?>
		                <option value="<?=$do['valid'];?>" 
		                	<?=isset($dtOnem) && $dtOnem[0]['carlmej'] && $pos ? ' selected ':''; ?>><?=$do['valnom'];?>
		                </option>
				    <?php }} ?>
				    </select>
				</div>
<!-- // Fin//////////////////////////////////////////////////////////// -->

<!-- // Inicio ////////////////////////////////////////////////////////// -->
				<div class="form-group col-md-6" id="go1">
					<label for="carrmej">Cargo del responsable de ejecución <small>(Seleccione de la lista desplegable)</small></label>
					<?php
						if(isset($dtOnem) AND $dtOnem[0]['carrmej']){
							$rvare = explode(";", $dtOnem[0]['carrmej']);
							array_unshift($rvare,"--");
						}
					?>
					<select class="form-control form-control-sm" style="padding: 0px;max-height: none;" id="carrmej" name="carrmej[]"  multiple="multiple">
					<?php if($cargo){ foreach ($cargo as $do){ ?>
						<?php 
							if(isset($dtOnem) AND $dtOnem[0]['carrmej'])
								$pos = array_search($do['valid'], $rvare);
							else
								$pos = NULL;

						?>
		                <option value="<?=$do['valid'];?>" 
		                	<?=isset($dtOnem) && $dtOnem[0]['carrmej'] && $pos ? ' selected ':''; ?>><?=$do['valnom'];?>
		                </option>
				    <?php }} ?>
				    </select>
				</div>
<!-- // Fin//////////////////////////////////////////////////////////// -->

				<div class="form-group col-md-6">
					<input type="submit" class="btn-primary-ccapital" value="Registrar">
					<?php if($noacc){ ?>
						<input type="hidden" name="edit" value="<?=$noacc;?>">
					<?php } ?>
				</div>
			</div>
		</form>
	</div>
<?php } ?>

<!-- Ver datos -->

<h2 class="title-c">Observación y/o hallazgo No. <?=$nopla;?></h2>
<br><br>

	<div class="table-responsive">
	<?php 
//l.nopla, l.fsolpla, l.fuepla, f.valnom AS fte, l.detfue, l.fobspla, l.cappla, l.obspla, l.areapla, l.estpla, e.valnom AS est
        if(isset($plamejs)){
        	foreach ($plamejs as $va){
				$carlmej = $va['carlmej'];
        		$peridAc = $va['perid']; ?>
				<table class="table table-hover">
					<tr>
						<th class="tablefor">Fecha Solicitud:</th>
						<td class="active">
							<strong>
								<?=$va['fsolpla'];?>
							</strong>
						</td>
						<th class="tablefor">Fuente:</th>
						<td class="active">
							<strong>
								<?=$va['fte'];?>
							</strong>
						</td>
					</tr>
					<tr>
						<th class="tablefor">Detalle:</th>
						<td class="active" colspan="4">
							<?=$va['detfue'];?>
						</td>
					</tr>
					<tr>
						<th class="tablefor">Observación:</th>
						<td class="active" colspan="4">
							<?=$va['obspla'];?>
						</td>
					</tr>
					<tr>
						<th class="tablefor">Fecha Observación:</th>
						<td class="active">
							<?=$va['fobspla'];?>
						</td>
						<th class="tablefor">Código o capítulo:</th>
						<td class="active"><?=$va['cappla'];?></td>
					</tr>
					<tr>
						<th class="tablefor">Áreas:</th>
						<td class="active">
							<?=mosArea($va['areapla']);?>
						</td>
						<th class="tablefor">Estados:</th>
						<td class="est"><?=$va['est'];?></td>
					</tr>
				</table>
		<?php }} ?>
	</div>


<?php 
function mosArea($noAre){
	$areas = NULL;
	$noAre = explode(";",$noAre);
	$plamej = new plamej();
	if($noAre){ foreach($noAre  AS $dta){
		$dtAr = $plamej->getArea($dta);
		if($dtAr){ foreach($dtAr  AS $da){
			$areas .= $da['valid']." ".$da['valnom']."<br>";
		}}
	}}
	return $areas;
}
?>
	<br>

<!-- Detalles -->

<!-- Ver datos -->

<h2 class="title-c">Acción de mejora</h2>

<?php 
if ($_SESSION['pefid'] == 71 OR $_SESSION['pefid'] == 75) {
    $plamej->setCargo($carlmej);
    $datPL = $plamej->getPerCargo();
    $dtPerid = isset($datPL[0]['perid']) ? $datPL[0]['perid'] : NULL;
    $plamej->setNopla($nopla);
    $DtCaA = $plamej->getCouAccApr();

    if (!$peridAc AND $dtPerid == $_SESSION['perid'] AND $DtCaA AND $DtCaA[0]['can'] == 0) {
?>
        <div class="row">
            <div class="form-group col-md-12" style="text-align: right;">
                <a href="<?= base_url; ?>plamej/updPlmj&nopla=<?= $nopla; ?>&valid=3051">
					<button class="btn-primary-ccapital">
						<i class="fa fa-check-circle"></i>&nbsp;&nbsp;Aprobar por Lider de Proceso
					</button>
                </a>
            </div>
        </div>
<?php 
    } else { 
?>
        <div class="row">
            <div class="form-group col-md-12" style="text-align: right; color: #f00; font-weight: bold; text-shadow: 1px 1px 1px #000;">
                Aprobado por Lider de Proceso
            </div>
        </div>
<?php 
    }
} 
?>


<br><br>
<div class="table-responsive">
	<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
        <thead>
            <tr>
            	<th>Acciones - Causa(s) de la observación y/o hallazgo</th>
                <th style="width: 140px !important"></th>
            </tr>
        </thead>
        <tbody>
        	<?php 
        	if(isset($acci)){
        		foreach ($acci as $va){ ?>
	            <tr>
	            	<td>
	            		<big>
	            			<strong>No. Acción: <?=$va['noacc'];?></strong>
	            			<br>
	            			<strong>Causa: </strong>
	            			<?=$va['caumej'];?>
	            			<br>
	            		</big>
	            		<small>
	            			<strong>Universo:</strong> <?php if(isset($acti)) echo count($acti);?>&nbsp;&nbsp;&nbsp;
	            			<strong>Tipo de acción Propuesta:</strong> <?=$va['tap'];?><br>
	            			<!-- <strong>Fórmula del indicador:</strong> <?=$va['formej'];?> <br> -->
                        	<!-- <strong>Meta de la acción:</strong> <?=$va['metmej'];?>&nbsp;&nbsp;&nbsp; -->
                        	<strong>% que se espera alcanzar de la meta:</strong> <?=$va['alcmej'];?><br>
                        	<!-- <strong>Fec. Inicio:</strong> <?=substr($va['finimej'],0,10);?>
                        	&nbsp;&nbsp;&nbsp;
                        	<strong>Fec. Terminación:</strong> <?=substr($va['ffinmej'],0,10);?><br> -->
                        	<strong>Área res. de ejecución:</strong> <?=$va['are'];?><br>
                        	<strong>Líder proceso:</strong> <?=$va['cal'];?> 
                        	<strong>Responsable de ejecución:</strong> <?=$va['car'];?>
                        </small>
                        <br><br>

	            			<strong>Detalle de Actividades para ejecutar la acción:</strong> <br><br>
		            		<?php 
		            			$plamej->setNoacc($va['noacc']);
								$acti = $plamej->getOneAct();
		            			if($acti){ for ($i=0;$i<count($acti);$i++) { 
	            				// Obtener la fecha actual
								$currentDate = date('Y-m-d');
								// Obtener la fecha de inicio
								$startDate = substr($acti[$i]['finimej'], 0, 10);
								if ($currentDate < $startDate) {
                                $acti[$i]['bloact'] = 1; // Bloquear la actividad
                                }?>
	            				<div class="titdtact">
	            					<?php if($h!='t47kt'){ ?>
		            					<?php if($va['aprpmj']==1){ ?>
		            						<?php if(($_SESSION['pefid']==58 OR $_SESSION['pefid']==70 OR $_SESSION['pefid']==73 OR $_SESSION['pefid']==74)){ ?>
					            				<?php if($acti[$i]['bloact']==1){ ?>
					            					<a href= "<?=base_url;?>mejseg/updBloq&bloact=2&noact=<?=$acti[$i]['noact'];?>&nopla=<?=$va['nopla'];?>" class="btnblq">
				            							<i class="fas fa-lock" title="Haz click para desbloquear"></i>
				            						</a>
				            					<?php }else{ ?>
				            						<a href= "<?=base_url;?>mejseg/updBloq&bloact=1&noact=<?=$acti[$i]['noact'];?>&nopla=<?=$va['nopla'];?>" class="btnblq">
				            							<i class="fas fa-unlock-alt" title="Haz click para bloquear"></i>
				            						</a>
				            					<?php } ?>
				            				<?php }else{ ?>
				            					<?php if($acti[$i]['bloact']==1){ ?>
				            						<i class="fas fa-lock" title="Bloqueado" style="color: #523178;"></i>
				            					<?php }else{ ?>
				            						<i class="fas fa-unlock-alt" title="Desbloqueado" style="color: #523178;"></i>
				            					<?php } ?>
				            				<?php } ?>	
		            					<?php } ?>
		            				&nbsp;&nbsp;
		            				<?php } ?>
	            					
	            					<?=($i+1).". ".$acti[$i]['accmej'];?>
	            					<br>
	            					<small>
		            					<strong>Indicador: </strong>
		            					<?=$acti[$i]['foract'];?>
		            				</small>
									<br>
									<small>
		            					<strong>Porcentaje actividad: </strong>
		            					<?=$acti[$i]['porcentaje'];?>%
		            				</small>
		            				<div style="display: inherit;float: right;margin-top: -17px;">
			            				<small>
				            				<strong>F. Ini.: </strong><?=substr($acti[$i]['finimej'],0,10);?>
			            					<br>
			            					<strong>F. Ter.: </strong><?=substr($acti[$i]['ffinmej'],0,10);?>
			            				</small>
			            			</div>
	            				</div>
	            				<?php 
	            					$vlmin = 0;
									$plamej->setNoact($acti[$i]['noact']);
									$datAva = $plamej->getAllAva();
								?>

								&nbsp;&nbsp;
								<?php $flag=true; ?>
	            				<?php if($h!='t47kt'){ ?>
		            				<?php if($va['aprpmj']==1){ ?>
			            				<?php if(($_SESSION['pefid']!=58 or $_SESSION['pefid']!=73 or $OCI) AND !$datAva AND $acti[$i]['bloact']==2 AND $plamejs[0]['perid']){ ?>
			            					<button class="btn btn-primary btn-sm btn2" style="background-color: #523178;margin: 2px;" data-toggle="modal" data-target="#myModtf<?=$acti[$i]['noact'];?>" type="button" title="Agregar Avance"><i class="fa fa-plus"></i></button>
						                	<?php 
						                		echo Utils::modalTextFile("myModtf", "Agregar Avance", $acti[$i]['noact'], "Relación de Avances", base_url."mejseg/saveAva", "comava", $nopla, ($i+1).". ".$acti[$i]['accmej'],"Evidencias y/o soportes de la ejecución de la acción", "eviava", "Si va a subir más de una evidencia, <br>súbelo en un archivo *.zip")
						                	?>

						                	<?php if($_SESSION['pefid']==58 OR $_SESSION['pefid']==70 OR $_SESSION['pefid']==73 OR $_SESSION['pefid']==74){ ?>
						                		<button class="btn btn-primary btn-sm btn2" style="background-color: #523178;padding: 0px 4px;margin-bottom: 2px;" type="button" data-toggle="modal" data-target="#myModSegSA<?=$acti[$i]['noact'];?>"><i class="fa fa-plus"></i> Agregar Seguimiento Sin Avances</button>

						                		<?php 
													echo Utils::modalTextCombo("myModSegSA", "Agregar Seguimiento Sin Avances", $acti[$i]['noact'], "Análisis del seguimiento <small>(Información del análisis adelantado por el auditor que realizó el seguimiento - OCI)</small>", base_url."mejseg/saveSeguSA", "anaseg", $nopla, ($i+1).". ".$acti[$i]['accmej'],substr($acti[$i]['ffinmej'],0,10),"", "aleseg","Porcentaje Ejecución","ejesep", "",$vlmin);
						                		?>
						                		<?php $flag=false; ?>

						                	<?php } ?>
						                	
			            				<?php } ?>
		            				<?php } ?>
		            			<?php } ?>
	            				<br>
	            				
	            				<?php
	            					$segui = NULL; 
	            					$vlmin = 0;
	            				?>

								<?php $r=0; if($datAva){ foreach ($datAva as $dta){ ?>
									<small>
										<div class="row">
											<div class="form-group col-md-3 bpun">
												<?=$dta['comava'];?>
												<br>
												<span class="<?= 
													($dta['estapr'] == 'Aprobado') ? 'text-success' : 
													(($dta['estapr'] == 'Pendiente') ? 'text-primary' : 'text-danger'); 
												?>">
													<?=$dta['estapr'];?>
												</span>
											</div>
											<div class="form-group col-md-1 bpun bpuncm">
												<?=$dta['fechava'];?>
											</div>
											<div class="form-group col-md-1 bpun bpuncm">
											<?php if($_SESSION['pefid'] == 58 || $_SESSION['pefid'] == 70 || $_SESSION['pefid'] == 73 || $_SESSION['pefid'] == 74) { ?>
													<div class="btn-group">
														<!-- Botón para editar-->
														<button class="btn btn-primary btn-sm btn2" type="button" data-toggle="modal" data-target="#editActivityModal<?=$dta['noava'];?>" title="Editar Actividad">
															<i class="fa fa-pencil-square-o"></i>
														</button>
														
														<?php
															// Modal para editar el avance
															echo modalEditActivity("editActivityModal", "Editar Avance", $dta['noava'], $dta);
														?>


													</div>
													<span id="statusText<?=$dta['noava'];?>" class="status-text"></span>
												    <?php } ?>
											</div>
											<div class="form-group col-md-1 bpun bpuncm">
												<?php
													$pathc = path_filem.$dta['eviava'];
													$pathc2 = path_file.$dta['eviava'];
													if (file_exists($pathc2))
														echo "<a href='".$pathc."' title='Descargar Evidencia ".$dta['comava']."'><i class='fa fa-download'></i></a>";
												?>
											</div>
											<div class="form-group col-md-6 bpun bpuncm">
												<?php 
													$plamej->setNoava($dta['noava']);
													$segui = $plamej->getAllSeg();
													$p=0;
													if($segui){ foreach ($segui as $sg){ ?>
														<strong><?=$sg['ale'];?></strong> <?=$sg['fecseg'];?>
								            		<?php
								            		if(isset($sg['ejesep'])){
								            			$vlmin= $sg['ejesep'];
								            		}
								            		$plamej->setNoact($acti[$i]['noact']);
								            		$CtnSgAcc = $plamej->getCtnSgAcc();
								            		$CtnSgAcc = isset($CtnSgAcc[0]['ctn']) ? $CtnSgAcc[0]['ctn']-1:0;
								            		$EjeSgAcc = $plamej->getEjeSgAcc();
								            		$EjeSgAcc = isset($EjeSgAcc[$CtnSgAcc-1]['ejesep']) ? $EjeSgAcc[$CtnSgAcc-1]['ejesep']:0;
								            		?>
								            		<?php if($h!='t47kt' and ($r==count($datAva)-1 or $r==$CtnSgAcc)){ ?>
									            		<?php if($_SESSION['pefid']==58 OR $_SESSION['pefid']==70 OR $_SESSION['pefid']==73 OR $_SESSION['pefid']==74){ ?>
									            		<button class="btn btn-primary btn-sm btn2" style="background-color: #523178;padding: 0px 4px;margin-bottom: 2px;" type="button" data-toggle="modal" data-target="#myModSeguE<?=$dta['noava'];?>" title="Editar Seguimiento"><i class="fa fa-pencil-square-o"></i></button>
									                	<?php 
								                			echo Utils::modalTextComboEdi("myModSeguE", "Editar Seguimiento", $dta['noava'], "Análisis del seguimiento <small>(Información del análisis adelantado por el auditor que realizó el seguimiento - OCI)</small>", base_url."mejseg/saveSegu", "anaseg", $nopla, $dta['comava'],substr($acti[$i]['ffinmej'],0,10),"Fecha Entrega", "aleseg","Porcentaje Ejecución","ejesep", "",$sg['noplsg'],$sg['anaseg'],$sg['ejesep'],$EjeSgAcc);
									                	?>
									                	<?php } ?>
									                <?php } ?>


								            		<br>
								            		<!-- <?=$sg['est'];?> -->
								            		<small>
								            			<?=$sg['anaseg'];?><br>
								            			<!-- <strong>Actividades realizadas a la fecha:</strong> <?=$sg['actrea'];?>
								            			<br> -->
								            			<!-- <strong>% avance en ejecución de la meta:</strong> <?=$sg['valfijo'];?> % -->
							                        </small>
							                        <?php $txtbcsb=""; 
							                        if(!$sg['ejesep']) $txtbcsb= "style='background-color: ".$sg['pre'].";'"; ?>
							                        <div class="bar1" <?=$txtbcsb;?>><div class="bar2" style="background-color: <?=$sg['pre'];?>;width: <?=$sg['ejesep'];?>%;">
							                        	<?=$sg['ejesep'];?> %
							                     <!--   	<?=$sg['valfijo'];?> % <?=$sg['abr'];?> -->
							                        </div></div>
							                        <small>
								            			<strong>Auditor: </strong> <?=$sg['pernom']." ".$sg['perape'];?><br>
								            		</small>
											    <?php $p++; }}else{ ?>
											    	<?php if($_SESSION['pefid']==58 OR $_SESSION['pefid']==70 OR $_SESSION['pefid']==73 OR $_SESSION['pefid']==74){ ?>
											    		<?php if($h!='t47kt'){ ?>
															<button class="btn btn-primary btn-sm btn2" style="background-color: #523178;padding: 0px 4px;margin-bottom: 2px;" type="button" data-toggle="modal" data-target="#myModSegu<?=$dta['noava'];?>"><small><small><i class="fa fa-plus"></i> Agregar Seguimiento</small></small></button>
										                	<?php 
									                			echo Utils::modalTextCombo("myModSegu", "Agregar Seguimiento", $dta['noava'], "Análisis del seguimiento <small>(Información del análisis adelantado por el auditor que realizó el seguimiento - OCI)</small>", base_url."mejseg/saveSegu", "anaseg", $nopla, $dta['comava'],substr($acti[$i]['ffinmej'],0,10),"Fecha Entrega", "aleseg","Porcentaje Ejecución","ejesep", "",$vlmin);
										                	?>
										                	<?php $flag=false; ?>
										                <?php } ?>
													<?php }else{ ?>
														<small>Sin seguimiento</small>
													<?php } ?>
												<?php } ?>

														</div>
													</div>
									</small>
								<?php $r++; }} ?>
						        <div class="form-group col-md-12 bpun">
						        <?php if($h!='t47kt'){ ?>
									<?php if($segui AND $va['aprpmj']==1){ ?>
			            				<?php if(($_SESSION['pefid']!=58 or $_SESSION['pefid']!=73 or $OCI) AND $acti[$i]['bloact']==2){ ?>
			            					<button class="btn btn-primary btn-sm btn2" style="background-color: #523178;margin: 2px;" data-toggle="modal" data-target="#myModtf<?=$acti[$i]['noact'];?>" type="button" title="Agregar Avance"><i class="fa fa-plus"></i></button>
						                	<?php 
						                		echo Utils::modalTextFile("myModtf", "Agregar Avance", $acti[$i]['noact'], "Relación de Avances", base_url."mejseg/saveAva", "comava", $nopla, ($i+1).". ".$acti[$i]['accmej'],"Evidencias y/o soportes de la ejecución de la acción", "eviava", "Si va a subir más de una evidencia, <br>súbelo en un archivo *.zip");
						                	?>
			            				<?php } ?>
		            				<?php } ?>
<!-- Inicio Agregar seguimiento sin avance -->
		            				<?php if($flag==true AND ($_SESSION['pefid']==58 OR $_SESSION['pefid']==70 OR $_SESSION['pefid']==73 OR $_SESSION['pefid']==74)){ ?>
						                		<button class="btn btn-primary btn-sm btn2" style="background-color: #523178;padding: 0px 4px;margin-bottom: 2px;" type="button" data-toggle="modal" data-target="#myModSegSA<?=$acti[$i]['noact'];?>"><i class="fa fa-plus"></i> Agregar Seguimiento Sin Avances</button>

						                		<?php 
													echo Utils::modalTextCombo("myModSegSA", "Agregar Seguimiento Sin Avances", $acti[$i]['noact'], "Análisis del seguimiento <small>(Información del análisis adelantado por el auditor que realizó el seguimiento - OCI)</small>", base_url."mejseg/saveSeguSA", "anaseg", $nopla, ($i+1).". ".$acti[$i]['accmej'],substr($acti[$i]['ffinmej'],0,10),"", "aleseg","Porcentaje Ejecución","ejesep", "",$vlmin);
						                		?>

						                	<?php } ?>
<!-- Fin Agregar seguimiento sin avance -->
		            			<?php } ?>
	            				</div>
						        <br>
                    <?php }} ?>
	                </td>
	                <td style="text-align: center;width: 140px;">
	                	<?php if(($_SESSION['pefid']!=58 or $_SESSION['pefid']!=73 or $OCI) AND $va['aprpmj']!=1){ ?>
	                		<div class="btnajupl">
		                		<a href= "<?=base_url;?>mejseg/index&nopla=<?=$va['nopla'];?>&noacc=<?=$va['noacc'];?>">
		                			<i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" title="Editar" style="color: #523178;"></i>
		                			<br><span class="txtajupl">Editar</span>
		                		</a>
		                	</div>
	                	<?php } ?>

	                	<div class="btnajupl">
	                	<?php if($va['aprpmj']==1){ ?>
	                		<?php if(($_SESSION['pefid']==58 OR $_SESSION['pefid']==70 OR $_SESSION['pefid']==73 OR $_SESSION['pefid']==74) AND $h!='t47kt' AND ($plamejs AND !$plamejs[0]['fecautpla'])){ ?>
		                		<a href= "<?=base_url;?>mejseg/updMej&nopla=<?=$va['nopla'];?>&at=2&noacc=<?=$va['noacc'];?>">
		                			<i class="fa fa-check-circle fa-2x" title="Aprobado" style="color: #523178;"></i>
		                			<br><span class="txtajupl">Aprobado</span>
		                		</a>
	                		<?php }else{ ?>
		                		<i class="fa fa-check-circle fa-2x" title="Aprobado" style="color: #523178;"></i>
		                		<br><span class="txtajupl">Aprobado</span>
	                		<?php } ?>
	                	<?php }else{ ?>
	                		
	                		<?php if($_SESSION['pefid']==58 OR $_SESSION['pefid']==70 OR $_SESSION['pefid']==73 OR $_SESSION['pefid']==74){ ?>
	                			<?php if($plamejs AND $plamejs[0]['perid']){ ?>
			                		<i class="fa fa-times-circle fa-2x" title="Falta la aprobación del lider a cargo" style="color: #f00;"></i>
		                			<br><span class="txtajupl">Sin aprobar</span>
			                	<?php }else{ ?>
		                			<a href= "<?=base_url;?>mejseg/updMej&nopla=<?=$va['nopla'];?>&at=1&noacc=<?=$va['noacc'];?>">
			                			<!-- fas fa-times-circle fa-2x -->
			                			<i class="fa fa-check-circle fa-2x bcacnd" title="Por aprobar"></i>
			                			<br><span class="txtajupl">Por aprobar</span>
			                		</a>
			                	<?php } ?>
	                		<?php }else{ ?>
		                		<i class="fa fa-check-circle fa-2x" title="Por aprobar" style="color: #f00;"></i>
		                			<br><span class="txtajupl">Por aprobar</span>
	                		<?php } ?>
	                		
	                	<?php } ?>
	                	</div>

	                	<br>
	                	<!-- Modal Modulos perfil -->
	                	<?php 
		                	$plamej->setNoacc($va['noacc']);
		                	$come = $plamej->getAllCom();
		                	$datos = NULL;
	                	?>
	                	<?php if($h!='t47kt'){ ?>
		                	<?php if($_SESSION['pefid']==58 OR $_SESSION['pefid']==70 OR $_SESSION['pefid']==73 OR $_SESSION['pefid']==74){ ?>
		                		<div class="btnajupl">
				                	<i class="fa fa-plus-circle fa-2x" data-toggle="modal" data-target="#myModCom<?=$va['noacc'];?>" title="Agregar Comentario" style="color: #523178;"></i>
				                	<br><span class="txtajupl" data-toggle="modal" data-target="#myModCom<?=$va['noacc'];?>">+ Comentario</span>
				                </div>
			                	<?php 
			                		echo Utils::modalUnText("myModCom", "Agregar Comentario", $va['noacc'], "", base_url."mejseg/saveCom", "relcom",$nopla,"","","",$va['noacc']." - ".$va['caumej']);
			                	?>
		                	<?php } ?>
		                <?php } ?>

	                	

	                	<?php 
	                		$plamej->setNoacc($va['noacc']);
	                		$CanCom = $plamej->getCanCom();
	                	?>
	                	<div class="btnajupl">
		                	<i class="fa fa-comment fa-2x" data-toggle="modal" data-target="#myMosCom<?=$va['noacc'];?>" title="Ver Comentario" style="color: #523178;">
		                		<?php if($CanCom[0]['can']>0){ ?>
		                			<div class="dcnum"><?=$CanCom[0]['can'];?></div>
		                		<?php } ?>
		                	</i>
		                	<br><span class="txtajupl" data-toggle="modal" data-target="#myMosCom<?=$va['noacc'];?>">Comentarios</span>
		                </div>
	                	
	                	
	                	<?php 
	                		echo Utils::modalMosCom("myMosCom", "Comentarios", $va['noacc'], "Opinión", base_url."mejseg/saveCom", "relcom",$nopla,$come,"Evidencias","");
	                	?>


	                	<?php //if($_SESSION['pefid']==58 OR $_SESSION['pefid']==70 OR $_SESSION['pefid']==73 OR $_SESSION['pefid']==74){ ?>
	                		<!-- <br>
	                		<a href= "<?=base_url;?>mejseg/delMejo&nopla=<?=$va['nopla'];?>&noacc=<?=$va['noacc'];?>" onclick="return eliminar();">
	                			<i class="fa fa-trash fa-2x" title="Eliminar" style="color: #523178;"></i>
	                		</a> -->
                		<?php //} ?>


	                	<?php if(($_SESSION['pefid']!=58 or $_SESSION['pefid']!=73 or $OCI) AND $va['aprpmj']!=1){ ?>
	                	<div class="btnajupl">
	                	<?php
	                		$plamej->setNoacc($va['noacc']);
			                $cacc = $plamej->getNoAccEli();
			                if($cacc AND $cacc[0]['can']==0){
			                ?>
					            <a href="<?=base_url?>mejseg/eliacc&noacc=<?=$va['noacc'];?>&nopla=<?=$va['nopla'];?>" onclick="return eliminar();">
				                	<i class="fas fa-trash fa-2x" title="Eliminar" style="color: #523178;"></i>
				                	<br><span class="txtajupl">Eliminar</span>
				                </a>
			            	<?php } ?>
			            </div>
			        	<?php } ?>
	                </td>
	            </tr>
	        <?php }} ?>
        </tbody>
        <tfoot>
            <tr>
            	<th>Acciones - Causa(s) de la observación y/o hallazgo</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
	
</div>

<!--
<br>
<h2 class="title-c">Avances</h2>
<br><br>
<div class="table-responsive">
    <table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
        <thead>
            <tr>
                <th style="text-align: center;">Avances / Seguimientos</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($acci) { foreach ($acci as $va) { ?>
                <?php 
                    $plamej->setNoacc($va['noacc']);
                    $acti = $plamej->getOneAct();
                    if ($acti) { foreach ($acti as $act) { ?>
                    <tr>
                        <td>
                            <strong>No. Acción: <?=$va['noacc'];?></strong> - 
                            <?=$act['accmej'];?> 
                            (<?=$act['foract'];?>) <br>
                            <?php 
                                $plamej->setNoact($act['noact']);
                                $datAva = $plamej->getAllAva();
                                $vlmin = 0;
                            ?>									
                            <?php if ($datAva) { foreach ($datAva as $dta) { ?>								
                                <small>
                                <div class="row">
                                    <div class="form-group col-md-3 bpun">
                                        <?=$dta['comava'];?>
                                    </div>
                                    <div class="form-group col-md-2 bpun bpuncm">
                                        <?=$dta['fechava'];?>
                                    </div>
                                    <div class="form-group col-md-1 bpun bpuncm">
                                        <?php
                                            $pathc = path_filem.$dta['eviava'];
                                            $pathc2 = path_file.$dta['eviava'];
                                            if (file_exists($pathc2))
                                                echo "<a href='".$pathc."' title='Descargar Evidencia ".$dta['comava']."'><i class='fa fa-download'></i></a>";
                                        ?>
                                    </div>
                                    <div class="form-group col-md-6 bpun bpuncm">
                                        <?php 
                                            $plamej->setNoava($dta['noava']);
                                            $segui = $plamej->getAllSeg();
											$fechava = $dta['fechava'];
											//$acti = $plamej->getOneAct();
                                            if ($segui) { foreach ($segui as $sg) {?>																			
                                                <strong><?=$sg['ale'];?></strong> <?=$sg['fecseg'];?>
                                                <br>
                                                <small>
                                                    <?=$sg['anaseg'];?><br>
                                                </small>
                                                <div class="bar1">
                                                    <div class="bar2" style="background-color: <?=$sg['pre'];?>; width: <?=$sg['valfijo'];?>%;">
                                                        <?=$sg['valfijo'];?> % <?=$sg['abr'];?>
                                                    </div>
                                                </div>
                                                <small>
                                                    <strong>Auditor: </strong> <?=$sg['pernom']." ".$sg['perape'];?><br>
                                                </small>
												
                                            <?php }} else { ?>
                                                <?php if ($_SESSION['pefid'] == 58 || $_SESSION['pefid'] == 70 || $_SESSION['pefid'] == 73 || $_SESSION['pefid'] == 74) { 
                                                    // Validar si la fecha actual es mayor que fecseg
                                                    $fecha_actual = date('Y-m-d');
                                                    if ($fecha_actual > $fechava) {
														//echo "la fecha start es " . $startDate;
                                                        $est = 'Fecha Entrega: 2024-12-01'; // Definir aquí la variable $est según tus necesidades
                                                        echo '<button class="btn btn-primary btn-sm btn2" style="background-color: #523178; padding: 0px 4px; margin-bottom: 2px;" type="button" data-toggle="modal" data-target="#myModSegu'.$dta['noava'].'"><small><small><i class="fa fa-plus"></i> Agregar Seguimiento</small></small></button>';
                                                        echo Utils::modalTextCombo("myModSegu", "Agregar Seguimiento", $dta['noava'], "Análisis del seguimiento <small>(Información del análisis adelantado por el auditor que realizó el seguimiento - OCI)</small>", base_url."mejseg/saveSegu", "anaseg", $nopla, $dta['comava'], $est, "Evidencias y/o soportes de la ejecución de la acción", "aleseg", "", $vlmin);
                                                    } else {
                                                        echo '<small>Sin seguimiento</small>';
                                                    }
                                                } else { ?>
                                                    <small>Sin seguimiento</small>
                                                <?php } ?>
                                            <?php } ?>
                                    </div>
                                </div>
                                </small>
                            <?php }} ?>
                        </td>
                    </tr>
                <?php }} ?>
            <?php }} ?>
			
        </tbody>
        <tfoot>
            <tr>
                <th style="text-align: center;">Avances / Seguimientos</th>
            </tr>
        </tfoot>
    </table>
</div>
-->

 



<script type="text/javascript" src="../js/code.js?v=<?php echo time(); ?>"></script>
<?php if(!isset($dtOnem)){ ?>
	<script type="text/javascript">adctr(3);</script>
<?php } ?>

<?php if(isset($dtOnem)): ?>
	<script>ocultar(1,300);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>