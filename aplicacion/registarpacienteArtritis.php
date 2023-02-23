<?php
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);
		
	//buscamos el email	
    
	$sql_busqueda = $conexionCancer->prepare("SELECT curp, id from dato_usuario where curp = :curp");
	    $sql_busqueda->bindParam(':curp',$curp,PDO::PARAM_STR);
    $sql_busqueda->execute();
    $sql_busqueda->setFetchMode(PDO::FETCH_ASSOC);
    $validacion = $sql_busqueda->fetch();
        $validaCurp = $validacion['curp'];
        $id_check = $validacion['id'];
        
         $sql = $conexionCancer->prepare("SELECT id_paciente from artritispaciente where id_paciente = :id_paciente limit 1");
                            $sql->execute(array(
            
                                ':id_paciente' => $id_check
                            
                            ));
                            $row = $sql->fetch();
                            $id_valida = $row['id_paciente'];
    if($id_valida != false){
        echo "<script>swal({
            title: 'Fatal!',
            text: 'Error!! ya existe un paciente con este CURP y registro de artritis!',
            icon: 'error',
            timer: 1500,
                    showConfirmButton: false
            });</script>";
        
    }else{
	// SI EL EMAIL NO EXISTE, REGISTRAMOS LOS DATOS EN LA TABLA USUARIO
    $raza = 'sin dato';   
    $cbx_estado = 0;
    $cbx_municipio = 0;
    $artritis = 'Artritis reumatoide';
        if($validaCurp != $curp){
    
	$sql = $conexionCancer->prepare("INSERT into dato_usuario(curp, nombrecompleto, poblacionindigena, escolaridad, fechanacimiento, edad, sexo, raza, estado, municipio, year) 
    
                                    values (:curp, :nombrecompleto, :poblacionindigena, :escolaridad, :fechanacimiento, :edad, :sexo, :raza, :estado, :municipio, :year)");
                    
                                $sql->execute(array(
                                    ':curp'=> $curp,
                                    ':nombrecompleto'=>$nombrecompleto,
                                    ':poblacionindigena'=>$raza,
                                    ':escolaridad'=>$escolaridad,
                                    ':fechanacimiento'=>$fecha,
                                    ':edad'=>$edad, 
                                    ':sexo'=>$sexo,
                                    ':raza'=>$raza,
                                    ':estado'=>$cbx_estado,
                                    ':municipio'=>$cbx_municipio,
                                    ':year'=>$hoy
        )); 
        $sql = $conexionCancer->prepare("SELECT id from dato_usuario where curp = :curp");
        $sql->execute(array(

            ':curp' => $curp
        
        ));
        $row = $sql->fetch();
        $id_usuario = $row['id'];
        $sql = $conexionCancer->prepare("INSERT into artritispaciente(descripcion_artritis,id_paciente) VALUES(:descripcion_artritis,:id_paciente)");
        $sql->execute(array(
            ':descripcion_artritis'=>$artritis,
            ':id_paciente'=>$id_usuario
        ));
        }else{
            $sql = $conexionCancer->prepare("INSERT into artritispaciente(descripcion_artritis,id_paciente) VALUES(:descripcion_artritis,:id_paciente)");
                $sql->execute(array(
                    ':descripcion_artritis'=>$artritis,
                    ':id_paciente'=>$id_check
                ));

        }
        if($sql != false) {
            echo "<script>swal({
                        title: 'Good job!',
                        text: 'Datos guardados exitosamente!',
                        icon: 'success',
                        timer: 1500,
showConfirmButton: false
                        
                });
                </script>";	
            
            }else {
                
                echo "<script>swal({
                        title: 'Fatal!',
                        text: 'Error al guardar informacion!',
                        icon: 'error',
                        timer: 1500,
showConfirmButton: false
                        });</script>";
                    
                
                }
    }
    ?>