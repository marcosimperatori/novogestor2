<?php echo $this->extend('layout/principal'); ?>

<?php echo $this->section('conteudo'); ?>
<div class="my-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo site_url("/"); ?>">Home</a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url("administracao"); ?>">Administração</a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url("administracao/itemcontrole"); ?>">Itens de controle</a></li>
      <li class="breadcrumb-item active" aria-current="page">Editando item</li>
    </ol>
  </nav>
</div>

<section>
  <div id="response"></div>
  <div class="jumbotron">
    <?php echo form_open_multipart('/', ['id' => 'form_cad_item', 'class' => 'update'], ['id' => "$itemcontrole->id"]) ?>
    <div class="row">
      <div class="col-lg-12">
        <?php echo $this->include('administracao/itemcontrole/_form'); ?>
        <div class="row">
          <div class="col-6">
            <div class="form-group mt-4 text-left">
              <a href="#" class="btn btn-danger btn-sm ml-2 delete-user mb-2" data-id="<?php echo $itemcontrole->id; ?>" data-nome="<?php echo $itemcontrole->nome; ?>" data-toggle="modal" data-target="#excluirModal">Excluir</a>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group mt-4 text-right">
              <input id="btn-salvar" type="submit" value="Salvar" class="btn btn-success btn-sm mr-e mb-2">
              <a href="<?php echo site_url("administracao/itemcontrole"); ?>" class="btn btn-secondary btn-sm ml-2 mb-2">Cancelar</a>
            </div>
          </div>
        </div>
      </div>
      <?php form_close() ?>
    </div>
  </div>
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="excluirModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title card-text" id="exampleModalLabel">Atenção!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        Confirma a <strong>exclusão</strong> do registro atual (<strong id="nome-user" class="text-danger"></strong>)?
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


<?php echo $this->section('scripts'); ?>

<script src="<?php echo site_url("assets/js/item.controle.js") ?>"></script>

<?php $this->endSection(); ?>