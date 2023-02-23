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
                <h5 class="modal-title">Seguimiento</h5>
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

                                    setTimeout('document.formularioseguimiento.reset()', 1000);
                                    return false;
                                }
                            </script>




                            <!-- form start -->

                            <div class="col-md-12" style="text-align: center; 
                                color: white; 
                                background-color:#CD114E;">
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
                            <form name="formularioseguimiento" id="formularioseguimiento" onSubmit="return limpiar()">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                        $("#formularioseguimiento").on("submit", function(e) {
                                            let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                            e.preventDefault();

                                            var formData = new FormData(document.getElementById(
                                                "formularioseguimiento"));
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
                                    <br>

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
                                    </div>
                                    <div class="col-md-4">
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
                                    </div>
                                    <div class="col-md-4">
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
                                    </div>
                                    <div class="col-md-4">
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
                                    </div>
                                    <div class="col-md-4">
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
                                    </div>
                                    <div class="col-md-4">
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
                                    </div>
                                    <div class="col-md-4">
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
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Estancia hospitalaria</strong>
                                        <textarea id="estanciahospitalaria" name="estanciahospitalaria" placeholder="Describa" class="form-control" onkeyup="mayus(this);" rows="2"></textarea>
                                    </div>
                                    <div class="col-md-4">
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
                                    </div>
                                    <div class="col-md-4">
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
                                    </div>
                                    <div class="col-md-4">
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
                                    </div>
                                    <div class="col-md-4">
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
                                    </div>
                                    <div class="col-md-4">
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
                                    </div>
                                    <div class="col-md-4">
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
                                    </div>
                                    <div class="col-md-4">
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
                                    </div>
                                    <div class="col-md-3">
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
                                    </div>
                                    <div class="col-md-12"></div>
                                    <br>


                                    <input type="submit" id="registrar" value="Registrar">
                                    <a href='' id="recargar" onclick="window.reload();">Finalizar</a>

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