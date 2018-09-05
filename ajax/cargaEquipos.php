<?php
include_once "../queries/dbcon.php";
include_once "../validation/classValidator.php";
$equiposCobro =  select_query($con, "SELECT nombreEquipo, cuota FROM forma_calculos_detalle fc INNER JOIN equipos e ON e.idEquipo = fc.idEquipo", '', []);
$cobranzaDefault = select_query_one($con, "SELECT idForma FROM formacobranzadefault", '', []);
if($_POST['accion'] == "equipos"){
?>
<div class="col-xl-offset-3 col-xl-6 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6">
             <table class="table table-striped table-hover table-responsive" id="listaEquipos">
                  <thead>
                    <tr class="success">
                      <th>#</th>
                      <th>EQUIPO</th>
                      <th>CUOTA MENSUAL</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                $con = 0;
                foreach ($equiposCobro as $res) {
                    ?>
                    <tr style="font-size: 15px">
                        <td><?=$con+1; ?></td>
                        <td style="font-size: smaller">
                           <?=$res['nombreEquipo'];?>
                        </td>
                        <td style="font-size: smaller">
                           <?=$res['cuota'];?>
                        </td>
                    </tr>
                    <?php
                    $con++;
                }
                ?>
                </tbody>
                  </tbody>
                </table>   
        </div>
<?php }
?>