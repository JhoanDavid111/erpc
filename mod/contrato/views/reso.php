<?php if($act == "Contrato"){ ?>
	<!-- Insertar o Editar datos -->
	<?php echo Utils::tit("Seguimiento","fas fa-restroom mr-3","reso/index&idcon=$idcon&idtra=$idtra&act=Contrato","300px"); ?>

	<div id="inser">

		<?php 
		// var_dump($edit);
		// var_dump($val);

		if(isset($edit) && isset($val)): ?>
			<h2 class="title-c m-tb-40">Ver Seguimiento</h2>
			<?php //$url_action = base_url."contrato/save&idcon=".$val[0]['idcon']; ?>
			
		<?php else: ?>
			<h2 class="title-c m-tb-40">Nuevo Seguimiento</h2>
			<?php $url_action = base_url."reso/saveseg&idcon=$idcon&idtra=$idtra"; ?>
		<?php endif; ?>

		<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
			<div class="row">
				<input type="hidden" name="idcon" value="<?=isset($idcon) ? $idcon: ''; ?>"/>
				<div class="form-group col-md-6" id="go1">
					<label for="valid">Estado</label>
					<select class="form-control" name="valid" style="height: 42px;">
					<?php if($datusu){
						foreach ($datusu as $dar) { ?>
							<option value='<?=$dar['valid'];?>'><?=$dar['valnom'];?></option>
					<?php	}
					} ?>
					</select>
				</div>
				<div class="form-group col-md-6" id="go2">
					<label for="obstra">Observación</label>
					<textarea name="obstra" id="obstra" class="form-control" required></textarea>
				</div>
				<div class="form-group col-md-6" id="go2">
					<input type='submit' value='Registrar' class='btn btn-success'>
				</div>
			</div>
		</form>
	</div>
<?php } ?>

<!-- Ver datos -->

<h2 class="title-c"><?=isset($datsop[0]['parnom']) ? $datsop[0]['parnom']:"";?> No. <?=$idcon;?></h2>
<br><br>


<!-- ---------------------------------------- Encabezado de contrato --------------------------------------------------- -->

<?php if ($datsop){
	foreach ($datsop as $f){ ?>
	<?php $estil= 'active'; ?>
	<?php $url_action2 = base_url."reso/save&idcon=$idcon&idtra=$idtra"; ?>
	
	<form name='frmupd' action='<?=$url_action2?>' method='POST'>
		<div class="row">
			<div class="form-group col-md-6" id="go1">
				<!-- <big><big><strong><?=$f['pernom'].' '.$f['perape'];?></strong></big></big>
				<input type='hidden' name='perid' value='<?=$f['pernom'].' '.$f['perape'];?>'> -->
				<label for="perid">Abogado</label>
				<select class="form-control" name="perid" style="height: 42px;">
				<?php if($databo){
					foreach ($databo as $dar) { ?>
						<option value='<?=$dar['perid'];?>' <?php if($f['perid']==$dar['perid'])	echo "SELECTED";?> ><?=$dar['pernom'].' '.$dar['perape'];?></option>
				<?php	}
				} ?>
				</select>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="valid">Área</label>
				<!-- <?=$f['valnom'];?> -->
				<select class="form-control" name="valid" style="height: 42px;">
				<?php if($datare){
					foreach ($datare as $dar) { ?>
						<option value="<?=$dar['valid'];?>" <?php if($f['codarea']==$dar['valid']) echo "SELECTED";?> ><?=$dar['valnom']?></option>
				<?php	}
				} ?>
				</select>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="nomcon">Contratista</label>
				<!-- <?=$f['nomcon'];?> -->
				<input type='text' name='nomcon' class='form-control' value='<?=$f['nomcon'];?>' >
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="feccon">Fecha Solicitud</label>
				<br><?=$f['feccon'];?>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="parid">Tipo de actividad</label>
				<?php if($_SESSION["pefid"]==11 or $_SESSION["pefid"]==12 or $_SESSION["pefid"]==14){ ?>
					<select class="form-control" name="parid" style="height: 42px;">
					<?php if($datTA){
						foreach ($datTA as $dar) { ?>
							<option value="<?=$dar['parid'];?>" <?php if($f['parid']==$dar['parid']) echo "SELECTED";?> ><?=$dar['parnom'];?></option>
					<?php	}
					} ?>
					</select>
				<?php }else{ ?>
					<?=$f['parnom'];?>
					<input type='hidden' name='parid' class='form-control' value='<?=$f['parid'];?>' >
				<?php } ?>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="nocon">No. Contrato</label>
				<input type='text' name='nocon' class='form-control' value='<?=$f['nocon'];?>' >
			</div>
			<div class="form-group col-md-12" id="go1">
				<label for="objcon">Objeto</label>
				<textarea name='objcon' class='form-control'><?=$f['objcon'];?></textarea>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="linexpcon">Link Expediente Drive</label>
				<?php if($f['linexpcon']){ ?>
					<a href='<?=$f['linexpcon'];?>' target='_blank'>
						<i class="fas fa-external-link-alt"></i>
					</a>
				<?php } ?>
				<input type='text' name='linexpcon' class='form-control' value='<?=$f['linexpcon'];?>' >
			</div>
<!-- 			<div class="form-group col-md-6" id="go1">
				<label for="nocon">No. Contrato</label>
				<input type='text' name='nocon' class='form-control' value='<?=$f['nocon'];?>' >
			</div> -->
<!-- 			<div class="form-group col-md-6" id="go1">
				<label for="lineccon">Link Expedición Contrato</label>
				<?php if($f['lineccon']){ ?>
					<a href='<?=$f['lineccon'];?>' target='_blank'>
						<i class="fas fa-external-link-alt"></i>
					</a>
				<?php } ?>
				<input type='text' name='lineccon' class='form-control' value='<?=$f['lineccon'];?>' >
			</div> -->
			<div class="form-group col-md-6" id="go1">
				<label for="pubseccon">Publicación SECOP</label>
				<input type='text' name='pubseccon' class='form-control' value='<?=$f['pubseccon'];?>' >
			</div>
<!-- 			<div class="form-group col-md-6" id="go1">
				<label for="enlseccon">Enlace SECOP</label>
				<?php if($f['enlseccon']){ ?>
					<a href='<?=$f['enlseccon'];?>' target='_blank'>
						<i class="fas fa-external-link-alt"></i>
					</a>
				<?php } ?>
				<input type='text' name='enlseccon' class='form-control' value='<?=$f['enlseccon'];?>' >
			</div> -->
			<!-- <div class="form-group col-md-6" id="go1">
				<label for="noseccon">No. Constancia del SECOP</label>
				<input type='text' name='noseccon' class='form-control' value='<?=$f['noseccon'];?>' >
			</div> -->
			<?php if($_SESSION["pefid"]!=17 AND $_SESSION["pefid"]!=16){ ?>
				<div class="form-group col-md-6" id="go1">
					<BR>
					<input type="hidden" name="opera" value="updCon">
					<input type="hidden" name="idcon" value="<?=$idcon;?>">
					<input type='submit' value='Actualizar' class='btn btn-success'>
				</div>
			<?php } ?>
		</div>
	</form>
	<?php }
}else{ ?>
    <center><h5>No existen resultados</h5></center><br><br>
<?php } ?>

