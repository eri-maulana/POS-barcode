<?php
// fungsi mengubah kata sandi 
function update($data)
{
   global $koneksi;

   // menangkap nilai dari input
   $curPass = trim(mysqli_real_escape_string($koneksi, $_POST['curPass']));
   $newPass = trim(mysqli_real_escape_string($koneksi, $_POST['newPass']));
   $confPass = trim(mysqli_real_escape_string($koneksi, $_POST['confPass']));
   $userActive = userLogin()['username'];

   // memeriksa kata sandi baru dan konfirmasi kata sandi baru
   if ($newPass !== $confPass) {
      echo "<script>
               alert('Kata Sandi gagal diperbarui.. !');
               document.location='?msg=err1'; 
            </script>";
      return false;
   }

   // verifikasi kata sandi lama dari database
   if (!password_verify($curPass, userLogin()['password'])) {
      echo "<script>
               alert('Kata Sandi gagal diperbarui.. !');
               document.location='?msg=err2'; 
            </script>";
      return false;
   } else {
      $pass = password_hash($newPass, PASSWORD_DEFAULT);
      mysqli_query($koneksi, "UPDATE tbl_user SET password = '$pass' WHERE username = '$userActive'");
      return mysqli_affected_rows($koneksi);
   }
}