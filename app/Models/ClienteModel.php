<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table            = 'clientes';


    protected $returnType       = '\App\Entities\Cliente';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        'codigo', 'cnpj', 'razao', 'apelido', 'ie', 'codigosimples', 'cpfempresario', 'telefone',
        'email', 'clientedesde', 'contato', 'tipocertificado', 'vectocertificado', 'qtdefuncionarios',
        'regimetributario', 'controlacnd', 'movimentocontabil', 'empresario', 'tipo',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    protected $deletedField  = 'deletado_em';

    // Validation
    protected $validationRules      = [
        'codigo'     => 'required',
        'razao'      => 'required|max_length[250]|is_unique[clientes.razao,id,{$id}]',
        'apelido'    => 'required|max_length[250]|is_unique[clientes.apelido,id,{$id}]',
        'cnpj'       => 'required|max_length[18]|is_unique[clientes.cnpj,id,{$id}]',
        'ie'         => 'is_unique[clientes.ie,id,{$id}]'
    ];

    protected $validationMessages   = [
        'codigo' => [
            'required' => 'Informe o código'
        ],
        'razao' => [
            'required'   => 'A razão social é obrigatória.',
            'min_length' => 'A razão social precisa ter ao menos 03 caracteres.',
            'max_length' => 'A razão social pode ter no máximo 250 caracteres.',
            'is_unique'   => 'Esta razão social já está sendo usado'
        ],
        'apelido' => [
            'required'    => 'O campo apelido é obrigatório.',
            'max_length'  => 'O apelido pode ter no máximo 250 caracteres.',
            'is_unique'   => 'Este apelido já está sendo usado'
        ],
        'cnpj' => [
            'required'    => 'O CNPJ apelido é obrigatório.',
            'max_length'  => 'O CNPJ pode ter no máximo 18 caracteres.',
            'is_unique'   => 'O CNPJ já está sendo usado'
        ],
        'ie' => 'Esta inscrição já sendo utilizada'
    ];
}
