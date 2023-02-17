<?php
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);
$sql = $conexionCancer->prepare("UPDATE inmunohistoquimicaiz set receptoresestrogenosiz=:receptoresestrogenosiz, receptoresprogesteronaiz=:receptoresprogesteronaiz, ki67iz=:ki67iz, p53iz=:p53iz,
    triplenegativoiz=:triplenegativoiz, aplicopdliz=:aplicopdliz, descripcionpdliz=:descripcionpdliz, oncogenher2iz=:oncogenher2iz, fishiz=:fishiz WHERE id_usuario =:id_usuario ");

                                                        $sql->execute(array(
                                                            ':receptoresestrogenosiz'=>$receptoresestrogenosizedit,
                                                            ':receptoresprogesteronaiz'=>$receptoresprogesteronaizedit,
                                                            ':ki67iz'=>$ki67izedit,
                                                            ':p53iz'=>$p53izedit,
                                                            ':triplenegativoiz'=>$triplenegativoizedit,
                                                            ':aplicopdliz'=>$pdlrealizoizedit,
                                                            ':descripcionpdliz'=>$pdlizedit,
                                                            ':oncogenher2iz'=>$oncogenizedit,
                                                            ':fishiz'=>$fishizedit,
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
