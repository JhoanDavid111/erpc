<div style="margin: 20px auto; max-width: 95%;" class="row">

	
	
	<div id="inser">

		<h2 class="title-c m-tb-40">Simulador Temporal <Temporal></Temporal></h2>
		<br><br>

		<form action="<?=base_url;?>simulador/oneSal" method="POST">
			<div class="row">				
				<div class="form-group col-md-4">
					<label for="">Seleccion de Honorarios Contratista:</label>
					<select class="num form-control form-control-md" id="selsal" name="selsal" style="font-size: 14px; padding: 0px; text-align: right;">

						<?php 

							//number_format($total, 2, ',', '.');
							//2 Indica el número de decimales a mostrar
							//',' Indica el separador que se va a usar para el separador de los decimales
							//'.' Indica el separador que se va a usar para el separador de los miles

						 ?>


						<?php foreach($salario as $sal){ ?>

							<option class="num" value="<?=$sal['rangosalario'];?>" <?=$sal['rangosalario']==$oneSal[0]['rangosalario'] ? ' selected ' : ''; ?> >$ <?=number_format($sal['rangosalario'], 2, ',', '.');?>		
							</option>
							
						<?php } ?>
					</select>					
				</div>				
				<div class="form-group col-md-4">
					<input type="submit" class="btn-primary-ccapital" value="Buscar" style="margin-top:30px !important; padding: 5px !important;">
				</div>
				
			</div>

			<div class="row align-items-end" >
				<div class="form-group col-md-4">
					<div class="input-group input-group-sm mb-3" style="margin-top:30px;">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="inputGroup-sizing-sm">Salario Mensual</span>
					    <span class="input-group-text">$</span>
					  </div>
					  <input type="text" class="num form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly="" value="<?=isset($oneSal[0]['saldevtem']) ? number_format($oneSal[0]['saldevtem'], 2, ',', '.') : '0'; ?>"  style="text-align: right;" >
					</div> 
				</div>

				<div class="form-group col-md-4">
					<div class="input-group input-group-sm mb-3" style="margin-top:30px;">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="inputGroup-sizing-sm">Aux. Transporte</span>
					    <span class="input-group-text">$</span>
					  </div>
					  <input type="text" class="num form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly="" value="<?=isset($oneSal[0]['auxtransp']) ? number_format($oneSal[0]['auxtransp'], 2, ',', '.') : '0'; ?>"  style="text-align: right;" >
					</div>
				</div>
			</div>	
			
		</form>

		<form>
			<div class="contsimul" style="display: flex;justify-content: space-between; flex-wrap: wrap;">

				<div class="simulador" style="border-color: #523178 !important; border-width: 1px; border-style: solid; max-width:33%; padding: 10px; font-size: 14px;">
					<div style="text-align: right;">
						<i class="fas fa-question-circle" style="color:#523178; font-size: 16px;" data-title="VALOR PRESTACIONES SOCIALES EMPLEADO:	 Las prestaciones sociales son beneficios legales y adicionales al salario que debe reconocer el empleador a su empleado que ha sido vinculado bajo un contrato de trabajo con la organización. Estas prestaciones se cancelarán en los tiempos estipulados por la norma y/o en la liquidación."></i>
					</div>
					
					<legend><h6 class="title-c">Simulación Asignación Salarial Temporal</h6></legend>
					<div class=""><br>						

						<div class="input-group input-group-sm mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">Cesantías&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						    <span class="input-group-text">$</span>
						  </div>
						  <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly="" value="<?=isset($oneSal[0]['cesantias']) ? number_format($oneSal[0]['cesantias'], 2, ',', '.') : '0'; ?>"  style="text-align: right;" >
						</div>

						<div class="input-group input-group-sm mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">Int. Cesantías&nbsp;&nbsp;&nbsp;&nbsp;</span>
						    <span class="input-group-text">$</span>
						  </div>
						   <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly="" value="<?=isset($oneSal[0]['intcesantias']) ? number_format($oneSal[0]['intcesantias'], 2, ',', '.') : '0'; ?>"  style="text-align: right;" >
						</div>

						<div class="input-group input-group-sm mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">Prima&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						    <span class="input-group-text">$</span>
						  </div>
						   <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly="" value="<?=isset($oneSal[0]['prima']) ? number_format($oneSal[0]['prima'], 2, ',', '.') : '0'; ?>"  style="text-align: right;" >
						</div>

						<div class="input-group input-group-sm mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">Vacaciones&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						    <span class="input-group-text">$</span>
						  </div>
						   <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly="" value="<?=isset($oneSal[0]['vacaciones']) ? number_format($oneSal[0]['vacaciones'], 2, ',', '.') : '0'; ?>"  style="text-align: right;" >
						</div>

					</div>
				</div>

				<div class="simulador" style="border-color: #523178 !important; border-width: 1px; border-style: solid; max-width:34%; padding: 10px; font-size: 14px;">
					<div style="text-align: right;">
						<i class="fas fa-question-circle" style="color:#523178; font-size: 16px;" data-title=" DEDUCCIONES MENSUALES EMPLEADO: Las deducciones son los descuentos o valores que se le restan o deducen al trabajador de su total devengado. Estas son las de norma. No se coloca valor de Retefuente porque depende de diferentes conceptos y de la persona.

