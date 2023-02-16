<?php   
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);

    $sql_d = $conexionCancer->prepare("DELETE from antecedentespatopersonales where id_paciente = :id_paciente");
        $sql_d->execute(array(
            ':id_paciente'=>$id_paciente
        ));
    
        
        

        if($check_listapatoedit != ''){
        
            foreach($check_listapatoedit as $seleccionedit) {
                $sql_s = $conexionCancer->prepare("INSERT into antecedentespatopersonales(descripcionantecedente, id_paciente) 

                            values(:descripcionantecedente, :id_paciente)");

                                $sql_s->execute(array(
                                    ':descripcionantecedente'=>$seleccionedit,
                                    ':id_paciente'=>$id_paciente
                    ));
            }
    }else{
        $sql = '';
    }
                        
                            if($sql_s || $sql_d == true) {
                        
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