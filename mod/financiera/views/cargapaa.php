
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

 <script type="text/javascript" src="js/filestyle.min.js"> </script>

 <?php 
    // $modelo= new conexion();
    // $conexion=$modelo->get_conexion();
    // $sql="SELECT us.*, ce.*, cu.*  FROM curcerti AS ce INNER JOIN usuario AS us ON ce.usuario=us.perid INNER JOIN cursos AS cu ON ce.curso=idcur ORDER BY ce.fecha ";
    // $result2=$conexion->prepare($sql);
    // //$result1->bindParam(":email",$email);
    // $result2->execute();

    // while($f=$result2->fetch()){
    //     $resultado2[]=$f;
    // }
       
 ?>



	<div class="wrapper d-flex align-items-stretch">
		

		<!-- Page Content  -->
		<div id="content" class="p-4 p-md-5 pt-5">

			<div class="container">

				 <?php if (isset($_SESSION['message'])){ ?>  
                  
            <div class="alert alert-<?=$_SESSION['message_type']?> alert-dismissible fade show" role="alert">   
                <?=$_SESSION['message']?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
        <?php unset($_SESSION['message']); } ?> 
        <?php unset($_SESSION['message_type']); ?>
				
				<div class="cont-wrapper">
					<h2 class="title-c">Subir Archivo</h2>
					<br><br><br>

              <?php if (isset($_SESSION['message'])){ ?>  
                  
                  <div class="alert alert-<?=$_SESSION['message_type']?> alert-dismissible fade show" role="alert">   
                      <?=$_SESSION['message']?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                  </div>
              <?php unset($_SESSION['message']); } ?> 
              <?php unset($_SESSION['message_type']); ?>

              <!--  <form class="forms-sample" action="<?=base_url;?>paa/subirArchpaa" name="importa" method="post" enctype="multipart/form-data"> -->
               <form class="forms-sample" action="<?=base_url;?>paa/subirArchpaa" name="importa" method="post" enctype="multipart/form-data">                

	               <div class="form-group">
	                   <label>Cargar Documento</label>
	                  <input type="file" class="filestyle" data-buttonText="Seleccione archivo" name="arcexc" accept=".xls,.xlsx">
	               </div>
	               
	               <button type="submit" name="enviar" class="btn-secondary-canalc">IMPORTAR</button>

	               <input type="hidden" value="upload" name="action" />
	               <input type="hidden" value="usuarios" name="mod">
	               <input type="hidden" value="masiva" name="acc">
                     
                </form>
				</div>
			</div>
		</div>
	</div>

	<script src="../js/jquery.min.js"></script>
	<script src="../js/popper.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/main.js"></script>



    