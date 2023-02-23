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

window.addEventListener('DOMContentLoaded', (evento) => {
    const hoy_fecha = new Date().toISOString().substring(0, 10);
    document.querySelector("input[name='fecha']").max = hoy_fecha;

});

$(document).ready(function() {

    $('#referenciado').change(function(e) {
        if ($(this).val() === "1") {

            $('#refe').prop("hidden", false);
            $('#diag').prop("hidden", false);
        } else {
            $('#refe').prop("hidden", true);
            $('#diag').prop("hidden", true);

        }
    })
});

$(function() {
    // $('#refe').prop("hidden", true);
    // $('#diag').prop("hidden", true);
})

function calculaIMC() {

    let talla = document.getElementById('talla').value;
    let peso = document.getElementById('peso').value;


    imccalculo = Math.pow(talla, 2);
    let limitimcalculo = imccalculo.toFixed(2);
    let calculoimc = peso / limitimcalculo;
    let limitcalculofinal = calculoimc.toFixed(1);

    document.formulario.imc.value = limitcalculofinal;

}


function curp2date(curp) {
    var miCurp = document.getElementById('curp').value.toUpperCase();
    var sexo = miCurp.substr(-8, 1);
    var m = miCurp.match(/^\w{4}(\w{2})(\w{2})(\w{2})/);
    //miFecha = new Date(año,mes,dia) 
    var anyo = parseInt(m[1], 10) + 1800;
    if (anyo < 1930) anyo += 100;
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
Date.prototype.toString = function() {
    var anyo = this.getFullYear();
    var mes = this.getMonth() + 1;
    if (mes <= 9) mes = "0" + mes;
    var dia = this.getDate();
    if (dia <= 9) dia = "0" + dia;
    return anyo + "-" + mes + "-" + dia;
}

$(window).load(function() {
    $(".loader").fadeOut("slow");
});

function limpiar() {

    setTimeout('document.formulario.reset()', 1000);
    return false;
}

$(document).ready(function() {

    $('#trombolisis').change(function(e) {
        if ($(this).val() === "Si") {

            $('#iniciotromb').prop("hidden", false);
            $('#finalizotromb').prop("hidden", false);
            $('#fibrinolitico').prop("hidden", false);

        } else {
            $('#iniciotromb').prop("hidden", true);
            $('#finalizotromb').prop("hidden", true);
            $('#fibrinolitico').prop("hidden", true);


        }
    })
});

$(function() {
    $('#iniciotromb').prop("hidden", true);
    $('#finalizotromb').prop("hidden", true);
    $('#fibrinolitico').prop("hidden", true);

})

$(document).ready(function() {

    $('#fibrilonitico').change(function(e) {
        if ($(this).val() === "Si") {

            $('#iniciofibri').prop("hidden", false);
            $('#finalizofibri').prop("hidden", false);

        } else {
            $('#iniciofibri').prop("hidden", true);
            $('#finalizofibri').prop("hidden", true);


        }
    })
});

$(function() {
    $('#iniciofibri').prop("hidden", true);
    $('#finalizofibri').prop("hidden", true);

})
//funcion para carecteristicas tipicas atipicas
$(document).ready(function() {

    $('#caractipicasatipicas').change(function(e) {
        if ($(this).val() === "tipicas") {

            $('#tipicascombos').prop("hidden", false);


        } else {
            $('#tipicascombos').prop("hidden", true);

        }
        if ($(this).val() === "atipicas") {

            $('#atipicascombos').prop("hidden", false);


        } else {
            $('#atipicascombos').prop("hidden", true);

        }
    })
});

$(function() {
    $('#tipicascombos').prop("hidden", true);
    $('#atipicascombos').prop("hidden", true);

})

//MOSTRAR O OCULTAR CHECKBOX DE ELECTROS
$(document).ready(function() {

    $('#electrocardio').change(function(e) {
        if ($(this).val() === "electro con cambios") {

            $('#opcionelectro').prop("hidden", false);


        } else {
            $('#opcionelectro').prop("hidden", true);

        }
        if ($(this).val() === "electro sin cambios") {

            $('#aopcionelectro').prop("hidden", false);


        } else {
            $('#aopcionelectro').prop("hidden", true);

        }
    })
});

$(function() {
    $('#opcionelectro').prop("hidden", true);
    

})

//Mostrar o ocultar fecha y causa de defuncion
$(document).ready(function() {

    $('#defuncion').change(function(e) {
        if ($(this).val() === "Si") {

            $('#defuncionopcion').prop("hidden", false);
            $('#fechadefuncionopcion').prop("hidden", false);


        } else {
            $('#defuncionopcion').prop("hidden", true);
            $('#fechadefuncionopcion').prop("hidden", true);

        }
        
    })
});

$(function() {
    $('#defuncionopcion').prop("hidden", true);
    $('#fechadefuncionopcion').prop("hidden", true);
    

})