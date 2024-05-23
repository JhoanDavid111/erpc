function mostrarOpciones() {
    document.getElementById("opciones").style.display = "block";
    document.getElementById('crearEquipo').style.display = 'block';
    document.getElementById('seleccionarEquipo').style.display = 'none';
  }

  function ocultarOpciones() {
    document.getElementById("opciones").style.display = "none";
    document.getElementById('crearEquipo').style.display = 'block';
    document.getElementById('seleccionarEquipo').style.display = 'none';
  }

function mostrarCrearEquipo(n) {
    document.getElementById('crearEquipo'+n).style.display = 'block';
    document.getElementById('seleccionarEquipo'+n).style.display = 'none';
    // document.getElementById("opciones").style.display = "block";
}

function SeleccionarEquipo(n) {
    document.getElementById('crearEquipo'+n).style.display = 'none';
    document.getElementById('seleccionarEquipo'+n).style.display = 'block';
    // document.getElementById("opciones").style.display = "block";
}

