<div class="row justify-content-center">

  <div class="form-group col-lg-2">
    <label class="form-control-label" for="codigo">Código<strong class="text-danger">*</strong></label>
    <input type="text" name="codigo" placeholder="Código" class="form-control form-control-sm" value="<?php echo esc($cliente->codigo); ?>">
  </div>

  <div class="form-group col-lg-3">
    <label class="form-control-label">CNPJ<strong class="text-danger">*</strong></label>
    <input type="text" name="cnpj" placeholder="Insira o CNPJ" class="form-control form-control-sm cnpj" value="<?php echo esc($cliente->cnpj); ?>">
  </div>

  <div class="form-group col-lg-4">
    <label class="form-control-label">
      Tipo
      <a class="" data-toggle="popover" title="Tipo" data-content="Esta classificação servirá para filtrar clientes na listagem de clientes." style="cursor:pointer;"><i class="fa fa-question-circle-o text-info"></i></a>
    </label>

    <select name="tipo" class="form-control form-control-sm" id="exampleFormControlSelect1">
      <option value="nao">Selecione</option>
      <option value="1" <?php echo ($cliente->tipo == 1 ? 'selected' : ''); ?>>Simples Nacional</option>
      <option value="2" <?php echo ($cliente->tipo == 2 ? 'selected' : ''); ?>>ILPI</option>
      <option value="3" <?php echo ($cliente->tipo == 3 ? 'selected' : ''); ?>>Lucro Presumido</option>
      <option value="4" <?php echo ($cliente->tipo == 4 ? 'selected' : ''); ?>>Lucro Real</option>
      <option value="5" <?php echo ($cliente->tipo == 5 ? 'selected' : ''); ?>>MEI</option>
      <option value="6" <?php echo ($cliente->tipo == 6 ? 'selected' : ''); ?>>APAE</option>
      <option value="7" <?php echo ($cliente->tipo == 7 ? 'selected' : ''); ?>>Hospital</option>
      <option value="8" <?php echo ($cliente->tipo == 8 ? 'selected' : ''); ?>>Conselho Met. JF</option>
    </select>
  </div>

  <div class="form-group col-lg-3">
    <label class="form-control-label">Responsável pela empresa</label>
    <input type="text" name="empresario" placeholder="Responsável pela empresa" class="form-control form-control-sm" value="<?php echo esc($cliente->empresario); ?>">
  </div>

  <div class="form-group col-lg-7">
    <label class="form-control-label">Razão social<strong class="text-danger">*</strong></label>
    <input type="text" name="razao" placeholder="Insira a razão social" class="form-control form-control-sm font-weight-bold" value="<?php echo esc($cliente->razao); ?>">
  </div>

  <div class="form-group col-lg-5">
    <label class="form-control-label">Apelido<strong class="text-danger">*</strong></label>
    <input type="text" name="apelido" placeholder="Insira o apelido" class="form-control form-control-sm font-weight-bold" value="<?php echo esc($cliente->apelido); ?>">
  </div>

  <div class="form-group col-lg-4">
    <label class="form-control-label">Inscrição estadual</label>
    <input type="text" name="ie" placeholder="IE" class="form-control form-control-sm" value="<?php echo esc($cliente->ie); ?>">
    <div class="err-ie"></div>
  </div>

  <div class="form-group col-lg-4">
    <label class="form-control-label">Código Simples Nacional</label>
    <input type="text" name="codigosimples" placeholder="Código do Simples" class="form-control form-control-sm" value="<?php echo esc($cliente->codigosimples); ?>">
  </div>

  <div class="form-group col-lg-4">
    <label class="form-control-label">CPF responsável</label>
    <input type="text" name="cpfempresario" placeholder="Insira o CPF" class="form-control form-control-sm cpf" value="<?php echo esc($cliente->cpfempresario); ?>">
  </div>

  <div class="form-group col-lg-3">
    <label class="form-control-label">Telefone</label>
    <input type="phone" name="telefone" placeholder="Insira o telefone da empresa" class="form-control form-control-sm sp_celphones" value="<?php echo $cliente->telefone; ?>">
  </div>

  <div class="form-group col-lg-7">
    <label class="form-control-label">Email</label>
    <input type="email" name="email" placeholder="Insira o email da empresa" class="form-control form-control-sm" value="<?php echo esc($cliente->email); ?>">
  </div>

  <div class="form-group col-lg-2">
    <label class="form-control-label">Cliente desde</label>
    <input type="date" name="clientedesde" placeholder="Data admissão" class="form-control form-control-sm" value="<?php echo ($cliente->clientedesde !== null ? date('Y-m-d', strtotime($cliente->clientedesde)) : ''); ?>">
  </div>

  <div class="form-group col-lg-4">
    <label class="form-control-label">Pessoa p/ contato</label>
    <input type="text" name="contato" placeholder="Nome da pessoa para contato" class="form-control form-control-sm" value="<?php echo esc($cliente->contato); ?>">
  </div>

  <div class="form-group col-lg-3">
    <label class="form-control-label">Tipo Certificado Digital</label>

    <select name="tipocertificado" class="form-control form-control-sm" id="exampleFormControlSelect1">
      <option value="nao">Não possui</option>
      <option value="a1" <?php echo ($cliente->tipocertificado == 'a1' ? 'selected' : ''); ?>>A1</option>
      <option value="a3" <?php echo ($cliente->tipocertificado == 'a3' ? 'selected' : ''); ?>>A3</option>
    </select>
  </div>

  <div class="form-group col-lg-2">
    <label class="form-control-label"> Vecto Cert. Digital</label>
    <input type="date" name="vectocertificado" placeholder="Código" class="form-control form-control-sm" value="<?php echo ($cliente->vectocertificado !== null ? date('Y-m-d', strtotime($cliente->vectocertificado)) : ''); ?>">
  </div>

  <div class="form-group col-lg-3">
    <label class="form-control-label">Quantidade funcionários</label>
    <input type="text" name="qtdefuncionarios" placeholder="Qtde funcionários" class="form-control form-control-sm" value="<?php echo esc($cliente->qtdefuncionarios); ?>">
  </div>

  <div class="form-group col-lg-4">
    <label class="form-control-label">Regime tributário<strong class="text-danger">*</strong></label>
    <select name="regimetributario" class="form-control form-control-sm" id="exampleFormControlSelect1">
      <option value="nao">Selecione</option>
      <option value="1" <?php echo ($cliente->regimetributario == 1 ? 'selected' : ''); ?>>Imune</option>
      <option value="2" <?php echo ($cliente->regimetributario == 2 ? 'selected' : ''); ?>>Isenta</option>
      <option value="3" <?php echo ($cliente->regimetributario == 3 ? 'selected' : ''); ?>>Lucro Presumido</option>
      <option value="4" <?php echo ($cliente->regimetributario == 4 ? 'selected' : ''); ?>>Lucro Real</option>
      <option value="5" <?php echo ($cliente->regimetributario == 5 ? 'selected' : ''); ?>>MEI</option>
      <option value="6" <?php echo ($cliente->regimetributario == 6 ? 'selected' : ''); ?>>Simples Nacional</option>
    </select>
  </div>

  <div class="form-group col-lg-8">
    <div class="row">
    </div>
  </div>

  <div class="form-group col-lg-12">
    <label class="form-control-label">Observação</label>
    <textarea cols="30" rows="5" name="obs" placeholder="Insira as observações da empresa" class="form-control form-control-sm"><?php echo esc($cliente->obs); ?></textarea>
  </div>
