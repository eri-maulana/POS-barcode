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
require "../module/mode-supplier.php";
$title = " Edit Supllier - POS barcode";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

// jalankan update data
if (isset($_POST['update'])) {
   if (update($_POST)) {
      echo "<script>
            document.location.href = 'data-supplier.php?msg=updated'
           </script>";
   }
}

$id = $_GET['id'];

$sqlEdit = "SELECT * FROM tbl_supplier WHERE id_supplier = $id";
$supplier = getData($sqlEdit)[0];

?>


<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Edit Supplier</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>dashboard.php">Home</a></li>
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>supplier/data-supplier.php">Data Supplier</a>
                  </li>
                  <li class="breadcrumb-item active">Edit Supplier</li>
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
                  <h2 class="card-title pt-2"><i class="fas fa-plus fa-sm mr-2"></i> Edit Supplier</h2>
                  <button type="submit" name="update" class="btn btn-primary  float-right"><i class="fas fa-save mr-1"></i>
                     Ubah</button>
                  <button type="reset" name="" class="btn btn-danger  float-right mr-1"><i class="fas fa-times mr-1"></i> Batal</button>
               </div>
               <div class="card-body">
                  <div class="row">
                     <input type="hidden" name="id" value="<?= $supplier['id_supplier']; ?>">
                     <div class="col-lg-8 mb-3">
                        <div class="form-group">
                           <label for="nama">Nama Supplier</label>
                           <input type="text" name="nama" id="nama" class="form-control" autofocus required placeholder="Masukan nama supplier " value="<?= $supplier['nama']; ?>">
                        </div>
                        <div class="form-group">
                           <label for="telpon">No. Telpon</label>
                           <input type="text" name="telpon" id="telpon" class="form-control" pattern="[0-9]{5,}" title="Minimal Input 5 Angka" required placeholder="Masukan no. telpon supplier " value="<?= $supplier['telpon']; ?>">
                        </div>

                        <div class="form-group">
                           <label for="alamat">Alamat</label>
                           <textarea name="alamat" id="alamat" class="form-control" required placeholder="Masukan alamat supplier"><?= $supplier['alamat']; ?></textarea>
                        </div>
                        <div class="form-group">
                           <label for="ketr">Deskripsi</label>
                           <textarea name="ketr" id="ketr" class="form-control" required placeholder="Masukan keterangan supplier"><?= $supplier['deskripsi']; ?></textarea>
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