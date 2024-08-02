<?php
/* ----------------------------------------
 * 必要なファイルを読み込む
 * ---------------------------------------- */
require_once 'private/bootstrap.php';
require_once 'private/database.php';
require_once 'validate.php';
require_once 'enums/prefecture.php';
require_once 'enums/Source.php';

// 実装
$is_error = false;
$error_message = [];
$is_submit = count($_POST) > 0;
if ($is_submit) {
    $error_message = validate($_POST);
    $is_error = count($error_message) > 0;
}
$is_sources_exists = array_key_exists('sources', $_POST);
$old_request = count($error_message) > 0 ? $_POST : [];

?>

<!-- 描画するHTML -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>onboarding-contact</title>
</head>
<body>
    <main>
        <? if ($is_submit && ! $is_error): ?>
            <? include 'components/contact_confirm.php' ?>
        <? else: ?>
            <? include 'components/contact.php' ?>
        <? endif; ?>
    </main>
</body>
</html>
