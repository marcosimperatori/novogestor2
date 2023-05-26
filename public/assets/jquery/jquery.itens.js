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


    $("#tab-obrigacoes").DataTable({
        oLanguage: DATATABLE_PTBR,
        ajax: "/administracao/itens",
        columns: [
            {
                data: "nome",
            },
            {
                data: "tipo",
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
                width: '90px', targets: [0]
            },

        ]
    });


});