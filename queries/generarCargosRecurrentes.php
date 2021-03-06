<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array ();
	$rules['fecha'] = ['t'=>'date', 'r'=>true];
	$_POST['fecha'] .= "-01";
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	$fecha = $_POST['fecha'];
	$mes_generado = date("m",strtotime($fecha));
	include "dbcon.php";
	include_once "getIdSede.php";
	//Lista de todas las clases que se impartieron en un mes en particular
	//CONSIDERAR POR MES y AÑO
    $cobroPorMes = select_query_one($con, "SELECT idForma FROM formacobranzadefault", '', []);
	$cobranzaMensual  = $cobroPorMes['idForma'];
	$clases = select_query($con,
	"   SELECT g.idGrupo as idClase, a.idDisciplina, g.nombreGrupo as Clase, g.precio FROM grupos as g
		LEFT JOIN asignaturas as a ON a.idAsignatura = g.idAsignatura
		LEFT JOIN disciplinas as d ON d.idDisciplina = a.idDisciplina
		WHERE g.idSede = ? AND
		 ((YEAR(?)>YEAR(g.fechaAlta) OR YEAR(?)=YEAR(g.fechaAlta)) AND
		 (YEAR(?)>YEAR(g.fechaAlta) OR MONTH(?)>=MONTH(g.fechaAlta)) AND
		 (g.fechaBaja IS NULL OR YEAR(?)<YEAR(g.fechaBaja) OR YEAR(?)=YEAR(g.fechaBaja)) AND
		 (g.fechaBaja IS NULL OR YEAR(?)<YEAR(g.fechaBaja) OR MONTH(?)<=MONTH(g.fechaBaja)))",
		 'issssssss', [$idSede, $fecha, $fecha, $fecha, $fecha, $fecha, $fecha, $fecha, $fecha]);
			  
		 //forma de calculo por clase
		 foreach($clases as $idClase=>$clase){
          	$formaCalculoDisciplina[$clase['idClase']] = select_query($con, "SELECT idCalculoPagos, veceshorasdias, cuota FROM forma_calculos_detalle WHERE idDisciplina = ? AND idEquipo IS NULL", 'i', [$clase['idDisciplina']]); 
			$clases[$idClase]['idFormaCalculoPago'] = $formaCalculoDisciplina[$clase['idClase']][0]['idCalculoPagos'];
			$clases[$idClase]['listaAlumnos'] = select_query($con, "SELECT idAlumno, idAlumnoGrupo FROM alumnos_grupos
			 WHERE idGrupo = ? AND ((YEAR(?)>YEAR(fechaAlta) OR YEAR(?)=YEAR(fechaAlta)) AND
	 		 (YEAR(?)>YEAR(fechaAlta) OR MONTH(?)>=MONTH(fechaAlta)) AND
	 		 (fechaBaja IS NULL OR YEAR(?)<YEAR(fechaBaja) OR YEAR(?)=YEAR(fechaBaja)) AND
	 		 (fechaBaja IS NULL OR YEAR(?)<YEAR(fechaBaja) OR MONTH(?)<=MONTH(fechaBaja)))",
				'issssssss', [$clase['idClase'], $fecha, $fecha, $fecha, $fecha, $fecha, $fecha, $fecha, $fecha]);
			
			$clases[$idClase]['horario'] = select_query($con, "SELECT h.dia, h.horaInicio, h.duracion FROM salon_grupo as sg
				LEFT JOIN horario as h ON h.idSalonGrupo = sg.idSalonGrupo WHERE sg.idGrupo = ? AND h.dia IS NOT NULL", 'i', [$clase['idClase']]);
			if(count($clases[$k]['listaAlumnos'])==0||count($clases[$k]['horario'])==0){
					unset($clases[$k]);
			}
		}

	$disciplinasActivas = select_query($con, "SELECT idDisciplina, nombreDisciplina as disciplina FROM disciplinas WHERE activo = '1'");
	foreach($disciplinasActivas as $disciplinas){
		$formaCalculoDisciplina[$disciplinas['idDisciplina']] = select_query($con, "SELECT idCalculoPagos, veceshorasdias, cuota FROM forma_calculos_detalle WHERE idDisciplina = ? AND idEquipo IS NULL", 'i', [$disciplinas['idDisciplina']]);
	}
	$equiposActivos = select_query($con, "SELECT idEquipo, nombreEquipo as equipo FROM equipos WHERE activo = '1' and idSede =?",'i',[$idSede]);
	foreach($equiposActivos as $equipo) {
		$formaCalculoEquipo[$equipo['idEquipo']] = select_query($con, "SELECT idCalculoPagos, cuota FROM forma_calculos_detalle WHERE idEquipo = ? AND idDisciplina IS NULL", 'i', [$equipo['idEquipo']]);
	} 
	$listaAlumnos = array();
		foreach($clases as $clase){
			$vecesClase = count($clase['horario']);
			$diasClase = array();
			$horasClase = 0;
			foreach($clase['horario'] as $horario){
				
					if(!in_array($horario['dia'], $diasClase)){
						$diasClase[] = $horario['dia'];
					}
					$horasClase += ($horario['duracion']*.5);
			}
			
			foreach($clase['listaAlumnos'] as $alumno){
					 //Checar que no se le haya cobrado a este alumno este grupo en este mes
					$equipoCobroAlumno[$alumno['idAlumno']] = select_query_one($con, "SELECT ae.idEquipo, fc.cuota, fc.idCalculoPagos FROM alumnos_equipos ae  LEFT JOIN forma_calculos_detalle fc  ON ae.idEquipo = fc.idEquipo WHERE idAlumno = ? AND usarCobro = '1'",'i',[$alumno['idAlumno']]); 			
					$modoCobroAlumno[$alumno['idAlumno']] = select_query_one($con, "SELECT idCalculoPagos FROM forma_calculos_detalle WHERE idDisciplina = ? AND idEquipo IS NULL",'i',[$clase['idDisciplina']]); 			
					$formaCalculoDefault[$alumno['idAlumno']] = $modoCobroAlumno[$alumno['idAlumno']]['idCalculoPagos'];
					$formaDeCalculo[$alumno['idAlumno']] = $equipoCobroAlumno[$alumno['idAlumno']]['idCalculoPagos'];
					$cuotaEquipo[$alumno['idAlumno']] = $equipoCobroAlumno[$alumno['idAlumno']]['cuota'];
					if($cobranzaMensual =='2'){
					$cobrado = select_query_one($con, "SELECT COUNT(rpl.idReciboPagoLista) as cobrado FROM recibo_pago_lista as rpl
					LEFT JOIN alumnos_grupos as ag ON ag.idAlumnoGrupo = rpl.idAlumnoGrupo
					WHERE ag.idGrupo = ? AND ag.idAlumno = ? AND YEAR(rpl.fecha) = YEAR(?) AND MONTH(rpl.fecha) = MONTH(?)", 'iiss', [$clase['idClase'], $alumno['idAlumno'], $fecha, $fecha]);
					}else{
					$cobrado = select_query_one($con, "SELECT COUNT(idReciboPagoLista) as cobrado FROM recibo_pago_lista 
					WHERE idAlumno = ? AND YEAR(fecha) = YEAR(?) AND MONTH(fecha) = MONTH(?)", 'iss', [$alumno['idAlumno'], $fecha, $fecha]);
					}
					if($cobrado['cobrado']!==0){
						continue;
					}
						if(!isset($listaAlumnos[$alumno['idAlumno']])){
							$listaAlumnos[$alumno['idAlumno']]  = [];
						}
						if(!isset($listaAlumnos[$alumno['idAlumno']][$clase['idClase']])){
								$listaAlumnos[$alumno['idAlumno']][$clase['idClase']] = [];
						}
					$listaAlumnos[$alumno['idAlumno']][$clase['idClase']]['idAlumno'] = $alumno['idAlumno'];
					$listaAlumnos[$alumno['idAlumno']][$clase['idClase']]['idClase'] = 	$clase['idClase'];
					$listaAlumnos[$alumno['idAlumno']][$clase['idClase']]['idAlumnoGrupo'] = 	$alumno['idAlumnoGrupo'];
					$listaAlumnos[$alumno['idAlumno']][$clase['idClase']]['precioMensual'] = 	$clase['precio'];
					$listaAlumnos[$alumno['idAlumno']][$clase['idClase']]['veces'] = 		$vecesClase;
					$listaAlumnos[$alumno['idAlumno']][$clase['idClase']]['horas'] = 		$horasClase;
					$listaAlumnos[$alumno['idAlumno']][$clase['idClase']]['dias']  = 		count($diasClase);
					$listaAlumnos[$alumno['idAlumno']][$clase['idClase']]['idDisciplina'] = $clase['idDisciplina'];
					$listaAlumnos[$alumno['idAlumno']][$clase['idClase']]['idEquipo'] = $equipoCobroAlumno[$alumno['idAlumno']]['idEquipo'];
					$listaAlumnos[$alumno['idAlumno']][$clase['idClase']]['cuotaEquipo']  = $cuotaEquipo[$alumno['idAlumno']]?:'0.00';
					$listaAlumnos[$alumno['idAlumno']][$clase['idClase']]['idCalculoPagos'] = $clase['idFormaCalculoPago']?:$formaCalculoDefault[$alumno['idAlumno']];
				}
		}
if($listaAlumnos !=NULL){ //si hay alumnos a quienes cobrar
		$listaConceptosAlumno = array();
		$listaDisciplinas = array();
		$listaDisciplinasClases = array();
		foreach($listaAlumnos as $idAlumno => $infoAlumno){
			if(@!in_array($infoAlumno['idDisciplina'],$listaDisciplinas)){
				$listaDisciplinas[] = $infoAlumno['idDisciplina'];	
			}
				foreach($infoAlumno as $infoo){
					if($infoo['cuotaEquipo']!=0.00){
						$equipoCobradoAlumno = select_query_one($con,"SELECT detallesCobro FROM recibo_pago_lista where idAlumno =? and MONTH(fecha) like MONTH(?)","is",[$idAlumno,$fecha]);
						$dataEquipoAlumno = json_decode($equipoCobradoAlumno['detallesCobro'],true);
						if($dataEquipoAlumno['cuota']==0.00){		
						$alumnos_equipos[$infoo['idAlumno']]=$infoo['idAlumno'];
					}
				} else{
					$alumnos_SinEquipo[$infoo['idAlumno']]=$infoo['idAlumno'];
				}	
			}
		}
			foreach($clases as $cla){
				foreach($listaAlumnos as $idAlumno => $conceptosAl){
					if(@in_array($conceptosAl[$cla['idClase']]['idAlumno'],$alumnos_equipos)){
				            $listaConceptosAlumno[$conceptosAl[$cla['idClase']]['idAlumno']]= ['idAlumno'=>$idAlumno,'fecha'=>$fecha,
							'precioActual'=>$conceptosAl[$cla['idClase']]['cuotaEquipo']?:'0.00', 'detallesCobro'=>json_encode($equipoCobroAlumno[$idAlumno]), 'infoCobros'=>json_encode($equipoCobroAlumno[$idAlumno])];
					} else {
					if($cobranzaMensual=='2'){
						$idCalculoPago = '2';
					}else{
						$idCalculoPago = $conceptosAl[$cla['idClase']]['idCalculoPagos'];
					}
					switch($idCalculoPago){
						case 1:
						//cuota fija mensual
						$listaDisciplinas = array();
						foreach($conceptosAl as $list){
							if($list['idCalculoPagos']==$cla['idFormaCalculoPago']){
								if(@!in_array($list['idDisciplina'],$listaDisciplinas)){
									$listaDisciplinas[] = $list['idDisciplina'];
								}
						 	}
						}
						foreach($listaDisciplinas as $disciplina){
							$diaPago = select_query_one($con, "SELECT cuota FROM forma_calculos_detalle  WHERE idCalculoPagos = ? AND idDisciplina = ? and idEquipo IS NULL",'ii',[$conceptosAl[$cla['idClase']]['idCalculoPagos'],$disciplina]); 
							$costo = $diaPago['cuota'];
							$listaConceptosAlumnoSinEquipo[$conceptosAl[$cla['idClase']]['idAlumno']][$disciplina]= ['idAlumno'=>$idAlumno,'fecha'=>$fecha, 'precioActual'=>$costo?:'0.00', 'detallesCobro'=>json_encode(['idAlumno'=>$idAlumno,'idEquipo'=>null]), 'infoCobros'=>json_encode(['idAlumno'=>$idAlumno,'idDisciplina'=>$disciplina,'idCalculoPagoUsado'=>$idCalculoPago])];
						}
						break;
						case 2:
						//por clase
						if($conceptosAl[$cla['idClase']]['idAlumno']!=""){
						@array_push($conceptosAl[$cla['idClase']]['idCalculoPagoUsado']=$idCalculoPago);	
						$listaConceptosAlumnoSinEquipo[$conceptosAl[$cla['idClase']]['idAlumno']][$cla['idClase']]= ['idAlumno'=>$idAlumno,'fecha'=>$fecha, 'idAlumnoGrupo'=>$conceptosAl[$cla['idClase']]['idAlumnoGrupo'],
							'precioActual'=>$conceptosAl[$cla['idClase']]['precioMensual']?:'0.00', 'detallesCobro'=>json_encode([$conceptosAl[$cla['idClase']]]), 'infoCobros'=>json_encode($conceptosAl[$cla['idClase']])];
						}
						break;
						case 3:
						//por dias
						$listaDisciplinasPorDias = array();
						foreach($conceptosAl as $list){
							if($list['idCalculoPagos']==$cla['idFormaCalculoPago']){
								if(@!in_array($list['idDisciplina'],$listaDisciplinasPorDias)){
									$listaDisciplinasPorDias[] = $list['idDisciplina'];
								}
							 }
						}
						@array_push($conceptosAl[$cla['idClase']]['idCalculoPagoUsado']=$idCalculoPago);
						$listaConceptosAlumnoSinEquipo[$conceptosAl[$cla['idClase']]['idAlumno']][$cla['idClase']]= ['idAlumno'=>$idAlumno,'fecha'=>$fecha, 'idAlumnoGrupo'=>$conceptosAl[$cla['idClase']]['idAlumnoGrupo'],
						'precioActual'=>0, 'detallesCobro'=>json_encode($conceptosAl[$cla['idClase']]), 'infoCobros'=>json_encode($conceptosAl[$cla['idClase']])];

						foreach($listaDisciplinasPorDias as $disciplina){
							$diaPago = select_query($con, "SELECT veceshorasdias as dias, cuota FROM forma_calculos_detalle  WHERE idCalculoPagos = ? AND idDisciplina = ? and idEquipo IS NULL",'ii',[3,$disciplina]); 			 
							$dias = 0;
							foreach($conceptosAl as $list){
							   if($list['idCalculoPagos']==3){
							   $dias += $list['dias'];
							   }
							}
							foreach($diaPago as $pagos){
								if(($dias!=0)){
										if(in_array($dias,$pagos)){
										$costo = $pagos['cuota'];
										}
									} else {$costo = 0.00;}
							}
						$listaConceptosAlumnoSinEquipo[$conceptosAl[$cla['idClase']]['idAlumno']][$conceptosAl['idDisciplina']]= ['idAlumno'=>$idAlumno,'fecha'=>$fecha,'precioActual'=>$costo?:0, 'detallesCobro'=>json_encode(['idAlumno'=>$idAlumno,'idEquipo'=>null,'dias'=>$dias]),
						'infoCobros'=>json_encode(['idAlumno'=>$idAlumno,'idDisciplina'=>$disciplina,'idCalculoPagoUsado'=>$idCalculoPago])];
						}	
						break;
						case 4:
						//por veces a la semana
						$listaDisciplinasPorVeces = array();
						foreach($conceptosAl as $list){
							if($list['idCalculoPagos']==$cla['idFormaCalculoPago']){
								if(@!in_array($list['idDisciplina'],$listaDisciplinasPorVeces)){
									$listaDisciplinasPorVeces[] = $list['idDisciplina'];
								}
							 }
						}
						@array_push($conceptosAl[$cla['idClase']]['idCalculoPagoUsado']=$idCalculoPago);
						$listaConceptosAlumnoSinEquipo[$conceptosAl[$cla['idClase']]['idAlumno']][$cla['idClase']]= ['idAlumno'=>$idAlumno,'fecha'=>$fecha, 'idAlumnoGrupo'=>$conceptosAl[$cla['idClase']]['idAlumnoGrupo'],
						'precioActual'=>0, 'detallesCobro'=>json_encode($conceptosAl[$cla['idClase']]), 'infoCobros'=>json_encode($conceptosAl[$cla['idClase']])];

						foreach($listaDisciplinasPorVeces as $disciplina){
							$diaPago = select_query($con, "SELECT veceshorasdias as dias, cuota FROM forma_calculos_detalle  WHERE idCalculoPagos = ? AND idDisciplina = ? and idEquipo IS NULL",'ii',[4,$disciplina]); 			 
							$veces = 0;
							foreach($conceptosAl as $list){
							   if($list['idCalculoPagos']==4){
							   $veces += $list['veces'];
							   }
							}
							foreach($diaPago as $pagos){
								if(($veces!=0)){
										if(in_array($veces,$pagos)){
											$costo = $pagos['cuota'];
										}
									} else {$costo = 0.00;}
							}
						$listaConceptosAlumnoSinEquipo[$conceptosAl[$cla['idClase']]['idAlumno']][$conceptosAl['idDisciplina']]= ['idAlumno'=>$idAlumno,'fecha'=>$fecha,'precioActual'=>$costo?:0, 'detallesCobro'=>json_encode(['idAlumno'=>$idAlumno,'idEquipo'=>null,'veces'=>$veces]),
						'infoCobros'=>json_encode(['idAlumno'=>$idAlumno,'idDisciplina'=>$disciplina,'idCalculoPagoUsado'=>$idCalculoPago])];
						}
						break;
						case 5:
						//por horas a la semana
						$listaDisciplinasPorHoras = array();
						foreach($conceptosAl as $list){
							if($list['idCalculoPagos']==$cla['idFormaCalculoPago']){
								if(@!in_array($list['idDisciplina'],$listaDisciplinasPorHoras)){
									$listaDisciplinasPorHoras[] = $list['idDisciplina'];
								}
							 }
						}
						@array_push($conceptosAl[$cla['idClase']]['idCalculoPagoUsado']=$idCalculoPago);
						$listaConceptosAlumnoSinEquipo[$conceptosAl[$cla['idClase']]['idAlumno']][$cla['idClase']]= ['idAlumno'=>$idAlumno,'fecha'=>$fecha, 'idAlumnoGrupo'=>$conceptosAl[$cla['idClase']]['idAlumnoGrupo'],
						'precioActual'=>0, 'detallesCobro'=>json_encode($conceptosAl[$cla['idClase']]), 'infoCobros'=>json_encode($conceptosAl[$cla['idClase']])];

						foreach($listaDisciplinasPorHoras as $disciplina){
							$diaPago = select_query($con, "SELECT veceshorasdias as dias, cuota FROM forma_calculos_detalle  WHERE idCalculoPagos = ? AND idDisciplina = ? and idEquipo IS NULL",'ii',[5,$disciplina]); 			 
							$horasClase = 0;
							foreach($conceptosAl as $list){
							   if($list['idCalculoPagos']==5){
							   $horasClase += $list['horas'];
							   }
							}
							$horas = $horasClase;
							$mediasHoras = explode(".",$horas);
							if($mediasHoras[1]==5){$numeroHorasClase=$mediasHoras[0];}else{$numeroHorasClase=$horas;}
							foreach($diaPago as $pagos){
								if(($numeroHorasClase!=0)){
										if(in_array($numeroHorasClase,$pagos)){
											$costo = $pagos['cuota'];
										}
									} else {$costo = 0.00;}
							}
						$listaConceptosAlumnoSinEquipo[$conceptosAl[$cla['idClase']]['idAlumno']][$idAlumno]= ['idAlumno'=>$idAlumno,'fecha'=>$fecha,'precioActual'=>$costo?:0, 'detallesCobro'=>json_encode(['idAlumno'=>$idAlumno,'idEquipo'=>null,'horas'=>$horasClase]),
						'infoCobros'=>json_encode(['idAlumno'=>$idAlumno,'idDisciplina'=>$disciplina,'idCalculoPagoUsado'=>$idCalculoPago])];
						}
						break;
					   }
					}
				}
			}
		$listaClientes = array();
		foreach($listaConceptosAlumno as $idAlumno => $listaConceptos){
			$idCliente = select_query_one($con, "SELECT idTutor FROM alumnos WHERE idAlumno = ?", 'i', [$idAlumno]);
			$idCliente = $idCliente['idTutor'];
			if(!isset($listaClientes[$idCliente])){
					$listaClientes[$idCliente] = array();
					
			}
			foreach ($listaConceptosAlumno as $al => $concepto) {
				$listaClientes[$idCliente][$idAlumno] = $listaConceptosAlumno[$idAlumno];
			}
		}
		foreach($listaConceptosAlumnoSinEquipo as $idAlumno => $listaConceptos){
				$idCliente = select_query_one($con, "SELECT idTutor FROM alumnos WHERE idAlumno = ?", 'i', [$idAlumno]);
				$idCliente = $idCliente['idTutor'];
				if(!isset($listaClientes2[$idCliente])){
						$listaClientes2[$idCliente] = array();		
				}
				if(@in_array($idAlumno,$alumnos_SinEquipo)){
				foreach ($listaConceptosAlumnoSinEquipo as $al => $concepto) {
					$listaClientes2[$idCliente][$idAlumno] = $listaConceptosAlumnoSinEquipo[$idAlumno];
					}
				}
			}
//print_r($listaClientes2); exit;				
if($alumnos_equipos !=NULL){
		foreach($listaClientes as $idCliente => $listaConceptos){
			$idCC = select_query_one($con, "SELECT idReciboPago FROM recibo_pago WHERE idCliente = ? AND folio IS NULL AND idSede = ? ORDER BY idReciboPago DESC LIMIT 1", 'ii', [$idCliente, $idSede]);
			if($idCC===false){ //Crear una CC si no hay alguna ya abierta y sin aprobar
				$idCC = insert_id_query($con, "INSERT INTO recibo_pago (idCliente, idSede, fecha) VALUES (?,?,?)", 'iis', [$idCliente, $idSede, date("Y-m-d")]);
			}else{ //Utilizar una CC abierta y sin aprobar si existe
				$idCC = $idCC['idReciboPago'];
			}
			$a[$idCliente] = $idCC;
			foreach($listaConceptos as $idAlumno => $concepto){ //Insertar conceptos a CC
				if(isset($concepto['idAlumno'])){ //echo "HAY ALUMNO";
					if(!isset($concepto['detallesCobro'])){
						$concepto['detallesCobro'] = "";
					}
					$query = "INSERT INTO recibo_pago_lista (idReciboPago, idAlumno, fecha, precioActual, detallesCobro, infoCobros) VALUES (?,?,?,?,?,?)";
					$paramText = "iisdss";
					$paramArray = [$a[$idCliente], $concepto['idAlumno'], $concepto['fecha'], $concepto['precioActual'], $concepto['detallesCobro'], $concepto['infoCobros']];
				}
				else if (isset($concepto['idAlumnoGrupo'])){ //echo "HAY ALUMNO GRUPO";
					$query = "INSERT INTO recibo_pago_lista (idReciboPago, idAlumnoGrupo, fecha, precioActual, detallesCobro, infoCobros) VALUES (?,?,?,?,?,?)";
					$paramText = "iisdss";
					$paramArray = [$a[$idCliente], $concepto['idAlumnoGrupo'], $concepto['fecha'], $concepto['precioActual'], $concepto['detallesCobro'], $concepto['infoCobros']];
				}else{//echo "NO HAY ALUMNO, NO HAY GRUPO";
					$query = "INSERT INTO recibo_pago_lista (idReciboPago, fecha, precioActual, detallesCobro, infoCobros) VALUES (?,?,?,?,?)";
					$paramText = "isdss";
					$paramArray = [$a[$idCliente], $concepto['fecha'], $concepto['precioActual'], $concepto['detallesCobro'], $concepto['infoCobros']];
				}
				execute_query($con, $query, $paramText, $paramArray, false) or die ("e|Generar Cobranza Mensual|Ha habido un error al generar la cobranza mensual.");
		}
	}
}

		 foreach($listaClientes2 as $idCliente2 => $listaConceptos){
		 	$idCC = select_query_one($con, "SELECT idReciboPago FROM recibo_pago WHERE idCliente = ? AND folio IS NULL AND idSede = ? ORDER BY idReciboPago DESC LIMIT 1", 'ii', [$idCliente2, $idSede]);
		 	if($idCC===false){ //Crear una CC si no hay alguna ya abierta y sin aprobar
		 		$idCC = insert_id_query($con, "INSERT INTO recibo_pago (idCliente, idSede, fecha) VALUES (?,?,?)", 'iis', [$idCliente2, $idSede, date("Y-m-d")]);
		 	}else{ //Utilizar una CC abierta y sin aprobar si existe
		 		$idCC = $idCC['idReciboPago'];
		 	}
			 $b[$idCliente2] = $idCC;
			 foreach($listaConceptos as $idAlumno => $clasesAlumno){ //Insertar conceptos a CC		
						foreach($clasesAlumno as $idClaseAlumno => $concepto)
						{
							if(isset($concepto['idAlumno']))
		 					{ 
		 						if(!isset($concepto['detallesCobro'])){
		 							$concepto['detallesCobro'] = "";
		 						}
		 						$query = "INSERT INTO recibo_pago_lista (idReciboPago, idAlumno, idAlumnoGrupo, fecha, precioActual, detallesCobro, infoCobros) VALUES (?,?,?,?,?,?,?)";
		 						$paramText = "iiisdss";
		 						$paramArray = [$b[$idCliente2], $concepto['idAlumno'],$concepto['idAlumnoGrupo'], $concepto['fecha'], $concepto['precioActual'], $concepto['detallesCobro'], $concepto['infoCobros']];
		 					}else if (isset($concepto['idAlumnoGrupo'])){
		 						$query = "INSERT INTO recibo_pago_lista (idReciboPago, idAlumno, idAlumnoGrupo, fecha, precioActual, detallesCobro, infoCobros) VALUES (?,?,?,?,?,?,?)";
		 						$paramText = "iiisdss";
		 						$paramArray = [$b[$idCliente2], $concepto['idAlumno'], $concepto['idAlumnoGrupo'], $concepto['fecha'], $concepto['precioActual'], $concepto['detallesCobro'], $concepto['infoCobros']];
		 					}else{
								$query = "INSERT INTO recibo_pago_lista (idReciboPago, fecha, precioActual, detallesCobro, infoCobros) VALUES (?,?,?,?,?)";
								$paramText = "isdss";
		 						$paramArray = [$b[$idCliente2], $concepto['fecha'], $concepto['precioActual'], $concepto['detallesCobro'], $concepto['infoCobros']];
							 }
							 execute_query($con, $query, $paramText, $paramArray, false) or die ("e|Generar Cobranza Mensual|Ha habido un error al generar la cobranza mensual.");
						}	
			 		}
		}
		$resMes = buscaMes($mes_generado);
		execute_query($con, "INSERT INTO logs_cobranza (fecha,mes_generado) VALUES (?,?)", 'ss', [date("Y-m-d H:i:s"),$resMes]);
		echo "s|Generar Cobranza Mensual|Se ha generado la cobranza mensual correctamente.";
	  mysqli_commit($con);
	} else{
		echo "s|Generar Cobranza Mensual|Ya se ha cobrado o no hay alumnos en este mes";
	}

function buscaMes($mensualidad){
	switch($mensualidad){
		case '01': $mes_g = "ENERO";
		return $mes_g;
		break;
		case '02': $mes_g = "FEBRERO";
		return $mes_g;
		break;
		case '03': $mes_g = "MARZO";
		return $mes_g;
		break;
		case '04': $mes_g = "ABRIL";
		return $mes_g;
		break;
		case '05': $mes_g = "MAYO";
		return $mes_g;
		break;
		case '06': $mes_g = "JUNIO";
		return $mes_g;
		break;
		case '07': $mes_g = "JULIO";
		return $mes_g;
		break;
		case '08': $mes_g = "AGOSTO";
		return $mes_g;
		break;
		case '09': $mes_g = "SEPTIEMBRE";
		return $mes_g;
		break;
		case '10': $mes_g = "OCTUBRE";
		return $mes_g;
		break;
		case '11': $mes_g = "NOVIEMBRE";
		return $mes_g;
		break;
		case '12': $mes_g = "DICIEMBRE";
		return $mes_g;
		break;
	}
}
?>

