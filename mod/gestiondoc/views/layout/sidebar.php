<?php
session_start();
if(isset($_SESSION['pefid'])){
?>
<body>

	<div class="wrapper d-flex align-items-stretch">
		<nav id="sidebar">
			<div class="custom-menu">
				<button type="button" id="sidebarCollapse" class="btn btn-primary">
					<i class="fa fa-bars"></i>
					<span class="sr-only">Toggle Menu</span>
				</button>
			</div>
			<div class="p-4">
				<!--
				<h1><a href="index.html" class="logo"><img src="../img/logo-dash.png" alt=""></a></h1>
				-->
				<div class="encabezado-m">
				<section class="encabezado-a">
		            <div class="encabezado-a-2">
		                <div class="redesp">
		                    <a href="https://www.facebook.com/CanalCapitalOficial" title="Facebook CanalCapitalOficial" target="_blank">
		                        <span class="icono">
		                            <i class="fab fa-facebook-f"></i>
		                        </span>
		                    </a>
		                    <a href="https://twitter.com/canalcapital" title="Twitter canalcapital" target="_blank">
		                        <span class="icono">
		                            <i class="fab fa-twitter"></i>
		                        </span>
		                    </a>
		                    <a href="https://www.instagram.com/canalcapitaloficial/" title="Instagram canalcapitaloficial" target="_blank">
		                        <span class="icono">
		                            <i class="fab fa-instagram"></i>
		                        </span>
		                    </a>
		                    <a href="https://www.youtube.com/user/CanalCapitalBogota" title="Youtube CanalCapitalBogota" target="_blank">
		                        <span class="icono">
		                            <i class="fab fa-youtube"></i>
		                        </span>
		                    </a>
		                </div>
		            </div>
		        </section>

		        <section class="encabezado-b">
	                <div class="logo_entidad1">
	                    <a href="http://www.canalcapital.gov.co/">
	                        <img id="imaglog" src="https://intranet.canalcapital.gov.co/intranet/img/logocanal.png" alt="Logo Canal Capital" alt="Logo Canal Capital">
	                    </a>
	                </div>	                
		        </section>

		        </div>



<?php
	Utils::menu($_SESSION['idmod'],$_SESSION['pefid']);
?>
				<ul class="list-unstyled components mb-5">
					
					<li class="">
						<a href="<?=base_ini?>"><span class="fas fa-table mr-3"></span> Módulos</a>
					</li>
					<li class="">
						<a href="<?=base_url?>"><span class="fa fa-home mr-3"></span> Inicio</a>
					</li>
					<?php 
						$menu = $_SESSION['menu']; 
						foreach ($menu as $mn) {
					?>
						<li>
							<!-- <a href="<?=base_url?>?controller=paa&action=index"><span class="fa fa-file-text  mr-3"></span> PAA</a> -->
							<a href="<?=base_url.$mn['pagarc']?>"><span class="<?=$mn['icono']?>  mr-3"></span> <?=$mn['pagnom']?></a>
						</li>
					<?php  } ?>
				</ul>

				<div class="footer">
					<p>
						&copy;2021 Todos los derechos reservados | Canal Capital
					</p>
				</div>

			</div>
		</nav>

		<!-- Page Content  -->
		<?=Utils::salir()?>

<?php
}
?>