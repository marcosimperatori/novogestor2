<?php echo $this->extend('layout/principal'); ?>

<?php echo $this->section('conteudo'); ?>
<div class="my-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo site_url("/"); ?>">Home</a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url("administracao"); ?>">Administração</a></li>
      <li class="breadcrumb-item active" aria-current="page">Usuários do sistema</li>
    </ol>
  </nav>
</div>

<section class="jumbotron">
  <div class="row">
    <div class="col-lg-12">
      <a href="<?php echo site_url('usuarios/criar'); ?>" class="btn btn-primary btn-sm mb-4" title="Permite incluir um novo usuário no sistema">Novo usuário</a>

      <div class="table-responsive">
        <table id="tableusers" class="table table-striped table-sm" style="width: 100%;">
          <thead>
            <tr>
              <th>Imagem</th>
              <th>Nome</th>
              <th>Email</th>
              <th>Situação</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  </div>
</section>



<?php $this->endSection(); ?>