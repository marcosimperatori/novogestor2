<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TabRegimesTributarios extends Migration
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
                'constraint' => 150,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('regimes_tributarios');
    }

    public function down()
    {
        $this->forge->dropTable('regimes_tributarios');
    }
}
