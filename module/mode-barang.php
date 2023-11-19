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
   $gambar = mysqli_real_escape_string($koneksi, $_FILES['image']['nama']);

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

   $sqlBarang = "INSERT INTO tbl_barang VALUE ('$id', '$barcode', '$nama','$harga_beli','$harga_jual',0,'$satuan','$stock_minimal','$gambar ')";
   mysqli_query($koneksi, $sqlBarang);

   return mysqli_affected_rows($koneksi);
}
