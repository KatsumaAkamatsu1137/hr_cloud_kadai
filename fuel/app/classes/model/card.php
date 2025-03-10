<?php

use Orm\Model;

class Model_Card extends Model
{
    protected static $_properties = [
        'id',
        'play_id',
        'type',
        'card_rank',
        'suit',
        'created_at',
    ];

    protected static $_belongs_to = [
        'play' => [
            'model_to' => 'Model_Play',
            'key_from' => 'play_id',
            'key_to'   => 'id',
        ]
    ];

    protected static $_observers = [
        'Orm\Observer_CreatedAt' => [
            'events' => ['before_insert'],
            'mysql_timestamp' => true,
        ],
    ];    

    protected static $_table_name = 'cards';
}
