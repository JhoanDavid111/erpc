function agregarArchivosGestor(){
	var serie = $('#nomserie').val();
	var num = $('#num').val();
	//var dfin = $('#dfin').val();
	var ultserie = $('#ultserie').val();			
	var formData = new FormData(document.getElementById('frmArchivos'));	
	//if (serie=="" || num=="" || dfin=="") {
	if (serie=="" || num=="") {
		swal("","Debe completar los campos","warning");
		return false;
	}else{					
		$.ajax({
			type:"POST",
			//data:"serie="+serie,
			//data:parametros,					
			url:"https://intranet.canalcapital.gov.co/erpc/mod/gestiondoc/views/vSaveSerie.php",
			datatype: "html",
			data: formData,
			cache: false,
			contentType:false,
			processData:false,
			success:function(respuesta){
				respuesta=respuesta.trim();
				console.log(respuesta);
				if(respuesta>0){					

					swal("","Registro agregado correctamente","success");
				}else{
					//console.log(ur);
					// console.log(respuesta);
					swal(":(","Fallo al agregar","error");
				}
			}
		});
	}
	

}