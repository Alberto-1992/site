<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="cancerbucal">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
                                    <input list="curpusuario" id="curp" name="curp" type="text" class="control form-control" onblur="curp2datebucal();" minlength="18" maxlength="18" required>
                                    <datalist id="curpusuario">
                                        <option value="">Seleccione</option>
                                        <?php
                                        require 'conexionCancer.php';
                                        $query = $conexionCancer->prepare("SELECT curpbucal FROM dato_usuariobucal ");
                                        $query->execute();
                                        $query->setFetchMode(PDO::FETCH_ASSOC);
                                        while ($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['curpbucal']; ?>">
                                                <?php echo $row['curpbucal']; ?></option>
                                        <?php } ?>
                                    </datalist>
                                </div>


                                <div class="col-md-4">
                                    <strong>Nombre Completo</strong>
                                    <input id="nombrecompleto" name="nombrecompleto" onblur="calcularEdadbucal();" type="text" class="control form-control" required>
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
                                    <input id="fecha" name="fecha" type="date" onblur="curp2datebucal();" class="form-control" readonly>
                                </div>
                                <div class="col-md-4">
                                    <strong>Edad</strong>
                                    <input id="edad" name="edad" type="text" class="form-control" readonly>
                                </div>

                                <div class="col-md-4">
                                    <strong>Sexo</strong>
                                    <input type="text" class="form-control" id="sexo" onclick="curp2datebucal();" name="sexo" readonly>

                                </div>

                                <!-- SE QUITA RAZA
                                <div class="col-md-3">
                                    <strong>Raza</strong>
                                    <input type="text" class="form-control" id="raza" onclick="curp2datebucal();" name="raza">
                                </div>-->

                                <script>
                                    /*
                                    $(document).ready(function() {
                                        $('#presionarterial').mask('000/000');
                                    });*/
                                    $(document).ready(function() {
                                        $('#tallabucal').mask('0.00');
                                    });
                                </script>

                                <div class="col-md-4">
                                    <strong>Talla</strong>
                                    <input type="number" step="any" class="form-control" id="tallabucal" name="tallabucal" required>

                                </div>
                                <div class="col-md-4">
                                    <strong>Peso</strong>
                                    <input type="number" step="any" class="form-control" id="pesobucal" onblur="calculaIMC();" name="pesobucal" required>

                                </div>
                                <div class="col-md-4">
                                    <strong>IMC</strong>
                                    <input type="text" class="form-control" id="imcbucal" onblur="calculaIMC();" name="imcbucal" readonly>

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
                                    <strong>Delegaci??n o Municipio</strong>
                                    <select name="cbx_municipio" id="cbx_municipio" class="form-control" style="width: 100%;">

                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Referenciado</strong>
                                    <select name="referenciado" id="referenciado" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Si">S??</option>
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





                                <!-- Inicia Secci??n de Antecedentes No Patol??gicos-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>ANTECEDENTES NO PATOLOGICOS</strong>
                                </div>

                                <div class="col-md-4">
                                    <strong>Exposici??n Solar</strong>
                                    <select name="exposicionsolarbucal" id="exposicionsolarbucal" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="si">S??</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Comidas al D??a</strong>
                                    <select name="comidasbucal" id="comidasbucal" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3 o m??s</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Higiene Bucal</strong>
                                    <select name="higienebucal" id="higienebucal" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Ninguno">Ninguno</option>
                                        <option value="1 vez al dia">1 vez al d??a</option>
                                        <option value="2 veces al dia">2 veces al d??a</option>
                                        <option value="3 o mas veces al dia">3 o m??s veces al d??a</option>
                                    </select>
                                </div>
                                <!-- Finaliza Secci??n de Antecedentes No Patol??gicos-->




                                <!--********************************************************************************************************************************************************************-->

                                <!--Inicia la secci??n de Antecedentes Personales Patol??gicos-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>ANTECEDENTES PERSONALES PATOL??GICOS</strong>
                                </div>


                                <!-- Inicia Secci??n de Toxicomanias-->
                                <div class="col-md-12">
                                    <strong>Toxicomanias</strong>
                                    <select id="mstoxicomanias" name="mstoxicomanias[]" multiple="multiple" class="form-control">
                                        <option value="Alcoholismo"> Alcoholismo</option>
                                        <option value="Tabaquismo"> Tabaquismo</option>
                                        <option value="Cocaina"> Coca??na</option>
                                        <option value="Marihuana"> Marihuana</option>
                                        <option value="Medicamentos Controlados"> Medicamentos Controlados</option>
                                        <option value="Solventes"> Solventes</option>
                                        <option value="Ninguno">Ninguno</option>
                                    </select>
                                </div>
                                <!-- si selecciona S?? en ALCOHOLISMO, se deben habiliar los siguientes dos campos:-->
                                <div class="col-md-4" id="alcoholismofrecuencia">
                                    <strong>Frecuencia Alcoholismo:</strong>
                                    <select name="frecuenciaal" id="frecuenciaal" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Social">Social</option>
                                        <option value="Embriaguez">Embriaguez</option>

                                    </select>
                                </div>

                                <!-- si selecciona S?? en Tabaquismo, se deben habiliar los siguientes dos campos:-->
                                <div class="col-md-4" id="yearstabaquismo">
                                    <strong>A??os Tabaquismo:</strong>
                                    <input id="anostabaquismo" name="anostabaquismo" type="number" class="form-control" placeholder="Ingrese a??os..." >
                                </div>
                                <div class="col-md-4" id="diacigarros">
                                    <strong>Cigarros al d??a:</strong>
                                    <input id="cigarrosdia" name="cigarrosdia" type="number" class="form-control" placeholder="Ingrese cigarros al d??a...">
                                </div>
                                <!-- FINALIZA Secci??n de Toxicomanias-->


                                <!-- Select m??ltiple H??BITOS-->
                                <div class="col-md-4" id="tipodehabitos">
                                    <strong>H??bitos</strong>
                                    <select id="mshabitos" name="mshabitos[]" multiple="multiple" class="form-control">
                                        <option value="Autolesiones"> Autolesiones</option>
                                        <option value="Bruxismo"> Bruxismo</option>
                                        <option value="Interposicion Lingual"> Interposici??n Lingual</option>
                                        <option value="Onicofagia"> Onicofag??a</option>
                                        <option value="Queilofagia"> Queilofag??a</option>
                                        <option value="Respiracion Oral"> Respiraci??n Oral</option>
                                        <option value="Succion Labial"> Succi??n Labial</option>
                                        <option value="Succion Digital"> Succi??n Digital</option>
                                        <option value="Ninguno">Ninguno</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Select m??ltiple H??BITOS-->


                                <!-- Select m??ltiple  Virus-->
                                <div class="col-md-4" id="tipodevirus">
                                    <strong>Virus</strong>
                                    <select id="msvirus" name="msvirus[]" multiple="multiple" class="form-control">
                                        <option value="VIH"> VIH </option>
                                        <option value="VPH"> VPH</option>
                                        <option value="I. Epstein Barr"> I. Epstein Barr</option>
                                        <option value="Ninguno">Ninguno</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Select m??ltiple  Virus-->


                                <!-- Select m??ltiple  C??NCER-->
                                <div class="col-md-4" id="tipodecancer">
                                    <strong>C??ncer</strong>
                                    <select id="mscancer" name="mscancer[]" multiple="multiple" class="form-control">
                                        <option value="Colon y Recto"> Colon y Recto </option>
                                        <option value="Endometrio"> Endometrio</option>
                                        <option value="Gastrico"> Gastrico</option>
                                        <option value="Higado"> H??gado </option>
                                        <option value="Leucemia"> Leucemia</option>
                                        <option value="Linfoma No Hodgkin"> Linfoma No Hodgkin</option>
                                        <option value="Mama"> Mama </option>
                                        <option value="Melanoma"> Melanoma</option>
                                        <option value="Ovario"> Ovario</option>
                                        <option value="Pancreas"> P??ncreas </option>
                                        <option value="Prostata"> Pr??stata</option>
                                        <option value="Pulmon"> Pulm??n</option>
                                        <option value="Rinon"> Ri????n </option>
                                        <option value="Testiculo"> Test??culo</option>
                                        <option value="Tiroides"> Tiroides</option>
                                        <option value="Vejiga"> Vejiga</option>
                                        <option value="Ninguno">Ninguno</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Select m??ltiple C??NCER-->




                                <!--Inicia la secci??n de AFECTACIONES ORALES-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; 
                                    background-color: #d9a4a5;
                                    color:aliceblue;
                                    margin-top: 5px; 
                                    font-size: 13px; ">
                                    <strong>AFECTACIONES ORALES</strong>
                                </div>

                                <!-- FINALIZA Select m??ltiple AFECTACIONES ORALES-->
                                <div class="col-md-12" id="tipodeao">
                                    <strong>Afectaciones Orales</strong>
                                    <select id="msao" name="msao[]" multiple="multiple" class="form-control">
                                        <option value="Afectacion Dental"> Afectaci??n Dental </option>
                                        <option value="Lesiones Orales"> Lesiones Orales</option>
                                        <option value="Ubicacion"> Ubicaci??n</option>
                                    </select>
                                </div>


                                <!-- del select m??ltiple de Afectaciones Orales, si se selecciona Afectaci??n Dental, se debe abrir la siguiente secci??n-->
                                <!--inicia Afectaci??n Dental-->
                                <div class="col-md-12" id="tituloafectaciondental" style="text-align: center; 
                                background-color: #c6b7bf;
                                color: aliceblue;
                                margin-top: 5px; 
                                font-size: 0px;">
                                    <strong>AFECTACI??N DENTAL</strong>
                                </div>

                                <!-- Select m??ltiple AFECTACIONES ORALES-->
                                <div class="col-md-12" id="tipodeodf">
                                    <strong>??rgano Oral Lesionado</strong>
                                    <select id="msodf" name="msodf[]" multiple="multiple" class="form-control">
                                        <option value="Enfermedad Periodontal"> Enfermedad Periodontal </option>
                                        <option value="Organo Dental Fracturado"> ??rgano Dental Fracturado</option>
                                        <option value="Protesis Fija Desajustada"> Protesis Fija Desajustada</option>
                                        <option value="Protesis Fija Fracturada"> Protesis Fija Fracturada</option>
                                        <option value="Protesis Removible Desajustada"> Protesis Removible Desajustada </option>
                                        <option value="Protesis Removible Fracturada"> Protesis Removible Fracturada</option>
                                    </select>
                                </div>
                                <!-- FINALIZA Select m??ltiple AFECTACIONES ORALES-->


                                <!--Si selecciona ORGANO DENTAL FRACTURADO, se deben habilitar los siguientes 4 multi select:-->
                                <!--Superior derecho-->
                                <div class="col-md-3" id="maxilarsd">
                                    <strong>Maxilar Superior Derecho</strong>
                                    <select id="msmaxilarsuperiorderecho" name="msmaxilarsuperiorderecho[]" multiple="multiple" class="form-control">
                                        <option value="11"> 11</option>
                                        <option value="12"> 12</option>
                                        <option value="13"> 13</option>
                                        <option value="14"> 14</option>
                                        <option value="15"> 15</option>
                                        <option value="16"> 16</option>
                                        <option value="17"> 17</option>
                                        <option value="18"> 18</option>
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
                                <div class="col-md-3" id="maxilarsd2">
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
                                <div class="col-md-3" id="maxilarid2">
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
                                <!--Finaliza la secci??n ORGANO DENTAL FRACTURADO-->
                                <!-- del select m??ltiple de Afectaciones Orales, si se selecciona LESIONES ORALES, se debe abrir la siguiente secci??n-->
                                <!--Inicia Lesiones Orales-->
                                <div class="col-md-12" id="titulolesionesorales" style="text-align: center; 
                                background-color: #c6b7bf;
                                color: aliceblue;
                                margin-top: 5px; 
                                font-size: 0px;">
                                    <strong>LESIONES ORALES</strong>
                                </div>

                                <!--Seleccion de s?? o no en lesi??n oral:-->

                                <div class="col-md-3" id="lesionoral">
                                    <strong>??Lesi??n Oral?:</strong>
                                    <select name="tipolesionoral" id="tipolesionoral" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">S??</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <!--S?? hay lesi??n oral, se hablitan:-->
                                <div class="col-md-3" id="tejidotipo">
                                    <strong>Tipo de Tejido:</strong>
                                    <select name="tipotejido" id="tipotejido" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Blando">Blando</option>
                                        <option value="Duro">Duro</option>
                                    </select>
                                </div>

                                <!--Select m??ltiple de tipo de lesi??n -->
                                <div class="col-md-3" id="tipolesion">
                                    <strong>Tipo Lesi??n:</strong>
                                    <select id="mstipodelesion" name="mstipodelesion[]" multiple="multiple" class="form-control">
                                        <option value="Melatonica"> Melat??nica</option>
                                        <option value="Nodulo"> Nodulo</option>
                                        <option value="Pigmentada"> Pigmentada</option>
                                        <option value="Tumor">Tumor</option>
                                        <option value="Ulcera"> Ulcera</option>
                                        <option value="Verruga"> Verruga</option>
                                        <option value="Vesicula"> Vesicula</option>

                                    </select>
                                </div>

                                <!--Si se selecciona la opci??n PIGMENTADA se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="coloracion">
                                    <strong>Coloraci??n:</strong>
                                    <select name="colorpigmentada" id="colorpigmentada" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Blanca">Blanca</option>
                                        <option value="Roja">Roja</option>
                                        <option value="Blanca y Roja">Blanca / Roja</option>
                                    </select>
                                </div>
                                <!-- Fin secci??n LESIONES ORALES-->



                                <!-- del select m??ltiple de Afectaciones Orales, si se selecciona UBICACI??N, se debe abrir la siguiente secci??n-->
                                <!--Inicia Lesiones Orales-->
                                <div class="col-md-12" id="tituloubicacion" style="text-align: center; 
                                background-color: #c6b7bf;
                                color: aliceblue;
                                margin-top: 5px; 
                                font-size: 0px;">
                                    <strong>UBICACI??N</strong>
                                </div>


                                <!--Select m??ltiple de ubicaci??n -->
                                <div class="col-md-12" id="ubicacion">
                                    <strong>Ubicaci??n:</strong>
                                    <select id="msubicacion" name="msubicacion[]" multiple="multiple" class="form-control">
                                        <option value="Derecha"> Derecha</option>
                                        <option value="Izquierda"> Izquierda</option>
                                    </select>
                                </div>


                                <!---->
                                <div class="col-md-12" id="tituloubicacionderecha" style="text-align: center; 
                                background-color: #b3cefd;
                                color: aliceblue;
                                margin-top: 5px; 
                                font-size: 0px;">
                                    <strong>Ubicaci??n Derecha</strong>
                                </div>

                                <div class="col-md-12" id="subanatomico">
                                    <strong>Subsitio Anat??mico:</strong>
                                    <select id="msqueva" name="msqueva[]" multiple="multiple" class="form-control">
                                        <option value="Cuerpo Mandibular"> Cuerpo Mandibular</option>
                                        <option value="Encia Superior"> Encia Superior</option>
                                        <option value="Labios"> Labios</option>
                                        <option value="Lengua"> Lengua</option>
                                        <option value="Encia Inferior"> Encia Inferior </option>
                                        <option value="Maxilar Posterior"> Maxilar Posterior</option>
                                        <option value="Mucosa Bucal"> Mucosa Bucal</option>
                                        <option value="Paladar Blando"> Paladar Blando</option>
                                        <option value="Paladar Duro"> Paladar Duro</option>
                                        <option value="Piso"> Piso</option>
                                        <option value="Premaxilar"> Premaxilar</option>
                                        <option value="Proceso Alveolar"> Proceso Alveolar</option>
                                        <option value="Rama Mandibular"> Rama Mandibular</option>
                                        <option value="Trigono Retromolar"> Trigono Retromolar</option>
                                    </select>
                                </div>


                                <!--Si se selecciona la opci??n LABIOS se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="labiospanel">
                                    <strong>Labios:</strong>
                                    <select name="labios" id="labios" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Labio Inferior">Labio Inferior</option>
                                        <option value="Labio Superior">Labio Superior</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opci??n LENGUA se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="lenguapanel">
                                    <strong>Lengua:</strong>
                                    <select name="lengua" id="lengua" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Borde Lateral">Borde Lateral</option>
                                        <option value="Cara Ventral">Cara Ventral</option>
                                        <option value="Dorso">Dorso</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opci??n PALADAR BLANDO se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="paladarblandopanel">
                                    <strong>Paladar Blando:</strong>
                                    <select name="paladarblando" id="paladarblando" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Boveda de Paladar">Boveda de Paladar</option>
                                        <option value="Velo de Paladar">Velo de Paladar</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="paladarduropanel">
                                    <strong>Paladar Duro:</strong>
                                    <select name="paladarduro" id="paladarduro" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Boveda de Paladar">Boveda de Paladar</option>
                                        <option value="Velo de Paladar">Velo de Paladar</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opci??n ENCIA se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="enciapanel">
                                    <strong>Encia superior:</strong>
                                    <select name="encia" id="encia" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Bucal">Bucal</option>
                                        <option value="Interpapilar">Interpapilar</option>
                                        <option value="Lingual">Lingual</option>
                                        <option value="Paladar">Paladar</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="enciapanelinferior">
                                    <strong>Encia inferior:</strong>
                                    <select name="enciainferior" id="enciainferior" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Bucal">Bucal</option>
                                        <option value="Interpapilar">Interpapilar</option>
                                        <option value="Lingual">Lingual</option>
                                        <option value="Paladar">Paladar</option>
                                    </select>
                                </div>


                                <!-- esta pendiente definir con qu?? campo se relaciona-->
                                <div class="col-md-6" id="relacionpanel">
                                    <strong>??Est?? relacionado con un ??rgano dental?:</strong>
                                    <select name="relacion" id="relacion" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">S??</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <!--Si S?? est?? comprometido con un ??rgano dental, se deben mostrar los siguientes MS-->
                                <!--Superior derecho-->
                                <div class="col-md-3" id="maxisd">
                                    <strong>Maxilar Superior Derecho</strong>
                                    <select id="msmaxisd" name="msmaxisd[]" multiple="multiple" class="form-control">
                                        <option value="11"> 11</option>
                                        <option value="12"> 12</option>
                                        <option value="13"> 13</option>
                                        <option value="14"> 14</option>
                                        <option value="15"> 15</option>
                                        <option value="16"> 16</option>
                                        <option value="17"> 17</option>
                                        <option value="18"> 18</option>
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
                                <div class="col-md-12" id="tituloubicacionizquierda" style="text-align: center; 
                                background-color: #b3cefd;
                                color: aliceblue;
                                margin-top: 5px; 
                                font-size: 0px;">
                                    <strong>Ubicaci??n Izquierda</strong>
                                </div>


                                <div class="col-md-12" id="subanatomicoiz">
                                    <strong>Subsitio Anat??mico:</strong>
                                    <select id="msqueva2" name="msqueva2[]" multiple="multiple" class="form-control">
                                        <option value="Cuerpo Mandibular"> Cuerpo Mandibular</option>
                                        <option value="Encia Superior"> Encia Superior</option>
                                        <option value="Labios"> Labios</option>
                                        <option value="Lengua"> Lengua</option>
                                        <option value="Encia Inferior"> Encia Inferior </option>
                                        <option value="Maxilar Posterior"> Maxilar Posterior</option>
                                        <option value="Mucosa Bucal"> Mucosa Bucal</option>
                                        <option value="Paladar Blando"> Paladar Blando</option>
                                        <option value="Paladar Duro"> Paladar Duro</option>
                                        <option value="Piso"> Piso</option>
                                        <option value="Premaxilar"> Premaxilar</option>
                                        <option value="Proceso Alveolar"> Proceso Alveolar</option>
                                        <option value="Rama Mandibular"> Rama Mandibular</option>
                                        <option value="Trigono Retromolar"> Trigono Retromolar</option>
                                    </select>
                                </div>


                                <!--Si se selecciona la opci??n LABIOS se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="labiospaneliz">
                                    <strong>Labios:</strong>
                                    <select name="labiosiz" id="labiosiz" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Labio Inferior">Labio Inferior</option>
                                        <option value="Labio Superior">Labio Superior</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opci??n LENGUA se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="lenguapaneliz">
                                    <strong>Lengua:</strong>
                                    <select name="lenguaiz" id="lenguaiz" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Borde Lateral">Borde Lateral</option>
                                        <option value="Cara Ventral">Cara Ventral</option>
                                        <option value="Dorso">Dorso</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opci??n PALADAR BLANDO se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="paladarblandopaneliz">
                                    <strong>Paladar Blando:</strong>
                                    <select name="paladarblandoiz" id="paladarblandoiz" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Boveda de Paladar">Boveda de Paladar</option>
                                        <option value="Velo de Paladar">Velo de Paladar</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="paladarduropaneliz">
                                    <strong>Paladar Duro:</strong>
                                    <select name="paladarduroiz" id="paladarduroiz" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Boveda de Paladar">Boveda de Paladar</option>
                                        <option value="Velo de Paladar">Velo de Paladar</option>
                                    </select>
                                </div>

                                <!--Si se selecciona la opci??n ENCIA se debe habilitar el siguiente select simple-->
                                <div class="col-md-3" id="enciapaneliz">
                                    <strong>Encia superior:</strong>
                                    <select name="enciaiz" id="enciaiz" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Bucal">Bucal</option>
                                        <option value="Interpapilar">Interpapilar</option>
                                        <option value="Lingual">Lingual</option>
                                        <option value="Paladar">Paladar</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="enciapanelinferioriz">
                                    <strong>Encia inferior:</strong>
                                    <select name="enciaizinferior" id="enciaizinferior" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Bucal">Bucal</option>
                                        <option value="Interpapilar">Interpapilar</option>
                                        <option value="Lingual">Lingual</option>
                                        <option value="Paladar">Paladar</option>
                                    </select>
                                </div>
                                
                                <br><br>

                                <!-- esta pendiente definir con qu?? campo se relaciona-->
                                <div class="col-md-6" id="relacionpaneliz">
                                    <strong>??Est?? relacionado con un ??rgano dental?:</strong>
                                    <select name="relacioniz" id="relacioniz" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">S??</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>


                                <!--Si S?? est?? comprometido con un ??rgano dental, se deben mostrar los siguientes MS-->
                                <!--Superior izquierdo-->
                                <div class="col-md-3" id="maxisdiz">
                                    <strong>Maxilar Superior Izquierdo</strong>
                                    <select id="msmaxisiiz" name="msmaxisiiz[]" multiple="multiple" class="form-control">
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
                                <div class="col-md-3" id="maxiidiz">
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

                                <!--Inicia la secci??n de ATENCI??N CLINICA-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>ATENCI??N CLINICA</strong>
                                </div>

                                <div class="col-md-4">
                                    <strong>Fecha primer atenci??n:</strong>
                                    <input type="date" id="fechaatencioninicial" name="fechaatencioninicial" class="form-control">
                                </div>

                                <div class="col-md-4" id="estadiocli">
                                    <strong>Estad??o Clinico</strong>
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



                                <div class="col-md-4">
                                    <strong>Tama??o tumoral</strong>
                                    <select name="tamaniotumoral" id="tamaniotumoral" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="TX: Tumor primario no puede ser evaluado">TX: Tumor primario no puede ser evaluado </option>
                                        <option value="Tis: Carcinoma insitu">Tis: Carcinoma insitu </option>
                                        <option value="T1 Menor o igual a 2cm">T1 Menor o igual a 2cm</option>
                                        <option value="T3 mas de 5cm">T3 mas de 5cm </option>
                                        <option value="T4 cualquier tama??o extension a piel o pared toracica">T4 cualquier tama??o extension a piel o pared toracica</option>
                                    </select>
                                </div>


                                <div class="col-md-4">
                                    <strong>Compromiso Linf??tico Nodal</strong>
                                    <select name="compromisolinfatico" id="compromisolinfatico" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="NX: No puede ser evaluado por falta de datos">NX: No puede ser evaluado por falta de datos </option>
                                        <option value="N0:Ausencia de adenopatias palpables">N0:Ausencia de adenopatias palpables</option>
                                        <option value="N1: Mets. Axilar homolateral movil palpable">N1: Mets. Axilar homolateral movil palpable</option>
                                        <option value="N2. Mets. Axilar homolateral fija o mets en mamaria interna detectable por imagen o por E.F. en ausencia clinica de mets en axila">N2. Mets. Axilar homolateral fija o mets en mamaria interna detectable por imagen o por E.F. en ausencia clinica de mets en axila </option>
                                        <option value="N3. Metastasis en ganglios infra o supraclaviculares">N3. Metastasis en ganglios infra o supraclaviculares</option>
                                    </select>
                                </div>


                                <div class="col-md-4">
                                    <strong>Met??stasis</strong>
                                    <select name="metastasisbucal" id="metastasisbucal" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="MX: No se pueden evaluar metastasis distantes">MX: No se pueden evaluar metastasis distantes</option>
                                        <option value="M0 Sin enfermedad a distancia">M0 Sin enfermedad a distancia</option>
                                        <option value="M1 Con enfermedad metastasica">M1 Con enfermedad metastasica</option>
                                    </select>
                                </div>

                                <!-- SI SE SELECCIONA M1 EN MET??STASIS, SE DEBE HABILITAR EL SIGUIENTE SELECT M??LTIPLE-->
                                <div class="col-md-4" id="idmssitiometastasis">
                                    <strong>Sitio Met??stasis</strong>
                                    <select id="mssitiometastasis" name="mssitiometastasis[]" multiple="multiple" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Hepatica">Hepatica</option>
                                        <option value="Pulmonar">Pulmonar</option>
                                        <option value="Cerebrales">Cerebrales</option>
                                        <option value="Oseas">??seas</option>
                                        <option value="Cervicouterino">Cervicouterino</option>
                                        <option value="Mediastino">Mediastino</option>
                                        <option value="Suprarrenal">Suprarrenal</option>
                                        <option value="Tiroidea">Tiroidea</option>
                                        <option value="Ganglionar">Ganglionar</option>
                                    </select>
                                </div>


                                <div class="col-md-4">
                                    <strong>Calidad de vida ECOG</strong>
                                    <select name="calidadvidaecogbucal" id="calidadvidaecogbucal" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Ecog 0  Desempe??o Funcional Normal">Ecog 0 Desempe??o Funcional Normal</option>
                                        <option value="Ecog 1 Desempe??o Leve">Ecog 1 Desempe??o Leve</option>
                                        <option value="Ecog 2 El 50% Del Tiempo Postrado">Ecog 2 El 50% Del Tiempo Postrado</option>
                                        <option value="Ecog 3 Mas Del 50% Postrado">Ecog 3 Mas Del 50% Postrado </option>
                                        <option value="Ecog 4 Dependiente Al 100% Para Vida Basica">Ecog 4 Dependiente Al 100% Para Vida Basica</option>
                                        <option value="Ecog 5 Fallecio">Ecog 5 Fallecio</option>
                                    </select>
                                </div>

                                <!--********************************************************************************************************************************************************************-->





                                <!--********************************************************************************************************************************************************************-->
                                <!--Inicia la secci??n de HISTOPATOLOG??A-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>HISTOPATOLOG??A</strong>
                                </div>


                                <div class="col-md-12" id="estadiocli">
                                    <strong>Dx Histopatologico</strong>
                                    <select name="dxhistopatologico" id="dxhistopatologico" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Adenocarcinoma">Adenocarcinoma</option>
                                        <option value="Adenoideoquistico">Adenoideoquistico</option>
                                        <option value="Basocelular">Basocelular</option>
                                        <option value="Carcinoma Ameloblastico">Carcinoma Ameloblastico</option>
                                        <option value="Epidermoide o Celulas Escamosas (Verrucoso o Basaloide)">Epidermoide o Celulas Escamosas (Verrucoso o Basaloide)</option>
                                        <option value="Linfoma">Linfoma</option>
                                        <option value="Melanoma">Melanoma</option>
                                        <option value="Metastasico">Metast??sico</option>
                                        <option value="Neuroendocrino">Neuroendocrino</option>
                                        <option value="Sarcoma de Kaposi">Sarcoma de Kaposi</option>
                                        <option value="Sarcomatoide">Sarcomatoide</option>
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
                                        <option value="Benigno">Benigno</option>
                                        <option value="Maligno">Maligno</option>
                                        <option value="Ninguno">Ninguno</option>
                                    </select>
                                </div>

                                <!--Si se selecciona Maligno, se debe mostrar el siguiente select-->
                                <div class="col-md-4" id="tumormaligno">
                                    <strong>Maligno:</strong>
                                    <select name="maligno" id="maligno" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Bien Diferenciado">Bien Diferenciado</option>
                                        <option value="Poco Diferenciado">Poco Diferenciado</option>
                                        <option value="Indefinido">Indefinido</option>
                                    </select>
                                </div>

                                <!--Inicia la secci??n de INMUNOHISTOQUIMICA-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>INMUNOHISTOQU??MICA</strong>
                                </div>

                                <div class="col-md-6">
                                    <strong>??Se realiz?? PDL?</strong>
                                    <select name="pdl" id="pdl" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">S??</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>


                                <!--Si s?? se realiz?? PDL se debe habilitar el siguiente campo-->

                                <div class="col-md-6" id="idpdl">
                                    <strong id="inmuno-title">PDL</strong>
                                    <input type="number" id="descripcionpdl" name="descripcionpdl" placeholder="%" class="form-control">
                                </div>

                                <!--Inicia la secci??n de TRATAMIENTO, en esta secci??n se deben ver, de inicio solo tres campos QUIRURGICO, RECONSTRUCCI??N Y RADIOTERAPIA-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>TRATAMIENTO</strong>
                                </div>

                                <!--PRIMER SELECT VISIBLE DE INICIO, QUIRURGICO-->
                                <div class="col-md-12">
                                    <strong>Quirurgico</strong>
                                    <select name="quirurgico" id="quirurgico" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">S??</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <!--Si selecciona que s?? en QUIRURGICO, se debe habilitar lo siguiente-->
                                <div class="col-md-12" id="idtipoquirurgico">
                                    <strong>Tipo de Cirug??a</strong>
                                    <select name="tipoquirurgico" id="tipoquirurgico" class="form-control">
                                        <option value="0">Seleccione...</option>
                                        <option value="Amigdalectomia">Amigdalectom??a</option>
                                        <option value="Comando">Comando</option>
                                        <option value="Diseccion Radical Modificada de Cuello">Disecci??n Radical Modificada de Cuello</option>
                                        <option value="Excision Local Amplia">Excision Local Amplia</option>
                                        <option value="Glosectomia Parcial">Glosectom??a Parcial</option>
                                        <option value="Hemiglosectomia">Hemiglosectom??a</option>
                                        <option value="Mandibulectomia (Parcial, Segmentaria, Maginal)">Mandibulectom??a (Parcial, Segmentaria, Maginal)</option>
                                        <option value="Maxilectomia de Infraestructura">Maxilectomia de Infraestructura</option>
                                        <option value="Maxilectomia de Superestructura">Maxilectomia de Superestructura</option>
                                        <option value="Reseccion de Glandula Salival Menor">Resecci??n de Gl??ndula Salival Menor</option>
                                    </select>
                                </div>

                                <!--Si se selecciona Maxilectomia de Infraestructura, se debe mostrar lo siguiente-->
                                <div class="col-md-12" id="idmaxinfra">
                                    <strong>Maxilectomia de Infraestructura</strong>
                                    <select name="maxinfraestructu" id="maxinfraestructu" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Clase I. Reseccion quirurgica clasica del maxilar que abarca paladar duro y dentici??n hasta la linea media, es unilateral.">Clase I. Resecci??n quir??rgica cl??sica del maxilar que abarca paladar duro y dentici??n hasta la l??nea media, es unilateral.</option>
                                        <option value="Clase II. Incluye defectos que mantienen la denticion del lado contralateral. Es unilateral posterior que no abarca hasta la linea media.">Clase II . Incluye defectos que mantienen la dentici??n del lado contralateral. Es unilateral posterior que no abarca hasta la l??nea media.</option>
                                        <option value="Clase III. Implica un defecto en la l??nea media del paladar duro y puede incluir una porcion del velo del paladar, sin involucrar proceso alveolar ni organos dentarios">Clase III. Implica un defecto en la l??nea media del paladar duro y puede incluir una porci??n del velo del paladar, sin involucrar proceso alveolar ni ??rganos dentarios</option>
                                        <option value="Clase IV. Es un defecto extenso bilateral anterior, involucra dientes anteriores y posteriores.">Clase IV. Es un defecto extenso bilateral anterior, involucra dientes anteriores y posteriores.</option>
                                        <option value="Clase V. Defecto bilateral posterior, situado por detras de los dientes remanentes.">Clase V. Defecto bilateral posterior, situado por detr??s de los dientes remanentes.</option>
                                        <option value="Clase VI. Defecto bilateral de la zona anterior sin involucrar dientes posteriores.">Clase VI. Defecto bilateral de la zona anterior sin involucrar dientes posteriores.</option>
                                    </select>
                                </div>


                                <!--Si se selecciona DISECCION RADICAL MODIFICADA DE CUELLO, se deben mostrar los siguientes 3 select: LUGAR, TIPO Y NIVEL CERVICAL-->
                                <div class="col-md-4" id="idlugar">
                                    <strong>Lugar DRMC </strong>
                                    <select name="lugardrmc" id="lugardrmc" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Bilateral">Bilateral</option>
                                        <option value="Unilateral">Unilateral</option>
                                    </select>
                                </div>

                                <div class="col-md-4" id="idtipo">
                                    <strong>Tipo DRMC</strong>
                                    <select name="tipodrmc" id="tipodrmc" class="form-control">
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
                                <!--Aqu?? finalizan los select que se habilitan/muestran si se selecciona DISECCION RADICAL MODIFICADA DE CUELLO -->






                                <!--SEGUNDO SELECT VISIBLE DE INICIO, RECONSTRUCCI??N-->
                                <div class="col-md-12">
                                    <strong>Reconstrucci??n</strong>
                                    <select name="reconstruccion" id="reconstruccion" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">S??</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>


                                <!-- SELECT MULTIPLE-->
                                <!--Si selecciona S?? en reconstrucci??n, se debe mostrar lo siguiente-->
                                <div class="col-md-12" id="idtiporeconstruccion">
                                    <strong>Tipo de Reconstrucci??n</strong>
                                    <select name="tiporeconstruccion" id="tiporeconstruccion" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Colgajo Microvascular">Colgajo Microvascular</option>
                                        <option value="Injerto Oseo Autologo o Cadaverico">Injerto ??seo Aut??logo o Cadav??rico</option>
                                        <option value="Material de Osteosintesis">Material de Osteos??ntesis</option>
                                        <option value="Rotacion de Colgajo">Rotaci??n de Colgajo</option>
                                        <option value="Toma y Aplicacion de Injerto">Toma y Aplicaci??n de Injerto</option>
                                    </select>
                                </div>





                                <!--TERCER SELECT VISIBLE DE INICIO, RECONSTRUCCI??N-->
                                <div class="col-md-12">
                                    <strong>Radioterapia</strong>
                                    <select name="radio" id="radio" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">S??</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <!--Si se selecciona S?? en RADIOTERAPIA, se deben mostrar: FECHA, MOMENTO RT, DOSIS, FRACCIONES, NO FRACCIONES, TECNICA, COMPLICACIONES RT-->
                                <div class="col-md-3" id="idfecharadio">
                                    <strong>Fecha:</strong>
                                    <input type="date" id="fecharadio" name="fecharadio" class="form-control">
                                </div>

                                <div class="col-md-3" id="idmomentort">
                                    <strong>Momento RT</strong>
                                    <select name="momentort" id="momentort" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Adyuvante">Adyuvante</option>
                                        <option value="Paliativa">Paliativa</option>
                                        <option value="Radical">Radical</option>
                                    </select>
                                </div>

                                <div class="col-md-3" id="iddosisradio">
                                    <strong>Dosis</strong>
                                    <input type="number" class="form-control" id="dosis" name="dosis" placeholder="cG...">
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

                                <div class="col-md-6" id="idnofracciones">
                                    <strong>No. Fracciones</strong>
                                    <input type="number" class="form-control" id="numfracciones" name="numfracciones" placeholder="Ingrese...">
                                </div>

                                <div class="col-md-6" id="idtecnica">
                                    <strong>T??cnica</strong>
                                    <select name="tecnica" id="tecnica" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="3D Conformal">3D Conformal</option>
                                        <option value="Braquiterapia">Braquiterapia</option>
                                        <option value="IMRT">IMRT</option>
                                    </select>
                                </div>

                                <div class="col-md-12" id="idcomplicaciones">
                                    <strong>Complicaciones RT</strong>
                                    <select id="mscomplicacionesrt" name="mscomplicacionesrt[]" multiple="multiple" class="form-control">
                                        <option value="Caries">Caries</option>
                                        <option value="Disgeusia">Disgeusia</option>
                                        <option value="Dolor">Dolor</option>
                                        <option value="Fractura">Fractura</option>
                                        <option value="Infeccion">Infecci??n</option>
                                        <option value="Hemorragias">Hemorragias</option>
                                        <option value="Mucositis">Mucositis</option>
                                        <option value="Osteonecrosis">Osteonecrosis</option>
                                        <option value="Parestesia">Parestesia</option>
                                        <option value="Propios">Propios De La Anestesia Local</option>
                                        <option value="Radiodermitis">Radiodermitis</option>
                                        <option value="Reaccionalergica">Reaccion Alergica</option>
                                        <option value="Trismus">Trismus</option>
                                        <option value="Xerostomia">Xerostomia</option>
                                        <option value="Ninguno">Ninguno</option>
                                    </select>
                                </div>

                                <!--Si se selecciona una complicaci??n, se debe mostrar lo siguiente-->
                                <div class="col-md-3" id="idtxcomplicaciones">
                                    <strong>Tx Caries</strong>
                                    <select name="txcomplicaciones" id="txcomplicaciones" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="crioterapia">Crioterapia</option>
                                        <option value="Farmacologico">Farmacol??gico</option>
                                        <option value="Laser">L??ser</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="idtxcomplicacionesdisguesia">
                                    <strong>Tx Disgeusia</strong>
                                    <select name="txcomplicacionesdisguesia" id="txcomplicacionesdisguesia" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="crioterapia">Crioterapia</option>
                                        <option value="Farmacologico">Farmacol??gico</option>
                                        <option value="Laser">L??ser</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="idtxcomplicacionesdolor">
                                    <strong>Tx Dolor</strong>
                                    <select name="txcomplicacionesdolor" id="txcomplicacionesdolor" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="crioterapia">Crioterapia</option>
                                        <option value="Farmacologico">Farmacol??gico</option>
                                        <option value="Laser">L??ser</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="idtxcomplicacionesfractura">
                                    <strong>Tx Fractura</strong>
                                    <select name="txcomplicacionesfractua" id="txcomplicacionesfractura" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="crioterapia">Crioterapia</option>
                                        <option value="Farmacologico">Farmacol??gico</option>
                                        <option value="Laser">L??ser</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="idtxcomplicacionesinfeccion">
                                    <strong>Tx Infecci??n</strong>
                                    <select name="txcomplicacionesinfeccion" id="txcomplicacionesinfeccion" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="crioterapia">Crioterapia</option>
                                        <option value="Farmacologico">Farmacol??gico</option>
                                        <option value="Laser">L??ser</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="idtxcomplicacionesdisguesiahemorragia">
                                    <strong>Tx Hemorragias</strong>
                                    <select name="txcomplicacioneshemorragia" id="txcomplicacioneshemorragia" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="crioterapia">Crioterapia</option>
                                        <option value="Farmacologico">Farmacol??gico</option>
                                        <option value="Laser">L??ser</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="idtxcomplicacionesmucositis">
                                    <strong>Tx Mucositis</strong>
                                    <select name="txcomplicacionesmucositis" id="txcomplicacionesdmucositis" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="crioterapia">Crioterapia</option>
                                        <option value="Farmacologico">Farmacol??gico</option>
                                        <option value="Laser">L??ser</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="idtxcomplicacionesosteonecrosis">
                                    <strong>Tx Osteonecrosis</strong>
                                    <select name="txcomplicacionessteonecrosis" id="txcomplicacionessteonecrosis" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="crioterapia">Crioterapia</option>
                                        <option value="Farmacologico">Farmacol??gico</option>
                                        <option value="Laser">L??ser</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="idtxcomplicacionesParestesia">
                                    <strong>Tx Parestesia</strong>
                                    <select name="txcomplicacionesParestesia" id="txcomplicacionesParestesia" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="crioterapia">Crioterapia</option>
                                        <option value="Farmacologico">Farmacol??gico</option>
                                        <option value="Laser">L??ser</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="idtxcomplicacionesalocal">
                                    <strong>Tx Anestesia Local</strong>
                                    <select name="txcomplicacionesalocal" id="txcomplicacionesalocal" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="crioterapia">Crioterapia</option>
                                        <option value="Farmacologico">Farmacol??gico</option>
                                        <option value="Laser">L??ser</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="idtxcomplicacionesradiodermitis">
                                    <strong>Tx Radiodermitis</strong>
                                    <select name="txcomplicacionesradiodermitis" id="txcomplicacionesradiodermitis" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="crioterapia">Crioterapia</option>
                                        <option value="Farmacologico">Farmacol??gico</option>
                                        <option value="Laser">L??ser</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="idtxcomplicacionesalergia">
                                    <strong>Tx Reaccion Alergica</strong>
                                    <select name="txcomplicacionesalergia" id="txcomplicacionesalergia" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="crioterapia">Crioterapia</option>
                                        <option value="Farmacologico">Farmacol??gico</option>
                                        <option value="Laser">L??ser</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="idtxcomplicacionetrismus">
                                    <strong>Tx Trismus</strong>
                                    <select name="txcomplicacionestrismus" id="txcomplicacionesdtrismus" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="crioterapia">Crioterapia</option>
                                        <option value="Farmacologico">Farmacol??gico</option>
                                        <option value="Laser">L??ser</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="idtxcomplicacionesxerostomia">
                                    <strong>Tx Xerostomia</strong>
                                    <select name="txcomplicacionesxerostomia" id="txcomplicacionesxerostomia" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="crioterapia">Crioterapia</option>
                                        <option value="Farmacologico">Farmacol??gico</option>
                                        <option value="Laser">L??ser</option>
                                    </select>
                                </div>




                                <!--**********************************-->
                                <!--AQUI FINALIZAN LOS COMBOS QUE SE MUESTRAN SI SE SELECCIONA S?? EN RADIOTERAPIA-->


                                <!--Select multiple-->
                                <div class="col-md-12" id="idmsoarsdosis">
                                    <strong>OARS Dosis</strong>
                                    <select id="msoarsdosis" name="msoarsdosis[]" multiple="multiple" class="form-control">
                                        <option value="Cavidad Oral">Cavidad Oral</option>
                                        <option value="Cocleas">Cocleas</option>
                                        <option value="Cristalinos">Cristalinos</option>
                                        <option value="Esofago">Es??fago</option>
                                        <option value="Labios">Labios</option>
                                        <option value="Laringe">Laringe</option>
                                        <option value="Mandibula">Mandibula</option>
                                        <option value="Medula">M??dula </option>
                                        <option value="Nervio ??ptico">Nervio ??ptico</option>
                                        <option value="Ojos">Ojos</option>
                                        <option value="Pared Faringea Posterior">Pared Faringea Posterior</option>
                                        <option value="Parotidas">Parotidas</option>
                                        <option value="Sublinguales">Sublinguales</option>
                                        <option value="Tallo">Tallo</option>
                                        <option value="Tiroides">Tiroides</option>
                                    </select>
                                </div>


                                <!-- SELECCION DE OARS DOSIS-->
                                <!--CAVIDAD ORAL-->

                                <div class="col-md-3" id="dosis1">
                                    <strong>Dosis M??x Cavidad Oral</strong>
                                    <input type="number" class="form-control" id="cavidadoral1" name="cavidadoral1" placeholder="Ingrese...">
                                </div>

                                <div class="col-md-3" id="promedio1">
                                    <strong>Dosis Prom Cavidad Oral</strong>
                                    <input type="number" class="form-control" id="cavidadoral2" name="cavidadoral2" placeholder="Ingrese...">
                                </div>


                                <!--Cocleas-->

                                <div class="col-md-3" id="dosis2">
                                    <strong>Dosis M??x Cocleas</strong>
                                    <input type="number" class="form-control" id="cocleas1" name="cocleas1" placeholder="Ingrese...">
                                </div>

                                <div class="col-md-3" id="promedio2">
                                    <strong>Dosis Prom Cocleas</strong>
                                    <input type="number" class="form-control" id="cocleas2" name="cocleas2" placeholder="Ingrese...">
                                </div>

                                <!--Crsitalinos-->

                                <div class="col-md-3" id="dosis3">
                                    <strong>Dosis M??x Cristalinos</strong>
                                    <input type="number" class="form-control" id="cristalinos1" name="cristalinos1" placeholder="Ingrese...">
                                </div>

                                <div class="col-md-3" id="promedio3">
                                    <strong>Dosis Prom Cristalinos</strong>
                                    <input type="number" class="form-control" id="cristalinos2" name="cristalinos2" placeholder="Ingrese...">
                                </div>


                                <!--Es??fago-->

                                <div class="col-md-3" id="dosis4">
                                    <strong>Dosis M??x Es??fago</strong>
                                    <input type="number" class="form-control" id="esofago1" name="esofago1" placeholder="Ingrese...">
                                </div>
                                <div class="col-md-3" id="promedio4">
                                    <strong>Dosis Prom Es??fago</strong>
                                    <input type="number" class="form-control" id="esofago2" name="esofago2" placeholder="Ingrese...">
                                </div>

                                <!--Labios-->

                                <div class="col-md-3" id="dosis5">
                                    <strong>Dosis M??x Labios</strong>
                                    <input type="number" class="form-control" id="labios1" name="labios1" placeholder="Ingrese...">
                                </div>
                                <div class="col-md-3" id="promedio5">
                                    <strong>Dosis Prom Labios</strong>
                                    <input type="number" class="form-control" id="labios2" name="labios2" placeholder="Ingrese...">
                                </div>


                                <!--LARINGE-->
                                <div class="col-md-3" id="dosis6">
                                    <strong>Dosis M??x Laringe</strong>
                                    <input type="number" class="form-control" id="laringe1" name="laringe1" placeholder="Ingrese...">
                                </div>
                                <div class="col-md-3" id="promedio6">
                                    <strong>Dosis Prom Laringe</strong>
                                    <input type="number" class="form-control" id="laringe2" name="laringe2" placeholder="Ingrese...">
                                </div>


                                <!--MANDIBULA-->
                                <div class="col-md-3" id="dosis7">
                                    <strong>Dosis M??x Mandibula</strong>
                                    <input type="number" class="form-control" id="mandibula1" name="mandibula1" placeholder="Ingrese...">
                                </div>
                                <div class="col-md-3" id="promedio7">
                                    <strong>Dosis Prom Mandibula</strong>
                                    <input type="number" class="form-control" id="mandibula2" name="mandibula2" placeholder="Ingrese...">
                                </div>

                                <!--M??dula-->
                                <div class="col-md-3" id="dosis8">
                                    <strong>Dosis M??x M??dula</strong>
                                    <input type="number" class="form-control" id="medula1" name="medula1" placeholder="Ingrese...">
                                </div>
                                <div class="col-md-3" id="promedio8">
                                    <strong>Dosis Prom M??dula</strong>
                                    <input type="number" class="form-control" id="medula2" name="medula2" placeholder="Ingrese...">
                                </div>



                                <!--Nervio ??ptico-->
                                <div class="col-md-3" id="dosis9">
                                    <strong>Dosis M??x Nervio ??ptico</strong>
                                    <input type="number" class="form-control" id="nerviooptico1" name="nerviooptico1" placeholder="Ingrese...">
                                </div>
                                <div class="col-md-3" id="promedio9">
                                    <strong>Dosis Prom Nervio ??ptico</strong>
                                    <input type="number" class="form-control" id="nerviooptico2" name="nerviooptico2" placeholder="Ingrese...">
                                </div>


                                <!--Ojos-->
                                <div class="col-md-3" id="dosis10">
                                    <strong>Dosis M??x Ojos</strong>
                                    <input type="number" class="form-control" id="ojos1" name="ojos1" placeholder="Ingrese...">
                                </div>
                                <div class="col-md-3" id="promedio10">
                                    <strong>Dosis Prom Ojos</strong>
                                    <input type="number" class="form-control" id="ojos2" name="ojos2" placeholder="Ingrese...">
                                </div>


                                <!--Pared Faringea Posterior-->
                                <div class="col-md-3" id="dosis11">
                                    <strong>Dosis M??x PFP</strong>
                                    <input type="number" class="form-control" id="pfp1" name="pfp1" placeholder="Ingrese...">
                                </div>
                                <div class="col-md-3" id="promedio11">
                                    <strong>Dosis Prom PFP</strong>
                                    <input type="number" class="form-control" id="pfp2" name="pfp2" placeholder="Ingrese...">
                                </div>


                                <!--Parotidas-->
                                <div class="col-md-3" id="dosis12">
                                    <strong>Dosis M??x Parotidas</strong>
                                    <input type="number" class="form-control" id="Parotidas1" name="Parotidas1" placeholder="Ingrese...">
                                </div>
                                <div class="col-md-3" id="promedio12">
                                    <strong>Dosis Prom Parotidas</strong>
                                    <input type="number" class="form-control" id="Parotidas2" name="Parotidas2" placeholder="Ingrese...">
                                </div>


                                <!--Sublinguales-->
                                <div class="col-md-3" id="dosis13">
                                    <strong>Dosis M??x Sublinguales</strong>
                                    <input type="number" class="form-control" id="Sublinguales1" name="Sublinguales1" placeholder="Ingrese...">
                                </div>
                                <div class="col-md-3" id="promedio13">
                                    <strong>Dosis Prom Sublinguales</strong>
                                    <input type="number" class="form-control" id="Sublinguales2" name="Sublinguales2" placeholder="Ingrese...">
                                </div>


                                <!--Tallo-->
                                <div class="col-md-3" id="dosis14">
                                    <strong>Dosis M??x Tallo</strong>
                                    <input type="number" class="form-control" id="Tallo1" name="Tallo1" placeholder="Ingrese...">
                                </div>
                                <div class="col-md-3" id="promedio14">
                                    <strong>Dosis Prom Tallo</strong>
                                    <input type="number" class="form-control" id="Tallo2" name="Tallo2" placeholder="Ingrese...">
                                </div>


                                <!--Tiroides-->
                                <div class="col-md-3" id="dosis15">
                                    <strong>Dosis M??x Tiroides</strong>
                                    <input type="number" class="form-control" id="Tiroides1" name="Tiroides1" placeholder="Ingrese...">
                                </div>
                                <div class="col-md-3" id="promedio15">
                                    <strong>Dosis Prom Tiroides</strong>
                                    <input type="number" class="form-control" id="Tiroides2" name="Tiroides2" placeholder="Ingrese...">
                                </div>



                                <!--****************************************************************-->


                                <!--Inicia la secci??n de CASO EXITOSO-->
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>CASO EXITOSO</strong>
                                </div>

                                <div class="col-md-4">
                                    <strong>Caso Exitoso</strong>
                                    <select name="casoexitoso" id="casoexitoso" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">S??</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <strong>Respuesta al Tratamiento</strong>
                                    <select name="respuestatratamiento" id="respuestatratamiento" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Completa">Completa</option>
                                        <option value="Nula">Nula</option>
                                        <option value="Parcial">Parcial</option>
                                    </select>
                                </div>
                                <div class="col-md-12"></div>
                                <div class="form-title" style="text-align: center; background-color: #d9a4a5;
                                    color:aliceblue; margin-top: 5px; font-size: 18px; ">
                                    <strong>DEFUNCI??N</strong>
                                </div>

                                <div class="col-md-4">
                                    <strong>Defunci??n</strong>
                                    <select name="defuncion" id="defuncion" class="form-control">
                                        <option value="Seleccione">Seleccione...</option>
                                        <option value="Si">S??</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <div class="col-md-4" id="defuncionfecha">
                                    <strong>Fecha Defunci??n</strong>
                                    <input type="date" name="fechadeladefuncion" id="fechadeladefuncion" class="form-control">
                                </div>

                                <div class=" col-md-4" id="defuncioncausa">
                                    <strong>Causa</strong>
                                    <select name="causadefuncion" id="causadefuncion" class="form-control">
                                        <option value="Sin registro">Sin registro</option>
                                        <option value="Oncologica">Oncologica</option>
                                        <option value="No oncologica">No oncologica</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12"></div>
                            <br>


                            <input type="submit" value="Registrar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                            <input type="button" onclick="window.location.reload();" value="Cerrar formulario" style="width: 170px; height: 27px; color: white; background-color: #FA0000; float: left; margin-left: 5px; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">


                            <br>
                    </div>
                    </form>
                    <div id="tabla_resultado2"></div>
                </div>
            </div>
        </div>
    </div>
</div>