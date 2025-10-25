<?php
session_start();
include('config.php');

// Kalau sudah login, langsung ke admin
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header('Location: admin.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // MD5 sesuai DB

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    if ($query && mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['login'] = true;
        $_SESSION['user'] = $data['nama_lengkap'];
        $_SESSION['level'] = $data['level'];
        $_SESSION['username'] = $data['username'];
        header('Location: admin.php');
        exit; // wajib!
    } else {
        $error = "❌ Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Admin - Desa Mekarjaya</title>
<link rel="stylesheet" href="style.css">
<style>
body { background: #f0f8f5; font-family: "Poppins", sans-serif; }
.login-container {
  width: 350px; margin: 100px auto; padding: 25px;
  background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); text-align: center;
}
h2 { color: #006837; margin-bottom: 20px; }
input { width: 90%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 8px; }
button { background: #006837; color: white; border: none; padding: 10px 15px; border-radius: 8px; cursor: pointer; width: 100%; }
button:hover { background: #004d2a; }
.error { color: red; margin-top: 10px; }
</style>
</head>
<body>
<div class="login-container">
  <h2>🔐 Login Admin</h2>
  <form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Masuk</button>
  </form>
  <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
</div>
</body>
</html>
