<?php   
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);

    $sql_d = $conexionCancer->prepare("DELETE from antecedentesfamiliarescancer where id_paciente = :id_paciente");
        $sql_d->execute(array(
            ':id_paciente'=>$id_paciente
        ));
    
            $sql_c = $conexionCancer->prepare("UPDATE cancerpaciente set descripcioncancer = :descripcioncancer where id_paciente = :id_paciente");
                
            $sql_c->execute(array(
                ':descripcioncancer'=>$tipodecanceredit,
                ':id_paciente'=>$id_paciente

            ));
        

        if($mscanceredit != ''){
        foreach($mscanceredit as $heredoedit) {
            
            $sql = $conexionCancer->prepare("INSERT into antecedentesfamiliarescancer(datoantecedentefamiliar, id_paciente) 

            values(:datoantecedentefamiliar, :id_paciente)");

            $sql->execute(array(
                ':datoantecedentefamiliar'=>$heredoedit,
                ':id_paciente'=>$id_paciente

            ));
        }
    }else{
        $sql = '';
    }
                        
                            if($sql || $sql_d || $sql_c == true) {
                        
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