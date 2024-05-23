<!-- <script src="js/my.js"></script> -->


<script src="../js/futic.js"></script>
<script src="../js/cdpaux.js"></script>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<?php if (isset($_SESSION['consultado']) && isset($editp)): ?>		

	<h2 class="title-c">Editar Anteproyecto Financiero </h2> <br><br>

<?php else: ?>
	<h2 class="title-c"> Anteproyecto Financiero </h2>
<?php endif; ?>




	<?php if(!isset($_SESSION['newpfin'])&& !isset($_SESSION['consultado'])):  ?>

		<form class="m-tb-40" action="<?=base_url;?>/antproy/planes" method="POST">
			<div class="row">				

				<div class="form-group col-md-3">
					<label for="vigencia">Vigencia  <a href="<?=base_url?>antproy/newpfin" class="fas fa-plus-square" style="color: #523178;"></a></label>
					<!-- <?php //$cont = date('Y'); ?> -->

					<input type="text" name="vigencia" class="form-control form-control-sm" style="padding: 0px;" value="<?=$pfvig[0]['idpaa'];?>" readonly>					

				</div>
				
				<div class="col-md-3">				
					<button class="btn-primary-ccapital">Consultar</button>
				</div>

			</div>
		</form>	

	<?php else:?>
		<?php if(isset($_SESSION['msgnp'])): ?>
			<br><br><br>
			<h5 style="color: red"><?=$_SESSION['msgnp'];?></h5><br>
			<a href="<?=base_url?>antproy/index" class="btn-primary-ccapital">Aceptar</a>
			<br><br>
			<?php 
				unset($_SESSION['msgnp']); 
				unset($_SESSION['newpfin']);
				unset($_SESSION['consultado']);
			?>

			


		<?php elseif(!isset($_SESSION['consultado']) && !isset($ediAnte)): ?>			

			<?php unset($_SESSION['newpfin']); ?>
			<form class="m-tb-40" action="<?=base_url;?>antproy/saveNPaa" method="POST" id="crnew">

				<fieldset>
					<legend><h4 class="title-c">Nuevo PAA</h4></legend>
					<div class="row">				

						<div class="form-group col-md-3">
							<label for="newvig">Vigencia</label>						
							<input type="text" class="form-control" id="newvig" name="newvig" value="<?=$pfvig[0]['idpaa']?>" readonly="">
						</div>
						<div class="form-group col-md-3">
							<label for="nompaa">Nombre</label>
							<input type="text" class="form-control" id="nompaa" name="nompaa" required="">
						</div>
						<div class="form-group col-md-3">
							<label for="digp">Digito</label>
							<input type="number" class="form-control" id="digp" name="digp" required="">
						</div>
						<div class="col-md-3">
							<label for="nompaa">&nbsp;</label><br>
							<!-- <a href="" class="btn-primary-ccapital" onclick="javascript:document.getElementById('crnew').submit();
								return false;">Crear</a> -->
							<a href="<?=base_url?>antproy/index" class="btn-secondary-canalc">Cancelar</a>
						</div>	
						<div class="col-md-3">				
							<button class="btn-primary-ccapital">Crear</button>
						</div>

								

					</div>
				</fieldset>
				
			</form>	


		<?php endif; ?>		
		
	<?php endif; ?>

	<?php if (isset($_SESSION['consultado']) && !isset($ediAnte)): ?>		

		<form class="m-tb-40" action="<?=base_url;?>antproy/editEPF" method="POST" id="crnew">
			<?php if ($_SESSION['pefid']==21 || $_SESSION['pefid']==34 || $_SESSION['pefid']==37 ): ?>
				<fieldset>
					<legend><h4 class="title-c">Estado de Anteproyecto Financiero</h4></legend>
					<div class="row">				

						<div class="form-group col-md-2">
							<label for="newvig">Vigencia</label>						
							<input type="text" class="form-control" id="newvig" name="newvig" value="<?=$_SESSION['consultado']?>" readonly="">
						</div>
						<div class="form-group col-md-3">
							<label for="nompaa">Nombre</label>
							<input type="text" class="form-control" id="nompaa" name="nompaa" required="" value="<?=isset($estado) ? $estado[0]['despaa'] : ''; ?>">
						</div>
						<div class="form-group col-md-1">
							<label for="digp">Digito</label>
							<input type="number" class="form-control" id="digp" name="digp" required="" value="<?=isset($estado) ? $estado[0]['ninipaa'] : ''; ?>">
						</div>

						<div class="form-group col-md-3">
							<label for="estact">Estado Actual</label>
							<input type="text" class="form-control" id="estact" name="estact" required="" readonly="" value="<?=isset($estado) ? $estado[0]['vafnom'] : ''; ?>">
						</div>

						<?php if(isset($estado)): ?>
							<?php if($estado[0]['vafnom']=="Activo"): ?>
								<div class="form-group col-md-2">
									<label for="cbox1" class="">Aprobado</label><br>
									<input type="checkbox"  id="cbox1" name="cbox1" value="aprobado" checked disabled=""> 
								</div>
							<?php endif; ?>
						<?php endif; ?>
						
						<div class="col-md-3">
							
							<label for="mestado">Modificar Estado</label>
							<?php if($_SESSION["pefid"]==21 OR $_SESSION["pefid"]==34){ ?>
								<?php 
									// var_dump($estados);
									// die();
								 ?>
								<select id="areas" name="mestado" id="mestado" class="form-control" style="padding: 0px;" >									
									<?php foreach ($estados as $stds){ ?>
										<option value="<?=$stds['vafid'];?>" <?=$estado[0]['vafid']==$stds['vafid'] ? ' selected ' : ''; ?>>
											<?=$stds['vafnom'];?>												
										</option>		


										
									<?php } ?>
								</select>
							<?php }else{ ?>
								<input type="hidden" name="areas" value="<?=$_SESSION['depid'];?>">
								<input type="text" class="form-control" value="<?=$_SESSION['nomarea'];?>" readonly>
							<?php } ?>								
							
							
						</div>	
						<div class="col-md-3">				
							<button class="btn-primary-ccapital">Actualizar</button>
						</div>	
					</div>

					<div class="contspan">
						<span class="spCanalP1">1</span>
						<span class="spCanalP2">2</span>
						<span class="spCanalP2">3</span>
						<span class="spCanalP2">4</span>	
					</div>
				</fieldset>

				<?php else: ?>

				<fieldset>
					<legend><h4 class="title-c">Estado de Anteproyecto Financiero</h4></legend>
					<div class="row">				

						<div class="form-group col-md-2">
							<label for="newvig">Vigencia</label>						
							<input type="text" class="form-control" id="newvig" name="newvig" value="<?=$_SESSION['consultado']?>" readonly="">
						</div>
						<div class="form-group col-md-3">
							<label for="nompaa">Nombre</label>
							<input type="text" class="form-control" id="nompaa" name="nompaa" required="" value="<?=isset($estado) ? $estado[0]['despaa'] : ''; ?>" readonly>
						</div>
						<div class="form-group col-md-2">
							<label for="digp">Digito</label>
							<input type="number" class="form-control" id="digp" name="digp" required="" value="<?=isset($estado) ? $estado[0]['ninipaa'] : ''; ?>" readonly>
						</div>

						<div class="form-group col-md-3">
							<label for="estact">Estado Actual</label>
							<input type="text" class="form-control" id="estact" name="estact" required="" readonly="" value="<?=isset($estado) ? $estado[0]['vafnom'] : ''; ?>" readonly>
						</div>

						<?php if(isset($estado)): ?>
							<?php if($estado[0]['vafnom']=="Activo"): ?>
								<div class="form-group col-md-2">
									<label for="cbox1" class="">Aprobado</label><br>
									<input type="checkbox"  id="cbox1" name="cbox1" value="aprobado" checked disabled=""> 
								</div>
							<?php endif; ?>
						<?php endif; ?>												

					</div>
				</fieldset>
			<?php endif ?>			
			
		</form>		
		
	<?php endif; ?>	

	

	<?php if($estado[0]['estpaa'] != 3): ?>
		<?php

			if (isset($_SESSION['newpaa'])) {
				?>	
				<a href="<?=base_url?>antproy/index" class="btn-secondary-canalc">Regresar</a>
				<?php			
			}else{
				?>
				<a href="<?=base_url?>antproy/index&nuevo=nuevo" class="btn-secondary-canalc">Nuevo Registro</a>
				<?php
			}


		 ?>
			<br><br>

	<?php if (isset($_SESSION['estAntCer'])) { ?>
		<span class="sgreen"><?=$_SESSION['estAntCer']?></span>
		<?php unset($_SESSION['estAntCer']); ?>
	<?php }else{ ?>

	<?php 
		$newpaa = isset($_SESSION['newpaa']) ? $_SESSION['newpaa']:NULL;
		if ($newpaa==null) {

			// var_dump($_SESSION['newpaa']);
			// die();
			?>

			<?php 
				$pfinan = new Pfinan();
				$vig = $pfinan->vigactan();//en modelo pfinan
			 ?>

			 <?php if (count($vig)>0): ?>
			 	<div class="form-group col-md-1" style="text-align: right;">
					<form class="m-tb-40" action="<?=base_url;?>views/csvantep.php" target="_blank" method="POST">
						<br>
						<input type="hidden" name="depid" value="<?=$_SESSION['depid'];?>">
						
						<button type="submit" class="btn" style="color: #523178;" title="CSV ANTEPROYECTO">
							<i class="fas fa-file-excel fa-2x"></i>
						</button>
					</form>
				</div>
			 <?php endif ?>

			<div class="table-responsive">
			<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
		        <thead>
		            <tr>
		                <th>Código</th>
						<th>Nombre Rubro</th>					
						<th>Nombre Cont</th>
						<th>Fecha Inicio</th>
						<th>Fecha Fin</th>
						<!-- <th>Número meses</th> -->					
						<th>Asignación</th>	
						<th>Area</th>				
						<th></th>
		            </tr>
		        </thead>
		        <tbody>

		        	<?php if(isset($pfinand)): ?>
		        		<?php $totalasig=0; ?>
		        		<?php foreach ($pfinand as $pf){ ?>
				            <tr>
				                <td><?=$ninipaa.$pf['codrub'];?></td>
				                <td><?=$pf['nomrub'];?></td>                
				                <td><?=$pf['nomcont'];?></td>
				                <td><?=$pf['fecinidpa'];?></td>
				                <td><?=$pf['fecfindpa'];?></td>
				                <!-- <td><?=$pf['nmesdpa'];?></td>   -->

				                <td style="text-align: right;">$ <?=number_format($pf['asidpa'], 0, ',', '.');?> </td>  
				                 <?php 

				                	$totalasig += $pf['asidpa'];

				                 ?>
				                <td><?=$pf['valnom'];?></td>              
				                <td>
									<a href="<?=base_url?>antproy/getAntPf&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>&area=<?=$pf['area'];?>" title="Editar">
				                		<i class="fas fa-edit" style="color: #523178;"></i>
				                	</a>
								</td>

				            </tr>
				        <?php } ?>

		        	<?php endif; ?>

		        	   
		           
		        </tbody>
		        <tfoot>
		             <!-- <tr>
		                <th>Código</th>
						<th>Nombre Rubro</th>					
						<th>Nombre Cont</th>
						<th>Fecha Inicio</th>
						<th>Fecha Fin</th>
						<th>Número meses</th>				
						<th>Asignación</th>
						<th>Area</th>				
						<th></th>
		            </tr> -->
		            <tr>
		            	<th colspan="5" style="text-align: right;">TOTAL ASIGNACIÓN</th>
		            	<th colspan="3">$ <?= isset($totalasig) ? number_format($totalasig, 0, ',', '.'):0;?></th>
		            </tr>
		        </tfoot>
		    </table>
			
		</div>
	<?php }	 ?>
	<?php }	 ?>


	<?php endif ?>

	

	



		

		<br>

		
		<?php //if(isset($pfinand) && isset($epf)): ?>
			
			<!-- <form class="m-tb-40" action="<?=base_url;?>pfinan/editPf" method="POST"> -->
			<!-- <form class="m-tb-40" action="<?=base_url;?>/antproy/insAntep"  method="POST"> -->

			<?php if(isset($_SESSION['consultado']) && isset($_SESSION['newpaa'])): ?>
				
				<h2 class="title-c m-tb-40">Nuevo Registro</h2>
				<br>
				<br><br>

				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
				        <thead>
				            <tr>
				                <th>Código</th>												
								<th>Nombre Rubro</th>
								<th>Act</th>
								<th></th>
				            </tr>
				        </thead>
				        <tbody>
				        	<?php 
				        	if(isset($rubrosPf)){
				        		$contar=0;
				        		foreach ($rubrosPf as $ep){ $contar++; ?>
					            <tr>
					                <td id="codrubr" value="<?=$ninipaa.$ep['codrub'];?>"><?=$ninipaa.$ep['codrub'];?> <input type="text" id="<?=$contar?>" value="<?=$ninipaa.$ep['codrub'];?>" hidden></td>               			                
					                <td><?=$ep['nomrub'];?></td>
					                <td>
					                <?php if($ep['actrub']==1){ ?>
					                	<i class="fas fa-check-circle" style="color: #523178;">
					                		<span style="color: rgba(255,255,255,0);">+</span>
					                	</i>
					                <?php }else{ ?>
										<i class="fas fa-times-circle" style="color: #f00;">
											<span style="color: rgba(255,255,255,0);">-</span>
										</i>
									<?php } ?>
					                </td>
					                <td>
					                	<input type="radio" id="<?=$ninipaa.$ep['codrub'];?>" name="rubro" onclick="rubri(<?=$contar;?>,'<?=$ep['nomrub'];?>')" value="<?=$ep['codrub'];?>" <?= $ep['codrub'] == $editp ? ' checked ' : ''; ?>>

					                <!-- 	<input type="radio" id="<?=$ninipaa.$ep['codrub'];?>" name="rubro" onclick="rubri(<?=strval($ninipaa.$ep['codrub']);?>,'<?=$ep['nomrub'];?>')" value="<?=$ep['codrub'];?>" <?= $ep['codrub'] == $editp ? ' checked ' : ''; ?>> -->

					                </td>
					            </tr>
					        <?php }} ?>
				        </tbody>
				        <tfoot>
				            <tr>
				                <th>Código</th>													
								<th>Nombre Rubro</th>
								<th>Act</th>
								<th></th>
				            </tr>
				        </tfoot>
				    </table>
					
				</div>
				

			<?php endif; ?>
				

				<div class="row">
					<div class="form-group col-md-12">
						<?php if(isset($edit) && isset($rub)){ ?>
							<label for="dependencias">Dependencias</label>
							<br>
							<span id="dependencias" style="font-size: 11px;">
				                <?=isset($dependencias) ? $dependencias:''; ?>
					        </span>


				        <?php } ?>
					</div>


					

					<div class="row">
						<div class="form-group col-md-12">
						</div>
					</div>


					<!-- 
					//*******************
					//EDITAR ANTEPROYECTO
					//******************* -->

					<?php if(isset($pfinandOne)): ?>
						<?php foreach ($pfinandOne as $pf2){ ?>
								<h4 class="title-c m-tb-40">Editar Registro</h4>
							
							<form class="m-tb-40" action="<?=base_url;?>antproy/editpaa2" method="POST">	

								<div class="row">

									<div class="form-group col-md-12">
										<label for="areas">Areas</label>
										<?php if($_SESSION["pefid"]==21 OR $_SESSION["pefid"]==34){ ?>
											<?php $areas=Utils::areasu($_SESSION['consultado']); ?>
											<select id="areas" name="areas" id="areas" class="form-control" style="padding: 0px;" >

												<?php $areas=Utils::areasu($_SESSION['consultado']); ?>	
												<?php foreach ($areas as $pf){ ?>
													

													<option value="<?=$pf['valid'];?>" <?=$pf['valid']==$pf2['area'] ? ' selected ' : ''; ?>>
														<?=$pf['valnom'];?>												
													</option>		


													
												<?php } ?>
											</select>
										<?php }else{ ?>
											<input type="hidden" name="areas" value="<?=$_SESSION['depid'];?>">
											<input type="text" class="form-control" value="<?=$_SESSION['nomarea'];?>" readonly>
										<?php } ?>

										
										
									</div>

								
									<div class="form-group col-md-6">
										<label for="codUNSPSC">Cod. UNSPSC</label>
										<input type="text" class="form-control" id="codUNSPSC" name="codUNSPSC" required="" value="<?=isset($pf2) && $pf2['unspsc'] ? $pf2['unspsc'] : '' ;?>">

									</div>
									<div class="form-group col-md-6">
										<label for="rubroPre"> Rubro Presupuestal</label>
										<input type="number" class="form-control" id="rubroPre" name="rubroPre" value="<?=$ninipaa.$pf2['codrub'];?>" readonly>

									</div>
									<div class="form-group col-md-12">
										<label for="nombreRubro">Nombre Rubro Presupuestal</label>
										<input type="text" class="form-control" id="nombreRubro" name="nombreRubro" value="<?=$pf2['nomrub'];?>" readonly="">

									</div>
									<div class="form-group col-md-12">
										<label for="nomcont">Nombre Contratista</label>
										<input type="text" class="form-control" id="nomcont" name="nomcont" value="<?=$pf2['nomcont'];?>">
									</div>
									<div class="form-group col-md-12">
										<label for="objeto">Objeto/Descripción</label>
										<textarea class="form-control" id="objeto" name="objeto" rows="4" required=""><?=$pf2['nobjeto'];?></textarea>
									</div>

									

									<?php if($_SESSION["pefid"]==21 OR $_SESSION["pefid"]==34){ ?>
										<div class="form-group col-md-12">
											<label for="objdpa">Objetivo</label>							

											<select id="objdpa" name="objdpa" class="form-control form-control-sm" style="padding: 0px;" >	
												<?php foreach ($objetivos as $dat){ ?>
													<option value="<?=$dat['vafid'];?>"  <?= $pf2['objdpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
												<?php } ?>
											</select>
										</div>
									<?php }else{ ?>
										<input type="hidden" name="objdpa" value="36">
									<?php } ?>

									<?php if($_SESSION["pefid"]==21 OR $_SESSION["pefid"]==34){ ?>
										<div class="form-group col-md-12">
											<label for="inidpa">Iniciativa</label>
											<select id="inidpa" name="inidpa" class="form-control form-control-sm" style="padding: 0px;" >	
												<?php foreach ($iniciativas as $dat){ ?>
													<option value="<?=$dat['vafid'];?>"  <?= $pf2['inidpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
												<?php } ?>
											</select>
										</div>
									<?php }else{ ?>
										<input type="hidden" name="inidpa" value="83">
									<?php } ?>

									<?php if($_SESSION["pefid"]==21 OR $_SESSION["pefid"]==34){ ?>
										<div class="form-group col-md-12">
											<label for="prodpa">Proyecto</label>
											<select id="prodpa" name="prodpa" class="form-control form-control-sm" style="padding: 0px;" >	
													<?php foreach ($proyectos as $dat){ ?>
													<option value="<?=$dat['vafid'];?>"  <?= $pf2['prodpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
												<?php } ?>
											</select>
										</div>
									<?php }else{ ?>
										<input type="hidden" name="prodpa" value="418">
									<?php } ?>

									<div class="form-group col-md-6">
										<label for="fechaInicio">Fecha Estimada de Inicio</label>
										<input type="date" class="form-control" id="fechaInicio" name="fechaInicio" onchange="asigmes()" value="<?=$pf2['fecinidpa'];?>">
									</div>

									<div class="form-group col-md-6">
										<label for="fechaEstimada">Fecha Estimada Final</label>
										<input type="date" class="form-control" id="fechaEstimada" name="fechaEstimada" onchange="asigmes()" value="<?=$pf2['fecfindpa'];?>">
									</div>

									<div class="form-group col-md-4">
										<label for="valorAsignado">Valor Asignado</label>
									
										<input type="number" class="form-control" id="valorAsignado" name="valorAsignado" onkeyup="asigmes()" onchange="asigmes()" value="<?=$pf2['asidpa'];?>">
										
									</div>
									<div class="form-group col-md-4">
										<label for="valorVigencia">Valor Vigencia Actual</label>
										<input type="text" class="form-control" id="valorVigencia" name="valorVigencia" value="<?=$pf2['valvigact'];?>" required="">
									</div>
									<div class="col-md-4">
										<label for="#">Requiere vigencia Futura</label>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="vigenciaF" id="SI" value="SI"
												<?= $pf2['reqvigf'] == "SI" ? ' checked' : ''; ?>>
											<label class="form-check-label" for="SI">
												SI
											</label>
											<input type="hidden" class="form-control" id="valorVigencia" name="valorVigencia" style="color:green; font-weight: bolder;" value="999999999999" readonly="">
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="vigenciaF" id="NO" value="NO" checked>
											<label class="form-check-label" for="NO">
												NO
											</label>
										<!-- <div class="form-check">
											<input class="form-check-input" type="radio" name="vigenciaF" id="SI" value="SI"
												<?=isset($pf2) && $pf2['reqvigf'] == "SI" ? ' checked' : ''; ?>>
											<label class="form-check-label" for="SI">
												SI
											</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="vigenciaF" id="NO" value="NO" <?=isset($pf2) &&  $pf2['reqvigf'] == "NO" ? ' checked' : ''; ?>>
											<label class="form-check-label" for="NO">
												NO
											</label> -->
										</div>
									</div>

									<!-- ALERTA -->
									<div class="col-md-12">
										<div id="alertdisponible" class="alert alert-danger" role="alert" style="display: none;">							
										  <div>
										    &nbsp;&nbsp; Recuerde que no puede exceder el valor disponible!!
										  </div>
										 
										</div>
									</div>

									<!-- FIN ALERTA -->

									<div class="form-group col-md-3">
										<label for="duracion">Número de Pagos</label>
										<input type="number" class="form-control" id="duracion" name="duracion" onkeyup="asigmes()" onchange="asigmes()" value="" readonly="">
									</div>

									<div class="form-group col-md-3">
										<label for="primerm">Valor Primer mes</label>
										<input type="text" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="primerm" name="primerm" value="" >
									</div>

									<div class="form-group col-md-3">
										<label for="ultimom">Valor último mes</label>
										<input type="number" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="ultimom" name="ultimom" value="">
									</div>	

									<div class="form-group col-md-3">
										<label for="valormensual">Valor mensual prom.</label>
										<input type="number" class="form-control" id="valormensual" name="valormensual" value=""  readonly="">
									</div>								

									<div class="form-group col-md-4">
										<label for="tipcondpa">Modalidad</label>
										<select id="tipcondpa" name="tipcondpa" class="form-control form-control-sm" style="padding: 0px;" >	
											<?php foreach ($tipocontra as $dat){ ?>
												<option value="<?=$dat['vafid'];?>"  <?= $pf2['tipcondpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
											<?php } ?>
										</select>
									</div>

									<div class="form-group col-md-4">
										<label for="ftefindpa">Fuente de Recursos</label>
										<select id="ftefindpa" name="ftefindpa" class="form-control form-control-sm" onchange="javascript:ovif(this.value);" style="padding: 0px;" >	
											<?php foreach ($fuentes as $dat){ ?>
												<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ftefindpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
											<?php } ?>
										</select>
									</div>

									<div class="form-group col-md-4" id="vif">
										<label for="futic">Resolución FUTIC</label>
										<select id="futic" name="futic" class="form-control form-control-sm" style="padding: 0px;" >	
											<?php foreach ($futic as $dat){ ?>
												<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ft'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
											<?php } ?>
										</select>
									</div>

									<?php 

										if ($pf2['ftefindpa']==653) {
											echo "<script type='text/javascript'>ovif(653);</script>";		
										}else{
											echo "<script type='text/javascript'>ovif(1);</script>";			
										}
										
									 ?>

									<br>
									<br>
								</div>

								<h4 class="title-c m-tb-40">Proyección de Inversión</h4>
								<br>
								<br>

								<div class="form-group col-md-12">
									<div class="table-responsive">
										<table id="example2" class="table table-striped table-bordered " style="width:100%; font-size: 15px;">
											<thead>
												<tr id="tmeses">
													
												</tr>						
											</thead>
											<tbody>
												<tr id="tvmeses">
													
												</tr>
											</tbody>
											<tfoot>
												<tr id="tfoot">
													
												</tr>
											</tfoot>				
										</table>
									</div>
								</div>			
								

							

								<br><br>
								
								<h4 class="title-c m-tb-40">Unidad Ejecutora</h4>
								<br><br>
					
								<div class="row">

								<?php if (isset($ucontrata)): ?>								

										<div class="form-group col-md-6">
											<label for="unicontra">Unidad de Contratación</label>
											<input type="text" class="form-control" id="unicontra" name="unicontra" value="<?=$ucontrata[0]['vafnom'];?>">
										</div>

										<div class="form-group col-md-6">
											<label for="ubicacion">Ubicación</label>
											<input type="text" class="form-control" id="ubicacion" name="ubicacion" value="<?=$ucontrata[1]['vafnom'];?>">
										</div>
								
								<?php endif ?>								
									<div class="form-group col-md-6">
										<label for="nombreR">Nombre del solicitante</label>
										<select id="nombreR" name="nombreR" class="form-control form-control-sm" style="padding: 0px;" >
											<?php foreach ($ordgas as $ord){ ?>
												<option value="<?=$ord['perid'];?>" <?php if($pf2['resp'] && $ord['perid']==$pf2['resp']) echo " selected ";?>>
													<?=$ord['pernom'].' '.$ord['perape']." (".$ord['valnom'].")";?>
												</option>								
											<?php } ?>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="norgas">Ordenador del gasto</label>
										<select id="norgas" name="norgas" class="form-control form-control-sm" onchange="" style="padding: 0px;" >	
											<?php foreach ($ordgas2 as $ord){ ?>
												<option value="<?=$ord['perid'];?>"  <?=isset($pf2) &&  ($ord['perid'])== $pf2['ordgas'] ? ' selected ' : ''; ?>><?=$ord['pernom']." ".$ord['perape']." (".$ord['valnom'].")";?></option>
											<?php } ?>
										</select>
									</div>

									<div class="form-group col-md-6">
										<label for="idpro">Proceso CDP:</label>
										<select id="idpro" name="idpro" class="form-control form-control-sm" onchange="" style="padding: 0px;">
											<?php foreach ($pcdp as $pcd){ ?>
												<option value="<?=$pcd['idpro'];?>" <?php if($pf2['idpro'] && $pcd['idpro']==$pf2['idpro']) echo " selected ";?>>
													<?=$pcd['nompro'];?>
												</option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>	

							<div class="row" style="opacity: 0; width: 0px; height: 0px;">
								<div class="col-md-3 text-center">
									<button id="btnsolicitar" class="btn-secondary-canalc">Solicitar</button>
								</div>			
							</div>

							<div class="row">
								<div class="col-md-3 text-center">
									<button type="submit" name="boton" class="btn-secondary-canalc" value="modificar">Modificar</button>
								</div>

								<div class="col-md-3 text-center">
									<button type="submit" name="boton" class="btn-secondary-canalc" value="duplicar">Duplicar</button>
								</div>
					<!-- <div class="col-md-3 text-center">
						<button class="btn-primary-ccapital">Nuevo</button>
					</div>
					<div class="col-md-3 text-center">
						<button class="btn-primary-ccapital">Generar Certificado</button>
					</div>
					 -->
							</div>
						</form>

						<?php 

							$_SESSION['editAntp']=TRUE;

						 ?>

						<?php } ?>
					<?php elseif(isset($_SESSION['consultado']) && !isset($pfinandOne)): ?>


						<!--//***********************
					//NUEVO
					//***********************
					 -->



					 <?php if(isset($_SESSION['newpaa'])): ?>
					 	<?php unset($_SESSION['newpaa']); ?>
						<?//php foreach ($pfinandOne as $pf2){ ?>
							<h4 class="title-c m-tb-40">Agregar Registro</h4>
							<br><br>
							
							<form class="m-tb-40" action="<?=base_url;?>antproy/insAntep"  method="POST" >

								<div class="row">

									<div class="form-group col-md-4">
										<label for="areas">Areas</label>
										<?php if($_SESSION["pefid"]==21 OR $_SESSION["pefid"]==34){ ?>
											<?php $areas=Utils::areasu($_SESSION['consultado']); ?>
											<select id="areas" name="areas" class="form-control" style="padding: 0px;" >

												<?php $areas=Utils::areasu($_SESSION['consultado']); ?>	
												<?php foreach ($areas as $pf){ ?>
													

													<option value="<?=$pf['valid'];?>" <?=$pf['valid']==$_SESSION['depid'] ? ' selected ' : ''; ?>>
														<?=$pf['valnom'];?>
														
													</option>								
													
												<?php } ?>
											</select>
										<?php }else{ ?>
											<input type="hidden" name="areas" value="<?=$_SESSION['depid'];?>">
											<input type="text" class="form-control" value="<?=$_SESSION['nomarea'];?>" readonly>
										<?php } ?>

										
										
									</div>

								
									<div class="form-group col-md-4">
										<label for="codUNSPSC">Cod. UNSPSC</label>
										<input type="text" class="form-control" id="codUNSPSC" name="codUNSPSC" required="" value="<?=isset($pf2) && $pf2['unspsc'] ? $pf2['unspsc'] : '' ;?>">

									</div>
									<div class="form-group col-md-4">
										<label for="rubroPre"> Rubro Presupuestal</label>
										<input type="number" class="form-control" id="rubroPre" name="rubroPre" value="<?=$ninipaa.$pf2['codrub'];?>" readonly>

									</div>
									<div class="form-group col-md-12">
										<label for="nombreRubro">Nombre Rubro Presupuestal</label>
										<input type="text" class="form-control" id="nombreRubro" name="nombreRubro" readonly="">

									</div>
									<div class="form-group col-md-12">
										<label for="nomcont">Nombre Contratista</label>
										<input type="text" class="form-control" id="nomcont" name="nomcont">
									</div>
									<div class="form-group col-md-12">
										<label for="objeto">Objeto/Descripción</label>
										<textarea class="form-control" id="objeto" name="objeto" rows="4" required=""></textarea>
									</div>

									

									<?php if($_SESSION["pefid"]==21 OR $_SESSION["pefid"]==34){ ?>
										<div class="form-group col-md-12">
											<label for="objdpa">Objetivo</label>							

											<select id="objdpa" name="objdpa" class="form-control form-control-sm" style="padding: 0px;" >	
												<?php foreach ($objetivos as $dat){ ?>
													<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) && $pf2['objdpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
												<?php } ?>
											</select>
										</div>
									<?php }else{ ?>
										<input type="hidden" name="objdpa" value="36">
									<?php } ?>

									<?php if($_SESSION["pefid"]==21 OR $_SESSION["pefid"]==34){ ?>
										<div class="form-group col-md-12">
											<label for="inidpa">Iniciativa</label>
											<select id="inidpa" name="inidpa" class="form-control form-control-sm" style="padding: 0px;" >	
												<?php foreach ($iniciativas as $dat){ ?>
													<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['inidpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
												<?php } ?>
											</select>
										</div>
									<?php }else{ ?>
										<input type="hidden" name="inidpa" value="83">
									<?php } ?>

									<?php if($_SESSION["pefid"]==21 OR $_SESSION["pefid"]==34){ ?>
										<div class="form-group col-md-12">
											<label for="prodpa">Proyecto</label>
											<select id="prodpa" name="prodpa" class="form-control form-control-sm" style="padding: 0px;" >	
												<?php foreach ($proyectos as $dat){ ?>
													<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['prodpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
												<?php } ?>
											</select>
										</div>
									<?php }else{ ?>
										<input type="hidden" name="prodpa" value="418">
									<?php } ?>

									<div class="form-group col-md-6">
										<label for="fechaInicio">Fecha Estimada de Inicio</label>
										<input type="date" class="form-control" id="fechaInicio" name="fechaInicio" onchange="asigmes()" value="<?=$pf2['fecinidpa'];?>">
									</div>

									<div class="form-group col-md-6">
										<label for="fechaEstimada">Fecha Estimada Final</label>
										<input type="date" class="form-control" id="fechaEstimada" name="fechaEstimada" onchange="asigmes()" value="<?=$pf2['fecfindpa'];?>">
									</div>

									<div class="form-group col-md-4">
										<label for="valorAsignado">Valor Asignado</label>
										<input type="text" class="form-control" id="valorAsignado" name="valorAsignado" onkeyup="asigmes()" onchange="asigmes()" value="">
									</div>
									<div class="form-group col-md-4">
										<label for="valorVigencia">Valor Vigencia Actual</label>
										<input type="number" class="form-control" id="valorVigencia" name="valorVigencia" value="">
									</div>
									<div class="col-md-4">
										<label for="#">Requiere vigencia Futura</label>
										<!-- <div class="form-check">
											<input class="form-check-input" type="radio" name="vigenciaF" id="SI" value="SI">
											<label class="form-check-label" for="SI">
												SI
											</label>
										</div> -->
										<div class="form-check">
											<input class="form-check-input" type="radio" name="vigenciaF" id="NO" value="NO" checked>
											<label class="form-check-label" for="NO">
												NO
											</label>
										<!-- <div class="form-check">
											<input class="form-check-input" type="radio" name="vigenciaF" id="SI" value="SI"
												<?=isset($pf2) && $pf2['reqvigf'] == "SI" ? ' checked' : ''; ?>>
											<label class="form-check-label" for="SI">
												SI
											</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="vigenciaF" id="NO" value="NO" <?=isset($pf2) &&  $pf2['reqvigf'] == "NO" ? ' checked' : ''; ?>>
											<label class="form-check-label" for="NO">
												NO
											</label> -->
										</div>
									</div>

									<!-- ALERTA -->
									<div class="col-md-12">
										<div id="alertdisponible" class="alert alert-danger" role="alert" style="display: none;">							
										  <div>
										    &nbsp;&nbsp; Recuerde que no puede exceder el valor disponible!!
										  </div>
										 
										</div>
									</div>

									<!-- FIN ALERTA -->

									<div class="form-group col-md-3">
										<label for="duracion">Número de Pagos</label>
										<input type="number" class="form-control" id="duracion" name="duracion" onkeyup="asigmes()" onchange="asigmes()" value="" readonly="">
									</div>



									<div class="form-group col-md-3">
										<label for="primerm">Valor Primer mes</label>
										<input type="number" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="primerm" name="primerm" value="" >
									</div>

									<div class="form-group col-md-3">
										<label for="ultimom">Valor último mes</label>
										<input type="number" onkeyup="asigmes()" onchange="asigmes()" class="form-control" id="ultimom" name="ultimom" value="">
									</div>	

									<div class="form-group col-md-3">
										<label for="valormensual">Valor mensual prom.</label>
										<input type="number" class="form-control" id="valormensual" name="valormensual" value=""  readonly="">
									</div>								

									<div class="form-group col-md-4">
										<label for="tipcondpa">Modalidad</label>
										<select id="tipcondpa" name="tipcondpa" class="form-control form-control-sm" style="padding: 0px;" >	
											<?php foreach ($tipocontra as $dat){ ?>
												<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['tipcondpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
											<?php } ?>
										</select>
									</div>

									<div class="form-group col-md-4">
										<label for="ftefindpa">Fuente de Recursos</label>
										<select id="ftefindpa" name="ftefindpa" class="form-control form-control-sm" onchange="javascript:ovif(this.value);" style="padding: 0px;" >	
											<?php foreach ($fuentes as $dat){ ?>
												<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ftefindpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
											<?php } ?>
										</select>
									</div>

									<div class="form-group col-md-4" id="vif">
										<label for="futic">Resolución FUTIC</label>
										<select id="futic" name="futic" class="form-control form-control-sm" style="padding: 0px;" >	
											<?php foreach ($futic as $dat){ ?>
												<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ftefindpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
											<?php } ?>
										</select>
									</div>								

									<br>
									<br>



									<!--
									//*******************
									//AJAX FUTIC**********
									//*****************
									-->

									<!-- <script type="text/javascript">
										$(document).ready(function()
										{  
										 // function to get all records from table
										 function getAll(){
										  
										  $.ajax
										  ({
										   url: '<?=base_url;?>antproy/ajaxFutic&action1=showAll',
										   data: 'action1=showAll',
										   type : 'post',
										   //cache: false,
										   success: function(r)
										   {
										    $("#display2").html(r);
										   }
										  });   
										 }
										 
										 getAll();
										 // function to get all records from table
										 
										 
										 // code to get all records from table via select box
										 $("#ftefindpa").change(function()
										 {    
										  var id = $(this).find(":selected").val();

										  var dataString = 'action1='+ id;
										    
										  $.ajax
										  ({

										   data: dataString,
										   url: '<?=base_url;?>antproy/ajaxFutic&action1='+ dataString,
										   
										   cache: false,
										   success: function(r)
										   {
										    $("#display2").html(r);
										   } 
										  });
										 })
										 // code to get all records from table via select box
										});
									</script>
 -->


									<!--
									//*******************
									//FIN AJAX FUTIC**********
									//*****************
									-->

								</div>

									<h4 class="title-c m-tb-40">Proyección de Inversión</h4>
									<br>
									<br>

									<div class="table-responsive">
										<table id="example2" class="table table-striped table-bordered " style="width:100%; font-size: 15px;">
											<thead>
												<tr id="tmeses">
													
												</tr>						
											</thead>
											<tbody>
												<tr id="tvmeses">
													
												</tr>
											</tbody>
											<tfoot>
												<tr id="tfoot">
													
												</tr>
											</tfoot>				
										</table>
									</div>							
								

								</div>

								<br><br>
								
								<h4 class="title-c m-tb-40">Unidad Ejecutora</h4>
								<br><br>
					
								<div class="row">

								<?php if (isset($ucontrata)): ?>								

										<div class="form-group col-md-6">
											<label for="unicontra">Unidad de Contratación</label>
											<input type="text" class="form-control" id="unicontra" name="unicontra" value="<?=$ucontrata[0]['vafnom'];?>">
										</div>

										<div class="form-group col-md-6">
											<label for="ubicacion">Ubicación</label>
											<input type="text" class="form-control" id="ubicacion" name="ubicacion" value="<?=$ucontrata[1]['vafnom'];?>">
										</div>
								
								<?php endif ?>								


									<div class="form-group col-md-6">
										<label for="nombreR">Nombre del solicitante</label>
										<select id="nombreR" name="nombreR" class="form-control form-control-sm" style="padding: 0px;" >
											<?php foreach ($ordgas as $ord){ ?>
												<option value="<?=$ord['perid'];?>">
													<?=$ord['pernom'].' '.$ord['perape'];?>
												</option>								
											<?php } ?>
										</select>
									</div>

									<div class="form-group col-md-6">
										<label for="norgas">Ordenador del gasto</label>
										<select id="norgas" name="norgas" class="form-control form-control-sm" onchange="" style="padding: 0px;" >	
											<?php foreach ($ordgas2 as $ord){ ?>
												<option value="<?=$ord['perid'];?>"  <?=isset($pf2) &&  ($ord['perid'])== $pf2['ordgas'] ? ' selected ' : ''; ?>><?=$ord['pernom']." ".$ord['perape'];?></option>
											<?php } ?>
										</select>
									</div>

									<div class="form-group col-md-6">
										<label for="idpro">Proceso CDP:</label>
										<select id="idpro" name="idpro" class="form-control form-control-sm" onchange="" style="padding: 0px;">
											<?php foreach ($pcdp as $pcd){ ?>
												<option value="<?=$pcd['idpro'];?>">
													<?=$pcd['nompro'];?>
												</option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>	

							<div class="row">
								<div class="col-md-3 text-center">
									<button class="btn-secondary-canalc">Registrar</button>
								</div>
								<div class="row" style="opacity: 0; width: 0px; height: 0px;">
									<div class="col-md-3 text-center">
										<button id="btnsolicitar" class="btn-secondary-canalc">Solicitar</button>
									</div>			
								</div>
								<!-- <div class="col-md-3 text-center">
									<button class="btn-primary-ccapital">Nuevo</button>
								</div>
								<div class="col-md-3 text-center">
									<button class="btn-primary-ccapital">Generar Certificado</button>
								</div>
								 -->
							</div>
						</form>

						<?php endif; ?>	
						
			

					 <!--//***********************
					//FIN NUEVO
					//***********************
					 -->

						

					<?php endif; ?>



				<!--//***********************
					//FIN EDITAR ANTEPROYECTO
					//***********************
					 -->
		</div> 

		<script>
			$(document).ready(function(){
				//alert('pp');
				//asigmes();
				
			})
		</script>


	<?php // } ?>


				
				

