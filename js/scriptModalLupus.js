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


// APP
$(document).ready(function() {
    $('#msapp').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});


// Habilita tipo biopsia
$(document).ready(function() {
    $('#biopsiaRenal').change(function(e) {
        if ($(this).val() === "Si") {
            $('#idtipobiopsia').prop("hidden", false);
        } else if ($(this).val() === "No") {
            $('#idtipobiopsia').prop("hidden", true);
        }
    })
});
$(function() {
    $('#idtipobiopsia').prop("hidden", true);
})



// Habilita tipo biopsia seguimiento
$(document).ready(function() {
    $('#biopsiaRenalseguimiento').change(function(e) {
        if ($(this).val() === "Si") {
            $('#idtipobiopsiaseguimiento').prop("hidden", false);
        } else if ($(this).val() === "No") {
            $('#idtipobiopsiaseguimiento').prop("hidden", true);
        }
    })
});
$(function() {
    $('#idtipobiopsiaseguimiento').prop("hidden", true);
})
