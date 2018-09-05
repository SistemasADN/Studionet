<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-list"></i> </div>
    <div class="text-container"> REPORTE DE ALUMNOS </div>
  </div>

  <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
      <button type="button" onClick = 'location.href = "perfilConfiguracionPagos.php";' class="btn btn-save">CONFIGURACIÓN COBRANZA</button>
  </div>
  <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
      <button type="button" onClick = 'location.href = "administracionRecibosCobroVer.php";' class="btn btn-save">VER CARTAS DE COBRO</button>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="alumnosVer" data-pdf = true data-csv = true data-copy = true data-xls = true data-titulo = "Reporte Alumnos" >
      <thead>
        <tr class="table-header">
          <th class="table-column-title ordenar" data-order='1' data-order-dir = 'asc'>CLIENTE</th>
          <th class="table-column-title ordenar" data-order='0' data-order-dir = 'asc'>ALUMNO</th>
          <th class="table-column-title ordenar" data-order='2' data-order-dir = 'asc'>GRUPOS INSCRITOS ACTUALMENTE</th>
        <!--  <th class="table-column-title">TOTAL MENSUAL</th> -->
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">CLIENTE</th>
          <th class="table-column-title">ALUMNO</th>
          <th class="table-column-title">GRUPOS INSCRITOS ACTUALMENTE</th>
      <!--    <th class="table-column-title">TOTAL MENSUAL</th> -->
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>



  <div class="modal fade" tabindex="-1" role="dialog" id="modalAlumnoHistorico">
    <div class="modal-dialog" role="document" style = 'width:82%;margin-left:17%;'>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span></button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-users"></i> </div>
            <div class="text-container"> HISTORICO DE ALUMNO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container">
            <label class='label-right col-xs-4 col-sm-4 col-md-4'>NOMBRE ALUMNO: </label>
            <input class='col-xs-8 col-sm-8 col-md-8' disabled id='nombreAlumno' />
          </div>
            <input type = 'hidden' id='idAlumno' />
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="jumbotron jumbotron-container">
              <div class="jumbotron-text"> <abbr title = 'Puede borrar un registro si no existe una Carta de Cobro que tenga como concepto esta clase (Aprobada o por aprobar) y si es por lo menos un Administrador Senior'>LISTA DE GRUPOS</abbr> </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <table class="table table-hover table-responsive" id="alumnosVerHistorico">
                <thead>
                  <tr class="table-header">
                    <th class="table-column-title">GRUPO</th>
                    <th class="table-column-title">NIVEL - CLASE</th>
                    <th class="table-column-title">PROFESOR</th>
                    <th class="table-column-title">FECHA ALTA</th>
                    <th class="table-column-title">FECHA BAJA</th>
                    <th class="table-column-title">ACTIVO</th>
                    <th class="table-column-title">ACCIONES</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr class="table-header">
                    <th class="table-column-title">GRUPO</th>
                    <th class="table-column-title">NIVEL - CLASE</th>
                    <th class="table-column-title">PROFESOR</th>
                    <th class="table-column-title">FECHA ALTA</th>
                    <th class="table-column-title">FECHA BAJA</th>
                    <th class="table-column-title">ACTIVO</th>
                    <th class="table-column-title">ACCIONES</th>
                  </tr>
                </tfoot>
                <tbody> </tbody>
              </table>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer"> </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php include 'templates/bottom.php'; ?>
    <script>
      var calculoInfo = {};

      $(document).ready(function () {

        $("#cobranzaMensual").click(function (){
          Utilizer.sendData('generarCargosRecurrentes', {});
        });


        //Csser.collapse(2, 1);
        //tableUtilities.createTable('alumnosVer', ['nombreAlumno', 'nombreEquipo', 'nombreCliente', 'gruposInscritos', 'totalCostoMensual', 'acciones'], ['nombreCliente']);
        tableUtilities.createTable('alumnosVer', ['nombreCliente', 'nombreAlumno', 'gruposInscritos', 'acciones'],
        ['nombreCliente']);
        tableUtilities.setUniqueColumns('alumnosVer', ['idAlumno']);

        tableUtilities.createTable('alumnosVerHistorico', ['nombreGrupo', 'nivelAsignatura', 'nombreProfesor', 'fechaAlta', 'fechaBaja',
         'activo', 'acciones'], ['nombreGrupo', 'nombreProfesor', 'activo']);
        tableUtilities.setUniqueColumns('alumnosVerHistorico', ['idGrupo']);
        /**/
        Utilizer.getResponse('getCalculoInfo', {}, loadTable);
        //tableUtilities.loadScript('alumnosVer', 'getAlumnoReporte', {}, agregarAlumno);

        function loadTable(data){
            calculoInfo = data;
            tableUtilities.loadScript('alumnosVer', 'getAlumnoReporte', {}, agregarAlumno);
        }
      });

      function agregarAlumno(data) {
       // console.log(calculoInfo);
        if (data.ca != null) {
          data.nombreCliente += ' (Alumno es cliente)';
        }
        data.totalCostoMensual = 0;
        var pagos = {};
        var abc = Utilizer.generateTextoCalculoPagos(data.grupos, calculoInfo);
        pagos.txt = abc.txt;
        pagos.total = abc.total
        data.gruposInscritos = pagos.txt;
        data.totalCostoMensual = pagos.total;
        data.buttons = [];
        data.buttons.push(["Historico Alumno", "btn-detail", verHistorico]);
        return data;
      }

      function verHistorico(event) {
        var data = tableUtilities.getDataFromEvent(event);//console.log(data);
        $("#nombreAlumno").val(data.nombreAlumno);
        $("#idAlumno").val(data.idAlumno);
        tableUtilities.loadScript('alumnosVerHistorico', 'getAlumnoHistorico', {idAlumno:data.idAlumno}, agregarHistorico);
        $("#modalAlumnoHistorico").modal('show');
      }

      function agregarHistorico(data){
          data.buttons = [];
          if(data.borrable===0){
            data.buttons.push(['Borrar', 'btn-delete', borrarHistorico]);
          }
          data.activo = data.fechaBaja===null?'ACTIVO':'INACTIVO';
          return data;
      }

      function borrarHistorico(event){
        var data = tableUtilities.getDataFromEvent(event);//console.log(data);
        Utilizer.sendData('borrarAlumnoHistorico', {idAlumnoGrupo:data.idAlumnoGrupo}, reloadTable);
      }

      function reloadTable(){
            tableUtilities.loadScript('alumnosVer', 'getAlumnoReporte', {}, agregarAlumno);
            tableUtilities.loadScript('alumnosVerHistorico', 'getAlumnoHistorico', {idAlumno:$("#idAlumno").val()}, agregarHistorico);
      }
      /**/
    </script>
