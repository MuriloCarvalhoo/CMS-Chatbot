$(document).ready(function() {
  $('[data-toggle="tooltip"]').tooltip();
});

$(function () {
  if(typeof module_link !== "undefined"){
    app.load("#app-entry", module_link + "/0");
  }
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
  jQuery.validator.setDefaults({
    debug: true,
    success: "valid",
    errorPlacement: function (error, element) {
      return true;
    },
  });

  $(".search-btn").on("click", function () {
    $(".header-search").toggleClass("open");
  });
  
  $('.page-previous').click(function(){
        current_page--;
        if(current_page < 1)
        {
        current_page = 1
        }
        $('#paginate-number').text('Page ' + current_page + ' of ' + total_pages);
        app.load('#item-list', module_link + '?page=' + current_page)
    });

    $('.page-next').click(function(){
        current_page++;
        if(current_page > total_pages)
        {
            current_page = total_pages
        }
        $('#paginate-number').text('Page ' + current_page + ' of ' + total_pages);
        app.load('#item-list', module_link + '?page=' + current_page)
    });

  $(".html-editor-mini").summernote({
    height: "200px",
    toolbar: [
      ["style", ["bold", "italic", "underline", "clear"]],
      ["fontsize", ["fontsize"]],
      ["color", ["color"]],
      ["para", ["ul", "ol", "paragraph"]],
    ],
  });

  $(".html-editor").summernote({
    height: "200px",
    onImageUpload: function (files, editor, welEditable) {
      app.sendFile(files[0], editor, welEditable);
    },
  });

  $("body").on("click", "[data-action]", function (e) {
    e.preventDefault();
    e.stopPropagation();
    var $tag = $(this);

    console.log(e);

    if ($tag.data("action") == "SHOW")
      return app.load($tag.data("load-to"), $tag.data("url"));

    if ($tag.data("action") == "CREATE")
      return app.load($tag.data("load-to"), $tag.data("url"));

    if ($tag.data("action") == "STORE")
      return app.store(
        $tag.data("form"),
        $tag.data("load-to"),
        $tag.data("list")
      );

    if ($tag.data("action") == "EDIT")
      return app.load($tag.data("load-to"), $tag.data("url"));

    if ($tag.data("action") == "UPDATE")
      return app.update(
        $tag.data("form"),
        $tag.data("load-to"),
        $tag.data("list")
      );

    if ($tag.data("action") == "DELETE") {
      return app.delete(
        $tag.data("href"),
        $tag.data("load-to"),
        $tag.data("list"),
        $tag.data("remove")
      );
    }

    if ($tag.data("action") == "REQUEST")
      return app.makeRequest($tag.data("method"), $tag.data("href"));

    app.load($tag.data("load-to"), $tag.data("href"));
  });


  $('.dropdown .has-child').on('click', 'a[data-toggle="collapse"]', function (event) {
      event.preventDefault();
      event.stopPropagation();
      $($(this).attr('href')).collapse('toggle');
  });
  var ps = new PerfectScrollbar(".main-nav-wrap", {
      wheelSpeed: 2,
      wheelPropagation: true,
      minScrollbarLength: 5
  });
  var dropdownMenu;
  $(window).on('show.bs.dropdown', function (e) {
      dropdownMenu = $(e.target).find('.main-nav-dropdown');
      $('body').append(dropdownMenu.detach());
      var eOffset = $(e.target).offset();
      dropdownMenu.css({
          'display': 'block',
          'top': eOffset.top,
          'left': eOffset.left + 63
      });
  });
  $(window).on('hide.bs.dropdown', function (e) {
      $(e.target).append(dropdownMenu.detach());
      dropdownMenu.hide();
  });
});

