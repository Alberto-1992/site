<?php 
sleep(0.5);

$utimoId = $_POST['utimoId'];
$limite  = 20;
	require 'conexionCancer.php';
    $sqlQueryComentarios  = $conexion2->query("SELECT dato_usuario.id, cancerpaciente.id_paciente FROM dato_usuario inner join cancerpaciente on cancerpaciente.id_paciente = dato_usuario.id");
    $total_registro       = mysqli_num_rows($sqlQueryComentarios);

    $sqlComentLimit= $conexionCancer->prepare("SELECT dato_usuario.id, dato_usuario.curp, dato_usuario.abandonopaciente, dato_usuario.nombrecompleto, dato_usuario.sexo FROM dato_usuario inner join cancerpaciente on cancerpaciente.id_paciente = dato_usuario.id WHERE dato_usuario.id <= '".$utimoId."' ORDER BY dato_usuario.id DESC LIMIT ".$limite." ");
    $sqlComentLimit->execute();
	?>

    <?php
        $sqlComentLimit->fetch(PDO::FETCH_ASSOC);
        while($dataRegistro= $sqlComentLimit->fetch())
        { ?>

<div class="item-comentario" id="<?php echo $dataRegistro['id']; ?>" >
            <?php
            error_reporting(0);
            $id = $dataRegistro['id'];
            $abandono = $dataRegistro['abandonopaciente'];
                $sql_busqueda = $conexionCancer->prepare("SELECT id_paciente from seguimientocancer where id_paciente = :id_paciente");
                $sql_busqueda->execute(array(
                    ':id_paciente'=>$id
                ));
                $validacion = $sql_busqueda->fetch();
                $validaid = $validacion['id_paciente'];
            ?>
                <div id='<?php echo $id ?>' class='ver-info' >
                    <?php echo '<strong style="font-family: Arial; white-space: nowrap; font-size: 10px; margin-left: 7px; text-transform: uppercase;">&nbsp'.$dataRegistro['nombrecompleto'].'</strong>'.'<br>'.'<strong style="font-size: 9px; margin-left: 7px;">&nbsp'.$dataRegistro['curp'].'</strong>'.'<br>'.'<strong style="font-size: 8px; margin-left: 7px;">&nbsp'.$dataRegistro['sexo'].'</strong>';
                    if($validaid == $id){ 
            ?><input type="submit" value="En seguimiento" style="padding: 1px; cursor-pointer: none; background: red; border: none;color: white; margin-left: 1%; font-size: 10px; font-style: arial; margin-top: 0px;"><?php } ?>
            <?php
            if($abandono == 1){ 
            ?>
            <input type="submit" value="Abandono" style="padding: 1px; cursor-pointer: none; background: yellow; border: none; color: red; margin-left: 1%; font-size: 10px; font-style: arial; margin-top: 0px;"><?php } ?>
            
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
            url: "consultaCancerdeMamaBusqueda.php",
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

        //A??adimos la imagen de carga en el contenedor
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
    <h4>No hay m??s Registros ...</h4>
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
