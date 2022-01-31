<?php
namespace postlogic;
require_once '../common/dbc.php';

class PostLogic{

    /**
     * 投稿を追加する
     * @param array $postData
     * @return bool $res
     */
    public static function createPost($postData){
        $res = false;

        $sql = 'INSERT INTO posts (created_by, msg, created_at, parent_post) VALUES (?,?,?,?)';

        //投稿データを配列に入れる
        $arr = [];
        echo json_encode($postData);
        $arr[] = $postData['created_by'];
        $arr[] = $postData['msg'];
        $arr[] = $postData['created_at'];
        $arr[] = $postData['parent_post'];
        
        try {
            $stm = dbConnect()->prepare($sql);
            $res = $stm->execute($arr);
            return $res;
        } catch(\Exception $e) {
            error_log($e, 3, '../public/php.log'); //ログを出力
            return $res;
        }
    }

    /**
     * 投稿データを取得
     * @param void   
     * @return array|bool $user|false
     */
    public static function getPost(){
        // SQLの準備
        // SQLの実行
        // SQLの結果を返す
        $sql = 'SELECT * FROM posts';
        
        try {
            $stm = dbConnect()->prepare($sql);
            $stm->execute();
            // SQLの結果を返す
            $posts = $stm->fetchAll();

            // 親に返信データを入れる
            $display_posts = [];
            foreach ($posts as $post){
                if ($post['parent_post']){
                    continue;
                }

                $post['reply'] = [];

                foreach ($posts as $post2){
                    if ($post2['parent_post'] == $post['id']){
                        $post['reply'][] = $post2;
                    }
                }

                $display_posts[] = $post;
            }

            return $display_posts;
        } catch(\Exception $e) {
            return false;
        }
    }

    /**
     * 投稿を削除する
     * @param int $id
     * @return bool $res
     */
    public static function deletePost($id){
        $res = false;
        
        $sql = 'DELETE FROM posts WHERE id=:id';             
        try {
            $stm = dbConnect()->prepare($sql);
            $res = $stm->execute(array($id));
            $stm->bindValue(':id', $id);
            return $res;            
        } catch(\Exception $e) {
            error_log($e, 3, '../public/php.log'); //ログを出力
            return $res;
        }
    }

}
?>