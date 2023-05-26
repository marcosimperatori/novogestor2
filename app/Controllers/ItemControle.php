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

        $itens = $this->itemModel->select('itemcontrole.id, itemcontrole.nome,itemcontrole.tipo ,departamentos.nome as depto')
            ->join('departamentos', 'departamentos.id = itemcontrole.depto')
            ->orderBy('nome', 'asc')->findAll();

        //recebe o array de objetos clientes
        $data = [];

        foreach ($itens as $item) {
            if ($item->tipo == '1')
                $tipo = '<i class="fas fa-donate text-primary"></i>&nbsp;Imposto';
            else if ($item->tipo == '2')
                $tipo = '<i class="fas fa-exclamation-triangle text-danger"></i>&nbsp;Obrigação';
            else
                $tipo = '<i class="fas fa-paste text-success"></i></i>&nbsp;Controle interno';

            $data[] = [
                'nome' => anchor("administracao/itemcontrole/editar/$item->id", esc($item->nome), 'title="Exibir detalhes do item"'),
                'depto' => $item->depto,
                'tipo' => $tipo,
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

        //Criando um novo objeto da entidade usuário
        $cliente = new \App\Entities\ItemControleEntity($post);

        if ($this->itemModel->protect(false)->save($cliente)) {

            //captura o id do cliente que acabou de ser inserido no banco de dados
            $retorno['id'] = $this->itemModel->getInsertID();
            $novoItem = $this->itemModel->find($retorno['id']);

            session()->setFlashdata('sucesso', "O registro ($novoItem->nome) foi incluído no sistema.");

            $retorno['Resultado'] = 'Registro salvo com sucesso';
            return $this->response->setJSON($retorno);
        }

        //se chegou até aqui, é porque tem erros de validação
        $retorno['erro'] = "Verifique os aviso de erro e tente novamente";
        $retorno['erros_model'] = $this->itemModel->errors();

        return $this->response->setJSON($retorno);
    }

    public function editar(int $id = null)
    {
        $item = $this->buscaItemControleOu404($id);
        $departamentoModel = new \App\Models\DepartamentoModel();
        $depto = $departamentoModel->orderBy('nome', 'asc')->findAll();


        $data = [
            'titulo' => "Editando o item",
            'itemcontrole' => $item,
            'deptos' => $depto,
        ];
        return view('administracao/itemcontrole/editar', $data);
    }

    public function atualizar()
    {
        //garatindo que este método seja chamado apenas via ajax
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        //atualiza o token do formulário
        $retorno['token'] = csrf_hash();

        //recuperando os dados que vieram na requisiçao
        $post = $this->request->getPost();

        $item = $this->buscaItemControleOu404($post['id']);

        //preenchendo os atributos com os valores que vieram do post
        //o ci4 consegue preencher o objeto com os dados do formulário graças a entidade de classe
        $item->fill($post);

        //verificando se o objeto teve alguma alteração nos seus atributos
        if ($item->hasChanged() == false) {
            $retorno['info'] = "Não houve alteração no registro!";

            return $this->response->setJSON($retorno);
        }

        if ($this->itemModel->protect(false)->save($item)) {
            session()->setFlashdata('sucesso', "O registro: $item->nome foi atualizado");
            return $this->response->setJSON($retorno);
        }

        //se chegou até aqui, é porque tem erros de validação
        $retorno['erro'] = "Verifique os aviso de erro e tente novamente";
        $retorno['erros_model'] = $this->itemModel->errors();

        return $this->response->setJSON($retorno);
    }

    /**
     * Método que recupera o item de controle
     *
     * @param integer|null $id
     * @return Exception|object
     */
    private function buscaItemControleOu404(int $id = null)
    {
        //vai considerar inclusive os registros excluídos (softdelete)
        if (!$id || !$cliente = $this->itemModel->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Item de controle não encontrado com o ID: $id");
        }

        return $cliente;
    }
}
