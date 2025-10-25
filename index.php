<?php
include('config.php');

// Tangkap keyword pencarian jika ada
$keyword = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Query berita
if ($keyword) {
    $query = "SELECT * FROM berita WHERE judul LIKE '%$keyword%' ORDER BY id_berita DESC";
} else {
    $query = "SELECT * FROM berita ORDER BY id_berita DESC";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Desa Mekarjaya – Berita & Informasi Desa</title>
<link rel="icon" type="image/png" href="img/favicon.png">
<style>
/* BODY & BACKGROUND */
body {
  font-family:"Poppins", sans-serif;
  margin:0; padding:0;
  background:url('img/kantor_desa.jpg') no-repeat center center fixed;
  background-size:cover;
  color:#fff;
  position:relative;
  overflow-x:hidden;
}
body::before {
  content:"";
  position:fixed;
  top:0; left:0;
  width:100%; height:100%;
  background:rgba(0,0,0,0.6);
  z-index:-1;
}

/* TOP BAR */
.top-bar {
  position:fixed;
  top:0; left:0;
  width:100%;
  display:flex;
  flex-wrap:wrap;
  justify-content:space-between;
  align-items:center;
  background:rgba(255,255,255,0.95);
  padding:10px 20px;
  z-index:999;
  box-shadow:0 2px 8px rgba(0,0,0,0.2);
}

/* HEADER */
header {
  display:flex;
  align-items:center;
  gap:10px;
}
header img { height:70px; transition: transform 0.3s ease; }
header img:hover { transform: scale(1.05); }
header .header-text h1 {
  font-size:1em;
  margin:0;
  color:#4B0082;
  line-height:1.2em;
}
header .header-text p {
  font-size:0.9em;
  margin:3px 0 0 0;
  color:#4B0082;
}

/* HAMBURGER */
.hamburger {
  display:none;
  font-size:28px;
  cursor:pointer;
  color:#4B0082;
}

/* NAVIGASI */
nav {
  position:relative;
  transition: max-height 0.4s ease;
}
nav ul {
  display:flex;
  list-style:none;
  margin:0;
  padding:0;
  flex-wrap:wrap;
}
nav ul li {
  position:relative;
}
nav ul li a {
  display:block;
  padding:8px 12px;
  color:white;
  background:#4B0082;
  margin:2px;
  border-radius:5px;
  text-decoration:none;
  font-weight:500;
  transition:0.3s;
}
nav ul li a:hover { background:#6A0DAD; }
nav ul li ul {
  display:none;
  position:absolute;
  top:100%;
  left:0;
  background:#4B0082;
  min-width:160px;
  border-radius:5px;
  flex-direction:column;
  opacity:0;
  transform:translateY(-10px);
  transition:0.3s ease-in-out;
  box-shadow:0 5px 15px rgba(0,0,0,0.4);
}
nav ul li:hover ul {
  display:flex;
  opacity:1;
  transform:translateY(0);
}

/* SEARCH BAR FIXED */
.search-bar {
  position:relative;
  display:flex;
  align-items:center;
  margin-left:auto;
  z-index:1000;
}
.search-bar input {
  flex:1;
  padding:6px 10px;
  border-radius:5px 0 0 5px;
  border:1px solid #ccc;
  z-index:1000;
}
.search-bar button {
  padding:6px 10px;
  border-radius:0 5px 5px 0;
  border:none;
  background:#4B0082;
  color:white;
  cursor:pointer;
  z-index:1000;
}
.search-bar button:hover { background:#6A0DAD; }

/* RUNNING TEXT / MARQUEE */
.marquee {
  overflow: hidden;
  white-space: nowrap;
  box-sizing: border-box;
  border: 2px solid rgba(0,255,234,0.5);
  padding: 10px;
  background: rgba(0,0,0,0.5);
  border-radius: 10px;
  max-width: 100%;
  margin:0 auto 40px auto;
}
.marquee span {
  display:inline-block;
  padding-left:100%;
  animation: marquee 15s linear infinite;
  color:#00ffea;
  font-size:1.2em;
  font-weight:bold;
}
@keyframes marquee {
  0% { transform: translateX(0); }
  100% { transform: translateX(-100%); }
}

/* MAIN CONTENT */
main {
  max-width:1000px;
  margin:150px auto 30px auto;
  padding:0 20px;
  overflow:auto;
  z-index:1;
}

.news {
  margin-bottom:50px;
}
.news h2 { color:#00ffea; margin-bottom:20px; text-align:center; text-shadow:1px 1px 5px #000; }
.news-list { display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:20px; }

/* NEWS ITEM ANIMASI */
.news-item {
  background:rgba(0,0,0,0.7);
  padding:15px;
  border-radius:10px;
  box-shadow:0 3px 10px rgba(0,0,0,0.3);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.news-item:hover {
  transform: translateY(-5px);
  box-shadow:0 10px 20px rgba(0,255,234,0.6);
}
.news-item img {
  width:100%;
  height:180px;
  object-fit:cover;
  border-radius:10px;
  margin-bottom:10px;
  cursor:pointer;
  transition: transform 0.3s ease;
}
.news-item img:hover { transform: scale(1.05); }
.news-item h3 { margin:10px 0 5px 0; color:#00ffea; font-size:1.2em; text-shadow:1px 1px 4px #000; }
.news-item p { font-size:0.95em; line-height:1.4em; margin-bottom:5px; text-align:justify; color:white; }
.news-item .date { font-size:0.85em; color:#ccc; }

/* MODAL */
.modal {
  display:none;
  position:fixed;
  z-index:9999;
  left:0; top:0;
  width:100%; height:100%;
  background:rgba(0,0,0,0.9);
  justify-content:center;
  align-items:center;
}
.modal-content { position:relative; width:90%; max-width:800px; }
.modal-content iframe, .modal-content video { width:100%; height:450px; border-radius:10px; }
.close-modal { position:absolute; top:10px; right:10px; color:white; font-size:28px; font-weight:bold; cursor:pointer; }

/* FOOTER */
footer { text-align:center; padding:20px; background:rgba(75,0,130,0.9); color:white; }

/* RESPONSIF */
@media(max-width:800px){
  .top-bar { flex-direction:column; align-items:flex-start; }
  .hamburger { display:block; margin-left:auto; }
  nav { width:100%; max-height:0; overflow:hidden; }
  nav.active { max-height:500px; }
  nav ul { flex-direction:column; width:100%; }
  nav ul li ul { position:relative; top:0; opacity:1; transform:none; }
  .search-bar { width:100%; margin-top:10px; }
  .search-bar input { width:80%; }
}
</style>
</head>
<body>

<div class="top-bar">
  <header>
    <img src="img/logo.png" alt="Logo Desa Mekarjaya">
    <div class="header-text">
      <h1>PEMERINTAH DESA MEKARJAYA</h1>
      <h1>KECAMATAN SUMEDANG UTARA KABUPATEN SUMEDANG</h1>
      <p>Website Resmi Pemerintah Desa Mekarjaya</p>
    </div>
  </header>

  <span class="hamburger" onclick="toggleMenu()">☰</span>

  <nav>
    <ul>
      <li><a href="index.php">Beranda</a></li>
      <li><a href="#">Data Aparatur</a>
        <ul>
          <li><a href="data_aparatur.php">Daftar Aparatur</a></li>
          <li><a href="struktur_aparatur.php">Struktur Organisasi</a></li>
        </ul>
      </li>
      <li><a href="#">Data RT/RW</a>
        <ul>
          <li><a href="data_rt_rw.php">Daftar RT/RW</a></li>
        </ul>
      </li>
      <li><a href="#">Data Penduduk</a>
        <ul>
          <li><a href="data_penduduk.php">Seluruh Penduduk</a></li>
          <li><a href="data_penduduk_rt.php">Penduduk per RT</a></li>
        </ul>
      </li>
      <li><a href="data_kemiskinan.php">Data Kemiskinan</a></li>
      <li><a href="data_infrastruktur.php">Data Infrastruktur</a></li>
      <li><a href="data_kelembagaan.php">Data Kelembagaan</a></li>
    </ul>
  </nav>

  <section class="search-bar">
    <form method="GET">
      <input type="text" name="search" placeholder="Cari berita..." value="<?= htmlspecialchars($keyword); ?>">
      <button type="submit">🔍</button>
    </form>
  </section>
</div>

<main>
  <!-- RUNNING TEXT -->
  <section class="welcome">
    <div class="marquee">
      <span>SELAMAT DATANG DI WEBSITE RESMI DESA MEKARJAYA KECAMATAN SUMEDANG UTARA KABUPATEN SUMEDANG.</span>
    </div>
  </section>

  <!-- BERITA -->
  <section class="news">
    <h2>📰 Berita Terbaru</h2>
    <div class="news-list">
      <?php if(mysqli_num_rows($result) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
          <div class="news-item">
            <?php if (!empty($row['gambar'])): ?>
              <img src="img/berita/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['judul']); ?>"
              <?php if(!empty($row['video'])) echo "onclick=\"openModal('{$row['video']}')\""; ?>>
            <?php endif; ?>
            <?php if (!empty($row['video']) && empty($row['gambar'])): ?>
              <?php
                if (strpos($row['video'], 'youtube.com') !== false || strpos($row['video'], 'youtu.be') !== false) {
                  preg_match('/(youtu\.be\/|v=)([a-zA-Z0-9_-]{11})/', $row['video'], $matches);
                  $youtube_id = $matches[2] ?? '';
                  echo "<img src='https://img.youtube.com/vi/{$youtube_id}/hqdefault.jpg' alt='Video {$row['judul']}' onclick=\"openModal('{$row['video']}')\">";
                } else {
                  echo "<video controls><source src='img/berita/".htmlspecialchars($row['video'])."' type='video/mp4'></video>";
                }
              ?>
            <?php endif; ?>
            <h3><?= htmlspecialchars($row['judul']); ?></h3>
            <p><?= isset($row['isi']) ? nl2br(htmlspecialchars($row['isi'])) : ''; ?></p>
            <span class="date">📅 <?= date('d M Y', strtotime($row['tanggal'])); ?></span>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p style="text-align:center; font-style:italic;">Berita tidak ditemukan.</p>
      <?php endif; ?>
    </div>
  </section>
</main>

<!-- MODAL -->
<div id="videoModal" class="modal" onclick="closeModal()">
  <div class="modal-content" onclick="event.stopPropagation()">
    <span class="close-modal" onclick="closeModal()">&times;</span>
    <div id="modalVideoContainer"></div>
  </div>
</div>

<footer>
  <p>© <?= date('Y'); ?> Pemerintah Desa Mekarjaya | Created by AS Sekretaris Desa Mekarjaya</p>
</footer>

<script>
function openModal(videoUrl){
  let container = document.getElementById('modalVideoContainer');
  container.innerHTML='';
  if(videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')){
    let id = videoUrl.split('v=')[1] || videoUrl.split('youtu.be/')[1];
    if(id.includes('&')) id=id.split('&')[0];
    container.innerHTML=`<iframe src="https://www.youtube.com/embed/${id}" frameborder="0" allowfullscreen></iframe>`;
  } else {
    container.innerHTML=`<video controls autoplay><source src='img/berita/${videoUrl}' type='video/mp4'></video>`;
  }
  document.getElementById('videoModal').style.display='flex';
}
function closeModal(){
  document.getElementById('videoModal').style.display='none';
  document.getElementById('modalVideoContainer').innerHTML='';
}
function toggleMenu(){
  document.querySelector('nav').classList.toggle('active');
}
</script>

</body>
</html>
