<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ConfigClientes extends BaseController
{
    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new \App\Models\UsuarioModel();
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

        $getUser = $this->request->getGet();
        $id = $getUser['id'];

        $clientes = new \App\Models\ClienteModel();

        $lista = $clientes
            ->select('clientes.codigo, clientes.apelido, clientes.id')
            ->join('clientesresponsavel', 'clientesresponsavel.idcliente = clientes.id', 'left')
            ->where('clientesresponsavel.idcliente IS NULL')
            ->findAll();

        //a partir do usuário eu consigo obter seu departamento
        $usuarioAtivo = new \App\Models\UsuarioModel();
        $usuario = $usuarioAtivo->find($id);

        //buscar apenas os usuários que são do mesmo departamento que o usuário que chegou neste método
        $deparmentoModel = new \App\Models\DepartamentoModel();


        $listaDeptos1 = $deparmentoModel
            ->select('usuarios.id, usuarios.nome, usuarios.imagem')
            ->join('clientesresponsavel', 'clientesresponsavel.iddepto = departamentos.id')
            ->join('usuarios', 'usuarios.id = clientesresponsavel.idusuario')
            ->where('clientesresponsavel.iddepto', $usuario->depto)
            ->orderBy('nome', 'asc')->findAll();


        $listaDeptos = $usuarioAtivo->orderBy('nome', 'asc')->findAll();

        $data = [];

        foreach ($lista as $retorno) {
            $imagens = '';

            foreach ($listaDeptos as $user) {
                if ($user->imagem != null) {
                    $imagem = [
                        'src'   => site_url("usuarios/imagem/$user->imagem"),
                        'class' => 'rounded-circle img-fluid',
                        'alt'   => esc($user->nome),
                        'title' => "Vincule a " . esc($user->nome),
                        'width' => '45',
                        'data-usuario' => $user->id,
                        'data-empresa' => $retorno->id,
                        'id' => "img-usuario",
                    ];
                } else {
                    $imagem = [
                        'src'   => site_url("assets/img/user_sem_imagem.png"),
                        'class' => 'rounded-circle img-fluid',
                        'alt'   => "Usuário sem imagem",
                        'title' => "Vincule a " . esc($user->nome),
                        'width' => '45',
                        'data-usuario' => $user->id,
                        'data-empresa' => $retorno->id,
                        'id' => "img-usuario",
                    ];
                }

                $imagens .= img($imagem);
            }

            $data[] = [
                'codigo'  => $retorno->codigo,
                'apelido' => $retorno->apelido,
                // 'acao'    => '<div class="text-success" data-id=' . $retorno->id . ' style="cursor:pointer;" title="Vincular cliente ao usuário ativo"><i class="fas fa-thumbs-up"></i>&nbsp;Vincular ao usuário</div>',
                'imagem' => $imagens,
            ];
        }

        $retorno = [
            'data' => $data,
        ];

        $resultado = json_encode($data);
        // echo "<pre>";
        // print_r($resultado);
        // exit;

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
                //'nome'    => $retorno->nome,
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
            ->select('usuarios.nome,usuarios.imagem,clientes.codigo, clientes.apelido, clientesresponsavel.id AS resp')
            ->join('clientesresponsavel', 'clientesresponsavel.idcliente = clientes.id')
            ->join('usuarios', 'usuarios.id = clientesresponsavel.idusuario')
            ->where('clientesresponsavel.idusuario =', $id)
            ->findAll();


        $data = [];

        foreach ($retornos as $item) {
            if ($item->imagem != null) {
                $imagem = [
                    'src'   => site_url("usuarios/imagem/$item->imagem"),
                    'class' => 'rounded-circle img-fluid',
                    'alt'   => esc($item->nome),
                    'title' => esc($item->nome),
                    'width' => '45'
                ];
            } else {
                $imagem = [
                    'src'   => site_url("assets/img/user_sem_imagem.png"),
                    'class' => 'rounded-circle img-fluid',
                    'alt'   => "Usuário sem imagem",
                    'title' => esc($item->nome),
                    'width' => '45'
                ];
            }

            $data[] = [
                'codigo'  => $item->codigo,
                'apelido' => $item->apelido,
                'imagem'  => img($imagem),
                'acao'    => '<div id="usuario-ativo" class="text-danger" data-id=' . $item->resp . ' style="cursor:pointer;" title="Desvincular cliente do usuário"><i class="fas fa-backspace"></i>&nbsp;Desvincular</div>'
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

        $retorno['token'] = csrf_hash();

        $cliente = new \App\Models\ClienteResponsavelModel();

        $id = $this->request->getPost('id');
        $respCliente = $this->buscaUsuarioOu404($id);

        $cliente->delete($respCliente->id);
        $retorno['resultado'] = 'Cliente desvinculado do usuário, com sucesso!';

        return $this->response->setJSON($retorno);
    }

    public function vincularCliente()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $retorno['token'] = csrf_hash();

        $postUser = $this->request->getPost();

        //preencho uma instancia da classe de controle com os dados que vieram do post
        $controle = new \App\Entities\ClienteResponsavel();

        $usuario = $this->buscaUsuarioOu404($postUser['idUsuario']);

        $controle->idcliente = $postUser['idCliente'];
        $controle->idusuario = $usuario->id;
        $controle->iddepto = $usuario->depto;

        $responsavelModel = new \App\Models\ClienteResponsavelModel();

        if ($responsavelModel->protect(false)->save($controle)) {
            $retorno['resultado'] = 'Cliente foi vinculado ao usuário com sucesso';
            return $this->response->setJSON($retorno);
        }

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
        if (!$id || !$usuario = $this->usuarioModel->find($id)) {
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
