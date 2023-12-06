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

$tgl1 = $_GET['tgl1'];
$tgl2 = $_GET['tgl2'];
$dataJual = getData("SELECT * FROM tbl_jual_head WHERE tgl_jual BETWEEN '$tgl1' AND '$tgl2'");
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Laporan Barang Keluar</title>
</head>

<body>
   <div style="text-align: center; margin-bottom: 30px;">
      <h2 style="margin-bottom: -15px;">Rekap Laporan Barang Keluar</h2>
      <h2 style="margin-bottom: 15px;">Eri Maulana | POS Barcode</h2>
   </div>
   <table align="center">
      <thead>
         <tr>
            <td colspan="5" style="height: 5px;">
               <hr style="margin-bottom: 2px; margin-left: -5px;" size="3" color="grey">
            </td>
         </tr>
         <tr>
            <th style="width: 50px;">No</th>
            <th style="width: 150px;">Tanggal Penjualan</th>
            <th style="width: 150px;">ID Penjualan</th>
            <th style="width: 300px;">Customer</th>
            <th style="width: 300px;">Total Penjualan</th>
         </tr>
         <tr>
            <td colspan="5" style="height: 5px;">
               <hr style="margin-bottom: 2px; margin-left: -5px;" size="3" color="grey">
            </td>
         </tr>
      </thead>
      <tbody>
         <?php
         $no = 1;
         foreach ($dataJual as $data) {
         ?>
            <tr>
               <td align="center"><?= $no++ ?></td>
               <td align="center"><?= in_date($data['tgl_jual']); ?></td>
               <td align="center"><?= $data['no_jual'] ?></td>
               <td align="center"><?= $data['customer'] ?></td>
               <td align="center"><?= number_format($data['total'], 0, ',', '.'); ?></td>
            </tr>
         <?php
         }
         ?>
      </tbody>
      <tfoot>
         <tr>
            <td colspan="5" style="height: 5px;">
               <hr style="margin-bottom: 2px; margin-left: -5px;" size="3" color="grey">
            </td>
         </tr>
      </tfoot>
   </table>


   <script>
      setTimeout(function() {
         window.print();
      }, 5000)
   </script>
</body>

</html>

<?php

?>