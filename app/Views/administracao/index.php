<?php echo $this->extend('layout/principal'); ?>

<?php echo $this->section('conteudo'); ?>

<div class="my-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo site_url("/"); ?>">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Administração</li>
    </ol>
  </nav>
</div>

<div class="jumbotron">
  <div class="row">
    <div class="col-lg-3 text-center mt-2">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-handshake text-danger"></i>
          Admissão de cliente
        </div>
        <div class="card-body">
          <a href="#" class="card-link btn btn-primary btn-sm">Acessar</a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 text-center mt-2">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-tools text-danger"></i>
          Alteração contratual
        </div>
        <div class="card-body">
          <a href="#" class="card-link btn btn-primary btn-sm">Acessar</a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 text-center mt-2">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-thumbs-up text-danger"></i>
          Obrigações da empresa
        </div>
        <div class="card-body">
          <a href="<?php echo site_url("administracao/controlecliente") ?>" class="card-link btn btn-primary btn-sm">Acessar</a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 text-center mt-2">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-wrench text-danger"></i>
          Alterar responsável
        </div>
        <div class="card-body">
          <a href="<?php echo site_url("administracao/config-responsavel") ?>" class="card-link btn btn-primary btn-sm">Acessar</a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 text-center mt-2">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-address-card text-danger"></i>
          Clientes
        </div>
        <div class="card-body">
          <a href="<?php echo site_url("administracao/clientes") ?>" class="card-link btn btn-primary btn-sm">Acessar</a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 text-center mt-2">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-users-cog text-danger"></i>
          Usuários
        </div>
        <div class="card-body">
          <a href="<?php echo site_url("usuarios"); ?>" class="card-link btn btn-primary btn-sm">Acessar</a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 text-center mt-2">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-grip-horizontal text-danger"></i>
          Itens de controle
        </div>
        <div class="card-body">
          <a href="<?php echo site_url("administracao/itemcontrole"); ?>" class="card-link btn btn-primary btn-sm">Acessar</a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 text-center mt-2">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-unlock-alt text-danger"></i>
          Permissões
        </div>
        <div class="card-body">
          <a href="#" class="card-link btn btn-primary btn-sm">Acessar</a>
        </div>
      </div>
    </div>
  </div>

</div>


<div class="jumbotron">
  <h5>colocar gráficos que mostram a utilização do sistema pelos usuários, exemplo: qtde de prontuários criados; qtde de inserçoes na base de conhecimento; etc.</h5>
</div>
<?php $this->endSection(); ?>