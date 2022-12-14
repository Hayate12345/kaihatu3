<?php

session_start();

// 外部ファイルのインポート
require '../../../../class/SystemLogic.php';
require '../../../../function/functions.php';

// インスタンス化
$val_inst = new DataValidationLogics();
$arr_prm_inst = new ArrayParamsLogics();
$db_inst = new DatabaseLogics();
$student_inst = new StaffLogics();

// ログインチェック
$userId = $student_inst->get_staff_id();

$err_array = [];

// ログインチェックの返り値がfalseの場合ログインページにリダイレクト　（不正なリクエストとみなす）
if (!$userId) {
    $url = '../../Incorrect_request.php';
    header('Location:' . $url);
}

// postリクエストがない場合リダイレクト
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $type = filter_input(INPUT_POST, 'type');
    $format = filter_input(INPUT_POST, 'format');
    $filed = filter_input(INPUT_POST, 'field');
    $time = filter_input(INPUT_POST, 'time');
    $company = filter_input(INPUT_POST, 'company');
    $overview = filter_input(INPUT_POST, 'overview');
    $attachment = filter_input(INPUT_POST, 'attachment');

    if (!$val_inst->staff_post_val($type, $format, $filed, $time, $company, $overview, $attachment)) {
        $err_array[] = $val_inst->getErrorMsg();
    }
} else {
    $url = '../../../Incorrect_request.php';
    header('Location:' . $url);
}

?>




