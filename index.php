<?php
/* ----------------------------------------
 * 必要なファイルを読み込む
 * ---------------------------------------- */
require_once 'private/bootstrap.php';
require_once 'private/database.php';

// 実装

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
    <form action="/submit" method="POST">
        
        <table width="350">
            <tr>
                
                <td align="left"><label for="name">氏名</label><font color="red">※</font></td>
                <td align="right"><input type="text" id="name" name="user_name"></td>
            </tr>
            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left"><label for="namefurigana">フリガナ</label><font color="red">※</font></td>
                <td align="right"><input type="text" id="namefurigana" name="user_namefurigana"></td>
            </tr>
            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left"><label for="email">メールアドレス</label><font color="red">※</font></td>
                <td align="right"><input type="email" id="email" name="user_email"></td>
            </tr>
            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left">性別</td>
                
                <td align="left">
                    <label><input type="radio" name="gender" value="female"> 女性</label>
                    <label><input type="radio" name="gender" value="male"> 男性</label>
                </td>
            </tr>
            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left"><label for="zip1">住所（郵便番号）</label><font color="red">※</font></td>
                <td align="left">
                    <input type="text" id="zip1" name="zip1" size="3" maxlength="3">
                    -
                    <input type="text" id="zip2" name="zip2" size="4" maxlength="4">
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
                
                <td align="left"><label for="juusyo">住所（市区町村）</label><font color="red">※</font></td>
                <td align="right"><input type="text" id="juusyo" name="user_juusyo"></td>
            </tr>

            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                
                <td align="left" valign="top"><label for="others">住所（それ以降の住所）</label><font color="red">※</font></td>
                <td align="right"><input type="text" id="others" name="user_others"></td>
            </tr>

             <tr height="15"><td colspan="2"></td></tr>
             <tr>
                
                <td align="left"><label for="buiding">住所（建物）</label></td>
                <td align="right"><input type="text" id="buiding" name="user_buiding"></td>
            </tr>
            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left" valign="top" nowrap>
                    <label for="message">お問い合わせ内容</label><font color="red">※</font>
                </td>
                <td align="right">
                    <!-- textarea タグに required を追加 -->
                    <textarea id="message" name="message" rows="4" cols="18"></textarea>
                </td>
            </tr>

             <tr height="15"><td colspan="2"></td></tr>
             <tr>
               <td align="left" valign="top" nowrap>このフォームを知った理由（複数選択可）<font color="red">※</font></td>
                <td align="left">
                    <label><input type="checkbox" name="interest" value="family"> 家族から聞いて</label><br>
                    <label><input type="checkbox" name="interest" value="friend"> 友人から聞いて</label><br>
                    <label><input type="checkbox" name="interest" value="newspaper"> 新聞</label><br>
                    <label><input type="checkbox" name="interest" value="radio"> ラジオ</label><br>
                    <label><input type="checkbox" name="interest" value="web"> Web</label>
                </td>
            </tr>

        </table>
        <br>

    </form>

</body>
</html>
