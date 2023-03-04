function Edadinfarto(FechaNacimiento) {

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

function calcularEdadinfarto() {
    var fecha = document.getElementById('fecha').value;


    var edad = Edadinfarto(fecha);
    document.formularioinfarto.edad.value = edad;

}
function curp2dateinfarto(curp) {
    var miCurp = document.getElementById('curp').value.toUpperCase();
    var sexo = miCurp.substr(-8, 1);
    var m = miCurp.match(/^\w{4}(\w{2})(\w{2})(\w{2})/);
    //miFecha = new Date(año,mes,dia) 
    var anyo = parseInt(m[1], 10) + 1900;
    if (anyo < 1940) anyo += 100;
    var mes = parseInt(m[2], 10) - 1;
    var dia = parseInt(m[3], 10);
    document.formularioinfarto.fecha.value = (new Date(anyo, mes, dia));
    if (sexo == 'M') {
        document.formularioinfarto.sexo.value = 'Femenino';
    } else if (sexo == 'H') {
        document.formularioinfarto.sexo.value = 'Masculino';
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

function calculaIMCinfarto() {

    let talla = document.getElementById('talla').value;
    let peso = document.getElementById('peso').value;


    imccalculo = Math.pow(talla, 2);
    let limitimcalculo = imccalculo.toFixed(2);
    let calculoimc = peso / limitimcalculo;
    let limitcalculofinal = calculoimc.toFixed(1);

    document.formularioinfarto.imc.value = limitcalculofinal;

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
            $('#exitotromb').prop("hidden", false);

        } else if ($(this).val() === "No") {
            $('#iniciotromb').prop("hidden", true);
            $('#finalizotromb').prop("hidden", true);
            $('#fibrinolitico').prop("hidden", true);
            $('#exitotromb').prop("hidden", true);

        }
    })
});

$(function() {
    $('#iniciotromb').prop("hidden", true);
    $('#finalizotromb').prop("hidden", true);
    $('#fibrinolitico').prop("hidden", true);
    $('#exitotromb').prop("hidden", true);


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
            $('#tipicascombos2').prop("hidden", false);


        } else {
            $('#tipicascombos').prop("hidden", true);
             $('#tipicascombos2').prop("hidden", true);

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
     $('#tipicascombos2').prop("hidden", true);
    $('#atipicascombos').prop("hidden", true);

})

//MOSTRAR O OCULTAR CHECKBOX DE ELECTROS
$(document).ready(function() {

    $('#electrocardio').change(function(e) {
        if ($(this).val() === "electro con cambios") {

            $('#opcionelectro').prop("hidden", false);


        } else {
            $('#opcionelectro').prop("hidden", true);
            $('.checkderivaciones:checkbox').removeAttr('checked');

        }
        
    })
});

$(function() {
    $('#opcionelectro').prop("hidden", true);
    

})
//Mostrar ocultar arritmia
$(document).ready(function() {

    $('#complicaciones').change(function(e) {
        if ($(this).val() === "ARRITMIA") {

            $('#arritmias').prop("hidden", false);


        } else {
            $('#arritmias').prop("hidden", true);
            $('#tipobloqueo').prop("hidden", true);
        }
        
    })
});
$(function() {
    $('#arritmias').prop("hidden", true);


})
$(document).ready(function() {

    $('#arritmia').change(function(e) {
        if ($(this).val() === "Bloqueo A-V") {

            $('#tipobloqueo').prop("hidden", false);


        } else {
            $('#tipobloqueo').prop("hidden", true);

        }
        
    })
});