<!-- <div>
	<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<div class="row">
			<input type="hidden" name="idcon" value="<?=isset($val) ? $val[0]['idcon'] : ''; ?>"/>
			<div class="form-group col-md-6" id="go1">
				<label for="nomcon">Contratista</label>
				<input type="text" class="form-control form-control-sm" id="nomcon" name="nomcon" value="<?=isset($val) ? $val[0]['nomcon'] : ''; ?>" <?=isset($val) ? ' disabled ' : ''; ?> />
			</div>
			<div class="form-group col-md-6" id="go2">
				<label for="perid">Abogado</label>
				<input type="text" class="form-control form-control-sm" id="perid" name="perid" value="<?=isset($val) ? $val[0]['perid'] : ''; ?>" <?=isset($val) ? ' disabled ' : ''; ?> />
			</div>
			<div class="form-group col-md-6" id="go3">
				<label for="valid">Área</label>
				<input type="number" class="form-control form-control-sm" id="valid" name="valid" value="<?=isset($val) ? $val[0]['valid'] : ''; ?>" <?=isset($val) ? ' disabled ' : ''; ?> />
			</div>
			<div class="form-group col-md-6" id="go3">
				<label for="parid">Tipo de Actividad</label>
				<input type="number" class="form-control form-control-sm" id="parid" name="parid" value="<?=isset($val) ? $val[0]['parid'] : ''; ?>" <?=isset($val) ? ' disabled ' : ''; ?> />
			</div>
			<div class="form-group col-md-6">
				<label for="linexpcon">Link Expediente Drive</label>
				<input type="text" class="form-control form-control-sm" id="linexpcon" name="linexpcon" value="<?=isset($val) ? $val[0]['linexpcon'] : ''; ?>" required  <?=isset($val) ? ' disabled ' : ''; ?> />
			</div>
		</div>
	</form>
</div>
 -->




	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Seguimiento</th>
	                <th>Días</th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($datasi)){
	        		$nt = 0;
	        		foreach ($datasi as $va){ ?>
		            <tr>
		            	<td style="text-align: center">
	                        <small>
                        		<?=$va['fectra'];?>
                        		<br>
	                        	<strong>
	                        		<big><?=$va['valnom'];?></big>
	                        		<br>
	                        		Días Hab. 
	                        		<?php 
	                        			date_default_timezone_set('America/Bogota');
										$fec1 = new DateTime(substr($va['fectra'],0,10));
										$fecha = isset($datasi[$nt+1]['fectra']) ? $datasi[$nt+1]['fectra']:date("Y-m-d");
										$fec2 = new DateTime($fecha);
										$fec3 = substr($va['fectra'],0,10);
	                        			echo Utils::getDiasHabiles($fec3, $fecha, $fes);
	                        			$nt++;
	                        		?>
	                        	</strong>
	                        </small>
		                </td>
		                <td>
		                	<strong>Observación: </strong><?=$va['obstra'];?><br>
							<small>
								<strong>Registrado por: </strong><?=strtoupper($va['pernom']).' '.strtoupper($va['perape']);?>
	                        </small>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Seguimiento</th>
	                <th>Días</th>
	            </tr>
	        </tfoot>
	    </table>
		
	</div>

	<br>

<?php if(isset($edit) && isset($val)): ?>
	<script>ocultar(1,300);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>