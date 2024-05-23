	<!-- Insertar o Editar datos -->
	<?php //echo Utils::tit("","fa fa-list","reso/index&norad=$norad","300px"); ?>

<h2 class="title-c">Seguimiento <?=$datrad[0]['tip'];?> No. <?=$datrad[0]['consecutivo'];?></h2>
<br><br>


<!-- ---------------------------------------- Encabezado de contrato --------------------------------------------------- -->

<?php if ($datrad){
	foreach ($datrad as $val){ ?>
	<?php $estil= 'active'; ?>
	<?php $url_action2 = base_url."radica/save&norad=$norad&tipo=".$t2;
	?>
	<?php $url_act2 = base_url."radica/index"; ?>
	
	<form class="m-tb-40" action="<?=$url_action2?>" method="POST" enctype="multipart/form-data">
		<div class="row">
			<input type="hidden" name="norad" value="<?=isset($val) ? $val['norad'] : ''; ?>"/>
			<div class="form-group col-md-12" id="go1">
				<label for="asurad">Asunto</label>
				<input type="text" class="form-control form-control-sm" id="asurad" name="asurad" value="<?=isset($val) ? $val['asurad'] : ''; ?>" />
			</div>
			<?php if($t2==602 OR $t2==603){ ?>
				<div class="form-group col-md-6" id="go1">
					<label for="nomrad">Dirigido a</label>
					<?php if($t2==602){ ?>
						<?php $crd = explode(",", $val['nomrad']); ?>
						<select class="form-control form-control-sm" style="padding: 0px;max-height: none;" id="nomrad" name="nomrad[]"  multiple="multiple" >
						<?php 
						if($personPlan){
							foreach ($personPlan as $do){ ?>
								<option value="<?=$do['perid'];?>" 
			                	<?php 
			                	foreach ($crd as $cr) {
			                		if(isset($val) && $do['perid']==$cr){
			                			echo ' selected ';
			                			break;
			                		}
			                	}
			                	?>
			                	><?=$do['pernom']." ".$do['perape'];?>
			                	</option>


				                <!-- <option value="<?=$do['perid'];?>" 
				                	<?=isset($val) && $do['perid']==$val[0]['nomrad'] ? ' selected ' : ''; ?>><?=$do['pernom']." ".$do['perape']." - ".$do['carg'];?>
				                </option> -->
				            
				        <?php }} ?>
				        </select>
				    <?php }else{ ?>
				    	<input type="text" class="form-control form-control-sm" id="nomrad" name="nomrad[]" value="<?=isset($val) ? $val['nomrad'] :''; ?>" />
				    <?php } ?>

<!--
				<?php $crd = explode(",", $val['coprad']); ?>
				<select class="form-control form-control-sm" style="padding: 0px;max-height: none;" id="coprad" name="coprad[]" multiple="multiple" >
				<?php 
				if($person){
					foreach ($person as $do){ ?>
		                <option value="<?=$do['perid'];?>" 
		                	<?php 
		                	foreach ($crd as $cr) {
		                		if(isset($val) && $do['perid']==$cr){
		                			echo ' selected ';
		                			break;
		                		}
		                	}
		                	?>
		                ><?=$do['pernom']." ".$do['perape'];?>
		                </option>
		            
		        <?php }} ?>
		        </select>
-->				    
				</div>
			<?php } ?>
			<?php if($t2==601){ ?>
				<div class="form-group col-md-6">
					<label for="carrad">Cargo</label>
					<select class="form-control form-control-sm" style="padding: 0px;" id="carrad" name="carrad"  >
					<?php 
					if($getVal){
						foreach ($getVal as $do){ ?>
			                <option value="<?=$do['valid'];?>" 
			                	<?=isset($val) && $do['valid']==$val['carrad'] ? ' selected ' : ''; ?>><?=$do['valnom'];?>
			                </option>
			            
			        <?php }} ?>
			        </select>
				</div>
			<?php } ?>
			<?php if($t2==603){ ?>
				<div class="form-group col-md-6">
					<label for="carrad">Cargo</label>
					<input type="text" class="form-control form-control-sm" id="carrad" name="carrad" value="<?=isset($val) ? $val['carrad'] : ''; ?>" />
				</div>
			<?php } ?>
			<?php if($t2==601 OR $t2==603){ ?>
				<div class="form-group col-md-6" id="go1">
					<label for="emprad">Empresa</label>
					<input type="text" class="form-control form-control-sm" id="emprad" name="emprad" value="<?=isset($val) ? $val['emprad'] : ''; ?>" />
				</div>
			<?php } ?>
			<?php if($t2==601 OR $t2==603){ ?>
				<div class="form-group col-md-6" id="go1">
					<label for="dirrad">Dirección</label>
					<input type="text" class="form-control form-control-sm" id="dirrad" name="dirrad" value="<?=isset($val) ? $val['dirrad'] : ''; ?>" />
				</div>
			<?php } ?>
			<?php if($t2==601 OR $t2==603){ ?>
				<div class="form-group col-md-6" id="go1">
					<label for="posrad">Código postal</label>
					<input type="text" class="form-control form-control-sm" id="posrad" name="posrad" value="<?=isset($val) ? $val['posrad'] : ''; ?>" />
				</div>
			<?php } ?>
			<div class="form-group col-md-6" id="go2">
				<label for="adjrad">Anexos</label>
				<textarea class="form-control form-control-sm" id="adjrad" name="adjrad"><?=isset($val) ? $val['adjrad'] : ''; ?></textarea>
			</div>
			<?php if($t2==602 OR $t2==603){ ?>
				<!-- <div class="form-group col-md-6" id="go2">
					<label for="cuerad">Contenido</label>
					<textarea class="form-control form-control-sm" id="cuerad" name="cuerad"><?=isset($val) ? $val['cuerad'] : ''; ?></textarea>
				</div> -->

				<!-- Agrega el editor de texto en linea INICIO Forma 1 -->
				  <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
				  <div class="form-group col-md-12">
				  	<label for="editor">Contenido</label>
				  	<?php $mdtxt = isset($val) ? $val['cuerad']:""; ?>
					<textarea id="editor" name="cuerad"><?=$mdtxt;?></textarea>
				    <script>
				            ClassicEditor
				                    .create( document.querySelector( '#editor' ) )
				                    .then( editor => {
				                            console.log( editor );
				                    } )
				                    .catch( error => {
				                            console.error( error );
				                    } );
				    </script>
				  </div>
				<!-- Agrega el editor de texto en linea FIN Forma 1 -->

			<?php } ?>
			<?php if($t2==601){ ?>
				<div class="form-group col-md-6" id="go3">
					<label for="orirad">Origen Documento</label>
					<input type="text" class="form-control form-control-sm" id="orirad" name="orirad" value="<?=isset($val) ? $val['orirad'] : ''; ?>"  />
				</div>
			<?php } ?>
			<div class="form-group col-md-6" id="go1">
				<label for="firrad">Firma Documento</label>
				<?php if($t2==601){ ?>
					<input type="text" class="form-control form-control-sm" id="firrad" name="firrad" value="<?=isset($val) ? $val['firrad'] : ''; ?>"  />
			    <?php } ?>
				<?php if($t2==602 OR $t2==603){ ?>
					<select class="form-control form-control-sm" style="padding: 0px;" id="firrad" name="firrad"  >
						<?php 
						if($personPlan){
							foreach ($personPlan as $do){ ?>
				                <option value="<?=$do['perid'];?>" 
				                	<?=isset($val) && $do['perid']==$val['firrad'] ? ' selected ' : ''; ?>><?=$do['pernom']." ".$do['perape']." - ".$do['carg'];?>
				                </option>
				            
				        <?php }} ?>
			        </select>
			    <?php } ?>
			</div>
			<div class="form-group col-md-6" id="go4">
				<label for="folrad">No. Folios</label>
				<input type="number" class="form-control form-control-sm" id="folrad" name="folrad" value="<?=isset($val) ? $val['folrad'] : '1'; ?>"  />
			</div>
			<?php if($t2==601 OR $t2==602){ ?>
				<div class="form-group col-md-6" id="go1">
					<label for="areprorad">
					<?php if($t2==601){ ?>Área asignada<?php } ?>
					<?php if($t2==602){ ?>Área que proyecta<?php } ?>
					</label>
					
					<select class="form-control form-control-sm" style="padding: 0px;" id="areprorad" name="areprorad"  >
					<?php 
					if($areas){
						foreach ($areas as $do){ ?>
			                <option value="<?=$do['valid'];?>" 
			                	<?=isset($val) && $do['valid']==$val['areprorad'] ? ' selected ' : ''; ?>><?=$do['valnom'];?>
			                </option>
			            
			        <?php }} ?>
			        </select>
				</div>
			<?php } ?>
			<?php if($t2==601){ ?>
				<div class="form-group col-md-6" id="go2">
					<label for="noradext">No. Radicación Externo</label>
					<input type="text" class="form-control form-control-sm" id="noradext" name="noradext" value="<?=isset($val) ? $val['noradext']:''; ?>" >
				</div>
			<?php } ?>
			<?php if($t2==601 OR $t2==603){ ?>
				<div class="form-group col-md-6">
					<label>Departamento</label>
					<select name="depto" class="form-control form-control-sm" style="padding: 0px;" onChange="javascript:recCiudad(this.value);">
						<option value=0>Seleccione Departamento</option>
						<?php 
						if($muni){
							foreach ($muni as $do){ ?>
				                <option value="<?=$do['ubiid'];?>" 
				                	><?=$do['ubinom'];?>
				                </option>
				            
				        <?php }} ?>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label for="ubiid">Municipio</label>
					<div id="reloadMun">
						<select class="form-control" style="padding: 0px;" id="ubiid" name="ubiid"  >
			                <option value="<?=isset($val) ? $val['ubiid']:0;?>"><?=isset($val) ? $val['ubinom']:'Seleccione un departamento';?></option>
				        </select>
					</div>
				</div>
			<?php } ?>
			<?php //if($t2==601){ ?>
				<!-- <div class="form-group col-md-6" id="go2">
					<label for="chkrad">Entregado</label>
					<input type="checkbox" class="form-control form-control-sm" id="chkrad" name="chkrad" value="<?php if(isset($val) && $val['chkrad']==1) echo '1'; else echo '2'; ?>" <?php if(isset($val) && $val['chkrad']==1) echo 'checked'; ?>>
				</div> -->
			<?php //} ?>
			<div class="form-group col-md-6" id="go2">
				<label for="coprad">Con copia a:</label>
				<?php $crd = explode(",", $val['coprad']); ?>
				<select class="form-control form-control-sm" style="padding: 0px;max-height: none;" id="coprad" name="coprad[]" multiple="multiple" >
				<?php 
				if($person){
					foreach ($person as $do){ ?>
		                <option value="<?=$do['perid'];?>" 
		                	<?php 
		                	foreach ($crd as $cr) {
		                		if(isset($val) && $do['perid']==$cr){
		                			echo ' selected ';
		                			break;
		                		}
		                	}
		                	?>
		                ><?=$do['pernom']." ".$do['perape'];?>
		                </option>
		            
		        <?php }} ?>
		        </select>
			</div>
			<?php if($t2==602){ ?>
				<div class="form-group col-md-6" id="go3">
					<label for="noradcon">No. Memorando que contesta</label>
					<input type="text" class="form-control form-control-sm" id="noradcon" name="noradcon" value="<?=isset($val) ? $val['noradcon'] : ''; ?>"  />
				</div>
			<?php } ?>
			<div class="form-group col-md-6" id="go3">
				<br>
				<input type="checkbox" class="form-control form-control-sm" id="mfirrad" name="mfirrad" style="width: 50px;display: inline-block;" <?php if(isset($val) && $val['mfirrad']==1) echo 'checked'; ?> />
				<label for="mfirrad">
					Mostrar Firma
					<br><small><small><small><small><small>&nbsp;</small></small></small></small></small>
				</label>
			</div>
			<?php if($t2==603){ ?>
				<div class="form-group col-md-6" id="go3">
					<br>
					<input type="checkbox" class="form-control form-control-sm" id="oficot" name="oficot" style="width: 50px;display: inline-block;" <?php if(isset($val) && $val['oficot']==1) echo 'checked'; ?> />
					<label for="oficot">
						Cotización
						<br><small><small><small><small><small>&nbsp;</small></small></small></small></small>
					</label>
				</div>
			<?php } ?>
			<?php if($_SESSION['pefid']==6){ ?>
				<div class="form-group col-md-6">
					<input type="submit" class="btn-primary-ccapital" value="Actualizar">
				</div>
			<?php } ?>
		</div>
	</form>
	
	<?php 
		if($docume){
			foreach($docume as $d){ ?>
				<div style="display: inline-block;text-align: center; margin: 20px 0px;">
					<a href="<?=path_filem.$d['docruta'];?>" target="_blank">
						<i class="fa fa-file-text fa-2x"></i><br>
						<?=$d['doctitu'];?>
					</a>
					<?php if($d['perid']==$_SESSION['perid']){ ?>
					<br>
					<a href="<?=$url_act2;?>&ope=eldc&docid=<?=$d['docid'];?>" onclick="return elidoc('<?=$d['doctitu'];?>');" title="Eliminar doc.: <?=$d['doctitu'];?>">
						<i class="fa fa-times-circle btndeldoc"></i>
					</a>
				<?php } ?>
				</div>
	<?php }}}
}else{ ?>
    <center><h5>No existen resultados</h5></center><br><br>
<?php } ?>


	<div id="inser">

		<?php 
		// var_dump($edit);
		// var_dump($val);

		if(isset($edit) && isset($datrad)): ?>
			<h2 class="title-c m-tb-40">Ver Seguimiento</h2>
			<?php $url_action = base_url."radica/savrr&norad=$norad"; ?>
			
		<?php else: ?>
			<h2 class="title-c m-tb-40">Nuevo Seguimiento</h2>
			<?php $url_action = base_url."radica/savrr&norad=$norad"; ?>
		<?php endif; ?>
