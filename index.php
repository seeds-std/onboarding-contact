<?php
/* ----------------------------------------
 * 必要なファイルを読み込む
 * ---------------------------------------- */
require_once 'private/bootstrap.php';
require_once 'private/database.php';
require      'vendor/autoload.php';


//実装 
/* ----------------------------------------
 * それぞれの画面が遷移する
 * ---------------------------------------- */


$mode = "input";

if( isset($_POST["back"] ) && $_POST["back"] ){
    //確認から入力に
    $mode ="input";
} else if( isset($_POST["confirm"] ) && $_POST["confirm"] ){
    //入力から確認に
    $mode = "confirm";
}

/* ----------------------------------------
 * 送信された内容を代入する
 * ---------------------------------------- */
if(isset($_POST['fullname'])){
    $fullname = ($_POST['fullname']);
}

if(isset($_POST['kana'])){
    $kana = ($_POST['kana']);
}

if(isset($_POST['email'])){
    $email = ($_POST['email']);
}

if(isset($_POST['gender'])){
    $gender = $_POST['gender'];
}

if(isset($_POST['zip1'])){
    $zip1 = ($_POST['zip1']);
}

if(isset($_POST['zip2'])){
    $zip2 = ($_POST['zip2']);
}

if(isset($_POST['prefs'])){
    $prefs = ($_POST['prefs']);
}

if(isset($_POST['municipalities'])){
    $municipalities = ($_POST['municipalities']);
}

if(isset($_POST['furtherDivisions'])){
    $furtherDivisions = ($_POST['furtherDivisions']);
}

if(isset($_POST['building'])){
    $building = ($_POST['building']);
}

if(isset($_POST['comment'])){
    $comment = ($_POST['comment']);
}

if(isset($_POST['discoveryReason'])){
    $discoveryReason = $_POST['discoveryReason'];
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

    .checkArea{
        margin-top: 5px;
        display: block;
        width: auto;
        text-align: right;
    }

    .check{
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
<!-- 確認画面 -->
<?php if($mode == "confirm"){ 
    include('confirm_form.php') ?>

<!-- 入力画面 -->
<?php } else if($mode == "input"){ 
    include('input_form.php'); ?>

<?php } ?>

</html> 
