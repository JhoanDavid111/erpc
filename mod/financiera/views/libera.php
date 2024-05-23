<h2 class="title-c">Liberaciones <?=$estlib;?>s&nbsp;&nbsp;&nbsp;&nbsp;</h2>

<?php if (!isset($_SESSION['inspaa'])) { ?>

	<?php // if($_SESSION['pefid']==21 OR $_SESSION['pefid']==34){ ?>				
	<!--		<a href="<?=base_url?>paa/index&new=1" class="fas fa-plus-square fa-2x" style="color: #f66f16;" title="Nuevo Registro"></a> -->
	<?php //} ?>

<!-- Inicio Selección área ///////////////////////////////////////////////// -->
		<form class="m-tb-40" action="<?=base_url;?>paa/libver" method="POST">
			<div class="row">
				<div class="form-group col-md-3">
					<label for="areas">Areas</label>
					<select id="areas" name="areSel" class="form-control form-control-sm" style="padding: 0px;" onchange="this.form.submit();">
						<option value="0">Seleccione área</option>
						<?php foreach ($areas2 as $pf){ ?>
							

							<option value="<?=$pf['valid'];?>"<?= $pf['valid'] == $areSel ? ' selected ' : ''; ?>><?=$pf['valnom'];?>
								
							</option>

							
						<?php } ?>
					</select>

				</div>

				<div class="form-group col-md-9" style="text-align: right;margin-top: 30px;">
					<a href="<?=base_url?>paa/libver&areSel=<?=$areSel;?>" class="btn-secondary-canalc">
						Pendiente
					</a>
					&nbsp;
					<a href="<?=base_url?>paa/libver&estlib=Realizada&areSel=<?=$areSel;?>" class="btn-secondary-canalc">
						Realizada
					</a>
					&nbsp;
					<a href="<?=base_url?>paa/libver&estlib=Rechazada&areSel=<?=$areSel;?>" class="btn-secondary-canalc">
						Rechazada
					</a>
				</div>
			</div>
		</form>
<!-- Fin Selección área ///////////////////////////////////////////////// -->



<!-- Inicio tabla  ///////////////////////////////////////////////////////////////////////// -->
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
			<thead>
				<tr>
					<th>Código</th>
					<th>Objeto</th>						
					<th>Valor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th>Memorando</th>
					<?php if($estlib=="Pendiente") echo "<th></th>"; ?>
				</tr>
			</thead>
			<tbody>
			<?php if(isset($pfrp)): ?>
				<?php foreach ($pfrp as $pf){ ?>
					<tr>
						<td 
							<?php
								if($pf['color']){
									echo ' style="background-color: #'.$pf['color'].';"';
								}
							?>
						><small><?=$ninipaa.$pf['codrub'];?></small></td>
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
							<?php if($pf["idflu"]>$numflu[0]["mini"]){ ?>
								<div class="mestCDP">
									<a href="<?=path_filem;?><?=$pf["rutlib"];?>" target="_blank" title="Memorando para Liberación">
										<i class="fas fa-file-pdf fa-2x"></i>
									</a>
									<span><br><br>
										<?=$pf["feclib"];?>
									</span>

									<span><br><br>
										<strong>Estado: </strong>
										<?=$pf['actflu'];?>
									</span>
								</div>
							<?php } ?>
							
							<br>
						</td>
						<?php if($estlib=="Pendiente"){ ?>
							<td>
								<a href="<?=base_url?>paa/libest&iddpa=<?=$pf['iddpa'];?>&estlib=Realizada&areSel=<?=$areSel;?>" title="Realizada">
			                		<i class="fas fa-check-circle fa-2x" style="color: #523178;"></i>
			                	</a>
								
								<br><br><br>

	            				<a href="<?=base_url?>paa/libest&iddpa=<?=$pf['iddpa'];?>&estlib=Rechazada&areSel=<?=$areSel;?>" title="Rechazada">
			                		<i class="fas fa-times-circle fa-2x" style="color: #f00;"></i>
			                	</a>
							</td>
						<?php } ?>
					</tr>
				<?php } ?>		
			<?php endif; ?>	
			</tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>						
					<td align="right"><strong>$ <?=number_format($sumasi, 0, ',', '.');?></strong></td>
					<td></td>
					<?php if($estlib=="Pendiente") echo "<th></th>"; ?>
				</tr>
				<tr>
					<th>Código</th>
					<th>Objeto</th>						
					<th>Valor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th>Memorando</th>
					<?php if($estlib=="Pendiente") echo "<th></th>"; ?>
				</tr>
	    </tfoot>
		</table>					
	</div>
<!-- Fin tabla RP ///////////////////////////////////////////////////////////////////////// -->

<?php } ?>