<!-- <!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../public/img/favicon.ico">
    <link rel="stylesheet" href="../../../public/css/intern/view.css">
    <title>「Real intentioN」 / インターン体験記</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #e6e6e6;
        }



        .square_box {
            position: relative;
            max-width: 100px;
            background: #ffb6c1;
        }

        .square_box::before {
            content: "";
            display: block;
            padding-bottom: 100%;
        }

        .square_box p {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .side-area {
            position: sticky;
            top: 60px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-4">
            <div class="container">
                <img style="width: 45px; height:45px; margin-right:10px;" src="../../../public/img/logo.png" alt="">
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

    <main role="main" class="container mt-5" style="padding: 0px">
        <div class="row">

            <div class="col-md-8">
                <div class="bg-light py-3">
                    <div class="mx-auto col-lg-8">
                        <div class="err-msg">
                            <?php if (count($err_array) > 0) : ?>
                                <?php foreach ($err_array as $err_msg) : ?>
                                    <p style="color: red;"><?php h($err_msg); ?></p>
                                <?php endforeach; ?>
                                <div class="backBtn">
                                    <a class="btn btn-primary px-5" href="./post_form.php">戻る</a>
                                </div>
                            <?php endif; ?>
                        </div>


                        <?php if (count($err_array) === 0) : ?>
                            <form class="mt-5" action="./post.php" method="post">
                                <div class="mb-2">
                                    <label class="form-label" for="name">投稿情報の種類</label>
                                    <input class="form-control" 　type="text" name="type" value="<?php h($type) ?>">
                                </div>



                                <div class="mb-2">
                                    <label class="form-label" for="name">イベント形式</label>
                                    <input class="form-control" 　type="text" name="format" value="<?php h($format) ?>">
                                </div>



                                <div class="mb-2">
                                    <label class="form-label" for="name">イベント分野</label>
                                    <input class="form-control" 　type="text" name="field" value="<?php h($filed) ?>">
                                </div>

                                <div class="mb-2">
                                    <label class="form-label" for="name">イベント日時</label>
                                    <input class="form-control" type="date" name="time" value="<?php h($time) ?>">
                                </div>


                                <div class="mb-2">
                                    <label class="form-label" for="name">企業名</label>
                                    <input class="form-control" type="text" name="company" value="<?php h($company) ?>">
                                </div>



                                <div class="mb-2">
                                    <label for="exampleFormControlTextarea1" class="form-label">イベント内容</label>
                                    <textarea class="form-control" name="overview" id="exampleFormControlTextarea1" rows="3"><?php h($overview) ?></textarea>
                                </div>


                                <div class="mb-2">
                                    <label for="exampleFormControlTextarea1" class="form-label">添付資料</label>
                                    <input class="form-control" type="text" name="attachment" value="<?php h($attachment) ?>">
                                </div>
                                <a href="./post_form.php" class="btn btn-primary px-5">書き直す</a>
                                <button type="submit" class="btn btn-primary px-5">投稿する</button>
                            </form>
                        <?php endif; ?>
                    </div>

                </div>
            </div>


            <div class="col-md-4 bg-warning sticky-top vh-100">
                <div>
                    <h1>送信</h1>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html> -->






<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../public/img/favicon.ico">
    <link rel="stylesheet" href="../../../public/css/intern/view.css">
    <title>「Real intentioN」 / インターン体験記</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #e6e6e6;
        }

        header {
            background-color: #D6E4E5;
        }

        footer {
            background-color: #D6E4E5;
        }

        .nav-link {
            font-weight: bold;
        }

        .nav-link:hover {
            text-decoration: underline;
        }

        .login-btn {
            background-color: #EB6440;
            color: white;
        }

        .login-btn:hover {
            color: white;
            background-color: #eb6540c1;
        }

        .box {
            background-color: white;
            border-radius: 5px;
        }

        .side-bar {
            padding-top: 10px;
            padding-bottom: 10px;
        }
    </style>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light py-4">
            <div class="container">
                <a class="navbar-brand" href="../../../index.html">
                    <img src="../../../public/img/logo.png" alt="" width="30" height="24" class="d-inline-block
                                align-text-top" style="object-fit: cover;">
                    Real intentioN
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="./src/StaffView/login/login_form.php">Real intentioNとは</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="./src/StaffView/login/login_form.php">お問い合わせはこちら</a>
                        </li>
                    </ul>
                </div>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../../StaffView/login/login_form.php">職員の方はこちら</a>
                        </li>

                        <li class="nav-item">
                            <a class="login-btn btn" href="./login_form.php">ログインはこちら</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>



    <main role="main" class="container mt-5" style="padding: 0px">
        <div class="row">

            <div class="col-md-8">
                <div class="bg-light py-3">
                    <div class="mx-auto col-lg-8">
                        <?php if (count($err_array) > 0) : ?>
                            <?php foreach ($err_array as $err_msg) : ?>
                                <p style="color: red;"><?php h($err_msg); ?></p>
                            <?php endforeach; ?>
                            <div class="backBtn">
                                <a class="btn btn-primary px-4" href="./post_form.php">戻る</a>
                            </div>
                        <?php endif; ?>


                        <?php if (count($err_array) === 0) : ?>
                            <form class="mt-5" action="./post.php" method="post">
                                <div class="mb-4">
                                    <label class="form-label" for="name">投稿情報の種類</label>
                                    <input class="form-control" 　type="text" name="type" value="<?php h($type) ?>" readonly>
                                </div>



                                <div class="mb-4">
                                    <label class="form-label" for="name">イベント形式</label>
                                    <input class="form-control" 　type="text" name="format" value="<?php h($format) ?>" readonly>
                                </div>



                                <div class="mb-4">
                                    <label class="form-label" for="name">イベント分野</label>
                                    <input class="form-control" 　type="text" name="field" value="<?php h($filed) ?>" readonly>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="name">イベント日時</label>
                                    <input class="form-control" readonly type="date" name="time" value="<?php h($time) ?>">
                                </div>


                                <div class="mb-4">
                                    <label class="form-label" for="name">企業名</label>
                                    <input class="form-control" readonly type="text" name="company" value="<?php h($company) ?>">
                                </div>



                                <div class="mb-4">
                                    <label for="exampleFormControlTextarea1" class="form-label">イベント内容</label>
                                    <textarea class="form-control" name="overview" id="exampleFormControlTextarea1" readonly rows="8"><?php h($overview) ?></textarea>
                                </div>


                                <div class="mb-4">
                                    <label for="exampleFormControlTextarea1" class="form-label">添付資料</label>
                                    <input class="form-control" readonly type="text" name="attachment" value="<?php h($attachment) ?>">
                                </div>
                                <a href="./post_form.php" class="btn btn-primary px-4">書き直す</a>
                                <button type="submit" class="login-btn btn px-4">投稿する</button>
                            </form>
                        <?php endif; ?>
                    </div>

                </div>
            </div>


            <div class="side-bar col-md-4 bg-light sticky-top h-100">
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a style="background-color: #EB6440;" href="./view.php" class="nav-link active" aria-current="page">
                                ホーム
                            </a>
                        </li>
                        <li>
                            <a href="./post/post_form.php" class="nav-link link-dark">
                                情報新規投稿
                            </a>
                        </li>

                        <li>
                            <a href="../staff_information/staff_information.php" class="nav-link link-dark">
                                ログアウト
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


        </div><!-- Div row 終了-->
    </main>
    <!-- </div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>