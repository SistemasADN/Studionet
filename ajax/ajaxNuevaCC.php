
<?php
if($_POST['accion']=='nuevaCartaCobro'){
  include '../queries/dbcon.php';
  include '../validation/classValidator.php';
  include '../queries/getIdSede.php';

  $cliente = $_POST['cliente'];
  $fecha = date("Y-m-d");
  $res = select_query_one($con,"SELECT rp.idReciboPago, rp.descuento, rp.fecha, rp.folio, s.nombreSede as sede, pc.nombre 
                     as cliente FROM recibo_pago as rp LEFT JOIn sedes as s ON s.idSede = rp.idSede LEFT JOIN clientes
                     as c ON c.idCliente = rp.idCliente LEFT JOIN personacompleta as pc ON pc.idPersona = c.idPersona
                     LEFT JOIN totalrecibopago as tr ON tr.idReciboPago = rp.idReciboPago WHERE rp.folio IS NOT NULL
                     AND rp.idCliente = ? AND rp.fecha = (SELECT MAX(fecha) FROM recibo_pago
                     where folio IS NOT NULL AND idCliente = ? AND s.idSede = ?)","iii",[$cliente,$cliente,$idSede]);
  
  if($res!=""){
  $dataReciboPago = select_query_one($con,"SELECT * FROM recibo_pago WHERE idReciboPago = ?","i",[$res['idReciboPago']]);
  $descuento = $dataReciboPago['descuento'];
  $idReciboPago = insert_id_query($con, "INSERT INTO recibo_pago (idCliente, fecha, descuento, idSede) VALUES (?,?,?,?)", 'isii',
  [$cliente,$fecha,$descuento,$idSede]);
  $dataReciboPagoLista = select_query($con,"SELECT * FROM recibo_pago_lista WHERE idReciboPago = ?","i",[$res['idReciboPago']]);
  foreach($dataReciboPagoLista as $data){
    $idConcepto = $data['idConcepto'];
    $idAlumno = $data['idAlumno'];
    $idAlumnoGrupo = $data['idAlumnoGrupo'];
    $cantidad = $data['cantidad'];
    $precioActual = $data['precioActual'];
    $descuento = $data['descuento'];
    $detallesCobro = $data['detallesCobro'];
    $infoCobros = $data['infoCobros'];
    if(!insert_id_query($con, "INSERT INTO recibo_pago_lista (idConcepto, idAlumno, idAlumnoGrupo, fecha, cantidad, 
                        idReciboPago, precioActual, descuento, detallesCobro, infoCobros)
                        VALUES (?,?,?,?,?,?,?,?,?,?)", "iiisiidiss",[$idConcepto,$idAlumno,$idAlumnoGrupo,
                         $fecha,$cantidad,$idReciboPago,$precioActual,$descuento,$detallesCobro,$infoCobros])){
                          echo "e|Generar Carta de cobro|Falló al generar el recibo de cobro.";
                        }
  }
  mysqli_commit($con, true);
  "s|Generar Carta de cobro|Carta de cobro Generada con exito.";
}
else{
  echo  "s|Generar Carta de cobro|No se pudo generar la Carta de cobro.";
}
}
?>
       