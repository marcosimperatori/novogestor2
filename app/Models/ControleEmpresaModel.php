<?php

namespace App\Models;

use CodeIgniter\Model;

class ControleEmpresaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'clientes_controle';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = '\App\Entities\ControleEmpresaEntity';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idcliente', 'iditem', 'inicio', 'final'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';

    // Validation
    protected $validationRules      = [
        'idcliente' => 'is_natural_no_zero|required_without[idcliente]',
        'iditem'    => 'is_natural_no_zero|required_without[iditem]',
        'inicio'    => 'required',
    ];
    protected $validationMessages   = [
        'idcliente' => [
            'is_natural_no_zero' => 'Informe o cliente',
            'required_without'   => 'Informe o cliente',
        ],
        'iditem' => [
            'is_natural_no_zero' => 'Escolha ao menos um item para controlar',
            'required_without'   => 'Escolha ao menos um item para controlar',
        ],
        'inicio' => [
            'required' => 'Selecione uma data'
        ],
    ];

    protected $beforeInsert   = ['dataParaCompetencia'];


    protected function dataParaCompetencia(array $data)
    {
        // Verifique se o campo 'data_coluna' está presente nos dados inseridos
        if (isset($data['data']['inicio'])) {

            $competencia = explode('/', $data['data']['inicio']);
            $ano = $competencia[1];
            $mes = $competencia[0];
            $dataCompleta = $ano . '-' . str_pad($mes, 2, '0', STR_PAD_LEFT) . '-01';
            $data['data']['inicio'] = $dataCompleta;
        }

        if (isset($data['data']['final'])) {

            $competencia = explode('/', $data['data']['final']);
            $ano = $competencia[1];
            $mes = $competencia[0];
            $dataCompleta = $ano . '-' . str_pad($mes, 2, '0', STR_PAD_LEFT) . '-01';
            $data['data']['final'] = $dataCompleta;
        }

        return $data;
    }
}
