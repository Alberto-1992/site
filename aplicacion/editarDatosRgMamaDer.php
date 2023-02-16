<?php
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);

$sql = $conexionCancer->prepare("UPDATE histopatoregionganglioderecha set dxhistopatologicorgd = :dxhistopatologicorgd, fechadxhistopatologicorgd = :fechadxhistopatologicorgd, nottinghamrgd = :nottinghamrgd,
 escalasbrrgd = :escalasbrrgd where id_paciente = :id_paciente");
                                            
    
                                            $sql->execute(array(
                                                ':dxhistopatologicorgd'=>$dxhistopatologicorgdedit,
                                                ':fechadxhistopatologicorgd'=>$fechadxhistopatologicorgdedit,
                                                ':nottinghamrgd'=>$nottinghamrgdedit,
                                                ':escalasbrrgd'=>$escalasbrrgdedit,
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