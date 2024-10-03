<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Rubro","fa fa-address-card ico3","rubro/index","350px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($rub);

	if(isset($edit) && isset($rub)): ?>
		<h2 class="title-c m-tb-40">Editar Rubro <!-- <?=$rub[0]['nomrub']?> --></h2>
		<?php $url_action = base_url."rubro/save&codrub=".$rub[0]['codrub']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo Rubro</h2>
		<?php $url_action = base_url."rubro/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">
			<div class="form-group col-md-6">
				<label for="codrub">Cod. Rubro</label>
				<input type="number" class="form-control form-control-sm" id="codrub" name="codrub" value="<?=isset($rub) ? $rub[0]['codrub'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="codrub">Cod. Rubro (2)</label>
				<input type="number" class="form-control form-control-sm" id="codrub2" name="codrub2" value="<?=isset($rub) ? $rub[0]['codrub2'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="nomrub">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="nomrub" name="nomrub" value="<?=isset($rub) ? $rub[0]['nomrub'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="deprub">Depende</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="deprub" name="deprub">
					<option value="0">Sin dependencia</option>
				<?php 
				if($rubros){

					foreach ($rubros as $ru){ ?>
		            
		                <option value="<?=$ru['codrub'];?>" <?=isset($rub) && $ru['codrub']==$rub[0]['deprub'] ? ' selected ' : ''; ?> ><?=$ninipaa.$ru['codrub'];?> - <?=$ru['nomrub'];?></option>
		            
		        <?php }} ?>
		        </select>

			</div>
			<div class="form-group col-md-6">
				<label for="actrub">Activo</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="actrub" name="actrub">
	                <option value="1" <?=isset($rub) && 1==$rub[0]['actrub'] ? ' selected ' : ''; ?> >Si</option>
	                <option value="2" <?=isset($rub) && 2==$rub[0]['actrub'] ? ' selected ' : ''; ?> >No</option>
		        </select>
			</div>
			<div class="form-group col-md-6">
				<label for="intrub">Rubro Interno</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="intrub" name="intrub">
	                <option value="1" <?=isset($rub) && 1==$rub[0]['intrub'] ? ' selected ':'';?>>Si</option>
	                <option value="2" <?=isset($rub) && 2==$rub[0]['intrub'] ? ' selected ':'';?>>No</option>
		        </select>
			</div>
		
			<div class="form-group col-md-6">
				<?php if(isset($edit) && isset($rub)){ ?>
					<label for="dependencias">Dependencias</label>
					<br>
					<span id="dependencias" style="font-size: 11px;">
		                <?=isset($dependencias) ? $dependencias:''; ?>
			        </span>
		        <?php } ?>
			</div>
		
			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>

<br>
<!-- Ver datos -->

<h2 class="title-c">Rubros</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Código</th>
	                <th>Código 2</th>
					<th>Rubro</th>								
					<th>Depende</th>
					<th>Act</th>
					<th>Rubro Interno</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($rubros)){
	        		foreach ($rubros as $ru){ ?>
		            <tr>
		                <td><?=$ninipaa.$ru['codrub'];?></td>
		                <td>
		                	<?php if($ru['codrub2']!=""): ?>
		                		
		                		<?=$ninipaa.$ru['codrub2'];?>

		                	<?php endif; ?>
		                	
		                	
		                </td>
		                <td><?=$ru['nomrub'];?></td>				                
		                <td><?=$ninipaa.$ru['deprub'];?></td>
		                <td>
		                <?php if($ru['actrub']==1){ ?>
		                	<i class="fas fa-check-circle" style="color: #0071bc;">
		                		<span style="color: rgba(255,255,255,0);">+</span>
		                	</i>
		                <?php }else{ ?>
							<i class="fas fa-times-circle" style="color: #f00;">
								<span style="color: rgba(255,255,255,0);">-</span>
							</i>
						<?php } ?>
		                </td>
		                <td style="text-align: center;">
		                	<?php if($ru['intrub']==1){ ?>
			                	<i class="fa fa-arrow-circle-left" style="color: #0071bc;"></i>
			                	<small style="font-size: 0px;opacity: 0;">Rubro Interno</small>
			                <?php }else{ ?>
								<i class="fa fa-arrow-circle-right" style="color: #888888;"></i>
							<?php } ?>
		                </td>
		                <td>
		                	<a href="<?=base_url?>rubro/edit&codrub=<?=$ru['codrub'];?>">
		                		<i class="fas fa-edit" style="color: #0071bc;"></i>
		                	</a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Código</th>
	                <th>Código 2</th>
					<th>Rubro</th>								
					<th>Depende</th>
					<th>Act</th>
					<th>Rubro Interno</th>
					<th></th>
	            </tr>
	        </tfoot>
	    </table>
		
	</div>

	<br>

<?php if(isset($edit) && isset($rub)): ?>
	<script>ocultar(1,0);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>