<?php include 'templates/topCliente.php'; ?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
  <div class="logo-container"> <i class="fa fa-list"></i> </div>
  <div class="text-container"> REPORTE DE ALUMNOS </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
  <table class="table table-hover table-responsive" id="alumnosVer">
    <thead>
      <tr class="table-header">
        <th class="table-column-title">ALUMNO</th>
        <th class="table-column-title">CLIENTE</th>
        <th class="table-column-title">GRUPOS INSCRITOS ACTUALMENTE</th>
        <th class="table-column-title">TOTAL MENSUAL</th>
        <th class="table-column-title">ACCIONES</th>
      </tr>
    </thead>
    <tfoot>
      <tr class="table-header">
        <th class="table-column-title">ALUMNO</th>
        <th class="table-column-title">CLIENTE</th>
        <th class="table-column-title">GRUPOS INSCRITOS ACTUALMENTE</th>
        <th class="table-column-title">TOTAL MENSUAL</th>
        <th class="table-column-title">ACCIONES</th>
      </tr>
    </tfoot>
    <tbody> </tbody>
  </table>
</div>
<!-- Modal Alumno Historico -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalAlumnoHistorico">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
          <i class="fa fa-times-circle"></i>
        </span> </button>
      </div>
      <div class="modal-body">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
          <div class="logo-container"> <i class="fa fa-users"></i> </div>
          <div class="text-container"> HISTORICO DE ALUMNO </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <label class='label-right col-xs-4 col-sm-4 col-md-4'>NOMBRE ALUMNO: </label>
          <input class='col-xs-8 col-sm-8 col-md-8' disabled id='nombreAlumno' /> </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> HISTORICO DE GRUPOS </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
          <fieldset>
            <table class="table table-hover table-responsive" id="alumnosVerHistorico">
              <thead>
                <tr class="table-header">
                  <th class="table-column-title">GRUPO</th>
                  <th class="table-column-title">PROFESOR</th>
                  <th class="table-column-title">FECHA ALTA</th>
                  <th class="table-column-title">FECHA BAJA</th>
                </tr>
              </thead>
              <tfoot>
                <tr class="table-header">
                  <th class="table-column-title">GRUPO</th>
                  <th class="table-column-title">PROFESOR</th>
                  <th class="table-column-title">FECHA ALTA</th>
                  <th class="table-column-title">FECHA BAJA</th>
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
  $(document).ready(function () {
    //Csser.collapse(1);
    //tableUtilities.createTable('alumnosVer', ['nombreAlumno', 'nombreEquipo', 'nombreCliente', 'gruposInscritos', 'totalCostoMensual', 'acciones'], ['nombreCliente']);
    tableUtilities.createTable('alumnosVer', ['nombreAlumno', 'nombreCliente', 'gruposInscritos', 'totalCostoMensual', 'acciones']);
    tableUtilities.setUniqueColumns('alumnosVer', ['idAlumno']);
    tableUtilities.loadScript('alumnosVer', 'getAlumnoReporteCliente', {
      idCliente: Number(<?php echo $_SESSION['idUsuario']; ?>)
    }, agregarAlumno);
    tableUtilities.createTable('alumnosVerHistorico', ['nombreGrupo', 'nombreProfesor', 'fechaAlta', 'fechaBaja'], ['nombreGrupo', 'nombreProfesor']);
    tableUtilities.setUniqueColumns('alumnosVerHistorico', ['idGrupo']);

    function agregarAlumno(data) {
      var i, actual;
      if (data.ca != null) {
        data.nombreCliente += ' (Alumno es cliente)';
      }
      data.gruposInscritos = "";
      data.totalCostoMensual = 0;
      for (var i = 0; i < data.grupos.length; i++) {
        actual = data.grupos[i];
        if (actual.fechaBaja === null) {
          data.gruposInscritos += actual.nombreGrupo + " - " + actual.nombreProfesor + " (" + Utilizer.numberToCoin(actual.precio) + ")";
          data.totalCostoMensual += Number(actual.precio);
          if (i != data.grupos.length - 1) {
            data.gruposInscritos += "<br>";
          }
        }
      }
      //console.log(data);
      data.buttons = [["Historico Alumno", "btn-detail", verHistorico]];
      return data;
    }
  });

  function verHistorico(event) {
    var data = tableUtilities.getDataFromEvent(event);
    tableUtilities.clearTable('alumnosVerHistorico');
    $("#nombreAlumno").val(data.nombreAlumno);
    data = data.grupos;
    for (var i = 0; i < data.length; i++) {
      tableUtilities.addRow('alumnosVerHistorico', data[i]);
    }
    tableUtilities.draw('alumnosVerHistorico');
    $("#modalAlumnoHistorico").modal('show');
  }
</script>