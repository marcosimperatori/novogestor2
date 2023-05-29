<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ControleEmpresa extends BaseController
{
    private $controleEmpresaModel;

    public function __construct()
    {
        $this->controleEmpresaModel = new \App\Models\ControleEmpresaModel();
    }

    public function index()
    {
        return view('administracao/controlecliente/index');
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

        $retorno = $cliente->select('id, codigo, apelido, razao, cnpj')->like('apelido', $busca)
            ->orderBy('apelido', 'ASC')->findAll();

        $data = [
            'data' => $retorno
        ];

        return $this->response->setJSON($data);
    }

    public function listarItens()
    {
        $itemModel = new \App\Models\ItemControleModel();

        $busca = $this->request->getVar('q');

        $retorno = $itemModel->select('id, nome, tipo')->like('nome', $busca)
            ->orderBy('nome', 'ASC')->findAll();

        $data = [
            'data' => $retorno
        ];

        return $this->response->setJSON($data);
    }

    public function cadastrar()
    {
        //garatindo que este método seja chamado apenas via ajax
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        //atualiza o token do formulário
        $retorno['token'] = csrf_hash();

        //recuperando os dados que vieram na requisiçao
        $post = $this->request->getPost();

        $controle = new \App\Entities\ControleEmpresaEntity($post);

        // echo "<pre>";
        //  print_r($controle);
        //  exit;

        //terminar implementação deste método
        if ($this->controleEmpresaModel->protect(false)->save($controle)) {

            //captura o id do cliente que acabou de ser inserido no banco de dados
            $retorno['id'] = $this->controleEmpresaModel->getInsertID();
            $novoItem = $this->controleEmpresaModel->find($retorno['id']);

            session()->setFlashdata('sucesso', "O registro ($novoItem->nome) foi incluído no sistema.");

            $retorno['Resultado'] = 'Registro salvo com sucesso';
            return $this->response->setJSON($retorno);
        }

        //se chegou até aqui, é porque tem erros de validação
        $retorno['erro'] = "Verifique os aviso de erro e tente novamente";
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
            'clientes_controle.inicio', 'clientes_controle.final', 'clientes.id',
            'itemcontrole.nome',
            'departamentos.nome as depto'
        ];

        $lista = $this->controleEmpresaModel->select($atributos)
            ->join('clientes', 'clientes.id = clientes_controle.idcliente')
            ->join('itemcontrole', 'itemcontrole.id = clientes_controle.iditem')
            ->join('departamentos', 'departamentos.id = itemcontrole.depto')
            ->where('clientes_controle.idcliente', $codigoCliente)
            ->orderBy('itemcontrole.nome')
            ->findAll();

        $data = [];

        foreach ($lista as $item) {
            if ($item->tipo == '1')
                $tipo = '<i class="fas fa-donate text-primary"></i>&nbsp;Imposto';
            else if ($item->tipo == '2')
                $tipo = '<i class="fas fa-exclamation-triangle text-danger"></i>&nbsp;Obrigação';
            else
                $tipo = '<i class="fas fa-paste text-success"></i></i>&nbsp;Controle interno';

            $data[] = [
                'nome'   => esc($item->nome),
                'depto' => $item->depto,
                'inicio' => date('m/Y', strtotime($item->inicio)),
                'fim'    => date('m/Y', strtotime($item->final)),
                'tipo'   => $tipo,
            ];
        }

        $retorno = [
            'data' => $data
        ];

        return $this->response->setJSON($retorno);
    }
}
