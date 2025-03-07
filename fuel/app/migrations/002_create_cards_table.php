<?php

namespace Fuel\Migrations;

class Create_cards_table
{
	public function up()
	{
		\DBUtil::create_table('cards', [
			'id'       => ['type' => 'int', 'auto_increment' => true, 'constraint' => 11],
			'play_id'  => ['type' => 'int', 'constraint' => 11],
			'type'     => ['type' => 'enum', 'constraint' => ['hand', 'flop', 'turn', 'river']],
			'rank'     => ['type' => 'varchar', 'constraint' => 2],
			'suit'     => ['type' => 'enum', 'constraint' => ['♠', '♥', '♦', '♣']],
		], ['id']);
	
		\DBUtil::create_index('cards', 'play_id', 'idx_play_id');
	}
	
	public function down()
	{
		\DBUtil::drop_table('cards');
	}
}