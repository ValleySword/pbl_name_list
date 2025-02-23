<?php
  $dsn = 'mysql:dbname=myapp_db;host=pbl_name_list-mysql-1;';
  $dbUser = 'root';
  $dbPass = 'rootpassword';

  try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    die("DB接続エラー: " . $e->getMessage());
  }
    