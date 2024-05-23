<!-- Insertar o Editar datos -->
<!-- <?php if($act == "radica"){ ?>

	<?php echo Utils::tit("Actividad","fas fa-restroom  mr-3","radica/index","300px"); ?>

	<div id="inser">

		<?php 
		// var_dump($edit);
		// var_dump($val);

		if(isset($edit) && isset($val)): ?>
			<h2 class="title-c m-tb-40">Ver Actividad de Gestión</h2>
			<?php //$url_action = base_url."radica/save&norad=".$val[0]['norad']; ?>
			
		<?php else: ?>
			<h2 class="title-c m-tb-40">Nueva Actividad de Gestión</h2>
			<?php $url_action = base_url."radica/save"; ?>
		<?php endif; ?>

		<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
			<div class="row">
				<input type="hidden" name="norad" value="<?=isset($val) ? $val[0]['norad'] : ''; ?>"/>
				<div class="form-group col-md-6" id="go1">
					<label for="nomcon">Contratista</label>
					<input type="text" class="form-control form-control-sm" id="nomcon" name="nomcon" value="<?=isset($val) ? $val[0]['nomcon'] : ''; ?>" <?=isset($val) ? ' disabled ' : ''; ?> />
				</div>
				<?php if($_SESSION["pefid"]>=11 and $_SESSION["pefid"]<16){ ?>
					<div class="form-group col-md-6" id="go2">
						<label for="perid">Abogado</label>
						<select class="form-control" name="perid" style="height: 42px;">
							<option value="0">Seleccione Abogado...</option>
							<?php if($databo){
								foreach ($databo as $dar) { ?>
									<option value="<?=$dar['perid'];?>">
										<?=$dar['pernom'].' '.$dar['perape'];?>
									</option>
								<?php }
							} ?>
						</select>
					</div>
				<?php }else{ ?>
					<input type="hidden" name="perid" value="<?=$_SESSION["perid"];?>">
				<?php } ?>

				<?php if($_SESSION["pefid"]>=11 and $_SESSION["pefid"]<16){ ?>
					<div class="form-group col-md-6" id="go3">
						<label for="valid">Área</label>
						<select class="form-control" name="valid" style="height: 42px;">
							<?php if($datare){
								foreach ($datare as $dar) { ?>
									<option value="<?=$dar['valid'];?>">
										<?=$dar['valnom'];?>
									</option>
								<?php }
							} ?>
						</select>
					</div>
				<?php }else{ ?>
					<input type="hidden" name="valid" value="<?=$_SESSION['depid'];?>">
				<?php } ?>
				<div class="form-group col-md-6" id="go3">
					<label for="parid">Tipo de Actividad</label>
					<select class="form-control" name="parid" style="height: 42px;">
						<?php if($datTA){
							foreach ($datTA as $dar) { ?>
								<option value="<?=$dar['parid'];?>">
									<?=$dar['parnom'];?>
								</option>
							<?php }
						} ?>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label for="objcon">Objeto del radica</label>
					<textarea class="form-control form-control-sm" id="objcon" name="objcon"><?=isset($val) ? $val[0]['objcon'] : ''; ?></textarea>
				</div>
				<div class="form-group col-md-6">
					<label for="linexpcon">Link Expediente  Drive</label>
					<input type="text" class="form-control form-control-sm" id="linexpcon" name="linexpcon" value="<?=isset($val) ? $val[0]['linexpcon'] : ''; ?>" required />
				</div>

				<div class="form-group col-md-6">
					<input type="submit" class="btn-primary-ccapital" value="Registrar">
				</div>
			</div>
		</form>
	</div>
<?php } ?>
 -->

<!-- Ver datos -->

<h2 class="title-c">
	TRD
<!-- 	<?php if($act == "radica"){ ?>
		RADICA
	<?php }elseif($act == "Finalizados"){ ?>
		Actividades Finalizadas y Retiradas
	<?php }else{ ?>
		Papelera de Gestión
	<?php } ?>
 --></h2>
<br><br>

<!-- <a href="<?=base_url?>views/pdf.php?idcali=2" target="_blank" title="Imprimir">
	<i class="fa fa-file-pdf-o" style="color: #523178;"></i>
</a>
<a href="<?=base_url?>views/pdf.php?idcali=2&pdf=1547" target="_blank" title="PDF">
	<i class="fa fa-file-pdf-o" style="color: #523178;"></i>
</a> -->

<?php $url_act2 = base_url."radica/index"; ?>


<?php $url_acttraz = base_url."radica/savetra"; ?>
	 <br>
	<div class="table-responsive">
		<!-- <form name='frmcom' action='<?=base_url?>radica/index' method='POST'> -->
		<form class="m-tb-40" action="<?=$url_acttraz?>" method="POST" enctype="multipart/form-data">

			<table id="example" class="table table-striped table-bordered dterpceDSC" style="width:100%;">		

		        <thead style="font-size: 12px; text-align: center;">
					<tr>
						<!-- <th rowspan="2">Tabla Avanzada</th> -->
						<th>ID</th>
						<th>DESCRIPCIÓN</th>										
						<th>TIPO</th>
						<th>ORD</th>
						<th>AÑOS EN ARCHIVO GEN.</th>
						<th>AÑOS EN ARCHIVO CEN.</th>
						<th>DFIN</th>
						<th></th>
					</tr>
					
				</thead>
			
				<tbody style="font-size: 12px; text-align: center;">
					<?php foreach ($dat as $f): ?>
						
						<tr>						
						
							<td><?=$f['doctrd'];?></td>
							<td style="text-align: left;">
								<strong><?=$f['descrip'];?></strong>
								<br><br>
								<strong>Dependencia:</strong>
								<small><?=$f['nomdep'];?></small>
								
							</td>												
							<td><?=$f['valnom'];?></td>
							<td><?=$f['ordtrd'];?></td>
							<td><?=$f['agentrd'];?></td>
							<td><?=$f['acentrd'];?></td>
							<td><?=$f['dfintrd'];?></td>							
							<td>
								<a href="" title="Ver Expediente">
			                		<i class="fas fa-eye"></i> 
			                	</a> 
			                </td>							
						</tr>	

					<?php endforeach ?>					
				</tbody>
		        <tfoot style="font-size: 10px; text-align: center;">
		            <tr>
						<th>ID</th>
						<th>DESCRIPCIÓN</th>											
						<th>TIPO</th>
						<th>ORD</th>
						<th>AÑOS EN ARCHIVO GEN.</th>
						<th>AÑOS EN ARCHIVO CEN.</th>
						<th>DFIN</th>
						<th></th>
		        </tfoot>
		    </table>
		</form>		
	</div>

	<br>

<?php if(isset($edit) && isset($val)): ?>
	<script>ocultar(1,300);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>