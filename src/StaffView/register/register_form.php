<?php

// 職員として認証済がチェックする
session_start();

// セッション情報がない場合リダイレクト　職員情報がない場合ダイレクト
if (!$_SESSION['auth_success']) {
    header('Location: staff_auth_form.php');
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #E6E6E6;
        }

        form h1 {
            margin-top: 100px;
            margin-bottom: 50px;
        }
    </style>
    <title>Document</title>
</head>



<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-4">
            <div class="container">
                <a class="navbar-brand" href="#">Real intentioN</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">職員の方はこちら</a>
                        </li>
                        <button class="btn btn-primary ms-3">ログインはこちら</button>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="main d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-6">
                    <form class="mt-5" action="./register.php" method="post">
                        <h1 class="text-center">職員情報登録</h1>

                        <div class="mb-2">
                            <label class="form-label" for="name">ニックネーム</label>
                            <input class="form-control" type="text" name="name" id="name">
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="name">メールアドレス</label>
                            <input class="form-control" type="text" name="email" id="name">
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="name">パスワード</label>
                            <input class="form-control" type="password" name="password" id="name">
                        </div>

                        <button type="submit" style="margin-top: 15px;" class="btn btn-primary px-5">登録する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>