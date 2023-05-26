<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ItemControle extends BaseController
{
    private $itemModel;

    public function __construct()
    {
        $this->itemModel = new \App\Models\ItemControleModel();
    }

    public function index()
    {
        return view('administracao/itemcontrole/index');
    }

    public function recuperaItensControle()
    {
        //garatindo que este método seja chamado apenas via ajax
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $atributos = ['id', 'nome', 'tipo'];

        $itens = $this->itemModel->select($atributos)->orderBy('nome', 'asc')->findAll();

        //recebe o array de objetos clientes
        $data = [];

        foreach ($itens as $item) {
            $data[] = [
                'nome' => anchor("administracao/itemcontrole/editar/$item->id", esc($item->nome), 'title="Exibir detalhes do item"'),
                'tipo' => ($item->tipo == '1' ? "Obrigação" : "Imposto"),
                //'ativo' => ($item->ativo == true ? '<i class="fa fa-unlock text-success"></i>&nbsp;Ativo' : '<i class="fa fa-lock text-danger"></i>&nbsp;Inativo'),
            ];
        }

        $retorno = [
            'data' => $data
        ];

        return $this->response->setJSON($retorno);
    }

    public function criar()
    {
        $itemControle = new \App\Entities\ItemControleEntity();
        $departamentoModel = new \App\Models\DepartamentoModel();
        $depto = $departamentoModel->orderBy('nome', 'asc')->findAll();

        $data = [
            'titulo' => "Criando novo item",
            'itemcontrole' => $itemControle,
            'deptos' => $depto,
        ];

        return view('administracao/itemcontrole/criar', $data);
    }
}
