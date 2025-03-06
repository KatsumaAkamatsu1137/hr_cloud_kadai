<?php
$rank_options = array('2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A');
$suit_options = array(
    '♠' => 'spade',
    '♥' => 'heart',
    '♦' => 'diamond',
    '♣' => 'club'
);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規プレイ追加</title>
</head>
<body>
    <h1>新規プレイ追加</h1>
    <form action="<?= Uri::create('plays/create') ?>" method="post">
    <label>ポジション:
        <select name="position">
            <option value="UTG">UTG</option>
            <option value="MP">MP</option>
            <option value="CO">CO</option>
            <option value="BTN">BTN</option>
            <option value="SB">SB</option>
            <option value="BB">BB</option>
        </select>
    </label>
    <br>
    <label>SB: <input type="number" name="sb" value="10"></label>
    <label>BB: <input type="number" name="bb" value="20"></label>
    <label>アンティ: <input type="number" name="ante" value="20"></label>
    <label>メモ: <input type="text" name="memo"></label>
    <br><br>

    <h3>ハンド選択</h3>
    <?php for ($i = 1; $i <= 2; $i++): ?>
        <label><?= $i ?>枚目:
            <select name="hand<?= $i ?>_rank">
                <?php foreach ($rank_options as $rank): ?>
                    <option value="<?= $rank ?>"><?= $rank ?></option>
                <?php endforeach; ?>
            </select>
            <select name="hand<?= $i ?>_suit">
                <?php foreach ($suit_options as $suit): ?>
                    <option value="<?= $suit ?>"><?= $suit ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <br>
    <?php endfor; ?>

    <h3>ボード選択</h3>
    <?php $board_types = ['flop1', 'flop2', 'flop3', 'turn', 'river']; ?>
    <?php foreach ($board_types as $board): ?>
        <label><?= ucfirst($board) ?>:
            <select name="<?= $board ?>_rank">
                <?php foreach ($rank_options as $rank): ?>
                    <option value="<?= $rank ?>"><?= $rank ?></option>
                <?php endforeach; ?>
            </select>
            <select name="<?= $board ?>_suit">
                <?php foreach ($suit_options as $suit): ?>
                    <option value="<?= $suit ?>"><?= $suit ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <br>
    <?php endforeach; ?>

    <input type="submit" value="プレイを作成">
</form>
    <a href="/plays/index">戻る</a>
</body>
</html>