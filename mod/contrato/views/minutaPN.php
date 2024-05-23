
<h2 class="title-c m-tb-40">Minuta de contrato</h2>
<br><br>
<h2 class="title-c m-tb-40">CLÁUSULAS</h2>


<div class="container mt-5">
    <style>
        .form-label{
          font-weight: bold !important;
        }
    </style>
    
    <form>
      <!-- PRIMERA - OBJETO -->
      <div class="mb-3">
        <label for="objeto" class="form-label">PRIMERA. – OBJETO</label>
        <textarea class="form-control" id="objeto" name="objeto" rows="4" placeholder="Descripción del objeto del contrato" readonly><?=$cdp[0]['nobjeto']?></textarea>
      </div>
      
      <!-- ALCANCE DEL OBJETO -->
      <div class="mb-3">
        <label for="alcance" class="form-label">ALCANCE DEL OBJETO</label>
        <textarea class="form-control" id="alcance" name="alcance" rows="4" placeholder="Descripción del alcance del objeto del contrato" readonly>N/A</textarea>
      </div>
      
      <!-- SEGUNDA - VALOR -->
      <div class="mb-3">
        <label for="valor" class="form-label">SEGUNDA. - VALOR</label><br>
        <label for="">Para efectos fiscales y legales el valor del presente contrato es hasta por la suma
        </label>
        <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor del contrato" value="<?=$numeroFormateado;?> " readonly>        
      </div>
      <div class="mb-3">        
        <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor del contrato" value="<?=$valetras." "."PESOS M/CTE";?>" readonly>
      </div>
      
      <!-- PARÁGRAFO: GASTOS DE VIAJE Y DESPLAZAMIENTO -->
      <div class="mb-3">
        <label for="gastosViaje" class="form-label">PARÁGRAFO: GASTOS DE VIAJE Y DESPLAZAMIENTO</label>
        <textarea class="form-control" id="gastosViaje" name="gastosViaje" rows="4" placeholder="Descripción de los gastos de viaje y desplazamiento" readonly>En el evento que sea necesario el desplazamiento del CONTRATISTA por fuera de la ciudad de Bogotá D.C., para el desarrollo de las actividades objeto del contrato, CANAL CAPITAL determinará si se requiere el pago de sus gastos de viaje y para el efecto, se tendrán en cuenta las disposiciones de regulación vigentes; así mismo determinará si hay lugar al reconocimiento de los gastos de desplazamiento que sean requeridos (transporte aéreo o terrestre).
        </textarea>
      </div>
      
      <!-- TERCERA - PLAZO DE EJECUCIÓN -->
      <div class="mb-3">
        <label for="plazo" class="form-label">TERCERA. - PLAZO DE EJECUCIÓN</label>
        <textarea class="form-control" id="plazo" name="plazo" rows="4" placeholder="Descripción de los gastos de viaje y desplazamiento" >El plazo del presente contrato será de <?=$mesesFormateado." "."(".$cdp[0]['nmesdpa'].")";?> MESES, previa afiliación de la ARL y demás requisitos exigidos en los estudios previos de la contratación.

        </textarea>
      </div>
      
      <!-- CUARTA - FORMA DE PAGO -->
      <div class="mb-3">
        <label for="formaPago" class="form-label">CUARTA. FORMA DE PAGO</label>
        <textarea class="form-control" id="formaPago" name="formaPago" rows="4" placeholder="Descripción de la forma de pago"></textarea>
      </div>
      
      <!-- PARÁGRAFO PRIMERO - FORMA DE PAGO -->
      <div class="mb-3">
        <label for="parrafoPrimeroPago" class="form-label">PARÁGRAFO PRIMERO</label>
        <textarea class="form-control" id="parrafoPrimeroPago" name="parrafoPrimeroPago" rows="4" placeholder="" readonly>Para efectos del cómputo de los días, todos los meses del año se entenderán de treinta (30) días, comprendidos entre el (1) y el último día de cada mes; es decir, que una vez se cumpla dicho plazo, EL CONTRATISTA podrá presentar su cuenta de cobro.</textarea>
      </div>
      
      <!-- PARÁGRAFO SEGUNDO - FORMA DE PAGO -->
      <div class="mb-3">
        <label for="parrafoSegundoPago" class="form-label">PARÁGRAFO SEGUNDO </label>
        <textarea class="form-control" id="parrafoSegundoPago" name="parrafoSegundoPago" rows="4" placeholder="">Los pagos se realizarán previa certificación de cumplimiento a satisfacción por parte del supervisor del contrato. Para el último pago se deberá aportar certificación de cierre contractual del supervisor. Los pagos se efectuarán dentro de los quince (15) días siguientes al cumplimiento de los anteriores requisitos. CANAL CAPITAL hará las retenciones a que haya lugar sobre el pago, de acuerdo con las disposiciones legales vigentes.</textarea>
      </div>
      
      <!-- PARÁGRAFO TERCERO - CIERRE DE VIGENCIA FISCAL -->
      <div class="mb-3">
        <label for="parrafoTerceroVigencia" class="form-label">PARÁGRAFO TERCERO - CIERRE DE VIGENCIA FISCAL</label>
        <textarea class="form-control" id="parrafoTerceroVigencia" name="parrafoTerceroVigencia" rows="4" placeholder="Descripción del tercer párrafo sobre el cierre de vigencia fiscal" readonly>Los pagos a causar en el mes de diciembre, si aplica, se realizarán de conformidad con las fechas establecidas por CANAL CAPITAL, a través de la Subdirección Financiera para el cierre de la respectiva vigencia.</textarea>
      </div>
      
      <!-- QUINTA - OBLIGACIONES GENERALES DEL CONTRATISTA -->
      <div class="mb-3">
        <label for="obligacionesGenerales" class="form-label">QUINTA. - OBLIGACIONES GENERALES DEL CONTRATISTA</label><br>
        <label for="">EL CONTRATISTA se obliga con CANAL CAPITAL a: </label><br>
        <?php $n=1; ?>
        <?php foreach($obligagen AS $obg){ ?>
            <input type="text" name="obliga[]" class="form-control" value="<?=$n.". ".$obg['obliga']?>" readonly>
            <?php $n++; ?>
        <?php } ?>
      </div>
      
      <!-- PARÁGRAFO - RESPONSABILIDAD DE EQUIPOS Y ELEMENTOS -->
      <div class="mb-3">
        <label for="parrafoResponsabilidadEquipos" class="form-label">PARÁGRAFO - RESPONSABILIDAD DE EQUIPOS Y ELEMENTOS</label>
        <textarea class="form-control" id="parrafoResponsabilidadEquipos" name="parrafoResponsabilidadEquipos" rows="7" placeholder="Descripción del párrafo sobre la responsabilidad de equipos y elementos" readonly>Cuando se presente daño o pérdida de los equipos o elementos que le sean entregados a él por parte de CANAL CAPITAL para el desarrollo del objeto del presente contrato en caso que hubiera lugar a ello, con la suscripción de este documento, el CONTRATISTA autoriza de manera clara y expresa a CANAL CAPITAL para descontar de los pagos que estén pendientes a su favor el valor de los equipos o elementos dañados o perdidos, sin perjuicio de las acciones legales a que haya lugar, salvo que la compañía aseguradora del Canal reconozca dicho valor, en cuyo caso el CONTRATISTA autoriza el descuento del valor que se deba cancelar a título de deducible. Lo anterior sin perjuicio de lo previsto en la cláusula vigésima quinta del presente contrato</textarea>
      </div>
      
      <!-- SEXTA - OBLIGACIONES ESPECÍFICAS DEL CONTRATISTA -->
      <div class="mb-3">
        <label for="obligacionesEspecificas" class="form-label">SEXTA. - OBLIGACIONES ESPECÍFICAS DEL CONTRATISTA</label>
        <?php $n=1; ?>
        <?php foreach($obligacon AS $obc){ ?>
            <input type="text" name="obligaEsp[]" class="form-control" value="<?=$n.". ".$obc['obliga']?>" readonly>
            <?php $n++; ?>
        <?php } ?>
      </div>

      <!-- SEPTIMA -->
      <div class="mb-3">
        <label for="inhabilidadesIncompatibilidades" class="form-label">SÉPTIMA -OBLIGACIONES DE CANAL CAPITAL:</label>
        <textarea class="form-control" id="septima" name="septima" rows="4" placeholder="Descripción de las inhabilidades e incompatibilidades" readonly>1. Pagar al CONTRATISTA las sumas estipuladas en este contrato, en la oportunidad y forma establecida. 2. Proporcionar la información y documentación requerida para la normal ejecución del objeto contractual. 3. Vigilar, supervisar y/o controlar la ejecución idónea y oportuna del objeto del contrato.</textarea>
      </div>

      <!-- OCTAVA -->
      <div class="mb-3">
        <label for="inhabilidadesIncompatibilidades" class="form-label">OCTAVA. -SUPERVISIÓN:</label>
        <textarea class="form-control" id="octava" name="octava" rows="4" placeholder="Descripción de las inhabilidades e incompatibilidades" readonly>CANAL CAPITAL ejercerá la supervisión del contrato a través del PROFESIONAL ESPECIALIZADO DEL ÁREA DE SISTEMAS o quien haga sus veces.</textarea>
      </div>

      <!-- NOVENA -->
      <div class="mb-3">
        <label for="inhabilidadesIncompatibilidades" class="form-label">NOVENA. -OBLIGACIONES DEL SUPERVISOR:</label>
        <textarea class="form-control" id="novena" name="novena" rows="5" placeholder="Descripción de las inhabilidades e incompatibilidades" readonly>El supervisor del contrato deberá cumplir con cada una de las funciones establecidas en la ley, en la Resolución 115 de 2022 de CANAL CAPITAL en materia de supervisión y demás normas o reglamentos que regulen la materia, a partir de la suscripción del contrato. En especial, deberá: 1. Conocer los antecedentes de la contratación. 2. Velar por el cumplimiento de las obligaciones del contrato. 3. Velar por el cumplimiento de los asuntos relacionados con los derechos de autor. 4. Todas las demás obligaciones que se desprendan de la vigilancia y control del contrato.</textarea>
      </div>

      <!-- DECIMA -->
      <div class="mb-3">
        <label for="inhabilidadesIncompatibilidades" class="form-label">DÉCIMA. -GARANTÍAS CONTRACTUALES:</label>
        <textarea class="form-control" id="decima" name="decima" rows="5" placeholder="Descripción de las inhabilidades e incompatibilidades" readonly>De conformidad con lo dispuesto en los estudios previos de esta contratación y en concordancia con lo dispuesto en la Nota 2 del numeral 3.1.17 del Manual de contratación del Canal, para el presente contrato el contratista no está obligado a constituir a favor de canal capital ningún tipo de una garantía, como quiera que su cuantía es inferior a 20 SMLMV, y el área solicitante no considera necesario solicitar la misma.
        </textarea>
      </div>

      <!-- DECIMA PRIMERA -->
      <div class="mb-3">
        <label for="inhabilidadesIncompatibilidades" class="form-label">DÉCIMA PRIMERA. -MODIFICACIONES CONTRACTUALES:</label>
        <textarea class="form-control" id="decimaprimera" name="decimaprimera" rows="5" placeholder="Descripción de las inhabilidades e incompatibilidades" readonly>A este contrato le son aplicables modificaciones contractuales que se requieran para su debida ejecución y cumplimiento, las cuales deberán constar mediante escrito y contar con la debida justificación para su realización. La respectiva solicitud deberá realizarse al menos con cinco (5) días de anticipación.
        </textarea>
      </div>

      <!-- DECIMA SEGUNDA -->
      <div class="mb-3">
        <label for="inhabilidadesIncompatibilidades" class="form-label">DÉCIMA SEGUNDA. -SUSPENSIÓN TEMPORAL DEL CONTRATO:</label>
        <textarea class="form-control" id="decimasegunda" name="decimasegunda" rows="5" placeholder="Descripción de las inhabilidades e incompatibilidades" readonly>Las partes de común acuerdo o por circunstancias de fuerza mayor o caso fortuito debidamente comprobadas, podrán suspender la jecución del presente contrato mediante la suscripción de un acta en la cual conste el evento que motivó la suspensión, sin que para efectos del plazo de ejecución del contrato se compute el tiempo de la suspensión. De igual manera procederá el Canal en el evento en que se determine por parte del supervisor y con aprobación del ordenador del gasto que se debe suspender de manera unilateral el contrato. La respectiva solicitud deberá realizarse al menos con cinco (5) días de anticipación.
        </textarea>
      </div>

      <!-- DECIMA TERCERA -->
      <div class="mb-3">
        <label for="inhabilidadesIncompatibilidades" class="form-label">DÉCIMA TERCERA. -CESIÓN Y SUBCONTRATACIÓN:</label>
        <textarea class="form-control" id="decimatercera" name="decimatercera" rows="5" placeholder="Descripción de las inhabilidades e incompatibilidades" readonly>EL CONTRATISTA no podrá ceder ni subcontratar total ni parcialmente los derechos u obligaciones surgidos de este Contrato a persona alguna natural o jurídica, nacional o extranjera, sin la autorización previa y escrita de CANAL CAPITAL. La cesión del contrato se hará constar en acta suscrita por las partes. EL CONTRATISTA deberá realizar la respectiva solicitud, al menos con cinco (5) días de anticipación.
        </textarea>
      </div>

      <!-- DECIMA CUARTA -->
      <div class="mb-3">
        <label for="inhabilidadesIncompatibilidades" class="form-label">DÉCIMA CUARTA. -TERMINACIÓN:</label>
        <textarea class="form-control" id="decimacuarta" name="decimacuarta" rows="5" placeholder="Descripción de las inhabilidades e incompatibilidades" readonly>Este contrato se dará por terminado en cualquiera de los siguientes eventos: 1. Por agotamiento del objeto o vencimiento del plazo sin que se haya suscrito una prórroga. 2. Cuando las partes, de común acuerdo, terminan la relación contractual antes del vencimiento del plazo de ejecución pactado en el contrato. 3. Por fuerza mayor o caso fortuito que hagan imposible continuar su ejecución.
        </textarea>
      </div>

      <!-- DECIMA cuanta paragrafo  -->
      <div class="mb-3">
        <label for="inhabilidadesIncompatibilidades" class="form-label">PARÁGRAFO:</label>
        <textarea class="form-control" id="decimacuartapara" name="decimacuartapara" rows="5" placeholder="Descripción de las inhabilidades e incompatibilidades" readonly>La terminación anticipada del contrato se hará constar en acta suscrita por las partes. En caso de terminación anormal del contrato, se procederá a su liquidación y al pago proporcional de los servicios prestados o bienes efectivamente suministrados. EL CONTRATISTA deberá realizar la respectiva solicitud, al menos con cinco (5) días de anticipación.
        </textarea>
      </div>

      <!-- DECIMA QUINTA  -->
      <div class="mb-3">
        <label for="inhabilidadesIncompatibilidades" class="form-label">DÉCIMA QUINTA. -DERECHOS DE AUTOR Y CONEXOS:</label>
        <textarea class="form-control" id="decimaquinta" name="decimaquinta" rows="15" placeholder="Descripción de las inhabilidades e incompatibilidades" readonly>De acuerdo con lo previsto en la Ley 23 de 1982, la Ley 1450 de 2011 y demás normas concordantes, con la firma del presente documento el CONTRATISTA cede en favor de CANAL CAPITAL a perpetuidad y sin ninguna limitación, la totalidad de los derechos patrimoniales de autor y conexos de las obras o creaciones derivadas o resultantes de este acuerdo de voluntades a partir de la fecha de suscripción del mismo, sin limitación territorial
