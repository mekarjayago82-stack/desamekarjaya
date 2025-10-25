body {
  margin: 0;
  font-family: "Poppins", sans-serif;
  background: #f7f9fb;
  color: #333;
}

/* ===== HEADER ===== */
header {
  background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.6)), url('img/header.jpg') center/cover no-repeat;
  color: white;
  text-align: center;
  padding: 100px 20px;
}

header h1 {
  font-size: 52px;
  margin: 0;
  text-shadow: 2px 2px 6px rgba(0,0,0,0.4);
}

header p {
  font-size: 20px;
  margin-top: 10px;
  color: #e8e8e8;
}

/* ===== MAIN ===== */
main {
  max-width: 950px;
  margin: 50px auto;
  padding: 0 20px;
}

.welcome {
  text-align: center;
  margin-bottom: 60px;
}

.welcome h2 {
  color: #006837;
  font-size: 28px;
  margin-bottom: 10px;
}

/* ===== BERITA ===== */
.news h2 {
  border-left: 6px solid #006837;
  padding-left: 12px;
  color: #333;
  margin-bottom: 25px;
}

.news-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 25px;
}

.news-item {
  background: white;
  padding: 25px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.news-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 16px rgba(0,0,0,0.15);
}

.news-item h3 {
  margin-top: 0;
  color: #006837;
  font-size: 20px;
}

.news-item p {
  line-height: 1.6;
}
.news-item img {
  width: 100%;
  height: 180px;
  object-fit: cover;
  border-radius: 10px;
  margin-bottom: 10px;
}

.video-container {
  margin-top: 10px;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.date {
  display: inline-block;
  margin-top: 12px;
  font-size: 14px;
  color: #777;
}

/* ===== FOOTER ===== */
footer {
  background: #006837;
  color: white;
  text-align: center;
  padding: 20px;
  margin-top: 60px;
  font-size: 14px;
  letter-spacing: 0.3px;
}

/* ================= ADMIN PANEL ================= */
.login-container, .form-container {
  max-width: 400px;
  margin: 100px auto;
  background: white;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.login-container h2, .form-container h2 {
  text-align: center;
  color: #006837;
}

input, textarea {
  width: 100%;
  padding: 10px;
  margin-top: 8px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

button, .btn {
  background: #006837;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  text-decoration: none;
}

button:hover, .btn:hover {
  background: #004d29;
}

.admin-header {
  background: #006837;
  color: white;
  padding: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.btn-logout {
  background: #e74c3c;
  color: white;
  padding: 8px 15px;
  border-radius: 5px;
  text-decoration: none;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

table th, table td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: left;
}

table th {
  background: #f0f0f0;
}

.btn-tambah, .btn-edit, .btn-hapus {
  padding: 6px 12px;
  border-radius: 6px;
  text-decoration: none;
  color: white;
  font-weight: bold;
}

.btn-tambah { background: #2b9348; }
.btn-edit { background: #0077b6; }
.btn-hapus { background: #d00000; }
.btn-hapus:hover { background: #9a0000; 
}

