$(document).ready(function () {

  $("#tableusers").DataTable({
    oLanguage: DATATABLE_PTBR,
    ajax: {
      url: "usuarios/recuperausuarios",
      beforeSend: function () {
        $("#tableusers").LoadingOverlay("show", {
          background: "rgba(165, 190, 100, 0.5)",
        });
      },
      complete: function () {
        $("#tableusers").LoadingOverlay("hide");
      },
    },
    columns: [
      {
        data: "imagem",
      },
      {
        data: "nome",
      },
      {
        data: "email",
      },
      {
        data: "ativo",
      },
    ],
    deferRender: true,
    processing: false,
    language: {
      processing: '<i class"fa fa-spinner fa-spin fa-3x fa-fw"></i>',
    },
    responsive: true,
    pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
    pageLength: 10,
  });

  $("#form_cad_user").on("submit", function (e) {
    e.preventDefault();

    if ($(this).hasClass("insert")) {
      url = "cadastrar"; // URL para inserir
    } else if ($(this).hasClass("update")) {
      url = "/usuarios/atualizar"; // URL para atualizar
    }

    $.ajax({
      type: "POST",
      url: url,
      data: new FormData(this),
      dataType: "json",
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function () {
        $("#response").html("");
        $("#btn-salvar").val("Aguarde...");
        $("#form_cad_user").LoadingOverlay("show", {
          background: "rgba(165, 190, 100, 0.5)",
        });
      },
      success: function (response) {
        $("#btn-salvar").val("Salvar");
        $("#btn-salvar").removeAttr("disabled");

        $("[name=csrf_test_name]").val(response.token);

        if (!response.erro) {
          if (response.info) {
            $("#response").html(
              '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
              response.info +
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
              '<span aria-hidden="true">&times;</span>' +
              "</button>" +
              "</div>"
            );
          } else {
            //tudo certo na atualização, redirecionar o usuário
            window.location.href = "/usuarios";
          }
        } else {
          if (response.erros_model) {
            exibirErros(response.erros_model);
          }
        }
      },
      error: function () {
        $("#btn-salvar").val("Salvar");
        $("#btn-salvar").removeAttr("disabled");
      },
      complete: function () {
        $("#form_cad_user").LoadingOverlay("hide");
      },
    });
  });

  $("#carregarImagemLink").click(function (event) {
    event.preventDefault();
    $("#imagemInput").click();
  });

  $("#imagemInput").change(function (event) {
    var imagem = $("#imagemPreview")[0];
    imagem.src = URL.createObjectURL(event.target.files[0]);
    imagem.onload = function () {
      URL.revokeObjectURL(imagem.src);
    };
  });

  $("#user_depto").change(function (e) {
    var valorSelecionado = $(this).val();
    //alert("selecionou depto: " + valorSelecionado);
  });

  $(".delete-user").on("click", function () {
    var id = $(this).data("id");
    var nome = $(this).data("nome");
    var token = $('input[name="csrf_test_name"]').val();
    $("#nome-user").text(nome);
    $("#excluir-user").data("iduser", id);
    $("#token").attr("value", token);
    $("#token").attr("name", csrf_test_name);
  });

  $("#excluir-user").on("click", function () {
    var idUsuario = $(this).data("iduser");
    csrfToken = $('input[name="csrf_test_name"]').val();

    $.ajax({
      type: "POST",
      headers: {
        "X-CSRF-Token": csrfToken,
      },
      url: "/usuarios/excluir",
      data: { id: idUsuario },
      beforeSend: function () { },
      success: function (response) {
        window.location.href = "/usuarios";
      },
      error: function () {
        alert("Falha ao tentar excluir o registro!");
      },
      complete: function () { },
    });
  });

  /* $(document).ajaxSend(function (event, jqxhr, settings) {
    $.LoadingOverlay("show", {
      background: "rgba(165, 190, 100, 0.5)",
    });
  });*/
  /*$(document).ajaxComplete(function (event, jqxhr, settings) {
    $.LoadingOverlay("hide");
  });*/
});
