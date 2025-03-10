<?php

namespace Fuel\Migrations;

class Create_plays_table
{
    public function up()
    {
        \DBUtil::create_table('plays', [
            'id'         => ['type' => 'int', 'auto_increment' => true, 'constraint' => 11, 'unsigned' => true],
            'position'   => ['type' => 'varchar', 'constraint' => 10],
            'sb'         => ['type' => 'int', 'constraint' => 11, 'default' => 0],
            'bb'         => ['type' => 'int', 'constraint' => 11, 'default' => 0],
            'ante'       => ['type' => 'int', 'constraint' => 11, 'default' => 0],
            'memo'       => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'timestamp', 'default' => \DB::expr('CURRENT_TIMESTAMP')],
            'updated_at' => ['type' => 'timestamp', 'null' => true, 'on_update' => \DB::expr('CURRENT_TIMESTAMP')],
            'deleted_at' => ['type' => 'timestamp', 'null' => true],
        ], ['id']);
    }

    public function down()
    {
        \DBUtil::drop_table('plays');
    }
}