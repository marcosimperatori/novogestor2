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

var valorSelecionado = $("#lista-status").val();
carregarDados(valorSelecionado);

$("#lista-status").on("change", function () {
  var valorSelecionado = $(this).val();
  carregarDados(valorSelecionado);
});
