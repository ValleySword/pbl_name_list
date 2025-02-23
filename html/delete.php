<?php
require 'db.php';

if (!isset($_GET['id'])) {
  die('不正なリクエストです。');
}

$id = $_GET['id'];

if (!filter_var($id, FILTER_VALIDATE_INT)) {
  die('不正なデータです。');
}

try {
  // 画像削除処理
  $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
  $stmt->execute([$id]);
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $path = $users[0]["photo"];
  unlink($path);

  $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
  $stmt->execute([$id]);
} catch (PDOException $e) {
  die("削除エラー: " . $e->getMessage());
}

header("Location: list.php");
exit;
