<style>
  .select {
    font-size: 14px;
  }
</style>



<?php echo form_open('/', ['id' => 'form_cad_controle']) ?>

<div class="row my-2">
  <div class="col-lg-6 msg-erros">
    <div class="form-group">
      <label class="form-control-label">Cliente</label>
      <input type="text" name="idcliente" id="idcliente" class="select">
      <div id="response2" class="mt-2"></div>
    </div>
  </div>
  <div class="col-lg-3">
    <label class="form-control-label">Quem executará?</label>
    <input type="text" name="idusuario" id="idusuario" placeholder="Pesquisar usuário" class="select">
    <div id="response2" class="mt-2"></div>
  </div>
  <div class="col-lg-3">
    <label class="form-control-label">Expectativa conclusão</label>
    <input type="date" name="nome" placeholder="Insira uma descrição para o item" class="form-control form-control-sm" value="<?php /*echo esc($itemcontrole->nome);*/ ?>">

  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="form-group">
      <label class="form-control-label">Título</label>
      <input type="text" name="nome" placeholder="Descreva um título para a tarefa" autocomplete="off" class="form-control form-control-sm" value="<?php /*echo esc($itemcontrole->nome);*/ ?>">
    </div>
  </div>

</div>
<div class="row">
  <div class="col-lg-12">
    <label class="form-control-label">Descrição da tarefa</label>
    <textarea name="obsitem" id="obx" class="form-control" placeholder="Descreva a tarefa a ser realizada" cols="30" rows="6"><?php /*echo $itemcontrole->obsitem*/ ?></textarea>
  </div>
</div>
<?php form_close(); ?>