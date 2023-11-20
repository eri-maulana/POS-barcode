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
$title = " Data Customer - POS barcode";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_GET['msg'])) {
   $msg = $_GET['msg'];
} else {
   $msg = '';
}

$alert = '';
if ($msg == 'deleted') {
   $alert = '<div class="alert alert-success alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <h5><i class="icon fas fa-check"></i> Data Costumer berhasil dihapus.~</h5>
               
            </div>';
}
if ($msg == 'updated') {
   $alert = '<div class="alert alert-warning alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <h5><i class="icon fas fa-check-circle"></i> Data Costumer berhasil diperbarui.~</h5>
               
            </div>';
}
if ($msg == 'aborted') {
   $alert = '<div class="alert alert-danger alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <h5><i class="icon fas fa-exclamation-triangle"></i> Data Costumer gagal dihapus.!</h5>
               
            </div>';
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
                  <li class="breadcrumb-item active">Data Customer</li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>

   <section class="content">
      <div class="container-fluid">
         <div class="card">
            <?php
            if ($alert != '') {
               echo $alert;
            }
            ?>
            <div class="card-header">
               <h3 class="card-title pt-2"><i class="fas fa-list fa-sm mr-2"></i>Data Customer</h3>
               <div class="card-tools">
                  <a href="<?= $main_url; ?>customer/add-customer.php" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-2"></i>Tambah Customer </a>
               </div>
            </div>
            <div class="card-body table-responsive p-3">

               <table class="table table-hover text-nowrap" id="tblData">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No. Telpon</th>
                        <th>Alamat</th>
                        <th>Deskripsi</th>
                        <th style="width: 10%;">Operasi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $no = 1;
                     $customers = getData("SELECT * FROM tbl_customer");
                     foreach ($customers as $customer) : ?>
                        <tr>
                           <td><?= $no++; ?></td>
                           <td><?= $customer["nama"]; ?></td>
                           <td><?= $customer["telpon"]; ?></td>
                           <td><?= $customer["alamat"]; ?></td>
                           <td><?= $customer["deskripsi"]; ?></td>

                           <td>
                              <!-- tombol edit supplier -->
                              <a href="edit-customer.php?id=<?= $customer['id_customer']; ?>" class="btn btn-sm btn-warning" title="edit customer"><i class="fas fa-user-edit"></i></a>

                              <!-- tombol hapus customer -->
                              <a href="del-customer.php?id=<?= $customer["id_customer"]; ?>" class="btn btn-sm btn-danger" title="hapus customer" onclick="return confirm('anda yakin akan menghapus data customer ini?')"><i class="fas fa-trash"></i></a>
                           </td>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </section>


   <?php
   require "../template/footer.php";
   ?>