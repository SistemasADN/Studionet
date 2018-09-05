<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	//$_POST['idSalon'] = 1;
	$rules['idGrupo'] = ["r"=>true, "t"=>"num"];
  //deleteDebuggingInfo();

	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";

  $check = select_query_one($con, "SELECT COUNT(idSalonGrupo) as existe FROM salon_grupo WHERE idGrupo = ? AND idSalon IS NULL", 'i', $_POST);
  if($check['existe']===0){
      if(!execute_query($con, "INSERT INTO salon_grupo (idGrupo, idSalon) VALUES (?, NULL)", 'i', $_POST)){
          json_echo(["error"=>true]);
      }
  }
	$respuesta = select_query($con,
	"SELECT
    sg.idSalonGrupo,
    s.nombreSalon as nombreGrupo,
		CONCAT(pc.nombre, ' (',a.nombreAsignatura, ' - ', n.nombreNivel, ')') as detallesGrupo,
    sg.idSalon
	FROM grupos as g
	LEFT JOIN salon_grupo as sg ON sg.idGrupo = g.idGrupo
  LEFT JOIN salones as s ON s.idSalon = sg.idSalon
	LEFT JOIN asignaturas as a ON a.idAsignatura = g.idAsignatura
	LEFT JOIN niveles as n ON n.idNivel = g.idNivel
	LEFT JOIN grupo_profesor as gp ON g.idGrupo = gp.idGrupo AND gp.fechaBaja IS NULL AND gp.principal = 1
	LEFT JOIN personal as p ON p.idPersonal = gp.idProfesor
	LEFT JOIN personacompleta as pc ON pc.idPersona = p.idPersona
	WHERE sg.idGrupo = ? ORDER BY (nombreGrupo) ASC",'i', $_POST);


	foreach($respuesta as $k=>$v){
		$insert = array($v['idSalonGrupo']);
		$respuesta[$k]['horarios'] = select_query($con, "SELECT idHorario, dia, horaInicio, duracion FROM horario WHERE idSalonGrupo = ?", 'i', $insert);
	}
  /**/
	json_echo($respuesta);
?>
