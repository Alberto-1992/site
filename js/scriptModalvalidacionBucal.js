function soloLetras(e) {
    textoArea = document.getElementById("curp").value;
    var total = textoArea.length;
    if (total == 0) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toString();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ"; //Se define todo el abecedario que se quiere que se muestre.
        especiales = [8, 9, 37, 39, 46, 6]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.

        tecla_especial = false
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
          swal({
              title: 'Fatal!',
              text: 'No puedes iniciar escribiendo numeros!',
              icon: 'error',
          });
          return false;

      }
    }
}
function Edad(FechaNacimiento) {

    var fechaNace = new Date(FechaNacimiento);
    var fechaActual = new Date()

    var mes = fechaActual.getMonth();
    var dia = fechaActual.getDate();
    var año = fechaActual.getFullYear();

    fechaActual.setDate(dia);
    fechaActual.setMonth(mes);
    fechaActual.setFullYear(año);

    edad = Math.floor(((fechaActual - fechaNace) / (1000 * 60 * 60 * 24) / 365));

    return edad;


}

function calcularEdad() {
    var fecha = document.getElementById('fecha').value;


    var edad = Edad(fecha);
    document.formulario.edad.value = edad;

}
function curp2date(curp) {
    var miCurp = document.getElementById('curp').value.toUpperCase();
    var sexo = miCurp.substr(-8, 1);
    var m = miCurp.match(/^\w{4}(\w{2})(\w{2})(\w{2})/);
    //miFecha = new Date(año,mes,dia) 
    var anyo = parseInt(m[1], 10) + 1900;
    if (anyo < 1940) anyo += 100;
    var mes = parseInt(m[2], 10) - 1;
    var dia = parseInt(m[3], 10);
    document.formulario.fecha.value = (new Date(anyo, mes, dia));
    if (sexo == 'M') {
        document.formulario.sexo.value = 'Femenino';
    } else if (sexo == 'H') {
        document.formulario.sexo.value = 'Masculino';
    } else if (sexo != 'M' || 'H') {
        alert('Error de CURP');
    }

}


//Select multiple de toxicomanias
$(document).ready(function() {
    $('#mstoxicomanias').change(function(e) {  
    }).multipleSelect({
        width: '100%'
    });
});

// Select multiple de hábitos
$(document).ready(function() {
    $('#mshabitos').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});

//Select múltiple de virus
$(document).ready(function() {
    $('#msvirus').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});

// Select multiple de virus
$(document).ready(function() {
    $('#msvirus').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});

// Select multiple de cancer
$(document).ready(function() {
    $('#mscancer').change(function(e) {
    }).multipleSelect({
        width: '100%'
    });
});

// Select multiple de Órgano Dental Fracturado
$(document).ready(function() {
    $('#msao').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});

// Select multiple de Órgano Dental Fracturado
$(document).ready(function() {
    $('#msodf').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});


// Select multiple de MAXILAR SUPERIOR DERECHO
$(document).ready(function() {
    $('#msmaxilarsuperiorderecho').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});

// Select multiple de MAXILAR INFERIOR DERECHO
$(document).ready(function() {
    $('#msmaxilarinferiorderecho').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});

// Select multiple de MAXILAR SUPERIOR IZQUIERDO
$(document).ready(function() {
    $('#msmaxilarsuperiorizquierdo').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});

// Select multiple de MAXILAR INFERIOR IZQUIERDO
$(document).ready(function() {
    $('#msmaxilarinferiorizquierdo').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});

// Select multiple de TIPO DE LESIÓN
$(document).ready(function() {
    $('#mstipodelesion').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});

// Select multiple de TIPO DE LESIÓN
$(document).ready(function() {
    $('#msubicacion').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});


