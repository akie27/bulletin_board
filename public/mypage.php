<?php
session_start();
require_once '../classes/UserLogic.php';
require_once '../common/functions.php';

//ログインしているか判定し、していなかったら新規登録画面へ返す
$res = UserLogic::checkLogin();

if(!$res){
    $_SESSION['login_err'] = 'ユーザを登録してログインしてください！';
    header('Location: signup_form.php');
    return;
}

$login_user = $_SESSION['login_user'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>
</head>
<body>        
    <h2>マイページ</h2>     
    <p>ログインユーザ:<?php echo h($login_user['name']); ?></p>       
    <form action="logout.php" method="POST">
        <input type="submit" name="logout" value="ログアウト">
    </form>
</body>
</html>