<?php
require 'db.php';

if (!isset($_GET['id'])) {
  echo "idが指定されていません。";
  exit;
}
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");   // 名前順にソート（深い意味はない）
$stmt->execute([$id]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'; ?>

<main class="container">
  <h1>ユーザー編集</h1>
  <form action="process_edit.php" method="post" enctype="multipart/form-data" class="form">
    <?php foreach ($users as $user): ?>
      <input type="text" name="id" value="<?php echo $user['id'] ?>" hidden>
      <!-- 現状名前は編集不可 -->
      <div class="form-group">
        <label for="name">名前:</label><input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?>" required hidden>
        名前は変更することが出来ないので、削除して作り直して下さい
      </div>
      <div class="form-group">
        <label for="grade">学年:</label>
        <select id="grade" name="grade" required>
          <option value="<?php echo $user['grade']; ?>" selected hidden><?php echo $user['grade']; ?></option>
          <?php for ($i = 1; $i < 5; $i++): ?>
            <option><?php echo $i; ?>回生</option>
          <?php endfor; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="faculty">学部:</label>
        <select id="faculty" name="faculty" required>
          <option value="<?php echo $user['faculty']; ?>" selected hidden><?php echo $user['faculty']; ?></option>
          <option>国際日本学部</option>
          <option>建築＆芸術学部</option>
          <option>現代社会学部</option>
          <option>経営学部</option>
          <option>健康栄養学部</option>
          <option>国際看護学部</option>
        </select>
      </div>
      <div class="form-group">
        <label for="comment">一言コメント（20字まで）</label>
        <textarea id="comment" name="comment" value="<?php echo $user['comment']; ?>"><?php echo $user['comment']; ?></textarea>
      </div>
      <div class="form-group">
        <label for="team">グループ:</label>
        <select id="team" name="team" required>
          <option value="<?php echo $user['team'] ?>" selected hidden><?php echo $user['team'] ?></option>
          <?php for ($i = 1; $i < 10; $i++): ?>
            <option><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="photo">写真:</label>
        <input type="file" id="photo" name="photo">
      </div>
      <div class="form-group">
        <button type="submit" class="btn-submit">編集
      </div>
    <?php endforeach; ?>
    <p class="back-link"><a href="list.php">一覧へ戻る</a></p>
  </form>
</main>
</body>

</html>