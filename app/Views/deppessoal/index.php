<?php echo $this->extend('layout/principal'); ?>

<?php echo $this->section('conteudo'); ?>
<div class="my-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo site_url("/"); ?>">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Departamento Pessoal</li>
    </ol>
  </nav>
</div>

<div class="jumbotron">
  <div class="row">
    <div class="col-lg-4 text-center mt-2">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-calculator text-danger"></i>
          Folha de pagamento
        </div>
        <div class="card-body">

          <div class="dropdown">
            <button class="card-link btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Folha de pagamento
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#"><i class="fas fa-angle-right text-primary"></i> Controle mensal</a>
              <a class="dropdown-item" href="#">Gerar controle mensal</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#"><i class="fas fa-angle-right text-primary"></i> Controle décimo terceiro</a>
              <a class="dropdown-item" href="#">Gerar controle 13º</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 text-center mt-2">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-user-injured text-danger"></i>
          Controle de perícias
        </div>
        <div class="card-body">
          <a href="#" class="card-link btn btn-primary btn-sm">Acessar</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 text-center mt-2">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-users text-danger"></i>
          Quadro de funcionários
        </div>
        <div class="card-body">
          <a href="#" class="card-link btn btn-primary btn-sm">Acessar</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 text-center mt-2">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-baby text-danger"></i>
          Salário família
        </div>
        <div class="card-body">
          <a href="#" class="card-link btn btn-primary btn-sm">Acessar</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 text-center mt-2">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-map-marked-alt text-danger"></i>
          Controle de férias
        </div>
        <div class="card-body">
          <a href="#" class="card-link btn btn-primary btn-sm">Acessar</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 text-center mt-2">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-print text-danger"></i>
          Obrigações
        </div>
        <div class="card-body">
          <a href="#" class="card-link btn btn-primary btn-sm">Acessar</a>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="row">
  <div class="col-lg-6">
    <div class="jumbotron">
      Últimos prontuários adicionados
    </div>
  </div>
  <div class="col-lg-6">
    <div class="jumbotron">
      Tarefas pendentes
    </div>
  </div>
</div>

<?php $this->endSection(); ?>