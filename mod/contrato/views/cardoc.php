<h2 class="title-c"><?=isset($datsop[0]['parnom']) ? $datsop[0]['parnom']:"";?> No. <?=$idcon;?></h2>
<br><br>


<!-- ---------------------------------------- Encabezado de contrato --------------------------------------------------- -->

<?php if ($datsop){
	foreach ($datsop as $f){ ?>
	<?php $estil= 'active'; ?>
		<div class="row">
			<div class="form-group col-md-6" id="go1">
				<!-- <big><big><strong><?=$f['pernom'].' '.$f['perape'];?></strong></big></big>
				<input type='hidden' name='perid' value='<?=$f['pernom'].' '.$f['perape'];?>'> -->
				<label for="perid">Abogado</label>
				<select class="form-control" name="perid" style="height: 42px;" disabled>
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
				<select class="form-control" name="valid" style="height: 42px;" disabled>
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
				<input type='text' name='nomcon' class='form-control' value='<?=$f['nomcon'];?>' disabled>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="nocon">No. Contrato</label>
				<input type='text' name='nocon' class='form-control' value='<?=$f['nocon'];?>' disabled>
			</div>
			<div class="form-group col-md-12" id="go1">
				<label for="objcon">Objeto</label>
				<textarea name='objcon' class='form-control' disabled><?=$f['objcon'];?></textarea>
			</div>
		</div>
	<?php }
}else{ ?>
    <center><h5>No existen resultados</h5></center><br><br>
<?php } ?>




<!-- Insertar o Eliminar Documentos -->

<div id="inser">
	<h2 class="title-c m-tb-40">Documentos Contratista</h2>
	<br><br>
	<?php $url_action = base_url."docon/save"; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<div class="row">
			<input type="hidden" name="idcon" value="<?=$idcon;?>"/>
			
			<?php
				//var_dump($datAll);
				if($datAll){
					$l=0;
					foreach ($datAll as $dc) {
			?>
						<?php if($dc['rutdpdc']){ ?>
							<div class="form-group col-md-1" style="text-align: left;">
								<a href="<?=path_filem;?><?=$dc['rutdpdc'];?>" target="_blank">
									<i class="fa fa-file-pdf-o fa-2x"></i>
								</a>
								<input type="hidden" name="valid[]" value="<?=$dc['valid'];?>"/>
								<input type="hidden" name="valor[]" value="<?=$dc['valnom'];?>"/>
								<input type="hidden" class="form-control" id="ruta<?=$l;?>" name="ruta<?=$l;?>" value="" />
							</div>
							<div class="form-group col-md-4" style="text-align: left;">
								<small><?=$dc['valnom'];?></small>
							</div>
							<div class="form-group col-md-1" style="text-align: left;">
								<a href="elidoc&iddoc=<?=$dc["iddpdc"];?>" onclick="return eliminar();" title="Eliminar documento">
	                				<i class="fa fa-times-circle" style="color: #f00;"></i>&nbsp;&nbsp;
	                			</a>
							</div>
						<?php }else{ ?>
							<div class="form-group col-md-6">
								<label for="ruta<?=$l;?>"><small><b><?=$dc['valnom'];?></b></small></label>
								<input type="file" class="form-control" id="ruta<?=$l;?>" name="ruta<?=$l;?>" accept="application/pdf" />
							</div>
						<?php } ?>
						<div class="form-group col-md-4" style="text-align: center;">
							<textarea name="obsdoc[]" class='form-control' placeholder="Observaciones"></textarea>
						</div>
						<div class="form-group col-md-2" style="text-align: center;">
							<input type="checkbox" name="apr[]" style="width: 30px; height: 30px;" value="<?=$dc['valid'];?>" checked/>
						</div>
						<?php $l++;
					}
				}
			?>

			<div class="form-group col-md-12">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>
			
		</div>
	</form>
</div>