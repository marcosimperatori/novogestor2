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

    <?php echo form_open('/', ['id' => 'form_cad_customer', 'class' => 'insert'], ['id' => "$cliente->id"]) ?>

    <?php echo $this->include('clientes/_form'); ?>

    <div class="form-group mt-4 text-right">
      <a href="<?php echo site_url("usuarios"); ?>" class="btn btn-secondary btn-sm ml-2 mb-2">Cancelar</a>
      <input id="btn-salvar" type="submit" value="Salvar" class="btn btn-success btn-sm mr-e mb-2">
    </div>

    <?php form_close(); ?>
  </div>

</section>



<?php $this->endSection(); ?>