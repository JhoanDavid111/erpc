<h2 class="title-c">Informacion Proveedor</h2>
<br><br>
	<div class="table-responsive">
		<table style="width:100%;" border="1" class="mitabla">
	        <tr>
            	<th>Proveedor:</th>
                <td colspan="3">
                	<?=$va[0]['nit'];?> - <?=$va[0]['razsoc'];?>
                </td>
            </tr>
            <tr>
                <th>Ciudad:</th>
                <td>
                	<?=$va[0]['ciu'];?>
                </td>
                <th>Dirección:</th>
                <td>
                	<?=$va[0]['dir'];?>
                </td>
            </tr>
            <tr>
                <th>Telefono: </th>
                <td>
                	<?=$va[0]['tel'];?>
                </td>
                <th>Email:</th>
                <td>
                	<?=$va[0]['email'];?>
                </td>
            </tr>
            <tr>
            	<th>Codigo CIIU:</th>
                <td colspan="3">
                	<?php
                		foreach ($ciius2 as $ci) {
                			echo $ci['codciiu']." - ".$ci['nomciiu']."<br>";
                		}
                	?> 
                </td>
            </tr>
		                
		   		            
	    </table>
	    <br><br>
	</div>

<!-- Insertar o Editar datos -->

<div id="inser">
	<h2 class="title-c m-tb-40">Información Documentos</h2>
	<?php $url_action = base_url."docpro/save"; ?>

	<form class="m-tb-40" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<div class="row">
			<input type="hidden" name="idprov" value="<?=$idprov;?>"/>
			
			<?php
				//var_dump($docm);
				if($docm){
					$l=0;
					foreach ($docm as $dc) {
			?>
						<?php
							$arc = $docpro->getOne($idprov, $dc['valid']);
							if($arc){
						?>
								<div class="form-group col-md-6" style="text-align: center;">
									<a href="<?=path_filem;?><?=$arc[0]['ruta'];?>" target="_blank">
										<i class="fa fa-file-pdf-o fa-2x"></i>
									</a>
									<input type="hidden" name="valid[]" value="<?=$dc['valid'];?>"/>
									<input type="hidden" name="valor[]" value="<?=$dc['valnom'];?>"/>
									<input type="hidden" class="form-control" id="ruta<?=$l;?>" name="ruta<?=$l;?>" value="" />
									<br>
									<a href="elidoc&iddoc=<?=$arc[0]["iddoc"];?>" onclick="return eliminar();" title="Eliminar documento">
		                				<i class="fa fa-times-circle" style="color: #f00;"></i>&nbsp;&nbsp;
		                			</a>
									<?=$arc[0]['valor'];?>
								</div>
						<?php }else{ ?>
								<div class="form-group col-md-6">
									<label for="ruta<?=$l;?>"><b><?=$dc['valnom'];?></b></label>
									<input type="hidden" name="valid[]" value="<?=$dc['valid'];?>"/>
									<input type="hidden" name="valor[]" value="<?=$dc['valnom'];?>"/>
									<input type="file" class="form-control" id="ruta<?=$l;?>" name="ruta<?=$l;?>" accept="application/pdf" />
								</div>
			<?php
							}
						$l++;
					}
				}
			?>

			<div class="form-group col-md-12">
				<input type="submit" class="btn-primary-ccapital" value="Registrar">
			</div>
			
		</div>
	</form>
</div>


