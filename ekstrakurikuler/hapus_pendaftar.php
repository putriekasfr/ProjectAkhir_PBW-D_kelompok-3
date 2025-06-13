<?php
include "koneksi.php";
include "session_.php";

if (!isset($_SESSION['username']) || $_SESSION['level'] != 'admin') {
  header("Location: login.php");
  exit();
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Cek apakah data dengan ID tersebut ada
  $cek = mysqli_query($koneksi, "SELECT * FROM pendaftaranEkstra WHERE id = '$id'");
  if (mysqli_num_rows($cek) > 0) {
    $hapus = mysqli_query($koneksi, "DELETE FROM pendaftaranEkstra WHERE id = '$id'");
    if ($hapus) {
      echo "<script>alert('Data berhasil dihapus!'); window.location.href='dashboard_admin.php';</script>";
    } else {
      echo "<script>alert('Gagal menghapus data!'); window.location.href='dashboard_admin.php';</script>";
    }
  } else {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='dashboard_admin.php';</script>";
  }
} else {
  echo "<script>alert('ID tidak ditemukan!'); window.location.href='dashboard_admin.php';</script>";
}
?>
