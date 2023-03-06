<div id="seguimientoArtritis" class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="css/estilosMenu.css" rel="stylesheet">
    <div class="modal-dialog modal-lg">
<script>
    function calculaIMCart() {

let talla = document.getElementById('tallaseguiart').value;
let peso = document.getElementById('pesoseguiart').value;


imccalculo = Math.pow(talla, 2);
let limitimcalculo = imccalculo.toFixed(2);
let calculoimc = peso / limitimcalculo;
let limitcalculofinal = calculoimc.toFixed(1);
document.formularioseguiart.imcsegui.value = limitcalculofinal;

}
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
    document.querySelector("input[name='fechasegui']").max = hoy_fecha;

});
$(document).ready(function () {
    $("#usghepaticosegui").change(function (e) {
        let valorusg = $('#usghepaticosegui').val();

        if (valorusg == 'Si') {

            $('#hallazgodeusgsegui').prop("hidden", false);
            $('#esteatosissegui').prop("hidden", false);
            $('#hallazgousgsegui').prop("selectedIndex", 0);
            $('#clasificacionesteatosissegui').prop("selectedIndex", 0);


        } else if (valorusg == 'No') {
            $('#hallazgodeusgsegui').prop("hidden", true);
            $('#esteatosissegui').prop("hidden", true);
            $('#hallazgousgsegui').prop("selectedIndex", 0);
            $('#clasificacionesteatosissegui').prop("selectedIndex", 0);


        }
    })
});




$(function () {
    $('#hallazgodeusgsegui').prop("hidden", true);
    $('#esteatosissegui').prop("hidden", true);
    $('#hallazgousgsegui').prop("selectedIndex", 0);
    $('#clasificacionesteatosissegui').prop("selectedIndex", 0);
    $('#dosisSemanalmetrosegui').prop("hidden", true);
    $('#dosisSemanalfemuasegui').prop("hidden", true);
    $('#dosisSemanalsulfasegui').prop("hidden", true);
    $("#dosisSemanaltecosegui").prop("hidden", true);
    $("#dosisSemanaltratasegui").prop("hidden", true);
    $("#tratamientoglucosegui").prop("hidden", true);
    $("#dosisSemanalvitadsegui").prop("hidden", true);
    $("#tratamientobiologicosegui").prop("hidden", true);
    $("#dosisSemanalmetrosegui").val('0');
    $("#dosisSemanalfemuasegui").val('0');
    $("#dosisSemanalsulfasegui").val('0');
    $("#dosisSemanaltecosegui").val('0');
    $("#dosisSemanaltratasegui").val('0');
    $("#clasisesteatosissegui").prop("hidden", true);
    $("#usghallazgosegui").prop("hidden", true);

})
function metrotexatesisegui(){
    let metrotexate = $("#metrotexate1segui").val();
    if(metrotexate == 'si'){
        $("#dosisSemanalmetrosegui").prop('hidden', false);
        $("#dosisSemanalmetrosegui").val('');
    };
    
}
function metrotexatenosegui(){
    let metrotexate = $("#metrotexate2segui").val();
    if(metrotexate == 'no'){
        $("#dosisSemanalmetrosegui").prop('hidden', true);
        $("#dosisSemanalmetrosegui").val('0');

    };
    
}

function Leflunomidesisegui() {
    let Leflunomide = $("#leflunomide1segui").val();

    if(Leflunomide == 'si'){
        $("#dosisSemanalfemuasegui").prop('hidden', false);
        $("#dosisSemanalfemuasegui").val('');

    }
}
function Leflunomidenosegui() {
    let Leflunomide = $("#leflunomide2segui").val();

    if(Leflunomide == 'no'){
        $("#dosisSemanalfemuasegui").prop('hidden', true);
        $("#dosisSemanalfemuasegui").val('0');

    }
}

function Sulfazalasinasisegui() {
    let Sulfazalasina = $("#sulfazalasina1segui").val();

    if(Sulfazalasina == 'si'){
        $("#dosisSemanalsulfasegui").prop('hidden', false);
        $("#dosisSemanalsulfasegui").val('');
    }
}
function Sulfazalasinanosegui() {
    let Sulfazalasina = $("#sulfazalasina2segui").val();

    if(Sulfazalasina == 'no'){
        $("#dosisSemanalsulfasegui").prop('hidden', true);
        $("#dosisSemanalsulfasegui").val('0');
    }
}

