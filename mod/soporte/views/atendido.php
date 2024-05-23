<!-- Ver datos -->

<h2 class="title-c">Soportes Atendidos</h2>
<?php $url_action2 = base_url."atendido/index"; ?>
	<div>
		<form class="m-tb-40" action="<?=$url_action2?>" method="POST">
			<div class="row">
				<div class="form-group col-md-6">
					<label for="fil1">Fecha Inicial:</label>
					<input type="date" class="form-control form-control-sm" id="fil1" name="fil1" value="<?=$munm?>">
				</div>
				<div class="form-group col-md-6">
					<label for="fil2">Fecha Final:</label>
					<input type="date" class="form-control form-control-sm" id="fil2" name="fil2"  onChange="this.form.submit();">
				</div>
			</div>
		</form>
	</div>

	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Fecha</th>
	                <th>Soporte</th>
	                <th>Categoría</th>
	                <th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($soportes)){
	        		foreach ($soportes as $va){ ?>
		            <tr>
		            	<td>
	                        <small>
	                            <?=$va['fecsst'];?>
	                        </small>
		                </td>
		                <td>
		                	<strong>
	                            <?=$va['nomsst'];?>
	                        </strong><br>
	                        <small>
                            	<strong>Área: </strong><?=$va['area'];?> - <?=$va['valnom'];?>
                            	</br>
                            	<strong>Descripción: </strong><?=$va['desst'];?>
                            	</br> 
	                            <strong>No. Teléfono: </strong><?=$va['telst'];?>
	                            </br>
                            	</br>
                            	<?php if($va['rutst']){ ?>
	                            	<strong>Adjunto: </strong>
	                            	<a href="<?=path_filem;?><?=$va['rutst'];?>" target="_blank">
	                            		<img src="<?=base_url_img?>adjun.png" width="30px">
	                            	</a>
                            	<?php } ?>
	                        </small>
		                </td>
		                <td>
	                        <small>
	                            <?=$va['cate'];?>
	                        </small>
		                </td>
		                <td style="text-align: center;">
		                	<!-- <a href="<?=base_url?>soporte/edit&idst=<?=$va['idst'];?>">
		                		<i class="far fa-eye" style="color: #523178;"></i>
		                	</a> -->
		                	<a href="<?=base_url?>ressop/index&idst=<?=$va['idst'];?>&ate=1A4cc2">
			                	<?php if($va['cerst']==1){ ?>
				                	<i class="fas fa-lock" title="Caso Cerrado" style="color: #523178;"></i>
				                <?php }else{ ?>
				                	<i class="fas fa-unlock-alt" title="Caso Abierto" style="color: #ff0000;"></i>
				                <?php } ?>
			                </a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Fecha</th>
	                <th>Soporte</th>
	                <th>Categoría</th>
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