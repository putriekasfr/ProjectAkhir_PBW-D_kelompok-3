<?php include "koneksi.php"; include "./session_.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>PMR | Ekstrakurikuler</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .ekskul-img {
      width: 100%;
      max-width: 600px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body class="container py-5">
  <h2 class="mb-4">Ekstrakurikuler PMR (Palang Merah Remaja)</h2>

  <img src="gambar3.jpg" alt="Ekstrakurikuler PMR" class="ekskul-img mb-4">

  <p>
    PMR adalah kegiatan ekstrakurikuler yang membentuk siswa agar memiliki kepedulian sosial dan keterampilan dasar pertolongan pertama. 
    Anggota PMR sering terlibat dalam kegiatan sosial, donor darah, dan bantuan kesehatan di sekolah.
  </p>

  <p>
    Kegiatan ini diawasi oleh pembina serta bekerja sama dengan PMI setempat untuk pelatihan lanjutan.
  </p>

  <a href="index.php" class="btn btn-primary mt-4">← Kembali ke Beranda</a>
</body>
</html>