$(function() {
    $('#tipobloqueo').prop("hidden", true);
    

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

$(document).ready(function() {

    $('#procedimientorealizado').change(function(e) {
        if ($(this).val() === "si") {

            $('#iniciodeprocedimiento').prop("hidden", false);
            $('#tipoprocedimiento').prop("hidden", false);
            $('#procedimientofueexitoso').prop("hidden", false);
            $('#tipodelesionangio').prop("hidden", false);
            $('#revasculariza').prop("hidden", false);
            $('#temporalmarcapasos').prop("hidden", false);


        } else {
            $('#iniciodeprocedimiento').prop("hidden", true);
            $('#tipoprocedimiento').prop("hidden", true);
            $('#procedimientofueexitoso').prop("hidden", true);
            $('#tipodelesionangio').prop("hidden", true);
            $('#revasculariza').prop("hidden", true);
            $('#temporalmarcapasos').prop("hidden", true);



        }
        if ($(this).val() === "no") {
            $('#idotc').prop("hidden", true);
            $('#idolusion2').prop("hidden", true);
            $('#idtratamientovaso').prop("hidden", true);
            $('#idsintax').prop("hidden", true);   
            $('#idtromboaspiracion').prop("hidden", true);  
            $('#idtipoinjerto').prop("hidden", true);
            $('#idmediocontraste').prop("hidden", true);
            $('#idestrategia').prop("hidden", true);
            $('#idsitiopuncion').prop("hidden", true);
            $('#idetapasprocedimiento').prop("hidden", true);
            $('#idstend').prop("hidden", true);
            $('#idolusion').prop("hidden", true);
            $('#cantidadstend').prop("hidden", true);
            $('#idseveridad').prop("hidden", true);
            $('#tipodelesionangio').prop("hidden", true);
            $('#revasculariza').prop("hidden", true);
            $('#temporalmarcapasos').prop("hidden", true);

            //limpiar todos los select al seleccionar la opcion de no

            $('#otc').prop('selectedIndex',0);
            $('#olusion2').prop('selectedIndex',0);
            $('#tratamientovaso').prop('selectedIndex',0);
            $('#sintax').prop('selectedIndex',0);
            $('#tromboaspiracion').prop('selectedIndex',0);
   
            $('#estrategia').prop('selectedIndex',0);
            $('#sitiodepuncion').prop('selectedIndex',0);
            $('#stent').prop('selectedIndex',0);
            $('#etapasprocedimiento').prop('selectedIndex',0);
            $('#olusion').prop('selectedIndex',0);
            $('#severidad').prop('selectedIndex',0);
            $('#tipodeprocedimiento').prop('selectedIndex',0);
            $('#procedimientoexitoso').prop('selectedIndex',0);

            $('#inicioprocedimiento').val('');
            $('#tipodeinjerto').val('');
            $('#mediodecontraste').val('');
            $('#lesionangeo').prop("selectedIndex", 0);
            $('#revascularizacion').prop("selectedIndex", 0);
            $('#marcapasostemporal').prop("selectedIndex", 0);

        }else{

        }
        
    })
});

$(function() {
    $('#iniciodeprocedimiento').prop("hidden", true);
    $('#tipoprocedimiento').prop("hidden", true);
    $('#procedimientofueexitoso').prop("hidden", true);

    $('#idotc').prop("hidden", true);
    $('#idolusion2').prop("hidden", true);
    $('#idtratamientovaso').prop("hidden", true);
    $('#idsintax').prop("hidden", true);   
    $('#idtromboaspiracion').prop("hidden", true);  
    $('#idtipoinjerto').prop("hidden", true);
    $('#idmediocontraste').prop("hidden", true);
    $('#idestrategia').prop("hidden", true);
    $('#idsitiopuncion').prop("hidden", true);
    $('#idetapasprocedimiento').prop("hidden", true);
    $('#idstend').prop("hidden", true);
    $('#idolusion').prop("hidden", true);

    $('#idseveridad').prop("hidden", true);
    $('#tipodelesionangio').prop("hidden", true);
    $('#revasculariza').prop("hidden", true);
    $('#temporalmarcapasos').prop("hidden", true);
    $('#cantidadstend').prop("hidden", true);
    
    

})

$(document).ready(function() {

    $('#tipodeprocedimiento').change(function(e) {
        if ($(this).val() === "Coronariografia") {

            $('#idestrategia').prop("hidden", false);
            $('#idsitiopuncion').prop("hidden", false);
            $('#idetapasprocedimiento').prop("hidden", false);
            $('#idstend').prop("hidden", false);
            $('#idolusion').prop("hidden", false);
            $('#cantidadstend').prop("hidden", false);
            


        } else {
            $('#idestrategia').prop("hidden", true);
            $('#idsitiopuncion').prop("hidden", true);
            $('#idetapasprocedimiento').prop("hidden", true);
            $('#idstend').prop("hidden", true);
            $('#idolusion').prop("hidden", true);

            $('#estrategia').prop('selectedIndex',0);
            $('#sitiodepuncion').prop('selectedIndex',0);
            $('#etapasprocedimiento').prop('selectedIndex',0);
            $('#stent').prop('selectedIndex',0);
            $('#stentcantidad').prop('selectedIndex', 0);
            $('#olusion').prop('selectedIndex',0);
            $('#cantidadstend').prop("hidden", true);
    

        }
        if($(this).val() === "Angioplastia coronaria trasnluminal") {
            $('#idseveridad').prop("hidden", false);
            $('#cantidadstend').prop("hidden", true);
            


        } else {
            $('#idseveridad').prop("hidden", true);
            
            $('#otc').prop('selectedIndex',0);
            $('#olusion2').prop('selectedIndex',0);
            $('#tratamientovaso').prop('selectedIndex',0);
            $('#sintax').prop('selectedIndex',0);
            $('#tromboaspiracion').prop('selectedIndex',0);
   
            $('#estrategia').prop('selectedIndex',0);
            $('#sitiodepuncion').prop('selectedIndex',0);
            $('#stent').prop('selectedIndex',0);
            $('#stentcantidad').prop('selectedIndex', 0);
            $('#etapasprocedimiento').prop('selectedIndex',0);
            $('#olusion').prop('selectedIndex',0);
            $('#severidad').prop('selectedIndex',0);

            $('#inicioprocedimiento').val('');
            $('#tipodeinjerto').val('');
            $('#mediodecontraste').val(''); 

        }
        
    })
});

$(function() {
    $('#idestrategia').prop("hidden", true);
            $('#idsitiopuncion').prop("hidden", true);
            $('#idetapasprocedimiento').prop("hidden", true);
            $('#idstend').prop("hidden", true);
            $('#idolusion').prop("hidden", true);

            $('#idseveridad').prop("hidden", true);
    
    

})

$(document).ready(function() {

    $('#severidad').change(function(e) {
        if ($(this).val() === "OTC") {

            $('#idotc').prop("hidden", false);
            $('#idolusion2').prop("hidden", false);
            $('#idtratamientovaso').prop("hidden", false);
            $('#idtromboaspiracion').prop("hidden", false);
            $('#idtipoinjerto').prop("hidden", false);
            $('#idmediocontraste').prop("hidden", false);
           
            


        } else {
            $('#idotc').prop("hidden", true);
            $('#idolusion2').prop("hidden", true);
            $('#idtratamientovaso').prop("hidden", true);
            $('#idtromboaspiracion').prop("hidden", true);
            $('#idtipoinjerto').prop("hidden", true);
            $('#idmediocontraste').prop("hidden", true);

            $('#otc').prop('selectedIndex',0);
            $('#olusion2').prop('selectedIndex',0);
$('#tratamientovaso').prop('selectedIndex',0);
$('#tromboaspiracion').prop('selectedIndex',0);
$('#tipodeinjerto').val('');
            $('#mediodecontraste').val(''); 
            $('#sintax').prop('selectedIndex',0);


        }

        if ($(this).val() === "SINTAX") {

            $('#idsintax').prop("hidden", false);
            
       

        } else {
            $('#idsintax').prop("hidden", true);
            $('#otc').prop('selectedIndex',0);
            $('#olusion2').prop('selectedIndex',0);
$('#tratamientovaso').prop('selectedIndex',0);
$('#tromboaspiracion').prop('selectedIndex',0);
$('#tipodeinjerto').val('');
            $('#mediodecontraste').val(''); 

        }
    
        
    })
});

$(function() {
    $('#idotc').prop("hidden", true);
    $('#idolusion2').prop("hidden", true);
    $('#idtratamientovaso').prop("hidden", true);
    $('#idsintax').prop("hidden", true);   
    $('#idtromboaspiracion').prop("hidden", true);  
    $('#idtipoinjerto').prop("hidden", true);
    $('#idmediocontraste').prop("hidden", true);
    

})
$(document).ready(function() {

    $('#electrocardio').change(function(e) {
        if ($(this).val() === "electro con cambios") {

            $('#opcionelectro').prop("hidden", false);


        } else {
            $('#opcionelectro').prop("hidden", true);
            $('.checkderivaciones:checkbox').removeAttr('checked');

        }
        
    })
});

$(function() {
    $('#opcionelectro').prop("hidden", true);
    

})
//Mostrar ocultar arritmia

$(document).ready(function() {

    $('#ms').change(function(e) {

        if ( $(this).val() === "ARRITMIA") {
            
            $('#arritmias').prop("hidden", false);


        } else {
            $('#arritmias').prop("hidden", true);
            $('#tipobloqueo').prop("hidden", true);
        }
        
    })
});
$(function() {
    $('#arritmias').prop("hidden", true);


})
$(document).ready(function() {

    $('#mscancer').change(function(e) {

        
    }).multipleSelect({
        width: '100%'
    });
});
$(document).ready(function () {

    $('#msfactores').change(function (e) {


    }).multipleSelect({
        width: '100%'
    });
});
$(document).ready(function() {

    $('#arritmia').change(function(e) {
        if ($(this).val() === "Bloqueo A-V") {

            $('#tipobloqueo').prop("hidden", false);


        } else {
            $('#tipobloqueo').prop("hidden", true);

        }
        
    })
});

$(function() {
    $('#tipobloqueo').prop("hidden", true);
    

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



//Se agrega condición en protesis endovascular
