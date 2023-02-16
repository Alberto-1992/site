<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <!--la siguiente liga es para el icon de Agregar persona que se muestra en el Modal CargarPacienteArtritis-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="js/getCatalogos.js"></script>

    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
<style>
    #datos_paciente{
        display: block;
        font-family: arial;
        
        font-size: 22px;

        /*animation: typing 2s steps(18),
        blink .5s infinite step-end alternate;
        overflow: hidden;*/
    }


   .form-title{
        display: block;
        font-family: arial;
       /* white-space: nowrap;*/
        
        width: 100%;
        font-size: 28px;
        text-align: center; color:blueviolet; background-color:antiquewhite; 
        margin-top: 5px;
        /*animation: typing 2s steps(18),
        blink .5s infinite step-end alternate;
        overflow: hidden; */
    }
    strong{
        font-family: arial;
        font-size: 13px;
        /*white-space: nowrap;*/ 
    }
    #inmuno-title{
        font-family: arial;
        font-size: 13px;
    }
   
    #titulos{
        font-size: 14px;
    }
   

</style>
<script>
    function Edad(FechaNacimiento) {

var fechaNace = new Date(FechaNacimiento);
var fechaActual = new Date()

var mes = fechaActual.getMonth();
var dia = fechaActual.getDate();
var año = fechaActual.getFullYear();

fechaActual.setDate(dia);
fechaActual.setMonth(mes);
fechaActual.setFullYear(año);

edad = Math.floor(((fechaActual - fechaNace) / (1000 * 60 * 60 * 24) / 365));

return edad;


}

function calcularEdadEdit() {
var fecha = document.getElementById('fechaedit').value;


var edad = Edad(fecha);
document.formularioedicion.edadedit.value = edad;

}
function curp2dateEdit(curpedit) {
var miCurp = document.getElementById('curpedit').value.toUpperCase();
var sexo = miCurp.substr(-8, 1);
var m = miCurp.match(/^\w{4}(\w{2})(\w{2})(\w{2})/);
//miFecha = new Date(año,mes,dia) 
var anyo = parseInt(m[1], 10) + 1900;
if (anyo < 1940) anyo += 100;
var mes = parseInt(m[2], 10) - 1;
var dia = parseInt(m[3], 10);
document.formularioedicion.fechaedit.value = (new Date(anyo, mes, dia));
if (sexo == 'M') {
    document.formularioedicion.sexoedit.value = 'Femenino';
} else if (sexo == 'H') {
    document.formularioedicion.sexoedit.value = 'Masculino';
} else if (sexo != 'M' || 'H') {
    alert('Error de CURP');
}

}
Date.prototype.toString = function() {
    var anyo = this.getFullYear();
    var mes = this.getMonth() + 1;
    if (mes <= 9) mes = "0" + mes;
    var dia = this.getDate();
    if (dia <= 9) dia = "0" + dia;
    return anyo + "-" + mes + "-" + dia;
}
window.addEventListener('DOMContentLoaded', (evento) => {
    const hoy_fecha = new Date().toISOString().substring(0, 10);
    document.querySelector("input[name='fechaedit']").max = hoy_fecha;

});
function calculaIMCEdit() {

let talla = document.getElementById('tallaedit').value;
let peso = document.getElementById('pesoedit').value;


imccalculo = Math.pow(talla, 2);
let limitimcalculo = imccalculo.toFixed(2);
let calculoimc = peso / limitimcalculo;
let limitcalculofinal = calculoimc.toFixed(1);

document.formularioedicion.imcedit.value = limitcalculofinal;

}
$(document).ready(function() {

$('#mscanceredit').change(function(e) {

    
}).multipleSelect({
    width: '100%'
});
});
$(document).ready(function() {

$('#mspatoedit').change(function(e) {

    
}).multipleSelect({
    width: '100%'
});
});
$(document).ready(function() {

$('#sitiometastasis2edit').change(function(e) {

    
}).multipleSelect({
    width: '100%'
});
});