function Tocoferolsisegui() {
    let Tocoferol = $("#tecoferol1segui").val();

    if(Tocoferol == 'si'){
        $("#dosisSemanaltecosegui").prop('hidden', false);
        $("#dosisSemanaltecosegui").val('');
    }
}
function Tocoferolnosegui() {
    let Tocoferol = $("#tecoferol2segui").val();

    if(Tocoferol == 'no'){
        $("#dosisSemanaltecosegui").prop('hidden', true);
        $("#dosisSemanaltecosegui").val('0');
    }
}

function Glucocorticoidesisegui() {
    let Glucocorticoide = $("#glucocorticoide1segui").val();

    if(Glucocorticoide == 'si'){
        $("#tratamientoglucosegui").prop('hidden', false);
        $("#dosisSemanaltratasegui").prop('hidden', false);
        $("#dosisSemanaltratasegui").val('');
    }
}

function Glucocorticoidenosegui() {
    let Glucocorticoide = $("#glucocorticoide2segui").val();

    if(Glucocorticoide == 'no'){
        $("#tratamientoglucosegui").prop('hidden', true);
        $("#tratamientoglucosegui").prop('selectedIndex', 0);
        $("#dosisSemanaltratasegui").prop('hidden', true);
        $("#dosisSemanaltratasegui").val('0');
    }
}

function vitaminadsisegui() {
    let vitaminade = $("#vitaminaD1segui").val();

        if(vitaminade == 'si'){
            $("#dosisSemanalvitadsegui").prop("hidden", false);
            $("#dosisSemanalvitadsegui").val('');
        }
}
function vitaminadnosegui() {
    let vitaminade = $("#vitaminaD2segui").val();

        if(vitaminade == 'no'){
            $("#dosisSemanalvitadsegui").prop("hidden", true);
            $("#dosisSemanalvitadsegui").val('0');
        }
}

function Biologicosegui() {
    let biolo = $("#biologicosegui").val();

    if(biolo == 'si'){
        $("#tratamientobiologicosegui").prop("hidden", false);
    }else if(biolo == 'no'){
        $("#tratamientobiologicosegui").prop("hidden", true);
        $("#tratamientobiologicosegui").prop("selectedIndex", 0);
    }

}

