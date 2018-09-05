var Tutorializer = {};
$(document).ready(function(){
  //$( document ).tooltip();

  (function($) {
      $.fn.goTo = function() {
         $('html, body').animate({
              scrollTop: Number($(this).offset().top)-Number(200) + 'px'
          }, '400');
          $(this).addClass('testing');
          return this; // for chaining...
      }
  })(jQuery);

  Tutorializer.loadWalkThrough = function (){
    var pageName = Tutorializer.getCurrentPageName();
    Tutorializer.addWalkthrough(pageName);
  }

  Tutorializer.getCurrentPageName = function (){
    var loc = window.location.href.replace('.php', '');
    loc = loc.substr(loc.lastIndexOf('/')+1);
    return loc;
  }

  Tutorializer.addWalkthrough = function (pageName) {
      $("body").append('<div class="modal fade in" tabindex="-1" role="dialog" id="tutorial'+pageName+'"><div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button></div><div class="modal-body container-fluid"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container"><div class="logo-container"><i class="fa fa-question-circle"></i> </div><div class="text-container"></div></div><div class="col-xs-12 col-sm-12 col-md-12 modal-content-container"></div></div><div class="modal-footer"></div></div></div></div>');

      $(".title-container").find('.text-container').append("<i title='Ayuda' hidden id = 'boton-tutorial"+pageName+"' class='help-icon fa fa-question-circle'></i></button>");

      $("#boton-tutorial"+pageName).click(function (){
        $("#tutorial"+pageName).find('.text-container').text($(this).parent().text());
        $("#tutorial"+pageName).modal('show');
      });

      $("#tutorial"+pageName).find('.modal-content-container').load('tutorial/'+pageName+".html", {},
      function (responseText, textStatus, req) {
        if(textStatus==='error'){
          $('#tutorial'+pageName).remove();
          $("#boton-tutorial"+pageName).remove();
        }else{
          $("#boton-tutorial"+pageName).show();
        }
      });
  }


  Tutorializer.loadTutorial = function (tutorial){
    Tutorializer.tutorial = tutorial;
    Tutorializer.startTutorial();
  }

  Tutorializer.startTutorial = function (){
    console.log("START TUTORIAL!");
    $("input, select, .validator-warn, button, .jumbotron-text, label").addClass('tutorial-blur');
    Tutorializer.goTo(0);
  }

  Tutorializer.stopTutorial = function (){
    $(".tutorial-blur").removeClass('tutorial-blur');
    $(".tutorial-modal").remove();
  }

  Tutorializer.goTo = function (number){
    console.log("Tutorializer.goto("+number+")");
  //  return;
    $(".tutorial-modal").remove();
    var actual = Tutorializer.tutorial[number], textHeader = "", textContent = "", textFooter = "", obj = $("#"+actual.id), marginLeft = '0', topBot = 'top';
    textHeader += "<div class = 'row' style = 'margin-right: 0px;'><div class = 'col-md-11'></div><div = class = 'col-md-1'><i onClick = 'Tutorializer.stopTutorial();' class = 'icon-control fa fa-times-circle'></i></div></div>";
    if(actual.id!==undefined){
      if($(obj).length==0){
        Messager.addAlertText('Tutorial', 'El elemento ['+actual.id+'] no existe en el dom.', 'e');
      }else{
        //Ir a elemento
        $(obj).goTo();
        //Quitar anti blur y poner blur
        $(".tutorial-focus").removeClass('tutorial-focus');
        if($(obj).hasClass('selectpicker')){
          console.log("SELECTPICKER");
          obj = $(obj).parent();
          $(obj).find('button').addClass('tutorial-focus');
          marginLeft = $(obj).find('button').eq(0).width();
          topBot = 'bot';
        }else if($(obj).hasClass('date')){
          console.log("DATEPICKER");
          $(obj).find('input').addClass('tutorial-focus');
          $(obj).siblings('.label-fecha').addClass('tutorial-focus');
          topBot = 'bot';
        }


        $(obj).addClass('tutorial-focus');
      }
    }
    $(obj).focus();
    if(actual.text!==undefined){
      textContent = actual.text;
    }

    if(actual.validation){
        textContent+= "<br>Detalles validación: ";
        var type = $(obj).attr("type");
        var subtype = $(obj).data("subtype");
        var textToInput = "";
        //console.log(type);
        //console.log(subtype);

        if (obj[0].required||$(obj).hasClass('required')) {
          textToInput+= "Es requerido. ";
        }

        var mensaje = "";
        if (type == "text") {
          switch (subtype) {
          case 'alpha':
            mensaje = "letras mayusculas, minusculas y espacios."
            break;
          case 'alphnum':
            mensaje = "números, letras mayusculas, minusculas y espacios."
            break;
          case 'alphnumper':
            mensaje = "números, letras mayusculas, minusculas, paréntesis y espacios."
            break;
          case 'specs':
            mensaje = "números, letras mayusculas, minusculas, espacios, guiones y puntos."
            break;
          case 'servs':
            mensaje = "números, letras mayusculas, minusculas, espacios, guiones, puntos, comillas y simbolos de admiración."
            break;
          case 'rfc':
            mensaje = "RFC (3 ó 4 letras seguido de 6 numeros y una homoclave de 3 caracteres, todas las letras deben ser mayusculas)."
            break;
          case 'num':
            mensaje = "números enteros sin signo."
            break;
          case 'tel':
            mensaje = "números, espacios y guiones."
            break;
          case 'date':
            mensaje = "fecha valida"
            break;
          case 'password':
            mensaje = "números, letras mayusculas y minusculas."
            break;
          case 'name':
            mensaje = "números, letras mayusculas, minusculas, puntos y espacios."
          }
        }
        else if (type == "number") {
          switch (subtype) {
          case 'coin':
            mensaje = "números con hasta dos decimales."
            break;
          case 'use':
            mensaje = "números enteros."
            break;
          }
        } else if (type == "email") {
          mensaje = "E-mail (ejemplo@dominio.com)."
        }
        if(mensaje!=""){
          textToInput+= "Sólo acepta "+mensaje+" ";
        }

        if ($(obj).data('min')) {
          textToInput+= "Requiere un valor menor a "+$(obj).data('min')+". ";
        }


        if ($(obj).data('max')) {
          textToInput+= "Requiere un valor mayor a "+$(obj).data('max')+". ";
        }

        if ($(obj).data('emin')) {
          textToInput+= "Requiere un valor menor o igual a "+$(obj).data('emin')+". ";
        }

        if ($(obj).data('emax')) {
          textToInput+= "Requiere un valor mayor o igual a "+$(obj).data('emax')+". ";
        }

        if ($(obj).data('minlength')) {
          textToInput+= "Requiere al menos "+$(obj).data('minlength')+" carácteres. ";
        }
        if ($(obj).data('maxlength')) {
          textToInput+= "Requiere como máximo "+$(obj).data('maxlength')+" carácteres. ";
        }
        if ($(obj).data('elength')) {
          textToInput+= "Requiere éxactamente "+$(obj).data('elength')+" carácteres. ";
        }
        console.log("TEXT TO INPUT ["+textToInput+"]");
        if(textToInput==""){
          textContent += "Ningúno. ";
        }else{
          textContent += textToInput;
        }
        textFooter += "<button type = 'button' class = 'btn btn-cancel-select'>Probar validación</button> ";
    }

    if(number>0){
      textFooter += "<i class = 'icon-control fa fa-arrow-circle-left' onClick = 'Tutorializer.goTo("+Number(number-1)+")'></i>";
    }
    console.log("Number["+number+"] Length["+Tutorializer.tutorial.length+"]");
    if(number<Tutorializer.tutorial.length-1){
      textFooter += "<i class = 'icon-control fa fa-arrow-circle-right' onClick = 'Tutorializer.goTo("+Number(number+1)+")'></i>";
    }


    $(obj).after("<div class = 'tutorial-modal triangle-border "+topBot+"'><div class = 'tutorial-header'>"+textHeader+"</div><div class = 'tutorial-content'>"+textContent+"</div><div class = 'tutorial-footer'>"+textFooter+"</div></div>");
    if($(".tutorial-modal").hasClass('bot')){
      $(".tutorial-modal").css('margin-top', (-1*$(".tutorial-modal").height()-100)+'px');
    }
    console.log("TUTORIAL");
    console.log(textHeader);
    console.log(textContent);
    console.log(textFooter);
  }

  Tutorializer.loadWalkThrough();
});

//              $(this).after("<p class = 'triangle-border top'>Este campo sirve para agregar el nombre del Usuario que desea agregar <button type = 'button'>Siguiente</button></p>");
