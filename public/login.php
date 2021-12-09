<?php
session_start();

require_once '../classes/UserLogic.php';

// エラーメッセージ
$err = [];

// バリデーション
if(!$login_id = filter_input(INPUT_POST, 'login_id')){
    $err['login_id'] = 'ログインIDを記入してください。';
}
if(!$pass = filter_input(INPUT_POST, 'pass')){
    $err['pass'] = 'パスワードを記入してください。';
}


if(count($err) > 0){
    // エラーがあった場合は戻す
    $_SESSION = $err;
    header('Location: login_form.php');
    return;
}
// ログイン成功時の処理
$res = UserLogic::login($login_id,$pass);

// ログイン失敗時の処理
if(!$res){    
    header('Location: login_form.php');
    return;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン完了</title>
</head>
<body>
    <h2>ログイン完了</h2>
    <p>ログインしました！</p>    
    <a href="./mypage.php">マイページへ</a>    
</body>
</html>