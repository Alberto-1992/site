<?php
include("../conexionCancer.php");
error_reporting(0);
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);

    $sql = $conexionCancer->prepare("UPDATE usghepaticoartritis SET detalleusghepatico = :detalleusghepatico,hallazgousg=:hallazgousg,clasificacionesteatosis=:clasificacionesteatosis WHERE id_paciente = :id_paciente");
            $sql->execute(array(
                ':detalleusghepatico'=>$usghepaticoedit,
                ':hallazgousg'=>$hallazgousgedit,
                ':clasificacionesteatosis'=>$clasificacionesteatosisedit,
                ':id_paciente'=>$id_paciente
            ));
    if($sql != false) {
        echo "<script>swal({
                    title: 'Good job!',
                    text: 'Datos guardados exitosamente!',
                    icon: 'success',
                    timer: 1500,
showConfirmButton: false
                    
            });
            </script>";	
        
        }else {
            
            echo "<script>swal({
                    title: 'Fatal!',
                    text: 'Error al guardar informacion!',
                    icon: 'error',
                    timer: 1500,
showConfirmButton: false
                    });</script>";
                
            
            }
?>