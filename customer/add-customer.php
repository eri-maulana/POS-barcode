<?php

// menjalankan session, agar harus login terlebih dahulu ketika di mengakses halaman ini
session_start();

if (!isset($_SESSION['ssLoginPOST'])) {
   header("location: ../auth/login.php");
   exit();
}

// memanggil halaman lain
require "../config/config.php";
require "../config/functions.php";
require "../module/mode-customer.php";
$title = "Tambah Data Customer - POS barcode";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

// aksi ketika tombol simpan di tekan
$alert = '';
if (isset($_POST['simpan'])) {
   if (insert($_POST)) {
      $alert = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                  <i class="icon fas fa-check"></i><strong> Supplier</strong> berhasil ditambahkan.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>';
   }
}
?>

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Data Customer</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>dashboard.php">Home</a></li>
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>customer/data-customer.php">Data Customer</a>
                  </li>
                  <li class="breadcrumb-item active">Tambah Customer</li>
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
                  <h2 class="card-title pt-2"><i class="fas fa-plus fa-sm mr-2"></i> Tambah Customer</h2>
                  <button type="submit" name="simpan" class="btn btn-primary  float-right"><i class="fas fa-save mr-1"></i>
                     Simpan</button>
                  <button type="reset" name="" class="btn btn-danger  float-right mr-1"><i class="fas fa-times mr-1"></i> Batal</button>
               </div>
               <div class="card-body">
                  <?php
                  if ($alert != '') {
                     echo $alert;
                  }
                  ?>
                  <div class="row">
                     <div class="col-lg-8 mb-3">
                        <div class="form-group">
                           <label for="nama">Nama Customer</label>
                           <input type="text" name="nama" id="nama" class="form-control" autofocus autocomplete="off" required placeholder="Masukan nama customer ">
                        </div>
                        <div class="form-group">
                           <label for="telpon">No. Telpon</label>
                           <input type="text" name="telpon" id="telpon" class="form-control" pattern="[0-9]{5,}" title="Minimal Input 5 Angka" required placeholder="Masukan no. telpon customer ">
                        </div>

                        <div class="form-group">
                           <label for="alamat">Alamat</label>
                           <textarea name="alamat" id="alamat" class="form-control" required placeholder="Masukan alamat customer"></textarea>
                        </div>
                        <div class="form-group">
                           <label for="ketr">Deskripsi</label>
                           <textarea name="ketr" id="ketr" class="form-control" required placeholder="Masukan keterangan customer"></textarea>
                        </div>
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