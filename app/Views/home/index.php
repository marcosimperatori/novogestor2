<?php echo $this->extend('layout/principal'); ?>

<?php echo $this->section('conteudo'); ?>

<div class="jumbotron jumbotron-fluid">
  <div class="row justify-content-center mx-3">
    <div class="col-sm-3">

      <div class="card mt-2 bg-light">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-user-cog text-danger"></i>
            Administração
          </h5>
          <hr class="my-4">
          <div class="text-right">
            <a href="<?php echo site_url("administracao"); ?>" class="badge badge-pill badge-primary">Acessar</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-3">

      <div class="card mt-2 bg-light">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-sitemap text-danger"></i>
            Dep. Pessoal</h5>
          <hr class="my-4">
          <div class="text-right">
            <a href="<?php echo site_url("pessoal"); ?>" class="badge badge-pill badge-primary">Acessar</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-3">

      <div class="card mt-2 bg-light">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-sitemap text-danger"></i>
            Dep. Fiscal</h5>
          <hr class="my-4">
          <div class="text-right">
            <a href="<?php echo site_url("fiscal"); ?>" class="badge badge-pill badge-primary">Acessar</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-3">

      <div class="card mt-2 bg-light">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-sitemap text-danger"></i>
            Dep. Contábil</h5>
          <hr class="my-4">
          <div class="text-right">
            <a href="<?php echo site_url("contabil"); ?>" class="badge badge-pill badge-primary">Acessar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="jumbotron jumbotron-fluid">
  <div class="row justify-content-center mx-3">
    <div class="col-sm-3">

      <div class="card text-info bg-light mt-2">
        <div class="card-body">
          <h5 class="card-title"><i class="far fa-address-book"></i>
            Clientes
          </h5>
          <hr class="my-4">
          <div class="text-right">
            <a href="#" class="badge badge-pill badge-primary">Acessar</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-3">

      <div class="card mt-2  bg-light">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-tasks text-primary"></i>
            Tarefas</h5>
          <hr class="my-4">
          <div class="text-right">
            <a href="#" class="badge badge-pill badge-primary">Acessar</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card mt-2 text-danger bg-light">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-comment-dots"></i>
            Prontuários</h5>
          <hr class="my-4">
          <div class="text-right">
            <a href="#" class="badge badge-pill badge-primary">Acessar</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card mt-2 text-success bg-light">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-folder-open"></i>
            Conteúdo</h5>
          <hr class="my-4">
          <div class="text-right">
            <a href="#" class="badge badge-pill badge-primary">Acessar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->endSection(); ?>