<?php
// 実装
require_once 'private/bootstrap.php';
require_once 'private/database.php';
require      'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//var_dump($_POST);
//文字エンコードを指定
mb_language('Japanese');
mb_internal_encoding('UTF-8');

// POSTデータから値を取得
$fullname = $_POST['fullname'];
$kana = $_POST['kana'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$zip1 = $_POST['zip1'];
$zip2 = $_POST['zip2'];
$prefs = $_POST['prefs'];
$municipalities = $_POST['municipalities'];
$furtherDivisions = $_POST['furtherDivisions'];
$building = $_POST['building'];
$comment = $_POST['comment'];
$discoveryReason = $_POST['discoveryReason'];


//登録する値を設定
$zip = $zip1 . '-' . $zip2; 
$discoveryReason = htmlspecialchars($discoveryReason);
$mail = new PHPMailer(true);

//データベース接続
$connection = connectDB();

try {
    // データを挿入するためのSQLクエリを作成
    $query = "INSERT INTO contacts (fullname, kana, email, gender, zip, prefs, municipalities, furtherDivisions, building, comment, discoveryReason)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // プリペアドステートメントを作成
    $stmt = $connection->prepare($query);

    // パラメータをバインドする
    $stmt->bind_param("sssssssssss", $fullname, $kana, $email, $gender, $zip, $prefs, $municipalities, $furtherDivisions, $building, $comment, $discoveryReason);

    // ステートメントを実行
    $stmt->execute();
    
    // SMTPサーバの設定
    $mail->isSMTP();
    $mail->Host = 'mail';
    $mail->SMTPAuth = false;
    $mail->SMTPSecure = false;
    $mail->Port = 1025;
    
    // 送受信先設定
    $mail->addAddress($email, $fullname);
    
    // メールの件名
    $mail->Subject = 'お問い合わせフォームからのメッセージ';
    $mail->setFrom($email, $fullname);
    $mail->Body = "
        氏名: $fullname
        フリガナ: $kana
        メールアドレス: $email
        性別: $gender
        住所(郵便番号): $zip
        住所(都道府県): $prefs
        住所(市区町村): $municipalities
        住所(それ以降の住所): $furtherDivisions
        住所(建物): $building
        お問い合わせ内容: $comment
        このフォームを知った経由: $discoveryReason";

    // メールを送信
    $mail->send();
    
} catch (Exception $e) {
    echo "エラーが発生しました：" . $e->getMessage();

} finally {
    // ステートメントと接続を閉じる
    $stmt->close();
    $connection->close();
}
?>

<!-- 描画するHTML -->
<form>
    <p>お問い合わせありがとうございました</p>
</form>
