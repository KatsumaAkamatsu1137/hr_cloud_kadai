<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プレイ履歴</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-min.js"></script>
</head>
<body>

<h3>プレイ履歴</h3>
<table>
    <tr>
        <th>ID</th>
        <th>ポジション</th>
        <th>スモールブラインド</th>
        <th>ビッグブラインド</th>
        <th>ハンド</th>
        <th>ボード</th>
        <th>メモ</th>
        <th>編集</th>
    </tr>
    <tbody data-bind="foreach: plays">
        <tr>
            <td data-bind="text: id"></td>
            <td><input type="text" data-bind="value: position"></td>
            <td><input type="number" data-bind="value: sb"></td>
            <td><input type="number" data-bind="value: bb"></td>

            <!-- ハンド (手札) -->
            <td>
                <select data-bind="value: hand1.rank">
                    <option value="A">A</option>
                    <option value="K">K</option>
                    <option value="Q">Q</option>
                    <option value="J">J</option>
                    <option value="10">10</option>
                    <option value="9">9</option>
                    <option value="8">8</option>
                    <option value="7">7</option>
                    <option value="6">6</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                </select>
                <select data-bind="value: hand1.suit">
                    <option value="spade">♠</option>
                    <option value="heart">♥</option>
                    <option value="diamond">♦</option>
                    <option value="club">♣</option>
                </select>

                <select data-bind="value: hand2.rank">
                    <option value="A">A</option>
                    <option value="K">K</option>
                    <option value="Q">Q</option>
                    <option value="J">J</option>
                    <option value="10">10</option>
                    <option value="9">9</option>
                    <option value="8">8</option>
                    <option value="7">7</option>
                    <option value="6">6</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                </select>
                <select data-bind="value: hand2.suit">
                    <option value="spade">♠</option>
                    <option value="heart">♥</option>
                    <option value="diamond">♦</option>
                    <option value="club">♣</option>
                </select>
            </td>

            <!-- ボード (フロップ, ターン, リバー) -->
            <td>
                フロップ:
                <input type="text" data-bind="value: flop" placeholder="例: 10♠ J♥ K♦"><br>
                ターン:
                <input type="text" data-bind="value: turn" placeholder="例: Q♣"><br>
                リバー:
                <input type="text" data-bind="value: river" placeholder="例: A♥">
            </td>

            <td><input type="text" data-bind="value: memo"></td>
            <td><button data-bind="click: $parent.savePlay">保存</button></td>
        </tr>
    </tbody>
</table>

<script>
function Play(id, position, sb, bb, hand1, hand2, flop, turn, river, memo) {
    this.id = ko.observable(id);
    this.position = ko.observable(position);
    this.sb = ko.observable(sb);
    this.bb = ko.observable(bb);
    this.memo = ko.observable(memo);

    // ハンド (手札)
    this.hand1 = {
        rank: ko.observable(hand1.rank),
        suit: ko.observable(hand1.suit)
    };
    this.hand2 = {
        rank: ko.observable(hand2.rank),
        suit: ko.observable(hand2.suit)
    };

    // ボード (フロップ・ターン・リバー)
    this.flop = ko.observable(flop);
    this.turn = ko.observable(turn);
    this.river = ko.observable(river);
}

function ViewModel() {
    var self = this;
    self.plays = ko.observableArray([
        new Play(1, "UTG", 50, 100, {rank: "A", suit: "spade"}, {rank: "K", suit: "heart"}, "10♠ J♥ K♦", "Q♣", "A♥", "試しのプレイ"),
        new Play(2, "BTN", 50, 100, {rank: "9", suit: "club"}, {rank: "9", suit: "diamond"}, "7♣ 8♠ 9♦", "10♠", "J♠", "BTNからのオールイン")
    ]);

    self.savePlay = function(play) {
        alert("プレイID " + play.id() + " のデータを保存！");
        // データベースが繋がったら実装
    };
}

ko.applyBindings(new ViewModel());
</script>

</body>
</html>