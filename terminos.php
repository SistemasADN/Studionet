<?php include 'templates/top.php'; if($_SERVER['DOCUMENT_ROOT']=="C:/AppServ/www"){$url = $_SERVER['DOCUMENT_ROOT']."/bailemacarena";}else{$url = $_SERVER['DOCUMENT_ROOT'];}?>

<div class="panel panel-primary">
  <div class="panel-heading" style="background:#000000;">Aviso de Privacidad y Términos y Condiciones</div>
  <div class="panel-body">
    <hr>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs">
       <center><button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#aviso">Aviso de Privacidad</button></center>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs">
       <center><button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#terminos">Términos y condiciones</button></center>
    </div>
  </div>
</div>

<?php include 'templates/bottom.php'; ?>

<div id="aviso" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content modal-lg">
      <div class="modal-header" style="background:#337ab7;border:#2e6da4">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><font color="#FFFFFF">Aviso de Privacidad</font></h4>
      </div>
      <div class="modal-body">
      <iframe src="http://docs.google.com/gview?url=<?=$url;?>/avisos/AVISO DE PRIVACIDAD STUDIONET.pdf&embedded=true" 
      style="width:880px; height:640px;" frameborder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" name="acepta_avisos" value="1">ACEPTO</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>

<div id="terminos" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content modal-lg">
      <div class="modal-header" style="background:#5cb85c;border:##4cae4c">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><font color="#FFFFFF">Términos y Condiciones de Uso</font></h4>
      </div>
      <div class="modal-body">
      <iframe src="http://docs.google.com/gview?url=<?=$url;?>/avisos/TERMINOS Y CONDICIONES STUDIONET.pdf&embedded=true" 
      style="width:880px; height:640px;" frameborder="0"></iframe>
      </div>
      <div class="modal-footer">
        <div class="form-container">
        <button type="button" class="btn btn-success" name="acepta_terminos" value="2">ACEPTO</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function ()
    {
      $('[name=acepta_terminos]').click(function()
      {
        $('#terminos').modal('hide');
        $.ajax(
                {
                    url: "queries/aceptaTerminosCondiciones.php",
                    context: document.body,
                    method: "POST",
                    data: {acepta_terminos:$(this).val()}
                }).done(function(data)
                {
                    alert(data);
                });
      });  

      $('[name=acepta_avisos]').click(function()
      {
        $('#aviso').modal('hide');
        $.ajax(
                {
                    url: "queries/aceptaTerminosCondiciones.php",
                    context: document.body,
                    method: "POST",
                    data: {acepta_aviso:$(this).val()}
                }).done(function(data)
                {
                    alert(data);
                });
      });  
    });
</script>
