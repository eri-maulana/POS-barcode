<?php

// cek akun
// jika akun yang login adalah petugas / role no 3 , tidak boleh meng akses halaman Stock Barang
if (userLogin()['level'] == 3) {
   header("location: " . $main_url . "error-page.php");
   exit();
}

function generateId()
{
   global $koneksi;

   $queryId = mysqli_query($koneksi, "SELECT max(id_barang) as maxid FROM tbl_barang");
   $data = mysqli_fetch_array($queryId);
   $maxid = $data['maxid'];

   $noUrut = (int) substr($maxid, 4, 3);
   $noUrut++;
   $maxid = "BRG-" . sprintf("%03s", $noUrut);

   return $maxid;
}


function insert($data)
{
   global $koneksi;

   $id = mysqli_real_escape_string($koneksi, $data['kode']);
   $barcode = mysqli_real_escape_string($koneksi, $data['barcode']);
   $nama = mysqli_real_escape_string($koneksi, $data['nama']);
   $satuan = mysqli_real_escape_string($koneksi, $data['satuan']);
   $harga_beli = mysqli_real_escape_string($koneksi, $data['harga_beli']);
   $harga_jual = mysqli_real_escape_string($koneksi, $data['harga_jual']);
   $stock_minimal = mysqli_real_escape_string($koneksi, $data['stock_minimal']);
   $gambar = mysqli_real_escape_string($koneksi, $_FILES['image']['name']);

   $cekBarcode = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE barcode = '$barcode'");
   if (mysqli_num_rows($cekBarcode)) {
      echo "<script>
               alert('Data Barang Sudah Tersedia .. Barang Gagal Ditambahkan !!');
            </script>";
      return false;
   }

   // upload gambar Barang
   if ($gambar != null) {
      $gambar = uploadimg(null, $id);
   } else {
      $gambar = 'default-brg.png';
   }

   // gambar tidak sesuai validasi 
   if ($gambar == '') {
      return false;
   }

   $sqlBarang = "INSERT INTO tbl_barang VALUE ('$id', '$barcode', '$nama','$harga_beli','$harga_jual',0,'$satuan','$stock_minimal','$gambar')";
   mysqli_query($koneksi, $sqlBarang);

   return mysqli_affected_rows($koneksi);
}

// fungsi menghapus data barang 
function delete($id, $gbr)
{
   global $koneksi;

   $sqlDel = "DELETE FROM tbl_barang WHERE id_barang='$id'";
   mysqli_query($koneksi, $sqlDel);
   if ($gbr != 'default-brg.png') {
      unlink('../asset/image/' . $gbr);
   }

   return mysqli_affected_rows($koneksi);
}

function update($data)
{
   global $koneksi;

   $id = mysqli_real_escape_string($koneksi, $data['kode']);
   $barcode = mysqli_real_escape_string($koneksi, $data['barcode']);
   $nama = mysqli_real_escape_string($koneksi, $data['nama']);
   $satuan = mysqli_real_escape_string($koneksi, $data['satuan']);
   $harga_beli = mysqli_real_escape_string($koneksi, $data['harga_beli']);
   $harga_jual = mysqli_real_escape_string($koneksi, $data['harga_jual']);
   $stock_minimal = mysqli_real_escape_string($koneksi, $data['stock_minimal']);
   $gbrLama = mysqli_real_escape_string($koneksi, $data['oldImg']);
   $gambar = mysqli_real_escape_string($koneksi, $_FILES['image']['name']);

   // cek barcode lama 
   $queryBarcode = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE barcode = '$barcode'");
   $dataBrg = mysqli_fetch_assoc($queryBarcode);
   $curBarcode = $dataBrg['barcode'];

   // barcode baru
   $cekBarcode = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE id_barang = '$id'");

   // jika barcode diganti
   if ($barcode !== $curBarcode) {
      // jika barcode sudah ada 
      if (mysqli_num_rows($cekBarcode)) {
         echo "<script>
                  alert('Data Barang Sudah Tersedia .. Barang Gagal Di Ubah !!');
               </script>";
         return false;
      }
   }

   // cek gambar Barang
   if ($gambar != null) {
      $url = "index.php";
      if ($gbrLama == "default-brg.png") {
         $nmgbr = $id;
      } else {
         $nmgbr = $id . '-' . rand(10, 1000);
      }
      $imgBrg = uploadimg($url, $nmgbr);
      if ($gbrLama != "default-brg.png") {
         @unlink('../asset/image/' . $gbrLama);
      }
   } else {
      $imgBrg = $gbrLama;
   }


   mysqli_query($koneksi, "UPDATE tbl_barang SET
                              barcode         = '$barcode',
                              nama_barang     = '$nama',
                              satuan          = '$satuan',
                              harga_beli      = $harga_beli,
                              harga_jual      = $harga_jual,
                              stock_minimal   = $stock_minimal,
                              gambar          = '$imgBrg' 
                              WHERE id_barang = '$id'

                           ");

   return mysqli_affected_rows($koneksi);
}