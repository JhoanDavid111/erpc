<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Ciiu","fa fa-address-card ico3","ciiu/index","350px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($cii);

	if(isset($edit) && isset($cii)): ?>
		<h2 class="title-c m-tb-40">Editar Ciiu <!-- <?=$cii[0]['idciiu']?> --></h2>
		<?php $url_action = base_url."ciiu/save&idciiu=".$cii[0]['idciiu']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo Codigo Ciiu</h2>
		<?php $url_action = base_url."ciiu/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">
				<input type="hidden" name="idciiu" value="<?=isset($cii) ? $cii[0]['idciiu'] : ''; ?>"/>
			<div class="form-group col-md-6">
				<label for="codciiu">Codigo Ciiu</label>
				<input type="text" class="form-control form-control-sm" id="codciiu" name="codciiu" value="<?=isset($cii) ? $cii[0]['codciiu'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="nomciiu">Nombre Codigo</label>
				<input type="text" class="form-control form-control-sm" id="nomciiu" name="nomciiu" value="<?=isset($cii) ? $cii[0]['nomciiu'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="depciiu">Depende</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="depciiu" name="depciiu">
					<option value="0">Sin dependencia</option>
				<?php 
				if($ciius){

					foreach ($ciius as $ru){ ?>
		            
		                <option value="<?=$ru['codciiu'];?>" <?=isset($cii) && $ru['codciiu']==$cii[0]['depciiu'] ? ' selected ' : ''; ?> ><?=$ru['codciiu'];?> - <?=$ru['nomciiu'];?></option>
		            
		        <?php }} ?>
		        </select>

			</div>	
			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>

<br>
<!-- Ver datos -->

<h2 class="title-c">CIIU</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
<!--	                <th>Aut. Código</th> -->
					<th>Codigo CIIU</th>								
					<th>Nombre CIIU</th>
					<th>Dependencia</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($ciius)){
	        		foreach ($ciius as $ru){ ?>
		            <tr>
<!--		                <td><?//=$ru['idciiu'];?></td> -->
		                <td><?=$ru['codciiu'];?></td>			                
		                <td><?=$ru['nomciiu'];?></td>
		                <td>
		                	<?php
		                		if($ru['depciiu'])
		                			echo $ru['depciiu']." - ".$ru['ncd'];
		                	?>
		                </td>
		                <td>
		                	<a href="<?=base_url?>ciiu/edit&idciiu=<?=$ru['idciiu'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
<!--	                <th>Aut. Código</th> -->
					<th>Codigo CIIU</th>								
					<th>Nombre CIIU</th>
					<th>Dependencia</th>
					<th></th>
	            </tr>
	        </tfoot>
	    </table>
		
	</div>

	<br>

<?php if(isset($edit) && isset($cii)): ?>
	<script>ocultar(1,0);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>