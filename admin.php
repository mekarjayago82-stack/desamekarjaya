<?php
session_start();
include('config.php');

// Proteksi login + pastikan session lengkap
if (
    !isset($_SESSION['login']) || $_SESSION['login'] !== true ||
    !isset($_SESSION['user']) || !isset($_SESSION['level'])
) {
    header('Location: login.php');
    exit;
}

// Ambil data berita
$query = "SELECT * FROM berita ORDER BY id_berita DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal dijalankan: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - Kelola Berita Desa Mekarjaya</title>
<link rel="stylesheet" href="style.css">
<style>
body { font-family: "Poppins", sans-serif; background: #f4f6f8; color: #333; }
header { background: #006837; color: white; padding: 20px; text-align: center; }
main { max-width: 900px; margin: 40px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
th { background: #006837; color: white; }
tr:nth-child(even) { background: #f2f2f2; }
a.btn { display: inline-block; padding: 8px 14px; color: white; border-radius: 6px; text-decoration: none; font-size: 14px; }
a.tambah { background: #006837; }
a.edit { background: #ff9800; }
a.hapus { background: #f44336; }
.topbar { display: flex; justify-content: space-between; align-items: center; }
.logout { background: #444; color: white; padding: 8px 14px; border-radius: 5px; text-decoration: none; }
</style>
</head>
<body>
<header>
<h1>📰 Panel Admin Desa Mekarjaya</h1>
</header>

<main>
<div class="topbar">
  <h2>Kelola Berita</h2>
  <div>
    <span>
      Halo, <?= htmlspecialchars($_SESSION['user'] ?? 'Admin'); ?> 
      (<?= htmlspecialchars($_SESSION['level'] ?? 'Desa'); ?>)
    </span>
    <a href="logout.php" class="logout">🚪 Logout</a>
  </div>
</div>

<a href="tambah_berita.php" class="btn tambah">➕ Tambah Berita</a>

<table>
<tr>
  <th>No</th>
  <th>Judul</th>
  <th>Tanggal</th>
  <th>Gambar</th>
  <th>Video</th>
  <th>Aksi</th>
</tr>

<?php 
$no = 1;
while ($row = mysqli_fetch_assoc($result)): 
?>
<tr>
  <td><?= $no++; ?></td>
  <td><?= htmlspecialchars($row['judul']); ?></td>
  <td><?= htmlspecialchars($row['tanggal']); ?></td>
  <td>
    <?php if (!empty($row['gambar'])): ?>
      <img src="uploads/<?= htmlspecialchars($row['gambar']); ?>" width="80">
    <?php else: ?>
      <em>-</em>
    <?php endif; ?>
  </td>
  <td>
    <?php if (!empty($row['video'])): ?>
      <video width="100" controls>
        <source src="uploads/<?= htmlspecialchars($row['video']); ?>" type="video/mp4">
      </video>
    <?php else: ?>
      <em>-</em>
    <?php endif; ?>
  </td>
  <td>
    <a href="edit_berita.php?id=<?= $row['id_berita']; ?>" class="btn edit">✏️ Edit</a>
    <a href="hapus_berita.php?id=<?= $row['id_berita']; ?>" class="btn hapus" onclick="return confirm('Yakin mau hapus berita ini?')">🗑️ Hapus</a>
  </td>
</tr>
<?php endwhile; ?>
</table>
</main>
</body>
</html>
