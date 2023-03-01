<div id="seguimientoArtritis" class="modal fade" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="css/estilosMenu.css" rel="stylesheet">
    <script src="js/enviacurp.js"></script>
    <div class="modal-dialog">


        <!-- Modal content-->
        <div class="modal-content"
            style="width: 950px; height: auto; color:black; left: 50%; transform: translate(-50%); ">
            <div class="modal-header" id="cabeceraModalArtritis">
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

                                setTimeout('document.formularioseguimiento.reset()', 1000);
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
                            <form name="formularioseguimientoartritis" id="formularioseguimientoartrits" onSubmit="return limpiar()">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioseguimientoartritis").on("submit", function(e) {
                                        let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioseguimientoartrits"));
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



                                    <input id="year" name="year" class="form-control" type="hidden" value="2022"
                                        required="required" onkeyup="mayus(this);" readonly>

                                    <div class="col-md-6">
                                        <strong>Seguimiento</strong>
                                        <select name="seguimiento" id="seguimiento" class="form-control" required
                                            onclick="obtenerid();">
                                            <option value="">Seleccione una opción</option>
                                            <option value="3 meses">Tres meses</option>
                                            <option value="6 meses">Seis meses</option>
                                            <option value="un anio">Un año</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>CURP:&nbsp;</strong>
                                        <input id="curps" name="curps" class="form-control" type="text" value=""
                                            readonly>
                                        <span id="curp" class="curp" name="curp"></span>
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