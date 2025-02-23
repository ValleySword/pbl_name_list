<?php
require 'db.php';

$id = trim($_POST['id']);
$name = trim($_POST['name']);
$grade = trim($_POST['grade']);
$faculty = trim($_POST['faculty']);
$comment = trim($_POST['comment']);
$team = trim($_POST['team']);

if (preg_match('/\/|\<|\>/', $name)) {
  $sym = array('<', '/', '>');
  $name = str_replace($sym, '', $name);
}

$photoPath = '';
$photoPath = 'images/' . $name . '.jpg';

if ($_FILES['photo']['tmp_name']) {
  unlink($photoPath);
  if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
      die("写真のアップロードに失敗しました。");
    }
  }
}

try {
  $stmt = $pdo->prepare('UPDATE users SET  grade = :grade, faculty = :faculty, comment = :comment, team = :team, photo = :photo WHERE id = :id'); // 現状画像のパスを変更できないため名前とパスは編集不可能
  $stmt->execute(array(':grade' => $grade, ':faculty' => $faculty, ':comment' => $comment, ':team' => $team, ':photo' => $photoPath, ':id' => $id));
  header("Location: list.php");
  exit;
} catch (PDOException $e) {
  echo "登録エラー: " . $e->getMessage();
}
