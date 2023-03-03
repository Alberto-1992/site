<?php
include("../conexionCancer.php");
error_reporting(0);
date_default_timezone_set('America/Monterrey');
$hoy = date("Y-m-d");
    extract($_POST);	
$artritis = 'Artritis reumatoide';	
	//buscamos el email	
    
	$sql_busqueda = $conexionCancer->prepare("SELECT curp, id_usuarioartritis from dato_usuarioartritis where curp = :curp");
	    $sql_busqueda->bindParam(':curp',$curp,PDO::PARAM_STR);
    $sql_busqueda->execute();
    $sql_busqueda->setFetchMode(PDO::FETCH_ASSOC);
    $validacion = $sql_busqueda->fetch();
        $validaCurp = $validacion['curp'];
        $id_check = $validacion['id_usuarioartritis'];
        
         $sql = $conexionCancer->prepare("SELECT id_paciente from artritispaciente where id_paciente = :id_paciente limit 1");
                            $sql->execute(array(
            
                                ':id_paciente' => $id_check
                            
                            ));
                            $row = $sql->fetch();
                            $id_valida = $row['id_paciente'];
    if($id_valida != false){
        echo "<script>swal({
            title: 'Fatal!',
            text: 'Error!! ya existe un paciente con este CURP y registro de cancer!',
            icon: 'error',
            timer: 1500,
                    showConfirmButton: false
            });</script>";
        
    }else{
	// SI EL EMAIL NO EXISTE, REGISTRAMOS LOS DATOS EN LA TABLA USUARIO   
	$sql = $conexionCancer->prepare("INSERT into dato_usuarioartritis(curp, nombrecompleto, escolaridad, fechanacimiento, edad, sexo,  year) 
    
                                    values (:curp, :nombrecompleto, :escolaridad, :fechanacimiento, :edad, :sexo,  :year)");
                    
                                $sql->execute(array(
                                    ':curp'=> $curp,
                                    ':nombrecompleto'=>$nombrecompleto,
                                    ':escolaridad'=>$escolaridad,
                                    ':fechanacimiento'=>$fecha,
                                    ':edad'=>$edad, 
                                    ':sexo'=>$sexo,
                                    ':year'=>$hoy
        )); 
        $sql = $conexionCancer->prepare("SELECT id_usuarioartritis from dato_usuarioartritis where curp = :curp");
        $sql->execute(array(

            ':curp' => $curp
        
        ));
        $row = $sql->fetch();
        $id_usuario = $row['id_usuarioartritis'];
        $sql = $conexionCancer->prepare("INSERT into artritispaciente(id_artritispaciente, descripcion_artritis,id_paciente) VALUES(:id_artritispaciente, :descripcion_artritis,:id_paciente)");
        $sql->execute(array(
            ':id_artritispaciente'=>$id_usuario,
            ':descripcion_artritis'=>$artritis,
            ':id_paciente'=>$id_usuario
        ));
        $sql = $conexionCancer->prepare("INSERT into somatometriaartritis(id_somatometria,id_paciente,tallaartritis,pesoartritis,imcartritis)values(:id_somatometria,:id_paciente,:tallaartritis,:pesoartritis,:imcartritis)");
            $sql->execute(array(
                ':id_somatometria'=>uniqid('hraei'),
                ':id_paciente'=>$id_usuario,
                ':tallaartritis'=>$talla,
                ':pesoartritis'=>$peso,
                ':imcartritis'=>$imc  
            ));
                        $msartritis;
                        if(is_array($msartritis) || is_object($msartritis)){
                            foreach($msartritis as $seleccion) {
                                $sql_s = $conexionCancer->prepare("INSERT into antecedentespatologicosartritis(detalleantecedente,id_paciente) 
                
                                            values(:detalleantecedente,:id_paciente)");

                                                $sql_s->execute(array(
                                                    
                                                    ':detalleantecedente'=>$seleccion,
                                                    ':id_paciente'=>$id_usuario
                                                    
                                    ));
                            }
                        }
        $sql = $conexionCancer->prepare("INSERT into laboratoriosartritis(id_laboratorio,plaquetas,frbasal,frnominal,pcr,vitaminadbasal,vitaminadnominal,anticppbasal,anticppnominal,vsg,tgobasal,tgonominal,tgpbasal,tgpnominal,glucosa,colesterol,trigliceridos,fib4,resultadofib4,id_paciente)
        values(:id_laboratorio,:plaquetas,:frbasal,:frnominal,:pcr,:vitaminadbasal,:vitaminadnominal,:anticppbasal,:anticppnominal,:vsg,:tgobasal,:tgonominal,:tgpbasal,:tgpnominal,:glucosa,:colesterol,:trigliceridos,:fib4,:resultadofib4,:id_paciente)");
                    $sql->execute(array(
                        ':id_laboratorio'=>uniqid('hraei'),
                        ':plaquetas'=>$plaquetas,
                        ':frbasal'=>$frbasal,
                        ':frnominal'=>$frnominal,
                        ':pcr'=>$pcr,
                        ':vitaminadbasal'=>$vitaminaDBasal,
                        ':vitaminadnominal'=>$vitaminaDNominal,
                        ':anticppbasal'=>$anticppbasal,
                        ':anticppnominal'=>$anticppnominal,
                        ':vsg'=>$vsg,
                        ':tgobasal'=>$tgobasal,
                        ':tgonominal'=>$tgonominal,
                        ':tgpbasal'=>$tgpbasal,
                        ':tgpnominal'=>$tgpnominal,
                        ':glucosa'=>$glucosa,
                        ':colesterol'=>$colesterol,
                        ':trigliceridos'=>$trigliceridos,
                        ':fib4'=>$fib4,
                        ':resultadofib4'=>$resultadofib,
                        ':id_paciente'=>$id_usuario
                    ));
        $sql = $conexionCancer->prepare("INSERT into usghepaticoartritis(id_usg,id_paciente,detalleusghepatico,hallazgousg,clasificacionesteatosis)
        values(:id_usg,:id_paciente,:detalleusghepatico,:hallazgousg,:clasificacionesteatosis)");
                $sql->execute(array(
                    ':id_usg'=>uniqid('hraei'),
                    ':id_paciente'=>$id_usuario,
                    ':detalleusghepatico'=>$usghepatico,
                    ':hallazgousg'=>$hallazgousg,
                    ':clasificacionesteatosis'=>$clasificacionesteatosis
                ));
        $sql = $conexionCancer->prepare("INSERT into clinicaartritis(id_clinica,id_paciente,articulacionesinflamadassjc28,articulacionesdolorosastjc28,evglobalpga,evega,resultadocdai,resultadosdai)
        values(:id_clinica,:id_paciente,:articulacionesinflamadassjc28,:articulacionesdolorosastjc28,:evglobalpga,:evega,:resultadocdai,:resultadosdai)");
                $sql->execute(array(
                    ':id_clinica'=>uniqid('hraei'),
                    ':id_paciente'=>$id_usuario,
                    ':articulacionesinflamadassjc28'=>$articulacionesInflamadasSJC28,
                    ':articulacionesdolorosastjc28'=>$articulacionesDolorosasTJC28,
                    ':evglobalpga'=>$evglobalpga,
                    ':evega'=>$evega,
                    ':resultadocdai'=>$resultadocdai,
                    ':resultadosdai'=>$resultadosdai
                ));
        $sql = $conexionCancer->prepare("INSERT into tratamientoartritis(id_tratamientoartritis,id_paciente,metrotexate,dosissemanalmetro,leflunomide,dosissemanalfemua,sulfazalasina,
        dosissemanalsulfa,tecoferol,dosissemanalteco,glucocorticoide,usghepatico,dosissemanaltrata,vitaminad,dosissemanalvitad,biologico,tratamientobiologico,apegotratamiento)
        values(:id_tratamientoartritis,:id_paciente,:metrotexate,:dosissemanalmetro,:leflunomide,:dosissemanalfemua,:sulfazalasina,
        :dosissemanalsulfa,:tecoferol,:dosissemanalteco,:glucocorticoide,:usghepatico,:dosissemanaltrata,:vitaminad,:dosissemanalvitad,:biologico,:tratamientobiologico,:apegotratamiento)");
                $sql->execute(array(
                    ':id_tratamientoartritis'=>uniqid('hraei'),
                    ':id_paciente'=>$id_usuario,
                    ':metrotexate'=>$metrotexate,
                    ':dosissemanalmetro'=>$dosisSemanalmetro,
                    ':leflunomide'=>$leflunomide,
                    ':dosissemanalfemua'=>$dosisSemanalfemua,
                    ':sulfazalasina'=>$sulfazalasina,
                    ':dosissemanalsulfa'=>$dosisSemanalsulfa,
                    ':tecoferol'=>$tecoferol,
                    ':dosissemanalteco'=>$dosisSemanalteco,
                    ':glucocorticoide'=>$glucocorticoide,
                    ':usghepatico'=>$tratamientogluco,
                    ':dosissemanaltrata'=>$dosisSemanaltrata,
                    ':vitaminad'=>$vitaminaD,
                    ':dosissemanalvitad'=>$dosisSemanalvitad,
                    ':biologico'=>$biologico,
                    ':tratamientobiologico'=>$tratamientobiologico,
                    ':apegotratamiento'=>$apegotratamiento
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
    }
    ?>