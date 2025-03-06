<?php
require 'db.php';

// team_detail.phpでデータを取得しているので、ここで取得する必要はない
// $stmt = $pdo->query("SELECT DISTINCT team FROM users ORDER BY team");
// $teamsFromDB = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include 'header.php'; ?>

<h1>グループ別一覧</h1>
<div class="grid-container">
    <?php for ($i = 1; $i < 10; $i++): ?>
        <button class="team-btn" onclick="openModal('<?php echo $i; ?>')">
            <?php echo $i; ?>グループ
        </button>
    <?php endfor; ?>
    <button class="team-btn" onclick="openModal('スタッフ')">スタッフ</button>
</div>
<!-- モーダルウィンドウ -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="modal-body">
            <!-- Ajaxでグループモーダルを表示 -->
        </div>
    </div>
</div>
<script>
    // Ajaxを利用して、指定したteamの詳細を取得する関数
    function openModal(team) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById('modal-body').innerHTML = xhr.responseText;
                    document.getElementById('myModal').style.display = "block";
                } else {
                    document.getElementById('modal-body').innerHTML = "データの取得に失敗しました。";
                    document.getElementById('myModal').style.display = "block";
                }
            }
        };
        // team_detail.php に team をGETパラメータとして送信
        xhr.open("GET", "team_detail.php?team=" + encodeURIComponent(team), true);
        xhr.send();
    }

    function closeModal() {
        document.getElementById('myModal').style.display = "none";
    }
    // モーダル外をクリックしたら閉じる
    window.onclick = function(event) {
        var modal = document.getElementById('myModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
</script>

</body>

</html>