<h2 class="title-c">Presupuesto <?=$idpaa;?>&nbsp;&nbsp;&nbsp;&nbsp;</h2>
<?php if (!isset($_SESSION['inspaa'])) { ?>
<!-- Inicio Selección área ///////////////////////////////////////////////// -->
<!-- Inicio Selección área Reportes ///////////////////////////////////////////////// -->
 	<div class="row">
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
		<div class="form-group col-md-3 m-tb-40">
			&nbsp;
		</div>
		<div class="form-group col-md-1 m-tb-40">
			&nbsp;
		</div>
		<!-- <div class="mestCDP" style="display: block;margin-top: -100px;text-align: end;"> -->
		<div class="form-group col-md-1" style="text-align: center;">
			<form class="m-tb-40" action="<?=base_url;?>views/pdf4.php" target="_blank" method="POST">
				<br>
				<input type="hidden" name="depid" value="<?=$_SESSION['depid'];?>">
				<input type="hidden" name="tot" value="<?=$tot;?>">
				<input type="hidden" name="areSel" value="<?=$areSel;?>">
				<input type="hidden" name="ntipoT" value="0">
				<button type="submit" class="btn" style="color: #523178;" title="Imprimir total o área seleccionada">
					<i class="fas fa-print fa-2x"></i>
				</button>
			</form>
		</div>
		<div class="form-group col-md-1" style="text-align: center;">
			<form class="m-tb-40" action="<?=base_url;?>views/pdf4.php" target="_blank" method="POST">
				<br>
				<input type="hidden" name="depid" value="<?=$_SESSION['depid'];?>">
				<input type="hidden" name="tot" value="<?=$tot;?>">
				<input type="hidden" name="areSel" value="<?=$areSel;?>">
				<input type="hidden" name="ntipoT" value="0">
				<input type="hidden" name="pdf" value="1547">
				<button type="submit" class="btn" style="color: #523178;" title="PDF total o área seleccionada">
					<i class="fas fa-file-pdf fa-2x"></i>
				</button>
			</form>
		</div>
		<div class="form-group col-md-1" style="text-align: center;">
			<form class="m-tb-40" action="<?=base_url;?>views/csv4.php" target="_blank" method="POST">
				<br>
				<input type="hidden" name="depid" value="<?=$_SESSION['depid'];?>">
				<input type="hidden" name="tot" value="<?=$tot;?>">
				<input type="hidden" name="areSel" value="<?=$areSel;?>">
				<input type="hidden" name="ntipoT" value="0">
				<button type="submit" class="btn" style="color: #523178;" title="CSV total o área seleccionada">
					<i class="fas fa-file-excel fa-2x"></i>
				</button>
			</form>
		</div>
		<div class="form-group col-md-2 m-tb-40" style="text-align: center;">
			<form class="m-tb-40" action="<?=base_url;?>presu/new" method="POST">
				<button type="submit" class="" style="color: #523178;border-radius: 10px;padding: 7px 14px;" title="Agregar Nueva Fila al Presupuesto Vigente">
						<i class="fa fa-indent"></i> Nueva Fila
				</button>
			</form>
		</div>
	</div>
<!-- Fin Selección área ///////////////////////////////////////////////// -->

<!-- Inicio tabla PRESUPUESTO ///////////////////////////////////////////////////////////////////////// -->
	<?php if(isset($pfcdp)): ?>
		<br><br>
		<div class="table-responsive">
			<table id="example" class="table table-striped table-bordered dterpc" style="width: 100%;" role="grid" aria-describedby="example_info">
				<thead>
					<tr>
						<th>Código</th>
						<th>Objeto</th>						
						<th style="width: 122px;">Asignado</th>
						<th style="width: 122px;">En CDP's</th>
						<th style="width: 122px;">En RP's</th>
						<th style="width: 122px;">Disponible</th>
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
								</small>
							</td>
							<td align="right">$ <?=number_format($pf['asidpa'], 0, ',', '.');?></td>
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

							<td align="right">$ <?=number_format($cdp, 0, ',', '.');?></td>

							<td align="right">$ <?=number_format($rp, 0, ',', '.');?></td>

							<td align="right">$ <?=number_format($dispo, 0, ',', '.');?></td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Código</th>
						<th>Objeto</th>						
						<th style="width: 122px;">Asignado</th>
						<th style="width: 122px;">En CDP's</th>
						<th style="width: 122px;">En RP's</th>
						<th style="width: 122px;">Disponible</th>
					</tr>
		    </tfoot>
			</table>
		</div>
	<?php endif; ?>	
<?php }?>
<!-- Fin tabla PRESUPUESTO ///////////////////////////////////////////////////////////////////////// -->
