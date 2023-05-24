<?php echo $this->extend('layout/principal'); ?>

<?php echo $this->section('conteudo'); ?>
<div class="my-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo site_url("/"); ?>">Home</a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url("pessoal"); ?>">Departamento Pessoal</a></li>
      <li class="breadcrumb-item active" aria-current="page">Tarefas</li>
    </ol>
  </nav>
</div>

<h5>lista de tarefas</h5>

<?php $this->endSection(); ?>