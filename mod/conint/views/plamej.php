<!-- Insertar o Editar datos -->
<?php if($_SESSION['pefid']==58 OR $_SESSION['pefid']==70){ ?>
<?php echo Utils::tit("Plan de Mejora","fa fa-cogs mr-3","plamej/index","300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Editar Plan de Mejora</h2>
		<?php $url_action = base_url."plamej/save&nopla=".$val[0]['nopla']; ?>
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nuevo Plan de Mejora</h2>
		<?php $url_action = base_url."plamej/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<div class="row">
			<input type="hidden" name="nopla" value="<?=isset($val) ? $val[0]['nopla'] : ''; ?>"/>
			<div class="form-group col-md-12">
				<label for="fuepla">Fuente de la Observación y/o hallazgo <small>(Seleccione de la lista desplegable)</small></label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="fuepla" name="fuepla"  >
				<?php 
				if($datfuet){
					foreach ($datfuet as $dft){ ?>
		                <option value="<?=$dft['valid'];?>" 
		                	<?=isset($val) && $dft['valid']==$val[0]['fuepla'] ? ' selected ' : ''; ?>><?=$dft['valnom'];?>
		                </option>
		            
		        <?php }} ?>
		        </select>
		    </div>
		    <div class="form-group col-md-6">
				<label for="detfue">Detalle de la fuente <br><small>(Nombre completo del informe origen de la observación y/o hallazgo)</small></label>
				<textarea class="form-control form-control-sm" id="detfue" name="detfue"><?=isset($val) ? $val[0]['detfue']:''; ?></textarea>
		    </div>
		    		    <div class="form-group col-md-6" id="go1">
				<label for="areapla">Áreas<br><small>(Ctrl + Click para más de una área)</small></label>
				<?php
					if(isset($val) AND $val[0]['areapla']){
						$rvare = explode(";", $val[0]['areapla']);
						array_unshift($rvare,"--");
					}
				?>
				<select class="form-control form-control-sm" style="padding: 0px;max-height: none;" id="areapla" name="areapla[]"  multiple="multiple">
					<?php 
					if($areasT){
						foreach ($areasT as $do){ ?>
							<?php 
								if(isset($val) AND $val[0]['areapla'])
									$pos = array_search($do['valid'], $rvare);
								else
									$pos = NULL;
							?>
			                <option value="<?=$do['valid'];?>" 
			                	<?=isset($val) && $val[0]['areapla'] && $pos ? ' selected ' : ''; ?>><?=$do['valnom'];?>
			                </option>
			            
			        <?php }} ?>
			    </select>
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="fobspla">Fecha de la observación y/o hallazgo</label>
				<input type="date" class="form-control form-control-sm" id="fobspla" name="fobspla" value="<?php if($val AND $val[0]['fobspla']<>'0000-00-00 00:00:00') echo substr($val[0]['fobspla'],0,10); else echo $hoy; ?>" />
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="cappla">Código o capítulo <small>(Identificación de la obs. y/o hallazgo, en el informe)</small></label>
				<input type="text" class="form-control form-control-sm" id="cappla" name="cappla" value="<?=isset($val) ? $val[0]['cappla']:""; ?>" />
			</div>
			<div class="form-group col-md-12">
				<label for="obspla">Observación y/o Hallazgo detectado <small>(Transcripción de la observación y/o hallazgo)</small></label>
				<textarea class="form-control form-control-sm" id="obspla" name="obspla"><?=isset($val) ? $val[0]['obspla']:''; ?></textarea>
		    </div>

<!-- // Inicio ////////////////////////////////////////////////////////// -->
			<div class="form-group col-md-6" id="go1">
				<label for="carlmej">Cargo del Líder proceso <!-- <small>(Seleccione de la lista desplegable)</small> --> </label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="carlmej" name="carlmej">
				<?php if($cargoLid){ foreach ($cargoLid as $do){ ?>
	                <option value="<?=$do['valid'];?>" 
	                	<?=isset($val) && $val[0]['carlmej']==$do['valid'] ? ' selected ':''; ?>><?=$do['valnom'];?>
	                </option>
			    <?php }} ?>
			    </select>
			</div>
<!-- // Fin//////////////////////////////////////////////////////////// -->
			<div class="form-group col-md-6">
				<input type="hidden" name="valid" value="<?=$valid;?>">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>
		</div>
	</form>
</div>
<?php } ?>
<!-- Ver datos -->

<h2 class="title-c">Planes de mejora</h2>
<?php $url_action2 = base_url."plamej/index"; ?>

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
				 <div class="form-group col-md-6" id="go1">
					<label for="areapla">Área</label>
					<?php
					// Verifica si $val está definido y si $val[0]['areapla'] existe para dividirlo en un array
					if (isset($val) && isset($val[0]['areapla'])) {
						$rvare = explode(";", $val[0]['areapla']);
					} else {
						$rvare = []; // Inicializa como un array vacío si no hay valores definidos
					}
					?>
					<select class="form-control form-control-sm" id="areapla" name="areapla[]" multiple="multiple" onChange="this.form.submit();" style="padding: 0px 5px;">
						<?php 
						if ($areasT) {
							foreach ($areasT as $do) {
								// Determina si la opción actual debe estar seleccionada
								$selected = in_array($do['valid'], $rvare) ? 'selected="selected"' : '';
								?>
								<option value="<?= $do['valid']; ?>" <?= $selected; ?>><?= $do['valnom']; ?></option>
							<?php }
						} ?>
					</select>
				</div>


				 
				<div class="form-group col-md-3" style="text-align: center;">
					<a href="<?=base_url?>views/pdftot.php?fil1=<?=$fil1;?>&fil2=<?=$fil2;?>&fil3=<?=$fil3;?>&ac=1&valid=3051" target="_blank" title="Imprimir Planes de Mejora">
			            <i class="fas fa-print fa-2x" style="color: #523178;margin-top: 30px;"></i>
			        </a>
			        <a href="<?=base_url?>views/csv.php?fil1=<?=$fil1;?>&fil2=<?=$fil2;?>&fil3=<?=$fil3;?>&ac=1&valid=3051" target="_blank" title="CSV Planes de Mejora">
			        	<i class="fa fa-download fa-2x" style="color: #523178;margin-top: 30px;"></i>
			        </a>
			    </div>
			</div>
		</form>
	</div>

	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
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
		            		<strong><?=str_pad($va['nopla'], 6, "0", STR_PAD_LEFT);?></strong>
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
	                            <?php if($va['ocpla']){ ?>
		                            </br></br>
	                            	<strong>Observación de Cierre: </strong><?=$va['ocpla'];?> (<?=$va['feciepla'];?>).
	                            <?php } ?>

	                            
		                        <?php if($va['carlmej']){ ?>
		                        	<small><br>
			                        <strong>Cargo Lider: </strong><?=$va['lid'];?>
			                        <?php 
			                        	$plamej->setCargo($va['carlmej']);
			                        	$datPL = $plamej->getPerCargo();
			                        	if($datPL){
			                        ?>
					                        <br>
					                        <?php if(!$va['perid']){ ?>
					                        	<strong>Aprueba: </strong> <?=$datPL[0]['pernom']." ".$datPL[0]['perape'];?> 
					                        <?php }else{ ?>
					                        	<strong>Aprobado: </strong> <?=$va['pernom']." ".$va['perape'];?> 
					                        <?php } ?>
					                         
					                        <?php if($va['perid']){ ?>
					                        	<?=$va['fecautpla'];?>
					                        <?php } ?>

					                <?php } ?>
			                        
			                    <?php } ?>

	                            <?php 
	                            $plamej->setNopla($va['nopla']);
	                            $CouAcc = $plamej->getCouAcc();
	                            if($CouAcc) $CouAcc = $CouAcc[0]['can'];
								$CouAct = $plamej->getCouAct();
								if($CouAct) $CouAct = $CouAct[0]['can'];
								$CouAva = $plamej->getCouAva();
								if($CouAva) $CouAva = $CouAva[0]['can'];
								$CouSeg = $plamej->getCouSeg();
								if($CouSeg) $CouSeg = $CouSeg[0]['can'];
								$DtSeg = $plamej->getDtSeg();
								$FfAcc = $plamej->getFfAcc();
	                            ?>

	                            <br><br><div class="titdtact"><span style="color: #4d3274;">
	                            <strong>No. Acciones:</strong> <?=$CouAcc." ";?>
	                            <strong>No. Actividades:</strong> <?=$CouAct." ";?>
	                            <strong>No. Avances:</strong> <?=$CouAva." ";?>
	                            <strong>No. Seguimientos:</strong> <?=$CouSeg." ";?>
	                            <!-- <?php if($CouAcc && $FfAcc){ ?>
	                            	<br><strong>F. Inicial por Acción:</strong> 
	                            	<?php foreach ($FfAcc as $fa) { ?>
	                            		<?=$fa['noacc'].". ".substr($fa['finimej'],0,10)."&nbsp;&nbsp;";?>
	                            	<?php } ?>
	                            <?php } ?> -->
	                            <!-- <?php if($CouAcc && $FfAcc){ ?>
	                            	<br><strong>F. Finales por Acción:</strong> 
	                            	<?php foreach ($FfAcc as $fa) { ?>
	                            		<?=$fa['noacc'].". ".substr($fa['ffinmej'],0,10)."&nbsp;&nbsp;";?>
	                            	<?php } ?>
	                            <?php } ?> -->
	                            <?php if($DtSeg){ ?>
		                            <br><strong>Fecha ultimo seguimiento:</strong> <?=$DtSeg[0]['fecseg']." ";?>
		                            <strong>Realizo seguimiento:</strong> <?=$DtSeg[0]['pernom']." ".$DtSeg[0]['perape']." ";?>
		                        <?php } ?>
	                        	</span></div>
	                        	</small>
	                        </small>
		                </td>
		                <td style="text-align: center;">
	                        <strong><?=$va['est'];?><br><?=$va['porpla'];?> %</strong>
		                </td>
		                <td style="text-align: center;width: 140px;">

		                	<?php 
	                			$plamej->setNopla($va['nopla']);
	                			$DtCaA = $plamej->getCouAccApr();
	                		?>
						<div class="btnajupl">
		                <?php if($CouAcc<>0){ ?>
		                	<?php if(!$va['perid'] AND ($_SESSION['pefid']==70 OR $_SESSION['pefid']==71 OR $_SESSION['pefid']==75)){
		                		$dtPerid = isset($datPL[0]['perid']) ? $datPL[0]['perid']:NULL;
		                	?>
		                		<?php if($dtPerid==$_SESSION['perid']){ 
		                			/*s$plamej->setNopla($va['nopla']);
		                			$DtCaA = $plamej->getCouAccApr();*/
		                			if($DtCaA AND $DtCaA[0]['can']==0){
		                		?>
				                		<a href= "<?=base_url;?>plamej/updPlmj&nopla=<?=$va['nopla'];?>&valid=3051">
				                			<i class="fa fa-check-circle fa-2x" title="Por aprobar" style="color: #f00;text-shadow: 1px 1px 1px #000;"></i>
				                			<br><span class="txtajupl">Por aprobar</span>
				                		</a>
				                	<?php }else{ ?>
				                		<i class="fa fa-check-circle fa-2x" title="Pendiente por aprobar acciones por CI" style="color: #f00;"></i>
	                					<br><span class="txtajupl">Pend. CI.</span>
				                	<?php } ?>
			                	<?php }elseif(!$va['carlmej']){ ?>
			                		<i class="fa fa-check-circle fa-2x" title="Sin cargo de lider asignado" style="color: #f00;"></i>
	                				<br><span class="txtajupl">Sin Cargo</span>
	                			<?php }else{ ?>
	                				<?php if($DtCaA AND $DtCaA[0]['can']==0){ ?>
	                					<i class="fa fa-check-circle fa-2x" title="Pendiente por aprobar del lider" style="color: #f00;"></i>
		                				<br><span class="txtajupl">Pend. Lider</span>
	                				<?php }else{ ?>
	                					<i class="fa fa-check-circle fa-2x" title="Pendiente por aprobar acciones por CI" style="color: #f00;"></i>
		                				<br><span class="txtajupl">Pend. CI.</span>
	                				<?php } ?>
			                	<?php } ?>
		                	<?php }elseif(!$va['perid']){ ?>
		                		<i class="fa fa-check-circle fa-2x" title="Por aprobar" style="color: #f00;"></i>
	                			<br><span class="txtajupl">Por aprobar</span>
	                		<?php }else{ ?>
	                			<?php if($_SESSION['pefid']==70){ ?>
	                				<a href= "<?=base_url;?>plamej/updDAplmj&nopla=<?=$va['nopla'];?>&valid=3051" onclick="return confirm('¿Está seguro de desaprobar este item? Tenga en cuenta que el proceso se inicia y las acciones se desaprueban para realizar ajustes, luego debe aprobar Control Interno, por último el líder debe aprobar para poder iniciar el seguimiento.');">
				                		<i class="fa fa-check-circle fa-2x" title="Haga Click para DESAPROBAR este item. El proceso vuelve a iniciar." style="color: #523178;text-shadow: 1px 1px 1px #f00, 0px 0px 3px #000;"></i>
				                		<br><span class="txtajupl">Aprobado</span>
				                	</a>
			                	<?php }else{ ?>
			                		<i class="fa fa-check-circle fa-2x" title="Aprobado" style="color: #523178;"></i>
			                		<br><span class="txtajupl">Aprobado</span>
			                	<?php } ?>
	                		<?php } ?>
	                	<?php }else{ ?>
	                		<i class="fa fa-check-circle fa-2x" title="Sin acciones. Por favor el área debe agregar acciones" style="color: #f00;"></i>
	                			<br><span class="txtajupl">Sin acciones</span>
	                	<?php } ?>
	                	</div>


<!-- 		                <div class="btnajupl">
	                	<?php if($va['perid']==1){ ?>
	                		<?php if(($_SESSION['pefid']==58 OR $_SESSION['pefid']==70)){ ?>
		                		<a href= "<?=base_url;?>mejseg/updMej&nopla=<?=$va['nopla'];?>&at=2;?>">
		                			<i class="fa fa-check-circle fa-2x" title="Aprobado" style="color: #523178;"></i>
		                			<br><span class="txtajupl">Aprobado</span>
		                		</a>
	                		<?php }else{ ?>
		                		<i class="fa fa-check-circle fa-2x" title="Aprobado" style="color: #523178;"></i>
		                		<br><span class="txtajupl">Aprobado</span>
	                		<?php } ?>
	                	<?php }else{ ?>
	                		
	                		<?php if($_SESSION['pefid']==58 OR $_SESSION['pefid']==70){ ?>
		                		<a href= "<?=base_url;?>plamej/updPlmj&nopla=<?=$va['nopla'];?>&valid=3051">
		                			<i class="fa fa-check-circle fa-2x" title="Por aprobar" style="color: #f00;"></i>
		                			<br><span class="txtajupl">Por aprobar</span>
		                		</a>
	                		<?php }else{ ?>
		                		<i class="fa fa-check-circle fa-2x" title="Por aprobar" style="color: #f00;"></i>
		                			<br><span class="txtajupl">Por aprobar</span>
	                		<?php } ?>
	                		
	                	<?php } ?>
	                	</div> -->



		                	<div class="btnajupl">
			                	<a href="<?=base_url?>mejseg/index&nopla=<?=$va['nopla'];?>">
				                	<i class="fa fa-file-text fa-2x" title="Ver Desarrollo Hallazgo" style="color: #523178;"></i>
				                	<br><span class="txtajupl">Ver</span>
		                		</a>
		                	</div>
		                	<?php if($_SESSION['pefid']==70 AND ($va['estpla']==1803 OR $va['estpla']==1804)){ ?>
		                		<div class="btnajupl">
					                <i class="fas fa-unlock-alt fa-2x bcacnd" data-toggle="modal" data-target="#myModCob<?=$va['nopla'];?>" title="Caso Abierto"></i>
						            <br><span class="txtajupl">Abierto</span>
			                	</div>
			                	<?php ;
			                		$plamej->setNopla($va['nopla']);
			                		$dtobs = $plamej->getObsNp();
			                		echo Utils::modalUnTextAbCe("myModCob", "Cerrar Plan de mejora", $va['nopla'], "Observación", base_url."plamej/updpm&valid=3051", "ocpla",$va['nopla'],"","","","",$va['ocpla'],$dtobs);
			                	?>
				            <?php }else{ ?>
				            	<div class="btnajupl">
			                		<i class="fas fa-unlock-alt fa-2x" title="Caso Abierto" style="color: #523178;"></i>
			                	<br><span class="txtajupl">Abierto</span>
			                	</div>
				            <?php } ?>

				            <?php if($DtCaA AND $DtCaA[0]['can']==0 AND ($_SESSION['pefid']==58 OR $_SESSION['pefid']==70)){ ?>
				            	<div class="btnajupl">
						            <a href="<?=base_url?>plamej/edit&nopla=<?=$va['nopla'];?>">
					                	<i class="fa fa-pencil-square-o fa-2x" title="Editar" style="color: #523178;"></i>
						                <br><span class="txtajupl">Editar</span>
			                		</a>
			                	</div>
			                <?php } ?>

			                <div class="btnajupl">
				                <a href="<?=base_url?>views/pdfpm.php?nopla=<?=$va['nopla'];?>" target="_blank" title="Imprimir Plan de Mejora">
				                	<i class="fas fa-print fa-2x" style="color: #523178;"></i>
				                	<br><span class="txtajupl">Imprimir</span>
				                </a>
				            </div>

			                <?php if($_SESSION['pefid']==58 OR $_SESSION['pefid']==70){ 
			                	$cacc = $plamej->getCouAcc();
			                	if($cacc){ if($cacc[0]['can']==0){ 
			                ?>
					            <div class="btnajupl">
					            	<a href="<?=base_url?>plamej/elipm&nopla=<?=$va['nopla'];?>&valid=3051" onclick="return eliminar();">
					                	<i class="fas fa-trash fa-2x" title="Eliminar" style="color: #523178;"></i>
					                	<br><span class="txtajupl">Eliminar</span>
					                </a>
					            </div>
			                <?php }}} ?>
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