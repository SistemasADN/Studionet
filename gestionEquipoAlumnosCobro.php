<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-sitemap"></i> </div>
    <div class="text-container"> GESTIONAR COBROS DE ALUMNOS </div>
  </div>
  <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
      <button type="button" onClick = 'location.href = "perfilConfiguracionPagos.php";' class="btn btn-save">CONFIGURACIÓN COBRANZA</button>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container" id="equipoContainer">
    Seleccione el equipo que cada alumno puede usar para generar su cobranza.
    <table class="table table-hover table-responsive" id="equiposVer">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">ALUMNO</th>
          <th class="table-column-title">EQUIPO</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">ALUMNO</th>
          <th class="table-column-title">EQUIPO</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <!-- Modal Edit -->
  <?php include 'templates/bottom.php'; ?>
    <script>
        $(document).ready(function () {
            tableUtilities.createTable('equiposVer', ['alumno', 'acciones']);
            loadTable();
        });
        function loadTable(){
          tableUtilities.loadScript('equiposVer', 'getAlumnosEquiposCobro', {}, agregarAlumno);
        }
        function agregarAlumno(data){
          data.buttons = [];
          var i, color;
          for(var i = 0;i<data.equipos.length;i++) {
            if(data.equipos[i].usarCobro===0){
                color = "btn-cancel";
            }else{
                color = "btn-accept";
            }
            data.buttons.push([data.equipos[i].nombreEquipo, 'editar'+data.equipos[i].nombreEquipo.replace(/\s/g, '')+" "+color, usarEquipo]);
          }
          return data;
        }

        function usarEquipo(){
          var data = tableUtilities.getDataFromEvent(event), text = $(event.target).text().trim();
          for(var i = 0;i<data.equipos.length;i++) {
            if(data.equipos[i].nombreEquipo==text){
              Utilizer.sendData('changeAlumnosEquipoCobro', {
                idAlumno:data.idAlumno,
                idEquipo:data.equipos[i].idEquipo
              },loadTable);
              break;
            }
          }
        }
    </script>
