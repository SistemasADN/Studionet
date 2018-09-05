<?php
include "../queries/dbcon.php";
include "../validation/classValidator.php";
$disciplinasCobro =  select_query($con, "SELECT nombreDisciplina as disciplina, formaCalculo, veceshorasdias 
                     as veces, cuota FROM forma_calculos_detalle fc INNER JOIN disciplinas d ON 
                     d.idDisciplina=fc.idDisciplina INNER JOIN forma_calculos f ON f.idCalculoPagos = fc.idCalculoPagos
                     AND d.activo=1", '', []);
$cobranzaDefault = select_query_one($con, "SELECT idForma FROM formacobranzadefault", '', []);

if($_POST['accion'] == "disciplinas"){
?>
<div class="col-xl-offset-3 col-xl-6 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6">
             <table class="table table-striped table-hover table-responsive" id="listaDisciplinas">
                  <thead>
                    <tr class="success">
                      <th>#</th>
                      <th>DISCIPLINA</th>
                      <th>FORMA DE CÁLCULO</th>
                      <th>VECES</th>
                      <th>CUOTA</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                $con = 0;
                foreach ($disciplinasCobro as $res) {
                    ?>
                    <tr style="font-size: 15px">
                        <td><?=$con+1; ?></td>
                        <td style="font-size: smaller">
                           <?=$res['disciplina'];?>
                        </td>
                        <td style="font-size: smaller">
                           <?=$res['formaCalculo'];?>
                        </td>
                        <td style="font-size: smaller">
                           <?php if($res['veces']=='-1'){echo "MENSUAL";}else{echo $res['veces'];}?>
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