alguna. Por lo anterior, reconoce y acepta que CANAL CAPITAL es el dueño exclusivo de los derechos
de todas las obras y creaciones que se generen en torno a la ejecución del objeto del contrato, y en
razón a ello, CANAL CAPITAL podrá efectuar las modificaciones o transformaciones que este último
considere necesarias para el uso adecuado de la obra o creación resultante. En consecuencia, CANAL
CAPITAL como titular de los derechos patrimoniales de autor y conexos de las creaciones, podrá
explotarlos directamente o a través de terceros, por cualquier medio inventado o por inventarse.
Durante la ejecución del presente contrato, EL CONTRATISTA se obliga a respetar los derechos de
autor y conexos de todos los contenidos u obras de propiedad de terceros que utilice para el
cumplimiento de sus obligaciones con CANAL CAPITAL. Para tal efecto deberá obtener formalmente y
por escrito las autorizaciones y/o cesiones necesarias, en las condiciones exigidas, para lo cual deberá
informar y/o consultar a su supervisor. La no observancia de esta obligación podrá ser considerada
causal de terminación del presente contrato de prestación de servicios. Así mismo, EL CONTRATISTA se
obliga a mantener a CANAL CAPITAL libre de toda reclamación de terceros que tenga origen en las
actuaciones del CONTRATISTA y defenderá a CANAL CAPITAL de cualquier pleito, queja o demanda y
responsabilidad de cualquier naturaleza, incluyendo indemnizaciones, costos, gastos, honorarios de
abogados y costas de procesos de cualquier índole por cualquier infracción. En caso de ser necesario y
si la premura de los hechos obliga a CANAL CAPITAL a enfrentar cualquier tipo de reclamación o
proceso, asumirá directamente el pago de indemnizaciones, costos, gastos, honorarios de abogados y
costas procesales de cualquier índole, sin perjuicio de repetir contra el CONTRATISTA para recuperar
cualquier valor en el que haya incurrido así como los daños y perjuicios generados, razón por la cual,
EL CONTRATISTA autoriza a CANAL CAPITAL a realizar la deducciones a que haya lugar. En
consecuencia, el CONTRATISTA sólo percibirá el valor pactado en el contrato, conservando los derechos
morales de las obras resultantes. Adicionalmente, el CONTRATISTA cede expresamente a CANAL
CAPITAL, mediante la firma del contrato, el derecho de registrar el nombre o signos distintivos que se
generen de la ejecución del contrato, en las clases que considere pertinentes y por tal razón, se
compromete a no solicitar el registro del nombre o signos distintivos de la producción, y en el evento
en que lo hubiere hecho, se compromete a transferirlo a nombre de CANAL CAPITAL.

        </textarea>
      </div>

      <!-- DECIMA SEXTA  -->
      <div class="mb-3">
        <label for="inhabilidadesIncompatibilidades" class="form-label">DÉCIMA SEXTA. -CONFIDENCIALIDAD Y USO DE LA INFORMACIÓN: </label>
        <textarea class="form-control" id="decimasexta" name="decimasexta" rows="15" placeholder="Descripción de las inhabilidades e incompatibilidades" readonly>EL CONTRATISTA guardará confidencialidad sobre toda la información que obtenga de CANAL CAPITAL en desarrollo del objeto contractual, en consecuencia: 1. El CONTRATISTA no obtiene bajo ningún título, incluyendo, pero sin limitarse a concesión, uso, usufructo, licencia, depósito, préstamo, alquiler, ni propiedad alguna sobre los derechos de propiedad intelectuales o alguna otra propiedad de CANAL CAPITAL. 2. El CONTRATISTA utilizará la información confidencial únicamente para efectos de realizar las operaciones
