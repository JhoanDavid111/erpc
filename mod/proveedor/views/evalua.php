<!-- Ver datos -->

<?php if($dtprov){ foreach ($dtprov as $dtpv) { ?>
<h2 class="title-c">Proveedor</h2>
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
<h2 class="title-c">Evaluación</h2>
<br><br>

	<form action="<?=$url_action?>" method="POST">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
	        <thead>
	            <tr>
	                <th>
	                	Preguntas
	                	<input type="hidden" name="idprov" value="<?=$idprov;?>">
	                </th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($preress)){
	        		$i = 1;
	        		foreach ($preress as $va){ ?>
		            <tr>
		                <td>
		                	<span style="opacity: 0;"><?=$va['idepr'];?></span>
		                	<strong><?=$i.' - '.$va['txtepr'];?></strong>
		                	<input type="hidden" name="idepr[]" value="<?=$va['idepr'];?>">
	                        <div style="padding: 10px 0px 0px 20px;">
	                        	<?php
			                		$resp = $preres->getResp($va["idepr"]);
			                		if($resp){
			                		foreach ($resp as $rsp){
			                	?>
				                		<input type="radio" name="idere<?=$i;?>" value="<?=$rsp["idere"];?>" <?php if($rsp["punere"]==5) echo "checked"; ?>>
				                		<?php
				                			$txtere = substr($rsp['txtere'],0,strpos($rsp['txtere'],"-"));
				                			if(!$txtere) $txtere = $rsp['txtere'];
				                				echo $txtere;
				                		?><br>
			                	<?php
			                		}}
			                	?>	                       	
	                        </div>
		                </td>
		            </tr>
		        <?php $i++; }} ?>
	        </tbody>
	        <tfoot>
	        	<tr>
	            	<th style="text-align: center;">
	            		<input type="submit" class="btn-primary-ccapital" value="Guardar Evaluación">
	            	</th>
	            </tr>
	        </tfoot>
	    </table>
	</form>
	<br>