<?php echo $this->extend('layout/principal'); ?>

<?php echo $this->section('conteudo'); ?>
<div class="my-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo site_url("/"); ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo site_url("administracao"); ?>">Administração</a></li>
            <li class="breadcrumb-item active" aria-current="page">Itens de controle do cliente</li>
        </ol>
    </nav>
</div>


<section class="jumbotron">
    <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo site_url('administracao/itemcontrole/criar'); ?>" class="btn btn-primary btn-sm mb-4" title="Permite incluir um novo item de controle no sistema">Novo item</a>
            <button id="teste">toast</button>
            <button id="teste1">toast</button>

            <div class="table-responsive">
                <table id="tab-obrigacoes" class="table table-striped table-sm" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Departamento</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    </div>
</section>

<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
    <div id="toastContainer" class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;"></div>
</div>

<?php $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>

<script src="<?php echo site_url("assets/js/item.controle.js") ?>"></script>

<script>
    $('#teste').on('click', function() {
        createToast('<i class="fas fa-check-circle text-success"></i>', 'toast do marcos', 'estou aqui', 'toastContainer');
    });
    $('#teste1').on('click', function() {
        createToast('<i class="fas fa-check-circle text-danger"></i>', 'aviso', 'notificaçao', 'toastContainer');
    });
</script>

<?php $this->endSection(); ?>