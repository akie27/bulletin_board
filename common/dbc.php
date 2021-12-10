<?php
// DB接続 PDOの接続オプション取得
require 'env.php';

function dbConnect(){           
    $host = DB_HOST;
    $db = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASS;

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    try{
        $pdo = new PDO($dsn, $user, $pass, $opt);        
        return $pdo;        
    }catch(PDOException $e){
        echo '接続失敗' . $e->getMessage();
        exit();        
    }    
}

?>