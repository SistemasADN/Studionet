<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
  $rules = array ();
  $rules['fechaInicial'] = 		["t"=>"date", "r"=>true];
  $rules['fechaFinal'] = 			["t"=>"date", "r"=>true];
  $rules['idAlumno'] =        ["t"=>"num", "r"=>true];
  //$_POST['fechaInicial'] = "2017-08-01";$_POST['fechaFinal'] = "2017-08-30";$_POST['idAlumno'] = 1;
  $validator->setRulesValidateArrayEcho($rules, $_POST);
  include "dbcon.php";
  $resultados = ['asistencias', 'tarde', 'faltas'];
  $grupos = select_query ($con, "SELECT g.idGrupo, g.nombreGrupo FROM grupos as g LEFT JOIN alumnos_grupos as ag ON ag.idGrupo = g.idGrupo WHERE ag.idAlumno = ? GROUP BY (g.idGrupo)", 'i', [$_POST['idAlumno']]);
  foreach($grupos as $k=>$grupo){
    for($i = 0;$i<count($resultados);$i++){
      $grupos[$k][$resultados[$i]] = select_query($con, "SELECT COUNT(aa.asistencia) as resultado FROM asistencia_alumno as aa
       LEFT JOIN asistencia as a ON aa.idAsistencia = a.idAsistencia
       LEFT JOIN grupos as g ON g.idGrupo = a.idGrupo
       WHERE asistencia = ".$i." AND g.idGrupo = ? AND aa.idAlumno = ? AND a.fecha BETWEEN ? AND ?", 'iiss', [$grupo['idGrupo'], $_POST['idAlumno'], $_POST['fechaInicial'], $_POST['fechaFinal']]);
       $grupos[$k][$resultados[$i]] = $grupos[$k][$resultados[$i]][0]['resultado'];
    }
  }
  json_echo($grupos);
  //var_dump($grupos);
//
?>
