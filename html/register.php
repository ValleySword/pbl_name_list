<?php include 'header.php'; ?>

<main class="container">
  <h1>ユーザー登録</h1>
  <form action="process_register.php" method="post" enctype="multipart/form-data" class="form">
    <div class="form-group">
      <label for="name">名前</label>
      <input type="text" id="name" name="name" required>
    </div>
    <div class="form-group">
      <label for="grade">学籍番号（大文字）</label>
      <input type="text" id="grade" name="grade" pattern="^[A-Z0-9]+$" maxlength="6" required>
    </div>
    <div class="form-group">
      <label for="faculty">学部</label>
      <select id="faculty" name="faculty" required>
        <option value="" disabled selected hidden>選択してください</option>
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
      <textarea id="comment" name="comment" maxlength="20"></textarea>
    </div>
    <div class="form-group">
      <label for="team">グループ</label>
      <select id="team" name="team" required>
        <option value="" disabled selected hidden>選択してください</option>
        <?php for ($i = 1; $i < 10; $i++): ?>
          <option><?php echo $i; ?></option>
        <?php endfor; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="photo">写真</label><input type="file" id="photo" name="photo">
    </div>
    <div class="form-group">
      <button type="submit" class="btn-submit">登録
    </div>

  </form>
  <p class="back-link"><a href="list.php">一覧へ戻る</a></p>
</main>
</body>

</html>