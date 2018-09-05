<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-list"></i> </div>
    <div class="text-container"> REPORTE DE EQUIPOS </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="equipoVer">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">EQUIPO</th>
		  <th class="table-column-title"># ALUMNOS</th>
          <th class="table-column-title">PROFESOR</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">EQUIPO</th>
		  <th class="table-column-title"># ALUMNOS</th>
          <th class="table-column-title">PROFESOR</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <!-- Modal Edit -->
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
            <div class="text-container"> LISTA DE ALUMNOS DE EQUIPO </div>
          </div>
		             
		  <div class="col-xs-12 col-sm-12 col-md-12 input-container">
			<label class='label-right col-xs-4 col-sm-4 col-md-4'>NOMBRE EQUIPO: </label>
            <input class = 'col-xs-8 col-sm-8col-md-8' disabled id = 'nombreEquipo'/>
			
		  </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <table class="table table-hover table-responsive" id="equipoVerAlumnos">
			  <thead>
				<tr class="table-header">
				  <th class="table-column-title">ALUMNO</th>
				  <th class="table-column-title">FECHA ALTA</th>
				</tr>
			  </thead>
			  <tfoot>
				<tr class="table-header">
				  <th class="table-column-title">ALUMNO</th>
				  <th class="table-column-title">FECHA ALTA</th>
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
        //Csser.collapse(2,2);
        tableUtilities.createTable('equipoVer', ['nombreEquipo', 'numAlumnos', 'nombreProfesor', 'acciones']);
        tableUtilities.setUniqueColumns('equipoVer', ['idAlumno']);
        tableUtilities.loadScript('equipoVer', 'getEquipoReporte', {}, agregarAlumno);

		tableUtilities.createTable('equipoVerAlumnos', ['nombreAlumno', 'fechaAlta']);
        tableUtilities.setUniqueColumns('equipoVerAlumnos', ['idAlumno']);
		
		
        function agregarAlumno(data) {
		  data.numAlumnos = data.alumnos.length;
          data.buttons = [["Lista de alumnos", "btn-detail", verLista]];
          return data;
        }
      });

      function verLista(event) {
        var data = tableUtilities.getDataFromEvent(event);
		tableUtilities.clearTable('equipoVerAlumnos');
		$("#nombreEquipo").val(data.nombreEquipo);
		data = data.alumnos;
		for(var i = 0;i<data.length;i++){
			tableUtilities.addRow('equipoVerAlumnos', data[i]);
		}
		tableUtilities.draw('equipoVerAlumnos');
		$("#modalAlumnoHistorico").modal('show');
      }
    </script>