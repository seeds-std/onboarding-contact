<?php
/* ----------------------------------------
 * 必要なファイルを読み込む
 * ---------------------------------------- */
require_once 'private/bootstrap.php';
require_once 'private/database.php';
require_once 'private/validation.php';
require_once 'private/mail.php';

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

        $errors = validateContactForm($_POST);

        if (empty($errors)) {
            $mode = 'confirm';
        }

    } elseif (isset($_POST['btn_submit'])) {

       if (saveContact($_POST)) {
            sendCompleteMail($email, $name, $message);

            header('Location: thanks.php');
            exit;
        } else {
            $errors[] = '保存処理に失敗しました。';
            $mode = 'confirm';
        }

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
