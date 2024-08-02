<? foreach ($error_message as $message) {
    echo '<p class="error-message">' . $message . '</p>';
} ?>

<form action="./index.php" method="POST">
    <table class="table">
        <tr>
            <p><span class="reference-mark">※</span>内容は必須項目です</p>
        </tr>
        <tr>
            <th>氏名<span class="reference-mark">※</span></th>
            <td><input class="right" type="text" id="name" name="name" value="<? echo $is_submit ? $old_request['name'] : null?>" required></td>
        </tr>
        <tr>
            <th>フリガナ<span class="reference-mark">※</span></th>
            <td><input class="right" type="text" id="kana" name="kana" value="<? echo $is_submit ? $old_request['kana'] : null ?>" required><br></td>
        </tr>
        <tr>
            <th>メールアドレス<span class="reference-mark">※</span></th>
            <td><input class="right" type="email" id="email" name="email" value="<? echo $is_submit ? $old_request['email'] : null ?>" required><br></td>
        </tr>
        <tr>
            <th>性別<span class="reference-mark">※</span></th>
            <td>
                <input class="right" type="radio" id="female" name="gender" value="女性" checked><label for="female">女性</label>
                <input type="radio" id="male" name="gender" value="男性" <? if ($is_submit && $old_request['gender'] == '男性') echo 'checked' ?>><label for="male">男性</label><br>
            </td>
        </tr>
        <tr>
            <th>住所（郵便番号）<span class="reference-mark">※</span></th>
            <td>
                <input class="right" type="text" id="zip_code1" name="zip_code1" value="<? echo $is_submit ? $old_request['zip_code1'] : null ?>" required>
                <span>-</span>
                <input type="text" id="zip_code2" name="zip_code2" value="<? echo $is_submit ? $old_request['zip_code2'] : null ?>" required><br>
            </td>
        </tr>
        <tr>
            <th>住所（都道府県）<span class="reference-mark">※</span></th>
            <td>
                <select class="right" name="prefecture" id="prefecture" required>
                    <option class="bold" value="" selected>選択してください</option>
                    <? foreach (Prefecture::cases() as $prefecture): ?>
                        <option value="<? echo $prefecture->value ?>" <? if ($is_submit && $old_request['prefecture'] == $prefecture->value) echo 'selected' ?>><? echo $prefecture->value ?></option>
                    <? endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>住所（市区町村）<span class="reference-mark">※</span></th>
            <td><input class="right" type="text" id="address1" name="address1" value="<? echo $is_submit ? $old_request['address1'] : null ?>" required><br></td>
        </tr>
        <tr>
            <th>住所（それ以降の住所）<span class="reference-mark">※</span></th>
            <td><input class="right" type="text" id="address2" name="address2" value="<? echo $is_submit ? $old_request['address2'] : null ?>" required><br></td>
        </tr>
        <tr>
            <th>住所（建物名）</th>
            <td><input class="right" type="text" id="building_name" name="building_name" value="<? echo $is_submit ? $old_request['building_name'] : null ?>"><br></td>
        </tr>
        <tr>
            <th>お問い合わせ内容<span class="reference-mark">※</span></th>
            <td><textarea class="right" id="contact" name="contact" rows="10" required><? echo $is_submit ? $old_request['contact'] : null ?></textarea><br></td>
        </tr>
        <tr>
            <th>このフォームを知った経由<br>（複数選択可）</th>
            <td>
                <input class="right" type="checkbox" name="sources[]" id="family" value="家族から聞いて" <? if (array_key_exists('sources', $old_request) && in_array('家族から聞いて', $old_request['sources'])) echo 'checked' ?>><label for="family">家族から聞いて</label><br>
                <input class="right" type="checkbox" name="sources[]" id="friends" value="友達から聞いて" <? if (array_key_exists('sources', $old_request) && in_array('友達から聞いて', $old_request['sources'])) echo 'checked' ?>><label for="friends">友達から聞いて</label><br>
                <input class="right" type="checkbox" name="sources[]" id="newspaper" value="新聞" <? if (array_key_exists('sources', $old_request) && in_array('新聞', $old_request['sources'])) echo 'checked' ?>><label for="newspaper">新聞</label><br>
                <input class="right" type="checkbox" name="sources[]" id="radio" value="ラジオ" <? if (array_key_exists('sources', $old_request) && in_array('ラジオ', $old_request['sources'])) echo 'checked' ?>><label for="radio">ラジオ</label><br>
                <input class="right" type="checkbox" name="sources[]" id="web" value="Web" <? if (array_key_exists('sources', $old_request) && in_array('Web', $old_request['sources'])) echo 'checked' ?>><label for="web">Web</label>
            </td>
        </tr>
    </table>
    <div class="footer">
        <button class="confirm-btn" type="submit" value="確認">確認</button>
    </div>
</form>
