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

    setTimeout('document.formularioinfarto.reset()', 1000);
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

    $('#mscomplicacion').change(function(e) {

        
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


//Select multiple de MACE HOSPITALARIO
$(document).ready(function() {
    $('#msmacehospitalario').change(function(e) {  
    }).multipleSelect({
        width: '100%'
    });
});


//Select multiple de MACE HOSPITALARIO
$(document).ready(function() {
    $('#mslesionescoronarias').change(function(e) {  
    }).multipleSelect({
        width: '100%'
    });
});

// Habilita Complicaciones de SCHOCKWAVE C2
$(document).ready(function() {
    $('#shockwavedato').change(function(e) {
        if ($(this).val() === "Si") {
            $('#resultadoshock').prop("hidden", false);
        } else if ($(this).val() === "No") {
            $('#resultadoshock').prop("hidden", true);
        }
    })
});
$(function() {
    $('#resultadoshock').prop("hidden", true);
})




// Habilita PROTESIS ENDOVASCULAR
$(document).ready(function() {
    $('#protesisendovascular').change(function(e) {
        if ($(this).val() === "Con Medicacion") {
            $('#idprimerageneracion').prop("hidden", false);
            $('#idsegundageneracion').prop("hidden", false);
        } else if ($(this).val() === "No") {
            $('#idprimerageneracion').prop("hidden", true);
            $('#idsegundageneracion').prop("hidden", true);
        }
    })
});
$(function() {
    $('#idprimerageneracion').prop("hidden", true);
    $('#idsegundageneracion').prop("hidden", true);
})


// Habilita AIRBUS
$(document).ready(function() {
    $('#airbus').change(function(e) {
        if ($(this).val() === "Si") {
            $('#resultadoirbus').prop("hidden", false);
        } else if ($(this).val() === "No") {
            $('#resultadoirbus').prop("hidden", true);
        }
    })
});
$(function() {
    $('#resultadoirbus').prop("hidden", true);
})





// Habilita GAMAGRAMA EN seguimiento
$(document).ready(function() {
    $('#idgamagrama').change(function(e) {
        if ($(this).val() === "Si") {
            $('#gamagra').prop("hidden", false);
        } else if ($(this).val() === "No") {
            $('#gamagra').prop("hidden", true);
             $('#localizaciongamagrama').prop("hidden", true);
        }
    })
});
$(function() {
    $('#gamagra').prop("hidden", true);
    $('#localizaciongamagrama').prop("hidden", true);
})

// Habilita la LOCALIZACIÓN GAMAGRAMA en seguimiento
$(document).ready(function() {
    $('#gamagrama').change(function(e) {
        if ($(this).val() === "Positivo") {
            $('#localizaciongamagrama').prop("hidden", false);
        } else if ($(this).val() === "Negativo") {
            $('#localizaciongamagrama').prop("hidden", true);
        }
    })
});
$(function() {
    $('#localizaciongamagrama').prop("hidden", true);
})


// Habilita PATRÓN PET en seguimiento
$(document).ready(function() {
    $('#idpet').change(function(e) {
        if ($(this).val() === "Si") {
            $('#patron').prop("hidden", false);
        } else if ($(this).val() === "No") {
            $('#patron').prop("hidden", true);
            $('#idmatch').prop("hidden", true);
            $('#idmismatch').prop("hidden", true);
        }
    })
});
$(function() {
    $('#patron').prop("hidden", true);
    $('#idmatch').prop("hidden", true);
    $('#idmismatch').prop("hidden", true);
})

// Habilita Segmento Match en seguimiento
$(document).ready(function() {
    $('#pet').change(function(e) {
        if ($(this).val() === "Patron Match") {
            $('#idmatch').prop("hidden", false);
        } else if ($(this).val() === "Patron Mismatch") {
            $('#idmatch').prop("hidden", true);
        }
    })
});
$(function() {
    $('#idmatch').prop("hidden", true);
})


// Habilita Segmento Mismatch en seguimiento
$(document).ready(function() {
    $('#pet').change(function(e) {
        if ($(this).val() === "Patron Mismatch") {
            $('#idmismatch').prop("hidden", false);
        } else if ($(this).val() === "Patron Match") {
            $('#idmismatch').prop("hidden", true);
        }
    })
});
$(function() {
    $('#idmismatch').prop("hidden", true);
})






// Habilita Bloqueo AV
$(document).ready(function() {
    $('#arritmiadetalle').change(function(e) {
        if ($(this).val() === "Bloqueo AV") {
            $('#bloqueo').prop("hidden", false);
        } else if ($(this).val() === "Extrasistoles Ventriculares") {
            $('#bloqueo').prop("hidden", true);

        }
        
    })
});
$(function() {
    $('#bloqueo').prop("hidden", true);

})

// Habilita Extrasístoles Ventriculares
$(document).ready(function() {
    $('#arritmiadetalle').change(function(e) {
        if ($(this).val() === "Extrasistoles Ventriculares") {
            $('#ventricularesextra').prop("hidden", false);
        } else if ($(this).val() === "Bloqueo AV") {
            $('#ventricularesextra').prop("hidden", true);

        }
    })
});
$(function() {
    $('#ventricularesextra').prop("hidden", true);

})



// Habilita DEFUNCION en SEGUIMIENTO
$(document).ready(function() {
    $('#defuncion').change(function(e) {
        if ($(this).val() === "Si") {
            $('#causadefuncion').prop("hidden", false);
        } else if ($(this).val() === "No") {
            $('#causadefuncion').prop("hidden", true);

        }
    })
});
$(function() {
    $('#causadefuncion').prop("hidden", true);

})
