CREATE DATABASE IF NOT EXISTS desa_mekarjaya;
USE desa_mekarjaya;

DROP TABLE IF EXISTS berita;
CREATE TABLE berita (
  id_berita INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(255),
  isi TEXT,
  tanggal DATE DEFAULT CURRENT_DATE
);

INSERT INTO berita (judul, isi, tanggal) VALUES
('Pelatihan UMKM Desa', 'Pemerintah Desa menyelenggarakan pelatihan untuk meningkatkan keterampilan masyarakat.', '2025-10-01'),
('Kegiatan Posyandu Bulanan', 'Kegiatan posyandu rutin untuk memantau tumbuh kembang anak-anak dan kesehatan ibu hamil.', '2025-10-10'),
('Pembangunan Jalan Desa Dimulai', 'Pemerintah Desa Mekarjaya mulai melaksanakan pembangunan jalan lingkungan.', '2025-10-15');

-- Tabel admin untuk login multi user
CREATE TABLE IF NOT EXISTS admin (
  id_admin INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nama_lengkap VARCHAR(100),
  level ENUM('Super Admin','Admin') DEFAULT 'Admin'
);

-- Tambahkan akun admin default
INSERT INTO admin (username, password, nama_lengkap, level)
VALUES
('admin', MD5('mekarjaya123'), 'Administrator Desa', 'Super Admin');

