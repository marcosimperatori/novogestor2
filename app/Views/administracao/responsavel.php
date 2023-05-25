<?php echo $this->extend('layout/principal'); ?>

<?php echo $this->section('conteudo'); ?>
<div class="my-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo site_url("/"); ?>">Home</a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url("administracao"); ?>">Administração</a></li>
      <li class="breadcrumb-item active" aria-current="page">Definir responsável por empresa</li>
    </ol>
  </nav>
</div>
<!--
<div class="jumbotron">
  <div class="row">
    <div class="col-lg-4 busca-user">
      <label class="form-control-label">Selecione um funcionário</label>
      <select id="list-users" name="depto" class="form-control">
        <option value=''>Selecione...</option>
        <?php foreach ($usuarios as $usuario) : ?>
          <option value="<?php echo $usuario->id; ?>"><?php echo $usuario->nome; ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-lg-3 mt-2">
      <div id="resumodp" class="card d-none">
        <div class="card-body">
          <p class="card-text">Total de empresas: <strong id="totalempresa" class="text-danger text-size"></strong></p>
        </div>
      </div>
    </div>
  </div>
</div>-->


<div class="jumbotron">
  <div class="row mb-4">
    <div class="col-lg-4 busca-user">
      <label class="form-control-label">Selecione um funcionário</label>
      <select id="list-users" name="depto" class="form-control">
        <option value=''>Selecione...</option>
        <?php foreach ($usuarios as $usuario) : ?>
          <option value="<?php echo $usuario->id; ?>"><?php echo $usuario->nome; ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-lg-8 mt-2">
      <p class="card-text mt-3">Atenção, ao clicar nas ações, disponíveis em todas as tabelas abaixo, o sistema as excutará <strong class="text-danger">sem</strong> pedir confirmação!</p>
      <!--  <div id="resumodp1" class="card">
        <div class="card-body">
        </div>
      </div>-->
    </div>
  </div>

  <div class="row-12 mt-2">
    <div class="accordion" id="accordionExample3">
      <div class="card">
        <div class="card-header bg-success" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-sm btn-link btn-block text-left text-white busca-sem-mov" type="button" data-toggle="collapse" data-target="#emp-atual" aria-expanded="true" aria-controls="emp-atual">
              <i class="fas fa-check"></i>&nbsp;
              Empresas <strong>vinculadas</strong> ao usuário
            </button>
          </h2>
        </div>
        <div id="emp-atual" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample3">
          <div class="card-body">
            <div class="table-responsive">
              <table id="emp-user-select" class="table table-striped table-sm" style="width: 100%;">
                <thead>
                  <tr>
                    <th>Código</th>
                    <th>Apelido</th>
                    <th>Responsável</th>
                    <th><i class="fas fa-wrench text-primary"></i>&nbsp;Ação</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row-12 mt-2">
    <div class="accordion" id="accordionExample1">
      <div class="card">
        <div class="card-header bg-info" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-sm btn-link btn-block text-white text-left busca-sem-mov" type="button" data-toggle="collapse" data-target="#emp-outros" aria-expanded="true" aria-controls="emp-outros">
              <i class="fas fa-user-check"></i>&nbsp;
              Empresas <strong>vinculadas</strong> a outros usuários
            </button>
          </h2>
        </div>
        <div id="emp-outros" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample1">
          <div class="card-body">
            <div class="table-responsive">
              <table id="emp-outro-user" class="table table-striped table-sm" style="width: 100%;">
                <thead>
                  <tr>
                    <th>Código</th>
                    <th>Apelido</th>
                    <th>Responsável</th>
                    <th><i class="fas fa-wrench text-primary"></i>&nbsp;Ação</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row-12 mt-2">
    <div class="accordion" id="accordionExample2">
      <div class="card">
        <div class="card-header bg-warning" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-sm btn-link btn-block text-left text-dark busca-sem-mov" type="button" data-toggle="collapse" data-target="#emp-sem-resp" aria-expanded="true" aria-controls="emp-sem-resp">
              <i class="fas fa-exclamation-triangle"></i>&nbsp;
              Empresas <strong>sem</strong> responsável atribuído*
            </button>
          </h2>
        </div>
        <div id="emp-sem-resp" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample2">
          <div class="card-body">
            <div class="table-responsive">
              <table id="emp-sem-user" class="table table-striped table-sm" style="width: 100%;">
                <thead>
                  <tr>
                    <th>Código</th>
                    <th>Apelido</th>
                    <!--  <th><i class="fas fa-wrench text-primary"></i>&nbsp;Ação</th>-->
                    <th>Ação: selecione um responsável</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <span class="ml-3 text-muted">* Em relação ao departamento que o usuário está vinculado</span>
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" name="csrf_test_name" value="">
</div>

<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
  <div id="toastContainer" class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;"></div>
</div>


<?php $this->endSection(); ?>