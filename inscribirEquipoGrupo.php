<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-plus-circle"></i> </div>
    <div class="text-container"> INSCRIBIR EQUIPO A GRUPO</div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DATOS DE INSCRIPCIÓN </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input" data-live-search="false" data-label="Equipo" id="idEquipo" name='Equipo'> </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input" data-live-search="false" data-label="Grupo" id="idGrupo" name='Grupo'> </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" id="inscribir">Guardar</button>
        </div>
      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(3);
        Utilizer.makeDatepicker('fechaSelect');
        Utilizer.loadSelect('idEquipo', 'equipoInscribirSelect', 'Equipo');
        Utilizer.loadSelect('idGrupo', 'grupoInscribirSelect', 'Grupo');
        $("#inscribir").click(function () {
          var selE = Utilizer.getSelected('idEquipo')
            , selG = Utilizer.getSelected('idGrupo')
            , data = {}
            , txt = "";
          data.idGrupo = $("#idGrupo").val();
          data.idEquipo = $("#idEquipo").val();
          if (data.idGrupo === null) {
            txt += "Debe seleccionar un grupo. ";
          }
          if (data.idEquipo === null) {
            txt += "Debe seleccionar un equipo. ";
          }
          if (txt == "") {
            Utilizer.sendData('inscribirEquipoGrupo', data, afterEdit);
          }
          else {
            Messager.addAlertText('Advertencia', 'Para continuar: ' + txt, 'w');
          }
        });
      });

      function afterEdit(data, extra) {
        Utilizer.loadSelect('idGrupo', 'grupoInscribirSelect', 'Grupo');
        Utilizer.setPicker('idEquipo', '');
      }
    </script>