<?php
ini_set('display_errors', true); 

session_start();

require_once '../common/functions.php';
require_once '../classes/UserLogic.php';

$res = UserLogic::checkLgoin();
if($res){
    header('Location: mypage.php');
    return;
}

$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;
unset($_SESSION['login_err']);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザ登録画面</title>

    <link rel="stylesheet" href="../common/style.css">
</head>
<body>
    <?php require('../common/header.php'); ?>

    <p class="title regist_title">会員登録</p>

    <?php if(isset($login_err)): ?>
        <p><?php echo $login_err; ?></p>
    <?php endif; ?>

    <form action="register.php" method="POST" class="form_items register_form">

        <div class="resister_items">
            <label for="login_id">ログインID</label>
            <input type="text" name="login_id" placeholder="ログインID" class="register_input">
        </div>
        <div class="resister_items">
            <label for="user_name">会員名</label>
            <input type="text" name="user_name" placeholder="会員名" class="register_input">
        </div>
        <div class="resister_items">
            <label for="pass">パスワード</label>
            <input type="password" name="pass" placeholder="パスワード" class="register_input">
            <p class="warning">※パスワードは半角英数字８文字以上100文字以下にしてください。</p>
        </div>
        <div class="resister_items">
            <label for="pass_conf">パスワード(確認)</label>
            <input type="password" name="pass_conf" placeholder="パスワード(確認)" class="register_input">
            <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
        </div>

        <div class="button_flex">
            <input type="button" value="ログインする" onclick="location.href='login_form.php'" class="btn register_btn">
            <input type="submit" value="新規登録" class="btn register_btn">            
        </div>
    </form>

    <?php require('../common/footer.php'); ?>
</body>
</html>
