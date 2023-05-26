<?php echo $this->extend('layout/principal'); ?>

<?php echo $this->section('conteudo'); ?>
<div class="my-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo site_url("/"); ?>">Home</a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url("administracao"); ?>">Administração</a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url("administracao/itemcontrole"); ?>">Itens de controle</a></li>
      <li class="breadcrumb-item active" aria-current="page">Cadastro do item</li>
    </ol>
  </nav>
</div>

<section>
  <div class="jumbotron">
    <div id="response"></div>
    <?php echo form_open('/', ['id' => 'form_cad_item', 'class' => 'insert'], ['id' => "$itemcontrole->id"]) ?>
    <div class="row">


      <div class="col-lg-12">
        <?php echo $this->include('administracao/itemcontrole/_form'); ?>
        <div class="form-group mt-4 text-right">
          <input id="btn-salvar" type="submit" value="Salvar" class="btn btn-success btn-sm mr-e mb-2">
          <a href="<?php echo site_url("usuarios"); ?>" class="btn btn-secondary btn-sm ml-2 mb-2">Cancelar</a>
        </div>
      </div>

    </div>
    <?php form_close(); ?>
  </div>
  </div>
</section>



<?php $this->endSection(); ?>