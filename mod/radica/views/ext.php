<!-- Insertar o Editar datos -->
<?php //echo Utils::tit("Externo","fas fa-restroom  mr-3","flujo/index","300px"); ?>

	<?php if(isset($edit) && isset($val)): ?>
		<h2 class="title-c m-tb-40">Ver flujo</h2>
		<?php $url_action = base_url."flujo/save&tipo=".$t2."&norad=".$val[0]['norad']; ?>
	<?php else: ?>
		<h2 class="title-c m-tb-40">Crear <?=$tipo;?></h2>
		<?php $url_action = base_url."radica/save&tipo=".$t2; ?>
	<?php endif; ?>
<br><br>

<!--
$asurad, $carrad, $noradext, $orirad, $firrad, $folrad, $tiprad, $areprorad, $noradcon, $regrad, $fecrad, $emprad, $nomrad, $dirrad, $posrad, $ubiid, $cuerad, $revrad,$coprad, $chkrad, $adjrad, $consecutivo, $carradofi
-->
	<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<div class="row">
			<input type="hidden" name="norad" value="<?=isset($val) ? $val[0]['norad'] : ''; ?>"/>
			<div class="form-group col-md-12" id="go1">
				<label for="asurad">Asunto</label>
				<input type="text" class="form-control form-control-sm" id="asurad" name="asurad" value="<?=isset($val) ? $val[0]['asurad'] : ''; ?>" />
			</div>
			<?php if($t2==602 OR $t2==603){ ?>
				<div class="form-group col-md-6" id="go1">
					<label for="nomrad">Dirigido a</label>
					<?php if($t2==602){ ?>
						<select class="form-control form-control-sm" style="padding: 0px;max-height: none;" id="nomrad" name="nomrad[]"  multiple="multiple">
						<?php 
						if($personPlan){
							foreach ($personPlan as $do){ ?>
				                <option value="<?=$do['perid'];?>" 
				                	<?=isset($val) && $do['perid']==$val[0]['nomrad'] ? ' selected ' : ''; ?>><?=$do['pernom']." ".$do['perape']." - ".$do['carg'];?>
				                </option>
				            
				        <?php }} ?>
				        </select>
				    <?php }else{ ?>
				    	<input type="text" class="form-control form-control-sm" id="nomrad" name="nomrad" value="<?=isset($val) ? $val[0]['nomrad'] : ''; ?>" />
				    <?php } ?>
				</div>
			<?php } ?>
			<?php /*if($t2==601){ ?>
				<div class="form-group col-md-6">
					<label for="carrad">Cargo</label>
					<select class="form-control form-control-sm" style="padding: 0px;" id="carrad" name="carrad"  >
					<?php 
					if($getVal){
						foreach ($getVal as $do){ ?>
			                <option value="<?=$do['valid'];?>" 
			                	<?=isset($val) && $do['valid']==$val[0]['valid'] ? ' selected ' : ''; ?>><?=$do['valnom'];?>
			                </option>
			            
			        <?php }} ?>
			        </select>
				</div>
			<?php }else*/
			if($t2==601 OR $t2==603){ ?>
				<div class="form-group col-md-6">
					<label for="carrad">Cargo</label>
			    	<input type="text" class="form-control form-control-sm" id="carrad" name="carrad" value="<?=isset($val) ? $val[0]['carrad'] : ''; ?>" />
		    	</div>
		    <?php } ?>
			<?php if($t2==601 OR $t2==603){ ?>
				<div class="form-group col-md-6" id="go1">
					<label for="emprad">Empresa</label>
					<input type="text" class="form-control form-control-sm" id="emprad" name="emprad" value="<?=isset($val) ? $val[0]['emprad'] : ''; ?>" />
				</div>
			<?php } ?>
			<?php if($t2==601 OR $t2==603){ ?>
				<div class="form-group col-md-6" id="go1">
					<label for="dirrad">Dirección</label>
					<input type="text" class="form-control form-control-sm" id="dirrad" name="dirrad" value="<?=isset($val) ? $val[0]['dirrad'] : ''; ?>" />
				</div>
			<?php } ?>
			<?php if($t2==601 OR $t2==603){ ?>
				<div class="form-group col-md-6" id="go1">
					<label for="posrad">Código postal</label>
					<input type="text" class="form-control form-control-sm" id="posrad" name="posrad" value="<?=isset($val) ? $val[0]['posrad'] : ''; ?>" />
				</div>
			<?php } ?>
			<div class="form-group col-md-6" id="go2">
				<label for="adjrad">Anexos</label>
				<textarea class="form-control form-control-sm" id="adjrad" name="adjrad"><?=isset($val) ? $val[0]['adjrad'] : ''; ?></textarea>
			</div>
			<?php if($t2==602 OR $t2==603){ ?>
				<!-- <div class="form-group col-md-6" id="go2">
					<label for="cuerad">Contenido</label>
					<textarea class="form-control form-control-sm" id="cuerad" name="cuerad"><?=isset($val) ? $val[0]['cuerad'] : ''; ?></textarea>
				</div> -->
			

				<!-- Agrega el editor de texto en linea INICIO Forma 1 -->
				  <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
				  <div class="form-group col-md-12">
				  	<label for="editor">Contenido</label>
				  	<?php $mdtxt = isset($val) ? $val[0]['cuerad']:""; ?>
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

<!-- Agrega el editor de texto en linea INICIO Forma 2 -->
<!--
  <script src="https://cdn.tiny.cloud/1/xmtjma4u7x9xm3d30p9qxf8mozel7bo1ezd83d0ejfcj3b6r/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

  <div class="form-group col-md-12">
    <textarea id="t1">
      Welcome Canal Capital ll
    </textarea class="form-control">
  </div>
  <script>
    tinymce.init({
      selector: '#t1',
      plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
    });
  </script>
-->

<!-- Agrega el editor de texto en linea FIN Forma 2 -->


			<?php /*if($t2==601){ ?>
				<div class="form-group col-md-6" id="go3">
					<label for="orirad">Origen Documento</label>
					<input type="text" class="form-control form-control-sm" id="orirad" name="orirad" value="<?=isset($val) ? $val[0]['orirad'] : ''; ?>"  />
				</div>
			<?php }*/ ?>
			<div class="form-group col-md-6" id="go1">
				<label for="firrad">Firma Documento</label>
				<?php if($t2==601){ ?>
					<input type="text" class="form-control form-control-sm" id="firrad" name="firrad" value="<?=isset($val) ? $val[0]['firrad'] : ''; ?>"  />
			    <?php } ?>
				<?php if($t2==602 OR $t2==603){ ?>
					<select class="form-control form-control-sm" style="padding: 0px;" id="firrad" name="firrad"  >
						<?php 
						if($personPlan){
							foreach ($personPlan as $do){ ?>
				                <option value="<?=$do['perid'];?>" 
				                	<?=isset($val) && $do['perid']==$val[0]['firrad'] ? ' selected ' : ''; ?>><?=$do['pernom']." ".$do['perape']." - ".$do['carg'];?>
				                </option>
				            
				        <?php }} ?>
			        </select>
			    <?php } ?>
			</div>
			<div class="form-group col-md-6" id="go4">
				<label for="folrad">No. Folios</label>
				<input type="number" class="form-control form-control-sm" id="folrad" name="folrad" value="<?=isset($val) ? $val[0]['folrad'] : '1'; ?>"  />
			</div>
			<?php if($t2==601){ ?>
				<div class="form-group col-md-6" id="go1">
					<label for="areprorad">Área asignada</label>
				
					<select class="form-control form-control-sm" style="padding: 0px;" id="areprorad" name="areprorad"  >
					<?php 
					if($areas){
						foreach ($areas as $do){ ?>
			                <option value="<?=$do['valid'];?>" 
			                	<?=isset($val) && $do['valid']==$val[0]['areprorad'] ? ' selected ' : ''; ?>><?=$do['valnom'];?>
			                </option>
			            
			        <?php }} ?>
			        </select>
				</div>
			<?php } ?>
			<?php if($t2==602 OR $t2==603){ ?>
				<input type="hidden" name="areprorad" value="<?=$_SESSION['depid'];?>">
			<?php } ?>
			<?php if($t2==601){ ?>
				<div class="form-group col-md-6" id="go2">
					<label for="noradext">No. Radicación Externo</label>
					<input type="text" class="form-control form-control-sm" id="noradext" name="noradext" value="<?=isset($val) ? $val[0]['noradext']:''; ?>" >
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
				                	<?=isset($val) && $do['ubiid']==$val[0]['ubiid'] ? ' selected ' : ''; ?>><?=$do['ubinom'];?>
				                </option>
				            
				        <?php }} ?>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label for="ubiid">Municipio</label>
					<div id="reloadMun">
						<select class="form-control" style="padding: 0px;" id="ubiid" name="ubiid"  >
			                <option value="0">Seleccione un departamento</option>
				        </select>
					</div>
				</div>
			<?php } ?>
			<?php //if($t2==601){ ?>
				<!-- <div class="form-group col-md-6" id="go2">
					<label for="chkrad">Entregado</label>
					<input type="checkbox" class="form-control form-control-sm" id="chkrad" name="chkrad" value="<?php if(isset($val) && $val[0]['chkrad']==1) echo '1'; else echo '2'; ?>" <?php if(isset($val) && $val[0]['chkrad']==1) echo 'checked'; ?>>
				</div> -->
			<?php //} ?>
			<div class="form-group col-md-6" id="go2">
				<label for="coprad">Con copia a:</label>
				<select class="form-control form-control-sm" style="padding: 0px;max-height: none;" id="coprad" name="coprad[]" multiple="multiple" >
				<?php 
				if($person){
					foreach ($person as $do){ ?>
		                <option value="<?=$do['perid'];?>" >
		                	<?=$do['pernom']." ".$do['perape'];?>
		                </option>
		            
		        <?php }} ?>
		        </select>
			</div>
			<?php if($t2==602){ ?>
				<div class="form-group col-md-6" id="go3">
					<label for="noradcon">No. Memorando que contesta</label>
					<input type="text" class="form-control form-control-sm" id="noradcon" name="noradcon" value="<?=isset($val) ? $val[0]['noradcon'] : ''; ?>"  />
				</div>
			<?php } ?>
			<div class="form-group col-md-6" id="go3">
				<label for="archi">Archivos Adjuntos</label>
				<input type="file" class="form-control form-control-sm" id="archi" name="archi" accept="image/*,.pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" multiple /> <!--  -->
			</div>

			<div class="form-group col-md-6" id="go3">
				<br>
				<input type="checkbox" class="form-control form-control-sm" id="mfirrad" name="mfirrad" style="width: 50px;display: inline-block;" checked />
				<label for="mfirrad">
					Firmar documento
					<br><small><small><small><small><small>&nbsp;</small></small></small></small></small>
				</label>
			</div>

			<?php if($t2==603){ ?>
				<div class="form-group col-md-6" id="go3">
					<br>
					<input type="checkbox" class="form-control form-control-sm" id="oficot" name="oficot" style="width: 50px;display: inline-block;" />
					<label for="oficot">
						Cotización
						<br><small><small><small><small><small>&nbsp;</small></small></small></small></small>
					</label>
				</div>
			<?php } ?>

			<div class="form-group col-md-6">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>
		</div>
	</form>
 