<?php
	$tit = $eleti[0]['nomdel'];
	$rut = "eledat/index&iddel=".$iddel;
?>

<!-- Insertar o Editar datos -->
<?php echo Utils::tit($tit,"fa fa-address-card ico3",$rut,"300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Editar <?=$tit;?></h2>
		<?php $url_action = base_url."eledat/save&idd=".$val[0]['idd']; ?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo <?=$tit;?></h2>
		<?php $url_action = base_url."eledat/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>&iddel=<?=$eleti[0]['iddel'];?>" method="POST">
		<div class="row">
			<div class="form-group col-md-6">
				<label for="iddat">Id</label>
				<input type="number" class="form-control form-control-sm" id="iddat" name="iddat" value="<?=isset($val) ? $val[0]['iddat'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="nomdat">Nombre</label>
				<input type="text" class="form-control form-control-sm" id="nomdat" name="nomdat" value="<?=isset($val) ? $val[0]['nomdat'] : ''; ?>" required />

			</div>	

			<div class="form-group col-md-6">
				<input type="hidden" name="iddel" value="<?=isset($val) ? $val[0]['iddel'] : $eleti[0]['iddel']; ?>" />
				<input type="hidden" name="idd" value="<?=isset($val) ? $val[0]['idd'] : ''; ?>" />
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>

		</div>
	</form>
</div>

<br>
<!-- Ver datos -->

<h2 class="title-c"><?=$tit;?></h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
					<th>Valor</th>								
					<th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($eledats)){
	        		foreach ($eledats as $va){ ?>
		            <tr>
		                <td>
		                	<?=$va['iddat'];?> - <?=$va['nomdat'];?>
		                </td>				                
		                <td>
		                	<a href="<?=base_url?>eledat/edit&idd=<?=$va['idd'];?>&iddel=<?=$iddel;?>">
		                		<i class="fas fa-edit" style="color: #523178;"></i>
		                	</a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Valor</th>
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


<!-- ************************** -->
<!-- DM -->
<!-- ************************** -->

<h2 class="title-c m-tb-40">DM</h2>
<br><br><br>	
<div class="table-responsive">
	<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
        <thead>
            <tr>
				<th>Id</th>								
				<th>Cod Depar</th>
				<th>Cod Mun</th>
				<th>Nombre</th>
				<th style="max-width: 10px !important;">Act</th>
				<th></th>
            </tr>
        </thead>
        <tbody>
        	<?php 
        	if(isset($eledm)){
        		foreach ($eledm as $dm){ ?>
	            <tr>
	                <td>
	                	<?=$dm['id'];?>	                	
	                </td>				                
	                <td>
	                	<?=$dm['elecdep'];?>
	                </td>
	                <td>
	                	<?=$dm['elecmun'];?>
	                </td>
	                <td>
	                	<?=$dm['elenmun'];?>
	                </td>
	                <td>
	                	<!-- <?//=$va['ptip'];?><br> -->
	                	<span style="opacity: 0"><?=$dm['act'];?></span>
	                	<?php if($dm['act']==1){ ?>
	                		<a href="<?=base_url?>eledat/act&id=<?=$dm['id'];?>&act=2">
			                	<i class="fas fa-check-circle" style="color: #523178;">
			                		<span style="color: rgba(255,255,255,0);">+</span>
			                	</i>
			                </a>
		                <?php }else{ ?>
		                	<a href="<?=base_url?>eledat/act&id=<?=$dm['id'];?>&act=1">
								<i class="fas fa-times-circle" style="color: #f00;">
									<span style="color: rgba(255,255,255,0);">-</span>
								</i>
							</a>
						<?php } ?>
	                </td>
	                <td>
	                	<!-- <a href="<?=base_url?>elecan/edit&idcan=<?=$va['idcan'];?>">
	                		<i class="fas fa-edit" style="color: #523178;"></i>
	                	</a> -->
	                </td>
	            </tr>
	        <?php }} ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Id</th>								
				<th>Cod Depar</th>
				<th>Cod Mun</th>
				<th>Nombre</th>
				<th>Act</th>
				<th></th>
            </tr>
        </tfoot>
    </table>
	
</div>