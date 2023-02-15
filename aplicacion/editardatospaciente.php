<?php
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);

    $sql = $conexionCancer->prepare("UPDATE dato_usuario set curp = :curp, nombrecompleto = :nombrecompleto, poblacionindigena = :poblacionindigena, escolaridad =:escolaridad, fechanacimiento =:fechanacimiento, edad = :edad,
    sexo = :sexo, raza = :raza, estado = :estado, municipio = :municipio where id = :id");
        $sql->execute(array(
            ':curp' => $curpedit,
            ':nombrecompleto' => $nombrecompletoedit,
            ':poblacionindigena' =>$poblacionindigenaedit,
            ':escolaridad' =>$escolaridadedit,
            ':fechanacimiento' =>$fechaedit,
            ':edad'=>$edadedit,
            ':sexo' =>$sexoedit,
            ':raza' =>$razaedit,
            ':estado'=>$cbx_estadoedit,
            ':municipio'=>$cbx_municipioedit,
            ':id'=>$id_paciente
        ));
        $sql_d = $conexionCancer->prepare("UPDATE signosvitales set talla = :talla, peso = :peso, imc = :imc where id_paciente = :id_paciente");
            $sql_d->execute(array(
                ':talla'=>$tallaedit,
                ':peso'=>$pesoedit,
                ':imc'=>$imcedit,
                ':id_paciente'=>$id_paciente
            ));

    


            if($sql || $sql_d == true) {
        
                echo "<script>swal({
                            title: 'Good job!',
                            text: 'Datos actualizados exitosamente!',
                            icon: 'success',
                            
                    });
                    </script>";	
                
                }else if($sql == false or $sql_d == false){
                    
                    echo "<script>swal({
                            title: 'Fatal!',
                            text: 'Error al actualizar informacion!',
                            icon: 'error',
                            });</script>";
                        
                    
                    }
?>