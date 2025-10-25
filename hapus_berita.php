<?php
include('config.php');

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM berita WHERE id_berita=$id");

echo "<script>alert('Berita berhasil dihapus!'); window.location='admin.php';</script>";
?>
