<!-- Ver datos -->

<h2 class="title-c">Minuta</h2>
<?php 
	$url_action = base_url."minuta/index";
 ?>

	<div>
		<form class="m-tb-40" action="<?=$url_action?>" method="POST">
			<div class="row">
				<div class="form-group col-md-3">
					<label for="fechos">Fecha Inicial:</label>
					<input type="date" class="form-control form-control-sm" id="fechos" name="fechos" value="<?=$fechos;?>">
				</div>
				<div class="form-group col-md-3">
					<label for="fhlle">Fecha Final:</label>
					<input type="date" class="form-control form-control-sm" id="fhlle" name="fhlle" value="<?=$fhlle;?>" onChange="this.form.submit();">
				</div>
				<div class="form-group col-md-3">
	                <label for="nodocemp">No. Documento: </label>
	                <input type="text" name="nodocemp" id="nodocemp" value="<?=$nodocemp;?>" onchange="this.form.submit();" class="form-control form-control">
	            </div>
			</div>
		</form>
<!--		<div style="margin: -50px 30px 20px 20px;float: right;">
	        <a href="views/pdfmin.php?&fechos=<?= $fechos ?>&fhlle=<?= $fhlle ?>&nodocemp=<?= $nodocemp ?>" title="imprimir" target="_blank">
	            <i class="fa-solid fa-print fa-2x" style="color:#027902;"></i>
	        </a>
	        <a href="views/pdfmin.php?&fechos=<?= $fechos ?>&fhlle=<?= $fhlle ?>&nodocemp=<?= $nodocemp ?>&pdf=ok" title="PDF" target="_blank">
	            <i class="fa-solid fa-file-pdf fa-2x" style="color:#027902;"></i>
	        </a>
	    </div>  -->
	</div>

	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
	    	<thead>
	            <tr>
	                <th>Usuario</th>
	                <th>Entrada</th>
	                <th>Salida</th>
	                <th>Tiempo</th>
	                <th>Estado</th>
	            </tr>
	        </thead>
	        <tbody>
	            <?php
	            if ($dat) {
	                foreach ($dat as $d) {
	            ?>
	                    <tr>
	                        <td>
	                            <?= $d['nodocemp']; ?> <?= $d['nomusu']; ?><br><small>
	                        </td>
	                        <td><?= $d['fechos']; ?></td>
	                        <td><?= $d['fhlle'] ?></td>
	                        <td><?= $d['tiempo'] ?></td>
	                        <td><?php
	                            if ($d['tipmin'] == "I") {
	                                echo "Entro";
	                            } else {
	                                echo "Salio";
	                            }
	                            ?></td>
	                    </tr>
	            <?php
	                }
	            }
	            ?>
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>Usuario</th>
	                <th>Entrada</th>
	                <th>Salida</th>
	                <th>Tiempo</th>
	                <th>Estado</th>
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