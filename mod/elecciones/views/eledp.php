<!-- Insertar o Editar datos -->
<?php echo Utils::tit("División Política","fa fa-address-card ico3","eledp/index","300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Editar Valor<!-- <?=$val[0]['elendep']?> --></h2>
		<?php $url_action = base_url."eledp/save&eledpid=".$val[0]['eledpid']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nueva División Política</h2>
		<?php $url_action = base_url."eledp/save"; ?>
	<?php endif; ?>
	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">
			<div class="form-group col-md-6">
				<label for="elecdep">Código Departamento</label>
				<input type="number" max="99" class="form-control form-control-sm" id="elecdep" name="elecdep" value="<?=isset($val) ? $val[0]['elecdep'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="elecmun">Código Municipio</label>
				<input type="number" max="999" class="form-control form-control-sm" id="elecmun" name="elecmun" value="<?=isset($val) ? $val[0]['elecmun'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="eleczon">Código Zona</label>
				<input type="number" max="99" class="form-control form-control-sm" id="eleczon" name="eleczon" value="<?=isset($val) ? $val[0]['eleczon'] : ''; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="elcpue">Código Puesto</label>
				<input type="number" max="99" class="form-control form-control-sm" id="elcpue" name="elcpue" value="<?=isset($val) ? $val[0]['elcpue'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="elendep">Nombre Departamento</label>
				<input type="text" maxlength="12" class="form-control form-control-sm" id="elendep" name="elendep" value="<?=isset($val) ? $val[0]['elendep'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="elenmun">Nombre Municipio</label>
				<input type="text" maxlength="30" class="form-control form-control-sm" id="elenmun" name="elenmun" value="<?=isset($val) ? $val[0]['elenmun'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="elenpue">Nombre Puesto</label>
				<input type="text" maxlength="30" class="form-control form-control-sm" id="elenpue" name="elenpue" value="<?=isset($val) ? $val[0]['elenpue'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="eleipue">Indicador Puesto</label>
				<input type="number" max="9" class="form-control form-control-sm" id="eleipue" name="eleipue" value="<?=isset($val) ? $val[0]['eleipue'] : ''; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="elephom">Potencial Hombres</label>
				<input type="number" max="99999999" class="form-control form-control-sm" id="elephom" name="elephom" value="<?=isset($val) ? $val[0]['elephom'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="elepmuj">Potencial Mujeres</label>
				<input type="number" max="99999999" class="form-control form-control-sm" id="elepmuj" name="elepmuj" value="<?=isset($val) ? $val[0]['elepmuj'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="elenmes">Número de mesas</label>
				<input type="number" max="999999" class="form-control form-control-sm" id="elenmes" name="elenmes" value="<?=isset($val) ? $val[0]['elenmes'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="eleccom">Código Comuna</label>
				<input type="number" max="99" class="form-control form-control-sm" id="eleccom" name="eleccom" value="<?=isset($val) ? $val[0]['eleccom'] : ''; ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="elencom">Nombre Comuna</label>
				<input type="text" maxlength="30" class="form-control form-control-sm" id="elencom" name="elencom" value="<?=isset($val) ? $val[0]['elencom'] : ''; ?>" />
			</div>

			<div class="form-group col-md-6">
				<input type="hidden" name="eledpid" value="<?=isset($val) ? $val[0]['eledpid'] : ''; ?>" />
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>

<br>
<!-- Ver datos -->

<h2 class="title-c">División Política</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
					<th>Departamento</th>								
					<th>Municipio</th>
					<th>Puesto</th>
					<th>Potencial</th>
					<th>No. Mesas</th>
					<th>Comuna</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($eledps)){
	        		foreach ($eledps as $va){ ?>
		            <tr>
		                <td>
		                	<?=$va['elendep'];?><br>
		                	<small><strong>Código:</strong> <?=$va['elecdep'];?></small>
		                </td>				                
		                <td>
		                	<?=$va['elenmun'];?><br>
		                	<small><strong>Código:</strong> <?=$va['elecmun'];?></small> 
		                	<small><strong>Zona:</strong> <?=$va['eleczon'];?></small>
		                </td>
		                <td>
		                	<?=$va['elenpue'];?><br>
		                	<small><strong>Código:</strong> <?=$va['elcpue'];?></small> 
		                	<small><strong>Indicador:</strong> <?=$va['eleipue'];?></small>
		                </td>
		                <td>
		                	<strong>Hombres: </strong><?=$va['elephom'];?><br>
		                	<strong>Mujeres: </strong><?=$va['elepmuj'];?>
		                </td>
		                <td style="text-align: center;">
		                	<big>
		                		<strong>
		                			<?=$va['elenmes'];?>		                			
		                		</strong>
		                	</big>
		                </td>
		                <td>
		                	<?php if($va['elencom']){ ?>
			                	<?=$va['elencom'];?><br>
			                	<small><strong>Código:</strong> <?=$va['eleccom'];?></small>
			                <?php } ?>
		                </td>
		                <td>
		                	<a href="<?=base_url?>eledp/edit&eledpid=<?=$va['eledpid'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Valor</th>								
					<th>Dominio</th>
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