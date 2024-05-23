<h2 class="title-c">Reporte de Estados</h2>
<br><br>

<?php $url_action = base_url."repest/index"; ?>
<form id="formdes" name="frmdes" method="POST" action="<?=$url_action;?>">
	<div style="display: inline-block;">
		<?php if($anos){ ?>
			<select name="ano" class="form-control"  onchange="this.form.submit();">
				<?php foreach ($anos as $dtano) { ?>
					<option <?php if($dtano["ano"]==$ano) echo " SELECTED "; ?>><?=$dtano["ano"];?></option>
				<?php } ?>
			</select>
		<?php } ?>
	</div>
</form>

<style type="text/css">
.highcharts-figure, .highcharts-data-table table {
    min-width: 360px; 
    max-width: 1000px;
    margin: 1em auto;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

		</style>


<script src="../code/highcharts.js"></script>
<script src="../code/modules/series-label.js"></script>
<script src="../code/modules/exporting.js"></script>
<script src="../code/modules/export-data.js"></script>
<script src="../code/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description"></p>
</figure>

<script type="text/javascript">
	Highcharts.chart('container', {

	    title: {
	        text: 'Contratos'
	    },

	    subtitle: {
	        text: 'Estado / Mes'
	    },

	    yAxis: {
	        title: {
	            text: 'Valores'
	        }
	    },

	    xAxis: {
	        // accessibility: {
	        //     rangeDescription: 'Range: 2010 to 2017'
	        // }
	        categories: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic']
	    },

	    legend: {
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'middle'
	    },

	    plotOptions: {
	        line: {
	            dataLabels: {
	                enabled: true
	            },
	            enableMouseTracking: false
	        }
	    },

	    series: [{
	        <?php
	        $con=1; 
	        foreach ($estados as $f){
	        	//$datnoco = $contrato->selcanabo($f['perid'],$ano); ?>
	        name: '<?=strtoupper($f['valnom']);?>',
	        data: [
	            	<?php
	            		$t = 0;
	                	for ($i=1; $i<=12; $i++) {
	                		$datnoco = $contrato->setotactn($ano, $i, $f['valid']); 
	                		if($datnoco){
	                			$can = 0;
	                			foreach ($datnoco as $dtc) {
	                				if($dtc['mes']==$i){
	                					if($dtc['cant']) $can = $dtc['cant'];
	                				}
	                			}
	                			echo $can;
	                		}else{ echo 0; }
	            			if($t<11) echo ",";
	            			$t++;
	                	}
	                ?>
	        ]
	            <?php 
	            	if($con<(count($estados))) echo "}, {";
	           		$con++;
	           	?>
	        <?php } ?>
	    }],

	    responsive: {
	        rules: [{
	            condition: {
	                maxWidth: 500
	            },
	            chartOptions: {
	                legend: {
	                    layout: 'horizontal',
	                    align: 'center',
	                    verticalAlign: 'bottom'
	                }
	            }
	        }]
	    }

	});
</script>

<br><br>

<div class="table-responsive">
	<?php if($estados){ ?>
		<table id="example" class="table table-striped table-bordered dterpce" style="width:100%;">
			<thead>
				<tr>
					<th><small>Est</small>ados</th>
					<th><small>Ene</small></th>
					<th><small>Feb</small></th>
					<th><small>Mar</small></th>
					<th><small>Abr</small></th>
					<th><small>May</small></th>
					<th><small>Jun</small></th>
					<th><small>Jul</small></th>
					<th><small>Ago</small></th>
					<th><small>Sep</small></th>
					<th><small>Oct</small></th>
					<th><small>Nov</small></th>
					<th><small>Dic</small></th>
					<th><small>Total</small></th>
				</tr>
			 </thead>
			 <tbody>
			 	<?php foreach ($estados as $f){ ?>
			 		<tr>
			 			<td>
			 				<small><strong>
			 					<?= strtoupper($f['valnom']);?>
			 				</strong></small>
			 			</td>
	 					<?php $tot = 0; ?>
	 					<?php for ($i=1; $i<=12; $i++) {  ?>
	 						<td><small>
	 							<?php 
	 								$datnoco = $contrato->setotactn($ano, $i, $f['valid']); 
	 								if($datnoco){
										echo $datnoco[0]['cant'];
										$toms[$i] += $datnoco[0]['cant'];
										$tot += $datnoco[0]['cant'];
									}
	 							?>
	 						</small></td>
	 					<?php } ?>
	 					<th>
					 		<?php 
					 			echo $tot;
								$toms[13] += $tot; 
					 		?>
					 	</th>			 			
			 		</tr>
			 	<?php } ?>	 		
			 </tbody>
			<thead>
				<tr>
				 	<th><small>Total</small></th>
				 	<?php for ($i=1; $i<=12; $i++) { ?>
				 		<th><small><?=$toms[$i];?></small></th>
				 	<?php } ?>
				 	<th><small><?=$toms[13];?></small></th>
				 </tr>
			</thead>			 
		</table>
	<?php }else{ ?>
		<center><h5>No existen resultados</h5></center><br><br>
	<?php } ?>
</div>		


