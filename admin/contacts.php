<?php
require_once './../private/bootstrap.php';
require_once './../private/database.php';

$connection = connectDB();
$sql = "SELECT * FROM contacts";
$statement = $connection->prepare($sql);
$statement->execute();
$contacts = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
$statement->close();

$sql = "SELECT * FROM sources";
$statement = $connection->prepare($sql);
$statement->execute();
$sources = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
$statement->close();
$connection->close();

foreach ($contacts as &$contact) {
    $contact['sources'] = [];
    foreach ($sources as $source) {
        if ($contact['id'] === $source['contact_id']) {
            $contact['sources'][] = $source['source'];
        }
    }
}
unset($contact); // 参照を解除

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>onboarding-contact</title>
</head>
    <style>
        .table-wrapper {
            display: flex;
            overflow-x: auto;
        }
        table {
            flex: 0 0 auto;
            border-collapse: collapse;
            min-width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            min-width: 40px;
            word-wrap: break-word;
            max-width: 500px;
        }
    </style>
<body>
    <h1>問い合わせ一覧</h1>
    <div class="table-wrapper">
        <table>
            <tr>
                <th>氏名</th>
                <th>フリガナ</th>
                <th>メールアドレス</th>
                <th>性別</th>
                <th>郵便番号</th>
                <th>都道府県</th>
                <th>市区町村</th>
                <th>それ以降の住所</th>
                <th>建物名</th>
                <th>お問い合わせ内容</th>
                <th>フォームを知った経由</th>
            </tr>
            <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td><?= htmlspecialchars($contact['name']) ?></td>
                    <td><?= htmlspecialchars($contact['kana']) ?></td>
                    <td><?= htmlspecialchars($contact['email']) ?></td>
                    <td><?= htmlspecialchars($contact['gender']) ?></td>
                    <td><?= htmlspecialchars($contact['zip_code']) ?></td>
                    <td><?= htmlspecialchars($contact['prefecture']) ?></td>
                    <td><?= htmlspecialchars($contact['address1']) ?></td>
                    <td><?= htmlspecialchars($contact['address2']) ?></td>
                    <td><?= htmlspecialchars($contact['building_name']) ?></td>
                    <td><?= nl2br(htmlspecialchars($contact['contact'])) ?></td>
                    <td>
                        <?php foreach ($contact['sources'] as $source): ?>
                            <?= htmlspecialchars($source) ?><br>
                        <?php endforeach; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
