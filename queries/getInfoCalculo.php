<?php
  include "../validation/classValidator.php";
  $validator = new Validator();
  $rules = array();
  $validator->setRules($_POST);
  include "dbcon.php";
  $idCalculoPagos = $_POST['idCalculoPago'];  //forma de calculo pago: cuota fija, por dias, por veces o por horas a la semana
  $tipoSelect     = $_POST['tipoSelect']; // 2: disciplina  3: equipos
  $idSelect       = $_POST['idSelect'];  //disciplina o equipo
  
  if($tipoSelect=='1'){
    $idCalculo = select_query_one($con, "SELECT idCalculoPagos FROM forma_calculos_detalle WHERE idDisciplina IS NULL AND idEquipo IS NULL and idCalculoPagos='$idCalculoPagos'");
  }
  else if($tipoSelect=='2'){
    $idCalculo = select_query_one($con, "SELECT idCalculoPagos FROM forma_calculos_detalle WHERE idDisciplina='$idSelect' AND idEquipo IS NULL and idCalculoPagos='$idCalculoPagos'");
  }
  else if($tipoSelect=='3'){
    $idCalculo = select_query_one($con, "SELECT idCalculoPagos FROM forma_calculos_detalle WHERE idDisciplina IS NULL AND idEquipo ='$idSelect' and idCalculoPagos='$idCalculoPagos'");
  }
 $idCalculo = $idCalculo['idCalculoPagos'];
  $data = [];

  if(isset($idCalculo)){
    $data['idCalculoPagos'] = $idCalculo;
    switch($idCalculo){
      case 1:
      if($tipoSelect=='1'){
        $cuotaMensual = select_query_one($con, "SELECT cuota FROM forma_calculos_detalle WHERE idCalculoPagos = '$idCalculo[idCalculoPagos]' AND idDisciplina IS NULL AND idEquipo IS NULL");
        $data['cuotaMensual'] = $cuotaMensual['cuota'];
      }
      else if($tipoSelect=='2'){
        $cuotaMensual = select_query_one($con, "SELECT cuota FROM forma_calculos_detalle where idCalculoPagos = $idCalculo AND idDisciplina = $idSelect AND idEquipo IS NULL");
        $data['cuotaMensual'] = $cuotaMensual['cuota'];
      }
      else if($tipoSelect=='3'){
        $cuotaMensual = select_query_one($con, "SELECT cuota FROM forma_calculos_detalle where idCalculoPagos = $idCalculo AND idDisciplina IS NULL AND idEquipo = $idSelect");
        $data['cuotaMensual'] = $cuotaMensual['cuota'];
      } 
      break;
      case 2:
        $data['detalles'] = select_query($con, "SELECT idDisciplina, cuota FROM forma_calculos_detalle");
      break;
      case 3:
      if($tipoSelect=='1'){
        $cuotaMensual = select_query_one($con, "SELECT cuota FROM forma_calculos_detalle WHERE idCalculoPagos = '$idCalculo[idCalculoPagos]' AND idDisciplina IS NULL AND idEquipo IS NULL");
        $data['cuotaMensual'] = $cuotaMensual['cuota'];
      }
      else if($tipoSelect=='2'){
        $data['detalles'] = select_query($con, "SELECT veceshorasdias, cuota FROM forma_calculos_detalle where idCalculoPagos = $idCalculo AND idDisciplina = $idSelect AND idEquipo IS NULL");
      }
      else if($tipoSelect=='3'){
        $cuotaMensual = select_query_one($con, "SELECT cuota FROM forma_calculos_detalle where idCalculoPagos = $idCalculo AND idDisciplina IS NULL AND idEquipo = $idSelect");
        $data['cuotaMensual'] = $cuotaMensual['cuota'];
      } 
      break;
      case 4:
      if($tipoSelect=='2'){
        $data['detalles'] = select_query($con, "SELECT veceshorasdias, cuota FROM forma_calculos_detalle where idCalculoPagos = $idCalculo AND idDisciplina = $idSelect AND idEquipo IS NULL");
      }
      break;
      case 5:
      if($tipoSelect=='2'){
        $data['detalles'] = select_query($con, "SELECT veceshorasdias, cuota FROM forma_calculos_detalle where idCalculoPagos = $idCalculo AND idDisciplina = $idSelect AND idEquipo IS NULL");
      }
    break;
    }
  }
  else{
    $data['idCalculoPagos'] = $idCalculoPagos;
    $data['detalles'] = NULL;
  }
  json_echo($data);
?>
