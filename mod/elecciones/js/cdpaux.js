function quitar(){
	var lista = document.getElementById ("newpay");
      let nchild = lista.children.length;
     
      for (var i = 1; i <= nchild; i++) {
      	var item = document.querySelector('#div'+i);
      	lista.removeChild (item);
      }
     metodoClick();
}

function metodoClick(){ 

   	if(pagoman.checked) {   	  
      document.getElementById('duracion').removeAttribute('readonly');
      document.getElementById('duracion').style.display='none';
      document.getElementById('duracion2').style.display='block';
      document.getElementById('primerm').style.display='none';
      document.getElementById('ultimom').style.display='none';
      document.getElementById('valormensual').style.display='none';
      document.getElementById('example2').style.display='none';

      document.getElementById('lprimerm').style.display='none';
      document.getElementById('lduracion').style.display='none';
      document.getElementById('lduracion2').style.display='block';
      document.getElementById('lultimom').style.display='none';
      document.getElementById('lvalormensual').style.display='none';      

      let pagos = document.querySelector("#duracion2").value;
      pagos = parseInt(pagos);
      var element  = document.querySelector("#newpay");

      const fragment = document.createDocumentFragment();
       
       	for (let i = 1; i <= pagos; i++) {
	      	const div = document.createElement("div");
		    div.className = "form-group col-md-4";
		    div.id="div"+i;

		    const label = document.createElement("label");
		    label.htmlFor ="p"+i;
		    label.textContent="Pago"+" "+i;		   
		    div.appendChild(label);

		    const input = document.createElement("input");
		    input.className = "form-control";
		    input.type= "number";
		    input.id="p"+i;
		    input.required=true;
		    // input.name="p"+i;
		    input.name="p[]";

		    div.appendChild(input);
		    fragment.appendChild(div);		    
	    }

	    element.appendChild(fragment);

    } else {          
      document.getElementById('duracion').setAttribute('readonly',''); 
      document.getElementById('duracion').style.display='block';
      document.getElementById('duracion2').style.display='none';
      document.getElementById('primerm').style.display='block';
      document.getElementById('ultimom').style.display='block';
      document.getElementById('valormensual').style.display='block';
      document.getElementById('example2').style.display='table';

      document.getElementById('lprimerm').style.display='block';
      document.getElementById('lduracion').style.display='block';
      document.getElementById('lduracion2').style.display='none';
      document.getElementById('lultimom').style.display='block';
      document.getElementById('lvalormensual').style.display='block'; 

      var lista = document.getElementById ("newpay");
      let nchild = lista.children.length;      

      for (var i = 1; i <= nchild; i++) {
      	var item = document.querySelector('#div'+i);      	
      	lista.removeChild (item);
      }
    }
} 
									