<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TabClienteResponsavel extends Migration
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
            'idusuario' => [
                'type' => 'INT',
                'constraint' => 9,
                'unsigned' => true,
            ],
            'iddepto' => [
                'type' => 'INT',
                'constraint' => 9,
                'unsigned' => true,
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
        $this->forge->addForeignKey('idcliente', 'clientes', 'id', 'CASCADE', 'NO ACTION', 'resp_cliente');
        $this->forge->addForeignKey('idusuario', 'usuarios', 'id', 'NO ACTION', 'NO ACTION', 'resp_user');
        $this->forge->addForeignKey('iddepto', 'departamentos', 'id', 'CASCADE', 'CASCADE', 'resp_depto');
        $this->forge->createTable('clientesresponsavel');
    }

    public function down()
    {
        $this->forge->dropTable('clientesresponsavel');
    }
}
