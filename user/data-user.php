<?php
require "../config/config.php";
require "../config/functions.php";
require "../module/mode-user.php";

$title = "Data Pengguna - POS barcode";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Data Pengguna</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Data Pengguna</li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <section class="content">
      <div class="container-fluid">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title"><i class="fas fa-list fa-sm mr-2"></i>Data Pengguna</h3>
               <div class="card-tools">
                  <a href="<?= $main_url; ?>user/add-user.php" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-2"></i>Tambah Pengguna </a>
               </div>
            </div>
            <div class="card-body table-responsive p-3">
               <table class="table table-hover text-nowrap">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Alamat</th>
                        <th>Level User</th>
                        <th style="width: 10%;">Operasi</th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>
   </section>



   <?php
   require "../template/footer.php";
   ?>