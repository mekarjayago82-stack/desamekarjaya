<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $judul = $_POST['judul'];
  $isi = $_POST['isi'];
  $video = $_POST['video'];

  // Upload gambar
  $gambar = '';
  if (!empty($_FILES['gambar']['name'])) {
    $target_dir = "img/berita/";
    $gambar = basename($_FILES["gambar"]["name"]);
    $target_file = $target_dir . $gambar;
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
  }

  $query = "INSERT INTO berita (judul, isi, gambar, video, tanggal) 
            VALUES ('$judul', '$isi', '$gambar', '$video', CURDATE())";

  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Berita berhasil ditambahkan!'); window.location='admin.php';</script>";
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Berita - Desa Mekarjaya</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>📝 Tambah Berita Baru</h2>
  <form action="" method="POST" enctype="multipart/form-data" class="form">
    <label>Judul Berita</label>
    <input type="text" name="judul" required>

    <label>Isi Berita</label>
    <textarea name="isi" rows="6" required></textarea>

    <label>Upload Gambar</label>
    <input type="file" name="gambar" accept="image/*">

    <label>Link Video (YouTube)</label>
    <input type="url" name="video" placeholder="https://youtube.com/...">

    <button type="submit">💾 Simpan Berita</button>
  </form>
</body>
</html>
