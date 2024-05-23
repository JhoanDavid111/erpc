<script type="text/javascript" src="../js/jquery.min.js"></script>

<!-- Insertar o Editar datos -->
<?php if($txtn){ ?>
	<div style="color: #ff0000;font-weight:bold;text-shadow: 1px 1px 1px #787676;">
		¡Su usuario ha sido <?=$txtn;?>.!<br><br>
	</div>
<?php }?>
<?php //echo Utils::tit("Datos Básicos","fa fa-cogs mr-3","dathvper/index","300px"); ?>
<!-- <div id="inser"> -->
	<?php if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Ver Datos Básicos</h2>
		<?php $url_action = base_url."dathvper/save&perid=".$val[0]['perid']; 
	?>
		
	<?php else: ?>
		<h2 class="title-c m-tb-40">Datos Personales</h2>
		<?php $url_action = base_url."dathvper/save"; ?>
	<?php endif; ?>

	<form class="m-tb-40" action="<?=$url_action;?>" method="POST">
		<div class="row">

			<?php //if(isset($val) && $perid){ ?>
				<input type="hidden" id="perid" name="perid" value="<?=isset($perid) ? $perid : ''; ?>"/>
			<?php //} ?>
			<div class="form-group col-md-6">
				<label for="tipcon">Tipo Contrato</label>
				<select id="tipcon" name="tipcon" class="form-control form-control-sm" style="padding: 0px;" required >	
					<?php foreach ($tipcon as $tc){ ?>
						<option value="<?=$tc['valid'];?>" <?php if($datOne AND $tc['valid']==$datOne[0]['tipcon']) echo ' selected '; ?>><?=$tc['valnom'];?></option>
					<?php } ?>
				</select>				
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="fecinico">Fecha Inicio Contrato</label>
				<input type="date" class="form-control form-control-sm" id="fecinico" name="fecinico" value="<?=isset($datOne) ? $datOne[0]['fecinico']:$hoy; ?>" required />
			</div>
			<div class="form-group col-md-6" id="go1">
				<label for="fecfinco">Fecha Fin Contrato</label>
				<input type="date" class="form-control form-control-sm" id="fecfinco" name="fecfinco" value="<?=isset($datOne) ? $datOne[0]['fecfinco']:$hoy; ?>" >
			</div>
			<div class="form-group col-md-6">
				<label for="tipdoc">Tipo Documento</label>
				<select id="tipdoc" name="tipdoc" class="form-control form-control-sm" style="padding: 0px;" required >	
					<?php foreach ($tipdoc as $td){ ?>
						<option value="<?=$td['valid'];?>" <?php if($datOne AND $td['valid']==$datOne[0]['tipdoc']) echo ' selected '; ?>><?=$td['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="nodocemp">Número de Documento</label>
				<input type="number" class="form-control form-control-sm" id="nodocemp" name="nodocemp" value="<?=isset($datOne) ? $datOne[0]['nodocemp']:''; ?>" required />
		    </div>
		    <div class="form-group col-md-6">
				<label for="pernom">Nombres</label>
				<input type="text" class="form-control form-control-sm" id="pernom" name="pernom" value="<?=isset($datOne) ? $datOne[0]['pernom'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="perape">Apellidos</label>
				<input type="text" class="form-control form-control-sm" id="perape" name="perape" value="<?=isset($datOne) ? $datOne[0]['perape'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="nomide">Nombre Identitario</label>
				<input type="text" class="form-control form-control-sm" id="nomide" name="nomide" value="<?=isset($datOne) ? $datOne[0]['pernom']." ".$datOne[0]['perape']:''; ?>" >
		    </div>
			<div class="form-group col-md-6">
				<label for="usuemail">Correo Electronico Personal</label>
				<input type="email" class="form-control form-control-sm" id="usuemail" name="usuemail" value="<?=isset($datOne) ? $datOne[0]['usuemail']:''; ?>" required />
		    </div>
		    <div class="form-group col-md-6">
				<label for="peremail">Correo Electronico Institucional</label>
				<input type="email" class="form-control form-control-sm" id="peremail" name="peremail" value="<?=isset($datOne) ? $datOne[0]['peremail']:''; ?>" required />
		    </div>
		    <div class="form-group col-md-6">
				<label for="pertel">Telefono Fijo</label>
				<input type="text" class="form-control form-control-sm" id="pertel" name="pertel" value="<?=isset($datOne) ? $datOne[0]['pertel']:''; ?>" required />
		    </div>
		    <div class="form-group col-md-6">
				<label for="percel">Telefono Celular</label>
				<input type="text" class="form-control form-control-sm" id="percel" name="percel" value="<?=isset($datOne) ? $datOne[0]['percel']:''; ?>" required />
		    </div>
			<div class="form-group col-md-6">
				<label for="sex">Sexo</label>
				<select id="sex" name="sex" class="form-control form-control-sm" onchange="javascript:adlibmil(this.value);" style="padding: 0px;" required >
					<?php foreach ($sex as $sx){ ?>
						<option value="<?=$sx['valid'];?>" <?php if($datOne AND $sx['valid']==$datOne[0]['sex']) echo ' selected '; ?>><?=$sx['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="panac">Pais Nacionalidad</label>
				<input type="text" class="form-control form-control-sm" id="panac" name="panac" value="<?=isset($datOne) ? $datOne[0]['panac'] : ''; ?>" >
			</div>
			<div class="form-group col-md-6">
				<label for="grusan">Grupo Sanguineo</label>
				<select id="grusan" name="grusan" class="form-control form-control-sm" style="padding: 0px;" required >	
					<?php foreach ($grusan as $gs){ ?>
						<option value="<?=$gs['valid'];?>" <?php if($datOne AND $gs['valid']==$datOne[0]['grusan']) echo ' selected '; ?>><?=$gs['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
						
		</div>		   
			
		<h2 class="title-c m-tb-40">Datos de Nacimiento</h2>
		<br><br>

		<div class="row">
			<div class="form-group col-md-6" id="go1">
				<label for="fecnac">Fecha de Nacimiento</label>
				<input type="date" class="form-control form-control-sm" id="fecnac" name="fecnac" value="<?=isset($datOne) ? $datOne[0]['fecnac']:$hoy; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label>Departamento</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="muni"/>
					<option value="0">Seleccione</option>
				<?php foreach ($depar as $d): ?>
					<option value="<?=$d['ubiid']?>"><?=$d['ubinom']?></option>	
				<?php endforeach ?>					
				</select>
			</div>	
			<div class="form-group col-md-6">
				<label for="ubiid">Municipio</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="ubiid" name="ubiid" />
					<?php if($datOne){ ?>
						<option value="<?=$datOne[0]['lgnac'];?>"><?=$infnac.$datOne[0]['nlgnac'];?></option>
					<?php }else{ ?>
						<option value="0">Seleccione Departamento</option>
					<?php } ?>
				</select>
			</div>			
		</div>			

		<h2 class="title-c m-tb-40">Ubicación Residencia</h2>
		<br><br>

		<div class="row">
			<div class="form-group col-md-12">
				<?=$infviv." ".$datOne[0]['ndpmlb'];?>
				<!-- <br><br>
				<?php var_dump($dcifvv); ?>
				<?php echo count($dcifvv); ?> -->
			</div>
			<div class="form-group col-md-6">
				<label>Departamento</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="depto"  required />
					<option value="0">Seleccione</option>
				<?php foreach ($depar as $d): ?>
					<option value="<?=$d['ubiid']?>"><?=$d['ubinom']?></option>	
				<?php endforeach ?>					
				</select>
			</div>	
			<div class="form-group col-md-6">
				<label for="munici">Municipio</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="munici" name="munbrlc1" onchange="eliCiucmb();" required />
					<?php if($datOne && $dcifvv && count($dcifvv)==5){ ?>
						<option value="<?=$dcifvv[3];?>"><?=$dcifvv[4];?></option>
					<?php }else{ ?>
						<option value="0">Seleccione Departamento</option>
					<?php } ?>			
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="loca">Localidad</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="loca" name="munbrlc2" />
					<?php if($datOne && $dcifvv && count($dcifvv)==7){ ?>
						<option value="<?=$dcifvv[5];?>"><?=$dcifvv[6];?></option>
					<?php }else{ ?>
						<option value="0">Seleccione Municipio</option>
					<?php } ?>					
				</select>
			</div>	
			<div class="form-group col-md-6">
				<label for="barr">Barrio</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="barr" name="munbrlc3" />
					<?php if($datOne && $dcifvv && count($dcifvv)==9){ ?>
						<option value="<?=$dcifvv[7];?>"><?=$dcifvv[8];?></option>
					<?php }else{ ?>
						<option value="0">Seleccione Localidad</option>
					<?php } ?>		
				</select>
			</div>			
			<div class="form-group col-md-6" id="go1">
				<label for="perdir">Dirección</label>
				<input type="text" class="form-control form-control-sm" id="perdir" name="perdir" value="<?=isset($datOne) ? $datOne[0]['perdir']:""; ?>" required />
			</div>					
			<div class="form-group col-md-6" id="go1">
				<label for="idzona">Zona</label>
				<select id="idzona" name="idzona" class="form-control form-control-sm" style="padding: 0px;" required >	
					<?php foreach ($idzon as $zn){ ?>
						<option value="<?=$zn['valid'];?>"><?=$zn['valnom'];?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="estra">Estrato</label>
				<select id="estra" name="estra" class="form-control form-control-sm" style="padding: 0px;" required >
					<?php foreach ($estra as $es){ ?>
						<option value="<?=$es['valid'];?>" <?php if($datOne AND $es['valid']==$datOne[0]['estra']) echo ' selected '; ?>><?=$es['valnom'];?></option>
					<?php } ?>	
				</select>
		    </div>	
		    <div class="form-group col-md-6">
				<label for="tipviv">Tipo de Vivienda</label>
				<select id="tipviv" name="tipviv" class="form-control form-control-sm" style="padding: 0px;" required >
					<?php foreach ($tipviv as $tv){ ?>
						<option value="<?=$tv['valid'];?>" <?php if($datOne AND $tv['valid']==$datOne[0]['tipviv']) echo ' selected '; ?>><?=$tv['valnom'];?></option>
					<?php } ?>	
				</select>
		    </div>
		</div>
		
		<h2 class="title-c m-tb-40" id="tlib">Libreta Militar</h2>
			
		<div id="libmil" style="width:100%;">
			<div class="row">			
				
				<div class="form-group col-md-6">
					<label for="tiplib">Clase Libreta</label>
					<select id="tiplib" name="tiplib" class="form-control form-control-sm" style="padding: 0px;" required >	
					<?php foreach ($tiplib as $cl){ ?>
						<option value="<?=$cl['valid'];?>" <?php if($datOne AND $cl['valid']==$datOne[0]['tiplib']) echo ' selected '; ?>><?=$cl['valnom'];?></option>
					<?php } ?>
					</select>
		    	</div>				
		    	<div class="form-group col-md-6">
					<label for="dismil">Distrito Militar</label>
					<input type="text" class="form-control form-control-sm" id="dismil" name="dismil" value="<?=isset($datOne) ? $datOne[0]['dismil']:''; ?>" required />
		    	</div>
				<div class="form-group col-md-6">
					<label for="numlib">Número de Libreta</label>
					<input type="number" class="form-control form-control-sm" id="numlib" name="numlib" value="<?=isset($datOne) ? $datOne[0]['numlib']:''; ?>" required />
		    	</div>
		   
			</div>
		</div>
		
		<br><br>	
		<h2 class="title-c m-tb-40">Datos Complementarios</h2>
		<br><br>

		<div class="row">	
			<div class="form-group col-md-6">
				<label for="estciv">Estado Civil</label>
				<select id="estciv" name="estciv" class="form-control form-control-sm" style="padding: 0px;" required >
					<?php foreach ($estciv as $ec){ ?>
						<option value="<?=$ec['valid'];?>" <?php if($datOne AND $ec['valid']==$datOne[0]['estciv']) echo ' selected '; ?>><?=$ec['valnom'];?></option>
					<?php } ?>	
				</select>
		    </div>
		    <div class="form-group col-md-6">
				<label for="idio">Idioma Nativo</label>
				<input type="text" class="form-control form-control-sm" id="idio" name="idio" value="<?=isset($datOne) ? $datOne[0]['idio']:''; ?>" required />
		    </div>
		    <div class="form-group col-md-6">
				<label for="idgene">Identidad de Género</label>
				<select id="idgene" name="idgene" class="form-control form-control-sm" style="padding: 0px;" required >
					<?php foreach ($idgene as $ig){ ?>
						<option value="<?=$ig['valid'];?>" <?php if($datOne AND $ig['valid']==$datOne[0]['idgene']) echo ' selected '; ?>><?=$ig['valnom'];?></option>
					<?php } ?>	
				</select>
		    </div>
		    <div class="form-group col-md-6">
				<label for="orisex">Orientación Sexual</label>
				<select id="orisex" name="orisex" class="form-control form-control-sm" style="padding: 0px;" required >	
					<?php foreach ($orisex as $os){ ?>
						<option value="<?=$os['valid'];?>" <?php if($datOne AND $os['valid']==$datOne[0]['orisex']) echo ' selected '; ?>><?=$os['valnom'];?></option>
					<?php } ?>
				</select>
		    </div>
		    <div class="form-group col-md-6">
				<label for="cabfam">Es cabeza de Familia</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="cabfam" name="cabfam" required >
            		<option value="1" <?=isset($datOne) && $datOne[0]['cabfam']==1 ? ' selected ' : ''; ?> >Si</option>
            		<option value="2" <?=isset($datOne) && $datOne[0]['cabfam']!=1 ? ' selected ' : ''; ?> >No</option>
		        </select>
			</div>
		    <div class="form-group col-md-6">
				<label for="perexp">Persona Expuesta Publicamente</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="perexp" name="perexp" required >
            		<option value="1" <?=isset($datOne) && $datOne[0]['perexp']==1 ? ' selected ' : ''; ?> >Si</option>
            		<option value="2" <?=isset($datOne) && $datOne[0]['perexp']!=1 ? ' selected ' : ''; ?> >No</option>
		        </select>
			</div>
		    <div class="form-group col-md-6">
				<label for="viccon">Es Victima del Conflicto</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="viccon" name="viccon" required >
            		<option value="1" <?=isset($datOne) && $datOne[0]['viccon']==1 ? ' selected ' : ''; ?> >Si</option>
            		<option value="2" <?=isset($datOne) && $datOne[0]['viccon']!=1 ? ' selected ' : ''; ?> >No</option>
		        </select>
			</div>
		    <div class="form-group col-md-6">
				<label for="peretn">Tiene Pertenencia Etnica</label>
				<select id="peretn" name="peretn" class="form-control form-control-sm" onchange="javascript:ovit(this.value);" style="padding: 0px;"  required >
            		<option value="1" <?=isset($datOne) && $datOne[0]['peretn']==1 ? ' selected ' : ''; ?> >Si</option>
            		<option value="2" <?=isset($datOne) && $datOne[0]['peretn']!=1 ? ' selected ' : ''; ?> >No</option>
		        </select>
			</div>
		    <div id="grpetn" class="form-group col-md-6">
				<label for="nometb">Grupo Etnico</label>
				<select id="nometb" name="nometb" class="form-control form-control-sm" style="padding: 0px;" required >	
					<?php foreach ($nometb as $ge){ ?>
						<option value="<?=$ge['valid'];?>"><?=$ge['valnom'];?></option>
					<?php } ?>
				</select>
		    </div>
		</div>
			
		<h2 class="title-c m-tb-40">Seguridad Social</h2>
		<br><br>
		
		<div class="row">			
			<div class="form-group col-md-6">
				<label for="eps">EPS</label>
				<input type="text" class="form-control form-control-sm" id="eps" name="eps" value="<?=isset($datOne) ? $datOne[0]['eps']:''; ?>" required />
		    </div>
		    <div class="form-group col-md-6">
				<label for="fdp">AFP</label>
				<input type="text" class="form-control form-control-sm" id="fdp" name="fdp" value="<?=isset($datOne) ? $datOne[0]['fdp']:''; ?>" required />
		    </div>
		    <div class="form-group col-md-6">
				<label for="arl">ARL</label>
				<input type="text" class="form-control form-control-sm" id="arl" name="arl" value="<?=isset($datOne) ? $datOne[0]['arl']:''; ?>" required />
		    </div>
		</div>

		<h2 class="title-c m-tb-40">Educacion Básica</h2>
		<br><br>

		<div class="row">
			<div class="form-group col-md-6">
				<label for="nomedubas">Establecimiento Donde Curso el Último Año</label>
				<input type="text" class="form-control form-control-sm" id="nomedubas" name="nomedubas" value="<?=isset($datOne) ? $datOne[0]['nomedubas']:''; ?>" >
		    </div>
		    <div class="form-group col-md-6">
				<label for="ulgrap">Nombre Programa</label>
				<input type="text" class="form-control form-control-sm" id="ulgrap" name="ulgrap" value="<?=isset($datOne) ? $datOne[0]['ulgrap']:''; ?>" >
		    </div>
		    <div class="form-group col-md-6" id="go1">
				<label for="feulgrap">Fecha Terminación</label>
				<input type="date" class="form-control form-control-sm" id="feulgrap" name="feulgrap" value="<?=isset($datOne) ? $datOne[0]['feulgrap']:$hoy; ?>" >
			</div>
		</div>

<!-- Boton Registrar -->		    
			
			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
				<input type="hidden" name="ope" value="save">
			</div>
		</div>
	</form>
<!-- </div> -->

<script type="text/javascript" src="../js/ubica.js"></script>
<script type="text/javascript" src="../js/libmil.js"></script>
<script type="text/javascript" src="../js/grpetn.js"></script>
<?php if($datOne) $aclm=$datOne[0]['sex']; else $aclm="1601"; ?>
<script type="text/javascript">adlibmil(<?=$aclm;?>);</script>