<?php
session_start();
if (!isset($_SESSION['login'])) {
  header('Location: login.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - Desa Mekarjaya</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      text-align: center;
      padding-top: 100px;
      font-family: Arial, sans-serif;
      background: #f0f8f5;
    }
    a {
      display: inline-block;
      margin: 10px;
      padding: 12px 18px;
      background: #006837;
      color: white;
      border-radius: 8px;
      text-decoration: none;
    }
    a:hover { background: #004d2a; }
  </style>
</head>
<body>
  <h1>🌾 Selamat Datang, <?= $_SESSION['user']; ?>!</h1>
  <p>Anda masuk sebagai Administrator Website Desa Mekarjaya.</p>
  <a href="admin.php">Kelola Berita</a>
  <a href="logout.php">Logout</a>
</body>
</html>
