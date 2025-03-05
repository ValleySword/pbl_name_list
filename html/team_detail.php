<?php
require 'db.php';

if (!isset($_GET['team'])) {
    echo "Teamが指定されていません。";
    exit;
}
$team = $_GET['team'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE team = ? ORDER BY name");   // 名前順にソート（深い意味はない）
$stmt->execute([$team]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$users) {
    echo "このチームのデータはありません。";
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($team, ENT_QUOTES, 'UTF-8'); ?> の詳細</title>
    <style>
        /* チーム詳細ページの簡単なスタイル */
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        /* 写真の列の幅を固定 */
        .photo-col {
            width: 240px;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <h2><?php echo htmlspecialchars($team, ENT_QUOTES, 'UTF-8'); ?>グループのメンバー</h2>
    <table>
        <tr>
            <th>名前</th>
            <th>学籍番号</th>
            <!-- <th>学部</th> スマホの画面幅の都合上非表示
            <th>コース</th> -->
            <th>一言コメント</th>
            <th class="photo-col">写真</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($user['grade'], ENT_QUOTES, 'UTF-8'); ?></td>
                <!-- <td><?php echo htmlspecialchars($user['faculty'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($user['department'], ENT_QUOTES, 'UTF-8'); ?></td> -->
                <td><?php echo htmlspecialchars($user['comment'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td>
                    <?php if (!empty($user['photo'])): ?>
                        <img src="<?php echo htmlspecialchars($user['photo'], ENT_QUOTES, 'UTF-8'); ?>" alt="photo">
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>