<?php
use Fuel\Core\Controller;
use Fuel\Core\View;
use Fuel\Core\Response;
use Fuel\Core\Input;
use Fuel\Core\Session;
use Fuel\Core\Cookie;
use Fuel\Core\HttpNotFoundException;

class Controller_Plays extends Controller
{
    public function before()
    {
        parent::before();

        // セッション確認
        $last_edit = Session::get('last_edit_play_id', null);

        // クッキー
        $default_position = Cookie::get('default_position', 'UTG');

        // View にデフォルト値を渡す
        View::set_global('last_edit', $last_edit);
        View::set_global('default_position', $default_position);
    }

    public function action_index()
    {
        try {
            // DBクラスを使用してプレイ情報を取得
            $query = DB::select('plays.*', 'cards.card_rank', 'cards.suit', 'cards.type')
                ->from('plays')
                ->join('cards', 'LEFT')
                ->on('plays.id', '=', 'cards.play_id')
                ->where('plays.deleted_at', 'IS', NULL)
                ->execute()
                ->as_array();
    
            // データを `plays/index.php` に渡して表示
            return Response::forge(View::forge('plays/index', ['plays' => $query]));
        } catch (Database_Exception $e) {
            Log::error('データベースエラー: ' . $e->getMessage());
            return Response::forge(View::forge('error/db_error', ['error_message' => $e->getMessage()]));
        }
    }

    public function action_view($id)
    {
        try {
            // DBクラスを使用してプレイの詳細情報を取得
            $query = DB::select('plays.*', 'cards.card_rank', 'cards.suit', 'cards.type')
                ->from('plays')
                ->join('cards', 'LEFT')
                ->on('plays.id', '=', 'cards.play_id')
                ->where('plays.id', '=', $id)
                ->where('plays.deleted_at', 'IS', NULL)
                ->execute()
                ->as_array();
    
            if (empty($query)) {
                throw new HttpNotFoundException();
            }
    
            return Response::forge(View::forge('plays/view', ['play' => $query]));
        } catch (Database_Exception $e) {
            Log::error('データベースエラー: ' . $e->getMessage());
            return Response::forge(View::forge('error/db_error', ['error_message' => $e->getMessage()]));
        }
    }

    public function action_create()
    {
        if (Input::method() == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
    
            if (!$data || !isset($data['position'])) {
                return Response::forge(json_encode(['success' => false, 'message' => 'データが不正です']), 400, ['Content-Type' => 'application/json']);
            }
    
            try {
                // トランザクション開始
                DB::start_transaction();
    
                // プレイデータの作成
                $play_id = DB::insert('plays')->set(array(
                    'position' => $data['position'] ?? 'UTG',
                    'sb' => $data['sb'] ?? 0,
                    'bb' => $data['bb'] ?? 0,
                    'ante' => $data['ante'] ?? 0,
                    'memo' => $data['memo'] ?? '',
                    'created_at' => date('Y-m-d H:i:s')
                ))->execute()[0];
    
                // セッションに保存
                Session::set('last_edit_play_id', $play_id);
    
                // カード情報の保存
                $cards = [];
    
                // ハンド (2枚)
                for ($i = 1; $i <= 2; $i++) {
                    $cards[] = array(
                        'play_id' => $play_id,
                        'type' => 'hand',
                        'card_rank' => $data["hand{$i}_rank"],
                        'suit' => $data["hand{$i}_suit"],
                        'created_at' => date('Y-m-d H:i:s')
                    );
                }
    
                // ボード (フロップ3枚 + ターン1枚 + リバー1枚)
                $board_types = ['flop1', 'flop2', 'flop3', 'turn', 'river'];
                foreach ($board_types as $board) {
                    $cards[] = array(
                        'play_id' => $play_id,
                        'type' => str_replace(['flop1', 'flop2', 'flop3'], 'flop', $board),
                        'card_rank' => $data["{$board}_rank"],
                        'suit' => $data["{$board}_suit"],
                        'created_at' => date('Y-m-d H:i:s')
                    );
                }
    
                // 一括挿入
                DB::insert('cards')->columns(array('play_id', 'type', 'card_rank', 'suit', 'created_at'))->values($cards)->execute();
    
                // コミット
                DB::commit_transaction();
    
                return Response::forge(json_encode(['success' => true, 'message' => '新しいプレイを作成しました']), 200, ['Content-Type' => 'application/json']);
            } catch (Exception $e) {
                // ロールバック
                DB::rollback_transaction();
                return Response::forge(json_encode(['success' => false, 'message' => 'プレイの作成に失敗しました']), 400, ['Content-Type' => 'application/json']);
            }
        }
    
        return Response::forge(View::forge('plays/create'));
    }

