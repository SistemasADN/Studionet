<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
  $rules['tipo'] = 				   					    ['r' => true , 	't' => "alpha"];
  $rules['idTipo'] = 				   					  ['r' => true , 	't' => "num"];

  $validator->setRulesValidateArrayEcho($rules, $_POST);
  include "dbcon.php";
  include "getIdSede.php";
  switch($_POST['tipo']){
      case 'CLASE':
         $query = "SELECT DISTINCT ap.nombre as alumno, cp.nombre as cliente, g.nombreGrupo as clase FROM alumnos as a
         LEFT JOIN alumnos_grupos as ag ON ag.idAlumno = a.idAlumno
         LEFT JOIN personacompleta as ap ON ap.idPersona = a.idPersona
         LEFT JOIN clientes as c ON c.idCliente = a.idTutor
         LEFT JOIN personacompleta as cp ON cp.idPersona = c.idPersona
         LEFT JOIN grupos as g ON ag.idGrupo = g.idGrupo AND g.idSede = ?
         WHERE ag.fechaBaja IS NULL AND ag.idGrupo = ?";
      break;
      case 'DISCIPLINA':
          $query = "SELECT DISTINCT ap.nombre as alumno, cp.nombre as cliente, g.nombreGrupo as clase FROM alumnos as a
          LEFT JOIN alumnos_grupos as ag ON ag.idAlumno = a.idAlumno
          LEFT JOIN personacompleta as ap ON ap.idPersona = a.idPersona
          LEFT JOIN clientes as c ON c.idCliente = a.idTutor
          LEFT JOIN personacompleta as cp ON cp.idPersona = c.idPersona
          LEFT JOIN grupos as g ON ag.idGrupo = g.idGrupo AND g.idSede = ?
          LEFT JOIN asignaturas as aa ON aa.idAsignatura = g.idAsignatura
          WHERE ag.fechaBaja IS NULL AND aa.idDisciplina = ?";
      break;
      case 'ASIGNATURA':
          $query = "SELECT DISTINCT ap.nombre as alumno, cp.nombre as cliente, g.nombreGrupo as clase FROM alumnos as a
          LEFT JOIN alumnos_grupos as ag ON ag.idAlumno = a.idAlumno
          LEFT JOIN personacompleta as ap ON ap.idPersona = a.idPersona
          LEFT JOIN clientes as c ON c.idCliente = a.idTutor
          LEFT JOIN personacompleta as cp ON cp.idPersona = c.idPersona
          LEFT JOIN grupos as g ON ag.idGrupo = g.idGrupo AND g.idSede = ?
          WHERE ag.fechaBaja IS NULL AND g.idAsignatura = ?";
      break;
      case 'NIVEL':
          $query = "SELECT DISTINCT ap.nombre as alumno, cp.nombre as cliente, g.nombreGrupo as clase FROM alumnos as a
          LEFT JOIN alumnos_grupos as ag ON ag.idAlumno = a.idAlumno
          LEFT JOIN personacompleta as ap ON ap.idPersona = a.idPersona
          LEFT JOIN clientes as c ON c.idCliente = a.idTutor
          LEFT JOIN personacompleta as cp ON cp.idPersona = c.idPersona
          LEFT JOIN grupos as g ON ag.idGrupo = g.idGrupo AND g.idSede = ?
          WHERE ag.fechaBaja IS NULL AND g.idNivel = ?";
      break;
  }

  $listaAlumnos = select_query($con, $query, 'ii', [$idSede, $_POST['idTipo']]);
  json_echo($listaAlumnos);
?>
