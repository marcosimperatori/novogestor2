<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ConfigClientes extends BaseController
{
    private $clienteReponsavelModel;

    public function __construct()
    {
        $this->clienteReponsavelModel = new \App\Models\ClienteResponsavelModel();
    }

    public function index()
    {
        $usuarioModel = new \App\Models\UsuarioModel();

        $usuarios = $usuarioModel->orderBy('nome', 'asc')
            ->withDeleted(false)->findAll();

        $data = [
            'usuarios' => $usuarios
        ];

        return view('administracao/responsavel', $data);
    }

    public function listaEmpresasUsuarioById()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        //atualiza o token do formulário
        $retorno['token'] = csrf_hash();

        $post = $this->request->getGet();

        $lista = $this->getEmpresasPorUsuario($post['id']);

        $totalEmpresas = count($lista);

        if (empty($lista)) {
            $retorno = [
                'totalEmpresas' => 0,
                'usuario' => '',
                'token' => csrf_hash(),
            ];

            return $this->response->setJSON($retorno);
        }

        $usuario = $lista[0];
        $retorno = [
            'totalEmpresas' => $totalEmpresas,
            'usuario' => $usuario,
            'token' => csrf_hash(),
        ];

        return $this->response->setJSON($retorno);
    }

    public function empresasSemResponsavel()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $clientes = new \App\Models\ClienteModel();

        $lista = $clientes
            ->select('clientes.codigo, clientes.apelido, clientes.id')
            ->join('clientesresponsavel', 'clientesresponsavel.idcliente = clientes.id', 'left')
            ->where('clientesresponsavel.idcliente IS NULL')
            ->findAll();

        $data = [];

        foreach ($lista as $retorno) {
            $data[] = [
                'codigo'  => $retorno->codigo,
                'apelido' => $retorno->apelido,
                'acao'    => '<div class="text-success" style="cursor:pointer;" title="Desvincular cliente do usuário"><i data-id=' . $retorno->id . ' class="fas fa-thumbs-up"></i>&nbsp;Vincular ao usuário</div>'
            ];
        }

        $retorno = [
            'data' => $data,
        ];

        return $this->response->setJSON($retorno);
    }

    public function empresasOutroResponsavel()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $get = $this->request->getGet();

        $id = $get['id'];

        $clientes = new \App\Models\ClienteModel();

        $lista = $clientes
            ->select('clientes.codigo, clientes.apelido,usuarios.imagem,usuarios.nome, clientesresponsavel.id AS controle')
            ->join('clientesresponsavel', 'clientesresponsavel.idcliente = clientes.id')
            ->join('usuarios', 'usuarios.id = clientesresponsavel.idusuario')
            ->where('clientesresponsavel.idusuario !=', $id)
            ->findAll();

        $data = [];

        foreach ($lista as $retorno) {

            if ($retorno->imagem != null) {
                $imagem = [
                    'src'   => site_url("usuarios/imagem/$retorno->imagem"),
                    'class' => 'rounded-circle img-fluid',
                    'alt'   => esc($retorno->nome),
                    'title' => esc($retorno->nome),
                    'width' => '45'
                ];
            } else {
                $imagem = [
                    'src'   => site_url("assets/img/user_sem_imagem.png"),
                    'class' => 'rounded-circle img-fluid',
                    'alt'   => "Usuário sem imagem",
                    'title' => esc($retorno->nome),
                    'width' => '45'
                ];
            }

            $data[] = [
                'codigo'  => $retorno->codigo,
                'apelido' => $retorno->apelido,
                'nome'    => $retorno->nome,
                'imagem'  => $retorno->imagem = img($imagem),
                'acao'    => '<div id="outros-usuarios" class="text-danger" data-id=' . $retorno->controle . ' style="cursor:pointer;" title="Desvincular cliente do usuário"><i class="fas fa-backspace" ></i>&nbsp;Desvincular</div>'
            ];
        }

        $retorno = [
            'data' => $data,
        ];

        return $this->response->setJSON($retorno);
    }

    public function empresasResponsavel()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $get = $this->request->getGet();

        $id = $get['id'];

        $clientes = new \App\Models\ClienteModel();

        $retornos = $clientes
            ->select('clientes.codigo, clientes.apelido, clientesresponsavel.id AS resp')
            ->join('clientesresponsavel', 'clientesresponsavel.idcliente = clientes.id')
            ->where('clientesresponsavel.idusuario =', $id)
            ->findAll();


        $data = [];

        foreach ($retornos as $item) {
            $data[] = [
                'codigo'  => $item->codigo,
                'apelido' => $item->apelido,
                'acao'    => '<div class="text-danger" data-id=' . $item->resp . ' style="cursor:pointer;" title="Desvincular cliente do usuário"><i class="fas fa-backspace"></i>&nbsp;Desvincular</div>'
            ];
        }

        $retorno = [
            'data' => $data,
        ];


        return $this->response->setJSON($retorno);
    }

    public function excluir()
    {
        //garatindo que este método seja chamado apenas via ajax
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $id = $this->request->getPost('id');
        $respCliente = $this->buscaUsuarioOu404($id);

        $this->clienteReponsavelModel->delete($respCliente->id);
        $retorno['resultado'] = 'Cliente desvinculado do usuário, com sucesso!';

        return $this->response->setJSON($retorno);
    }

    /**
     * Método que recupera o usuário
     *
     * @param integer|null $id
     * @return Exception|object
     */
    private function buscaUsuarioOu404(int $id = null)
    {
        //vai considerar inclusive os registros excluídos (softdelete)
        if (!$id || !$usuario = $this->clienteReponsavelModel->withDeleted(true)->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Registro não encontrado com o ID: $id");
        }

        return $usuario;
    }

    /**
     * Undocumented function
     *
     * @param integer|null $id
     * @return array
     */
    private function getEmpresasPorUsuario(int $id = null): array
    {
        $listaClientes = new \App\Models\ClienteResponsavelModel();

        $atributos = [
            'usuarios.ultimo_login',
            'usuarios.ativo',
            'usuarios.email',
            'usuarios.depto',
            'clientes.codigo',
            'clientes.id',
            'clientes.apelido',
            'clientes.ativo'
        ];

        $retorno = $listaClientes
            ->select($atributos)
            ->join('clientes', 'clientes.id = clientesresponsavel.idcliente')
            ->join('usuarios', 'usuarios.id = clientesresponsavel.idusuario')
            ->where('usuarios.id', $id)
            ->findAll();

        return $retorno;
    }
}
