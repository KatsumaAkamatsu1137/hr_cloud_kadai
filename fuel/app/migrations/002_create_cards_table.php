<?php

namespace Fuel\Migrations;

class Create_cards_table
{
    public function up()
    {
        \DBUtil::create_table('cards', [
            'id'        => ['type' => 'int', 'auto_increment' => true, 'constraint' => 11, 'unsigned' => true],
            'play_id'   => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'type'      => ['type' => 'enum', 'constraint' => ["hand", "flop", "turn", "river"]],
            'card_rank'      => ['type' => 'varchar', 'constraint' => 2], // A, K, Q, J, 10, 9...
            'suit'      => ['type' => 'enum', 'constraint' => ["spade", "heart", "diamond", "club"]],
            'created_at'=> ['type' => 'timestamp', 'default' => \DB::expr('CURRENT_TIMESTAMP')],
        ], ['id']);

        // 外部キー制約 (play_id → plays.id)
        \DBUtil::add_foreign_key('cards', [
            'constraint' => 'fk_cards_play_id',
            'key' => 'play_id',
            'reference' => [
                'table' => 'plays',
                'column' => 'id',
            ],
            'on_delete' => 'CASCADE',
        ]);
    }

    public function down()
    {
        \DBUtil::drop_table('cards');
    }
}