$(document).ready(function() {

    $('#calcularCDAIsegui').on('click',function(e) {
    let valor1 = parseFloat($("#articulacionesInflamadasSJC28segui").val());
    let valor2 = parseFloat($("#articulacionesDolorosasTJC28segui").val());
    let valor3 = parseFloat($("#evglobalpgasegui").val());
    let valor4 = parseFloat($("#evegasegui").val());


    let sumar = valor1 + valor2 + valor3 + valor4;
    if(sumar <= 2.8){
    $("#resultadocdaisegui").val(sumar);
    }else if(sumar >= 2.9 && sumar <= 10){
        $("#resultadocdaisegui").val(sumar);  
    }else if(sumar >11 && sumar <= 22){
    $("#resultadocdaisegui").val(sumar); 
    }else if(sumar > 23){
        $("#resultadocdaisegui").val(sumar); 
    }
   
});
});
$(document).ready(function() {

    $('#calcularSDAIsegui').on('click',function(e) {
    let valor1 = parseFloat($("#articulacionesInflamadasSJC28segui").val());
    let valor2 = parseFloat($("#articulacionesDolorosasTJC28segui").val());
    let valor3 = parseFloat($("#evglobalpgasegui").val());
    let valor4 = parseFloat($("#evegasegui").val());
    let valor5 = parseFloat($("#pcrsegui").val());

    let sumar = valor1 + valor2 + valor3 + valor4;
    let sumar2 = sumar + valor5;
    
    if(sumar2 <= 3.3){
        $("#resultadosdaisegui").val(sumar2);
    }else if(sumar2 >= 3.4 && sumar2 <= 11){
        $("#resultadosdaisegui").val(sumar2); 
    }else if(sumar2 >=12 && sumar2 <= 26){
        $("#resultadosdaisegui").val(sumar2);  
    }else if(sumar2 > 27){
        $("#resultadosdaisegui").val(sumar2);
    }
});
});
$(document).ready(function() {

    $('#hallazgousgsegui').change(function(e) {
    let hallazgo = $("#hallazgousgsegui").val();
    
    if(hallazgo == 'Esteatosis'){
        $("#clasisesteatosissegui").prop("hidden", false);
    }else{
        $("#clasisesteatosissegui").prop("hidden", true);
        $("#clasificacionesteatosissegui").prop("selectedIndex",0);
    }
});
});
$(document).ready(function() {

    $('#usghepaticosegui').change(function(e) {
    let hallazgo = $("#usghepaticosegui").val();
    
    if(hallazgo == 'Si'){
        $("#usghallazgosegui").prop("hidden", false);
    }else{
        $("#usghallazgosegui").prop("hidden", true);
        $("#hallazgousgsegui").prop("selectedIndex",0);
        $("#clasisesteatosissegui").prop("hidden", true);
        $("#clasificacionesteatosissegui").prop("selectedIndex",0);
    }
});
});
$(document).ready(function() {

    $('#resultadofib4segui').on('click', function(e) {
    let valorsegui = parseFloat($("#fibsegui").val());
    
    if(valorsegui >= 0 && valorsegui <= 2.9){
        $("#resultadofib4segui").val("Fibrosis leve");
    }else if(valorsegui >= 3 && valorsegui <= 4.9){
        $("#resultadofib4segui").val("Fibrosis moderada"); 
    }else if(valorsegui >=5 && valorsegui <= 6){
        $("#resultadofib4segui").val("Fibrosis severa");  
    }
});
});
</script>

        <!-- Modal content-->
        <div class="modal-content">


            <div class="modal-header" id="cabeceraModalArtritis">
                <span class="material-symbols-outlined">
                    edit_note
                </span>
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarformularioseguimiento();">&times;</button>

            </div>
            <div class="modal-body">
                <div id="panel_editar">
                    <div class="contrato-nuevo">




                        <div class="modal-body">
                            <script>
                                /*
                                $(window).load(function() {
                                    $(".loader").fadeOut("slow");
                                });

                                function limpiarformularioseguimiento() {
                                    setTimeout('document.formularioseguimiento.reset()', 1000);
                                    return false;
                                }*/
                            </script>




                            <!-- form start -->
                            <div class="form-header">
                                <h5 class="form-title" style="text-align: center;
                                color:aliceblue; 
                                background-color:#A9DFBF; 
                                margin-top: 5px; 
                                font-size: 17px;">
                                    DATOS DEL PACIENTE </h5>
                            </div>

                            <form name="formularioseguiart" id="formularioseguiart" onsubmit="return limpiar()">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioseguiart").on("submit", function(e) {
                                        let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioseguiart"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/registrarSeguimientoPacienteArtritis.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                //$("#tabla_resultadobus").load('consultacancerdemama.php')

                                            }
                                        })
                                    })
                                    /** 
                                    var idcurp;

                                    function obtenerid() {

                                        var textoadjunto = document.getElementById("curps").value = idcurp;


                                    }
                                    */
                                    </script>
                                    <?php
                                    date_default_timezone_set('America/Monterrey');
                                    $hoy = date("Y-m-d h:i:s");
                
                                    ?>
                                    <div class="col-md-4">
                                        <strong>Fecha:</strong>
                                        <input type="text" value="<?php echo $hoy ?>" class="form-control" name="fechahoy" id="fechahoy" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>ID:</strong>
                                        <input type="text" value="<?php echo $dataRegistro['id_usuarioartritis']; ?>" class="form-control" name="seguiart" id="seguiart" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>CURP:</strong>
                                        <input id="curpseguiart" name="curpseguiart" class="form-control" type="text" value="<?php echo $dataRegistro['curp']; ?>" readonly>
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                        $('#tallaseguiart').mask('0.00');
                                    });
                                    </script>
                                    <div class="col-md-4">
                                        <strong>Talla:</strong>
                                        <input type="number" step="any" class="form-control" id="tallaseguiart" name="tallaseguiart" required>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Peso:</strong>
                                        <input type="number" step="any" class="form-control" id="pesoseguiart" onblur="calculaIMCart();" name="pesoseguiart" required>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>IMC:</strong>
                                        <input type="number" step="any" class="form-control" id="imcsegui" onblur="calculaIMCart();" name="imcsegui"  value="">
                                    </div>
                                    <br>
                                    <br>





                                    <!-- Titulo de SEGUIMIENTO LABORATORIOS -->
                                    <div class="col-md-12" style="text-align: center; 
                                    color:aliceblue; 
                                    background-color:#A9DFBF; 
                                    margin-top: 5px; 
                                    font-size: 17px;">
                                        SEGUIMIENTO LABORATORIOS
                                    </div>

                                    <br>
                                    <div class="col-md-3">
                                        <strong>Plaquetas</strong>
                                        <input type="number" step="any" class="form-control" id="plaquetassegui" name="plaquetassegui">
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Factor Reumatoide Basal</strong>
                                        <input type="number" step="any" class="form-control" id="frbasalsegui" name="frbasalsegui">
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Factor Reumatoide Nominal</strong>
                                        <select name="frnominalsegui" id="frnominalsegui" class="form-control">
                                            <option value="">Seleccione..</option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>
                                        </select>

                                    </div>

                                    <div class="col-md-3">
                                        <strong>PCR</strong>
                                        <input type="number" step="any" class="form-control" id="pcrsegui" name="pcrsegui">
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Vitamina D Basal</strong>
                                        <input type="number" step="any" class="form-control" id="vitaminaDBasalsegui" name="vitaminaDBasalsegui">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Vitamina D Nominal</strong>
                                        <select name="vitaminaDNominalsegui" id="vitaminaDNominalsegui" class="form-control">
                                            <option value="">Seleccione..</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Deficiente">Deficiente</option>
                                        </select>

                                    </div>

                                    <div class="col-md-3">
                                        <strong>AC Anticpp Basal</strong>
                                        <input type="number" step="any" class="form-control" id="anticppbasalsegui" name="anticppbasalsegui">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>AC Anticpp Nominal</strong>
                                        <select name="anticppnominalsegui" id="anticppnominalsegui" class="form-control">
                                            <option value="">Seleccione..</option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>
                                        </select>

                                    </div>


                                    <div class="col-md-3">
                                        <strong>VSG</strong>
                                        <input type="number" step="any" class="form-control" id="vsgsegui" name="vsgsegui">
                                    </div>

                                    <div class="col-md-3">
                                        <strong>TGO Basal</strong>
                                        <input type="number" step="any" class="form-control" id="tgobasalsegui" name="tgobasalsegui">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>TGO Nominal</strong>
                                        <select name="tgonominal" id="tgonominal" class="form-control">
                                            <option value="">Seleccione..</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Anormal">Anormal</option>
                                        </select>

                                    </div>

                                    <div class="col-md-3">
                                        <strong>TGP Basal</strong>
                                        <input type="number" step="any" class="form-control" id="tgpbasalsegui" name="tgpbasalsegui">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>TGP Nominal</strong>
                                        <select name="tgpnominalsegui" id="tgpnominalsegui" class="form-control">
                                            <option value="">Seleccione..</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Anormal">Anormal</option>
                                        </select>
                                    </div>


                                    <div class="col-md-3">
                                        <strong>Glucosa</strong>
                                        <input type="number" step="any" class="form-control" id="glucosasegui" name="glucosasegui">
                                    </div>

                                    <div class="col-md-2">
                                        <strong>Colesterol</strong>
                                        <input type="number" step="any" class="form-control" id="colesterolsegui" name="colesterolsegui">
                                    </div>

                                    <div class="col-md-2">
                                        <strong>Trigliceridos</strong>
                                        <input type="number" step="any" class="form-control" id="trigliceridossegui" name="trigliceridossegui">
                                    </div>

                                    <div class="col-md-2">
                                        <strong>FIB 4</strong>
                                        <input type="number" step="any" class="form-control" id="fibsegui" name="fibsegui" >
                                    </div>
                                    <div class="col-md-2">
                                        <strong>Resultado FIB 4</strong>
                                        <input type="text" step="any" class="form-control" id="resultadofib4segui" name="resultadofib4segui" readonly>
                                    </div>
                                    <!--Finaliza sección de Laboratorio-->






                                    <div class="col-md-12" style="text-align: center; color:aliceblue; background-color:#A9DFBF; margin-top: 5px; font-size: 17px;">
                                        SEGUIMIENTO USG HEPÁTICO
                                    </div>

                                    <!-- Los siguientes tres select son de selección simple-->
                                    <div class="col-md-12">
                                        <strong>USG Hepático</strong>
                                        <select name="usghepaticosegui" id="usghepaticosegui" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <!--Si el usuario Selecciona Sí en USG Hepático, se debe abrir el siguiente select-->

                                    <div class="col-md-12" id="usghallazgosegui">
                                        <strong>Hallazgo USG</strong>
                                        <select name="hallazgousgsegui" id="hallazgousgsegui" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Cirrosis hepatica">Cirrosis Hepática</option>
                                            <option value="Esteatosis">Esteatosis</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12" id="clasisesteatosissegui">
                                        <strong>
                                            Clasificación Esteatosis</strong>
                                        <select name="clasificacionesteatosissegui" id="clasificacionesteatosissegui" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Leve">Leve</option>
                                            <option value="Moderada">Moderada</option>
                                            <option value="Severa">Severa</option>
                                        </select>
                                    </div>
                                    <!--Finalizan los Select simples-->
                                    <!--Finaliza USG Hepático-->






                                    <!--Inicia la sección Clinica-->
                                    <div class="col-md-12" style="text-align: center; color:aliceblue; background-color:#A9DFBF; margin-top: 5px; font-size: 17px;">
                                        SEGUIMIENTO CLINICO
                                    </div>

                                    <div class="col-md-4">

                                        <strong>Articulaciones Inflamadas SJC28</strong>
                                        <input type="number" class="form-control" id="articulacionesInflamadasSJC28segui" name="articulacionesInflamadasSJC28segui" placeholder="Ingrese valor...">

                                    </div>

                                    <div class="col-md-4">

                                        <strong>Articulaciones Dolorosas TJC28</strong>
                                        <input type="number" class="form-control" id="articulacionesDolorosasTJC28segui" name="articulacionesDolorosasTJC28segui" placeholder="Ingrese valor...">

                                    </div>

                                    <div class="col-md-4">

                                        <strong>Evaluación Global PGA</strong>
                                        <input type="number" class="form-control" id="evglobalpgasegui" name="evglobalpgasegui" placeholder="Ingrese valor...">

                                    </div>


                                    <div class="col-md-4">

                                        <strong>Evaluación del Evaluador EGA</strong>
                                        <input type="number" class="form-control" id="evegasegui" name="evegasegui" placeholder="Ingrese valor...">

                                    </div>

                                    <div class="col-md-4">
                                        <strong>Resultado CDAI</strong>
                                        <input type="text" class="form-control" id="resultadocdaisegui" name="resultadocdaisegui" readonly value="">

                                    </div>

                                    <div class="col-md-4">
                                        <strong>Resultado SDAI</strong>
                                        <input type="text" class="form-control" id="resultadosdaisegui" name="resultadosdaisegui" readonly value="">

                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <a href="#" id="calcularCDAIsegui" style="font-style: italic;">Calcular CDAI</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#" id="calcularSDAIsegui" style="font-style: italic;">Calcular SDAI</a>
                                    </div>


                                    <!--Finaliza la Sección Clinica-->





                                    <!-- Inicia sección Tratamiento-->
                                    <div class="col-md-12" style="text-align: center; color:aliceblue; background-color:#A9DFBF; margin-top: 5px; font-size: 17px;">
                                        SEGUIMIENTO TRATAMIENTO
                                    </div>

                                    <!-- si selecciona SÍ en el medicamento, se debe abrir el campo de "Dosis Semanal":-->
                                    <fieldset class="col-md-2">
                                        <strong>Metrotexate</strong>
                                        <br>
                                        <input type="radio" name="metrotexatesegui" id="metrotexate1segui" class="check" value="si" onclick="metrotexatesisegui();">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="metrotexatesegui" id="metrotexate2segui" class="check" value="no" checked onclick="metrotexatenosegui();">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <div class="col-md-2">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanalmetrosegui" name="dosisSemanalmetrosegui" type="text" class="form-control" value="0">
                                    </div>

                                    <!-- si selecciona SÍ en el medicamento, se debe abrir el campo de "Dosis Semanal":-->
                                    <fieldset class="col-md-2">
                                        <strong>Leflunomide</strong>
                                        <br>
                                        <input type="radio" name="leflunomidesegui" id="leflunomide1segui" class="check" value="si" onclick="Leflunomidesisegui();">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="leflunomidesegui" id="leflunomide2segui" class="check" value="no" checked onclick="Leflunomidenosegui();">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <div class="col-md-2">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanalfemuasegui" name="dosisSemanalfemuasegui" type="text" class="form-control" value="0">
                                    </div>

                                    <!-- si selecciona SÍ en el medicamento, se debe abrir el campo de "Dosis Semanal":-->
                                    <fieldset class="col-md-2">
                                        <strong>Sulfazalasina</strong>
                                        <br>
                                        <input type="radio" name="sulfazalasinasegui" id="sulfazalasina1segui" class="check" value="si" onclick="Sulfazalasinasisegui();">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="sulfazalasinasegui" id="sulfazalasina2segui" class="check" value="no" checked onclick="Sulfazalasinanosegui();">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <div class="col-md-2">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanalsulfasegui" name="dosisSemanalsulfasegui" type="text" class="form-control" value="0">
                                    </div>

                                    <!-- si selecciona SÍ en el medicamento, se debe abrir el campo de "Dosis Semanal":-->
                                    <fieldset class="col-md-2">
                                        <strong>Tocoferol</strong>
                                        <br>
                                        <input type="radio" name="tecoferolsegui" id="tecoferol1segui" class="check" value="si" onclick="Tocoferolsisegui();">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="tecoferolsegui" id="tecoferol2segui" class="check" value="no" checked onclick="Tocoferolnosegui();">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <div class="col-md-2">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanaltecosegui" name="dosisSemanaltecosegui" type="text" class="form-control" value="0">
                                    </div>

                                    <!-- si selecciona SÍ en el medicamento, se debe abrir el campo de "Dosis Semanal":-->
                                    <fieldset class="col-md-2">
                                        <strong>Glucocorticoide</strong>
                                        <br>
                                        <input type="radio" name="glucocorticoidesegui" id="glucocorticoide1segui" class="check" value="si" onclick="Glucocorticoidesisegui();">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="glucocorticoidesegui" id="glucocorticoide2segui" class="check" value="no" checked onclick="Glucocorticoidenosegui();">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <!--Si el usuario selecciona Sí en la opción Glucocorticoide, se deben mostrar los siguientes dos selects-->
                                    <div class="col-md-4">
                                        <strong>Tratamiento</strong>
                                        <select name="tratamientoglucosegui" id="tratamientoglucosegui" class="form-select">
                                            <option value="0">Seleccione...</option>
                                            <option value="Deflazacort">Deflazacort</option>
                                            <option value="Prednisona">Prednisona</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanaltratasegui" name="dosisSemanaltratasegui" type="text" class="form-control" value="0">
                                    </div>

                                    <!-- si selecciona SÍ en el medicamento, se debe abrir el campo de "Dosis Semanal":-->
                                    <fieldset class="col-md-2">
                                        <strong>Vitamina D</strong>
                                        <br>
                                        <input type="radio" name="vitaminaDsegui" id="vitaminaD1segui" class="check" value="si" onclick="vitaminadsisegui();">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="vitaminaDsegui" id="vitaminaD2segui" class="check" value="no" checked onclick="vitaminadnosegui();">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <div class="col-md-2">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanalvitadsegui" name="dosisSemanalvitadsegui" type="text" class="form-control" value="0">
                                    </div>

                                    <div class="col-md-2">
                                        <strong>
                                            Biológico</strong>
                                        <select name="biologicosegui" id="biologicosegui" class="form-select" onchange="Biologicosegui();">
                                            <option value="0">Seleccione...</option>
                                            <option value="si">Sí</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <!--Si el usuario selecciona Sí en la opción Biológico, se deben mostrar los siguientes dos selects-->
                                    <div class="col-md-3">
                                        <strong>Tratamiento</strong>
                                        <select name="tratamientobiologicosegui" id="tratamientobiologicosegui" class="form-select">
                                            <option value="Sin registro">Seleccione...</option>
                                            <option value="Rituximab">Rituximab</option>
                                            <option value="Abatacept">Abatacept</option>
                                            <option value="Alimumab">Adalimumab</option>
                                            <option value="Tocilizumab">Tocilizumab</option>
                                            <option value="Pertuzumab">Pertuzumab</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>
                                            Apego a Tratamiento</strong>
                                        <select name="apegotratamientosegui" id="apegotratamientosegui" class="form-select">
                                            <option value="0">Seleccione...</option>
                                            <option value="Parcial">Parcial</option>
                                            <option value="Total">Total</option>
                                            <option value="Sin apego">Sin Apego</option>
                                        </select>
                                    </div>
                                    <br><br><br><br>

                                    <!--Botón Guardar y Cancelar-->
                                    <input type="submit" value="Registrar" style="width: 170px; 
                                    height: 27px; 
                                    color: white; 
                                    background-color: #6CCD06; 
                                    float: right; 
                                    margin-right: 5px; 
                                    margin-top: 5px; 
                                    text-decoration: none; 
                                    border: none; 
                                    border-radius: 15px;">
                                    <input type="button" onclick="window.location.reload();" value="Cerrar formulario" style="width: 170px; 
                                    height: 27px; 
                                    color: white; 
                                    background-color: #FA0000; 
                                    float: left; 
                                    margin-left: 5px; 
                                    margin-top: 5px; 
                                    text-decoration: none; 
                                    border: none; 
                                    border-radius: 15px;">


                                    <br>
                                </div>
                            </form>
                            <div id="tabla_resultado2"></div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>