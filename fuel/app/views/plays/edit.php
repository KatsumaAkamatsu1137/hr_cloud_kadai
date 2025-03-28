<?php
$rank_options = array('2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A');
$suit_options = array(
    'spade' => '♠',
    'heart' => '♥',
    'diamond' => '♦',
    'club' => '♣'
);
?>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest.js"></script>
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
