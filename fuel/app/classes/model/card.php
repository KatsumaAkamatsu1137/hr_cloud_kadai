<?php

class Model_Card extends Orm\Model
{
    protected static $_properties = [
        'id',
        'play_id',
        'type',
        'card_rank',
        'suit',
    ];

    protected static $_table_name = 'cards';

    protected static $_belongs_to = [
        'play' => [
            'model_to' => 'Model_Play',
            'key_from' => 'play_id',
            'key_to' => 'id',
        ],
    ];
}