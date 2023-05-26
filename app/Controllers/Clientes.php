<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClienteModel;

class Clientes extends BaseController
{
    private $clienteModel;

    public function __construct()
    {
        $this->clienteModel = new ClienteModel();
    }

    public function index()
    {
        return view('clientes/index');
    }

    public function recuperaClientes()
    {
        //garatindo que este método seja chamado apenas via ajax
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $atributos = ['id', 'codigo', 'apelido', 'ativo', 'vectocertificado'];

        $clientes = $this->clienteModel->select($atributos)->orderBy('apelido', 'asc')->findAll();

        //recebe o array de objetos clientes
        $data = [];

        foreach ($clientes as $cliente) {
            $data[] = [
                //'imagem' => $cliente->imagem = img($imagem),
                'apelido' => anchor("administracao/clientes/editar/$cliente->id", esc($cliente->apelido), 'title="Exibir detalhes do cliente"'),
                //'email' => esc($cliente->email),
                'vecto' => date('d/m/Y', strtotime($cliente->vectocertificado)),
                'ativo' => ($cliente->ativo == true ? '<i class="fa fa-unlock text-success"></i>&nbsp;Ativo' : '<i class="fa fa-lock text-danger"></i>&nbsp;Inativo'),
            ];
        }

        $retorno = [
            'data' => $data
        ];

        return $this->response->setJSON($retorno);
    }

    public function criar()
    {
        $cliente = new \App\Entities\Cliente;

        $data = [
            'titulo' => "Criando novo cliente",
            'cliente' => $cliente,
        ];

        return view('clientes/criar', $data);
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
        $cliente = new \App\Entities\Cliente($post);

        if ($this->clienteModel->protect(false)->save($cliente)) {

            //captura o id do cliente que acabou de ser inserido no banco de dados
            $retorno['id'] = $this->clienteModel->getInsertID();
            $Novocliente = $this->buscaClienteOu404($retorno['id']);

            session()->setFlashdata('sucesso', "O registro ($Novocliente->razao) foi incluído no sistema.");

            return $this->response->setJSON($retorno);
        }

        //se chegou até aqui, é porque tem erros de validação
        $retorno['erro'] = "Verifique os aviso de erro e tente novamente";
        $retorno['erros_model'] = $this->clienteModel->errors();

        return $this->response->setJSON($retorno);
    }

    public function editar(int $id = null)
    {
        $cliente = $this->buscaClienteOu404($id);

        $data = [
            'titulo' => "Editando o cliente",
            'cliente' => $cliente,
        ];
        return view('clientes/editar', $data);
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

        $cliente = $this->buscaClienteOu404($post['id']);

        //preenchendo os atributos com os valores que vieram do post
        //o ci4 consegue preencher o objeto com os dados do formulário graças a entidade de classe
        $cliente->fill($post);

        //verificando se o objeto teve alguma alteração nos seus atributos
        if ($cliente->hasChanged() == false) {
            $retorno['info'] = "Não houve alteração no registro!";

            return $this->response->setJSON($retorno);
        }

        if ($this->clienteModel->protect(false)->save($cliente)) {
            session()->setFlashdata('sucesso', "O registro: $cliente->razao foi atualizado");
            return $this->response->setJSON($retorno);
        }

        //se chegou até aqui, é porque tem erros de validação
        $retorno['erro'] = "Verifique os aviso de erro e tente novamente";
        $retorno['erros_model'] = $this->clienteModel->errors();

        return $this->response->setJSON($retorno);
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
        if (!$id || !$cliente = $this->clienteModel->withDeleted(false)->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Cliente não encontrado com o ID: $id");
        }

        return $cliente;
    }
}
