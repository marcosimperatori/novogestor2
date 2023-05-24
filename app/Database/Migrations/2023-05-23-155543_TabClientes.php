<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TabClientes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 9,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'codigo' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'cnpj' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => false
            ],
            'razao' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'apelido' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => false
            ],
            'ie' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
                'default' => null,
            ],
            'codigosimples' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
                'default' => null,
            ],
            'cpfempresario' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => true,
                'default' => null,
            ],
            'empresario' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'default' => null,
            ],
            'telefone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'default' => null,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'default' => null,
            ],
            'clientedesde' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'contato' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => true,
                'default' => null,
            ],
            'tipocertificado' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'default' => null,
            ],
            'vectocertificado' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'qtdefuncionarios' => [
                'type' => 'INT',
                'constraint' => 10,
                'default' => 0,
                'null' => true
            ],
            'regimetributario' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'default' => null,
            ],
            'tipo' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'default' => null,
            ],
            'ativo' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'controlacnd' => [
                'type' => 'BOOLEAN',
                'null' => true,
                'default' => false,
            ],
            'movimentocontabil' => [
                'type' => 'BOOLEAN',
                'null' => true,
                'default' => false,
            ],
            'obs' => [
                'type' => 'VARCHAR',
                'constraint' => 1000,
                'null' => true,
                'default' => null,
            ],
            'criado_em' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'atualizado_em' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'deletado_em' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
        ]);

        //diz para o bd para adicionar a coluna id como chave primária
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('razao');
        $this->forge->addUniqueKey('cnpj');
        $this->forge->addUniqueKey('email');
        //$this->forge->addUniqueKey('ie');
        $this->forge->createTable('clientes');
    }

    public function down()
    {
        $this->forge->dropTable('clientes');
    }
}
