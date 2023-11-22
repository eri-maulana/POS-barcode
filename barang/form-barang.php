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
$title = "Form Barang - POS barcode";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

// manangkap pesan dari halaman index.php
if (isset($_GET['msg'])) {
   $msg = $_GET['msg'];
   $id = $_GET['id'];
   $sqlEdit = "SELECT * FROM tbl_barang WHERE id_barang = '$id'";
   $barang = getData($sqlEdit)[0];
} else {
   $msg = "";
}

// aksi ketika tombol simpan di tekan
$alert = '';
if (isset($_POST['simpan'])) {
   if ($msg != "") {
      if (update($_POST)) {
         echo "
               <script>
                  document.location.href = 'index.php?msg=updated';
               </script>
               ";
      } else {
         echo "
               <script>
                  document.location.href = 'index.php';
               </script> 
               ";
      }
   } else {
      if (insert($_POST)) {
         $alert = '<div class="alert alert-success alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <h5><i class="icon fas fa-check"></i> Data Barang Berhasil Ditambahkan.~</h5>
            </div>';
      }
   }
}

?>

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Form Barang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>dashboard.php">Home</a></li>
                  <li class="breadcrumb-item"><a href="<?= $main_url; ?>barang">Data Barang</a>
                  </li>
                  <li class="breadcrumb-item active"><?= $msg != "" ? "Ubah Barang" : "Tambah Barang"; ?></li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>

   <!-- content -->
   <div class="content">
      <div class="container-fluid">
         <div class="card">
            <form action="" method="post" enctype="multipart/form-data">
               <?php
               if ($alert != '') {
                  echo $alert;
               }
               ?>
               <div class="card-header">
                  <h2 class="card-title pt-2">
                     <?= $msg != "" ? "<i class='fas fa-pen fa-sm mr-2'></i> Ubah Barang" : "<i class='fas fa-plus fa-sm mr-2'></i> Tambah Barang"; ?>
                  </h2>
                  <button type="submit" name="simpan" class="btn btn-primary  float-right"><i class="fas fa-save mr-1"></i>
                     Simpan</button>
                  <button type="reset" name="" class="btn btn-danger  float-right mr-1"><i class="fas fa-times mr-1"></i>
                     Batal</button>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-lg-8 mb-3 pr-3">
                        <div class="form-group">
                           <label for="kode">Kode Barang</label>
                           <input type="text" value="<?= $msg != "" ? $barang['id_barang'] : generateId(); ?>" name="kode" id="kode" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                           <label for="barcode">Barcode</label>
                           <input type="text" name="barcode" id="barcode" class="form-control" autofocus autocomplete="off" value="<?= $msg != "" ? $barang['barcode'] : null; ?>">
                        </div>
                        <div class="form-group">
                           <label for="nama">Nama</label>
                           <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?= $msg != "" ? $barang['nama_barang'] : null; ?>">
                        </div>
                        <div class="form-group">
                           <label for="satuan">Satuan</label>
                           <select name="satuan" id="satuan" class="form-control">
                              <?php
                              if ($msg != "") {
                                 $satuan = ["piece", "botol", "kaleng", "pouch"];
                                 foreach ($satuan as $sat) {
                                    if ($barang['satuan'] == $sat) {
                              ?>
                                       <option value="<?= $sat ?>" selected><?= $sat ?></option>
                                    <?php
                                    } else {
                                    ?>
                                       <option value="<?= $sat ?>"><?= $sat ?></option>
                                 <?php
                                    }
                                 }
                              } else {
                                 ?>
                                 <option value="">-- Satuan Barang --</option>
                                 <option value="piece">Piece</option>
                                 <option value="botol">Botol</option>
                                 <option value="kaleng">Kaleng</option>
                                 <option value="pouch">Pouch</option>

                              <?php
                              }
                              ?>
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="harga_beli">Harga Beli</label>
                           <input type="number" name="harga_beli" id="harga_beli" class="form-control" autocomplete="off" value="<?= $msg != "" ? $barang['harga_beli'] : null; ?>">
                        </div>
                        <div class="form-group">
                           <label for="harga_jual">Harga Jual</label>
                           <input type="number" name="harga_jual" id="harga_jual" class="form-control" autocomplete="off" value="<?= $msg != "" ? $barang['harga_jual'] : null; ?>">
                        </div>
                        <div class="form-group">
                           <label for="stock_minimal">Stock Minimal</label>
                           <input type="number" name="stock_minimal" id="stock_minimal" class="form-control" autocomplete="off" value="<?= $msg != "" ? $barang['stock_minimal'] : null; ?>">
                        </div>
                     </div>
                     <div class="col-lg-4 text-center px-3">
                        <input type="hidden" name="oldImg" value="<?= $msg != "" ? $barang['gambar'] : null; ?>">
                        <img src="<?= $main_url; ?>asset/image/<?= $msg != "" ? $barang['gambar'] : "default-brg.png"; ?>" class="profile-user-img mb-3" alt="">
                        <input type="file" name="image" class="form-control">
                        <span class="text-sm">hanya boleh menggunakan ekstensi JPG | PNG | GIF</span>
                     </div>
                  </div>
            </form>
         </div>
      </div>
   </div>
</div>

<?php

require "../template/footer.php";

?>