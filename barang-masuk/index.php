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
require "../module/mode-beli.php";
$title = "Barang Masuk - POS barcode";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$noBeli = generateNo();
?>


<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Barang Masuk</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Tambah Barang Masuk</li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>
   <section>
      <div class="container-fluid">
         <form action="" method="post">
            <div class="row">
               <div class="col-lg-8">
                  <div class="card card-outline card-secondary p-4">
                     <div class="form-group row mb-2">
                        <label for="noNota" class="col-sm-2 col-form-label">No Nota</label>
                        <div class="col-sm-4">
                           <input type="text" name="nobeli" class="form-control" id="noNota" value="<?= $noBeli ?>">
                        </div>
                        <label for="tglNota" class="col-sm-2 col-form-label">Tanggal Nota</label>
                        <div class="col-sm-4">
                           <input type="date" name="tglNota" class="form-control" id="tglNota" value="<?= date('Y-m-d') ?>" require>
                        </div>
                     </div>
                     <div class="form-group row mb-2 mt-2">
                        <label for="kodeBrg" class="col-sm-2 col-form-label">SKU</label>
                        <div class="col-sm-10">
                           <select name="kodeBrg" id="kodeBrg" class="form-control">
                              <option value="">-- Pilih Kode Barang --</option>
                              <?php
                              $barang = getData("SELECT * FROM tbl_barang");
                              foreach ($barang as $brg) {
                              ?>
                                 <option value="<?= $brg['id_barang'] ?>">
                                    <?= $brg['id_barang'] . "|" . $brg['nama_barang'] ?></option>
                              <?php
                              }
                              ?>
                           </select>
                        </div>
                     </div>

                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="card card-outline card-secondary p-3">
                     <h3 class="font-weight-bold text-right">Total Pembelian</h3>
                     <h1 class="font-weight-bold text-right" style="font-size: 40pt;">0</h1>
                  </div>
               </div>
            </div>
            <div class="card p-3">
               <div class="row">
                  <div class="col-lg-4">
                     <div class="form-group">
                        <label for="namaBrg">Nama Barang</label>
                        <input type="text" name="namaBrg" id="namaBrg" class="form-control form-control-sm" readonly>
                     </div>
                  </div>
                  <div class="col-lg-1">
                     <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" name="stok" id="stok" class="form-control form-control-sm" readonly>
                     </div>
                  </div>
                  <div class="col-lg-1">
                     <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <input type="text" name="satuan" id="satuan" class="form-control form-control-sm" readonly>
                     </div>
                  </div>
                  <div class="col-lg-2">
                     <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" id="harga" class="form-control form-control-sm" readonly>
                     </div>
                  </div>
                  <div class="col-lg-2">
                     <div class="form-group">
                        <label for="qty">Qty</label>
                        <input type="number" name="qty" id="qty" class="form-control form-control-sm">
                     </div>
                  </div>
                  <div class="col-lg-2">
                     <div class="form-group">
                        <label for="jmlHarga">Jumlah Harga</label>
                        <input type="number" name="jmlHarga" id="jmlHarga" class="form-control form-control-sm" readonly>
                     </div>
                  </div>
               </div>
               <button type="submit" name="addBrg" class="btn btn-primary btn-sm">
                  <i class="fas fa-plus fa-sm mr-3"></i> Tambah Barang
               </button>
            </div>
            <div class="card card-outline card-primary table-responsive px-3">
               <table class="table table-sm table-hover text-nowrap">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Jumlah Harga</th>
                        <th class="text-right" widht="10%">Operasi</th>
                     </tr>
                  </thead>
                  <tbody>

                  </tbody>
               </table>
            </div>
            <div class="row">
               <div class="col-lg-6 p-3">
                  <div class="form-group row mb-2">
                     <label for="suplier" class="col-sm-3 col-form-label col-form-label-sm">Nama Supplier</label>
                     <div class="col-sm-9">
                        <select name="suplier" id="suplier" class="form-control form-control-sm">
                           <option value="">-- Pilih Supplier --</option>
                           <?php
                           $supliers = getData("SELECT * FROM tbl_supplier");
                           foreach ($supliers as $suplier) {
                           ?>
                              <option value="<?= $suplier['nama'] ?>">
                                 <?= $suplier['nama'] ?> </option>
                           <?php
                           }
                           ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row mb-2">
                     <label for="ktr" class="col-sm-3 col-form-label col-form-label-sm">Keterangan</label>
                     <div class="col-sm-9">
                        <textarea name="ktr" id="ktr" class="form-control form-control-sm"></textarea>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 p-2 ">
                  <button type="submit" name="simpan" id="simpan" class="btn btn-primary btn-sm btn-block"><i class="fas fa-save mr-3"></i> Simpan</button>
               </div>
            </div>
         </form>
      </div>
   </section>

   <?php
   require "../template/footer.php";
   ?>