const agr = document.querySelector('#agr');
agr.addEventListener("click", function(){adctr(4);});
var num = 1;

function UpdFechaFin(d,n=''){
	const fecha = new Date(d);
	const fecin = (fecha.getFullYear()+1)+"-"+(fecha.getMonth() + 1)+"-"+(fecha.getDate()+1);
	// alert("Acá toy "+d+" "+fecin+" "+n);
	document.getElementById("ffinmej"+n).max = fecin;
	document.getElementById("ffinmej"+n).value = fecin;
}

function adctr(deseli){
	let mdv1 = document.createElement('div');
	mdv1.id = "dp" + num;
	mdv1.className = "form-group col-md-3";
	mdv1.style.background = "#dfd0f1";
	let mdv2 = document.createElement('div');
	mdv2.id = "dc" + num;
	mdv2.className = "form-group col-md-4";
	mdv2.style.background = "#dfd0f1";
	let mdv3 = document.createElement('div');
	mdv3.id = "defi" + num;
	mdv3.className = "form-group col-md-2";
	mdv3.style.background = "#dfd0f1";
	let mdv4 = document.createElement('div');
	mdv4.id = "deff" + num;
	mdv4.className = "form-group col-md-2";
	mdv4.style.background = "#dfd0f1";
	let mdv5 = document.createElement('div');
	mdv5.id = "de" + num;
	mdv5.className = "form-group col-md-1";
	mdv5.style.textAlign = "center";
	let accmej = document.createElement('input');
	accmej.type = 'text';
	accmej.name = 'accmej[]';
	accmej.id = 'accmej';
	accmej.required = 'required';
	accmej.className = "form-control form-control-sm"
	let foract = document.createElement('input');
	foract.type = 'text';
	foract.name = 'foract[]';
	foract.id = 'foract';
	foract.required = 'required';
	foract.className = "form-control form-control-sm"

// Inicio Variables de fecha ------------------------------------------------
	const fecha = new Date();
	const fecin = fecha.getFullYear()+"-"+(fecha.getMonth() + 1)+"-"+"01";
	let diaant = (fecha.getDate());
	if(diaant<10) diaant = '0'+diaant;
	let diahoy = fecha.getDate();
	if(diahoy<10) diahoy = '0'+diahoy;
	const fechoy = fecha.getFullYear()+"-"+(fecha.getMonth() + 1)+"-"+diahoy;
	const fecfi = (fecha.getFullYear()+1)+"-"+(fecha.getMonth() + 1)+"-"+diaant;
// Fin Variables de fecha ------------------------------------------------	

	let finimej = document.createElement('input');
	finimej.type = 'date';
	finimej.name = 'finimej[]';
	finimej.id = 'finimej' + num;
	finimej.value = fechoy;
	finimej.min = fecin;
	finimej.max = fecfi;
	finimej.required = 'required';
	finimej.className = "form-control form-control-sm"
	let ffinmej = document.createElement('input');
	ffinmej.type = 'date';
	ffinmej.name = 'ffinmej[]';
	ffinmej.id = 'ffinmej' + num;
	ffinmej.value = fecfi;
	ffinmej.min = fecin;
	ffinmej.max = fecfi;
	ffinmej.required = 'required';
	ffinmej.className = "form-control form-control-sm"
	// mdv1.innerHTML = "<label class='nom' for='accmej'>Actividad</label>";
	// mdv2.innerHTML = "<label class='nom' for='foract'>Fórmula</label>";
	if(num!=1)
		mdv5.innerHTML = "<button class='btn btn-danger btn1' title='Eliminar fila' onclick='elitr(" + num +")'><i class='fa fa-trash'></i></button>";
	else{
		if(deseli==4)
			mdv5.innerHTML = "<button class='btn btn-danger btn1' title='Eliminar fila' onclick='elitr(" + num +")'><i class='fa fa-trash'></i></button>";
	}
	mdv1.appendChild(accmej);
	mdv2.appendChild(foract);
	mdv3.appendChild(finimej);
	mdv4.appendChild(ffinmej);
	act.appendChild(mdv1);
	act.appendChild(mdv2);
	act.appendChild(mdv3);
	act.appendChild(mdv4);
	act.appendChild(mdv5);
	finimej.addEventListener("change", function(){ UpdFechaFin(this.value,num-1);});
	num++;
}

function elitr(n){
	let h = confirm("¿Desea eliminar el registro selecionado?");
	if(h==true){
		let dp = document.getElementById("dp"+n);
		let dc = document.getElementById("dc"+n);
		let de = document.getElementById("de"+n);
		let defi = document.getElementById("defi"+n);
		let deff = document.getElementById("deff"+n);
		act.removeChild(dp);
		act.removeChild(dc);
		act.removeChild(de);
		act.removeChild(defi);
		act.removeChild(deff);
	}
}