$(document).ajaxComplete(function () {
  $("body")
    .off()
    .on("click", "[data-action]", function (e) {
      e.preventDefault();
      e.stopPropagation();
      var tag = $(this);

      console.log(e);

      if (tag.data("action") == "SHOW")
        return app.load(tag.data("load-to"), tag.data("url"));

      if (tag.data("action") == "CREATE")
        return app.load(tag.data("load-to"), tag.data("url"));

      if (tag.data("action") == "STORE") {
        return app.store(tag);
        tag.data("load-to");
        tag.data("list");
      }

      if (tag.data("action") == "EDIT") {
        return app.load(tag.data("load-to"), tag.data("url"));
      }

      if (tag.data("action") == "UPDATE") {
        return app.update(tag);
      }

      if (tag.data("action") == "DELETE") {
        return app.delete(tag);
      }

      if (tag.data("action") == "REQUEST")
        return app.makeRequest(tag.data("method"), tag.data("href"));

      app.load(tag.data("load-to"), tag.data("href"));
    });

  $("form[id$='-show'] :input").prop("disabled", true);

  $(".html-editor-mini").summernote({
    height: "200px",
    toolbar: [
      ["style", ["bold", "italic", "underline", "clear"]],
      ["fontsize", ["fontsize"]],
      ["color", ["color"]],
      ["para", ["ul", "ol", "paragraph"]],
    ],
  });

  $(".html-editor").summernote({
    height: "200px",
    onImageUpload: function (files, editor, welEditable) {
      app.sendFile(files[0], editor, welEditable);
    },
  });
});

$(document).ajaxError(function (event, jqxhr, settings, thrownError) {
  app.message(jqxhr);
});

$(document).ajaxSuccess(function (event, xhr, settings) {
  app.message(xhr);
});

class myApp {
  constructor() {}
  async sendmail(forms) {
    var form = $(forms);

    if (form.valid() == false) {
      toastr.error("Please enter valid information.", "Error");
      return false;
    }

    var formData = new FormData($(forms));
    params = form.serializeArray();

    $.each(params, function (i, val) {
      formData.append(val.name, val.value);
    });

    var url = form.attr("action");

    $.ajax({
      url: url,
      type: "POST",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (data, textStatus, jqXHR) {
        app.load(tag, data.redirect);
      },
    });
  }

  async index(id) {
    var tag = $(id);
    console.log(tag);
    await app.load(id, tag.data("url"));
  }

  async store(tag) {
    var form = $(tag.data("form"));
    var forms = tag.data("form");

    if (form.valid() == false) {
      toastr.error("Please enter valid information.", "Error");
      return false;
    }

    var formData = new FormData();
    var params = form.serializeArray();

    $.each(params, function (i, val) {
      formData.append(val.name, val.value);
    });

    $.each($(forms + " .html-editor"), function (i, val) {
      formData.append(val.name, $("#" + val.id).code());
    });

    var url = form.attr("action");

    $.ajax({
      url: url,
      type: "POST",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (result) {
        app.load(tag.data("load-to"), result.url);
        app.index(tag.data("list"));
      },
    });
  }

  async update(tag) {
    var params;
    var form = $(tag.data("form"));
    var forms = tag.data("form");

    if (form.valid() == false) {
      toastr.error("Please enter valid information.", "Error");
      return false;
    }

    var formData = new FormData();
    params = form.serializeArray();

    $.each(params, function (i, val) {
      formData.append(val.name, val.value);
    });

    $.each($(forms + " .html-editor"), function (i, val) {
      formData.append(val.name, $("#" + val.id).code());
    });

    var url = form.attr("action");

    $.ajax({
      url: url,
      type: "POST",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (result) {
        app.load(tag.data("load-to"), result.url);
        app.index(tag.data("list"));
      },
    });
  }

