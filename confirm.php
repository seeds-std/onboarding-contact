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