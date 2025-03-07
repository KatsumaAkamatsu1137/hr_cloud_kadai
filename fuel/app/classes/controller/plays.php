<?php

class Controller_Plays extends Controller
{
    private static $suit_map = [
        'spade'   => '♠',
        'heart'   => '♥',
        'diamond' => '♦',
        'club'    => '♣',
    ];

    public function action_index()
    {
        // 🔴 ダミーデータを用意 (データベースが動かなくても表示確認可能)
        $data["plays"] = array(
            array(
                "id" => 1,
                "position" => "UTG",
                "sb" => 50,
                "bb" => 100,
                "memo" => "試しのプレイ",
                "created_at" => "2025-03-05 18:00:00"
            ),
            array(
                "id" => 2,
                "position" => "BTN",
                "sb" => 50,
                "bb" => 100,
                "memo" => "BTNからのオールイン",
                "created_at" => "2025-03-05 18:10:00"
            ),
        );

        return View::forge('plays/index', $data);
    }	
}

class Controller_Base extends Controller
{
    public function before()
    {
        parent::before();

        // セッションの開始
        Session::start();

        // ユーザーがログインしていなければリダイレクト
        if (!Session::get('user_id')) {
            Response::redirect('login');
        }
    }
}


