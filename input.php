<form action="index.php" method="POST">
        
        <table width="350">
            <tr>
                <td align="left"><label for="name">氏名</label><font color="red">※</font></td>
                <td align="right">
                    <input type="text" id="name" name="user_name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>" required>
                </td>
            </tr>
            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left"><label for="namefurigana">フリガナ</label><font color="red">※</font></td>
                <td align="right">
                    <input type="text" id="namefurigana" name="user_namefurigana" value="<?php echo htmlspecialchars($furigana, ENT_QUOTES, 'UTF-8'); ?>" required>
                </td>
            </tr>
            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left"><label for="email">メールアドレス</label><font color="red">※</font></td>
                <td align="right">
                    <input type="email" id="email" name="user_email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" required>
                </td>
            </tr>
            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left">性別</td>
                
                <td align="left">
                   <label><input type="radio" name="gender" value="女性" <?php echo $gender === '女性' ? 'checked' : ''; ?> required> 女性</label>
                   <label><input type="radio" name="gender" value="男性" <?php echo $gender === '男性' ? 'checked' : ''; ?> required> 男性</label>
                </td>
            </tr>
            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left"><label for="zip1">住所（郵便番号）</label><font color="red">※</font></td>
                <td align="left">
                    <input type="text" id="zip1" name="zip1" size="3" maxlength="3" value="<?php echo htmlspecialchars($zip1, ENT_QUOTES, 'UTF-8'); ?>" required>
                    -
                    <input type="text" id="zip2" name="zip2" size="4" maxlength="4" value="<?php echo htmlspecialchars($zip2, ENT_QUOTES, 'UTF-8'); ?>" required>
                </td>
            </tr>

            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left"><label for="pref">住所（都道府県）</label><font color="red">※</font></td>
                <td align="left">
                    <select id="pref" name="pref" required>
                        <option value="">選択してください</option>
                        <?php
                        // 選択されていた都道府県に selected を付ける
                        $prefs = ['北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','新潟県','富山県','石川県','福井県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県'];
                        foreach ($prefs as $p) {
                            $selected = ($pref === $p) ? 'selected' : '';
                            echo "<option value=\"{$p}\" {$selected}>{$p}</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left"><label for="city">住所（市区町村）</label><font color="red">※</font></td>
                <td align="right">
                    <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($city, ENT_QUOTES, 'UTF-8'); ?>" required>
                </td>
            </tr>

            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left" valign="top"><label for="address">住所（それ以降の住所）</label><font color="red">※</font></td>
                <td align="right">
                    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?>" required>
                </td>
            </tr>

             <tr height="15"><td colspan="2"></td></tr>
             <tr>
                <td align="left"><label for="building">住所（建物）</label></td>
                <td align="right">
                    <input type="text" id="building" name="building" value="<?php echo htmlspecialchars($building, ENT_QUOTES, 'UTF-8'); ?>">
                </td>
            </tr>
            <tr height="15"><td colspan="2"></td></tr>
            <tr>
                <td align="left" valign="top" nowrap>
                    <label for="message">お問い合わせ内容</label><font color="red">※</font>
                </td>
                <td align="right">
                    <textarea id="message" name="message" rows="4" cols="18" required><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></textarea>
                </td>
            </tr>

             <tr height="15"><td colspan="2"></td></tr>
             <tr>
               <td align="left" valign="top" nowrap>このフォームを知った理由（複数選択可）<font color="red">※</font></td>
                <td align="left" valign="top" nowrap>
                    <label><input type="checkbox" name="interest[]" value="家族から聞いて" <?php echo in_array('家族から聞いて', $interests, true) ? 'checked' : ''; ?>> 家族から聞いて</label><br>
                    <label><input type="checkbox" name="interest[]" value="友人から聞いて" <?php echo in_array('友人から聞いて', $interests, true) ? 'checked' : ''; ?>> 友人から聞いて</label><br>
                    <label><input type="checkbox" name="interest[]" value="新聞" <?php echo in_array('新聞', $interests, true) ? 'checked' : ''; ?>> 新聞</label><br>
                    <label><input type="checkbox" name="interest[]" value="ラジオ" <?php echo in_array('ラジオ', $interests, true) ? 'checked' : ''; ?>> ラジオ</label><br>
                    <label><input type="checkbox" name="interest[]" value="Web" <?php echo in_array('Web', $interests, true) ? 'checked' : ''; ?>> Web</label>
                </td>
            </tr>

        </table>
        <br>

        <div align="left">
            <button type="submit" name="btn_confirm">決定</button>
        </div>

    </form>