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
        'idcliente' => 'is_natural_no_zero',
        'iditem   ' => 'is_natural_no_zero',
        'inicio'    => 'required',
    ];
    protected $validationMessages   = [
        'idcliente' => [
            'is_natural_no_zero' => 'Informe o cliente'
        ],
        'iditem' => [
            'is_natural_no_zero' => 'Escolha ao menos um item para controlar'
        ],
        'inicio' => [
            'is_natural_no_zero' => 'Selecione uma data'
        ],
    ];
}
