<?php
include "koneksi.php";
include "./session_.php";
if (!isset($_SESSION['username'])) {
  header("location:./login.php");
  exit();
}
$nomor = 1;
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda | Sistem Informasi Ekstrakurikuler</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9f9f9;
    }
    .topbar {
      background-color: #3f5e8a;
      color: white;
      font-size: 14px;
      padding: 5px 15px;
    }
    .topbar .marquee {
      white-space: nowrap;
      overflow: hidden;
      display: inline-block;
      animation: marquee 15s linear infinite;
    }
    @keyframes marquee {
      0% { transform: translateX(100%); }
      100% { transform: translateX(-100%); }
    }
    .navbar-main {
      background-color: white;
      border-bottom: 1px solid #ddd;
      padding: 10px 0;
    }
    .navbar-main .navbar-brand {
      font-weight: bold;
      font-size: 20px;
      color: #1d3e64;
    }
    .menu-bar {
      background-color: #27496d;
    }
    .menu-bar .nav-link {
      color: white !important;
      font-weight: 500;
    }
    .menu-bar .nav-link:hover,
    .menu-bar .dropdown-menu .dropdown-item:hover {
      background-color: #f6b93b;
      color: #1d3e64 !important;
    }
    .menu-bar .dropdown-menu {
      background-color: #27496d;
      border: none;
    }
    .menu-bar .dropdown-item {
      color: white;
    }
    .hero-section {
      background: url('header 2.jpeg') center/cover no-repeat;
      height: 400px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
    }
    .footer {
      background-color: #1d3e64;
      color: white;
      padding: 1rem;
      margin-top: 3rem;
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
  </style>
</head>
<body>

<!-- Topbar -->
<div class="topbar d-flex justify-content-between">
  <div class="marquee">
    <i class="fas fa-envelope"></i> smknsugihwaras.official@gmail.com
  </div>
  <div class="marquee">
    <i class="fas fa-bolt"></i> <strong>Selamat Datang di Website Ekstrakurikuler SMK Negeri Sugihwaras</strong> <i class="fas fa-bolt"></i>
  </div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-main">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="logo.png" style="width: 50px; margin-right: 10px;">
      <div>
        SMK NEGERI SUGIHWARAS<br>
        <small>SMK Bisa, SMK Hebat, SMK Rigas Siap Kerja</small>
      </div>
    </a>
  </div>
</nav>

<!-- Menu -->
<nav class="navbar navbar-expand-lg menu-bar">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menuNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menuNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="ekstraDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ekstrakurikuler</a>
          <div class="dropdown-menu" aria-labelledby="ekstraDropdown">
            <a class="dropdown-item" href="futsal.php">Futsal</a>
            <a class="dropdown-item" href="modelling.php">Modelling</a>
            <a class="dropdown-item" href="pmr.php">PMR</a>
            <a class="dropdown-item" href="tari.php">Tari</a>
            <a class="dropdown-item" href="pramuka.php">Pramuka</a>
            <a class="dropdown-item" href="senimusik.php">Seni Musik</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="informasiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pendaftaran</a>
          <div class="dropdown-menu" aria-labelledby="informasiDropdown">
            <a class="dropdown-item" href="pendaftaran.php">Pendaftaran</a>
            <a class="dropdown-item" href="berita.php">Berita</a>
  </div>
</li>

      </ul>
      <a href="logout.php" class="btn btn-sm btn-outline-light ml-2" id="logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>
</nav>

<!-- Hero -->
<div class="hero-section"></div>

<!-- Sejarah Sekolah -->
<section class="container py-5">
  <h4 class="fw-bold mb-4">Sejarah Singkat</h4>
  <div class="row align-items-center">
    <div class="col-md-6">
      <h5 class="font-weight-bold">SMK Negeri Sugihwaras</h5>
      <p>SMKN Sugihwaras didirikan pada tanggal <strong>05 Juli 2005</strong> berdasarkan SK Pendirian <strong>188/289/KEP/412.12/2005</strong>. Sekolah ini telah terakreditasi <strong>A</strong> dan berdiri di lahan seluas <strong>17.625 M<sup>2</sup></strong>.</p>
      <p class="mb-2 font-weight-bold">Daftar Kepala Sekolah:</p>
      <ul>
        <li>Hidayat Rahman, S.Pd, MM (2005–2009)</li>
        <li>Drs. Mukanan, MM (2009–2012)</li>
        <li>Drs. Moh. Ahyar (2012–2017)</li>
        <li>Dra. Heny Indriana, MM (2017–2019)</li>
        <li><em>Plt</em> Drs. Suyono, M.MPd. (2019–2021)</li>
        <li><em>Plt</em> Drs. Agus Suprapto Mulyono (2021–2022)</li>
        <li>Umi Kulsum (2023–sekarang)</li>
      </ul>
    </div>
    <div class="col-md-6 text-center">
      <img src="foto 1.jpeg" alt="Sejarah SMKN Sugihwaras" class="img-fluid shadow-sm" style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 30px;">
    </div>
  </div>
</section>

<footer class="footer text-center">
  &copy; <?= date('Y') ?> SMK Negeri Sugihwaras | Sistem Informasi Ekstrakurikuler
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById("logout").addEventListener("click", function (e) {
    if (!confirm("Yakin ingin logout?")) {
      e.preventDefault();
    }
  });
</script>
</body>
</html>
