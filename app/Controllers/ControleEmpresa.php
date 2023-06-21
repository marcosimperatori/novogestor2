<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ControleEmpresa extends BaseController
{
    private $controleEmpresaModel;
    private $clienteModel;

    public function __construct()
    {
        $this->controleEmpresaModel = new \App\Models\ControleEmpresaModel();
        $this->clienteModel = new \App\Models\ClienteModel();
    }

    public function index()
    {
        $data['token'] = csrf_hash();
        return view('administracao/controlecliente/index', $data);
    }

    public function recuperaControleEmpresa()
    {
        //garatindo que este método seja chamado apenas via ajax
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $itens = $this->controleEmpresaModel->select('itemcontrole.id, itemcontrole.nome,itemcontrole.tipo ,departamentos.nome as depto')
            ->join('departamentos', 'departamentos.id = itemcontrole.depto')
            ->orderBy('nome', 'asc')->findAll();

        //recebe o array de objetos clientes
        $data = [];

        foreach ($itens as $item) {
            $data[] = [
                'nome' => anchor("administracao/itemcontrole/editar/$item->id", esc($item->nome), 'title="Exibir detalhes do item"'),
                'depto' => $item->depto,
                'tipo' => '',
            ];
        }

        $retorno = [
            'data' => $data
        ];

        return $this->response->setJSON($retorno);
    }

    public function listarClientes()
    {
        $cliente = new \App\Models\ClienteModel();

        $busca = $this->request->getVar('q');

        $retorno = $cliente->select('id, codigo, apelido, razao, cnpj')
            ->groupStart()
            ->like('apelido', $busca)
            ->orLike('codigo', $busca)
            ->groupEnd()
            ->orderBy('apelido', 'ASC')
            ->findAll();

        $data = [
            'data' => $retorno
        ];

        return $this->response->setJSON($data);
    }

    public function listarUsuarios()
    {
        $cliente = new \App\Models\UsuarioModel();

        $busca = $this->request->getVar('q');

        $retorno = $cliente->select('usuarios.id, usuarios.nome, departamentos.nome as depto')
            ->join('departamentos', 'departamentos.id = usuarios.depto')
            ->groupStart()
            ->like('usuarios.nome', $busca)
            ->orLike('departamentos.nome', $busca) // Condição OR
            ->groupEnd()
            ->orderBy('usuarios.nome', 'ASC')
            ->findAll();

        $data = [
            'data' => $retorno
        ];

        return $this->response->setJSON($data);
    }

    public function listarItens()
    {
        $itemModel = new \App\Models\ItemControleModel();

        $busca = $this->request->getVar('q');

        $retorno = $itemModel->select('itemcontrole.id, itemcontrole.nome, itemcontrole.tipo')
            //  ->join('clientes_controle', 'clientes_controle.iditem = itemcontrole.id', 'left')
            //            ->join('clientes', 'clientes.id = clientes_controle.idcliente')
            // ->where('clientes_controle.iditem IS NULL')
            // ->where('clientes_controle.idcliente', 48)
            ->like('nome', $busca)
            ->orderBy('nome', 'ASC')->findAll();

        $data = [
            'data' => $retorno
        ];

        return $this->response->setJSON($data);
    }

    public function cadastrar()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $retorno['token'] = csrf_hash();

        $codigoCliente = $this->request->getPost('idcliente');

        if (empty($codigoCliente)) {
            $retorno['info2'] = "Selecione um cliente para continuar";

            return $this->response->setJSON($retorno);
        }

        $post = $this->request->getPost();
        $registro = new \App\Entities\ControleEmpresaEntity($post);


        //uma forma de garantir que o cliente, nao tenha sido uma manipulação do usuário
        $cliente = $this->buscaClienteOu404($registro->idcliente);

        //verificando se o item já foi adicionado para o cliente
        $existeControle = $this->controleEmpresaModel->where('idcliente', $cliente->id)
            ->where('iditem', $post['iditem'])->findAll();

        if (empty($existeControle) == false) {
            $itemModel = new \App\Models\ItemControleModel();
            $item = $itemModel->find($registro->iditem);

            $retorno['info'] = "<b>[ " . $item->nome . " ]</b> Este item já foi adicionado para o cliente anteriormente";

            return $this->response->setJSON($retorno);
        }

        if ($this->controleEmpresaModel->save($registro)) {
            session()->setFlashdata('sucesso', "Registro inserido no sistema.");
            $retorno['Resultado'] = "Registro inserido com sucesso";
            return $this->response->setJSON($retorno);
        }

        $retorno['erro'] = "Verifique os avisos de erro e tente novamente";
        $retorno['erros_model'] = $this->controleEmpresaModel->errors();

        return $this->response->setJSON($retorno);
    }

    public function listarItensControlados()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $codigoCliente = $this->request->getGet('id');

        $atributos = [
            'clientes_controle.inicio', 'clientes_controle.final', 'clientes_controle.id',
            'itemcontrole.nome', 'itemcontrole.tipo',
            'departamentos.nome as depto'
        ];

        $lista = $this->controleEmpresaModel->select($atributos)
            ->join('clientes', 'clientes.id = clientes_controle.idcliente')
            ->join('itemcontrole', 'itemcontrole.id = clientes_controle.iditem', 'left')
            ->join('departamentos', 'departamentos.id = itemcontrole.depto')
            ->where('clientes_controle.idcliente', $codigoCliente)
            ->orderBy('itemcontrole.nome')
            ->findAll();

        $data = [];

        foreach ($lista as $item) {
            if ($item->tipo == '1')
                $tipo = '<i class="fas fa-donate text-primary"></i>&nbsp;Imposto';
            else if ($item->tipo == '2')
                $tipo = '<i class="fas fa-exclamation-triangle text-secondary"></i>&nbsp;Obrigação';
            else
                $tipo = '<i class="fas fa-paste text-success"></i></i>&nbsp;Controle interno';

            $data[] = [
                'nome'   => esc($item->nome),
                'depto' => $item->depto,
                'inicio' => date('m/Y', strtotime($item->inicio)),
                'fim'    => ($item->final == '0000-00-00' ? '---' : date('m/Y', strtotime($item->final))),
                'tipo'   => $tipo,
                'acao' => '
                    <div class="d-flex justify-content-between">
                    <div id="excluir-item-controlado" data-idcontrole="' . $item->id . '" data-descricao="' . $item->nome . '" class="text-danger" style="cursor:pointer;" data-toggle="modal" data-target="#mdExcluirControle" title="Remover o item da lista de controle do cliente"><i class="fas fa-trash-alt"></i>&nbsp;Excluir</div> 
                    <div id="editar-item-controlado" data-idcontrole="' . $item->id . '" data-descricao="' . $item->nome . '" data-compfim="' . $item->final . '"  class="text-info" style="cursor:pointer;" data-toggle="modal" data-target="#mdFinalizarControle" title="Definir fim para o item">
                    <i class="fas fa-edit"></i>&nbsp;Finalizar</div> 
                    </div>
                ',
            ];
        }

        $retorno = [
            'data' => $data
        ];

        return $this->response->setJSON($retorno);
    }

    public function excluir()
    {
        //garatindo que este método seja chamado apenas via ajax
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $retorno['token'] = csrf_hash();

        $id = $this->request->getPost('id');

        $controleModel = new \App\Models\ControleEmpresaModel();
        $itemControle = $controleModel->find($id);

        $controleModel->delete($itemControle->id);

        $retorno['resultado'] = "Item de controle excluído com sucesso";
        return $this->response->setJSON($retorno);
    }

    /**
     * Este método foi criado exclusivamente para trabalhar com a chamada INSERTBATCH, pois tal chamada não aciona as validações e 
     * gatilhos do model. Tal comportamento resulta num melhor desempenho. Porém, se necessário alguma validação é preciso usar outro
     * método para salvar, o que pode resultar até mesmo em alteração na lógica do método.
     *
     * @param string $referencia
     * @return string
     */
    private function competenciaParaData(string $referencia): string
    {
        if ($referencia != "") {
            $competencia = explode('/', $referencia);
            $ano = $competencia[1];
            $mes = $competencia[0];
            $dataCompleta = $ano . '-' . str_pad($mes, 2, '0', STR_PAD_LEFT) . '-01';
        } else {
            $dataCompleta = "0000-00-00";
        }

        return $dataCompleta;
    }

    /**
     * Método que recupera o cliente
     *
     * @param integer|null $id
     * @return Exception|object
     */
    private function buscaClienteOu404(int $id = null)
    {

        //vai considerar inclusive os registros excluídos (softdelete)
        if (!$id || !$cliente = $this->clienteModel->withDeleted(true)->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Cliente não encontrado com o ID: $id");
        }

        return $cliente;
    }
}
