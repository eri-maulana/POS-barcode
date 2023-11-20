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
$title = "Data Barang - POS barcode";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_GET['msg'])) {
   $msg = $_GET['msg'];
} else {
   $msg = '';
}

$alert = '';
// jalankan fungsi hapus barang
if ($msg == 'deleted') {
   $id = $_GET['id'];
   $gbr = $_GET['gbr'];
   delete($id, $gbr);
   $alert = "
            <script>
            $(document).ready(function(){
               $(document).Toasts('create', {
                  title  : 'Sukses',
                  body   : 'Data Barang Berhasil Dihapus dari Database.',
                  class  : 'bg-success',
                  icon   : 'fas fa-check-circle',
               })
            });
            </script>      
            ";
}


?>


<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Data Barang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Data Barang</li>
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
               <h3 class="card-title pt-2"><i class="fas fa-list fa-sm mr-2"></i>Data Barang</h3>
               <div class="card-tools">
                  <a href="<?= $main_url; ?>barang/form-barang.php" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-2"></i>Tambah Barang </a>
               </div>
            </div>
            <div class="card-body table-responsive p-3">
               <table class="table table-hover text-nowrap" id="tblData">
                  <thead>
                     <tr>
                        <th>Gambar</th>
                        <th>ID Barang</th>
                        <th>Nama</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th style="width: 10%" class="text-center">Operasi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $no = 1;
                     $barang = getData("SELECT * FROM tbl_barang");
                     foreach ($barang as $brg) {
                     ?>

                        <tr>
                           <td>
                              <img src="../asset/image/<?= $brg['gambar']; ?>" class="rounded-circle" width="50px" height="50px" alt="<?= $brg['nama_barang'] ?>">
                           </td>
                           <td><?= $brg['id_barang']; ?></td>
                           <td><?= $brg['nama_barang']; ?></td>
                           <td class="text-center"><?= number_format($brg['harga_beli'], 0, ',', '.'); ?></td>
                           <td class="text-center"><?= number_format($brg['harga_jual'], 0, ',', '.'); ?></td>
                           <td>
                              <!-- tombol edit barang -->
                              <a href="edit-barang.php?id=<?= $brg['id_barang']; ?>" class="btn btn-sm btn-warning" title="edit barang"><i class="fas fa-edit"></i></a>

                              <!-- tombol hapus barang -->
                              <a href="?id=<?= $brg['id_barang']; ?>&gbr=<?= $brg['gambar']; ?>&msg=deleted" class="btn btn-sm btn-danger" title="hapus barang" onclick="return confirm('anda yakin akan menghapus data barang ini?')">
                                 <i class="fas fa-trash"></i>
                              </a>
                           </td>
                        </tr>

                     <?php
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