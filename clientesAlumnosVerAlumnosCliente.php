<?php include 'templates/topCliente.php'; ?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
  <div class="logo-container"> <i class="fa fa-users"></i> </div>
  <div class="text-container"> VER CLIENTE Y ALUMNOS </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
  <table class="table table-hover table-responsive" id="clienteVer">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="text-container-subtitle"> INFORMACI&Oacute;N DE CLIENTE </div>
    </div>
    <thead>
      <tr class="table-header">
        <th class="table-column-title">NOMBRE</th>
        <th class="table-column-title">CORREO</th>
        <th class="table-column-title">DIRECCION</th>
        <th class="table-column-title">TELEFONO CELULAR</th>
        <th class="table-column-title">NUM. DE ALUMNOS</th>
      </tr>
    </thead>
    <tfoot>
      <tr class="table-header">
        <th class="table-column-title">NOMBRE</th>
        <th class="table-column-title">CORREO</th>
        <th class="table-column-title">DIRECCION</th>
        <th class="table-column-title">TELEFONO CELULAR</th>
        <th class="table-column-title">NUM. DE ALUMNOS</th>
      </tr>
    </tfoot>
    <tbody> </tbody>
  </table>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
  <table class="table table-hover table-responsive" id="alumnosVer">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="text-container-subtitle"> ALUMNOS DE CLIENTE </div>
    </div>
    <thead>
      <tr class="table-header">
        <th class="table-column-title">NOMBRE</th>
        <th class="table-column-title">CORREO</th>
        <th class="table-column-title">GÉNERO</th>
        <th class="table-column-title">PADRE/TUTOR</th>
        <th class="table-column-title">COLEGIO</th>
        <th class="table-column-title">GRADO ESCOLAR</th>
        <th class="table-column-title">ESTATUS</th>
      </tr>
    </thead>
    <tfoot>
      <tr class="table-header">
        <th class="table-column-title">NOMBRE</th>
        <th class="table-column-title">CORREO</th>
        <th class="table-column-title">GÉNERO</th>
        <th class="table-column-title">PADRE/TUTOR</th>
        <th class="table-column-title">COLEGIO</th>
        <th class="table-column-title">GRADO ESCOLAR</th>
        <th class="table-column-title">ESTATUS</th>
      </tr>
    </tfoot>
    <tbody> </tbody>
  </table>
</div>
<?php include 'templates/bottom.php'; ?>
  <script>
    $(document).ready(function () {
      //Csser.collapse(1);
      tableUtilities.createTable('clienteVer', ['nombreCompleto', 'email', 'dirCompleta', 'telCelular', 'numAlumnos']);
      tableUtilities.createTable('alumnosVer', ['nombreCompleto', 'email', 'genero', 'tutor', 'colegio', 'nombreGrado', 'estatus']);
      tableUtilities.setUniqueColumns('alumnosVer', ['idAlumno']);
      tableUtilities.loadScript('clienteVer', 'getClienteCliente', {idCliente: Number(<?php echo $_SESSION['idUsuario']; ?>)}, agregarCliente);
      tableUtilities.loadScript('alumnosVer', 'getAlumnoCliente', {idCliente: Number(<?php echo $_SESSION['idUsuario']; ?>)}, agregarAlumno);


    });
    function agregarAlumno(data) {
        data.nombreCompleto = data.nombre + " " + data.apellidoPaterno;
        if (data.apellidoMaterno != "") {
          data.nombreCompleto += " " + data.apellidoMaterno;
        }
        if (data.email == "") {
          data.email = "N/E";
        }
        if(data.colegio == null){
          data.colegio = "N/E";
        }
        if(data.nombreGrado == null){
          data.nombreGrado = "N/E";
        }
        data.estatus = data.activo == 1 ? "ACTIVO" : "INACTIVO";
        if(data.ca!=null){
          data.tutor += ' (Alumno es cliente)';
        }
        //console.log(data);
        return data;
      }

      function agregarCliente(data) {
        data.nombreCompleto = data.prefijo + " " + data.nombre + " " + data.apellidoPaterno;
        data.nombreCompleto = data.apellidoMaterno != "" ? data.nombreCompleto + " " + data.apellidoMaterno : data.nombreCompleto;
        data.dirCompleta = Utilizer.concatenateDireccion(data);
        data.dirCompleta = data.dirCompleta == "" ? "N/E" : data.dirCompleta;
        data.estatus = data.estatus == 1 ? "ACTIVO" : "INACTIVO";
        data.fechaSelectText = Utilizer.fechaDbParseToFecha(data.fechaNacimiento);
        data.postalcodeSum = data.postalcodeSum == 0 ? "" : data.postalcodeSum;
        data.numAlumnos = data.numAlumnos == null ? 0 : data.numAlumnos;
        return data;
      }
  </script>
