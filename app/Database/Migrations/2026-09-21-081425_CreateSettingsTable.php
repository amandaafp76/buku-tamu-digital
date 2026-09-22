<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'institution_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'primary_color' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
            ],
            'require_photo' => [
                'type'    => 'BOOLEAN',
                'default' => true,
            ],
            'require_signature' => [
                'type'    => 'BOOLEAN',
                'default' => true,
            ],
            'warning_limit' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 0,
            ],
            'photo_size' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 0,
            ],
            'wakita_enabled' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'wakita_api_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'wakita_api_key' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'wakita_sender' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
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
        $this->forge->addUniqueKey('institution_id');

        $this->forge->addForeignKey(
            'institution_id',
            'institutions',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('settings');
    }

    public function down()
    {
        $this->forge->dropTable('settings');
    }
}
