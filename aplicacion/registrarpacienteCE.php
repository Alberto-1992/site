<?php
include("../conexionCancer.php");
date_default_timezone_set('America/Monterrey');
$hoy = date("d-m-Y");
    extract($_POST);
		
	//buscamos el email	
//	$sql_busqueda = $conexion2->query("SELECT email from usuarios where email = '".$email."'");

	// SI EL EMAIL NO EXISTE, REGISTRAMOS LOS DATOS EN LA TABLA USUARIO

 
	$sql = $conexionCancer->prepare("INSERT into dato_personalinfarto(curp, nombrecompleto, poblacionindigena, escolaridad, fechanacimiento, edad, sexo, raza, estado, municipio,  year) 
    
                                    values (:curp, :nombrecompleto, :poblacionindigena, :escolaridad, :fechanacimiento, :edad, :sexo, :raza, :estado, :municipio, :year)");
                    $sql->execute(array(
                                ':curp'=>$curpinfarto,
                                ':nombrecompleto'=>$nombrecompleto, 
                                ':poblacionindigena'=>$poblacionindigena, 
                                ':escolaridad'=>$escolaridad, 
                                ':fechanacimiento'=>$fechainfarto,
                                ':edad'=>$edadinfarto, 
                                ':sexo'=>$sexoinfarto,
                                ':raza'=>$raza,
                                ':estado'=>$cbx_estado, 
                                ':municipio'=>$cbx_municipio, 
                                ':year'=>$hoy
                            )); 

                        $sql = $conexionCancer->prepare("SELECT id from dato_personalinfarto where curp = :curp");
                                $sql->execute(array(
                                    ':curp'=>$curpinfarto
                                ));
                                $row = $sql->fetch();
                                $identi = $row['id'];
                        $sql = $conexionCancer->prepare("INSERT into infartopaciente(descripcioninfarto, id_pacienteinfarto)
                                values(:descripcioninfarto,:id_pacienteinfarto)");
                                    $sql->execute(array(
                                        ':descripcioninfarto'=>$consinelevacion,
                                        ':id_pacienteinfarto'=>$identi
                                    ));
                                    $msfactoresinfarto;
                                    if(is_array($msfactoresinfarto) || is_object($msfactoresinfarto)){       
                                        foreach($msfactoresinfarto as $factorinfarto) {
                                            $sql_s = $conexionCancer->prepare("INSERT into factoresriesgoinfarto(descripcionfrinfarto, id_pacienteinfarto) 
                            
                                            values(:descripcionfrinfarto, :id_pacienteinfarto)");
                        
                                            $sql_s->execute(array(
                                                ':descripcionfrinfarto'=>$factorinfarto,
                                                ':id_pacienteinfarto'=>$identi
                        
                                            ));
                                        }
                                    }
                                    $sql = $conexionCancer->prepare("INSERT into somatometriainfarto(id_somatometriainfa,id_pacienteinfarto,fc,pa,tallainfarto,pesoinfarto,imcinfarto)
                                            values(:id_somatometriainfa,:id_pacienteinfarto,:fc,:pa,:tallainfarto,:pesoinfarto,:imcinfarto)");
                                                $sql->execute(array(
                                                    ':id_somatometriainfa'=>uniqid('hraei'),
                                                    ':id_pacienteinfarto'=>$identi,
                                                    ':fc'=>$frecuenciacardiaca,
                                                    ':pa'=>$presionarterial,
                                                    ':tallainfarto'=>$talla,
                                                    ':pesoinfarto'=>$peso,
                                                    ':imcinfarto'=>$imc
                                                ));
                                                $mslesionescoronarias;
                                                if(is_array($mslesionescoronarias) || is_object($mslesionescoronarias)){       
                                                    foreach($mslesionescoronarias as $lesionesinfarto) {
                                                        $sql = $conexionCancer->prepare("INSERT into macehospinfarto(descripcionmacehosp, id_pacienteinfarto) 
                                        
                                                        values(:descripcionmacehosp, :id_pacienteinfarto)");
                                    
                                                        $sql->execute(array(
                                                            ':descripcionmacehosp'=>$lesionesinfarto,
                                                            ':id_pacienteinfarto'=>$identi
                                    
                                                        ));
                                                    }
                                                }
                                    $sql = $conexionCancer->prepare("INSERT into atencionclinicainfarto(id_atencionclinica,iniciosintomas,caracterisiticasdolor,iniciotriage,terminotriage,electrocardiograma,localizacionelectro,consinelevacion,killipkimball,id_pacienteinfarto)
                                            value(:id_atencionclinica,:iniciosintomas,:caracterisiticasdolor,:iniciotriage,:terminotriage,:electrocardiograma,:localizacionelectro,:consinelevacion,:killipkimball,:id_pacienteinfarto)");
                                                $sql->execute(array(
                                                    ':id_atencionclinica'=>uniqid('hraei'),
                                                    ':iniciosintomas'=>$fechasintomas,
                                                    ':caracterisiticasdolor'=>$caractipicasatipicas,
                                                    ':iniciotriage'=>$primercontacto,
                                                    ':terminotriage'=>$terminotriage,
                                                    ':electrocardiograma'=>$elctrocardio,
                                                    ':localizacionelectro'=>$localizacion,
                                                    ':consinelevacion'=>$consinelevacion,
                                                
                                                    ':killipkimball'=>$killipkimball,
                                                    ':id_pacienteinfarto'=>$identi
                                                ));
                                        
                                    $sql = $conexionCancer->prepare("INSERT into paraclinicos(id_paraclinico,ck,ckmb,troponinas,glucosa,urea,creatinina,colesterol,trigliceridos,acidourico,hbglucosilada,proteinas,colesteroltotal,ldl,hdl,id_paciente)
                                            values(:id_paraclinico,:ck,:ckmb,:troponinas,:glucosa,:urea,:creatinina,:colesterol,:trigliceridos,:acidourico,:hbglucosilada,:proteinas,:colesteroltotal,:ldl,:hdl,:id_paciente)");
                                            $sql->execute(array(
                                                ':id_paraclinico'=>uniqid('hraei'),
                                                ':ck'=>$ck,
                                                ':ckmb'=>$ckmb,
                                                ':troponinas'=>$troponinas,
                                                ':glucosa'=>$glucosa,
                                                ':urea'=>$urea,
                                                ':creatinina'=>$creatinina,
                                                ':colesterol'=>$colesterol,
                                                ':trigliceridos'=>$trigliceridos,
                                                ':acidourico'=>$acidourico,
                                                ':hbglucosilada'=>$hbglucosilada,
                                                ':proteinas'=>$proteinas,
                                                ':colesteroltotal'=>$colesteroltotal,
                                                ':ldl'=>$ldl,
                                                ':hdl'=>$hdl,
                                                ':id_paciente'=>$identi

                                            ));
                                    $sql = $conexionCancer->prepare("INSERT into tratamientoinfarto(id_tratamientoinfarto,fibrinolisis,horainiciofibro,horaterminofibro,tipofibrinolitico,procedimientoexitoso,id_pacienteinfarto)
                                    values(:id_tratamientoinfarto,:fibrinolisis,:horainiciofibro,:horaterminofibro,:tipofibrinolitico,:procedimientoexitoso,:id_pacienteinfarto)");
                                        $sql->execute(array(
                                            ':id_tratamientoinfarto'=>uniqid('hraei'),
                                            ':fibrinolisis'=>$trombolisis,
                                            ':horainiciofibro'=>$iniciotrombolisis,
                                            ':horaterminofibro'=>$finalizotrombolisis,
                                            ':tipofibrinolitico'=>$fibrinoliticos,
                                            ':procedimientoexitoso'=>$exitotrombolisis,
                                            ':id_pacienteinfarto'=>$identi
                                        ));
                                    $sql = $conexionCancer->prepare("INSERT into angiocoronaria(id_angiocorono,fechahoraangio,tipoprocedimientoangio,sitiopuncionangio,lesionescoronoangio,clasificaciondukeangio,clasiificacionmedinaangio,clasificacionaccahaangio,severidadangio,protesisendovascularangio,primerageneracionangio,segundageneracionangio,numeroprotesisangio,revascularizacionangio,procedimientoexitosoangio,airbusangio,resultadoairbusangio,octangio,id_pacienteinfarto)
                                        values(:id_angiocorono,:fechahoraangio,:tipoprocedimientoangio,:sitiopuncionangio,:lesionescoronoangio,:clasificaciondukeangio,:clasiificacionmedinaangio,:clasificacionaccahaangio,:severidadangio,:protesisendovascularangio,:primerageneracionangio,:segundageneracionangio,:numeroprotesisangio,:revascularizacionangio,:procedimientoexitosoangio,:airbusangio,:resultadoairbusangio,:octangio,:id_pacienteinfarto)");
                                        $sql->execute(array(
                                            ':id_angiocorono'=>uniqid('hraei'),
                                            ':fechahoraangio'=>$inicioprocedimiento,
                                            ':tipoprocedimientoangio'=>$tipoangioplastia,
                                            ':sitiopuncionangio'=>$tipositiopuncion,
                                            ':lesionescoronoangio'=>$lesionescoronarias,
                                            ':clasificaciondukeangio'=>$clasificacionduke,
                                            ':clasiificacionmedinaangio'=>$clasificacionmedina,
                                            ':clasificacionaccahaangio'=>$lesionangeo,
                                            ':severidadangio'=>$severidadangio,
                                            ':protesisendovascularangio'=>$endo,
                                            ':primerageneracionangio'=>$primergeneracion,
                                            ':segundageneracionangio'=>$segundageneracion,
                                            ':numeroprotesisangio'=>$ndp,
                                            ':revascularizacionangio'=>$tratamientovaso,
                                            ':procedimientoexitosoangio'=>$procedimientoexitoso,
                                            ':airbusangio'=>$airbus,
                                            ':resultadoairbusangio'=>$resultadoirbus,
                                            ':octangio'=>$oct,
                                            ':id_pacienteinfarto'=>$identi
                                        ));
                                    $sql = $conexionCancer->prepare("INSERT into litotriciaangio(id_litotriciaangio,schockwaveangio,resultadoairbuslito,id_pacienteinfarto)
                                    values(:id_litotriciaangio,:schockwaveangio,:resultadoairbuslito,:id_pacienteinfarto)");
                                        $sql->execute(array(
                                            ':id_litotriciaangio'=>uniqid('hraei'),
                                            ':schockwaveangio'=>$shockwavedato,
                                            ':resultadoairbuslito'=>$resultadoshockwavedato,
                                            ':id_pacienteinfarto'=>$identi
                                        ));
                                        $msmscomplicacion;
                                        if(is_array($mscomplicacion) || is_object($mscomplicacion)){       
                                            foreach($mscomplicacion as $complicacioninfarto) {
                                                $sql_s = $conexionCancer->prepare("INSERT into complicacionesinfarto(descripcioncomplicacion, id_pacienteinfarto) 
                                
                                                values(:descripcioncomplicacion, :id_pacienteinfarto)");
                            
                                                $sql_s->execute(array(
                                                    ':descripcioncomplicacion'=>$complicacioninfarto,
                                                    ':id_pacienteinfarto'=>$identi
                            
                                                ));
                                            }
                                        }
                                    $sql = $conexionCancer->prepare("INSERT into detallecomplicaciones(arritimia,bloqueoav,extrasistolesventri,id_pacienteinfarto)
                                        values(:arritimia,:bloqueoav,:extrasistolesventri,:id_pacienteinfarto)");
                                            $sql->execute(array(
                                                ':arritimia'=>$arritmiadetalle,
                                                ':bloqueoav'=>$bloqueoav,
                                                ':extrasistolesventri'=>$extraventri,
                                                ':id_pacienteinfarto'=>$identi
                                            ));
                                    $sql = $conexionCancer->prepare("INSERT into marcapasostratamiento(id_marcapasostrata,marcapasostratamiento,soporteventricular,id_pacienteinfarto)
                                        values(:id_marcapasostrata,:marcapasostratamiento,:soporteventricular,:id_pacienteinfarto)");
                                            $sql->execute(array(
                                                ':id_marcapasostrata'=>uniqid('hraei'),
                                                ':marcapasostratamiento'=>$marcapasossino,
                                                ':soporteventricular'=>$soporteven,
                                                ':id_pacienteinfarto'=>$identi
                                            ));
                                    $sql = $conexionCancer->prepare("INSERT into seguimientopostprocedimiento(id_seguimientopost,fechaegresopost,causadefuncionpost,fechadefuncionpost,id_pacienteinfarto)
                                        values(:id_seguimientopost,:fechaegresopost,:causadefuncionpost,:fechadefuncionpost,:id_pacienteinfarto)");
                                            $sql->execute(array(
                                                ':id_seguimientopost'=>uniqid('hraei'),
                                                ':fechaegresopost'=>$fechadeegreso,
                                                ':causadefuncionpost'=>$causadefuncion,
                                                ':fechadefuncionpost'=>$fechadefuncion,
                                                ':id_pacienteinfarto'=>$identi
                                            ));

					if($sql != false) {
					echo "<script>swal({
                                title: 'Good job!',
                                text: 'Datos guardados exitosamente!',
                                icon: 'success',
                                
                        });
                        </script>";	
                    
					}else {
                        
                        echo "<script>swal({
                                title: 'Fatal!',
                                text: 'Error al guardar informacion!',
                                icon: 'error',
                                });</script>";
                            
            

					}
	
	
				
				
				?>