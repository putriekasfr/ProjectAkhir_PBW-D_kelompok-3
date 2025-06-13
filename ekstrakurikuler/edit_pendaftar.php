<?php
include "koneksi.php";
include "session_.php";

if (!isset($_SESSION['username']) || $_SESSION['level'] != 'admin') {
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];

// Ambil data pendaftar
$query = mysqli_query($koneksi, "SELECT * FROM pendaftaranEkstra WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
  echo "<script>alert('Data tidak ditemukan'); location.href='dashboard_admin.php';</script>";
  exit;
}

// Ambil data user dan ekstrakurikuler
$users = mysqli_query($koneksi, "SELECT id, nama FROM user WHERE level = 'user'");
$ekstras = mysqli_query($koneksi, "SELECT id, nama FROM ekstrakurikuler");

if (isset($_POST['update'])) {
  $user_id = $_POST['user_id'];
  $ekstra_id = $_POST['ekstra_id'];
  $tanggal_daftar = $_POST['tanggal_daftar'];
  $status = $_POST['status'];

  $update = mysqli_query($koneksi, "UPDATE pendaftaranEkstra SET 
    user_id='$user_id',
    ekstra_id='$ekstra_id',
    tanggal_daftar='$tanggal_daftar',
    status='$status'
    WHERE id='$id'");

  if ($update) {
    echo "<script>alert('Data berhasil diperbarui!'); location.href='dashboard_admin.php';</script>";
  } else {
    echo "<script>alert('Gagal memperbarui data!');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Pendaftar Ekstrakurikuler</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <h3>Edit Data Pendaftar Ekstrakurikuler</h3>
  <a href="dashboard_admin.php" class="btn btn-secondary btn-sm mb-3">← Kembali</a>

  <form method="POST">
    <div class="form-group">
      <label>Nama Siswa</label>
      <select name="user_id" class="form-control" required>
        <option value="">-- Pilih Siswa --</option>
        <?php while ($u = mysqli_fetch_assoc($users)) { ?>
          <option value="<?= $u['id'] ?>" <?= $u['id'] == $data['user_id'] ? 'selected' : '' ?>>
            <?= $u['nama'] ?>
          </option>
        <?php } ?>
      </select>
    </div>

    <div class="form-group">
      <label>Ekstrakurikuler</label>
      <select name="ekstra_id" class="form-control" required>
        <option value="">-- Pilih Ekstra --</option>
        <?php while ($e = mysqli_fetch_assoc($ekstras)) { ?>
          <option value="<?= $e['id'] ?>" <?= $e['id'] == $data['ekstra_id'] ? 'selected' : '' ?>>
            <?= $e['nama'] ?>
          </option>
        <?php } ?>
      </select>
    </div>

    <div class="form-group">
      <label>Tanggal Daftar</label>
      <input type="date" name="tanggal_daftar" class="form-control" value="<?= $data['tanggal_daftar'] ?>" required>
    </div>

    <div class="form-group">
      <label>Status</label>
      <select name="status" class="form-control" required>
        <option value="menunggu" <?= $data['status'] == 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
        <option value="diterima" <?= $data['status'] == 'lolos' ? 'selected' : '' ?>>Lolos</option>
        <option value="ditolak" <?= $data['status'] == 'tidak lolos' ? 'selected' : '' ?>>Tidak Lolos</option>
      </select>
    </div>

    <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
  </form>
</div>
</body>
</html>
