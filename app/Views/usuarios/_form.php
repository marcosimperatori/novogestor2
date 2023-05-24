<div class="row">
  <div class="col-lg-8">
    <div class="form-group">
      <label class="form-control-label">Nome</label>
      <input type="text" name="nome" placeholder="Insira o nome do usuário" class="form-control" value="<?php echo esc($usuario->nome); ?>">
    </div>
  </div>
  <div class="col-lg-4">
    <label class="form-control-label">Departamento</label>
    <select id="user_depto" name="depto" class="form-control">
      <option value='0'>Selecione...</option>
      <?php foreach ($deptos as $depto) : ?>
        <option <?php echo ($usuario->depto == $depto->id ? 'selected' : ''); ?> value="<?php echo $depto->id; ?>"><?php echo $depto->nome; ?></option>
      <?php endforeach; ?>
    </select>

  </div>
</div>

<div class=" form-group">
  <label class="form-control-label">Email</label>
  <input type="email" name="email" placeholder="Insira o email" class="form-control" value="<?php echo esc($usuario->email); ?>">
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="form-group">
      <label for="password" class="form-control-label">Senha</label>
      <input type="password" name="password" placeholder="Digite a nova senha" class="form-control" value="">
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      <label for="password_confirmation" class="form-control-label">Redigite senha</label>
      <input type="password" name="password_confirmation" placeholder="Redigite a nova senha" class="form-control" value="">
    </div>
  </div>
</div>


<div class="custom-control custom-checkbox">
  <input type="hidden" name="ativo" value="0">
  <input type="checkbox" name="ativo" id="ativo" value="1" class="custom-control-input" <?php if ($usuario->ativo == true) : ?> checked <?php endif; ?>>
  <label for="ativo" class="custom-control-label">Usuário ativo</label>
</div>