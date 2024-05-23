<h6 class="title-c m-tb-40">Contenido</h6>
<br>
<br>
<br>
<div style="background-color: #A769A5; color: #fff; padding: 5px;">
	<span><?=$rama;?></span>
</div>

<?php 
		if ($allcat) {
			$depcat=$allcat[0]['depcat'];	
		}else{
			$depcat=0;
		}
		
		include'vdrive.php';
?>




