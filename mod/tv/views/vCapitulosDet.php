

<?php foreach($getSerie as $document): ?>
   <?php $id = (string) $document['_id'];  ?>
    
  <?php foreach($document as $key => $value){ ?>
     <?php //echo $key ?>
    <?php if($key == $idserie) { ?>
      <?php //echo $key ?>
      <?php 
          $codigo = substr($value['codigounico'], 0,5);
          $nt = substr($value['codigounico'], 5,2); 
          $nt2 = substr($value['codigounico'], 8,3);
      ?>

        <!-- ///////////////////////////////////// -->

          <link rel="stylesheet" href="../css/acordeon.css">
          <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->

          <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
          <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
            
          <!-- <script>
          $( function() {
              $( "#accordion" ).accordion({
                  active: false,
                collapsible: true,
                heightStyle: "content"
              });
            } );
          </script> -->

          <script>
            $( function() {
              $( "#accordion" ).accordion();
            } );

            $( function() {
              $( "#accordion2" ).accordion();
            } );

            $( function() {
              $( "#accordion3" ).accordion();
            } );
          </script>

          <style>
              .fondo_acordeon{
                  background-color: #D5EFFC;
                  color: #0D1F7C;
              }    

          </style>


          <h3 class="title-c m-tb-40">Cápitulos</h3>
          <br><br>
          <br><br>
          <!-- <select name="" id="">
              <option value="">Cambiar a otro capítulo</option>
          </select> -->
          <br><br>
          <div style="display: flex;justify-content: space-evenly;">
              <div>
                  <h6 style="font-size: 25px;">
                      <span class="badge badge-danger" ><?=$codigo;?></span>
                      <span class="badge badge-dark" style="margin-left:-5px;"><?=$nt;?></span> 
                      <span class="badge badge-danger" style="margin-left:-5px;">T</span> 
                      <span class="badge badge-dark" style="margin-left:-5px;"><?=$nt2;?></span>  

                       <?php if($value['cc']==true) { ?>
                          <span class="badge badge-light" style="margin-left:-5px;">C</span>
                          <?php }else{ ?>
                          <span class="badge badge-light"  style="margin-left:-5px;">X</span>
                      <?php } ?>   

                      <?php if($value['st']==true) { ?>
                          <span class="badge badge-light" style="margin-left:-5px;">S</span>
                          <?php }else{ ?>
                          <span class="badge badge-light"  style="margin-left:-5px;">X</span>
                      <?php } ?>

                      <?php if($value['lsc']==true) { ?>
                          <span class="badge badge-light" style="margin-left:-5px;">L</span>
                          <?php }else{ ?>
                          <span class="badge badge-light"  style="margin-left:-5px;">X</span>
                      <?php } ?> 

                      <a href="#" class="fa fa-file" style="font-size: 15px; color: gray;" title="Copiar"></a>                              
                  </h6>
              </div>
              <div> 
                <strong><span>Duración</span></strong>  
                <?php 
                    $segundoss = $value['duracion'];
                    $horas = floor($segundoss/3600);
                    $minutos = floor(($segundoss - ($horas*3600))/60);
                    $seg = floor($segundoss - (($horas * 3600)+ ($minutos*60)));
                    if($horas<10){
                        $horas = "0".$horas;
                    }
                    if($minutos<10){
                        $minutos = "0".$minutos;
                    }
                    if($seg<10){
                        $seg = "0".$seg;
                    }
                    //echo $horas.":".$minutos.":".$seg;
                ?>

                <span class="badge badge-secondary" style="font-size: 20px;"><?=$horas.":".$minutos.":".$seg;?></span>
              </div>
          </div>
              
          <br><br>
          <span style="font-size: 20px;"><?=$value['nombre'];?></span><span>&nbsp;&nbsp;</span><a href="#" class="fa fa-file" style="font-size: 15px; color: gray;" title="Copiar"></a> 

          <br>
          <br>

          <div id="accordion">
            <h3>General <i class="fa fa-file-video-o" aria-hidden="true"></i></h3>
            <div class="fondo_acordeon">

              <div style="background-color: #0E0E79; color: white; padding: 5px;">
                <span>Argumento</span>
              </div>
              <br>
              <p>
                <?=$value['storyline'];?>
              </p>

              <br>
              <div style="background-color: #0E0E79; color: white; padding: 5px;">
                <span>Sinopsis</span>
              </div>
              <br>
              <p>
                <?=$value['sinopsis'];?>
              </p>

            </div>


            <h3>Temas <i class="fa fa-book" aria-hidden="true"></i></h3>
            <div class="fondo_acordeon">
              <div style="background-color: #0E0E79; color: white; padding: 5px;">
                <span>Subtemas</span>
              </div>
              <br>
              <p>
                <?php 

                  if (isset($value['subtemas'])) {
                    if ($value['subtemas']!="") {
                      $reg=count($value['subtemas']);
                      for ($i=0; $i < $reg ; $i++) { 
                        echo $value['subtemas'][$i];
                        echo '<br>';
                      }
                    }else{
                      echo "Sin Información";
                    }
                    
                  }else{
                    echo "Sin Información";
                  }

                 ?>
               
              </p>

              <br>
              <div style="background-color: #0E0E79; color: white; padding: 5px;">
                <span>Ubicación Geográfica</span>
              </div>
              <br>
              <p>
                <?php 

                  if (isset($value['localidades'])) {
                    if ($value['localidades']!="") {
                      $reg=count($value['localidades']);
                      for ($i=0; $i < $reg ; $i++) { 
                        echo $value['localidades'][$i];
                        echo '<br>';
                      }
                    }else{
                      echo "Sin Información";
                    }
                    
                  }else{
                    echo "Sin Información";
                  }
                ?>
              </p>

              <br>
              <div style="background-color: #0E0E79; color: white; padding: 5px;">
                <span>Público Objetivo</span>
              </div>
              <br>
              <p>
                <?php 

                  if (isset($value['publico'])) {
                    if ($value['publico']!="") {
                      $reg=count($value['publico']);
                      for ($i=0; $i < $reg ; $i++) { 
                        echo $value['publico'][$i];
                        echo '<br>';
                      }
                    }else{
                      echo "Sin Información";
                    }
                    
                  }else{
                    echo "Sin Información";
                  }
                ?>
              </p>
            </div>
            <h3>Premios <i class="fa fa-trophy" aria-hidden="true"></i></h3>
            <div class="fondo_acordeon">
              <p>
                 <?php 
                 
                  if (isset($value['premios'])) {
                    foreach($value['premios'] AS $premio =>$prem){
                      echo "<strong>Tipo: </strong>".$prem->tipo. "<br><br>";
                      echo "<strong>Año: </strong>".$prem->year. "<br><br>";
                      echo "<strong>Evento: </strong>".$prem->evento. "<br><br>";
                      echo "<strong>Describe: </strong>".$prem->describe. "<br><br>";
                      echo "<strong>Ciudad-País: </strong>".$prem->ciudadpais. "<br>";
                      
                    }
                    
                    
                  }else{
                    echo "Sin Información";
                  }

                  
                ?>                
              </p>
             <!--  <ul>
                <li>List item one</li>
                <li>List item two</li>
                <li>List item three</li>
              </ul> -->
            </div>
          </div>


          <br><br>
          <h4 class="title-c m-tb-40">Enlaces</h4>

          <br>
          <br>


          <div id="accordion2">
            <h3>Entregables <i class="fa fa-film" aria-hidden="true"></i></h3>
            <div class="fondo_acordeon">
              <table  class="table table-striped table-bordered dterpceTVcapi"  style="width:100%;">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Enlace</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
                
              </table>
            </div>
            <h3>Archivos de Vídeo <i class="fa fa-video-camera  mr-3"></i></h3>
            <div class="fondo_acordeon">
              <p>
              Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
              purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
              velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
              suscipit faucibus urna.
              </p>
            </div>
            <h3>Convergentes <i class="fa fa-television" aria-hidden="true"></i></h3>
            <div class="fondo_acordeon">
              <p>
              Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
              Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
              ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
              lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
              </p>
              <ul>
                <li>List item one</li>
                <li>List item two</li>
                <li>List item three</li>
              </ul>
            </div>
          </div>

          <br><br>
          <h4 class="title-c m-tb-40">Historial</h4>

          <br>
          <br>

          <div id="accordion3">
            <h3>Historial de cambios del episodio <i class="fa fa-database" aria-hidden="true"></i></h3>
            <div class="fondo_acordeon">
              <p>
              Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
              ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
              amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
              odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
              </p>
            </div>
            

         

         


        <!-- //////////////////////////////////// -->




    <?php } ?>
  <?php } ?>
<?php endforeach ?> 


 <!-- SE DETIENE LA EJECUCION DEL CODIGO PARA QUE FUNCIONE EL ACORDEON -->

 <?php die(); ?>



  



