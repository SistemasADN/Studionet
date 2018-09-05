<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $menus[''] = [
    [
      "href"=>'',
      "icon"=>'',
      "text"=>'',
      "list"=>[
        ["href"=>'', "text"=>'']
      ]
    ],
  ];
?>
<script>
  $(document).ready(function () {
    $("#barReportes").addClass('is-selected');
  });
</script>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"><?php
  <!-- Ver Reportes Administrativos Start -->

    <button class="panel-heading catalogo" data-parent="#accordion" data-toggle="collapse" href="#collapse11" type="button" data-toggle="collapse" aria-expanded="false">

         <i class="fa fa-bar-chart"></i> </div>
        ', "text"=>' REPORTES ADMINISTRATIVOS </div>
      </div>
    </button>
    1One">

        <div class="list-group">
          <a href="./reportesAdministrativosEstadoCliente.php">
            <button type="button" class="list-group-item">
              <div class="textaction"> ESTADO DE CUENTA CLIENTE </div>
            </button>
          </a>
          <a href="./reportesAdministrativosEstadoEmpresa.php">
            <button type="button" class="list-group-item">
              <div class="textaction"> ESTADO DE CUENTA EMPRESA </div>
            </button>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- End Reportes Administrativos Menu -->
  <!-- Ver Reportes Operativos Start -->

    <button class="panel-heading catalogo" data-parent="#accordion" data-toggle="collapse" href="#collapse22" type="button" data-toggle="collapse" aria-expanded="false">

         <i class="fa fa-list-ul"></i> </div>
        ', "text"=>' REPORTES OPERATIVOS </div>
      </div>
    </button>
    2Two">

        <div class="list-group">
          <a href="./reportesOperativosAlumnos.php">
            <button type="button" class="list-group-item">
              <div class="textaction"> REPORTE DE ALUMNOS </div>
            </button>
          </a>
          <a href="./reportesOperativosEquipos.php">
            <button type="button" class="list-group-item">
              <div class="textaction"> REPORTE DE EQUIPOS </div>
            </button>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- End Reportes Operativos Menu -->
</div>
<!-- Accordion End -->
