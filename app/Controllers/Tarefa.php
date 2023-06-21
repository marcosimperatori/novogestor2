<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TarefaModel;

class Tarefa extends BaseController
{
    private $tarefaModel;

    public function __construct()
    {
        $this->tarefaModel = new TarefaModel();
    }

    public function index()
    {
        return view('tarefas/index');
    }

    public function recuperaTarefas()
    {
        //garatindo que este método seja chamado apenas via ajax
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $parametro = $this->request->getVar('parametro');

        if (empty($parametro)) {
            $tarefas =  $this->tarefaModel->select(
                'tarefas.id, tarefas.titulo,tarefas.status, tarefas.vecto,usuarios.nome as nome_autor, usuarios.imagem,clientes.razao,
                departamentos.nome as depto'
            )
                ->join('clientes', 'clientes.id = tarefas.idcliente')
                ->join('usuarios', 'usuarios.id = tarefas.executadapor')
                ->join('departamentos', 'departamentos.id = usuarios.depto')
                ->orderBy('tarefas.vecto', 'asc')
                ->orderBy('tarefas.titulo', 'asc')
                ->findAll();
        } else {
            $tarefas = $this->tarefaModel->select(
                'tarefas.id, tarefas.titulo,tarefas.status, tarefas.vecto,usuarios.nome as nome_autor, usuarios.imagem,clientes.razao,
                departamentos.nome as depto'
            )
                ->join('clientes', 'clientes.id = tarefas.idcliente')
                ->join('usuarios', 'usuarios.id = tarefas.executadapor')
                ->join('departamentos', 'departamentos.id = usuarios.depto')
                ->where('tarefas.status', $parametro)
                ->orderBy('tarefas.vecto', 'asc')
                ->orderBy('tarefas.titulo', 'asc')
                ->findAll();
        }

        //recebe o array de objetos tarefas
        $data = [];

        foreach ($tarefas as $tarefa) {
            if ($tarefa->imagem != null) {
                $imagem = [
                    'src'   => site_url("usuarios/imagem/$tarefa->imagem"),
                    'class' => 'rounded-circle img-fluid',
                    'alt'   => esc($tarefa->nome_autor),
                    'title' => esc($tarefa->nome_autor),
                    'width' => '40'
                ];
            } else {
                $imagem = [
                    'src'   => site_url("assets/img/user_sem_imagem.png"),
                    'class' => 'rounded-circle img-fluid',
                    'alt'   => "Usuário sem imagem",
                    'title' => esc($tarefa->nome_autor),
                    'width' => '40'
                ];
            }

            if ($tarefa->status == 'Finalizada') {
                $tarefa->status = '<div class="text-success"><i class="fas fa-check"></i>&nbsp;<strong>' . $tarefa->status . '</strong></div>';
            } else {
                $tarefa->status = '<div ><i class="fas fa-exclamation text-danger"></i>&nbsp;' . $tarefa->status . '</div>';
            }

            $data[] = [
                'vencimento' => date('d/m/Y', strtotime($tarefa->vecto)),
                'titulo'     => anchor("tarefas/editar/$tarefa->id", esc($tarefa->titulo), 'title="Exibir detalhes da tarefa"'),
                'status'     => $tarefa->status,
                'cliente'    => $tarefa->razao,
                'depto'      => $this->obterIniciais($tarefa->depto),
                'imagem'     => $tarefa->imagem = img($imagem),
            ];
        }

        $retorno = [
            'data' => $data
        ];

        return $this->response->setJSON($retorno);
    }

    public function criar()
    {
        $tarefa = new \App\Entities\TarefaEntity();

        $data = [
            'titulo' => "Criando nova tarefa",
            'tarefa' => $tarefa
        ];

        return view('tarefas/criar', $data);
    }

    private function obterIniciais($expressao)
    {
        $palavras = explode(' ', $expressao);
        $iniciais = '';

        foreach ($palavras as $palavra) {
            $iniciais .= substr($palavra, 0, 1);
        }

        if (count($palavras) === 1) {
            $iniciais = substr($expressao, 0, 3);
        }

        return $iniciais;
    }
}
