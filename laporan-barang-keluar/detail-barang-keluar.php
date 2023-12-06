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
$title = "Laporan Barang Keluar Detail - POS barcode";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$id = $_GET['id'];
$tgl = $_GET['tgl'];
$penjualan = getData("SELECT * FROM tbl_jual_detail WHERE no_jual = '$id'");
?>

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Laporan Barang Keluar Detail</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active"><a href="<?= $main_url; ?>laporan-barang-keluar/">Laporan Barang
                        Keluar</a></li>
                  <li class="breadcrumb-item active">Laporan Barang Keluar Detail</li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>

   <section class="conntent">
      <div class="container-fluid">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title pt-2"><i class="fas fa-list fa-sm mr-2"></i>Laporan Barang Keluar Detail</h3>
               <button type="button" class="btn btn-sm btn-success float-right"><?= $tgl ?></button>
               <button type="button" class="btn btn-sm btn-warning float-right mr-3"><?= $id ?></button>
            </div>
            <div class="card-body table-responsive p-3">
               <table class="table table-hover text-nowrap">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Barcode</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th class="text-center ">Qty</th>
                        <th class="text-center ">Total</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $no = 1;
                     foreach ($penjualan as $detail) {
                     ?>
                        <tr>
                           <td><?= $no; ?></td>
                           <td><?= $detail['barcode']; ?></td>
                           <td><?= $detail['nama_brg']; ?></td>
                           <td><?= number_format($detail['harga_jual'], 0, ',', '.'); ?></td>
                           <td class="text-center"><?= $detail['qty']; ?></td>
                           <td class="text-center"><?= number_format($detail['jml_harga'], 0, ',', '.'); ?></td>

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