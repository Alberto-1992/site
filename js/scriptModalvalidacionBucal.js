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

function calcularEdadbucal() {
    var fecha = document.getElementById('fecha').value;


    var edad = Edad(fecha);
    document.formulariocancerbucal.edad.value = edad;

}
function curp2datebucal(curp) {
    var miCurp = document.getElementById('curp').value.toUpperCase();
    var sexo = miCurp.substr(-8, 1);
    var m = miCurp.match(/^\w{4}(\w{2})(\w{2})(\w{2})/);
    //miFecha = new Date(año,mes,dia) 
    var anyo = parseInt(m[1], 10) + 1900;
    if (anyo < 1940) anyo += 100;
    var mes = parseInt(m[2], 10) - 1;
    var dia = parseInt(m[3], 10);
    document.formulariocancerbucal.fecha.value = (new Date(anyo, mes, dia));
    if (sexo == 'M') {
        document.formulariocancerbucal.sexo.value = 'Femenino';
    } else if (sexo == 'H') {
        document.formulariocancerbucal.sexo.value = 'Masculino';
    } else if (sexo != 'M' || 'H') {
        alert('Error de CURP');
    }

}
Date.prototype.toString = function() {
    var anyo = this.getFullYear();
    var mes = this.getMonth() + 1;
    if (mes <= 9) mes = "0" + mes;
    var dia = this.getDate();
    if (dia <= 9) dia = "0" + dia;
    return anyo + "-" + mes + "-" + dia;
}
window.addEventListener('DOMContentLoaded', (evento) => {
    const hoy_fecha = new Date().toISOString().substring(0, 10);
    document.querySelector("input[name='fecha']").max = hoy_fecha;

});
function calculaIMC() {

    let talla = document.getElementById('tallabucal').value;
    let peso = document.getElementById('pesobucal').value;


    imccalculo = Math.pow(talla, 2);
    let limitimcalculo = imccalculo.toFixed(2);
    let calculoimc = peso / limitimcalculo;
    let limitcalculofinal = calculoimc.toFixed(1);

    document.formulariocancerbucal.imcbucal.value = limitcalculofinal;

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

// Select multiple de TIPO DE LESIÓN
$(document).ready(function() {
    $('#msqueva').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});


// Select multiple de TIPO DE LESIÓN
$(document).ready(function() {
    $('#msqueva2').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});


// UBICACIÓN DERECHA - MULTIPLE SELECT DE MAXILAR SUPERIOR DERECHO
$(document).ready(function() {
    $('#msmaxisd').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});

// UBICACIÓN DERECHA - MULTIPLE SELECT DE MAXILAR INFERIOR DERECHO
$(document).ready(function() {
    $('#msmaxiid').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});


// UBICACIÓN DERECHA - MULTIPLE SELECT DE MAXILAR SUPERIOR IZQUIERDO
$(document).ready(function() {
    $('#msmaxisi').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});


// UBICACIÓN DERECHA - MULTIPLE SELECT DE MAXILAR INFERIOR IZQUIERDO
$(document).ready(function() {
    $('#msmaxiiz').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});

$(function () {
    $('#medioreferencia').prop("hidden", true);
    $('#yearstabaquismo').prop("hidden", true);
    $('#diacigarros').prop("hidden", true);
    $('#alcoholfrecuencia').prop("hidden", true);

    /**afectaciones dentales */
    $('#afectaciondental').prop('#hidden',true);
    $('#tituloafectaciondental').prop('hidden',true);
    $('#tipodeodf').prop('hidden',true);
    $('#maxilarsd').prop('hidden',true);
    $('#maxilarid').prop('hidden',true);
    $('#maxilarsd2').prop('hidden',true);
    $('#maxilarid2').prop('hidden',true);
    
})

$(document).ready(function () {
    $("#referenciado").change(function (e) {
        if (referenciado.options[1].selected == true) {

            $('#medioreferencia').prop("hidden", false);
        } else if (referenciado.options[2].selected == true) {
            $('#medioreferencia').prop("hidden", true);
            $('#unidadreferencia').prop('selectedIndex',0);
        }

    })
});
$(document).ready(function () {
    $("#mstoxicomanias").change(function (e) {
        if (mstoxicomanias.options[0].selected == true) {

            $('#alcoholfrecuencia').prop("hidden", false);
        } else if (mstoxicomanias.options[0].selected == false) {
            $('#alcoholfrecuencia').prop("hidden", true);
            $('#frecuenciaal').prop('selectedIndex',0);
        }

    })
});
$(document).ready(function () {
    $("#mstoxicomanias").change(function (e) {
        if(mstoxicomanias.options[1].selected == true) {
            $('#yearstabaquismo').prop("hidden", false);
            $('#diacigarros').prop("hidden", false);

        }else if(mstoxicomanias.options[1].selected == false) {
            $('#yearstabaquismo').prop("hidden", true);
            $('#diacigarros').prop("hidden", true);
            $('#cigarrosdia').val('');
            $('#anostabaquismo').val('');

        }

    })
});


