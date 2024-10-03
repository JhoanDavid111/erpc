window.onload = function() {
    var nn=0;
    //asigmes2(nn);
    asigmes(nn);
    meses();    
    //alert('mensaje prueba');
    //rubro(nn);
  
};

const rubri = (rubro,nombre)=> {
    
    const rub = document.querySelector("#rubroPre"); 
    const codirub = document.getElementById(rubro);     
    const nrub = document.querySelector("#nombreRubro");
    //console.log(codirub.value);
    rub.value=rubro;
    rub.value=codirub.value;
    nrub.value=nombre;

};

const asigmes = (nn)=> {   

    var fNumber = {
        sepMil: ".", // separador para los miles
        sepDec: ',', // separador para los decimales
        formatear:function (num){
        num +='';
        var splitStr = num.split('.');
        var splitLeft = splitStr[0];
        var splitRight = splitStr.length > 1 ? this.sepDec + splitStr[1] : '';
        var regx = /(\d+)(\d{3})/;
        while (regx.test(splitLeft)) {
        splitLeft = splitLeft.replace(regx, '$1' + this.sepMil + '$2');
        }
        return this.simbol + splitLeft + splitRight;
        },
        go:function(num, simbol){
        this.simbol = simbol ||'';
        return this.formatear(num);
        }
    }

    // Para utilizar dicha función bastaría con llamarla de la siguiente manera:

    // //retorna $45.786.477,86
    // fNumber.go(45786477.86, "$");
    // // retorna "45.786.477,86234"
    // fNumber.go(45786477.86234);
    // // retorna 45.786.477"
    // fNumber.go(45786477);
    // // retorna NaN
    // fNumber.go(NaN);

    var asignacion=null;
    var meses=null;
    var valmes=null;
    var valmesI=null;
    var valmesF=null;
    var m1=null;
    var m2=null;
    var dmses=null;
    var cal=null;
    var dur=null;
    var months=null;

    //alert(asignacion);

    var asignacion = document.querySelector("#valorAsignado");
    var asignacion2 = document.querySelector("#valorAsignado").value;
    var meses = document.querySelector("#duracion");
    var valmes = document.querySelector("#valormensual");
    var valmesI = document.querySelector("#primerm");
    var valmesF = document.querySelector("#ultimom");

    var disponi = document.querySelector("#valorVigencia").value;
    var asignacion2 = parseInt(asignacion2);
    var disponi = parseInt(disponi);
    //alert(disponi);
    
    if (asignacion2>disponi) {
        document.getElementById('alertdisponible').style.display='block';
        document.getElementById('btnsolicitar').style.display='none';
    }else{
        document.getElementById('alertdisponible').style.display='none';
        document.getElementById('btnsolicitar').style.display='block';
    }
    
   


    var m1= parseInt(valmesI.value);
    var m2= parseInt(valmesF.value);    
    
    var start1 = new Date(document.getElementById('fechaInicio').value);
    var d1 = start1.getFullYear();
    var ms1 = start1.getMonth();
    
    start1.setDate(start1.getDate()+1)
    var diam1 = start1.getDate();
    //console.log("dias mes 1"+diam1);
    //console.log("dd"+diam1)


    var start2 = new Date(document.getElementById('fechaEstimada').value);
    var d2 = start2.getFullYear();
    var ms2 = start2.getMonth();

    start2.setDate(start2.getDate()+1)
    var diam2 = start2.getDate();
    var months;
    months = (d2 - d1) * 12;

    //alert('months 1'+'  '+ months);
    //console.log("nn"+nn)
    if ((nn==0)||diam1==1) {

        ms1= ms1 +2;
        nn++;
        //alert('nn');
      
    }else{
         ms1= ms1 +1;        
    }





    if (diam2==1) {

        ms2= ms2 +2;
        
    }else{
         ms2= ms2 +1;    
    }
   

    months -= ms1;
    months += ms2;
    months <= 0 ? 0 : months;

   if (ms1>12) {
        ms1=1;
        d1=d1+1;
        // months += ms2;
        
    }else{
       
    }

    //alert('months'+' '+months);
    

    if (months==0) {

    }


    //alert('months 2'+'  '+ months);

   //Calcular dias mes inicial
    var di1 = start1.getDate();
    datr = new Date(d1+','+ms1+',1');
    ultDiam = new Date(datr.getFullYear(), datr.getMonth() + 1, 0);
    fedim1 = new Date(d1+'-'+ms1+'-'+di1);
    fedfm2 = new Date(d1+'-'+ms1+'-'+ultDiam.getDate());

    var diasdif= fedfm2.getTime()-fedim1.getTime();
    var mdmini = Math.round(diasdif/(1000*60*60*24));

    //console.log("Cantidad de dias: ",mdmini);

    dur = months;

    //alert('Duracion'+'  '+dur);

    //dias del primer mes
    // alert('di1'+'  '+di1);

    if (di1>30) {
        diaspm=1;
    }else{
        var diaspm = 30-di1+1;
    }

    
    //mdmini=diaspm;
    // alert(diaspm);
    // alert(mdmini);

//Calcular duración en meses
    //alert('months valor'+months);

    
    //vald = (asignacion.value/months/30); 
    vald = (asignacion.value/months/30); 
    // alert('months' + months);
    //alert('vald'+vald);

    //alert('dur'+dur);
    document.getElementById('duracion').value = dur;

    //console.log(vald);
    // Calcular valor mes inicial
    var valmesIN= Math.round(vald*mdmini);
     
    //alert(valmesIN);

    //document.getElementById('primerm').value = Math.round(vald*mdmini);
    document.getElementById('primerm').value =valmesIN;

    //Calcular dias mes final
    var di2 = start2.getDate();
    fedim1 = new Date(d1+'-'+ms1+'-1');
    //fedim1 = new Date(d1+'-'+ms1+'-1');
    fedfm2 = new Date(d1+'-'+ms1+'-'+di2);

   
    var diasdif= fedfm2.getTime()-fedim1.getTime();
    var mdmfin = Math.round(diasdif/(1000*60*60*24))+1; 

     //alert('d1'+'  '+d1);
    // alert('ms1'+'  '+ms1);

    //alert('fedim1'+'  '+fedim1);

    if (mdmfin>30) {
        mdmfin=30;
    }

    //alert(mdmfin);
// Calcular valor mes final

    //fNumber.go(45786477.86, "$");
    // var v_ultimom = Math.round(vald*mdmfin);
    // var vf_ultimom =fNumber.go(10000, "$");
    // console.log(vf_ultimom);


    document.getElementById('ultimom').value = Math.round(vald*mdmfin);

    //calcular valor diario
        cal=(dur-1)*30+mdmfin+diaspm;
        //alert('cal'+cal);
        // alert(asignacion.value);
        dmses= asignacion.value/cal;
        //alert('aqui');
        //alert('dmeses'+dmses);
   

    if (dur==0) {
        document.getElementById('primerm').setAttribute('readonly','')
        document.getElementById('ultimom').setAttribute('readonly','')
       
        var mensualidad = Math.round(dmses * 30);
      
        valmes.value=parseInt(mensualidad);
        // alert('aqui'+dmses);


        //document.getElementById('primerm').value = Math.round(dmses*diaspm);
        //document.getElementById('ultimom').value = Math.round(dmses*mdmfin);
        document.getElementById('primerm').value = document.getElementById('valorAsignado').value;
        document.getElementById('valormensual').value = document.getElementById('valorAsignado').value;
        document.getElementById('ultimom').value = 0;
        document.getElementById('duracion').value = dur+1;

        
    }else if (dur==1){
        //document.getElementById('primerm').removeAttribute('readonly')
        document.getElementById('ultimom').setAttribute('readonly','') 
        document.getElementById('primerm').setAttribute('readonly','')       
        //alert('aa');
        //var mensualidad =(asignacion.value-(m1));
        var mensualidad = Math.round(dmses * 30);
        valmesF.value=mensualidad;
        valmes.value=mensualidad;
        //document.getElementById('primerm').value = Math.round(dmses*diaspm);
        //document.getElementById('ultimom').value = Math.round(dmses*mdmfin);
        document.getElementById('duracion').value = dur+1;
        // alert('dmses'+dmses);
        // alert('diaspm'+diaspm);
        document.getElementById('primerm').value = Math.round(dmses*diaspm);
        document.getElementById('valormensual').value = document.getElementById('valorAsignado').value;
        document.getElementById('ultimom').value = document.getElementById('valorAsignado').value - document.getElementById('primerm').value;

    }else if(dur>1){

        
        
        // document.getElementById('primerm').removeAttribute('readonly')
        // document.getElementById('ultimom').removeAttribute('readonly')
        document.getElementById('ultimom').setAttribute('readonly','') 
        document.getElementById('primerm').setAttribute('readonly','')  

        //alert('dmses'+' '+dmses);
        var mensualidad = Math.round(dmses * 30);
        //var mensualidad =(asignacion.value-(m1+m2))/(meses.value-2);
        //console.log("mensualidad"+mensualidad);
            
        valmes.value=parseInt(mensualidad);
        //valmes.value=mensualidad;

        var primerm= Math.round(dmses*diaspm);
        var ultimomes = Math.round(dmses*mdmfin);

        // alert('dmses'+ dmses);
        // alert('mdmfin'+mdmfin);

        //alert('dias primer mes' +'  '+diaspm);
        //alert('mdmfin' +'  '+mdmfin);

        //alert(ultimomes);

        //alert(primerm);
        document.getElementById('duracion').value = dur+1;
        document.getElementById('primerm').value = Math.round(dmses*diaspm);
        document.getElementById('ultimom').value = Math.round(dmses*mdmfin);

        
    }

   
 

    var nommeses = new Array();
    nommeses[1]="Ene";
    nommeses[2]="Feb";
    nommeses[3]="Mar";
    nommeses[4]="Abr";
    nommeses[5]="May";
    nommeses[6]="Jun";
    nommeses[7]="Jul";
    nommeses[8]="Ago";
    nommeses[9]="Sep";
    nommeses[10]="Oct";
    nommeses[11]="Nov";
    nommeses[12]="Dic";

    //console.log(nommeses[12])

    const tr = document.querySelector("#tmeses"); // <div class="info"></div>  
    const trb = document.querySelector("#tvmeses"); // <div class="info"></div> 
    const trf = document.querySelector("#tfoot"); // <div class="info"></div>
    var unmes= document.querySelector("#valorAsignado").value;         

   
    var ttyear=d2-d1;
    //console.log(ttyear);
    var tyear=d1;
    var mesini=ms1;

    tr.innerHTML="";
    trb.innerHTML="";
    trf.innerHTML="";
    var mf=12;

    

    for (var i = 0; i <= ttyear; i++) { 
        if (i==ttyear) {
            mf=ms2;
        }

        for (var k = mesini; k <= mf; k++) {
            tr.innerHTML += "<th>"+nommeses[k]+" <br> "+tyear+"</th>"; // Interpreta el HTML
        }
        mesini=1;
        tyear++;
        
    }   

    ///////
    ///////TD
    //************  

    //alert(meses.value);

    if (dur==0) {
        var ttyear=d2-d1;   
        var tyear=d1;
        var mesini=ms1; 
        var mf=12;

        for (var i = 0; i <= ttyear; i++) { 
            if (i==ttyear) {
                mf=ms2;
            }

            //fNumber.go(45786477.86, "$");
            // var v_ultimom = Math.round(vald*mdmfin);
            // var vf_ultimom =fNumber.go(10000, "$");
            // console.log(vf_ultimom);

            var vf_mensualidad =fNumber.go(mensualidad, "$");

            for (var k = mesini; k <= mf; k++) {
                trb.innerHTML += "<td>"+vf_mensualidad+"</td>"; // Interpreta el HTML
            }
            mesini=1;
            tyear++;
            
        }
    }

    if ( dur==1) {
        var ttyear=d2-d1;   
        var tyear=d1;
        var mesini=ms1; 
        var mf=12;
        var contando=0;

        for (var i = 0; i <= ttyear; i++) { 
            if (i==ttyear) {
                mf=ms2;
            }

            cont=0;

            for (var k = mesini; k <= mf; k++) {
                if(cont==0 && contando==0){
                    var prim=document.getElementById('primerm').value;
                    var vf_prim =fNumber.go(prim, "$");
                    trb.innerHTML += "<td>"+vf_prim+"</td>"; // Interpreta el HTML
                    cont++;              
                    
                }else if(k==mf && contando==months){
                    var ultim=document.getElementById('primerm').value;
                    var vf_ultim =fNumber.go(ultim, "$");
                    trb.innerHTML += "<td>"+vf_ultim+"</td>";
                }else{
                    var ultim=document.getElementById('primerm').value;
                    var vf_ultim =fNumber.go(ultim, "$");
                    trb.innerHTML += "<td>"+vf_ultim+"</td>";
                }
                contando++;
            }
            mesini=1;
            tyear++;
            
        }
    }


    if (dur>1) {
        //alert("mayor a 3");
        var ttyear=d2-d1;   
        var tyear=d1;
        var mesini=ms1; 
        var mf=12;
        var contando=0;
        for (var i = 0; i <= ttyear; i++) { 
            if (i==ttyear) {
                mf=ms2;
            }

            cont=0;

            for (var k = mesini; k <= mf; k++) {
                if(cont==0 && contando==0){
                    var prim=document.getElementById('primerm').value;
                    var vf_prim =fNumber.go(prim, "$");
                    trb.innerHTML += "<td>"+vf_prim+"</td>"; // Interpreta el HTML
                    cont++;              
                    
                }else if(k==mf && contando==months){
                    var ult=ultimomes;
                    var vf_ult =fNumber.go(ult, "$");
                    trb.innerHTML += "<td>"+vf_ult+"</td>";
                }else{
                    var vmen=document.getElementById('valormensual').value;
                    var vf_vmen =fNumber.go(vmen, "$");
                    trb.innerHTML += "<td>"+vf_vmen+"</td>"; // Interpreta el HTML
                    
                }
                contando++;
            }
            mesini=1;
            tyear++;
            
        }
    }

    ///////
    ///////Tf
    //************  
                
    var ttyear=d2-d1;
    //console.log(ttyear);
    var tyear=d1;
    var mesini=ms1; 
    var mf=12;

    for (var i = 0; i <= ttyear; i++) { 
        if (i==ttyear) {
            mf=ms2;
        }

        for (var k = mesini; k <= mf; k++) {
            //trf.innerHTML += "<th>"+nommeses[k]+" <br> "+tyear+"</th>"; // Interpreta el HTML
        }
        mesini=1;
        tyear++;
        
    }   



    // var f_vAsignado = document.getElementById('valorAsignado').value;
    // ff_vAsignado = fNumber.go(f_vAsignado, "$");
    // document.getElementById('primerm').value = ff_vAsignado;


    // var f_primerm = document.getElementById('primerm').value;
    // ff_primerm = fNumber.go(f_primerm);
    // document.getElementById('primerm').value = ff_primerm;
    // alert(ff_primerm);
    // console.log(ff_primerm);


    //fNumber.go(45786477.86, "$");
    // var v_ultimom = Math.round(vald*mdmfin);
    // var vf_ultimom =fNumber.go(10000, "$");
    // console.log(vf_ultimom);
    
};






