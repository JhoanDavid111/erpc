
<h2 class="title-c">Pasantes</h2>
<br><br>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Pasante</th>
	                <th>F. Ing</th>
	                <th>F. Fin</th>
	                <th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($pasantes)){
	        		foreach ($pasantes as $va){ ?>
		            <tr>
		                <td>
		                	<strong>
<!-- , , durpas, acvpas, conpas, actpas -->
	                            <?php if($va['docpas']) echo $va['docpas']." - ";?>
	                            <?=$va['nompas'];?>
	                        </strong><br>
	                        <small>
	                        	<strong>Programa: </strong><?=$va['propas'];?>
	                            </br>
	                            <strong>Universidad: </strong><?=$va['unipas'];?>
	                            </br>
	                            <strong>Duración: </strong><?=$va['durpas'];?>

	                            <!-- <?php if($va['acvpas']){
	                            	echo "<strong>Activo: </strong>";
	                            	echo $va['acvpas']."&nbsp;&nbsp;&nbsp";
	                            } ?>
	                            <?php if($va['conpas']){
	                            	echo "<strong>Con: </strong>";
	                            	echo $va['conpas']."</br>";
	                            } ?> -->
	                        </small>
		                </td>
		                <td>
		                	<small>
                            	<?=$va['fingpas'];?>
                            </small>
		                </td>
		                <td>
		                	<small>
                            	<?=$va['ffinpas'];?>
                            </small>
		                </td>
		                <td>
							<span style="opacity: 0"><?=$va['actpas'];?></span>
		                	<?php if($va['actpas']==1){ ?>
			                	<i class="fas fa-check-circle" style="color: #523178;">
			                		<span style="color: rgba(255,255,255,0);">+</span>
			                	</i>
			                <?php }else{ ?>
								<i class="fas fa-times-circle" style="color: #f00;">
									<span style="color: rgba(255,255,255,0);">-</span>
								</i>
							<?php } ?>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Pasante</th>
	                <th>F. Ing</th>
	                <th>F. Fin</th>
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