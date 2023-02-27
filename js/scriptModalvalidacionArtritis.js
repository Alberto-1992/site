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
    document.formularioartritis.edad.value = edad;

}
function curp2date(curp) {
    var miCurp = document.getElementById('curp').value.toUpperCase();
    var sexo = miCurp.substr(-8, 1);
    var m = miCurp.match(/^\w{4}(\w{2})(\w{2})(\w{2})/);
    //miFecha = new Date(año,mes,dia) 
    var anyo = parseInt(m[1], 10) + 1900;
    if (anyo < 1920) anyo += 100;
    var mes = parseInt(m[2], 10) - 1;
    var dia = parseInt(m[3], 10);
    document.formularioartritis.fecha.value = (new Date(anyo, mes, dia));
    if (sexo == 'M') {
        document.formularioartritis.sexo.value = 'Femenino';
    } else if (sexo == 'H') {
        document.formularioartritis.sexo.value = 'Masculino';
    } else if (sexo != 'M' || 'H') {
        alert('Error de CURP');
    }

}
$(document).ready(function () {

    $('#msartritis').change(function (e) {


    }).multipleSelect({
        width: '100%'
    });
});
$(document).ready(function () {

    $('#mspato').change(function (e) {


    }).multipleSelect({
        width: '100%'
    });
});

$(document).ready(function () {

    $('#sitiometastasis2').change(function (e) {


    }).multipleSelect({
        width: '100%'
    });
});

$(document).ready(function () {

    $('#mamaseleccion').change(function (e) {


    }).multipleSelect({
        width: '100%'
    });
});
$(document).ready(function () {

    $('#mamaseleccioninmuno').change(function (e) {


    }).multipleSelect({
        width: '100%'
    });
});
$(document).ready(function () {

    $('#mamaseleccionmolecular').change(function (e) {


    }).multipleSelect({
        width: '100%'
    });
});
$(document).ready(function () {

    $('#quirurgicotipo').change(function (e) {


    }).multipleSelect({
        width: '100%'
    });
});

Date.prototype.toString = function () {
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

    let talla = document.getElementById('talla').value;
    let peso = document.getElementById('peso').value;


    imccalculo = Math.pow(talla, 2);
    let limitimcalculo = imccalculo.toFixed(2);
    let calculoimc = peso / limitimcalculo;
    let limitcalculofinal = calculoimc.toFixed(1);

    document.formularioartritis.imc.value = limitcalculofinal;

}
$(document).ready(function () {
    $("#usghepatico").change(function (e) {
        let valorusg = $('#usghepatico').val();

        if (valorusg == 'Si') {

            $('#hallazgodeusg').prop("hidden", false);
            $('#esteatosis').prop("hidden", false);
            $('#hallazgousg').prop("selectedIndex", 0);
            $('#clasificacionesteatosis').prop("selectedIndex", 0);


        } else if (valorusg == 'No') {
            $('#hallazgodeusg').prop("hidden", true);
            $('#esteatosis').prop("hidden", true);
            $('#hallazgousg').prop("selectedIndex", 0);
            $('#clasificacionesteatosis').prop("selectedIndex", 0);


        }
    })
});
$(function () {
    $('#hallazgodeusg').prop("hidden", true);
    $('#esteatosis').prop("hidden", true);
    $('#hallazgousg').prop("selectedIndex", 0);
    $('#clasificacionesteatosis').prop("selectedIndex", 0);
    $('#dosisSemanalmetro').prop("disabled", true);
    $('#dosisSemanalfemua').prop("disabled", true);
    $('#dosisSemanalsulfa').prop("disabled", true);
    $("#dosisSemanalteco").prop("disabled", true);
    $("#dosisSemanaltrata").prop("disabled", true);

})