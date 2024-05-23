function buscarEmpleado(tp) {   
    //var documento = $("#num_documento").val();
    var tipoper = tp;
    if (tipoper==1) {
         var documento = $("#num_documento").val();
     }else if(tipoper == 2){
        var documento = $("#nit").val();
     }
    $.ajax({
        type: "POST",
       
        //url: "<?php echo base_raiz; ?>mod/financiera/views/buscarempleado.php",

        url: "https://intranet.canalcapital.gov.co/erpc/mod/financiera/views/buscarempleado.php",            
        data: { documento: documento, tipoper: tipoper },
        
        // error: function () {
        //     alert("Error al buscar el empleado..");
        // }
    }).done(function(res){
        
        //console.log(res);
        // console.log(result);
        // console.log(result.nombre);
        var result = JSON.parse(res);

         
         if (result.r > 1) {
            swal("","Se encontro persona registradax en el sistema","success");
            //console.log(result.tipoper);
            if (result.tipoper == 1) {
                console.log('aquiiiii');
                console.log($("#dataFuturoCont"));
                //$("#dataFuturoCont").addClass("visible");
                //$("#dataFuturoCont").css("display", "block !important");
                $("#dataFuturoCont").show();
                $("#nomcont").val(result.nombre + " " + result.apellido);            
                $("#nomcontNew").val(result.nombre).prop("readonly", true);
                $("#apecontNew").val(result.apellido).prop("readonly", true);
                $("#peridNew").val(result.perid);
                $("#nodocemp").val(result.nodocemp);
                $("#datosmail").css("display", "none");
                $("#mailcontNew").val("");
                $("#contracontNew").val("");
                $("#oblicargo").val("");


            }else if(result.tipoper == 2){
                $("#divrazon").css("display", "block");
                $("#nomcont").val(result.nombre + " " + result.apellido);    
                $("#razsocial").val(result.nombre + " " + result.apellido).prop("readonly", true);
            }
            
            

            
         }else if(result.r == 1){
            swal("","Ingrese un número de documento valido","error");
            $("#nomcont").val("");
            $("#nomcontNew").val("");
            $("#apecontNew").val("");
            $("#peridNew").val("");
            $("#nodocemp").val(documento);
            $("#mailcontNew").val("");
            $("#contracontNew").val("");
            $("#oblicargo").val("");
            
         }else if(result.r == 0){  
            if (tp == 1) {
                swal("","Persona Natural no registrada","error");
                $("#nomcont").val("").prop("readonly", false);;
                $("#nomcontNew").val("").prop("readonly", false);;
                $("#apecontNew").val("").prop("readonly", false);;
                $("#peridNew").val("");
                $("#nodocemp").val(documento);  
                $("#mailcontNew").val("");
                $("#contracontNew").val("");
                $("#oblicargo").val("");
                $("#dataFuturoCont").show();       
                $("#datosmail").show();
            }else if(tp == 2){
                swal("","Persona Juridica no registrada","error");
                $("#divrazon").css("display", "block");
                $("#datosmailpj").css("display", "block"); 
                $("#razsocial").val("").prop("readonly", false);
            }
            
         }
         
                
    });
   
    // var documento = $("#num_documento").val();
    // alert(documento);

    // $.ajax({
    //     type: "POST",
    //     url: "https://intranet.canalcapital.gov.co/erpc/mod/financiera/views/buscarempleado.php",        
    //     data: { documento: documento },
    //     dataType: "json",
        
    //     success: function (data) {
    //         $("#nombre_contratista").val(data.nombre);
    //         //$("#puesto").val(data.puesto);
    //     },
    //     error: function () {
    //         alert("Error al buscar el empleado.");
    //     }
    // });
}



function mostrarObligaciones(a) {
    var valid = a;    
    $.ajax({
        type: "POST",
        //url:"<?php echo base_raiz; ?>mod/rrhh/views/vsavecat.php",
        url: "https://intranet.canalcapital.gov.co/erpc/mod/financiera/views/buscarobligagen.php",
        data: { valid: valid },
    }).done(function(res) {
        var result = JSON.parse(res);

        // Limpiamos el contenedor antes de mostrar las nuevas obligaciones
        $("#obligaciones-container1").empty();
        console.log(result);

        if (result.length > 0) {

           // Mostramos dinámicamente un campo de entrada para cada obligación
           result.forEach(function(obligacion) {
               var nuevoCampo = '<div class="input-group mb-2">' +
                   '<input type="text" class="form-control" name="obligacionCargo[]" value="' + obligacion.obliga + '">' +
                   '<div class="input-group-append">' +
                   '<button type="button" class="btn btn-danger eliminar-obligacion" onclick="eliminarObligacion(this)">Eliminar</button>' +
                   '</div>' +
                   '</div>';
               $("#obligaciones-container1").append(nuevoCampo);
               $("#oblicargo").val(a);
               $("#agregar-obligacion-general").css("display", "block");
           });
        }else {
            // No hay obligaciones, muestra una alerta
            swal("", "No hay obligaciones para el cargo", "info");
            $("#oblicargo").val(a);
            $("#agregar-obligacion-general").css("display", "block");
        }
    });
}

// Función para eliminar un campo de entrada de obligación
function eliminarObligacion(btnEliminar) {
    $(btnEliminar).closest(".input-group").remove();
}

function obligacionesAnt() {
    // var documento = $("#num_documento").val(); 
    var documento = $("#peridNew").val(); 
    var oblicargo = $("#oblicargo").val();      
    $.ajax({
        type: "POST",
        url: "https://intranet.canalcapital.gov.co/erpc/mod/financiera/views/buscarobligaAnt.php",
        data: { documento: documento, oblicargo: oblicargo },
    }).done(function(res) {
        var result = JSON.parse(res);

        // Limpiamos el contenedor antes de mostrar las nuevas obligaciones
        $("#obligaciones-container2").empty();
        
        if (result.length > 0) {

           // Mostramos dinámicamente un campo de entrada para cada obligación
           result.forEach(function(obligacion) {
               var nuevoCampo = '<div class="input-group mb-2">' +
                   '<input type="text" class="form-control" name="obligacionOld[]" value="' + obligacion.obliga + '">' +
                   '<div class="input-group-append">' +
                   '<button type="button" class="btn btn-danger eliminar-obligacion" onclick="eliminarObligacion(this)">Eliminar</button>' +
                   '</div>' +
                   '</div>';
               $("#obligaciones-container2").append(nuevoCampo);
           });
        }else {
            // No hay obligaciones, muestra una alerta
            swal("", "No hay obligaciones anteriores para el contratista y cargo seleccionado", "info");
        }
    });
}


