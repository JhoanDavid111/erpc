<!-- Ver datos -->
<h2 class="title-c">Histórico - Planes de mejora</h2>
<?php $url_action2 = base_url."plamej/plamejcr"; ?>

	<div>
		<form class="m-tb-40" action="<?=$url_action2?>" method="POST">
			<div class="row">
				<div class="form-group col-md-3">
					<label for="fil1">F. Inicial Seguimiento:</label>
					<input type="date" class="form-control form-control-sm" id="fil1" name="fil1" value="<?=$fil1;?>">
				</div>
				<div class="form-group col-md-3">
					<label for="fil2">F. Final Seguimiento:</label>
					<input type="date" class="form-control form-control-sm" id="fil2" name="fil2"  onChange="this.form.submit();" value="<?=$fil2;?>">
				</div>
				<div class="form-group col-md-3">
					<label for="fil3">Origen:</label>
					<select class="form-control form-control-sm" id="fil3" name="fil3" onChange="this.form.submit();" style="padding: 0px 5px;">
						<option value="0" >Seleccione</option>
						<option value="1901" <?php if($fil3==1901) echo "selected"; ?>>Externo</option>
						<option value="1902" <?php if($fil3==1902) echo "selected"; ?>>Interno</option>
					</select>
				</div>

				<div class="form-group col-md-3" style="text-align: center;">
					<a href="<?=base_url?>views/pdftot.php?fil1=<?=$fil1;?>&fil2=<?=$fil2;?>&fil3=<?=$fil3;?>&ac=2&valid=3051" target="_blank" title="Imprimir Planes de Mejora">
			            <i class="fas fa-print fa-2x" style="color: #523178;margin-top: 30px;"></i>
			        </a>
			        <a href="<?=base_url?>views/csv.php?fil1=<?=$fil1;?>&fil2=<?=$fil2;?>&fil3=<?=$fil3;?>&ac=2&valid=3051" target="_blank" title="CSV Planes de Mejora">
			        	<i class="fa fa-download fa-2x" style="color: #523178;margin-top: 30px;"></i>
			        </a>
			    </div>
			</div>
		</form>
	</div>

	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	                <th>No. Plan.</th>
	                <th>Detalle</th>
	                <th>Estado</th>
	                <th style="width: 140px !important"></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($plamejs)){
	        		foreach ($plamejs as $va){ ?>
		            <tr>
		            	<td style="text-align: center;">
		            		<strong><?=$va['nopla'];?></strong>
		            		<br><br>
	                        <small>
	                            <strong>Fecha Sol. </strong><?=$va['fsolpla'];?>
		                        </br>
		                        <strong>Fecha Obs. </strong><?=substr($va['fobspla'],0,10);?>
		                        </br>
		                        <strong>Cod. </strong><?=$va['cappla'];?>
                            </small>
		                </td>
		                <td>
		                	<strong><?=$va['detfue'];?></strong><br>
	                        <small>
	                        	<?php 
	                        		if($va['areapla']){
	                        			$areas = explode(";", $va['areapla']);
	                        	?>
	                        		<strong>Áreas: </strong>
	                        		<?php
	                        			foreach ($areas as $area) {
	                        				$ar = $plamej->getArea($area);
	                        		?>
	                        				<?=$ar[0]['valid'];?> - <?=$ar[0]['valnom'];?>; 
	                        		<?php } ?>
	                        		<br>
	                        	<?php } ?>
                            	</br>
                            	<strong>Fuente de la Observación y/o hallazgo: </strong><?=$va['fte'];?>
                            	</br> 
	                            <?=$va['obspla'];?>
	                            </br></br>
                            	<strong>Observación de Cierre: </strong><?=$va['ocpla'];?> (<?=$va['feciepla'];?>).
	                        </small>
		                </td>
		                <td style="text-align: center;">
	                        <strong><?=$va['est'];?></strong>
		                </td>
		                <td style="text-align: center;width: 140px;">
		                	<div class="btnajupl">
		                		<a href="<?=base_url?>mejseg/index&h=t47kt&nopla=<?=$va['nopla'];?>">
				                	<i class="fa fa-file-text fa-2x" title="Ver Desarrollo Hallazgo" style="color: #523178;"></i>
				                	<br><span class="txtajupl">Ver</span>
		                		</a>
		                	</div>
		                	<?php if($_SESSION['pefid']==70){ ?>
		                		<!-- <div class="btnajupl">
					                <a href="<?=base_url?>plamej/updpm&nopla=<?=$va['nopla'];?>&actpla=1" title="Haz click para abrir el caso">
					                	<i class="fas fa-lock fa-2x bcacnd" title="Caso Cerrado" ></i>
					                	<br><span class="txtajupl">Cerrado</span>
					                </a>
					            </div> -->
					            <div class="btnajupl">
					                <i class="fas fa-lock fa-2x bcacnd" data-toggle="modal" data-target="#myModCob<?=$va['nopla'];?>" title="Caso Cerrado"></i>
						            <br><span class="txtajupl">Cerrado</span>
			                	</div>
			                	<?php ;
			                		$plamej->setNopla($va['nopla']);
			                		$dtobs = $plamej->getObsNp();
			                		echo Utils::modalUnTextAbCe("myModCob", "Abrir Plan de mejora", $va['nopla'], "Observación", base_url."plamej/updpm&valid=3051", "ocpla",$va['nopla'],"","","","",$va['ocpla'],$dtobs);
			                	?>
				            <?php }else{ ?>
				            	<div class="btnajupl">
			                		<i class="fas fa-lock fa-2x" title="Caso Cerrado" style="color: #523178;"></i>
			                		<br><span class="txtajupl">Cerrado</span>
			                	</div>
				            <?php } ?>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>No. Plan.</th>
	                <th>Detalle</th>
	                <th>Estado</th>
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