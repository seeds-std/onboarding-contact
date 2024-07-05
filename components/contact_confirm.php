<form action="./thanks.php" method="POST">
    <table class="table">
        <tr>
            <th>氏名</th>
            <td><span class="right"><? echo htmlspecialchars($_GET['name']) ?></span></td>
            <input type="hidden" name="name" value="<? echo htmlspecialchars($_GET['name']) ?>">
        </tr>
        <tr>
            <th>フリガナ</th>
            <td><span class="right"><? echo htmlspecialchars($_GET['kana']) ?></span></td>
            <input type="hidden" name="kana" value="<? echo htmlspecialchars($_GET['kana']) ?>">
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td><span class="right"><? echo htmlspecialchars($_GET['email']) ?></span></td>
            <input type="hidden" name="email" value="<? echo htmlspecialchars($_GET['email']) ?>">
        </tr>
        <tr>
            <th>性別</th>
            <td><span class="right"><? echo htmlspecialchars($_GET['gender']) ?></span></td>
            <input type="hidden" name="gender" value="<? echo htmlspecialchars($_GET['gender']) ?>">
        </tr>
        <tr>
            <th>住所（郵便番号）</th>
            <td>
                <span class="right"><? echo htmlspecialchars($_GET['zip_code1']) ?></span>
                <input type="hidden" name="zip_code1" value="<? echo htmlspecialchars($_GET['zip_code1']) ?>">
                <span>-</span>
                <span><? echo htmlspecialchars($_GET['zip_code2']) ?></span>
                <input type="hidden" name="zip_code2" value="<? echo htmlspecialchars($_GET['zip_code2']) ?>">
            </td>
        </tr>
        <tr>
            <th>住所（都道府県）</th>
            <td><span class="right"><? echo htmlspecialchars($_GET['prefecture']) ?></span></td>
            <input type="hidden" name="prefecture" value="<? echo htmlspecialchars($_GET['prefecture']) ?>">
        </tr>
        <tr>
            <th>住所（市区町村）</th>
            <td><span class="right"><? echo htmlspecialchars($_GET['address1']) ?></span></td>
            <input type="hidden" name="address1" value="<? echo htmlspecialchars($_GET['address1']) ?>">
        </tr>
        <tr>
            <th>住所（それ以降の住所）</th>
            <td><span class="right"><? echo htmlspecialchars($_GET['address2']) ?></span></td>
            <input type="hidden" name="address2" value="<? echo htmlspecialchars($_GET['address2']) ?>">
        </tr>
        <tr>
            <th>住所（建物名）</th>
            <td><span class="right"><? echo htmlspecialchars($_GET['building_name']) ?></span></td>
            <input type="hidden" name="building_name" value="<? echo htmlspecialchars($_GET['building_name']) ?>">
        </tr>
        <tr>
            <th>お問い合わせ内容</th>
            <td><span class="right"><? echo htmlspecialchars($_GET['contact']) ?></span></td>
            <input type="hidden" name="contact" value="<? echo htmlspecialchars($_GET['contact']) ?>">
        </tr>
        <tr>
            <th>このフォームを知った経由<br>（複数選択可）</th>
            <td>
                <? if ($is_sources_exists): ?>
                    <? foreach ($_GET['sources'] as $source): ?>
                        <span class="right"><? echo $source ?></span><br>
                        <input type="hidden" name="sources[]" value="<? echo htmlspecialchars($source) ?>">
                    <? endforeach; ?>
                <? endif; ?>
            </td>
        </tr>
    </table>
    <div class="footer">
        <button class="back-btn" id="back-btn" type="button" value="戻る">戻る</button>
        <button class="confirm-btn" type="submit" value="確認">確認</button>
    </div>
</form>

<script>
    document.getElementById('back-btn').addEventListener('click', function() {
        window.history.back();
    });
</script>
