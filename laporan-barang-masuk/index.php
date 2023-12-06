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
$title = "Laporan Barang Masuk - POS barcode";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$pembelian = getData("SELECT * FROM tbl_beli_head ");
?>

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Laporan Barang Masuk</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Laporan Barang Masuk</li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>
   <section class="conntent">
      <div class="container-fluid">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title pt-2"><i class="fas fa-list fa-sm mr-2"></i>Data Barang Masuk</h3>
               <button type="button" class="btn btn-sm btn-outline-primary float-right" data-toggle="modal" data-target="#mdlPeriodeBeli"><i class="fas fa-print mr-2"></i> Cetak</button>
            </div>
            <div class="card-body table-responsive p-3">
               <table class="table table-hover text-nowrap" id="tblData">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>No Pembelian</th>
                        <th>Tanggal Pembelian</th>
                        <th>Supplier</th>
                        <th>Total Pembelian</th>
                        <th style="width: 10%" class="text-center">Operasi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $no = 1;
                     foreach ($pembelian as $beli) {
                     ?>
                        <tr>
                           <td><?= $no; ?></td>
                           <td><?= $beli['no_beli']; ?></td>
                           <td><?= in_date($beli['tgl_beli']); ?></td>
                           <td><?= $beli['suplier']; ?></td>
                           <td><?= number_format($beli['total'], 0, ',', '.'); ?></td>
                           <td class="text-center">
                              <a href="detail-barang-masuk.php?id=<?= $beli['no_beli']; ?>&tgl=<?= in_date($beli['tgl_beli']); ?>" class="btn btn-sm btn-info" title="rincian barang ">Detail</a>
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

   <div class="modal fade" id="mdlPeriodeBeli">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Periode Beli</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group row">
                  <label for="tgl1" class="col-sm-3 col-form-label">Tanggal Awal</label>
                  <div class="col-sm-9">
                     <input type="date" class="form-control" id="tgl1">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="tgl2" class="col-sm-3 col-form-label">Tanggal Akhir</label>
                  <div class="col-sm-9">
                     <input type="date" class="form-control" id="tgl2">
                  </div>
               </div>

            </div>
            <div class="modal-footer ">
               <button type="button" class="btn btn-primary" onclick="printDoc()"><i class="fas fa-print"></i>
                  Cetak</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>

   <script>
      let tgl1 = document.getElementById('tgl1');
      let tgl2 = document.getElementById('tgl2');

      function printDoc() {
         if (tgl1.value != '' && tgl2.value != '') {
            window.open("../report/r-beli.php?tgl1=" + tgl1.value + "&tgl2=" + tgl2.value, "",
               "width=900, height=600, left=100");
         }
      }
   </script>

   <?php
   require "../template/footer.php";
   ?>