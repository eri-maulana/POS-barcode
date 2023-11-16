<?php

// cek akun
// jika akun yang login adalah petugas / role no 3 , tidak boleh meng akses halaman customer
if (userLogin()['level'] == 3) {
   header("location: " . $main_url . "error-page.php");
   exit();
}

// fungsi menambahkan data customer baru
function insert($data)
{
   global $koneksi;

   $nama = mysqli_real_escape_string($koneksi, $data['nama']);
   $telpon = mysqli_real_escape_string($koneksi, $data['telpon']);
   $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
   $ketr = mysqli_real_escape_string($koneksi, $data['ketr']);

   $sqlCustomer = "INSERT INTO tbl_customer VALUES (null, '$nama', '$telpon', '$ketr', '$alamat')";
   mysqli_query($koneksi, $sqlCustomer);

   return mysqli_affected_rows($koneksi);
}

// fungsi menghapus data customer 
function delete($id)
{
   global $koneksi;

   $sqlDel = "DELETE FROM tbl_customer WHERE id_customer='$id'";
   mysqli_query($koneksi, $sqlDel);


   return mysqli_affected_rows($koneksi);
}


// fungsi Mengubah data customer 
function update($data)
{
   global $koneksi;

   $id = mysqli_real_escape_string($koneksi, $data['id']);
   $nama = mysqli_real_escape_string($koneksi, $data['nama']);
   $telpon = mysqli_real_escape_string($koneksi, $data['telpon']);
   $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
   $ketr = mysqli_real_escape_string($koneksi, $data['ketr']);

   $sqlCustomer = "UPDATE tbl_customer SET nama = '$nama' , telpon = '$telpon', deskripsi = '$ketr', alamat = '$alamat' WHERE id_customer = '$id'";
   mysqli_query($koneksi, $sqlCustomer);

   return mysqli_affected_rows($koneksi);
}