que se acuerden, obligándose a no divulgar, develar, publicar, grabar, mostrar, copiar, difundir,
reproducir, transcribir, transmitir, duplicar, citar, asociar, imprimir, almacenar, alterar, modificar, vender,
explotar económicamente o realizar cualquier actividad análoga de las anteriores, con todo o parte de
la información y documentos y/o materiales que el CANAL CAPITAL le entregue o a los que llegare a
tener conocimiento, por cualquier motivo, contenidos en cualquier medio, sea cual fuere su finalidad,
salvo que para ello cuente con autorización escrita y expresa del supervisor del contrato. 3. El
CONTRATISTA no divulgará el hecho de conocer la información confidencial, de estudios, aspectos
económicos, operación o temas objeto de discusión, también acuerda que ni él, ni ninguno de sus
empleados o subcontratistas revelará, usará o copiará en medio alguno Información Confidencial en
forma alguna (directa o indirectamente, en todo o en parte, independientemente o junto con otros), sin
la autorización específica de CANAL CAPITAL, excepto si lo requiere la ley o alguna autoridad
competente. 4. El CONTRATISTA responderá ante CANAL CAPITAL por los daños ocasionados por
terceros como consecuencia del uso no autorizado o la revelación de la información confidencial, que
haya sido revelada. 5. El CONTRATISTA deberá comunicar esta cláusula de confidencialidad de la
información a cada una de las personas que llegaren o pudieren llegar a tener acceso a la información
y documentación y/o materiales que CANAL CAPITAL le entregue, o a los que llegaren a tener
conocimiento, por cualquier motivo, contenidos en cualquier medio, en desarrollo de cualesquiera de
las relaciones que comprende el campo de aplicación de esta cláusula, antes de permitirles el acceso,
que será para lo estrictamente necesario, sometiéndose y adhiriéndose al cumplimiento de las
disposiciones contenidas en estas estipulaciones. 6. Una vez ejecutado el contrato en su totalidad, el
CONTRATISTA se obliga a devolver de inmediato al supervisor del contrato, toda la información y
documentos y/o materiales entregados, o a los que llegare a tener conocimiento, por cualquier motivo,
contenidos en cualquier medio, y toda copia de ella, facilitados para el desarrollo de la labor
contratada. Igualmente, por solicitud de CANAL CAPITAL, deberán proceder a la destrucción de la
información confidencial y documentos y/o materiales entregados, así como certificar ello por escrito,
en cada relación individualmente considerada
        </textarea>
      </div>

       <!-- DECIMA SEPTIMA  -->
      <div class="mb-3">
        <label for="inhabilidadesIncompatibilidades" class="form-label">DÉCIMA SÉPTIMA. -INDEMNIDAD:</label>
        <textarea class="form-control" id="decimaseptima" name="decimaseptima" rows="15" placeholder="Descripción de las inhabilidades e incompatibilidades" readonly>El CONTRATISTA mantendrá indemne y defenderá a su propio costo a CANAL CAPITAL de cualquier pleito, queja o demanda y responsabilidad de cualquier naturaleza, incluyendo costos y gastos provenientes de actos y omisiones del CONTRATISTA en el desarrollo de este contrato. El CONTRATISTA se obliga a evitar que sus empleados y/o los familiares de
