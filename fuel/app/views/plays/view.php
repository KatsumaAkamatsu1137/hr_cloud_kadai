<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プレイ詳細</title>
</head>
<body>
    <h1>プレイ詳細</h1>
    <p>ID: <?= $play['id'] ?></p>
    <p>ポジション: <?= $play['position'] ?></p>
    <p>SB: <?= $play['sb'] ?></p>
    <p>BB: <?= $play['bb'] ?></p>
    <p>メモ: <?= $play['memo'] ?></p>
    <a href="/plays/index">戻る</a>
</body>
</html>