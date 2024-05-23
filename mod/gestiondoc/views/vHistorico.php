<!-- Ver datos -->

<h2 class="title-c">
	BANDEJA DE HISTÓRICO
<!-- 	<?php if($act == "radica"){ ?>
		RADICA
	<?php }elseif($act == "Finalizados"){ ?>
		Actividades Finalizadas y Retiradas
	<?php }else{ ?>
		Papelera de Gestión
	<?php } ?>
 --></h2>
<br><br>


<?php $url_act2 = base_url."radica/index"; ?>


<?php $url_acttraz = base_url."radica/savetra"; ?>

<br><br>

<form class="m-tb-40" action="<?=base_url?>radica/index" method="POST">
	<div class="row">
		<div class="form-group col-md-2" id="go1">
			<label for="fecin">Fecha Inicial</label>
			<input type="date" class="form-control form-control-sm" id="fecin" name="fecin" value="<?=$fecin;?>" />
		</div>
		<div class="form-group col-md-2" id="go1">
			<label for="fecfi">Fecha Final</label>
			<input type="date" class="form-control form-control-sm" id="fecfi" name="fecfi" value="<?=$fecfi;?>" />
		</div>
		<div class="form-group col-md-2" id="go1">
			<button type="submit" class="btn-primary-ccapital" style="background-color: #ff0000;">
				<i class="fa fa-search"></i> Buscar
			</button>
		</div>
	</div>
