<!-- Insertar o Editar datos -->

<h2 class="title-c">generar Reporte</h2>
<?php $url_action2 = base_url."dathvper/repor"; ?>

<div>
	<form class="m-tb-40" action="<?=$url_action2?>" method="POST">
		<div class="row">
			<div class="form-group col-md-3">
				<label for="pernom">Nombre o Apellido</label>
				<input type="text" class="form-control form-control-sm" id="pernom" name="pernom" value="<?=isset($pernom) ? $pernom:''; ?>" />
			</div>
			<div class="form-group col-md-3">
				<label for="tipcon">Tipo Contrato</label>
				<select id="tipcon" name="tipcon" class="form-control form-control-sm" style="padding: 0px;" >
					<option value="0">Seleccione</option>
					<?php if($tipcons){ foreach ($tipcons as $tc){ ?>
						<option value="<?=$tc['valid'];?>" <?php if($tc['valid']==$tipcon) echo " selected "; ?>><?=$tc['valnom'];?></option>
					<?php }} ?>
				</select>				
			</div>
			<div class="form-group col-md-3">
				<label for="fecinico">Fecha Inicial:</label>
				<input type="date" class="form-control form-control-sm" id="fecinico" name="fecinico" value="<?=$munm?>">
			</div>
			<div class="form-group col-md-3">
				<label for="fecfinco">Fecha Final:</label>
				<input type="date" class="form-control form-control-sm" id="fecfinco" name="fecfinco"  value="<?=$munm?>">
			</div>
			<div id="ba" class="form-group col-md-12" style="display: none;">
			<div class="row">
				<div class="form-group col-md-3">
					<label for="depid">Área</label>
					<select class="form-control form-control-sm" style="padding: 0px;" id="depid" name="depid">
						<option value="0">Seleccione</option>
					<?php if($areas){	foreach ($areas as $do){ ?>
			            <option value="<?=$do['valid'];?>" <?php if($do['valid']==$depid) echo " selected "; ?>><?=$do['valnom'];?></option>
			        <?php }} ?>
			        </select>
				</div>
				<div class="form-group col-md-3">
					<label for="cargo">Cargo</label>
					<select id="cargo" name="cargo" class="form-control form-control-sm" style="padding: 0px;" >
						<option value="0">Seleccione</option>
						<?php if($carg){ foreach ($carg as $do){ ?>
							<option value="<?=$do['valid'];?>" <?php if($do['valid']==$cargo) echo " selected "; ?>><?=$do['valnom'];?></option>
						<?php }} ?>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label for="actemp">Activo</label>
					<select id="actemp" name="actemp" class="form-control form-control-sm" style="padding: 0px;" >
						<option value="0">Seleccione</option>
	            		<option value="1" <?=isset($val) && $val[0]['actemp']==1 ? ' selected ' : ''; ?> >Si</option>
	            		<option value="2" <?=isset($val) && $val[0]['actemp']!=1 ? ' selected ' : ''; ?> >No</option>
	            	</select>
				</div>
				<div class="form-group col-md-3">
					<label for="sex">Sexo</label>
					<select id="sex" name="sex" class="form-control form-control-sm" style="padding: 0px;" >
						<option value="0">Seleccione</option>
						<?php if($sexs){ foreach ($sexs as $tc){ ?>
							<option value="<?=$tc['valid'];?>" <?php if($tc['valid']==$sex) echo " selected "; ?>><?=$tc['valnom'];?></option>
						<?php }} ?>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label for="grusan">Grupo Sanguineo</label>
					<select id="grusan" name="grusan" class="form-control form-control-sm" style="padding: 0px;" >	
						<option value="0">Seleccione</option>
						<?php if($grusans){ foreach ($grusans as $tc){ ?>
							<option value="<?=$tc['valid'];?>" <?php if($tc['valid']==$grusan) echo " selected "; ?>><?=$tc['valnom'];?></option>
						<?php }} ?>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label for="estciv">Estado Civil</label>
					<select id="estciv" name="estciv" class="form-control form-control-sm" style="padding: 0px;" >	
						<option value="0">Seleccione</option>
						<?php if($estcivs){ foreach ($estcivs as $tc){ ?>
							<option value="<?=$tc['valid'];?>" <?php if($tc['valid']==$estciv) echo " selected "; ?>><?=$tc['valnom'];?></option>
						<?php }} ?>
					</select>
				</div>
		   		<div class="form-group col-md-3">
		   			<label for="idgene">Identidad de Género</label>
					<select id="idgene" name="idgene" class="form-control form-control-sm" style="padding: 0px;" >	
						<option value="0">Seleccione</option>
						<?php if($idgenes){ foreach ($idgenes as $tc){ ?>
							<option value="<?=$tc['valid'];?>" <?php if($tc['valid']==$idgene) echo " selected "; ?>><?=$tc['valnom'];?></option>
						<?php }} ?>
					</select>
		   		</div>
		   		<div class="form-group col-md-3">
		   			<label for="orisex">Orientación Sexual</label>
					<select id="orisex" name="orisex" class="form-control form-control-sm" style="padding: 0px;" >	
						<option value="0">Seleccione</option>
						<?php if($orisexs){ foreach ($orisexs as $tc){ ?>
							<option value="<?=$tc['valid'];?>" <?php if($tc['valid']==$orisex) echo " selected "; ?>><?=$tc['valnom'];?></option>
						<?php }} ?>
					</select>
				</div>
		   		<div class="form-group col-md-3">
		   			<label for="cabfam">Es cabeza de Familia</label>
					<select id="cabfam" name="cabfam" class="form-control form-control-sm" style="padding: 0px;" >
						<option value="0">Seleccione</option>
	            		<option value="1" <?=isset($val) && $val[0]['cabfam']==1 ? ' selected ' : ''; ?> >Si</option>
	            		<option value="2" <?=isset($val) && $val[0]['cabfam']!=1 ? ' selected ' : ''; ?> >No</option>
	            	</select>
				</div>
		    	<div class="form-group col-md-3">
		    		<label for="perexp">Persona Expuesta Publicamente</label>
					<select id="perexp" name="perexp" class="form-control form-control-sm" style="padding: 0px;" >
						<option value="0">Seleccione</option>
	            		<option value="1" <?=isset($val) && $val[0]['perexp']==1 ? ' selected ' : ''; ?> >Si</option>
	            		<option value="2" <?=isset($val) && $val[0]['perexp']!=1 ? ' selected ' : ''; ?> >No</option>
	            	</select>
				</div>
		    	<div class="form-group col-md-3">
		    		<label for="viccon">Es Victima de Conflicto</label>
					<select id="viccon" name="viccon" class="form-control form-control-sm" style="padding: 0px;" >
						<option value="0">Seleccione</option>
	            		<option value="1" <?=isset($val) && $val[0]['viccon']==1 ? ' selected ' : ''; ?> >Si</option>
	            		<option value="2" <?=isset($val) && $val[0]['viccon']!=1 ? ' selected ' : ''; ?> >No</option>
	            	</select>
				</div>
		    	<div class="form-group col-md-3">
		    		<label for="peretn">Tiene Pertenencia Etnica</label>
					<select id="peretn" name="peretn" class="form-control form-control-sm" style="padding: 0px;" >
						<option value="0">Seleccione</option>
	            		<option value="1" <?=isset($val) && $val[0]['peretn']==1 ? ' selected ' : ''; ?> >Si</option>
	            		<option value="2" <?=isset($val) && $val[0]['peretn']!=1 ? ' selected ' : ''; ?> >No</option>
	            	</select>				
				</div>	
				<div class="form-group col-md-3">
					<label for="eps">EPS</label>
					<input type="text" class="form-control form-control-sm" id="eps" name="eps" value="<?=isset($eps) ? $eps:''; ?>" />
		    	</div>
		    	<div class="form-group col-md-3">
					<label for="fdp">Fondo de Pensiones</label>
					<input type="text" class="form-control form-control-sm" id="fdp" name="fdp" value="<?=isset($fdp) ? $fdp:''; ?>" />
		    	</div>
		    	<div class="form-group col-md-3">
		    		<label for="arl">ARL</label>
					<input type="text" class="form-control form-control-sm" id="arl" name="arl" value="<?=isset($arl) ? $arl:''; ?>" />	
		   		</div>
		   		<!--
				<div class="form-group col-md-3" id="go1">
					<label for="tiedis">Tiene Discapacidad</label>
					<select id="tiedis" name="tiedis" class="form-control form-control-sm" style="padding: 0px;" >
						<option value="0">Seleccione</option>	
						<option value="1" <?=isset($val) && $val[0]['tiedis']==1 ? ' selected ' : ''; ?> >Si</option>
	            		<option value="2" <?=isset($val) && $val[0]['tiedis']!=1 ? ' selected ' : ''; ?> >No</option>
		        	</select>
				</div>
				<div id="discap" class="form-group col-md-3" id="go1">
					<label for="disca">Tipo Discapacidad</label>
					<select id="disca" name="disca" class="form-control form-control-sm" style="padding: 0px;" >
						<option value="0">Seleccione</option>
						<?php if($discas){ foreach ($discas as $scs){ ?>
							<option value="<?=$scs['valid'];?>" <?php if($scs['valid']==$disca) echo " selected "; ?>><?=$scs['valnom'];?></option>
						<?php }} ?>
					</select>	
				</div>			
				<div class="form-group col-md-3" id="go1">
					<label for="tiptitul">Titulo</label>
					<select id="tiptitul" name="tiptitul" class="form-control form-control-sm" style="padding: 0px;" >
						<option value="0">Seleccione</option>
						<?php if($tiptituls){ foreach ($tiptituls as $xx){ ?>
							<option value="<?=$xx['valid'];?>" <?php if($xx['valid']==$tiptitul) echo " selected "; ?>><?=$xx['valnom'];?></option>
						<?php }} ?>
					</select>	
				</div>
				<div class="form-group col-md-3" id="go1">
					<label for="modest">Modalidad de Estudio</label>
					<select id="modest" name="modest" class="form-control form-control-sm" style="padding: 0px;" >
						<option value="0">Seleccione</option>
						<?php if($modests){ foreach ($modests as $xx){ ?>
							<option value="<?=$xx['valid'];?>" <?php if($xx['valid']==$modest) echo " selected "; ?>><?=$xx['valnom'];?></option>
						<?php }} ?>
					</select>	
				</div>
				<div class="form-group col-md-3">
					<label for="medcap">Medio de Capacitaciòn</label>
					<select id="medcap" name="medcap" class="form-control form-control-sm" style="padding: 0px;" >
						<option value="0">Seleccione</option>
						<?php if($medcaps){ foreach ($medcaps as $xx){ ?>
							<option value="<?=$xx['valid'];?>" <?php if($xx['valid']==$medcap) echo " selected "; ?>><?=$xx['valnom'];?></option>
						<?php }} ?>
					</select>	
				</div>
				<div class="form-group col-md-3">
					<label for="prtpcg">Parentesco</label>
					<select id="prtpcg" name="prtpcg" class="form-control form-control-sm" style="padding: 0px;" >
						<option value="0">Seleccione</option>
						<?php if($prtpcgs){ foreach ($prtpcgs as $pcs){ ?>
							<option value="<?=$pcs['valid'];?>" <?php if($pcs['valid']==$prtpcg) echo " selected "; ?>><?=$pcs['valnom'];?></option>
						<?php }} ?>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label for="tippcg">Tipologia</label>
					<select id="tippcg" name="tippcg" class="form-control form-control-sm" style="padding: 0px;" >
						<option value="0">Seleccione</option>
						<?php if($tippcgs){ foreach ($tippcgs as $pcs){ ?>
							<option value="<?=$pcs['valid'];?>" <?php if($pcs['valid']==$tippcg) echo " selected "; ?>><?=$pcs['valnom'];?></option>
						<?php }} ?>
					</select>
				</div> -->
			</div>
			</div>
			<div class="form-group col-md-3">
				<input type="submit" class="btn-primary-ccapital" value="Buscar">
			</div>
			<div id="bba" class="form-group col-md-3">
				<br><br>
				<a href="#" onclick="bsqava(1);">Búsqueda avanzada</a>
			</div>
			<div id="bbb" class="form-group col-md-3" style="display: none;">
				<br><br>
				<a href="#" onclick="bsqava(2);">Búsqueda básica</a>
			</div>
		</div>
	</form>