  async delete(tag) {
    var target = tag.data("url");
    return new Promise((resolve) => {
      swal({
        title: "Are you sure?",
        text: "You will not be able to recover this data!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
      }).then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: target,
            type: "DELETE",
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (result) {
              app.load(tag.data("load-to"), result.url);
              app.index(tag.data("list"));
            },
          });
        }
      });
    });
  }

  async load(tag, target) {
    console.log(tag);
    console.log(target);
    $(tag).load(target);
  }

  async sendFile(file, url, editor) {
    var data = new FormData();
    formData.append("file", file);
    $.ajax({
      data: data,
      type: "POST",
      url: url,
      cache: false,
      contentType: false,
      processData: false,
      success: function (objFile) {
        editor.summernote("insertImage", objFile.folder + objFile.file);
      },
      error: function (jqXHR, textStatus, errorThrown) {},
    });
  }

  makeRequest(method, target) {
    $.ajax({
      url: target,
      type: method,
    });
  }

  message(info) {
    if (info.status == 200) {
      return true;
    }

    var msgType;
    var msgTitle;
    var msgText = "";
    var response = "";

    if (info.status == 201) {
      msgTitle = "Success";
      msgType = "success";
      response = jQuery.parseJSON(info.responseText);
      msgText = response.message;
    } else if (info.status == 422) {
      msgType = "warning";
      msgTitle = info.statusText;
      response = jQuery.parseJSON(info.responseText);
      $.each(response.errors, function (key, val) {
        msgText += val + "<br>";
      });
    } else if (info.status >= 100 && info.status <= 199) {
      msgTitle = "Info";
      msgType = "info";
      msgText = info.statusText;
    } else if (info.status >= 202 && info.status <= 299) {
      msgTitle = "Success";
      msgType = "success";
      msgText = info.statusText;
    } else if (info.status >= 400 && info.status <= 499) {
      msgTitle = "Warning";
      msgType = "warning";
      msgText = info.statusText;
    } else if (info.status >= 500 && info.status <= 599) {
      msgType = "error";
      msgTitle = "Error";
      msgText = info.statusText;
    }

    if (msgType != undefined) toastr[msgType](msgText, msgTitle);

    return true;
  }
}

var app = new myApp();

$(window)
  .scroll(function () {
    var scrollDistance = $(window).scrollTop();
    $(".app-entry-form-section").each(function (i) {
      if ($(this).position().top <= scrollDistance) {
        $("#steps_nav a.step-item.active").removeClass("active");
        $("#steps_nav a.step-item").eq(i).addClass("active");
      }
    });
  })
  .scroll();

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

//Formulario Dinamico Chatbox

