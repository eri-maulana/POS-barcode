<?php

function uploadimg($url = null)
{
   $namafile = $_FILES['image']['name'];
   $ukuran   = $_FILES['image']['size'];
   $tmp      = $_FILES['image']['tmp_name'];

   // validasi file gambar yang boleh di upload
   $ekstensiGambarValid = ['jpg', 'png', 'jpeg', 'gif'];
   $ekstensiGambar      = explode('.', $namafile);
   $ekstensiGambar      = strtolower(end($ekstensiGambar));
   if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      if ($url != null) {
         echo '<script>
               alert("data yang anda unggah bukan gambar !! data gagal diubah!!");
               document.location.href = "' . $url . '";
            </script>';
         die();
      } else {
         echo "<script>
         alert('data yang anda unggah bukan gambar !! data gagal ditambahkan!!');
         </script>";
         return false;
      }
   }

   // validasi ukuran gambar max 1 MB
   if ($ukuran > 1000000) {
      if ($url != null) {
         echo '<script>
               alert("ukuran gambar melebihi 1 mb, data gagal di ubah");
               document.location.href = "' . $url . '";
            </script>';
         die();
      } else {
         echo "<script>
                  alert('gambar tidak boleh lebih dari 1 MB');
               </script>";
         return false;
      }
   }

   $namaFileBaru = rand(10, 1000) . '-' . $namafile;

   move_uploaded_file($tmp, '../asset/image/' . $namaFileBaru);
   return $namaFileBaru;
}

function getData($sql)
{
   global $koneksi;
   $result = mysqli_query($koneksi, $sql);
   $rows = [];
   while ($row = mysqli_fetch_array($result)) {
      $rows[] = $row;
   }
   return $rows;
}