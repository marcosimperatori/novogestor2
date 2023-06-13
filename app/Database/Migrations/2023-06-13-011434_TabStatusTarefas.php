<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TabStatusTarefas extends Migration
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
            'descricao' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('status_tarefas');
    }

    public function down()
    {
        $this->forge->dropTable('status_tarefas');
    }
}
