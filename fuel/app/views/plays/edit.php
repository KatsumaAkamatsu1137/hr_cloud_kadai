<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プレイ編集</title>
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