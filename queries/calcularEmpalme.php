<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	//getDebuggingInfo();
	//deleteDebuggingInfo();
	//vde();
	$rules = array ();
  if(isset($_POST['idHorario'])){//Cambiar Grupo:
      $rules['idHorario'] =['r' => true , 	't' => "num"];
      $rules['idGrupo'] =['r' => true , 	't' => "num"];
      $rules['idSalon'] =['r' => true , 	't' => "num"];
  }else{
    if(isset($_POST['idSalonGrupo'])){//Pegar Grupo
      $rules['idSalonGrupo'] =['r' => true , 	't' => "num"];
    }else{//Asignar Grupo
      $rules['idGrupo'] =['r' => true , 	't' => "num"];
      $rules['idSalon'] =['r' => true , 	't' => "num"];
    }

    $rules['dia'] =['r' => true , 	't' => "num"];
    $rules['duracion'] =['r' => true , 	't' => "coin"];
    $rules['horaInicio'] =['r' => true , 	't' => "num"];
  }
/*
    $_POST['idGrupo'] = '9';
    $_POST['idSalon'] = '3';

  /**/
  //$_POST['idHorario'] = '40';
  $validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
  //EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME
  if(isset($_POST['idHorario'])){//Cambiar
    //Horario que estamos comparando
    $horario = select_query($con, "SELECT idSalonGrupo, dia, horaInicio, duracion FROM horario WHERE idHorario = ?", 'i', [$_POST['idHorario']]);
    $idGrupoViejo = select_query($con, "SELECT idGrupo FROM salon_grupo WHERE idSalonGrupo = ?", 'i', [$horario[0]['idSalonGrupo']]);
    //Horario que estamos comparando
  }else{
    $horario[0]['dia'] = $_POST['dia'];
    $horario[0]['duracion'] = $_POST['duracion'];
    $horario[0]['horaInicio'] = $_POST['horaInicio'];

    if(isset($_POST['idSalonGrupo'])){//Pegar
      $idGrupoViejo = select_query($con, "SELECT idGrupo FROM salon_grupo WHERE idSalonGrupo = ?", 'i', [$_POST['idSalonGrupo']]);
    }else{//Asignar
      $idGrupoViejo[0]['idGrupo'] = $_POST['idGrupo'];
    }
  }
  $idGrupoViejo = $idGrupoViejo[0]['idGrupo'];

    $profesores = select_query($con, "SELECT idProfesor, pc.nombreProfesor
    FROM grupo_profesor as gp LEFT JOIN profesorcompleto as pc ON pc.idPersonal = gp.idProfesor WHERE gp.idGrupo = ? AND gp.fechaBaja IS NULL", 'i', [$idGrupoViejo]);

    $continue = true;
    //Grupos de profesor principal
    $empalmes = array();
    for($i=0;$i<count($profesores);$i++){
      if(!$continue){
        break;
      }

      $profesores[$i]['grupos'] = select_query($con, "SELECT idGrupo FROM grupo_profesor
         WHERE idProfesor = ? AND idGrupo <> ?", 'ii', [$profesores[$i]['idProfesor'], $idGrupoViejo]);
      //var_dump($profesores[$i]['grupos']);
      for($j=0;$j<count($profesores[$i]['grupos']);$j++){
        if($profesores[$i]['grupos'][$j]['idGrupo']==$idGrupoViejo){
          continue;
        }

        $insert = array($profesores[$i]['grupos'][$j]['idGrupo']);
        $horarioGrupo = select_query($con,
        "SELECT h.dia, h.horaInicio, h.duracion, g.nombreGrupo
        FROM horario as h LEFT JOIN salon_grupo as sg LEFT JOIN grupos as g ON g.idGrupo = sg.idGrupo
        ON sg.idSalonGrupo = h.idSalonGrupo
        WHERE sg.idGrupo = ?", 'i', $insert);
				if(!isset($empalmes[$profesores[$i]['nombreProfesor']])){
					$empalmes[$profesores[$i]['nombreProfesor']] = [];
				}
        $empalmes[$profesores[$i]['nombreProfesor']][] = lista_empalme_horario($horarioGrupo, $horario);
      }
    }
		$listaFinal = [];
		foreach($empalmes as $profesor=>$empalmesProfe){
			$listaFinal[$profesor] = [];
			foreach($empalmesProfe as $emp){
				if(count($emp)>0){
					$listaFinal[$profesor][] = $emp[0];
				}
			}
		}

    json_echo($listaFinal);
?>
