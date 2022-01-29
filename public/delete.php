<?php
require_once '../classes/PostLogic.php';

$id = $postData['id'];
if( !empty($postData['id']) ) {

// 投稿を削除する処理
$res = postlogic\PostLogic::deletePost($id);
header('Location:mypage.php');

}

?>