<!-- Insertar o Editar datos -->
<?php echo Utils::tit("perfil F.","fa fa-address-card ico3","perfil/index","300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Editar perfil F. <!-- <?=$val[0]['pefnom']?> --></h2>
		<?php $url_action = base_url."perfil/save&pefid=".$val[0]['pefid']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo perfil F.</h2>
		<?php $url_action = base_url."perfil/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">
			<!-- <div class="form-group col-md-6">
				<label for="pefid">Cod.</label>
				<input type="number" class="form-control form-control-sm" id="pefid" name="pefid" value="<?=isset($val) ? $val[0]['pefid'] : ''; ?>"/>

			</div> -->
			<div class="form-group col-md-6">
				<label for="pefnom">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="pefnom" name="pefnom" value="<?=isset($val) ? $val[0]['pefnom'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="idmod">Módulo</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="idmod" name="idmod">
				<?php 
				if($modulos){

					foreach ($modulos as $do){ ?>
		            
		                <option value="<?=$do['idmod'];?>" <?=isset($val) && $do['idmod']==$val[0]['idmod'] ? ' selected ' : ''; ?> ><?=$do['nommod'];?></option>
		            
		        <?php }} ?>
		        </select>

			</div>
			<!-- <div class="form-group col-md-6">
				<label for="pagprin">perfil Fijo</label>
				<input type="text" class="form-control form-control-sm" id="pagprin" name="pagprin" value="<?=isset($val) ? $val[0]['pagprin'] : ''; ?>"/>
			</div> -->
<!-- 			<div class="form-group col-md-6">
				<label for="idmod">Descripción</label>
				<input type="text" class="form-control form-control-sm" id="idmod" name="idmod" value="<?=isset($val) ? $val[0]['idmod'] : ''; ?>"/>

			</div> -->

			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>

<br>
<!-- Ver datos -->

<h2 class="title-c">Perfiles</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Cód.</th>
					<th>Perfil</th>
					<th>Módulo</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($perfils)){
	        		foreach ($perfils as $va){ ?>
		            <tr>
		                <td><?=$va['pefid'];?></td>
		                <td>
		                	<?=$va['pefnom'];?>
<!-- 		                	<br>
		                	<small><small>
		                		<strong>Página principal</strong>
		                		<?=$va['pagprin'];?>
		                	</small></small> -->
		                	<br>
		                	<!-- Modal Paginas -->
		                	<i class="far fa-copy" data-toggle="modal" data-target="#myModPag<?=$va['pefid'];?>" title="Mostrar Páginas" style="color: #523178;"></i>
		                	&nbsp;&nbsp;&nbsp;
		                	<?php 
		                		$paginas = $pagina->getOneMod($va['idmod']);
		                		$pxps = $perfil->getOnePxP($va['pefid']);
		                	echo Utils::modal("myModPag", "Páginas", $va['pefid'], $va['pefnom']."<br>Mod. ".$va['nommod'], $paginas, base_url."perfil/savepg", $pxps); 
		                	?>
		                	<!-- Modal Estados -->
		                	<i class="fas fa-clipboard-check" data-toggle="modal" data-target="#myModEsE<?=$va['pefid'];?>" title="Mostrar Notificaciones y Email" style="color: #523178;"></i>
		                	&nbsp;&nbsp;&nbsp;
		                	<?php 
		                		$estados = $valor->getOnePar(11);
		                		$pxem = $perfil->getOnePxEm($va['pefid']);
		                	echo Utils::modal("myModEsE", "Notificaciones", $va['pefid'], $va['pefnom']."<br>Mod. ".$va['nommod'], $estados, base_url."perfil/savepee", $pxem, "* Los segundos checkbox aparecen en el caso de solicitud de envío de e-mail automático"); 
		                	?>
		                	<!-- Modal Email -->
		                	<i class="fas fa-eye ico2" data-toggle="modal" data-target="#myModEv<?=$va['pefid'];?>" title="Mostrar Estados a Visualizar" style="color: #523178;"></i>
		                	&nbsp;&nbsp;&nbsp;
		                	<?php 
		                		$pxev = $perfil->getOnePxEv($va['pefid']);
		                	echo Utils::modal("myModEv", "Estados a Visualizar", $va['pefid'], $va['pefnom']."<br>Mod. ".$va['nommod'], $estados, base_url."perfil/savepev", $pxev); 
		                	?>
		                </td>				                
		                <td><?=$va['nommod'];?></td>
		                <td>
		                	<a href="<?=base_url?>perfil/edit&pefid=<?=$va['pefid'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Cód.</th>
					<th>Perfil</th>
					<th>Módulo</th>
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