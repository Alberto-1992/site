<?php
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);

$sql = $conexionCancer->prepare("UPDATE histopatologia set dxhistopatologico = :dxhistopatologico, fechadxhistopatologico = :fechadxhistopatologico, nottingham = :nottingham, escalasbr = :escalasbr where id_usuario = :id_usuario");
                                

                                        $sql->execute(array(
                                            ':dxhistopatologico'=>$dxhistopatologicoedit,
                                            ':fechadxhistopatologico'=>$fechadxhistopatologicoedit,
                                            ':nottingham'=>$nottinghamedit,
                                            ':escalasbr'=>$escalasbredit,
                                            ':id_usuario'=>$id_paciente
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