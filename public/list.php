<?php
require_once '../classes/PostLogic.php';

date_default_timezone_set('Asia/Tokyo');
// var_dump($_POST); 
$created_at = date("Y-m-d H:i:s");
// echo $created_at;

$parent_post = null;
if($_POST["parent_post"] !== "")
{
    $parent_post = $_POST["parent_post"];
}


$postData = array(
    "created_by" => $_POST["created_by"],
    "msg" => $_POST["post_msg"],
    "created_at" => $created_at,
    "parent_post" => $parent_post
);

// 投稿を追加する処理
$res = postlogic\PostLogic::createPost($postData);
header('Location:mypage.php');

echo $parent_post;

?>