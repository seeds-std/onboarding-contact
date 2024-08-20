<?php
// ファイルを読み込む
require_once 'private/bootstrap.php';
require_once 'private/database.php';

$connection = connectDB();

$sql = "SELECT * FROM contacts";

try {
    // SQLクエリを実行し、結果を取得する
    $result = $connection->query($sql);

    if (!$result) {
        throw new Exception("クエリの実行に失敗しました: " . $connection->error);
    }

    // データを連想配列として取得する
    $contacts = [];
    while ($row = $result->fetch_assoc()) {
        $contacts[] = $row;
    }

} catch (Exception $e) {
    die("エラーが発生しました: " . $e->getMessage());
} finally {
    // 接続を閉じる
    $connection->close();
}
?>

<style>
    td {
        text-align: center;
        padding-right: 8px;
        padding-left: 7px;
    }

    th {
        text-align: center;
        padding-right: 8px;
        padding-left: 7px;
    }
</style>

<html>
    <body>
        <!-- お問い合わせ内容を表示させる -->
        <table border="1" style="border-collapse: collapse">
            <tr>
                <th>名前</th> <th>性別</th> <th>お問い合わせ内容</th>
            </tr>
            <?php
            foreach ($contacts as $contact) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($contact['fullname'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($contact['gender'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($contact['comment'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </body>
</html>
