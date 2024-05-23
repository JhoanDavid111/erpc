<!-- Ver datos -->

<h2 class="title-c">
	ARCHIVO CENTRAL
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
	 <br>
	<div class="table-responsive">
		<!-- <form name='frmcom' action='<?=base_url?>radica/index' method='POST'> -->
		<form class="m-tb-40" action="<?=$url_acttraz?>" method="POST" enctype="multipart/form-data">

			<table id="example" class="table table-striped table-bordered dterpceDSC" style="width:100%;">		

		        <thead>
					<tr>
						<!-- <th rowspan="2">Tabla Avanzada</th> -->
						<th colspan="2" class="col-1">CÓDIGOS</th>
						<th rowspan="2">SERIES, SUBSERIES Y TIPOS DOCUMENTALES</th>	
						<th colspan="2">FECHA</th>
						<th rowspan="2">D.FIN</th>
						<th rowspan="2"></th>


					</tr>
					<tr>						
						<th>Dependencia</th>	
						<th>Serie - Subserie</th>					
						<th>Final Proceso</th>
						<th>En Central Hasta</th>
					
					</tr>
				</thead>
			
				<tbody>
					<?php 
						$radicad= new Radica();
						
					 ?>

					
					<?php foreach($arcentral AS $ac): ?>
						<?php 
							$fechaacentral = $ac['fecha'];
							$nuevafecha = strtotime ('+'.$ac['acentrd'].'year' , strtotime($fechaacentral)); 
							$nuevafecha = date ('Y-m-d',$nuevafecha);
							
							date_default_timezone_set('America/Bogota');
							$fechaact=date("Y-m-d");

							$date1 = strtotime($nuevafecha); 
							$date2 = strtotime($fechaact); 
							$diff = ($date1 - $date2);
							
							// echo $diff;
							//$diff=1;

						?>
						<?php if($diff>0): ?>
							<tr>
								<th><small><strong><?=$ac['valnom']?></strong></small></th>
								<td><small><?=$ac['ultserie']?></small></td>
								<td>
									<small>
										<strong><?=$ac['destrd']?></strong>										
									</small>
									<br><br>
									<?php 
										$arcentrald = $radicad->getar3($ac['ultserie'],$ac['depid']);
										$totalarchivos=count($arcentrald);
										$sumap=$radicad->sumap($ac['ultserie'],$ac['depid']);
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
								<td><small><?=$ac['fecha'];?></small></td>							
								<td><small><?=$nuevafecha;?></small></td>
								<td><small><?=$ac['dfintrd']?></small></td>							
								<td>
									<a href="" title="Ver Expediente">
				                		<i class="fas fa-eye"></i> 	
				                	</a> 
				                	<br><br>
				                	<?php if($_SESSION['pefid']==9): ?>
				                		<a href="<?=base_url?>radica/auditdoc&seriedoc=<?=$ac['ultserie']?>" title="Auditar Expediente">
					                		<i class="fa fa-search-plus"></i>
					                	</a> 
					                	<br><br>
					                	<a href="<?=base_url?>radica/compartir&seriedoc=<?=$ac['ultserie']?>&depid=<?=$ac['depid']?>&valnom=<?=$ac['valnom']?>&destrd=<?=$ac['destrd']?>&fechaexp=<?=$fechaExp?>" title="Compartir">  
					                		<i class="fa fa-cloud"></i>	
					                	</a> 
				                	<?php endif; ?>
				                	
				                </td>
							</tr>
						<?php endif; ?>
						
					<?php endforeach; ?>
					
				</tbody>
		        <tfoot>
		            <tr>
						<th>Estado</th>
		                <th>radica</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
		            </tr>
		        </tfoot>
		    </table>
		</form>		
	</div>

	<br>