const asigmes2 = (nn)=> {
    var asignacion=null;
    var meses=null;
    var valmes=null;
    var valmesI=null;
    var valmesF=null;
    var m1=null;
    var m2=null;
    var dmses=null;
    var cal=null;
    var dur=null;
    var months=null;

    //alert(asignacion);

    var asignacion = document.querySelector("#valorAsignado");
    var meses = document.querySelector("#duracion");
    var valmes = document.querySelector("#valormensual");
    var valmesI = document.querySelector("#primerm");
    var valmesF = document.querySelector("#ultimom");
    
    var m1= parseInt(valmesI.value);
    var m2= parseInt(valmesF.value);    
    
    var start1 = new Date(document.getElementById('fechaInicio').value);
    var d1 = start1.getFullYear();
    var ms1 = start1.getMonth();
    
    start1.setDate(start1.getDate()+1)
    var diam1 = start1.getDate();
    //console.log("dias mes 1"+diam1);
    //console.log("dd"+diam1)


    var start2 = new Date(document.getElementById('fechaEstimada').value);
    var d2 = start2.getFullYear();
    var ms2 = start2.getMonth();

    start2.setDate(start2.getDate()+1)
    var diam2 = start2.getDate();
    var months;
    months = (d2 - d1) * 12;
    //console.log("nn"+nn)
    if ((nn==0)||diam1==1) {

        ms1= ms1 +2;
        nn++;
        //alert('nn');
      
    }else{
         ms1= ms1 +1;        
    }


    if (diam2==1) {

        ms2= ms2 +2;
        
    }else{
         ms2= ms2 +1;    
    }
   
    months -= ms1;
    months += ms2;
    months <= 0 ? 0 : months;

    if (months==0) {

    }

   //Calcular dias mes inicial
    var di1 = start1.getDate();
    datr = new Date(d1+','+ms1+',1');
    ultDiam = new Date(datr.getFullYear(), datr.getMonth() + 1, 0);
    fedim1 = new Date(d1+'-'+ms1+'-'+di1);
    fedfm2 = new Date(d1+'-'+ms1+'-'+ultDiam.getDate());

    var diasdif= fedfm2.getTime()-fedim1.getTime();
    var mdmini = Math.round(diasdif/(1000*60*60*24));

    //console.log("Cantidad de dias iniciales: ",mdmini);


    dur = months+1;

    //dias del primer mes
    var diaspm = 30-di1+1;
    //alert('diaspm'+diaspm);



    //mdmini=diaspm;
    // alert(diaspm);
    // alert(mdmini);

//Calcular duración en meses
    //alert('months valor'+months);

    
    //vald = (asignacion.value/months/30); 
    vald = (asignacion.value/months/30); 
    // alert('months' + months);
    //alert('vald'+vald);

    //alert('dur'+dur);
    document.getElementById('duracion').value = dur;

    //console.log(vald);
    // Calcular valor mes inicial
    var valmesIN= Math.round(vald*mdmini);
    
    //alert(valmesIN);

    //document.getElementById('primerm').value = Math.round(vald*mdmini);
    document.getElementById('primerm').value =valmesIN;

    //Calcular dias mes final
    var di2 = start2.getDate();
    fedim1 = new Date(d1+'-'+ms1+'-1');
    fedfm2 = new Date(d1+'-'+ms1+'-'+di2);

    var diasdif= fedfm2.getTime()-fedim1.getTime();
    var mdmfin = Math.round(diasdif/(1000*60*60*24))+1;

    console.log("Cantidad de dias finales: ",mdmfin);

    //alert('mmdfin'+mdmfin);
// Calcular valor mes final

    document.getElementById('ultimom').value = Math.round(vald*mdmfin);

    if (meses.value==0) {
        document.getElementById('primerm').setAttribute('readonly','')
        document.getElementById('ultimom').setAttribute('readonly','')

        //var mensualidad = (asignacion.value)/meses.value;
        var mensualidad = Math.round(dmses * 30);
        valmes.value=parseInt(mensualidad);
        valmesI.value=0;
        valmesF.value=0;

        document.getElementById('primerm').value = document.getElementById('valorAsignado').value;
        document.getElementById('valormensual').value = document.getElementById('valorAsignado').value;
        document.getElementById('ultimom').value = 0;
        document.getElementById('duracion').value = dur+1;

        
    }else if (meses.value==1){
        //document.getElementById('primerm').removeAttribute('readonly')
        document.getElementById('ultimom').setAttribute('readonly','');
        document.getElementById('primerm').setAttribute('readonly','')            
        //var mensualidad =(asignacion.value-(m1));
        var mensualidad = Math.round(dmses * 30);
        valmesF.value=mensualidad;
        valmes.value=mensualidad;

         cal=(dur-1)*30+mdmfin+diaspm;
        // alert('cal'+cal);
        // alert(asignacion.value);
        dmses= asignacion.value/cal;
        //alert('aqui');
        // alert('dmeses'+dmses);


        document.getElementById('duracion').value = dur+1;
         // alert('dmses'+dmses);
         // alert('diaspm'+diaspm);
        document.getElementById('primerm').value = Math.round(dmses*diaspm);
        document.getElementById('valormensual').value = document.getElementById('valorAsignado').value;
        document.getElementById('ultimom').value = document.getElementById('valorAsignado').value - document.getElementById('primerm').value;

    }else if(meses.value>2){

        //calcular valor diario
        cal=(dur-1)*30+mdmfin+diaspm;
        //alert('cal'+cal);
        // alert(asignacion.value);
        dmses= asignacion.value/cal;
        //alert('aqui');
        // alert('dmeses'+dmses);
        
        //document.getElementById('primerm').removeAttribute('readonly');
        //document.getElementById('ultimom').removeAttribute('readonly');
        document.getElementById('ultimom').setAttribute('readonly','') 
        document.getElementById('primerm').setAttribute('readonly','')  

        //var mensualidad =(asignacion.value-(m1+m2))/(meses.value-2);
        //alert('vald'+vald);
        var mensualidad = Math.round(dmses * 30);
        console.log("mensualidad"+mensualidad);
            
        valmes.value=parseInt(mensualidad);
        //valmes.value=mensualidad;

        // alert('diaspm'+diaspm);
        // alert('mdmfin'+mdmfin);
        // alert('dmses'+dmses);
        document.getElementById('primerm').value = Math.round(dmses*diaspm);
        document.getElementById('ultimom').value = Math.round(dmses*mdmfin);
    }

   
    

    var nommeses = new Array();
    nommeses[1]="Ene";
    nommeses[2]="Feb";
    nommeses[3]="Mar";
    nommeses[4]="Abr";
    nommeses[5]="May";
    nommeses[6]="Jun";
    nommeses[7]="Jul";
    nommeses[8]="Ago";
    nommeses[9]="Sep";
    nommeses[10]="Oct";
    nommeses[11]="Nov";
    nommeses[12]="Dic";

    //console.log(nommeses[12])

    const tr = document.querySelector("#tmeses"); // <div class="info"></div>  
    const trb = document.querySelector("#tvmeses"); // <div class="info"></div> 
    const trf = document.querySelector("#tfoot"); // <div class="info"></div>
    var unmes= document.querySelector("#valorAsignado").value;         

   
    var ttyear=d2-d1;
    //console.log(ttyear);
    var tyear=d1;
    var mesini=ms1;

    tr.innerHTML="";
    trb.innerHTML="";
    //trf.innerHTML="";
    var mf=12;

    for (var i = 0; i <= ttyear; i++) { 
        if (i==ttyear) {
            mf=ms2;
        }

        for (var k = mesini; k <= mf; k++) {
            tr.innerHTML += "<th>"+nommeses[k]+" <br> "+tyear+"</th>"; // Interpreta el HTML
        }
        mesini=1;
        tyear++;
        
    }   

    ///////
    ///////TD
    //************  

    var df=dmses*mdmfin;
   
    
    if (meses.value==1) {
        var ttyear=d2-d1;   
        var tyear=d1;
        var mesini=ms1; 
        var mf=12;



        for (var i = 0; i <= ttyear; i++) { 
            if (i==ttyear) {
                mf=ms2;
            }

            //fNumber.go(45786477.86, "$");
            // var v_ultimom = Math.round(vald*mdmfin);
            // var vf_ultimom =fNumber.go(10000, "$");
            // console.log(vf_ultimom);

            var vf_mensualidad =fNumber.go(mensualidad, "$");

            for (var k = mesini; k <= mf; k++) {
                trb.innerHTML += "<td>"+vf_mensualidad+"</td>"; // Interpreta el HTML
            }
            mesini=1;
            tyear++;
            
        }
    }

    if (meses.value==2 || meses.value==1) { 
        var ttyear=d2-d1;   
        var tyear=d1;
        var mesini=ms1; 
        var mf=12;
        var contando=0;
        var mm= document.getElementById('valorAsignado').value;
       

        for (var i = 0; i <= ttyear; i++) { 
            if (i==ttyear) {
                mf=ms2;
            }

            cont=0;

            for (var k = mesini; k <= mf; k++) {
                if(cont==0 && contando==0){
                    var vf_mm =fNumber.go(mm, "$");
                    trb.innerHTML += "<td>"+ vf_mm +"</td>"; // Interpreta el HTML
                    cont++;              
                    
                }else if(k==mf && contando==months){
                    var vf_df =fNumber.go(df, "$");
                    trb.innerHTML += "<td>"+vf_df+"</td>";
                }else{
                    var vf_mensualidad =fNumber.go(mensualidad, "$");
                    trb.innerHTML += "<td>"+vf_mensualidad+"</td>"; // Interpreta el HTML
                    
                }
                contando++;
            }
            mesini=1;
            tyear++;
            
        }
    }


    if (meses.value>2) {

     
        var ttyear=d2-d1;   
        var tyear=d1;
        var mesini=ms1; 
        var mf=12;
        var contando=0;
        for (var i = 0; i <= ttyear; i++) { 
            if (i==ttyear) {
                mf=ms2;
            }

            cont=0;


            for (var k = mesini; k <= mf; k++) {
                if(cont==0 && contando==0){
                    var dmdi=dmses*diaspm;
                    var vf_dmdi =fNumber.go(dmdi, "$");
                    trb.innerHTML += "<td>"+vf_dmdi+"</td>"; // Interpreta el HTML
                    cont++;              
                    
                }else if(k==mf && contando==months){
                    var vf_df =fNumber.go(df, "$");
                    trb.innerHTML += "<td>"+vf_df+"</td>";
                }else{
                    var vf_mensualidad =fNumber.go(mensualidad, "$");
                    trb.innerHTML += "<td>"+vf_mensualidad+"</td>"; // Interpreta el HTML
                    
                }
                contando++;
            }
            mesini=1;
            tyear++;
            
        }
    }

    ///////
    ///////Tf
    //************  
                
    var ttyear=d2-d1;
    //console.log(ttyear);
    var tyear=d1;
    var mesini=ms1; 
    var mf=12;



    for (var i = 0; i <= ttyear; i++) { 
        if (i==ttyear) {
            mf=ms2;
        }

        for (var k = mesini; k <= mf; k++) {
            //trf.innerHTML += "<th>"+nommeses[k]+" <br> "+tyear+"</th>"; // Interpreta el HTML
        }
        mesini=1;
        tyear++;
        
    }   

    
};

