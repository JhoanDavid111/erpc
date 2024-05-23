const asigmes = ()=> {
    const asignacion = document.querySelector("#asig");

    const meses = document.querySelector("#nmeses");
    const valmes = document.querySelector("#valormensual");
    
    const resu= (asignacion.value)/(meses.value);
    valmes.value=parseInt(resu);

    console.log(resu)

    
};

function bsqava(ms){
    if(ms==1){
        document.getElementById("ba").style.display = "inherit";
        document.getElementById("bba").style.display = "none";
        document.getElementById("bbb").style.display = "block";
    }else{
        document.getElementById("ba").style.display = "none";
        document.getElementById("bba").style.display = "block";
        document.getElementById("bbb").style.display = "none";
    }
    
}