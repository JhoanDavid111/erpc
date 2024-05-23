<h2 class="title-c">
	ROLES USUARIOS 
</h2>
<br>
<br>
<br>
<table id="example" class="table table-striped table-bordered dterpce " style="width:100%;">
			<!-- <table id="example" class="table table-striped table-bordered dterpce table-dark" style="width:100%;"> -->
	<thead>
		<tr style="text-align: center !important;">	
			<th>NOMBRE</th>									
			<th>CORREO</th>						
			<th>ÁREA</th>			
			<th>ROL</th>			
		</tr>			
	</thead>
	<tbody>
		<?php if(isset($users)){ ?>
			<?php foreach($users as $f): ?>
			
				<tr>
					<td><small><?=$f['pernom'].' '.$f['perape'];?></small></td> 
					<td><small><?=$f['peremail'];?></small></td>
					<td><small><?=$f['valnom'];?></small></td>
					<td><small><?=$f['pefnom'];?></small></td>   
				</tr>
			<?php endforeach; ?>	
		<?php } ?>	
	</tbody>
	<tfoot>
	    
	</tfoot>
</table>