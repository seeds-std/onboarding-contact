<?php

// 必要なファイルを読み込む
require_once __DIR__ . '/private/helper.php';
require_once __DIR__ . '/private/database.php';
require_once __DIR__ . '/validate.php';



// 実装
$prefecture = intval($_POST['prefecture']);
$zip_code = $_POST['zip_code1'] . $_POST['zip_code2'];

$error_message = validate($_POST);
$is_error = count($error_message) > 0;
if ($is_error) {
    redirect('index.php');
}

$connection = connectDB();
$connection->begin_transaction();
try {
    $sql = "INSERT INTO contacts (name, kana, email, gender, zip_code, prefecture, address1, address2, building_name, contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $statement = $connection->prepare($sql);
    $statement->bind_param(
        'sssisissss',
        $_POST['name'],
        $_POST['kana'],
        $_POST['email'],
        $_POST['gender'],
        $zip_code,
        $prefecture,
        $_POST['address1'],
        $_POST['address2'],
        $_POST['building_name'],
        $_POST['contact']
    );
    $statement->execute();

    $sql = "INSERT INTO sources (contact_id, source) VALUES (?, ?)";
    $statement = $connection->prepare($sql);
    $contact_id = $connection->insert_id;
    foreach ($_POST['sources'] as $source) {
        $statement->bind_param('is', $contact_id, $source);
        $statement->execute();
    }

    $connection->commit();
} catch (Exception $e) {
    $connection->rollback();
    echo 'エラーが発生しました。';
}


$statement->close();
$connection->close();
?>

<!-- 描画するHTML -->
お問い合わせありがとうございました。
