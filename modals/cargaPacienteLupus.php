<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="cancerbucal">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--se agrega estilos para icon-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="css/estilosMenu.css" rel="stylesheet">
    <script src="js/getCatalogos.js"></script>
    <script src="js/scriptModalvalidacionBucal.js"></script>
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <div class="modal-dialog modal-lg">


        <!-- Modal content-->
        <!-- Inicia Modal Header -->
        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalBucal">
                <span class="material-symbols-outlined" style="color: white;">
                    person_add
                </span>
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiar();">&times;</button>
            </div>
            <!-- Finaliza Modal Header -->




            <div class="modal-body">
                <div id="panel_editar">
                    <div class="modal-body">



                        <!-- Header inicial Datos del Paciente -->
                        <div class="form-header">
                            <h5 class="form-title" style="text-align: center;
                                    background-color: #d9a4a5;
                                    color: aliceblue;
                                    margin-top:5px;">
                                DATOS DEL PACIENTE </h5>
                        </div>
                        <!-- Fin Header inicial Datos del Paciente -->





                        <form name="formulariocancerbucal" id="formulariocancerbucal" onSubmit="return limpiar()" autocomplete="off">
                            <div class="form-row">
                                <div id="mensaje"></div>
                                <script>
                                    $("#formulariocancerbucal").on("submit", function(e) {
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
                                            "formulariocancerbucal"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/registrarpacienteCancerBucal.php",
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
                                        require 'conexionCancer.php';
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
                                        require 'conexionCancer.php';
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
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>ANTECEDENTES NO PATOLOGICOS</strong>
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




                                <!--********************************************************************************************************************************************************************-->

                                <!--Inicia la sección de Antecedentes Personales Patológicos-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>ANTECEDENTES PERSONALES PATOLÓGICOS</strong>
                                </div>


                                <!-- Inicia Sección de Toxicomanias-->
                                <div class="col-md-4" id="tipodetoxicomanias">
                                    <strong>Toxicomanias</strong>
                                    <select id="mstoxicomanias" name="mstoxicomanias[]" multiple="multiple" class="form-control">
                                        <option value="alcoholismo"> Alcoholismo</option>
                                        <option value="cocaina"> Cocaina</option>
                                        <option value="marihuana"> Marihuana</option>
                                        <option value="medicamentoscontrolados"> Medicamentos Controlados</option>
                                        <option value="solventes"> Solventes</option>
                                        <option value="tabaquismo"> Tabaquismo</option>
                                    </select>
                                </div>
                                <!-- si selecciona SÍ en Tabaquismo, se deben habiliar los siguientes dos campos:-->
                                <div class="col-md-4" id="anostabaquismo">
                                    <strong>Años Tabaquismo:</strong>
                                    <input id="anostabaquismo" name="anostabaquismo" type="number" class="form-control" placeholder="Ingrese años..." value="" required>
                                </div>
                                <div class="col-md-4" id="cigarrosdia">
                                    <strong>Cigarros al día:</strong>
                                    <input id="cigarrosdia" name="cigarrosdia" type="number" class="form-control" placeholder="Ingrese cigarros al día..." value="" required>
                                </div>
                                <!-- si selecciona SÍ en ALCOHOLISMO, se deben habiliar los siguientes dos campos:-->
                                <div class="col-md-3">
                                    <strong>Frecuencia Alcoholismo:</strong>
                                    <select name="frecuenciaal" id="frecuenciaal" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="social">Social</option>
                                        <option value="embriaguez">Embriaguez</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Sección de Toxicomanias-->


                                <!-- Select múltiple HÁBITOS-->
                                <div class="col-md-3" id="tipodehabitos">
                                    <strong>Hábitos</strong>
                                    <select id="mshabitos" name="mshabitos[]" multiple="multiple" class="form-control">
                                        <option value="autolesiones"> Autolesiones</option>
                                        <option value="bruxismo"> Bruxismo</option>
                                        <option value="interposicionlingual"> Interposición Lingual</option>
                                        <option value="onicofagia"> Onicofagía</option>
                                        <option value="queilofagia"> Queilofagía</option>
                                        <option value="respiracionoral"> Respiración Oral</option>
                                        <option value="succionlabial"> Succión Labial</option>
                                        <option value="succiondigital"> Succión Digital</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Select múltiple HÁBITOS-->


                                <!-- Select múltiple  Virus-->
                                <div class="col-md-3" id="tipodevirus">
                                    <strong>Virus</strong>
                                    <select id="msvirus" name="msvirus[]" multiple="multiple" class="form-control">
                                        <option value="vih"> VIH </option>
                                        <option value="vph"> VPH</option>
                                        <option value="ieb"> I. Epstein Barr</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Select múltiple  Virus-->


                                <!-- Select múltiple  CÁNCER-->
                                <div class="col-md-3" id="tipodecancer">
                                    <strong>Cáncer</strong>
                                    <select id="mscancer" name="mscancer[]" multiple="multiple" class="form-control">
                                        <option value="colon"> Colon y Recto </option>
                                        <option value="endometrio"> Endometrio</option>
                                        <option value="gastrico"> Gastrico</option>
                                        <option value="higado"> Hígado </option>
                                        <option value="leucemia"> Leucemia</option>
                                        <option value="linfoma"> Linfoma No Hodgkin</option>
                                        <option value="mama"> Mama </option>
                                        <option value="melanoma"> Melanoma</option>
                                        <option value="ovario"> Ovario</option>
                                        <option value="pancreas"> Páncreas </option>
                                        <option value="prostata"> Prostata</option>
                                        <option value="pulmon"> Pulmón</option>
                                        <option value="rinon"> Riñón </option>
                                        <option value="testiculo"> Testículo</option>
                                        <option value="tiroides"> Tiroides</option>
                                        <option value="vejiga"> Vejiga</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Select múltiple CÁNCER-->




                                <!--Inicia la sección de AFECTACIONES ORALES-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; 
                                    background-color: #d9a4a5;
                                    color:aliceblue;
                                    margin-top: 5px; 
                                    font-size: 13px; ">
                                    <strong>AFECTACIONES ORALES</strong>
                                </div>

                                <!-- FINALIZA Select múltiple AFECTACIONES ORALES-->
                                <div class="col-md-12" id="tipodeao">
                                    <strong>Afectaciones Orales</strong>
                                    <select id="msao" name="msao[]" multiple="multiple" class="form-control">
                                        <option value="eperiodontal"> Afectación Dental </option>
                                        <option value="odf"> Lesiones Orales</option>
                                        <option value="protesisfd"> Ubicación</option>
                                    </select>
                                </div>


                                <!-- del select múltiple de Afectaciones Orales, si se selecciona Afectación Dental, se debe abrir la siguiente sección-->
                                <!--inicia Afectación Dental-->
                                <div class="col-md-12" id="tituloafectaciondental" style="text-align: center; 
                                background-color: #c6b7bf;
                                color: aliceblue;
                                margin-top: 5px; 
                                font-size: 0px;">
                                    <strong>AFECTACIÓN DENTAL</strong>
                                </div>

                                <!-- Select múltiple AFECTACIONES ORALES-->
                                <div class="col-md-12" id="tipodeodf">
                                    <strong>Órgano Oral Lesionado</strong>
                                    <select id="msodf" name="msodf[]" multiple="multiple" class="form-control">
                                        <option value="eperiodontal"> Enfermedad Periodontal </option>
                                        <option value="odf"> Órgano Dental Fracturado</option>
                                        <option value="protesisfd"> Protesis Fija Desajustada</option>
                                        <option value="protesisff"> Protesis Fija Fracturada</option>
                                        <option value="protesisrd"> Protesis Removible Desajustada </option>
                                        <option value="protesisrf"> Protesis Removible Fracturada</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Select múltiple AFECTACIONES ORALES-->


                                <!--Si selecciona ORGANO DENTAL FRACTURADO, se deben habilitar los siguientes 4 multi select:-->
                                <!--Superior derecho-->
                                <div class="col-md-3" id="maxilarsd">
                                    <strong>Maxilar Superior Derecho</strong>
                                    <select id="msmaxilarsuperiorderecho" name="msmaxilarsuperiorderecho[]" multiple="multiple" class="form-control">
                                        <option value="once"> 11</option>
                                        <option value="doce"> 12</option>
                                        <option value="trce"> 13</option>
                                        <option value="catorce"> 14</option>
                                        <option value="quince"> 15</option>
                                        <option value="dieciseis"> 16</option>
                                        <option value="diecisiete"> 17</option>
                                        <option value="dieciocho"> 18</option>
                                    </select>
                                </div>

                                <!--Inferior derecho-->
                                <div class="col-md-3" id="maxilarid">
                                    <strong>Maxilar Inferior Derecho</strong>
                                    <select id="msmaxilarinferiorderecho" name="msmaxilarinferiorderecho[]" multiple="multiple" class="form-control">
                                        <option value="41"> 41</option>
                                        <option value="42"> 42</option>
                                        <option value="43"> 43</option>
                                        <option value="44"> 44</option>
                                        <option value="45"> 45</option>
                                        <option value="46"> 46</option>
                                        <option value="47"> 47</option>
                                        <option value="48"> 48</option>
                                    </select>
                                </div>

                                <!--Superior izquierdo-->
                                <div class="col-md-3" id="maxilarsd">
                                    <strong>Maxilar Superior Izquierdo</strong>
                                    <select id="msmaxilarsuperiorizquierdo" name="msmaxilarsuperiorizquierdo[]" multiple="multiple" class="form-control">
                                        <option value="21"> 21</option>
                                        <option value="22"> 22</option>
                                        <option value="23"> 23</option>
                                        <option value="24"> 24</option>
                                        <option value="25"> 25</option>
                                        <option value="26"> 26</option>
                                        <option value="27"> 27</option>
                                        <option value="28"> 28</option>
                                    </select>
                                </div>

                                <!--Inferior izquierdo -->
                                <div class="col-md-3" id="maxilarid">
                                    <strong>Maxilar Inferior Izquierdo</strong>
                                    <select id="msmaxilarinferiorizquierdo" name="msmaxilarinferiorizquierdo[]" multiple="multiple" class="form-control">
                                        <option value="31"> 31</option>
                                        <option value="32"> 32</option>
                                        <option value="33"> 33</option>
                                        <option value="34"> 34</option>
                                        <option value="35"> 35</option>
                                        <option value="36"> 36</option>
                                        <option value="37"> 37</option>
                                        <option value="38"> 38</option>
                                    </select>
                                </div>
                                <!--Finalizan los 4 multi select-->
                                <!--Finaliza la sección ORGANO DENTAL FRACTURADO-->




                                <!-- del select múltiple de Afectaciones Orales, si se selecciona LESIONES ORALES, se debe abrir la siguiente sección-->
                                <!--Inicia Lesiones Orales-->
                                <div class="col-md-12" id="titulolesionesorales" style="text-align: center; 
                                background-color: #c6b7bf;
                                color: aliceblue;
                                margin-top: 5px; 
                                font-size: 0px;">
                                    <strong>LESIONES ORALES</strong>
                                </div>

                                <!--Seleccion de sí o no en lesión oral:-->
                                <div class="col-md-3" id="">
                                    <strong>¿Lesión Oral?:</strong>
                                    <select name="tipotejido" id="tipotejido" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="silesion">Sí</option>
                                        <option value="nolesion">No</option>
                                    </select>
                                </div>

                                <!--Sí hay lesión oral, se hablitan:-->
                                <div class="col-md-3" id="">
                                    <strong>Tipo de Tejido:</strong>
                                    <select name="tipotejido" id="tipotejido" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="blando">Blando</option>
                                        <option value="duro">Duro</option>
                                    </select>
                                </div>

                                <!--Select múltiple de tipo de lesión -->
                                <div class="col-md-3" id="tipolesion">
                                    <strong>Tipo Lesión:</strong>
                                    <select id="mstipodelesion" name="mstipodelesion[]" multiple="multiple" class="form-control">
                                        <option value="melatonica"> Melatónica</option>
                                        <option value="nodulo"> Nodulo</option>
                                        <option value="pigmentada"> Pigmentada</option>
                                        <option value="tumor">Tumor</option>
                                        <option value="ulcera"> Ulcera</option>
                                        <option value="verruga"> Verruga</option>
                                        <option value="vesicula"> Vesicula</option>

                                    </select>
                                </div>

                                <!--Si se selecciona la opción PIGMENTADA se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Coloración:</strong>
                                    <select name="colorpigmentada" id="colorpigmentada" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="blanca">Blanca</option>
                                        <option value="roja">Roja</option>
                                        <option value="blancaroja">Blanca / Roja</option>
                                    </select>
                                </div>
                                <!-- Fin sección LESIONES ORALES-->



                                <!-- del select múltiple de Afectaciones Orales, si se selecciona UBICACIÓN, se debe abrir la siguiente sección-->
                                <!--Inicia Lesiones Orales-->
                                <div class="col-md-12" id="titulolesionesorales" style="text-align: center; 
                                background-color: #c6b7bf;
                                color: aliceblue;
                                margin-top: 5px; 
                                font-size: 0px;">
                                    <strong>UBICACIÓN</strong>
                                </div>


                                <!--Select múltiple de ubicación -->
                                <div class="col-md-12" id="ubicacion">
                                    <strong>Ubicación:</strong>
                                    <select id="msubicacion" name="msubicacion[]" multiple="multiple" class="form-control">
                                        <option value="derecha"> Derecha</option>
                                        <option value="izquierda"> Izquierda</option>
                                    </select>
                                </div>


                                <!---->
                                <div class="col-md-12" id="titulolesionesorales" style="text-align: center; 
                                background-color: #b3cefd;
                                color: aliceblue;
                                margin-top: 5px; 
                                font-size: 0px;">
                                    <strong>Ubicación Derecha</strong>
                                </div>

                                <div class="col-md-12" id="">
                                    <strong>Subsitio Anatómico:</strong>
                                    <select id="msqueva" name="msqueva[]" multiple="multiple" class="form-control">
                                        <option value="cuerpomandibular"> Cuerpo Mandibular</option>
                                        <option value="encia"> Encia</option>
                                        <option value="labios"> Labios</option>
                                        <option value="encia"> Encia</option>
                                        <option value="lengua"> Lengua</option>
                                        <option value="encia"> Encia</option>
                                        <option value="maxilarposterior"> Maxilar Posterior</option>
                                        <option value="mucosabucal"> Mucosa Bucal</option>
                                        <option value="paladarblando"> Paladar Blando</option>
                                        <option value="paladarduro"> Paladar Duro</option>
                                        <option value="piso"> Piso</option>
                                        <option value="premaxilar"> Premaxilar</option>
                                        <option value="procesoalveolar"> Proceso Alveolar</option>
                                        <option value="ramamandibular"> Rama Mandibular</option>
                                        <option value="trigono"> Trigono Retromolar</option>
                                    </select>
                                </div>


                                <!--Si se selecciona la opción LABIOS se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Labios:</strong>
                                    <select name="labios" id="labios" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="labioinferior">Labio Inferior</option>
                                        <option value="labiosuperior">Labio Superior</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opción LENGUA se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Lengua:</strong>
                                    <select name="lengua" id="lengua" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="bordelateral">Borde Lateral</option>
                                        <option value="caraventral">Cara Ventral</option>
                                        <option value="dorso">Dorso</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opción PALADAR BLANDO se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Paladar Blando:</strong>
                                    <select name="paladarblando" id="paladarblando" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="boveda">Boveda de Paladar</option>
                                        <option value="velo">Velo de Paladar</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opción ENCIA se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Encia:</strong>
                                    <select name="labios" id="labios" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="bucal">Bucal</option>
                                        <option value="interpapilar">Interpapilar</option>
                                        <option value="lingual">Lingual</option>
                                        <option value="paladar">Paladar</option>
                                    </select>
                                </div>


                                <!-- esta pendiente definir con qué campo se relaciona-->
                                <div class="col-md-6" id="">
                                    <strong>¿Está relacionado con un órgano dental?:</strong>
                                    <select name="relacion" id="relacion" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="si">Sí</option>
                                        <option value="no">No</option>
                                    </select>
                                </div><br><br>

                                <!--Si SÍ está comprometido con un órgano dental, se deben mostrar los siguientes MS-->
                                <!--Superior derecho-->
                                <div class="col-md-3" id="maxisd">
                                    <strong>Maxilar Superior Derecho</strong>
                                    <select id="msmaxisd" name="msmaxisd[]" multiple="multiple" class="form-control">
                                        <option value="once"> 11</option>
                                        <option value="doce"> 12</option>
                                        <option value="trce"> 13</option>
                                        <option value="catorce"> 14</option>
                                        <option value="quince"> 15</option>
                                        <option value="dieciseis"> 16</option>
                                        <option value="diecisiete"> 17</option>
                                        <option value="dieciocho"> 18</option>
                                    </select>
                                </div>

                                <!--Inferior derecho-->
                                <div class="col-md-3" id="maxiid">
                                    <strong>Maxilar Inferior Derecho</strong>
                                    <select id="msmaxiid" name="msmaxiid[]" multiple="multiple" class="form-control">
                                        <option value="41"> 41</option>
                                        <option value="42"> 42</option>
                                        <option value="43"> 43</option>
                                        <option value="44"> 44</option>
                                        <option value="45"> 45</option>
                                        <option value="46"> 46</option>
                                        <option value="47"> 47</option>
                                        <option value="48"> 48</option>
                                    </select>
                                </div>


                                <!---->
                                <div class="col-md-12" id="titulolesionesorales" style="text-align: center; 
                                background-color: #b3cefd;
                                color: aliceblue;
                                margin-top: 5px; 
                                font-size: 0px;">
                                    <strong>Ubicación Izquierda</strong>
                                </div>


                                <div class="col-md-12" id="">
                                    <strong>Subsitio Anatómico:</strong>
                                    <select id="msqueva2" name="msqueva2[]" multiple="multiple" class="form-control">
                                        <option value="cuerpomandibular"> Cuerpo Mandibular</option>
                                        <option value="encia"> Encia</option>
                                        <option value="labios"> Labios</option>
                                        <option value="encia"> Encia</option>
                                        <option value="lengua"> Lengua</option>
                                        <option value="encia"> Encia</option>
                                        <option value="maxilarposterior"> Maxilar Posterior</option>
                                        <option value="mucosabucal"> Mucosa Bucal</option>
                                        <option value="paladarblando"> Paladar Blando</option>
                                        <option value="paladarduro"> Paladar Duro</option>
                                        <option value="piso"> Piso</option>
                                        <option value="premaxilar"> Premaxilar</option>
                                        <option value="procesoalveolar"> Proceso Alveolar</option>
                                        <option value="ramamandibular"> Rama Mandibular</option>
                                        <option value="trigono"> Trigono Retromolar</option>
                                    </select>
                                </div>


                                <!--Si se selecciona la opción LABIOS se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Labios:</strong>
                                    <select name="labios" id="labios" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="labioinferior">Labio Inferior</option>
                                        <option value="labiosuperior">Labio Superior</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opción LENGUA se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Lengua:</strong>
                                    <select name="lengua" id="lengua" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="bordelateral">Borde Lateral</option>
                                        <option value="caraventral">Cara Ventral</option>
                                        <option value="dorso">Dorso</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opción PALADAR BLANDO se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Paladar Blando:</strong>
                                    <select name="paladarblando" id="paladarblando" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="boveda">Boveda de Paladar</option>
                                        <option value="velo">Velo de Paladar</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opción ENCIA se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="">
                                    <strong>Encia:</strong>
                                    <select name="labios" id="labios" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="bucal">Bucal</option>
                                        <option value="interpapilar">Interpapilar</option>
                                        <option value="lingual">Lingual</option>
                                        <option value="paladar">Paladar</option>
                                    </select>
                                </div><br><br>

                                <!-- esta pendiente definir con qué campo se relaciona-->
                                <div class="col-md-6" id="">
                                    <strong>¿Está relacionado con un órgano dental?:</strong>
                                    <select name="relacion" id="relacion" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="si">Sí</option>
                                        <option value="no">No</option>
                                    </select>
                                </div><br><br>


                                <!--Si SÍ está comprometido con un órgano dental, se deben mostrar los siguientes MS-->
                                <!--Superior izquierdo-->
                                <div class="col-md-3" id="maxisi">
                                    <strong>Maxilar Superior Izquierdo</strong>
                                    <select id="msmaxisi" name="msmaxisi[]" multiple="multiple" class="form-control">
                                        <option value="21"> 21</option>
                                        <option value="22"> 22</option>
                                        <option value="23"> 23</option>
                                        <option value="24"> 24</option>
                                        <option value="25"> 25</option>
                                        <option value="26"> 26</option>
                                        <option value="27"> 27</option>
                                        <option value="28"> 28</option>
                                    </select>
                                </div>

                                <!--Inferior izquierdo -->
                                <div class="col-md-3" id="maxiiz">
                                    <strong>Maxilar Inferior Izquierdo</strong>
                                    <select id="msmaxiiz" name="msmaxiiz[]" multiple="multiple" class="form-control">
                                        <option value="31"> 31</option>
                                        <option value="32"> 32</option>
                                        <option value="33"> 33</option>
                                        <option value="34"> 34</option>
                                        <option value="35"> 35</option>
                                        <option value="36"> 36</option>
                                        <option value="37"> 37</option>
                                        <option value="38"> 38</option>
                                    </select>
                                </div>
                                <!--Finalizan los 4 multi select-->



                                <!--********************************************************************************************************************************************************************-->

                                <!--Inicia la sección de ATENCIÓN CLINICA-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>ATENCIÓN CLINICA</strong>
                                </div>

                                <div class="col-md-4">
                                    <strong>Fecha primer atención:</strong>
                                    <input type="date" id="fechaatencioninicial" name="fechaatencioninicial" class="form-control">
                                </div>

                                <div class="col-md-4" id="estadiocli">
                                    <strong>Estadío Clinico</strong>
                                    <select name="estadioclinico" id="estadioclinico" class="form-control">
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
                                    <select name="etapaclinica" id="etapaclinica" class="form-control" readonly>
                                        <option value="TNM" selected>TNM</option>

                                    </select>
                                </div>
                                <!--********************************************************************************************************************************************************************-->





                                <!--********************************************************************************************************************************************************************-->
                                <!--Inicia la sección de HISTOPATOLOGÍA-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>HISTOPATOLOGÍA</strong>
                                </div>


                                <div class="col-md-12" id="estadiocli">
                                    <strong>Dx Histopatologico</strong>
                                    <select name="dxhistopatologico" id="dxhistopatologico" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="adenocarcinoma">Adenocarcinoma</option>
                                        <option value="adenoideoquistico">Adenoideoquistico</option>
                                        <option value="basocelular">Basocelular</option>
                                        <option value="carcinomaame">Carcinoma Ameloblastico</option>
                                        <option value="epidermoide">Epidermoide o Celulas Escamosas (Verrucoso o Basaloide)</option>
                                        <option value="lindoma">Linfoma</option>
                                        <option value="melanoma">Melanoma</option>
                                        <option value="metastasico">Metastásico</option>
                                        <option value="neuroendocrino">Neuroendocrino</option>
                                        <option value="sarcomakaposi">Sarcoma de Kaposi</option>
                                        <option value="sarcomatoide">Sarcomatoide</option>
                                    </select>
                                </div>



                                <div class="col-md-4">
                                    <strong>Fecha de Reporte:</strong>
                                    <input type="date" id="fechareporte" name="fechareporte" class="form-control">
                                </div>


                                <div class="col-md-4" id="">
                                    <strong>Tipo:</strong>
                                    <select name="tipohisto" id="tipohisto" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="benigno">Benigno</option>
                                        <option value="maligno">Maligno</option>
                                    </select>
                                </div>

                                <!--Si se selecciona Maligno, se debe mostrar el siguiente select-->
                                <div class="col-md-4" id="">
                                    <strong>Maligno:</strong>
                                    <select name="maligno" id="maligno" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="biendefinido">Bien Diferenciado</option>
                                        <option value="pocodefinido">Poco Diferenciado</option>
                                        <option value="indefinido">Indefinido</option>
                                    </select>
                                </div>



                                <!--********************************************************************************************************************************************************************-->
                                <!--Inicia la sección de INMUNOHISTOQUIMICA-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>INMUNOHISTOQUÍMICA</strong>
                                </div>

                                <div class="col-md-4" id="">
                                    <strong>¿Se realizó PDL?</strong>
                                    <select name="pdl" id="pdl" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="pdlsi">Sí</option>
                                        <option value="pdlno">No</option>
                                    </select>
                                </div>

                                <!--Si sí se realizó PDL se debe habilitar el siguiente campo-->

                                <div class="col-md-4">
                                    <strong id="inmuno-title">PDL</strong>
                                    <input type="number" id="pdl" name="pdl" placeholder="%" class="form-control" value="%">
                                </div>



                                <!--********************************************************************************************************************************************************************-->
                                <!--Inicia la sección de TRATAMIENTO, en esta sección se deben ver, de inicio solo tres campos QUIRURGICO, RECONSTRUCCIÓN Y RADIOTERAPIA-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>TRATAMIENTO</strong>
                                </div>

                                <!--PRIMER SELECT VISIBLE DE INICIO, QUIRURGICO-->
                                <div class="col-md-12" id="idquirurgico">
                                    <strong>*Quirurgico</strong>
                                    <select name="quirurgico" id="quirurgico" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="quirurgicosi">Sí</option>
                                        <option value="quirurgicono">No</option>
                                    </select>
                                </div>

                                <!--Si selecciona que sí en QUIRURGICO, se debe habilitar lo siguiente-->
                                <div class="col-md-4" id="idtipoquirurgico">
                                    <strong>Tipo de Cirugía</strong>
                                    <select name="tipoquirurgico" id="tipoquirurgico" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="amigdalectomia">Amigdalectomía</option>
                                        <option value="comando">Comando</option>
                                        <option value="diseccionradical">Disección Radical Modificada de Cuello</option>
                                        <option value="excisionlocalamplia">Excision Local Amplia</option>
                                        <option value="glosectomiaparcial">Glosectomía Parcial</option>
                                        <option value="hemiglosectomia">Hemiglosectomía</option>
                                        <option value="mandibulectomia">Mandibulectomía (Parcial, Segmentaria, Maginal)</option>
                                        <option value="maxilectomiainfra">Maxilectomia de Infraestructura</option>
                                        <option value="maxilectomiasuper">Maxilectomia de Superestructura</option>
                                        <option value="reseccionglandula">Resección de Glándula Salival Menor</option>
                                    </select>
                                </div>

                                <!--Si se selecciona Maxilectomia de Infraestructura, se debe mostrar lo siguiente-->
                                <div class="col-md-8" id="idmaxinfra">
                                    <strong>Maxilectomia de Infraestructura</strong>
                                    <select name="maxinfra" id="maxinfra" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="claseuno">Clase I. Resección quirúrgica clásica del maxilar que abarca paladar duro y dentición hasta la línea media, es unilateral.</option>
                                        <option value="clasedos">Clase II . Incluye defectos que mantienen la dentición del lado contralateral. Es unilateral posterior que no abarca hasta la línea media.</option>
                                        <option value="clasetres">Clase III. Implica un defecto en la línea media del paladar duro y puede incluir una porción del velo del paladar, sin involucrar proceso alveolar ni órganos dentarios</option>
                                        <option value="clasecuatro">Clase IV. Es un defecto extenso bilateral anterior, involucra dientes anteriores y posteriores.</option>
                                        <option value="clasecinco">Clase V. Defecto bilateral posterior, situado por detrás de los dientes remanentes.</option>
                                        <option value="claseseis">Clase VI. Defecto bilateral de la zona anterior sin involucrar dientes posteriores.</option>
                                    </select>
                                </div>


                                <!--Si se selecciona DISECCION RADICAL MODIFICADA DE CUELLO, se deben mostrar los siguientes 3 select: LUGAR, TIPO Y NIVEL CERVICAL-->
                                <div class="col-md-4" id="idlugar">
                                    <strong>Lugar</strong>
                                    <select name="maxinfra" id="maxinfra" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="bilateral">Bilateral</option>
                                        <option value="unilateral">Unilateral</option>
                                    </select>
                                </div>

                                <div class="col-md-4" id="idtipo">
                                    <strong>Tipo</strong>
                                    <select name="maxinfra" id="maxinfra" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Selectiva">Selectiva</option>
                                        <option value="Superselectiva">Superselectiva</option>
                                    </select>
                                </div>

                                <div class="col-md-4" id="idnivelcervical">
                                    <strong>Nivel Cervical</strong>
                                    <select name="nivelcervical" id="nivelcervical" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                    </select>
                                </div>
                                <!--Aquí finalizan los select que se habilitan/muestran si se selecciona DISECCION RADICAL MODIFICADA DE CUELLO -->






                                <!--SEGUNDO SELECT VISIBLE DE INICIO, RECONSTRUCCIÓN-->
                                <div class="col-md-6" id="idqreconstruccion">
                                    <strong>*Reconstrucción</strong>
                                    <select name="quirurgico" id="quirurgico" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="reconstruccionsi">Sí</option>
                                        <option value="reconstruccionno">No</option>
                                    </select>
                                </div>

                                <!--Si selecciona SÍ en reconstrucción, se debe mostrar lo siguiente-->
                                <div class="col-md-6" id="idnivelcervical">
                                    <strong>Tipo de Reconstrucción</strong>
                                    <select name="nivelcervical" id="nivelcervical" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="colgajomicro">Colgajo Microvascular</option>
                                        <option value="injertooseo">Injerto Óseo Autólogo o Cadavérico</option>
                                        <option value="materialdeosteo">Material de Osteosíntesis</option>
                                        <option value="rotaciondecolgajo">Rotación de Colgajo</option>
                                        <option value="tomayaplicaciondeinjertos">Toma y Aplicación de Injerto</option>
                                    </select>
                                </div>





                                <!--TERCER SELECT VISIBLE DE INICIO, RECONSTRUCCIÓN-->
                                <div class="col-md-12" id="idradio">
                                    <strong>*Radioterapia</strong>
                                    <select name="radio" id="radio" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="reconstruccionsi">Sí</option>
                                        <option value="reconstruccionno">No</option>
                                    </select>
                                </div>

                                <!--Si se selecciona SÍ en RADIOTERAPIA, se deben mostrar: FECHA, COMPLICACIONJES, MOMENTO RT-->
                                <div class="col-md-4">
                                    <strong>Fecha:</strong>
                                    <input type="date" id="fecharadio" name="fecharadio" class="form-control">
                                </div>

                                <div class="col-md-4" id="idcomplicaciones">
                                    <strong>Complicaciones</strong>
                                    <select name="complicaciones" id="complicaciones" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Caries">Caries</option>
                                        <option value="Disgeusia">Disgeusia</option>
                                        <option value="Dolor">Dolor</option>
                                        <option value="Fractura">Fractura</option>
                                        <option value="Infeccion">Infeccion</option>
                                        <option value="Hemorragias">Hemorragias</option>
                                        <option value="Mucositis">Mucositis</option>
                                        <option value="Osteonecrosis">Osteonecrosis</option>
                                        <option value="Parestesia">Parestesia</option>
                                        <option value="Propios">Propios De La Anestesia Local</option>
                                        <option value="Radiodermitis">Radiodermitis</option>
                                        <option value="Reaccionalergica">Reaccion Alergica</option>
                                        <option value="Trismus">Trismus</option>
                                        <option value="Xerostomia">Xerostomia</option>
                                    </select>
                                </div>

                                <div class="col-md-4" id="idmomentort">
                                    <strong>Momento RT</strong>
                                    <select name="moentort" id="momentort" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="adyuvante">Adyuvante</option>
                                        <option value="paliativa">Paliativa</option>
                                        <option value="radical">Radical</option>
                                    </select>
                                </div>

                                <!--AQUI FINALIZAN LOS COMBOS QUE SE MUESTRAN SI SE SELECCIONA SÍ EN RADIOTERAPIA-->

                                <!--AQUI FALTA REVISAR SI ESTOS COMBOS SE VAN A MOSTRAR DESDE UN INICIO O SI DEPENDEN DE UNA SELECCION (TX COMPLICACIONES ORALES, DOSIS, FRACCIONES, TECNICA,OARS DOSIS)-->


                                <div class="col-md-3" id="idtxcomplicaciones">
                                    <strong>Tx Complicaciones Orales</strong>
                                    <select name="txcomplicaciones" id="txcomplicaciones" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="crioterapia">Crioterapia</option>
                                        <option value="Farmacológico">Farmacológico</option>
                                        <option value="Laser">Laser</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <strong>Dosis</strong>
                                    <input type="number" class="form-control" id="dosis" name="dosis" placeholder="Ingrese cG...">
                                </div>

                                <div class="col-md-3" id="idfracciones">
                                    <strong>Fracciones</strong>
                                    <select name="fracciones" id="fracciones" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Convencional">Convencional</option>
                                        <option value="Hiperfraccionamiento">Hiperfraccionamiento</option>
                                        <option value="Hipofraccionamiento">Hipofraccionamiento</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <strong>No. Fracciones</strong>
                                    <input type="number" class="form-control" id="fracciones" name="fracciones" placeholder="Ingrese..." readonly>
                                </div>

                                <div class="col-md-3" id="idtecnica">
                                    <strong>Tecnica</strong>
                                    <select name="tecnica" id="tecnica" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="3D">3D Conformal</option>
                                        <option value="braquiterapia">Braquiterapia</option>
                                        <option value="imrt">IMRT</option>
                                    </select>
                                </div>

                                <div class="col-md-5" id="idoars">
                                    <strong>OARS Dosis</strong>
                                    <select name="oarsdosis" id="oarsdosis" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="cavidadoral">Cavidad Oral</option>
                                        <option value="cocleas">Cocleas</option>
                                        <option value="cristalinos">Crsitalinos</option>
                                        <option value="esofago">Esófago</option>
                                        <option value="labios">Labios</option>
                                        <option value="laringe">Laringe</option>
                                        <option value="mandibula">Mandibula</option>
                                        <option value="medula">Médula </option>
                                        <option value="nerviooptico">Nervio Óptico</option>
                                        <option value="ojos">Ojos</option>
                                        <option value="pared">Pared Faringea Posterior</option>
                                        <option value="parotidas">Parotidas</option>
                                        <option value="sublinguales">Sublinguales</option>
                                        <option value="tallo">Tallo</option>
                                        <option value="tiroides">Tiroides</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <strong>Dosis Máxima</strong>
                                    <input type="number" class="form-control" id="dosismaxima" name="dosismaxima" placeholder="Ingrese...">
                                </div>

                                <div class="col-md-2">
                                    <strong>Dosis Promedio</strong>
                                    <input type="number" class="form-control" id="dosispromedio" name="dosispromedio" placeholder="Ingrese...">
                                </div>

                                <!--********************************************************************************************************************************************************************-->





                                <!--********************************************************************************************************************************************************************-->
                                <!--Inicia la sección de DEFUNCIÓN-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>DEFUNCIÓN</strong>
                                </div>


                                <fieldset class="col-md-2">
                                    <strong>Defunción</strong><br>
                                    &nbsp;<strong>Si</strong>
                                    <input type="radio" name="defunsi" id="defunsionsi" onclick="defusi();" class="check" value="si">
                                    &nbsp;<strong>No</strong>
                                    <input type="radio" name="defunsi" id="defunsionno" onclick="defuno();" class="check" value="no" checked>
                                </fieldset>

                                <!--En caso de seleccionar que sí, se deben mostrar/habilitar fecha y Causa-->

                                <div class="col-md-5" id="defuncionfecha">
                                    <strong>Fecha Defunción</strong>
                                    <input type="date" name="fechadeladefuncion" id="fechadeladefuncion" class="form-control" value="0000/00/00">
                                </div>

                                <div class="col-md-5" id="defuncioncausa">
                                    <strong>Causa</strong>
                                    <select name="causadefuncion" id="causadefuncion" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Oncologica">Oncologica</option>
                                        <option value="No oncologica">No oncologica</option>
                                    </select>
                                </div>
                            </div>



                            <!--********************************************************************************************************************************************************************-->
                            <!--Inicia la sección de CASO ÉXITOSO-->
                            <div class="col-md-12"></div>
                            <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                <strong>CASO ÉXITOSO</strong>
                            </div>

                            <fieldset class="col-md-2">
                                <strong>Caso Éxitoso</strong><br>
                                &nbsp;<strong>Si</strong>
                                <input type="radio" name="exitosi" id="casoexitososi" onclick="exitosi();" class="check" value="si">
                                &nbsp;<strong>No</strong>
                                <input type="radio" name="exitosi" id="casoexitosono" onclick="exitono();" class="check" value="no" checked>
                            </fieldset>


                            <div class="col-md-5" id="idrespuestatratamiento">
                                <strong>Respuesta al Tratamiento</strong>
                                <select name="respuestatratamiento" id="respuestatratamiento" class="form-control">
                                    <option value="Sin registro">Sin registro</option>
                                    <option value="completa">Completa</option>
                                    <option value="nula">Nula</option>
                                    <option value="parcial">Parcial</option>
                                </select>
                            </div>
                    </div>







                    <!--********************************************************************************************************************************************************************-->
                    <div class="col-md-12"></div>
                    <br>

                    <input type="submit" id="registrar" value="Guardar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
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