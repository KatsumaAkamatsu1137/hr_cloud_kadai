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
        // `plays` テーブルのデータを取得（`cards` テーブルと関連付け）
        $plays = Model_Play::find('all', [
            'related' => ['cards']
        ]);

        // データを `plays/index.php` に渡して表示
        return Response::forge(View::forge('plays/index', ['plays' => $plays]));
    }

    public function action_view($id)
    {
        // ID で `plays` のレコードを取得
        $play = Model_Play::find($id, [
            'related' => ['cards']
        ]);

        if (!$play) {
            throw new HttpNotFoundException();
        }

        return Response::forge(View::forge('plays/view', ['play' => $play]));
    }

    public function action_create()
    {
        if (Input::method() == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true); // JSONデータを取得

            if (!$data || !isset($data['position'])) {
                return Response::forge(json_encode(['success' => false, 'message' => 'データが不正です']), 400, ['Content-Type' => 'application/json']);
            }

            // プレイデータの作成
            $play = Model_Play::forge(array(
                'position' => $data['position'] ?? 'UTG', // デフォルト値を設定
                'sb' => $data['sb'] ?? 0,
                'bb' => $data['bb'] ?? 0,
                'ante' => $data['ante'] ?? 0,
                'memo' => $data['memo'] ?? '',
            ));

            if ($play->save()) {
                // セッションに最近作成したプレイのIDを保存
                Session::set('last_edit_play_id', $play->id);

                // カード情報を保存
                $cards = [];

                // ハンド (2枚)
                for ($i = 1; $i <= 2; $i++) {
                    $cards[] = Model_Card::forge(array(
                        'play_id' => $play->id,
                        'type' => 'hand',
                        'card_rank' => Input::post("hand{$i}_rank"),
                        'suit' => Input::post("hand{$i}_suit"),
                    ));
                }

                // ボード (フロップ3枚 + ターン1枚 + リバー1枚)
                $board_types = ['flop1', 'flop2', 'flop3', 'turn', 'river'];
                foreach ($board_types as $board) {
                    $cards[] = Model_Card::forge(array(
                        'play_id' => $play->id,
                        'type' => str_replace(['flop1', 'flop2', 'flop3'], 'flop', $board),
                        'card_rank' => Input::post("{$board}_rank"),
                        'suit' => Input::post("{$board}_suit"),
                    ));
                }

                foreach ($cards as $card) {
                    $card->save();
                }

                return Response::forge(json_encode(['success' => true, 'message' => '新しいプレイを作成しました']), 200, ['Content-Type' => 'application/json']);
            } else {
                return Response::forge(json_encode(['success' => false, 'message' => 'プレイの作成に失敗しました']), 400, ['Content-Type' => 'application/json']);
            }
        }

        return Response::forge(View::forge('plays/create'));
    }

    public function action_edit($id = null)
    {
        // 指定されたIDのプレイを取得 (見つからなければ 404)
        $play = Model_Play::find($id, ['related' => ['cards']]);
    
        if (!$play) {
            Session::set_flash('error', '指定されたプレイが見つかりません。');
            Response::redirect('plays/index');
        }
    
        // 編集フォームのPOST処理
        if (Input::method() == 'POST') {
            // バリデーション
            $val = Validation::forge();
            $val->add('position', 'ポジション')->add_rule('required');
            $val->add('sb', 'SB')->add_rule('valid_string', 'numeric');
            $val->add('bb', 'BB')->add_rule('valid_string', 'numeric');
            $val->add('ante', 'アンティ')->add_rule('valid_string', 'numeric');
    
            if ($val->run()) {
                // フォームからの入力値を更新
                $play->position = Input::post('position');
                $play->sb = Input::post('sb');
                $play->bb = Input::post('bb');
                $play->ante = Input::post('ante');
                $play->memo = Input::post('memo');
    
                // クッキーにデフォルトポジションを保存 
                Cookie::set('default_position', $play->position, 86400);
    
                // セッションに最近編集したプレイのIDを保存
                Session::set('last_edit_play_id', $play->id);
    
                // カード情報を更新
                foreach ($play->cards as $card) {
                    if ($card->type === 'hand') {
                        $index = ($card->id % 2 == 0) ? 1 : 2; // 1枚目 or 2枚目
                        $card->card_rank = Input::post("hand{$index}_rank");
                        $card->suit = Input::post("hand{$index}_suit");
                    } elseif (in_array($card->type, ['flop', 'turn', 'river'])) {
                        $card->card_rank = Input::post("{$card->type}_rank");
                        $card->suit = Input::post("{$card->type}_suit");
                    }
                    $card->save();
                }
    
                if ($play->save()) {
                    Session::set_flash('success', 'プレイ情報を更新しました！');
                    Response::redirect('plays/index');
                } else {
                    Session::set_flash('error', 'プレイ情報の更新に失敗しました。');
                }
            } else {
                Session::set_flash('error', '入力に誤りがあります。');
            }
        }
    
        return Response::forge(View::forge('plays/edit', ['play' => $play]));
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

        $play = Model_Play::find($data['id'], ['related' => ['cards']]);
        if (!$play) {
            return $this->json_response(false, 'プレイが見つかりません', 404);
        }

        // 更新処理
        $play->position = $data['position'];
        $play->sb = $data['sb'];
        $play->bb = $data['bb'];
        $play->ante = $data['ante'];
        $play->memo = $data['memo'];
        $play->updated_at = (new \DateTime())->format('Y-m-d H:i:s');

        foreach ($play->cards as $card) {
            foreach ($data['cards'] as $c) {
                if ($card->id == $c['id']) {
                    $card->card_rank = $c['card_rank'];
                    $card->suit = $c['suit'];
                    $card->save();
                }
            }
        }

        if ($play->save()) {
            return Response::forge(json_encode(['success' => true, 'message' => 'プレイ情報を更新しました']), 200, ['Content-Type' => 'application/json']);
        } else {
            return Response::forge(json_encode(['success' => false, 'message' => 'プレイ情報の更新に失敗しました']), 400, ['Content-Type' => 'application/json']);
        }
    }

    public function action_delete($id = null)
    {
        if (Input::method() != 'POST') {
            return $this->json_response(false, '無効なリクエスト', 400);
        }

        $play = Model_Play::find($id);
        if (!$play) {
            return $this->json_response(false, '指定されたプレイが見つかりません', 404);
        }

        // 削除処理
        $play->deleted_at = (new \DateTime())->format('Y-m-d H:i:s');
        if ($play->save()) {
            return $this->json_response(true, 'プレイを削除しました');
        } else {
            return $this->json_response(false, 'プレイの削除に失敗しました', 400);
        }
    }

    public function action_api()
    {
        $plays = Model_Play::find('all', ['related' => ['cards']]);
    
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
    }
    
    private function json_response($success, $message, $status = 200)
    {
        return Response::forge(json_encode(['success' => $success, 'message' => $message]), $status, ['Content-Type' => 'application/json']);
    }
}
