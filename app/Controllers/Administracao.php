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
        if ($this->request->isAJAX() == false) {
            $retorno['resultado'] = 'Sem permissão de acesso!';
            return $this->response->setJSON($retorno);
        }

        $lista = $this->clienteModel->select(
            "(SELECT COUNT(c.id) AS ativos FROM clientes c WHERE c.vectocertificado >= CURRENT_DATE) ",
            "(SELECT COUNT(c.id) AS inativos FROM clientes c WHERE c.vectocertificado < CURRENT_DATE) ",
            "(SELECT COUNT(c.id) AS sem_cert FROM clientes c WHERE c.vectocertificado = '00-00-0000' OR c.vectocertificado IS NULL) "
        )
            ->groupBy(1, 2, 3)
            ->get()->getRow();


        if (!empty($result)) {
            $lista = [
                'ativos' => $result[0]->ativos,
                'inativos' => $result[0]->inativos,
                'sem_cert' => $result[0]->sem_cert
            ];
        } else {
            $lista = [
                'ativos' => 0,
                'inativos' => 0,
                'sem_cert' => 0
            ];
        }

        return $this->response->setJSON($lista);
    }
}
