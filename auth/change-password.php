<?php

session_start();

if (!isset($_SESSION['ssLoginPOST'])) {
   header("location: ../auth/login.php");
   exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-password.php";
$title = "Ubah Kata Sandi - POS barcode";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

// update password
if (isset($_POST['simpan'])) {
   if (update($_POST)) {
      echo "<script>
               alert('Kata Sandi berhasil diperbarui.. !');
               document.location='change-password.php'; 
            </script>";
   }
}

if (isset($_GET['msg'])) {
   $msg = $_GET['msg'];
} else {
   $msg = '';
}

$alert1 = "<small class='text-danger pl-2 font-italic'>Konfirmasi kata sandi tidak sama dengan kata sandi baru</small>";
$alert2 = "<small class='text-danger pl-2 font-italic'>Kata sandi saat ini tidak sama</small>";

?>

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Ubah Kata Sandi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Ubah Kata Sandi</li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>

   <section class="content">
      <div class="container-fluid">
         <div class="card">
            <form action="" method="post">
               <div class="card-header">
                  <h3 class="card-title pt-2"><i class="fas fa-key mr-2"></i> Ubah Kata Sandi</h3>
                  <button class="btn btn-primary float-right text-sm" type="submit" name="simpan"><i class="fas fa-edit"></i>
                     Simpan</button>
                  <button type="reset" name="reset" class="btn btn-danger text-sm float-right mr-2"><i class="fas fa-times"></i>
                     Batal</button>
               </div>
               <div class="card-body">
                  <div class="col-lg-8 mb-3">
                     <div class="form-group">
                        <label for="curPass">Kata Sandi Saat Ini</label>
                        <input type="password" name="curPass" id="curPass" class="form-control" placeholder="Masukan kata sandi Anda saat ini .." required>
                        <?php
                        if ($msg == 'err2') {
                           echo $alert2;
                        }

                        ?>
                     </div>
                     <div class="form-group">
                        <label for="newPass">Kata Sandi Baru</label>
                        <input type="password" name="newPass" id="newPass" class="form-control" placeholder="Masukan kata sandi Baru .." required>
                     </div>
                     <div class="form-group">
                        <label for="confPass">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="confPass" id="confPass" class="form-control" placeholder="Konfirmasi kata sandi Baru .." required>
                        <?php
                        if ($msg == 'err1') {
                           echo $alert1;
                        }

                        ?>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </section>

   <?php

   require "../template/footer.php";

   ?>