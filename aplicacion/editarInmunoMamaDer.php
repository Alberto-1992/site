<?php
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);

$sql = $conexionCancer->prepare("UPDATE inmunohistoquimica set receptoresestrogenos = :receptoresestrogenos, receptoresprogesterona = :receptoresprogesterona, ki67 = :ki67, p53 = :p53, triplenegativo = :triplenegativo, 
aplicopdl = :aplicopdl, descripcionpdl = :descripcionpdl, oncogenher2 = :oncogenher2, fish = :fish where id_usuario = :id_usuario");
                                                        

                                                        $sql->execute(array(
                                                            ':receptoresestrogenos'=>$receptoresestrogenosedit,
                                                            ':receptoresprogesterona'=>$receptoresprogesteronaedit,
                                                            ':ki67'=>$ki67edit,
                                                            ':p53'=>$p53edit,
                                                            ':triplenegativo'=>$triplenegativoedit,
                                                            ':aplicopdl'=>$pdlrealizoedit,
                                                            ':descripcionpdl'=>$pdledit,
                                                            ':oncogenher2'=>$oncogenedit,
                                                            ':fish'=>$fishedit,
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