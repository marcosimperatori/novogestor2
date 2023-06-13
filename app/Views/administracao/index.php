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
  <div class="row text-center my-2">
    <div class="col-lg-6 mb-2">
      <div id="chart_certificados" style="width: 100%; height: 400px;"></div>
    </div>
    <div class="col-lg-6 mb-2">
      <div id="chart_funcdepto" style="width: 100%; height: 400px;"></div>
    </div>
  </div>

  <div class="row text-center my-2">
    <div class="col-lg-12 mb-2">
      <div id="chart_tipo2" style="width: 100%; height: 400px;"></div>
    </div>
  </div>


</div>
<?php $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>


<script src="<?php echo site_url("assets/js/scripts.js") ?>"></script>

<script src="<?php echo site_url("assets/js/chart.administracao.js"); ?>"> </script>
<script>
  window.addEventListener('load', function() {
    carregarGraficos();
  });
</script>
<?php $this->endSection(); ?>