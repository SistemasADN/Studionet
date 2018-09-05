<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas

  $data['empalme'] = [];
  $data['inscrito'] = [];
  $data['empalmeHorario'] = [];
  //getDebuggingInfo();
  //deleteDebuggingInfo();
  if(!(isset($_POST['alumnos'])&&isset($_POST['grupos']))){
    json_echo($data);exit;
  }


  $rules = array ();
  $rules['idAlumno'] = ["t"=>'num',"r"=>true];

  foreach($_POST['alumnos'] as $alumno){
    $validator->setRulesValidateArrayEcho($rules, $alumno);
  }

  $rules = array ();
  $rules['idGrupo'] = ["t"=>'num',"r"=>true];
  foreach($_POST['grupos'] as $grupo){
    $validator->setRulesValidateArrayEcho($rules, $grupo);
  }

  include "dbcon.php";
  //Lista de alumnos con sus grupos inscritos y sus horarios
  $listaAlumnos = array();
  foreach($_POST['alumnos'] as $k=>$alumno){
    $gruposAlumno = select_query($con, "SELECT idGrupo FROM alumnos_grupos WHERE idAlumno = ? AND fechaBaja IS NULL",
     'i', [$alumno['idAlumno']]);
    $listaAlumnos[$alumno['idAlumno']] = array();
    foreach($gruposAlumno as $grupo){
      $listaAlumnos[$alumno['idAlumno']][$grupo['idGrupo']] = select_query($con, "SELECT h.dia, h.horaInicio, h.duracion
        FROM horario as h LEFT JOIN salon_grupo as sg ON sg.idSalonGrupo = h.idSalonGrupo WHERE sg.idGrupo = ?", 'i',
         [$grupo['idGrupo']]);
    }
  }
  //Lista de grupos con sus horarios
  $listaGrupos = array();
  foreach($_POST['grupos'] as $k=>$grupo){
      $listaGrupos[$grupo['idGrupo']] = select_query($con, "SELECT h.dia, h.horaInicio, h.duracion
        FROM horario as h LEFT JOIN salon_grupo as sg ON sg.idSalonGrupo = h.idSalonGrupo WHERE sg.idGrupo = ?", 'i',
         [$grupo['idGrupo']]);
  }


  //Buscar todos los grupos donde ya está inscrito y quitarlos
  foreach($listaAlumnos as $idAlumno => $listaGruposAlumno){
      foreach($listaGrupos as $idGrupo => $horario){
          //Si el grupo se encuentra dentro de la lista de alumnos
          if(isset($listaGruposAlumno[$idGrupo])){
            $data['inscrito'][] = ['idAlumno' => $idAlumno, 'idGrupo' => $idGrupo];
            unset($listaAlumnos[$idAlumno][$idGrupo]);
          }
      }
  }
  //Buscar todos los grupos restantes y checar empalmes
  foreach($listaAlumnos as $idAlumno => $listaGruposAlumno){
    foreach($listaGruposAlumno as $idGrupoAlumno =>$horarioAlumno){
        foreach($listaGrupos as $idGrupo => $horarioGrupo){
          if(empalme_horario($horarioAlumno, $horarioGrupo)){
            $data['empalme'][] = ['idAlumno' =>$idAlumno, 'idGrupoAlumno'=>$idGrupoAlumno, 'idGrupoEmpalme'=>$idGrupo];
          }
        }
    }
  }
  //Checar empalmes entre grupos
  foreach($listaGrupos as $idGrupoA => $horarioGrupoA){
      foreach($listaGrupos as $idGrupoB => $horarioGrupoB){
          if($idGrupoA!=$idGrupoB){
            if(empalme_horario($horarioGrupoA, $horarioGrupoB)){
              $data['empalmeHorario'][] = ['idGrupoA' =>$idGrupoA, 'idGrupoB'=>$idGrupoB];
            }
          }
      }
      unset($listaGrupos[$idGrupoA]);
  }

  json_echo($data);
?>
