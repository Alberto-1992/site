<div id="seguimientocancerdemama" class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="css/estilosMenu.css" rel="stylesheet">
    <script src="js/scriptseguimientocancermama.js"></script>
    <div class="modal-dialog modal-lg">


        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                <button type="button" class="close" data-bs-dismiss="modal"
                    onclick="limpiarformularioseguimiento();">&times;</button>
                <h5 class="modal-title">Seguimiento paciente</h5>
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

                                setTimeout('document.formularioseguimientocancer.reset()', 1000);
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
                            <form name="formularioseguimientocancer" id="formularioseguimientocancer" onSubmit="return limpiar()">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioseguimientocancer").on("submit", function(e) {
                                        let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioseguimientocancer"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/registrarSeguimientoPacienteCancer.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                $("#tabla_resultadobus").load('consultacancerdemama.php')

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
                                    $fechaActual = date("F j, Y, g:i a");
                
                                    ?>


                                    <input id="year" name="year" class="form-control" type="hidden" value="2022"
                                        required="required" onkeyup="mayus(this);" readonly>
                                    <div class="col-md-12">
                                        <strong>ID:&nbsp;</strong>
                                        <input id="curps" name="curps" class="form-control" type="text" value="<?php echo $dataRegistro['id']; ?>"
                                            readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Calidad de vida ECOG</strong>
                                        <select name="calidadvidaecog" id="calidadvidaecog" class="form-control" >
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcionecog FROM calidadvidaecog");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionecog']; ?>">
                                                <?php echo $row['descripcionecog']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    
                                   <!-- <div class="col-md-4">
                                        <strong>Frecuencia cardiaca</strong>
                                        <input type="text" class="control control col-md-12" id="frecuenciacardiaca"
                                            name="frecuenciacardiaca">

                                    </div>
                                    <div class="col-md-4">
                                        <strong>Presión arterial</strong>
                                        <input type="text" class="control control col-md-12" id="presionarterial"
                                            name="presionarterial">

                                    </div>-->
                                    <div class="col-md-4">
                                        <strong>Progresión de la enfermedad</strong>
                                        <select name="progresionenfermedad" id="progresionenfermedad"
                                            class="form-control">
                                            <option value="0">Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>

                                    </div>
                                    <div class="col-md-4" id="dxprogresion">
                                        <strong style="color:red;">Fecha Dx progresión</strong>
                                        <input type="date" id="fechadxprogresion" name="fechadxprogresion" 
                                            class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Recurrencia de la enfermedad</strong>
                                        <select name="recurrencianenfermedad" id="recurrencianenfermedad"
                                            class="form-control">
                                            <option value="0">Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>

                                    </div>
                                    <div class="col-md-4" id="recurrenciadate">
                                        <strong style="color:red;">Fecha de recurrencia</strong>
                                        <input type="date" id="fecharecurrencia" name="fecharecurrencia"
                                            class="form-control">
                                    </div>
                                     <div class="col-md-4">
                                        <strong>Amerita reintervención</strong>
                                        <select name="ameritareintervencion" id="ameritareintervencion"
                                            class="form-control">
                                            <option value="0">Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>

                                    </div>
                                    <div class="col-md-4" id="datereintervencion">
                                        <strong style="color:red;">Fecha de reintervención</strong>
                                        <input type="date" id="fechareintenvencion" name="fechareintenvencion"
                                            class="form-control">
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
                                        <strong style="color:red;">Lateralidad reintervención QX</strong>
                                        <select name="lateralidadreintervencion" id="lateralidadreintervencion" class="form-control">
                                            <option value="0">Seleccione</option>
                                            <option value="Derecha">Derecha</option>
                                            <option value="Izquierda">Izquierda</option>
                                            <option value="Bilateral">Bilateral</option>

                                        </select>

                                    </div>
                                    <div class="col-md-4">
                                        <strong>Amerita nueva QT</strong>
                                        <select name="ameritanuevaqt" id="ameritanuevaqt" class="form-control">
                                            <option value="0">Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>

                                    </div>
                                    <div class="col-md-4" id="fechadelanuevaqt">
                                        <strong style="color:red;">Fecha de nueva QT</strong>
                                        <input type="date" id="fechanuevaqt" name="fechanuevaqt"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-4" id="tipodelaqt">
                                        <strong style="color:red;">Tipo</strong>
                                        <select name="tipoqt" id="tipoqt" class="form-control">
                                            <option value="0">Seleccione</option>
                                            <option value="Neoadyuvante">Neoadyuvante</option>
                                            <option value="Coadyuvante">Coadyuvante</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="tratamientodelaqt">
                                        <strong style="color:red;">Tratamiento QT</strong>
                                        <select name="tratameintoqt" id="tratameintoqt" class="form-control">
                                            <option value="0">Seleccione</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripciontratameinto FROM tratamientoqt");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripciontratameinto']; ?>">
                                                <?php echo $row['descripciontratameinto']; ?></option>
                                            <?php } ?>

                                        </select>
                                        </div>
                                    <div class="col-md-4">
                                        <strong>Amerita radioterapia</strong>
                                        <select name="ameritaradioterapia" id="ameritaradioterapia" class="form-control">
                                            <option value="0">Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="aplicoradio">
                                        <strong style="color:red;">Tipo Radioterapia</strong>
                                        <select name="tipoderadioterapia" id="tipoderadioterapia" class="form-control">
                                            <option value="0">Seleccione</option>
                                            <option value="CICLO MAMARIO COMPLETO">CICLO MAMARIO COMPLETO</option>
                                            <option value="TANGENCIAL">TANGENCIAL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="fecharadio">
                                        <strong style="color:red;">Fecha de inicio</strong>
                                        <input type="date" id="fechadeinicioradio" name="fechadeinicioradio"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-4" id="sesionescanti">
                                        <strong style="color:red;">N° de sesiones</strong>
                                        <input type="number" id="numerodesesiones" name="numerodesesiones"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Amerita braquiterapia</strong>
                                        <select name="ameritabraquiterapia" id="ameritabraquiterapia" class="form-control">
                                            <option value="0">Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="fechadelabraqui">
                                        <strong style="color:red;">Fecha de inicio</strong>
                                        <input type="date" id="fechabraquiterapia" name="fechabraquiterapia"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Cuidados paliativos</strong>
                                        <select name="cuidadospaliativos" id="cuidadospaliativos" class="form-control">
                                            <option value="0">Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="paliativaclinica">
                                        <strong style="color:red;">Tipo de cuidado paliativo</strong>
                                        <select name="clinicapaliativa" id="clinicapaliativa" class="form-control">
                                            <option value="0">Seleccione</option>
                                            <option value="Clinca del dolor">Clinca del dolor</option>
                                            <option value="Medicina paliativa">Medicina paliativa</option>
                                        </select>

                                    </div>
                                    <div class="col-md-4">
                                        <strong>Protocolo clínico</strong>
                                        <select name="protocoloclinico" id="protocoloclinico" class="form-control">
                                            <option value="0">Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>

                                    </div>
                                    <div class="col-md-4">
                                        <strong>Protocolo de investigación</strong>
                                        <select name="protocoloinvestigacion" id="protocoloinvestigacion"
                                            class="form-control">
                                            <option value="0">Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>

                                    </div>


                                    <div class="col-md-12"></div>
                                    <br>


                                    <input type="submit" id="registrar" value="Registrar" style="width: 170px; height: 27px; color: white; background-color: #00B6FF; margin-left: auto; margin-right: auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">&nbsp;&nbsp;
                                    <input type="button" id="recargar" onclick="window.location.reload();"
                                        value="Finalizar" style="width: 170px; height: 27px; color: white; background-color: #FA0000; margin-left: auto; margin-right: auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
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