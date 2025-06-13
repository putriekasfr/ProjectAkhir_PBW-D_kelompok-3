<?php
include "koneksi.php";
session_start();

if (isset($_SESSION['username'])) {
  if ($_SESSION['level'] == "admin") {
    header("Location: dashboard_admin.php");
  } else {
    header("Location: index.php");
  }
  exit;
}
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Sistem Informasi Ekstrakurikuler</title>
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
      text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
      border-bottom-left-radius: 30px;
      border-bottom-right-radius: 30px;
    }

    .card {
      box-shadow: 0 4px 12px rgba(0, 51, 102, 0.2);
      border-radius: 10px;
      margin-top: 20px;
      background-color: #ffffff;
      animation: fadeSlideUp 1s ease 0.5s forwards;
      opacity: 0;
    }

    @keyframes fadeSlideUp {
      0% { opacity: 0; transform: translateY(30px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    .btn-primary {
      background-color: #0059b3; border: none;
    }

    .btn-primary:hover {
      background-color: #004080;
      transform: scale(1.05);
      box-shadow: 0 0 8px rgba(0, 89, 179, 0.6);
    }

    .btn-danger {
      background-color: #cc0000; border: none;
    }

    .btn-danger:hover {
      background-color: #990000;
      transform: scale(1.05);
      box-shadow: 0 0 8px rgba(204, 0, 0, 0.6);
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
  <h1>SISTEM INFORMASI EKSTRAKURIKULER</h1>
</header>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-6 col-sm-8">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title text-center"><i class="fa fa-sign-in-alt"></i> Masuk </h6>
          <hr>
          <form method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
            </div>

            <?php
            if (isset($_POST['kirim'])) {
              $username = mysqli_real_escape_string($koneksi, $_POST['username']);
              $password = md5($_POST['password']); // sesuai struktur password di database

              $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
              if (mysqli_num_rows($sql) == 1) {
                $row = mysqli_fetch_assoc($sql);
                $_SESSION['id_log']   = $row['id'];
                $_SESSION['nama']     = $row['nama'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['level']    = $row['level'];

                if ($row['level'] == "admin") {
                  header("Location: dashboard_admin.php");
                } else {
                  header("Location: index.php");
                }
                exit;
              } else {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Username / Password Salah!</strong>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>";
              }
            }
            ?>

            <div class="text-right">
              <input type="reset" value="Reset" class="btn btn-danger">
              <input type="submit" value="Login" class="btn btn-primary" name="kirim">
            </div>

            <p class="text-center mt-3">
              Belum punya akun? <a href="register.php">Daftar di sini</a>
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
