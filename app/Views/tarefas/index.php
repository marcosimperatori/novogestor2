<?php echo $this->extend('layout/principal'); ?>

<?php echo $this->section('conteudo'); ?>
<div class="my-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo site_url("/"); ?>">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Tarefas</li>
    </ol>
  </nav>
</div>


<section>
  <div class="jumbotron">

    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-4 busca-user">
          <div class="form-group mb-3">
            <label for="list-users" class="form-control-label">Funcionário</label>
            <select id="list-users" name="depto" class="form-control">
              <option value="">Selecione...</option>
              <!-- Opções do select aqui -->
            </select>
          </div>
        </div>

        <div class="col-lg-8 text-lg-right">
          <button type="button" class="btn btn-primary btn-sm ml-3 mt-4">Nova tarefa</button>
        </div>
      </div>
    </div>



    <div class="table-responsive mt-3">
      <table id="lista_tarefas" class="table table-striped table-sm" style="width: 100%;">
        <thead>
          <tr>
            <th>Tarefa</th>
            <th>Nome</th>
          </tr>
        </thead>
      </table>
    </div>

  </div>
</section>

<?php $this->endSection(); ?>