<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = '\App\Entities\Usuario';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nome',
        'email',
        'password',
        'reset_hash',
        'reset_expira_em',
        'imagem',
        //o campo ativo será alterado via manipulação de formulário
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    protected $deletedField  = 'deletado_em';

    // Validation
    protected $validationRules      = [
        'nome'                  => 'required|min_length[3]|max_length[250]',
        'email'                 => 'required|valid_email|max_length[250]|is_unique[usuarios.email,id,{$id}]',
        'password'              => 'required|min_length[6]',
        'password_confirmation' => 'required_with[password]|matches[password]',
    ];

    protected $validationMessages   = [
        'nome' => [
            'required'   => 'O campo NOME é obrigatório.',
            'min_length' => 'O NOME precisa ter ao menos 03 caracteres.',
            'max_length' => 'O NOME pode ter no máximo 250 caracteres.',
        ],
        'email' => [
            'required'    => 'O campo EMAIL é obrigatório.',
            'valid_email' => 'O EMAIL não é válido.',
            'max_length'  => 'O EMAIL pode ter no máximo 250 caracteres.',
            'is_unique'   => 'Este email já está sendo utilizado, por favor, informe outro email.'
        ],
        'password' => [
            'required'    => 'O campo SENHA é obrigatório.',
            'min_length'  => 'A SENHA precisa ter no mínimo 06 caracteres.',
        ],
        'password_confirmation' => [
            'required_with' => 'Por favor, confirme sua senha.',
            'matches'       => 'As senhas não são iguais.'
        ],
    ];

    // Callbacks
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    /**
     * Método intercepta a requisição e faz o hash da posição password, caso exista.
     * Depois elimina do array de post a posição password.
     *
     * @param [type] $data
     * @return void
     */
    protected function hashPassword($data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

            //removendo estas posições pois não existem no banco de dados
            unset($data['data']['password']);
            unset($data['data']['password_confirmation']);
        }

        return $data;
    }
}
