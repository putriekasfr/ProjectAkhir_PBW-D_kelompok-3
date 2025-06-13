<?php
include "koneksi.php";
include "session_.php";

// Hanya bisa diakses oleh admin
if (!isset($_SESSION['username']) || $_SESSION['level'] != 'admin') {
  header("Location: login.php");
  exit();
}

// Ambil data pendaftar
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
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cetak Data Pendaftar Ekstrakurikuler</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @media print {
      .btn-print, .btn-back { display: none; }
    }
    body {
      padding: 30px;
      font-family: Arial, sans-serif;
    }
    h2 {
      text-align: center;
      margin-bottom: 30px;
    }
    table {
      font-size: 12pt;
    }
  </style>
</head>
<body>

  <h2>Data Pendaftar Ekstrakurikuler<br>SMK Sugihwaras</h2>

  <div class="d-flex justify-content-between mb-3">
    <a href="dashboard_admin.php" class="btn btn-secondary btn-back">Kembali ke Dashboard</a>
    <button onclick="window.print()" class="btn btn-primary btn-print">Cetak / Simpan PDF</button>
  </div>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>No HP</th>
        <th>Ekstrakurikuler</th>
        <th>Tanggal Daftar</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      while ($row = mysqli_fetch_assoc($sql)) {
      ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td><?= htmlspecialchars($row['kelas']) ?></td>
        <td><?= htmlspecialchars($row['jurusan']) ?></td>
        <td><?= htmlspecialchars($row['no_hp']) ?></td>
        <td><?= htmlspecialchars($row['nama_ekstra']) ?></td>
        <td><?= htmlspecialchars($row['tanggal_daftar']) ?></td>
        <td><?= htmlspecialchars($row['status']) ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

</body>
</html>
