<?php
$css = "./style.css";
$title = "index";
$h1 = "";
$nav = "";
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('./common/header.php'); ?>
    
    <p>phpでCRUD練習。<br><a href='./top' class='btn'>会員登録あり掲示板</a></p>

    <?php include('./common/footer.php'); ?>
</body>
</html>
