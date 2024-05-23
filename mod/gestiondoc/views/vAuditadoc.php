<h2 class="title-c">
	Auditoría de expediente
</h2>
<br><br><br><br>

<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
    <thead>
        <tr>        	
            <th>Nombre Expediente</th>
            <th>Fecha Consulta</th>
            <th>Usuario</th>
            <th>Área</th>
            <th>Acción</th>					
        </tr>        
    </thead>
    <tbody>
        
        <?php if(isset($trazadoc)): ?>
            <?php   foreach($trazadoc AS $tr): ?>
                <tr>
                    <td><?=$tr['destrd'];?></td>
                    <td><?=$tr['fecha'];?></td>
                    <td><?=$tr['pernom']." ".$tr['perape'];?></td>
                    <td><?=$tr['valnom'];?></td>
                    <td><?=$tr['estado'];?></td>
                </tr>
            <?php   endforeach ?>
        <?php endif ?>
      
    </tbody>
</table>