"></i>
					</div>
					<legend><h6 class="title-c">Deducciones Mensuales <br>Empleado</h6></legend>
					<div class=""><br><br>

						<div class="input-group input-group-sm mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">Salud&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						    <span class="input-group-text">$</span>
						  </div>
						   <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly="" value="<?=isset($oneSal[0]['salud4']) ? number_format($oneSal[0]['salud4'], 2, ',', '.') : '0'; ?>"  style="text-align: right;" >
						</div>

						<div class="input-group input-group-sm mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">Pensión&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						    <span class="input-group-text">$</span>
						  </div>
						   <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly="" value="<?=isset($oneSal[0]['pension4']) ? number_format($oneSal[0]['pension4'], 2, ',', '.') : '0'; ?>"  style="text-align: right;" >
						</div>

						<div class="input-group input-group-sm mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">Ret. Fuente&nbsp;&nbsp;&nbsp;</span>
						    <span class="input-group-text">$</span>
						  </div>
						   <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly="" value="<?=isset($oneSal[0]['retfuente4']) ? number_format($oneSal[0]['retfuente4'], 2, ',', '.') : '0'; ?>"  style="text-align: right;" >
						</div>

						<div class="input-group input-group-sm mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">Fondo Salud&nbsp;</span>
						    <span class="input-group-text">$</span>
						  </div>
						   <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly="" value="<?=isset($oneSal[0]['fondosol']) ? number_format($oneSal[0]['fondosol'], 2, ',', '.') : '0'; ?>"  style="text-align: right;" >
						</div>
						
					</div>
				</div>

				<div class="simulador" style="border-color: #523178 !important; border-width: 1px; border-style: solid; max-width:33%; padding: 10px; font-size: 14px;">
					<div style="text-align: right;">
						<i class="fas fa-question-circle" style="color:#523178; font-size: 16px;" data-title="VALORES ASUMIDOS POR LA EMPRESA POR CADA EMPLEADO: Aportes y pagos que la empresa debe realizar mensualmente por cada empleado."></i>
					</div>
					<legend><h6 class="title-c">Valores Mensuales Asumidos Por La Empresa</h6></legend>
					<div class=""><br>

						<div class="input-group input-group-sm mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">Salud&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						    <span class="input-group-text">$</span>
						  </div>
						   <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly="" value="<?=isset($oneSal[0]['salud8']) ? number_format($oneSal[0]['salud8'], 2, ',', '.') : '0'; ?>"  style="text-align: right;" >
						</div>

						<div class="input-group input-group-sm mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">Pensión&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						    <span class="input-group-text">$</span>
						  </div>
						  <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly="" value="<?=isset($oneSal[0]['pension12']) ? number_format($oneSal[0]['pension12'], 2, ',', '.') : '0'; ?>"  style="text-align: right;" >
						</div>

						<div class="input-group input-group-sm mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">Caja Compensación</span>
						    <span class="input-group-text">$</span>
						  </div>
						   <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly="" value="<?=isset($oneSal[0]['caja4']) ? number_format($oneSal[0]['caja4'], 2, ',', '.') : '0'; ?>"  style="text-align: right;" >
						</div>

						<div class="input-group input-group-sm mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">ARL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						    <span class="input-group-text">$</span>
						  </div>
						   <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly="" value="<?=isset($oneSal[0]['arl1']) ? number_format($oneSal[0]['arl1'], 2, ',', '.') : '0'; ?>"  style="text-align: right;" >
						</div>

						<div class="input-group input-group-sm mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">SENA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						    <span class="input-group-text">$</span>
						  </div>
						  <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly="" value="<?=isset($oneSal[0]['sena']) ? number_format($oneSal[0]['sena'], 2, ',', '.') : '0'; ?>"  style="text-align: right;" >
						</div>

						<div class="input-group input-group-sm mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">ICBF&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						    <span class="input-group-text">$</span>
						  </div>
						  <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly="" value="<?=isset($oneSal[0]['icbf']) ? 
						  number_format($oneSal[0]['icbf'], 2, ',', '.') : '0'; ?>"  style="text-align: right;" >
						</div>					

					</div>
				</div>

				
				
			</div>
			<div>
				<br>
				
			</div>
			<!-- <div class="" style="border-color: #523178 !important; border-width: 1px; border-style: solid; max-width:100%; padding: 10px; font-size: 14px;"><br>
				
				<div class="row"><br>

					<div class="input-group input-group-sm col-md-4">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="inputGroup-sizing-sm">Total Días</span>	    
					  </div>
					  <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
					</div>

					<div class="input-group input-group-sm col-md-4">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="inputGroup-sizing-sm">Liquidación</span>
					    <span class="input-group-text">$</span>
					  </div>
					  <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
					</div>

					<div class="input-group input-group-sm col-md-4">
						<input type="submit" class="btn-primary-ccapital" value="Calcular" style="margin-top:0px !important; padding: 5px !important;">
					</div>
					 
				</div>				
			</div> -->
		</form>	
		<div class="m-tb-40" style="font-size: 12px;	">
			<p>
				El objeto de este simulador es proyectar información aproximada al interesado sobre el valor del salario mensual en un contrato laboral, partiendo de la base de los honorarios que devenga actualmente en contrato de prestación de servicios. 
			</p>
			<p>
				Retención en la fuente: Aplica para salarios mayores a $3.449.260. Esta se hará en los términos del Estatuto Tributario Nacional y podrá variar en atención a las particularidades de cada caso.
			</p>
			<p>
				En ningún caso este simulador reemplaza a los cálculos que corresponderá realizar al empleador en cumplimiento de las normas laborales vigentes, pues se trata de una proyección estimada que puede servir de referencia al usuario. Los valores arrojados por el simulador pueden cambiar de acuerdo a fechas o situaciones normativas particulares.
			</p>
			<p>	
				Este simulador es una herramienta auxiliar que facilita Capital y que no tiene relación alguna con la existencia un vínculo laboral y de este no se derivan obligaciones para ninguna de las partes.
			</p>
		</div>	
	</div>
</div>
 
<!-- <script type="text/javascript">
	$(".num").keyup(function() {

	    this.value = parseFloat(this.value.replace(/,/g, ""))
            .toFixed(2)
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	});
</script>
 -->
