<?php
session_start();

require_once '../classes/UserLogic.php';
require_once '../common/functions.php';

// エラーメッセージ
$err = [];

$token = filter_input(INPUT_POST, 'csrf_token');
//トークンがない、もしくは一致しない場合、処理を中止
if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']){    
    exit('不正なリクエスト');
}

unset($_SESSION['csrf_token']);

// バリデーション
if(!$login_id = filter_input(INPUT_POST, 'login_id')){
    $err[] = 'ログインIDを記入してください。';
}
if(!$user_name = filter_input(INPUT_POST, 'user_name')){
    $err[] = '会員名を記入してください。';
}
$pass = filter_input(INPUT_POST, 'pass');
// 正規表現
if(!preg_match("/\A[a-z\d]{8,100}+\z/i", $pass)){
    $err[] = 'パスワードは半角英数字８文字以上100文字以下にしてください。';
}
$pass_conf = filter_input(INPUT_POST, 'pass_conf');
if($pass !== $pass_conf){
    $err[] = '確認用パスワードと異なっています。';
}

if(count($err) === 0){
    // ユーザを登録する処理
    $hasCreated = UserLogic::createUser($_POST);

    if(!$hasCreated){
        $err[] = '登録に失敗しました';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザ登録完了画面</title>

    <link rel="stylesheet" href="../common/style.css">
</head>
<body>
    <?php if (count($err) > 0): ?>
        <?php foreach($err as $e): ?>
            <p><?php echo $e; ?></p>
        <?php endforeach; ?>
        <?php else: ?>            
            <p>ユーザ登録が完了しました。</p>
    <?php endif; ?>
    <a href="./login_form.php">ログイン画面へ</a>
</body>
</html>