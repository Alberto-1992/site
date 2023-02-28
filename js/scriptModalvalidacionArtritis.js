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
    $("#tratamientogluco").prop("disabled", true);
    $("#dosisSemanalvitad").prop("disabled", true);
    $("#tratamientobiologico").prop("disabled", true);
    $("#dosisSemanalmetro").val('0');
    $("#dosisSemanalfemua").val('0');
    $("#dosisSemanalsulfa").val('0');
    $("#dosisSemanalteco").val('0');
    $("#dosisSemanaltrata").val('0');

})
function metrotexatesi(){
    let metrotexate = $("#metrotexate1").val();
    if(metrotexate == 'si'){
        $("#dosisSemanalmetro").prop('disabled', false);
        $("#dosisSemanalmetro").val('');
    };
    
}
function metrotexateno(){
    let metrotexate = $("#metrotexate2").val();
    if(metrotexate == 'no'){
        $("#dosisSemanalmetro").prop('disabled', true);
        $("#dosisSemanalmetro").val('0');

    };
    
}

function Leflunomidesi() {
    let Leflunomide = $("#leflunomide1").val();

    if(Leflunomide == 'si'){
        $("#dosisSemanalfemua").prop('disabled', false);
        $("#dosisSemanalfemua").val('');

    }
}
function Leflunomideno() {
    let Leflunomide = $("#leflunomide2").val();

    if(Leflunomide == 'no'){
        $("#dosisSemanalfemua").prop('disabled', true);
        $("#dosisSemanalfemua").val('0');

    }
}

function Sulfazalasinasi() {
    let Sulfazalasina = $("#sulfazalasina1").val();

    if(Sulfazalasina == 'si'){
        $("#dosisSemanalsulfa").prop('disabled', false);
        $("#dosisSemanalsulfa").val('');
    }
}
function Sulfazalasinano() {
    let Sulfazalasina = $("#sulfazalasina2").val();

    if(Sulfazalasina == 'no'){
        $("#dosisSemanalsulfa").prop('disabled', true);
        $("#dosisSemanalsulfa").val('0');
    }
}

function Tocoferolsi() {
    let Tocoferol = $("#tecoferol1").val();

    if(Tocoferol == 'si'){
        $("#dosisSemanalteco").prop('disabled', false);
        $("#dosisSemanalteco").val('');
    }
}
function Tocoferolno() {
    let Tocoferol = $("#tecoferol2").val();

    if(Tocoferol == 'no'){
        $("#dosisSemanalteco").prop('disabled', true);
        $("#dosisSemanalteco").val('0');
    }
}

function Glucocorticoidesi() {
    let Glucocorticoide = $("#glucocorticoide1").val();

    if(Glucocorticoide == 'si'){
        $("#tratamientogluco").prop('disabled', false);
        $("#dosisSemanaltrata").prop('disabled', false);
        $("#dosisSemanaltrata").val('');
    }
}

function Glucocorticoideno() {
    let Glucocorticoide = $("#glucocorticoide2").val();

    if(Glucocorticoide == 'no'){
        $("#tratamientogluco").prop('disabled', true);
        $("#tratamientogluco").prop('selectedIndex', 0);
        $("#dosisSemanaltrata").prop('disabled', true);
        $("#dosisSemanaltrata").val('0');
    }
}

function vitaminadsi() {
    let vitaminade = $("#vitaminaD1").val();

        if(vitaminade == 'si'){
            $("#dosisSemanalvitad").prop("disabled", false);
            $("#dosisSemanalvitad").val('');
        }
}
function vitaminadno() {
    let vitaminade = $("#vitaminaD2").val();

        if(vitaminade == 'no'){
            $("#dosisSemanalvitad").prop("disabled", true);
            $("#dosisSemanalvitad").val('0');
        }
}

function Biologico() {
    let biolo = $("#biologico").val();

    if(biolo == 'si'){
        $("#tratamientobiologico").prop("disabled", false);
    }else if(biolo == 'no'){
        $("#tratamientobiologico").prop("disabled", true);
        $("#tratamientobiologico").prop("selectedIndex", 0);
    }

}