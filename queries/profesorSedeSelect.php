<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
  session_start();
  $idProfesor = select_query($con, "SELECT idPersonal FROM profesorcompleto WHERE idUsuario = ?", 'i', [$_SESSION['idUsuario']]);
	$respuesta = [];
	if(count($idProfesor)==1){
	  $idProfesor = $idProfesor[0]['idPersonal'];
	  $respuesta = select_query($con,
		"SELECT s.idSede as id, s.nombreSede as value FROM sedes as s LEFT JOIN grupos as g ON g.idSede = s.idSede
    LEFT JOIN grupo_profesor as gp ON gp.idGrupo = g.idGrupo
     WHERE s.activo = 1 AND gp.idProfesor = ? AND gp.fechaBaja IS NULL GROUP BY (id) ORDER BY s.nombreSede ASC", 'i', [$idProfesor]);
	 }

  json_echo(format_respuesta_select($respuesta));
?>
