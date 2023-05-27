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
}
