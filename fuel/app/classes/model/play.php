<?php

class Model_Play extends Orm\Model_Soft
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
        'deleted_at',
    ];

    protected static $_table_name = 'plays';

    protected static $_soft_delete = ['deleted_at'];

    protected static $_has_many = [
        'cards' => [
            'model_to' => 'Model_Card',
            'key_from' => 'id',
            'key_to' => 'play_id',
            'cascade_delete' => true,
        ],
    ];
}