<?php
  $dsn = 'mysql:dbname=myapp_db;host=mysql;';
  $dbUser = 'root';
  $dbPass = 'rootpassword';

  try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    die("DB接続エラー: " . $e->getMessage());
  }
    
