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
require "../module/mode-barang.php";
$title = "Laporan Stock Barang - POS barcode";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$stockBrg = getData("SELECT * FROM tbl_barang ");
?>

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Laporan Stock Barang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Laporan Barang</li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>

   <section class="conntent">
      <div class="container-fluid">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title pt-2"><i class="fas fa-list fa-sm mr-2"></i>Data Stock Barang</h3>
               <a href="<?= $main_url ?>report/r-stock.php" class="btn btn-sm btn-outline-primary float-right" target="_blank"><i class="fas fa-print mr-2"></i> Cetak</a>
            </div>
            <div class="card-body table-responsive p-3">
               <table class="table table-hover text-nowrap" id="tblData">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Kode Barang</th>
                        <th>Satuan</th>
                        <th>Jumlah Stok</th>
                        <th>Stok Minimal</th>
                        <th>Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $no = 1;
                     foreach ($stockBrg as $stock) {
                     ?>
                        <tr>
                           <td><?= $no; ?></td>
                           <td><?= $stock['id_barang']; ?></td>
                           <td><?= $stock['nama_barang']; ?></td>
                           <td><?= $stock['satuan']; ?></td>
                           <td class="text-center"><?= $stock['stock']; ?></td>
                           <td class="text-center"><?= $stock['stock_minimal']; ?></td>
                           <td>
                              <?php
                              if ($stock['stock'] < $stock['stock_minimal']) {
                                 echo "<span class='text-danger'>Stock Kurang</span>";
                              } else {
                                 echo "Stock Cukup";
                              }
                              ?>
                           </td>
                        </tr>
                     <?php
                        $no++;
                     }
                     ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </section>


   <?php
   require "../template/footer.php";
   ?>