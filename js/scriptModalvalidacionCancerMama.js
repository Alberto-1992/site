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
$(document).ready(function() {

    $('#mscancer').change(function(e) {

        
    }).multipleSelect({
        width: '100%'
    });
});
$(document).ready(function() {

    $('#mspato').change(function(e) {

        
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
        if ($(this).val() === "Si") {

            $('#medioreferencia').prop("hidden", false);
        } else {
            $('#medioreferencia').prop("hidden", true);
            $('#unidadreferencia').val('');

        }
    })
});

$(function() {
    $('#medioreferencia').prop("hidden", true);

})
//clasificacion tamaños tumorales
$(document).ready(function() {

    $('#etapasclinicas').change(function(e) {
        if ($(this).val() === "TNM") {

            $('#tumoraltamanio').prop("hidden", false);
            $('#nodal_linfatico').prop("hidden", false);
            $('#metasta').prop("hidden", false);
            $('#calidaddevidaecog').prop("selectedIndex",0);
            $('#etapasclasificacion').prop("selectedIndex", 0);
        } else {
            $('#tumoraltamanio').prop("hidden", true);
            $('#nodal_linfatico').prop("hidden", true);
            $('#metasta').prop("hidden", true);
            $('#metastasissitio').prop("hidden", true);
        
        }
    })
});
function calcularmestruacion(){
    const fecha = toLocaleDateString();
    alert(fecha);
}
$(function() {
    $('#tumoraltamanio').prop("hidden", true);
    $('#nodal_linfatico').prop("hidden", true);
    $('#metasta').prop("hidden", true);
    $('#metastasissitio').prop("hidden", true);
})

$(document).ready(function() {

    $('#etapasclinicas').change(function(e) {
        if ($(this).val() === "Etapas") { 

            $('#etapas').prop("hidden", false);
            $('#tamañotumoral').prop('selectedIndex',0);
            $('#linfaticonodal').prop('selectedIndex',0);
            $('#metastasis').prop('selectedIndex',0);
            $('#sitiometastasis').prop("selectedIndex", 0);
            $('#calidaddevidaecog').prop("selectedIndex",0);
                } else {
            $('#etapas').prop("hidden", true);
            $('#etapasclasificacion').prop("selectedIndex", 0);

        }
    })
});
$(function() {

    $('#etapas').prop("hidden", true);

})
//Etapas metastasicas

//Etapa fish
$(document).ready(function() {

    $('#oncogen').change(function(e) {
        if ($(this).val() === "Dos cruces") {

            $('#fish').prop("disabled", false);
        } else {
            $('#fish').prop("disabled", true);
            $('#fish').prop("selectedIndex", 0);

        }
    })
});
$(document).ready(function () {

    $('#oncogeniz').change(function (e) {
        if ($(this).val() === "Dos cruces") {

            $('#fishiz').prop("disabled", false);
        } else {
            $('#fishiz').prop("disabled", true);
            $('#fishiz').prop("selectedIndex", 0);

        }
    })
});
$(document).ready(function () {

    $('#oncogenrgd').change(function (e) {
        if ($(this).val() === "Dos cruces") {

            $('#fishrgd').prop("disabled", false);
        } else {
            $('#fishrgd').prop("disabled", true);
            $('#fishrgd').prop("selectedIndex", 0);

        }
    })
});
$(document).ready(function () {

    $('#oncogenizrgi').change(function (e) {
        if ($(this).val() === "Dos cruces") {

            $('#fishizrgi').prop("disabled", false);
        } else {
            $('#fishizrgi').prop("disabled", true);
            $('#fishizrgi').prop("selectedIndex", 0);

        }
    })
});



