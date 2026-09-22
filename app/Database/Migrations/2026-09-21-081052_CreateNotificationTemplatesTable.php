<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotificationTemplatesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'recipient_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'notification_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'template_message' => [
                'type' => 'TEXT',
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

        $this->forge->createTable('notification_templates');
    }

    public function down()
    {
        $this->forge->dropTable('notification_templates');
    }
}
