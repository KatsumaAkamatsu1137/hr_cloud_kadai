<?php

use Orm\Model;

class Model_Play extends Model
{
    protected static $_properties = [
        'id',
        'position',
        'sb',
        'bb',
        'ante',
        'memo',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected static $_conditions = array(
        'where' => array(
            array('deleted_at', 'IS', null), // 削除されていないデータのみ取得
        ),
    );

    protected static $_has_many = [
        'cards' => [
            'model_to' => 'Model_Card',
            'key_from' => 'id',
            'key_to'   => 'play_id',
            'cascade_delete' => true,
        ]
    ];

    protected static $_observers = [
        'Orm\Observer_CreatedAt' => [
            'events' => ['before_insert'],
            'mysql_timestamp' => true,
        ],
        'Orm\Observer_UpdatedAt' => [
            'events' => ['before_update'],
            'mysql_timestamp' => true,
        ],
    ];

    protected static $_table_name = 'plays';
}