<?php

// データベースロジックファイルの読み込み
require '/Applications/MAMP/htdocs/Deliverables3/class/DatabaseLogic.php';

// ユーザロジッククラス
class UserLogic
{


    // メールアドレスバリデーションチェック
    public static function emailValidation($email)
    {
        if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@st.kobedenshi.ac.jp/", $email)) {
            return true;
        } else {
            return false;
        }
    }

    // メールアドレスがDBに存在するか判定する
    public static function emailCheck($email)
    {
        // データベースクラス呼び出し
        $obj = new DatabaseLogic();

        $sql = 'SELECT * FROM user_master WHERE email = ?';
        $result = $obj::databaseSelect($sql, $email);

        if ($result) {
            return false;
        }

        return true;
    }

    public static function pushToken($email)
    {
        // 登録完了メールの送信
        $send = $email;
        mb_language('Japanese');
        mb_internal_encoding('UTF-8');
        $to = $send;
        $subject = "メールアドレス認証トークン";
        $token = rand();
        $message = '認証トークンは' . '"' . $token . '"' . 'です。';
        $headers = "From: hayate.syukatu1@gmail.com";
        mb_send_mail($to, $subject, $message, $headers);
        return $token;
    }

    public static function createUser($post)
    {
        // データベースクラス呼び出し
        $obj = new DatabaseLogic();

        $sql = 'INSERT INTO `user_master`(`name`, `email`, `password`, `department`, `school_year`, `number`) VALUES (?, ?, ?, ?, ?, ?)';

        $arr = [];
        $arr[] = $post['name'];
        $arr[] = $post['email'];
        // パスワードはハッシュ化する
        $arr[] = password_hash($post['password'], PASSWORD_DEFAULT);
        $arr[] = $post['department'];
        $arr[] = $post['school_year'];
        $arr[] = $post['number'];

        $result = $obj::databaseInsert($sql, $arr);

        if (!$result) {
            return false;
        }

        return true;
    }
}