function carregarDados(parametro) {
  $("#lista_tarefas").DataTable().clear().destroy();
  $("#lista_tarefas").DataTable({
    oLanguage: DATATABLE_PTBR,
    ajax: {
      url: "/tarefas/lista",
      data: {
        parametro: parametro,
      },
      beforeSend: function () {
        $("#lista_tarefas").LoadingOverlay("show", {
          background: "rgba(165, 190, 100, 0.5)",
        });
      },
      complete: function () {
        $("#lista_tarefas").LoadingOverlay("hide");
      },
    },
    columns: [
      {
        data: "vencimento",
      },
      {
        data: "titulo",
      },
      {
        data: "status",
      },
      {
        data: "cliente",
      },
      {
        data: "depto",
      },
      {
        data: "imagem",
      },
    ],
    deferRender: true,
    processing: false,
    language: {
      processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
    },
    responsive: true,
    pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
    pageLength: 10,
    columnDefs: [
      {
        width: "105px",
        targets: [0],
      },
      {
        width: "280px",
        targets: [3],
      },
      {
        width: "90px",
        targets: [2],
      },
      {
        width: "30px",
        targets: [4],
      },
      {
        className: "text-center",
        targets: [0, 4, 5],
      },
    ],
  });
}

let dono = "";

if ($("#dono").is(":checked")) {
  //pegar id do usuário da sessão do usuário, assim o back filtrará apenas solicitações do usuário
}

let valorSelecionado = $("#lista-status").val();
carregarDados(valorSelecionado);

$("#lista-status").on("change", function () {
  let valorSelecionado = $(this).val();
  carregarDados(valorSelecionado);
});

$("#idcliente").selectize({
  valueField: "id",
  labelField: "apelido",
  searchField: ["apelido", "codigo"],
  placeholder: "Pesquisar cliente",
  maxItems: 1,
  render: {
    option: function (item, escape) {
      return (
        '<div class="font-weight-bold text-primary ml-1"><i class="fas fa-long-arrow-alt-right text-secondary"></i>&nbsp;&nbsp;' +
        item.codigo +
        " - " +
        item.apelido +
        '<br><small class="text-dark text-uppercase ml-3">' +
        item.razao +
        " - " +
        item.cnpj +
        "</small></div>"
      );
    },
  },
  load: function (query, callback) {
    if (query.length < 2) return callback();

    $.ajax({
      url: "/clientes/consulta",
      data: {
        q: query,
      },
      dataType: "json",
      success: function (response) {
        callback(response.data);
      },
    });
  },
});

$("#idusuario").selectize({
  valueField: "id",
  labelField: ["nome"],
  searchField: ["nome", "depto"],
  placeholder: "Pesquisar usuário / departamento",
  maxItems: 1,
  render: {
    option: function (item, escape) {
      return (
        '<div class="font-weight-bold text-primary ml-1 text-lg"><i class="fas fa-long-arrow-alt-right text-secondary"></i>&nbsp;&nbsp;' +
        item.nome +
        '<br><small class="text-dark text-uppercase ml-3">' +
        "Alocação: " +
        item.depto +
        "</small></div>"
      );
    },
  },
  load: function (query, callback) {
    if (query.length < 2) return callback();

    $.ajax({
      url: "/usuarios/consulta",
      data: {
        q: query,
      },
      dataType: "json",
      success: function (response) {
        callback(response.data);
      },
    });
  },
});