//HTML para cada tipo de função
var buttonDelete = " type=\"button\" class=\"bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded\" > Remover </button>";
var formText = "<div class=\"app-entry-form-section m-2\" id=\"meta\"><div class=\"row\"><div class=\"col-auto\"><div class=\"form-group\"><label for=\"tipo[]\" class=\"control-label\">Tipo</label><input type=\"hidden\"  name=\"tipo[]\" id=\"tipo\" value=\"Desabilitado\"><input type=\"text\" class=\"form-control\" disabled=\"true\" value=\"Desabilitado\"></div><div class=\"form-group\"><label for=\"nome[]\" class=\"control-label\">Nome da função</label><input type=\"text\" class=\"form-control\" disabled=\"true\" name=\"nome\" id=\"nome\" placeholder=\"Ex: 'email'\"></div></div><div class=\"col-auto\"><div class=\"form-group\"><label for=\"ouvir[]\" class=\"control-label\">Ouvir:</label><input type=\"text\" class=\"form-control\" disabled=\"true\" name=\"ouvir[]\" id=\"ouvir\" placeholder=\"Ex: 'Quero o meu extrato'\"></div><div class=\"form-group\"><label for=\"validar[]\" class=\"control-label\">Validação</label><select type=\"text\" class=\"form-control\" disabled=\"true\" name=\"validar[]\" id=\"validar\"><option value=\"naovalidar\">Não Validar</option><option value=\"cpf\">CPF</option><option value=\"email\">E-mail</option><option value=\"celular\">Celular</option></select></div></div><div class=\"col-auto\"><div class=\"form-group\"><label for=\"pergunta[]\" class=\"control-label\">Pergunta:</label><input type=\"text\" class=\"form-control\" disabled=\"true\" name=\"pergunta[]\" id=\"pergunta\" placeholder=\"Ex: 'Qual o seu email ? '\"></div><div class=\"form-group\"><label for=\"resposta[]\" class=\"control-label\">Resposta:</label><input type=\"text\" class=\"form-control\" disabled=\"true\" name=\"resposta[]\" id=\"resposta\" placeholder=\"Ex: 'Seu e-mail é '\"></div></div><div class=\"col-auto\"><div class=\"form-group\"><label for=\"nome_prox[]\" class=\"control-label\">Nome da proxima função:</label><input type=\"text\" class=\"form-control\" disabled=\"true\" name=\"nome_prox[]\" id=\"nome_prox\" placeholder=\"Ex: 'cpf'\"></div></div></div></div>";
var formPerguntaUnica = "<div class=\"app-entry-form-section m-2\" id=\"meta\"><div class=\"row\"><div class=\"col-auto\"><div class=\"form-group\"><label for=\"tipo[]\" class=\"control-label\">Tipo</label><input type=\"hidden\" name=\"tipo[]\" id=\"tipo\" value=\"Pergunta\"><input type=\"text\" class=\"form-control\" disabled=\"true\" value=\"Pergunta\"></div><div class=\"form-group\"><label for=\"nome[]\" class=\"control-label\">Nome da função</label><input type=\"text\" class=\"form-control\"  name=\"nome[]\" id=\"nome\" placeholder=\"Ex: 'email'\"></div></div><div class=\"col-auto\"><div class=\"form-group\"><label for=\"ouvir[]\" class=\"control-label\">Ouvir:</label><input type=\"hidden\" name=\"ouvir[]\" id=\"ouvir\" value=\"\"><input type=\"text\" class=\"form-control\" disabled=\"true\" placeholder=\"Ex: 'Quero o meu extrato'\"></div><div class=\"form-group\"><label for=\"validar[]\" class=\"control-label\">Validação</label><select type=\"text\" class=\"form-control\"  name=\"validar[]\" id=\"validar\"><option value=\"naovalidar\">Não Validar</option><option value=\"cpf\">CPF</option><option value=\"email\">E-mail</option><option value=\"celular\">Celular</option></select></div></div><div class=\"col-auto\"><div class=\"form-group\"><label for=\"pergunta[]\" class=\"control-label\">Pergunta:</label><input type=\"text\" class=\"form-control\"  name=\"pergunta[]\" id=\"pergunta\" placeholder=\"Ex: 'Qual o seu email ? '\"></div><div class=\"form-group\"><label for=\"resposta[]\" class=\"control-label\">Resposta:</label><input type=\"text\" class=\"form-control\"  name=\"resposta[]\" id=\"resposta\" placeholder=\"Ex: 'Seu e-mail é '\"></div></div><div class=\"col-auto\"><div class=\"form-group\"><label for=\"nome_prox[]\" class=\"control-label\">Nome da proxima função:</label><input type=\"text\" class=\"form-control\"  name=\"nome_prox[]\" id=\"nome_prox\" placeholder=\"Ex: 'cpf'\"></div></div></div></div>";
var formRespostaUnica = "<div class=\"app-entry-form-section m-2\" id=\"meta\"><div class=\"row\"><div class=\"col-auto\"><div class=\"form-group\"><label for=\"tipo[]\" class=\"control-label\">Tipo</label><input type=\"hidden\" name=\"tipo[]\" id=\"tipo\" value=\"Resposta\"><input type=\"text\" class=\"form-control\" disabled=\"true\" value=\"Resposta\"></div><div class=\"form-group\"><label for=\"nome[]\" class=\"control-label\">Nome da função</label><input type=\"text\" class=\"form-control\"  name=\"nome[]\" id=\"nome\" placeholder=\"Ex: 'email'\"></div></div><div class=\"col-auto\"><div class=\"form-group\"><label for=\"ouvir[]\" class=\"control-label\">Ouvir:</label><input type=\"text\" class=\"form-control\" name=\"ouvir[]\" id=\"ouvir\" placeholder=\"Ex: 'Quero o meu extrato'\"></div><div class=\"form-group\"><label for=\"validar[]\" class=\"control-label\">Validação</label><input type=\"hidden\" name=\"validar[]\" id=\"validar\" value=\"\"><select type=\"text\" class=\"form-control\" disabled=\"true\"><option value=\"naovalidar\">Não Validar</option><option value=\"cpf\">CPF</option><option value=\"email\">E-mail</option><option value=\"celular\">Celular</option></select></div></div><div class=\"col-auto\"><div class=\"form-group\"><label for=\"pergunta[]\" class=\"control-label\">Pergunta:</label><input type=\"hidden\" name=\"pergunta[]\" id=\"pergunta\" value=\"\"><input type=\"text\" class=\"form-control\" disabled=\"true\" placeholder=\"Ex: 'Qual o seu email ? '\"></div><div class=\"form-group\"><label for=\"resposta[]\" class=\"control-label\">Resposta:</label><input type=\"text\" class=\"form-control\" name=\"resposta[]\" id=\"resposta\" placeholder=\"Ex: 'Seu e-mail é '\"></div></div><div class=\"col-auto\"><div class=\"form-group\"><label for=\"nome_prox[]\" class=\"control-label\">Nome da proxima função:</label><input type=\"text\" class=\"form-control\" name=\"nome_prox[]\" id=\"nome_prox\" placeholder=\"Ex: 'cpf'\"></div></div></div></div>";
var formAnexo = "<div class=\"app-entry-form-section m-2\" id=\"meta\"><div class=\"row\"><div class=\"col-auto\"><div class=\"form-group\"><label for=\"tipo[]\" class=\"control-label\">Tipo</label><input type=\"hidden\" name=\"tipo[]\" id=\"tipo\" value=\"Anexo\"><input type=\"text\" class=\"form-control\" disabled=\"true\" value=\"Anexo\"></div><div class=\"form-group\"><label for=\"nome[]\" class=\"control-label\">Nome da função</label><input type=\"text\" class=\"form-control\" name=\"nome[]\" id=\"nome\" placeholder=\"Ex: 'email'\"></div></div><div class=\"col-auto\"><div class=\"form-group\"><label for=\"ouvir[]\" class=\"control-label\">Ouvir:</label><input type=\"text\" class=\"form-control\" name=\"ouvir[]\" id=\"ouvir\" placeholder=\"Ex: 'Quero o meu extrato'\"></div><div class=\"form-group\"><label for=\"validar[]\" class=\"control-label\">Validação</label><input type=\"hidden\" name=\"validar[]\" id=\"validar\" value=\"\"><select type=\"text\" class=\"form-control\" disabled=\"true\"><option value=\"naovalidar\">Não Validar</option><option value=\"cpf\">CPF</option><option value=\"email\">E-mail</option><option value=\"celular\">Celular</option></select></div></div><div class=\"col-auto\"><div class=\"form-group\"><label for=\"pergunta[]\" class=\"control-label\">Pergunta:</label><input type=\"text\" class=\"form-control\" name=\"pergunta[]\" id=\"pergunta\" placeholder=\"Ex: 'Qual o seu email ? '\"></div><div class=\"form-group\"><label for=\"resposta[]\" class=\"control-label\">Resposta:</label><input type=\"text\" class=\"form-control\" name=\"resposta[]\" id=\"resposta\" placeholder=\"Ex: 'Seu e-mail é '\"></div></div><div class=\"col-auto\"><div class=\"form-group\"><label for=\"nome_prox[]\" class=\"control-label\">Nome da proxima função:</label><input type=\"text\" class=\"form-control\" name=\"nome_prox[]\" id=\"nome_prox\" placeholder=\"Ex: 'cpf'\"></div></div></div></div>";
var formImagem = "<div class=\"app-entry-form-section m-2\" id=\"meta\"><div class=\"row\"><div class=\"col-auto\"><div class=\"form-group\"><label for=\"tipo[]\" class=\"control-label\">Tipo</label><input type=\"hidden\" name=\"tipo[]\" id=\"tipo\" value=\"Imagem\"><input type=\"text\" class=\"form-control\" disabled=\"true\" value=\"Imagem\"></div><div class=\"form-group\"><label for=\"nome[]\" class=\"control-label\">Nome da função</label><input type=\"text\" class=\"form-control\" name=\"nome[]\" id=\"nome\" placeholder=\"Ex: 'email'\"></div></div><div class=\"col-auto\"><div class=\"form-group\"><label for=\"ouvir[]\" class=\"control-label\">Ouvir:</label><input type=\"text\" class=\"form-control\" name=\"ouvir[]\" id=\"ouvir\" placeholder=\"Ex: 'Quero o meu extrato'\"></div><div class=\"form-group\"><label for=\"validar[]\" class=\"control-label\">Validação</label><input type=\"hidden\" name=\"validar[]\" id=\"validar\" value=\"\"><select type=\"text\" class=\"form-control\" disabled=\"true\"><option value=\"naovalidar\">Não Validar</option><option value=\"cpf\">CPF</option><option value=\"email\">E-mail</option><option value=\"celular\">Celular</option></select></div></div><div class=\"col-auto\"><div class=\"form-group\"><label for=\"pergunta[]\" class=\"control-label\">Pergunta:</label><input type=\"text\" class=\"form-control\" name=\"pergunta[]\" id=\"pergunta\" placeholder=\"Ex: 'Qual o seu email ? '\"></div><div class=\"form-group\"><label for=\"resposta[]\" class=\"control-label\">Resposta:</label><input type=\"text\" class=\"form-control\" name=\"resposta[]\" id=\"resposta\" placeholder=\"Ex: 'Seu e-mail é '\"></div></div><div class=\"col-auto\"><div class=\"form-group\"><label for=\"nome_prox[]\" class=\"control-label\">Nome da proxima função:</label><input type=\"text\" class=\"form-control\" name=\"nome_prox[]\" id=\"nome_prox\" placeholder=\"Ex: 'cpf'\"></div></div></div></div>";

