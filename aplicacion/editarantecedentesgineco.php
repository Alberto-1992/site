<?php   
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);

$sql = $conexionCancer->prepare("UPDATE antecedentesgineco set menarca = :menarca, ultimamestruacion = :ultimamestruacion, cuentacon = :cuentacon, gestas = :gestas, parto = :parto, aborto = :aborto, cesarea = :cesarea, 
embarazada = :embarazada, fpp = :fpp, terapiareemplazohormonal = :terapiareemplazohormonal, lactancia = :lactancia, tiempolactancia = :tiempolactancia where id_paciente = :id_paciente");
                    
                                $sql->execute(array(
                                    ':menarca'=> $menarcaedit,
                                    ':ultimamestruacion'=>$fechaultimamestruacionedit,
                                    ':cuentacon'=>$menopauseaedit,
                                    ':gestas'=>$gestasedit,
                                    ':parto'=>$partoedit,
                                    ':aborto'=>$abortoedit,
                                    ':cesarea'=>$cesareaedit,
                                    ':embarazada'=>$embarazadaedit,
                                    ':fpp'=>$fechaprobablepartoedit,
                                    ':terapiareemplazohormonal'=>$planificacionfamiliaredit,
                                    ':lactancia'=>$lactanciaedit,
                                    ':tiempolactancia'=>$tiempolactanciaedit,
                                    ':id_paciente'=>$id_paciente
));

                            if($sql == true) {
                        
                                echo "<script>swal({
                                            title: 'Good job!',
                                            text: 'Datos actualizados exitosamente!',
                                            icon: 'success',
                                            
                                    });
                                    </script>";	
                                
                                }else {
                                    
                                    echo "<script>swal({
                                            title: 'Fatal!',
                                            text: 'Error al actualizar informacion!',
                                            icon: 'error',
                                            });</script>";
                                        
                                    
                                    }

?>