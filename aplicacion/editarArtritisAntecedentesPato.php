<?php   
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);

    $sql_d = $conexionCancer->prepare("DELETE from antecedentespatologicosartritis where id_paciente = :id_paciente");
        $sql_d->execute(array(
            ':id_paciente'=>$id_paciente
        ));
    

            $msartritisedit;
            if(is_array($msartritisedit) || is_object($msartritisedit)){
                foreach($msartritisedit as $seleccionedit) {
                    $sql_s = $conexionCancer->prepare("INSERT into antecedentespatologicosartritis(detalleantecedente,id_paciente) 
    
                                values(:detalleantecedente,:id_paciente)");

                                    $sql_s->execute(array(
                                        
                                        ':detalleantecedente'=>$seleccionedit,
                                        ':id_paciente'=>$id_paciente
                                        
                        ));
                }
            }
    
                        
                            if($sql || $sql_d || $sql_s == true) {
                        
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