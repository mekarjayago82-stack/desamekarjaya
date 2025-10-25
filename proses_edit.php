<?php
include('config.php');

if (isset($_POST['submit'])) {
  $id       = $_POST['id'];
  $judul    = $_POST['judul'];
  $isi      = $_POST['isi'];
  $tanggal  = $_POST['tanggal'];
  $video    = $_POST['video'];

  // Upload gambar baru (jika ada)
  $gambarBaru = "";
  if (!empty($_FILES['gambar']['name'])) {
    $targetDir = "img/berita/";
    if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);

    $gambarBaru = time() . '_' . basename($_FILES['gambar']['name']);
    $targetFile = $targetDir . $gambarBaru;
    move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile);

    // Hapus gambar lama
    $qOld = mysqli_query($conn, "SELECT gambar FROM berita WHERE id_berita = '$id'");
    $old = mysqli_fetch_assoc($qOld);
    if (!empty($old['gambar']) && file_exists("img/berita/" . $old['gambar'])) {
      unlink("img/berita/" . $old['gambar']);
    }

    $updateGambar = ", gambar = '$gambarBaru'";
  } else {
    $updateGambar = "";
  }

  // Update database
  $query = "UPDATE berita SET 
              judul = '$judul',
              isi = '$isi',
              video = '$video',
              tanggal = '$tanggal'
              $updateGambar
            WHERE id_berita = '$id'";

  if (mysqli_query($conn, $query)) {
    header('Location: admin.php');
  } else {
    echo "Gagal memperbarui berita: " . mysqli_error($conn);
  }
}
?>
