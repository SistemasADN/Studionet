<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['idGrupo'] =['r' => true , 	't' => "num"];
	$rules['idSalon'] =['r' => true , 	't' => "num"];

	$rules['dia'] =['r' => true , 	't' => "num"];
	$rules['horaInicio'] =['r' => true , 	't' => "num"];
	$rules['duracion'] =['r' => true , 	't' => "coin"];

	$validator->setRulesValidateArrayEcho($rules, $_POST);

	include "dbcon.php";
	//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME
	$horario = array();
	$horario[] = $_POST;
	unset($horario[0]['idSalonGrupo']);
	//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME

	if($_POST['idSalon']==0){
			$existe = select_query($con, "SELECT idSalonGrupo FROM salon_grupo WHERE idGrupo = ? AND idSalon IS NULL", 'i', reorder_array($_POST, ['idGrupo']));
	}else{
			$existe = select_query($con, "SELECT idSalonGrupo FROM salon_grupo WHERE idGrupo = ? AND idSalon = ?", 'ii', reorder_array($_POST, ['idGrupo', 'idSalon']));
	}

  if(count($existe)>0){
    $respuesta['idSalonGrupo']  = $existe[0]['idSalonGrupo'];
		$respuesta['new'] = false;
  }else{
    $respuesta['idSalonGrupo'] = insert_id_query($con, "INSERT INTO salon_grupo (idGrupo, idSalon) VALUES (?,?)", 'ii', reorder_array($_POST, ['idGrupo', 'idSalon']));
		$respuesta['new'] = true;
  }

	//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME
	$profesores = select_query($con, "SELECT idProfesor FROM grupo_profesor WHERE idGrupo = ? AND fechaBaja IS NULL", 'i', reorder_array($_POST, ['idGrupo']));
	$continue = true;
	//Grupos de profesor principal
	for($i=0;$i<count($profesores);$i++){
			if(!$continue){
				break;
			}
			$profesores[$i]['grupos'] = select_query($con, "SELECT idGrupo FROM grupo_profesor WHERE idProfesor = ? AND fechaBaja IS NULL", 'i', [$profesores[$i]['idProfesor']]);
			for($j=0;$j<count($profesores[$i]['grupos']);$j++){
				if(!$continue){
					break;
				}
				$insert = array($profesores[$i]['grupos'][$j]['idGrupo']);
				//var_dump($insert);
				$horarioGrupo = select_query($con, "SELECT dia, horaInicio, duracion
				FROM horario as h LEFT JOIN salon_grupo as sg ON sg.idSalonGrupo = h.idSalonGrupo
				WHERE sg.idGrupo = ?", 'i', $insert);
				if(empalme_horario($horarioGrupo, $horario)){
					$continue = false;
				}
			}
	}
//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME


	if($continue){
		$respuesta['idHorario'] = insert_id_query($con, "INSERT INTO horario (idSalonGrupo, dia, horaInicio, duracion) VALUES (?,?,?,?)", 'iiid',
		[$respuesta['idSalonGrupo'], $_POST['dia'], $_POST['horaInicio'], $_POST['duracion']]);
		mysqli_commit($con);
	}else{
		$respuesta['idHorario'] = false;
	}

  json_echo($respuesta);
  //vde();
?>
