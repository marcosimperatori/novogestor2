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
            <div id="response2" class="mt-2"></div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-6 msg-erros">
            <label class="form-control-label">Item</label>
            <input type="text" name="iditem" id="iditem">
            <div id="response" class="mt-2"></div>
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
    Controles já vinculados ao cliente selecionado
    <div class="row mt-4">
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
                            <th>Ações</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="csrf_test_name" value="<?php echo $token; ?>">

<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
    <div id="toastContainer" class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;"></div>
</div>

<!-- Modal exclusão -->
<div class="modal fade" id="mdExcluirControle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title card-text" id="exampleModalLabel">
                    <i class="fas fa-exclamation-triangle text-danger"></i>
                    Atenção!
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                Confirma a <strong>exclusão</strong> do controle atual? <br>
                <p id="descricao-citem" class="font-weight-bold text-danger text-uppercase my-2"></p>
                <div class="my-4">
                    <p class="muted"><span>Após excluído, esse item deixará de ser apresentado na geração dos controles mensais a partir de então.</span></p>
                </div>
                <input type="hidden" id="token">
            </div>
            <div class="modal-footer">
                <button id="cancela-exclusao" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                <button id="excluir-controle" data-iduser="" type="button" class="btn btn-danger btn-sm">Excluir</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal edição-->
<div class="modal fade" id="mdFinalizarControle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title card-text" id="exampleModalLabel">
                    <i class="fas fa-check-circle text-info"></i>
                    Finalizar controle
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <p id="descricao-citem" class="font-weight-bold text-primary text-uppercase">teste</p>
                    </div>
                    <div class="col-lg-4">
                        data
                    </div>
                    <input type="hidden" id="token">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                <button id="finaliza-controle" data-iduser="" type="button" class="btn btn-success btn-sm">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="<?php echo site_url("assets/js/controle.empresa.js") ?>"></script>

<?php $this->endSection(); ?>