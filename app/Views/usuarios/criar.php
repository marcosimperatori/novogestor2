<?php echo $this->extend('layout/principal'); ?>

<?php echo $this->section('conteudo'); ?>
<div class="my-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo site_url("/"); ?>">Home</a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url("administracao"); ?>">Administração</a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url("usuarios"); ?>">Usuários</a></li>
      <li class="breadcrumb-item active" aria-current="page">Cadastro do usuário</li>
    </ol>
  </nav>
</div>

<section>
  <div class="jumbotron">
    <div id="response"></div>
    <?php echo form_open_multipart('/', ['id' => 'form_cad_user', 'class' => 'insert'], ['id' => "$usuario->id"]) ?>
    <div class="row">
      <div class="col-lg-3 mt-2">
        <div class="text-center">
          <img id="imagemPreview" src="<?php echo site_url('assets/img/user_sem_imagem.png'); ?>" class="card-img-top" style="height: 200px; width: 180px;" alt="usuário sem imagem">
          <br>
          <a id="carregarImagemLink" href="#" class="btn btn-outline-success btn-sm mt-3">Carregar imagem</a>
          <input id="imagemInput" name="imagem" type="file" style="display: none;" accept=".jpg,.jpeg,.png">
        </div>
        <br>
      </div>

      <div class="col-lg-9">
        <?php echo $this->include('usuarios/_form'); ?>
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