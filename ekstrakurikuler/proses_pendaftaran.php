<?php
include "koneksi.php";
include "./session_.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama       = mysqli_real_escape_string($koneksi, $_POST['nama']);
  $kelas     = mysqli_real_escape_string($koneksi, $_POST['kelas']);
  $jurusan    = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
  $ekstra     = mysqli_real_escape_string($koneksi, $_POST['ekstrakurikuler']);

  // Ambil data user dari sesi
  $user_id = $_SESSION['id_log']; // pastikan 'id_log' diset saat login
  $tanggal = date('Y-m-d');

  // Cek apakah sudah pernah daftar ke ekstra yang sama
  $cek = mysqli_query($koneksi, "SELECT * FROM pendaftaranEkstra WHERE user_id = '$user_id' AND ekstra_id = '$ekstra'");
  if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Kamu sudah mendaftar ke ekstrakurikuler ini!'); window.location='pendaftaran.php';</script>";
  } else {
    $query = "INSERT INTO pendaftaranEkstra (user_id, ekstra_id, tanggal_daftar, status) 
              VALUES ('$user_id', '$ekstra', '$tanggal', 'menunggu')";

    if (mysqli_query($koneksi, $query)) {
      echo "<script>alert('Pendaftaran berhasil!'); window.location='pendaftaran.php';</script>";
    } else {
      echo "<script>alert('Gagal mendaftar. Silakan coba lagi.'); window.location='pendaftaran.php';</script>";
    }
  }
}
?>
