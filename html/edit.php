<?php
require 'db.php';

if (!isset($_GET['id'])) {
  echo "idが指定されていません。";
  exit;
}
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
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
        <label for="name">名前</label><input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?>" hidden>
        名前は変更することが出来ないので、削除して作り直して下さい
      </div>
      <div class="form-group">
        <label for="grade">学籍番号（大文字）</label>
        <input type="text" id="grade" name="grade" pattern="^[A-Z0-9]+$" maxlength="6" value="<?php echo $user['grade']; ?>">
      </div>
      <div class="form-group">
        <label for="faculty">学部</label>
        <select id="faculty" name="faculty">
          <option value="<?php echo $user['faculty']; ?>" selected hidden><?php echo $user['faculty']; ?></option>
          <option>国際日本学部</option>
          <option>建築＆芸術学部</option>
          <option>現代社会学部</option>
          <option>経営学部</option>
          <option>健康栄養学部</option>
        </select>
      </div>
      <div class="form-group">
        <label for="department">コース</label>
        <select id="department" name="department" required>
          <option value="<?php echo $user['department']; ?>" selected hidden><?php echo $user['department']; ?></option>
          <!-- JavaScriptでオプションを挿入 -->
        </select>
      </div>
      <div class="form-group">
        <label for="comment">一言コメント（20字まで）</label>
        <textarea id="comment" name="comment" value="<?php echo $user['comment']; ?>" maxlength="20"><?php echo $user['comment']; ?></textarea>
      </div>
      <div class="form-group">
        <label for="team">グループ</label>
        <select id="team" name="team" required>
          <option value="<?php echo $user['team'] ?>" selected hidden><?php echo $user['team'] ?></option>
          <?php for ($i = 1; $i < 10; $i++): ?>
            <option><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="photo">写真（変更が必要な場合のみ）</label>
        <input type="file" id="photo" name="photo">
      </div>
      <div class="form-group">
        <button type="submit" class="btn-submit">編集
      </div>
    <?php endforeach; ?>
    <p class="back-link"><a href="list.php">一覧へ戻る</a></p>
  </form>
  <script>
    const departmentOptions = {
      "国際日本学部": [{
          value: "英語国際コミュニケーション専攻",
          text: "英語国際コミュニケーション専攻"
        },
        {
          value: "国際関係学専攻",
          text: "国際関係学専攻"
        },
        {
          value: "多文化共生専攻",
          text: "多文化共生専攻"
        },
        {
          value: "日本史専攻",
          text: "日本史専攻"
        },
        {
          value: "東洋史・西洋史専攻",
          text: "東洋史・西洋史専攻"
        },
        {
          value: "考古学・地理学専攻",
          text: "日本とアジアの文化・文学専攻"
        },
        {
          value: "日本語・日本語教育専攻",
          text: "日本語・日本語教育専攻"
        },
      ],
      "建築＆芸術学部": [{
          value: "インテリアデザイン専攻",
          text: "インテリアデザイン専攻"
        },
        {
          value: "デザイン・造形美術専攻",
          text: "デザイン・造形美術専攻"
        },
        {
          value: "マンガ制作専攻",
          text: "マンガ制作専攻"
        },
        {
          value: "映像・アニメーション専攻",
          text: "映像・アニメーション専攻"
        },
        {
          value: "映画・演劇専攻",
          text: "映画・演劇専攻"
        },
      ],
      "現代社会学部": [{
          value: "観光マネジメント専攻",
          text: "観光マネジメント専攻"
        },
        {
          value: "地域価値創造専攻",
          text: "地域価値創造専攻"
        },
        {
          value: "心理学専攻",
          text: "心理学専攻"
        },
        {
          value: "情報・コンピュータ専攻",
          text: "情報・コンピュータ専攻"
        },
        {
          value: "メディア・社会学専攻",
          text: "メディア・社会学専攻"
        },
      ],
      "経営学部": [{
        value: "経営学専攻",
        text: "経営学専攻"
      }, ],
      "健康栄養学部": [{
        value: "栄養学専攻",
        text: "栄養学専攻"
      }, ],
    };

    function updateDepartmentOptions() {
      const facultySelect = document.getElementById('faculty');
      const departmentSelect = document.getElementById('department');
      const selectedFaculty = facultySelect.value;

      // 初期化
      // departmentSelect.innerHTML = '<option value="" disabled selected hidden>選択してください</option>';

      if (departmentOptions[selectedFaculty]) {
        departmentOptions[selectedFaculty].forEach(opt => {
          const option = document.createElement('option');
          option.value = opt.value;
          option.text = opt.text;
          departmentSelect.appendChild(option);
        });
      }
    }

    // ページ読み込み時に、現在の学部の選択値に基づいて学科プルダウンを更新する
    document.addEventListener('DOMContentLoaded', function() {
      updateDepartmentOptions();
    });

    // 学部選択が変更されたときに更新する
    document.getElementById('faculty').addEventListener('change', updateDepartmentOptions);
  </script>
</main>
</body>

</html>