los mismos, sus acreedores, sus proveedores y/o terceros, presenten reclamaciones (judiciales o
extrajudiciales) contra CANAL CAPITAL, con ocasión o por razón de acciones u omisiones suyas,
relacionadas con la ejecución del presente contrato. Si ello no fuere posible y se presentaren
reclamaciones o demandas contra CANAL CAPITAL esta entidad podrá comunicar la situación por
escrito al CONTRATISTA. En cualquiera de dichas situaciones, el CONTRATISTA se obliga a acudir en
defensa de los intereses del CANAL CAPITAL, para lo cual contratará profesionales idóneos que
representen a la entidad y asumirá el costo de los honorarios de éstos, del proceso y de la condena, si
la hubiere. Si CANAL CAPITAL estima que sus intereses no están siendo adecuadamente defendidos, lo
manifestará por escrito al CONTRATISTA, caso en el cual acordará la mejor estrategia de defensa o, si CANAL CAPITAL lo estima necesario, asumirá directamente la misma. En este último caso, CANAL
CAPITAL cobrará y descontará de los saldos a favor del CONTRATISTA todos los costos que implique
esa defensa, más un diez por ciento (10%) del valor de los mismos, por concepto de gastos de
administración. Si no hubiere saldos pendientes de pago a favor del CONTRATISTA, CANAL CAPITAL
podrá proceder, para el cobro de los valores a que se refiere este numeral, por la vía ejecutiva, para lo
cual este contrato, junto con los documentos en los que se consignen dichos valores, prestará mérito
ejecutivo.
        </textarea>
      </div>

       <!-- DECIMA OCTAVA  -->
      <div class="mb-3">
        <label for="inhabilidadesIncompatibilidades" class="form-label">DÉCIMA OCTAVA. -EXCLUSIÓN DE LA RELACIÓN LABORAL:</label>
        <textarea class="form-control" id="decimaoctava" name="decimaoctava" rows="7" placeholder="Descripción de las inhabilidades e incompatibilidades" readonly>EL CONTRATISTA ejecutará el
