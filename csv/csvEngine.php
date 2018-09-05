<?php
  if(!isset($_POST['titulo'])||!isset($_POST['titulopdf'])){
    exit;
  }
  include "../validation/classValidator.php";

  $header = array();
  $firstLine = array();
  $titleLine = [$_POST['titulo']];

  foreach($_POST['header'] as $value){
    $header[] = $value['key'];
    $firstLine[] = $value['titulo'];
  }
  $n = 1;
  $handler = fopen($_POST['titulopdf'].".csv", 'w');

  if(fputcsv($handler, $titleLine)===false){
    fclose($handler);
    echo "Error en linea ".$n;exit;
  }

  $n++;

  if(isset($_POST['filtros'])){
    $filtroHeader = array();
    $filtroValues = array();
    $filtroHeader[] = "FILTROS";
    $filtroValues[] = "";
    foreach($_POST['filtros'] as $value){
      $filtroHeader[] = $value['nombre'];
      $filtroValues[] = $value['valor'];
    }
    if(fputcsv($handler, $filtroHeader)===false){
      echo "Error en linea ".$n;exit;
      fclose($handler);
    }
    $n++;
    if(fputcsv($handler, $filtroValues)===false){
      echo "Error en linea ".$n;exit;
      fclose($handler);
    }
    $n++;
  }

  if(fputcsv($handler, $firstLine)===false){
    echo "Error en linea ".$n;exit;
    fclose($handler);
  }

  foreach($_POST['info'] as $line){
    $n++;
    if(fputcsv($handler, reorder_array($line, $header))===false){
      fclose($handler);
      echo "Error en linea ".$n;exit;
    }
  }
  fclose($handler);
?>
