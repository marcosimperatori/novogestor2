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
        data: "vecto",
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
    columnDefs: [
      {
        width: '100px', targets: [1, 2]
      },
      {
        width: '90px', targets: [2]
      },
      {
        className: 'text-center', targets: [1]
      },
    ]
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

  function empresasSemUsuario() {
    var id = $('#list-users').val();
    $('#emp-sem-user').DataTable().destroy();

    $('#emp-sem-user').DataTable({
      oLanguage: DATATABLE_PTBR,
      ajax: {
        data: { id: id },
        url: "/administracao/divisaoempresas",
        beforeSend: function () {
        },
        complete: function () {
        },
      },
      columns: [
        {
          data: "codigo",
        },
        {
          data: "apelido",
        },
        /* {
           data: "acao",
           render: function (data) {
             return data;
           }
         },*/
        {
          data: "imagem",
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
          width: '300px', targets: [2]
        },
        {
          className: 'text-center', targets: [2]
        },
        /*  {
            targets: [0],
            render: function (data, type, row) {
              return '<div class="vertical-align">' + data + '</div>';
            }
          }*/
      ]
    });
  }

  function outrosUsuarios() {
    var id = $('#list-users').val();
    $('#emp-outro-user').DataTable().destroy();

    $('#emp-outro-user').DataTable({
      oLanguage: DATATABLE_PTBR,
      ajax: {
        data: { id: id },
        url: "/administracao/empresasoutroresponsavel",
        beforeSend: function () {
        },
        complete: function () {
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
          width: '60px', targets: [3]
        },
        {
          className: 'text-center', targets: [2, 3]
        }
      ]
    });
  }

  function empresasDoUsuario() {
    var id = $('#list-users').val();
    $('#emp-user-select').DataTable().destroy();

    $('#emp-user-select').DataTable({
      oLanguage: DATATABLE_PTBR,
      ajax: {
        data: { id: id },
        url: "/administracao/empresasresponsavel",
        beforeSend: function () {
        },
        complete: function () {
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
          width: '90px', targets: [2]
        },
        {
          className: 'text-center', targets: [2]
        },
        {
          width: '60px', targets: [3]
        },
        {
          className: 'text-center', targets: [2, 3]
        }
      ]
    });
  }

  function carregarDados() {
    empresasSemUsuario();
    outrosUsuarios();
    empresasDoUsuario();
  }

  function createToast(icone, mensagem) {
    // Criar elemento do toast
    var toastEl = document.createElement('div');
    toastEl.classList.add('toast');
    toastEl.setAttribute('role', 'alert');
    toastEl.setAttribute('aria-live', 'assertive');
    toastEl.setAttribute('aria-atomic', 'true');
    toastEl.setAttribute('name', 'msgtouser');

    var meuHtml = ' <div class="toast-header">' +
      '<strong class="mr-auto">' + icone + '&nbsp;Registro atualizado</strong>' +
      `<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Fechar">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="toast-body">` +
      mensagem +
      '</div>';

    toastEl.innerHTML = meuHtml;

    // Adicionar toast ao container
    var toastContainer = document.getElementById('toastContainer');
    toastContainer.appendChild(toastEl);

    // Criar objeto Toast
    var toast = new bootstrap.Toast(toastEl, {
      //autohide: true, // Esconder o toast automaticamente
      delay: 5000
    });

    console.log('aqui');
    // Adicionar evento de ocultação do toast
    toastEl.addEventListener('hidden.bs.toast', function () {
      // Remover o elemento do toast do seu container pai
      toastEl.parentNode.removeChild(toastEl);
    });

    // Exibir o toast
    toast.show();
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
        $("[name='csrf_test_name']").val(response.token);
        var icone = '<i class="fas fa-check-circle text-success"></i>';
        var mensagem = 'Sua ação foi executada com sucesso!';
        createToast(icone, mensagem);
        outrosUsuarios();
        empresasSemUsuario();
      },
      error: function () {
        var icone = '<i class="fas fa-thumbs-down text-danger"></i>';
        var mensagem = 'Falha ao executar a ação!';
        createToast(icone, mensagem);
      },
    });
  });

  $('#emp-user-select').on('click', '#usuario-ativo', function () {
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
        $("[name='csrf_test_name']").val(response.token);
        var icone = '<i class="fas fa-check-circle text-success"></i>';
        var mensagem = 'Sua ação foi executada com sucesso!';
        createToast(icone, mensagem);
        empresasDoUsuario();
        empresasSemUsuario();
      },
      error: function () {
        var icone = '<i class="fas fa-thumbs-down text-danger"></i>';
        var mensagem = 'Falha ao executar a ação!';
        createToast(icone, mensagem);
      },
    });
  });

  $('#emp-sem-user').on('click', '#img-usuario', function () {
    var usuario = $(this).data('usuario');
    var empresa = $(this).data('empresa');
    csrfToken = $('input[name="csrf_test_name"]').val();

    $.ajax({
      type: "POST",
      headers: {
        "X-CSRF-Token": csrfToken,
      },
      url: "/responsavel/vincular",
      data: { idUsuario: usuario, idCliente: empresa },
      success: function (response) {
        $("[name='csrf_test_name']").val(response.token);
        var icone = '<i class="fas fa-check-circle text-success"></i>';
        var mensagem = 'Sua ação foi executada com sucesso!';
        createToast(icone, mensagem);
        empresasSemUsuario();
        empresasDoUsuario();
        outrosUsuarios();
      },
      error: function () {
        var icone = '<i class="fas fa-thumbs-down text-danger"></i>';
        var mensagem = 'Falha ao executar a ação!';
        createToast(icone, mensagem);
      },
    });
  });


});
