<?php
/* ----------------------------------------
 * 必要なファイルを読み込む
 * ---------------------------------------- */
require_once 'private/bootstrap.php';
require_once 'private/database.php';
require      'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


//実装 
/* ----------------------------------------
 * それぞれの画面が遷移する
 * ---------------------------------------- */


$mode = "input";

if( isset($_POST["back"] ) && $_POST["back"] ){
    //確認から編集に
    $mode ="edit";
    } else if( isset($_POST["confirm"] ) && $_POST["confirm"] ){
    //入力、編集から確認に
    $mode = "confirm";
    } else if( isset($_POST["send"] ) && $_POST["send"] ){
    //確認から送信に
    $mode = "send";
    header('Location: thanks.php');
    
}

/* ----------------------------------------
 * 送信された内容を代入する
 * ---------------------------------------- */
if(isset($_POST['fullname'])){
    $fullname = htmlspecialchars($_POST['fullname']);
    $_POST['fullname'] = "";
}

if(isset($_POST['Kana'])){
    $Kana = htmlspecialchars($_POST['Kana']);
    $_POST['Kana'] = "";
}

if(isset($_POST['email'])){
    $email = htmlspecialchars($_POST['email']);
    $_POST['email'] = "";
}

if(isset($_POST['gender'])){
    $gender = $_POST['gender'];
    $_POST['gender'] = "";
}

if(isset($_POST['zip1'])){
    $zip1 = htmlspecialchars($_POST['zip1']);
    $_POST['zip1'] = "";
}

if(isset($_POST['zip2'])){
    $zip2 = htmlspecialchars($_POST['zip2']);
    $_POST['zip2'] = "";
}

if(isset($_POST['prefs'])){
    $prefs = htmlspecialchars($_POST['prefs']);
    $_POST['prefs'] = "";
}

if(isset($_POST['municipalities'])){
    $municipalities = htmlspecialchars($_POST['municipalities']);
    $_POST['municialities'] = "";
}

if(isset($_POST['FurtherDivisions'])){
    $FurtherDivisions = htmlspecialchars($_POST['FurtherDivisions']);
    $_POST['FurtherDivisions'] = "";
}

if(isset($_POST['building'])){
    $building = htmlspecialchars($_POST['building']);
    $_POST['building'] = "";
}

if(isset($_POST['comment'])){
    $comment = htmlspecialchars($_POST['comment']);
    $_POST['comment'] = "";
}

if(isset($_POST['check'])){
    $check = $_POST['check'];
}

?>

<!DOCTYPE html>
<html lang="ja" >
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    .form-container {
        max-width: 550px;
        margin: auto;
    }

    .form-group {
        margin-bottom: 12px;
        margin-top: 12px;
        display: flex;
    }

    .form-label {
        margin-right: 10px;
        min-width: 350px;
    }

    .form-input {
        flex: 1;
        padding: 8px;
        font-size: 16px;
        width: 70px;
        height: auto;
    }
    
    .form-check{
        margin-right: 10px;
        min-width: 350px;
        margin-bottom: 6px;
        margin-top: 6px;
    }

    .red{
        color: red;
    }

    .commentArea{
        flex: 1;
        width: 70px;
        height: 120px;
        resize: none;
    }

    checkArea{
        margin-top: 5px;
        display: block;
        width: auto;
        text-align: right;
    }

    check{
        display: block;
        text-align: left;
    }

    .button1{
        color:black;
        background-color:lightskyblue;
        font-size:15;
        width:100px;
        height:45px;
        border-radius:10px;
    }

    .button2{
        color:black;
        font-size: 15;
        width: 100px;
        height: 45px;
        border-radius: 10px;
        justify-content: space-between;
    }

    select{
        height: 200px;
        width: 200px;
    }
</style>

