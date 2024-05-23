<!-- Ver datos -->

<?php if($dtprov){ foreach ($dtprov as $dtpv) { ?>
<h2 class="title-c">Historial de evaluaciones</h2>
<br><br>
<table class="table table-striped table-bordered" style="width: 100%;">
	<tbody>
		<tr>
			<th style="background-color: #523178;color: #fff">Nit</th>
			<td><?=$dtpv['nit'];?></td>
		</tr>
		<tr>
			<th style="background-color: #523178;color: #fff">Razón Social</th>
			<td><?=$dtpv['razsoc'];?></td>
		</tr>
		<tr>
			<th style="background-color: #523178;color: #fff">Teléfono</th>
			<td><?=$dtpv['tel'];?></td>
		</tr>
		<tr>
			<th style="background-color: #523178;color: #fff">E-mail</th>
			<td><?=$dtpv['email'];?></td>
		</tr>
	</tbody>
</table>
<?php }} ?>

<?php $url_action = base_url."preres/saveEvalu"; ?>
<h2 class="title-c">Historial de Evaluaciones</h2>
<br><br>

	<form action="<?=$url_action?>" method="POST">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Fecha</th>
	                <th>Usuario</th>
	                <th>Calificación</th>
	                <th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($histo)){
	        		$total = 0;
	        		$con = 0;
	        		foreach ($histo as $va){ ?>
		            <tr>
		                <td>
							<?=$va['fecha'];?>
		                </td>
		                <td>
							<?=$va['pernom']." ".$va['perape'];?>
							<small>
								<br><?=$va['peremail'];?>
							</small>
		                </td>
		                <td style="text-align: center;">
							<strong>
								<?=$va['califica'];?>
								<?php 
									$total += $va['califica'];
	        						$con++;
								?>
							</strong>
		                </td>
		                <td style="text-align: center;">
							<a href="<?=base_url?>views/pdf.php?idcali=<?=$va['idcali'];?>" target="_blank" title="Ver Historial">
		                		<i class="fa fa-file-pdf-o" style="color: #523178;"></i>
		                	</a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	        	<tr>
	            	<th></th>
	                <th>TOTAL</th>
	                <th style="text-align: center;">
	                	<?php if($con>0) echo round($total/$con,2); ?>
	                </th>
	                <th style="text-align: center;">
	                	<?php if($con>0){ ?>
		                	<a href="<?=base_url?>views/pdft.php?idprov=<?=$dtprov[0]['idprov'];?>" target="_blank" title="Ver Historial Consolidaddo">
			                		<i class="fa fa-file-pdf-o" style="color: #ff0000;"></i>
			                	</a>
			            <?php } ?>
	                </th>
	            </tr>
	        </tfoot>
	    </table>
	</form>
	<br>