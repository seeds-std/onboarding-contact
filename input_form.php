<body>
    <form action="./index.php" method="POST">
        <p class="form-container"><sup class="red">*</sup>内容は必須項目です</p>
        <div class="form-container">
            <div class="form-group">
                <label for="fullname" class="form-label">氏名<sup class="red">*</sup></label>
                <input type="text" id="fullname" name="fullname" class="form-input" 
                    value='<?= isset($fullname) ? htmlspecialchars($fullname, ENT_QUOTES) : "" ?>' required>
            </div>

            <div class="form-group">
                <label for="kana" class="form-label">フリガナ<sup class="red">*</sup></label>
                <input type="text" id="kana" name="kana" class="form-input" 
                    pattern="[\u30A1-\u30F6]*"
                    value='<?= isset($kana) ? htmlspecialchars($kana, ENT_QUOTES) : "" ?>' required>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">メールアドレス<sup class="red">*</sup></label>
                <input type="email" id="email" name="email" class="form-input" 
                    value='<?= isset($email) ? htmlspecialchars($email, ENT_QUOTES) : "" ?>' required> 
            </div>

            <div class="form-group">
                <label for="gender" class="form-label">性別<sup class="red">*</sup></label>
                <input id="female" type="radio" name="gender" value="女性" 
                    <?= isset($gender) && $gender == '女性' ? 'checked' : '' ?>><label for="female">女性</label>
                <input id="male" type="radio" name="gender" value="男性" 
                    <?= isset($gender) && $gender == '男性' ? 'checked' : '' ?>><label for="male">男性</label>
            </div>

            <div class="form-group">
                <label for="zipcode" class="form-label">住所(郵便番号)<sup class="red">*</sup></label>
                <input type="text" id="zip1" name="zip1" class="form-input" maxlength="3" pattern="\d{3}" 
                    inputmode="numeric" 
                    value='<?= isset($zip1) ? htmlspecialchars($zip1, ENT_QUOTES) : "" ?>' required>
                <sup>-</sup>
                <input type="text" id="zip2" name="zip2" class="form-input" maxlength="4" pattern="\d{4}" 
                    inputmode="numeric" 
                    value='<?= isset($zip2) ? htmlspecialchars($zip2, ENT_QUOTES) : "" ?>' required>
            </div>

            <div class="form-group">
                <label for="prefs" class="form-label">住所(都道府県)<sup class="red">*</sup></label>
                <select name="prefs" class="form-input" required>
                    <option value="">選択してください</option>
                    <?php
                    $prefsList = [
                        "北海道", "青森県", "岩手県", "宮城県", "秋田県", "山形県", "福島県", "茨城県", 
                        "栃木県", "群馬県", "埼玉県", "千葉県", "東京都", "神奈川県", "新潟県", "富山県", 
                        "石川県", "福井県", "山梨県", "長野県", "岐阜県", "静岡県", "愛知県", "三重県", 
                        "滋賀県", "京都府", "大阪府", "兵庫県", "奈良県", "和歌山県", "鳥取県", "島根県", 
                        "岡山県", "広島県", "山口県", "徳島県", "香川県", "愛媛県", "高知県", "福岡県", 
                        "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県"
                    ];
                    foreach ($prefsList as $pref) {
                        echo "<option value=\"$pref\" " . (isset($prefs) && $prefs == $pref ? 'selected' : '') . ">$pref</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="municipalities" class="form-label">住所(市区町村)<sup class="red">*</sup></label>
                <input type="text" id="municipalities" name="municipalities" class="form-input" 
                    value='<?= isset($municipalities) ? htmlspecialchars($municipalities, ENT_QUOTES) : "" ?>' required>
            </div>

            <div class="form-group">
                <label for="furtherDivisions" class="form-label">住所(それ以降の住所)<sup class="red">*</sup></label>
                <input type="text" id="furtherDivisions" name="furtherDivisions" class="form-input" 
                    value='<?= isset($furtherDivisions) ? htmlspecialchars($furtherDivisions, ENT_QUOTES) : "" ?>' required>
            </div>

            <div class="form-group">       
                <label for="building" class="form-label">住所(建物)</label>
                <input type="text" id="building" name="building" class="form-input" 
                    value='<?= isset($building) ? htmlspecialchars($building, ENT_QUOTES) : "" ?>'>
            </div>

            <div class="form-group">
                <label for="comment" class="form-label">お問い合わせ内容<sup class="red">*</sup></label>
                <textarea id="comment" name="comment" class="commentArea" required>
                    <?= isset($comment) ? htmlspecialchars(trim($comment), ENT_QUOTES) : "" ?>
                </textarea>
            </div>

            <div class="form-group">       
                <label for="reason" class="form-label">このフォームを知った経由(複数選択可)</label>
                <div class="checkArea">
                <div class="check">
                    <label for="family">
                        <input id="family" type="checkbox" name="discoveryReason[]" value="家族から聞いて" 
                        <?= isset($discoveryReason) && in_array('家族から聞いて', $discoveryReason) ? 'checked' : '' ?>>家族から聞いて
                    </label>
                </div>
                <div class="check">
                    <label for="friend">
                        <input id="friend" type="checkbox" name="discoveryReason[]" value="友達から聞いて" 
                        <?= isset($discoveryReason) && in_array('友達から聞いて', $discoveryReason) ? 'checked' : '' ?>>友達から聞いて
                    </label>
                </div>
                <div class="check">
                    <label for="newspaper">
                        <input id="newspaper" type="checkbox" name="discoveryReason[]" value="新聞"
                        <?= isset($discoveryReason) && in_array('新聞', $discoveryReason) ? 'checked' : '' ?>>新聞
                    </label>
                </div>
                <div class="check">
                    <label for="Radio">
                        <input id="Radio" type="checkbox" name="discoveryReason[]" value="ラジオ"
                        <?= isset($discoveryReason) && in_array('ラジオ', $discoveryReason) ? 'checked' : '' ?>>ラジオ
                    </label>
                </div>
                <div class="check">
                    <label for="web">
                        <input id="web" type="checkbox" name="discoveryReason[]" value="web"
                        <?= isset($discoveryReason) && in_array('web', $discoveryReason) ? 'checked' : '' ?>>web
                    </label>
                </div>
            </div>

            <div align="center">
                <input class="button1" type="submit" value="確認" name="confirm">
            </div>
        </div>
    </form>
</body>
