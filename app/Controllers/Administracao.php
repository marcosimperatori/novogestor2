<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClienteModel;

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
            ->select('(SELECT COUNT(c.id) FROM clientes c WHERE c.vectocertificado < CURRENT_DATE) AS inativos')
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

    public function graficoResumoTipoCliente()
    {
        if (!$this->request->isAJAX()) {
            $retorno['resultado'] = 'Sem permissão de acesso!';
            return $this->response->setJSON($retorno);
        }

        $lista = $this->clienteModel
            ->select('tipo, COUNT(*) AS total')
            ->groupBy('tipo')
            ->findAll();


        $chartData = [
            ['Tipo', 'Total'],
        ];

        foreach ($lista as $row) {
            $chartData[] = [$row['tipo'], (int) $row['total']];
        }

        $jsonData = json_encode($chartData);

        return view('chart_view', ['jsonData' => $jsonData]);
    }
}
