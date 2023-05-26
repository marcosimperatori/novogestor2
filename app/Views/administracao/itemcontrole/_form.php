<div class="row">
  <div class="col-lg-7">
    <div class="form-group">
      <label class="form-control-label">Descrição</label>
      <input type="text" name="nome" placeholder="Insira uma descrição para o item" class="form-control form-control-sm" value="<?php echo esc($itemcontrole->nome); ?>">
    </div>
  </div>
  <div class="col-lg-3">
    <label class="form-control-label">Pertence a</label>
    <select id="user_depto" name="depto" class="form-control form-control-sm">
      <option value=''>Selecione...</option>
      <?php foreach ($deptos as $depto) : ?>
        <option <?php echo ($itemcontrole->depto == $depto->id ? 'selected' : ''); ?> value="<?php echo $depto->id; ?>"><?php echo $depto->nome; ?></option>
      <?php endforeach;
      ?>
    </select>
  </div>
  <div class="col-lg-2">
    <label class="form-control-label">Tipo<strong class="text-danger">*</strong></label>
    <select name="regimetributario" class="form-control form-control-sm" id="exampleFormControlSelect1">
      <option value="nao">Selecione</option>
      <option value="1" <?php echo ($itemcontrole->tipo == 1 ? 'selected' : ''); ?>>Imposto</option>
      <option value="2" <?php echo ($itemcontrole->tipo == 2 ? 'selected' : ''); ?>>Controle interno</option>
    </select>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <label class="form-control-label">Tipo</label>
    <textarea name="obs" id="obx" class="form-control" placeholder="Observação sobre o item" cols="30" rows="6"></textarea>
  </div>
</div>