<?php echo $this->extend('layout/principal'); ?>

<?php echo $this->section('conteudo'); ?>
<div class="my-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo site_url("/"); ?>">Home</a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url("administracao"); ?>">Administração</a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url("administracao/clientes"); ?>">Clientes</a></li>
      <li class="breadcrumb-item active" aria-current="page">Cadastro de cliente</li>
    </ol>
  </nav>
</div>

<section>
  <div id="response"></div>
  <div class="jumbotron">

    <?php echo form_open('/', ['id' => 'form_cad_customer', 'class' => 'update'], ['id' => "$cliente->id"]) ?>

    <?php echo $this->include('clientes/_form'); ?>

    <div class="row">
      <div class="col-6">
        <div class="form-group mt-4 text-left">
          <a href="#" class="btn btn-danger btn-sm ml-2 delete-user mb-2" data-id="<?php echo $cliente->id; ?>" data-nome="<?php echo $cliente->razao; ?>" data-toggle="modal" data-target="#excluirModal">Excluir</a>
        </div>
      </div>
      <div class="col-6">
        <div class="form-group mt-4 text-right">
          <a href="<?php echo site_url("administracao/clientes"); ?>" class="btn btn-secondary btn-sm ml-2 mb-2">Cancelar</a>
          <input id="btn-salvar" type="submit" value="Salvar" class="btn btn-success btn-sm mr-e mb-2">
        </div>
      </div>
    </div>

    <?php form_close(); ?>
  </div>

</section>

<!-- Modal -->
<div class="modal fade" id="excluirModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title card-text" id="exampleModalLabel">
          <i class="fas fa-exclamation-triangle text-danger"></i>
          Atenção!
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        Confirma a <strong>exclusão</strong> do Cliente atual? <br>
        <p id="nome-user" class="font-weight-bold text-danger text-uppercase"></p>
        <input type="hidden" id="token">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
        <button id="excluir-user" data-iduser="" type="button" class="btn btn-danger btn-sm">Excluir</button>
      </div>
    </div>
  </div>
</div>

<?php $this->endSection(); ?>