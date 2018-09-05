<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array ();
  $rules['fechaInicial'] = 		["t"=>"date", "r"=>true];
  $rules['fechaFinal'] = 			["t"=>"date", "r"=>true];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
  session_start();
  //*	Calculamos el total que un profesor le han pagado
  $profesorEgresos = select_query($con,
  "SELECT ep.idPersonal, pc.nombreProfesor, SUM(e.cantidad) as totalEgresos
  FROM egresos_personal as ep
  LEFT JOIN egresos as e ON e.idEgreso = ep.idEgreso
  LEFT JOIN profesorcompleto as pc ON pc.idPersonal = ep.idPersonal
  WHERE e.fecha BETWEEN ? AND ? GROUP BY (ep.idPersonal)", 'ss', $_POST);
  //*	Sacamos los grupos
  $grupos = select_query($con, "SELECT g.idGrupo, g.nombreGrupo, h.duracion, h.dia
		 FROM grupos as g
		 LEFT JOIN salon_grupo AS sg ON sg.idGrupo = g.idGrupo
		 LEFT JOIN horario as h ON h.idSalonGrupo = sg.idSalonGrupo
		 WHERE g.fechaBaja IS NULL");
	//*	Cuentas la duración en horas por grupo entre un rango de fechas
  $fechaInicial = date($_POST['fechaInicial']);
  $fechaFinal = date($_POST['fechaFinal']);
	$listaGrupos = array();
	$interval = DateInterval::createFromDateString('1 day');

	foreach($grupos as $k=>$grupo){
			if(!isset($listaGrupos[$grupo['idGrupo']])){
				$listaGrupos[$grupo['idGrupo']] = [
					"idGrupo"=>$grupo['idGrupo'],
				  "nombreGrupo"=>$grupo['nombreGrupo'],
					"totalHoras"=>0
				];
			}

			$start    = new DateTime($fechaInicial);	$start->modify('midnight');
			$end      = new DateTime($fechaFinal);	$end->modify('midnight');
			$period   = new DatePeriod($start, $interval, $end);
			foreach ($period as $dt) {
				$dia = $dt->format("w")-1;
				if($dia==-1){
					$dia = 6;
				}
				if($grupo['dia']==$dia){
					$listaGrupos[$grupo['idGrupo']]['totalHoras'] += $grupo['duracion'];
				}
			}

			$totalCobrado = select_query($con,
			"SELECT IFNULL(SUM(rp.cantidad*rp.precioActual*(1-(rp.descuento/100))),0) as totalCobroGrupo
			 FROM recibo_pago_lista as rp
			 LEFT JOIN recibo_pago as r ON r.idReciboPago = rp.idReciboPago
			 LEFT JOIN alumnos_grupos as ag ON ag.idAlumnoGrupo = rp.idAlumnoGrupo
			 WHERE ag.idGrupo = ? AND r.folio IS NOT NULL AND r.fecha BETWEEN ? AND ? GROUP BY (ag.idGrupo)", 'iss', [$grupo['idGrupo'], $fechaInicial, $fechaFinal]);
			 if(isset($totalCobrado[0])){
			 		$listaGrupos[$grupo['idGrupo']]['totalCobrar'] = $totalCobrado[0]['totalCobroGrupo'];
		 	 }else{
				$listaGrupos[$grupo['idGrupo']]['totalCobrar'] = 0;
			 }
	}
	//Relacion grupos profesor
	$listaProfesores = array();
	//Tomas cada profesor y asignas horas totales sumando las horas por grupo
	foreach($listaGrupos as $idGrupo=>$detalles){
		$listaGrupos[$idGrupo]['profesores'] = select_query($con,
		"SELECT gp.idProfesor, pc.nombreProfesor FROM grupo_profesor as gp
		LEFT JOIN profesorcompleto as pc ON pc.idPersonal = gp.idProfesor
		WHERE idGrupo = ? AND ((? <= fechaBaja AND fechaAlta <= ?) OR (fechaBaja IS NULL AND (fechaAlta<=?)))
		GROUP BY (idProfesor)", 'isss',	[$idGrupo, $fechaInicial, $fechaFinal, $fechaFinal]);
		for($i=0;$i<count($listaGrupos[$idGrupo]['profesores']);$i++){
			if(!isset($listaProfesores[$listaGrupos[$idGrupo]['profesores'][$i]['idProfesor']]['horasTotales'])){
				$listaProfesores[$listaGrupos[$idGrupo]['profesores'][$i]['idProfesor']]['horasTotales'] = 0;
			}
			$listaProfesores[$listaGrupos[$idGrupo]['profesores'][$i]['idProfesor']]['horasTotales'] += $detalles['totalHoras'];
		}
	}
	// luego divides totalEgresos/horasTotales y ves el costo por hora de ese profesor

	foreach($listaProfesores as $idProfesor=>$profesor){
		$totalProfesor = 0;
		for($i=0;$i<count($profesorEgresos);$i++){
				if($profesorEgresos[$i]['idPersonal']==$idProfesor){
						$totalProfesor = $profesorEgresos[$i]['totalEgresos']/$profesor['horasTotales'];
				}
		}
		$listaProfesores[$idProfesor]['totalHoras'] = $profesor['horasTotales'];
		$listaProfesores[$idProfesor]['costoHora'] = $totalProfesor;
	}

	foreach($listaGrupos as $idGrupo=>$detalles){
		foreach($detalles['profesores'] as $k=>$profesor){
			$listaGrupos[$idGrupo]['profesores'][$k]['totalHoras'] = $listaProfesores[$profesor['idProfesor']]['totalHoras']; ;
			$listaGrupos[$idGrupo]['profesores'][$k]['costoHora'] = $listaProfesores[$profesor['idProfesor']]['costoHora'];
			$listaGrupos[$idGrupo]['profesores'][$k]['costoGrupo'] = $listaProfesores[$profesor['idProfesor']]['costoHora']*$detalles['totalHoras'];
		}
	}


	$respuesta = array();
	foreach($listaGrupos as $k=>$v){
		$respuesta[] = $v;
	}
	//var_dump($respuesta);exit;
	json_echo($respuesta);
  /**/
?>
