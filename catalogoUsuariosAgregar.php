<?php
  include 'templates/top.php';
?>
<style>
.tutorial-blur {
  filter:blur(2px);
}

.tutorial-footer > *{
  filter:none;
}

.tutorial-footer{
    margin-top: 1em;
}

.icon-control{
  font-size:2em;
  cursor:pointer;
}

.icon-control:hover{
  opacity:0.5;
}

.tutorial-focus {
  filter:none;
}

.triangle-border.bot{
  margin: -13em 0 3em;
}
.triangle-border {
  /*position:relative;*/
  position:absolute;
  padding:15px;
  margin:1em 0 3em;
  border:5px solid #5a8f00;
  color:#333;
  background:#fff;
  /* css3 */
  -webkit-border-radius:10px;
  -moz-border-radius:10px;
  border-radius:10px;
  z-index: 999900000000000000;
}

/* Variant : for left positioned triangle
------------------------------------------ */

.triangle-border.left {
  margin-left:30px;
}

/* Variant : for right positioned triangle
------------------------------------------ */

.triangle-border.right {
  margin-right:30px;
}

/* THE TRIANGLE
------------------------------------------------------------------------------------------------------------------------------- */
.triangle-border.move{
  margin-left: 20px;
}
.triangle-border:before {
  content:"";
  position:absolute;
  bottom:-20px; /* value = - border-top-width - border-bottom-width */
  left:40px; /* controls horizontal position */
  border-width:20px 20px 0;
  border-style:solid;
  border-color:#5a8f00 transparent;
  /* reduce the damage in FF3.0 */
  display:block;
  width:0;
}

/* creates the smaller  triangle */
.triangle-border:after {
  content:"";
  position:absolute;
  bottom:-13px; /* value = - border-top-width - border-bottom-width */
  left:47px; /* value = (:before left) + (:before border-left) - (:after border-left) */
  border-width:13px 13px 0;
  border-style:solid;
  border-color:#fff transparent;
  /* reduce the damage in FF3.0 */
  display:block;
  width:0;
}

/* Variant : top
------------------------------------------ */

/* creates the larger triangle */
.triangle-border.top:before {
  top:-20px; /* value = - border-top-width - border-bottom-width */
  bottom:auto;
  left:auto;
  right:40px; /* controls horizontal position */
  border-width:0 20px 20px;
}

/* creates the smaller  triangle */
.triangle-border.top:after {
  top:-13px; /* value = - border-top-width - border-bottom-width */
  bottom:auto;
  left:auto;
  right:47px; /* value = (:before right) + (:before border-right) - (:after border-right) */
  border-width:0 13px 13px;
}

/* Variant : left
------------------------------------------ */

/* creates the larger triangle */
.triangle-border.left:before {
  top:10px; /* controls vertical position */
  bottom:auto;
  left:-30px; /* value = - border-left-width - border-right-width */
  border-width:15px 30px 15px 0;
  border-color:transparent #5a8f00;
}

/* creates the smaller  triangle */
.triangle-border.left:after {
  top:16px; /* value = (:before top) + (:before border-top) - (:after border-top) */
  bottom:auto;
  left:-21px; /* value = - border-left-width - border-right-width */
  border-width:9px 21px 9px 0;
  border-color:transparent #fff;
}

/* Variant : right
------------------------------------------ */

/* creates the larger triangle */
.triangle-border.right:before {
  top:10px; /* controls vertical position */
  bottom:auto;
  left:auto;
  right:-30px; /* value = - border-left-width - border-right-width */
  border-width:15px 0 15px 30px;
  border-color:transparent #5a8f00;
}

/* creates the smaller  triangle */
.triangle-border.right:after {
  top:16px; /* value = (:before top) + (:before border-top) - (:after border-top) */
  bottom:auto;
  left:auto;
  right:-21px; /* value = - border-left-width - border-right-width */
  border-width:9px 0 9px 21px;
  border-color:transparent #fff;
}


