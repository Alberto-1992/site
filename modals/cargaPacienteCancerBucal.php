<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="cancerBucal">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--se agrega estilos para icon-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link href="css/estilosMenu.css" rel="stylesheet">
    <script src="js/getCatalogos.js"></script>
    <script src="js/scriptModalvalidacionCancerMama.js"></script>
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <!-- Inicia Modal Header -->
        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalBucal">
                <span class="material-symbols-outlined" style="color: white;">
                    person_add
                </span>
                <!--<h6 class="modal-title">FICHA DE DATOS -  CANCER BUCAL</h6>-->
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiar();">&times;</button>
            </div>
            <!-- Finaliza Modal Header -->




            <div class="modal-body">
                <div id="panel_editar">
                    <div class="modal-body">

                        <!-- Header inicial Datos del Paciente -->
                        <div class="form-header">
                            <h4 class="form-title" style="text-align: center;
                                    color:aliceblue  ;
                                    background-color:#e64f6c;
                                    margin-top: 5px;">
                                DATOS DEL PACIENTE </h4>
                        </div>
                        <!-- Fin Header inicial Datos del Paciente -->





                        <form name="formulario" id="formulario" onSubmit="return limpiar()" autocomplete="off">
                            <div class="form-row">
                                <div id="mensaje"></div>
                                <script>
                                    $("#formulario").on("submit", function(e) {
                                        if ($('input[name=curp]').val().length == 0 || $(
                                                'input[name=nombrecompleto]')
                                            .val().length == 0 || $('select[name=cbx_estado]').val().length == 0
                                        ) {
                                            alert('Ingrese los datos requeridos');

                                            return false;

                                        }
                                        let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formulario"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/registrarpacienteCancer.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                            }
                                        })
                                    })
                                </script>

                                <div class="col-md-6" autocomplete="off">
                                    <input id="year" name="year" class="control form-control" type="hidden" value="2022" required="required" readonly>
                                </div>
                                <div class="col-md-12">
                                    <input id="cest" name="cest" type="hidden" class="form-control" value="cest">
                                </div>


                                <!-- Inicia formulario de Datos del Paciente-->
                                <div class="col-md-4">
                                    <strong>CURP</strong>
                                    <input list="curpusuario" id="curp" name="curp" type="text" class="control form-control" value="" onblur="curp2date();" minlength="18" maxlength="18" required>
                                    <datalist id="curpusuario">
                                        <option value="">Seleccione</option>
                                        <?php
                                        require 'conexionCancer.php';
                                        $query = $conexionCancer->prepare("SELECT curp FROM dato_usuario ");
                                        $query->execute();
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['curp']; ?>">
                                                <?php echo $row['curp']; ?></option>
                                        <?php } ?>
                                    </datalist>
                                </div>


                                <div class="col-md-4">
                                    <strong>Nombre Completo</strong>
                                    <input id="nombrecompleto" name="nombrecompleto" onblur="calcularEdad();" type="text" class="control form-control" value="" required>
                                </div>


                                <div class="col-md-4">
                                    <strong>Escolaridad</strong>
                                    <select id="escolaridad" name="escolaridad" class="form-control" style="font-size: 12px;">
                                        <option value="Sin registro">Sin registro</option>
                                        <?php
                                        require 'conexionInfarto.php';
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
                                    <strong>Fecha de nacimiento</strong>
                                    <input id="fecha" name="fecha" type="date" value="" onblur="curp2date();" class="control form-control" readonly>
                                </div>
                                <div class="col-md-4">
                                    <strong>Edad</strong>
                                    <input id="edad" name="edad" type="text" class="control form-control" value="" readonly>
                                </div>

                                <div class="col-md-4">
                                    <strong>Sexo</strong>
                                    <input type="text" class="control form-control" id="sexo" onclick="curp2date();" name="sexo" readonly>

                                </div>
                                <div class="col-md-3">
                                    <strong>Raza</strong>
                                    <input type="text" class="form-control" id="raza" onclick="curp2date();" name="raza">
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

                                <div class="col-md-3">
                                    <strong>Talla</strong>
                                    <input type="number" step="any" class="form-control" id="talla" name="talla" required>

                                </div>
                                <div class="col-md-3">
                                    <strong>Peso</strong>
                                    <input type="number" step="any" class="form-control" id="peso" onblur="calculaIMC();" name="peso" required>

                                </div>
                                <div class="col-md-3">
                                    <strong>IMC</strong>
                                    <input type="text" class="form-control" id="imc" onblur="calculaIMC();" name="imc" value="" readonly>

                                </div>

                                <div class="col-md-4">
                                    <strong>Estado de residencia</strong>

                                    <select name="cbx_estado" id="cbx_estado" class="form-control" style="width: 100%;" required>
                                        <option value="Sin registro" selected>Sin registro</option>
                                        <?php
                                        require '../esclerosis/conexion.php';
                                        $query = "SELECT id_estado, estado FROM t_estado ";
                                        $resultado = $conexion2->query($query);
                                        while ($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['id_estado']; ?>">
                                                <?php echo $row['estado']; ?></option>
                                        <?php } ?>

                                        <!--<option value="1">Otro</option>-->

                                    </select>

                                </div>
                                <div class="col-md-4">
                                    <strong>Delegación o Municipio</strong>
                                    <select name="cbx_municipio" id="cbx_municipio" class="form-control" style="width: 100%;">

                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Referenciado</strong>
                                    <select name="referenciado" id="referenciado" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Si">Sí</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-12" id="medioreferencia">
                                    <strong>Unidad referencia</strong>
                                    <input list="referencias" name="unidadreferencia" id="unidadreferencia" class="form-control">
                                    <datalist id="referencias">
                                        <option value="Sin registro">Sin registro</option>
                                        <?php
                                        $query = $conexionCancer->prepare("SELECT clues, unidad FROM hospitales");
                                        $query->execute();
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['clues']; ?>">
                                                <?php echo $row['unidad']; ?></option>
                                        <?php } ?>

                                    </datalist>
                                </div>





                                <!-- Inicia Sección de Antecedentes No Patológicos-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; color:aliceblue; background-color:#e64f6c; margin-top: 5px; font-size: 18px; ">
                                    ANTECEDENTES NO PATOLÓGICOS
                                </div>

                                <div class="col-md-4">
                                    <strong>Exposición Solar</strong>
                                    <select name="comidas" id="comidas" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="si">Sí</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>


                                <div class="col-md-4">
                                    <strong>Comidas al día</strong>
                                    <select name="comidas" id="comidas" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="unacomida">1</option>
                                        <option value="doscomidas">2</option>
                                        <option value="trescomidas">3 o más</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Higiene Bucal</strong>
                                    <select name="comidas" id="comidas" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="unavez">1 vez al día</option>
                                        <option value="dosveces">2 veces al día</option>
                                        <option value="tresveces">3 o más veces al día</option>
                                    </select>
                                </div>

                                <!-- Finaliza Sección de Antecedentes No Patológicos-->





                                <!--Inicia la sección de Antecedentes Personales Patológicos-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; color:aliceblue; background-color:#e64f6c; margin-top: 5px; font-size: 18px; ">
                                    ANTECEDENTES PERSONALES PATOLÓGICOS
                                </div>

                                <!--ALCOHOLISMO-->
                                <fieldset class="col-md-2">
                                    <strong>Tabaquismo</strong>
                                    <br>
                                    <input type="radio" name="tabaquismo" id="tabaquismo1" class="check" value="si">&nbsp;Sí&nbsp;&nbsp;
                                    <input type="radio" name="tabaquismo" id="tabaquismo2" class="check" value="no">&nbsp;No&nbsp;&nbsp;
                                </fieldset>
                                <!-- si selecciona SÍ en Tabaquismo, se deben habiliar los siguientes dos campos:-->
                                <div class="col-md-2" id="anos">
                                    <strong>Años:</strong>
                                    <input id="anos" name="anos" type="number" class="form-control" value="" required>
                                </div>
                                <div class="col-md-3" id="cigarrosdia">
                                    <strong>Cigarros al día:</strong>
                                    <input id="cigarrosdia" name="cigarrosdia" type="number" class="form-control" value="" required>
                                </div>

                                <!--ALCOHOLISMO-->
                                <fieldset class="col-md-2">
                                    <strong>Alcoholismo</strong>
                                    <br>
                                    <input type="radio" name="alcoholismo" id="alcoholismo1" class="check" value="si">&nbsp;Sí&nbsp;&nbsp;
                                    <input type="radio" name="alcoholismo" id="alcoholismo2" class="check" value="no">&nbsp;No&nbsp;&nbsp;
                                </fieldset>
                                <!-- si selecciona SÍ en Alcoholismo, se debe habilitar el siguiente select:-->
                                <div class="col-md-3">
                                    <strong>Recurrencia:</strong>
                                    <select name="recurrencia" id="recurrencia" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="social">Social</option>
                                        <option value="embriaguez">Embriaguez</option>
                                    </select>
                                </div>

                                <fieldset class="col-md-3">
                                    <strong>VPH</strong>
                                    <br>
                                    <input type="radio" name="vph" id="vph1" class="check" value="si">&nbsp;Sí&nbsp;&nbsp;
                                    <input type="radio" name="vph" id="vph2" class="check" value="no">&nbsp;No&nbsp;&nbsp;
                                </fieldset>

                                <fieldset class="col-md-3">
                                    <strong>VIH</strong>
                                    <br>
                                    <input type="radio" name="vih" id="vih1" class="check" value="si">&nbsp;Sí&nbsp;&nbsp;
                                    <input type="radio" name="vih" id="vih2" class="check" value="no">&nbsp;No&nbsp;&nbsp;
                                </fieldset>

                                <fieldset class="col-md-3">
                                    <strong>Epstein Barr</strong>
                                    <br>
                                    <input type="radio" name="epsteinbarr" id="epsteinbarr1" class="check" value="si">&nbsp;Sí&nbsp;&nbsp;
                                    <input type="radio" name="epsteinbarr" id="epsteinbarr2" class="check" value="no">&nbsp;No&nbsp;&nbsp;
                                </fieldset>

                                <div class="col-md-3" id="otrasadicciones">
                                    <strong>Otras adicciones:</strong>
                                    <input id="otrasadicciones" name="otrasadicciones" type="text" class="form-control" value="" required>
                                </div>
                                <!--Finaliza la sección de Antecedentes Personales Patológicos-->






                                <!--Inicia la sección de AFECTACIONES ORALES-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; color:aliceblue; background-color:#e64f6c; margin-top: 5px; font-size: 18px; ">
                                    AFECTACIONES ORALES
                                </div>


                                <div class="col-md-6">
                                    <strong>Afectación dental:</strong>
                                    <select name="recurrencia" id="recurrencia" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="pf">Protesis Fracturada</option>
                                        <option value="pd">Protesis Desajustada</option>
                                        <option value="ic">Irritación Crónica</option>
                                    </select>
                                </div>

                                <!--Si selecciona Irritación crónica se deben habilitar los siguientes 4 select múltiples, uno por cada maxilar-->


                                <!--Inicia la sección de AFECTACIONES ORALES-->

                                <div class="form-title" style="text-align: center; color:aliceblue; background-color:#eb768d; margin-top: 10px; font-size: 12px; ">
                                    ÓRGANO DENTAL FRACTURADO
                                </div>



                                <!-- Maxilar Superior Derecho -->
                                <div class="col-md-3">
                                    <strong>Maxilar Superior Derecho</strong>
                                    <!-- En el select se deben reemplazar los datos de la tabla 'antecedentescancer' por los siguientes datos,
                                        también debe considerarse que es un múltiple select:
                                            11,
                                            12,
                                            13,
                                            14,
                                            15,
                                            16,
                                            17,
                                            18
                                        -->
                                    <select id="mscancer" name="mscancer[]" multiple="multiple" class="form-control">
                                        <?php
                                        $query = $conexionCancer->prepare("SELECT relacion FROM antecedentescancer");
                                        $query->execute();
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['relacion']; ?>">
                                                <?php echo $row['relacion']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- Máxilar Inferior Derecho -->
                                <!-- Debe ser un select múltiple, se deben reemplazar los datos de la tabla 'antecedentescancer' por los siguientes datos:
                                            41,
                                            42,
                                            43,
                                            44,
                                            45,
                                            46,
                                            47,
                                            48
                                        -->
                                <div class="col-md-3" id="maxilarinferiorderecho">
                                    <strong>Maxilar Inferior Derecho:</strong>
                                    <input id="maxilarinferiorderecho" name="maxilarinferiorderecho" type="text" class="form-control" value="" required>
                                </div>

                                <!-- Maxilar Superior Izquierdo -->
                                <!-- En el select se deben reemplazar los datos de la tabla 'antecedentescancer' por los siguientes datos:
                                            21,
                                            22,
                                            23,
                                            24,
                                            25,
                                            26,
                                            27,
                                            28
                                        -->
                                <div class="col-md-3" id="maxilarsuperiorderecho">
                                    <strong>Maxilar Superior Izquierdo:</strong>
                                    <input id="maxilarsuperiorderecho" name="maxilarsuperiorderecho" type="text" class="form-control" value="" required>
                                </div>

                                <!-- Maxilar Inferior Izquierdo -->
                                <!-- En el select se deben reemplazar los datos de la tabla 'antecedentescancer' por los siguientes datos:
                                            31,
                                            32,
                                            33,
                                            34,
                                            35,
                                            36,
                                            37,
                                            38
                                        -->
                                <div class="col-md-3" id="maxilarinferiorizquierdo">
                                    <strong>Maxilar Inferior Izquierdo:</strong>
                                    <input id="maxilarinferiorizquierdo" name="maxilarinferiorizquierdo" type="text" class="form-control" value="" required>
                                </div>
                                <!--Finaliza sección de Órgano dental fracturado-->


                                <!--continua el formulario de Afectaciones orales-->
                                <div class="form-title" style="text-align: center; color:aliceblue; background-color:#eb768d; margin-top: 10px; font-size: 12px;"> ...
                                </div>

                                <div class="col-md-4">
                                    <strong>Lesiones Orales:</strong>
                                    <select name="lesionesorales" id="lesionesorales" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="si">Sí</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>

                                <!--Si se selecciona Sí se habilitan:-->
                                <div class="col-md-4">
                                    <strong>Tipo de Tejido:</strong>
                                    <select name="tipotejido" id="tipotejido" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="duro">Duro</option>
                                        <option value="blando">Blando</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Tipo de Lesión:</strong>
                                    <select name="tipolesion" id="tipolesion" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="nodulo">Duro</option>
                                        <option value="tumor">Tumor</option>
                                        <option value="pigmentada">Pigmentada</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opción Pigmentada, se debe habilitar el siguiente select-->
                                <div class="col-md-4">
                                    <strong>Tipo Pigmentación:</strong>
                                    <select name="tipopigmentacion" id="tipopigmentacion" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="blanca">Blanca</option>
                                        <option value="roja">Roja</option>
                                        <option value="blancaroja">Blanca/Roja</option>
                                    </select>
                                </div>



















                                <div class="col-md-2">
                                    <strong>Menarca</strong>
                                    <input type="text" class="control form-control" id="menarca" name="menarca">

                                </div>
                                <div class="col-md-3">
                                    <strong>Ultima menstruación</strong>
                                    <input type="date" class="control control col-md-12" id="fechaultimamestruacion" name="fechaultimamestruacion" onblur="calcularmestruacion();">

                                </div>
                                <div class="col-md-3" id="menopauperimenopau">
                                    <strong>Cuenta con:</strong>
                                    <input type="text" class="control control col-md-12" id="menopausea" name="menopausea" readonly>

                                </div>

                                <div class="col-md-2">
                                    <strong>Gestas</strong>
                                    <select name="gestas" id="gestas" class="control control col-md-12">
                                        <option value="0">Ninguna</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>

                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <strong>Paras</strong>
                                    <input type="number" class="control form-control" id="parto" name="parto">

                                </div>
                                <div class="col-md-2">
                                    <strong>Aborto</strong>
                                    <input type="number" class="control form-control" id="aborto" onblur="validaparto();" name="aborto">

                                </div>
                                <div class="col-md-2">
                                    <strong>Cesarea</strong>
                                    <input type="number" class="control control col-md-12" id="cesarea" onblur="validaparto();" name="cesarea">

                                </div>
                                <div class="col-md-2">
                                    <strong>Esta embarazada</strong>
                                    <select name="embarazada" id="embarazada" class="control control col-md-12">
                                        <option value="0">Seleccione</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>


                                    </select>
                                </div>
                                <div class="col-md-2" id="probableparto">
                                    <strong>F.P.P</strong>
                                    <input type="date" class="control control col-md-12" id="fechaprobableparto" name="fechaprobableparto" value="0000/00/00">

                                </div>
                                <div class="col-md-4">
                                    <strong>Terapia de remplazo hormonal</strong>
                                    <select name="planificacionfamiliar" id="planificacionfamiliar" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="si">si</option>
                                        <option value="no">no</option>

                                    </select>
                                </div>

                                <div class="col-md-2" id="tipolactancia">
                                    <strong>Lactancia</strong>
                                    <select name="lactancia" id="lactancia" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>

                                    </select>
                                </div>
                                <div class="col-md-2" id="tiempodelactancia">
                                    <strong>Tiempo</strong>
                                    <input type="text" class="control control col-md-12" id="tiempolactancia" name="tiempolactancia">

                                </div>

                                <div class="col-md-12" style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                    <strong id="titulos">ANTECEDENTES PERSONALES PATOLOGICOS</strong>
                                </div>
                                <div class="col-md-12">
                                    <strong>Antecedentes</strong>
                                    <select id="mspato" name="check_listapato[]" multiple="multiple" class="control control col-md-12">

                                        <?php
                                        $query = $conexionCancer->prepare("SELECT descripcionantecedente FROM antecedentespersonalespatologicos");
                                        $query->execute();
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionantecedente']; ?>">
                                                <?php echo $row['descripcionantecedente']; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <!--
                                    <fieldset class="col-md-12">

                                        <input type="checkbox" name="check_listapato[]" id="check_listapato[]"
                                            class="check" value="Tabaquismo">&nbsp;Tabaquismo&nbsp;&nbsp;
                                        <input type="checkbox" name="check_listapato[]" id="check_listapato[]"
                                            class="check" value="Hipertencion Arterial">&nbsp;Hipertensión
                                        Arterial&nbsp;&nbsp;
                                        <input type="checkbox" name="check_listapato[]" id="check_listapato[]"
                                            class="check" value="Enfermedad Renal Cronica">&nbsp;Enfermedad Renal
                                        Cronica&nbsp;&nbsp;
                                        <input type="checkbox" name="check_listapato[]" id="check_listapato[]"
                                            class="check" value="Diabetes Mellitus">&nbsp;Diabetes Mellitus&nbsp;&nbsp;
                                        <input type="checkbox" name="check_listapato[]" id="check_listapato[]"
                                            class="check" value="Conocida con Gen BRCA 1">&nbsp;Conocida con Gen BRCA
                                        1&nbsp;&nbsp;
                                        <input type="checkbox" name="check_listapato[]" id="check_listapato[]"
                                            class="check" value="Conocida con Gen BRCA 2">&nbsp;Conocida con Gen BRCA
                                        2&nbsp;&nbsp;

                                    </fieldset>
                                    -->
                                <div class="col-md-12" style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                    <strong id="titulos">ATENCIÓN CLINICA</strong>
                                </div>

                                <div class="col-md-3">
                                    <strong>Fecha primer atencion</strong>
                                    <input type="date" id="fechaatencioninicial" name="fechaatencioninicial" class="control control col-md-12">
                                </div>
                                <div class="col-md-3">
                                    <strong>BIRADS de referencia</strong>
                                    <select name="biradsreferencia" id="biradsreferencia" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <?php
                                        $query = $conexionCancer->prepare("SELECT descripcionbrad FROM birads_atencion_inicial");
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        $query->execute();
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionbrad']; ?>">
                                                <?php echo $row['descripcionbrad']; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <strong>BIRADS HRAEI</strong>
                                    <select name="biradshraei" id="biradshraei" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <?php
                                        $query = $conexionCancer->prepare("SELECT descripcionbrad FROM birads_atencion_inicial");
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        $query->execute();
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionbrad']; ?>">
                                                <?php echo $row['descripcionbrad']; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="col-md-3" id="lateralidadinicio">
                                    <strong>Lateralidad</strong>
                                    <select name="lateralidadprimero" id="lateralidadprimero" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Derecha">Derecha</option>
                                        <option value="Izquierda">Izquierda</option>
                                        <option value="Bilateral">Bilateral</option>

                                    </select>
                                </div>
                                <div class="col-md-4" id="lateralidadinicio">
                                    <strong>Estadio clinico</strong>
                                    <select name="estadioclinico" id="estadioclinico" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="0">0</option>
                                        <option value="I">I</option>
                                        <option value="II A">II A</option>
                                        <option value="II B">II B</option>
                                        <option value="III A">III A</option>
                                        <option value="III B">III B</option>
                                        <option value="III C">III C</option>
                                        <option value="IV">IV</option>


                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <strong>Etapa clinica</strong>
                                    <select name="etapasclinicas" id="etapasclinicas" class="control control col-md-12" readonly>
                                        <option value="TNM" selected>TNM</option>

                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <strong>Tamaño tumoral</strong>
                                    <select name="tamaniotumoral" id="tamaniotumoral" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <?php
                                        $query = $conexionCancer->prepare("SELECT descripcion_size_tumoral FROM size_tumoral");
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        $query->execute();
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcion_size_tumoral']; ?>">
                                                <?php echo $row['descripcion_size_tumoral']; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Compromiso linfatico nodal</strong>
                                    <select name="linfaticonodal" id="linfaticonodal" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <?php
                                        $query = $conexionCancer->prepare("SELECT descripcion_linfatico_nodal FROM compromiso_linfatico_nodal");
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        $query->execute();
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcion_linfatico_nodal']; ?>">
                                                <?php echo $row['descripcion_linfatico_nodal']; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <strong>Metastasis</strong>
                                    <select name="metastasis" id="metastasis" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="MX: No se pueden evaluar metastasis distantes">MX: No se pueden evaluar metastasis distante</option>
                                        <option value="M0 Sin enfermedad a distancia">M0 Sin enfermedad a distancia</option>
                                        <option value="M1 Con enfermedad metastasica">M1 Con enfermedad metastasica</option>


                                    </select>
                                </div>
                                <div class="col-md-4" id="metastasissitio">
                                    <strong>Sitio de metastasis</strong>
                                    <select name="sitiometastasis[]" id="sitiometastasis2" multiple="multiple" class="category control col-md-12">

                                        <?php
                                        $query = $conexionCancer->prepare("SELECT descripcionsitiometastasis FROM sitiometastasis");
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        $query->execute();
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionsitiometastasis']; ?>">
                                                <?php echo $row['descripcionsitiometastasis']; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="col-md-4" id="etapas">
                                    <strong>Clasificación etapas</strong>
                                    <select name="clasificaciondeetapas" id="clasificaciondeetapas" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <?php
                                        $query = $conexionCancer->prepare("SELECT etapaclasificacion FROM clasificacionetapas");
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        $query->execute();
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['etapaclasificacion']; ?>">
                                                <?php echo $row['etapaclasificacion']; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Calidad de vida ECOG</strong>
                                    <select name="calidaddevidaecog" id="calidaddevidaecog" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <?php
                                        $query = $conexionCancer->prepare("SELECT descripcionecog FROM calidadvidaecog");
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        $query->execute();
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionecog']; ?>">
                                                <?php echo $row['descripcionecog']; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <strong>Mastectomia Extrainstitucional</strong>
                                    <select name="mastectomiaextrainstitucional" id="mastectomiaextrainstitucional" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-4" id="mstectoextra1">
                                    <strong>Lateralidad Mastectomia</strong>
                                    <select name="lateralidadextrainstitucional" id="lateralidadextrainstitucional" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Mama Derecha">Mama Derecha</option>
                                        <option value="Mama Izquierda">Mama Izquierda</option>
                                        <option value="Ambas Mamas">Ambas Mamas</option>
                                    </select>
                                </div>
                                <div class="col-md-4" id="mstectoextra2">
                                    <strong>Fecha de mastectomia extrainstitucional</strong>
                                    <input type="date" class="control control col-md-12" id="fechamastectoextra" name="fechamastectoextra">

                                </div>
                                <div class="col-md-12" style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                    <strong id="titulos">HISTOPATOLOGIA</strong>
                                </div>
                                <div class="col-md-12">
                                    <strong>Seleccione la mama</strong>
                                    <select name="mamaseleccion[]" multiple="multiple" id="mamaseleccion" class="control control col-md-12">
                                        <option value="Mama Derecha">Mama Derecha</option>
                                        <option value="Mama Izquierda">Mama Izquierda</option>
                                    </select>
                                </div>
                                <!--inicia mama derecha-->
                                <div class="col-md-12" id="titulomamaderecha" style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                    <strong id="titulos">mama derecha</strong>
                                </div>
                                <div class="col-md-4" id="dxhisto">
                                    <strong>Dx histopatologico MMD</strong>
                                    <select name="dxhistopatologico" id="dxhistopatologico" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <?php
                                        $query = $conexionCancer->prepare("SELECT descripcion_dx_histopalogico FROM dxhistopalogico");
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        $query->execute();
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcion_dx_histopalogico']; ?>">
                                                <?php echo $row['descripcion_dx_histopalogico']; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="col-md-4" id="fechadx">
                                    <strong>Fecha dx histopatologico MMD</strong>
                                    <input type="date" id="fechadxhistopatologico" name="fechadxhistopatologico" class="control control col-md-12">
                                </div>
                                <div class="col-md-4" id="nothin">
                                    <strong>Nottinghan MMD</strong>
                                    <select name="nottingham" id="nottingham" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Grado I Bien diferenciado">Grado I Bien diferenciado</option>
                                        <option value="Grado II Moderadamente diferenciado">Grado II Moderadamente diferenciado</option>
                                        <option value="Grado III Escasamente diferenciado">Grado III Escasamente diferenciado</option>


                                    </select>
                                </div>
                                <div class="col-md-12" id="escala">
                                    <strong>Escala SBR (SCARLET-BLOOM-RICHARDSON) MMD</strong>
                                    <select name="escalasbr" id="escalasbr" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <?php
                                        $query = $conexionCancer->prepare("SELECT descripcionescalasbr FROM escalasbr");
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        $query->execute();
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionescalasbr']; ?>">
                                                <?php echo $row['descripcionescalasbr']; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <!--finaliza mama derecha-->
                                <!--inicia mama izquierda-->
                                <div class="col-md-12" id="titulomamaizquierda" style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                    <strong id="titulos">mama izquierda</strong>
                                </div>
                                <div class="col-md-4" id="dxhistoiz">
                                    <strong>Dx histopatologico MMI</strong>
                                    <select name="dxhistopatologicoiz" id="dxhistopatologicoiz" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <?php
                                        $query = $conexionCancer->prepare("SELECT descripcion_dx_histopalogico FROM dxhistopalogico");
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        $query->execute();
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcion_dx_histopalogico']; ?>">
                                                <?php echo $row['descripcion_dx_histopalogico']; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="col-md-4" id="fechadxiz">
                                    <strong>Fecha dx histopatologico MMI</strong>
                                    <input type="date" id="fechadxhistopatologicoiz" name="fechadxhistopatologicoiz" class="control control col-md-12">
                                </div>
                                <div class="col-md-4" id="nothiniz">
                                    <strong>Nottinghan MMI</strong>
                                    <select name="nottinghamiz" id="nottinghamiz" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Grado I Bien diferenciado">Grado I Bien diferenciado</option>
                                        <option value="Grado II Moderadamente diferenciado">Grado II Moderadamente diferenciado</option>
                                        <option value="Grado III Escasamente diferenciado">Grado III Escasamente diferenciado</option>


                                    </select>
                                </div>
                                <div class="col-md-12" id="escalaiz">
                                    <strong>Escala SBR (SCARLET-BLOOM-RICHARDSON) MMI</strong>
                                    <select name="escalasbriz" id="escalasbriz" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <?php
                                        $query = $conexionCancer->prepare("SELECT descripcionescalasbr FROM escalasbr");
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        $query->execute();
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionescalasbr']; ?>">
                                                <?php echo $row['descripcionescalasbr']; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <!--finaliza mama izquierda -->
                                <!--inicia mama derecha inmuno-->
                                <div class="col-md-12" style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                    <strong id="titulos">INMUNOHISTOQUIMICA</strong>
                                </div>
                                <div class="col-md-12">
                                    <strong>Seleccione la mama</strong>
                                    <select name="mamaseleccioninmuno[]" multiple="multiple" id="mamaseleccioninmuno" class="control control col-md-12">
                                        <option value="Mama Derecha">Mama Derecha</option>
                                        <option value="Mama Izquierda">Mama Izquierda</option>
                                    </select>
                                </div>

                                <div class="col-md-12" id="tituloinmunomamaderecha" style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                    <strong id="titulos">Mama derecha</strong>
                                </div>
                                <div class="col-md-4">

                                    <div class="input-group pull-left" id="inmunoderecha1">
                                        <strong>Receptores de estrogenos (RE)</strong>
                                        <input type="number" id="receptoresestrogenos" name="receptoresestrogenos" placeholder="%" class="control control col-md-12">
                                    </div>
                                </div>
                                <div class="col-md-4" id="inmunoderecha2">
                                    <div class="input-group pull-left">
                                        <strong>Receptores de progesterona (RP)</strong>
                                        <input type="number" id="receptoresprogesterona" name="receptoresprogesterona" placeholder="%" class="control control col-md-12">
                                    </div>
                                </div>
                                <div class="col-md-2" id="inmunoderecha3">
                                    <div class="input-group pull-left">
                                        <strong>KI-67</strong>
                                        <input type="number" id="ki67" name="ki67" placeholder="%" class="control control col-md-12">
                                    </div>
                                </div>
                                <div class="col-md-2" id="inmunoderecha4">
                                    <div class="input-group pull-left">
                                        <strong>K</strong>
                                        <input type="number" id="k" name="k" placeholder="%" class="control control col-md-12">
                                    </div>
                                </div>
                                <div class="col-md-2" id="inmunoderecha5">
                                    <div class="input-group pull-left">
                                        <strong>P 53</strong>
                                        <select name="p53" id="p53" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2" id="inmunoderecha6">
                                    <div class="input-group pull-left">
                                        <strong>Triple negativo</strong>
                                        <select name="triplenegativo" id="triplenegativo" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                </div>
                                <fieldset class="col-md-2" id="inmunoderecha7">
                                    <strong>&nbsp;&nbsp;Se realizó PDL</strong><br>
                                    &nbsp;<strong>Si</strong>
                                    <input type="radio" name="pdlrealizo" id="pdlrealizo1" onclick="aplicopdlsi();" class="check" value="si">
                                    &nbsp;<strong>No</strong>
                                    <input type="radio" name="pdlrealizo" id="pdlrealizo2" onclick="aplicopdlno();" class="check" checked value="no">
                                </fieldset>
                                <div class="col-md-2" id="inmunoderecha8">
                                    <div class="input-group pull-left">
                                        <strong id="inmuno-title">PDL</strong>
                                        <input type="number" id="pdl" name="pdl" placeholder="%" class="control control col-md-12" value="0">
                                    </div>
                                </div>

                                <div class="col-md-2" id="inmunoderecha9">
                                    <div class="input-group pull-left">
                                        <strong>Oncogen HER2</strong>
                                        <select name="oncogen" id="oncogen" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Una cruz">+</option>
                                            <option value="Dos cruces">++</option>
                                            <option value="Tres cruces">+++</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2" id="inmunoderecha10">
                                    <div class="input-group pull-left">
                                        <strong>FISH</strong>
                                        <select name="fish" id="fish" class="control control col-md-12">
                                            <option value="0">Seleccione</option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>

                                        </select>
                                    </div>
                                </div>
                                <!--finaliza mama derecha inmuno-->
                                <!--inicia mama izquierda inmuno-->

                                <div class="col-md-12" id="tituloinmunomamaizquierda" style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                    <strong id="titulos">Mama izquierda</strong>
                                </div>
                                <div class="col-md-4">

                                    <div class="input-group pull-left" id="inmunoderechaiz1">
                                        <strong>Receptores de estrogenos (RE)</strong>
                                        <input type="number" id="receptoresestrogenosiz" name="receptoresestrogenosiz" placeholder="%" class="control control col-md-12">
                                    </div>
                                </div>
                                <div class="col-md-4" id="inmunoderechaiz2">
                                    <div class="input-group pull-left">
                                        <strong>Receptores de progesterona (RP)</strong>
                                        <input type="number" id="receptoresprogesteronaiz" name="receptoresprogesteronaiz" placeholder="%" class="control control col-md-12">
                                    </div>
                                </div>
                                <div class="col-md-2" id="inmunoderechaiz3">
                                    <div class="input-group pull-left">
                                        <strong>KI-67</strong>
                                        <input type="number" id="ki67iz" name="ki67iz" placeholder="%" class="control control col-md-12">
                                    </div>
                                </div>
                                <div class="col-md-2" id="inmunoderechaiz4">
                                    <div class="input-group pull-left">
                                        <strong>K</strong>
                                        <input type="number" id="kiz" name="kiz" placeholder="%" class="control control col-md-12">
                                    </div>
                                </div>
                                <div class="col-md-2" id="inmunoderechaiz5">
                                    <div class="input-group pull-left">
                                        <strong>P 53</strong>
                                        <select name="p53iz" id="p53iz" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2" id="inmunoderechaiz6">
                                    <div class="input-group pull-left">
                                        <strong>Triple negativo</strong>
                                        <select name="triplenegativoiz" id="triplenegativoiz" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                </div>
                                <fieldset class="col-md-2" id="inmunoderechaiz7">
                                    <strong>&nbsp;&nbsp;Se realizó PDL</strong><br>
                                    &nbsp;<strong>Si</strong>
                                    <input type="radio" name="pdlrealizoiz" id="pdlrealizo1iz" onclick="aplicopdlsi();" class="check" value="si">
                                    &nbsp;<strong>No</strong>
                                    <input type="radio" name="pdlrealizoiz" id="pdlrealizo2iz" onclick="aplicopdlno();" class="check" checked value="no">
                                </fieldset>
                                <div class="col-md-2" id="inmunoderechaiz8">
                                    <div class="input-group pull-left">
                                        <strong id="inmuno-title">PDL</strong>
                                        <input type="number" id="pdliz" name="pdliz" placeholder="%" class="control control col-md-12" value="0">
                                    </div>
                                </div>

                                <div class="col-md-2" id="inmunoderechaiz9">
                                    <div class="input-group pull-left">
                                        <strong>Oncogen HER2</strong>
                                        <select name="oncogeniz" id="oncogeniz" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Una cruz">+</option>
                                            <option value="Dos cruces">++</option>
                                            <option value="Tres cruces">+++</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2" id="inmunoderechaiz10">
                                    <div class="input-group pull-left">
                                        <strong>FISH</strong>
                                        <select name="fishiz" id="fishiz" class="control control col-md-12">
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>

                                        </select>
                                    </div>
                                </div>
                                <!--finaliza mama izquierda inmuno-->
                                <!--Inicia mama molecular derecha-->
                                <hr>
                                <div class="col-md-12" style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                    <strong id="titulos">MOLECULAR</strong>
                                </div>
                                <div class="col-md-12">
                                    <strong>Seleccione la mama</strong>
                                    <select name="mamaseleccionmolecular[]" multiple="multiple" id="mamaseleccionmolecular" class="control control col-md-12">
                                        <option value="Mama Derecha">Mama Derecha</option>
                                        <option value="Mama Izquierda">Mama Izquierda</option>
                                    </select>
                                </div>
                                <div class="col-md-12" id="titulomolecularmamaderecha" style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                    <strong id="titulos">Mama derecha</strong>
                                </div>
                                <div class="col-md-4" id="luminal1">
                                    <div class="input-group pull-left">
                                        <strong id="inmuno-title">Luminal A</strong>
                                        <input type="number" id="luminala" name="luminala" placeholder="%" class="control control col-md-12" value="0">
                                    </div>
                                </div>

                                <div class="col-md-4" id="luminal2">
                                    <div class="input-group pull-left">
                                        <strong id="inmuno-title">Luminal B</strong>
                                        <input type="number" id="luminalb" name="luminalb" placeholder="%" class="control control col-md-12" value="0">
                                    </div>
                                </div>
                                <div class="col-md-4" id="luminal3">
                                    <div class="input-group pull-left">
                                        <strong id="inmuno-title">Enriquecido en Her 2 +</strong>
                                        <input type="number" id="enriquecidoherdos" name="enriquecidoherdos" placeholder="%" class="control control col-md-12" value="0">
                                    </div>
                                </div>
                                <div class="col-md-4" id="luminal4">
                                    <div class="input-group pull-left">
                                        <strong id="inmuno-title">Basal</strong>
                                        <input type="number" id="basal" name="basal" placeholder="%" class="control control col-md-12" value="0">
                                    </div>
                                </div>
                                <!--Finaliza mama molecular derecha-->
                                <!--Inicia mama molecular izquierda-->
                                <div class="col-md-12" id="titulomolecularmamaizquierda" style="text-align: center; color: blueviolet; background-color:antiquewhite; margin-top: 5px; font-size: 0px;">
                                    <strong id="titulos">Mama izquierda</strong>
                                </div>
                                <div class="col-md-4" id="luminal5">
                                    <div class="input-group pull-left">
                                        <strong id="inmuno-title">Luminal A</strong>
                                        <input type="number" id="luminalaiz" name="luminalaiz" placeholder="%" class="control control col-md-12" value="0">
                                    </div>
                                </div>

                                <div class="col-md-4" id="luminal6">
                                    <div class="input-group pull-left">
                                        <strong id="inmuno-title">Luminal B</strong>
                                        <input type="number" id="luminalbiz" name="luminalbiz" placeholder="%" class="control control col-md-12" value="0">
                                    </div>
                                </div>
                                <div class="col-md-4" id="luminal7">
                                    <div class="input-group pull-left">
                                        <strong id="inmuno-title">Enriquecido en Her 2 +</strong>
                                        <input type="number" id="enriquecidoherdosiz" name="enriquecidoherdosiz" placeholder="%" class="control control col-md-12" value="0">
                                    </div>
                                </div>
                                <div class="col-md-4" id="luminal8">
                                    <div class="input-group pull-left">
                                        <strong id="inmuno-title">Basal</strong>
                                        <input type="number" id="basaliz" name="basaliz" placeholder="%" class="control control col-md-12" value="0">
                                    </div>
                                </div>
                                <!--Finaliza mama molecular izquierda-->
                                <hr>
                                <div class="col-md-12" style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                    <strong id="titulos">TRATAMIENTO</strong>
                                </div>
                                <div class="col-md-3" style="color: #BD9FD6; ">
                                    <strong>QUIRURGICO</strong>
                                    <select name="quirurgico" id="quirurgico" class="control control col-md-12">
                                        <option value="0">Seleccione</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>

                                    </select>
                                </div>
                                <div class="col-md-3" id="lateralidad">
                                    <strong>Lateralidad Qx</strong>
                                    <select name="lateralidadsegundo" id="lateralidadsegundo" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Derecha">Derecha</option>
                                        <option value="Izquierda">Izquierda</option>
                                        <option value="Bilateral">Bilateral</option>

                                    </select>
                                </div>
                                <div class="col-md-3" id="tipoquirurgico">
                                    <strong>Tipo</strong>
                                    <select name="quirurgicotipo" id="quirurgicotipo" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Mastectomia">Mastectomia</option>
                                        <option value="Ganglionar">Ganglionar</option>

                                    </select>
                                </div>

                                <div class="col-md-3" id="tipomastectomia">
                                    <strong>Tipo de mastectomia</strong>
                                    <select name="mastectomiatipo" id="mastectomiatipo" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Mastectomia total">Mastectomia total</option>
                                        <option value="Mastectomia conservadora">Mastectomia conservadora</option>
                                        <option value="Mastectomia paliativa">Mastectomia paliativa</option>

                                    </select>
                                </div>
                                <div class="col-md-3" id="tipoganglionar">
                                    <strong>Tipo de ganglionar</strong>
                                    <select name="ganglionartipo" id="ganglionartipo" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="GANGLIO CENTINELA">GANGLIO CENTINELA</option>
                                        <option value="DISECCION AXILAR">DISECCION AXILAR</option>

                                    </select>
                                </div>
                                <div class="col-md-3" id="fechatipomastectomia">
                                    <strong>Fecha</strong>
                                    <input type="date" id="fechatipomastecto" name="fechatipomastecto" class="control control col-md-12">
                                </div>
                                <div class="col-md-3" id="fechatipoganglionar">
                                    <strong>Fecha</strong>
                                    <input type="date" id="fechatipoganglio" name="fechatipoganglio" class="control control col-md-12">
                                </div>
                                <div class="col-md-3" id="reconstruccion">
                                    <strong>Reconstruccion</strong>
                                    <select name="reconstruccionsino" id="reconstruccionsino" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>

                                    </select>
                                </div>
                                <div class="col-md-3" id="tiporeconstruccion">
                                    <strong>Tipo</strong>
                                    <select name="reconstrucciontipo" id="reconstrucciontipo" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Expansor tisular">Expansor tisular</option>
                                        <option value="Implante mamario">Implante mamario</option>
                                        <option value="Colgajo">Colgajo</option>

                                    </select>
                                </div>

                                <div class="col-md-3" id="reconstrucciontipofecha">
                                    <strong>Fecha</strong>
                                    <input type="date" id="fechatiporeconstruccion" name="fechatiporeconstruccion" class="control control col-md-12">
                                </div>
                                <div class="col-md-12"></div>
                                <input type="button" name="enviar" value="Guardar Tratamiento" onclick="Hola();" id="guardaApartado" style="width: 170px; height: 27px; font-size: 12px; color: white; background-color: #00B6FF; margin-left: auto; margin-right: auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                                <script>
                                    function Hola() {

                                        if ($('input[name=curp]').val().length == 0 || $('input[name=nombrecompleto]')
                                            .val().length == 0 || $('select[name=cbx_estado]').val().length == 0) {
                                            swal({
                                                title: 'Hooho error!',
                                                text: 'Ingresa los datos requeridos!',
                                                icon: 'warning',

                                            });

                                            return false;
                                        }
                                        let quirurgico = $("#quirurgico").val();
                                        let lateralidadsegundo = $("#lateralidadsegundo").val();
                                        let quirurgicotipo = $("#quirurgicotipo").val();
                                        let curp = $("#curp").val();
                                        let mastectomiatipo = $("#mastectomiatipo").val();
                                        let fechatipomastecto = $("#fechatipomastecto").val();
                                        let ganglionartipo = $("#ganglionartipo").val();
                                        let fechatipoganglio = $("#fechatipoganglio").val();
                                        let reconstruccionsino = $("#reconstruccionsino").val();
                                        let reconstrucciontipo = $("#reconstrucciontipo").val();
                                        let fechatiporeconstruccion = $("#fechatiporeconstruccion").val();

                                        let parametros = {
                                            quirurgico: quirurgico,
                                            lateralidadsegundo: lateralidadsegundo,
                                            quirurgicotipo: quirurgicotipo,
                                            curp: curp,
                                            mastectomiatipo: mastectomiatipo,
                                            fechatipomastecto: fechatipomastecto,
                                            ganglionartipo: ganglionartipo,
                                            fechatipoganglio: fechatipoganglio,
                                            reconstruccionsino: reconstruccionsino,
                                            reconstrucciontipo: reconstrucciontipo,
                                            fechatiporeconstruccion: fechatiporeconstruccion
                                        }
                                        $.ajax({
                                            data: parametros,
                                            url: 'aplicacion/procesoAjax.php',
                                            type: 'post',
                                            beforeSend: function() {
                                                $("#mensaje").html("Procesando, espere por favor");
                                            },
                                            success: function(response) {
                                                $("#mensaje").html(response);
                                            }
                                        });
                                    }
                                </script>

                                <div class="col-md-12" style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                    <strong id="titulos">QUIMIOTERAPIA</strong>
                                </div>
                                <div class="col-md-3" style="color: #BD9FD6;">
                                    <strong>QUIMIOTERAPIA</strong>
                                    <select name="aplicoquimio" id="aplicoquimio" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>

                                    </select>
                                </div>
                                <div class="col-md-3" id="fechainicioquimio">
                                    <strong>Fecha inicio</strong>
                                    <input type="date" id="fechadeinicioquimio" name="fechadeinicioquimio" class="control control col-md-12">
                                </div>
                                <div class="col-md-3" id="atracicilassi">
                                    <strong>Antraciclinas</strong>
                                    <select name="antraciclinas" id="antraciclinas" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <?php
                                        $query = $conexionCancer->prepare("SELECT descripcion FROM atraciclina");
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        $query->execute();
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcion']; ?>">
                                                <?php echo $row['descripcion']; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="col-md-3" id="quimiomomento">
                                    <strong>Momento de la QT</strong>
                                    <select name="momentoquimio" id="momentoquimio" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Neoadyuvante">Neoadyuvante</option>
                                        <option value="Coadyuvante">Coadyuvante</option>
                                        <option value="Paliativo">Paliativo</option>
                                    </select>
                                </div>
                                <fieldset class="col-md-2" id="quimiono">
                                    <strong>HER 2 ++</strong><br>
                                    <input type="radio" name="her" id="her1" onclick="aplicoher();" class="check" value="si">&nbsp;<strong>Si</strong>&nbsp;&nbsp;
                                    <input type="radio" name="her" id="her2" onclick="aplicoherno();" class="check" checked value="noaplico">&nbsp;<strong>No</strong>&nbsp;&nbsp;
                                </fieldset>
                                <div class="col-md-3" id="esquemaher">
                                    <strong style="color:red;">Esquema HER 2 ++</strong>
                                    <select name="esquemaherdos" id="esquemaherdos" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="TRASTUZUMAB/PERTUZUMAB">TRASTUZUMAB/PERTUZUMAB</option>
                                        <option value="TRASTUZUMAB/EMTANSINA">TRASTUZUMAB/EMTANSINA</option>
                                    </select>
                                </div>
                                <fieldset class="col-md-2" id="quimiono2">
                                    <strong>Triple negativo</strong><br>
                                    <input type="radio" name="triplenegativo" id="triplenegativo1" onclick="triplesi();" class="check" value="si">&nbsp;<strong>Si</strong>&nbsp;&nbsp;
                                    <input type="radio" name="triplenegativo" id="triplenegativo2" onclick="tripleno();" class="check" checked value="no">&nbsp;<strong>No</strong>&nbsp;&nbsp;
                                </fieldset>
                                <div class="col-md-3" id="tripleesquema">
                                    <strong style="color:red;">Esquema triple negativo</strong>
                                    <select name="esquematriple" id="esquematriple" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="ATEZOLIZUMAB">ATEZOLIZUMAB</option>
                                        <option value="PEMBROLIZUMAB">PEMBROLIZUMAB</option>
                                        <option value="OLAPARIB">OLAPARIB</option>
                                    </select>
                                </div>
                                <fieldset class="col-md-2" id="quimiono3">
                                    <strong>Hormonosensible</strong><br>
                                    <input type="radio" name="hormonosensibles" id="hormonosensibles1" onclick="hormonosi();" class="check" value="si">&nbsp;<strong>Si</strong>&nbsp;&nbsp;
                                    <input type="radio" name="hormonosensibles" id="hormonosensibles2" onclick="hormonono();" class="check" checked value="no">&nbsp;<strong>No</strong>&nbsp;&nbsp;
                                </fieldset>
                                <div class="col-md-3" id="hormonoesquema">
                                    <strong style="color:red;">Esquema hormonosensible</strong>
                                    <select name="esquemahormonosensible" id="esquemahormonosensible" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="PALBOCICLIB">PALBOCICLIB</option>
                                        <option value="RIBOCICLIB">RIBOCICLIB</option>
                                        <option value="ABEMACICLIB">ABEMACICLIB</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="quimiono4">
                                    <strong>Tipo de tratamiento</strong>
                                    <select name="tipotratamiento" id="tipotratamiento" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Adyuvante">Adyuvante</option>
                                        <option value="Coadyuvante">Coadyuvante</option>
                                        <option value="Paliativo">Paliativo</option>
                                    </select>
                                </div>
                                <fieldset class="col-md-2" id="quimiono5">
                                    <strong>Completo quimio</strong><br>
                                    <input type="radio" name="completoquimio" id="completoquimio1" onclick="quimiocompletosi();" class="check" checked value="si">&nbsp;<strong>Si</strong>&nbsp;&nbsp;
                                    <input type="radio" name="completoquimio" id="completoquimio2" onclick="quimiocompletono();" class="check" value="no">&nbsp;<strong>No</strong>&nbsp;&nbsp;
                                </fieldset>
                                <div class="col-md-4" id="esquemaquimio">
                                    <strong style="color:red;">Causa QT incompleta</strong>
                                    <select name="quimioesquema" id="quimioesquema" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="EVENTO ADVERSO">EVENTO ADVERSO</option>
                                        <option value="PROGRESION DE LA ENFERMEDAD">PROGRESION DE LA ENFERMEDAD
                                        </option>
                                        <option value="RECURRENCIA DE LA ENFERMEDAD">RECURRENCIA DE LA ENFERMEDAD
                                        </option>
                                        <option value="ABANDONO DEL PACIENTE">ABANDONO DEL PACIENTE</option>
                                        <option value="FALLECIO">FALLECIO</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="eventoadverso">
                                    <strong style="color:red;">Fecha evento adverso</strong>
                                    <input type="date" id="fechaeventoadverso" name="fechaeventoadverso" class="control control col-md-12">
                                </div>
                                <div class="col-md-3" id="eventoprogresivo">
                                    <strong style="color:red;">Fecha progresion</strong>
                                    <input type="date" id="fechaprogresion" name="fechaprogresion" class="control control col-md-12">
                                </div>
                                <div class="col-md-3" id="eventorecurrencia">
                                    <strong style="color:red;">Fecha recurrencia</strong>
                                    <input type="date" id="fecharecurrencia" name="fecharecurrencia" class="control control col-md-12">
                                </div>
                                <div class="col-md-3" id="eventodefuncion">
                                    <strong style="color:red;">Fecha fallecio</strong>
                                    <input type="date" id="fechadefuncion" name="fechadefuncion" class="control control col-md-12">
                                </div>
                                <div class="col-md-3" id="causaonco">
                                    <strong style="color:red;">Causa</strong>
                                    <select name="otracausa" id="otracausa" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="ONCOLOGICA">ONCOLOGICA</option>
                                        <option value="EVENTO ADVERSO">EVENTO ADVERSO</option>
                                        <option value="OTRA">OTRA</option>
                                    </select>
                                </div>
                                <div class="col-md-6" id="especausa">
                                    <strong style="color:red;">Especifique</strong>
                                    <input type="text" id="especifiquecausa" name="especifiquecausa" class="control control col-md-12">
                                </div>

                                <div class="col-md-12" style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                    <strong id="titulos">RADIOTERAPIA</strong>
                                </div>
                                <div class="col-md-3" style="color: #BD9FD6; ">
                                    <strong>RADIOTERAPIA</strong>
                                    <select name="radioterapia" id="radioterapia" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="seaplicoradio">
                                    <strong>Tipo Radioterapia</strong>
                                    <select name="aplicoradioterapia" id="aplicoradioterapia" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="CICLO MAMARIO COMPLETO">CICLO MAMARIO COMPLETO</option>
                                        <option value="TANGENCIAL">TANGENCIAL</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="fechadelaradio">
                                    <strong>Fecha de inicio</strong>
                                    <input type="date" id="fechainicioradio" name="fechainicioradio" class="control control col-md-12">
                                </div>
                                <div class="col-md-3" id="sesionescantidad">
                                    <strong>N° de sesiones</strong>
                                    <input type="number" id="numerosesiones" name="numerosesiones" class="control control col-md-12">
                                </div>
                                <div class="col-md-12" style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                    <strong id="titulos">BRAQUITERAPIA</strong>
                                </div>
                                <div class="col-md-3" style="color: #BD9FD6; ">
                                    <strong>BRAQUITERAPIA</strong>
                                    <select name="braquiterapia" id="braquiterapia" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="fechabraquiterapia">
                                    <strong>Fecha braquiterapia</strong>
                                    <input type="date" id="fechadebraquiterapia" name="fechadebraquiterapia" class="control control col-md-12">
                                </div>

                                <div class="col-md-12" style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                    <strong id="titulos">DEFUNCIÓN</strong>
                                </div>

                                <fieldset class="col-md-2">
                                    <strong>Defunción</strong><br>
                                    &nbsp;<strong>Si</strong>
                                    <input type="radio" name="defunsi" id="defunsionsi" onclick="defusi();" class="check" value="si">
                                    &nbsp;<strong>No</strong>
                                    <input type="radio" name="defunsi" id="defunsionno" onclick="defuno();" class="check" value="no" checked>
                                </fieldset>
                                <div class="col-md-3" id="defuncionfecha">
                                    <strong>Fecha defunción</strong>
                                    <input type="date" name="fechadeladefuncion" id="fechadeladefuncion" class="control control col-md-12" value="0000/00/00">

                                </div>
                                <div class="col-md-3" id="defuncioncausa">

                                    <strong>Causa</strong>
                                    <select name="causadefuncion" id="causadefuncion" class="control control col-md-12">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Oncologica">Oncologica</option>
                                        <option value="No oncologica">No oncologica</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12"></div>
                            <br>


                            <input type="submit" id="registrar" value="Registrar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                            <input type="button" id="recargar" onclick="window.location.reload();" value="Cerrar formulario" style="width: 170px; height: 27px; color: white; background-color: #FA0000; float: left; margin-left: 5px; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">


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