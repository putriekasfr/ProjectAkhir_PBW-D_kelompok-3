<?php
include "koneksi.php";
session_start();

if (isset($_SESSION['username'])) {
  header("location: index.php");
  exit;
}

if (isset($_POST['daftar'])) {
  $nama       = htmlspecialchars($_POST['nama']);
  $username   = htmlspecialchars($_POST['username']);
  $no_hp      = htmlspecialchars($_POST['no_hp']);
  $kelas      = htmlspecialchars($_POST['kelas']);
  $jurusan_id = $_POST['jurusan_id'];
  $password   = $_POST['password'];
  $confirm    = $_POST['confirm'];

  if ($password !== $confirm) {
    $error = "Konfirmasi password tidak cocok!";
  } else {
    $password_hash = md5($password); // Untuk produksi sebaiknya gunakan password_hash()

    $cek = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
      $error = "Username sudah digunakan!";
    } else {
      $query = "INSERT INTO user (nis, nama, tpt_lahir, tgl_lahir, alamat, kelas, jurusan_id, no_hp, username, password, level)
                VALUES (NULL, '$nama', NULL, NULL, NULL,'$kelas', '$jurusan_id', '$no_hp', '$username', '$password_hash', 'user')";
      $insert = mysqli_query($koneksi, $query);
      if ($insert) {
        header("location: login.php");
        exit;
      } else {
        $error = "Pendaftaran gagal. Periksa kembali data!";
      }
    }
  }
}
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar | Sistem Informasi Ekstrakurikuler</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      background: linear-gradient(to bottom right, #e6f0ff, #ffffff);
      font-family: 'Poppins', sans-serif;
      color: #003366;
    }
    header.hero-header {
      height: 220px;
      background: url('header.jpeg') center/cover no-repeat;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
      border-bottom-left-radius: 30px;
      border-bottom-right-radius: 30px;
    }
    .card {
      margin-top: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 51, 102, 0.2);
    }
    .card-title {
      color: #003366;
      font-weight: 600;
    }
    .btn-primary {
      background-color: #0059b3;
      border: none;
    }
    .btn-primary:hover {
      background-color: #004080;
      transform: scale(1.05);
      box-shadow: 0 0 8px rgba(0, 89, 179, 0.6);
    }
    .form-control:focus {
      border-color: #0059b3;
      box-shadow: 0 0 0 0.2rem rgba(0, 89, 179, 0.25);
    }
    footer {
      margin-top: 40px;
      text-align: center;
      font-size: 0.9rem;
      color: #666;
    }
  </style>
</head>
<body>

<header class="hero-header">
  <h1>DAFTAR AKUN EKSTRAKURIKULER</h1>
</header>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-7 col-sm-9">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center"><i class="fas fa-user-plus"></i> Formulir Pendaftaran</h5>
          <hr>

          <?php if (isset($error)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong><?= $error; ?></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php endif; ?>

          <form method="post">
            <div class="form-group">
              <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
            </div>
            <div class="form-group">
              <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
              <input type="tel" name="no_hp" class="form-control" placeholder="Nomor HP" pattern="[0-9]{10,15}" required>
            </div>
            <div class="form-group">
              <input type="tel" name="kelas" class="form-control" placeholder="kelas" required>
            </div>
            <div class="form-group">
              <select name="jurusan_id" class="form-control" required>
                <option value="">-- Pilih Jurusan --</option>
                <?php
                $jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan");
                while ($j = mysqli_fetch_assoc($jurusan)) {
                  echo "<option value='" . $j['id'] . "'>" . $j['nama'] . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
              <input type="password" name="confirm" class="form-control" placeholder="Konfirmasi Password" required>
            </div>

            <input type="submit" name="daftar" value="Daftar" class="btn btn-primary btn-block">
            <p class="text-center mt-3">
              Sudah punya akun? <a href="login.php">Login di sini</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<footer>
  <small>&copy; <?= date('Y'); ?> Sistem Informasi Ekstrakurikuler</small>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
