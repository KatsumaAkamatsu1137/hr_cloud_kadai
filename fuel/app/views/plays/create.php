<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プレイ記録</title>
</head>
<body>
    <h1>プレイ記録フォーム</h1>
    <form action="/plays/store" method="post">
        <label>ポジション: <input type="text" name="position"></label><br>
        <label>SB: <input type="number" name="sb"></label><br>
        <label>BB: <input type="number" name="bb"></label><br>

        <h3>ハンド選択</h3>
        <label>1枚目:
            <select name="hand1_rank">
                <?php foreach (["A", "K", "Q", "J", "10", "9", "8", "7", "6", "5", "4", "3", "2"] as $rank): ?>
                    <option value="<?= $rank ?>"><?= $rank ?></option>
                <?php endforeach; ?>
            </select>
            <select name="hand1_suit">
                <?php foreach (["♠", "♥", "♦", "♣"] as $suit): ?>
                    <option value="<?= $suit ?>"><?= $suit ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <br>
        <label>2枚目:
            <select name="hand2_rank">
                <?php foreach (["A", "K", "Q", "J", "10", "9", "8", "7", "6", "5", "4", "3", "2"] as $rank): ?>
                    <option value="<?= $rank ?>"><?= $rank ?></option>
                <?php endforeach; ?>
            </select>
            <select name="hand2_suit">
                <?php foreach (["♠", "♥", "♦", "♣"] as $suit): ?>
                    <option value="<?= $suit ?>"><?= $suit ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <br>

        <h3>ボード選択</h3>
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <label><?= ($i <= 3) ? "フロップ" : (($i == 4) ? "ターン" : "リバー") ?>:
                <select name="board<?= $i ?>_rank">
                    <option value="">-</option>
                    <?php foreach (["A", "K", "Q", "J", "10", "9", "8", "7", "6", "5", "4", "3", "2"] as $rank): ?>
                        <option value="<?= $rank ?>"><?= $rank ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="board<?= $i ?>_suit">
                    <option value="">-</option>
                    <?php foreach (["♠", "♥", "♦", "♣"] as $suit): ?>
                        <option value="<?= $suit ?>"><?= $suit ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <br>
        <?php endfor; ?>

        <label>メモ: <input type="text" name="memo"></label><br>
        <input type="submit" value="記録する">
    </form>
    <a href="/plays/index">戻る</a>
</body>
</html>
