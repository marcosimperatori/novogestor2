<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TabItensControle extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'depto' => [
                'type' => 'INT',
                'constraint' => 9,
                'unsigned' => true,
            ],
            'id' => [
                'type' => 'INT',
                'constraint' => 9,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => 120,
            ],
            'tipo' => [
                'type' => 'VARCHAR',
                'constraint' => 1,
                'default' => '0',
            ],
            'obsitem' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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

        //diz para o bd para adicionar a coluna id como chave primária
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('nome');
        $this->forge->addForeignKey('iddepto', 'departamentos', 'id', 'CASCADE', 'CASCADE', 'itemcont_depto');

        $this->forge->createTable('itemcontrole');
    }

    public function down()
    {
        $this->forge->dropTable('itemcontrole');
    }
}
