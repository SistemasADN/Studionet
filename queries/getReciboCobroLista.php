<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array ();

//		$_POST['idReciboPago'] = 24;
    $rules['idReciboPago'] = ["r"=>true, "t"=>"num"];
		//$_POST['idReciboPago'] = 39;
		//deleteDebuggingInfo();
		//getDebuggingInfo();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
    include_once "dbcon.php";
    $respuesta = select_query($con, "
                  SELECT
                    rpl.idReciboPago,
                    rpl.idReciboPagoLista,
                    rpl.cantidad AS cantidad,
										rpl.idConcepto,
										rpl.idAlumno,
                    con.nombreConcepto,
										rpl.precioActual AS precio,
                    rpl.descuento AS descuentoLista,
                    DATE_FORMAT(rpl.fecha, '%Y-%m') as fecha,
                    rpl.detallesCobro,
										rpl.infoCobros,
                    rpl.idAlumnoGrupo
                  FROM recibo_pago_lista AS rpl
                  LEFT JOIN conceptos AS con ON rpl.idConcepto = con.idConcepto
                  WHERE rpl.idReciboPago = ?
					", 'i', $_POST);				
    foreach($respuesta as $k=>$v){
        $detallesCobro = json_decode($v['detallesCobro'], true);
				$infoCobros = json_decode($v['infoCobros'], true);
				if($v['idAlumno']!=null){
					$nombre = select_query_one($con, "SELECT pc.nombre FROM alumnos as a LEFT JOIN personacompleta as pc ON pc.idPersona = a.idPersona WHERE a.idAlumno = ?", 'i', [$v['idAlumno']]);
				}else if($v['idAlumnoGrupo']!=null){
					$nombre = select_query_one($con, "SELECT pc.nombre FROM alumnos_grupos as ag LEFT JOIN alumnos as a ON a.idAlumno = ag.idAlumno LEFT JOIN personacompleta as pc ON pc.idPersona = a.idPersona WHERE ag.idAlumnoGrupo = ?", 'i', [$v['idAlumnoGrupo']]);
				}else{
					$nombre = "N/A";
				}
				$respuesta[$k]['alumno'] = $nombre['nombre'];
				if($v['nombreConcepto']===null){
					$texto = "";
					if($detallesCobro['cuotaEquipo']!="0.00"){$texto = "Cuota Equipo";}else{
					switch($infoCobros['idCalculoPagos']){
						case 1: //Cuota Fija Mensual Por Disciplina
							$texto = "";
							$disciplina = select_query_one($con, "SELECT nombreDisciplina FROM disciplinas WHERE idDisciplina = ?", 'i', [$detallesCobro['idDisciplina']]);
							$texto = "Disciplina: ".$disciplina['nombreDisciplina'];
						break;
						case 2: //Cuota Mensual Por Clase
							$grupo = select_query_one($con, "SELECT nombreGrupo FROM grupos WHERE idGrupo = ?", 'i', [$detallesCobro['idGrupo']]);
							$texto = $grupo['nombreGrupo'];
						break;
						case 3: //Cuota Por Días
							$texto = "";
							$dias = ['Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab', 'Dom'];
							if(isset($detallesCobro['idClase'])){
								$grupo = select_query_one($con, "SELECT nombreGrupo FROM grupos WHERE idGrupo = ?", 'i', [$detallesCobro['idClase']]);
								$listaDias = $detallesCobro['dias'];
								$texto = $grupo['nombreGrupo']." ($listaDias dias)";
							}
						break;
						case 4: //Cuota Por Veces A La Semana Por Disciplina
							$texto = "";
							$disciplina = select_query_one($con, "SELECT nombreDisciplina FROM disciplinas WHERE idDisciplina = ?", 'i', [$detallesCobro['idDisciplina']]);
							if(isset($detallesCobro['idGrupo'])){
								$grupo = select_query_one($con, "SELECT nombreGrupo FROM grupos WHERE idGrupo = ?", 'i', [$detallesCobro['idClase']]);
								$texto = $grupo['nombreGrupo']." (".$disciplina['nombreDisciplina'].") ".$detallesCobro['veces']." ve".($detallesCobro['veces']>1?'ces':'z')." a la semana";
							}else{
								$texto = "Total de veces a la semana (".$disciplina['nombreDisciplina']."): ".$detallesCobro['veces'];
							}
						break;
						case 5: //Cuota Por Total de Horas Semanales Por Disciplina
						$texto = "";
						$disciplina = select_query_one($con, "SELECT nombreDisciplina FROM disciplinas WHERE idDisciplina = ?", 'i', [$detallesCobro['idDisciplina']]);
						if(isset($detallesCobro['idGrupo'])){
							$detallesCobro['horas'] = $detallesCobro['horas']/2;
							$grupo = select_query_one($con, "SELECT nombreGrupo FROM grupos WHERE idGrupo = ?", 'i', [$detallesCobro['idClase']]);
							$texto = $grupo['nombreGrupo']." (".$disciplina['nombreDisciplina']."): ".$detallesCobro['horas']." hora".($detallesCobro['horas']>1?'s':'')." a la semana";
						}else{
							$texto = "Total (".$disciplina['nombreDisciplina']."): ".$detallesCobro['horas']." hora".($detallesCobro['horas']>1?'s':'')." a la semana";
						}
						break;
					}
				}
					$respuesta[$k]['concepto'] = $texto;
				}else{
					$respuesta[$k]['concepto'] = $v['nombreConcepto'];
				}
    }
		foreach($respuesta as $k=>$v){
			$respuesta[$k]['bd'] = true;
		}
		json_echo($respuesta);
?>