$(function() {
    $('#fish').prop("disabled", true);
    $('#fishiz').prop("disabled", true);
    $('#fishrgd').prop("disabled", true);
    $('#fishizrgi').prop("disabled", true);
    $('#pdlrgd').prop("disabled", true);
    $('#pdliz').prop("disabled", true);
    $('#pdlrgiz').prop("disabled", true);
    $('#fishizrgi').prop("disabled", true);
    $('#fishizrgi').prop("selectedIndex", 0);

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

    $('#procedimientorealizado').change(function(e) {
        if ($(this).val() === "si") {

            $('#iniciodeprocedimiento').prop("hidden", false);
            $('#tipoprocedimiento').prop("hidden", false);
            $('#procedimientofueexitoso').prop("hidden", false);
            


        } else {
            $('#iniciodeprocedimiento').prop("hidden", true);
            $('#tipoprocedimiento').prop("hidden", true);
            $('#procedimientofueexitoso').prop("hidden", true);

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

            $('#idseveridad').prop("hidden", true);

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
    
    

})

$(document).ready(function() {

    $('#tipodeprocedimiento').change(function(e) {
        if ($(this).val() === "Coronariografia") {

            $('#idestrategia').prop("hidden", false);
            $('#idsitiopuncion').prop("hidden", false);
            $('#idetapasprocedimiento').prop("hidden", false);
            $('#idstend').prop("hidden", false);
            $('#idolusion').prop("hidden", false);
            


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
            $('#olusion').prop('selectedIndex',0);
    

        }
        if($(this).val() === "Angioplastia coronaria trasnluminal") {
            $('#idseveridad').prop("hidden", false);
        
            


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

//Diferencia de fecha si un es mayor a un año o menor
function calcularmestruacion(){
    
var fecha1 = $("#fechaultimamestruacion").val();
var fechaActual = new Date()
if(fecha1 == ''){
}else{
const fecha_compare_1 = new Date(fecha1)
const fecha_compare_2 = new Date(fechaActual)

fecha_compare_1.setMonth(fecha_compare_1.getMonth()+ 12);

//alert(`fecha1 es mayor a 12 meses? > ${fecha_compare_1> fecha_compare_2} `  )
    const menopausea = 'Menopausia';
    const perimenopausea = 'Perimenopausia';
if (fecha_compare_1< fecha_compare_2){
    $('#menopauperimenopau').prop("hidden", false);
    $('#menopausea').val(menopausea);
}else{
    $('#menopauperimenopau').prop("hidden", false);
    $('#menopausea').val(perimenopausea);
}

}
}
$(function() {
    $('#menopauperimenopau').prop("hidden", false);
    

})
/*numero de gestas*/
$(document).ready(function() {

    $('#gestas').change(function(e) {
        if ($(this).val() != 0) {

            $('#partoid').prop("hidden", false);
            $('#abortoid').prop("hidden", false);
            $('#cesareaid').prop("hidden", false);
            $('#cesarea').val('');
            $('#aborto').val('');
            $('#parto').val('');

        }else{
            $('#partoid').prop("hidden", true);
            $('#abortoid').prop("hidden", true);
            $('#cesareaid').prop("hidden", true);
            $('#cesarea').val('');
            $('#aborto').val('');
            $('#parto').val('');
        }

    })
});
$(function(){
    $('#partoid').prop("hidden", true);
    $('#abortoid').prop("hidden", true);
    $('#cesareaid').prop("hidden", true);
});
function validaparto(){
    let parto = parseFloat($("#parto").val());
    let aborto = parseFloat($("#aborto").val());
    let cesarea = parseFloat($("#cesarea").val());
    let cantidad = parseFloat($("#gestas").val());
        let sumauno = parto + aborto;
    let sumados = parto + cesarea;
    let sumatres = cesarea + aborto;

        if(parto === cantidad){
            $('#abortoid').prop("hidden", true);
            $('#cesareaid').prop("hidden", true);
            $('#aborto').val('');
            $('#cesarea').val('');
        }else{
            $('#abortoid').prop("hidden", false);
            $('#cesareaid').prop("hidden", false);
        }
    if (aborto === cantidad) {
        $('#partoid').prop("hidden", true);
        $('#cesareaid').prop("hidden", true);
        $('#parto').val('');
        $('#cesarea').val('');
    }
    if (cesarea === cantidad) {
        $('#abortoid').prop("hidden", true);
        $('#partoid').prop("hidden", true);
        $('#parto').val('');
        $('#aborto').val('');
        }

    if (sumauno === cantidad) {
        $('#cesareaid').prop("hidden", true);
        $('#cesarea').val('');

        }

    if (sumados === cantidad) {
        $('#abortoid').prop("hidden", true);

            $('#aborto').val('');
        }
    if (sumatres === cantidad) {
        $('#partoid').prop("hidden", true);
        
            $('#parto').val('');
        }
    if (cantidad === '0') {
        $('#cesarea').val('');
        $('#aborto').val('');
        $('#parto').val('');
        }
        
    
}
$(document).ready(function() {

    $('#planificacionfamiliar').change(function(e) {
    let parto = parseFloat($("#parto").val());
    let aborto = parseFloat($("#aborto").val());
    let cesarea = parseFloat($("#cesarea").val());
    let cantidad = parseFloat($("#gestas").val());
        let sumar = parto + aborto + cesarea;

    if(sumar > cantidad || parto > cantidad || aborto > cantidad || cesarea > cantidad){
        swal({
            title: 'Warning!',
            text: 'Error! Las sumas de Parto, Aborto y Cesarea no empatan con la cantidad de gestas, Favor de verificar!',
            icon: 'error',
            
        });
    } else if (sumar < cantidad) {
        swal({
            title: 'Warning!',
            text: 'Error! Las sumas de Parto, Aborto y Cesarea no empatan con la cantidad de gestas, Favor de verificar!',
            icon: 'error',

        });
    } else if (cantidad === 0) {

    }

    
});
});
$(document).ready(function() {

    $('#lactancia').change(function(e) {
    let parto = parseFloat($("#parto").val());
    let aborto = parseFloat($("#aborto").val());
    let cesarea = parseFloat($("#cesarea").val());
    let cantidad = parseFloat($("#gestas").val());
        let sumar = parto + aborto + cesarea;

        if (sumar > cantidad) {
        swal({
            title: 'Warning!',
            text: 'Error! Las sumas de Parto, Aborto y Cesarea no empatan con la cantidad de gestas, Favor de verificar!',
            icon: 'error',
            
        });
        } else if (sumar < cantidad) {
            swal({
                title: 'Warning!',
                text: 'Error! Las sumas de Parto, Aborto y Cesarea no empatan con la cantidad de gestas, Favor de verificar!',
                icon: 'error',

            });
        } else if (cantidad === 0) {

    }


});
});

/*termina numero de gestas*/
/*quirurgico*/
$(document).ready(function() {

    $('#quirurgico').change(function(e) {
        if ($(this).val() === "Si") {

            $('#tipoquirurgico').prop("hidden", false);
            $('#reconstruccion').prop("hidden", false);
            $('#lateralidad').prop("hidden", false);
            $("#guardaApartado").prop("hidden", false);

        } else if ($(this).val() === "No") {
            $('#tipoquirurgico').prop("hidden", true);
            $('#tipomastectomia').prop("hidden", true);
            $('#reconstruccion').prop("hidden", true);
            $('#tipoganglionar').prop("hidden", true);
            $('#tiporeconstruccion').prop("hidden", true);
            $('#fechatipomastectomia').prop("hidden", true);
            $('#fechatipoganglionar').prop("hidden", true);
            $("#guardaApartado").prop("hidden", true);
            $('#lateralidad').prop("hidden", true);
            $('#fechatiporeconstruccion').val('');
            $('#reconstrucciontipofecha').prop('hidden', true);
            $('#quirurgicotipo').prop('selectedIndex',0);
            $('#mastectomiatipo').prop("selectedIndex", 0);
            $('#reconstruccionsino').prop("selectedIndex", 0);
            $('#fechatipomastecto').prop("selectedIndex", 0);
            $('#fechatipoganglio').prop("selectedIndex", 0);
            $('#reconstrucciontipo').prop("selectedIndex", 0);
            $('#lateralidadsegundo').prop("selectedIndex", 0);
            $('#reconstrucciontipo').prop("selectedIndex", 0);
        }
    })
});

$(function() {
    $('#tipoquirurgico').prop("hidden", true);
    $('#tipomastectomia').prop("hidden", true);
    $('#reconstruccion').prop("hidden", true);
    $('#tipoganglionar').prop("hidden", true);
    $('#tiporeconstruccion').prop("hidden", true);
    $('#lateralidad').prop("hidden", true);
    $('#reconstrucciontipofecha').prop("hidden", true);
    $("#guardaApartado").prop("hidden", true);
    $('#quirurgicotipo').prop('selectedIndex',0);
    $('#mastectomiatipo').prop("selectedIndex", 0);
    $('#reconstruccionsino').prop("selectedIndex", 0);
    $('#fechatipomastecto').prop("selectedIndex", 0);
    $('#fechatipoganglio').prop("selectedIndex", 0);
    $('#lateralidadsegundo').prop("selectedIndex", 0);
    $('#fechatiporeconstruccion').val('');

})
/*termina quirurgico*/
/*mastectomia ganglionar*/
$(document).ready(function() {

    $('#quirurgicotipo').change(function(e) {
        if ($(this).val() === "Mastectomia") {

            $('#tipomastectomia').prop("hidden", false);
            $('#fechatipomastectomia').prop("hidden", false);
            $('#ganglionartipo').prop("selectedIndex", 0);
            $('#fechatipoganglio').prop("selectedIndex", 0);
            $('#fechatipomastecto').val('');
            $('#fechatipoganglio').val('');
            $('#reconstruccion').prop("hidden", false);
            $('#reconstruccionsino').prop("selectedIndex", 0);
            $('#tiporeconstruccion').prop("hidden", false);
            $('#reconstrucciontipo').prop("selectedIndex", 0);
            $('#reconstrucciontipofecha').prop("hidden", false);
            $('#fechatiporeconstruccion').val('');
        } else {
            $('#tipomastectomia').prop("hidden", true);
            $('#fechatipomastectomia').prop("hidden", true);
            $('#fechatipomastecto').val('');
            $('#fechatipoganglio').val('');
            $('#reconstruccion').prop("hidden", true);
            $('#reconstruccionsino').prop("selectedIndex", 0);
            $('#tiporeconstruccion').prop("hidden", true);
            $('#reconstrucciontipo').prop("selectedIndex", 0);
            $('#reconstrucciontipofecha').prop("hidden", true);
            $('#fechatiporeconstruccion').val('');
        
        }
        if ($(this).val() === "Ganglionar") {

            $('#tipoganglionar').prop("hidden", false);
            $('#fechatipoganglionar').prop("hidden", false);
            $('#mastectomiatipo').prop("selectedIndex", 0);
            $('#fechatipomastecto').prop("selectedIndex", 0);
            $('#fechatipoganglio').val('');
            $('#fechatipomastecto').val('');
            $('#reconstruccion').prop("hidden", true);
            $('#reconstruccionsino').prop("selectedIndex", 0);
            $('#tiporeconstruccion').prop("hidden", true);
            $('#tiporeconstruccion').prop("hidden", true);
            $('#reconstrucciontipo').prop("selectedIndex", 0);
            $('#reconstrucciontipofecha').prop("hidden", true);
            $('#fechatiporeconstruccion').val('');
        } else {
            $('#tipoganglionar').prop("hidden", true);
            $('#fechatipoganglionar').prop("hidden", true);
            $('#fechatipoganglio').val('');
            $('#fechatipomastecto').val('');
        
        }
    })
});

$(function() {
    $('#tipomastectomia').prop("hidden", true);
    $('#tipoganglionar').prop("hidden", true);
    $('#fechatipomastectomia').prop("hidden", true);
    $('#fechatipoganglionar').prop("hidden", true);
    $('#fechatipoganglio').val('');
    $('#fechatipomastecto').val('');


})
/*termina mastectomia ganglionar*/
/*tipo reconstruccion*/
$(document).ready(function() {

    $('#reconstruccionsino').change(function(e) {
        if ($(this).val() === "Si") {

            $('#tiporeconstruccion').prop("hidden", false);
            $('#reconstrucciontipofecha').prop("hidden", false);
            $('#reconstrucciontipo').prop("selectedIndex", 0);
        } else {
            $('#tiporeconstruccion').prop("hidden", true);
            $('#reconstrucciontipofecha').prop("hidden", true);
            $('#reconstrucciontipo').prop("selectedIndex", 0);
            $('#fechatiporeconstruccion').val('');
        
        }
    
    })
});

$(function() {
    $('#tiporeconstruccion').prop("hidden", true);
    $('#reconstrucciontipofecha').prop("hidden", true);
    $('#reconstrucciontipo').prop("selectedIndex", 0);
    $('#fechatiporeconstruccion').val('');


})
/*termina tipo reconstruccion*/

/*inicia aplicacion quimioterapia*/
$(document).ready(function() {

    $('#aplicoquimio').change(function(e) {
        if ($(this).val() === "Si") {

            $('#fechainicioquimio').prop("hidden", false);
            $('#atracicilassi').prop("hidden", false);
            $('#quimiomomento').prop("hidden", false);
            $('#quimiono').prop("hidden", false);
            $('#quimiono2').prop("hidden", false);
            $('#quimiono3').prop("hidden", false);
            $('#quimiono4').prop("hidden", false);
            $('#quimiono5').prop("hidden", false);

            $('#her2').prop("checked", true);
            $('#triplenegativo2').prop("checked", true);
            $('#hormonosensibles2').prop("checked", true);
            $('#quimiono4').prop("checked", true);
            $('#completoquimio1').prop("checked", true);

            $('#primerlineaqt').prop("hidden", false);
            $('#ciclosprimerlinea').prop("hidden", false);
            $('#segundalineaqt').prop("hidden", false);
            $('#ciclossegundalinea').prop("hidden", false);
        } else {
            $('#fechainicioquimio').prop("hidden", true);
            $('#atracicilassi').prop("hidden", true);
            $('#quimiomomento').prop("hidden", true);
            $('#fechadeinicioquimio').val('');
            $('#antraciclinas').prop("selectedIndex", 0);
            $('#momentoquimio').prop("selectedIndex", 0);
            $("input[type=radio][name=her]").prop('checked', false);
            $("input[type=radio][name=triplenegativo]").prop('checked', false);
            $("input[type=radio][name=hormonosensibles]").prop('checked', false);
            $('#fechaeventoadverso').val('');
            $('#quimioesquema').prop("selectedIndex", 0);
            $("input[type=radio][name=completoquimio]").prop('checked', false);
            $('#esquemaquimio').prop("hidden", true);
            $('#esquemaher').prop("hidden", true);
            $('#esquemaherdos').prop("selectedIndex", 0);
            $('#tripleesquema').prop("hidden", true);
            $('#esquematriple').prop("selectedIndex", 0);
            $('#hormonoesquema').prop("hidden", true);
            $('#esquemahormonosensible').prop("selectedIndex", 0);
            $('#eventoadverso').prop("hidden", true);
            $('#quimiono').prop("hidden", true);
            $('#quimiono2').prop("hidden", true);
            $('#quimiono3').prop("hidden", true);
            $('#quimiono4').prop("hidden", true);
            $('#quimiono5').prop("hidden", true);
            $('#esquemahormosensible').prop("selectedIndex", 0);
            $('#eventoprogresivo').prop("hidden", true);
            $('#fechaprogresion').val('');
            $('#eventorecurrencia').prop("hidden", true);
            $('#eventodefuncion').prop("hidden", true);
            $('#causaonco').prop("hidden", true);
            $('#especausa').prop("hidden", true);
            $('#fechadefuncion').val('');
            $('#otracausa').prop("selectedIndex", 0);
            $('#especifiquecausa').val('');

            $('#primerlineaqt').prop("hidden", true);
            $('#ciclosprimerlinea').prop("hidden", true);
            $('#segundalineaqt').prop("hidden", true);
            $('#ciclossegundalinea').prop("hidden", true);

            $('#primerlinea').prop("selectedIndex", 0);
            $('#segundalinea').prop("selectedIndex", 0);
            $('#ciclosprimerlineaqt').val('');
            $('#ciclossegundalineaqt').val('');








        
        }
    
    })
});

$(function() {
    $('#fechainicioquimio').prop("hidden", true);
    $('#atracicilassi').prop("hidden", true);
    $('#quimiomomento').prop("hidden", true);
    $('#fechainicioquimio').prop("selectedIndex", 0);
    $('#atracicilassi').prop("selectedIndex", 0);
    $('#quimiomomento').prop("selectedIndex", 0);
    $('#primerlineaqt').prop("hidden", true);
    $('#ciclosprimerlinea').prop("hidden", true);
    $('#segundalineaqt').prop("hidden", true);
    $('#ciclossegundalinea').prop("hidden", true);
    $('#primerlinea').prop("selectedIndex", 0);
    $('#segundalinea').prop("selectedIndex", 0);
    $('#ciclosprimerlineaqt').val('');
    $('#ciclossegundalineaqt').val('');


})
/*finaliza quimio*/

/*incia onco her*/
function aplicoher(){
        if ($("#her1").val() === "si") {

            $('#esquemaher').prop("hidden", false);
        
        }
    
    }
    function aplicoherno(){
        if ($("#her2").val() === "noaplico") {

            $('#esquemaher').prop("hidden", true);
            $('#esquemaherdos').prop("selectedIndex", 0);
        }
    
    }

$(function() {
        $('#esquemaher').prop("hidden", true);
        $('#esquemaherdos').prop("selectedIndex", 0);


})
/*finaliza onco her*/

/*incia triple si*/
function triplesi(){
    if ($("#triplenegativo1").val() === "si") {

        $('#tripleesquema').prop("hidden", false);
        
    }

}
function tripleno(){
    if ($("#triplenegativo2").val() === "no") {

        $('#tripleesquema').prop("hidden", true);
        $('#esquematriple').prop("selectedIndex", 0);
    }

}

$(function() {
    $('#tripleesquema').prop("hidden", true);
    $('#esquematriple').prop("selectedIndex", 0);


})
/*finaliza triples si*/

/*inicia hormonosensibles*/
function hormonosi(){
    if ($("#hormonosensibles1").val() === "si") {

        $('#hormonoesquema').prop("hidden", false);
        
    }

}
function hormonono(){
    if ($("#hormonosensibles2").val() === "no") {

        $('#hormonoesquema').prop("hidden", true);
        $('#esquemahormonosensible').prop("selectedIndex", 0);
    }

}

$(function() {
    $('#hormonoesquema').prop("hidden", true);
    $('#esquemahormonosensible').prop("selectedIndex", 0);


})
/*finaliza hormonosensibles*/

/*inicia quimio completa si/no*/
function quimiocompletosi(){
    if ($("#completoquimio1").val() === "si") {

        $('#esquemaquimio').prop("hidden", true);
        $('#eventoadverso').prop("hidden", true);
        $('#eventoprogresivo').prop("hidden", true);
        $('#eventorecurrencia').prop("hidden", true);
        $('#eventodefuncion').prop("hidden", true);
        $('#causaonco').prop("hidden", true);
        $('#especausa').prop("hidden", true);
        $('#quimioesquema').prop("selectedIndex", 0);
        $('#otracausa').prop("selectedIndex", 0);
    
    }

}
function quimiocompletono(){
    if ($("#completoquimio2").val() === "no") {

        $('#esquemaquimio').prop("hidden", false);
        
        
    }

}

$(function() {
    $('#esquemaquimio').prop("hidden", true);
    $('#eventoadverso').prop("hidden", true);
    $('#eventoprogresivo').prop("hidden", true);
    $('#eventorecurrencia').prop("hidden", true);
    $('#eventodefuncion').prop("hidden", true);
    $('#causaonco').prop("hidden", true);
    $('#especausa').prop("hidden", true);
    $('#otracausa').prop("selectedIndex", 0);
    $('#quimioesquema').prop("selectedIndex", 0);


})

$(document).ready(function() {

    $('#quimioesquema').change(function(e) {
        if ($(this).val() === "EVENTO ADVERSO") {

            $('#eventoadverso').prop("hidden", false);

        } else {
            $('#eventoadverso').prop("hidden", true);
            $('#fechaeventoadverso').val('');
        
        }
        if ($(this).val() === "PROGRESION DE LA ENFERMEDAD") {

            $('#eventoprogresivo').prop("hidden", false);

        } else {
            $('#eventoprogresivo').prop("hidden", true);
            $('#fechaprogresion').val();
        
        }
        if ($(this).val() === "RECURRENCIA DE LA ENFERMEDAD") {

            $('#eventorecurrencia').prop("hidden", false);

        } else {
            $('#eventorecurrencia').prop("hidden", true);
            $('#fecharecurrencia').val();
        
        }
        if ($(this).val() === "ABANDONO DEL PACIENTE") {
            $('#eventoadverso').prop("hidden", true);
            $('#eventorecurrencia').prop("hidden", true);
            $('#eventoprogresivo').prop("hidden", true);
        } else {
            $('#fechaeventoadverso').prop("selectedIndex", 0);
            $('#fechaprogresion').val('');
            $('#fecharecurrencia').val('');
        
        }
        if ($(this).val() === "FALLECIO") {

            $('#eventodefuncion').prop("hidden", false);
            $('#causaonco').prop("hidden", false);


        } else {
            $('#eventodefuncion').prop("hidden", true);
            $('#causaonco').prop("hidden", true);

            $('#fechadefuncion').val('');
            $('#otracausa').val('');
        
        }
    
    })
});


/*finiliza quimio completa*/

/*incia radio terapia*/
$(document).ready(function(){
    $("#radioterapia").change(function(e) {
    if ($(this).val() === "Si") {

        $('#seaplicoradio').prop("hidden", false);
        $('#fechadelaradio').prop("hidden", false);
        $('#sesionescantidad').prop("hidden", false);
    
    }else{
        $('#seaplicoradio').prop("hidden", true);
        $('#fechadelaradio').prop("hidden", true);
        $('#sesionescantidad').prop("hidden", true);
        $('#aplicoradioterapia').prop("selectedIndex", 0);
        $('#fechainicioradio').val('');
        $('#numerosesiones').val('');
    }

    })
});

$(function() {
    $('#seaplicoradio').prop("hidden", true);
    $('#fechadelaradio').prop("hidden", true);
    $('#sesionescantidad').prop("hidden", true);
    $('#aplicoradioterapia').prop("selectedIndex", 0);
    $('#fechainicioradio').val('');
    $('#numerosesiones').val('');


})
/*finaliza radio*/
/*inicia braquiterapia*/
$(document).ready(function(){
    $("#braquiterapia").change(function(e) {
    if ($(this).val() === "Si") {

        $('#fechabraquiterapia').prop("hidden", false);

    }else{
        $('#fechabraquiterapia').prop("hidden", true);
        $('#fechadebraquiterapia').val('');
    }

    })
});

$(function() {
    $('#fechabraquiterapia').prop("hidden", true);
    $('#fechadebraquiterapia').val('');


})
/*finaliza braquiterapia*/

/*inicia pdl*/
function aplicopdlsi(){
    if ($("#pdlrealizo1").val() === "si") {

        $('#pdl').prop("disabled", false);
        
    }

}
function aplicopdlno(){
    if ($("#pdlrealizo2").val() === "no") {

        $('#pdl').prop("disabled", true);
        
    }

}
function aplicopdlsirgd() {
    if ($("#pdlrealizo1rgd").val() === "si") {

        $('#pdlrgd').prop("disabled", false);

    }

}
function aplicopdlnorgd() {
    if ($("#pdlrealizo2rgd").val() === "no") {

        $('#pdlrgd').prop("disabled", true);

    }

}
function aplicopdlsirgiz() {
    if ($("#pdlrealizo1izrgi").val() === "si") {

        $('#pdlizrgi').prop("disabled", false);

    }

}
function aplicopdlnorgiz() {
    if ($("#pdlrealizo2izrgi").val() === "no") {

        $('#pdlizrgi').prop("disabled", true);

    }

}
function aplicopdlsimmiz() {
    if ($("#pdlrealizo1iz").val() === "si") {

        $('#pdliz').prop("disabled", false);

    }

}
function aplicopdlnommiz() {
    if ($("#pdlrealizo2iz").val() === "no") {

        $('#pdliz').prop("disabled", true);

    }

}
function defusi() {
    if ($("#defunsionsi").val() === "si") {

        $('#defuncionfecha').prop("hidden", false);
        $('#defuncioncausa').prop("hidden", false);

    }

}
function defuno() {
    if ($("#defunsionno").val() === "no") {

        $('#defuncionfecha').prop("hidden", true);
        $('#defuncioncausa').prop("hidden", true);
        $('#causadefuncion').prop("selectedIndex", 0);
        $('#fechadeladefuncion').val('');
    }

}

$(function() {
    $('#pdl').prop("disabled", true);
    $('#pdliz').prop("disabled", true);
    $('#defuncionfecha').prop("hidden", true);
    $('#defuncioncausa').prop("hidden", true);
    $('#causadefuncion').prop("selectedIndex", 0);
    $('#fechadeladefuncion').val('');
    $('#pdlizrgi').prop("disabled", true);

})

/*finaliza pdl*/
/*lactancia*/
$(document).ready(function(){
    $("#lactancia").change(function(e) {
    if ($(this).val() === "No") {

        $('#tiempolactancia').prop("disabled", true);

    
    }else{
        $('#tiempolactancia').prop("disabled", false);
    }

    })
});

$(function() {
    $('#tiempolactancia').prop("disabled", true);
    $('#antecedentesfamiliares').prop("hidden", true);


})
$(document).ready(function () {
    $("#tipodecancer").change(function (e) {
        if ($(this).val() == "Cancer de ovario") {

            $('#familiarescancer').prop("hidden", false);
        } else if ($(this).val() == "Cancer de mama") {

            $('#familiarescancer').prop("hidden", false);
            $('#COv').prop("disabled", true);
        }
        else if (tipodecancer.options[1].selected == false) {

            $('#familiarescancer').prop("hidden", true);
        } else if (tipodecancer.options[1].selected == true) {

            $('#familiarescancer').prop("hidden", false);
        }

    })
});

$(document).ready(function () {
    $("#tipodecancer").change(function (e) {

        if (tipodecancer.options[0].selected == true) {
            //alert('Esta opción no está disponible');
            tipodecancer.options[1].selected == true;
            $('#familiarescancer').prop("hidden", true);


        }

    })
});

$(document).ready(function () {
    $("#metastasis").change(function (e) {

        if (metastasis.options[3].selected == true) {
            //alert('Esta opción no está disponible');
            //tipodecancer.options[1].selected == true;
            $('#metastasissitio').prop("hidden", false);


        } else if (metastasis.options[0].selected == true || metastasis.options[1].selected == true || metastasis.options[2].selected == true) {
            $('#metastasissitio').prop("hidden", true);
            $("#sitiometastasis2 option").prop("selected", false);



        }

    })
});

$(document).ready(function () {
    $("#otracausa").change(function (e) {

        if (otracausa.options[3].selected == true) {
            //alert('Esta opción no está disponible');
            //tipodecancer.options[1].selected == true;
            $('#especausa').prop("hidden", false);


        } else if (otracausa.options[0].selected == true || otracausa.options[1].selected == true || otracausa.options[2].selected == true) {
            $('#especausa').prop("hidden", true);
            $('#especifiquecausa').val('');
        }

    })
});

$(document).ready(function () {
    $("#mastectomiaextrainstitucional").change(function (e) {

        if (mastectomiaextrainstitucional.options[1].selected == true) {
            //alert('Esta opción no está disponible');
            //tipodecancer.options[1].selected == true;
            $('#mstectoextra1').prop("hidden", false);
            $('#mstectoextra2').prop("hidden", false);


        } else if (mastectomiaextrainstitucional.options[2].selected == true) {
            $('#mstectoextra1').prop("hidden", true);
            $('#mstectoextra2').prop("hidden", true);
            $('#lateralidadextrainstitucional').prop("selectedIndex", 0);
            $('#fechamastectoextra').val('0000/00/00')
        } else if (mastectomiaextrainstitucional.options[0].selected == true) {
            $('#mstectoextra1').prop("hidden", true);
            $('#mstectoextra2').prop("hidden", true);
            $('#lateralidadextrainstitucional').prop("selectedIndex", 0);
            $('#fechamastectoextra').val('0000/00/00')
        }

    })
});
$(document).ready(function () {
    $("#mamaseleccion").change(function (e) {

        if (mamaseleccion.options[0].selected == true) {

            $('#dxhisto').prop("hidden", false);
            $('#fechadx').prop("hidden", false);
            $('#nothin').prop("hidden", false);
            $('#escala').prop("hidden", false);
            $('#titulomamaderecha').prop("hidden", false);
        } else if (mamaseleccion.options[0].selected == false) {
            $('#dxhisto').prop("hidden", true);
            $('#fechadx').prop("hidden", true);
            $('#nothin').prop("hidden", true);
            $('#escala').prop("hidden", true);
            $('#titulomamaderecha').prop("hidden", true);
            $('#dxhistopatologico').prop('selectedIndex', 0);
            $('#fechadxhistopatologico').val('0000/00/00');
            $('#nottingham').prop('selectedIndex', 0);
            $('#escalasbr').prop('selectedIndex', 0);

        }

    })
});
$(document).ready(function () {
    $("#mamaseleccion").change(function (e) {

        if (mamaseleccion.options[1].selected == true) {

            $('#dxhistorgd').prop("hidden", false);
            $('#fechadxrgd').prop("hidden", false);
            $('#nothinrgd').prop("hidden", false);
            $('#escalargd').prop("hidden", false);
            $('#titulomamaderechargd').prop("hidden", false);
        } else if (mamaseleccion.options[1].selected == false) {
            $('#dxhistorgd').prop("hidden", true);
            $('#fechadxrgd').prop("hidden", true);
            $('#nothinrgd').prop("hidden", true);
            $('#escalargd').prop("hidden", true);
            $('#titulomamaderechargd').prop("hidden", true);
            $('#dxhistopatologicorgd').prop('selectedIndex', 0);
            $('#fechadxhistopatologicorgd').val('0000/00/00');
            $('#nottinghamrgd').prop('selectedIndex', 0);
            $('#escalasbrrgd').prop('selectedIndex', 0);

        }

    })
});

$(document).ready(function () {
    $("#mamaseleccion").change(function (e) {

        if (mamaseleccion.options[2].selected == true) {

            $('#dxhistoiz').prop("hidden", false);
            $('#fechadxiz').prop("hidden", false);
            $('#nothiniz').prop("hidden", false);
            $('#escalaiz').prop("hidden", false);
            $('#titulomamaizquierda').prop("hidden", false);
        } else if (mamaseleccion.options[2].selected == false) {
            $('#dxhistoiz').prop("hidden", true);
            $('#fechadxiz').prop("hidden", true);
            $('#nothiniz').prop("hidden", true);
            $('#escalaiz').prop("hidden", true);
            $('#titulomamaizquierda').prop("hidden", true);
            $('#dxhistopatologicoiz').prop('selectedIndex', 0);
            $('#fechadxhistopatologicoiz').val('0000/00/00');
            $('#nottinghamiz').prop('selectedIndex', 0);
            $('#escalasbriz').prop('selectedIndex', 0);


        }

    })
});
$(document).ready(function () {
    $("#mamaseleccion").change(function (e) {

        if (mamaseleccion.options[3].selected == true) {

            $('#dxhistorgi').prop("hidden", false);
            $('#fechadxrgi').prop("hidden", false);
            $('#nothinrgi').prop("hidden", false);
            $('#escalargi').prop("hidden", false);
            $('#titulomamaderechargi').prop("hidden", false);
        } else if (mamaseleccion.options[3].selected == false) {
            $('#dxhistorgi').prop("hidden", true);
            $('#fechadxrgi').prop("hidden", true);
            $('#nothinrgi').prop("hidden", true);
            $('#escalargi').prop("hidden", true);
            $('#titulomamaderechargi').prop("hidden", true);
            $('#dxhistopatologicorgi').prop('selectedIndex', 0);
            $('#fechadxhistopatologicorgi').val('0000/00/00');
            $('#nottinghamrgi').prop('selectedIndex', 0);
            $('#escalasbrrgi').prop('selectedIndex', 0);

        }

    })
});
/*mama inmuno*/
$(document).ready(function () {
    $("#mamaseleccioninmuno").change(function (e) {

        if (mamaseleccioninmuno.options[0].selected == true) {

            $('#inmunoderecha1').prop("hidden", false);
            $('#inmunoderecha2').prop("hidden", false);
            $('#inmunoderecha3').prop("hidden", false);
            $('#inmunoderecha4').prop("hidden", false);
            $('#inmunoderecha5').prop("hidden", false);
            $('#inmunoderecha6').prop("hidden", false);
            $('#inmunoderecha7').prop("hidden", false);
            $('#inmunoderecha8').prop("hidden", false);
            $('#inmunoderecha9').prop("hidden", false);
            $('#inmunoderecha10').prop("hidden", false);
            $('#tituloinmunomamaderecha').prop("hidden", false);
        } else if (mamaseleccion.options[0].selected == false) {
            $('#inmunoderecha1').prop("hidden", true);
            $('#inmunoderecha2').prop("hidden", true);
            $('#inmunoderecha3').prop("hidden", true);
            $('#inmunoderecha4').prop("hidden", true);
            $('#inmunoderecha5').prop("hidden", true);
            $('#inmunoderecha6').prop("hidden", true);
            $('#inmunoderecha7').prop("hidden", true);
            $('#inmunoderecha8').prop("hidden", true);
            $('#inmunoderecha9').prop("hidden", true);
            $('#inmunoderecha10').prop("hidden", true);
            $('#tituloinmunomamaderecha').prop("hidden", true);

            $('#receptoresestrogenos').val('');
            $('#receptoresprogesterona').val('');
            $('#ki67').val('');
            $('#k').val('');
            $('#p53').prop('selectedIndex', 0);
            $('#triplenegativo').prop('selectedIndex', 0);
            $('#pdl').val('');
            $('#oncogen').prop('selectedIndex', 0);
            $('#fish').prop('selectedIndex', 0);
            $('#fish').prop('disabled', true);


        }

    })
});
$(document).ready(function () {
    $("#mamaseleccioninmuno").change(function (e) {

        if (mamaseleccioninmuno.options[1].selected == true) {

            $('#inmunoderecha1rgd').prop("hidden", false);
            $('#inmunoderecha2rgd').prop("hidden", false);
            $('#inmunoderecha3rgd').prop("hidden", false);
            $('#inmunoderecha4rgd').prop("hidden", false);
            $('#inmunoderecha5rgd').prop("hidden", false);
            $('#inmunoderecha6rgd').prop("hidden", false);
            $('#inmunoderecha7rgd').prop("hidden", false);
            $('#inmunoderecha8rgd').prop("hidden", false);
            $('#inmunoderecha9rgd').prop("hidden", false);
            $('#inmunoderecha10rgd').prop("hidden", false);
            $('#tituloinmunomamaderechargd').prop("hidden", false);
        } else if (mamaseleccion.options[1].selected == false) {
            $('#inmunoderecha1rgd').prop("hidden", true);
            $('#inmunoderecha2rgd').prop("hidden", true);
            $('#inmunoderecha3rgd').prop("hidden", true);
            $('#inmunoderecha4rgd').prop("hidden", true);
            $('#inmunoderecha5rgd').prop("hidden", true);
            $('#inmunoderecha6rgd').prop("hidden", true);
            $('#inmunoderecha7rgd').prop("hidden", true);
            $('#inmunoderecha8rgd').prop("hidden", true);
            $('#inmunoderecha9rgd').prop("hidden", true);
            $('#inmunoderecha10rgd').prop("hidden", true);
            $('#tituloinmunomamaderechargd').prop("hidden", true);

            $('#receptoresestrogenosrgd').val('');
            $('#receptoresprogesteronargd').val('');
            $('#ki67rgd').val('');
            $('#krgd').val('');
            $('#p53rgd').prop('selectedIndex', 0);
            $('#triplenegativorgd').prop('selectedIndex', 0);
            $('#pdlrgd').val('');
            $('#oncogenrgd').prop('selectedIndex', 0);
            $('#fishrgd').prop('selectedIndex', 0);
            $('#fishrgd').prop('disabled', true);


        }

    })
});

$(document).ready(function () {
    $("#mamaseleccioninmuno").change(function (e) {

        if (mamaseleccioninmuno.options[2].selected == true) {

            $('#inmunoderechaiz1').prop("hidden", false);
            $('#inmunoderechaiz2').prop("hidden", false);
            $('#inmunoderechaiz3').prop("hidden", false);
            $('#inmunoderechaiz4').prop("hidden", false);
            $('#inmunoderechaiz5').prop("hidden", false);
            $('#inmunoderechaiz6').prop("hidden", false);
            $('#inmunoderechaiz7').prop("hidden", false);
            $('#inmunoderechaiz8').prop("hidden", false);
            $('#inmunoderechaiz9').prop("hidden", false);
            $('#inmunoderechaiz10').prop("hidden", false);
            $('#tituloinmunomamaizquierda').prop("hidden", false);
        } else if (mamaseleccion.options[2].selected == false) {
            $('#inmunoderechaiz1').prop("hidden", true);
            $('#inmunoderechaiz2').prop("hidden", true);
            $('#inmunoderechaiz3').prop("hidden", true);
            $('#inmunoderechaiz4').prop("hidden", true);
            $('#inmunoderechaiz5').prop("hidden", true);
            $('#inmunoderechaiz6').prop("hidden", true);
            $('#inmunoderechaiz7').prop("hidden", true);
            $('#inmunoderechaiz8').prop("hidden", true);
            $('#inmunoderechaiz9').prop("hidden", true);
            $('#inmunoderechaiz10').prop("hidden", true);
            $('#tituloinmunomamaizquierda').prop("hidden", true);

            $('#receptoresestrogenosiz').val('');
            $('#receptoresprogesteronaiz').val('');
            $('#ki67iz').val('');
            $('#kiz').val('');
            $('#p53iz').prop('selectedIndex', 0);
            $('#triplenegativoiz').prop('selectedIndex', 0);
            $('#pdliz').val('');
            $('#oncogeniz').prop('selectedIndex', 0);
            $('#fishiz').prop('selectedIndex', 0);
            $('#fishiz').prop('disabled', true);


        }

    })
});
$(document).ready(function () {
    $("#mamaseleccioninmuno").change(function (e) {

        if (mamaseleccioninmuno.options[3].selected == true) {

            $('#inmunoderechaiz1rgi').prop("hidden", false);
            $('#inmunoderechaiz2rgi').prop("hidden", false);
            $('#inmunoderechaiz3rgi').prop("hidden", false);
            $('#inmunoderechaiz4rgi').prop("hidden", false);
            $('#inmunoderechaiz5rgi').prop("hidden", false);
            $('#inmunoderechaiz6rgi').prop("hidden", false);
            $('#inmunoderechaiz7rgi').prop("hidden", false);
            $('#inmunoderechaiz8rgi').prop("hidden", false);
            $('#inmunoderechaiz9rgi').prop("hidden", false);
            $('#inmunoderechaiz10rgi').prop("hidden", false);
            $('#tituloinmunomamaizquierdargi').prop("hidden", false);
        } else if (mamaseleccion.options[3].selected == false) {
            $('#inmunoderechaiz1rgi').prop("hidden", true);
            $('#inmunoderechaiz2rgi').prop("hidden", true);
            $('#inmunoderechaiz3rgi').prop("hidden", true);
            $('#inmunoderechaiz4rgi').prop("hidden", true);
            $('#inmunoderechaiz5rgi').prop("hidden", true);
            $('#inmunoderechaiz6rgi').prop("hidden", true);
            $('#inmunoderechaiz7rgi').prop("hidden", true);
            $('#inmunoderechaiz8rgi').prop("hidden", true);
            $('#inmunoderechaiz9rgi').prop("hidden", true);
            $('#inmunoderechaiz10rgi').prop("hidden", true);
            $('#tituloinmunomamaizquierdargi').prop("hidden", true);

            $('#receptoresestrogenosizrgi').val('');
            $('#receptoresprogesteronaizrgi').val('');
            $('#ki67izrgi').val('');
            $('#kizrgi').val('');
            $('#p53izrgi').prop('selectedIndex', 0);
            $('#triplenegativoizrgi').prop('selectedIndex', 0);
            $('#pdlizrgi').val('');
            $('#oncogenizrgi').prop('selectedIndex', 0);
            $('#fishizrgi').prop('selectedIndex', 0);
            $('#fishizrgi').prop('disabled', true);


        }

    })
});
/*finaliza mama inmuno*/
/*inicia mama molecular*/
$(document).ready(function () {
    $("#mamaseleccionmolecular").change(function (e) {

        if (mamaseleccionmolecular.options[0].selected == true) {

            $('#luminal1').prop('hidden', false);
            $('#luminal2').prop('hidden', false);
            $('#luminal3').prop('hidden', false);
            $('#luminal4').prop('hidden', false);
            $('#titulomolecularmamaderecha').prop("hidden", false);
        } else if (mamaseleccionmolecular.options[0].selected == false) {
            $('#luminal1').prop('hidden', true);
            $('#luminal2').prop('hidden', true);
            $('#luminal3').prop('hidden', true);
            $('#luminal4').prop('hidden', true);
            $('#titulomolecularmamaderecha').prop("hidden", true);
            $('#luminala').val('');
            $('#luminalb').val('');
            $('#enriquecidoherdos').val('');
            $('#basal').val('');


        }

    })
});
$(document).ready(function () {
    $("#mamaseleccionmolecular").change(function (e) {

        if (mamaseleccionmolecular.options[1].selected == true) {

            $('#luminal1mmrgd').prop('hidden', false);
            $('#luminal2mmrgd').prop('hidden', false);
            $('#luminal3mmrgd').prop('hidden', false);
            $('#luminal4mmrgd').prop('hidden', false);
            $('#titulomolecularmamaderechammrgd').prop("hidden", false);
        } else if (mamaseleccionmolecular.options[1].selected == false) {
            $('#luminal1mmrgd').prop('hidden', true);
            $('#luminal2mmrgd').prop('hidden', true);
            $('#luminal3mmrgd').prop('hidden', true);
            $('#luminal4mmrgd').prop('hidden', true);
            $('#titulomolecularmamaderechammrgd').prop("hidden", true);
            $('#luminalammrgd').val('');
            $('#luminalbmmrgd').val('');
            $('#enriquecidoherdosmmrgd').val('');
            $('#basalmmrgd').val('');


        }

    })
});
$(document).ready(function () {
    $("#mamaseleccionmolecular").change(function (e) {

        if (mamaseleccionmolecular.options[2].selected == true) {

            $('#luminal5').prop('hidden', false);
            $('#luminal6').prop('hidden', false);
            $('#luminal7').prop('hidden', false);
            $('#luminal8').prop('hidden', false);
            $('#titulomolecularmamaizquierda').prop("hidden", false);
        } else if (mamaseleccionmolecular.options[2].selected == false) {
            $('#luminal5').prop('hidden', true);
            $('#luminal6').prop('hidden', true);
            $('#luminal7').prop('hidden', true);
            $('#luminal8').prop('hidden', true);
            $('#titulomolecularmamaizquierda').prop("hidden", true);
            $('#luminalaiz').val('');
            $('#luminalbiz').val('');
            $('#enriquecidoherdosiz').val('');
            $('#basaliz').val('');


        }

    })
});
$(document).ready(function () {
    $("#mamaseleccionmolecular").change(function (e) {

        if (mamaseleccionmolecular.options[3].selected == true) {

            $('#luminal5mmrgi').prop('hidden', false);
            $('#luminal6mmrgi').prop('hidden', false);
            $('#luminal7mmrgi').prop('hidden', false);
            $('#luminal8mmrgi').prop('hidden', false);
            $('#titulomolecularmamaizquierdammrgi').prop("hidden", false);
        } else if (mamaseleccionmolecular.options[2].selected == false) {
            $('#luminal5mmrgi').prop('hidden', true);
            $('#luminal6mmrgi').prop('hidden', true);
            $('#luminal7mmrgi').prop('hidden', true);
            $('#luminal8mmrgi').prop('hidden', true);
            $('#titulomolecularmamaizquierdammrgi').prop("hidden", true);
            $('#luminalaizmmrgi').val('');
            $('#luminalbizmmrgi').val('');
            $('#enriquecidoherdosizmmrgi').val('');
            $('#basalizmmrgi').val('');


        }

    })
});

/*finaliza lactancia*/
/*cuidados paliativos*/
$(document).ready(function() {

    $('#cuidadospaliativos').change(function(e) {
        if ($(this).val() === "Si") {

            $('#paliativaclinica').prop("hidden", false);
        } else {
            $('#paliativaclinica').prop("hidden", true);
            $('#clinicapaliativa').prop("selectedIndex", 0);

        }

    })
});
$(document).ready(function () {

    $('#embarazada').change(function (e) {
        if ($(this).val() === "Si") {

            $('#probableparto').prop("hidden", false);
        } else {
            $('#probableparto').prop("hidden", true);
            $('#fechaprobableparto').val('0000/00/00');
        
        }
    
    })
});



$(function() {
    $('#paliativaclinica').prop("hidden", true);
    $('#clinicapaliativa').prop("selectedIndex", 0);
    $('#quimiono').prop("hidden", true);
    $('#quimiono2').prop("hidden", true);
    $('#quimiono3').prop("hidden", true);
    $('#quimiono4').prop("hidden", true);
    $('#quimiono5').prop("hidden", true);
    $('#familiarescancer').prop("hidden", true);
    $('#probableparto').prop("hidden", true);
    $('#fechaprobableparto').val('0000/00/00');
    $('#dxhisto').prop("hidden", true);
    $('#fechadx').prop("hidden", true);
    $('#nothin').prop("hidden", true);
    $('#escala').prop("hidden", true);

    $('#dxhistoiz').prop("hidden", true);
    $('#fechadxiz').prop("hidden", true);
    $('#nothiniz').prop("hidden", true);
    $('#escalaiz').prop("hidden", true);

    $('#dxhistoambas').prop("hidden", true);
    $('#fechadxambas').prop("hidden", true);
    $('#nothinambas').prop("hidden", true);
    $('#escalaambas').prop("hidden", true);

    $('#mstectoextra1').prop("hidden", true);
    $('#mstectoextra2').prop("hidden", true);

    $('#lateralidadextrainstitucional').prop("selectedIndex", 0);
    $('#fechamastectoextra').val('0000/00/00');

    $('#especausa').prop("hidden", true);
    $('#metastasissitio').prop("hidden", true);
    $('#titulomamaizquierda').prop("hidden", true);
    $('#titulomamaderecha').prop("hidden", true);

    $('#tituloinmunomamaderecha').prop("hidden", true);
    $('#tituloinmunomamaizquierda').prop("hidden", true);
    $('#inmunoderecha1').prop("hidden", true);
    $('#inmunoderecha2').prop("hidden", true);
    $('#inmunoderecha3').prop("hidden", true);
    $('#inmunoderecha4').prop("hidden", true);
    $('#inmunoderecha5').prop("hidden", true);
    $('#inmunoderecha6').prop("hidden", true);
    $('#inmunoderecha7').prop("hidden", true);
    $('#inmunoderecha8').prop("hidden", true);
    $('#inmunoderecha9').prop("hidden", true);
    $('#inmunoderecha10').prop("hidden", true);

    $('#inmunoderechaiz1').prop("hidden", true);
    $('#inmunoderechaiz2').prop("hidden", true);
    $('#inmunoderechaiz3').prop("hidden", true);
    $('#inmunoderechaiz4').prop("hidden", true);
    $('#inmunoderechaiz5').prop("hidden", true);
    $('#inmunoderechaiz6').prop("hidden", true);
    $('#inmunoderechaiz7').prop("hidden", true);
    $('#inmunoderechaiz8').prop("hidden", true);
    $('#inmunoderechaiz9').prop("hidden", true);
    $('#inmunoderechaiz10').prop("hidden", true);

    $('#receptoresestrogenos').val('');
    $('#receptoresprogesterona').val('');
    $('#ki67').val('');
    $('#k').val('');
    $('#p53').prop('selectedIndex', 0);
    $('#triplenegativo').prop('selectedIndex', 0);
    $('#pdl').val('');
    $('#oncogen').prop('selectedIndex', 0);
    $('#fish').prop('selectedIndex', 0);
    $('#fish').prop('disabled', true);

    $('#receptoresestrogenosiz').val('');
    $('#receptoresprogesteronaiz').val('');
    $('#ki67iz').val('');
    $('#kiz').val('');
    $('#p53iz').prop('selectedIndex', 0);
    $('#triplenegativoiz').prop('selectedIndex', 0);
    $('#pdliz').val('');
    $('#oncogeniz').prop('selectedIndex', 0);
    $('#fishiz').prop('selectedIndex', 0);
    $('#fishiz').prop('disabled', true);

    $('#luminal1').prop('hidden', true);
    $('#luminal2').prop('hidden', true);
    $('#luminal3').prop('hidden', true);
    $('#luminal4').prop('hidden', true);
    $('#titulomolecularmamaderecha').prop("hidden", true);

    $('#luminal5').prop('hidden', true);
    $('#luminal6').prop('hidden', true);
    $('#luminal7').prop('hidden', true);
    $('#luminal8').prop('hidden', true);
    $('#titulomolecularmamaizquierda').prop("hidden", true);

    $('#dxhistorgd').prop("hidden", true);
    $('#fechadxrgd').prop("hidden", true);
    $('#nothinrgd').prop("hidden", true);
    $('#escalargd').prop("hidden", true);
    $('#titulomamaderechargd').prop("hidden", true);
    $('#dxhistopatologicorgd').prop('selectedIndex', 0);
    $('#fechadxhistopatologicorgd').val('0000/00/00');
    $('#nottinghamrgd').prop('selectedIndex', 0);
    $('#escalasbrrgd').prop('selectedIndex', 0);

    $('#dxhistorgi').prop("hidden", true);
    $('#fechadxrgi').prop("hidden", true);
    $('#nothinrgi').prop("hidden", true);
    $('#escalargi').prop("hidden", true);
    $('#titulomamaderechargi').prop("hidden", true);
    $('#dxhistopatologicorgi').prop('selectedIndex', 0);
    $('#fechadxhistopatologicorgi').val('0000/00/00');
    $('#nottinghamrgi').prop('selectedIndex', 0);
    $('#escalasbrrgi').prop('selectedIndex', 0);

    $('#inmunoderecha1rgd').prop("hidden", true);
    $('#inmunoderecha2rgd').prop("hidden", true);
    $('#inmunoderecha3rgd').prop("hidden", true);
    $('#inmunoderecha4rgd').prop("hidden", true);
    $('#inmunoderecha5rgd').prop("hidden", true);
    $('#inmunoderecha6rgd').prop("hidden", true);
    $('#inmunoderecha7rgd').prop("hidden", true);
    $('#inmunoderecha8rgd').prop("hidden", true);
    $('#inmunoderecha9rgd').prop("hidden", true);
    $('#inmunoderecha10rgd').prop("hidden", true);
    $('#tituloinmunomamaderechargd').prop("hidden", true);

    $('#receptoresestrogenosrgd').val('');
    $('#receptoresprogesteronargd').val('');
    $('#ki67rgd').val('');
    $('#krgd').val('');
    $('#p53rgd').prop('selectedIndex', 0);
    $('#triplenegativorgd').prop('selectedIndex', 0);
    $('#pdlrgd').val('');
    $('#oncogenrgd').prop('selectedIndex', 0);
    $('#fishrgd').prop('selectedIndex', 0);
    $('#fishrgd').prop('disabled', true);

    $('#inmunoderechaiz1rgi').prop("hidden", true);
    $('#inmunoderechaiz2rgi').prop("hidden", true);
    $('#inmunoderechaiz3rgi').prop("hidden", true);
    $('#inmunoderechaiz4rgi').prop("hidden", true);
    $('#inmunoderechaiz5rgi').prop("hidden", true);
    $('#inmunoderechaiz6rgi').prop("hidden", true);
    $('#inmunoderechaiz7rgi').prop("hidden", true);
    $('#inmunoderechaiz8rgi').prop("hidden", true);
    $('#inmunoderechaiz9rgi').prop("hidden", true);
    $('#inmunoderechaiz10rgi').prop("hidden", true);
    $('#tituloinmunomamaizquierdargi').prop("hidden", true);

    $('#receptoresestrogenosizrgi').val('');
    $('#receptoresprogesteronaizrgi').val('');
    $('#ki67izrgi').val('');
    $('#kizrgi').val('');
    $('#p53izrgi').prop('selectedIndex', 0);
    $('#triplenegativoizrgi').prop('selectedIndex', 0);
    $('#pdlizrgi').val('');
    $('#oncogenizrgi').prop('selectedIndex', 0);
    $('#fishizrgi').prop('selectedIndex', 0);
    $('#fishizrgi').prop('disabled', true);

    $('#luminal1mmrgd').prop('hidden', true);
    $('#luminal2mmrgd').prop('hidden', true);
    $('#luminal3mmrgd').prop('hidden', true);
    $('#luminal4mmrgd').prop('hidden', true);
    $('#titulomolecularmamaderechammrgd').prop("hidden", true);
    $('#luminalammrgd').val('');
    $('#luminalbmmrgd').val('');
    $('#enriquecidoherdosmmrgd').val('');
    $('#basalmmrgd').val('');

    $('#luminal5mmrgi').prop('hidden', true);
    $('#luminal6mmrgi').prop('hidden', true);
    $('#luminal7mmrgi').prop('hidden', true);
    $('#luminal8mmrgi').prop('hidden', true);
    $('#titulomolecularmamaizquierdammrgi').prop("hidden", true);
    $('#luminalaizmmrgi').val('');
    $('#luminalbizmmrgi').val('');
    $('#enriquecidoherdosizmmrgi').val('');
    $('#basalizmmrgi').val('');



})
/*
$(document).ready(function () {

    $('#triplenegativo').change(function (e) {
        if (triplenegativo.options[0].selected == true) {

            $('#inmunoderecha7').prop("hidden", true);
            $('#inmunoderecha8').prop("hidden", true);
        } else if (triplenegativo.options[1].selected == true) {
            $('#inmunoderecha7').prop("hidden", false);
            $('#inmunoderecha8').prop("hidden", false);
            $("#pdlrealizo1").prop("checked", true);
            $("#pdl").prop("disabled", false);

        } else if (triplenegativo.options[2].selected == true) {
            $('#inmunoderecha7').prop("hidden", true);
            $('#inmunoderecha8').prop("hidden", true);
            $("#pdl").val('');
            $("#pdlrealizo2").prop("checked", true);
        }

    })

});
*/