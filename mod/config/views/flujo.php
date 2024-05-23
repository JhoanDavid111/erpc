<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Flujo","fas fa-restroom  mr-3","flujo/index","300px"); ?>
<div id="inser">

	<?php if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Ver flujo</h2>
		<?php $url_action = base_url."flujo/save&idflu=".$val[0]['idflu']; ?>
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo flujo</h2>
		<?php $url_action = base_url."flujo/save"; ?>
	<?php endif; ?>
	<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<div class="row">
			<?php if($idflu){ ?>
				<input type="hidden" name="idflu" value="<?=isset($val) ? $val[0]['idflu'] : ''; ?>" required>
			<?php }else{ ?>
				<div class="form-group col-md-6">
					<label for="idflu">Id.</label>
					<input type="number" class="form-control form-control-sm" id="idflu" name="idflu" value="" required>
				</div>
				<div class="form-group col-md-6">
				</div>
			<?php } ?>
			<div class="form-group col-md-6" id="go1">
				<label for="actflu">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="actflu" name="actflu" value="<?=isset($val) ? $val[0]['actflu'] : ''; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="idpro">Proceso</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="idpro" name="idpro"  >
				<?php 
				if($datpro){
					foreach ($datpro as $do){ ?>
		                <option value="<?=$do['idpro'];?>" 
		                	<?=isset($val) && $do['idpro']==$val[0]['idpro'] ? ' selected ' : ''; ?>><?=$do['nompro'];?>
		                </option>
		            
		        <?php }} ?>
		        </select>
			</div>
			<div class="form-group col-md-6" id="go2">
				<label for="metflu">Descripción</label>
				<textarea class="form-control form-control-sm" id="metflu" name="metflu" style="height: 82px;"><?=isset($val) ? $val[0]['metflu'] : ''; ?></textarea>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="areas">Áreas</label>
				<!-- <input type="text" class="form-control form-control-sm" id="areas" name="areas" value="<?=isset($val) ? $val[0]['areas'] : ''; ?>"  /> -->

				<?php
					if(isset($val) AND $val[0]['areas']){
						$rvare = explode(";", $val[0]['areas']);
						array_unshift($rvare,"--");
					}
				?>
				<select class="form-control form-control-sm" style="padding: 0px;max-height: none;" id="areas" name="areas[]"  multiple="multiple">
					<?php 
					if($areasT){
						foreach ($areasT as $do){ ?>
							<?php 
								if(isset($val) AND $val[0]['areas'])
									$pos = array_search($do['valid'], $rvare);
								else
									$pos = NULL;
							?>
			                <option value="<?=$do['valid'];?>" 
			                	<?=isset($val) && $val[0]['areas'] && $pos ? ' selected ' : ''; ?>><?=$do['valnom'];?>
			                </option>
			            
			        <?php }} ?>
			    </select>

			</div>
			<div class="form-group col-md-6" id="go3">
				<label for="ordflu">No. Orden</label>
				<input type="number" class="form-control form-control-sm" id="ordflu" name="ordflu" value="<?=isset($val) ? $val[0]['ordflu'] : '1'; ?>"  />
			</div>
			<div class="form-group col-md-6" id="go4">
				<label for="ntipo">No. Tipo</label>
				<!-- <input type="number" class="form-control form-control-sm" id="ntipo" name="ntipo" value="<?=isset($val) ? $val[0]['ntipo'] : ''; ?>"  /> -->
				<select class="form-control form-control-sm" style="padding: 0px;" id="ntipo" name="ntipo"  >
		            <option value="1" <?=isset($val) && 1==$val[0]['ntipo'] ? ' selected ' : ''; ?>>1. Inicio</option>
		            <option value="2" <?=isset($val) && 2==$val[0]['ntipo'] ? ' selected ' : ''; ?>>2. Flujo Normal</option>
		            <option value="3" <?=isset($val) && 3==$val[0]['ntipo'] ? ' selected ' : ''; ?>>3. Sección CDP</option>
		            <option value="4" <?=isset($val) && 4==$val[0]['ntipo'] ? ' selected ' : ''; ?>>4. Sección RP</option>
		            <option value="5" <?=isset($val) && 5==$val[0]['ntipo'] ? ' selected ' : ''; ?>>5. Devolución / Cancelación</option>
		        </select>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="color">Color</label>
				<input type="color" class="form-control" id="color" name="color" value="#<?=isset($val) ? $val[0]['color'] : ''; ?>"  />
			</div>
			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>
		</div>
	</form>
</div>

<!-- Ver datos -->

<h2 class="title-c">Flujos</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Id</th>
	                <th>Flujo</th>
	                <th>Proceso</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($flujos)){
	        		foreach ($flujos as $va){ ?>
		            <tr>
		                <td>
		                	<?=$va['idflu'];?>
		                </td>
		                <td>
		                	<strong>
	                            <?=$va['actflu'];?>
	                        </strong><br>
	                        <small>
	                        	<strong>No. Orden: </strong><?=$va['ordflu'];?>
	                        	<strong> No. Tipo: </strong><?=$va['ntipo'];?>
	                        	<?php if($va['color']){ ?>
	                        		<strong> Color </strong>
	                        		<div style="display: inline-block;width: 15px;height: 15px;background-color: <?=$va['color'];?>;border: 1px solid #000;"></div>
	                        	<?php } ?>
	                        	<br>
	                        	<?php 
	                        		if($va['areas']){
	                        			$areas = explode(";", $va['areas']);
	                        	?>
	                        		<strong>Áreas: </strong>
	                        		<?php
	                        			foreach ($areas as $area) {
	                        				$ar = $flujo->getArea($area);
	                        		?>
	                        				<?=$ar[0]['valid'];?> - <?=$ar[0]['valnom'];?>; 
	                        		<?php } ?>
	                        		<br>
	                        	<?php } ?>
	                        	<?php if($va['metflu']){ ?>
		                            <strong>Descripción: </strong><?=$va['metflu'];?>
	              				<?php } ?>
	                        </small>
		                </td>
		                <td>
	                        <small>
	                            <?=$va['idpro'];?> - <?=$va['nompro'];?>
	                        </small>
		                </td>
		                <td>
		                	<a href="<?=base_url?>flujo/edit&idflu=<?=$va['idflu'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Id</th>
	                <th>Flujo</th>
	                <th>Proceso</th>
					<th></th>
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