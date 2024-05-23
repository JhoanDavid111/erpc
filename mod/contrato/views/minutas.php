<h2 class="title-c m-tb-40">Buscar minuta</h2>
<br>
<br>
<form class="m-tb-40" action="<?=base_url;?>contrato/consultarminuta" method="POST">
  <div class="form-row">                     
      <div class="col-md-4 form-group">
          <label for="num_documento">Número de documento</label>
          <input type="number" class="form-control" id="num_documento" name="num_documento" required>
      </div>

      <div class="col-md-4">
         <label for="area">Área</label>
          <select id="area" name="area" class="form-control"  style="padding: 0px;" required>
            <option value="">Seleccione...</option>
              <?php foreach ($areas as $ar) { ?>
                  <option value="<?= $ar['valid']; ?>"><?= $ar['valnom']; ?></option>
              <?php } ?>
          </select>
      </div>  
      <div class="col-md-4 form-group">
          <button type="submit" class="btn-secondary-canalc ">Buscar</button>
      </div>
      <div class="col-md-4 form-group">
          
      </div>
  </div>
  
</form>




