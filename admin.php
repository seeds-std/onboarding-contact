<?php

require_once 'private/bootstrap.php';
require_once 'private/database.php';

$db = connectDB();

$sql = "SELECT * FROM contacts ORDER BY created_at DESC";
$result = $db->query($sql);

$contacts_list = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $contacts_list[] = $row;
    }
}

$db->close();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ管理画面</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>お問い合わせ管理画面</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>作成日時</th>
                <th>氏名（フリガナ）</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>住所</th>
                <th>知った理由</th>
                <th>お問い合わせ内容</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts_list as $contact): ?>
            <tr>
                <td><?php echo htmlspecialchars($contact['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                
                <td><?php echo htmlspecialchars($contact['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                
                <td>
                    <?php echo htmlspecialchars($contact['name'], ENT_QUOTES, 'UTF-8'); ?><br>
                    <small>（<?php echo htmlspecialchars($contact['furigana'], ENT_QUOTES, 'UTF-8'); ?>）</small>
                </td>

                <td><?php echo htmlspecialchars($contact['gender'], ENT_QUOTES, 'UTF-8'); ?></td>

                <td><?php echo htmlspecialchars($contact['email'], ENT_QUOTES, 'UTF-8'); ?></td>

                <td>
                    〒<?php echo htmlspecialchars($contact['zip_code'], ENT_QUOTES, 'UTF-8'); ?><br>
                    <?php 
                    echo htmlspecialchars($contact['pref'], ENT_QUOTES, 'UTF-8');
                    echo htmlspecialchars($contact['city'], ENT_QUOTES, 'UTF-8');
                    echo htmlspecialchars($contact['address'], ENT_QUOTES, 'UTF-8');
                    if (!empty($contact['building'])) {
                        echo ' ' . htmlspecialchars($contact['building'], ENT_QUOTES, 'UTF-8');
                    }
                    ?>
                </td>

                <td><?php echo htmlspecialchars($contact['interest'], ENT_QUOTES, 'UTF-8'); ?></td>

                <td><?php echo nl2br(htmlspecialchars($contact['message'], ENT_QUOTES, 'UTF-8')); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>