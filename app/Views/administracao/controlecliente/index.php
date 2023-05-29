<?php echo $this->extend('layout/principal'); ?>

<?php echo $this->section('conteudo'); ?>
<div class="my-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo site_url("/"); ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo site_url("administracao"); ?>">Administração</a></li>
            <li class="breadcrumb-item active" aria-current="page">Definir controle da empresa</li>
        </ol>
    </nav>
</div>

<div class="jumbotron">
    <?php echo form_open('/', ['id' => 'form_cad_controle']) ?>
    Adicionar novos itens de controle
    <div class="row mt-3">
        <div class="col-lg-6 msg-erros">
            <label class="form-control-label">Cliente</label>
            <input type="text" name="idcliente" id="idcliente">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-6 msg-erros">
            <label class="form-control-label">Itens</label>
            <input type="text" name="iditem" multiple id="iditem">
        </div>

        <div class="form-group col-lg-2 msg-erros">
            <label class="form-control-label">A partir de</label>
            <input type="text" id="inicio" name="inicio" placeholder="Data início" autocomplete="off" class="form-control form-control-sm competencia" value="<?php /*echo ($cliente->clientedesde !== null ? date('Y-m-d', strtotime($cliente->clientedesde)) : '');*/ ?>">
        </div>

        <div class="form-group col-lg-2">
            <label class="form-control-label">Finaliza em</label>
            <input type="text" name="final" placeholder="Data fim" autocomplete="off" class="form-control form-control-sm competencia" value="<?php /*echo ($cliente->clientedesde !== null ? date('Y-m-d', strtotime($cliente->clientedesde)) : '');*/ ?>">
        </div>

        <div class="form-group col-lg-2">
            <br>
            <button type="submit" class="btn btn-success btn-sm mt-2">Adicionar</button>
        </div>
    </div>
    <?php form_close(); ?>
</div>

<div class="jumbotron">
    Itens que estão controlados pelo cliente selecionado
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="tab-itens-controle" class="table table-striped table-sm" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Departamento</th>
                            <th>Início</th>
                            <th>Final</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<?php $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="<?php echo site_url("assets/js/controle.empresa.js") ?>"></script>

<?php $this->endSection(); ?>