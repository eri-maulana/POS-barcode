<?php
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="<?= $main_url; ?>dashboard.php" class="brand-link">
      <img src="<?= $main_url; ?>asset/image/eri.jpg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light ml-2">POS - barcode</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
         </div>
         <div class="info">
            <a href="#" class="d-block"><?= "Eri Maulana"; ?></a>
         </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
               <a href="<?= $main_url; ?>dashboard.php" class="nav-link">
                  <i class="fas fa-tachometer-alt nav-icon text-sm"></i>
                  <p>Dashboard</p>
               </a>
            </li>
            <li class="nav-item">
               <a href="#" class="nav-link">
                  <i class="fas fa-folder  nav-icon text-sm"></i>
                  <p>
                     Master
                     <i class="fas fa-angle-right right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview ml-4">
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon text-sm "></i>
                        <p>Supplier</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon text-sm "></i>
                        <p>Pelanggan</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon text-sm "></i>
                        <p>Stock Barang</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-header">Transaksi</li>
            <li class="nav-item">
               <a href="" class="nav-link">
                  <i class="fas fa-shopping-cart nav-icon text-sm "></i>
                  <p>Barang Masuk</p>
               </a>
            </li>
            <li class="nav-item">
               <a href="" class="nav-link">
                  <i class="fas fa-file-invoice nav-icon text-sm "></i>
                  <p>Barang Keluar</p>
               </a>
            </li>
            <li class="nav-header">Laporan</li>
            <li class="nav-item">
               <a href="" class="nav-link">
                  <i class="fas fa-chart-pie nav-icon text-sm "></i>
                  <p>Laporan Barang Masuk</p>
               </a>
            </li>
            <li class="nav-item">
               <a href="" class="nav-link">
                  <i class="fas fa-chart-line nav-icon text-sm "></i>
                  <p>Laporan Barang Keluar</p>
               </a>
            </li>
            <li class="nav-item">
               <a href="" class="nav-link">
                  <i class="fas fa-warehouse nav-icon text-sm "></i>
                  <p>Laporan Stock Barang</p>
               </a>
            </li>
            <li class="nav-header">Akun</li>
            <li class="nav-item">
               <a href="<?= $main_url; ?>user/data-user.php" class="nav-link">
                  <i class="far fa-user-circle nav-icon text-sm "></i>
                  <p>Data Pengguna</p>
               </a>
            </li>
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>