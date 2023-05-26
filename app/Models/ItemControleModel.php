<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemControleModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'itemcontrole';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = '\App\Entities\ItemControleEntity';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nome', 'tipo', 'obsitem', 'depto'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    // Validation
    protected $validationRules      = [
        'nome'    => 'required|min_length[3]|max_length[120]|is_unique[itemcontrole.nome,id,{$id}]',
        'obsitem' => 'max_length[250]',
        'depto'   => 'is_natural_no_zero',
        'tipo'    => 'is_natural_no_zero',
    ];

    protected $validationMessages   = [
        'nome' => [
            'required'   => 'A descrição para o item de controle é obrigatória',
            'min_length' => 'A descrição precisa ter ao menos 03 caracteres.',
            'max_length' => 'A descrição pode ter no máximo 120 caracteres.',
            'is_unique'   => 'Esta descrição já está sendo usada'
        ],
        'obsitem' => [
            'max_length'  => 'O apelido pode ter no máximo 250 caracteres.',
        ],
        'depto' => [
            'is_natural_no_zero' => 'Selecione o departamento'
        ],
        'tipo' => [
            'is_natural_no_zero' => 'Selecione o tipo'
        ],
    ];
}
