<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  ini_set('max_input_vars','200000');
  ini_set('post_max_size','2000000000M');
  ini_set('upload_max_filesize','2000000000M');

  include('../validation/newValidator.php');
  include('../queries/dbcon.php');
  include("pdfEngineUtilities.php");

  //getDebuggingInfo();
  /*
  $_POST['type'] = 'cartacobro';
  $_POST['params']['idReciboPago'] = '1';
  $_POST['www'] = 'Pollo';
  /**/
  /*
  $_POST['type'] = 'recibospagoacademias';
  $_POST['params']['idPagoRecibido'] = '33';
  $_POST['www'] = 'Pollo';
  /**/
  /*
  $_POST['type'] = 'listaalumnos';
  $_POST['params']['idGrupo'] = '6';
  $_POST['www'] = 'Pollo';
  /**/
  /*
  $_POST['type'] = 'pagonomina';
  $_POST['params']['idEgreso'] = '4';
  $_POST['www'] = 'Pollo';
  /**/
  //deleteDebuggingInfo();
  //getDebuggingInfo(true);
  /*
  session_start();
  if(!isset($_SESSION['test'])){
    $_SESSION['test'] = $_POST;
  }
  var_dump($_SESSION['test']['params']);
  exit;
  /**/
  $formats['listaalumnos'] =            ['id'=>"idGrupo",         'orientation'=>'portrait',  'size'=>'letter'];
  $formats['cartacobro'] =              ['id'=>"idReciboPago",    'orientation'=>'portrait',  'size'=>'letter'];
  $formats['tablafiltrada'] =           ['id'=>"titulopdf",       'orientation'=>'landscape',  'size'=>'letter'];
  $formats['recibospagoacademias'] =    ['id'=>"idPagoRecibido",  'orientation'=>'portrait',  'size'=>'A4'];
  $formats['pagonomina'] =              ['id'=>"idEgreso",  'orientation'=>'portrait',  'size'=>'A4'];

  if(!isset($_POST['type'])){
    exit;
  }else if(!isset($formats[$_POST['type']])){
    exit;
  }
  //$_POST['params']['titulo'] .= (int)$_SERVER['CONTENT_LENGTH'];
  $format = $formats[$_POST['type']];
  if(!isset($_POST['params'][$format['id']])){
    $name = $_POST['type'];
  }else{
    $name = $_POST['type'].$_POST['params'][$format['id']];
  }

  $pdfTemplate = getPdfTemplate($_POST['type']);
  $pdfData = getPdfData($con, $_POST['type'], $_POST['params']);
  $pdfFusion = fusePdfTemplateData($pdfTemplate, $pdfData);
  moveCss($_POST['type']);
  createPdfHtml("MyPage.view.php", $pdfFusion);

/**/
require "pdfhtml/MyPage.php";
$mypage = new MyPage;
/*
$mypage->render();
/**/
$mypage->export()
->pdf(array(
  "format"=>$format['size'],
  "orientation"=>$format['orientation']
))->saveAs("pdf/".$name.".pdf");
/**/

?>
