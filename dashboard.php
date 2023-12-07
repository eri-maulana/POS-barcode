<?php

session_start();

if (!isset($_SESSION['ssLoginPOST'])) {
   header("location: auth/login.php");
   exit();
}


require "config/config.php";
require "config/functions.php";

$title = "Dashboard - POS barcode";
require "template/header.php";
require "template/navbar.php";
require "template/sidebar.php";

$users = getData("SELECT * FROM tbl_user");
$userNum = count($users);

$customers = getData("SELECT * FROM tbl_customer");
$customerNum = count($customers);

$suppliers = getData("SELECT * FROM tbl_supplier");
$supplierNum = count($suppliers);

$stocks = getData("SELECT * FROM tbl_barang");
$stockNum = count($stocks);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- Main content -->
   <div class="content">
      <div class="container-fluid">
         <!-- Small boxes (Stat box) -->
         <div class="row">
            <div class="col-lg-3 col-6">
               <!-- small box -->
               <div class="small-box bg-light">
                  <div class="inner">
                     <h4><?= $userNum; ?></h4>

                     <p>Pengguna</p>
                  </div>
                  <div class="icon">
                     <i class="far fa-user-circle"></i>
                  </div>
                  <a href="<?= $main_url ?>user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
               <!-- small box -->
               <div class="small-box bg-light">
                  <div class="inner">
                     <h4><?= $supplierNum; ?></h4>

                     <p>Supplier</p>
                  </div>
                  <div class="icon">
                     <i class="fas fa-box"></i>
                  </div>
                  <a href="<?= $main_url ?>supplier" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
               <!-- small box -->
               <div class="small-box bg-light">
                  <div class="inner">
                     <h4><?= $customerNum ?></h4>

                     <p>Pelanggan</p>
                  </div>
                  <div class="icon">
                     <i class="fas fa-users"></i>
                  </div>
                  <a href="<?= $main_url ?>customer" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
               <!-- small box -->
               <div class="small-box bg-light">
                  <div class="inner">
                     <h4><?= $stockNum ?></h4>

                     <p>Barang</p>
                  </div>
                  <div class="icon">
                     <i class="fas fa-boxes"></i>
                  </div>
                  <a href="<?= $main_url ?>barang" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- ./col -->
         </div>
         <div class="row">
            <div class="col-lg-6">
               <div class="card card-outline card-secondary">
                  <div class="card-header text-dark">
                     <h4 class="card-title pt-1">Laporan Stock Barang</h4>
                     <h4><a href="stock" class="float-right" title="Laporan Stock"><i class="fas fa-arrow-right fa-sm"></i></a></h4>
                  </div>
                  <table class="table">
                     <tbody>
                        <?php
                        $stockmin = getData("SELECT * FROM tbl_barang WHERE stock < stock_minimal");
                        foreach ($stockmin as $min) {
                        ?>
                           <tr>
                              <td><?= $min['nama_barang']; ?></td>
                              <td class="text-danger">Stock Kurang !</td>
                           </tr>
                        <?php
                        }
                        ?>
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="col-lg-6 ">
               <div class="card card-outline card-secondary  text-center">
                  <div class="card-header text-dark pt-2 font-weight-bold">
                     <h2>Omzet penjualan</h4>
                  </div>
                  <div class="card-body text-success pb-4">
                     <h1><span class="h1 text-dark">Rp </span><?= omzet(); ?><span class="text-dark">.-</span></h1>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- /.content -->

   <?php
   require "template/footer.php";
   ?>