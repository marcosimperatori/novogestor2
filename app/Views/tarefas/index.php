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
    <div class="">
      <div class="row align-items-center">
        <div class="col-lg-4  col-md-6 busca-user">
          <div class="form-group mb-3 d-flex align-items-center">
            <label for="list-users" class="form-control-label mr-3">Situação</label>
            <select id="lista-status" name="depto" class="form-control">
              <option value="Pendente">Pendentes</option>
              <option value="Finalizada">Finalizadas</option>
              <option value="">Todas</option>
            </select>
          </div>
        </div>
        <div class="col-lg-5  col-md-6">
          <div class="form-group mb-3 d-flex align-items-center">
            <div class="input-group-text">
              <input id="dono" type="checkbox" checked aria-label="Checkbox for following text input">&nbsp;Apenas as que sou responsável
            </div>
          </div>
        </div>
        <div class="col-lg-3  col-md-12 text-lg-right">
          <div class="form-group mb-3 d-flex align-items-end justify-content-end">
            <a href="<?php echo site_url('tarefas/criar'); ?>" class="btn btn-outline-primary">Nova tarefa</a>
          </div>
        </div>
      </div>
    </div>

    <div class="table-responsive mt-3">
      <table id="lista_tarefas" class="table table-striped table-sm" style="width: 100%;">
        <thead>
          <tr>
            <th>Vencimento</th>
            <th>Tarefa</th>
            <th>Status</th>
            <th>Cliente</th>
            <th>Depto</th>
            <th>Responsável</th>
          </tr>
        </thead>
      </table>
    </div>

  </div>
</section>

<?php $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>

<script src="<?php echo site_url("assets/js/tarefas.js") ?>"></script>
<?php $this->endSection(); ?>