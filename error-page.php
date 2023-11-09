<?php

session_start();

if (!isset($_SESSION['ssLoginPOST'])) {
   header("location: auth/login.php");
   exit();
}

require "config/config.php";
require "config/functions.php";

$title = "Halaman Error - POS barcode";
require "template/header.php";
require "template/navbar.php";
require "template/sidebar.php";

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Halaman Error</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Halaman Error</li>
               </ol>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">
      <div class="error-page">
         <h2 class="headline text-warning"> 404</h2>

         <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Halaman tidak ditemukan.</h3>

            <p>
               Kami tidak dapat menemukan halaman yang kamu cari.
               <a href="dashboard.php">kembali ke halaman Dashboard</a>
            </p>

         </div>
         <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
   </section>
   <!-- /.content -->


   <?php
   require "template/footer.php";
   ?>