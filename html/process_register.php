<?php
require 'db.php';

$name = trim($_POST['name']);
$grade = trim($_POST['grade']);
$department = trim($_POST['department']);
$faculty = trim($_POST['faculty']);
$comment = trim($_POST['comment']);
$team = trim($_POST['team']);

if (preg_match('/\/|\<|\>/', $name)) {
  $sym = array('<', '/', '>');
  $name = str_replace($sym, '', $name);
}

if (!is_dir('images/')) {
  if (!mkdir('images/', 0755, true)) {
    die("画像アップロード用ディレクトリの作成に失敗しました。");
  }
}

$photoPath = '';
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
  $photoPath = 'images/' . $name . '.jpg';
  if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
    die("写真のアップロードに失敗しました。");
  }
}

try {
  $stmt = $pdo->prepare("INSERT INTO users (name, grade, faculty, department, comment, team, photo) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->execute([$name, $grade, $faculty, $department, $comment, $team, $photoPath]);
  header("Location: list.php");
  exit;
} catch (PDOException $e) {
  echo "登録エラー: " . $e->getMessage();
}
