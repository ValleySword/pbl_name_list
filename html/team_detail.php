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
        /* チーム詳細ページの基本スタイル */
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        /* テーブル全体を囲むラッパーを追加 */
        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 16px;
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

        /* スマホなどの小さい画面向けの調整 */
        @media screen and (max-width: 600px) {

            th,
            td {
                padding: 24px;
                /* パディングを小さく */
                font-size: 14px;
                /* フォントサイズを小さく */
            }

            /* テーブルが横にスクロールできるようにする */
            table {
                min-width: 700px;
            }
        }
    </style>

</head>

<body>
    <h2>
        <?php
        $teamEscaped = htmlspecialchars($team, ENT_QUOTES, 'UTF-8');
        if ($team === 'スタッフ') {
            echo $teamEscaped;
        } else {
            echo $teamEscaped . "グループのメンバー";
        }
        ?>
    </h2>
    <div class="table-wrapper">
        <table>
            <tr>
                <th>名前</th>
                <th>学籍番号</th>
                <th>学部</th>
                <th>コース</th>
                <th>一言コメント</th>
                <th class="photo-col">写真</th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($user['grade'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($user['faculty'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($user['department'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($user['comment'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <?php if (!empty($user['photo'])): ?>
                            <img src="<?php echo htmlspecialchars($user['photo'], ENT_QUOTES, 'UTF-8'); ?>" alt="photo">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="delete.php?id=<?php echo urlencode($user['id']); ?>" onclick="return confirm('本当に削除しますか？');">削除</a>
                    </td>
                    <td>
                        <a href="edit.php?id=<?php echo urlencode($user['id']); ?>">編集</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>