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
        <option value="国際日本学部">国際日本学部</option>
        <option value="建築＆芸術学部">建築＆芸術学部</option>
        <option value="現代社会学部">現代社会学部</option>
        <option value="経営学部">経営学部</option>
        <option value="健康栄養学部">健康栄養学部</option>
        <option value="国際看護学部">国際看護学部</option>
      </select>
    </div>
    <div class="form-group">
      <label for="department">コース</label>
      <select id="department" name="department" required>
        <option value="" disabled selected hidden>選択してください</option>
        <!-- JavaScriptでオプションを挿入 -->
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
      "国際看護学部": [{
        value: "看護学専攻",
        text: "看護学専攻"
      }, ],
    };

    // DOMが読み込まれたら処理を開始
    document.addEventListener('DOMContentLoaded', function() {
      const facultySelect = document.getElementById('faculty');
      const departmentSelect = document.getElementById('department');

      // 学部の選択が変更された場合のイベントリスナーを設定
      facultySelect.addEventListener('change', function() {
        const selectedFaculty = facultySelect.value;

        // 第2のプルダウンのオプションを一旦クリア
        departmentSelect.innerHTML = '<option value="" disabled selected hidden>選択してください</option>';

        // 定義した学科選択肢があれば、その内容を挿入
        if (departmentOptions[selectedFaculty]) {
          departmentOptions[selectedFaculty].forEach(function(opt) {
            const option = document.createElement('option');
            option.value = opt.value;
            option.text = opt.text;
            departmentSelect.appendChild(option);
          });
        }
      });
    });
  </script>
</main>
</body>

</html>