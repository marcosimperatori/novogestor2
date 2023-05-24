<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ConfigClientes extends BaseController
{
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

        $post = $this->request->getGet();

        $lista = $this->getEmpresasPorUsuario($post['id']);

        $totalEmpresas = count($lista);

        if (empty($lista)) {
            $retorno = [
                'totalEmpresas' => 0,
                'usuario' => ''
            ];

            return $this->response->setJSON($retorno);
        }

        $usuario = $lista[0];
        $retorno = [
            'totalEmpresas' => $totalEmpresas,
            'usuario' => $usuario
        ];

        return $this->response->setJSON($retorno);
    }

    public function empresasSemResponsavel()
    {
        /*  if (!$this->request->isAJAX()) {
            return redirect()->back();
        }*/

        $post = $this->request->getGet();

        $data = [];

        $clientes = new \App\Models\ClienteModel();


        $retorno = $clientes
            ->select('clientes.codigo, clientes.razao')
            ->join('clientesresponsavel', 'clientesresponsavel.idcliente = clientes.id', 'left')
            ->where('clientesresponsavel.idcliente IS NULL')
            ->findAll();

        return $this->response->setJSON($retorno);
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
