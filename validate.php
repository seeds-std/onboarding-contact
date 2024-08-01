<?php
function validate($request) {
    $error_messages = [];
    if ($request['name'] === '') {
        $error_messages[] = '氏名は必須です';
    }
    if (! is_string($request['name'])) {
        $error_messages[] = '氏名は文字列で入力してください';
    }

    if ($request['kana'] === '') {
        $error_messages[] = 'フリガナは必須です';
    }
    if (! is_string($request['kana'])) {
        $error_messages[] = 'フリガナは文字列で入力してください';
    }

    if ($request['email'] === '') {
        $error_messages[] = 'メールアドレスは必須です';
    }
    if (! filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
        // $error_messages[] = 'メールアドレスの形式が正しくありません';
    }

    if ($request['gender'] === '') {
        $error_messages[] = '性別は必須です';
    }
    if (! is_string($request['gender'])) {
        $error_messages[] = '性別は文字列で入力してください';
    }

    if ($request['prefecture'] === '') {
        $error_messages[] = '都道府県は必須です';
    }
    if (! is_string($request['prefecture'])) {
        $error_messages = '都道府県は文字列で入力してください';
    }

    if ($request['address1'] === '') {
        $error_messages[] = '住所（市区町村）は必須です';
    }
    if (! is_string($request['address1'])) {
        $error_messages[] = '住所（市区町村）は文字列で入力してください';
    }

    if ($request['address2'] === '') {
        $error_messages[] = '住所（それ以降の住所）は必須です';
    }
    if (! is_string($request['address2'])) {
        $error_messages[] = '住所（それ以降の住所）は文字列で入力してください';
    }

    if (! is_string($request['building_name'])) {
        $error_messages[] = '住所（建物名）は文字列で入力してください';
    }

    if ($request['contact'] === '') {
        $error_messages[] = 'お問い合わせ内容は必須です';
    }
    if (! is_string($request['contact'])) {
        $error_messages[] = 'お問い合わせ内容は文字列で入力してください';
    }

    if (array_key_exists('sources', $request) &&! is_array($request['sources'])) {
        $error_messages[] = 'このフォームを知った経由でエラーが発生しました';
    }

    return $error_messages;
}
