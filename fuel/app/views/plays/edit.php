<<<<<<< HEAD
<?php
$rank_options = array('2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A');
$suit_options = array(
    'spade' => '♠',
    'heart' => '♥',
    'diamond' => '♦',
    'club' => '♣'
);
?>
=======
>>>>>>> 9b6128ab66efe27283097e95392c3e1869bf60ad
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プレイ編集</title>
<<<<<<< HEAD
    <script src="https://cdn.jsdelivr.net/npm/knockout@3.5.1/build/knockout.js"></script>
    <script>
        function PlayViewModel(play) {
            var self = this;
            self.id = ko.observable(play.id);
            self.position = ko.observable(play.position);
            self.sb = ko.observable(play.sb);
            self.bb = ko.observable(play.bb);
            self.ante = ko.observable(play.ante);
            self.memo = ko.observable(play.memo);

            self.handCards = ko.observableArray(play.cards.filter(c => c.type === 'hand'));
            self.boardCards = ko.observableArray(play.cards.filter(c => c.type !== 'hand'));

            self.rankOptions = <?= json_encode($rank_options); ?>;
            self.suitOptions = <?= json_encode($suit_options); ?>;

            // プレイ情報更新処理
            self.updatePlay = function () {
                let data = {
                    id: self.id(),
                    position: self.position(),
                    sb: self.sb(),
                    bb: self.bb(),
                    ante: self.ante(),
                    memo: self.memo(),
                    cards: [...self.handCards(), ...self.boardCards()]
                };

                fetch('/plays/update', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                }).then(response => response.json())
                  .then(result => {
                      alert(result.message);
                      if (result.success) {
                          window.location.href = "/plays/index";
                      }
                  }).catch(error => console.error("Error:", error));
            };
        }

        document.addEventListener("DOMContentLoaded", function () {
            let playData = <?= json_encode($play); ?>;
            ko.applyBindings(new PlayViewModel(playData));
        });
    </script>
</head>
<body>
<h2>プレイ編集</h2>

<form data-bind="submit: updatePlay">
    <h3>プレイ情報</h3>
    <label>ポジション:
        <select data-bind="value: position">
            <?php foreach (['UTG', 'MP', 'CO', 'BTN', 'SB', 'BB'] as $pos): ?>
                <option value="<?= $pos ?>"><?= $pos ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <br>
    <label>SB: <input type="number" data-bind="value: sb"></label>
    <label>BB: <input type="number" data-bind="value: bb"></label>
    <label>アンティ: <input type="number" data-bind="value: ante"></label>
    <label>メモ: <input type="text" data-bind="value: memo"></label>
    <br><br>

    <h3>ハンド編集</h3>
    <div data-bind="foreach: handCards">
        <label>
            <select data-bind="value: card_rank, options: $root.rankOptions"></select>
            <select data-bind="value: suit, options: Object.keys($root.suitOptions), optionsText: function(item) { return $root.suitOptions[item]; }"></select>
        </label>
        <br>
    </div>

    <h3>ボード編集</h3>
    <div data-bind="foreach: boardCards">
        <label>
            <span data-bind="text: type"></span>:
            <select data-bind="value: card_rank, options: $root.rankOptions"></select>
            <select data-bind="value: suit, options: Object.keys($root.suitOptions), optionsText: function(item) { return $root.suitOptions[item]; }"></select>
        </label>
        <br>
    </div>

    <button type="submit">更新する</button>
</form>

<a href="/plays/index">戻る</a>

</body>
</html>
=======
</head>
<body>
    <h1>プレイ編集</h1>
    <form action="/plays/update/<?= $play['id'] ?>" method="post">
        <label>ポジション: <input type="text" name="position" value="<?= $play['position'] ?>"></label><br>
        <label>SB: <input type="number" name="sb" value="<?= $play['sb'] ?>"></label><br>
        <label>BB: <input type="number" name="bb" value="<?= $play['bb'] ?>"></label><br>
        <label>メモ: <input type="text" name="memo" value="<?= $play['memo'] ?>"></label><br>

        <h3>ハンド</h3>
        <input type="text" name="hand" value="<?= $play['hand'] ?>"><br>

        <h3>ボード</h3>
        <label>フロップ: <input type="text" name="flop" value="<?= $play['flop'] ?>"></label><br>
        <label>ターン: <input type="text" name="turn" value="<?= $play['turn'] ?>"></label><br>
        <label>リバー: <input type="text" name="river" value="<?= $play['river'] ?>"></label><br>

        <input type="submit" value="更新">
    </form>
    <a href="/plays/index">戻る</a>
</body>
</html>
>>>>>>> 9b6128ab66efe27283097e95392c3e1869bf60ad
