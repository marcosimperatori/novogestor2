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

    <div class="col-lg-8">
      <div class="container">
        <div class=" offset-md-3 align-self-center">
          <div id="resumodp" class="card d-none" style="width: 18rem;">
            <div class="card-body">
              <p class="card-text">Total de empresas: <strong id="totalempresa" class="text-danger"></strong></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="jumbotron">
  <p>Empresas vinculadas a outros usuários</p>
  <div class="row">
    <div class="table-responsive">
      <table id="tableclientes1" class="table table-striped table-sm" style="width: 100%;">
        <thead>
          <tr>
            <th>Código</th>
            <th>Apelido</th>
            <th>Apelido</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<div class="jumbotron">

  <div class="row-12">
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#emp-sem-resp" aria-expanded="true" aria-controls="emp-sem-resp">
              Empresas responsável atribuido
            </button>
          </h2>
        </div>

        <div id="emp-sem-resp" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <div class="table-responsive">
              <table id="tableclientes2" class="table table-striped table-sm" style="width: 100%;">
                <thead>
                  <tr>
                    <th>Código</th>
                    <th>Apelido</th>
                    <th>Apelido</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php $this->endSection(); ?>