objeto de este contrato con plena autonomía, sin relación de subordinación o dependencia, por lo cual
no se generará ningún tipo de vínculo laboral entre CANAL CAPITAL y EL CONTRATISTA o las personas
que estén a su cargo. Lo anterior aplicará en todos los casos, aun cuando en ocasiones, en función a la
naturaleza de las actividades a desarrollar, se haga necesario que el CONTRATISTA atienda un horario,
con el único fin de ejecutar el objeto contractual en forma coordinada con los fines y funciones propios
de CANAL CAPITAL.1
        </textarea>
      </div>

       <!-- DECIMA OCTAVA  -->
      <div class="mb-3">
        <label for="inhabilidadesIncompatibilidades" class="form-label">DÉCIMA NOVENA. -RESPONSABILIDAD DEL CONTRATISTA:</label>
        <textarea class="form-control" id="decimanovena" name="decimanovena" rows="7" placeholder="Descripción de las inhabilidades e incompatibilidades" readonly>EL CONTRATISTA será responsable ante las autoridades de los actos u omisiones que desarrolle en el ejercicio de las actividades del presente contrato, cuando con ellos cause perjuicio a la administración o a terceros.
        </textarea>
      </div>
      
      <!-- ... Agregar más campos aquí ... -->
      
      <!-- VIGÉSIMA - INHABILIDADES E INCOMPATIBILIDADES -->
      <div class="mb-3">
        <label for="inhabilidadesIncompatibilidades" class="form-label">VIGÉSIMA. - INHABILIDADES E INCOMPATIBILIDADES</label>
        <textarea class="form-control" id="inhabilidadesIncompatibilidades" name="inhabilidadesIncompatibilidades" rows="4" placeholder="Descripción de las inhabilidades e incompatibilidades" readonly>El CONTRATISTA declara bajo la gravedad del juramento, que se entiende prestado con la suscripción del presente documento, no encontrarse incurso en causal alguna de inhabilidad o incompatibilidad legal para contratar con el Estado.</textarea>
      </div>

      <!-- VIGÉSIMA PRIMERA - RESPONSABILIDAD FISCAL Y TRIBUTARIA -->
      <div class="mb-3">
        <label for="responsabilidadFiscal" class="form-label">VIGÉSIMA PRIMERA. - RESPONSABILIDAD FISCAL Y TRIBUTARIA</label>
        <textarea class="form-control" id="responsabilidadFiscal" name="responsabilidadFiscal" rows="4" placeholder="Descripción de la responsabilidad fiscal y tributaria" readonly>El CONTRATISTA será el único responsable del cumplimiento de sus obligaciones fiscales y tributarias en los términos de Ley. En virtud del artículo 60 de la Ley 610 de 2000 EL CONTRATISTA declara bajo la gravedad del juramento que no ha sido sancionado por la Contraloría con juicio de responsabilidad fiscal en su contra
        </textarea>
      </div>
      
      <!-- VIGÉSIMA SEGUNDA - COMPROMISO DE PREVENCIÓN Y ERRADICACIÓN DEL TRABAJO INFANTIL -->
      <div class="mb-3">
        <label for="compromisoTrabajoInfantil" class="form-label">VIGÉSIMA SEGUNDA. - COMPROMISO DE PREVENCIÓN Y ERRADICACIÓN DEL TRABAJO INFANTIL</label>
        <textarea class="form-control" id="compromisoTrabajoInfantil" name="compromisoTrabajoInfantil" rows="10" placeholder="Descripción del compromiso de prevención y erradicación del trabajo infantil" readonly>En cumplimiento de las disposiciones internacionales y nacionales vigentes, en especial las contenidas en los pactos, convenios y convenciones internacionales, la Resolución 1796 de 2018 del Ministerio del Trabajo y el Acuerdo 785 de 2020 del Consejo de Bogotá, EL CONTRATISTA se
