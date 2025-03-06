<?php
require 'db.php';

$sth = $pdo->query("SELECT * FROM users ORDER BY name");
$users = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'; ?>

<h1>生徒一覧</h1>
<table border="1">
  <tr>
    <th>名前</th>
    <th>学籍番号</th>
    <th>学部</th>
    <th>コース</th>
    <th>一言コメント</th>
    <th>グループ</th>
    <th>写真</th>
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
      <td><?php echo htmlspecialchars($user['team'], ENT_QUOTES, 'UTF-8'); ?></td>
      <td>
        <?php if (!empty($user['photo'])): ?>
          <img src="<?php echo htmlspecialchars($user['photo'], ENT_QUOTES, 'UTF-8'); ?>" alt="photo" style="width:200px;">
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
</body>

</html>