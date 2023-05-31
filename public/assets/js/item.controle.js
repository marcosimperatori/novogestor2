
$("#tab-obrigacoes").DataTable({
    oLanguage: DATATABLE_PTBR,
    ajax: {
        url: "/administracao/itens",
        beforeSend: function () {
            $("#tab-obrigacoes").LoadingOverlay("show", {
                background: "rgba(165, 190, 100, 0.5)",
            });
        },
        complete: function () {
            $("#tab-obrigacoes").LoadingOverlay("hide");
        },
    },
    columns: [
        {
            data: "nome",
        },
        {
            data: "depto",
        },
        {
            data: "tipo",
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
    columnDefs: [
        {
            width: '180px', targets: 1
        },
        {
            width: '200px', targets: 2
        },
        {
            className: 'text-left', targets: 1
        }
    ]
});

$("#form_cad_item").on("submit", function (e) {
    e.preventDefault();

    if ($(this).hasClass("insert")) {
        url = "/itens/cadastrar"; // URL para inserir
    } else if ($(this).hasClass("update")) {
        url = "/itens/atualizar"; // URL para atualizar
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
            $("#form_cad_item").LoadingOverlay("show", {
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
                    window.location.href = "/administracao/itemcontrole";
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
            $("#form_cad_item").LoadingOverlay("hide");
        },
    });
});