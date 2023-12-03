<?php

// fungsi membuat no urut otomatis
function generateNo()
{
   global $koneksi;

   $queryNo = mysqli_query($koneksi, "SELECT max(no_beli) as maxno FROM tbl_beli_head");
   $row     = mysqli_fetch_assoc($queryNo);
   $maxno   = $row['maxno'];

   $noUrut = (int) substr($maxno, 2, 4);
   $noUrut++;
   $maxno = 'PB' . sprintf("%04s", $noUrut);

   return $maxno;
}

// fungsi menambahkan barang table yang akan di checkout
function insert($data)
{
   global $koneksi;

   $no         = mysqli_real_escape_string($koneksi, $data['nobeli']);
   $tgl        = mysqli_real_escape_string($koneksi, $data['tglNota']);
   $kode       = mysqli_real_escape_string($koneksi, $data['kodeBrg']);
   $nama       = mysqli_real_escape_string($koneksi, $data['namaBrg']);
   $qty        = mysqli_real_escape_string($koneksi, $data['qty']);
   $harga      = mysqli_real_escape_string($koneksi, $data['harga']);
   $jmlharga   = mysqli_real_escape_string($koneksi, $data['jmlHarga']);

   $cekbrg = mysqli_query($koneksi, "SELECT * FROM tbl_beli_detail WHERE no_beli = '$no' AND kode_brg = '$kode' ");
   if (mysqli_num_rows($cekbrg)) {
      echo "<script>
               alert('barang sudah ada! anda harus menghapusnya dulu jika ingin mengubah QTY-nya');
            </script>";
      return false;
   }

   if (empty($qty)) {
      echo "<script>
                  alert('QTY barang tidak boleh kosong');
               </script>";
      return false;
   } else {
      $sqlbeli = "INSERT INTO tbl_beli_detail VALUES (null, '$no', '$tgl', '$kode', '$nama', $qty, $harga, $jmlharga)";
      mysqli_query($koneksi, $sqlbeli);
   }

   mysqli_query($koneksi, "UPDATE tbl_barang SET stock = stock + $qty WHERE id_barang = '$kode'");

   return mysqli_affected_rows($koneksi);
}

// fungsi menghitung total harga barang yang akan di checkout
function totalBeli($nobeli)
{
   global $koneksi;
   $totalBeli = mysqli_query($koneksi, "SELECT sum(jml_harga) AS total FROM tbl_beli_detail WHERE no_beli = '$nobeli'");
   $data = mysqli_fetch_assoc($totalBeli);
   $total = $data['total'];

   return $total;
}

// fungsi menghapus barang di table checkout
function delete($idbrg, $idbeli, $qty)
{
   global $koneksi;
   $sqlDel = "DELETE FROM tbl_beli_detail WHERE kode_brg = '$idbrg' AND no_beli = '$idbeli'";
   mysqli_query($koneksi, $sqlDel);

   mysqli_query($koneksi, "UPDATE tbl_barang SET stock = stock - $qty WHERE id_barang = '$idbrg'");

   return mysqli_affected_rows($koneksi);
}


// fungsi simpan data transaksi per nota
function simpan($data)
{
   global $koneksi;

   $nobeli = mysqli_real_escape_string($koneksi, $data['nobeli']);
   $tgl = mysqli_real_escape_string($koneksi, $data['tglNota']);
   $total = mysqli_real_escape_string($koneksi, $data['total']);
   $suplier = mysqli_real_escape_string($koneksi, $data['suplier']);
   $keterangan = mysqli_real_escape_string($koneksi, $data['ktr']);

   $sqlbeli = "INSERT INTO tbl_beli_head VALUES ('$nobeli','$tgl','$suplier','$total','$keterangan')";
   mysqli_query($koneksi, $sqlbeli);


   return mysqli_affected_rows($koneksi);
}
