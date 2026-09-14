<?php
/* ----------------------------------------
 * 必要なファイルを読み込む
 * ---------------------------------------- */
require_once 'private/bootstrap.php';
require_once 'private/database.php';

// 実装
$errors = [];
$mode   = 'input';

$name      = $_POST['user_name'] ?? '';
$furigana  = $_POST['user_namefurigana'] ?? '';
$email     = $_POST['user_email'] ?? '';
$gender    = $_POST['gender'] ?? '女性';
$zip1      = $_POST['zip1'] ?? '';
$zip2      = $_POST['zip2'] ?? '';
$pref      = $_POST['pref'] ?? '';
$city      = $_POST['city'] ?? '';
$address   = $_POST['address'] ?? '';
$building  = $_POST['building'] ?? '';
$message   = $_POST['message'] ?? '';
$interests = $_POST['interest'] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['btn_confirm'])) {

        if (trim($name) === '') {
            $errors[] = '氏名を入力してください。';
        }

        if (trim($furigana) === '') {
            $errors[] = 'フリガナを入力してください。';
        } elseif (!preg_match('/^[ァ-ヶー\s ]+$/u', $furigana)) {
            $errors[] = 'フリガナは全角カタカナで入力してください。';
        }

        if (trim($email) === '') {
            $errors[] = 'メールアドレスを入力してください。';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = '正しいメールアドレスの形式で入力してください。';
        }

        if (trim($zip1) === '' || trim($zip2) === '') {
            $errors[] = '郵便番号を入力してください。';
        } elseif (!preg_match('/^\d{3}$/', $zip1) || !preg_match('/^\d{4}$/', $zip2)) {
            $errors[] = '郵便番号は半角数字（3桁・4桁）で入力してください。';
        }

        if (trim($pref) === '') {
            $errors[] = '都道府県を選択してください。';
        }

        if (trim($city) === '') {
            $errors[] = '住所（市区町村）を入力してください。';
        }

        if (trim($address) === '') {
            $errors[] = '住所（それ以降の住所）を入力してください。';
        }

        if (empty($interests)) {
            $errors[] = '知った理由を1つ以上選択してください。';
        }

        if (trim($message) === '') {
            $errors[] = 'お問い合わせ内容を入力してください。';
        }

        if (empty($errors)) {
            $mode = 'confirm';
        }

    } elseif (isset($_POST['btn_submit'])) {

        $zip_code     = $zip1 . '-' . $zip2;
        $interest_str = implode('、', $interests);

        $db = connectDB();

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

            if ($stmt->execute()) {
                $stmt->close();
                $db->close();

                mb_language("Japanese");
                mb_internal_encoding("UTF-8");

                $to      = $email;
                $subject = "【〇〇】お問い合わせ受け付け完了";
                $mail_body = "{$name} 様\n\nお問い合わせありがとうございます。\n\n【内容】\n{$message}";
                $headers = "From: " . mb_encode_mimeheader("お問い合わせ窓口") . " <no-reply@example.com>";

                mb_send_mail($to, $subject, $mail_body, $headers);

                header('Location: thanks.php');
                exit;
            } else {
                $errors[] = '保存処理に失敗しました。';
            }
        } else {
            $errors[] = 'データベースエラーが発生しました。';
        }

        $mode = 'confirm';

    } elseif (isset($_POST['btn_back'])) {
        $mode = 'input';
    }
}
?>

<!-- 描画するHTML -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせフォーム</title>
</head>
<body>

    <h4><font color="red">※</font>内容は必須項目です</h4>

    <?php if (!empty($errors)): ?>
            <ul style="color: red;">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
    <?php endif; ?>

    <?php
    if ($mode === 'confirm') {
        include 'confirm.php';
    } else {
        include 'input.php';
    }
    ?>

</body>
</html>
