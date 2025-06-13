<?php
include "koneksi.php";
include "session_.php";

if (!isset($_SESSION['username']) || $_SESSION['level'] != 'admin') {
  header("Location: login.php");
  exit();
}

$nomor = 1;
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Dashboard Admin | Sistem Ekstrakurikuler</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family:'Poppins',sans-serif; background-color:#f9f9f9; }
    .topbar { background:#3f5e8a; color:#fff; padding:5px 15px; font-size:14px; }
    .navbar-main { background:#fff; border-bottom:1px solid #ddd; padding:10px 0; }
    .navbar-main .navbar-brand { color:#1d3e64; font-weight:bold; }
    .menu-bar { background:#27496d; }
    .menu-bar .nav-link { color:#fff!important; font-weight:500; }
    .menu-bar .nav-link:hover, .menu-bar .dropdown-menu .dropdown-item:hover {
      background:#f6b93b; color:#1d3e64!important;
    }
    .menu-bar .dropdown-menu { background:#27496d; border:none; }
    .menu-bar .dropdown-item { color:#fff; }
    .footer { background:#1d3e64; color:#fff; padding:1rem; margin-top:3rem; }
    .btn-warning { background:#f6b93b; border:none; color:#fff; }
    .btn-warning:hover { background:#e89c00; }
  </style>
</head>
<body>

<!-- Topbar -->
<div class="topbar d-flex justify-content-between">
  <div><i class="fas fa-envelope"></i> smknsugihwaras.official@gmail.com</div>
  <div><strong>Hallo, <?= htmlspecialchars($_SESSION['nama']) ?> (Admin)</strong></div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-main">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SMK Sugihwaras</a>
    <a href="logout.php" class="btn btn-sm btn-outline"><i class="fa fa-sign-out-alt"></i> Logout</a>
  </div>
</nav>

<!-- Menu bar -->
<nav class="navbar navbar-expand-lg menu-bar">
  <div class="container">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item"><a class="nav-link active" href="dashboard_admin.php">Data Pendaftar</a></li>
    </ul>
  </div>
</nav>

<div class="mb-3">
  <a href="cetak_pendaftar.php" class="btn btn-danger" target="_blank">
    <i class="fa fa-file-pdf"></i> Cetak PDF
  </a>
</div>

<div class="container py-4">
  <!-- Data pendaftar -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Pendaftar Ekstrakurikuler</h4>
  </div>

  <?php
  $sql = mysqli_query($koneksi, "
    SELECT p.id, u.nis, u.nama, u.kelas, j.nama AS jurusan, u.no_hp,
           e.nama AS nama_ekstra, p.tanggal_daftar, p.status
    FROM pendaftaranEkstra p
    JOIN user u ON p.user_id = u.id
    LEFT JOIN jurusan j ON u.jurusan_id = j.id
    JOIN ekstrakurikuler e ON p.ekstra_id = e.id
    ORDER BY p.tanggal_daftar DESC
  ");
  ?>

  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="thead-dark">
        <tr>
          <th>No</th>     
          <th>Nama</th>
          <th>Kelas</th>
          <th>Jurusan</th>
          <th>No HP</th>
          <th>Ekstrakurikuler</th>
          <th>Tanggal Daftar</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
          <tr>
            <td><?= $nomor++ ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['kelas'] ?? '-') ?></td>
            <td><?= htmlspecialchars($row['jurusan'] ?? '-') ?></td>
            <td><?= htmlspecialchars($row['no_hp']) ?></td>
            <td><?= htmlspecialchars($row['nama_ekstra']) ?></td>
            <td><?= htmlspecialchars($row['tanggal_daftar']) ?></td>
            <td><span class="badge badge-info"><?= htmlspecialchars($row['status']) ?></span></td>
            <td>
              <a href="edit_pendaftar.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="hapus_pendaftar.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin hapus data ini?')" class="btn btn-danger btn-sm">Hapus</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<footer class="footer text-center">
  &copy; <?= date('Y') ?> SMK Sugihwaras
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById("logout")?.addEventListener("click", function (e) {
    if (!confirm("Yakin ingin logout?")) {
      e.preventDefault();
    }
  });
</script>
</body>
</html>
