<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartamentoModel;
use App\Models\UsuarioModel;

class Usuarios extends BaseController
{
    private $usuarioModel;
    private $departamentoModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->departamentoModel = new DepartamentoModel();
    }

    public function index()
    {
        return view('usuarios/index');
    }

    public function recuperaUsuarios()
    {
        //garatindo que este método seja chamado apenas via ajax
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $atributos = ['id', 'nome', 'email', 'ativo', 'imagem'];

        $usuarios = $this->usuarioModel->select($atributos)->orderBy('nome', 'asc')->findAll();

        //recebe o array de objetos usuários
        $data = [];

        foreach ($usuarios as $usuario) {
            if ($usuario->imagem != null) {
                $imagem = [
                    'src'   => site_url("usuarios/imagem/$usuario->imagem"),
                    'class' => 'rounded-circle img-fluid',
                    'alt'   => esc($usuario->nome),
                    'title' => esc($usuario->nome),
                    'width' => '45'
                ];
            } else {
                $imagem = [
                    'src'   => site_url("assets/img/user_sem_imagem.png"),
                    'class' => 'rounded-circle img-fluid',
                    'alt'   => "Usuário sem imagem",
                    'title' => esc($usuario->nome),
                    'width' => '45'
                ];
            }


            $data[] = [
                'imagem' => $usuario->imagem = img($imagem),
                'nome' => anchor("usuarios/editar/$usuario->id", esc($usuario->nome), 'title="Exibir detalhes do usuário"'),
                'email' => esc($usuario->email),
                'ativo' => ($usuario->ativo == true ? '<i class="fa fa-unlock text-success"></i>&nbsp;Ativo' : '<i class="fa fa-lock text-danger"></i>&nbsp;Inativo'),
            ];
        }

        $retorno = [
            'data' => $data
        ];

        return $this->response->setJSON($retorno);
    }

    public function editar(int $id = null)
    {
        $usuario = $this->buscaUsuarioOu404($id);
        $depto = $this->departamentoModel->orderBy('nome', 'asc')->findAll();

        $data = [
            'titulo' => "Editando o usuário",
            'usuario' => $usuario,
            'deptos' => $depto
        ];
        return view('usuarios/editar', $data);
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

        if (empty($post['password'])) {
            unset($post['password']);
            unset($post['password_confirmation']);
        }

        $usuario = $this->buscaUsuarioOu404($post['id']);

        //preenchendo os atributos com os valores que vieram do post
        //o ci4 consegue preencher o objeto com os dados do formulário graças a entidade de classe
        $usuario->fill($post);

        ///armazena a imagem anterior para ser excluída na sequencia
        $imagemAntiga = $usuario->imagem;


        //aplicar validação na imagem
        $validacao = service('validation');

        $regras = [
            'imagem' => 'max_size[imagem,1024]|ext_in[imagem,png,jpg,jpeg,webp]'
        ];

        $mensagens = [
            'imagem' => [
                'max_size' => 'A imagem deve ter no máximo 1Mb',
                'ext_in'   => 'Só são permitidas as extensões: .png,.jpg,.jpeg,.webp'
            ]
        ];

        $validacao->setRules($regras, $mensagens);

        if ($validacao->withRequest($this->request)->run() == false) {
            $retorno['erro'] = "Verifique os aviso de erro e tente novamente";
            $retorno['erros_model'] = $validacao->getErrors();

            return $this->response->setJSON($retorno);
        }

        if ($post['depto'] == 0) {
            $retorno['erro'] = "Verifique os aviso de erro e tente novamente";
            $retorno['erros_model'] = [
                'depto' => 'Selecione um departamento'
            ];

            return $this->response->setJSON($retorno);
        }

        if ($this->request->getFile('imagem')->isValid()) {
            //recuperando a imagem que veio no post
            $imagem = $this->request->getFile('imagem');


            list($largura, $altura) = getimagesize($imagem->getPathName());

            if ($largura < "200" || $altura < "200") {
                $retorno['erro'] = "Verifique os aviso de erro e tente novamente";
                $retorno['erros_model'] = [
                    'dimenssao' => 'A imagem deve ter a dimensão mínima de 300x300px'
                ];

                return $this->response->setJSON($retorno);
            }

            //definindo onde a imagem será salva
            $imagemCaminho = $imagem->store('usuarios');

            $imagemCaminho = WRITEPATH . 'uploads/' . $imagemCaminho;

            //manipulando a imagem
            $this->manipularImagem($imagemCaminho, $usuario->id);


            //neste momento já é possível atualizar a tabela de usuários
            $usuario->imagem = $imagem->getName();
        } else {
            $imagemAntiga = null;
        }


        //verificando se o objeto teve alguma alteração nos seus atributos
        if ($usuario->hasChanged() == false) {
            $retorno['info'] = "Não houve alteração no registro!";
            return $this->response->setJSON($retorno);
        }

        if ($this->usuarioModel->protect(false)->save($usuario)) {

            if ($imagemAntiga != null) {
                $this->removeImagemDoFileSystem($imagemAntiga);
            }

            session()->setFlashdata('sucesso', "O registro $usuario->nome foi atualizado");
            return $this->response->setJSON($retorno);
        } else {
            //senão conseguir atualizar o usuário, vou excluir a imagem que foi recém adicionada para atualizar seu perfil
            if ($imagemAntiga != null) {
                $this->removeImagemDoFileSystem($imagemAntiga);
            }
        }

        //se chegou até aqui, é porque tem erros de validação
        $retorno['erro'] = "Verifique os aviso de erro e tente novamente";
        $retorno['erros_model'] = $this->usuarioModel->errors();

        return $this->response->setJSON($retorno);
    }

    public function criar()
    {
        $usuario = new \App\Entities\Usuario;
        $depto = $this->departamentoModel->orderBy('nome', 'asc')->findAll();

        $data = [
            'titulo' => "Criando novo usuário",
            'usuario' => $usuario,
            'deptos' => $depto
        ];

        return view('usuarios/criar', $data);
    }

    public function cadastrar()
    {
        //garatindo que este método seja chamado apenas via ajax
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        //atualiza o token do formulário
        $retorno['token'] = csrf_hash();

        //aplicar validação na imagem
        $validacao = service('validation');

        $regras = [
            'imagem' => 'max_size[imagem,1024]|ext_in[imagem,png,jpg,jpeg,webp]'
        ];

        $mensagens = [
            'imagem' => [
                'max_size' => 'A imagem deve ter no máximo 1Mb',
                'ext_in'   => 'Só são permitidas as extensões: .png,.jpg,.jpeg,.webp'
            ]
        ];

        $validacao->setRules($regras, $mensagens);

        if ($validacao->withRequest($this->request)->run() == false) {
            $retorno['erro'] = "Verifique os aviso de erro e tente novamente";
            $retorno['erros_model'] = $validacao->getErrors();

            return $this->response->setJSON($retorno);
        }

        //recuperando os dados que vieram na requisiçao
        $post = $this->request->getPost();

        if ($post['depto'] == 0) {
            $retorno['erro'] = "Verifique os aviso de erro e tente novamente";
            $retorno['erros_model'] = [
                'depto' => 'Selecione um departamento'
            ];

            return $this->response->setJSON($retorno);
        }

        //Criando um novo objeto da entidade usuário
        $usuario = new \App\Entities\Usuario($post);


        if ($this->usuarioModel->protect(false)->save($usuario)) {

            //captura o id do usuário que acabou de ser inserido no banco de dados
            $retorno['id'] = $this->usuarioModel->getInsertID();
            $NovoUsuario = $this->buscaUsuarioOu404($retorno['id']);

            if ($this->request->getFile('imagem')->isValid()) {
                //recuperando a imagem que veio no post
                $imagem = $this->request->getFile('imagem');


                list($largura, $altura) = getimagesize($imagem->getPathName());

                if ($largura < "200" || $altura < "200") {
                    $retorno['erro'] = "Verifique os aviso de erro e tente novamente";
                    $retorno['erros_model'] = [
                        'dimenssao' => 'A imagem deve ter a dimensão mínima de 300x300px'
                    ];

                    return $this->response->setJSON($retorno);
                }

                //definindo onde a imagem será salva
                $imagemCaminho = $imagem->store('usuarios');

                $imagemCaminho = WRITEPATH . 'uploads/' . $imagemCaminho;

                //manipulando a imagem
                $this->manipularImagem($imagemCaminho, $NovoUsuario->id);

                //neste momento já é possível atualizar a tabela de usuários
                $NovoUsuario->imagem = $imagem->getName();

                $this->usuarioModel->protect(false)->save($NovoUsuario);
            }
            $retorno['url'] = 'usuarios';

            session()->setFlashdata('sucesso', "O registro ($NovoUsuario->nome) foi incluído no sistema.");

            return $this->response->setJSON($retorno);
        }

        //se chegou até aqui, é porque tem erros de validação
        $retorno['erro'] = "Verifique os aviso de erro e tente novamente";
        $retorno['erros_model'] = $this->usuarioModel->errors();

        return $this->response->setJSON($retorno);
    }

    public function excluir()
    {
        //garatindo que este método seja chamado apenas via ajax
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $id = $this->request->getPost('id');
        $usuario = $this->buscaUsuarioOu404($id);

        $this->usuarioModel->delete($usuario->id);

        //após remover o usuário no banco de dados, excluir sua imagem do sistema de arquivos
        if ($usuario->imagem != null) {
            $this->removeImagemDoFileSystem($usuario->imagem);
        }

        //soft delete está ativo, então o usuário não será excluído fisicamente
        $usuario->imagem = null;
        $usuario->ativo = false;
        $this->usuarioModel->protect(false)->save($usuario);

        session()->setFlashdata('sucesso', "O registro ($usuario->nome) foi excluído do sistema");

        //return redirect()->to(site_url("usuarios"))->with('sucesso', "Usuário $usuario->nome excluído");
    }

    public function imagem(string $imagem = null)
    {
        if ($imagem != null) {
            $this->exibeArquivo('usuarios', $imagem);
        }
    }

    private function manipularImagem(string $imagemCaminho, int $usuarioId)
    {
        //manipulando a imagem que neste ponto já está salva no diretório writable
        //redimensionando a imagem e sobrescrevendo a imagem anterior
        service('image')
            ->withFile($imagemCaminho)
            ->fit(300, 300, 'center')
            ->save($imagemCaminho);

        $anoAtual = date('Y');

        //adicionando uma marca d'água
        \Config\Services::image('imagick')
            ->withFile($imagemCaminho)
            ->text("$anoAtual - UserId $usuarioId", [
                'color'      => '#cc8400',
                'opacity'    => 0.5,
                'withShadow' => false,
                'hAlign'     => 'center',
                'vAlign'     => 'bottom',
                'fontSize'   => 30
            ])
            ->save($imagemCaminho);
    }

    private function removeImagemDoFileSystem(string $imagem)
    {
        $caminhoImagem = WRITEPATH . 'uploads/usuarios/' . $imagem;

        if (is_file($caminhoImagem)) {
            unlink($caminhoImagem);
        }
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
        if (!$id || !$usuario = $this->usuarioModel->withDeleted(true)->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Usuário não encontrado com o ID: $id");
        }

        return $usuario;
    }
}
