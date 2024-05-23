const asigmes = ()=> {
    const asignacion = document.querySelector("#asig");

    const meses = document.querySelector("#nmeses");
    const valmes = document.querySelector("#valormensual");
    
    const resu= (asignacion.value)/(meses.value);
    valmes.value=parseInt(resu);

    console.log(resu)

    
};