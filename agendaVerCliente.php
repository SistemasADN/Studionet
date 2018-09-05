<?php include 'templates/topCliente.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-calendar-o"></i> </div>
    <div class="text-container"> VER AGENDA DE ALUMNO</div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="agendaVerCliente">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">EVENTO</th>
          <th class="table-column-title">TIPO</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
		  <th class="table-column-title">FECHA</th>
          <th class="table-column-title">EVENTO</th>
          <th class="table-column-title">TIPO</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(1);
        //Utilizer.makeDatepicker('fecha');
        //Utilizer.loadSelect('equipoSearch', 'equipoSelect', 'Equipo');
        //FormEngine.setFormEngine('editarEvento');
        //modalUtilities.Initialize('editarEvento');

		tableUtilities.createTable('agendaVerCliente', ['fecha', 'evento', 'equipo'], ['equipo']);
		tableUtilities.loadScript('agendaVerCliente', 'getEventoCliente', {}, agregarAgenda);
      });


	  function agregarAgenda(data){
          data.fecha = data.fechaText;
		  return data;
	  }

    </script>
