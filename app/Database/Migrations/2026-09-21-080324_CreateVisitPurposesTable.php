<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVisitPurposesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'purpose_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'active' => [
                'type'    => 'BOOLEAN',
                'default' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('visit_purposes');
    }

    public function down()
    {
        $this->forge->dropTable('visit_purposes');
    }
}
