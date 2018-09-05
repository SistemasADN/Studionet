<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['idGrupo'] =['r' => true , 	't' => "num"];
	$rules['idSalon'] =['r' => true , 	't' => "num"];

	$rules['idHorario'] =['r' => true , 	't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME
	$horario = select_query($con, "SELECT idSalonGrupo, dia, horaInicio, duracion FROM horario WHERE idHorario = ?", 'i', [$_POST['idHorario']]);
  $idGrupoViejo = select_query($con, "SELECT idGrupo FROM salon_grupo WHERE idSalonGrupo = ?", 'i', [$horario[0]['idSalonGrupo']]);
	$idGrupoViejo = $idGrupoViejo[0]['idGrupo'];
	$profesores = select_query($con, "SELECT idProfesor FROM grupo_profesor WHERE idGrupo = ? AND fechaBaja IS NULL", 'i', [$idGrupoViejo]);

	$continue = true;
	//Grupos de profesor principal
	for($i=0;$i<count($profesores);$i++){
			if(!$continue){
				break;
			}

			$profesores[$i]['grupos'] = select_query($con, "SELECT idGrupo FROM grupo_profesor WHERE idProfesor = ? AND idGrupo <> ?", 'ii', [$profesores[$i]['idProfesor'], $idGrupoViejo]);
			//var_dump($profesores[$i]['grupos']);
			for($j=0;$j<count($profesores[$i]['grupos']);$j++){
				if(!$continue){
					break;
				}
				if($profesores[$i]['grupos'][$j]['idGrupo']==$idGrupoViejo){
					continue;
				}
				$insert = array($profesores[$i]['grupos'][$j]['idGrupo']);
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
    $idSalonGrupoNuevo = select_query($con, "SELECT idSalonGrupo FROM salon_grupo WHERE idGrupo = ? AND idSalon = ?", 'ii',
    reorder_array($_POST, ['idGrupo', 'idSalon']));
    if(count($idSalonGrupoNuevo)>0){
      $idSalonGrupoNuevo = $idSalonGrupoNuevo[0]['idSalonGrupo'];
    }else{
      $idSalonGrupoNuevo = insert_id_query($con, "INSERT INTO salon_grupo (idGrupo, idSalon) VALUES (?,?)", 'ii', reorder_array($_POST, ['idGrupo', 'idSalon']));
    }

    if($idSalonGrupoNuevo){
      if(execute_query($con, "UPDATE horario SET idSalonGrupo = ? WHERE idHorario = ?", 'ii', [$idSalonGrupoNuevo, $_POST['idHorario']])){

				//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY
				$count = select_query($con, "SELECT COUNT(*) as total FROM horario WHERE idSalonGrupo = ?", 'i', [$horario[0]['idSalonGrupo']]);
				$count = $count[0]['total'];
				if($count==0){
					if(!execute_query($con, "DELETE FROM salon_grupo WHERE idSalonGrupo = ?", 'i', [$horario[0]['idSalonGrupo']], false)){
						echo "e|Cambiar clase|No se pudo cambiar el grupo. ";	exit;
					}
				}
				//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY
        mysqli_commit($con);
        echo "s|Cambiar clase|Clase cambiada correctamente.";
      }else{
          echo "e|Cambiar clase|No se pudo cambiar la clase.";
      }
    }
	}else{
		echo "e|Cambiar clase|No se pudo cambiar la clase ya que se crea un empalme con los profesores.";
	}
  //vde();
?>
