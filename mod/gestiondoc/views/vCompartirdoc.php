<h2 class="title-c">
	Compartir Expediente
</h2>
<br><br><br><br>

<form ame='frmcom' action='<?=base_url?>radica/compartir2' method='POST'>
    <table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
        <thead>
            <tr>
                <th>Dependencia</th>
                <th>Nombre Expediente</th>
                <th>Seríe</th>                          
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?=$valnom?></td>
                <td><?=$destrd?></td>
                <td><?=$seriedoc?></td>
            </tr>
        </tbody>
    </table>

    <label for="correo">Correo(s) <small>Separados por (;) sin espacios: </small></label>
    <input type="email" class="form-control" id="correo" name="correo" required>

    <input type="hidden" name="depid" value="<?=$depid?>">
    <input type="hidden" name="seriedoc" value="<?=$seriedoc?>">
    <input type="hidden" name="fechaexp" value="<?=$fechaexp?>">

    <input type="submit" class="btn-primary-ccapital" style="background-color: #ff0000;" value="Compartir">

</form>

