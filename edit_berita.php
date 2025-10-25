<?php
include('config.php');

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM berita WHERE id_berita=$id");
$data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $judul = $_POST['judul'];
  $isi = $_POST['isi'];
  $video = $_POST['video'];

  $gambar = $data['gambar'];
  if (!empty($_FILES['gambar']['name'])) {
    $target_dir = "img/berita/";
    $gambar = basename($_FILES["gambar"]["name"]);
    $target_file = $target_dir . $gambar;
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
  }

  $query = "UPDATE berita SET 
              judul='$judul', 
              isi='$isi', 
              gambar='$gambar', 
              video='$video' 
            WHERE id_berita=$id";

  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Berita berhasil diperbarui!'); window.location='admin.php';</script>";
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Berita - Desa Mekarjaya</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>✏️ Edit Berita</h2>
  <form action="" method="POST" enctype="multipart/form-data" class="form">
    <label>Judul Berita</label>
    <input type="text" name="judul" value="<?= $data['judul']; ?>" required>

    <label>Isi Berita</label>
    <textarea name="isi" rows="6" required><?= $data['isi']; ?></textarea>

    <label>Gambar Saat Ini:</label><br>
    <?php if ($data['gambar']): ?>
      <img src="img/berita/<?= $data['gambar']; ?>" width="200"><br>
    <?php endif; ?>

    <label>Ganti Gambar (Opsional)</label>
    <input type="file" name="gambar" accept="image/*">

    <label>Link Video (YouTube)</label>
    <input type="url" name="video" value="<?= $data['video']; ?>">

    <button type="submit">💾 Simpan Perubahan</button>
  </form>
</body>
</html>
