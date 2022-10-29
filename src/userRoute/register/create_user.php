<?php

session_start();

// クラスファイルインポート
require __DIR__ . '../../../../class/UserLogic.php';

// functionファイルインポート
require __DIR__ . '../../../../function/functions.php';

// クラスのインポート
$obj = new UserLogic();

// err配列準備
$err = [];

// フォームリクエストを受け取る
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // バリデーション
    $password = filter_input(INPUT_POST, 'password');

    if (!preg_match("/\A[a-z\d]{8,100}+\z/i", $password)) {
        $err[] = 'パスワードは英数字8文字以上で作成してください。';
    }

    // エラーが一つもない場合ユーザ登録する
    if (count($err) === 0) {
        // ユーザを登録する処理
        $hasCreated = $obj::createUser($_POST);

        if (!$hasCreated) {
            $err[] = '登録できませんでした';
        }
    }
} else {
    $err[] = '不正なリクエストです。';

    // 3秒後に入力フォームへリダイレクト
    header('refresh:3;url=./tentative_register_form.php');
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../public/img/favicon.ico">
    <link rel="stylesheet" href="../../../public/css/register/auth.css">
    <title>「Real intentioN」 / 新規会員登録</title>
</head>

<body>
    <?php include '/Applications/MAMP/htdocs/Deliverables3/public/template/header.html'; ?>

    <div class="err">
        <?php if (count($err) > 0) : ?>
            <?php foreach ($err as $e) : ?>
                <label><?php h($e); ?></label>
                <div class="backBtn">
                    <a href="./create_user_form.php">戻る</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (count($err) === 0) : ?>
            <label>ユーザ登録が完了しました。</label>
            <?php header('refresh:3;url=../login/login_form.php'); ?>
        <?php endif; ?>
    </div>
</body>

</html>