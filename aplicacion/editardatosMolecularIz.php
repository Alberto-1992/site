<?php
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);


    $sql = $conexionCancer->prepare("UPDATE molecularizquierda SET luminalaiz = :luminalaiz, luminalbiz = :luminalbiz, enriquecidoher2iz = :enriquecidoher2iz, basaliz= :basaliz where id_paciente = :id_paciente");

                            $sql->execute(array(
                                ':luminalaiz'=>$luminalaeditiz,
                                ':luminalbiz'=>$luminalbeditiz,
                                ':enriquecidoher2iz'=>$enriquecidoherdoseditiz,
                                ':basaliz'=>$basaleditiz,
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