<br><br>
		<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
			<div class="row">
				<input type="hidden" name="norad" value="<?=isset($norad) ? $norad: ''; ?>"/>
				<div class="form-group col-md-6" id="go1">
					<label for="estrad">Estado</label>
					<select class="form-control" name="estrad" style="height: 42px;">
					<?php if($esta){
						foreach ($esta as $est) { ?>
							<option value='<?=$est['valid'];?>'><?=$est['valnom'];?></option>
					<?php	}
					} ?>
					</select>
				</div>
				<div class="form-group col-md-6" id="go2">
					<label for="obsres">Observación</label>
					<textarea name="obsres" id="obsres" class="form-control"></textarea>
				</div>
				<?php if($t2==602){ ?>
<!-- 					<div class="form-group col-md-6" id="go3">
						<input type="checkbox" class="form-control form-control-sm" id="mfirrad" name="mfirrad" style="width: 50px;display: inline-block;" <?php if(isset($val) && $val['mfirrad']==1) echo 'checked'; ?> />
						<label for="mfirrad">
							Firmar documento y Aprobar
							<br><small><small><small><small><small>&nbsp;</small></small></small></small></small>
						</label>
					</div> -->

					<?php if($datFir){ foreach($datFir AS $df){ ?>
						<div class="form-group col-md-3" id="go3">
							<input type="radio" class="form-control form-control-sm" id="visres" name="visres" value="<?=$df['valid'];?>" style="width: 50px;display: inline-block;" <?php if($df['valid']==31) echo "checked";?> />
							<label for="visres">
								<?=$df['valnom'];?>
								<br><small><small><small><small><small>&nbsp;</small></small></small></small></small>
							</label>
						</div>
					<?php }} ?>
				<?php } ?>
				<div class="form-group col-md-6" id="go2">
					<label for="coprad">Dirigir a:</label>
					<?php $crd = explode(",", $val['coprad']); ?>
					<select class="form-control form-control-sm" style="padding: 0px;max-height: none;" id="coprad" name="coprad[]" multiple="multiple" >
					<?php 
					if($person){
						foreach ($person as $do){ ?>
			                <option value="<?=$do['perid'];?>" 
			                	<?php 
			                	foreach ($crd as $cr) {
			                		if(isset($val) && $do['perid']==$cr){
			                			echo ' selected ';
			                			break;
			                		}
			                	}
			                	?>
			                ><?=$do['pernom']." ".$do['perape'];?>
			                </option>
			            
			        <?php }} ?>
			        </select>
				</div>
				<div class="form-group col-md-6" id="go2">
					<br><br><input type='submit' value='Registrar' class='btn btn-success'>
				</div>
			</div>
		</form>
	</div>
