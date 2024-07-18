<?php
//ファイルを読み込む
require_once 'private/bootstrap.php';
require_once 'private/database.php';

// SQLクエリを準備
$sql = "SELECT * FROM contacts";

// クエリを実行し、結果を取得する
try {
    $stmt = $pdo->query($sql);
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("クエリの実行に失敗しました: " . $e->getMessage());
}

?>
<style>
        td{
            text-align: center;
            padding-right: 8px;
            padding-left: 7px;
        }

        th{
            text-align: center;
            padding-right: 8px;
            padding-left: 7px;
        }

    </style>
    
<html>
    <body>
        <!-- お問い合わせ内容を表示させる -->
        <table border = "1" style="border-collapse: collapse" >
            <tr>
                <th>名前</th> <th>性別</th> <th>お問い合わせ内容</th>
            </tr>
        <?php
        foreach ($contacts as $contact){
            echo "<tr>";
            echo "<td>" . $contact['fullname'] . "</td>";
            echo "<td>" . $contact['gender'] . "</td>";
            echo "<td>" . $contact['comment'] . "</td>";
            echo "</tr>";
        } ?>
        </table>
    </body>
</html>



