<?php 
sleep(0.5);

$utimoId = $_POST['utimoId'];
$limite  = 10;
	require 'conexionCancer.php';
    $sqlQueryComentarios  = $conexion2->query("SELECT dato_personalinfarto.id, infartopaciente.id_pacienteinfarto FROM dato_personalinfarto inner join infartopaciente on infartopaciente.id_pacienteinfarto = dato_personalinfarto.id");
    $total_registro       = mysqli_num_rows($sqlQueryComentarios);

    $sqlComentLimit = $conexionCancer->prepare("SELECT dato_personalinfarto.id, dato_personalinfarto.nombrecompleto, dato_personalinfarto.edad, dato_personalinfarto.curp, dato_personalinfarto.sexo, dato_personalinfarto.fechanacimiento FROM dato_personalinfarto inner join infartopaciente on infartopaciente.id_pacienteinfarto = dato_personalinfarto.id WHERE dato_personalinfarto.id < '".$utimoId."' ORDER BY dato_personalinfarto.id DESC LIMIT ".$limite."");
    $sqlComentLimit->execute();
	?>

    <?php
        $sqlComentLimit->fetch(PDO::FETCH_ASSOC);
        while($dataRegistro= $sqlComentLimit->fetch())
        { ?>

    <div class="item-comentario" id="<?php echo $dataRegistro['id']; ?>">
    

    <div id='<?php echo $dataRegistro['id']; ?>' class='ver-info' >
                    <?php echo '<strong style="font-family: Arial; white-space: nowrap; font-size: 10px; margin-left: 7px; text-transform: uppercase;">&nbsp'.$dataRegistro['nombrecompleto'].'</strong>'.'<br>'.'<strong style="font-size: 9px; margin-left: 7px;">&nbsp'.$dataRegistro['curp'].'</strong>'.'<br>'.'<strong style="font-size: 8px; margin-left: 7px;">&nbsp'.$dataRegistro['sexo'].'</strong>';
                    ?>
            </div> 
                    <hr>
            
        
            </div>
        <?php
        }?>
<script>
$(function() {

    $('.item-comentario').on('click', '.ver-info', function() {

        var id = $(this).prop('id');

        let ob = {
            id: id
        };
        $.ajax({
            type: "POST",
            url: "consultaPacienteBusqueda.php",
            data: ob,
            beforeSend: function() {

            },
            success: function(data) {

                $("#tabla_resultado").html(data);

            }
        });

    });
});
$(document).ready(function() {
    $('.item-comentario').on('click', '.ver-info', function() {

        //Añadimos la imagen de carga en el contenedor
        $('#tabla_resultado').html(
            '<div id="tabla_resultado" style="position: fixed;  top: 0px; left: 0px;  width: 100%; height: 100%; z-index: 9999;  opacity: .7; background: url(imagenes/loader2.gif) 50% 50% no-repeat rgb(249,249,249);"><br/></div>'
        );


        return false;
    });
});
</script>

<?php
    
if ($total_registro <= $limite) { ?>
<div class="col-md-12 col-sm-12">
    <h4>No hay más Registros ...</h4>
</div>
<?php }else{ ?>
<!--
<div class="col-md-12 col-sm-12">
    <div class="ajax-loader text-center">
        <img src="img/cargando.svg">
        <br>
        Cargando los Registros...
    </div>
</div>
-->
<?php } 
?>