</style>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-user-circle-o"></i> </div>
    <div class="text-container"> AGREGAR USUARIO </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> NOMBRE COMPLETO </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input capitalize" data-subtype = 'alpha' required placeholder="Nombre(s)" id="nombre"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input capitalize" required placeholder="Apellido Paterno" id="apellidoPaterno"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input capitalize" placeholder="Apellido Materno" id="apellidoMaterno"> </div>
        <div class="col-xs-12 col-sm-6 col-md-6 input-container">
          <select class="selectpicker form-input" data-live-search="false" required data-label="Genero" id="generoSearch" name='Genero'> </select>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 input-container date-container">
          <label class='label-fecha'>FECHA DE NACIMIENTO</label>
          <div class="input-group date form-input" id="fechaSelect"> <span class="input-group-addon">
              <i class="glyphicon glyphicon-calendar"></i>
          </span>
            <input type="text" class="form-control form-input" required id="fechaSelectText"> </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> TIPO DE USUARIO </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input" data-live-search="false" required data-label="Tipo de Usuario" id="tipousuarioSearch" name='Tipo de Usuario'> </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> INFORMACIÓN DE CONTACTO </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="email" class="form-control form-input lowercase" required placeholder="Correo Electrónico" id="email"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" required placeholder="Tel. Celular" id="telCelular"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" placeholder="Tel. Casa" id="telCasa"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" placeholder="Tel. Oficina" id="telOficina"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" placeholder="Tel. Otro" id="telOtro"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DIRECCIÓN </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input capitalize" data-minlength="1" data-maxlength="30" data-label="Calle" data-subtype="alphnum" id="street" placeholder="Calle" name="Calle"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número exterior" data-subtype="alphnum" id="numExt" placeholder="No. Exterior" name='NoExterior'> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número interior" data-subtype="alphnum" id="numInt" placeholder="No. Interior" name='NoInterior'> </div>
        <div class="col-xs-12 col-sm-4 col-md-4 input-container">
          <input type="text" class="form-control form-input" data-minlength="4" data-maxlength="5" data-label="Codigo Postal" data-subtype="alphnum" id="postalcodeSum" placeholder="C.P." name='CP'> </div>
        <div class="col-xs-12 col-sm-8 col-md-8 input-container">
          <select class="selectpicker form-input" data-live-search="true" id="areaSum" data-label="Colonia">
            <option>Colonia</option>
          </select>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 marTop-md input-container">
          <input type="text" placeholder="Ciudad" id="citySum" name='Ciudad' disabled/> </div>
        <div class="col-xs-12 col-sm-4 col-md-4 marTop-md input-container">
          <input type="text" placeholder="Estado" id="stateSum" name='Estado' disabled/> </div>
        <div class="col-xs-12 col-sm-4 col-md-4 marTop-md input-container">
          <input type="text" placeholder="Pa&iacute;s" id="countrySum" name='pais' disabled/>
          <input type="hidden" id="countryIdSum" name='Pais' /> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input" data-script="agregarUsuario" data-function="afterEdit" data-clear="true" id="agregarUsuario">agregar usuario</button>
        </div>
      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(11, 1);
        Utilizer.makeDatepicker('fechaSelect');
        Utilizer.loadSelect('tipousuarioSearch', 'tipousuarioSelect', 'Tipo de Usuario');
        Utilizer.loadSelect('generoSearch', 'generoSelect', 'Género');
        FormEngine.setFormEngine('agregarUsuario');
        $('#postalcodeSum').on('change', Utilizer.loadDireccion);

        /*Tutorializer.loadTutorial([
          {'id':'nombre', 'text':'En este campo se escribe el nombre del Usuario que desea agregar.', 'validation':true},
          {'id':'apellidoPaterno', 'text':'En este campo se escribe el apellido paterno del Usuario que desea agregar.', 'validation':true},
          {'id':'apellidoMaterno', 'text':'En este campo se escribe el apellido materno del Usuario que desea agregar.', 'validation':true},
          {'id':'generoSearch', 'text':'Seleccione aquí el género que desea registrar para el usuario que desea agregar.', 'validation':true},
          {'id':'fechaSelect', 'text':'Seleccione aquí la fecha de nacimiento que desea registrar para el usuario que desea agregar.', 'validation':true},
        ]);
                /**/
      });

      function afterEdit(data, extra) {
        console.log(data);
        console.log(extra);
        Utilizer.makeDatepicker('fechaSelect');
      }
    </script>
