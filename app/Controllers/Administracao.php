<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClienteModel;
use App\Models\UsuarioModel;

class Administracao extends BaseController
{
    private $clienteModel;

    public function __construct()
    {
        $this->clienteModel = new ClienteModel();
    }

    public function index()
    {
        return view('administracao/index');
    }

    public function graficoResumoCertificadoDigital()
    {
        if (!$this->request->isAJAX()) {
            $retorno['resultado'] = 'Sem permissão de acesso!';
            return $this->response->setJSON($retorno);
        }

        $lista = $this->clienteModel
            ->select('(SELECT COUNT(c.id) FROM clientes c WHERE c.vectocertificado >= CURRENT_DATE) AS ativos')
            ->select('(SELECT COUNT(c.id) FROM clientes c WHERE c.vectocertificado < CURRENT_DATE AND c.vectocertificado <> "00-00-0000") AS inativos')
            ->select('(SELECT COUNT(c.id) FROM clientes c WHERE c.vectocertificado = "00-00-0000" OR c.vectocertificado IS NULL) AS sem_cert')
            ->findAll();

        if (!empty($lista)) {
            $data = [
                'ativos' => $lista[0]->ativos,
                'inativos' => $lista[0]->inativos,
                'sem_cert' => $lista[0]->sem_cert
            ];
        } else {
            $data = [
                'ativos' => 0,
                'inativos' => 0,
                'sem_cert' => 0
            ];
        }

        return $this->response->setJSON($data);
    }

    public function graficoFuncionariosPorDepartamento()
    {
        if (!$this->request->isAJAX()) {
            $retorno['resultado'] = 'Sem permissão de acesso!';
            return $this->response->setJSON($retorno);
        }

        $funcionario = new UsuarioModel();

        $lista = $funcionario
            ->select('departamentos.nome,COUNT(usuarios.id) AS total')
            ->join('departamentos', 'departamentos.id = usuarios.depto')
            ->groupBy('departamentos.nome')
            ->orderBy('total', 'desc')
            ->findAll();

        $chartData = [];

        foreach ($lista as $row) {
            $chartData[] = [$row->nome, (int) $row->total];
        }

        $jsonData = json_encode($chartData);

        return $this->response->setJSON($jsonData);
    }

    public function graficoRegimesTributarios()
    {
        if (!$this->request->isAJAX()) {
            $retorno['resultado'] = 'Sem permissão de acesso!';
            return $this->response->setJSON($retorno);
        }

        $lista = $this->clienteModel
            ->select('select c., count(c.id) as total from clientes c')
            ->groupBy('departamentos.nome')
            ->findAll();

        $chartData = [];

        foreach ($lista as $row) {
            $chartData[] = [$row->nome, (int) $row->total];
        }

        $jsonData = json_encode($chartData);

        return $this->response->setJSON($jsonData);
    }
}
