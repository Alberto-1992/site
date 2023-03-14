<div id="seguimientolupus" class="modal fade" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="css/estilosMenu.css" rel="stylesheet">
    <script src="js/enviacurp.js"></script>
    <script src="js/scriptModalLupus.js"></script>
    <div class="modal-dialog">


        <!-- Modal content-->
        <div class="modal-content" style="width: 800px; height: auto; left: 50%; transform: translate(-50%); ">
            <div class="modal-header" id="cabeceraModalLupus">
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
                                <h5 class="form-title" style="text-align: center;
                                    background-color:  #b763a2;
                                    color: aliceblue;
                                    margin-top:5px;">
                                    SEGUIMIENTO DEL PACIENTE</h5>
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



                                    <input id="year" name="year" class="form-control" type="hidden" value="2022" required="required" onkeyup="mayus(this);" readonly>

                                    <div class="col-md-4">
                                        <strong>CURP:&nbsp;</strong>
                                        <input id="curps" name="curps" class="form-control" type="text" value="" readonly>
                                        <span id="curp" class="curp" name="curp"></span>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Nombre Completo</strong>
                                        <input id="nombrecompleto" name="nombrecompleto" onblur="calcularEdad();" type="text" class="control form-control" value="" required>
                                    </div>


                                    <div class="col-md-4" id="idfechaseguimientolupus">
                                        <strong>Fecha de Seguimiento</strong>
                                        <input type="date" id="fechaSeguimiento" name="fechaSeguimiento" class="form-control">
                                    </div>

                                    <!--********************************************************************************************************************************************************************-->
                                    <!--Inicia la sección de Antecedentes Personales Patológicos-->
                                    <div class="col-md-12"></div>
                                    <div class="form-title" style="text-align: center; 
                                    background-color: #b763a2;
                                    color:aliceblue; 
                                    margin-top: 5px; 
                                    font-size: 18px;">
                                        <strong>CLÍNICA</strong>
                                    </div>
                                    <br>


                                    <!--Inicia la sección de ACTIVIDAD LÚPICA-->
                                    <div class="col-md-12"></div>
                                    <div class="form-title" style="text-align: center; 
                                    background-color: #cba1ce;
                                    color:aliceblue;
                                    margin-top: 5px; 
                                    font-size: 13px; ">
                                        <strong>ACTIVIDAD LÚPICA</strong>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Actividad Articular</strong>
                                        <select name="actividadArticular" id="actividadArticular" class="form-control">
                                            <option value="Seleccione">Seleccione...</option>
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Actividad Cutánea</strong>
                                        <select name="actividadCutanea" id="actividadCutanea" class="form-control">
                                            <option value="Seleccione">Seleccione...</option>
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Actividad Hematología</strong>
                                        <select name="actividadHematologia" id="actividadHematologia" class="form-control">
                                            <option value="Seleccione">Seleccione...</option>
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Actividad Inmunológica</strong>
                                        <select name="actividadInmuno" id="actividadInmuno" class="form-control">
                                            <option value="Seleccione">Seleccione...</option>
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Actividad Neurológica</strong>
                                        <select name="actividadNeurologica" id="actividadNeurologica" class="form-control">
                                            <option value="Seleccione">Seleccione...</option>
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Actividad Renal</strong>
                                        <select name="actividadRenal" id="actividadRenal" class="form-control">
                                            <option value="Seleccione">Seleccione...</option>
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <!--Inicia la sección de CALCULADORA SLEDAI-->
                                    <div class="col-md-12"></div>
                                    <div class="form-title" style="text-align: center; 
                                    background-color: #cba1ce;
                                    color:aliceblue;
                                    margin-top: 5px; 
                                    font-size: 13px; ">
                                        <strong>CALCULADORA SLEDAI</strong>
                                    </div>

                                    <div class="container" id="contenedor">
                                        <!-- <div class="form-check form-check-inline">-->
                                        <!-- <div class="form-check form-check-inline">-->
                                        <div class="custom-control custom-checkbox text-inline">

                                            <!--primera columna-->

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="8Convulsion" id="convulsion">
                                                <label for="convulsion" class="form-check-label">Convulsión</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="8Psicosis" id="Psicosis">
                                                <label for="Psicosis" class="form-check-label">Psicosis</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="8Síndrome Cerebral Orgánico" id="sindromecerebralorganico">
                                                <label for="sindromecerebralorganico" class="form-check-label">Síndrome Cerebral Orgánico</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="8AlteracionVisual" id="alteracionvisual">
                                                <label for="alteracionvisual" class="form-check-label">Alteración Visual</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="8Trastorno De Los Nervios Craneales" id="tnervioscentrales">
                                                <label for="tnervioscentrales" class="form-check-label">Trastorno De Los Nervios Craneales</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="8Dolor De Cabeza Por Lupus" id="dolorcabeza">
                                                <label for="dolorcabeza" class="form-check-label">Dolor De Cabeza Por Lupus</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="8EVC" id="evc">
                                                <label for="evc" class="form-check-label">EVC</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="8Vasculitis" id="Vasculitis">
                                                <label for="Vasculitis" class="form-check-label">Vasculitis</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="4Artritis" id="aartritis">
                                                <label for="aartritis" class="form-check-label">Artritis</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="4Miositis" id="Miositis">
                                                <label for="Miositis" class="form-check-label">Miositis</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="4Cilindros Urinarios" id="cilindrosurinarios">
                                                <label for="cilindrosurinarios" class="form-check-label">Cilindros Urinarios</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="4Hematuria" id="hematuria">
                                                <label for="hematuria" class="form-check-label">Hematuria</label>
                                            </div>
                                        </div>

                                        <!--segunda columna-->
                                        <div class="col-md-6">

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="4Piuria" id="Piuria">
                                                <label for="Piuria" class="form-check-label">Piuria</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="2Proteinuria" id="Proteinuria">
                                                <label for="Proteinuria" class="form-check-label">Proteinuria</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="2Erupción" id="erupcion">
                                                <label for="erupcion" class="form-check-label">Erupción</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="2Úlceras De Las Mucosasa" id="ulceras">
                                                <label for="ulceras" class="form-check-label">Úlceras De Las Mucosas</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="2Pleuritis" id="Pleuritis">
                                                <label for="Pleuritis" class="form-check-label">Pleuritis</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="2Pericarditis" id="Pericarditis">
                                                <label for="Pericarditis" class="form-check-label">Pericarditis</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="2Bajo Complemento (C3,C4 O Ch50 Bajo)" id="bajocomplemento">
                                                <label for="bajocomplemento" class="form-check-label">Bajo com(C3,C4 O Ch50 Bajo)</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="2Aumento de la Unión al ADN" id="ADN">
                                                <label for="ADN" class="form-check-label">Aumento de la Unión al ADN</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="1Fiebre" id="fiebre">
                                                <label for="convulsion" class="form-check-label">Fiebre</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="1Trombocitopenia" id="Trombocitopenia">
                                                <label for="Trombocitopenia" class="form-check-label">Trombocitopenia</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="1Leucopenia" id="Leucopenia">
                                                <label for="Leucopenia" class="form-check-label">Leucopenia</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" value="1Alopecia" id="Alopecia">
                                                <label for="Alopecia" class="form-check-label">Alopecia</label>
                                            </div>
                                        </div>
                                    </div>





                                    <div class="col-md-12"><br>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="resultadosledai"><strong>Resultado SLEDAI</strong></span>
                                            <input type="text" class="form-control" aria-describedby="resultadosledai" readonly value="">
                                        </div>



                                    </div>

                                    <!--********************************************************************************************************************************************************************-->
                                    <!--Inicia la sección de LABORATORIO-->
                                    <div class="col-md-12"></div>
                                    <div class="form-title" style="text-align: center; 
                                    background-color: #cba1ce;
                                    color:aliceblue;
                                    margin-top: 5px; 
                                    font-size: 13px; ">
                                        <strong>LABORATORIOS</strong>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Albumina</strong>
                                        <input type="number" step="any" class="form-control" id="albumina" name="albumina" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>BUN</strong>
                                        <input type="number" step="any" class="form-control" id="bun" name="bun" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>C3</strong>
                                        <input type="number" step="any" class="form-control" id="c3" name="c3" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>C4</strong>
                                        <input type="number" step="any" class="form-control" id="c4" name="c4" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Creatina</strong>
                                        <input type="number" step="any" class="form-control" id="creatina" name="creatina" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Proteina</strong>
                                        <input type="number" step="any" class="form-control" id="proteina" name="proteina" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Urea</strong>
                                        <input type="number" step="any" class="form-control" id="urea" name="urea" required>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Vitamina D</strong>
                                        <input type="number" step="any" class="form-control" id="vitaminad" name="vitamina4" required>
                                    </div>


                                    <!--********************************************************************************************************************************************************************-->
                                    <!--Inicia la sección de BIOPSIA RENAL-->
                                    <div class="col-md-12"></div>
                                    <div class="form-title" style="text-align: center; 
                                    background-color: #cba1ce;
                                    color:aliceblue;
                                    margin-top: 5px; 
                                    font-size: 13px; ">
                                        <strong>BIOPSIA RENAL</strong>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Biopsia Renal</strong>
                                        <select name="biopsiaRenalseguimiento" id="biopsiaRenalseguimiento" class="form-control">
                                            <option value="Seleccione">Seleccione...</option>
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6" id="idtipobiopsiaseguimiento">
                                        <strong>Tipo</strong>
                                        <select name="tipobiopsiaseguimiento" id="tipobiopsiaseguimiento" class="form-control">
                                            <option value="Seleccione">Seleccione...</option>
                                            <option value="G. Focal Y Segmentaria">G. Focal Y Segmentaria</option>
                                            <option value="G. Membranosa">G. Membranosa</option>
                                            <option value="G. Proliferativa Difusa">G. Proliferativa Difusa</option>
                                            <option value="Glomerulos Normales">Glomerulos Normales</option>
                                            <option value="Mesangial Pura">Mesangial Pura</option>
                                        </select>
                                    </div>

                                    <!--********************************************************************************************************************************************************************-->
                                    <!--Inicia la sección de DEFUNCION-->
                                    <div class="col-md-12"></div>
                                    <div class="form-title" style="text-align: center; 
                                    background-color: #b763a2;
                                    color:aliceblue; 
                                    margin-top: 5px; 
                                    font-size: 18px;">
                                        <strong>DEFUNCIÓN</strong>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Defunción</strong>
                                        <select name="defuncion" id="defuncion" class="form-control">
                                            <option value="Seleccione">Seleccione...</option>
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>


                                    <div class="col-md-12"></div>
                                    <br>


                                    <input type="button" id="recargar" onclick="window.location.reload();" value="Cancelar" style="width: 170px; height: 27px; color: white; background-color: #FA0000; margin-left: auto; margin-right: auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                                    <input type="submit" id="registrar" value="Guardar" style="width: 170px; height: 27px; color: white; background-color: #008000; margin-left: auto; margin-right: auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">&nbsp;&nbsp;

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