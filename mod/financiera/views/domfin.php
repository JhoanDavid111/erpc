<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Dominios F.","fa fa-address-card ico3","domfin/index","230px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($dom);

	if(isset($edit) && isset($dom)): ?>
		<h2 class="title-c m-tb-40">Editar Dominio <!-- <?=$dom[0]['dofnom']?> --></h2>
		<?php $url_action = base_url."domfin/save&dofid=".$dom[0]['dofid']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo Dominio F.</h2>
		<?php $url_action = base_url."domfin/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">
			<!-- <div class="form-group col-md-6"> -->
				<!-- <label for="dofid">Cod. Dominio</label> -->
				<input type="hidden" class="form-control form-control-sm" id="dofid" name="dofid" value="<?=isset($dom) ? $dom[0]['dofid'] : ''; ?>"/>
			<!-- </div> -->
			<div class="form-group col-md-6">
				<label for="dofnom">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="dofnom" name="dofnom" value="<?=isset($dom) ? $dom[0]['dofnom'] : ''; ?>"/>

			</div>
			<div class="form-group col-md-6">
				<label for="doffijo">Valor Fijo</label>
				<input type="text" class="form-control form-control-sm" id="doffijo" name="doffijo" value="<?=isset($dom) ? $dom[0]['doffijo'] : ''; ?>"/>
			</div>
		
			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>

<br>
<!-- Ver datos -->

<h2 class="title-c">Dominios Financiera</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Código</th>
					<th>Dominio</th>								
					<th>Valor Fijo</th>
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($domfins)){
	        		foreach ($domfins as $do){ ?>
		            <tr>
		                <td><?=$do['dofid'];?></td>
		                <td><?=$do['dofnom'];?></td>				                
		                <td><?=$do['doffijo'];?></td>
		                <td>
		                	<a href="<?=base_url?>domfin/edit&dofid=<?=$do['dofid'];?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Código</th>
					<th>Dominio</th>								
					<th>Valor Fijo</th>
					<th></th>
	            </tr>
	        </tfoot>
	    </table>
		
	</div>

	<br>

<?php if(isset($edit) && isset($dom)): ?>
	<script>ocultar(1,230);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>