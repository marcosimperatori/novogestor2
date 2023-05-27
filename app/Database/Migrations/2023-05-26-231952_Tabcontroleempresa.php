<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tabcontroleempresa extends Migration
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
            'idcliente' => [
                'type' => 'INT',
                'constraint' => 9,
                'unsigned' => true,
            ],
            'iditem' => [
                'type' => 'INT',
                'constraint' => 9,
                'unsigned' => true,
            ],
            'inicio' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'final' => [
                'type' => 'DATETIME',
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
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('idcliente', 'clientes', 'id', 'CASCADE', 'CASCADE', 'controle_cliente');
        $this->forge->addForeignKey('iditem', 'itemcontrole', 'id', 'CASCADE', 'CASCADE', 'controle_item');
        $this->forge->createTable('clientes_controle');
    }

    public function down()
    {
        $this->forge->dropTable('clientes_controle');
    }
}
