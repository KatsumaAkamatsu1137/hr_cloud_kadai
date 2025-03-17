<?php
return array(
    '_root_'  => 'plays/index',  // デフォルトページ
    'plays/index' => 'plays/index',
    'plays/create' => 'plays/create',
    'plays/view/(:num)' => 'plays/view/$1',
    'plays/edit/(:num)' => 'plays/edit/$1',
    'plays/delete/(:num)' => 'plays/delete/$1',
);
