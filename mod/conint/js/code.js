const agr = document.querySelector('#agr');
agr.addEventListener("click", function() { adctr(4); });
var num = 1;

function UpdFechaFin(d, n = '') {
    const fecha = new Date(d);
    const fecin = (fecha.getFullYear() + 1) + "-" + (fecha.getMonth() + 1) + "-" + (fecha.getDate() + 1);
    document.getElementById("ffinmej" + n).max = fecin;
    document.getElementById("ffinmej" + n).value = fecin;
}

function adctr(deseli) {
    let act = document.querySelector('#act'); // Asegúrate de que 'act' esté definido correctamente

    let mdv1 = document.createElement('div');
    mdv1.id = "dp" + num;
    mdv1.className = "form-group col-md-3";
    mdv1.style.background = "#dfd0f1";

    let mdv2 = document.createElement('div');
    mdv2.id = "dc" + num;
    mdv2.className = "form-group col-md-2";
    mdv2.style.background = "#dfd0f1";

    let mdv3 = document.createElement('div');
    mdv3.id = "dpct" + num;
    mdv3.className = "form-group col-md-2";
    mdv3.style.background = "#dfd0f1";

    let mdv4 = document.createElement('div');
    mdv4.id = "defi" + num;
    mdv4.className = "form-group col-md-2";
    mdv4.style.background = "#dfd0f1";

    let mdv5 = document.createElement('div');
    mdv5.id = "deff" + num;
    mdv5.className = "form-group col-md-2";
    mdv5.style.background = "#dfd0f1";

    let mdv6 = document.createElement('div');
    mdv6.id = "de" + num;
    mdv6.className = "form-group col-md-1";
    mdv6.style.textAlign = "center";

    let accmej = document.createElement('input');
    accmej.type = 'text';
    accmej.name = 'accmej[]';
    accmej.id = 'accmej';
    accmej.required = true;
    accmej.className = "form-control form-control-sm";

    let foract = document.createElement('input');
    foract.type = 'text';
    foract.name = 'foract[]';
    foract.id = 'foract';
    foract.required = true;
    foract.className = "form-control form-control-sm";

    let porcentaje = document.createElement('input');
    porcentaje.type = 'number';
    porcentaje.name = 'porcentaje[]';
    porcentaje.id = 'porcentaje' + num;
    porcentaje.required = true;
    porcentaje.className = "form-control form-control-sm";
    porcentaje.min = 0;
    porcentaje.max = 100;
    porcentaje.addEventListener('input', validatePercentage);

    const fecha = new Date();
    const fecin = fecha.getFullYear() + "-" + (fecha.getMonth() + 1) + "-" + "01";
    let diaant = (fecha.getDate());
    if (diaant < 10) diaant = '0' + diaant;
    let diahoy = fecha.getDate();
    if (diahoy < 10) diahoy = '0' + diahoy;
    const fechoy = fecha.getFullYear() + "-" + (fecha.getMonth() + 1) + "-" + diahoy;
    const fecfi = (fecha.getFullYear() + 1) + "-" + (fecha.getMonth() + 1) + "-" + diaant;

    let finimej = document.createElement('input');
    finimej.type = 'date';
    finimej.name = 'finimej[]';
    finimej.id = 'finimej' + num;
    finimej.value = fechoy;
    finimej.min = fecin;
    finimej.max = fecfi;
    finimej.required = true;
    finimej.className = "form-control form-control-sm";

    let ffinmej = document.createElement('input');
    ffinmej.type = 'date';
    ffinmej.name = 'ffinmej[]';
    ffinmej.id = 'ffinmej' + num;
    ffinmej.value = fecfi;
    ffinmej.min = fecin;
    ffinmej.max = fecfi;
    ffinmej.required = true;
    ffinmej.className = "form-control form-control-sm";

    if (num != 1) {
        mdv6.innerHTML = "<button class='btn btn-danger btn1' title='Eliminar fila' onclick='elitr(" + num + ")'><i class='fa fa-trash'></i></button>";
    } else {
        if (deseli == 4) {
            mdv6.innerHTML = "<button class='btn btn-danger btn1' title='Eliminar fila' onclick='elitr(" + num + ")'><i class='fa fa-trash'></i></button>";
        }
    }

    mdv1.appendChild(accmej);
    mdv2.appendChild(foract);
    mdv3.appendChild(porcentaje);
    mdv4.appendChild(finimej);
    mdv5.appendChild(ffinmej);

    act.appendChild(mdv1);
    act.appendChild(mdv2);
    act.appendChild(mdv3);
    act.appendChild(mdv4);
    act.appendChild(mdv5);
    act.appendChild(mdv6);

    finimej.addEventListener("change", function() { UpdFechaFin(this.value, num - 1); });

    num++;
}

function elitr(n) {
    let h = confirm("¿Desea eliminar el registro selecionado?");
    if (h == true) {
        let dp = document.getElementById("dp" + n);
        let dc = document.getElementById("dc" + n);
        let de = document.getElementById("de" + n);
        let defi = document.getElementById("defi" + n);
        let deff = document.getElementById("deff" + n);
        let dpct = document.getElementById("dpct" + n);

        act.removeChild(dp);
        act.removeChild(dc);
        act.removeChild(de);
        act.removeChild(defi);
        act.removeChild(deff);
        act.removeChild(dpct);

        validatePercentage(); // Recalcular la suma de los porcentajes
    }
}

function validatePercentage() {
    const percentages = document.querySelectorAll('input[name="porcentaje[]"]');
    let total = 0;

    percentages.forEach((input) => {
        total += parseFloat(input.value) || 0;
    });

    if (total > 100) {
        alert("La suma de los porcentajes no puede exceder el 100%");
    }
}