var file = "<div class=\"app-entry-form-section\" id=\"file\"><div class=\"section-title\">Arquivos</div><div class=\"row\"> @@if ($mode == 'create') <div class=\"form-group\"><label for=\"file\" class=\"control-label col-lg-12 col-sm-12 text-left\">Enviar arquivo...</label><div class=\"col-12\">{!!$data -> files('file') -> url($data -> getUploadUrl('file')) -> uploader()!!}</div></div>@@elseif ($mode == 'edit')<div class=\"form-group\"><label for=\"file\" class=\"control-label col-lg-12 col-sm-12 text-left\">{{ trans('chatbox::chatbox.label.file') }}</label><div class=\"col-12\">{!!$data -> files('file') -> url($data -> getUploadUrl('file')) -> uploader()!!}</div></div>@@elseif ($mode == 'show')<div class=\"col-12\">{!!$data -> files('file')!!}</div>@@endif</div>{!!Form::hidden('file') !!}</div>";

//Adicionar o HTML da função
$(document).on('change','#tipoPergunta',function(){
  //Receber o valor das opções de funcoes
  var value = this.options[this.selectedIndex].value;

  if (value == 'desabilitado'){
    $("#showFunc").append(formText);
    $("#meta").append("<button" + buttonDelete).attr("id", "meta-" + value);
    $("#meta-desabilitado button").attr("id", "delete-" + value);

  }
  else if (value == 'perguntaUnica'){
    $("#showFunc").append(formPerguntaUnica);
    $("#meta").append("<button" + buttonDelete).attr("id", "meta-" + value);
    $("#meta-perguntaUnica button").attr("id", "delete-" + value);

  }
  else if (value == 'respostaUnica'){
    $("#showFunc").append(formRespostaUnica);
    $("#meta").append("<button" + buttonDelete).attr("id", "meta-" + value);
    $("#meta-respostaUnica button").attr("id", "delete-" + value);
  }
  else if (value == 'anexo'){
    $("#showFunc").append(formAnexo);
    $("#meta").append("<button" + buttonDelete).attr("id", "meta-" + value);
    $("#meta-anexo button").attr("id", "delete-" + value);
  }
  else if (value == 'imagem'){
    $("#showFunc").append(formImagem);
    $("#meta").append("<button" + buttonDelete).attr("id", "meta-" + value);
    $("#meta-imagem button").attr("id", "delete-" + value);
  }

});

//Remover os forms adicionados
$(document).on( "click", "#delete-desabilitado", function() {
  $("#meta-desabilitado").remove();
});

$(document).on( "click", "#delete-perguntaUnica", function() {
  $("#meta-perguntaUnica").remove();
});

$(document).on( "click", "#delete-respostaUnica", function() {
  $("#meta-respostaUnica").remove();
});

$(document).on( "click", "#delete-anexo", function() {
  $("#meta-anexo").remove();
});

$(document).on( "click", "#delete-imagem", function() {
  $("#meta-imagem").remove();
});

//Pegar valor do formulario na pagina entry.blade no modo = SHOW (input conversa)
$(document).on( "click", "#tipoPergunta", function() {
  //var conversa = $("input #conversa").val();
  $("#showFunc").append("<div>teste</div>");//.attr("id", conversa);
});

