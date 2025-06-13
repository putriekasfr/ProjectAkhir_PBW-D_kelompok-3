<?php
include "koneksi.php";
include "./session_.php";
if (!isset($_SESSION['username'])) {
  header("location:./login.php");
  exit();
}
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Pendaftaran Ekstrakurikuler</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9f9f9;
    }
    .container {
      margin-top: 50px;
      margin-bottom: 50px;
    }
    .form-container {
      background-color: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .btn-warning {
      background-color: #f6b93b;
      border: none;
      color: white;
    }
    .btn-warning:hover {
      background-color: #e89c00;
      color: white;
    }
    .form-title {
      font-weight: 600;
      margin-bottom: 25px;
      color: #27496d;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="form-container">
    <h4 class="form-title text-center">Formulir Pendaftaran Ekstrakurikuler</h4>
    <form action="proses_pendaftaran.php" method="post">
      <div class="form-group">
        <label for="nama">Nama Lengkap:</label>
        <input type="text" name="nama" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="jurusan">Jurusan:</label>
        <select name="jurusan" class="form-control" required>
          <option value="">-- Pilih Jurusan --</option>
          <?php
            $result = mysqli_query($koneksi, "SELECT * FROM jurusan");
            while ($data = mysqli_fetch_assoc($result)) {
              echo "<option value='".$data['id']."'>".$data['nama']."</option>";
            }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="ekstrakurikuler">Pilih Ekstrakurikuler:</label>
        <select name="ekstrakurikuler" class="form-control" required>
          <option value="">-- Pilih Ekstrakurikuler --</option>
          <?php
            $result = mysqli_query($koneksi, "SELECT * FROM ekstrakurikuler");
            while ($data = mysqli_fetch_assoc($result)) {
              echo "<option value='".$data['id']."'>".$data['nama']."</option>";
            }
          ?>
        </select>
      </div>
      <div class="form-group text-center">
        <button type="submit" class="btn btn-warning">Daftar</button>
        <a href="index.php" class="btn btn-secondary ml-2">Kembali</a>
      </div>
    </form>
  </div>
</div>

</body>
</html>
