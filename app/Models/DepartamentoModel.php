<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartamentoModel extends Model
{

    protected $table            = 'departamentos';


    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nome', 'descricao'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'criato_em';
    protected $updatedField  = 'atualizado_em';
    protected $deletedField  = 'deletado_em';

    // Validation
    protected $validationRules      = [
        'nome'       => 'required|min_length[4]|max_length[100]|is_unique[grupos.nom,id,{id}]',
    ];

    protected $validationMessages   = [
        'nome' => [
            'required'   => 'O campo NOME é obrigatório.',
            'min_length' => 'O NOME precisa ter ao menos 04 caracteres.',
            'max_length' => 'O NOME pode ter no máximo 100 caracteres.',
            'is_unique'  => 'Este NOME já está sendo utilizado, favor informar um nome disponível'
        ],
    ];
}
