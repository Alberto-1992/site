<?php
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);

    $sql = $conexionCancer->prepare("UPDATE histopatoregionganglionariz set dxhistopatologicorgi = :dxhistopatologicorgi, fechadxhistopatologicorgi = :fechadxhistopatologicorgi, 
    nottinghamrgi = :nottinghamrgi, escalasbrrgi = :escalasbrrgi where id_paciente = :id_paciente");
                                            
                                            $sql->execute(array(
                                                ':dxhistopatologicorgi'=>$dxhistopatologicorgiedit,
                                                ':fechadxhistopatologicorgi'=>$fechadxhistopatologicorgiedit,
                                                ':nottinghamrgi'=>$nottinghamrgiedit,
                                                ':escalasbrrgi'=>$escalasbrrgiedit,
                                                ':id_paciente'=>$id_paciente
                                            ));
                                            if($sql) {
                                                $sql = mysqli_affected_rows($conexionCancer);
                                                echo "<script>swal({
                                                            title: 'Good job!',
                                                            text: 'Datos actualizados exitosamente!',
                                                            icon: 'success',
                                                            timer: 1500,
                                                    showConfirmButton: false
                                                            
                                                    });
                                                    </script>";	
                                                
                                                }else {
                                                    
                                                    echo "<script>swal({
                                                            title: 'Fatal!',
                                                            text: 'Error al actualizar informacion!',
                                                            icon: 'error',
                                                            timer: 1500,
                                                    showConfirmButton: false
                                                            });</script>";
                                                        
                                                    
                                                    }
                                    ?>
