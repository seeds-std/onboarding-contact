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
$city    = $_POST['user_city'] ?? '';
$address    = $_POST['user_address'] ?? '';
$building   = $_POST['user_building'] ?? '';
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

    <?php if ($mode === 'confirm'): ?>
        <form action="index.php" method="POST">
            <table width="500" cellpadding="8">
                <tr>
                    <td width="180" align="left">氏名</td>
                    <td align="left"><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td align="left">フリガナ</td>
                    <td align="left"><?php echo htmlspecialchars($furigana, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td align="left">メールアドレス</td>
                    <td align="left"><?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td align="left">性別</td>
                    <td align="left"><?php echo htmlspecialchars($gender, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td align="left">都道府県</td>
                    <td align="left"><?php echo htmlspecialchars($pref, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>

                <tr>
                    <td align="left">住所（郵便番号）</td>
                    <td align="left">〒<?php echo htmlspecialchars($zip1, ENT_QUOTES, 'UTF-8'); ?>-<?php echo htmlspecialchars($zip2, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>

                <tr>
                    <td align="left">住所（市区町村）</td>
                    <td align="left"><?php echo htmlspecialchars($city, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>

                <tr>
                    <td align="left">住所（それ以降の住所）</td>
                    <td align="left"><?php echo htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>

                <tr>
                    <td align="left">住所（建物）</td>
                    <td align="left"><?php echo htmlspecialchars($building, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>

                <tr>
                    <td align="left" valign="top">お問い合わせ内容</td>
                    <td align="left"><?php echo nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')); ?></td>
                </tr>
                <tr>
                    <td align="left" valign="top">このフォームを知った理由</td>
                    <td align="left">
                        <?php foreach ($interests as $item): ?>
                            <?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?><br>
                        <?php endforeach; ?>
                    </td>
                </tr>
            </table>

            <input type="hidden" name="user_name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="user_namefurigana" value="<?php echo htmlspecialchars($furigana , ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="user_email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="gender" value="<?php echo htmlspecialchars($gender, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="pref" value="<?php echo htmlspecialchars($pref, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="zip1" value="<?php echo htmlspecialchars($zip1, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="zip2" value="<?php echo htmlspecialchars($zip2, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="city" value="<?php echo htmlspecialchars($city, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="address" value="<?php echo htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="building" value="<?php echo htmlspecialchars($building, ENT_QUOTES, 'UTF-8'); ?>">
            <?php foreach ($interests as $item): ?>
                <input type="hidden" name="interest[]" value="<?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?>">
            <?php endforeach; ?>
            <input type="hidden" name="message" value="<?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>">

            <br>
            <div align="left">
                <button type="submit" name="btn_back">修正する</button>
                &nbsp;&nbsp;
                <button type="submit" name="btn_submit">送信する</button>
            </div>
            
        </form>

    <?php else: ?>
        <form action="index.php" method="POST">
        
        <table width="350">
            <tr>
                
                <td align="left"><label for="name">氏名</label><font color="red">※</font></td>
                <td align="right"><input type="text" id="name" name="user_name" required></td>
            </tr>
            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left"><label for="namefurigana">フリガナ</label><font color="red">※</font></td>
                <td align="right"><input type="text" id="namefurigana" name="user_namefurigana" required></td>
            </tr>
            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left"><label for="email">メールアドレス</label><font color="red">※</font></td>
                <td align="right"><input type="email" id="email" name="user_email" required></td>
            </tr>
            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left">性別</td>
                
                <td align="left">
                    <label><input type="radio" name="gender" value="女性" required> 女性</label>
                    <label><input type="radio" name="gender" value="男性" required> 男性</label>
                </td>
            </tr>
            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left"><label for="zip1">住所（郵便番号）</label><font color="red">※</font></td>
                <td align="left">
                    <input type="text" id="zip1" name="zip1" size="3" maxlength="3" required>
                    -
                    <input type="text" id="zip2" name="zip2" size="4" maxlength="4" required>
                </td>
            </tr>

            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left"><label for="pref">住所（都道府県）</label><font color="red">※</font></td>
                <td align="left">
                    <select id="pref" name="pref" required>
                        <option value="" selected>選択してください</option>
                        <option value="北海道">北海道</option>
                        <option value="青森県">青森県</option>
                        <option value="岩手県">岩手県</option>
                        <option value="宮城県">宮城県</option>
                        <option value="秋田県">秋田県</option>
                        <option value="山形県">山形県</option>
                        <option value="福島県">福島県</option>
                        <option value="茨城県">茨城県</option>
                        <option value="栃木県">栃木県</option>
                        <option value="群馬県">群馬県</option>
                        <option value="埼玉県">埼玉県</option>
                        <option value="千葉県">千葉県</option>
                        <option value="東京都">東京都</option>
                        <option value="神奈川県">神奈川県</option>
                        <option value="新潟県">新潟県</option>
                        <option value="富山県">富山県</option>
                        <option value="石川県">石川県</option>
                        <option value="福井県">福井県</option>
                        <option value="山梨県">山梨県</option>
                        <option value="長野県">長野県</option>
                        <option value="岐阜県">岐阜県</option>
                        <option value="静岡県">静岡県</option>
                        <option value="愛知県">愛知県</option>
                        <option value="三重県">三重県</option>
                        <option value="滋賀県">滋賀県</option>
                        <option value="京都府">京都府</option>
                        <option value="大阪府">大阪府</option>
                        <option value="兵庫県">兵庫県</option>
                        <option value="奈良県">奈良県</option>
                        <option value="和歌山県">和歌山県</option>
                        <option value="鳥取県">鳥取県</option>
                        <option value="島根県">島根県</option>
                        <option value="岡山県">岡山県</option>
                        <option value="広島県">広島県</option>
                        <option value="山口県">山口県</option>
                        <option value="徳島県">徳島県</option>
                        <option value="香川県">香川県</option>
                        <option value="愛媛県">愛媛県</option>
                        <option value="高知県">高知県</option>
                        <option value="福岡県">福岡県</option>
                        <option value="佐賀県">佐賀県</option>
                        <option value="長崎県">長崎県</option>
                        <option value="熊本県">熊本県</option>
                        <option value="大分県">大分県</option>
                        <option value="宮崎県">宮崎県</option>
                        <option value="鹿児島県">鹿児島県</option>
                        <option value="沖縄県">沖縄県</option>
                    </select>
                </td>
            </tr>

            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                
                <td align="left"><label for="city">住所（市区町村）</label><font color="red">※</font></td>
                <td align="right"><input type="text" id="city" name="user_city" required></td>
            </tr>

            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                
                <td align="left" valign="top"><label for="address">住所（それ以降の住所）</label><font color="red">※</font></td>
                <td align="right"><input type="text" id="address" name="user_address" required></td>
            </tr>

             <tr height="15"><td colspan="2"></td></tr>
             <tr>
                
                <td align="left"><label for="building">住所（建物）</label></td>
                <td align="right"><input type="text" id="building" name="user_building"></td>
            </tr>
            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left" valign="top" nowrap>
                    <label for="message">お問い合わせ内容</label><font color="red">※</font>
                </td>
                <td align="right">
                    <textarea id="message" name="message" rows="4" cols="18" required></textarea>
                </td>
            </tr>

             <tr height="15"><td colspan="2"></td></tr>
             <tr>
               <td align="left" valign="top" nowrap>このフォームを知った理由（複数選択可）<font color="red">※</font></td>
                <td align="left" valign="top" nowrap>
                    <label><input type="checkbox" name="interest[]" value="家族から聞いて"> 家族から聞いて</label><br>
                    <label><input type="checkbox" name="interest[]" value="友人から聞いて"> 友人から聞いて</label><br>
                    <label><input type="checkbox" name="interest[]" value="新聞"> 新聞</label><br>
                    <label><input type="checkbox" name="interest[]" value="ラジオ"> ラジオ</label><br>
                    <label><input type="checkbox" name="interest[]" value="Web"> Web</label>
                </td>
            </tr>

        </table>
        <br>

        <div align="left">
            <button type="submit" name="btn_confirm">決定</button>
        </div>

    </form>
    <?php endif; ?>

</body>
</html>
