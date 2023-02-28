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