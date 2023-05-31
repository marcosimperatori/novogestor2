

function formatarData() {
    // Suponha que você tenha uma variável chamada "data" que contém o valor da data persistida no banco de dados
    const data = new Date('2023-05-15');

    // Formate a data para exibir apenas o mês e o ano
    const dataFormatada = data.toLocaleString('pt-BR', { month: '2-digit', year: 'numeric' });

    // Atribua o valor formatado ao input
    const campo = document.getElementById('inicio'); // Substitua 'seu-input' pelo ID do seu input
    campo.value = dataFormatada;
}

$("#idcliente").selectize({
    valueField: "id",
    labelField: "apelido",
    searchField: "apelido",
    placeholder: "Pesquisar cliente",
    maxItems: 1,
    render: {
        option: function (item, escape) {
            return (
                '<div class="font-weight-bold text-primary ml-1"><i class="fas fa-long-arrow-alt-right text-secondary"></i>&nbsp;&nbsp;' + item.codigo + ' - ' + item.apelido +
                '<br><small class="text-dark text-uppercase ml-3">' + item.razao + ' - ' + item.cnpj + '</small></div>'

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

$("#iditem").selectize({
    valueField: "id",
    labelField: "nome",
    searchField: "nome",
    placeholder: "Pesquisar item",
    plugins: ['remove_button'],
    closeAfterSelect: true,
    maxItems: 1,
    render: {
        option: function (item, escape) {
            return (
                '<div class="text-primary ml-1"><b><i class="fas fa-long-arrow-alt-right text-secondary"></i>&nbsp;&nbsp;' + item.nome + '</div>'
            );
        },
    },
    load: function (query, callback) {
        if (query.length < 2) return callback();

        $.ajax({
            url: "/itens/consulta",
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

function limparCampos() {
    $('#iditem').val('');
    $('#inicio').val('');
    $('#final').val('');
    var selectize = $('#iditem')[0].selectize;
    selectize.clear();
}

function exibirMsgErros(erros_model) {
    $.each(erros_model, function (key, value) {
        var errorElement = $('[name="' + key + '"]');

        if (errorElement.length) {
            var errorContainer = errorElement.closest('.msg-erros').find('.error');
            if (errorContainer.length === 0) {
                errorContainer = $('<div class="error text-danger" style="font-size: 13px"></div>');
                errorElement.closest('.msg-erros').append(errorContainer);
            }
            errorContainer.text(value).show();

            errorElement.on('change', function () {
                errorContainer.hide();
            });
        }
    });
}


// Captura o evento de submissão do formulário
$("#form_cad_controle").on("submit", function (e) {
    e.preventDefault(); // Impede o envio normal do formulário    
    // Obtém o valor selecionado do campo idcliente
    var idcliente = $("#idcliente").val();
    var iditem = $("#iditem").val();

    $.ajax({
        type: "POST",
        url: '/clientes/itens/cadastrar',
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $("#response").html("");
            $("#form_cad_controle").LoadingOverlay("show", {
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
                } else if (response.info2) {
                    $("#response2").html(
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        response.info2 +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span>' +
                        "</button>" +
                        "</div>"
                    );
                }
                else {
                    $("#iditem").focus();
                    $("#form_cad_controle").LoadingOverlay("hide");
                    listarControlesCliente();
                    limparCampos();
                }
            } else {
                if (response.erros_model) {
                    exibirMsgErros(response.erros_model);
                }
            }
        },
        complete: function () {
            $("#form_cad_controle").LoadingOverlay("hide");
        },
    });
});

$('#idcliente').change(function () {
    listarControlesCliente();
});


function listarControlesCliente() {
    var idUser = $('#idcliente').val();


    $('#tab-itens-controle').DataTable().destroy();

    $('#tab-itens-controle').DataTable({
        oLanguage: DATATABLE_PTBR,
        ajax: {
            data: { id: idUser },
            url: "/itens/controlecliente",
            beforeSend: function () {
                $("#tab-itens-controle").LoadingOverlay("show", {
                    background: "rgba(165, 190, 100, 0.5)",
                });
            },
            complete: function () {
                $("#tab-itens-controle").LoadingOverlay("hide");
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
                data: "inicio",
            },
            {
                data: "fim",
            },
            {
                data: "tipo",
            },
            {
                data: "acao",
            }
        ],
        processing: false,
        deferRender: true,
        responsive: true,
        pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
        pageLength: 10,
        columnDefs: [
            {
                width: '80px', targets: [2, 3]
            },
            {
                width: '100px', targets: [1]
            },
            {
                width: '170px', targets: [4]
            },
            {
                width: '150px', targets: [5]
            },
            {
                className: 'text-center', targets: [2, 3, 5]
            },
        ]
    });
}

$(window).on('load', function () {
    //formatarData();
    listarControlesCliente();
});

$('#tab-itens-controle').on('click', '#excluir-item-controlado', function () {
    var registro = $(this).data('idcontrole');
    var descricao = $(this).data('descricao');

    $("#descricao-citem").text(descricao);
    $("#excluir-controle").data("iduser", registro);
});

$('#tab-itens-controle').on('click', '#editar-item-controlado', function () {
    var registro = $(this).data('idcontrole');
    var descricao = $(this).data('descricao');
    var final = $(this).data('compfim');
    csrfToken = $('input[name="csrf_test_name"]').val();

    $("#descricao-citem").text(descricao);
    $("#excluir-controle").data("iduser", registro);
    $("#token").attr("value", csrfToken);
    $("#token").attr("name", csrf_test_name);
});

$("#excluir-controle").on("click", function () {
    var idControle = $('#excluir-controle').data('iduser');
    csrfToken = $('input[name="csrf_test_name"]').val();

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-Token": csrfToken,
        },
        url: "/clientes/item/excluir",
        data: { id: idControle },
        beforeSend: function () { },
        success: function (response) {
            $("[name='csrf_test_name']").val(response.token);
            listarControlesCliente();
        },
        error: function () {
            alert("Falha ao tentar excluir o registro!");
        },
        complete: function () {
            fecharModal('#cancela-exclusao');
        },
    });
});

function fecharModal(idModal) {
    var botao = $(idModal);
    // Simulando o clique no botão
    botao.trigger('click');
}