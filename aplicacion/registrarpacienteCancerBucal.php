<?php
include("../conexionCancer.php");
//error_reporting(0);

date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);
    $tipodecancer = 'Cancer bucal'; 	
	//buscamos el email	   
	$sql_busqueda = $conexionCancer->prepare("SELECT curpbucal, id_bucal from dato_usuariobucal where curpbucal = :curpbucal");
	$sql_busqueda->bindParam(':curpbucal',$curp,PDO::PARAM_STR);
    $sql_busqueda->execute();
    $sql_busqueda->setFetchMode(PDO::FETCH_ASSOC);
    $validacion = $sql_busqueda->fetch();
    if(is_array($validacion)){
        $validaCurp = $validacion['curpbucal'];
        $id_check = $validacion['id_bucal'];
    }
            $sql = $conexionCancer->prepare("SELECT id_pacientebucal from cancerbucal where id_pacientebucal = :id_pacientebucal limit 1");
                            $sql->execute(array(
            
                                ':id_pacientebucal' =>$id_check
                            
                            ));
                            
                            $row = $sql->fetch();
                            if(is_array($row)){
                            $id_valida = $row['id_pacientebucal'];
                            }
    if(isset($id_valida) != false){
        echo "<script>swal({
            title: 'Fatal!',
            text: 'Error!! ya existe un paciente con este CURP y registro de cancer!',
            icon: 'error',
            timer: 1500,
                    showConfirmButton: false
            });</script>";
        
    }else{
	// SI EL EMAIL NO EXISTE, REGISTRAMOS LOS DATOS EN LA TABLA USUARIO
        //if($validaCurp != $curp){
	$sql = $conexionCancer->prepare("INSERT into dato_usuariobucal(curpbucal, nombrecompletobucal, escolaridadbucal, fechanacimientobucal, edadbucal, sexobucal, razabucal, estadobucal, municipiobucal, yearbucal) 
    
                                    values (:curpbucal, :nombrecompletobucal, :escolaridadbucal, :fechanacimientobucal, :edadbucal, :sexobucal, :razabucal, :estadobucal, :municipiobucal, :yearbucal)");
                    
                                $sql->execute(array(
                                    ':curpbucal'=>$curp,
                                    ':nombrecompletobucal'=>$nombrecompleto,
                                    ':escolaridadbucal'=>$escolaridad,
                                    ':fechanacimientobucal'=>$fecha,  
                                    ':edadbucal'=>$edad,  
                                    ':sexobucal'=>$sexo,
                                    ':razabucal'=>$raza,
                                    ':estadobucal'=>$cbx_estado,  
                                    ':municipiobucal'=>$cbx_municipio,  
                                    ':yearbucal'=>$hoy
                                )); 

                            $sql = $conexionCancer->prepare("SELECT id_bucal from dato_usuariobucal where curpbucal = :curpbucal");
                            $sql->execute(array(
            
                                ':curpbucal'=>$curp
                            
                            ));
                            $row = $sql->fetch();
                            $id_usuario = $row['id_bucal'];
                            

                            
                            $sql = $conexionCancer->prepare("INSERT INTO cancerbucal(descripcion_bucal, id_pacientebucal)
                                        values(:descripcion_bucal, :id_pacientebucal)");
                                        $sql->execute(array(
                                            ':descripcion_bucal'=>$tipodecancer,
                                            ':id_pacientebucal'=>$id_usuario
                                        ));
                                        $sql = $conexionCancer->prepare("INSERT into unidadreferenciadobucal(id_referenciabucal, id_pacientebucal, referenciadobucal, cluesbucal) 
                                        values(:id_referenciabucal, :id_pacientebucal, :referenciadobucal, :cluesbucal)");
                                        $sql->execute(array(
                                                ':id_referenciabucal'=>uniqid('hraei'),
                                                ':id_pacientebucal'=>$id_usuario, 
                                                ':referenciadobucal'=>$referenciado,
                                                ':cluesbucal'=>$unidadreferencia
                                        ));
                                
    
                                $sql = $conexionCancer->prepare("INSERT into somatometriabucal(id_signovitalbucal, id_pacientebucal, tallabucal, pesobucal, imcbucal)
                                        values(:id_signovitalbucal, :id_pacientebucal, :tallabucal, :pesobucal, :imcbucal)");
                                        $sql->execute(array(
                                                    ':id_signovitalbucal'=>uniqid('hraei'),
                                                    ':id_pacientebucal'=>$id_usuario,   
                                                    ':tallabucal'=>$tallabucal,
                                                    ':pesobucal'=>$pesobucal,
                                                    ':imcbucal'=>$imcbucal 
                                                    
                                        ));
                                $sql = $conexionCancer->prepare("INSERT into antecedentesnopatologicosbucal(id_antecedentenopato,id_pacientebucal,exposicionsolarbucal,comidasbucal,higienebucal)
                                    values(:id_antecedentenopato,:id_pacientebucal,:exposicionsolarbucal,:comidasbucal,:higienebucal)");
                                        $sql->execute(array(
                                            ':id_antecedentenopato'=>uniqid('hraei'),
                                            ':id_pacientebucal'=>$id_usuario,
                                            ':exposicionsolarbucal'=>$exposicionsolarbucal,
                                            ':comidasbucal'=>$comidasbucal,
                                            ':higienebucal'=>$higienebucal
                                        ));
                                        $mstoxicomanias;
                        if(is_array($mstoxicomanias) || is_object($mstoxicomanias)){
                            foreach($mstoxicomanias as $toxicoheredo) {
                                $sql_s = $conexionCancer->prepare("INSERT into antecedentespersonalespatotoxicobucal(descripcionantecedentepatobucal, id_pacientebucal) 
                
                                values(:descripcionantecedentepatobucal, :id_pacientebucal)");
            
                                $sql_s->execute(array(
                                    ':descripcionantecedentepatobucal'=>$toxicoheredo,
                                    ':id_pacientebucal'=>$id_usuario
            
                                ));
                            }
                        };
                            $sql = $conexionCancer->prepare("INSERT into alcoholismotabaquismobucal(id_alcoholtabacobucal,id_pacientebucal,frecuenciaalcoholbucal,tiempotabaquismobucal,cigarrosaldiabucal)
                                    values(:id_alcoholtabacobucal,:id_pacientebucal,:frecuenciaalcoholbucal,:tiempotabaquismobucal,:cigarrosaldiabucal)");
                                        $sql->execute(array(
                                            ':id_alcoholtabacobucal'=>uniqid('hraei'),
                                            ':id_pacientebucal'=>$id_usuario,
                                            ':frecuenciaalcoholbucal'=>$frecuenciaal,
                                            ':tiempotabaquismobucal'=>$anostabaquismo,
                                            ':cigarrosaldiabucal'=>$cigarrosdia
                                        ));
                                        $mshabitos;
                                        if(is_array($mshabitos) || is_object($mshabitos)){
                                            foreach($mshabitos as $habitos) {
                                                $sql = $conexionCancer->prepare("INSERT into habitospersonalespatobucal(descripcionhabitopatobucal, id_pacientebucal) 
                                
                                                values(:descripcionhabitopatobucal, :id_pacientebucal)");
                            
                                                $sql->execute(array(
                                                    ':descripcionhabitopatobucal'=>$habitos,
                                                    ':id_pacientebucal'=>$id_usuario
                            
                                                ));
                                            }
                                        };  
                                        $msvirus;
                                        if(is_array($msvirus) || is_object($msvirus)){
                                            foreach($msvirus as $viruspato) {
                                                $sql = $conexionCancer->prepare("INSERT into viruspatobucal(descripcionviruspatobucal, id_pacientebucal) 
                                
                                                values(:descripcionviruspatobucal, :id_pacientebucal)");
                            
                                                $sql->execute(array(
                                                    ':descripcionviruspatobucal'=>$viruspato,
                                                    ':id_pacientebucal'=>$id_usuario
                            
                                                ));
                                            }
                                        };  
                                    
                                        $mscancer;
                                        if(is_array($mscancer) || is_object($mscancer)){
                                            foreach($mscancer as $cancerpato) {
                                                $sql = $conexionCancer->prepare("INSERT into cancerpatopatobucal(descripcioncancerpatobucal, id_pacientebucal) 
                                
                                                values(:descripcioncancerpatobucal, :id_pacientebucal)");
                            
                                                $sql->execute(array(
                                                    ':descripcioncancerpatobucal'=>$cancerpato,
                                                    ':id_pacientebucal'=>$id_usuario
                            
                                                ));
                                            }
                                        }; 
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