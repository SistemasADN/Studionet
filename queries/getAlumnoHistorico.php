<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
  $rules['idAlumno'] = ['t'=>'num', 'r'=>true];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
  if(!isset($_SESSION)){
    session_start();
  }
	
  $respuesta = select_query($con,
  "SELECT ag.idAlumnoGrupo, ag.fechaAlta, ag.fechaBaja, g.nombreGrupo,
  CONCAT(a.nombreAsignatura, ' - ', n.nombreNivel) as nivelAsignatura,
  pc.nombre as nombreProfesor
  FROM alumnos_grupos as ag
  LEFT JOIN grupos as g ON g.idGrupo = ag.idGrupo
  LEFT JOIN asignaturas as a ON a.idAsignatura = g.idAsignatura
	LEFT JOIN niveles as n ON n.idNivel = g.idNivel
	LEFT JOIN grupo_profesor as gp ON g.idGrupo = gp.idGrupo AND gp.fechaBaja IS NULL AND gp.principal = 1
	LEFT JOIN personal as p ON p.idPersonal = gp.idProfesor
	LEFT JOIN personacompleta as pc ON pc.idPersona = p.idPersona
	WHERE ag.idAlumno = ?", 'i', [$_POST['idAlumno']]);

  foreach($respuesta as $k=>$v){
      if($_SESSION['idTipoUsuario']==3||$_SESSION['idTipoUsuario']==4) {
        continue;
      }
      $borrable = select_query_one($con, "SELECT COUNT(idReciboPagoLista) as borrable FROM recibo_pago_lista WHERE idAlumnoGrupo = ?",
       'i', [$v['idAlumnoGrupo']]);
      $respuesta[$k]['borrable'] = $borrable['borrable'];
  }
  //var_dump($respuesta);
  json_echo($respuesta);
?>
