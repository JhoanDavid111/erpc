<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Proceso","fas fa-restroom  mr-3","proceso/index","300px"); ?>

<div id="inser">
	<?php if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Editar proceso</h2>
		<?php $url_action = base_url."proceso/save&idpro=".$val[0]['idpro']; ?>
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo proceso</h2>
		<?php $url_action = base_url."proceso/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST">
		<div class="row">
			<?php if($idpro){ ?>
					<input type="hidden" id="idpro" name="idpro" value="<?=isset($val) ? $val[0]['idpro'] : ''; ?>" required>
			<?php }else{ ?>
				<div class="form-group col-md-4">
					<label for="idpro">Id.</label>
					<input type="number" class="form-control" id="idpro" name="idpro" value="" required>
				</div>
			<?php } ?>
			<div class="form-group col-md-4">
				<label for="nompro">Nombre</label>
				<input type="text" class="form-control" id="nompro" name="nompro" value="<?=isset($val) ? $val[0]['nompro'] : ''; ?>" required>
			</div>
			<div class="form-group col-md-4">
				<label for="ordpro">Orden</label>
				<input type="number" class="form-control" id="ordpro" name="ordpro" value="<?=isset($val) ? $val[0]['ordpro'] : ''; ?>" required>
			</div>
			<div class="form-group col-md-4">
				<button id="btnsolicitar" class="btn-secondary-canalc btn-block">Registrar</button>
			</div>
		</div>

	</form>
</div>

<!-- Ver datos -->

<h2 class="title-c">Procesos</h2>
<br><br>
<div class="table-responsive">
	<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
        <thead>
			<tr>
				<!-- <th rowspan="2">Tabla Avanzada</th> -->
				<th>PROCESO</th>				
				<th>ORDEN</th>
				<th></th>
			</tr>			
		</thead>
		<tbody>
			<?php foreach($result as $f): ?>
				<tr>
					<?php 
						$long = strlen($f["idpro"]);
						$esp = "";
						for($i=0;$i<$long;$i++){
							$esp .= "&nbsp;";
						}

					?>
					<td>
						<?=$esp.$f['idpro']." - ".$f['nompro'];?>
					</td>
					<td>
						<?=$f['ordpro']?>
					</td>
					<td>
	                	<a href="<?=base_url?>proceso/edit&idpro=<?=$f['idpro'];?>">
	                		<i class="fas fa-edit" style="color: #523178;"></i>
	                	</a>
	                </td>
				</tr>
			<?php endforeach ?>	
		</tbody>
        <tfoot>
            <tr>
				<!-- <th rowspan="2">Tabla Avanzada</th> -->
				<th>PROCESO</th>				
				<th>ORDEN</th>
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