function limpiar() {

setTimeout('document.formularioedicion.reset()', 1000);



return false;
}
function limpiarcancer() {

setTimeout('document.formularioedicioncancer.reset()', 1000);


return false;
}
function limpiarpato() {

setTimeout('document.formularioedicionpato.reset()', 1000);

return false;
}

</script>
<div id="mensaje"></div>

<div class="modal fade in" role="dialog"  data-bs-keyboard="false" id="editarDatosPersonalescancerdeMama">

    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiar();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                            <div class="form-header">
                                <h3 class="form-title"
                                    >
                                    FICHA DE DATOS</h3>

                            </div>

                            <form name="formularioedicion" id="formularioedicion" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioedicion").on("submit", function(e) {
                                
                                        let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioedicion"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editardatospaciente.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarDatosPersonalescancerdeMama").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarDatosPersonalescancerdeMama").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarDatosPersonalescancerdeMama").modal('hide');
                                            }
                                        
                                        })
                                        
                                    })
                                    
                                    
                                    </script>
                                    <div class="col-md-12" autocomplete="off">

                                        <input id="year" name="year" class="form-control" type="hidden" value="2022"
                                            required="required" readonly>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-6">
                                        <strong>CURP</strong>
                                        <input type="text" id="curpedit" name="curpedit" type="text" class="form-control" value="<?php echo $dataRegistro['curp'] ?>"
                                        onblur="curp2dateEdit();" minlength="18" maxlength="18" required >
                                    
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Nombre Completo</strong>
                                        <input id="nombrecompletoedit" name="nombrecompletoedit" onblur="calcularEdadEdit();"
                                            type="text" class="form-control" value="<?php echo $dataRegistro['nombrecompleto'] ?>" required>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Población indigena</strong>
                                        <select name="poblacionindigenaedit" id="poblacionindigenaedit" class="form-control" >
                                            <option value="<?php echo $dataRegistro['poblacionindigena'] ?>" selected><?php echo $dataRegistro['poblacionindigena'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                
                                    <div class="col-md-3">
                                        <strong>Discapacidad</strong>
                                        <select name="discapacidadedit" id="discapacidadedit" class="form-control">
                                    
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Escolaridad</strong>
                                        <select id="escolaridadedit" name="escolaridadedit" class="form-control">
                                        <option value="<?php echo $dataRegistro['escolaridad'] ?>" selected><?php echo $dataRegistro['escolaridad'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				    require 'conexionInfarto.php';
				        $query = $conexionCancer->prepare("SELECT id_escolaridad, gradoacademico FROM escolaridad");
                        $query->execute();
                        $query->setFetchMode(PDO::FETCH_ASSOC);
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['gradoacademico']; ?>">
                                                <?php echo $row['gradoacademico']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Fecha de nacimiento</strong>
                                        <input id="fechaedit" name="fechaedit" type="date" value="<?php echo $dataRegistro['fechanacimiento'] ?>" onblur="curp2dateEdit();"
                                            class="form-control" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <strong>Edad</strong>
                                        <input id="edadedit" name="edadedit" type="text" class="form-control" value="<?php echo $dataRegistro['edad'] ?>" readonly>
                                    </div>

                                    <div class="col-md-2">
                                        <strong>Sexo</strong>
                                        <input type="text" class="form-control" id="sexoedit" value="<?php echo $dataRegistro['sexo'] ?>" onclick="curp2dateEdit();"
                                            name="sexoedit" readonly>

                                    </div>
                                    <div class="col-md-2">
                                        <strong>Raza</strong>
                                        <input type="text" class="form-control" id="razaedit" onclick="curp2dateEdit();"
                                            name="razaedit" value="<?php echo $dataRegistro['raza'] ?>">

                                    </div>
                                    <!--
                                    <div class="col-md-3">
                                        <strong>Frecuencia cardiaca</strong>
                                        <input type="text" class="form-control col-md-12" id="frecuenciacardiaca"
                                            name="frecuenciacardiaca">

                                    </div>
                                    <div class="col-md-3">
                                        <strong>Presión arterial</strong>
                                        <input type="text" class="form-control col-md-12" id="presionarterial"
                                            name="presionarterial">

                                    </div>
                                    -->
                                    <script>
                                        /*
                                    $(document).ready(function() {
                                        $('#presionarterial').mask('000/000');
                                    });*/
                                    $(document).ready(function() {
                                        $('#tallaedit').mask('0.00');
                                    });
                                    </script>
                                    <div class="col-md-2">
                                        <strong>Talla</strong>
                                        <input type="number" step="any" class="form-control" id="tallaedit" name="tallaedit"
                                            required value="<?php echo $dataRegistro['talla'] ?>">

                                    </div>
                                    <div class="col-md-2">
                                        <strong>Peso</strong>
                                        <input type="number" step="any" class="form-control" id="pesoedit"
                                            onblur="calculaIMCEdit();" name="pesoedit" required value="<?php echo $dataRegistro['peso'] ?>">

                                    </div>
                                    <div class="col-md-2">
                                        <strong>IMC</strong>
                                        <input type="text" class="form-control" id="imcedit" onblur="calculaIMCEdit();"
                                            name="imcedit" readonly value="<?php echo $dataRegistro['imc'] ?>">

                                    </div>

                                    <div class="col-md-6">
                                        <strong>Estado de residencia</strong>

                                        <select name="cbx_estadoedit" id="cbx_estadoedit" class="form-control"
                                            style="width: 100%;" required>
                                            <option value="<?php echo $rows['id_estado'] ?>" selected><?php echo $rows['estado'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				    require '../esclerosis/conexion.php';
				  $query = "SELECT id_estado, estado FROM t_estado ";
	                $resultado=$conexion2->query($query);
				while($row = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['id_estado']; ?>">
                                                <?php echo $row['estado']; ?></option>
                                            <?php } ?>

                                            <!--<option value="1">Otro</option>-->

                                        </select>

                                    </div>
                                    <div class="col-md-6">
                                        <strong>Delegación o Municipio</strong>
                                        
                                        <select name="cbx_municipioedit" id="cbx_municipioedit" class="form-control"
                                            style="width: 100%;">
                                            <option value="<?php echo $rowsm['id_municipio'] ?>" selected><?php echo $rowsm['municipio'] ?></option>
                                        </select>
                                    </div>
                                    
                                    </div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                                    
                        </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarDatosReferencia">

    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarcancer();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="formularioedicionreferencia" id="formularioedicionreferencia" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioedicionreferencia").on("submit", function(e) {
                                        
                                        let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioedicionreferencia"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editarreferencia.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarDatosReferencia").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarDatosReferencia").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarDatosReferencia").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script>
                                <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">DATOS DE REFERECNIA</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                <div class="col-md-6" >
                                        <strong>Referenciado</strong>
                                        <select name="referenciadoedit" id="referenciadoedit" class="form-control">
                                        <option value="<?php echo $dataRegistro['referenciado'] ?>" ><?php echo $dataRegistro['referenciado'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6" >
                                        <strong>Unidad referencia</strong>
                                        <input list="referencias" name="unidadreferenciaedit" id="unidadreferenciaedit"
                                            class="form-control" value="<?php echo $rown['unidad']; ?>">
                                        <datalist id="referencias">
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT clues, unidad FROM hospitales");
                        $query->execute();
                        $query->setFetchMode(PDO::FETCH_ASSOC);
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['clues']; ?>">
                                                <?php echo $row['unidad']; ?></option>
                                            <?php } ?>

                                        </datalist>
                                    </div>
                                    </div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                                    
                                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarDatosCancer">

    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarcancer();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="formularioedicioncancer" id="formularioedicioncancer" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioedicioncancer").on("submit", function(e) {
                                        
                                        let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioedicioncancer"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editarcancermama.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarDatosCancer").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarDatosCancer").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarDatosCancer").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script>
                                <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">ANTECEDENTES HEREDOFAMILIARES</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-6">
                                        <strong>Cancer</strong>
                                        <select name="tipodecanceredit" id="tipodecanceredit" class="form-control">
                                        
                                            <option value="Sin antecedentes">Sin antecedentes</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                    <div class="col-md-6" >
                                        <strong>Familiar(es)</strong>
                                        <select id="mscanceredit" name="mscanceredit[]" multiple="multiple"
                                            class="form-control">
                                            
                                            <optgroup style="margin-left: 5px;" label="Cancer de mama">
                                            
                                                <option value="Madre CM">Madre</option>
                                                <option value="Hermana CM">Hermana</option>
                                                <option value="Abuela materna CM">Abuela materna</option>
                                                <option value="Abuela paterna CM">Abuela paterna</option>
                                                <option value="Tia paterna CM">Tia paterna</option>
                                                <option value="Tia materna CM">Tia materna</option>
                                                <option value="Prima paterna CM">Prima paterna</option>
                                                <option value="Prima materna CM">Prima materna</option>
                                    </optgroup>
                                            <optgroup label="Cancer de ovario">
                                                <option value="Madre CO">Madre</option>
                                                <option value="Hermana CO">Hermana</option>
                                                <option value="Abuela materna CO">Abuela materna</option>
                                                <option value="Abuela paterna CO">Abuela paterna</option>
                                                <option value="Tia paterna CO">Tia paterna</option>
                                                <option value="Tia materna CO">Tia materna</option>
                                                <option value="Prima paterna CO">Prima paterna</option>
                                                <option value="Prima materna CO">Prima materna</option>
                                            
                                    </optgroup>
                                        </select>
                                    </div>
                                    </div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                    
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarDatosPersonalesPatologicos">
    
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="formularioedicionpato" id="formularioedicionpato" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioedicionpato").on("submit", function(e) {
                                        checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioedicionpato"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/antecedentespersonalespato.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarDatosPersonalesPatologicos").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarDatosPersonalesPatologicos").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarDatosPersonalesPatologicos").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script>
                                <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">ANTECEDENTES PERSONALES PATOLOGICOS</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-12">
                                        <strong>Antecedentes</strong>
                                        <select id="mspatoedit" name="check_listapatoedit[]" multiple="multiple"
                                            class="form-control">

                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcionantecedente FROM antecedentespersonalespatologicos");
                        $query->execute();
                        $query->setFetchMode(PDO::FETCH_ASSOC);
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionantecedente']; ?>">
                                                <?php echo $row['descripcionantecedente']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    </div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                    
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarDatosAntecedentesGineco">
    
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="formularioediciongineco" id="formularioediciongineco" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioediciongineco").on("submit", function(e) {
                                        
                                        let checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioediciongineco"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/editarantecedentesgineco.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarDatosAntecedentesGineco").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarDatosAntecedentesGineco").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarDatosAntecedentesGineco").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script>
                        <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">ANTECEDENTES GINECOOBSTETRICOS</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-2">
                                        <strong>Menarca</strong>
                                        <input type="text" class="form-control" id="menarcaedit" name="menarcaedit" value="<?php echo $dataRegistro['menarca'] ?>">

                                    </div>
                                    <div class="col-md-3">
                                        <strong>Ultima menstruación</strong>
                                        <input type="date" class="form-control" id="fechaultimamestruacionedit"
                                            name="fechaultimamestruacionedit" onblur="calcularmestruacionedit();" value="<?php echo $dataRegistro['ultimamestruacion'] ?>">

                                    </div>
                                    <div class="col-md-3" >
                                        <strong>Cuenta con:</strong>
                                        <input type="text" class="form-control" id="menopauseaedit" name="menopauseaedit"
                                            readonly value="<?php echo $dataRegistro['cuentacon'] ?>">

                                    </div>

                                    <div class="col-md-2">
                                        <strong>Gestas</strong>
                                        <select name="gestasedit" id="gestasedit" class="form-control" >
                                            <option value="<?php echo $dataRegistro['gestas'] ?>" selected><?php echo $dataRegistro['gestas'] ?></option>
                                            <option value="0">Ninguna</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>

                                        </select>
                                    </div>
                                    <div class="col-md-2" id="partoidedit">
                                        <strong>Paras</strong>
                                        <input type="number" class="form-control" id="partoedit" onblur="validapartoedit();"
                                            name="partoedit" value="<?php echo $dataRegistro['parto'] ?>">

                                    </div>
                                    <div class="col-md-3" id="abortoidedit">
                                        <strong>Aborto</strong>
                                        <input type="number" class="form-control" id="abortoedit" onblur="validapartoedit();"
                                            name="abortoedit" value="<?php echo $dataRegistro['aborto'] ?>">

                                    </div>
                                    <div class="col-md-3" id="cesareaidedit">
                                        <strong>Cesarea</strong>
                                        <input type="number" class="form-control" id="cesareaedit" onblur="validapartoedit();"
                                            name="cesareaedit" value="<?php echo $dataRegistro['cesarea'] ?>">

                                    </div>
                                    <div class="col-md-3">
                                        <strong>Esta embarazada</strong>
                                        <select name="embarazadaedit" id="embarazadaedit" class="form-control" >
                                            <option value="<?php echo $dataRegistro['embarazada'] ?>" selected><?php echo $dataRegistro['embarazada'] ?></option>
                                            <option value="0">Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                    

                                        </select>
                                    </div>
                                    <div class="col-md-3" id="probablepartoedit">
                                        <strong>F.P.P</strong>
                                        <input type="date" class="form-control" id="fechaprobablepartoedit"
                                            name="fechaprobablepartoedit" value="<?php echo $dataRegistro['fpp'] ?>" >

                                    </div>
                                    <div class="col-md-4">
                                        <strong>Terapia de remplazo hormonal</strong>
                                        <select name="planificacionfamiliaredit" id="planificacionfamiliaredit"
                                            class="form-control">
                                            <option value="<?php echo $dataRegistro['terapiareemplazohormonal'] ?>" selected><?php echo $dataRegistro['terapiareemplazohormonal'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>

                                    <div class="col-md-2" id="tipolactancia">
                                        <strong>Lactancia</strong>
                                        <select name="lactanciaedit" id="lactanciaedit" class="form-control">
                                        <option value="<?php echo $dataRegistro['lactancia'] ?>" selected><?php echo $dataRegistro['lactancia'] ?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                    <div class="col-md-2" id="tiempodelactancia">
                                        <strong>Tiempo</strong>
                                        <input type="text" class="form-control" id="tiempolactanciaedit"
                                            name="tiempolactanciaedit" value="<?php echo $dataRegistro['tiempolactancia'] ?>">

                                    </div>
                                    <script>
                                        $(document).ready(function() {

                                                $('#embarazadaedit').change(function(e) {
                                                    if ($(this).val() == 'No') {

                                                            $('#fechaprobablepartoedit').prop("disabled", true);
                                                            $('#fechaprobablepartoedit').val('');
                                                        

                                                        }else if($(this).val() == 'Sin registro') {
                                                            $('#fechaprobablepartoedit').prop("disabled", true);
                                                            $('#fechaprobablepartoedit').val('');
                                                        }else if ($(this).val() == 'Si') {
                                                            $('#fechaprobablepartoedit').prop("disabled", false);
                                                            $('#fechaprobablepartoedit').val('');
                                                        }
                                                        })
                                                    });
                                                    $(document).ready(function() {

                                                            $('#lactanciaedit').change(function(e) {                
                                                                        if ($(this).val() == 'No') {

                                                                        $('#tiempodelactancia').prop("hidden", true);
                                                                        $('#tiempolactanciaedit').val('');
        

                                                                }else if($(this).val() == 'Sin registro'){
                                                                        $('#tiempodelactancia').prop("hidden", true);
                                                                        $('#tiempolactanciaedit').val('');
                                                                    }else if($(this).val() == 'Si'){
                                                                        $('#tiempodelactancia').prop("hidden", false);
                                                                        $('#tiempolactanciaedit').val('');
                                                                    }

                                                                        })
                                                                    });
                                    </script>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div class="modal fade in" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" id="editarDatosAtencionClinica">
    
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header" id="cabeceraModalMama">
                
                <button type="button" class="close" data-bs-dismiss="modal" onclick="limpiarpato();">&times;</button>
            
            </div>
            <div class="modal-body">

                <div id="panel_editar">

                    <div class="contrato-nuevo">
                        <div class="modal-body">

                            <!-- form start -->
                        

                            <form name="formularioedicionatencionclinica" id="formularioedicionatencionclinica" onSubmit="return limpiar()" autocomplete="off">
                                <div class="form-row">
                                    <div id="mensaje"></div>
                                    <script>
                                    $("#formularioedicionatencionclinica").on("submit", function(e) {
                                        checked = this.querySelectorAll('input[type=checkbox]:checked');
                                        e.preventDefault();

                                        var formData = new FormData(document.getElementById(
                                            "formularioedicionatencionclinica"));
                                        formData.append("dato", "valor");

                                        $.ajax({

                                            url: "aplicacion/atencionclinicacancer.php",
                                            type: "post",
                                            dataType: "html",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(datos) {
                                                $("#mensaje").html(datos);
                                                let id = $("#id_paciente").val();
                                                let ob = {
                                                            id: id
                                                            };
  
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "consultaCancerdeMamaBusqueda.php",
                                                            data: ob,
                                                    
                                                        success: function(data) {

                                                            $("#tabla_resultado").html(data);
                                                            //$("#editarDatosPersonalescancerdeMama").modal('show');
                                                            setTimeout(function(){
                                                                $("#editarDatosAtencionClinica").modal('hide');
                                                                    }, 1500);
                                                                    $("#editarDatosAtencionClinica").modal('hide');
                                                            
                                                            }
                                                            
                                                    });
                                                    $("#editarDatosAtencionClinica").modal('hide');
                                            }
                                        })
                                    })
                                
                                    
                                    </script>
                                    <div class="col-md-12"
                                        style="text-align: center; color:blueviolet; background-color:antiquewhite; margin-top: 5px;">
                                        <strong id="titulos">ATENCIÓN CLINICA</strong>
                                    </div>
                                    <div class="col-md-12">
                                            <input id="id_paciente" name="id_paciente" type="hidden" class="form-control" value="<?php echo $dataRegistro['id']; ?>">
                                        </div>
                                    <div class="col-md-3">
                                        <strong>Fecha primer atencion</strong>
                                        <input type="date" id="fechaatencioninicialedit" name="fechaatencioninicialedit"
                                            class="form-control" value="<?php echo $dataRegistro['fechaatencioninicial']?>">
                                    </div>
                                    <div class="col-md-3">
                                        <strong>BIRADS de referencia</strong>
                                        <select name="biradsreferenciaedit" id="biradsreferenciaedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['biradsreferencia']?>" selected><?php echo $dataRegistro['biradsreferencia']?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				            $query = $conexionCancer->prepare("SELECT descripcionbrad FROM birads_atencion_inicial");
                                $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionbrad']; ?>">
                                                <?php echo $row['descripcionbrad']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <strong>BIRADS HRAEI</strong>
                                        <select name="biradshraeiedit" id="biradshraeiedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['biradshraei']?>" selected><?php echo $dataRegistro['biradshraei']?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				            $query = $conexionCancer->prepare("SELECT descripcionbrad FROM birads_atencion_inicial");
                                $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionbrad']; ?>">
                                                <?php echo $row['descripcionbrad']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-3" id="lateralidadinicioedit">
                                        <strong>Lateralidad</strong>
                                        <select name="lateralidadprimeroedit" id="lateralidadprimeroedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['lateralidadmama']?>" selected><?php echo $dataRegistro['lateralidadmama']?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Derecha">Derecha</option>
                                            <option value="Izquierda">Izquierda</option>
                                            <option value="Bilateral">Bilateral</option>

                                        </select>
                                    </div>
                                    <div class="col-md-4" id="lateralidadinicioedit">
                                        <strong>Estadio clinico</strong>
                                        <select name="estadioclinicoedit" id="estadioclinicoedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['estadioclinico']?>" selected><?php echo $dataRegistro['estadioclinico']?></option>
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
                                        <select name="etapasclinicasedit" id="etapasclinicasedit" class="form-control" readonly>
                                            <option value="TNM" selected>TNM</option>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Tamaño tumoral</strong>
                                        <select name="tamaniotumoraledit" id="tamaniotumoraledit" class="form-control">
                                            <option value="<?php echo $dataRegistro['tamaniotumoral']?>" selected><?php echo $dataRegistro['tamaniotumoral']?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcion_size_tumoral FROM size_tumoral");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcion_size_tumoral']; ?>">
                                                <?php echo $row['descripcion_size_tumoral']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Compromiso linfatico nodal</strong>
                                        <select name="linfaticonodaledit" id="linfaticonodaledit" class="form-control">
                                            <option value="<?php echo $dataRegistro['compromisolenfatico']?>" selected><?php echo $dataRegistro['compromisolenfatico']?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcion_linfatico_nodal FROM compromiso_linfatico_nodal");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcion_linfatico_nodal']; ?>">
                                                <?php echo $row['descripcion_linfatico_nodal']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Metastasis</strong>
                                        <select name="metastasisedit" id="metastasisedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['metastasis']?>" selected><?php echo $dataRegistro['metastasis']?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="MX: No se pueden evaluar metastasis distantes">MX: No se pueden evaluar metastasis distante</option>
                                            <option value="M0 Sin enfermedad a distancia">M0 Sin enfermedad a distancia</option>
                                            <option value="M1 Con enfermedad metastasica">M1 Con enfermedad metastasica</option>
                                            

                                        </select>
                                    </div>
                                    <div class="col-md-4" id="metastasissitioedit">
                                        <strong>Sitio de metastasis</strong>
                                        <select name="sitiometastasisedit[]" id="sitiometastasis2edit" multiple="multiple" class="form-control">
                                           
                                            <?php 
				        $query = $conexionCancer->prepare("SELECT descripcionsitiometastasis FROM sitiometastasis");
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
				                    while($row = $query->fetch()) { ?>
                                            <option value="<?php echo $row['descripcionsitiometastasis']; ?>">
                                                <?php echo $row['descripcionsitiometastasis']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    

                                    <div class="col-md-4">
                                        <strong>Calidad de vida ECOG</strong>
                                        <select name="calidaddevidaecogedit" id="calidaddevidaecogedit" class="form-control">
                                            <option value="<?php echo $dataRegistro['calidadvidaecog']?>" selected><?php echo $dataRegistro['calidadvidaecog']?></option>
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
                                    <div class="col-md-4" >
                                        <strong>Mastectomia Extrainstitucional</strong>
                                        <select name="mastectomiaextrainstitucionaledit" id="mastectomiaextrainstitucionaledit"
                                            class="form-control">
                                            <option value="<?php echo $dataRegistro['mastectoextrainstituto']?>" selected><?php echo $dataRegistro['mastectoextrainstituto']?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="mstectoextra1edit">
                                        <strong>Lateralidad Mastectomia</strong>
                                        <select name="lateralidadextrainstitucionaledit" id="lateralidadextrainstitucionaledit"
                                            class="form-control">
                                            <option value="<?php echo $dataRegistro['lateralidadmastectoextrainstituto']?>" selected><?php echo $dataRegistro['lateralidadmastectoextrainstituto']?></option>
                                            <option value="Sin registro">Sin registro</option>
                                            <option value="Mama Derecha">Mama Derecha</option>
                                            <option value="Mama Izquierda">Mama Izquierda</option>
                                            <option value="Ambas Mamas">Ambas Mamas</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="mstectoextra2edit">
                                        <strong>Fecha</strong>
                                        <input type="date" class="form-control" id="fechamastectoextraedit"
                                            name="fechamastectoextraedit" value="<?php echo $dataRegistro['fechamastectoextrainstituto']?>">

                                    </div>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <input type="submit" value="Editar" style="width: 170px; height: 27px; color: white; background-color: #6CCD06; float: right; margin-right: 5px; auto; margin-top: 5px; text-decoration: none; border: none; border-radius: 15px;">
                        </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>