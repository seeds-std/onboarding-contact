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
                    <?php foreach (getGenders() as $g): ?>
                        <label>
                            <input type="radio" name="gender" value="<?php echo htmlspecialchars($g, ENT_QUOTES, 'UTF-8'); ?>" <?php echo $gender === $g ? 'checked' : ''; ?> required>
                            <?php echo htmlspecialchars($g, ENT_QUOTES, 'UTF-8'); ?>
                        </label>
                    <?php endforeach; ?>
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
                        <?php foreach (getPrefectures() as $p): ?>
                            <option value="<?php echo htmlspecialchars($p, ENT_QUOTES, 'UTF-8'); ?>" <?php echo $pref === $p ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($p, ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php endforeach; ?>
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