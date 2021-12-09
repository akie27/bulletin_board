<?php
    session_start();

    require_once '../classes/UserLogic.php';

    $res = UserLogic::checkLgoin();
    if($res){
        header('Location: mypage.php');
        return;
    }

    $err = $_SESSION;

    // セッションを消す
    $_SESSION = array();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>

    <link rel="stylesheet" href="../common/style.css">
</head>
<body>
    <?php require('../common/header.php'); ?>    
    
    <h1 class="title">会員制掲示板</h1>
        <?php if(isset($err['msg'])): ?>
            <p><?php echo $err['msg']; ?></p>
        <?php endif; ?>

    <form action="login.php" method="POST" class="form_items">

        <input type="text" name="login_id" placeholder="ログインID">
        <?php if(isset($err['login_id'])): ?>
            <p><?php echo $err['login_id']; ?></p>
        <?php endif; ?>
        <input type="password" name="password" placeholder="パスワード">
        <?php if(isset($err['pass'])): ?>
            <p><?php echo $err['pass']; ?></p>
        <?php endif; ?>

        <input type="submit" name="login" value="ログイン" class="btn">
        <a href="signup_form.php" class="btn">新規登録はこちら</a>
        
    </form>

    <?php require('../common/footer.php'); ?>
</body>
</html>
