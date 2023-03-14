<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="artritisdatospersonales">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--la siguiente liga es para el icon de Agregar persona que se muestra en el Modal CargarPacienteArtritis-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!--Fin de la liga-->

    <link href="css/estilosMenu.css" rel="stylesheet">
    <script src="js/getCatalogos.js"></script>
    <script src="js/scriptModalvalidacionArtritis.js"></script>
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <div class="modal-dialog modal-lg">
<script>
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
function Edadedit(FechaNacimiento) {

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

function calcularEdadedit() {
    var fecha = document.getElementById('fechaedit').value;


    var edad = Edadedit(fecha);
    document.formularioartritisediciondp.edadedit.value = edad;

}
function curp2dateedit(curp) {
    var miCurp = document.getElementById('curpedit').value.toUpperCase();
    var sexo = miCurp.substr(-8, 1);
    var m = miCurp.match(/^\w{4}(\w{2})(\w{2})(\w{2})/);
    //miFecha = new Date(año,mes,dia) 
    var anyo = parseInt(m[1], 10) + 1900;
    if (anyo < 1920) anyo += 100;
    var mes = parseInt(m[2], 10) - 1;
    var dia = parseInt(m[3], 10);
    document.formularioartritisediciondp.fechaedit.value = (new Date(anyo, mes, dia));
    if (sexo == 'M') {
        document.formularioartritisediciondp.sexoedit.value = 'Femenino';
    } else if (sexo == 'H') {
        document.formularioartritisediciondp.sexoedit.value = 'Masculino';
    } else if (sexo != 'M' || 'H') {
        alert('Error de CURP');
    }
calcularEdadedit();
}
function calculaIMCedit() {

let talla = document.getElementById('tallaedit').value;
let peso = document.getElementById('pesoedit').value;


imccalculo = Math.pow(talla, 2);
let limitimcalculo = imccalculo.toFixed(2);
let calculoimc = peso / limitimcalculo;
let limitcalculofinal = calculoimc.toFixed(1);

document.formularioartritisediciondp.imcedit.value = limitcalculofinal;

}
$(document).ready(function() {

$('#resultadofibedit').on('click', function(e) {
let valor = parseFloat($("#fib4edit").val());

if(valor >= 0 && valor <= 2.9){
    $("#resultadofibedit").val("Fibrosis leve");
}else if(valor >= 3 && valor <= 4.9){
    $("#resultadofibedit").val("Fibrosis moderada"); 
}else if(valor >=5 && valor <= 6){
    $("#resultadofibedit").val("Fibrosis severa");  
}
});
});

$(document).ready(function () {

    $('#msartritisedit').change(function (e) {


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
    document.querySelector("input[name='fechaedit']").max = hoy_fecha;

});
</script>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalArtritis">
                <span class="material-symbols-outlined">
                    📝
                </span>
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiar();">&times;</button>
            </div>
            <div class="modal-body">
                <div id="panel_editar">
                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- Titulo de Datos del Paciente -->
                            <div class="form-header">
                                <h4 class="form-title" style="text-align: center;
                                    color:aliceblue  ;
                                    background-color:#A9DFBF;
                                    margin-top: 5px;">
                                    DATOS DEL PACIENTE 🙍🏻‍♂️</h4>
                            </div>

                            <form name="formularioartritisediciondp" id="formularioartritisediciondp" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                        $("#formularioartritisediciondp").on("submit", function(e) {
                                            if ($('input[name=curpedit]').val().length == 0 || $(
                                                    'input[name=nombrecompletoedit]')
                                                .val().length == 0
                                            ) {
                                                alert('Ingrese los datos requeridos');

                                                return false;
                                            }
                                            let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                            e.preventDefault();

                                            var formData = new FormData(document.getElementById(
                                                "formularioartritisediciondp"));
                                            formData.append("dato", "valor");

                                            $.ajax({

                                                url: "aplicacion/editarArtritisdp.php",
                                                type: "post",
                                                dataType: "html",
                                                data: formData,
                                                cache: false,
                                                contentType: false,
                                                processData: false,
                                                success: function(datos) {
                                                    $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };

                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaArtritisBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#artritisdatospersonales").modal('hide');
                                                                    }, 1500);
                                                                    $("#artritisdatospersonales").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#artritisdatospersonales").modal('hide');
                                            }
                                        
                                            })
                                        })
                                    </script>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id_usuarioartritis']; ?>">
                                        </div>
                                    <div class="col-md-4">
                                        <strong>CURP</strong>
                                        <input id="curpedit" name="curpedit" type="text" class="form-control" value="<?php echo $dataRegistro['curp'] ?>" onblur="curp2dateedit();" minlength="18" maxlength="18" >
                                        
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Nombre Completo</strong>
                                        <input id="nombrecompletoedit" name="nombrecompletoedit" onblur="calcularEdadedit();" type="text" class="form-control" value="<?php echo $dataRegistro['nombrecompleto'] ?>">
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Escolaridad</strong>
                                        <select id="escolaridadedit" name="escolaridadedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['escolaridad'] ?>"><?php echo $dataRegistro['escolaridad'] ?></option>
                                            <?php
                                            require 'conexionCancer.php';
                                            $query = $conexionCancer->prepare("SELECT id_escolaridad, gradoacademico FROM escolaridad");
                                            $query->execute();
                                            $query->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row = $query->fetch()) { ?>
                                                <option value="<?php echo $row['gradoacademico']; ?>">
                                                    <?php echo $row['gradoacademico']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Fecha de Nacimiento</strong>
                                        <input id="fechaedit" name="fechaedit" type="date" value="<?php echo $dataRegistro['fechanacimiento'] ?>" onblur="curp2dateedit();" class="form-control" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Edad</strong>
                                        <input id="edadedit" name="edadedit" type="text" class="form-control" value="<?php echo $dataRegistro['edad'] ?>" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Sexo</strong>
                                        <input type="text" class="form-control" id="sexoedit" value="<?php echo $dataRegistro['sexo'] ?>" onclick="curp2dateedit();" name="sexoedit" readonly>
                                    </div>
                                    <script>
                                        /*
                                    $(document).ready(function() {
                                        $('#presionarterial').mask('000/000');
                                    });*/
                                    $(document).ready(function() {
                                        $('#talla').mask('0.00');
                                    });
                                    </script>
                                    <div class="col-md-4">
                                        <strong>Talla</strong>
                                        <input type="number" step="any" class="form-control" id="tallaedit" name="tallaedit" value="<?php echo $dataRegistro['tallaartritis'] ?>">

                                    </div>
                                    <div class="col-md-4">
                                        <strong>Peso</strong>
                                        <input type="number" step="any" class="form-control" id="pesoedit" value="<?php echo $dataRegistro['pesoartritis'] ?>" onblur="calculaIMCedit();" name="pesoedit">
                                    </div>

                                    <div class="col-md-4">
                                        <strong>IMC</strong>
                                        <input type="text" class="form-control" id="imcedit" onblur="calculaIMCedit();" name="imcedit" value="<?php echo $dataRegistro['imcartritis'] ?>" readonly>
                                    </div>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="artritisantecedentespato">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--la siguiente liga es para el icon de Agregar persona que se muestra en el Modal CargarPacienteArtritis-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!--Fin de la liga-->

    <link href="css/estilosMenu.css" rel="stylesheet">
    <script src="js/getCatalogos.js"></script>
    <script src="js/scriptModalvalidacionArtritis.js"></script>
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalArtritis">
                <span class="material-symbols-outlined">
                    📝
                </span>
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiar();">&times;</button>
            </div>
            <div class="modal-body">
                <div id="panel_editar">
                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- Titulo de Datos del Paciente -->

                            <form name="formularioartritisedicionpato" id="formularioartritisedicionpato" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                        $("#formularioartritisedicionpato").on("submit", function(e) {
                                            if ($('input[name=curpedit]').val().length == 0 || $(
                                                    'input[name=nombrecompletoedit]')
                                                .val().length == 0
                                            ) {
                                                alert('Ingrese los datos requeridos');

                                                return false;
                                            }
                                            let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                            e.preventDefault();

                                            var formData = new FormData(document.getElementById(
                                                "formularioartritisedicionpato"));
                                            formData.append("dato", "valor");

                                            $.ajax({

                                                url: "aplicacion/editarArtritisAntecedentesPato.php",
                                                type: "post",
                                                dataType: "html",
                                                data: formData,
                                                cache: false,
                                                contentType: false,
                                                processData: false,
                                                success: function(datos) {
                                                    $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };

                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaArtritisBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#artritisantecedentespato").modal('hide');
                                                                    }, 1500);
                                                                    $("#artritisantecedentespato").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#artritisantecedentespato").modal('hide');
                                            }
                                        
                                            })
                                        })
                                    </script>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id_usuarioartritis']; ?>">
                                        </div>
                                        <div class="col-md-12" style="text-align: center; color:aliceblue; background-color:#A9DFBF; margin-top: 5px; font-size: 17px;">
                                        ANTECEDENTES PERSONALES PATOLÓGICOS 🏥
                                    </div>

                                    <div class="col-md-12">
                                        <strong>Antecedentes Personales Patológicos</strong>
                                
                                        <select id="msartritisedit" name="msartritisedit[]" multiple="multiple" class="form-control">
                                            <option value="Tabaquismo">Tabaquismo</option>
                                            <option value="Alcoholismo">Alcoholismo</option>
                                            <option value="Esteatosis Hepatica">Esteatosis Hepatica</option>
                                            <option value="Diabetes Mellitus">Diabetes Mellitus</option>
                                            <option value="Hipertensión Arterial">Hipertensión Arterial</option>
                                            <option value="Obesidad">Obesidad</option>
                                            <option value="Hiperlipidemia">Hiperlipidemia</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="artritislaboratorios">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--la siguiente liga es para el icon de Agregar persona que se muestra en el Modal CargarPacienteArtritis-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!--Fin de la liga-->

    <link href="css/estilosMenu.css" rel="stylesheet">
    <script src="js/getCatalogos.js"></script>
    <script src="js/scriptModalvalidacionArtritis.js"></script>
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalArtritis">
                <span class="material-symbols-outlined">
                    📝
                </span>
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiar();">&times;</button>
            </div>
            <div class="modal-body">
                <div id="panel_editar">
                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- Titulo de Datos del Paciente -->

                            <form name="formularioartritislaboratorios" id="formularioartritislaboratorios" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                        $("#formularioartritislaboratorios").on("submit", function(e) {
                                            if ($('input[name=curpedit]').val().length == 0 || $(
                                                    'input[name=nombrecompletoedit]')
                                                .val().length == 0
                                            ) {
                                                alert('Ingrese los datos requeridos');

                                                return false;
                                            }
                                            let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                            e.preventDefault();

                                            var formData = new FormData(document.getElementById(
                                                "formularioartritislaboratorios"));
                                            formData.append("dato", "valor");

                                            $.ajax({

                                                url: "aplicacion/editarArtritisLaboratorios.php",
                                                type: "post",
                                                dataType: "html",
                                                data: formData,
                                                cache: false,
                                                contentType: false,
                                                processData: false,
                                                success: function(datos) {
                                                    $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };

                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaArtritisBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#artritislaboratorios").modal('hide');
                                                                    }, 1500);
                                                                    $("#artritislaboratorios").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#artritislaboratorios").modal('hide');
                                            }
                                        
                                            })
                                        })
                                    </script>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id_usuarioartritis']; ?>">
                                        </div>
                                        <div class="col-md-12">
                                        <div class="form-title" style="text-align: center; color:aliceblue; background-color:#A9DFBF; margin-top: 5px; font-size: 18px;">
                                            LABORATORIOS 🧪
                                        </div>
                                    </div>



                                    <div class="col-md-3">
                                        <strong>Plaquetas</strong>
                                        <input type="number" step="any" class="form-control" id="plaquetasedit" name="plaquetasedit" value="<?php echo $dataRegistro['plaquetas'] ?>">
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Factor Reumatoide Basal</strong>
                                        <input type="number" step="any" class="form-control" id="frbasaledit" name="frbasaledit" value="<?php echo $dataRegistro['frbasal'] ?>">
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Factor Reumatoide Nominal</strong>
                                        <select name="frnominaledit" id="frnominaledit" class="form-control">
                                            <option value="<?php echo $dataRegistro['frnominal'] ?>"><?php echo $dataRegistro['frnominal'] ?></option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>
                                        </select>
                                        
                                    </div>

                                    <div class="col-md-3">
                                        <strong>PCR</strong>
                                        <input type="number" step="any" class="form-control" id="pcredit" name="pcredit" value="<?php echo $dataRegistro['pcr'] ?>">
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Vitamina D Basal</strong>
                                        <input type="number" step="any" class="form-control" id="vitaminaDBasaledit" name="vitaminaDBasaledit" value="<?php echo $dataRegistro['vitaminadbasal'] ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Vitamina D Nominal</strong>
                                        <select name="vitaminaDNominaledit" id="vitaminaDNominaledit" class="form-control">
                                            <option value="<?php echo $dataRegistro['vitaminadnominal'] ?>"><?php echo $dataRegistro['vitaminadnominal'] ?></option>
                                            <option value="Normal">Normal</option>
                                            <option value="Deficiente">Deficiente</option>
                                        </select>
                                        
                                    </div>

                                    <div class="col-md-3">
                                        <strong>AC Anticpp Basal</strong>
                                        <input type="number" step="any" class="form-control" id="anticppbasaledit" name="anticppbasaledit" value="<?php echo $dataRegistro['anticppbasal'] ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>AC Anticpp Nominal</strong>
                                        <select name="anticppnominaledit" id="anticppnominaledit" class="form-control">
                                            <option value="<?php echo $dataRegistro['anticppnominal'] ?>"><?php echo $dataRegistro['anticppnominal'] ?></option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>
                                        </select>
                                        
                                    </div>
                                    

                                    <div class="col-md-3">
                                        <strong>VSG</strong>
                                        <input type="number" step="any" class="form-control" id="vsgedit" name="vsgedit" value="<?php echo $dataRegistro['vsg'] ?>">
                                    </div>

                                    <div class="col-md-3">
                                        <strong>TGO Basal</strong>
                                        <input type="number" step="any" class="form-control" id="tgobasaledit" name="tgobasaledit" value="<?php echo $dataRegistro['tgobasal'] ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>TGO Nominal</strong>
                                        <select name="tgonominaledit" id="tgonominaledit" class="form-control">
                                            <option value="<?php echo $dataRegistro['tgonominal'] ?>"><?php echo $dataRegistro['tgonominal'] ?></option>
                                            <option value="Normal">Normal</option>
                                            <option value="Anormal">Anormal</option>
                                        </select>
                                        
                                    </div>

                                    <div class="col-md-3">
                                        <strong>TGP Basal</strong>
                                        <input type="number" step="any" class="form-control" id="tgpbasaledit" name="tgpbasaledit" value="<?php echo $dataRegistro['tgpbasal'] ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>TGP Nominal</strong>
                                        <select name="tgpnominaledit" id="tgpnominaledit" class="form-control" >
                                            <option value="<?php echo $dataRegistro['tgpnominal'] ?>"><?php echo $dataRegistro['tgpnominal'] ?></option>
                                            <option value="Normal">Normal</option>
                                            <option value="Anormal">Anormal</option>
                                        </select>
                                        
                                    </div>
                                

                                    <div class="col-md-3">
                                        <strong>Glucosa</strong>
                                        <input type="number" step="any" class="form-control" id="glucosaedit" name="glucosaedit" value="<?php echo $dataRegistro['glucosa'] ?>">
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Colesterol</strong>
                                        <input type="number" step="any" class="form-control" id="colesteroledit" name="colesteroledit" value="<?php echo $dataRegistro['colesterol'] ?>">
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Trigliceridos</strong>
                                        <input type="number" step="any" class="form-control" id="trigliceridosedit" name="trigliceridosedit" value="<?php echo $dataRegistro['trigliceridos'] ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <i><a sytle="font-size: 7px;" href="https://www.hepatitisc.uw.edu/page/clinical-calculators/fib-4" target="_blank">Fib 4</a></i>
                                        <input type="number" step="any" class="form-control" id="fib4edit" name="fib4edit" value="<?php echo $dataRegistro['fib4'] ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <strong id="calcularresultado">Resultado FIB 4</strong>
                                        <input type="text" class="form-control"  id="resultadofibedit" value="<?php echo $dataRegistro['resultadofib4'] ?>" name="resultadofibedit" readonly>

                                    </div>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="artritisusghepatico">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--la siguiente liga es para el icon de Agregar persona que se muestra en el Modal CargarPacienteArtritis-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!--Fin de la liga-->

    <link href="css/estilosMenu.css" rel="stylesheet">
    <script src="js/getCatalogos.js"></script>
    <script src="js/scriptModalvalidacionArtritis.js"></script>
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalArtritis">
                <span class="material-symbols-outlined">
                    📝
                </span>
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiar();">&times;</button>
            </div>
            <div class="modal-body">
                <div id="panel_editar">
                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- Titulo de Datos del Paciente -->

                            <form name="formularioartritisusghepatico" id="formularioartritisusghepatico" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                        $("#formularioartritisusghepatico").on("submit", function(e) {
                                            if ($('input[name=curpedit]').val().length == 0 || $(
                                                    'input[name=nombrecompletoedit]')
                                                .val().length == 0
                                            ) {
                                                alert('Ingrese los datos requeridos');

                                                return false;
                                            }
                                            let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                            e.preventDefault();

                                            var formData = new FormData(document.getElementById(
                                                "formularioartritisusghepatico"));
                                            formData.append("dato", "valor");

                                            $.ajax({

                                                url: "aplicacion/editarArtritisUsgHepatico.php",
                                                type: "post",
                                                dataType: "html",
                                                data: formData,
                                                cache: false,
                                                contentType: false,
                                                processData: false,
                                                success: function(datos) {
                                                    $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };

                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaArtritisBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#artritisusghepatico").modal('hide');
                                                                    }, 1500);
                                                                    $("#artritisusghepatico").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#artritisusghepatico").modal('hide');
                                            }
                                        
                                            })
                                        })
                                    </script>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id_usuarioartritis']; ?>">
                                        </div>
                                        <div class="col-md-12" style="text-align: center; color:aliceblue; background-color:#A9DFBF; margin-top: 5px; font-size: 17px;">
                                        USG HEPÁTICO 🖥
                                    </div>
                                        <script>
                                            $(document).ready(function() {

$('#hallazgousgedit').change(function(e) {
let hallazgo = $("#hallazgousgedit").val();

if(hallazgo == 'Esteatosis'){
    $("#clasione").prop("hidden", false);
}else{
    $("#clasione").prop("hidden", true);
    $("#clasificacionesteatosisedit").prop("selectedIndex",1);
}
});
});
$(document).ready(function() {

$('#usghepaticoedit').change(function(e) {
let hallazgo = $("#usghepaticoedit").val();

if(hallazgo == 'Si'){
    $("#usgone").prop("hidden", false);
}else{
    $("#usgone").prop("hidden", true);
    $("#hallazgousgedit").prop("selectedIndex",1);
    $("#clasione").prop("hidden", true);
    $("#clasificacionesteatosisedit").prop("selectedIndex",1);
}
});
});
                                        </script>
                                    <!-- Los siguientes tres select son de selección simple-->
                                    <div class="col-md-12">
                                        <strong>USG Hepático</strong>
                                        <select name="usghepaticoedit" id="usghepaticoedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['detalleusghepatico'] ?>"><?php echo $dataRegistro['detalleusghepatico'] ?></option>
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <!--Si el usuario Selecciona Sí en USG Hepático, se debe abrir el siguiente select-->

                                    <div class="col-md-12" id="usgone">
                                        <strong>Hallazgo USG</strong>
                                        <select name="hallazgousgedit" id="hallazgousgedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['hallazgousg'] ?>"><?php echo $dataRegistro['hallazgousg'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Cirrosis hepatica">Cirrosis Hepática</option>
                                            <option value="Esteatosis">Esteatosis</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12" id="clasione">
                                        <strong>
                                            Clasificación Esteatosis</strong>
                                        <select name="clasificacionesteatosisedit" id="clasificacionesteatosisedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['clasificacionesteatosis'] ?>"><?php echo $dataRegistro['clasificacionesteatosis'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Leve">Leve</option>
                                            <option value="Moderada">Moderada</option>
                                            <option value="Severa">Severa</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="edicionfechaseguimiento">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--la siguiente liga es para el icon de Agregar persona que se muestra en el Modal CargarPacienteArtritis-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!--Fin de la liga-->

    <link href="css/estilosMenu.css" rel="stylesheet">
    <script src="js/getCatalogos.js"></script>
    <script src="js/scriptModalvalidacionArtritis.js"></script>
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalArtritis">
                <span class="material-symbols-outlined">
                    📝
                </span>
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiar();">&times;</button>
            </div>
            <div class="modal-body">
                <div id="panel_editar">
                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <form name="formularioartritisedicionfechasegui" id="formularioartritisedicionfechasegui" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                        $("#formularioartritisedicionfechasegui").on("submit", function(e) {
                                            
                                            let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                            e.preventDefault();

                                            var formData = new FormData(document.getElementById(
                                                "formularioartritisedicionfechasegui"));
                                            formData.append("dato", "valor");

                                            $.ajax({

                                                url: "aplicacion/editarArtritisfechainicioseguimiento.php",
                                                type: "post",
                                                dataType: "html",
                                                data: formData,
                                                cache: false,
                                                contentType: false,
                                                processData: false,
                                                success: function(datos) {
                                                    $("#mensaje").html(datos);
                                                    let id = $("#idcurp").val();
                                                let fechasegui = $("#fechainicioseguimiento").val();
                                                let ob = {
                                                            id: id, fechasegui:fechasegui
                                                            };

                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaSeguimientosArtritis.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#edicionfechaseguimiento").modal('hide');
                                                                    }, 1500);
                                                                    $("#edicionfechaseguimiento").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#edicionfechaseguimiento").modal('hide');
                                            }
                                        
                                            })
                                        })
                                    </script>
                                    <div class="col-md-12">
                                            <input id="id_seguimientoartritis" name="id_seguimientoartritis" type="hidden" class="form-control" value="<?php echo $dataRegistro['id_seguimientoartritis']; ?>">
                                        </div>
                                        <input type="hidden" id="fechainicioseguimiento" value="<?php echo $dataRegistro['fechainicioseguiartritis'] ?>">
                                        <input type="hidden" id="idcurp" value="<?php echo $id_paciente; ?>">
                                        <div class="col-md-6">
                                        <strong>CURP</strong>
                                        <input id="" name="" type="text" value="<?php echo $dataRegistro['curpseguiart'] ?>"  class="form-control" readonly>
                                        </div>
                                        <div class="col-md-6">
                                        <strong>Fecha de inicio de seguimiento</strong>
                                        <input id="fechaeditseguimiento" name="fechaeditseguimiento" type="date" value="<?php echo $dataRegistro['fechaseguimiento'] ?>"  class="form-control">
                                        </div>
                                    
                                        </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>