compromete a no contratar y o vincular menores de edad con el objetivo de coadyuvar con las políticas
de prevención y erradicación de trabajo infantil. En el evento en que se haga necesaria la participación
de menores en la ejecución del contrato a título oneroso, se deberá dar cumplimiento a lo dispuesto en el artículo 35 de la Ley 1098 de 2006. Este compromiso se extiende a los subcontratistas con los cuales
se desarrolle el objeto contractual, cuando a ello hubiere lugar.
</textarea>
      </div>
      
      <!-- VIGÉSIMA TERCERA - PROTECCIÓN Y CUMPLIMIENTO A LA NORMATIVIDAD DE MEDIO AMBIENTE -->
      <div class="mb-3">
        <label for="proteccionMedioAmbiente" class="form-label">VIGÉSIMA TERCERA. - PROTECCIÓN Y CUMPLIMIENTO A LA NORMATIVIDAD DE MEDIO AMBIENTE</label>
        <textarea class="form-control" id="proteccionMedioAmbiente" name="proteccionMedioAmbiente" rows="10" placeholder="Descripción de la protección y cumplimiento a la normatividad de medio ambiente" readonly>EL CONTRATISTA en desarrollo del presente contrato dará estricto cumplimiento a las
Leyes ambientales, siendo responsable ante CANAL CAPITAL y demás autoridades de la protección
ambiental y sobre el cumplimiento de éstas. De igual forma, vigilará que sus dependientes den estricto
cumplimiento durante la ejecución del objeto contractual, a todas las medidas ambientales establecidas
en las normas vigentes. Es obligación especial de EL CONTRATISTA ejecutar sus actividades o servicios
sin crear riesgo para la salud, la seguridad o el medio ambiente, ya que todos los costos que se
generen con ocasión a la contaminación se trasladarán a los directos causantes, incluyendo multas y
gastos que se generen con ocasión de requerimientos o actuación de las autoridades. En tal sentido, EL
CONTRATISTA tomará todas las medidas conducentes para evitar la contaminación ambiental durante
sus operaciones, cumplirá con todas las leyes ambientales aplicables, y se sujetará a las normas
relativas al control de la misma, no dejando sustancias o materiales nocivos para la flora, fauna, salud
humana o animal, ni verterá contaminantes en la atmósfera ni a los cuerpos de agua. En general, EL
CONTRATISTA se compromete a dar estricto cumplimiento a las disposiciones legales vigentes sobre la
materia.
        </textarea>
      </div>
      
      <!-- VIGÉSIMA CUARTA - COMPROMISO DE INTEGRIDAD Y CLÁUSULA ANTICORRUPCIÓN -->
      <div class="mb-3">
        <label for="compromisoIntegridad" class="form-label">VIGÉSIMA CUARTA. - COMPROMISO DE INTEGRIDAD Y CLÁUSULA ANTICORRUPCIÓN</label>
        <textarea class="form-control" id="compromisoIntegridad" name="compromisoIntegridad" rows="10" placeholder="Descripción del compromiso de integridad y cláusula anticorrupción"readonly>El
CONTRATISTA se compromete con CANAL CAPITAL en un esfuerzo conjunto, a preservar, fortalecer y
garantizar la transparencia y la prevención de corrupción en su gestión contractual, en el marco de los
principios y normas constitucionales y en especial en lo dispuesto en el capítulo VII de la Ley 1474 de
2011, el artículo 14 del Decreto Distrital 189 de 2020 y la Directiva 003 de 2021 de la Secretaría
Jurídica Distrital. Para el efecto, el CONTRATISTA se obliga a: 1. No ofrecer ni dar sobornos, ni ninguna
otra forma de halago o dádiva a ningún funcionario público o colaborador de CANAL CAPITAL en
relación con la ejecución del presente contrato, ni permitir que sus empleados y/o contratistas lo hagan
en su nombre. 2. Informar de manera inmediata a CANAL CAPITAL y/o a las autoridades competentes
sobre cualquier situación, actuación u omisión irregular que pueda considerarse vulneradora del
principio de transparencia. 3. No realizar actividades de falsificación, ocultamiento de la verdad o
cualquier otra acción u omisión tendiente a inducir en error a la entidad con el fin de acceder al
contrato, a sus pagos o a inducir cualquier actividad a cargo de CANAL CAPITAL.
        </textarea>
      </div>
      
      <!-- VIGÉSIMA QUINTA - SOLUCIÓN DE CONTROVERSIAS CONTRACTUALES -->
      <div class="mb-3">
        <label for="solucionControversias" class="form-label">VIGÉSIMA QUINTA. - SOLUCIÓN DE CONTROVERSIAS CONTRACTUALES</label>
        <textarea class="form-control" id="solucionControversias" name="solucionControversias" rows="8" placeholder="Descripción de la solución de controversias contractuales" readonly>Las partes buscarán
