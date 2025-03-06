<?php
require 'db.php';

$name      = isset($_POST['name']) ? trim($_POST['name']) : '';
$grade     = isset($_POST['grade']) ? trim($_POST['grade']) : '';
$faculty   = isset($_POST['faculty']) ? trim($_POST['faculty']) : '';
$department = isset($_POST['department']) ? trim($_POST['department']) : '';
$comment   = isset($_POST['comment']) ? trim($_POST['comment']) : '';
$team = isset($_POST['team']) ? trim($_POST['team']) : '';

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
  header("Location: team_list.php");
  exit;
} catch (PDOException $e) {
  echo "登録エラー: " . $e->getMessage();
}
