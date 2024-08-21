<h2 class="title-c">Plan Anual de Adquisiciones Detalle&nbsp;&nbsp;&nbsp;&nbsp;</h2>

<?php if (!isset($_SESSION['inspaa'])) { ?>


	<?php //if($_SESSION['pefid']==21 OR $_SESSION['pefid']==34){ ?>				
	<!--		<a href="<?=base_url?>paa/index&new=1" class="fas fa-plus-square fa-2x" style="color: #f66f16;" title="Nuevo Registro"></a>  -->
	<?php //} ?>

<!-- Inicio Selección área Reportes ///////////////////////////////////////////////// -->
 	<div class="row">
 		<div class="form-group col-md-3">
 			<?php if(!isset($pfinandOne)): ?>
				<form class="m-tb-40" action="<?=base_url;?>paa/detpaa&codrub=<?=$codrub;?>&tot=<?=$tot;?>" method="POST">
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
		<div class="form-group col-md-3">
				<form class="m-tb-40" action="<?=base_url;?>paa/detpaa&codrub=<?=$codrub;?>&tot=<?=$tot;?>" method="POST">
					<label for="estFin">Filtro Estados Financieros</label>
					<select id="estFin" name="estFin" class="form-control form-control-sm" style="padding: 0px;" onchange="this.form.submit();">
						<?php foreach ($estfi as $pf){ ?>
							<option value="<?=$pf['vaffijo'];?>"<?= $pf['vaffijo']==$estFin ? ' selected ':''; ?>>
								<?=$pf['vafnom'];?>
							</option>
						<?php } ?>
					</select>
					<input type="hidden" name="areSel" value="<?=$areSel;?>">
					<input type="hidden" name="tot" value="<?=$tot;?>">
				</form>
		</div>
		<div class="form-group col-md-3 m-tb-40">
			&nbsp;
		</div>
		<div class="form-group col-md-1" style="text-align: right;">
			<form class="m-tb-40" action="<?=base_url;?>views/pdf2.php" target="_blank" method="POST">
				<br>
				<input type="hidden" name="depid" value="<?=$_SESSION['depid'];?>">
				<input type="hidden" name="tot" value="<?=$tot;?>">
				<input type="hidden" name="areSel" value="<?=$areSel;?>">
				<input type="hidden" name="ntipoT" value="<?=$estFin;?>">
				<button type="submit" class="btn" style="color: #0071bc;" title="Imprimir total o área seleccionada">
					<i class="fas fa-print fa-2x"></i>
				</button>
			</form>
		</div>
		<div class="form-group col-md-1" style="text-align: right;">
			<form class="m-tb-40" action="<?=base_url;?>views/pdf2.php" target="_blank" method="POST">
				<br>
				<input type="hidden" name="depid" value="<?=$_SESSION['depid'];?>">
				<input type="hidden" name="tot" value="<?=$tot;?>">
				<input type="hidden" name="areSel" value="<?=$areSel;?>">
				<input type="hidden" name="ntipoT" value="<?=$estFin;?>">
				<input type="hidden" name="pdf" value="1547">
				<button type="submit" class="btn" style="color: #0071bc;" title="PDF total o área seleccionada">
					<i class="fas fa-file-pdf fa-2x"></i>
				</button>
			</form>
		</div>
		<div class="form-group col-md-1" style="text-align: right;">
			<form class="m-tb-40" action="<?=base_url;?>views/csv.php" target="_blank" method="POST">
				<br>
				<input type="hidden" name="depid" value="<?=$_SESSION['depid'];?>">
				<input type="hidden" name="tot" value="<?=$tot;?>">
				<input type="hidden" name="areSel" value="<?=$areSel;?>">
				<input type="hidden" name="ntipoT" value="<?=$estFin;?>">
				<button type="submit" class="btn" style="color: #0071bc;" title="CSV total o área seleccionada">
					<i class="fas fa-file-excel fa-2x"></i>
				</button>
			</form>
		</div>
	</div>
<!-- Fin Selección área Reportes ///////////////////////////////////////////////// -->


<!-- Inicio tabla Rubro Disponible y Asignado ///////////////////////////////////////////////// -->
<?php if($tip==1 OR $tip==0){ ?>
			<h4 class="title-c">Presupuesto disponible&nbsp;&nbsp;&nbsp;&nbsp;</h4>
			<?php //if(isset($pfinand) && !isset($codrub)): ?>
			<?php if(isset($pfinand)): ?>
				<br><br>
				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
						<thead>
							<tr>
								<th>Código</th>
								<th>Objeto</th>						
								<th>Asignación&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th>Disponible&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
								<?php $_SESSION['ninipaa']= $ninipaa;?>			
								
								<?php foreach ($pfinand as $pf){ ?>
									
									<tr>
										<td><small><?=$ninipaa.$pf['codrub'];?></small>
											<?php if($pf['codrub2']!=""): ?>
					                		<br><br><span>Nuevo rubro:</span><br>
					                		<?=$ninipaa.$pf['codrub2'];?>

					                	<?php endif; ?>

										</td>
											<!-- <td><?//=$pf['unspsc'];?></td> -->
										<td>
											<?php if ($pf['nomcont']) {?>
												<strong>Contratista </strong><?=$pf['nomcont'];?><br>
											<?php } ?>

											<?=$pf['nobjeto'];?>
											<br><br>
												<strong>Área: </strong><?=$pf['are'];?>
											<br>
											<small>
												<strong>Fecha Inicio: </strong><?=$pf['fecinidpa'];?>
												<br>
												<strong>Fecha Fin: </strong>
												<?=$pf['fecfindpa'];?>
												<br>
												<strong>Modalidad:</strong>
												<?=$pf['moda'];?>
												<br>
												<strong>Fuente: </strong>
												<?=$pf['fuen'];?>
												<br>
												<strong>Iddpa: </strong>
												<?=$pf['iddpa'];?>
												<br>
												<strong>depidd: </strong>
												<?=$pf['depidd'];?>
												<br>
												<strong>Proceso: 
												<?=$pf['nompro'];?>
												</strong>
												
											</small>
										</td>
										<?php
											$TAsig = $pfinan->TotAsig($pf['iddpa']);
											$TAsig1 = isset($TAsig[0]['asidpa']) ? $TAsig[0]['asidpa']:0;
											$TAsig2 = isset($TAsig[0]['TotAsig']) ? $TAsig[0]['TotAsig']:0;
											$TAsig3 = $TAsig1 + $TAsig2;
										?>
										<td align="right">
											$ <?=number_format($TAsig3, 0, ',', '.');?></td>
										<?php 
											$dtcdp = $pfinan->sumcdp($pf['iddpa'],$areas,$_SESSION['vig']);
											$dtrp = $pfinan->sumrp($pf['iddpa'],$areas,$_SESSION['vig']);
											$cdp= isset($dtcdp[0]['cdp']) ? $dtcdp[0]['cdp']:0;
											$rp= isset($dtrp[0]['rp']) ? $dtrp[0]['rp']:0;
											$dispo = ($pf['asidpa']-$cdp-$rp);
											$sumasi += $pf['asidpa'];
											$sumdis += $dispo;
											$sumcdp += $cdp;
											$sumrp += $rp;
										?>
										<td align="right">$ <?=number_format($dispo, 0, ',', '.');?></td>
										<td style="text-align: center;">
											<?php if($_SESSION['pefid']==21 OR $_SESSION['pefid']==34){ ?>	
												<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="Editar">
							                		<i class="fas fa-edit" style="color: #0071bc;"></i>
							                	</a>
							                <?php } ?>
												<br><br>
											<?php if($dispo>0){ ?>	
							                	<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>&soli=true" title="CDP">
							                		<i class="fas fa-file-invoice-dollar" style="color: #0071bc;"></i>
							                	</a>
							                	<br><br>
							                <?php } ?> 
			                				<a href="<?=base_raiz."modulo/mod&id=14&bus=1&iddpa=".$pf['iddpa'];?>" title="Busqueda Proveedor" class="btn-primary-ccapital btable">
			                					<i class="fa fa-search-plus" style="">Prv</i>
			                				</a>
			                				<?php //echo $_SESSION['perid']; ?>
			                				
										</td>
									</tr>

								<?php  } ?>
					
							
						</tbody>
						<tfoot>
							<tr>
								<td></td>
								<td></td>						
								<td align="right"><strong>$ <?=number_format($sumasi, 0, ',', '.');?></strong></td>
								<td align="right"><strong>$ <?=number_format($sumdis, 0, ',', '.');?></strong></td>
								<td></td>
							</tr>
							<tr>
								<th>Código</th>
								<th>Objeto</th>						
								<th>Asignación</th>
								<th>Disponible</th>
								<th></th>
							</tr>
				    </tfoot>
					</table>					
				</div>
			<?php endif; ?>	
<?php } ?>
<!-- Fin tabla Rubro Disponible y Asignado ///////////////////////////////////////////////// -->

<!-- Inicio tabla CDP ///////////////////////////////////////////////////////////////////////// -->
<?php if($tip==2 OR $tip==0){ ?>
	<?php if($tip!=2) echo "<br><br>"; ?>
	<h4 class="title-c">CDP's&nbsp;&nbsp;&nbsp;&nbsp;</h4>
	<?php if(isset($pfcdp)): ?>
		<br><br>
		<div class="table-responsive">
			<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
				<thead>
					<tr>
						<th>Código</th>
						<th>Objeto</th>						
						<th>Valor CDP's &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<th>Estado&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($pfcdp as $pf){ ?>
						<?php 
							// var_dump($pfcdp);
							// die();
						 ?>
						<tr>
							<td><small><?=$ninipaa.$pf['codrub'];?></small></td>
								<!-- <td><?//=$pf['unspsc'];?></td> -->
							<td>
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
									<strong>Área: </strong><?=$pf['are'];?>
								<br>
								<small>
									<strong>Fecha Inicio: </strong><?=$pf['fecinidpa'];?>
									<br>
									<strong>Fecha Fin: </strong>
									<?=$pf['fecfindpa'];?>
									<br>
									<strong>Modalidad:</strong>
									<?=$pf['moda'];?>
									<br>
									<strong>Fuente: </strong>
									<?=$pf['fuen'];?>
									<br>
									<strong>Proceso:
									<?=$pf['nompro'];?> 
									</strong>
									<br>
									<strong>iddpa:
									<?=$pf['iddpa'];?> 
									</strong>
									<br>
									<strong>depidd:
									<?=$pf['depidd'];?> 
									</strong>									
								</small>
							</td>
							<td align="right">$ <?=number_format($pf['asidpa'], 0, ',', '.');?></td>
							<?php 
								$dtcdp = $pfinan->sumcdp($pf['iddpa'],$areas,$_SESSION['vig']);
								$dtrp = $pfinan->sumrp($pf['iddpa'],$areas,$_SESSION['vig']);
								$cdp= isset($dtcdp[0]['cdp']) ? $dtcdp[0]['cdp']:0;
								$rp= isset($dtrp[0]['rp']) ? $dtrp[0]['rp']:0;
								$dispo = ($pf['asidpa']-$cdp-$rp);
								$sumasi += $pf['asidpa'];
								$sumdis += $dispo;
								$sumcdp += $cdp;
								$sumrp += $rp;
								$numflu=$pfinan->getVFlujoPro($pf['idpro'],3);
							?>
							<td>
								<?=$pf['actflu'];?>
								<br>
								<?php if($pf["idflu"]>$numflu[0]["mini"]){ ?>
									<div class="mestCDP">
										<a href="<?=base_url?>views/pdf.php?iddpa=<?=$pf['iddpa'];?>" target="_blank" title="Imprimir Solicitud CDP">
											<i class="fas fa-print fa-2x"></i>
										</a>
										&nbsp;
										<a href="<?=base_url?>views/pdf.php?pdf=1547&iddpa=<?=$pf['iddpa'];?>" target="_blank" title="PDF Solicitud CDP">
											<i class="fas fa-file-pdf fa-2x"></i>
										</a>
										<span><br><br>
											Solicitud CDP
										</span>
									</div>
								<?php } ?>
								<?php if($pf['rutcdp']){ ?>
									<div class="mestCDP">
										<a href="<?=path_filem;?><?=$pf['rutcdp'];?>" target="_blank" title="PDF CDP Bogdata">
											<i class="fas fa-file-pdf fa-2x"></i>
										</a>
										<span><br><br>
											CDP B.
										</span>
									</div>
								<?php } ?>
								
							</td>

							<td>
								<?php if($_SESSION['pefid']==34){ ?>	
									<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="Editar">
				                		<i class="fas fa-eye" style="color: #0071bc;"></i>
				                	</a>
					            <?php } ?>
								<br><br>
			                	<!-- <a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>&soli=true" title="CDP">
			                		// <i class="fas fa-file-invoice-dollar" style="color: #0071bc;"></i>
			                		<i class="fas fa-eye" style="color: #0071bc;"></i>
			                	</a> -->

			                	<?php if($pf['idmcdp'] == NULL){ ?>
			                		<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>&apro=1" title="Aprobar o Rechazar">
			                		<i class="fas fa-arrow-alt-circle-right" style="color: #0071bc;"></i>
			                		</a><br><br>
			                	<?php } ?>			                	
			                	
			                	<?php 
			                	$dtfl = $pfinan->getFCreaM(2);

			                	// var_dump($dtfl);
			                	// die();

			                	foreach ($dtfl AS $dtf){
			                		if($pf['area']==$_SESSION['depid'] AND $pf['idflu']==$dtf['idflu'] AND $pf['idmcdp'] == NULL){ 
			                	?>	
				                		<a href="<?=base_url?>paa/delcdp&iddpa=<?=$pf['iddpa'];?>" title="Cancelar y Liberar CDP" onclick="return elimObj();">
				                			<i class="fas fa-trash-alt" style="color: #0071bc;"></i>
				                		</a>
				                	<?php }
				            	} ?>

				            	<?php if ($pf['idmcdp'] != NULL) {?>
				            		<h6>Múltiple</h6>
				            	<?php } ?>


				            	<!-- Modal File Memorando CDP traslado  -->
				            	<!-- <?php if($pf['idmcdp'] == NULL){ ?>
				            		<br><br>
				                	<i class="fas fa-truck" data-toggle="modal" data-target="#myModFil<?=$pf['iddpa'];?>" title="Traslado" style="color: #0071bc;"></i>
				                	<?php 
				                	echo Utils::modalfile("myModFil", "Solicitud Traslado", $pf['iddpa'], "Cargar archivo, memorando solicitud traslado", base_url."paa/libera",$codrub); 
				                	?>
				                	<br><br>
				                <?php } ?> -->

							</td>
						</tr>
					<?php } ?>
			
					
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>						
						<td align="right"><strong>$ <?=number_format($sumasi, 0, ',', '.');?></strong></td>
						<td></td>	
						<td></td>
					</tr>
					<tr>
						<th>Código</th>
						<th>Objeto</th>						
						<th>Valor CDP's&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<th>Estado&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<th></th>
					</tr>
		    	</tfoot>
			</table>					
		</div>
	<?php endif; ?>	
<?php }?>
<!-- Fin tabla CDP ///////////////////////////////////////////////////////////////////////// -->

