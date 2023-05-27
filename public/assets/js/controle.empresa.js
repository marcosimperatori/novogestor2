


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


// Captura o evento de submissão do formulário
$("#form_cad_controle").submit(function (event) {
    event.preventDefault(); // Impede o envio normal do formulário

    // Obtém o valor selecionado do campo idcliente
    var idcliente = $("#idcliente").val();
    var iditem = $("#iditem").val();

    // Faça algo com o valor selecionado
    console.log("cliente: " + idcliente + "  itens: " + iditem);

    // ...continua com o processamento do formulário
});

$('#idcliente').change(function () {
    var idcliente = $("#idcliente").val();
    if (idcliente.length) {
        alert('selecionou: ' + idcliente);
    }
});