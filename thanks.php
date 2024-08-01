<?php

// 必要なファイルを読み込む
require_once __DIR__ . '/private/helper.php';
require_once __DIR__ . '/private/database.php';
require_once __DIR__ . '/validate.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

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
        'ssssssssss',
        $_POST['name'],
        $_POST['kana'],
        $_POST['email'],
        $_POST['gender'],
        $zip_code,
        $_POST['prefecture'],
        $_POST['address1'],
        $_POST['address2'],
        $_POST['building_name'],
        $_POST['contact'],
    );
    $statement->execute();
    $statement->close();

    $sql = "INSERT INTO sources (contact_id, source) VALUES (?, ?)";
    $statement = $connection->prepare($sql);
    $contact_id = $connection->insert_id;
    foreach ($_POST['sources'] as $source) {
        $statement->bind_param('is', $contact_id, $source);
        $statement->execute();
    }
    $statement->close();

    $connection->commit();
} catch (Exception $e) {
    $connection->rollback();
    echo 'エラーが発生しました。';
}
$connection->close();

$mail = new PHPMailer(true);
try {
    // サーバ設定
    $mail->isSMTP();
    $mail->Host = getenv('MAILHOG_HOST');  // MailHogコンテナのホスト名
    $mail->Port = 1025;  // MailHogのSMTPポート
    $mail->SMTPAuth = false; // SMTP認証なし
    // 文字エンコーディングを設定
    $mail->CharSet = 'UTF-8';

    $mail->setFrom('from@example.com'); // 送信元メールアドレス
    $mail->addAddress($_POST['email']); // 送信先メールアドレス

    $mail->isHTML(true);
    $mail->Subject = '問い合わせ内容';
    $mail->Body = $_POST['contact'];

    $mail->send();
    echo 'メールを送信しました。お問い合わせありがとうございました。';
} catch (Exception $e) {
    echo "メールを送信できませんでした。 {$mail->ErrorInfo}";
}
?>
