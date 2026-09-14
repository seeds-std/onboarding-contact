<?php
function validateContactForm(array $params): array
{
    $errors = [];

    $name      = $params['user_name'] ?? '';
    $furigana  = $params['user_namefurigana'] ?? '';
    $email     = $params['user_email'] ?? '';
    $zip1      = $params['zip1'] ?? '';
    $zip2      = $params['zip2'] ?? '';
    $pref      = $params['pref'] ?? '';
    $city      = $params['city'] ?? '';
    $address   = $params['address'] ?? '';
    $message   = $params['message'] ?? '';
    $interests = $params['interest'] ?? [];

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

    return $errors;
}