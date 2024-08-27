<body>
    <form action="./thanks.php" method="POST" id="confirm">
        <div class="form-container">

            <!-- 上部に空間を作る  -->
            <br class="form-group">

            <div class="form-group">
                <label class="form-check">氏名</label>
                <p class="form-check"><?= $fullname ?></p>
                <input type="hidden" name="fullname" id="fullname" value="<?= $fullname ?>">
            </div>

            <div class="form-group">
                <label class="form-check">フリガナ</label>
                <p class="form-check"><?= $kana ?></p>
                <input type="hidden" name="kana" id="kana" value="<?= $kana ?>">
            </div>
            
            <div class="form-group">
                <label class="form-check">メールアドレス</label>
                <p class="form-check"><?= $email ?></p>
                <input type="hidden" name="email" id="email" value="<?= $email ?>">
            </div>
            
            <div class="form-group">
                <label class="form-check">性別</label>
                <p class="form-check"><?= $gender ?></p>
                <input type="hidden" name="gender" id="gender" value="<?= $gender ?>">
            </div>
            
            <div class="form-group">
                <label class="form-check">住所(郵便番号)</label>
                <p class="form-check"><?= $zip1 . "-" . $zip2 ?></p>
                <input type="hidden" name="zip1" id="zip1" value="<?= $zip1 ?>">
                <input type="hidden" name="zip2" id="zip2" value="<?= $zip2 ?>">
            </div>
            
            <div class="form-group">
                <label class="form-check">住所(都道府県)</label>
                <p class="form-check"><?= $prefs ?></p>
                <input type="hidden" name="prefs" id="prefs" value="<?= $prefs ?>">
            </div>
            
            <div class="form-group">
                <label class="form-check">住所(市区町村)</label>
                <p class="form-check"><?= $municipalities ?></p>
                <input type="hidden" name="municipalities" id="municipalities" value="<?= $municipalities ?>">
            </div>
            
            <div class="form-group">
                <label class="form-check">住所(それ以降の住所)</label>
                <p class="form-check"><?= $furtherDivisions ?></p>
                <input type="hidden" name="furtherDivisions" id="furtherDivisions" value="<?= $furtherDivisions ?>">
            </div>
            
            <div class="form-group">
                <label class="form-check">住所(建物)</label>
                <p class="form-check"><?= $building ?></p>
                <input type="hidden" name="building" id="building" value="<?= $building ?>">
            </div>
            
            <div class="form-group">
                <label class="form-check">お問い合わせ内容</label>
                <p class="form-check"><?= $comment ?></p>
                <input type="hidden" name="comment" id="comment" value="<?= $comment ?>">
            </div>
            
            <div class="form-group">
                <label class="form-check">このフォームを知った経由(複数選択可)</label>
                <p class="form-check">
                    <?php if (isset($discoveryReason) && is_array($discoveryReason)) {$discoveryReason = implode(', ',$discoveryReason); echo $discoveryReason;}?>
                </p>
                <input name="discoveryReason" type="hidden" value="<?=isset($discoveryReason) ? '$discoveryReason' : '' ?>">
            </div>
            <!-- 戻る、送信ボタン  -->
            <div align="center">
                <button type="button" class="button2" onclick="window.history.back()">戻る</button>
                <input class="button1" type="submit" value="送信" />
            </div>
        </div>
    </form>
</body>