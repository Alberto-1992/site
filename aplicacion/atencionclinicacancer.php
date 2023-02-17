<?php   
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);

    $sql = $conexionCancer->prepare("UPDATE atencionclinica set fechaatencioninicial = :fechaatencioninicial, biradsreferencia = :biradsreferencia, biradshraei = :biradshraei, lateralidadmama = :lateralidadmama, 
        estadioclinico = :estadioclinico, etapaclinica = :etapaclinica, tamaniotumoral = :tamaniotumoral, compromisolenfatico = :compromisolenfatico, metastasis = :metastasis, calidaddevidaecog = :calidaddevidaecog, 
        mastectoextrainstituto = :mastectoextrainstituto, lateralidadmastectoextrainstituto = :lateralidadmastectoextrainstituto, fechamastectoextrainstituto = :fechamastectoextrainstituto where id_usuario = :id_usuario");
                        $sql->execute(array(
                            ':fechaatencioninicial'=>$fechaatencioninicialedit,
                            ':biradsreferencia'=>$biradsreferenciaedit,
                            ':biradshraei'=>$biradshraeiedit,
                            ':lateralidadmama'=>$lateralidadprimeroedit,
                            ':estadioclinico'=>$estadioclinicoedit,
                            ':etapaclinica'=>$etapasclinicasedit,
                            ':tamaniotumoral'=>$tamaniotumoraledit,
                            ':compromisolenfatico'=>$linfaticonodaledit,
                            ':metastasis'=>$metastasisedit,
                            ':calidaddevidaecog'=>$calidaddevidaecogedit,
                            ':mastectoextrainstituto'=>$mastectomiaextrainstitucionaledit,
                            ':lateralidadmastectoextrainstituto'=>$lateralidadextrainstitucionaledit,
                            ':fechamastectoextrainstituto'=>$fechamastectoextraedit,
                            ':id_usuario'=>$id_paciente
                        ));
                        if($sql == true) {
                        
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