<?php
$koneksi = mysqli_connect("localhost", "root", "", "b_ekstrakurikuler");

if ($koneksi->connect_error) {
    echo "Koneksi Gagal";
}
