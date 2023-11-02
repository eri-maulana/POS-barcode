<?php
require "../config/config.php";
$title = "Tambah User - POS barcode";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";
?>

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>dashboard.php">Home</a></li>
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>user/data-user.php">Users</a></li>
                  <li class="breadcrumb-item active">Users</li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>

   <section class="content">
      <div class="container-fluid">
         <div class="card">
            <div class="card-header">
               <h2 class="card-title text-xl"><i class="fas fa-plus fa-sm mr-2"></i> Add User</h2>
               <button type="submit" name="simpan" class="btn btn-primary  float-right"><i class="fas fa-save mr-1"></i>
                  Simpan</button>
               <button type="reset" name="simpan" class="btn btn-danger  float-right mr-1"><i class="fas fa-times mr-1"></i> Cancel</button>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-lg-8 mb-3">
                     <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Masukan Username" autofocus autocomplete="off">
                     </div>
                     <div class="form-group">
                        <label for="fullname">Nama Lengkap</label>
                        <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Masukan Nama Lengkap" autocomplete="off">
                     </div>
                     <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Kata Sandi" autocomplete="off">
                     </div>
                     <div class="form-group">
                        <label for="password2">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password2" class="form-control" id="password2" placeholder="Masukan Kembali Kata Sandi" autocomplete="off">
                     </div>
                     <div class="form-group">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="form-control">
                           <option value="">-- Pilih Level --</option>
                           <option value="1">Administrator</option>
                           <option value="2">Supervisor</option>
                           <option value="3">Operator</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control" cols="" rows="3" placeholder="Masukan Alamat" required></textarea>
                     </div>
                  </div>
                  <div class="col-lg-4 mb-3 text-center">
                     <img src="<?= $main_url; ?>asset/image/profil.png" alt="" class="profile-user-img img-circle mb-3">
                     <input type="file" class="form-control" name="image">
                     <span class="text-sm">type file gambar "jpg, png, dan gif"</span>
                     <br>
                     <span class="text-sm">Widht = Height</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

   <?php
   require "../template/footer.php";
   ?>