<!-- Ver datos -->



	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Fecha</th>
	                <th>Respuestas</th>
	                <?php if($t2==602){ ?><th>Cambiar...</th><?php } ?>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($datasi)){
	        		$nt = 0;
	        		foreach ($datasi as $va){ ?>
		            <tr>
		            	<td style="text-align: center">
	                        <small>
                        		<?=$va['fecres'];?>
                        		<br>
	                        	<strong>
	                        		<!-- <big><?=$va['valnom'];?></big>
	                        		<br> -->
	                        		<!-- Días Hab.  -->
	                        		<?php 
	         //                			date_default_timezone_set('America/Bogota');
										// $fec1 = new DateTime(substr($va['fecres'],0,10));
										// $fecha = isset($datasi[$nt+1]['fecres']) ? $datasi[$nt+1]['fecres']:date("Y-m-d");
										// $fec2 = new DateTime($fecha);
										// $fec3 = substr($va['fecres'],0,10);
	         //                			echo Utils::getDiasHabiles($fec3, $fecha, $fes);
	         //                			$nt++;
	                        		?>
	                        	</strong>
	                        </small>
		                </td>
		                <td>
		                	<strong>Observación: </strong><?=$va['obsres'];?><?php if($t2==602){ ?>&nbsp;&nbsp;&nbsp;<strong><?=$va['vist'];?></strong><?php } ?><br>
							<small>
								<strong>Registrado por: </strong><?=strtoupper($va['pernom']).' '.strtoupper($va['perape']);?>
								<br>
								<strong>E-mail: </strong><?=strtolower($va['peremail']);?>
								<br>
	                        	<strong>Estado:</strong> <?=$va['est'];?>
	                        	
								<!-- <br>
	                        	<strong>Proceso:</strong> <?=$va['nompro'];?>
	                        	<br>
	                        	<strong>Flujo:</strong> <?=$va['actflu'];?> -->
	                        </small>
		                </td>
		                <?php if($t2==602){ ?><td>
		                <form action="<?=base_url."radica/savevb";?>" method="POST">
		                	<select class="form-control form-control-sm" style="padding: 0px;max-height: none;" id="visres" name="visres"  onchange="this.form.submit();">
			                	<?php if($datFir){ foreach($datFir AS $df){ ?>
			                		<option value="<?=$df['valid'];?>" <?php if(isset($val) && $df['valid']==$va['visres']) echo ' selected '; ?>><?=$df['valnom'];?></option>
								<?php }} ?>
							</select>
							<input type="hidden" name="idres" value="<?=$va['idres'];?>">
							<input type="hidden" name="norad" value="<?=$va['norad'];?>">
						</form>
		                </td><?php } ?>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Fecha</th>
	                <th>Respuestas</th>
	                <?php if($t2==602){ ?><th>Cambiar...</th><?php } ?>
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