<script src="js/my.js"></script>
<script src="../js/futic.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<?php
	date_default_timezone_set('America/Bogota');
	$feact = date("Y-m-d");
?>

<h2 class="title-c">Papelera Anteproyecto Financiero </h2> <br><br>



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
    		<?php foreach ($pfinand as $pf){ ?>
	            <tr>
	                <td>
	                	<small><small><small><span style="opacity: 0">
	                		<?=$pf['iddpa'];?><br>
	                	</span></small></small></small>
	                	<?=$ninipaa.$pf['codrub'];?>
	                </td>
	                <td>
	                	<?=$pf['nomrub'];?>
	                	<br><small>
	                		<strong>Iddpa: </strong>
	                		<?=$pf['iddpa'];?>
	                	</small>
	                </td>                
	                <td><?=$pf['nomcont'];?></td>
	                <td><?=$pf['fecinidpa'];?></td>
	                <td><?=$pf['fecfindpa'];?></td>
	                <!-- <td><?=$pf['nmesdpa'];?></td>   -->

	                <td style="text-align: right;">$ <?=number_format($pf['asidpa'], 0, ',', '.');?> </td>  
	                <td><?=$pf['valnom'];?></td>              
	                <td>
	                	<a href="<?=base_url?>anteli/AntRes&iddpa=<?=$pf['iddpa'];?>" title="Restaurar">
	                		<i class="fa fa-arrow-up" style="color: #0071bc;padding: 10px 5px;"></i>
	                	</a>
					</td>

	            </tr>
	        <?php } ?>

    	<?php endif; ?>

    	   
       
    </tbody>
    <tfoot>
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
    </tfoot>
</table>

</div>
