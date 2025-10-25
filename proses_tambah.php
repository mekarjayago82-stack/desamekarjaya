<?php
include('config.php');

if (isset($_POST['submit'])) {
  $judul   = $_POST['judul'];
  $isi     = $_POST['isi'];
  $tanggal = $_POST['tanggal'];
  $video   = $_POST['video'];

  // ==== Upload Gambar ====
  $namaFile = "";
  if (!empty($_FILES['gambar']['name'])) {
    $targetDir = "img/berita/";
    if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);

    $namaFile = time() . '_' . basename($_FILES['gambar']['name']);
    $targetFile = $targetDir . $namaFile;
    move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile);
  }

  // ==== Simpan ke Database ====
  $query = "INSERT INTO berita (judul, isi, gambar, video, tanggal) 
            VALUES ('$judul', '$isi', '$namaFile', '$video', '$tanggal')";

  if (mysqli_query($conn, $query)) {
    header('Location: admin.php');
  } else {
    echo "Gagal menyimpan berita: " . mysqli_error($conn);
  }
}
?>