<!-- Inicio tabla RP ///////////////////////////////////////////////////////////////////////// -->
<?php if($tip==3 OR $tip==0){ ?>
	<?php if($tip!=3) echo "<br><br>"; ?>
	<h4 class="title-c">RP's&nbsp;&nbsp;&nbsp;&nbsp;</h4>
	<?php if(isset($pfrp)): ?>
		<br><br>
		<div class="table-responsive">
			<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
				<thead>
					<tr>
						<th>Código</th>
						<th>Objeto</th>						
						<th>Valor RP's&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<th>Estado</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($pfrp as $pf){ ?>
						<tr>
							<td><small><?=$ninipaa.$pf['codrub'];?></small></td>
								<!-- <td><?//=$pf['unspsc'];?></td> -->
							<td>
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
									<?php if ($pf['nrp']) {?>
										<strong>RP: </strong><?=$pf['nrp'];?>
										<br>
									<?php } ?>
									<strong>Área: </strong><?=$pf['are'];?>
								<br>
								<small>
									<strong>Fecha Inicio: </strong><?=$pf['fecinidpa'];?>
									<br>
									<strong>Fecha Fin: </strong>
									<?=$pf['fecfindpa'];?>
									<br>
									<strong>Modalidad:</strong>
									<?=$pf['moda'];?>
									<br>
									<strong>Fuente: </strong>
									<?=$pf['fuen'];?>
									<br>
									<strong>Proceso: 
									<?=$pf['nompro'];?>
									</strong>
									<br>
									<strong>iddpa:
									<?=$pf['iddpa'];?> 
									</strong>
									<br>
									<strong>depidd:
									<?=$pf['depidd'];?> 
									</strong>
									
								</small>
							</td>
							<td align="right">$ <?=number_format($pf['asidpa'], 0, ',', '.');?></td>
							<?php 
								$dtcdp = $pfinan->sumcdp($pf['iddpa'],$areas,$_SESSION['vig']);
								$dtrp = $pfinan->sumrp($pf['iddpa'],$areas,$_SESSION['vig']);
								$cdp= isset($dtcdp[0]['cdp']) ? $dtcdp[0]['cdp']:0;
								$rp= isset($dtrp[0]['rp']) ? $dtrp[0]['rp']:0;
								$dispo = ($pf['asidpa']-$cdp-$rp);
								$sumasi += $pf['asidpa'];
								$sumdis += $dispo;
								$sumcdp += $cdp;
								$sumrp += $rp;
								$numflu=$pfinan->getVFlujoPro($pf['idpro'],3);
								$btnApro=$pfinan->getVFlujoPro($pf['idpro'],4);
							?>
							<td>
								<?=$pf['actflu'];?>
								<br>
								<?php if($pf["idflu"]>$numflu[0]["mini"]){ ?>
									<div class="mestCDP" style="margin-left: -10px !important; margin-right: -15px !important;">
										<a href="<?=base_url?>views/pdf.php?iddpa=<?=$pf['iddpa'];?>" target="_blank" title="Imprimir Solicitud CDP">
											<i class="fas fa-print fa-2x"></i>
										</a>
										&nbsp;
										<a href="<?=base_url?>views/pdf.php?pdf=1547&iddpa=<?=$pf['iddpa'];?>" target="_blank" title="PDF Solicitud CDP">
											<i class="fas fa-file-pdf fa-2x"></i>
										</a>
										<span><br><br>
											Solicitud CDP
										</span>
									</div>
								<?php } ?>
								<?php if($pf['rutcdp']){ ?>
									<br>
									<div class="mestCDP">
										<a href="<?=path_filem;?><?=$pf['rutcdp'];?>" target="_blank" title="PDF CDP Bogdata">
											<i class="fas fa-file-pdf fa-2x"></i>
										</a>
										<span><br><br>
											CDP B.
										</span>
									</div>
								<?php } ?>
								<?php if($pf['rutrp']){ ?>
									<div class="mestCDP">
										<a href="<?=path_filem;?><?=$pf['rutrp'];?>" target="_blank" title="PDF RP Bogdata">
											<i class="fas fa-file-pdf fa-2x"></i>
										</a>
										<span><br><br>
											RP B.
										</span>
									</div>
								<?php } ?>
							</td>
							<td>
								<?php if($_SESSION['pefid']==21 OR $_SESSION['pefid']==34){ ?>	
									<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="Editar">
				                		<i class="fas fa-edit" style="color: #0071bc;"></i>
				                	</a>
				                <?php } ?>
<!-- 								<br><br>
			                	<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>&soli=true" title="CDP">
			                		<i class="fas fa-file-invoice-dollar" style="color: #0071bc;"></i>
			                		<i class="fas fa-eye" style="color: #0071bc;"></i>
			                	</a> -->

			                	<br><br>
			                	<?php if(($_SESSION['pefid']==21 OR $_SESSION['pefid']==34) && $pf["idflu"]<$btnApro[0]["maxi"]){ ?>
			                		<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>&apro=1" title="RP">
			                		<i class="fas fa-arrow-alt-circle-right" style="color: #0071bc;"></i>
			                		</a><br><br>
			                	<?php } ?>
			                	<br><br>
			                	<?php if($_SESSION['depid']==1026){ ?>
				                	<a href="<?=base_url?>paa/delcdp&iddpa=<?=$pf['iddpa'];?>" title="Anular y Liberar RP" onclick="return elimObj();">
				                		<i class="fas fa-trash-alt" style="color: #0071bc;"></i>
				                	</a>
				                <?php } ?>


				                <!-- Modal File Memorando CDP Traslado  -->
				            	<?php //if($dispo>0){ ?>
				            		<br><br>
				                	<i class="fas fa-truck" data-toggle="modal" data-target="#myModFil<?=$pf['iddpa'];?>" title="Traslado f" style="color: #0071bc;"></i>
				                	<?php 
				                	echo Utils::modalfile("myModFil", "Solicitud Traslado", $pf['iddpa'], "Cargar archivo, memorando solicitud traslado", base_url."paa/libera",$pf['codrub']); 
				                	?>
				                	<br><br>
				                <?php //} ?>

				                <?php if($_SESSION['depid']==1026){ ?>	
									<a href="<?=base_url?>paa/liberarRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="Liberar">
				                		<i class="fas fa-link" style="color: #0071bc;"></i>
				                	</a>
				                <?php } ?>
				                
							</td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>						
						<td align="right"><strong>$ <?=number_format($sumasi, 0, ',', '.');?></strong></td>
						<td></td>
					</tr>
					<tr>
						<th>Código</th>
						<th>Objeto</th>						
						<th>Valor RP's&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<th>Estado</th>
						<th></th>
					</tr>
		    </tfoot>
			</table>					
		</div>
	<?php endif; ?>	
<?php } ?>
<!-- Fin tabla RP ///////////////////////////////////////////////////////////////////////// -->

<?php } ?>