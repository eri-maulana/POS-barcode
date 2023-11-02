<?php
require "config/config.php";

$title = "Dashboard - POS barcode";
require "template/header.php";
require "template/navbar.php";
require "template/sidebar.php";

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
                     <h4>0</h4>

                     <p>Pengguna</p>
                  </div>
                  <div class="icon">
                     <i class="far fa-user-circle"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
               <!-- small box -->
               <div class="small-box bg-light">
                  <div class="inner">
                     <h4>0</h4>

                     <p>Supplier</p>
                  </div>
                  <div class="icon">
                     <i class="fas fa-box"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
               <!-- small box -->
               <div class="small-box bg-light">
                  <div class="inner">
                     <h4>0</h4>

                     <p>Pelanggan</p>
                  </div>
                  <div class="icon">
                     <i class="fas fa-users"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
               <!-- small box -->
               <div class="small-box bg-light">
                  <div class="inner">
                     <h4>0</h4>

                     <p>Barang</p>
                  </div>
                  <div class="icon">
                     <i class="fas fa-boxes"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- ./col -->
         </div>
      </div>
   </div>
   <!-- /.content -->

   <?php
   require "template/footer.php";
   ?>