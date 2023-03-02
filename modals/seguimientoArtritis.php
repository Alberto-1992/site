<div id="seguimientoArtritis" class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="css/estilosMenu.css" rel="stylesheet">
    <script src="js/enviacurp.js"></script>
    <div class="modal-dialog modal-lg">


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
                                <h5 class="form-title" style="text-align: center;
                                color:aliceblue; 
                                background-color:#A9DFBF; 
                                margin-top: 5px; 
                                font-size: 17px;">
                                    DATOS DEL PACIENTE </h5>
                            </div>

                            <form name="formularioseguimientoartritis" id="formularioseguimientoartrits" onSubmit="return limpiar()">
                                <div class="form-row">
                                    <div id="mensaje"></div>

                                    <div class="col-md-4">
                                        <strong>CURP:</strong>
                                        <input id="curps" name="curps" class="form-control" type="text" value="" readonly>
                                        <span id="curp" class="curp" name="curp"></span>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Talla:</strong>
                                        <input type="number" step="any" class="form-control" id="talla" name="talla" required>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Peso:</strong>
                                        <input type="number" step="any" class="form-control" id="peso" onblur="calculaIMC();" name="peso" required>
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
                                        <input type="number" step="any" class="form-control" id="plaquetas" name="plaquetas">
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Factor Reumatoide Basal</strong>
                                        <input type="number" step="any" class="form-control" id="frbasal" name="frbasal">
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Factor Reumatoide Nominal</strong>
                                        <select name="frnominal" id="frnominal" class="form-control">
                                            <option value="">Seleccione..</option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>
                                        </select>

                                    </div>

                                    <div class="col-md-3">
                                        <strong>PCR</strong>
                                        <input type="number" step="any" class="form-control" id="pcr" name="pcr">
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Vitamina D Basal</strong>
                                        <input type="number" step="any" class="form-control" id="vitaminaDBasal" name="vitaminaDBasal">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Vitamina D Nominal</strong>
                                        <select name="vitaminaDNominal" id="vitaminaDNominal" class="form-control">
                                            <option value="">Seleccione..</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Deficiente">Deficiente</option>
                                        </select>

                                    </div>

                                    <div class="col-md-3">
                                        <strong>AC Anticpp Basal</strong>
                                        <input type="number" step="any" class="form-control" id="anticppbasal" name="anticppbasal">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>AC Anticpp Nominal</strong>
                                        <select name="anticppnominal" id="anticppnominal" class="form-control">
                                            <option value="">Seleccione..</option>
                                            <option value="Positivo">Positivo</option>
                                            <option value="Negativo">Negativo</option>
                                        </select>

                                    </div>


                                    <div class="col-md-3">
                                        <strong>VSG</strong>
                                        <input type="number" step="any" class="form-control" id="vsg" name="vsg">
                                    </div>

                                    <div class="col-md-3">
                                        <strong>TGO Basal</strong>
                                        <input type="number" step="any" class="form-control" id="tgobasal" name="tgobasal">
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
                                        <input type="number" step="any" class="form-control" id="tgpbasal" name="tgpbasal">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>TGP Nominal</strong>
                                        <select name="tgpnominal" id="tgpnominal" class="form-control">
                                            <option value="">Seleccione..</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Anormal">Anormal</option>
                                        </select>
                                    </div>


                                    <div class="col-md-3">
                                        <strong>Glucosa</strong>
                                        <input type="number" step="any" class="form-control" id="glucosa" name="glucosa">
                                    </div>

                                    <div class="col-md-2">
                                        <strong>Colesterol</strong>
                                        <input type="number" step="any" class="form-control" id="colesterol" name="colesterol">
                                    </div>

                                    <div class="col-md-2">
                                        <strong>Trigliceridos</strong>
                                        <input type="number" step="any" class="form-control" id="trigliceridos" name="trigliceridos">
                                    </div>

                                    <div class="col-md-2">
                                        <strong>FIB 4</strong>
                                        <input type="number" step="any" class="form-control" id="fib" name="fib" readonly>
                                    </div>
                                    <!--Finaliza sección de Laboratorio-->






                                    <div class="col-md-12" style="text-align: center; color:aliceblue; background-color:#A9DFBF; margin-top: 5px; font-size: 17px;">
                                        SEGUIMIENTO USG HEPÁTICO
                                    </div>

                                    <!-- Los siguientes tres select son de selección simple-->
                                    <div class="col-md-12">
                                        <strong>USG Hepático</strong>
                                        <select name="usghepatico" id="usghepatico" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Si">Sí</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <!--Si el usuario Selecciona Sí en USG Hepático, se debe abrir el siguiente select-->

                                    <div class="col-md-12" id="usghallazgo">
                                        <strong>Hallazgo USG</strong>
                                        <select name="hallazgousg" id="hallazgousg" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Cirrosis hepatica">Cirrosis Hepática</option>
                                            <option value="Esteatosis">Esteatosis</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12" id="clasisesteatosis">
                                        <strong>
                                            Clasificación Esteatosis</strong>
                                        <select name="clasificacionesteatosis" id="clasificacionesteatosis" class="form-control">
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
                                        <input type="number" class="form-control" id="articulacionesInflamadasSJC28" name="articulacionesInflamadasSJC28" placeholder="Ingrese valor...">

                                    </div>

                                    <div class="col-md-4">

                                        <strong>Articulaciones Dolorosas TJC28</strong>
                                        <input type="number" class="form-control" id="articulacionesDolorosasTJC28" name="articulacionesDolorosasTJC28" placeholder="Ingrese valor...">

                                    </div>

                                    <div class="col-md-4">

                                        <strong>Evaluación Global PGA</strong>
                                        <input type="number" class="form-control" id="evglobalpga" name="evglobalpga" placeholder="Ingrese valor...">

                                    </div>


                                    <div class="col-md-4">

                                        <strong>Evaluación del Evaluador EGA</strong>
                                        <input type="number" class="form-control" id="evega" name="evega" placeholder="Ingrese valor...">

                                    </div>

                                    <div class="col-md-4">
                                        <strong>Resultado CDAI</strong>
                                        <input type="text" class="form-control" id="resultadocdai" name="resultadocdai" readonly value="">

                                    </div>

                                    <div class="col-md-4">
                                        <strong>Resultado SDAI</strong>
                                        <input type="text" class="form-control" id="resultadosdai" name="resultadosdai" readonly value="">

                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <a href="#" id="calcularCDAI" style="font-style: italic;">Calcular CDAI</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#" id="calcularSDAI" style="font-style: italic;">Calcular SDAI</a>
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
                                        <input type="radio" name="metrotexate" id="metrotexate1" class="check" value="si" onclick="metrotexatesi();">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="metrotexate" id="metrotexate2" class="check" value="no" checked onclick="metrotexateno();">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <div class="col-md-2">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanalmetro" name="dosisSemanalmetro" type="text" class="form-control" value="0">
                                    </div>

                                    <!-- si selecciona SÍ en el medicamento, se debe abrir el campo de "Dosis Semanal":-->
                                    <fieldset class="col-md-2">
                                        <strong>Leflunomide</strong>
                                        <br>
                                        <input type="radio" name="leflunomide" id="leflunomide1" class="check" value="si" onclick="Leflunomidesi();">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="leflunomide" id="leflunomide2" class="check" value="no" checked onclick="Leflunomideno();">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <div class="col-md-2">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanalfemua" name="dosisSemanalfemua" type="text" class="form-control" value="0">
                                    </div>

                                    <!-- si selecciona SÍ en el medicamento, se debe abrir el campo de "Dosis Semanal":-->
                                    <fieldset class="col-md-2">
                                        <strong>Sulfazalasina</strong>
                                        <br>
                                        <input type="radio" name="sulfazalasina" id="sulfazalasina1" class="check" value="si" onclick="Sulfazalasinasi();">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="sulfazalasina" id="sulfazalasina2" class="check" value="no" checked onclick="Sulfazalasinano();">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <div class="col-md-2">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanalsulfa" name="dosisSemanalsulfa" type="text" class="form-control" value="0">
                                    </div>

                                    <!-- si selecciona SÍ en el medicamento, se debe abrir el campo de "Dosis Semanal":-->
                                    <fieldset class="col-md-2">
                                        <strong>Tocoferol</strong>
                                        <br>
                                        <input type="radio" name="tecoferol" id="tecoferol1" class="check" value="si" onclick="Tocoferolsi();">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="tecoferol" id="tecoferol2" class="check" value="no" checked onclick="Tocoferolno();">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <div class="col-md-2">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanalteco" name="dosisSemanalteco" type="text" class="form-control" value="0">
                                    </div>

                                    <!-- si selecciona SÍ en el medicamento, se debe abrir el campo de "Dosis Semanal":-->
                                    <fieldset class="col-md-2">
                                        <strong>Glucocorticoide</strong>
                                        <br>
                                        <input type="radio" name="glucocorticoide" id="glucocorticoide1" class="check" value="si" onclick="Glucocorticoidesi();">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="glucocorticoide" id="glucocorticoide2" class="check" value="no" checked onclick="Glucocorticoideno();">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <!--Si el usuario selecciona Sí en la opción Glucocorticoide, se deben mostrar los siguientes dos selects-->
                                    <div class="col-md-4">
                                        <strong>Tratamiento</strong>
                                        <select name="tratamientogluco" id="tratamientogluco" class="form-select">
                                            <option value="0">Seleccione...</option>
                                            <option value="Deflazacort">Deflazacort</option>
                                            <option value="Prednisona">Prednisona</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanaltrata" name="dosisSemanaltrata" type="text" class="form-control" value="0">
                                    </div>

                                    <!-- si selecciona SÍ en el medicamento, se debe abrir el campo de "Dosis Semanal":-->
                                    <fieldset class="col-md-2">
                                        <strong>Vitamina D</strong>
                                        <br>
                                        <input type="radio" name="vitaminaD" id="vitaminaD1" class="check" value="si" onclick="vitaminadsi();">&nbsp;Sí&nbsp;&nbsp;
                                        <input type="radio" name="vitaminaD" id="vitaminaD2" class="check" value="no" checked onclick="vitaminadno();">&nbsp;No&nbsp;&nbsp;
                                    </fieldset>

                                    <div class="col-md-2">
                                        <strong>Dosis Semanal:</strong>
                                        <input id="dosisSemanalvitad" name="dosisSemanalvitad" type="text" class="form-control" value="0">
                                    </div>

                                    <div class="col-md-2">
                                        <strong>
                                            Biológico</strong>
                                        <select name="biologico" id="biologico" class="form-select" onchange="Biologico();">
                                            <option value="0">Seleccione...</option>
                                            <option value="si">Sí</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <!--Si el usuario selecciona Sí en la opción Biológico, se deben mostrar los siguientes dos selects-->
                                    <div class="col-md-3">
                                        <strong>Tratamiento</strong>
                                        <select name="tratamientobiologico" id="tratamientobiologico" class="form-select">
                                            <option value="0">Seleccione...</option>
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
                                        <select name="apegotratamiento" id="apegotratamiento" class="form-select">
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