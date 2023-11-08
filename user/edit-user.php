<?php
require "../config/config.php";
require "../config/functions.php";
require "../module/mode-user.php";
$title = "Ubah Data Pengguna - POS barcode";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$id = $_GET['id'];
$sqlEdit = "SELECT * FROM tbl_user WHERE userid='$id'";
$user = getData($sqlEdit)[0];
$level = $user['level'];

if (isset($_POST['koreksi'])) {
   if (update($_POST)) {
      echo '<script>
               alert("data user berhasil di ubah");
               document.location.href = "data-user.php";
            </script>';
   }
}


?>

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Ubah Data Pengguna</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>dashboard.php">Home</a></li>
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>user/data-user.php">Data Pengguna</a></li>
                  <li class="breadcrumb-item active">Ubah Data Pengguna</li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>

   <section class="content">
      <div class="container-fluid">
         <div class="card">
            <form action="" method="post" enctype="multipart/form-data">
               <div class="card-header">
                  <h2 class="card-title text-xl"><i class="fas fa-pen fa-sm mr-2"></i> Ubah Data Pengguna</h2>
                  <button type="submit" name="koreksi" class="btn btn-primary  float-right"><i class="fas fa-save mr-1"></i>
                     Ubah</button>
                  <button type="reset" name="" class="btn btn-danger  float-right mr-1"><i class="fas fa-times mr-1"></i> Batal</button>
               </div>
               <div class="card-body">
                  <div class="row">
                     <input type="hidden" name="id" value="<?= $user['userid']; ?>">
                     <div class="col-lg-8 mb-3">
                        <div class="form-group">
                           <label for="username">Username</label>
                           <input type="text" name="username" class="form-control" id="username" placeholder="Masukan Username" autofocus autocomplete="off" value="<?= $user['username']; ?>">
                        </div>
                        <div class=" form-group">
                           <label for="fullname">Nama Lengkap</label>
                           <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Masukan Nama Lengkap" autocomplete="off" value="<?= $user['fullname']; ?>">
                        </div>

                        <div class="form-group">
                           <label for="level">Level</label>
                           <select name="level" id="level" class="form-control">
                              <option value="">-- Pilih Level --</option>
                              <option value="1" <?= selectUser1($level); ?>>Administrator</option>
                              <option value="2" <?= selectUser2($level); ?>>Supervisor</option>
                              <option value="3" <?= selectUser3($level); ?>>Operator</option>
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="address">Alamat</label>
                           <textarea name="address" id="address" class="form-control" cols="" rows="3" placeholder="Masukan Alamat"><?= $user['address']; ?></textarea>
                        </div>
                     </div>
                     <div class="col-lg-4 mb-3 text-center">
                        <input type="hidden" name="oldImg" value="<?= $user['foto']; ?>">
                        <img src="<?= $main_url; ?>asset/image/<?= $user['foto']; ?>" alt="" class="profile-user-img img-circle mb-3">
                        <input type="file" class="form-control " name="image">
                        <span class="text-sm">type file gambar "jpg, png, dan gif"</span>
                        <br>
                        <span class="text-sm">Widht = Height</span>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </section>

   <?php
   require "../template/footer.php";
   ?>