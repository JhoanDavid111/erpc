$('#depto').change(function() {

	let parametros="id="+$("#depto").val();

	$.ajax({
		data: parametros,
		url: 'https://intranet.canalcapital.gov.co/erpc/mod/rrhh/views/ajaxmunicipio.php',
		type:'POST', beforeSend: function () { }, 
		dataType:'json', 
		success: function(response){
			//console.log(response);
			$("#munici").html(response.muni);
		},
		error: function(){
			alert('error')
		}
	});

})
$('#munici').change(function() {

	let parametros="id="+$("#munici").val();

	$.ajax({
		data: parametros,
		url: 'https://intranet.canalcapital.gov.co/erpc/mod/rrhh/views/ajaxlocalidad.php',
		type:'POST', beforeSend: function () { }, 
		dataType:'json', 
		success: function(response){
			console.log(response);
			$("#loca").html(response.loca);
		},
		error: function(){
			alert('error')
		}
	});

})
$('#loca').change(function() {

	let parametros="id="+$("#loca").val();

	$.ajax({
		data: parametros,
		url: 'https://intranet.canalcapital.gov.co/erpc/mod/rrhh/views/ajaxbarrio.php',
		type:'POST', beforeSend: function () { }, 
		dataType:'json', 
		success: function(response){
			console.log(response);
			$("#barr").html(response.barr);
		},
		error: function(){
			alert('error')
		}
	});

})

$('#muni').change(function() {

	let parametros="id="+$("#muni").val();

	$.ajax({
		data: parametros,
		url: 'https://intranet.canalcapital.gov.co/erpc/mod/rrhh/views/ajaxdepaedu.php',
		type:'POST', beforeSend: function () { }, 
		dataType:'json', 
		success: function(response){
			console.log(response);
			$("#ubiid").html(response.muni);
		},
		error: function(){
			alert('error')
		}
	});

});

function eliCiucmb(){
	document.getElementById("barr").value="0";
}