</div>


<h2 class="title-c">Personas</h2>
<br><br>
<div class="table-responsive">
	<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
        <thead>
            <tr>
            	<th class="ttxttbl">No. Doc.</th>
            	<th class="ttxttbl">Tip. Contra</th>
            	<th class="ttxttbl">Fecha Ini.</th>
                <th class="ttxttbl">Fecha Fin.</th>
                <th class="ttxttbl">Area</th>
            	<th class="ttxttbl">Usuario</th>
            	<th class="ttxttbl">Cargo</th>
            	<th class="ttxttbl">Correo Pers.</th>
            	<th class="ttxttbl">Correo Inst.</th>
            	<th class="ttxttbl">Direccion</th>
            	<th class="ttxttbl">Lugar Resid.</th>
            	<th class="ttxttbl">Celular</th>
            	<th class="ttxttbl">Sexo</th>    
            	<th class="ttxttbl">Grupo Sangui.</th>   
            	<th class="ttxttbl">Fec. de Nac.</th>
            	<th class="ttxttbl">Est. Civil</th>
            	<th class="ttxttbl">Genero</th>
            	<th class="ttxttbl">Orientación</th>	
            	<th class="ttxttbl">Cabeza de Flia</th>
            	<th class="ttxttbl">Exp. Publicamente</th>
            	<th class="ttxttbl">Victima de Conf.</th>
            	<th class="ttxttbl">Pert. Etnica</th>
            	<th class="ttxttbl">Grup. Etn.</th>
            	<th class="ttxttbl">EPS</th>
            	<th class="ttxttbl">AFP</th>
            	<th class="ttxttbl">ARL</th>
            	<th class="ttxttbl">Discapacidad</th>
            	<th class="ttxttbl">Tipo Disc.</th>            	
            	<th class="ttxttbl">Titulo</th>
            	<th class="ttxttbl">Modalidad Est.</th>
            	<th class="ttxttbl">Medio Capac.</th>
            	<th class="ttxttbl">Persona a Cargo</th>
            	<th class="ttxttbl">Sexo</th>
            	<th class="ttxttbl">Fecha nac. Per. Cargo</th>
            	<th class="ttxttbl">Parentesco</th>
            	<th class="ttxttbl">Tipologia</th>
            	<th class="ttxttbl">Edad</th>	
                <th class="ttxttbl">Act</th>
				<!-- <th class="ttxttbl"></th> -->
            </tr>
        </thead>
        <tbody>
        	<?php 
        	if(isset($personas)){
        		foreach ($personas as $va){ ?>
        		<tr>
        			<td class="ttxttbl"><?=$va['nodocemp'];?></td>
        			<td class="ttxttbl"><?php if($va['tpcto']) echo $va['tpcto']; ?></td>
        			<td class="ttxttbl"><?php if($va['fecinico']) echo $va['fecinico']; ?></td>
	                <td class="ttxttbl"><?php if($va['fecfinco']) echo $va['fecfinco']; ?></td>
        			<td class="ttxttbl"><?php if($va['area']) echo $va['area']; ?></td>
        			<td class="ttxttbl"><?=$va['pernom'];?> <?=$va['perape'];?></td>
        			<td class="ttxttbl"><?php if($va['carg']) echo $va['carg']; ?></td>
        			<td class="ttxttbl"><?=$va['usuemail'];?></td>
        			<td class="ttxttbl"><?=$va['peremail'];?></td>
        			<td class="ttxttbl"><?=$va['perdir'];?></td>
        			<td class="ttxttbl"><?=$va['nmu1']." ".$va['ndp1'];?></td>
        			<td class="ttxttbl"><?=$va['percel'];?></td>
        			<td class="ttxttbl"><?php if($va['sx']) echo $va['sx']; ?></td>
        			<td class="ttxttbl"><?php if($va['grsan']) echo $va['grsan']; ?></td>
					<td class="ttxttbl"><?php if($va['fecnac']) echo $va['fecnac']; ?></td>
					<td class="ttxttbl"><?php if($va['ecv']) echo $va['ecv']; ?></td>
					<td class="ttxttbl"><?php if($va['gnr']) echo $va['gnr']; ?></td>
					<td class="ttxttbl"><?php if($va['osx']) echo $va['osx']; ?></td>
					<td class="ttxttbl"><?php if($va['cabfam']==1) echo "Sí"; else echo "No"; ?></td>
					<td class="ttxttbl"><?php if($va['perexp']==1) echo "Sí"; else echo "No"; ?></td>
					<td class="ttxttbl"><?php if($va['viccon']==1) echo "Sí"; else echo "No"; ?></td>
					<td class="ttxttbl"><?php if($va['peretn']==1) echo "Sí"; else echo "No"; ?></td>
					<td class="ttxttbl"><?php if($va['etb'] && $va['peretn']==1) echo $va['etb']; ?></td>
					<td class="ttxttbl"><?php if($va['eps']) echo $va['eps']; ?></td>
					<td class="ttxttbl"><?php if($va['fdp']) echo $va['fdp']; ?></td>
					<td class="ttxttbl"><?php if($va['arl']) echo $va['arl']; ?></td>
					<td class="ttxttbl"><?php  
						$persona->setPerid($va['perid']);
						$dis = $persona->getDiscap();
						if($dis){ foreach ($dis as $ds) {
							if($ds['tiedis']==2) echo "Sí"; else echo "No";
							echo "<br>";
						}}
					?></td>
					<td class="ttxttbl"><?php  
						if($dis){ foreach ($dis as $ds) {
							if($ds['tiedis']==2) echo $ds['valnom'];
							echo "<br>";
						}}
					?></td>
					<td class="ttxttbl"><?php 
        				$persona->setPerid($va['perid']);
						$dstd = $persona->getEstu();
						if($dstd){ foreach ($dstd as $vstd) {
							if($vstd['tiptitul']) echo $vstd['nomtt'];
							echo "<br>";
						}}
					?></td>
					<td class="ttxttbl"><?php if($dstd){ foreach ($dstd as $vstd) {
							if($vstd['modest']) echo $vstd['nomme'];
							echo "<br>";
						}}
					?></td>
        			<td class="ttxttbl"><?php if($dstd){ foreach ($dstd as $vstd) {
							if($vstd['medcap']) echo $vstd['nommc'];
							echo "<br>";
						}}
					?></td>
        			<td class="ttxttbl"><?php 
        				$persona->setPerid($va['perid']);
						$pc = $persona->getPerca();
						if($pc){ foreach ($pc as $vpc) {
							if($vpc['nompcg']) echo $vpc['nompcg'];
							echo "<br>";
						}}
        			?></td>	                	
        			<td class="ttxttbl"><?php if($pc){ foreach ($pc as $vpc) {
							if($vpc['sexpcg']) echo $vpc['sexpcgo'];
							echo "<br>";
						}}
        			?></td>	                	
        			<td class="ttxttbl"><?php if($pc){ foreach ($pc as $vpc) {
							if($vpc['fnacpcg']) echo $vpc['fnacpcg'];
							echo "<br>";
						}}
        			?></td>	                	
        			<td class="ttxttbl"><?php if($pc){ foreach ($pc as $vpc) {
							if($vpc['prtpcg']) echo $vpc['prtpcg'];
							echo "<br>";
						}}
        			?></td>	                	
        			<td class="ttxttbl"><?php if($pc){ foreach ($pc as $vpc) {
							if($vpc['tippcg']) echo $vpc['tippcg'];
							echo "<br>";
						}}
        			?></td>	                	
        			<td class="ttxttbl"><?php if($pc){ foreach ($pc as $vpc) {
							if($vpc['Edad']) echo $vpc['Edad'];
							echo "<br>";
						}}
        			?></td>	                	
        		    <td class="ttxttbl">
						<span style="opacity: 0"><?=$va['actemp'];?></span>
		                <?php if($va['actemp']==1){ ?>
		                	<a href="<?=base_url?>persona/act&perid=<?=$va['perid'];?>&actemp=2">
				            <i class="fas fa-check-circle" style="color: #523178;">
				                <span style="color: rgba(255,255,255,0);">+</span>
				            </i>
				            </a>
			            <?php }else{ ?>
			                <a href="<?=base_url?>persona/act&perid=<?=$va['perid'];?>&actemp=1">
							<i class="fas fa-times-circle" style="color: #f00;">
								<span style="color: rgba(255,255,255,0);">-</span>
							</i>
							</a>
						<?php } ?>
		            </td>
	            </tr>
	        <?php }} ?>
        </tbody>
        <tfoot>
            <tr>
            	<th class="ttxttbl">No. Doc.</th>
            	<th class="ttxttbl">Tip. Contra</th>
            	<th class="ttxttbl">Fecha Ini.</th>
                <th class="ttxttbl">Fecha Fin.</th>
                <th class="ttxttbl">Area</th>
            	<th class="ttxttbl">Usuario</th>
            	<th class="ttxttbl">Cargo</th>
            	<th class="ttxttbl">Correo Pers.</th>
            	<th class="ttxttbl">Correo Inst.</th>
            	<th class="ttxttbl">Direccion</th>
            	<th class="ttxttbl">Lugar Resid.</th>
            	<th class="ttxttbl">Celular</th>
            	<th class="ttxttbl">Sexo</th>    
            	<th class="ttxttbl">Grupo Sangui.</th>   
            	<th class="ttxttbl">Fec. de Nac.</th>
            	<th class="ttxttbl">Est. Civil</th>
            	<th class="ttxttbl">Genero</th>
            	<th class="ttxttbl">Orientación</th>	
            	<th class="ttxttbl">Cabeza de Flia</th>
            	<th class="ttxttbl">Exp. Publicamente</th>
            	<th class="ttxttbl">Victima de Conf.</th>
            	<th class="ttxttbl">Pert. Etnica</th>
            	<th class="ttxttbl">Grup. Etn.</th>
            	<th class="ttxttbl">EPS</th>
            	<th class="ttxttbl">AFP</th>
            	<th class="ttxttbl">ARL</th>
            	<th class="ttxttbl">Discapacidad</th>
            	<th class="ttxttbl">Tipo Disc.</th>            	
            	<th class="ttxttbl">Titulo</th>
            	<th class="ttxttbl">Modalidad Est.</th>
            	<th class="ttxttbl">Medio Capac.</th>
            	<th class="ttxttbl">Persona a Cargo</th>
            	<th class="ttxttbl">Sexo</th>
            	<th class="ttxttbl">Fecha nac. Per. Cargo</th>
            	<th class="ttxttbl">Parentesco</th>
            	<th class="ttxttbl">Tipologia</th>
            	<th class="ttxttbl">Edad</th>	
                <th class="ttxttbl">Act</th>
				
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