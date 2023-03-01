<div id="seguimiento" class="modal fade" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="css/estilosMenu.css" rel="stylesheet">
    <!--URL para agregar el icon-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!--Finaliza url para agregar icon-->
    <script src="js/enviacurp.js"></script>
    <div class="modal-dialog">


        <!-- Cabecera del modal-->
        <div class="modal-content" style="width: 950px;
        height: auto;
        color:black;
        left: 50%;
        transform: translate(-50%); ">

            <div class="modal-header" id="cabeceraModalInfarto">
                <span class="material-symbols-outlined">
                    edit_note
                </span>

                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarformularioseguimiento();">&times;</button>
            </div>
            <!-- Finaliza Cabecera del modal-->


            <div class="modal-body">
                <div id="panel_editar">
                    <div class="contrato-nuevo">
                        <div class="modal-body">
                            <script>
                                $(window).load(function() {
                                    $(".loader").fadeOut("slow");
                                });

                                function limpiarformularioseguimiento() {

                                    setTimeout('document.formularioseguimientoinfarto.reset()', 1000);
                                    return false;
                                }
                            </script>




                            <!-- form start -->

                            <div class="col-md-12" style="text-align: center; 
                                color: white; 
                                background-color:#e16c70;">
                                <strong>SEGUIMIENTO DEL PACIENTE</strong>
                            </div>

                            <style>
                                #fecha,
                                #curp,
                                #nombrecompleto,
                                #edad {
                                    text-transform: uppercase;
                                }
                            </style>
                            <form name="formularioseguimientoinfarto" id="formularioseguimientoinfarto" onSubmit="return limpiar()">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                        $("#formularioseguimientoinfarto").on("submit", function(e) {
                                            let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                            e.preventDefault();

                                            var formData = new FormData(document.getElementById(
                                                "formularioseguimientoinfarto"));
                                            formData.append("dato", "valor");

                                            $.ajax({

                                                url: "aplicacion/registrarSeguimientoPaciente.php",
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
                                        var idcurp;

                                        function obtenerid() {

                                            var textoadjunto = document.getElementById("curps").value = idcurp;


                                        }
                                    </script>



                                    <input id="year" name="year" class="form-control" type="hidden" value="2022" required="required" onkeyup="mayus(this);" readonly>

                                    <div class="col-md-4">
                                        <strong>CURP:&nbsp;</strong>
                                        <input id="curps" name="curps" class="form-control" type="text" value="" readonly>
                                        <span id="curp" class="curp" name="curp"></span>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Seguimiento</strong>
                                        <select name="seguimiento" id="seguimiento" class="form-control" required onclick="obtenerid();">
                                            <option value="">Seleccione...</option>
                                            <option value="3 meses">Tres meses</option>
                                            <option value="6 meses">Seis meses</option>
                                            <option value="un anio">Un año</option>
                                        </select>
                                    </div>



                                    <script>
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
                                    </script>
                                    <!--<br>

                                    <div class="col-md-4">
                                        <strong>Disección</strong>
                                        <select name="diseccion" id="diseccion" class="form-control" style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php
                                            require 'conexionInfarto.php';
                                            $query = "SELECT * FROM diseccion ";
                                            $resultado = $conexion2->query($query);
                                            while ($row = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['descripcion']; ?>">
                                                    <?php echo $row['descripcion']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>-->


                                    <!--<div class="col-md-4">
                                        <strong>IAM Periprocedimiento</strong>
                                        <select name="iamperiprocedimiento" id="iamperiprocedimiento" class="form-control" style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php
                                            require 'conexionInfarto.php';
                                            $query = "SELECT * FROM iam_periprocedimiento ";
                                            $resultado = $conexion2->query($query);
                                            while ($row = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['nombre_aimperi']; ?>">
                                                    <?php echo $row['nombre_aimperi']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>-->


                                    <!--<div class="col-md-4">
                                        <strong>Complicaciones</strong>
                                        <select name="complicaciones" id="complicaciones" class="form-control" style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php
                                            require 'conexionInfarto.php';
                                            $query = "SELECT * FROM complicaciones ";
                                            $resultado = $conexion2->query($query);
                                            while ($row = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['nombre_compliacion']; ?>">
                                                    <?php echo $row['nombre_compliacion']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>-->


                                    <!--<div class="col-md-4">
                                        <strong>Flujo microvascular tmp</strong>
                                        <select name="flujomicrovasculartmp" id="flujomicrovasculartmp" class="form-control" style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php
                                            require 'conexionInfarto.php';
                                            $query = "SELECT * FROM flujo_microvascular_tmp ";
                                            $resultado = $conexion2->query($query);
                                            while ($row = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['nombre_flujo_microvascular']; ?>">
                                                    <?php echo $row['nombre_flujo_microvascular']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>-->


                                    <!--<div class="col-md-4">
                                        <strong>TIMI Final</strong>
                                        <select name="flujofinaltfg" id="flujofinaltfg" class="form-control" style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php
                                            require 'conexionInfarto.php';
                                            $query = "SELECT * FROM flujo_final_tfg ";
                                            $resultado = $conexion2->query($query);
                                            while ($row = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['nombre_flujo_final']; ?>">
                                                    <?php echo $row['nombre_flujo_final']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>-->



                                    <!--<div class="col-md-4">
                                        <strong>Trombosis definitiva</strong>
                                        <select name="trombosisdefinitiva" id="trombosisdefinitiva" class="form-control" style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php
                                            require 'conexionInfarto.php';
                                            $query = "SELECT * FROM trombosis_definitiva ";
                                            $resultado = $conexion2->query($query);
                                            while ($row = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['nombre_trombosis']; ?>">
                                                    <?php echo $row['nombre_trombosis']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>-->



                                    <!--<div class="col-md-4">
                                        <strong>Marca pasos temporal</strong>
                                        <select name="marcapasostemporal" id="marcapasostemporal" class="form-control" style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php
                                            require 'conexionInfarto.php';
                                            $query = "SELECT * FROM marcapasos_temporal ";
                                            $resultado = $conexion2->query($query);
                                            while ($row = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['descripcion']; ?>">
                                                    <?php echo $row['descripcion']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>-->



                                    <!--<div class="col-md-4">
                                        <strong>Estancia hospitalaria</strong>
                                        <textarea id="estanciahospitalaria" name="estanciahospitalaria" placeholder="Describa" class="form-control" onkeyup="mayus(this);" rows="2"></textarea>
                                    </div>-->



                                    <!--<div class="col-md-4">
                                        <strong>Reestentosis intrastent</strong>
                                        <select name="reesentosis" id="reesentosis" class="form-control" style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php
                                            require 'conexionInfarto.php';
                                            $query = "SELECT * FROM reestenosis_intrastent ";
                                            $resultado = $conexion2->query($query);
                                            while ($row = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['descripcion_resentosis']; ?>">
                                                    <?php echo $row['descripcion_resentosis']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>-->



                                    <!--<div class="col-md-4">
                                        <strong>Rehospitalización</strong>
                                        <select name="rehospitalizacion" id="rehospitalizacion" class="form-control" style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php
                                            require 'conexionInfarto.php';
                                            $query = "SELECT * FROM rehospitalacion_one_year ";
                                            $resultado = $conexion2->query($query);
                                            while ($row = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['descripcion_rehospi']; ?>">
                                                    <?php echo $row['descripcion_rehospi']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>-->



                                    <!--<div class="col-md-4">
                                        <strong>Escala de riesgo</strong>
                                        <select name="escaladeriesgo" id="escaladeriesgo" class="form-control" style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php
                                            require 'conexionInfarto.php';
                                            $query = "SELECT * FROM escalas_riesgo ";
                                            $resultado = $conexion2->query($query);
                                            while ($row = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['nombre_escala']; ?>">
                                                    <?php echo $row['nombre_escala']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>-->



                                    <!--<div class="col-md-4">
                                        <strong>IAM 3 años</strong>
                                        <select name="iamtresyears" id="iamtresyears" class="form-control" style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php
                                            require 'conexionInfarto.php';
                                            $query = "SELECT * FROM iam_tres_years ";
                                            $resultado = $conexion2->query($query);
                                            while ($row = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['descripcion_iam_tres_years']; ?>">
                                                    <?php echo $row['descripcion_iam_tres_years']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>-->


                                    <!--<div class="col-md-4">
                                        <strong>CRUC A LOS 3 AÑOS</strong>
                                        <select name="cruc" id="cruc" class="form-control" style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php
                                            require 'conexionInfarto.php';
                                            $query = "SELECT * FROM cruce_a_tres_years ";
                                            $resultado = $conexion2->query($query);
                                            while ($row = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['descripcion_cruce_tres_years']; ?>">
                                                    <?php echo $row['descripcion_cruce_tres_years']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>-->


                                    <!--<div class="col-md-4">
                                        <strong>Defunción</strong>
                                        <select name="defuncion" id="defuncion" class="form-control" style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php
                                            require 'conexionInfarto.php';
                                            $query = "SELECT * FROM defuncion ";
                                            $resultado = $conexion2->query($query);
                                            while ($row = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['descripcion']; ?>">
                                                    <?php echo $row['descripcion']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>-->



                                    <!--<div class="col-md-4">
                                        <strong>Causa defunción</strong>
                                        <select name="causadefuncion" id="causadefuncion" class="form-control" style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php
                                            require 'conexionInfarto.php';
                                            $query = "SELECT * FROM causa ";
                                            $resultado = $conexion2->query($query);
                                            while ($row = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['nombre_causa']; ?>">
                                                    <?php echo $row['nombre_causa']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>-->



                                    <!--<div class="col-md-3">
                                        <strong>Fevi</strong>
                                        <select name="fevi" id="fevi" class="form-control" style="width: 100%;" required>
                                            <option value="0">Selecciona</option>
                                            <?php

                                            $query = "SELECT * FROM fevi ";
                                            $resultado = $conexion2->query($query);
                                            while ($row = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['nombrefevi']; ?>">
                                                    <?php echo $row['nombrefevi']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>-->

                                    <br><br><br>
                                    <div class="col-md-12" style="text-align: center; 
                                    color: white; 
                                    background-color:#e16c70;">

                                        <strong>Tratamiento</strong>
                                    </div>

                                    <!-- Los siguientes select, de la sección TRATAMIENTO son de selección simple-->
                                    <div class="col-md-3" id="">
                                        <strong>Anticoagulantes</strong>
                                        <select name="anticoagulantes" id="anticoagulantes" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="acidoacetil">Acido Acetil Salicilico</option>
                                            <option value="Clopidogrel">Clopidogrel</option>
                                            <option value="Eptifibatida">Eptifibatida</option>
                                            <option value="Prasugrel">Prasugrel</option>
                                            <option value="rivarox">Rivaroxaban/Apixaban</option>
                                            <option value="ticagrelor">Ticagrelor</option>
                                        </select>
                                    </div>


                                    <div class="col-md-3" id="">
                                        <strong>Betabloqueadores</strong>
                                        <select name="betabloqueadores" id="betabloqueadores" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="acetubolol">Acetubolol</option>
                                            <option value="atenolol">Atenolol</option>
                                            <option value="bisoprolol">Bisoprolol</option>
                                            <option value="esmolol">Esmolol</option>
                                            <option value="metoprolol">Metoprolol</option>
                                            <option value="nebivolol">Nebivolol</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3" id="">
                                        <strong>IECA</strong>
                                        <select name="ieca" id="ieca" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="enalapril">Enalapril</option>
                                            <option value="lisinopril">Lisinopril</option>
                                            <option value="ramipril">Ramipril</option>
                                        </select>
                                    </div>


                                    <div class="col-md-3" id="">
                                        <strong>Calcioantagonistas</strong>
                                        <select name="calcio" id="calcio" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="amlodipino">Amlodipino</option>
                                            <option value="diltiazem">Diltiazem</option>
                                            <option value="felodipino">Felodipino</option>
                                            <option value="lercadipino">Lercadipino</option>
                                            <option value="manidipino">Manidipino</option>
                                            <option value="nifedpino">Nifedpino</option>
                                            <option value="nimodipino">Nimodipino</option>
                                            <option value="verapamilo">Verapamilo</optio>
                                        </select>
                                    </div>


                                    <div class="col-md-3" id="">
                                        <strong>ARA II</strong>
                                        <select name="araii" id="araii" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="candesartan">Candesartan</option>
                                            <option value="ibesartan">Ibesartan</option>
                                            <option value="losartan">Losartan</option>
                                            <option value="olmesartan">Olmesartan</option>
                                            <option value="telmisartan">Telmisartan</option>
                                            <option value="valsartan">Valsartan</option>
                                        </select>
                                    </div>


                                    <div class="col-md-3" id="">
                                        <strong>Estatinas</strong>
                                        <select name="estatinas" id="estatinas" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="atorvastatina">Atorvastatina</option>
                                            <option value="pravastatina">Pravastatina</option>
                                            <option value="rosuvastatina">Rosuvastatina</option>
                                            <option value="simvastatina">Simvastatina</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3" id="">
                                        <strong>Fibratos</strong>
                                        <select name="fibratos" id="fibratos" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="bezafibrato">Bezafibrato</option>
                                            <option value="cipofibrato">Cipofibrato</option>
                                            <option value="fenobifrato">Fenobifrato</option>
                                            <option value="gembibrozilo">Gembibrozilo</option>
                                        </select>
                                    </div><br><br><br>

                                    <!-- Finaliza la sección TRATAMIENTO-->



                                    <!-- Inicia sección PARACLINICOS-->
                                    <div class="col-md-12" style="text-align: center; 
                                    color: white; 
                                    background-color:#e16c70;">

                                        <strong>Paraclinicos</strong>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>CK</strong>
                                        <input type="number" id="ck" name="ck" placeholder="Ingrese..." class="form-control">

                                    </div>
                                    <div class="col-md-3">
                                        <strong>CK-MB</strong>
                                        <input type="number" id="ckmb" name="ckmb" placeholder="Ingrese..." class="form-control">

                                    </div>
                                    <div class="col-md-3">
                                        <strong>Troponinas</strong>
                                        <input type="number" id="troponinas" name="troponinas" placeholder="Ingrese..." class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Glucosa</strong>
                                        <input type="number" id="glucosa" name="glucosa" placeholder="Ingrese..." class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>UREA</strong>
                                        <input type="number" id="urea" name="urea" placeholder="Ingrese Urea..." class="form-control">

                                    </div>
                                    <div class="col-md-3">
                                        <strong>Creatinina</strong>
                                        <input type="number" id="creatinina" name="creatinina" placeholder="Ingrese..." class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Colesterol</strong>
                                        <input type="number" id="colesterol" name="colesterol" placeholder="Ingrese..." class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Trigliceridos</strong>
                                        <input type="number" id="trigliceridos" name="trigliceridos" placeholder="Ingrese..." class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Ácido Urico</strong>
                                        <input type="number" id="acidourico" name="acidourico" placeholder="Ingrese..." class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>HB Glucosilada</strong>
                                        <input type="number" id="hbglucosilada" name="hbglucosilada" placeholder="Ingrese..." class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Proteinas</strong>
                                        <input type="number" id="proteinas" name="proteinas" placeholder="Ingrese..." class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Colesterol Total</strong>
                                        <input type="number" id="colesteroltotal" name="colesteroltotal" placeholder="Ingrese..." class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>LDL</strong>
                                        <input type="number" id="ldl" name="ldl" placeholder="Ingrese..." class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>HDL</strong>
                                        <input type="number" id="hdl" name="hdl" placeholder="Ingrese..." class="form-control">
                                    </div><br><br><br>

                                    <!-- FINALIZA sección PARACLINICOS-->

                                    <!--***********************************************************************************-->



                                    <!--Inicia sección Viabilidad y Perfusión Miocardia-->
                                    <div class="col-md-12" style="text-align: center; 
                                    color: white; 
                                    background-color:#e16c70;">
                                        <strong>Viabilidad y Perfusión Miocardia</strong>
                                    </div>

                                    


                                    <!--Inicia sección PET-->
                                    <div class="col-md-12" style="text-align: center; 
                                    color: white; 
                                    background-color:#eda9ab;">
                                        <strong>PET</strong>
                                    </div>

                                    




                                    <!-- El select PET solo desplegará dos opciones, PATRON MATH y PATRON MISMATCH-->
                                    <div class="col-md-4" id="">
                                        <strong>*Patrón</strong>
                                        <select name="pet" id="pet" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="match">Patrón Match</option>
                                            <option value="mismatch">Patrón Mismatch</option>
                                        </select>
                                    </div>

                                    <!--Si se selecciona PATRON MATH, se debe habilitar el siguiente select-->

                                    <div class="col-md-4" id="">
                                        <strong>Segmento Match</strong>
                                        <select name="segmentomatch" id="segmentomatch" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="aplical">Apical</option>
                                            <option value="basal">Basal</option>
                                            <option value="Medio">Medio</option>
                                        </select>
                                    </div>

                                    <!-- Si se selecciona PATRON MISMATCH, se debe habilitar el siguiente select-->
                                    <div class="col-md-4" id="">
                                        <strong>Segmento Mismatch</strong>
                                        <select name="segmentomismatch" id="segmentomismatch" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="aplical">Apical</option>
                                            <option value="basal">Basal</option>
                                            <option value="Medio">Medio</option>
                                        </select>
                                    </div>











                                    <!--Inicia sección Viabilidad y Perfusión Miocardia-->
                                    <div class="col-md-12" style="text-align: center; 
                                    color: white; 
                                    background-color:#eda9ab;">
                                        <strong>Gamagrama Cardiaco</strong>
                                    </div>
                                    <!-- El siguiente SELECT solo muestra dos opciones: NEGATIVO / POSITIVO-->
                                    <div class="col-md-4" id="">
                                        <strong>* Resultado de Gamagrama Cardiaco</strong>
                                        <select name="gamagrama" id="gamagrama" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="bezafibrato">Positivo</option>
                                            <option value="cipofibrato">Negativo</option>
                                        </select>
                                    </div>

                                    <!-- Si en el select anterior, se seleccionó POSITIVO, se debenera mostrar el siguiente select-->
                                    <div class="col-md-4" id="">
                                        <strong>Localización</strong>
                                        <select name="gamagrama" id="gamagrama" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="anterior">Anterior</option>
                                            <option value="aplical">Apical</option>
                                            <option value="diafragmatica">Diafragmatica</option>
                                            <option value="lateral">Lateral</option>
                                            <option value="leteralbajo">Lateral Bajo</option>
                                            <option value="septal">Septal</option>
                                        </select>
                                    </div>





                                    <!--Inicia sección Viabilidad y Perfusión Miocardia-->
                                    <div class="col-md-12" style="text-align: center; 
                                    color: white; 
                                    background-color:#eda9ab;">
                                        <strong>Ergometría</strong>
                                    </div>
                                    <!-- ERGOMETRÍA no se seleccionará, solo se visualizará-->
                                    <div class="col-md-3">
                                        <strong>*Ergometría</strong>
                                        <select name="bruce" id="bruce" class="form-control" readonly>
                                            <option value="bruce" selected>Protocolo Bruce</option>
                                        </select>
                                    </div>

                                

                                    <!-- Cuando se seleccione una etapa, se debe seleccionar si es positivo/negativo-->
                                    <div class="col-md-3" id="">
                                        <strong>Etapa 1</strong>
                                        <select name="posinega" id="posinega" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="positivo">Positivo</option>
                                            <option value="negativo">Negativo</option>
                                        </select>
                                    </div>

                                    <!-- Cuando se seleccione una etapa, se debe seleccionar si es positivo/negativo-->
                                    <div class="col-md-3" id="">
                                        <strong>Etapa 2</strong>
                                        <select name="posinega" id="posinega" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="positivo">Positivo</option>
                                            <option value="negativo">Negativo</option>
                                        </select>
                                    </div>

                                    <!-- Cuando se seleccione una etapa, se debe seleccionar si es positivo/negativo-->
                                    <div class="col-md-3" id="">
                                        <strong>Etapa 3</strong>
                                        <select name="posinega" id="posinega" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="positivo">Positivo</option>
                                            <option value="negativo">Negativo</option>
                                        </select>
                                    </div>

                                    <!-- Cuando se seleccione una etapa, se debe seleccionar si es positivo/negativo-->
                                    <div class="col-md-3" id="">
                                        <strong>Etapa 4</strong>
                                        <select name="posinega" id="posinega" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="positivo">Positivo</option>
                                            <option value="negativo">Negativo</option>
                                        </select>
                                    </div>

                                    <!-- Cuando se seleccione una etapa, se debe seleccionar si es positivo/negativo-->
                                    <div class="col-md-3" id="">
                                        <strong>Etapa 5</strong>
                                        <select name="posinega" id="posinega" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="positivo">Positivo</option>
                                            <option value="negativo">Negativo</option>
                                        </select>
                                    </div>

                                    <!-- Cuando se seleccione una etapa, se debe seleccionar si es positivo/negativo-->
                                    <div class="col-md-3" id="">
                                        <strong>Etapa 6</strong>
                                        <select name="posinega" id="posinega" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="positivo">Positivo</option>
                                            <option value="negativo">Negativo</option>
                                        </select>
                                    </div>

                                    <!-- Cuando se seleccione una etapa, se debe seleccionar si es positivo/negativo-->
                                    <div class="col-md-3" id="">
                                        <strong>Etapa 7</strong>
                                        <select name="posinega" id="posinega" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="positivo">Positivo</option>
                                            <option value="negativo">Negativo</option>
                                        </select>
                                    </div>


                                    <!-- Suspención de estudio-->
                                    <div class="col-md-3" id="">
                                        <strong>Suspensión de Estudio</strong>
                                        <select name="suspencionestudio" id="suspencionestudio" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="disminucion">Disminucion De Tas -10Mmhg Debajo De La Inicial +Evidencia De Isquemia</option>
                                            <option value="arritmiaSuspencion">Arritmia</option>
                                            <option value="anginamoderada">Angina Moderada</option>
                                            <option value="aasn">Aumento De Actividad De Sistema Nervioso</option>
                                            <option value="palidez">Cianosis/Palidez</option>
                                            <option value="detenerse">Deseo Del Paciente De Detenerse</option>
                                            <option value="elevacionst">Elevacion Del Segmento St (< 1Mm) </option>
                                            <option value="taquicardiavs">Taquicardia Ventricular Sostenida</option>
                                            <option value="na">No Aplica</option>
                                        </select>
                                    </div>





                                    <br>
                                    <br>
                                    <br>


                                    <!--Inicia sección Viabilidad y Perfusión Miocardia-->
                                    <div class="col-md-12" style="text-align: center; 
                                    color: white; 
                                    background-color:#eda9ab;">
                                        <strong>ECOCARDIOGRAMA</strong>
                                    </div>

                                    <!-- El siguiente select Ecocardiograma tiene 3 opciones, las cuales tienen dependencias:-->

                                    <div class="col-md-3">
                                        <strong>Diastólico</strong>
                                        <input type="number" id="ldl" name="ldl" placeholder="Ingrese..." class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Sistólico</strong>
                                        <input type="number" id="hdl" name="hdl" placeholder="Ingrese..." class="form-control">
                                    </div><br><br><br>






                                    <!-- Si el usuario selecciona FEVI, se habilitan las siguientes opciones-->
                                    <div class="col-md-3" id="">
                                        <strong>FEVI</strong>
                                        <select name="feviop" id="feviop" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="treinta">Menos del 30%</option>
                                            <option value="cincuenta">Del 31% - 50%</option>
                                            <option value="setenta">Del 51% - 70%</option>
                                            <option value="cien">Más del 71%</option>
                                        </select>
                                    </div>

                                    <!-- Si el usuario selecciona MOVILIDAD, se habilitan las siguientes opciones-->
                                    <div class="col-md-3" id="">
                                        <strong>Movilidad</strong>
                                        <select name="movilidadop" id="movilidadop" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="acinesia">Acinesia</option>
                                            <option value="aneurismatico">Aneurismatico</option>
                                            <option value="discinecia">Discinecia</option>
                                            <option value="hipocinesia">Hipocinesia</option>
                                            <option value="normal">Normal</option>
                                        </select>
                                    </div>


                                    <!-- Si el usuario selecciona la opción NORMAL (del select de Movilidad) se deben desplegar las siguientes opciones:-->
                                    <div class="col-md-3" id="">
                                        <strong>Segmento</strong>
                                        <select name="segmento" id="segmento" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="anterior">Anterior</option>
                                            <option value="apical">Apical</option>
                                            <option value="diafragmatica">Diafragmática</option>
                                            <option value="lateral">Lateral</option>
                                            <option value="lateralbajo">Lateral Bajo</option>
                                            <option value="septal">Septal</option>
                                        </select>
                                    </div>

                                    <br>
                                    <br>
                                    <br>











                                    <!--Inicia sección Viabilidad y Perfusión Miocardia-->
                                    <div class="col-md-12" style="text-align: center; 
                                    color: white; 
                                    background-color:#eda9ab;">
                                        <strong>Defunción</strong>
                                    </div>

                                    <!-- El siguiente select tiene dependencia:-->
                                    <div class="col-md-3" id="">
                                        <strong>*Defunción</strong>
                                        <select name="defuncion" id="defuncion" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="sidefuncion">Sí</option>
                                            <option value="nodefuncion">No</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3" id="">
                                        <strong>Causa</strong>
                                        <select name="causa" id="causa" class="form-control" style="width:100%;" require>
                                            <option value="0">Seleccione...</option>
                                            <option value="cardiaca">Cardiaca</option>
                                            <option value="nocardiaca">No Cardiaca</option>
                                        </select>
                                    </div> <br><br><br>

                                    <div class="col-md-12" style="text-align: center; 
                                    color: white; 
                                    background-color:white;">
                                        <strong>Viabilidad y Perfusión Miocardia</strong>
                                    </div>


                                    <div class="col-md-12">
                                        <!--Se cambia value=Finalizar por value=Cancelar-->
                                        <input type="button" id="recargarArtritis" onclick="window.location.reload();" value="Cancelar">
                                        <!--Se cambia value=Registrar por value=Guardar-->
                                        <input type="submit" id="registrarArtritis" value="Guardar">
                                        <br>
                                    </div>

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