solucionar en forma ágil, rápida y directa, las diferencias y discrepancias surgidas de la actividad
contractual con ocasión de la ejecución, interpretación o incumplimiento de este contrato, por
cualquiera de los mecanismos alternativos de solución de conflictos contemplados en la ley, tales como
la conciliación, amigable composición, el acuerdo directo y la transacción. Estos mecanismos se
agotarán en un término de diez días (10) hábiles, contados a partir de la fecha en que una de las
partes presente a la otra, la diferencia o reclamación debiendo convocarse una reunión entre los
representantes de las partes o quien estos deleguen, dentro de los cinco (5) días hábiles posteriores a
la presentación de la reclamación o antes de ser acordado por las partes. De la reunión se levantará acta en la que consten los arreglos acordados o en su defecto, manifestar que se declara fallido el
trámite directo de arreglo.
        </textarea>
      </div>
      
      <!-- VIGÉSIMA SEXTA - PENAL PECUNIARIA -->
      <div class="mb-3">
        <label for="penalPecuniaria" class="form-label">VIGÉSIMA SEXTA. - PENAL PECUNIARIA</label>
        <textarea class="form-control" id="penalPecuniaria" name="penalPecuniaria" rows="8" placeholder="Descripción de la penal pecuniaria" readonly>En caso de incumplimiento por parte de EL
CONTRATISTA de las obligaciones que por este contrato adquiere, sin perjuicio de las acciones legales
a que haya lugar, CANAL CAPITAL cobrará a título de pena, una sanción pecuniaria equivalente al diez
por ciento (10%) del valor total del contrato, suma que se tendrá como pago parcial pero no definitivo
de los perjuicios que reciba CANAL CAPITAL por el incumplimiento.
        </textarea>
      </div>

      <!-- VIGÉSIMA SEXTA - paragrafo -->
      <div class="mb-3">
        <label for="penalPecuniaria" class="form-label">PARÁGRAFO:</label>
        <textarea class="form-control" id="penalPecuniariapara" name="penalPecuniariapara" rows="4" placeholder="Descripción de la penal pecuniaria" readonly>El valor de la Cláusula Penal se tomará del saldo a favor de EL CONTRATISTA si lo hubiere, y si esto no fuere posible, se cobrará por justicia coactiva o ejecutiva según corresponda.
        </textarea>
      </div>
      
      <!-- VIGÉSIMA SÉPTIMA - MULTAS -->
      <div class="mb-3">
        <label for="multas" class="form-label">VIGÉSIMA SÉPTIMA. - MULTAS</label>
        <textarea class="form-control" id="multas" name="multas" rows="4" placeholder="Descripción de las multas" readonly>Las partes acuerdan que en caso de mora o retardo en el
cumplimiento parcial o total de las obligaciones a cargo de EL CONTRATISTA, y como apremio para que
las atienda oportunamente CANAL CAPITAL, podrá imponerle multas equivalentes al uno por ciento
(1%) del valor del contrato por cada día de mora o por cada incumplimiento, las cuales serán
descontadas del saldo a su favor, previo requerimiento al CONTRATISTA, sin que el valor total de ellas
pueda llegar a exceder el diez por ciento (10%) del valor total del mismo. Lo anterior salvo en el caso
en que EL CONTRATISTA demuestre que su tardanza o mora obedecieron a hechos constitutivos de
caso fortuito o fuerza mayor debidamente comprobados.
        </textarea>
      </div>
      
       <!-- VIGÉSIMA OCTAVA - PROCEDIMIENTO PARA SANCIONES -->
      <div class="mb-3">
        <label for="procedimientoSanciones" class="form-label">VIGÉSIMA OCTAVA. - PROCEDIMIENTO PARA SANCIONES</label>
        <textarea class="form-control" id="procedimientoSanciones" name="procedimientoSanciones" rows="8" placeholder="Descripción del procedimiento para sanciones" readonly>Para efectos de dar aplicación a lo
previsto en las cláusulas vigésima sexta y vigésima séptima, CANAL CAPITAL deberá contar con el
respectivo informe de supervisión o interventoría donde se describa detalladamente las actuaciones
constitutivas del presunto incumplimiento; con base en éste citará a audiencia al contratista o su
representante, y al garante, con la finalidad de rendir descargos, solicitar o presentar pruebas y
presentar las demás explicaciones del caso, todo ello, en cumplimiento del debido proceso, en
concordancia con lo dispuesto en la cláusula vigésima quinta. Probados los hechos, CANAL CAPITAL
impondrá las multas, o la cláusula penal a que haya lugar como sanción. El acto administrativo que
imponga la sanción será susceptible de control judicial.</textarea>
      </div>

      <!-- VIGÉSIMA NOVENA - VEEDURÍA -->
      <div class="mb-3">
        <label for="veeduria" class="form-label">VIGÉSIMA NOVENA. - VEEDURÍA</label>
        <textarea class="form-control" id="veeduria" name="veeduria" rows="4" placeholder="Descripción de la veeduría" readonly>De conformidad con el artículo 270 de la Constitución Política de
Colombia, el Canal promueve la participación de las Veedurías Ciudadanas de tal manera que se
garantice el control y la vigilancia a la gestión pública, asegurando que se dé la correcta destinación a
los recursos públicos, en este sentido, a este contrato le es aplicable el control social referido.</textarea>
      </div>
      
      <!-- TRIGÉSIMA - CIERRE DEL EXPEDIENTE CONTRACTUAL -->
      <div class="mb-3">
        <label for="cierreExpediente" class="form-label">TRIGÉSIMA. - CIERRE DEL EXPEDIENTE CONTRACTUAL</label>
        <textarea class="form-control" id="cierreExpediente" name="cierreExpediente" rows="4" placeholder="Descripción del cierre del expediente contractual" readonly>En este documento se presentará la
