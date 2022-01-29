<?php
session_start();
require_once '../classes/UserLogic.php';
require_once '../classes/PostLogic.php';
require_once '../common/functions.php';

//ログインしているか判定し、していなかったら新規登録画面へ返す
$res = userlogic\UserLogic::checkLogin();

if(!$res){
    $_SESSION['login_err'] = 'ユーザを登録してログインしてください！';
    header('Location: signup_form.php');
    return;
}

$login_user = $_SESSION['login_user'];

$postData = postlogic\PostLogic::getPost();


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>

    <link rel="stylesheet" href="../common/style.css">
</head>
<body>        
    <p>ログインユーザ:<?php echo h($login_user['name']); ?></p>    

    <p class="title">Web1ちゃんねる</p>
    <form action="list.php" method="POST" class="form_items list_form">
        <input type="hidden" name="created_by" value="<?php echo h($login_user['name']); ?>">
        <input type="hidden" name="parent_post" id="parent_post">
        <div class="list_items">
        <?php foreach($postData as $post): ?>
            <div class="list_titles">                
                <span><?php echo h($post['id']); ?></span>
                <span><?php echo h($post['created_by']); ?></span>
                <p><?php echo h($post['created_at']); ?></p>
            </div>
            <p class="list_msg"><?php echo h($post['msg']); ?></p>
            <div class="reply_items">
                <?php foreach($post['reply'] as $reply): ?>
                <div class="reply_titles">
                    <span class="reply_arrow">↪️</span>
                    <div class="flex_column">
                        <div class="list_titles">
                            <span><?php echo h($reply['created_by']); ?></span>
                            <p><?php echo h($reply['created_at']); ?></p>
                        </div>
                        <p><?php echo h($reply['msg']); ?></p>
                    </div>
                </div>  
                <?php endforeach; ?>          
            </div>
            <input type="text" name="reply_msg" placeholder="返信メッセージ" id="reply_msg_<?php echo h($post['id']); ?>" class="reply_msg">
            <input type="button" name="reply_btn" value="返信" onclick="reply(<?php echo h($post['id']); ?>)" class="btn list_btn reply_btn">
            <a href="http://" class="delete_url">この投稿を削除する</a>
        <?php endforeach; ?>
        </div>        

        <div class="post_msg">
            <input type="text" name="post_msg" id="post_msg" placeholder="投稿メッセージ" class="post_msg">
            <input type="submit" name="post_btn" value="投稿" id="btn" class="btn list_btn post_btn">
        </div>

    </form>

    <form action="logout.php" method="POST">
        <input type="submit" name="logout" value="ログアウト">
    </form>
    
    <?php require('../common/footer.php'); ?>
    
    <script>
        const reply = (id) => {
            document.querySelector("#parent_post").value = id
            document.querySelector("#post_msg").value = document.querySelector(`#reply_msg_${id}`).value
            document.querySelector("#btn").click()
        }
    </script>
</body>
</html>