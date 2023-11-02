<?php

date_default_timezone_set('Asia/Jakarta');

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'kasir-barcode';

$koneksi = mysqli_connect($host, $username, $password, $database);
// if(mysqli_connect_errno()){
//    echo "Koneksi ke database Gagal !";
//    exit;
// } else {
//    echo "database berhasil terkoneksi";
// }

$main_url = 'http://localhost/kasir-barcode/';


?>