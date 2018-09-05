<?php
  function createPdfHtml($name, $pdf){
      /*
      if(!isset($_POST['www'])){
        echo $pdf;exit;
      }
      */
      try {
        $writtenFile = fopen("pdfhtml/".$name, 'w');
        //echo "File oppened. <br>";
        fwrite($writtenFile, $pdf);
        //echo "File written into. <br>";
        fclose($writtenFile);
        //echo "File closed. <br>";
      } catch (Exception $e) {
          echo "Error: No se pudo crear [".$name.".html] ".$e->getMessage();
      }
      /**/
  }

  function moveCss($name){
    copy("css/".$name.".css", "pdfhtml/".$name.".css");
  }

 function fusePdfTemplateData($template, $data){
   //echo "fusePdfTemplateData"; var_dump($template); var_dump($data);
   if(isset($data['pdf_error'])&&count($data['pdf_error'])>0){
     var_dump($data['pdf_error']);
     exit;
   }

   foreach($data as $key =>$value){
     if(is_array($value)){
       //echo "KEY";var_dump($key);echo"VALUE";var_dump($value);
       if(count($value)==0){
         continue;
       }

       if($value['type']=="table"){ //TABLA//TABLA//TABLA//TABLA//TABLA//TABLA//TABLA//TABLA
         if(!isset($value[0])){ //Si no hay datos en la tabla
           continue;
         }
       //var_dump($value);echo $key;echo "[*".$key."*]";
        $inicio = strpos($template, "[*".$key."*]");
        $fin = strpos($template, "[/*".$key."*]");
        //var_dump($inicio);var_dump($fin);
        $sub_template_snapshot = substr($template, $inicio+strlen("[*".$key."*]"), $fin-$inicio-strlen("[*".$key."*]"));
        //echo htmlspecialchars($sub_template_snapshot)."<br><br>";
        $final_sub_template = $sub_template_snapshot;

          //CREACION DE HEADER
          //Grab header text
          //$sub_template_header = substr($sub_template_snapshot, strpos($sub_template_snapshot, "<thead>")+strlen("<thead>"), strpos($sub_template_snapshot, "</thead>"));
          //echo $sub_template_header;
          //Crear lista de headers
          $header_list = [];

          foreach($value[0] as $k=>$v){ //var_dump($key."_".$k);var_dump($v);
            $pos = strpos($sub_template_snapshot, "[*".$key."_".$k."*]"); //Posición del elemento en el header
            if($pos!==false){ //Si el elemento está en el header
                $header_list[$pos]['key']   = $key."_".$k;
                $header_list[$pos]['clean_key']   = $k;
                $header_list[$pos]['show']  = false;
                //Por cada header que sí existe
                foreach($value as $vk=>$vv){ //Iterar dentro de datos para ver si mostrarlo o no
                  if($vk==='type'){ //Saltar type
                    continue;
                  }
                  if($vv[$k]!==null){//Si el elemento no es nulo
                    $header_list[$pos]['show'] = true;
                    break;
                  }
                }
            }
          }

          //Ordenar por aparicion
          ksort($header_list);

          $fin_sub_template = 0;
          $replace_list = [];
          //Sacar lista de reemplazo
          foreach($header_list as $pos=>$current_header){//var_dump($current_header);var_dump($final_sub_template);
            $inicio_sub_template = strpos($final_sub_template, "[*".$current_header['key']."*]", $fin_sub_template);
            $fin_sub_template = strpos($final_sub_template, "</th>", $inicio_sub_template)-$inicio_sub_template+strlen("</th>");

            if($current_header['show']){//Si se muestra quitar llave
               $substring = "[*".$current_header['key']."*]";
            }else{//Si no se muestra se quita todo
                $substring = substr($sub_template_snapshot, $inicio_sub_template, $fin_sub_template);
            }
            $replace_list[] = $substring;
          }

          foreach($replace_list as $k=>$replace){//Quitamos todo dentro de la lista de reemplazo
            $final_sub_template = str_replace($replace, "", $final_sub_template);
          }
          $template = str_replace($sub_template_snapshot, $final_sub_template, $template);
          //CREACION DE BODY
          //Snapshot
          $sub_template_body_snapshot = substr($sub_template_snapshot, strpos($sub_template_snapshot, "<tbody>"), strpos($sub_template_snapshot, "</tbody>")+strlen("</tbody>")-strpos($sub_template_snapshot, "<tbody>"));
          //Contenido
          $sub_template_body = "<tbody>";
          foreach($value as $value_key=>$value_value){ //Iterar dentro de datos para ver si mostrarlo o no
            if($value_key==='type'){ //Saltar type
              continue;
            }
            $sub_template_body .= "<tr>";
            foreach($header_list as $pos=>$current_header){
              if($current_header['show']){
                if(isset($value_value[$current_header['clean_key']])){
                  $sub_template_body .= "<td>".$value_value[$current_header['clean_key']]."</td>";
                }else{
                  $sub_template_body .= "<td>NOT FOUND: ".$current_header['clean_key']."</td>";
                }
              }
            }
            $sub_template_body .= "</tr>";
          }
          $sub_template_body .= "</tbody>";
          //TYPE ES TABLA
        }else if($value['type']=="template"){//TEMPLATE TEMPLATE TEMPLATE TEMPLATE TEMPLATE TEMPLATE TEMPLATE TEMPLATE TEMPLATE TEMPLATE TEMPLATE TEMPLATE
          //Checar si tiene o no SHOW echo "ES UN TEMPLATE";
          $pos_final = 0;
          while($pos_inicial = strpos($template, "[-".$key."-]", $pos_final)){
            //echo "INICIAL";var_dump($pos_inicial);
            $pos_final = strpos($template, "[/-".$key."-]", $pos_inicial);
            //echo "FINAL";var_dump($pos_final);
            $sub_template_snapshot = substr($template, $pos_inicial, $pos_final-$pos_inicial+strlen("[/-".$key."-]"));
            //echo "<br>";echo htmlspecialchars($sub_template_snapshot);echo "<br>";
            $sub_template_body = "body???";
            $sub_template_body_snapshot = "snapshot???";

            if($value===null){
              $template = str_replace($sub_template_snapshot, "", $template);
            }else{
              if(!isset($value[0])){
                $sub_template = "";
              }else{
                $sub_template = str_replace("[-".$key."-]", "", $sub_template_snapshot);
                $sub_template = str_replace("[/-".$key."-]", "", $sub_template);
              }
              //echo "BEFORE";var_dump($template);
              $template = str_replace($sub_template_snapshot, $sub_template, $template);
              //echo "AFTER";var_dump($template);
            }

            if($pos_final>strlen($template)){
              $pos_final = strlen($template);
            }
          }//END DEL WHILE

          $pos_inicial = strpos($template, "[*".$key."*]", 0);
          $pos_final = strpos($template, "[/*".$key."*]", 0);
          $sub_template = substr($template, $pos_inicial+strlen("[*".$key."*]"), $pos_final-$pos_inicial-strlen("[/*".$key."*]"));

          $final_sub_template = "";
          foreach($value as $k=>$row){
            if($k!=='type'){
              $temp_sub_template = $sub_template;
              foreach($row as $row_key => $row_value){
                $temp_sub_template = str_replace("[*".$key."_".$row_key."*]", $row_value, $temp_sub_template);
              }
              $final_sub_template .= $temp_sub_template;
            }
          }
          if(!isset($value[0])){//This may cause a bug
            $sub_template = "";
          }
          //var_dump($sub_template);var_dump($final_sub_template);echo "BEFORE";var_dump($template);
          $template = str_replace($sub_template, $final_sub_template, $template);
          //echo "AFTER";var_dump($template);
          //TYPE ES TEMPLATE
          /*
          echo "VALUE";
          var_dump($value);
          exit;
          /**/
        }else{
          echo "Type [".$value['type']."] no existe";
        }

        if($value['type']=="table"){ //This may cause a bug?
          //var_dump($sub_template_body_snapshot);var_dump($sub_template_body);
          $template = str_replace($sub_template_body_snapshot, $sub_template_body, $template);
        }
        $template = str_replace ("[*".$key."*]", "", $template);
        $template = str_replace ("[/*".$key."*]", "", $template);

     }else{//SI NO ES TABLA o TEMPLATE
       //Checar si tiene o no SHOW
       $pos_final = 0;
       while($pos_inicial = strpos($template, "[-".$key."-]", $pos_final)){
         //echo "INICIAL";var_dump($pos_inicial);
         $pos_final = strpos($template, "[/-".$key."-]", $pos_inicial);
         //echo "FINAL";var_dump($pos_final);
         $sub_template_snapshot = substr($template, $pos_inicial, $pos_final-$pos_inicial+strlen("[/-".$key."-]"));
         //echo "<br>";echo htmlspecialchars($sub_template_snapshot);echo "<br>";
         if($value===null){
           $template = str_replace($sub_template_snapshot, "", $template);
         }else{
           $sub_template = str_replace("[-".$key."-]", "", $sub_template_snapshot);
           $sub_template = str_replace("[/-".$key."-]", "", $sub_template);
           $template = str_replace($sub_template_snapshot, $sub_template, $template);
         }
         if($pos_final>strlen($template)){
           $pos_final = strlen($template);
         }
       }

       $template = str_replace ("[*".$key."*]", $value, $template);
     }
   }
   //echo $template;exit;
   //var_dump($template);

   return $template;
 }

 function getpdfTemplate($pdf){
   //echo "getpdfTemplate"; var_dump($pdf);
   $handler = fopen("template/".$pdf.".html", "r");
   $template = "";
   while($line = fgets($handler)){
     $template .= $line;
   }
   return $template;
 }

 function getPdfData($con, $pdf, $params){
   //echo "getPdfData"; var_dump($pdf); var_dump($params);
  // var_dump($params);
    $data['pdf_error'] = [];
    switch($pdf){
      case "tablafiltrada":
          $data = $params;
          $data['header']['type'] = "template";
          $data['info']['type'] = "table";
          $data['filtros']['type'] = "template";
          //var_dump($data);exit;
          /*
          $data['titulo'] = "Gallinero";

          $data['header']['type'] = "template";

          $data['header'][0]['titulo'] = "Pollo";
          $data['header'][0]['key'] = "pollo";

          $data['header'][1]['titulo'] = "Gallo";
          $data['header'][1]['key'] = "gallo";

          $data['filtros']['type'] = "template";
          $data['filtros'][0]['nombre'] = "Clave";
          $data['filtros'][0]['valor'] = "A01061360";
          $data['filtros'][1]['nombre'] = "Fecha";
          $data['filtros'][1]['valor'] = "21/10/2017";

          $data['info']['type'] = "table";

          $data['info'][0]['pollo'] = "A";
          $data['info'][0]['gallo'] = "B";

          $data['info'][1]['pollo'] = "C";
          $data['info'][1]['gallo'] = "D";
          */
      break;
      case "listaalumnos":
            if(!isset($params['idGrupo'])){
                $data['pdf_error'][] = "No existe el parametro ['idGrupo']";
            }else{
                $data = select_query_one ($con,
                "SELECT g.nombreGrupo as grupo, gp.*,  pc.nombreProfesor as profesorPrincipal, a.nombreAsignatura as clase, g.numMaxAlumnos
                FROM grupos as g
                LEFT JOIN grupo_profesor as gp ON gp.principal = 1 AND  gp.idGrupo = g.idGrupo AND gp.fechaBaja IS NULL
                LEFT JOIN profesorcompleto as pc ON pc.idPersonal = gp.idProfesor
                LEFT JOIN asignaturas as a ON a.idAsignatura = g.idAsignatura
                 WHERE g.idGrupo = ?",
                 'i', [$params['idGrupo']]);

                 $data['listaAlumnos'] = select_query ($con,
                 "SELECT DATE_FORMAT(ag.fechaAlta, '%d/%m/%Y') as fechaAlta, pc.nombre as alumno
                 FROM alumnos_grupos AS ag
                 LEFT JOIN alumnos AS a ON a.idalumno = ag.idalumno
                 LEFT JOIN personacompleta AS pc ON pc.idpersona = a.idpersona
                 WHERE ag.idgrupo = ? ORDER BY pc.nombre ASC","i",[$params['idGrupo']]);

                 for($i = 1; $i<=count($data['listaAlumnos']);$i++){
                   $data['listaAlumnos'][$i-1]['num'] = $i;
                 }

                 $data['alumnosInscritos'] = count($data['listaAlumnos']);
                 $data['listaAlumnos']['type'] = 'table';
            }
      break;
      case "recibospagoacademias":
        if(!isset($params['idPagoRecibido'])){
          $data['pdf_error'][] = "No existe el parametro ['idPagoRecibido']";
        }else{
          $data = select_query_one($con,
          "SELECT DATE_FORMAT(pr.fecha, '%d/%m/%Y') as fecha, pr.folio, pr.cantidad as monto, s.nombreSede as sede,
           pc.nombre as cliente, fp.formaPago, pr.concepto as descripcionConcepto
           FROM pagos_recibidos as pr
           LEFT JOIN sedes as s ON pr.idSede = s.idSede
           LEFT JOIN clientes as c ON pr.idCliente = c.idCliente
           LEFT JOIN personacompleta as pc ON pc.idPersona = c.idPersona
           LEFT JOIN forma_pago as fp ON fp.idFormaPago = pr.idFormaPago
            WHERE pr.idPagoRecibido = ?",
             'i', //Por cada signo de ? tiene que haber una letra i para enteros, d para decimales y s para strings (todo lo demás)
              [$params['idPagoRecibido']] //Por cada parametro ? tiene que haber un elemento en el arreglo (El orden de como están en el arreglo es como se ponen en la "query")
            );
            $data['monto'] = numberToCoin($data['monto']);

            //$data['folio'] = "1";
        }
      break;
      case 'pagonomina':
            if(!isset($params['idEgreso'])){
              $data['pdf_error'][] = "No existe el parametro ['idEgreso']";
            }else{
              $data = select_query_one($con,
              "SELECT ep.idEgreso, DATE_FORMAT(e.fecha, '%d/%m/%y') as fecha, ep.folio, pc.nombre as personal,
              tp.tipo as tipoPersonal, DATE_FORMAT(ep.fechaInicio, '%d/%m/%y') as inicioPeriodoPago,
              DATE_FORMAT(ep.fechaFin, '%d/%m/%y') as finPeriodoPago, datediff(ep.fechaFin, ep.fechaInicio) as periodoPagoDias,
               fp.formaPago, e.cantidad as monto, e.concepto, mp.modalidad as modalidadPago
              FROM egresos_personal as ep
              LEFT JOIN egresos as e ON e.idEgreso = ep.idEgreso
              LEFT JOIN forma_pago as fp ON fp.idFormaPago = e.idFormaPago
              LEFT JOIN personal as p ON p.idPersonal = ep.idPersonal
              LEFT JOIN modalidad_pago as mp ON mp.idModalidadPago = ep.idModalidadPago
              LEFT JOIN personacompleta as pc ON p.idPersona = pc.idPersona
              LEFT JOIN tipo_personal as tp ON tp.idTipoPersonal = p.idTipoPersonal
              WHERE e.idEgreso = ?",
                 'i', //Por cada signo de ? tiene que haber una letra i para enteros, d para decimales y s para strings (todo lo demás)
                  [$params['idEgreso']] //Por cada parametro ? tiene que haber un elemento en el arreglo (El orden de como están en el arreglo es como se ponen en la "query")
                );
              $data['monto'] = numberToCoin($data['monto']);
            }
      break;
      case "cartacobro":
            if(!isset($params['idReciboPago'])){
              $data['pdf_error'][] = "No existe el parametro ['idReciboPago']";
            }else{
              $data = select_query_one($con,
              "SELECT
              DATE_FORMAT(rp.fecha, '%d/%m/%Y') as fecha, pc.nombre as cliente, rp.folio, s.nombreSede as sede, rp.descuento
              FROM recibo_pago as rp
              LEFT JOIN sedes as s ON s.idSede = rp.idSede
              LEFT JOIN clientes as c ON c.idCliente = rp.idCliente
              LEFT JOIN personacompleta as pc ON pc.idPersona = c.idPersona
              WHERE idReciboPago = ?", 'i', [$params['idReciboPago']]);
              $data['subtotal'] = 0;
              $data['conceptos'] = select_query($con,
              "SELECT rpl.cantidad, rpl.precioActual as precio, rpl.descuento, c.nombreConcepto as concepto
              FROM recibo_pago_lista as rpl
              LEFT JOIN conceptos as c ON c.idConcepto = rpl.idConcepto
              WHERE idReciboPago = ?", 'i', [$params['idReciboPago']]);
              $data['conceptos']['type'] = "table";
              foreach($data['conceptos'] as $key => $concepto){
                if($key==="type"){
                  continue;
                }
                $data['conceptos'][$key]['subtotal'] = $concepto['cantidad']*$concepto['precio'];
                $data['conceptos'][$key]['total'] = $data['conceptos'][$key]['subtotal']*(1-$concepto['descuento']/100);
                $data['subtotal'] += $data['conceptos'][$key]['total'];

                $data['conceptos'][$key]['precio'] = numberToCoin($data['conceptos'][$key]['precio']);
                $data['conceptos'][$key]['descuento'] = numberToPer($data['conceptos'][$key]['descuento']);
                $data['conceptos'][$key]['subtotal'] = numberToCoin($data['conceptos'][$key]['subtotal']);
                $data['conceptos'][$key]['total'] = numberToCoin($data['conceptos'][$key]['total']);

              }
              $data['totalPagar'] = $data['subtotal']*(1-$data['descuento']/100);


              $data['descuento'] = numberToPer($data['descuento']);
              $data['subtotal'] = numberToCoin($data['subtotal']);
              $data['totalPagar'] = numberToCoin($data['totalPagar']);
            }
      break;
      default:
        $data['pdf_error'][] = "No existe un template de datos para un pdf con nombre [".$pdf."]";
      break;
    }
    return $data;
  }

 function runDomPDF ($name, $dompdf, $orientation = 'portrait'){
   //DOM PDF MAGIC
   $contents = file_get_contents('pdfhtml/'.$name.'.html');
   $dompdf->loadHtml($contents);
   $dompdf->setPaper('letter',$orientation);
   // Render the HTML as PDF
   $dompdf->render();
   // Output the generated PDF to Browser
   file_put_contents('pdf/'.$name.'.pdf', $dompdf->output());
 }

 function numberToCoin($num){
   return "$".number_format((float)$num, 2, '.', ',');
 }

 function numberToPer($num){
   return $num."%";
 }

 function numberToCoinNull($num){
   if($num==0){
     return null;
   }else{
     return numberToCoin($num);
   }
 }

 function numberToPerNull($num){
   if($num==0){
     return null;
   }else{
     return numberToPer($num);
   }
 }
?>
