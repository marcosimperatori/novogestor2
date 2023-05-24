$(document).ready(function () {
  const DATATABLE_PTBR = {
    sEmptyTable: "Nenhum registro encontrado",
    sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    sInfoEmpty: "Mostrando 0 até 0 de 0 registros",
    sInfoFiltered: "(Filtrados de _MAX_ registros)",
    sInfoPostFix: "",
    sInfoThousands: ".",
    sLengthMenu: "_MENU_ resultados por página",
    sLoadingRecords: "Carregando...",
    sProcessing: "Processando...",
    sZeroRecords: "Nenhum registro encontrado",
    sSearch: "Pesquisar",
    oPaginate: {
      sNext: "Próximo",
      sPrevious: "Anterior",
      sFirst: "Primeiro",
      sLast: "Último",
    },
    oAria: {
      sSortAscending: ": Ordenar colunas de forma ascendente",
      sSortDescending: ": Ordenar colunas de forma descendente",
    },
    select: {
      rows: {
        _: "Selecionado %d linhas",
        0: "Nenhuma linha selecionada",
        1: "Selecionado 1 linha",
      },
    },
  };

  $("#tableclientes").DataTable({
    oLanguage: DATATABLE_PTBR,
    ajax: "/clientes/recuperaclientes",
    columns: [
      {
        data: "apelido",
      },
      {
        data: "email",
      },
      {
        data: "ativo",
      },
    ],
    deferRender: true,
    processing: true,
    language: {
      processing: '<i class"fa fa-spinner fa-spin fa-3x fa-fw"></i>',
    },
    responsive: true,
    pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
    pageLength: 10,
  });

  $("#form_cad_customer").on("submit", function (e) {
    e.preventDefault();

    if ($(this).hasClass("insert")) {
      url = "cadastrar"; // URL para inserir
    } else if ($(this).hasClass("update")) {
      url = "/administracao/clientes/atualizar"; // URL para atualizar
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
        $("#form_cad_customer").LoadingOverlay("show", {
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
            window.location.href = "/administracao/clientes";
          }
        } else {
          //existem erros de validação

          $("#response").html(
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
            response.erro +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            "</button>" +
            "</div>"
          );

          if (response.erros_model) {
            $.each(response.erros_model, function (key, value) {
              $("#response").append(
                '<ul class="list-unstyled"><li class="text-danger alert-danger">' +
                value +
                "</li></ul>"
              );
            });
          }
        }
      },
      error: function () {
        alert("falha ao executar a operação");
        $("#btn-salvar").val("Salvar");
        $("#btn-salvar").removeAttr("disabled");
      },
      complete: function () {
        $("#form_cad_customer").LoadingOverlay("hide");
      },
    });
  });

  $('#list-users').change(function () {
    if ($(this).val() === '') {
      $('#resumodp').addClass('d-none');
    } else {
      var idUser = $(this).val();

      $.ajax({
        url: "/administracao/empresasdousuario",
        data: { id: idUser },
        dataType: "json",
        beforeSend: function () {
          $(".busca-user").LoadingOverlay("show", {
            background: "rgba(165, 190, 100, 0.5)",
          });
        },
        success: function (response) {
          $("#totalempresa").text(response.totalEmpresas);
          $('#resumodp').removeClass('d-none');
          /*  var usuario = response.usuario;
  
            if (usuario != '') {
              $("#lastlogin").text(usuario.ultimo_login);
              $("#status").text(usuario.ativo);
            } else {
              $('#resumodp').addClass('d-none');
            }*/
        },
        error: function () {
        },
        complete: function () {
          $(".busca-user").LoadingOverlay("hide");
        },
      });
    }
  });
});