const meses = ()=> {
    var start1 = new Date(document.getElementById('fechaInicio').value);
    var d1 = start1.getFullYear();
    var m1 = start1.getMonth();

    var start2 = new Date(document.getElementById('fechaFin').value);
    var d2 = start2.getFullYear();
    var m2 = start2.getMonth();
  

    var months;
    months = (d2 - d1) * 12;
    //m1= m1 +1;
    months -= m1 + 1;
    months += m2;
    months <= 0 ? 0 : months;


    
    
};

const actNPFIN = ()=> {
    
    
};

// function ovif(a){
//     if(a==653){
//         document.getElementById('vif').style.display='inline-block';

//     }else{
//         document.getElementById('vif').style.display='none';
//     }
    
//     alert('sisas');
// }



//document.getElementById('vif').style.display='none';



function elimObj(){
    var v = confirm("¿Está seguro de desea Anular y Liberar este registro? \n\n El monto asignado será devuelto al registro inicial.");
    return v;
}

// febrero 2024------------------


function formatearNumero(numero) {
    var numeroSinFormato = numero.replace(/\D/g, '');
    var numeroFormateado = parseInt(numeroSinFormato);

    if (isNaN(numeroFormateado)) {
      return "";
    }

    var parteEntera = numeroFormateado.toLocaleString('es-ES');
    var parteDecimal = numeroSinFormato.slice(parteEntera.length);

    if (parteDecimal.length > 0) {
      parteDecimal = "," + parteDecimal;
    }

    return "$ " + parteEntera + parteDecimal;
}

$(document).ready(function() {
    $("#valorAsignado2").on("input", function() {
      var valorConFormato = $(this).val();
      var valorSinFormato = valorConFormato.replace(/\D/g, '');
      var valorNumerico = parseInt(valorSinFormato);

      if (isNaN(valorNumerico)) {
        return;
      }

      // Convertir el valor numérico a letras
      //var valorEnLetras = convertirNumeroALetras(valorNumerico);

      // Mostrar el valor en letras en el segundo input
      //$("#valorEnLetras").val(valorEnLetras + " PESOS M/CTE");

      // Formatear el valor numérico original con el signo pesos y separador de miles
      var valorFormateado = formatearNumero(valorConFormato);
      $(this).val(valorFormateado);
      $("#valorAsignado").val(valorNumerico);

        
    });
  });