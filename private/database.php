<?php
/* ----------------------------------------------------------------------
 * データベースの設定定義
 *
 * DB_HOST: データベースサーバのホスト名
 * DB_PORT: データベースサーバのポート
 * DB_NAME: データベース名
 * DB_USER: データベースにアクセスする際に利用するユーザ
 * DB_PASSWORD: データベースにアクセスする際に利用するユーザのパスワード
 * ---------------------------------------------------------------------- */
define('DB_HOST', 'db');
define('DB_PORT', 3306);
define('DB_NAME', 'bbs');
define('DB_USER', 'user');
define('DB_PASSWORD', 'password');

/**
 * データベースへの接続を行う
 *
 * @return mysqli|void
 */

$dsn = 'mysql:dbname=bbs;host=db';
$user = 'user';
$password = 'password';

try{
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //連想配列
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //例外
        PDO::ATTR_EMULATE_PREPARES => false, //SQLインジェクション対策
    ]);
    
    } catch(PDOException $e){
    echo '接続失敗' . $e->getMessage() . "\n";
    exit();
    }

// データを挿入する準備文を作成
$stmt = $pdo->prepare("INSERT INTO contacts (fullname, Kana, email, gender, zip, prefs, municipalities,FurtherDivisions, building, comment, checks)
VALUES (:fullname, :kana, :email, :gender, :zip, :prefs, :municipalities, :FurtherDivisions, :building, :comment, :checks)");

?>