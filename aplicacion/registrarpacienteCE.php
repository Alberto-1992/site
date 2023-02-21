<?php
include("../conexionCancer.php");
date_default_timezone_set('America/Mexico_City');
$hoy = date("d-m-Y");
    extract($_POST);
		
	//buscamos el email	
//	$sql_busqueda = $conexion2->query("SELECT email from usuarios where email = '".$email."'");

	// SI EL EMAIL NO EXISTE, REGISTRAMOS LOS DATOS EN LA TABLA USUARIO

    
	$sql = $conexionCancer->prepare("INSERT into dato_usuario(curp, nombrecompleto, poblacionindigena, escolaridad, fechanacimiento, edad, sexo, raza, estado, municipio,  year) 
    
                                    values (:curp, :nombrecompleto, :poblacionindigena, :escolaridad, :fechanacimiento, :edad, :sexo, :raza, :estado, :municipio, :year)");
                    
                    $sql->bindParam(':curp', $curp, PDO::PARAM_STR, 25);
                    $sql->bindParam(':nombrecompleto',$nombrecompleto, PDO::PARAM_STR, 100);
                    $sql->bindParam(':poblacionindigena',$poblacionindigena, PDO::PARAM_STR, 100);
                    $sql->bindParam(':escolaridad',$escolaridad, PDO::PARAM_STR, 100);
                    $sql->bindParam(':fechanacimiento',$fecha, PDO::PARAM_STR); 
                    $sql->bindParam(':edad',$edad, PDO::PARAM_INT); 
                    $sql->bindParam(':sexo',$sexo, PDO::PARAM_STR, 10); 
                    $sql->bindParam(':raza',$raza, PDO::PARAM_STR, 100); 
                    $sql->bindParam(':estado',$cbx_estado, PDO::PARAM_INT); 
                    $sql->bindParam(':municipio',$cbx_municipio, PDO::PARAM_INT); 
                    $sql->bindParam(':year',$hoy, PDO::PARAM_STR);
                            $sql->execute(); 
            $query = $conexion2->query("SELECT id from dato_usuario where curp = '".$curp."'");
                    $rows = mysqli_fetch_assoc($query);

                    $id_carga = $rows['id'];
                $query2 = $conexionCancer->prepare("INSERT into tratamiento(killipkimball, fevi, choquecardiogenico, revascularizacionprevia, localizacion, caracteristicasdolor, 
                iniciosintomas, primercontacto, puertabalon, trombolisis, fechainiciotrombolisis, fechaterminotrombolisis, tipofibrinolitico, tiempoisquemiatotal, revascularizacion, 
                diseccion, iam_periprocedimiento, complicaciones, flujo_microvascular_tmp, flujo_final_tfj, trombosis_definitiva, marcapasos_temporal, estancia_hospitalaria, reestenosis_instrastent, 
                reehospitalizacion_one_year, escalas_riesgo, iam_tres_years, cruc_tres_years, defuncion, causadefuncion, id_paciente, identificador, 
                peso, talla, imc, electroconcambios, seguimiento)
                                    values(:killipkimball, 
                                    :fevi,
                                    :choquecardiogenico,
                                    :revascularizacionprevia,
                                    :localizacion, 
                                    :caracteristicasdolor,
                                    :iniciosintomas, 
                                    :primercontacto, 
                                    :puertabalon, 
                                    :trombolisis, 
                                    :fechainiciotrombolisis, 
                                    :fechaterminotrombolisis, 
                                    :tipofibrinolitico,
                                    :tiempoisquemiatotal,
                                    :revascularizacion,
                                    :diseccion,
                                    :iam_periprocedimiento,
                                    :complicaciones,
                                    :flujo_microvascular_tmp,
                                    :flujo_final_tfj,
                                    :trombosis_definitiva,
                                    :marcapasos_temporal,
                                    :estancia_hospitalaria,
                                    :reestenosis_instrastent,
                                    :reehospitalizacion_one_year,
                                    :escalas_riesgo,
                                    :iam_tres_years,
                                    :cruc_tres_years, 
                                    :defuncion,
                                    :causadefuncion, 
                                    :id_paciente, 
                                    :identificador, 
                                    :peso, 
                                    :talla, :imc, :electroconcambios, 'inicial')");
                        $query2->execute(array(
                            ':killipkimball'=>$killip,
                            ':fevi'=>$fevi,
                            ':choquecardiogenico'=>$choque,
                            ':revascularizacionprevia'=>$revascularizacionprevia,
                            ':localizacion'=>$localizacion,
                            ':caracteristicasdolor'=>$caractipicasatipicas,
                            ':iniciosintomas'=>$iniciotrombolisis,
                            ':primercontacto'=>$primercontacto,
                            ':puertabalon'=>$puertabalon,
                            ':trombolisis'=>$trombolisis,
                            ':fechainiciotrombolisis'=>$iniciotrombolisis,
                            ':fechaterminotrombolisis'=>$finalizotrombolisis,
                            ':tipofibrinolitico'=>$fibrinoliticos,
                            ':tiempoisquemiatotal'=>$tiempoisquemia,
                            ':revascularizacion'=>$revascularizacion,
                            ':diseccion'=>$diseccion,
                            ':iam_periprocedimiento'=>$iamperiprocedimiento,
                            ':complicaciones'=>$complicaciones,
                            ':flujo_microvascular_tmp'=>$flujomicrovasculartmp,
                            ':flujo_final_tfj'=>$flujofinaltfg,
                            ':trombosis_definitiva'=>$trombosisdefinitiva,
                            ':marcapasos_temporal'=>$marcapasostemporal,
                            ':estancia_hospitalaria'=>$estanciahospitalaria,
                            ':reestenosis_instrastent'=>$reesentosis,
                            ':reehospitalizacion_one_year'=>$rehospitalizacion,
                            ':escalas_riesgo'=>$escaladeriesgo,
                            ':iam_tres_years'=>$iamtresyears,
                            ':cruc_tres_years'=>$cruc,
                            ':defuncion'=>$defuncion,
                            ':causadefuncion'=>$causadefuncion,
                            ':id_paciente'=>$id_carga,
                            ':identificador'=> $identificador,
                            ':peso'=>$peso,
                            ':talla'=>$talla, 
                            ':imc'=>$imc, 
                            ':electroconcambios'=>$electrocardio
                            ));

                    $sql_s = $conexionCancer->prepare("INSERT into paraclinicos(
                        ck, 
                        ckmb, 
                        troponinas, 
                        glucosa, 
                        urea, 
                        creatinina, 
                        colesterol, 
                        trigliceridos, 
                        acidourico, 
                        hbglucosilada, 
                        proteinas, 
                        colesteroltotal, 
                        ldl, 
                        hdl, 
                        id_paciente)
                                    values(
                                        :ck,
                                        :ckmb,
                                        :troponinas,
                                        :glucosa,
                                        :urea,
                                        :creatinina,
                                        :colesterol,
                                        :trigliceridos,
                                        :acidourico,
                                        :hbglucosilada,
                                        :proteinas,
                                        :colesteroltotal,
                                        :ldl,
                                        :hdl,
                                        :id_paciente)");     
                        $sql_s->execute(array(
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
                            ':colesteroltotal'=>$colesterol, 
                            ':ldl'=>$ldl, 
                            ':hdl'=>$hdl, 
                            ':id_paciente'=>$id_carga


                        ));
                        
                        
                        $checked_contador = count($check_lista);
                //echo "<p>Has seleccionado los siguientes ".$checked_contador." opcione(s):</p> <br/>";
                // Bucle para almacenar y visualizar valores activados checkbox.
                foreach($check_lista as $seleccion) {
                    $sql = $conexionCancer->prepare("INSERT into factores_riesgo(nombrefactor, id_paciente) 
    
                    values ('".$seleccion."', '".$id_carga."')");

                    $sql->execute(array(
                        ':nombrefactor'=>$seleccion,
                        ':id_paciente'=>$id_carga

                    ));
                }
                $checked_contador2 = count($check_lista2);
                //echo "<p>Has seleccionado los siguientes ".$checked_contador." opcione(s):</p> <br/>";
                // Bucle para almacenar y visualizar valores activados checkbox.
                foreach($check_lista2 as $seleccion2) {
                    $sql = $conexionCancer->prepare("INSERT into caracteristicasdolortipicas(descripcioncaracteristica, id_paciente) 
    
                    values ('".$seleccion2."', '".$id_carga."')");

                    $sql->execute(array(
                        ':descripcioncaracteristica'=>$seleccion2, 
                        ':id_paciente'=>$id_carga
                    ));
                }
                $checked_contador3 = count($check_lista3);
                //echo "<p>Has seleccionado los siguientes ".$checked_contador." opcione(s):</p> <br/>";
                // Bucle para almacenar y visualizar valores activados checkbox.
                foreach($check_lista3 as $seleccion3) {
                    $sql = $conexionCancer->prepare("INSERT into caracteristicasdoloratipicas(descripcioncaracteristica, id_paciente) 
    
                    values ('".$seleccion3."', '".$id_carga."')");
                        $sql->execute(array(
                            ':descripcioncaracteristica'=>$seleccion3, 
                            ':id_paciente'=>$id_carga
                        ));

                }
                $checked_contador4 = count($check_lista4);
                //echo "<p>Has seleccionado los siguientes ".$checked_contador." opcione(s):</p> <br/>";
                // Bucle para almacenar y visualizar valores activados checkbox.
                foreach($check_lista4 as $seleccion4) {
                    $sql = $conexionCancer->prepare("INSERT into electrocardiograma(derivacionesafectadas, id_paciente) 
    
                    values ('".$seleccion4."', '".$id_carga."')");
                        $sql->execute(array(
                            ':derivacionesafectadas'=>$seleccion4, 
                            ':id_paciente'=>$id_carga

                        ));
                }
                /*              
                $query3 = $conexion2->query("INSERT into tratamiento(id_paciente, id_medicamento, indicacion)
                                    values('".$id."', '".$medicamento."', '".$tratamiento."')");
	                    if($refe != ''){
                $query4 = $conexion2->query("INSERT into referecnias(id_paciente, datosreferencia) 
                                    values('".$id."', '".$refe."')");
	                    }else{
	                        
	                    };*/												    										 
	//MENSAJE DE CONFIRMACIÓN												 
					if($query2 != false) {
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
                            
                            $sql1 = $conexion2->query("DELETE from factores_riesgo where id_paciente = '$id_carga'");
                            $sql2 = $conexion2->query("DELETE from caracteristicasdolortipicas where id_paciente = '$id_carga'");
                            $sql0 = $conexion2->query("DELETE from dato_personal where id = '$id_carga'");
                        $conexion2->close();

					    }
	
	
				
				
				?>