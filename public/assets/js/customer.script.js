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
          $("[name='csrf_test_name']").val(response.token);
        },
        error: function () {
        },
        complete: function () {
          $(".busca-user").LoadingOverlay("hide");
          carregarDados();
        },
      });
    }
  });

  function carregarDados() {
    var id = $('#list-users').val();

    $('#emp-sem-user').DataTable().destroy();
    $('#emp-outro-user').DataTable().destroy();
    $('#emp-user-select').DataTable().destroy();

    $('#emp-sem-user').DataTable({
      oLanguage: DATATABLE_PTBR,
      ajax: {
        url: "/administracao/divisaoempresas",
        beforeSend: function () {
          $(".busca-sem-mov").LoadingOverlay("show", {
            background: "rgba(165, 190, 100, 0.5)",
          });
        },
        complete: function () {
          $(".busca-sem-mov").LoadingOverlay("hide");
        },
      },
      columns: [
        {
          data: "codigo",
        },
        {
          data: "apelido",
        },
        {
          data: "acao",
          render: function (data) {
            return data;
          }
        }
      ],
      deferRender: true,
      responsive: true,
      pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
      pageLength: 10,
      columnDefs: [
        {
          width: '100px', targets: 0
        },
        {
          width: '200px', targets: [2]
        },
        {
          className: 'text-center', targets: [2]
        }
      ]
    });

    $('#emp-outro-user').DataTable({
      oLanguage: DATATABLE_PTBR,
      ajax: {
        data: { id: id },
        url: "/administracao/empresasoutroresponsavel",
        beforeSend: function () {
          $("#busca-sem-mov").LoadingOverlay("show", {
            background: "rgba(165, 190, 100, 0.5)",
          });
        },
        complete: function () {
          $("#busca-sem-mov").LoadingOverlay("hide");
        },
      },
      columns: [
        {
          data: "codigo",
        },
        {
          data: "apelido",
        },
        {
          data: "nome",
        },
        {
          data: "imagem",
        },
        {
          data: "acao",
          render: function (data) {
            return data;
          }
        }
      ],
      deferRender: true,
      processing: true,
      responsive: true,
      pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
      pageLength: 10,
      columnDefs: [
        {
          width: '100px', targets: 0
        },
        {
          width: '80px', targets: [2]
        },
        {
          width: '60px', targets: [3, 4]
        },
        {
          className: 'text-center', targets: [2, 3, 4]
        }
      ]
    });

    $('#emp-user-select').DataTable({
      oLanguage: DATATABLE_PTBR,
      ajax: {
        data: { id: id },
        url: "/administracao/empresasresponsavel",
        beforeSend: function () {
          $("#busca-sem-mov").LoadingOverlay("show", {
            background: "rgba(165, 190, 100, 0.5)",
          });
        },
        complete: function () {
          $("#busca-sem-mov").LoadingOverlay("hide");
        },
      },
      columns: [
        {
          data: "codigo",
        },
        {
          data: "apelido",
        },
        {
          data: "acao",
          render: function (data) {
            return data;
          }
        }
      ],
      deferRender: true,
      processing: true,
      responsive: true,
      pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
      pageLength: 10,
      columnDefs: [
        {
          width: '100px', targets: 0
        },
        {
          width: '90px', targets: [2]
        },
        {
          className: 'text-center', targets: [2]
        }
      ]
    });
  }

  $('#emp-outro-user').on('click', '#outros-usuarios', function () {
    var registro = $(this).data('id');
    csrfToken = $('input[name="csrf_test_name"]').val();

    $.ajax({
      type: "POST",
      headers: {
        "X-CSRF-Token": csrfToken,
      },
      url: "/responsavel/excluir",
      data: { id: registro },
      success: function (response) {
        $('#liveToast').toast('show');
      },
      error: function () {
      },
    });
  });
});
