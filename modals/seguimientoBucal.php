<div id="seguimientobucal" class="modal fade" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="css/estilosMenu.css" rel="stylesheet">
    <script src="js/enviacurp.js"></script>
    <div class="modal-dialog">


        <!-- Modal content-->
        <div class="modal-content" style="width: 950px; height: auto; color:black; left: 50%; transform: translate(-50%); ">
            <div class="modal-header" id="cabeceraModalBucal">


                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarformularioseguimiento();">&times;</button>
                
            </div>
            <div class="modal-body">
                <div id="panel_editar">
                    <div class="contrato-nuevo">




                        <div class="modal-body">
                            <script>
                                $(window).load(function() {
                                    $(".loader").fadeOut("slow");
                                });

                                function limpiarformularioseguimiento() {

                                    setTimeout('document.formularioseguimientobucal.reset()', 1000);
                                    return false;
                                }
                            </script>




                            <!-- form start -->


                            <div class="form-header">
                                <h3 class="form-title">Seguimiento paciente</h3>

                            </div>
                            <style>
                                #fecha,
                                #curp,
                                #nombrecompleto,
                                #edad {
                                    text-transform: uppercase;
                                }
                            </style>
                            <form name="formularioseguimientobucal" id="formularioseguimientobucal" onSubmit="return limpiar()">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                        $("#formularioseguimientobucal").on("submit", function(e) {
                                            let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                            e.preventDefault();

                                            var formData = new FormData(document.getElementById(
                                                "formularioseguimientobucal"));
                                            formData.append("dato", "valor");

                                            $.ajax({

                                                url: "aplicacion/registrarSeguimientoPacienteBucal.php",
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



                                    <!-- INICIA FORMULARIO DE SEGUIMIENTO-->
                                    <div class="col-md-4">
                                        <strong>Progresión de la enfermedad</strong>
                                        <select name="progresionenfermedad" id="progresionenfermedad" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>
                                        </select>

                                    </div>
                                    <div class="col-md-4" id="dxprogresion">
                                        <strong>Fecha Dx Progresión</strong>
                                        <input type="date" id="fechadxprogresion" name="fechadxprogresion" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Recurrencia de la Enfermedad</strong>
                                        <select name="recurrencianenfermedad" id="recurrencianenfermedad" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Si">SÍ</option>
                                            <option value="No">No</option>
                                        </select>

                                    </div>
                                    <div class="col-md-4" id="recurrenciadate">
                                        <strong>Fecha de recurrencia</strong>
                                        <input type="date" id="fecharecurrencia" name="fecharecurrencia" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <strong>¿Amerita reintervención?</strong>
                                        <select name="ameritareintervencion" id="ameritareintervencion" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Si">SÍ</option>
                                            <option value="No">No</option>
                                        </select>

                                    </div>
                                    <div class="col-md-4" id="datereintervencion">
                                        <strong>Fecha de Reintervención</strong>
                                        <input type="date" id="fechareintenvencion" name="fechareintenvencion" class="form-control">
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

                                    <div class="col-md-4" id="lateralidadqt">
                                        <strong>Lateralidad Reintervención QX</strong>
                                        <select name="lateralidadreintervencion" id="lateralidadreintervencion" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Derecha">Derecha</option>
                                            <option value="Izquierda">Izquierda</option>
                                            <option value="Bilateral">Bilateral</option>
                                        </select>

                                    </div>
                                    <div class="col-md-4">
                                        <strong>¿Amerita Nueva QT?</strong>
                                        <select name="ameritanuevaqt" id="ameritanuevaqt" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Si">SÍ</option>
                                            <option value="No">No</option>

                                        </select>

                                    </div>
                                    <div class="col-md-4" id="fechadelanuevaqt">
                                        <strong>Fecha de nueva QT</strong>
                                        <input type="date" id="fechanuevaqt" name="fechanuevaqt" class="form-control">
                                    </div>
                                    <div class="col-md-4" id="tipodelaqt">
                                        <strong>Tipo</strong>
                                        <select name="tipoqt" id="tipoqt" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Neoadyuvante">Neoadyuvante</option>
                                            <option value="Coadyuvante">Coadyuvante</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="tratamientodelaqt">
                                        <strong>Tratamiento QT</strong>
                                        <select name="tratameintoqt" id="tratameintoqt" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <?php
                                            $query = $conexionCancer->prepare("SELECT descripciontratameinto FROM tratamientoqt");
                                            $query->setFetchMode(PDO::FETCH_ASSOC);
                                            $query->execute();
                                            while ($row = $query->fetch()) { ?>
                                                <option value="<?php echo $row['descripciontratameinto']; ?>">
                                                    <?php echo $row['descripciontratameinto']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>¿Amerita Radioterapia?</strong>
                                        <select name="ameritaradioterapia" id="ameritaradioterapia" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="aplicoradio">
                                        <strong>Tipo Radioterapia</strong>
                                        <select name="tipoderadioterapia" id="tipoderadioterapia" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Ciclo Mamario Completo">Ciclo Mamario Completo</option>
                                            <option value="Tangencial">Tangencial</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="fecharadio">
                                        <strong>Fecha de inicio</strong>
                                        <input type="date" id="fechadeinicioradio" name="fechadeinicioradio" class="form-control">
                                    </div>
                                    <div class="col-md-4" id="sesionescanti">
                                        <strong>N° de sesiones</strong>
                                        <input type="number" id="numerodesesiones" name="numerodesesiones" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <strong>¿Amerita Braquiterapia?</strong>
                                        <select name="ameritabraquiterapia" id="ameritabraquiterapia" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="fechadelabraqui">
                                        <strong>Fecha de inicio</strong>
                                        <input type="date" id="fechabraquiterapia" name="fechabraquiterapia" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Cuidados paliativos</strong>
                                        <select name="cuidadospaliativos" id="cuidadospaliativos" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="paliativaclinica">
                                        <strong>Tipo de cuidado paliativo</strong>
                                        <select name="clinicapaliativa" id="clinicapaliativa" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Clinca del dolor">Clinca del Dolor</option>
                                            <option value="Medicina paliativa">Medicina Paliativa</option>
                                        </select>

                                    </div>
                                    <div class="col-md-4">
                                        <strong>Protocolo clínico</strong>
                                        <select name="protocoloclinico" id="protocoloclinico" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>

                                        </select>

                                    </div>
                                    <div class="col-md-4">
                                        <strong>Protocolo de investigación</strong>
                                        <select name="protocoloinvestigacion" id="protocoloinvestigacion" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>
                                        </select>

                                    </div>


                                    <div class="col-md-12"></div>
                                    <br>


                                    <input type="submit" id="registrar" value="Registrar" style="width: 170px; height: 27px; color: white; background-color: #00B6FF; margin-left: auto; margin-right: auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">&nbsp;&nbsp;
                                    <input type="button" id="recargar" onclick="window.location.reload();" value="Finalizar" style="width: 170px; height: 27px; color: white; background-color: #FA0000; margin-left: auto; margin-right: auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
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