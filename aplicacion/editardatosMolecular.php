<?php
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);


    $sql = $conexionCancer->prepare("UPDATE molecular SET luminala = :luminala, luminalb = :luminalb, enriquecidoher2 = :enriquecidoher2, basal= :basal where id_paciente = :id_paciente");

                            $sql->execute(array(
                                ':luminala'=>$luminalaedit,
                                ':luminalb'=>$luminalbedit,
                                ':enriquecidoher2'=>$enriquecidoherdosedit,
                                ':basal'=>$basaledit,
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
