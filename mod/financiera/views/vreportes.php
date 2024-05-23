<script src="js/my.js"></script>

<h2 class="title-c">REPORTES </h2>



<!-- <form class="m-tb-40" action="<?=base_url;?>/antproy/planes" method="POST">
-->	

	<form class="m-tb-40" action="" method="POST">

		<div class="row">				

		<div class="form-group col-md-3">
			<label for="vigencia">Vigencia  <a href="<?=base_url?>antproy/newpfin" class="" style="color: #523178;"></a></label>
			<!-- <?php //$cont = date('Y'); ?> -->
			<select id="sel1" name="vigencia" class="form-control form-control-sm" style="padding: 0px;" >	
				<?php foreach ($pfvig as $pf){ ?>
					<option value="<?=$pf['idpaa'];?>"><?=$pf['idpaa'];?></option>
				<?php } ?>
			</select>	

		</div>

		<div class="form-group col-md-3">
			<label for="vigencia">Tipo de Reporte <a href="<?=base_url?>antproy/newpfin" class="" style="color: #523178;"></a></label>
			<!-- <?php //$cont = date('Y'); ?> -->
			<select id="sel1" name="vigencia" class="form-control form-control-sm" style="padding: 0px;" >	
				<?php foreach ($pfvig as $pf){ ?>
					<option value="<?=$pf['idpaa'];?>"><?=$pf['idpaa'];?></option>
				<?php } ?>
			</select>
		</div>

		<div class="form-group col-md-3">
			<label for="vigencia">Entidad receptora<a href="<?=base_url?>antproy/newpfin" class="" style="color: #523178;"></a></label>
			<!-- <?php //$cont = date('Y'); ?> -->
			<select id="sel1" name="vigencia" class="form-control form-control-sm" style="padding: 0px;" >	
				<?php foreach ($pfvig as $pf){ ?>
					<option value="<?=$pf['idpaa'];?>"><?=$pf['idpaa'];?></option>
				<?php } ?>
			</select>
		</div>

		
		<div class="col-md-3">				
			<button class="btn-primary-ccapital">Generar</button>
		</div>

	</div>
</form>	


<h4 class="title-c">Rango del Reporte </h4>
<br><br>

<div class="row">
	<div class="col-md-3">	
		<label for="finicial">Fecha Inicial</label>		
		<input type="date" class="form-control form-control-sm" id="finicial" name="finicial">
	</div>
	<div class="col-md-3">	
		<label for="ffinal">Fecha Final</label>			
		<input type="date" class="form-control form-control-sm" id="ffinal" name="ffinal">
	</div>
</div>
<br><br>

<i class="fas fa-file-pdf fa-2x" style="color: #523178;"></i>
<i class="fas fa-file-excel fa-2x" style="color: #523178;"></i>
<i class="fas fa-print fa-2x" style="color: #523178;"></i>




		
			

		




	

					
					