    public function action_edit($id = null)
    {
        // 指定されたIDのプレイを取得
        $play = DB::select()->from('plays')->where('id', $id)->execute()->current();
        if (!$play) {
            Session::set_flash('error', '指定されたプレイが見つかりません。');
            Response::redirect('plays/index');
        }
    
        // 関連するカードを取得
        $cards = DB::select()->from('cards')->where('play_id', $id)->execute()->as_array();
    
        if (Input::method() == 'POST') {
            $val = Validation::forge();
            $val->add('position', 'ポジション')->add_rule('required');
            $val->add('sb', 'SB')->add_rule('valid_string', 'numeric');
            $val->add('bb', 'BB')->add_rule('valid_string', 'numeric');
            $val->add('ante', 'アンティ')->add_rule('valid_string', 'numeric');
    
            if ($val->run()) {
                try {
                    // トランザクション開始
                    DB::start_transaction();
    
                    // プレイ情報更新
                    DB::update('plays')->set(array(
                        'position' => Input::post('position'),
                        'sb' => Input::post('sb'),
                        'bb' => Input::post('bb'),
                        'ante' => Input::post('ante'),
                        'memo' => Input::post('memo'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ))->where('id', $id)->execute();
    
                    // クッキーにデフォルトポジションを保存
                    Cookie::set('default_position', Input::post('position'), 86400);
    
                    // セッションに最近編集したプレイのIDを保存
                    Session::set('last_edit_play_id', $id);
    
                    // カード情報の更新
                    foreach ($cards as $card) {
                        if ($card['type'] === 'hand') {
                            $index = ($card['id'] % 2 == 0) ? 1 : 2;
                            DB::update('cards')->set(array(
                                'card_rank' => Input::post("hand{$index}_rank"),
                                'suit' => Input::post("hand{$index}_suit"),
                                'updated_at' => date('Y-m-d H:i:s')
                            ))->where('id', $card['id'])->execute();
                        } else {
                            DB::update('cards')->set(array(
                                'card_rank' => Input::post("{$card['type']}_rank"),
                                'suit' => Input::post("{$card['type']}_suit"),
                                'updated_at' => date('Y-m-d H:i:s')
                            ))->where('id', $card['id'])->execute();
                        }
                    }
    
                    // コミット
                    DB::commit_transaction();
                    Session::set_flash('success', 'プレイ情報を更新しました！');
                    Response::redirect('plays/index');
                } catch (Exception $e) {
                    DB::rollback_transaction();
                    Session::set_flash('error', 'プレイ情報の更新に失敗しました。');
                }
            } else {
                Session::set_flash('error', '入力に誤りがあります。');
            }
        }
    
        return Response::forge(View::forge('plays/edit', ['play' => $play, 'cards' => $cards]));
    }
    
    public function action_update()
    {
        if (Input::method() != 'POST') {
            return $this->json_response(false, '無効なリクエスト', 400);
        }
    
        $data = json_decode(file_get_contents('php://input'), true);
        if (!isset($data['id'])) {
            return $this->json_response(false, 'IDが指定されていません', 400);
        }
    
        // トランザクション開始
        DB::start_transaction();
    
        try {
            // プレイ情報の更新
            $affected_rows = DB::update('plays')
                ->set(array(
                    'position' => $data['position'],
                    'sb' => $data['sb'],
                    'bb' => $data['bb'],
                    'ante' => $data['ante'],
                    'memo' => $data['memo'],
                    'updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
                ))
                ->where('id', $data['id'])
                ->execute();
    
            if ($affected_rows === 0) {
                DB::rollback_transaction();
                return $this->json_response(false, 'プレイ情報が見つかりません', 404);
            }
    
            // カード情報の更新
            foreach ($data['cards'] as $c) {
                DB::update('cards')
                    ->set(array(
                        'card_rank' => $c['card_rank'],
                        'suit' => $c['suit'],
                        'updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
                    ))
                    ->where('id', $c['id'])
                    ->execute();
            }
    
            // トランザクションコミット
            DB::commit_transaction();
            return $this->json_response(true, 'プレイ情報を更新しました');
        } catch (Exception $e) {
            DB::rollback_transaction();
            return $this->json_response(false, 'プレイ情報の更新に失敗しました', 500);
        }
    }

    public function action_delete($id = null)
    {
        if (Input::method() != 'POST') {
            return $this->json_response(false, '無効なリクエスト', 400);
        }
    
        // レコードの存在確認
        $play = DB::select()->from('plays')->where('id', $id)->execute()->current();
        if (!$play) {
            return $this->json_response(false, '指定されたプレイが見つかりません', 404);
        }
    
        // 削除処理 (ソフトデリート)
        try {
            $affected_rows = DB::update('plays')
                ->set(array(
                    'deleted_at' => (new \DateTime())->format('Y-m-d H:i:s')
                ))
                ->where('id', $id)
                ->execute();
    
            if ($affected_rows === 0) {
                return $this->json_response(false, 'プレイの削除に失敗しました', 500);
            }
    
            return $this->json_response(true, 'プレイを削除しました');
        } catch (Exception $e) {
            return $this->json_response(false, '削除中にエラーが発生しました', 500);
        }
    }

    public function action_api()
    {
        try {
            $plays = Model_Play::find('all', ['related' => ['cards']]);
        
            if (!$plays) {
                return Response::forge(json_encode(['success' => false, 'message' => 'プレイが見つかりません']), 404, ['Content-Type' => 'application/json']);
            }
        
            $result = [];
            foreach ($plays as $play) {
                $result[] = [
                    'id' => $play->id,
                    'position' => $play->position,
                    'sb' => $play->sb,
                    'bb' => $play->bb,
                    'ante' => $play->ante,
                    'memo' => $play->memo,
                    'created_at' => $play->created_at,
                    'updated_at' => $play->updated_at,
                    'deleted_at' => $play->deleted_at,
                    'cards' => array_map(function ($card) {
                        return [
                            'id' => $card->id,
                            'play_id' => $card->play_id,
                            'type' => $card->type,
                            'card_rank' => $card->card_rank,
                            'suit' => $card->suit,
                            'created_at' => $card->created_at,
                        ];
                    }, $play->cards)
                ];
            }
        
            return Response::forge(json_encode($result), 200, ['Content-Type' => 'application/json']);
        } catch (Exception $e) {
            Log::error('APIエラーメッセージ: ' . $e->getMessage());
            return Response::forge(json_encode(['success' => false, 'message' => '内部サーバーエラー']), 500, ['Content-Type' => 'application/json']);
        }
    }
    
    private function json_response($success, $message, $status = 200)
    {
        return Response::forge(json_encode(['success' => $success, 'message' => $message]), $status, ['Content-Type' => 'application/json']);
    }
}
