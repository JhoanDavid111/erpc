

<h2 class="title-c">
	GESTIÓN DE ARCHIVOS - CARPETAS
</h2>
<br><br><br>


<?php $url_act2 = base_url."radica/index"; ?>


<?php $url_acttraz = base_url."radica/savetra"; ?>
 <br>

<!-- <table id="example" class="table table-striped table-dark table-bordered dterpceDSC" style="width:100%;"> -->		

<table id="example" class="table table-striped table-bordered dterpceDSC" style="width:100%;">

    <thead>
		<tr>
			<!-- <th rowspan="2">Tabla Avanzada</th> -->
			<th>ID</th>
			<th>EXPEDIENTE</th>						
			<th>SUBSERIE</th>			
			<th></th>
			<th></th>
		</tr>			
	</thead>

	<tbody>
		<?php 
			// var_dump($result);
			// die();
		 ?>
		<?php foreach($result as $f): ?>
			<tr>
				<td><?=$f['idexp'];?></td>
				<td><?=$f['anoexp'];?></td>
				<td><?=$f['destrd'];?></td>
				<!-- <td>
					<a href="" title="Activo">
                		<i class="fas fa-check-circle"></i> 
                	</a> 
                </td> -->

                <td>
					<a href="" title="Descargar">
                		<i class="fa fa-download"></i> 
                	</a> 
                </td>			
				
				<td>
					<a href="" title="Eliminar">
                		<i class="fas fa-trash-alt"></i> 
                	</a> 
                </td>
			</tr>
		<?php endforeach; ?>		
		
	</tbody>
    <tfoot>
        
    </tfoot>
</table>


<br>

<?php if(isset($edit) && isset($val)): ?>
	<script>ocultar(1,300);</script>
<?php else: ?>
	<script>ocultar(2,0);</script>
<?php endif; ?>


<script src="../js/sweetalert.min.js"></script>