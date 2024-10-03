<h2 class="title-c">Presupuesto <?=$idpaa;?>&nbsp;&nbsp;&nbsp;&nbsp;</h2>
<?php if (!isset($_SESSION['inspaa'])) { ?>
<!-- Inicio Selección área ///////////////////////////////////////////////// -->
<!-- Inicio Selección área Reportes ///////////////////////////////////////////////// -->
<div class="row">
        <!-- Filtro por Área -->
		<div class="form-group col-md-3">
 			<?php if(!isset($pfinandOne)): ?>
				<form class="m-tb-40" action="<?=base_url;?>presu/index" method="POST">
					<label for="areas">Filtro Total o por áreas</label>
					<select id="areas" name="areSel" class="form-control form-control-sm" style="padding: 0px;" onchange="this.form.submit();">
						<option value="0">Seleccione área</option>
						<?php foreach ($areas2 as $pf){ ?>
							<option value="<?=$pf['valid'];?>"<?= $pf['valid']==$areSel ? ' selected ':''; ?>>
								<?=$pf['valnom'];?>
							</option>
						<?php } ?>
					</select>
					<input type="hidden" name="estFin" value="<?=$estFin;?>">
					<input type="hidden" name="tot" value="<?=$tot;?>">
				</form>
			<?php endif; ?>
		</div>

        <!-- Filtro por Rubro -->
        <div class="form-group col-md-3">
            <form class="m-tb-40" action="<?=base_url;?>presu/index" method="POST">
                <label for="rubro">Filtrar por Rubro</label>
                <input type="text" id="rubro" name="rubroSel" class="form-control form-control-sm" value="<?= isset($rubroSel) ? $rubroSel : ''; ?>" placeholder="Ingrese Rubro">
            </form>
        </div>

        <!-- Filtro por IDDPA -->
        <div class="form-group col-md-2">
            <form class="m-tb-40" action="<?=base_url;?>presu/index" method="POST">
                <label for="iddpa">Filtrar por Nombre</label>
                <input type="text" id="iddpa" name="nobjetoSel" class="form-control form-control-sm" value="<?= isset($nobjetoSel) ? $nobjetoSel : ''; ?>" placeholder="Ingrese Nombre">
            </form>
        </div>
		<!-- <div class="mestCDP" style="display: block;margin-top: -100px;text-align: end;"> -->
        <!-- Botones para exportar y otros -->
        <div class="form-group col-md-0.5" style="text-align: right;">
            <form class="m-tb-40" action="<?=base_url;?>views/pdf4.php" target="_blank" method="POST">
				<br>
                <input type="hidden" name="areSel" value="<?=$areSel;?>">
                <input type="hidden" name="rubroSel" value="<?=$rubroSel;?>">
                <input type="hidden" name="nobjetoSel" value="<?=$nobjetoSel;?>">
                <button type="submit" class="btn" style="color: #523178;" title="Imprimir total o área seleccionada">
                    <i class="fas fa-print fa-2x"></i>
                </button>
            </form>
        </div>
        <div class="form-group col-md-0.5" style="text-align: right;">
            <form class="m-tb-40" action="<?=base_url;?>views/pdf4.php" target="_blank" method="POST">
				<br>
                <input type="hidden" name="areSel" value="<?=$areSel;?>">
                <input type="hidden" name="rubroSel" value="<?=$rubroSel;?>">
                <input type="hidden" name="nobjetoSel" value="<?=$nobjetoSel;?>">
                <button type="submit" class="btn" style="color: #523178;" title="PDF total o área seleccionada">
                    <i class="fas fa-file-pdf fa-2x"></i>
                </button>
            </form>
        </div>
		<div class="form-group col-md-0.5" style="text-align: right;">
			<form class="m-tb-40" action="<?=base_url;?>views/csv4.php" target="_blank" method="POST">
				<br>
			    <input type="hidden" name="areSel" value="<?=$areSel;?>">
                <input type="hidden" name="rubroSel" value="<?=$rubroSel;?>">
                <input type="hidden" name="nobjetoSel" value="<?=$nobjetoSel;?>">
				<button type="submit" class="btn" style="color: #523178;" title="CSV total o área seleccionada">
					<i class="fas fa-file-excel fa-2x"></i>
				</button>
			</form>
		</div>
		<div class="form-group col-md-1 m-tb-40" style="text-align: center;">
			<form class="m-tb-40" action="<?=base_url;?>presu/new" method="POST">
				<br>
				<button type="submit" class="" style="color: #523178;border-radius: 10px;padding: 7px 14px;" title="Agregar Nueva Fila al Presupuesto Vigente">
						<i class="fa fa-indent"></i>
				</button>
			</form>
		</div>
	
		<div class="form-group col-md-2 m-tb-40" style="text-align: center;">
			<?php 
				$PresCargado = $pfinan->VerPresCargado($idpaa);
				if($PresCargado AND $PresCargado[0]['can']==0){
			?>
				<button type="button" class="" style="color: #523178;border-radius: 10px;padding: 7px 14px;margin: 20px 0px 0px 0px !important;" title="Cargar Presupuesto de Archivo de Excel" data-toggle="modal" data-target="#myModPaaPr<?=$idpaa;?>">
						<i class="fa fa-file-excel-o"></i> Excel
				</button>
				<?php 
		    		echo Utils::modalfile("myModPaaPr", "Cargar Presupuesto ".$idpaa, $idpaa, "Cargar el presupuesto en archivo Excel. <br><small><a href='https://intranet.canalcapital.gov.co/erpc/mod/financiera/plantilla/Gastos_Vigencia_30junio2024.xlsx'>Descargue la plantilla aquí.</a></small>", base_url."presu/subirArchPre", "", "", "* Cargue un solo archivo.");
		    	?>
			<?php 
				}else{
					echo "<big><strong>Presupuesto<br>cargado</strong></big>";
				}
			?>
		</div>

		<div class="form-group col-md-2 m-tb-40" style="text-align: center;">
			<?php 
				$PresCargado = $pfinan->VerPresCargado($idpaa);
				if($PresCargado AND $PresCargado[0]['can']>0){
			?>
				<button type="button" class="" style="color: #523178;border-radius: 10px;padding: 7px 14px;margin: 20px 0px 0px 0px !important;" title="Cargar Presupuesto de Archivo CSV - Bogdata CDP" data-toggle="modal" data-target="#myModPaaCsv<?=$idpaa;?>">
						<i class="fa fa-file-text"></i> CDP
				</button>
				<?php 
		    		echo Utils::modalfile("myModPaaCsv", "Cargar Presupuesto CSV - CDP ".$idpaa, $idpaa, "Cargar el presupuesto en archivo CSV o XLS que genera Bogdata CDP para realizar conciliación. <br><small><a href='https://intranet.canalcapital.gov.co/erpc/mod/financiera/plantilla/CDP_28junio.2024.xls'>Descargue la plantilla aquí.</a></small>", base_url."presu/subirArchCon&tip=CDP", "", "", "* Cargue un solo archivo.");
		    	?>

		    	<button type="button" class="" style="color: #523178;border-radius: 10px;padding: 7px 14px;margin: 20px 0px 0px 0px !important;" title="Cargar Presupuesto de Archivo RP - Bogdata RP" data-toggle="modal" data-target="#myModPaaCrp<?=$idpaa;?>">
						<i class="fa fa-file-text"></i> RP
				</button>
				<?php 
		    		echo Utils::modalfile("myModPaaCrp", "Cargar Presupuesto CSV - RP ".$idpaa, $idpaa, "Cargar el presupuesto en archivo CSV o XLS que genera Bogdata RP para realizar conciliación. <br><small><a href='https://intranet.canalcapital.gov.co/erpc/mod/financiera/plantilla/RP_28.junio.2024.xls'>Descargue la plantilla aquí.</a></small>", base_url."presu/subirArcConRp&tip=RP", "", "", "* Cargue un solo archivo.");
		    	?>
			<?php 
				}
			?>
				
		</div>
		<div class="form-group col-md-1 m-tb-40" style="text-align: left;">
			<form class="m-tb-40" action="<?=base_url;?>views/csv5.php" target="_blank" method="POST">
				<!-- Campo oculto para enviar el valor de idpaa -->
				<input type="hidden" name="idpaa" value="<?=$idpaa;?>">
				<!-- Filtros adicionales que deben enviarse -->
				<input type="hidden" name="rubroSel" value="<?=isset($rubroSel) ? $rubroSel : '';?>">
				<input type="hidden" name="nobjetoSel" value="<?=isset($nobjetoSel) ? $nobjetoSel : '';?>">
				
				<button type="submit" class="" style="color: #523178;border-radius: 10px;padding: 12px 14px;margin: 0px 0px 0px 0px !important;" title="Imprimir Reporte">
					<i class="fas fa-print"></i>
				</button>
			</form>
		</div>
	</div>
<!-- Fin Selección área ///////////////////////////////////////////////// -->

<!-- Inicio tabla PRESUPUESTO ///////////////////////////////////////////////////////////////////////// -->
<?php if(isset($pfcdp)): ?>
		<br><br>
		<div class="table-responsive" style="display:none !important;">
			<table id="example" class="table table-striped table-bordered dterpc" style="width: 100%;" role="grid" aria-describedby="example_info">
				<thead>
					<tr>
						<th>Código</th>
						<th>
							<div class="row">
 								<div class="form-group col-md-4">
 									Objeto
 								</div>
 								<div class="form-group col-md-2">
 									Asignado
 								</div>
 								<div class="form-group col-md-2">
 									En CDP's
 								</div>
 								<div class="form-group col-md-2">
 									En RP's
 								</div>
 								<div class="form-group col-md-2">
 									Disponible
 								</div>
 							</div>
						</th>
					</tr>
				</thead>
				<tbody>
					
					<?php foreach ($pfcdp as $pf){ ?>
						<tr>
							<td><small><?=$ninipaa.$pf['codrub'];?></small>
								<?=$pf['fondo'];?>
							</td>
								<!-- <td><?//=$pf['unspsc'];?></td> -->
							<td>
								<div class="row">
	 								<div class="form-group col-md-4" style="margin-bottom: 0px !important;">
										<?php if ($pf['nomcont']) {?>
											<strong>Contratista </strong><?=$pf['nomcont'];?><br>
										<?php } ?>
										<?=$pf['nobjeto'];?>
										
										<br><br>
											<?php if ($pf['nexpcdp']) {?>
												<strong>No. Solicitud: </strong><?=$pf['nexpcdp'];?>
												<br>
											<?php } ?>
											<?php if ($pf['nbogdata']) {?>
												<strong>No. Bogdata: </strong><?=$pf['nbogdata'];?>
												<br>
											<?php } ?>
	 								</div>

	 								<div class="form-group col-md-2" style="margin-bottom: 0px !important;">
	 									$ <?=number_format($pf['asidpa'], 0, ',', '.');?>
	 									<?php 
											$dtcdp = $pfinan->sumPr("2,3",$pf['codrub']);
											$dtrp = $pfinan->sumPr("4",$pf['codrub']);
											$cdp= isset($dtcdp[0]['cdp']) ? $dtcdp[0]['cdp']:0;
											$rp= isset($dtrp[0]['cdp']) ? $dtrp[0]['cdp']:0;
											$dispo = ($pf['asidpa']-$cdp-$rp);
											$sumasi += $pf['asidpa'];
											$sumdis += $dispo;
											$sumcdp += $cdp;
											$sumrp += $rp;
										?>
	 								</div>
	 								<div class="form-group col-md-2" style="margin-bottom: 0px !important;">
	 									$ <?=number_format($cdp, 0, ',', '.');?>
	 								</div>
	 								<div class="form-group col-md-2" style="margin-bottom: 0px !important;">
	 									$ <?=number_format($rp, 0, ',', '.');?>
	 								</div>
	 								<div class="form-group col-md-2" style="margin-bottom: 0px !important;">
	 									$ <?=number_format($dispo, 0, ',', '.');?>
	 								</div>
<!-- 	 								<div class="form-group col-md-12">
	 									<strong>Área: </strong><?=$pf['are'];?>
										&nbsp;&nbsp;&nbsp;
										<small>
											<strong>Fecha Inicio: </strong><?=$pf['fecinidpa'];?>
											&nbsp;&nbsp;&nbsp;
											<strong>Fecha Fin: </strong>
											<?=$pf['fecfindpa'];?>
											&nbsp;&nbsp;&nbsp;
											<strong>Modalidad:</strong>
											<?=$pf['moda'];?>
											&nbsp;&nbsp;&nbsp;
											<strong>Fuente: </strong>
											<?=$pf['fuen'];?>
										</small>
									</div> -->
									<?php 
										$dtUni = $pfinan->getAllAnaPre($pf['codrub']);
										//var_dump($dtUni);
											//valcdp, anucdp, cxccdp, valrp, anurp, vlrneto, autgir, csagir, nintcrp, nintcdp, fecent
										if($dtUni){ foreach ($dtUni as $dtnu) { if($dtnu['valcdpM'] OR $dtnu['valrpM']){
									?>
									<!-- <div class="form-group col-md-12" style="font-size: 10px;text-align: right;">
										<?php if ($dtnu['nomcont']) {?>
											<strong>Contratista: </strong><?=$dtnu['nomcont'];?> 
											<strong>Fecha: </strong>
											<?=date('Y-m-d', $dtnu['fecent']);?>
										<?php } ?>
									</div> -->

	 								<div class="form-group col-md-3" style="font-size: 10px;text-align: center;background-color: #306fb642;font-weight: bold;margin-bottom: 0px !important;">CDP</div>
	 								<div class="form-group col-md-9" style="font-size: 10px;text-align: center;background-color: #306fb67e;font-weight: bold;margin-bottom: 0px !important;">RP</div>

	 								<div class="form-group col-md-2" style="font-size: 10px;text-align: right;margin-bottom: 0px !important;background-color: #306fb642;">
	 									<small>Valor CDP</small><br>
	 									<?="$ ".number_format($dtnu['valcdpM'], 0, ',', '.');?></div>
	 								<div class="form-group col-md-1" style="font-size: 10px;text-align: right;margin-bottom: 0px !important;background-color: #306fb642;">
	 									<small>Anu. CDP</small><br>
	 									<?="$ ".number_format($dtnu['anucdpM'], 0, ',', '.');?></div>

	 								
	 								<div class="form-group col-md-2" style="font-size: 10px;text-align: right;margin-bottom: 0px !important;background-color: #306fb67e;">
	 									<small>Com.Sin.Aut.Giro</small><br>
	 									<?="$ ".number_format($dtnu['csagirM'], 0, ',', '.');?></div>
	 								<div class="form-group col-md-2" style="font-size: 10px;text-align: right;margin-bottom: 0px !important;background-color: #306fb67e;">
	 									<small>Autorizacion giro</small><br>
	 									<?="$ ".number_format($dtnu['autgirM'], 0, ',', '.');?></div>
	 								<div class="form-group col-md-2" style="font-size: 10px;text-align: right;margin-bottom: 0px !important;background-color: #306fb67e;">
	 									<small>Valor CRP</small><br>
	 									<?="$ ".number_format($dtnu['valrpM'], 0, ',', '.');?></div>
	 								<div class="form-group col-md-1" style="font-size: 10px;text-align: right;margin-bottom: 0px !important;background-color: #306fb67e;">
	 									<small>Anulaciones</small><br>
	 									<?="$ ".number_format($dtnu['anurpM'], 0, ',', '.');?></div>
	 								<div class="form-group col-md-2" style="font-size: 10px;text-align: right;margin-bottom: 0px !important;background-color: #306fb67e;">
	 									<small>Valor Neto</small><br>
	 									<?="$ ".number_format($dtnu['vlrnetoM'], 0, ',', '.');?></div>
									<?php }}} ?>
	 							</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Código</th>
						<th>
							<div class="row">
 								<div class="form-group col-md-4">
 									Objeto
 								</div>
 								<div class="form-group col-md-2">
 									Asignado
 								</div>
 								<div class="form-group col-md-2">
 									En CDP's
 								</div>
 								<div class="form-group col-md-2">
 									En RP's
 								</div>
 								<div class="form-group col-md-2">
 									Disponible
 								</div>
 							</div>
						</th>
					</tr>
		    </tfoot>
			</table>
		</div>
	<?php endif; ?>	
<?php }?>
<!-- Fin tabla PRESUPUESTO ///////////////////////////////////////////////////////////////////////// -->






<h4 class="title-c">Reporte PAA&nbsp;&nbsp;&nbsp;&nbsp;</h4>
<br>

<div class="container mt-5">
    <!-- <h2 class="text-center"> PAA - Presupuesto</h2> -->
    <br>
    <table id="example" class="table table-striped table-bordered scrollx"style="width:100%">
        <thead>
            <tr>
                <th>Ce.gestores / Pos.presupuestarias</th>
                <th>Denominación</th>
                <th>Apropiación Inicial</th>
                <th>Modificaciones Mes</th>
                <th>Modific. Acumulado</th>
                <th>Apropiación Vigente</th>
                <th>Suspensión</th>
                <th>Aprop. Disponible</th>
                <th>CDP Mes</th>
                <th>CDP Acumulado</th>
                <th>Saldo Apr.Disponible</th>
                <th>Compromisos Mes</th>
                <th>Compromisos Acumulad.</th>
                <th>Saldo CDP x comprometer</th>
                <th>Eje Ptal %</th>
                <th>Giro Mes Presupuestal</th>
                <th>Giros Acumulados Ppto</th>
                <th>Saldo por Pagar</th>
                <th>% Ej.Giro</th>
            </tr>
        </thead>
        <tbody>
        	<?php foreach ($pfcdp as $pf){ ?>

	        	<tr>
	        		<td><small><?=$ninipaa.$pf['codrub'];?></small>	<?=$pf['fondo'];?> </td>
	                <td><?=$pf['nobjeto'];?></td>
	                <td>
	                	$ <?=number_format($pf['asidpa'], 0, ',', '.');?>
						<?php 
							$dtcdp = $pfinan->sumPr("2,3",$pf['codrub']);
							$dtrp = $pfinan->sumPr("4",$pf['codrub']);
							$cdp= isset($dtcdp[0]['cdp']) ? $dtcdp[0]['cdp']:0;
							$rp= isset($dtrp[0]['cdp']) ? $dtrp[0]['cdp']:0;
							$dispo = ($pf['asidpa']-$cdp-$rp);
							$sumasi += $pf['asidpa'];
							$sumdis += $dispo;
							$sumcdp += $cdp;
							$sumrp += $rp;

							$suspension=0;
							$aprodisp = $rp-$suspension;
							$Saldo_apr_disponible = $rp - $dtnu['valrpM'];
						?>
	                </td>
	                <td style="text-align:left !important;">$ 0</td>
	                <td>$ 0</td>
	                <td>$ <?=number_format($rp, 0, ',', '.');?></td>
	                <td>$ 0</td>
	                <td>$ <?=number_format($aprodisp, 0, ',', '.');?></td>
	                <td>$ 0</td>
	                <td><?="$ ".number_format($dtnu['valrpM'], 0, ',', '.');?></td>
	                <td>--</td>
	                <td>--</td>
	                <td>--</td>
	                <td>--</td>
	                <td>--</td>
	                <td>--</td>
	                <td>--</td>
	                <td>--</td>
	                <td>--</td>
	            </tr>
        	<?php } ?>

        </tbody>
        <tfoot>
        	<tr>
                <th>Ce.gestores / Pos.presupuestarias</th>
                <th>Denominación</th>
                <th>Apropiación Inicial</th>
                <th>Modificaciones Mes</th>
                <th>Modific. Acumulado</th>
                <th>Apropiación Vigente</th>
                <th>Suspensión</th>
                <th>Aprop. Disponible</th>
                <th>CDP Mes</th>
                <th>CDP Acumulado</th>
                <th>Saldo Apr.Disponible</th>
                <th>Compromisos Mes</th>
                <th>Compromisos Acumulad.</th>
                <th>Saldo CDP x comprometer</th>
                <th>Eje Ptal %</th>
                <th>Giro Mes Presupuestal</th>
                <th>Giros Acumulados Ppto</th>
                <th>Saldo por Pagar</th>
                <th>% Ej.Giro</th>
            </tr>
        </tfoot>
    </table>
</div>
