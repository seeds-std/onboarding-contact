<?php
function sendCompleteMail(string $to, string $name, string $message): bool
{
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");

    $subject = "【〇〇】お問い合わせ受け付け完了";
    $mail_body = "{$name} 様\n\nお問い合わせありがとうございます。\n\n【内容】\n{$message}";
    $headers = "From: " . mb_encode_mimeheader("お問い合わせ窓口") . " <no-reply@example.com>";

    return mb_send_mail($to, $subject, $mail_body, $headers);
}