</form>
<div class="table-responsive">
	<!-- <form name='frmcom' action='<?=base_url?>radica/index' method='POST'> -->
	<form class="m-tb-40" action="<?=$url_acttraz?>" method="POST" enctype="multipart/form-data">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	            	<th>Fecha</th>
	                <th>Usuario</th>
	                <th>Radicado</th>
	                <th>Área</th>
	                <th>Tipo</th>					
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($radicas)){
	        		foreach ($radicas as $f){ ?>
	        			
		            <tr>
		            	<?php 
			            	if (file_exists("image/".$f['firrad'].".png"))
								$imagen = "image/".$f['firrad'].".png";
							else
								$imagen = "image/file.png";

							$fecleido = isset($f['fecleido']) ? $f['fecleido']:NULL;
							$idban = isset($f['idban']) ? $f['idban']:NULL;
							$vinculo = base_url."radica/resp&norad=".$f['norad'];
							if($idban) $vinculo .= "&idban=".$idban;

							// if($selpef[0]["pefdes"]==1){
							// 	echo "<td align='center' width='30px'><a href='".$vinculo."' target='_new'><img src='".$imagen."' title='Descargar' width='20px' ></a></td>";
							// }
		            	?>
		            	<td>
		            		<small><small>
		            			<?=substr($f["fecrad"],0,10);?>
		            			<BR>
		            			<?=substr($f["fecrad"],11,8);?>
		            		</small></small>
		                </td>
		            	<td>
		            		<small>
	 		            		<?php if($tipo=="Recibidos"){ ?>
									<a href='<?=$vinculo;?>'>
										<?php if(!$fecleido) echo "<strong>";
											$nprs = $f["pernom"]." ".$f["perape"];
											if(strlen($nprs)<36)
												echo $nprs;
											else
												echo substr($nprs,0,34)."...";
										if(!$fecleido) echo "</strong>"; ?>
									</a>
								<?php }elseif($tipo=="Enviados"){
										$sep = explode(", ",$f['nomrad']);
										$nomper = ""; ?>
										<?php foreach ($sep as $sp) {
											$spr = $mrad->selpara($sp);
											$nprs = $spr[0]["pernom"]." ".$spr[0]["perape"];
											$nomper .= substr($nprs,0,strpos($nprs," ")).", ";
										} ?>
										<a href='<?=$vinculo;?>'>
											<?php if(strlen($nomper)<36)
												echo "Para: ".substr($nomper,0,strlen($nomper)-2);
											else
												echo "Para: ".substr($nomper,0,30)."...";
										?>
										</a>
								<?php } ?>
							</small>
		                </td>
		                <td>
		                	<a href='<?=$vinculo;?>'>
								<small>
									<?php if(!$fecleido) echo "<strong>"; ?>
									<?php
										echo $f['consecutivo']." - ";
										if(strlen($f['asurad'])<50)
											echo $f['asurad'];
										else
											echo substr($f['asurad'],0,50)."...";
									?>
									<?php if(!$fecleido) echo "</strong>"; ?>
		                        </small>
		                    </a>
		                </td>
		                <td>
		                	<small><small>
		                		<?=$f['are']; ?>
		                	</small></small>
		                </td>
		                <td>
		                	<?=$f['tip']; ?>
		                </td>
		                
		                
		                
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	            	<th>Fecha</th>
	                <th>Usuario</th>
	                <th>Radicado</th>
	                <th>Área</th>
	                <th>Tipo</th>					
	            </tr>
	        </tfoot>
	    </table>
	</form>		
</div>

<br>

<h2 class="title-c">COMPARTIDOS CONMIGO</h2>
<br><br><br>
<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
    <thead>
        <tr>
        	<th>DEPENDENCIA</th>
            <th>SERIE-SUBSERIE</th>
            <th>TIPODOCUMENTAL</th>
            <th>D.FIN</th>
            				
        </tr>
    </thead>
    <tbody>
    	<?php 
			$radica= new Radica();			
		 ?>
		 <?php foreach($compartidos AS $cm): ?>
		 	<?php 
				$fechaacentral = $cm['fechaini'];
				$nuevafecha = strtotime ('+'.$fechaacentral.'year' , strtotime($fechaacentral)); 
				$nuevafecha = date ('Y-m-d',$nuevafecha);
				
				date_default_timezone_set('America/Bogota');
				$fechaact=date("Y-m-d");

				$date1 = strtotime($nuevafecha); 
				$date2 = strtotime($fechaact); 
				$diff = ($date1 - $date2);
				
				// echo $diff;
				//$diff=1;

				// var_dump($cm['ultserie']);
				// die();

				$compartid = $radica->getcompartidos($cm['ultserie'],$cm['depid'],$cm['anoexp']);

			?>

			<?php foreach ($compartid as $ac): ?>
				<tr>
					<th><small><strong><?=$ac['valnom']?></strong></small></th>
					<td><small><?=$ac['ultserie']?></small></td>
					<td>
						<small>
							<strong><?=$ac['destrd']?></strong>									
						</small>
						<br><br>
						<?php 
							$arcentrald = $radica->getar3($ac['ultserie'],$ac['depid']);
							$totalarchivos=count($arcentrald);
							$sumap=$radica->sumap($ac['ultserie'],$ac['depid']);
						 ?>
						 <small>
							<strong>Total de archivos: <?=$totalarchivos;?> (<?=$sumap[0]['sumapeso'];?>Kb)</strong>										
						</small>
						<br><br>
						 <?php foreach($arcentrald AS $acd): ?>
						 	<a href="<?=$acd['ruta'];?>" target="_blank"><strong>&#8226;</strong><small><?=$acd['nomserie']?>.<?=$acd['tipo'].' '.'('.$acd['peso'].'Kb)';?></small></a>
						 	
						 	<br>
						 	
						 <?php endforeach; ?>
					</td>
					<?php 

						$fechaExp=date("Y",strtotime($ac['fecha']));

					 ?>
					<!-- <td><small><?=$ac['fecha'];?></small></td>							
					<td><small><?=$nuevafecha;?></small></td> -->
					<td><small><?=$ac['dfintrd']?></small></td>							
					
				</tr>
				
			<?php endforeach ?>
		 <?php endforeach; ?>
    </tbody>
</table>


<h2 class="title-c">COMPARTIDOS JURÍDICA</h2>
<br><br><br>
<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
    <thead>
        <tr>
        	<th>DEPENDENCIA</th>
        	<th>TIPO</th>
            <th>SERIE-SUBSERIE</th>
            <th>TIPODOCUMENTAL</th>            				
        </tr>
    </thead>
    <tbody>
    	<?php 
			$radica= new Radica();			
		 ?>
		

			<?php foreach ($compjuridica as $ac): ?>
				<tr>
					<th><small><strong>JURÍDICA</strong></small></th>
					<td><small><?=$ac['tipo']?></small></td>
					<td><small><?=$ac['ultserie']?></small></td>
					<td>
						<small>
							<strong><?=$ac['destrd']?></strong>	
							<br>
							<a href="#">
								<?=$ac['nomserie']?>	
							</a>
							

						</small>
						<br>
						<?php 
							//$arcentrald = $radica->getar3($ac['ultserie'],$ac['depid']);
							// $totalarchivos=count($arcentrald);
							//$sumap=$radica->sumap($ac['ultserie'],$ac['depid']);
						 ?>
						 <small>
							<!-- <strong>Total de archivos: <?=$totalarchivos;?> (<?=$sumap[0]['sumapeso'];?>Kb)</strong>										 -->
						</small>
					
						 
					</td>
					<?php 

						$fechaExp=date("Y",strtotime($ac['fecha']));

					 ?>
					<!-- <td><small><?=$ac['fecha'];?></small></td>							
					<td><small><?=$nuevafecha;?></small></td> -->
					<!-- <td><small><?=$ac['dfintrd']?></small></td>							 -->
					
				</tr>
				
			<?php endforeach ?>
		
    </tbody>
</table>




<?php if(isset($edit) && isset($val)): ?>
	<script>ocultar(1,300);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>