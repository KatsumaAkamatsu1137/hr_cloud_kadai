<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>エラー</title>
</head>
<body>
    <h1>エラーが発生しました</h1>
    <p><?= htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8') ?></p>
    <a href="/plays/index">戻る</a>
</body>
</html>