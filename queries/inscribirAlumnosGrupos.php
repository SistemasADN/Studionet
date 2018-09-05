<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas

  $data['empalme'] = [];
  $data['inscrito'] = [];
  $data['empalmeHorario'] = [];
  //getDebuggingInfo(true);
  //deleteDebuggingInfo();
  if(!(isset($_POST['listaAlumnos'])&&isset($_POST['listaGrupos']))){
    echo "e|Inscribir alumnos|No se ha podido inscribir alumnos.";exit;
  }

  $rules = array ();
  $rules['idAlumno'] = ["t"=>'num',"r"=>true];

  foreach($_POST['listaAlumnos'] as $alumno){
    $validator->setRulesValidateArrayEcho($rules, $alumno);
  }

  $rules = array ();
  $rules['idGrupo'] = ["t"=>'num',"r"=>true];
  foreach($_POST['listaGrupos'] as $grupo){
    $validator->setRulesValidateArrayEcho($rules, $grupo);
  }

  include "dbcon.php";
  //Lista de alumnos con sus grupos inscritos y sus horarios
  $listaAlumnos = array();
  foreach($_POST['listaAlumnos'] as $k=>$alumno){
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
  foreach($_POST['listaGrupos'] as $k=>$grupo){
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

  if(count($data['empalme'])==0&&count($data['inscrito'])==0&&count($data['empalmeHorario'])==0){
    //
    $fecha = date("Y-m-d");
    mysqli_autocommit($con, FALSE);
    foreach($listaAlumnos as $idAlumno => $listaGruposAlumno){
        foreach($_POST['listaGrupos'] as $k => $grupo){
          $idGrupo = $grupo['idGrupo'];
            if(!execute_query($con, "INSERT INTO alumnos_grupos(idAlumno, idGrupo, fechaAlta) VALUES (?,?,?)", 'iis', [$idAlumno, $idGrupo, $fecha], false)){
                echo "e|Inscribir alumnos|No se ha podido inscribir alumnos a las clases."; exit;
            }
        }
    }
    echo "s|Inscribir alumnos|Alumnos inscritos a clases correctamente";
    mysqli_commit($con);
  }else{
    echo "e|Inscribir alumnos|No se ha podido inscribir alumnos ya que se ha detectado un empalme.";
  }
?>
