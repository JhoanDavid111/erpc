<h2 class="title-c">Plan Anual de Adquisiciones Detalle&nbsp;&nbsp;&nbsp;&nbsp;</h2>

<?php if (!isset($_SESSION['inspaa'])) { ?>

	<?php if($_SESSION['pefid']==21 OR $_SESSION['pefid']==34){ ?>				
			<a href="<?=base_url?>paa/index&new=1" class="fas fa-plus-square fa-2x" style="color: #f66f16;" title="Nuevo Registro"></a>
	<?php } ?>

<!-- Inicio Selección área ///////////////////////////////////////////////// -->
 	<?php	if($_SESSION['pefid']!=31){	?>
 		<?php if(!isset($pfinandOne)): ?>
				<form class="m-tb-40" action="<?=base_url;?>paa/index" method="POST">
					<!-- <div class="row">
		

 						<div class="form-group col-md-3">
							<label for="areas">Areas</label>
							<select id="areas" name="areas" class="form-control form-control-sm" style="padding: 0px;" onchange="this.form.submit();">
								<option value="0">Seleccione área</option>
								<?php foreach ($areas2 as $pf){ ?>
									

									<option value="<?=$pf['valid'];?>"<?= $pf['valid'] == $area ? ' selected ' : ''; ?>><?=$pf['valnom'];?>
										
									</option>

									
								<?php } ?>
							</select>

						</div>
					</div> -->
					<?php if(isset($_SESSION['actpaa'])): ?>
						<?php if ($_SESSION['actpaa']=="si"): ?>
							<strong style="color:green;">Actualización Exitosa!!</strong>
						<?php endif; ?>
						<?php if ($_SESSION['actpaa']=="no"): ?>
							<strong style="color:red;">Error al Actualizar</strong>
						<?php endif; ?>
						<?php Utils::deleteSession('actpaa'); ?>
					<?php endif; ?>
					
				</form>
	<?php endif; ?>
<?php } ?>
<!-- Fin Selección área ///////////////////////////////////////////////// -->


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
							
								<?php foreach ($pfinand as $pf){ ?>
									<tr>
										<td><small><?=$ninipaa.$pf['codrub'];?></small></td>
											<!-- <td><?//=$pf['unspsc'];?></td> -->
										<td>
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
											$dtcdp = $pfinan->sumcdp($pf['iddpa']);
											$dtrp = $pfinan->sumrp($pf['iddpa']);
											$cdp= isset($dtcdp[0]['cdp']) ? $dtcdp[0]['cdp']:0;
											$rp= isset($dtrp[0]['rp']) ? $dtrp[0]['rp']:0;
											$dispo = ($pf['asidpa']-$cdp-$rp);
											$sumasi += $pf['asidpa'];
											$sumdis += $dispo;
											$sumcdp += $cdp;
											$sumrp += $rp;
										?>
										<td align="right">$ <?=number_format($dispo, 0, ',', '.');?></td>
										<td>
											<?php if($_SESSION['pefid']==21 OR $_SESSION['pefid']==34){ ?>	
												<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="Editar">
			                		<i class="fas fa-edit" style="color: #523178;"></i>
			                	</a>
			                <?php } ?>
												<br><br>
											<?php if($dispo>0){ ?>	
			                	<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>&soli=true" title="CDP">
			                		<i class="fas fa-file-invoice-dollar" style="color: #523178;"></i>
			                	</a>
			                	<br><br>
			                <?php } ?>
			                	<!-- <a href="<?=base_url?>cdp/solicdp&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="SOLICITAR">
			                		<i class="fas fa-sign-in-alt" style="color: #523178;"></i>
			                	</a> -->
										</td>
									</tr>
								<?php } ?>
					
							
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
			<br>
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
									<tr>
										<td><small><?=$ninipaa.$pf['codrub'];?></small></td>
											<!-- <td><?//=$pf['unspsc'];?></td> -->
										<td>
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
											</small>
										</td>
										<td align="right">$ <?=number_format($pf['asidpa'], 0, ',', '.');?></td>
										<?php 
											$dtcdp = $pfinan->sumcdp($pf['iddpa']);
											$dtrp = $pfinan->sumrp($pf['iddpa']);
											$cdp= isset($dtcdp[0]['cdp']) ? $dtcdp[0]['cdp']:0;
											$rp= isset($dtrp[0]['rp']) ? $dtrp[0]['rp']:0;
											$dispo = ($pf['asidpa']-$cdp-$rp);
											$sumasi += $pf['asidpa'];
											$sumdis += $dispo;
											$sumcdp += $cdp;
											$sumrp += $rp;
										?>
										<td>
											<?=$pf['actflu'];?>
											<br>
											<?php if($pf['rutcdp']){ ?>
												<a href="<?=path_filem;?><?=$pf['rutcdp'];?>" target="_blank">
													<br>
													<i class="fas fa-file-pdf fa-2x"></i>
												</a>
											<?php } ?>
										</td>

										<td>
											<?php if($_SESSION['pefid']==21 OR $_SESSION['pefid']==34){ ?>	
												<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="Editar">
			                		<i class="fas fa-eye" style="color: #523178;"></i>
			                	</a>
			                <?php } ?>
												<br><br>
			                	<!-- <a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>&soli=true" title="CDP">
			                		// <i class="fas fa-file-invoice-dollar" style="color: #523178;"></i>
			                		<i class="fas fa-eye" style="color: #523178;"></i>
			                	</a> -->
			                	<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>&apro=1" title="Aprobar o Rechazar">
			                		<i class="fas fa-arrow-alt-circle-right" style="color: #523178;"></i>
			                	</a>
			                	<br><br>
			                	
			                	<a href="<?=base_url?>paa/delcdp&iddpa=<?=$pf['iddpa'];?>" title="Eliminar CDP">
			                		<i class="fas fa-trash-alt" style="color: #523178;"></i>
			                	</a>
			                	<!-- <a href="<?=base_url?>cdp/solicdp&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="SOLICITAR">
			                		<i class="fas fa-sign-in-alt" style="color: #523178;"></i>
			                	</a> -->
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
			<br>
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
											</small>
										</td>
										<td align="right">$ <?=number_format($pf['asidpa'], 0, ',', '.');?></td>
										<?php 
											$dtcdp = $pfinan->sumcdp($pf['iddpa']);
											$dtrp = $pfinan->sumrp($pf['iddpa']);
											$cdp= isset($dtcdp[0]['cdp']) ? $dtcdp[0]['cdp']:0;
											$rp= isset($dtrp[0]['rp']) ? $dtrp[0]['rp']:0;
											$dispo = ($pf['asidpa']-$cdp-$rp);
											$sumasi += $pf['asidpa'];
											$sumdis += $dispo;
											$sumcdp += $cdp;
											$sumrp += $rp;
										?>
										<td>
											<?=$pf['actflu'];?>
											<br>
											<?php if($pf['rutcdp']){ ?>
												<a href="<?=path_filem;?><?=$pf['rutcdp'];?>" target="_blank">
													<br>
													<i class="fas fa-file-pdf fa-2x"></i>
												</a>
											<?php } ?>
										</td>
										<td>
											<?php if($_SESSION['pefid']==21 OR $_SESSION['pefid']==34){ ?>	
												<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="Editar">
			                		<i class="fas fa-edit" style="color: #523178;"></i>
			                	</a>
			                <?php } ?>
												<br><br>
			                	<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>&soli=true" title="CDP">
			                		<!-- <i class="fas fa-file-invoice-dollar" style="color: #523178;"></i> -->
			                		<i class="fas fa-eye" style="color: #523178;"></i>
			                	</a>
			                	<br><br>
			                	<?php if($_SESSION['area']==1026){ ?>
				                	<a href="<?=base_url?>paa/delcdp&iddpa=<?=$pf['iddpa'];?>" title="Eliminar RP">
				                		<i class="fas fa-trash-alt" style="color: #523178;"></i>
				                	</a>
				                <?php } ?>
			                	<!-- <a href="<?=base_url?>cdp/solicdp&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="SOLICITAR">
			                		<i class="fas fa-sign-in-alt" style="color: #523178;"></i>
			                	</a> -->
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