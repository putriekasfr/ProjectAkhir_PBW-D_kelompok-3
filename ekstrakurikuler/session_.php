<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Tambahan perlindungan:
if (!isset($_SESSION['level'])) {
  $_SESSION['level'] = null; // default aman
}
