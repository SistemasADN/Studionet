<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['idSalonGrupo'] =['r' => true , 	't' => "num"];
	$rules['dia'] =['r' => true , 	't' => "num"];
	$rules['horaInicio'] =['r' => true , 	't' => "num"];
	$rules['duracion'] =['r' => true , 	't' => "coin"];

	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$horario[0] = $_POST;
	$idGrupo = select_query($con, "SELECT idGrupo FROM salon_grupo WHERE idSalonGrupo = ?", 'i', [$horario[0]['idSalonGrupo']]);
	$idGrupo = $idGrupo[0]['idGrupo'];

	//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME
	$profesores = select_query($con, "SELECT idProfesor FROM grupo_profesor WHERE idGrupo = ? AND fechaBaja IS NULL", 'i', [$idGrupo]);
	$continue = true;
	//Grupos de profesor principal
	//$listaEmpalme = "";
	for($i=0;$i<count($profesores);$i++){
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
					//$listaEmpalme[] = $profesores[$i]['idProfesor'];
				}
			}
	}
//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME


	if($continue){
		if(execute_query($con, "INSERT INTO horario (idSalonGrupo, dia, horaInicio, duracion) VALUES (?,?,?,?)",
		 'iiid', [$_POST['idSalonGrupo'], $_POST['dia'], $_POST['horaInicio'], $_POST['duracion']], false)){
			echo "s|Pegar Horario|Horario pegado correctamente.";
			mysqli_commit($con);
			exit;
		}
	}else{
		echo "e|Pegar Horario|No se pudo pegar el horario ya que se crea un empalme con los profesores.";exit;
	}
	echo "e|Pegar Horario|No se pudo pegar el horario.";
  //vde();
?>
