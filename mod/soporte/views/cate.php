<!-- Insertar o Editar datos -->
<?php echo Utils::tit("Categoría","fa fa-sort-amount-desc mr-3","cate/index","300px"); ?>
<div id="inser">

	<?php 
	// var_dump($edit);
	// var_dump($val);

	if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Ver Categoría</h2>
		<?php $url_action = base_url."cate/save&idcts=".$val[0]['idcts']; ?>
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear Nueva Categoría</h2>
		<?php $url_action = base_url."cate/save"; ?>
	<?php endif; ?>


	<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<div class="row">
				<input type="hidden" name="idcts" value="<?=isset($val) ? $val[0]['idcts'] : ''; ?>"/>
			<div class="form-group col-md-6">
				<label for="tipprb">Problema</label>
				<input type="text" class="form-control form-control-sm" id="tipprb" name="tipprb" value="<?=isset($val) ? $val[0]['tipprb'] : ''; ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label for="clasop">Categoría principal</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="clasop" name="clasop">
	                <option value="I" 
	                	<?=isset($val) && $val[0]['clasop']=='I' ? ' selected ' : ''; ?> >Incidente
	                </option>
	                <option value="R" 
	                	<?=isset($val) && $val[0]['clasop']=='R' ? ' selected ' : ''; ?> >Requerimiento
	                </option>
		        </select>
			</div>
			<div class="form-group col-md-6">
				<label for="sersop">Servicio</label>
				<textarea class="form-control form-control-sm" id="sersop" name="sersop" required><?=isset($val) ? $val[0]['sersop'] : ''; ?></textarea>
			</div>
			<div class="form-group col-md-6">
				<label for="subcsop">Subcategoría</label>
				<textarea class="form-control form-control-sm" id="subcsop" name="subcsop" required><?=isset($val) ? $val[0]['subcsop'] : ''; ?></textarea>
			</div>
			<div class="form-group col-md-6">
				<label for="tipprd">Tipo de producto</label>
				<textarea class="form-control form-control-sm" id="tipprd" name="tipprd" required><?=isset($val) ? $val[0]['tipprd'] : ''; ?></textarea>
			</div>
			<div class="form-group col-md-6">
				<label for="n1">Nivel 1</label>
				<textarea class="form-control form-control-sm" id="n1" name="n1"><?=isset($val) ? $val[0]['n1'] : ''; ?></textarea>
			</div>
			<div class="form-group col-md-6">
				<label for="n2">Nivel 2</label>
				<textarea class="form-control form-control-sm" id="n2" name="n2"><?=isset($val) ? $val[0]['n2'] : ''; ?></textarea>
			</div>
			<div class="form-group col-md-6">
				<label for="n3">Nivel 3</label>
				<textarea class="form-control form-control-sm" id="n3" name="n3"><?=isset($val) ? $val[0]['n3'] : ''; ?></textarea>
			</div>
			<div class="form-group col-md-6">
				<label for="causop">Causa</label>
				<textarea class="form-control form-control-sm" id="causop" name="causop"><?=isset($val) ? $val[0]['causop'] : ''; ?></textarea>
			</div>
			<div class="form-group col-md-6">
				<label for="nsol">Nivel de solución</label>
				<select class="form-control form-control-sm" style="padding: 0px;" id="nsol" name="nsol">
	                <option value="N1" 
	                	<?=isset($val) && $val[0]['nsol']=='N1' ? ' selected ' : ''; ?> >Nivel 1
	                </option>
	                <option value="N2" 
	                	<?=isset($val) && $val[0]['nsol']=='N2' ? ' selected ' : ''; ?> >Nivel 2
	                </option>
	                <option value="N3" 
	                	<?=isset($val) && $val[0]['nsol']=='N3' ? ' selected ' : ''; ?> >Nivel 3
	                </option>
		        </select>
			</div>
			<div class="form-group col-md-6">
				<label for="afesop">Afecta</label>
				<textarea class="form-control form-control-sm" id="afesop" name="afesop" ><?=isset($val) ? $val[0]['afesop'] : ''; ?></textarea>
			</div>
			<div class="form-group col-md-6">
				<label for="obssop">Observaciones</label>
				<textarea class="form-control form-control-sm" id="obssop" name="obssop" ><?=isset($val) ? $val[0]['obssop'] : ''; ?></textarea>
			</div>
			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>
		</div>
	</form>
</div>

<!-- Ver datos -->

<h2 class="title-c">Categorías</h2>
<?php $url_action2 = base_url."cate/index"; ?>
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	        <thead>
	            <tr>
	                <th>Categoría</th>
	                <th>Subcategoría</th>
	                <th>Servicio</th>
	                <th>Clase</th>
	                <th></th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        	if(isset($cates)){
	        		foreach ($cates as $va){ ?>
		            <tr>
		                <td>
		                	<strong>
	                            <?=$va['idcts'];?> - <?=$va['tipprb'];?> - <?=$va['tipprd'];?>
	                        </strong><br>
	                        <small>
                            	<?php if($va['n1']){ ?>
	                            	<strong>Nivel 1: </strong><?=$va['n1'];?></br>
	                            <?php } if($va['n2']){ ?>
	                            	<strong>Nivel 2: </strong><?=$va['n2'];?></br>
	                            <?php } if($va['n3']){ ?>
	                            	<strong>Nivel 3: </strong><?=$va['n3'];?></br>
	                            <?php } if($va['causop']){ ?>
		                            <strong>Causa: </strong><?=$va['causop'];?></br>
		                        <?php } if($va['nsol']){ ?>
		                            <strong>Nivel solucionado por: </strong><?=$va['nsol'];?> 
		                        <?php } if($va['afesop']){ ?>
		                            <strong>Afecta: </strong><?=$va['afesop'];?></br>
		                        <?php } if($va['obssop']){ ?>
		                            <strong>Observación: </strong><?=$va['obssop'];?>
		                        <?php } ?>
	                        </small>
		                </td>
		                <td><?=$va['subcsop'];?></td>
		                <td><?=$va['sersop'];?></td>
		                <td><?php if($va['clasop']=='I') echo "Incidente"; else echo "Requerimiento"; ?></td>
		                <td style="text-align: center;">
		                	<a href="<?=base_url?>cate/edit&idcts=<?=$va['idcts'];?>">
				                <i class="fas fa-edit" title="Editar" style="color: #523178;"></i>
			                </a>
		                </td>
		            </tr>
		        <?php }} ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Categoría</th>
	                <th>Subcategoría</th>
	                <th>Servicio</th>
	                <th>Clase</th>
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