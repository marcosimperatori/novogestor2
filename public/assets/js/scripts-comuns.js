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

function exibirErros(erros_model) {
    $.each(erros_model, function (key, value) {
        var errorElement = $('[name="' + key + '"]');
        if (errorElement.length) {
            var errorContainer = errorElement.next('.error');
            if (errorContainer.length === 0) {
                errorContainer = $('<div class="error text-danger" style="font-size: 13px"></div>');
                errorElement.after(errorContainer);
            }
            errorContainer.text(value);

            errorElement.on('input', function () {
                errorContainer.remove();
            });
        }
    });
}

function createToast(icone, titulo, mensagem, idElementoHtml) {
    // Criar elemento do toast
    var toastEl = document.createElement('div');
    toastEl.classList.add('toast');
    toastEl.setAttribute('role', 'alert');
    toastEl.setAttribute('aria-live', 'assertive');
    toastEl.setAttribute('aria-atomic', 'true');
    toastEl.setAttribute('name', 'msgtouser');

    var meuHtml = ' <div class="toast-header">' +
        '<strong class="mr-auto">' + icone + '&nbsp;' + titulo + '</strong>' +
        `<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Fechar">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="toast-body">` +
        mensagem +
        '</div>';

    toastEl.innerHTML = meuHtml;

    // Adicionar toast ao container
    var toastContainer = document.getElementById(idElementoHtml);
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