certificación de cierre contractual del supervisor; hará las veces de acta de cierre y terminación del
contrato, y será el insumo para la liquidación del contrato, en caso de requerirse.</textarea>
      </div>
      
      <!-- TRIGÉSIMA PRIMERA - LIQUIDACIÓN -->
      <div class="mb-3">
        <label for="liquidacion" class="form-label">TRIGÉSIMA PRIMERA. - LIQUIDACIÓN</label>
        <textarea class="form-control" id="liquidacion" name="liquidacion" rows="4" placeholder="Descripción de la liquidación" readonly>En este contrato no se suscribirá acta de liquidación, a
menos de que su terminación sea anticipada o anormal, por lo que el cierre del expediente contractual
hará las veces de acta de liquidación.</textarea>
      </div>

       <!-- TRIGÉSIMA PRIMERA - paragrafo-->
      <div class="mb-3">
        <label for="liquidacion" class="form-label">PARÁGRAFO: </label>
        <textarea class="form-control" id="liquidacionpara" name="liquidacionpara" rows="4" placeholder="Descripción de la liquidación" readonly>En caso de que habiendo intentado la liquidación por parte de CANAL CAPITAL, esta no se lograre dentro del plazo establecido para el efecto, se procederá a la liquidación unilateral, la cual se notificará al correo electrónico señalado en la hoja de vida del contratista.
        </textarea>
      </div>
      
      <!-- TRIGÉSIMA SEGUNDA - RÉGIMEN LEGAL -->
      <div class="mb-3">
        <label for="regimenLegal" class="form-label">TRIGÉSIMA SEGUNDA. - RÉGIMEN LEGAL</label>
        <textarea class="form-control" id="regimenLegal" name="regimenLegal" rows="4" placeholder="Descripción del régimen legal" readonly>Este contrato se regirá en general por las normas civiles
y comerciales vigentes, por las disposiciones consagradas en el artículo 14 de la Ley 1150 de 2007; y
en especial lo contenido en el Manual de Contratación de CANAL CAPITAL, y lo dispuesto por los
manuales y procedimientos internos del Canal.</textarea>
      </div>
      
      <!-- TRIGÉSIMA TERCERA - DOMICILIO CONTRACTUAL -->
      <div class="mb-3">
        <label for="domicilioContractual" class="form-label">TRIGÉSIMA TERCERA. - DOMICILIO CONTRACTUAL</label>
        <textarea class="form-control" id="domicilioContractual" name="domicilioContractual" rows="4" placeholder="Descripción del domicilio contractual" readonly>Las partes acuerdan como domicilio contractual la ciudad de Bogotá DC.
        </textarea>
      </div>
      
      <!-- TRIGÉSIMA CUARTA - ANEXOS y DOCUMENTOS INTEGRANTES DEL CONTRATO -->
      <div class="mb-3">
        <label for="anexosDocumentos" class="form-label">TRIGÉSIMA CUARTA. - ANEXOS y DOCUMENTOS INTEGRANTES DEL CONTRATO</label>
        <textarea class="form-control" id="anexosDocumentos" name="anexosDocumentos" rows="4" placeholder="Descripción de los anexos y documentos integrantes del contrato" readonly>Hacen parte integral del presente contrato todos los documentos expedidos en las etapas precontractual, contractual y de liquidación, todos los documentos que dieron origen al mismo y los que se suscriban en su ejecución.
        </textarea>
      </div>
      
      <!-- TRIGÉSIMA QUINTA - REQUISITOS DE PERFECCIONAMIENTO Y EJECUCIÓN -->
      <div class="mb-3">
        <label for="requisitosPerfeccionamiento" class="form-label">TRIGÉSIMA QUINTA. - REQUISITOS DE PERFECCIONAMIENTO Y EJECUCIÓN</label>
        <textarea class="form-control" id="requisitosPerfeccionamiento" name="requisitosPerfeccionamiento" rows="4" placeholder="Descripción de los requisitos de perfeccionamiento y ejecución" readonly>Este contrato se entiende perfeccionado con la firma de las partes. Para su ejecución deben cumplirse los siguientes requisitos: 1. La expedición del registro presupuestal. 2. Afiliación a la ARL, para lo cual es preciso indicar que al tener un plazo de ejecución inferior a treinta (30) días, la afiliación deberá realizarse por un (1) mes. (cuando aplique) 3. Comunicación de inicio.
        </textarea>
      </div>
      
      <!-- TRIGÉSIMA SEXTA - COMUNICACIONES -->
      <div class="mb-3">
        <label for="comunicaciones" class="form-label">TRIGÉSIMA SEXTA. - COMUNICACIONES</label>
        <textarea class="form-control" id="comunicaciones" name="comunicaciones" rows="4" placeholder="Descripción de las comunicaciones" readonly>Para los efectos de comunicaciones y notificaciones, al CONTRATANTE se le harán llegar a la dirección que aparece en el pie de página, y al CONTRATISTA en la dirección y/o correo electrónico suministrados en la hoja vida de SIDEAP.
        </textarea>
      </div>
      
      <!-- TRIGÉSIMA SÉPTIMA - FIRMA ELECTRÓNICA -->
      <div class="mb-3">
        <label for="firmaElectronica" class="form-label">TRIGÉSIMA SÉPTIMA. - FIRMA ELECTRÓNICA</label>
        <textarea class="form-control" id="firmaElectronica" name="firmaElectronica" rows="4" placeholder="Descripción de la firma electrónica" readonly>El contratista acepta de manera inequívoca el contenido del contrato electrónico y sus anexos con la aceptación de este a través de la plataforma SECOP II.
        </textarea>
      </div>

      <h2 class="title-c m-tb-40">Minuta de contrato</h2>

      <br><br>
      <button type="" class="btn btn-primary">Enviar</button>
  </form>

</div>