<body>
<?php if($mode == "confirm"){ ?>


<!-- 確認画面 -->
    <form action="./index.php" method="POST" id="confirm">
    <div class="form-container">

    <!-- 上部に空間を作る  -->
    <br class="form-group">

    <!-- 氏名  -->
    <div class="form-group">
        <label class="form-check">氏名</label>
        <p3 class="form-check"><?= $fullname ?></p3>
        <input type="hidden" name="fullname" id="fullname" value="<?= $fullname ?>">
    </div>

    <!-- フリガナ -->
    <div class="form-group">
        <label class="form-check">フリガナ</label>
        <p3 class="form-check"><?= $Kana ?></p3>
        <input type="hidden" name="Kana" id="fullname" value="<?= $Kana ?>">
    </div>
    
    <!-- メールアドレス  -->
    <div class="form-group">
        <label class="form-check">メールアドレス</label>
        <p3 class="form-check"><?= $email ?></p3>
        <input type="hidden" name="email" id="email" value="<?= $email ?>">
    </div>
    
    <!-- 性別 -->
    <div class="form-group">
        <label class="form-check">性別</label>
        <p3 class="form-check"><?= $gender ?></p3>
        <input type="hidden" name="gender" id="gender" value="<?= $gender ?>">
    </div>
    
    <!-- 郵便番号  -->
    <div class="form-group">
        <label class="form-check">住所(郵便番号)</label>  <!-- エラー発生: Unsupported operand types: string + string -->
        <p3 class="form-check"><?= $zip1 . "-" . $zip2 ?></p3>
        <input type="hidden" name="zip1" id="zip1" value="<?= $zip1 ?>">
        <input type="hidden" name="zip2" id="zip2" value="<?= $zip2 ?>">
    </div>
    
    <!-- 都道府県  -->
    <div class="form-group">
        <label class="form-check">住所(都道府県)</label>
        <p3 class="form-check"><?= $prefs ?></p3>
        <input type="hidden" name="prefs" id="prefs" value="<?= $prefs ?>">
    </div>
    
    <!-- 市区町村  -->
    <div class="form-group">
        <label class="form-check">住所(市区町村)</label>
        <p3 class="form-check"><?= $municipalities ?></p3>
        <input type="hidden" name="municipalities" id="municipalities" value="<?= $municipalities ?>">
    </div>
    
    <!-- 以降の住所  -->
    <div class="form-group">
        <label class="form-check">住所(それ以降の住所)</label>
        <p3 class="form-check"><?= $FurtherDivisions ?></p3>
        <input type="hidden" name="FurtherDivisions" id="FurtherDivisions" value="<?= $FurtherDivisions ?>">
    </div>
    
    <!-- 建物  -->
    <div class="form-group">
        <label class="form-check">住所(建物)</label>
        <p3 class="form-check"><?= $building ?></p3>
        <input type="hidden" name="building" id="building" value="<?= $building ?>">
    </div>
    
    <!-- お問い合わせ内容  -->
    <div class="form-group">
        <label class="form-check">お問い合わせ内容</label>
        <p3 class="form-check"><?= $comment ?></p3>
        <input type="hidden" name="comment" id="comment" value="<?= $comment ?>">
    </div>
    
    <!-- このサイトを知った経緯  -->
    <div class="form-group">
        <label class="form-check">このフォームを知った経由(複数選択可)</label>
        <p3 class="form-check">
            <?php if (isset($check) && is_array($check)) {$check = implode(', ',$check); echo $check;}?>
        </p3>
        <input name="check" type="hidden" value="<?= $check ?>">
    </div>
    <!-- 戻る、送信ボタン  -->
    <div align="center">
        <input class="button2" type="submit" name="back" value="戻る" />
        <input class="button1" type="submit" name="send" value="送信" />
    </div>
</div>
</form>



<?php } else if($mode == "input"){ ?>



<!-- 入力画面 -->
    <form action="./index.php" method="POST" id="input">
    <p class ="form-container"><sup class="red">*</sup>内容は必須項目です</p>

    <div class="form-container">
        <!-- 氏名を入力 -->
        <div class="form-group">
            <label for="fullname" class="form-label">氏名<sup class="red">*</sup></label>
            <input type="text"  id="fullname" name="fullname" class="form-input"  required>
        </div>

        <!-- フリガナを入力 -->
        <div class="form-group">
            <label for="Kana" class="form-label">フリガナ<sup class="red">*</sup></label>
            <input type="text" id="Kana" name="Kana" class="form-input" pattern="[\u30A1-\u30F6]*"  required>
        </div>

        <!-- メールアドレスを入力 -->
        <div class="form-group">
            <label for="email" class="form-label">メールアドレス<sup class="red">*</sup></label>
            <input type="email" id="email" name="email" class="form-input"  required> 
        </div>

        <!-- 性別を選択 -->
        <div class="form-group">
            <label for="gender" class="form-label">性別<sup class="red">*</sup></label>
                <input id="female" type="radio" name="gender" value="女性" required><label for="female">女性</label>
                <input id="male" type="radio" name="gender" value="男性" ><label for="male">男性</label>
        </div>

        <!-- 郵便番号を入力 -->
        <div class="form-group">
            <label for="zipcode" class="form-label">住所(郵便番号)<sup class="red">*</sup></label>
                <input type="text" id="zip1" name="zip1" class="form-input" maxlength="3" pattern="\d{3}" inputmode="numeric"  required>
                    <sup>-</sup>
                <input type="text" id="zip2" name="zip2" class="form-input" maxlength="4" pattern="\d{4}" inputmode="numeric"  required>
        </div>
        
        <!-- 都道府県を選択 -->
        <div class="form-group">
            <label for="prefs" class="form-label">住所(都道府県)<sup class="red">*</sup></label>
            <select name="prefs" class="form-input" style="max-width: 200px;" required>
            <option value="">選択してください</option>
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
        </div>

        <!-- 市区町村を入力 -->
        <div class="form-group">
            <label for="municipalities" class="form-label">住所(市区町村)<sup class="red">*</sup></label>
            <input type="text" id="municipalities" name="municipalities" class="form-input"  required>
        </div>

        <!-- 以降の住所を入力 -->
        <div class="form-group">
            <label for="FurtherDivisions" class="form-label">住所(それ以降の住所)<sup class="red">*</sup></label>
            <input type="text" id="FurtherDivisions" name="FurtherDivisions" class="form-input"  required>
        </div>

        <!-- 建物を入力 -->
        <div class="form-group">       
            <label for="building" class="form-label">住所(建物)<sup class="red">*</sup></label>
            <input type="text" id="building" name="building" class="form-input" required>
        </div>

        <!-- お問い合わせ内容を入力 -->
        <div class="form-group">
            <label for="comment" class="form-label">お問い合わせ内容<sup class="red">*</sup></label>
            <textarea type="text" id="comment" name="comment" class="commentArea" required></textarea>
        </div>
        <!-- 知った経緯を選択(任意) -->
        <div class="form-group">
        <label for="reason" class="form-label">このフォームを知った経由(複数選択可)</label>
            <checkArea>        
                <check><label for=""><input id="family" type="checkbox" name="check[]" value="家族から聞いて">家族から聞いて</label></check>
                <check><label for="friend"><input id="friend" type="checkbox" name="check[]" value="友達から聞いて">友達から聞いて</label></check>
                <check><label for="newspaper"><input id="newspaper" type="checkbox" name="check[]" value="新聞">新聞</label></check>
                <check><label for="Radio"><input id="Radio" type="checkbox" name="check[]" value="ラジオ">ラジオ</label></check>
                <check><label for="web"><input id="web" type="checkbox" name="check[]" value="web">web</label></check>
            </checkArea>
        </div>
        <!-- 確認画面に移行する -->
        <div align="center">
            <input class="button1" type="submit" value="確認" name="confirm">
        </div>
    </div>
</form>


<?php } else if($mode == "edit"){ ?>

<!-- 編集画面  -->
    <form action="./index.php" method="POST">
    <p class ="form-container"><sup class="red">*</sup>内容は必須項目です</p>

    <div class="form-container">
        <!-- 氏名を入力 -->
        <div class="form-group">
            <!--<?= var_dump($prefs) ?>-->
            <label for="fullname" class="form-label">氏名<sup class="red">*</sup></label>
            <input type="text"  id="fullname" name="fullname" class="form-input" value='<?= $fullname ?>' required>
        </div>

        <!-- フリガナを入力 -->
        <div class="form-group">
            <label for="Kana" class="form-label">フリガナ<sup class="red">*</sup></label>
            <input type="text" id="Kana" name="Kana" class="form-input" pattern="[\u30A1-\u30F6]*" value='<?= $Kana ?>' required>
        </div>

        <!-- メールアドレスを入力 -->
        <div class="form-group">
            <label for="email" class="form-label">メールアドレス<sup class="red">*</sup></label>
            <input type="email" id="email" name="email" class="form-input" value='<?= $email ?>' required> 
        </div>

        <!-- 性別を選択 -->
        <div class="form-group">
            <label for="gender" class="form-label">性別<sup class="red">*</sup></label>
                <input id="female" type="radio" name="gender" value="女性" <?php if(isset($gender) && $gender == '女性') echo 'checked'; ?>><label for="female">女性</label>
                <input id="male" type="radio" name="gender" value="男性" <?php if(isset($gender) && $gender == '男性') echo 'checked'; ?>><label for="male">男性</label>
                <script>
                    
                </script>
        </div>

        <!-- 郵便番号を入力 -->
        <div class="form-group">
            <label for="zipcode" class="form-label">住所(郵便番号)<sup class="red">*</sup></label>
                <input type="text" id="zip1" name="zip1" class="form-input" maxlength="3" pattern="\d{3}" inputmode="numeric" value='<?= $zip1 ?>' required>
                    <sup>-</sup>
                <input type="text" id="zip2" name="zip2" class="form-input" maxlength="4" pattern="\d{4}" inputmode="numeric" value='<?= $zip2 ?>' required>
        </div>

        <!-- 都道府県を選択 -->
        
        <div class="form-group">
            <label for="prefs" class="form-label">住所(都道府県)<sup class="red">*</sup></label>
            <select name="prefs" class="form-input" required>
            <option value="">選択してください</option>
            <option value="北海道"<?php if(isset($prefs) && $prefs == '北海道') echo 'selected'; ?>>北海道</option>
            <option value="青森県"<?php if(isset($prefs) && $prefs == '青森県') echo 'selected'; ?>>青森県</option>
            <option value="岩手県"<?php if(isset($prefs) && $prefs == '岩手県') echo 'selected'; ?>>岩手県</option>
            <option value="宮城県"<?php if(isset($prefs) && $prefs == '宮城県') echo 'selected'; ?>>宮城県</option>
            <option value="秋田県"<?php if(isset($prefs) && $prefs == '秋田県') echo 'selected'; ?>>秋田県</option>
            <option value="山形県"<?php if(isset($prefs) && $prefs == '山形県') echo 'selected'; ?>>山形県</option>
            <option value="福島県"<?php if(isset($prefs) && $prefs == '福島県') echo 'selected'; ?>>福島県</option>
            <option value="茨城県"<?php if(isset($prefs) && $prefs == '茨城県') echo 'selected'; ?>>茨城県</option>
            <option value="栃木県"<?php if(isset($prefs) && $prefs == '栃木県') echo 'selected'; ?>>栃木県</option>
            <option value="群馬県"<?php if(isset($prefs) && $prefs == '群馬県') echo 'selected'; ?>>群馬県</option>
            <option value="埼玉県"<?php if(isset($prefs) && $prefs == '埼玉県') echo 'selected'; ?>>埼玉県</option>
            <option value="千葉県"<?php if(isset($prefs) && $prefs == '千葉県') echo 'selected'; ?>>千葉県</option>
            <option value="東京都"<?php if(isset($prefs) && $prefs == '東京都') echo 'selected'; ?>>東京都</option>
            <option value="神奈川県"<?php if(isset($prefs) && $prefs == '神奈川県') echo 'selected'; ?>>神奈川県</option>
            <option value="新潟県"<?php if(isset($prefs) && $prefs == '新潟県') echo 'selected'; ?>>新潟県</option>
            <option value="富山県"<?php if(isset($prefs) && $prefs == '富山県') echo 'selected'; ?>>富山県</option>
            <option value="石川県"<?php if(isset($prefs) && $prefs == '石川県') echo 'selected'; ?>>石川県</option>
            <option value="福井県"<?php if(isset($prefs) && $prefs == '福井県') echo 'selected'; ?>>福井県</option>
            <option value="山梨県"<?php if(isset($prefs) && $prefs == '山梨県') echo 'selected'; ?>>山梨県</option>
            <option value="長野県"<?php if(isset($prefs) && $prefs == '長野県') echo 'selected'; ?>>長野県</option>
            <option value="岐阜県"<?php if(isset($prefs) && $prefs == '岐阜県') echo 'selected'; ?>>岐阜県</option>
            <option value="静岡県"<?php if(isset($prefs) && $prefs == '静岡県') echo 'selected'; ?>>静岡県</option>
            <option value="愛知県"<?php if(isset($prefs) && $prefs == '愛知県') echo 'selected'; ?>>愛知県</option>
            <option value="三重県"<?php if(isset($prefs) && $prefs == '三重県') echo 'selected'; ?>>三重県</option>
            <option value="滋賀県"<?php if(isset($prefs) && $prefs == '滋賀県') echo 'selected'; ?>>滋賀県</option>
            <option value="京都府"<?php if(isset($prefs) && $prefs == '京都府') echo 'selected'; ?>>京都府</option>
            <option value="大阪府"<?php if(isset($prefs) && $prefs == '大阪府') echo 'selected'; ?>>大阪府</option>
            <option value="兵庫県"<?php if(isset($prefs) && $prefs == '兵庫県') echo 'selected'; ?>>兵庫県</option>
            <option value="奈良県"<?php if(isset($prefs) && $prefs == '奈良県') echo 'selected'; ?>>奈良県</option>
            <option value="和歌山県"<?php if(isset($prefs) && $prefs == '和歌山県') echo 'selected'; ?>>和歌山県</option>
            <option value="鳥取県"<?php if(isset($prefs) && $prefs == '鳥取県') echo 'selected'; ?>>鳥取県</option>
            <option value="島根県"<?php if(isset($prefs) && $prefs == '島根県') echo 'selected'; ?>>島根県</option>
            <option value="岡山県"<?php if(isset($prefs) && $prefs == '岡山県') echo 'selected'; ?>>岡山県</option>
            <option value="広島県"<?php if(isset($prefs) && $prefs == '広島県') echo 'selected'; ?>>広島県</option>
            <option value="山口県"<?php if(isset($prefs) && $prefs == '山口県') echo 'selected'; ?>>山口県</option>
            <option value="徳島県"<?php if(isset($prefs) && $prefs == '徳島県') echo 'selected'; ?>>徳島県</option>
            <option value="香川県"<?php if(isset($prefs) && $prefs == '香川県') echo 'selected'; ?>>香川県</option>
            <option value="愛媛県"<?php if(isset($prefs) && $prefs == '愛媛県') echo 'selected'; ?>>愛媛県</option>
            <option value="高知県"<?php if(isset($prefs) && $prefs == '高知県') echo 'selected'; ?>>高知県</option>
            <option value="福岡県"<?php if(isset($prefs) && $prefs == '福岡県') echo 'selected'; ?>>福岡県</option>
            <option value="佐賀県"<?php if(isset($prefs) && $prefs == '佐賀県') echo 'selected'; ?>>佐賀県</option>
            <option value="長崎県"<?php if(isset($prefs) && $prefs == '長崎県') echo 'selected'; ?>>長崎県</option>
            <option value="熊本県"<?php if(isset($prefs) && $prefs == '熊本県') echo 'selected'; ?>>熊本県</option>
            <option value="大分県"<?php if(isset($prefs) && $prefs == '大分県') echo 'selected'; ?>>大分県</option>
            <option value="宮崎県"<?php if(isset($prefs) && $prefs == '宮崎県') echo 'selected'; ?>>宮崎県</option>
            <option value="鹿児島県"<?php if(isset($prefs) && $prefs == '鹿児島県') echo 'selected'; ?>>鹿児島県</option>
            <option value="沖縄県"<?php if(isset($prefs) && $prefs == '沖縄県') echo 'selected'; ?>>沖縄県</option>
            </select>
        </div>

        <!-- 市区町村を入力 -->
        <div class="form-group">
            <label for="municipalities" class="form-label">住所(市区町村)<sup class="red">*</sup></label>
            <input type="text" id="municipalities" name="municipalities" class="form-input" value='<?= $municipalities ?>' required>
        </div>

        <!-- 以降の住所を入力 -->
        <div class="form-group">
            <label for="FurtherDivisions" class="form-label">住所(それ以降の住所)<sup class="red">*</sup></label>
            <input type="text" id="FurtherDivisions" name="FurtherDivisions" class="form-input" value='<?= $FurtherDivisions ?>' required>
        </div>

        <!-- 建物を入力 -->
        <div class="form-group">       
            <label for="building" class="form-label">住所(建物)<sup class="red">*</sup></label>
            <input type="text" id="building" name="building" class="form-input" value='<?= $building ?>' required>
        </div>

        <!-- お問い合わせ内容を入力 -->
        <div class="form-group">
            <label for="comment" class="form-label">お問い合わせ内容<sup class="red">*</sup></label>
            <textarea type="text" id="comment" name="comment" class="commentArea"  required ></textarea>
            <script>
                document.getElementById("comment").value = '<?= $comment ?>' 
            </script>
        </div>
        <!-- 知った経緯を選択(任意) -->
        <div class="form-group">
        <label for="reason" class="form-label" >このフォームを知った経由(複数選択可)</label>
            <checkArea>  
                <check><label for="family"><input id="family" type="checkbox" name="check[]" value="家族から聞いて" <?php if(isset($check) && str_contains($check ,'家族から聞いて')) echo 'checked'; ?>>家族から聞いて</label></check>
                <check><label for="friend"><input id="friend" type="checkbox" name="check[]" value="友達から聞いて" <?php if(isset($check) && str_contains($check ,'友達から聞いて')) echo 'checked'; ?>>友達から聞いて</label></check>
                <check><label for="newspaper"><input id="newspaper" type="checkbox" name="check[]" value="新聞"<?php if(isset($check) && str_contains($check ,'新聞')) echo 'checked'; ?>>新聞</label></check>
                <check><label for="Radio"><input id="Radio" type="checkbox" name="check[]" value="ラジオ"<?php if(isset($check) && str_contains($check ,'ラジオ')) echo 'checked'; ?>>ラジオ</label></check>
                <check><label for="web"><input id="web" type="checkbox" name="check[]" value="web"<?php if(isset($check) && str_contains($check ,'web')) echo 'checked'; ?>>web</label></check>
            </checkArea>
        </div>
        <!-- 確認画面に移行する -->
        <div align="center">
            <input class="button1" type="submit" value="確認" name="confirm">
        </div>
    </div>
</form>

</body>
<?php }else{ ?>

<!-- 送信画面 -->
<?php


//登録する値を設定
$zip = $zip1 . '-' . $zip2; 
$checks = htmlspecialchars($check);
$mail = new PHPMailer(true);

//データベース接続
$dsn = 'mysql:dbname=bbs;host=db';
$user = 'user';
$password = 'password';
try {
    // パラメータをバインドする
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindValue(':kana', $Kana);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':gender', $gender);
    $stmt->bindValue(':zip', $zip);
    $stmt->bindValue(':prefs', $prefs);
    $stmt->bindValue(':municipalities', $municipalities);
    $stmt->bindValue(':FurtherDivisions', $FurtherDivisions);
    $stmt->bindValue(':building', $building);
    $stmt->bindValue(':comment', $comment);
    $stmt->bindValue(':checks', $checks);

    // ステートメントを実行
    $stmt->execute();

} catch (Exception $e) {
    echo "エラーが発生しました：" . $e->getMessage();
} finally {
    //文字エンコードを指定
    mb_language('Japanese');
    mb_internal_encoding('UTF-8');

    //SMTPサーバの設定
    $mail -> isSMTP();
    $mail -> Host = 'mail';
    $mail -> SMTPAuth = false;
    $mail -> SMTPSecure = false;
    $mail -> Port = 1025;

    //送受信先設定
    $mail -> addAddress($email, $fullname);
    
    //メールの件名
    $mail -> Subject = 'お問い合わせフォームからのメッセージ';

    $mail -> setFrom($email, $fullname);

    $mail -> Body ="
        氏名: $fullname
        フリガナ: $Kana
        メールアドレス: $email
        性別: $gender
        住所(郵便番号): $zip
        住所(都道府県): $prefs
        住所(市区町村): $municipalities
        住所(それ以降の住所): $FurtherDivisions
        住所(建物): $building
        お問い合わせ内容: $comment
        このフォームを知った経由: $checks";
    if ($mail->send()) {
        echo "ok";
    } else {
        echo "送信できませんでした";
    }

    // 接続を閉じる
    $pdo = null;
    
    exit();
}

?>

<?php } ?>

</html> 
