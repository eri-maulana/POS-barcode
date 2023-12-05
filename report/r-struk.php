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
$nota = $_GET['nota'];
$dataJual = getData("SELECT * FROM tbl_jual_head WHERE no_jual = '$nota'")[0];
$itemJual = getData("SELECT * FROM tbl_jual_detail WHERE no_jual = '$nota'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Struk Belanja</title>
</head>

<body>

   <table style="border-bottom: solid 2px ; text-align: center; font-size: 14px; width: 240px;">
      <tr>
         <td><b>Eri Maulana | POS Barcode</b></td>
      </tr>
      <tr>
         <td><?= "No Nota : $nota"; ?></td>
      </tr>
      <tr>
         <td><?= date('d-m-Y H:i:s') ?></td>
      </tr>
      <tr>
         <td><?= userLogin()['username'] ?></td>
      </tr>
   </table>

   <table style="border-bottom: dotted 2px ; text-align: center; font-size: 14px; width: 240px;">
      <?php
      foreach ($itemJual as $item) {
      ?>
         <tr>
            <td colspan="6" style="width: 70px;text-align: left;"><b><?= $item['nama_brg'] ?></b></td>
         </tr>
         <tr>
            <td colspan="2" style="width: 70px;text-align: left;">Qty : </td>
            <td style="width: 10px; text-align: center;"><?= $item['qty'] ?></td>
            <td style="width: 70px; text-align: right;">x <?= number_format($item['harga_jual'], 0, ',', '.') ?></td>
            <td style="width: 70px; text-align: right;" colspan="2">
               <?= number_format($item['jml_harga'], 0, ',', '.') ?></td>
         </tr>
      <?php
      }
      ?>
   </table>

   <table style="border-bottom: dotted 2px ;  font-size: 14px; width: 240px;">
      <tr>
         <td colspan="3" style="width: 100px;"></td>
         <td style="width: 50px; text-align: right;">Total</td>
         <td colspan="2" style="width: 70px; text-align: right;">
            <b><?= number_format($dataJual['total'], 0, ',', '.') ?></b>
         </td>
      </tr>
      <tr>
         <td colspan="3" style="width: 100px;"></td>
         <td style="width: 50px; text-align: right;">Bayar</td>
         <td colspan="2" style="width: 70px; text-align: right;">
            <b><?= number_format($dataJual['jml_bayar'], 0, ',', '.') ?></b>
         </td>
      </tr>
   </table>

   <table style="border-bottom: solid 2px ;  font-size: 14px; width: 240px;">
      <tr>
         <td colspan="3" style="width: 100px;"></td>
         <td style="width: 50px; text-align: right;">Kembalian</td>
         <td colspan="2" style="width: 70px; text-align: right;">
            <b><?= number_format($dataJual['kembalian'], 0, ',', '.') ?></b>
         </td>
      </tr>
   </table>

   <table style="text-align: center; margin-top: 10px; font-size: 16px; width: 240px;">
      <tr>
         <td>Terima kasih Sudah Belanja Disini.~</td>
      </tr>
      <td>Semoga Hari mu Menyenangkan.~</td>
   </table>

   <script>
      setTimeout(function() {
         window.print();
      }, 3000)
   </script>
</body>

</html>