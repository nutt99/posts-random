<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dislikes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_post' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['id_user', 'id_post']);
        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_post', 'posts', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('dislikes');
    }

    public function down()
    {
        $this->forge->dropTable('dislikes');
    }
}