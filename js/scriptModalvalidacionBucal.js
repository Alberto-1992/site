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
    if (anyo < 1920) anyo += 100;
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
    calcularEdadbucal();
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
    $('#msmaxisiiz').change(function(e) { 
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


// SITIO METÁSTASIS
$(document).ready(function() {
    $('#mssitiometastasis').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});

// Tipo de Reconstrucción
$(document).ready(function() {
    $('#tiporeconstruccion').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});



// OARS Dosis
$(document).ready(function() {
    $('#msoarsdosis').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});


// COMPLICACIONES RT
$(document).ready(function() {
    $('#mscomplicacionesrt').change(function(e) { 
    }).multipleSelect({
        width: '100%'
    });
});

$(document).ready(function() {
    $('#tiporeconstruccion').change(function(e) { 
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
/*defuncion si no */
    $('#defuncionfecha').prop('hidden', true);
    $('#defuncioncausa').prop('hidden', true);
/*finaliza defuncion si no */
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
    /* afectaciones dentales */
    $('#titulolesionesorales').prop('hidden', true);
    $('#lesionoral').prop('hidden', true);
    $('#tejidotipo').prop('hidden', true);
    $('#tipolesion').prop('hidden', true);
    $('#coloracion').prop('hidden', true);
    /*ubicaciones orales */
    $('#tituloubicacion').prop('hidden', true);
    $('#ubicacion').prop('hidden', true);

    /*alcoholiso frencuencia */
    $('#alcoholismofrecuencia').prop('hidden', true);   
    /*ubicacion derecha*/
    $('#tituloubicacionderecha').prop('hidden', true);
    $('#subanatomico').prop('hidden', true);
    $('#labiospanel').prop('hidden', true);
    $('#lenguapanel').prop('hidden', true);
    $('#paladarblandopanel').prop('hidden', true);
    $('#enciapanel').prop('hidden', true);
    $('#relacionpanel').prop('hidden', true);
    $('#maxisd').prop('hidden', true);
    $('#maxiid').prop('hidden', true);
    /*ubicacion izquierda*/
    $('#tituloubicacionizquierda').prop('hidden', true);
    $('#subanatomicoiz').prop('hidden', true);
    $('#labiospaneliz').prop('hidden', true);
    $('#lenguapaneliz').prop('hidden', true);
    $('#paladarblandopaneliz').prop('hidden', true);
    $('#enciapaneliz').prop('hidden', true);
    $('#relacionpaneliz').prop('hidden', true);
    $('#maxisdiz').prop('hidden', true);
    $('#maxiidiz').prop('hidden', true);

   
    $('#dosis1').prop('hidden', true);
    $('#promedio1').prop('hidden', true);
    $('#dosis2').prop('hidden', true);
    $('#promedio2').prop('hidden', true);
    $('#dosis3').prop('hidden', true);
    $('#promedio3').prop('hidden', true);
    $('#dosis4').prop('hidden', true);
    $('#promedio4').prop('hidden', true);
    $('#dosis5').prop('hidden', true);
    $('#promedio5').prop('hidden', true);
    $('#dosis6').prop('hidden', true);
    $('#promedio6').prop('hidden', true);
    $('#dosis7').prop('hidden', true);
    $('#promedio7').prop('hidden', true);
    $('#dosis8').prop('hidden', true);
    $('#promedio8').prop('hidden', true);
    $('#dosis9').prop('hidden', true);
    $('#promedio9').prop('hidden', true);
    $('#dosis10').prop('hidden', true);
    $('#promedio10').prop('hidden', true);
    $('#dosis11').prop('hidden', true);
    $('#promedio11').prop('hidden', true);
    $('#dosis12').prop('hidden', true);
    $('#promedio12').prop('hidden', true);
    $('#dosis13').prop('hidden', true);
    $('#promedio13').prop('hidden', true);
    $('#dosis14').prop('hidden', true);
    $('#promedio14').prop('hidden', true);
    $('#dosis15').prop('hidden', true);
    $('#promedio15').prop('hidden', true);
    

});
$(document).ready(function () {
    $("#msoarsdosis").change(function (e) {
        if (msoarsdosis.options[0].selected == true) {
            $('#dosis1').prop("hidden", false);
            $('#promedio1').prop("hidden", false);
        } else if (msoarsdosis.options[0].selected == false) {
            $('#dosis1').prop("hidden", true);
            $('#promedio1').prop("hidden", true);
            $('#cavidadoral1').val('');
            $('#cavidadoral2').val('');
        }
        if (msoarsdosis.options[1].selected == true) {
            $('#dosis2').prop("hidden", false);
            $('#promedio2').prop("hidden", false);
        } else if (msoarsdosis.options[1].selected == false) {
            $('#dosis2').prop("hidden", true);
            $('#promedio2').prop("hidden", true);
            $('#cocleas1').val('');
            $('#cocleas2').val('');
        }
        if (msoarsdosis.options[2].selected == true) {
            $('#dosis3').prop("hidden", false);
            $('#promedio3').prop("hidden", false);
        } else if (msoarsdosis.options[2].selected == false) {
            $('#dosis3').prop("hidden", true);
            $('#promedio3').prop("hidden", true);
            $('#cristalinos1').val('');
            $('#cristalinos2').val('');
        }
        if (msoarsdosis.options[3].selected == true) {
            $('#dosis4').prop("hidden", false);
            $('#promedio4').prop("hidden", false);
        } else if (msoarsdosis.options[3].selected == false) {
            $('#dosis4').prop("hidden", true);
            $('#promedio4').prop("hidden", true);
            $('#esofago1').val('');
            $('#esofago2').val('');
        }
        if (msoarsdosis.options[4].selected == true) {
            $('#dosis5').prop("hidden", false);
            $('#promedio5').prop("hidden", false);
        } else if (msoarsdosis.options[4].selected == false) {
            $('#dosis5').prop("hidden", true);
            $('#promedio5').prop("hidden", true);
            $('#labios1').val('');
            $('#labios2').val('');
        }
        if (msoarsdosis.options[5].selected == true) {
            $('#dosis6').prop("hidden", false);
            $('#promedio6').prop("hidden", false);
        } else if (msoarsdosis.options[5].selected == false) {
            $('#dosis6').prop("hidden", true);
            $('#promedio6').prop("hidden", true);
            $('#laringe1').val('');
            $('#laringe2').val('');
        }
        if (msoarsdosis.options[6].selected == true) {
            $('#dosis7').prop("hidden", false);
            $('#promedio7').prop("hidden", false);
        } else if (msoarsdosis.options[6].selected == false) {
            $('#dosis7').prop("hidden", true);
            $('#promedio7').prop("hidden", true);
            $('#mandibula1').val('');
            $('#mandibula2').val('');
        }
        if (msoarsdosis.options[7].selected == true) {
            $('#dosis8').prop("hidden", false);
            $('#promedio8').prop("hidden", false);
        } else if (msoarsdosis.options[7].selected == false) {
            $('#dosis8').prop("hidden", true);
            $('#promedio8').prop("hidden", true);
            $('#medula1').val('');
            $('#medula2').val('');
        }
        if (msoarsdosis.options[8].selected == true) {
            $('#dosis9').prop("hidden", false);
            $('#promedio9').prop("hidden", false);
        } else if (msoarsdosis.options[8].selected == false) {
            $('#dosis9').prop("hidden", true);
            $('#promedio9').prop("hidden", true);
            $('#nerviooptico1').val('');
            $('#nerviooptico2').val('');
        }
        if (msoarsdosis.options[9].selected == true) {
            $('#dosis10').prop("hidden", false);
            $('#promedio10').prop("hidden", false);
        } else if (msoarsdosis.options[9].selected == false) {
            $('#dosis10').prop("hidden", true);
            $('#promedio10').prop("hidden", true);
            $('#ojos1').val('');
            $('#ojos2').val('');
        }
        if (msoarsdosis.options[10].selected == true) {
            $('#dosis11').prop("hidden", false);
            $('#promedio11').prop("hidden", false);
        } else if (msoarsdosis.options[10].selected == false) {
            $('#dosis11').prop("hidden", true);
            $('#promedio11').prop("hidden", true);
            $('#pfp1').val('');
            $('#pfp2').val('');
        }
        if (msoarsdosis.options[11].selected == true) {
            $('#dosis12').prop("hidden", false);
            $('#promedio12').prop("hidden", false);
        } else if (msoarsdosis.options[11].selected == false) {
            $('#dosis12').prop("hidden", true);
            $('#promedio12').prop("hidden", true);
            $('#Parotidas1').val('');
            $('#Parotidas2').val('');
        }
        if (msoarsdosis.options[12].selected == true) {
            $('#dosis13').prop("hidden", false);
            $('#promedio13').prop("hidden", false);
        } else if (msoarsdosis.options[12].selected == false) {
            $('#dosis13').prop("hidden", true);
            $('#promedio13').prop("hidden", true);
            $('#Sublinguales1').val('');
            $('#Sublinguales2').val('');
        }
        if (msoarsdosis.options[13].selected == true) {
            $('#dosis14').prop("hidden", false);
            $('#promedio14').prop("hidden", false);
        } else if (msoarsdosis.options[13].selected == false) {
            $('#dosis14').prop("hidden", true);
            $('#promedio14').prop("hidden", true);
            $('#Tallo1').val('');
            $('#Tallo2').val('');
        }
        if (msoarsdosis.options[14].selected == true) {
            $('#dosis15').prop("hidden", false);
            $('#promedio15').prop("hidden", false);
        } else if (msoarsdosis.options[14].selected == false) {
            $('#dosis15').prop("hidden", true);
            $('#promedio15').prop("hidden", true);
            $('#Tiroides1').val('');
            $('#Tiroides2').val('');
        }
    })
});
function defusi() {
    $('#defuncionfecha').prop('hidden', false);
    $('#defuncioncausa').prop('hidden', false);
};
function defuno() {
    $('#defuncionfecha').prop('hidden', true);
    $('#defuncioncausa').prop('hidden', true);
    $('#fechadeladefuncion').val('');
    $('#causadefuncion').prop('selectedIndex', 0);
};
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
    $("#msodf").change(function (e) {
        if (msodf.options[1].selected == true) {
            $('#maxilarsd').prop('hidden',false);
            $('#maxilarid').prop('hidden',false);
            $('#maxilarsd2').prop('hidden',false);
            $('#maxilarid2').prop('hidden',false);
        }else if(msodf.options[1].selected == false) {
            $('#maxilarsd').prop('hidden',true);
            $('#maxilarid').prop('hidden',true);
            $('#maxilarsd2').prop('hidden',true);
            $('#maxilarid2').prop('hidden',true);
        }
    })
});
/*afectaciones orales */
$(document).ready(function () {
    $("#msao").change(function (e) {
        if (msao.options[0].selected == true) {
            $('#afectaciondental').prop('#hidden',false);
            $('#tituloafectaciondental').prop('hidden',false);
            $('#tipodeodf').prop('hidden',false);
            
        }else if (msao.options[0].selected == false) {
            $('#afectaciondental').prop('#hidden',true);
            $('#tituloafectaciondental').prop('hidden',true);
            $('#tipodeodf').prop('hidden',true);
            $('#maxilarsd').prop('hidden',true);
            $('#maxilarid').prop('hidden',true);
            $('#maxilarsd2').prop('hidden',true);
            $('#maxilarid2').prop('hidden',true);

            $('#tituloubicacionderecha').prop('hidden', true);
            $('#subanatomico').prop('hidden', true);
            $('#labiospanel').prop('hidden', true);
            $('#lenguapanel').prop('hidden', true);
            $('#paladarblandopanel').prop('hidden', true);
            $('#enciapanel').prop('hidden', true);
            $('#relacionpanel').prop('hidden', true);
            $('#maxisd').prop('hidden', true);
            $('#maxiid').prop('hidden', true);

            $('#msqueva').prop('selectedIndex', 0);
            $('#labios').prop('selectedIndex', 0);
            $('#lengua').prop('selectedIndex', 0);
            $('#paladarblando').prop('selectedIndex', 0);
            $('#encia').prop('selectedIndex', 0);
            $('#relacion').prop('selectedIndex', 0);
            $('#msmaxisd').prop('selectedIndex', 0);
            $('#msmaxiid').prop('selectedIndex', 0);
            
            $('#tituloubicacionizquierda').prop('hidden', true);
            $('#subanatomicoiz').prop('hidden', true);
            $('#labiospaneliz').prop('hidden', true);
            $('#lenguapaneliz').prop('hidden', true);
            $('#paladarblandopaneliz').prop('hidden', true);
            $('#enciapaneliz').prop('hidden', true);
            $('#relacionpaneliz').prop('hidden', true);
            $('#maxisdiz').prop('hidden', true);
            $('#maxiidiz').prop('hidden', true);

            $('#msqueva2').prop('selectedIndex', 0);
            $('#labiosiz').prop('selectedIndex', 0);
            $('#lenguaiz').prop('selectedIndex', 0);
            $('#paladarblandoiz').prop('selectedIndex', 0);
            $('#enciaiz').prop('selectedIndex', 0);
            $('#relacioniz').prop('selectedIndex', 0);
            $('#msmaxisiiz').prop('selectedIndex', 0);
            $('#msmaxiiz').prop('selectedIndex', 0);


        }
    })
});
/*finaliza afectaciones orales */
/*inicia lesiones orales */

$(document).ready(function () {
    $("#msubicacion").change(function (e) {
        if (msubicacion.options[0].selected == true) {
            $('#tituloubicacionderecha').prop('hidden', false);
            $('#subanatomico').prop('hidden', false);
            $('#labiospanel').prop('hidden', false);
            $('#lenguapanel').prop('hidden', false);
            $('#paladarblandopanel').prop('hidden', false);
            $('#enciapanel').prop('hidden', false);
            $('#relacionpanel').prop('hidden', false);
            $('#maxisd').prop('hidden', false);
            $('#maxiid').prop('hidden', false);
    }else if (msubicacion.options[0].selected == false) {
            $('#tituloubicacionderecha').prop('hidden', true);
            $('#subanatomico').prop('hidden', true);
            $('#labiospanel').prop('hidden', true);
            $('#lenguapanel').prop('hidden', true);
            $('#paladarblandopanel').prop('hidden', true);
            $('#enciapanel').prop('hidden', true);
            $('#relacionpanel').prop('hidden', true);
            $('#maxisd').prop('hidden', true);
            $('#maxiid').prop('hidden', true);

            $('#msqueva').prop('selectedIndex', 0);
            $('#labios').prop('selectedIndex', 0);
            $('#lengua').prop('selectedIndex', 0);
            $('#paladarblando').prop('selectedIndex', 0);
            $('#encia').prop('selectedIndex', 0);
            $('#relacion').prop('selectedIndex', 0);
            $('#msmaxisd').prop('selectedIndex', 0);
            $('#msmaxiid').prop('selectedIndex', 0);
        }
    })
});
$(document).ready(function () {
    $("#msubicacion").change(function (e) {
        if (msubicacion.options[1].selected == true) {
            $('#tituloubicacionizquierda').prop('hidden', false);
            $('#subanatomicoiz').prop('hidden', false);
            $('#labiospaneliz').prop('hidden', false);
            $('#lenguapaneliz').prop('hidden', false);
            $('#paladarblandopaneliz').prop('hidden', false);
            $('#enciapaneliz').prop('hidden', false);
            $('#relacionpaneliz').prop('hidden', false);
            $('#maxisdiz').prop('hidden', false);
            $('#maxiidiz').prop('hidden', false);
    }else if (msubicacion.options[1].selected == false) {
            $('#tituloubicacionizquierda').prop('hidden', true);
            $('#subanatomicoiz').prop('hidden', true);
            $('#labiospaneliz').prop('hidden', true);
            $('#lenguapaneliz').prop('hidden', true);
            $('#paladarblandopaneliz').prop('hidden', true);
            $('#enciapaneliz').prop('hidden', true);
            $('#relacionpaneliz').prop('hidden', true);
            $('#maxisdiz').prop('hidden', true);
            $('#maxiidiz').prop('hidden', true);

            $('#msqueva2').prop('selectedIndex', 0);
            $('#labiosiz').prop('selectedIndex', 0);
            $('#lenguaiz').prop('selectedIndex', 0);
            $('#paladarblandoiz').prop('selectedIndex', 0);
            $('#enciaiz').prop('selectedIndex', 0);
            $('#relacioniz').prop('selectedIndex', 0);
            $('#msmaxisiiz').prop('selectedIndex', 0);
            $('#msmaxiiz').prop('selectedIndex', 0);
        }
    })
});
$(document).ready(function () {
    $("#msao").change(function (e) {
        if (msao.options[1].selected == true) {
        $('#titulolesionesorales').prop('hidden', false);
        $('#lesionoral').prop('hidden', false);
        $('#tejidotipo').prop('hidden', false);
        $('#tipolesion').prop('hidden', false);
        $('#coloracion').prop('hidden', false);
    }else if (msao.options[1].selected == false) {
        $('#titulolesionesorales').prop('hidden', true);
        $('#lesionoral').prop('hidden', true);
        $('#tejidotipo').prop('hidden', true);
        $('#tipolesion').prop('hidden', true);
        $('#coloracion').prop('hidden', true);
        }
    })
});
$(document).ready(function () {
    $("#msao").change(function (e) {
        if (msao.options[2].selected == true) {
            $('#tituloubicacion').prop('hidden', false);
            $('#ubicacion').prop('hidden', false);
    }else if (msao.options[2].selected == false) {
        $('#tituloubicacion').prop('hidden', true);
        $('#ubicacion').prop('hidden', true);
        }
    })
});
/*finaliza lesiones orale */
$(document).ready(function () {
    $("#mstoxicomanias").change(function (e) {
        if (mstoxicomanias.options[0].selected == true) {

            $('#alcoholismofrecuencia').prop("hidden", false);
        } else if (mstoxicomanias.options[0].selected == false) {
            $('#alcoholismofrecuencia').prop("hidden", true);
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




// Habilita Tipo de Tejido:
$(document).ready(function() {
    $('#lesionoral').change(function(e) {
        if ($(this).val() === "Si") {
            $('#idtipotejido').prop("hidden", false);
        } else if ($(this).val() === "No") {
            $('#idtipotejido').prop("hidden", true);
        }
    })
});
$(function() {
    $('#idtipotejido').prop("hidden", true);
})



// Habilita QUIRURGICO:
$(document).ready(function() {
    $('#quirurgico').change(function(e) {
        if ($(this).val() === "Si") {
            $('#idtipoquirurgico').prop("hidden", false);
            
        } else if ($(this).val() === "No") {
            $('#idtipoquirurgico').prop("hidden", true);
            $('#tipoquirurgico').prop('selectedIndex',0);
            $('#idmaxinfra').prop('hidden', true); 
            $('#idlugar').prop('hidden', true);
            $('#idtipo').prop('hidden', true);
            $('#idnivelcervical').prop('hidden', true);

            $('#maxinfraestructu').prop('selectedIndex', 0);
            $('#lugardrmc').prop('selectedIndex', 0);
            $('#tipodrmc').prop('selectedIndex', 0);
            $('#nivelcervical').prop('selectedIndex', 0);
        }
    })
});
$(function() {
    $('#idtipoquirurgico').prop("hidden", true);

})



// Habilita Maxilectomia de Infraestructura:
$(document).ready(function() {
    $('#tipoquirurgico').change(function(e) {
        if (tipoquirurgico.options[8].selected == true) {
            $('#idmaxinfra').prop("hidden", false);
        } else if (tipoquirurgico.options[8].selected == false) {
            $('#idmaxinfra').prop("hidden", true);
            $('#maxinfraestructu').prop('selectedIndex', 0);
        }
    })
});
$(function() {
    $('#idmaxinfra').prop("hidden", true);
})

// Habilita DISECCIÓN RADICAL MODIFICADA:
$(document).ready(function() {
    $('#tipoquirurgico').change(function(e) {
        if (tipoquirurgico.options[3].selected == true) {
            $('#idlugar').prop("hidden", false);
            $('#idtipo').prop("hidden", false);
            $('#idnivelcervical').prop("hidden", false);
        } else if (tipoquirurgico.options[3].selected == false) {
            $('#idlugar').prop("hidden", true);
            $('#idtipo').prop("hidden", true);
            $('#idnivelcervical').prop("hidden", true);

            $('#lugardrmc').prop('selectedIndex', 0);
            $('#tipodrmc').prop('selectedIndex', 0);
            $('#nivelcervical').prop('selectedIndex', 0);
        }
        
    })
});
$(function() {
    $('#idlugar').prop("hidden", true);
    $('#idtipo').prop("hidden", true);
    $('#idnivelcervical').prop("hidden", true);
})

// Habilita PDL
$(document).ready(function() {
    $('#pdl').change(function(e) {
        if ($(this).val() === "Si") {
            $('#idpdl').prop("hidden", false);
        } else if ($(this).val() === "No") {
            $('#idpdl').prop("hidden", true);
        }
    })
});
$(function() {
    $('#idpdl').prop("hidden", true);
})

// Habilita INICIO, RECONSTRUCCIÓN:
$(document).ready(function() {
    $('#reconstruccion').change(function(e) {
        if ($(this).val() === "Si") {
            $('#idtiporeconstruccion').prop("hidden", false);
        } else if ($(this).val() === "No") {
            $('#idtiporeconstruccion').prop("hidden", true);
            $('#tiporeconstruccion').prop('selectedIndex',0); 
        }
    })
});
$(function() {
    $('#idtiporeconstruccion').prop("hidden", true);
})


// Habilita las opciones de RADIOTERAPIA en el modal de carga
$(document).ready(function() {
    $('#radio').change(function(e) {
        if ($(this).val() === "Si") {
            $('#idfecharadio').prop("hidden", false);
            $('#idmomentort').prop("hidden", false);
            $('#iddosisradio').prop("hidden", false);
            $('#idfracciones').prop("hidden", false);
            $('#idnofracciones').prop("hidden", false);
            $('#idtecnica').prop("hidden", false);
            $('#idcomplicaciones').prop("hidden", false);


        } else if ($(this).val() === "No") {
            $('#idfecharadio').prop("hidden", true);
            $('#idmomentort').prop("hidden", true);
            $('#iddosisradio').prop("hidden", true);
            $('#idfracciones').prop("hidden", true);
            $('#idnofracciones').prop("hidden", true);
            $('#idtecnica').prop("hidden", true);
            $('#idcomplicaciones').prop("hidden", true);
            $('#fecharadio').val('');
            $('#momentort').prop('selectedIndex',0);
            $('#dosis').val('');
            $('#fracciones').val('');
            $('#numfracciones').val('');
            $('#tecnica').prop('selectedIndex', 0);

        }
    })
});
$(function() {
    $('#idfecharadio').prop("hidden", true);
    $('#idmomentort').prop("hidden", true);
    $('#iddosisradio').prop("hidden", true);
    $('#idfracciones').prop("hidden", true);
    $('#idnofracciones').prop("hidden", true);
    $('#idtecnica').prop("hidden", true);
    $('#idcomplicaciones').prop("hidden", true);

})




// Habilita  DEFUNCION:
$(document).ready(function() {
    $('#defuncion').change(function(e) {
        if ($(this).val() === "Si") {
            $('#defuncionfecha').prop("hidden", false);
            $('#defuncioncausa').prop("hidden", false);
        } else if ($(this).val() === "No") {
            $('#defuncionfecha').prop("hidden", true);
            $('#defuncioncausa').prop("hidden", true);
        }
    })
});
$(function() {
    $('#defuncionfecha').prop("hidden", true);
    $('#defuncioncausa').prop("hidden", true);
    $('#idtxcomplicaciones').prop("hidden", true);//caries
    $('#idtxcomplicacionesdisguesia').prop("hidden", true);
    $('#idtxcomplicacionesdolor').prop("hidden", true);
    $('#idtxcomplicacionesfractura').prop("hidden", true);
    $('#idtxcomplicacionesinfeccion').prop("hidden", true);
    $('#idtxcomplicacionesdisguesiahemorragia').prop("hidden", true);
    $('#idtxcomplicacionesmucositis').prop("hidden", true);
    $('#idtxcomplicacionesosteonecrosis').prop("hidden", true);
    $('#idtxcomplicacionesParestesia').prop("hidden", true);
    $('#idtxcomplicacionesalocal').prop("hidden", true);
    $('#idtxcomplicacionesradiodermitis').prop("hidden", true);
    $('#idtxcomplicacionesalergia').prop("hidden", true);
    $('#idtxcomplicacionetrismus').prop("hidden", true);
    $('#idtxcomplicacionesxerostomia').prop("hidden", true);
    
   

})
$(document).ready(function () {
    $("#mscomplicaciones").change(function (e) {
        if(mscomplicaciones.options[0].selected == true) {
            $('#idtxcomplicaciones').prop("hidden", false);
        

        }else if(mscomplicaciones.options[0].selected == false) {
            $('#idtxcomplicaciones').prop("hidden", true);

        }
        if(mscomplicaciones.options[1].selected == true) {
            $('#idtxcomplicacionesdisguesia').prop("hidden", false);
        

        }else if(mscomplicaciones.options[1].selected == false) {
             $('#idtxcomplicacionesdisguesia').prop("hidden", true);

        }
         if(mscomplicaciones.options[2].selected == true) {
            $('#idtxcomplicacionesdolor').prop("hidden", false);
        

        }else if(mscomplicaciones.options[2].selected == false) {
            $('#idtxcomplicacionesdolor').prop("hidden", true);

        }
        if(mscomplicaciones.options[3].selected == true) {
           $('#idtxcomplicacionesfractura').prop("hidden", false);
        }else if(mscomplicaciones.options[3].selected == false) {
           $('#idtxcomplicacionesfractura').prop("hidden", true);
        }

        //AQUI
        if(mscomplicaciones.options[4].selected == true) {
           $('#idtxcomplicacionesinfeccion').prop("hidden", false);
        }else if(mscomplicaciones.options[4].selected == false) {
           $('#idtxcomplicacionesinfeccion').prop("hidden", true);
        }

        //AQUI
        if(mscomplicaciones.options[5].selected == true) {
           $('#idtxcomplicacionesdisguesiahemorragia').prop("hidden", false);
        }else if(mscomplicaciones.options[5].selected == false) {
           $('#idtxcomplicacionesdisguesiahemorragia').prop("hidden", true);
        }

        //AQUI
        if(mscomplicaciones.options[6].selected == true) {
           $('#idtxcomplicacionesmucositis').prop("hidden", false);
        }else if(mscomplicaciones.options[6].selected == false) {
           $('#idtxcomplicacionesmucositis').prop("hidden", true);
        }

        //AQUI
        if(mscomplicaciones.options[7].selected == true) {
           $('#idtxcomplicacionesosteonecrosis').prop("hidden", false);
        }else if(mscomplicaciones.options[7].selected == false) {
           $('#idtxcomplicacionesosteonecrosis').prop("hidden", true);
        }

        //AQUI
        if(mscomplicaciones.options[8].selected == true) {
           $('#idtxcomplicacionesParestesia').prop("hidden", false);
        }else if(mscomplicaciones.options[8].selected == false) {
           $('#idtxcomplicacionesParestesia').prop("hidden", true);
        }

        //AQUI
        if(mscomplicaciones.options[9].selected == true) {
           $('#idtxcomplicacionesalocal').prop("hidden", false);
        }else if(mscomplicaciones.options[9].selected == false) {
           $('#idtxcomplicacionesalocal').prop("hidden", true);
        }

        //AQUI
        if(mscomplicaciones.options[10].selected == true) {
           $('#idtxcomplicacionesradiodermitis').prop("hidden", false);
        }else if(mscomplicaciones.options[10].selected == false) {
           $('#idtxcomplicacionesradiodermitis').prop("hidden", true);
        }

        //AQUI
        if(mscomplicaciones.options[11].selected == true) {
           $('#idtxcomplicacionesalergia').prop("hidden", false);
        }else if(mscomplicaciones.options[11].selected == false) {
           $('#idtxcomplicacionesalergia').prop("hidden", true);
        }

        //AQUI
        if(mscomplicaciones.options[12].selected == true) {
           $('#idtxcomplicacionetrismus').prop("hidden", false);
        }else if(mscomplicaciones.options[12].selected == false) {
           $('#idtxcomplicacionetrismus').prop("hidden", true);
        }

        //AQUI
        if(mscomplicaciones.options[13].selected == true) {
           $('#idtxcomplicacionesxerostomia').prop("hidden", false);
        }else if(mscomplicaciones.options[13].selected == false) {
           $('#idtxcomplicacionesxerostomia').prop("hidden", true);
        }

    })
});
