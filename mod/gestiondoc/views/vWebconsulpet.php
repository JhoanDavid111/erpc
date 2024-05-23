<h2 class="title-c">
   Consultar registro de peticiones por fecha
</h2>
<br>
<br>

<form class="m-tb-40" action="<?=base_url?>radica/webconsultapetfechas" method="POST">
   <div class="row">
      <div class="form-group col-md-2" id="go1">
         <label for="fecin">Fecha Inicial</label>
         <input type="date" class="form-control form-control-sm" id="fecin" name="fecin"  required />
      </div>
      <div class="form-group col-md-2" id="go1">
         <label for="fecfi">Fecha Final</label>
         <input type="date" class="form-control form-control-sm" id="fecfi" name="fecfi" required />
      </div>
      <br>
      <div class="form-group col-md-2" id="go1">
         <button type="submit" class="btn-primary-ccapital">
            <i class="fa fa-search"></i> Buscar
         </button>
      </div>
   </div>
</form>