<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TabTarefas extends Migration
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
            'criadapor' => [
                'type' => 'INT',
                'constraint' => 9,
                'unsigned' => true,
            ],
            'executadapor' => [
                'type' => 'INT',
                'constraint' => 9,
                'unsigned' => true,
            ],
            'vecto' => [
                'type' => 'DATE',
                'null' => 'false'
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'default' => 'Pendente'
            ],
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'descricao' => [
                'type' => 'VARCHAR',
                'constraint' => 5000,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('idcliente', 'clientes', 'id', 'CASCADE', 'NO ACTION', 'tar_cliente');
        $this->forge->addForeignKey('criadapor', 'usuarios', 'id', 'NO ACTION', 'NO ACTION', 'tar_dono');
        $this->forge->addForeignKey('executadapor', 'usuarios', 'id', 'NO ACTION', 'NO ACTION', 'tar_executa');
        $this->forge->createTable('tarefas');
    }

    public function down()
    {
        $this->forge->dropTable('tarefas');
    }
}
