<?php

// 必要なファイルを読み込む
require_once __DIR__ . '/private/helper.php';
require_once __DIR__ . '/private/database.php';
require_once __DIR__ . '/validate.php';



// 実装

// 選択されたソースをカンマ区切りで結合する
$sources = '';
foreach ($_POST['sources'] as $source) {
    $sources .= $source . ',';
}
// 最後のカンマを削除する
$sources = rtrim($sources, ',');
$prefecture = intval($_POST['prefecture']);
$zip_code = $_POST['zip_code1'] . $_POST['zip_code2'];

$error_message = validate($_POST);
$is_error = count($error_message) > 0;
if ($is_error) {
    redirect('index.php');
}

$connection = connectDB();
$sql = "INSERT INTO contacts (name, kana, email, gender, zip_code, prefecture, address1, address2, building_name, contact, sources) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$statement = $connection->prepare($sql);
$statement->bind_param(
    'sssisisssss',
    $_POST['name'],
    $_POST['kana'],
    $_POST['email'],
    $_POST['gender'],
    $zip_code,
    $prefecture,
    $_POST['address1'],
    $_POST['address2'],
    $_POST['building_name'],
    $_POST['contact'],
    $sources
);
$statement->execute();

?>

<!-- 描画するHTML -->
お問い合わせありがとうございました。