</div>
<div class="row ml-1">
  <div class="custom-control custom-checkbox mr-5">
    <input type="hidden" name="ativo" value="0">
    <input type="checkbox" name="ativo" id="ativo" value="1" class="custom-control-input" <?php if ($cliente->ativo == true) : ?> checked <?php endif; ?>>
    <label for="ativo" class="custom-control-label">Cliente ativo</label>
  </div>

  <div class="custom-control custom-checkbox mr-5">
    <input type="hidden" name="controlacnd" value="0">
    <input type="checkbox" name="controlacnd" id="controlacnd" value="1" class="custom-control-input" <?php if ($cliente->controlacnd == true) : ?> checked <?php endif; ?>>
    <label for="controlacnd" class="custom-control-label">Controla CND's</label>
  </div>

  <div class="custom-control custom-checkbox mr-5">
    <input type="hidden" name="movimentocontabil" value="0">
    <input type="checkbox" name="movimentocontabil" id="movimentocontabil" value="1" class="custom-control-input" <?php if ($cliente->movimentocontabil == true) : ?> checked <?php endif; ?>>
    <label for="movimentocontabil" class="custom-control-label">Entrega movimento contábil</label>
  </div>
</div>




<!-- <ul class="nav nav-tabs card-header-tabs" id="abasempresa" role="tablist">
    <li class="nav-item">
      <a class="nav-link tab active" href="#geral" role="tab" aria-controls="description" aria-selected="true">Geral</a>
    </li>
    <li class="nav-item">
      <a class="nav-link tab" href="#dp" role="tab" aria-controls="history" aria-selected="false">Departamento Pessoal</a>
    </li>
    <li class="nav-item">
      <a class="nav-link tab" href="#df" role="tab" aria-controls="deals" aria-selected="false">Departamento Fiscal</a>
    </li>
    <li class="nav-item">
      <a class="nav-link tab" href="#dc" role="tab" aria-controls="deals" aria-selected="false">Departamento Contábil</a>
    </li>
  </ul>

  <div class="card-body">

    <div class="tab-content mt-3">
      <div class="tab-pane active" id="geral" role="tabpanel">
        <div class="row">
          <div class="form-group col-lg-3">
            <label class="form-control-label">Telefone</label>
            <input type="phone" name="empresario" placeholder="Insira o telefone da empresa" class="form-control sp_celphones" value="">
          </div>

          <div class="form-group col-lg-7">
            <label class="form-control-label">Email</label>
            <input type="email" name="empresario" placeholder="Insira o email da empresa" class="form-control" value="">
          </div>

          <div class="form-group col-lg-2">
            <label class="form-control-label text-success">Cliente desde</label>
            <input type="date" name="empresario" placeholder="Data admissão" class="form-control" value="">
          </div>

          <div class="form-group col-lg-4">
            <label class="form-control-label">Pessoa p/ contato</label>
            <input type="email" name="empresario" placeholder="Nome da pessoa para contato" class="form-control" value="">
          </div>

          <div class="form-group col-lg-3">
            <label class="form-control-label">Tipo Certificado Digital</label>
            <input type="text" name="codigo" placeholder="Código" class="form-control" value="<?php echo ""; /*esc($cliente->nome);*/ ?>">
          </div>

          <div class="form-group col-lg-2">
            <label class="form-control-label"> Vecto Cert. Digital</label>
            <input type="date" name="codigo" placeholder="Código" class="form-control" value="<?php echo ""; /*esc($cliente->nome);*/ ?>">
          </div>

          <div class="form-group">
            <input id="option" type="checkbox" value="">
            <label for="option">Ativo</label>
          </div>

          <div class="form-group col-lg-12">
            <label class="form-control-label">Observação</label>
            <textarea cols="30" rows="5" name="empresario" placeholder="Insira as observações da empresa" class="form-control" value=""></textarea>
          </div>
        </div>
      </div>

      <div class="tab-pane" id="dp" role="tabpanel" aria-labelledby="history-tab">

        <div class="form-group col-lg-3">
          <label class="form-control-label">Quantidade funcionários</label>
          <input type="text" name="codigo" placeholder="Código" class="form-control" value="<?php echo ""; /*esc($cliente->nome);*/ ?>">
        </div>

        <div class="form-group">
          <input id="option" type="checkbox" value="">
          <label for="option">Tem folha de pagamento</label>
        </div>

        <div class="form-group">
          <input id="option" type="checkbox" value="">
          <label for="option">Controla CND's</label>
        </div>

        <div class="form-group">
          <input id="option" type="checkbox" value="">
          <label for="option">Entrega RAIS</label>
        </div>
      </div>

      <div class="tab-pane" id="df" role="tabpanel" aria-labelledby="deals-tab">
        <div class="col">
          <div class="form-group col-lg-6">
            <label class="form-control-label">Regime tributário</label>
            <input type="text" name="codigo" placeholder="Código" class="form-control" value="<?php echo ""; /*esc($cliente->nome);*/ ?>">
          </div>
        </div>
      </div>

      <div class="tab-pane" id="dc" role="tabpanel" aria-labelledby="deals-tab">
        <div class="col">
          <div class="form-group">
            <input id="option" type="checkbox" value="">
            <label for="option">Entrega movimento contábil</label>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-end">
    <a href="#" class="btn btn-secondary btn-sm mr-3"> Cancelar</a>
    <a href="#" class="btn btn-success btn-sm"> Salvar</a>
  </div>
</div>
</div> -->