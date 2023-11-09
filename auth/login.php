<?php

session_start();

if (isset($_SESSION['ssLoginPOST'])) {
   header('location: ../dashboard.php');
   exit();
}

require "../config/config.php";

if (isset($_POST['login'])) {
   $username = mysqli_real_escape_string($koneksi, $_POST['username']);
   $password = mysqli_real_escape_string($koneksi, $_POST['password']);

   $queryLogin = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username='$username'");
   if (mysqli_num_rows($queryLogin)) {
      $row = mysqli_fetch_assoc($queryLogin);
      if (password_verify($password, $row['password'])) {
         $_SESSION['ssLoginPOST'] = true;
         $_SESSION['ssUserPOST'] = $username;
         header('location: ../dashboard.php');
         exit();
      } else {
         echo '<script>
                  alert("Password Salah!");
               </script>';
      }
   } else {
      echo '<script>
               alert("Username Tidak Terdaftar!");
            </script>';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Login | POS Barcode</title>

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="<?= $main_url; ?>asset/AdminLTE/plugins/fontawesome-free/css/all.min.css">
   <!-- icheck bootstrap -->
   <link rel="stylesheet" href="<?= $main_url; ?>asset/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="<?= $main_url; ?>asset/AdminLTE/dist/css/adminlte.min.css">
   <!-- Shortcut Icon -->
   <link rel="icon" href="<?= $main_url; ?>asset/image/cart.png" type="image/x-icon">
   <!-- My Css -->
   <link rel="stylesheet" href="style.css">
</head>

<body class="hold-transition login-page">
   <div class="login-box slide-down">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
         <div class="card-header text-center">
            <a href="" class="h1"><b>POS</b> barcode</a>
         </div>
         <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="" method="post">
               <div class="input-group mb-4">
                  <input type="text" class="form-control" placeholder="Username" name="username">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-user"></span>
                     </div>
                  </div>
               </div>
               <div class="input-group mb-4">
                  <input type="password" class="form-control" placeholder="Password" name="password">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                     </div>
                  </div>
               </div>
               <div class="row">

                  <!-- /.col -->
                  <div class="col-12 mb-4">
                     <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
                  </div>
                  <!-- /.col -->
               </div>
            </form>

            <p class="mb-0 text-center">
               <strong>&copy;Copyright</strong> 2023 | <a href="https://instagram.com/erimaulana.69" target="_blank" class="text-info text-decoration-none">Eri Maulana</a>
            </p>
         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.card -->
   </div>
   <!-- /.login-box -->

   <!-- jQuery -->
   <script src="<?= $main_url; ?>asset/AdminLTE/plugins/jquery/jquery.min.js"></script>
   <!-- Bootstrap 4 -->
   <script src="<?= $main_url; ?>asset/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- AdminLTE App -->
   <script src="<?= $main_url; ?>asset/AdminLTE/dist/js/adminlte.min.js"></script>
</body>

</html>