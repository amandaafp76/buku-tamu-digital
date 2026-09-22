<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVisitsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'visit_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'guest_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'department_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'employee_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'purpose_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'identity_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'identity_no' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'group_size' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 1,
            ],
            'arrival_time' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'check_in' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'check_out' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'duration' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'qr_token' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'consent' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'photo_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'signature_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
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
        $this->forge->addUniqueKey('visit_code');
        $this->forge->addUniqueKey('qr_token');

        $this->forge->addForeignKey(
            'guest_id',
            'guests',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->forge->addForeignKey(
            'department_id',
            'departments',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->forge->addForeignKey(
            'employee_id',
            'employees',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->forge->addForeignKey(
            'purpose_id',
            'visit_purposes',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->forge->createTable('visits');
    }

    public function down()
    {
        $this->forge->dropTable('visits');
    }
}
