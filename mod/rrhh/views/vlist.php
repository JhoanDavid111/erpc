<?php if($txtn){ ?>
	<div style="color: #ff0000;font-weight:bold;text-shadow: 1px 1px 1px #787676;">
		¡Su evento o capacitación ha sido <?=$txtn;?>.!<br><br>
	</div>
<?php }?>

<!-- Ver datos -->

<h2 class="title-c">Lista de asistencia &nbsp;&nbsp;&nbsp;
	<a href="<?=base_url?>views/pdflistado.php?idce=<?=$idce;?>" target="_blank">
		<i class="fa fa-print" style="color: #ff0000;"></i>
	</a>
</h2><br><br>

<?php if($datOne){ ?>  
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
            <tr>
                <th>EVENTO:</th>
                <td><?=$datOne[0]['nomce'];?></td>
            </tr>
            <tr>
                <th>FECHA:</th>
                <td><?=$datOne[0]['fecince']." hasta ".$datOne[0]['fecince'];?></td>
            </tr>
            <tr>
                <th>TIPO / MODALIDAD:</th>
                <td><?=$datOne[0]['tipo']." / ".$datOne[0]['modal'];?></td>
            </tr>
            <tr>
                <th>ENTIDAD:</th>
                <td><?=$datOne[0]['entce'];?></td>
            </tr>
	    </table>
	</div>
<?php } ?>  

<br><br>
<?php //$url_action2 = base_url."capeve/index"; ?>
<div class="table-responsive">
	<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
        <thead>
            <tr>
                <th>CEDULA</th>
                <th>NOMBRE</th>
                <th>CARGO / ACTIVIDAD</th>
                <th>ÁREA</th>
                <!-- <th>FIRMA</th> -->
                <th>Asistió?</th>
            </tr>
        </thead>
        <tbody>
        	<?php
        	if(isset($list)){
        		foreach ($list as $ls){ ?>  
        			<tr>
	            		<td><?=$ls['nodocemp'];?></td>
	                	<td><?=$ls['pernom']." ".$ls['perape'];?></td>
	                	<td><?=$ls['carg'];?></td>
	                	<td><?=$ls['valnom'];?></td>
	                	<!-- <td></td> -->
	                	<td style="text-align: center;">
                            <input type="checkbox" name="chkasis" <?php if($ls['asis']==1) echo "checked"; ?> style="width: 30px;height: 30px;">
                        </td>
	            	</tr>
	   		<?php }} ?>
        </tbody>
        <tfoot>
            <tr>
                <th>CEDULA</th>
                <th>NOMBRE</th>
                <th>CARGO / ACTIVIDAD</th>
                <th>ÁREA</th>
                <!-- <th>FIRMA</th> -->
                <th></th>
            </tr>
        </tfoot>
    </table>
	
</div>

<?php if(isset($dtOnem)): ?>
	<script>ocultar(1,300);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>