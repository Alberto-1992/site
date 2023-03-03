<?php
include("../conexionCancer.php");
error_reporting(0);
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);	
	//buscamos el email	
        
	// SI EL EMAIL NO EXISTE, REGISTRAMOS LOS DATOS EN LA TABLA USUARIO   
	$sql = $conexionCancer->prepare("UPDATE dato_usuarioartritis SET curp = :curp, nombrecompleto = :nombrecompleto, escolaridad = :escolaridad, fechanacimiento = :fechanacimiento, edad = :edad, sexo = :sexo,  year = :year where id_usuarioartritis = :id_usuarioartritis"); 

                    
                                $sql->execute(array(
                                    ':curp'=> $curpedit,
                                    ':nombrecompleto'=>$nombrecompletoedit,
                                    ':escolaridad'=>$escolaridadedit,
                                    ':fechanacimiento'=>$fechaedit,
                                    ':edad'=>$edadedit, 
                                    ':sexo'=>$sexoedit,
                                    ':year'=>$hoy,
                                    ':id_usuarioartritis'=>$id_paciente
        )); 
        $sql = $conexionCancer->prepare("UPDATE somatometriaartritis SET tallaartritis = :tallaartritis, pesoartritis = :pesoartritis,imcartritis = :imcartritis where id_paciente = :id_paciente");

            $sql->execute(array(
                ':tallaartritis'=>$tallaedit,
                ':pesoartritis'=>$pesoedit,
                ':imcartritis'=>$imcedit,
                ':id_paciente'=>$id_paciente 
            ));
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
    ?>