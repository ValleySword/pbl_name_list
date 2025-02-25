<?php
require 'db.php';

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
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
  $photoPath = 'images/' . time() . $name . '.jpg';
  if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
    die("写真のアップロードに失敗しました。");
  }
}

try {
  $stmt = $pdo->prepare("INSERT INTO users (name, grade, faculty, comment, team, photo) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->execute([$name, $grade, $faculty, $comment, $team, $photoPath]);
  header("Location: list.php");
  exit;
} catch (PDOException $e) {
  echo "登録エラー: " . $e->getMessage();
}
