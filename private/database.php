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
function connectDB()
{
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
    if ($connection->error) {
        die("Connection failed: " . $connection->connect_error);
    }

    return $connection;
}

function saveContact(array $data): bool
{
    $db = connectDB();
    if (!$db) {
        return false;
    }

    $name         = $data['user_name'] ?? '';
    $furigana     = $data['user_namefurigana'] ?? '';
    $email        = $data['user_email'] ?? '';
    $gender       = $data['gender'] ?? '女性';
    $zip1         = $data['zip1'] ?? '';
    $zip2         = $data['zip2'] ?? '';
    $pref         = $data['pref'] ?? '';
    $city         = $data['city'] ?? '';
    $address      = $data['address'] ?? '';
    $building     = $data['building'] ?? '';
    $message      = $data['message'] ?? '';
    $interests    = $data['interest'] ?? [];

    $zip_code     = $zip1 . '-' . $zip2;
    $interest_str = implode('、', $interests);

    $sql = "INSERT INTO bbs.contacts (
            name, furigana, email, gender, zip_code, pref, city, address, building, message, interest, created_at
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param(
            "sssssssssss",
            $name,
            $furigana,
            $email,
            $gender,
            $zip_code,
            $pref,
            $city,
            $address,
            $building,
            $message,
            $interest_str
        );

        $result = $stmt->execute();
        $stmt->close();
        $db->close();

        return $result;
    }

    $db->close();
    return false;
}
